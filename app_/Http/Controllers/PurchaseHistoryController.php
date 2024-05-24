<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use DB;
use Auth;
use App\Models\Order;
use App\Models\Upload;
use App\Models\Product;
use Cookie;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('orderDetails')->where('user_id', Auth::user()->id)->orderBy('code', 'desc')->paginate(10);
        return view('frontend.user.purchase_history', compact('orders'));
    }

    public function digital_index()
    {
        $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->join('products', 'order_details.product_id', '=', 'products.id')
                        ->where('orders.user_id', Auth::user()->id)
                        ->where('products.digital', '1')
                        ->where('order_details.payment_status', 'paid')
                        ->select('order_details.id')
                        ->paginate(15);
        return view('frontend.user.digital_purchase_history', compact('orders'));
    }

    public function purchase_history_details($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->delivery_viewed = 1;
        $order->payment_status_viewed = 1;
        $order->save();
        return view('frontend.user.order_details_customer', compact('order'));
    }

    public function download(Request $request)
    {
        $product = Product::findOrFail(decrypt($request->id));
        $downloadable = false;
        foreach (Auth::user()->orders as $key => $order) {
            foreach ($order->orderDetails as $key => $orderDetail) {
                if ($orderDetail->product_id == $product->id && $orderDetail->payment_status == 'paid') {
                    $downloadable = true;
                    break;
                }
            }
        }
        if ($downloadable) {
            $upload = Upload::findOrFail($product->file_name);
            if (env('FILESYSTEM_DRIVER') == "s3") {
                return \Storage::disk('s3')->download($upload->file_name, $upload->file_original_name . "." . $upload->extension);
            } else {
                if (file_exists(base_path('public/' . $upload->file_name))) {
                    return response()->download(base_path('public/' . $upload->file_name));
                }
            }
        } else {
            flash(translate('You cannot download this product.'))->success();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order_cancel($id)
    {
        $order = Order::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if($order && ($order->delivery_status == 'pending' && $order->payment_status == 'unpaid')) {
            $order->delivery_status = 'cancelled';
            $order->save();

            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->delivery_status = 'cancelled';
                $orderDetail->save();
                product_restock($orderDetail);
            }

            flash(translate('Order has been canceled successfully'))->success();
        } else {
            flash(translate('Something went wrong'))->error();
        }

        return back();
    }

    public function re_order($id)
    {   
        // dd($id);
        $user_id = Auth::user()->id;

        // if Cart has auction product check
        $carts = Cart::where('user_id', $user_id)->get();
        foreach ($carts as $cartItem){
            $cart_product = Product::where('id', $cartItem['product_id'])->first();
            if($cart_product->auction_product == 1){
                return back();
                flash(translate('Remove auction product from cart to add products.'))->error();
            }
        }

        $order = Order::findOrFail(decrypt($id));
        $msgs = [];
        $tax = 0;
        $data['user_id'] = $user_id;
        foreach ($order->orderDetails as $key => $orderDetail) {
            $product = $orderDetail->product;

            if($product && $product->published == 1 && $product->approved == 1){
                if($product->auction_product == 0 ){
                    // If product min qty is greater then the ordered qty, then update the order qty 
                    $order_qty = $orderDetail->quantity;
                    if($product->digital != 1 && $order_qty < $product->min_qty) {
                        $order_qty = $product->min_qty;
                    }

                    $data['product_id'] = $product->id;
                    $data['owner_id'] = $product->user_id;
                    $data['variation'] = $orderDetail->variation;

                    $product_stock = $product->stocks->where('variant', $data['variation'])->first();
                    if($product_stock){
                        $price = $product_stock->price;

                        if($product->wholesale_product){
                            $wholesalePrice = $product_stock->wholesalePrices->where('min_qty', '<=', $order_qty)->where('max_qty', '>=', $order_qty)->first();
                            if($wholesalePrice){
                                $price = $wholesalePrice->price;
                            }
                        }

                        $quantity = $product_stock->qty;
                        if($product->digital != 1){
                            if($quantity > 0){
                                //If order qty is greater then the product stock, set order qty = current product stock qty
                                $order_qty = $quantity >= $order_qty ? $order_qty : $quantity;
                            }
                            else{
                                array_push($msgs, $product->getTranslation('name').translate(' is stock stock out.'));
                                continue; 
                            }
                        }

                        //discount calculation
                        $discount_applicable = false;

                        if ($product->discount_start_date == null) {
                            $discount_applicable = true;
                        }
                        elseif (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
                            $discount_applicable = true;
                        }

                        if ($discount_applicable) {
                            if($product->discount_type == 'percent'){
                                $price -= ($price*$product->discount)/100;
                            }
                            elseif($product->discount_type == 'amount'){
                                $price -= $product->discount;
                            }
                        }

                        //calculation of taxes
                        foreach ($product->taxes as $product_tax) {
                            if($product_tax->tax_type == 'percent'){
                                $tax += ($price * $product_tax->tax) / 100;
                            }
                            elseif($product_tax->tax_type == 'amount'){
                                $tax += $product_tax->tax;
                            }
                        }

                        $data['quantity'] = $order_qty;
                        $data['price'] = $price;
                        $data['tax'] = $tax;
                        $data['shipping_cost'] = 0;
                        $data['product_referral_code'] = null;
                        $data['cash_on_delivery'] = $product->cash_on_delivery;
                        $data['digital'] = $product->digital;

                        if ($order_qty == null){
                            $data['quantity'] = 1;
                        }

                        if($carts && count($carts) > 0){
                            $foundInCart = false;

                            foreach ($carts as $key => $cartItem){
                                $cart_product = Product::where('id', $cartItem['product_id'])->first();
                                
                                if($cartItem['product_id'] == $product->id) {
                                    $product_stock = $cart_product->stocks->where('variant', $orderDetail->variation)->first();
                                    $quantity = $product_stock->qty;

                                    if($product->digital != 1){
                                        if($quantity > 0){
                                            // If product min qty is greater then the ordered qty, then update the order qty 
                                            $order_qty = $cartItem['quantity'] + $order_qty;
                                            $order_qty = $quantity >= $order_qty ? $order_qty : $quantity;
                                        }
                                        else{
                                            array_push($msgs, $product->getTranslation('name').translate(' is stock stock out.'));
                                            continue;     
                                        }
                                    }

                                    if(($orderDetail->variation != null && $cartItem['variation'] == $orderDetail->variation) || $orderDetail->variation == null){
                                        $foundInCart = true;

                                        $cartItem['quantity'] += $order_qty;

                                        if($cart_product->wholesale_product){
                                            $wholesalePrice = $product_stock->wholesalePrices->where('min_qty', '<=', $orderDetail->variation)->where('max_qty', '>=', $orderDetail->variation)->first();
                                            if($wholesalePrice){
                                                $price = $wholesalePrice->price;
                                            }
                                        }

                                        $cartItem['price'] = $price;
                                        $cartItem->save();
                                    }
                                }
                            }
                            if (!$foundInCart) {
                                Cart::create($data);
                            }
                        }
                        else{
                            Cart::create($data);
                        }
                    }
                    else{
                        array_push($msgs, $product->getTranslation('name').translate(' is stock out.'));
                    }                    
                }
                else{
                    array_push($msgs, translate('You can not re order an auction product.'));
                }
            }
            else{
                array_push($msgs, translate('An item from this order is not available now.'));
            }
        }

        if(count($msgs) > 0){
            foreach($msgs as $msg){
                flash($msg)->warning();
            }
        }
        else{
            flash(translate('Product added to cart successfully.'))->success();
        }

        return redirect()->route('cart');
    }
}
