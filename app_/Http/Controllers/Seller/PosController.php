<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\ProductStock;
use App\Models\Product;
use App\Models\Order;
use App\Models\City;
use App\Models\User;
use App\Models\Address;
use App\Models\Addon;
use Session;
use Auth;
use Mail;
use App\Mail\InvoiceEmailManager;
use App\Http\Resources\PosProductCollection;
use App\Models\Country;
use App\Models\State;
use App\Utility\CategoryUtility;
use App\Utility\FontUtility;
use App\Utility\PosUtility;
use Mpdf\Mpdf;

class PosController extends Controller
{
    public function index()
    {
        $customers = User::where('user_type', 'customer')->where('email_verified_at', '!=', null)->orderBy('created_at', 'desc')->get();
        if (get_setting('pos_activation_for_seller') == 1) {
            return view('seller.pos.index', compact('customers'));
        }
        else {
            flash(translate('POS is disable for Sellers!!!'))->error();
            return back();
        }
    }

    public function search(Request $request)
    {
        $products = PosUtility::product_search($request->only('category', 'brand', 'keyword'));

        $stocks = new PosProductCollection($products);
        $stocks->appends(['keyword' =>  $request->keyword, 'category' => $request->category, 'brand' => $request->brand]);
        return $stocks;
    }

    public function addToCart(Request $request)
    {
        $stock = ProductStock::find($request->stock_id);
        $product = $stock->product;

        $data = array();
        $data['stock_id'] = $request->stock_id;
        $data['id'] = $product->id;
        $data['variant'] = $stock->variant;
        $data['quantity'] = $product->min_qty;

        if($stock->qty < $product->min_qty && $product->digital == 0){
            return array('success' => 0, 'message' => translate("This product doesn't have enough stock for minimum purchase quantity ").$product->min_qty, 'view' => view('backend.pos.cart')->render());
        }

        $tax = 0;
        $price = $stock->price;

        // discount calculation
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

        //tax calculation
        foreach ($product->taxes as $product_tax) {
            if($product_tax->tax_type == 'percent'){
                $tax += ($price * $product_tax->tax) / 100;
            }
            elseif($product_tax->tax_type == 'amount'){
                $tax += $product_tax->tax;
            }
        }

        $data['price'] = $price;
        $data['tax'] = $tax;

        if($request->session()->has('pos.cart')){
            $foundInCart = false;
            $cart = collect();

            foreach ($request->session()->get('pos.cart') as $key => $cartItem){
                
                if($cartItem['id'] == $product->id && $cartItem['stock_id'] == $stock->id){
                    $foundInCart = true;

                    if($product->digital == 0){
                        $loop_product = Product::find($cartItem['id']);
                        $product_stock = $loop_product->stocks->where('variant', $cartItem['variant'])->first();

                        if($product->digital == 1 || $product_stock->qty >= ($cartItem['quantity'] + 1)){
                            $cartItem['quantity'] += 1;
                        }else{
                            return array('success' => 0, 'message' => translate("This product doesn't have more stock."), 'view' => view('backend.pos.cart')->render());
                        }
                    }
                    else{
                        return array('success' => 0, 'message' => translate("This product is alreday in the cart"), 'view' => view('backend.pos.cart')->render());
                    }
                    
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {
                $cart->push($data);
            }
            $request->session()->put('pos.cart', $cart);
        }
        else{
            $cart = collect([$data]);
            $request->session()->put('pos.cart', $cart);
        }

        $request->session()->put('pos.cart', $cart);

        return array('success' => 1, 'message' => '', 'view' => view('backend.pos.cart')->render());
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $cart = $request->session()->get('pos.cart', collect([]));
        $cart = $cart->map(function ($object, $key) use ($request) {
            if($key == $request->key){
                $product = Product::find($object['id']);
                $product_stock = $product->stocks->where('id', $object['stock_id'])->first();

                if($product_stock->qty >= $request->quantity){
                    $object['quantity'] = $request->quantity;
                }else{
                    return array('success' => 0, 'message' => translate("This product doesn't have more stock."), 'view' => view('backend.pos.cart')->render());
                }
            }
            return $object;
        });
        $request->session()->put('pos.cart', $cart);

        return array('success' => 1, 'message' => '', 'view' => view('backend.pos.cart')->render());
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
        if(Session::has('pos.cart')){
            $cart = Session::get('pos.cart', collect([]));
            $cart->forget($request->key);
            Session::put('pos.cart', $cart);

            $request->session()->put('pos.cart', $cart);
        }

        return view('backend.pos.cart');
    }

    //Shipping Address for seller
    public function getShippingAddressForSeller(Request $request)
    {
        $user_id = $request->id;
        return ($user_id == '') ?
            view('seller.pos.guest_shipping_address') :
            view('seller.pos.shipping_address', compact('user_id'));
    }

    public function set_shipping_address(Request $request)
    {
        $data = PosUtility::get_shipping_address($request);

        $shipping_info = $data;
        $request->session()->put('pos.shipping_info', $shipping_info);
    }

    //set Discount
    public function setDiscount(Request $request){
        if($request->discount >= 0){
            Session::put('pos.discount', $request->discount);
        }
        return view('backend.pos.cart');
    }

    //set Shipping Cost
    public function setShipping(Request $request){
        if($request->shipping != null){
            Session::put('pos.shipping', $request->shipping);
        }
        return view('backend.pos.cart');
    }

    //order summary
    public function get_order_summary(Request $request){
        return view('backend.pos.order_summary');
    }

    //order place
    public function order_store(Request $request){
        if(Session::get('pos.shipping_info') == null || Session::get('pos.shipping_info')['name'] == null || Session::get('pos.shipping_info')['phone'] == null || Session::get('pos.shipping_info')['address'] == null){
            return array('success' => 0, 'message' => translate("Please Add Shipping Information."));
        }

        if(Session::has('pos.cart') && count(Session::get('pos.cart')) > 0){
            $order = new Order;

            if ($request->user_id == null) {
                $order->guest_id    = mt_rand(100000, 999999);
            }
            else {
                $order->user_id = $request->user_id;
            }
            
            $order->shipping_address = json_encode(Session::get('pos.shipping_info'));

            $order->payment_type = $request->payment_type;
            $order->delivery_viewed = '0';
            $order->payment_status_viewed = '0';
            $order->code = date('Ymd-His').rand(10,99);
            $order->date = strtotime('now');
            $order->payment_status = $request->payment_type != 'cash_on_delivery' ? 'paid' : 'unpaid';
            $order->payment_details = $request->payment_type;
            $order->order_from = 'pos';

            if($request->payment_type == 'offline_payment'){
                if($request->offline_trx_id == null){
                    return array('success' => 0, 'message' => translate("Transaction ID can not be null."));
                }
                $data['name']   = $request->offline_payment_method;
                $data['amount'] = $request->offline_payment_amount;
                $data['trx_id'] = $request->offline_trx_id;
                $data['photo']  = $request->offline_payment_proof;
                $order->manual_payment_data = json_encode($data);
                $order->manual_payment = 1;
            }

            if($order->save()){
                $subtotal = 0;
                $tax = 0;
                foreach (Session::get('pos.cart') as $key => $cartItem){
                    $product_stock = ProductStock::find($cartItem['stock_id']);
                    $product = $product_stock->product;
                    $product_variation = $product_stock->variant;

                    $subtotal += $cartItem['price']*$cartItem['quantity'];
                    $tax += $cartItem['tax']*$cartItem['quantity'];

                    if($product->digital == 0){
                        if($cartItem['quantity'] > $product_stock->qty){
                            $order->delete();
                            return array('success' => 0, 'message' => $product->name.' ('.$product_variation.') '.translate(" just stock outs."));
                        }
                        else {
                            $product_stock->qty -= $cartItem['quantity'];
                            $product_stock->save();
                        }
                    }
                    
                    $order_detail = new OrderDetail;
                    $order_detail->order_id  =$order->id;
                    $order_detail->seller_id = $product->user_id;
                    $order_detail->product_id = $product->id;
                    $order_detail->payment_status = $request->payment_type != 'cash_on_delivery' ? 'paid' : 'unpaid';
                    $order_detail->variation = $product_variation;
                    $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                    $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                    $order_detail->quantity = $cartItem['quantity'];
                    $order_detail->shipping_type = null;

                    if (Session::get('pos.shipping', 0) >= 0){
                        $order_detail->shipping_cost = Session::get('pos.shipping', 0)/count(Session::get('pos.cart'));
                    }
                    else {
                        $order_detail->shipping_cost = 0;
                    }

                    $order_detail->save();

                    $product->num_of_sale++;
                    $product->save();
                }

                $order->grand_total = $subtotal + $tax + Session::get('pos.shipping', 0);

                if(Session::has('pos.discount')){
                    $order->grand_total -= Session::get('pos.discount');
                    $order->coupon_discount = Session::get('pos.discount');
                }

                $order->seller_id = $product->user_id;
                $order->save();

                $array['view'] = 'emails.invoice';
                $array['subject'] = 'Your order has been placed - '.$order->code;
                $array['from'] = env('MAIL_USERNAME');
                $array['order'] = $order;

                $admin_products = array();
                $seller_products = array();

                foreach ($order->orderDetails as $key => $orderDetail){
                    if($orderDetail->product->added_by == 'admin'){
                        array_push($admin_products, $orderDetail->product->id);
                    }
                    else{
                        $product_ids = array();
                        if(array_key_exists($orderDetail->product->user_id, $seller_products)){
                            $product_ids = $seller_products[$orderDetail->product->user_id];
                        }
                        array_push($product_ids, $orderDetail->product->id);
                        $seller_products[$orderDetail->product->user_id] = $product_ids;
                    }
                }

                foreach($seller_products as $key => $seller_product){
                    try {
                        Mail::to(User::find($key)->email)->queue(new InvoiceEmailManager($array));
                    } catch (\Exception $e) {

                    }
                }

                //sends email to customer with the invoice pdf attached
                if(env('MAIL_USERNAME') != null){
                    try {
                        Mail::to($request->session()->get('pos.shipping_info')['email'])->queue(new InvoiceEmailManager($array));
                        Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                    } catch (\Exception $e) {

                    }
                }

                if($request->user_id != NULL && $order->payment_status == 'paid') {
                    calculateCommissionAffilationClubPoint($order);
                }

                Session::forget('pos.shipping_info');
                Session::forget('pos.shipping');
                Session::forget('pos.discount');
                Session::forget('pos.cart');
               return array('success' => 1, 'message' => translate('Order Completed Successfully.'));
            }
            else {
                return array('success' => 0, 'message' => translate('Please input customer information.'));
            }
        }
        return array('success' => 0, 'message' => translate("Please select a product."));
    }

    public function configuration()
    {
        return view('seller.pos.pos_activation');
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        if(auth()->user()->id != $order->seller_id) {
            return back();
        }
        $print_width = get_setting('print_width_seller_pos');
        if ($print_width == null) {
            flash(translate('Print Size does not set for thermal printer from POS configuration'))->warning();
            return back();
        }
        
        $pdf_style_data = FontUtility::get_font_family();
        
        $html = view('backend.pos.thermal_invoice', compact('order', 'pdf_style_data'));

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => [$print_width, 1000]]);
        $mpdf->WriteHTML($html);
        // $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->page   = 0;
        $mpdf->state  = 0;
        unset($mpdf->pages[0]);
        // The $p needs to be passed by reference
        $p = 'P';
        // dd($mpdf->y);
        $mpdf->_setPageSize(array($print_width, $mpdf->y), $p);
        
        $mpdf->addPage();
        $mpdf->WriteHTML($html);

        $mpdf->Output('order-' . $order->code . '.pdf', 'I');
    }
}
