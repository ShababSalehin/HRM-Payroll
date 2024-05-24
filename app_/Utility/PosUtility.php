<?php

namespace App\Utility;

use App\Models\ProductStock;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class PosUtility
{
    public static function product_search($request_data): object
    {
        $product_query = ProductStock::query()->join('products', 'product_stocks.product_id', '=', 'products.id');

        if (auth()->user()->user_type == 'seller') {
            $product_query->where('products.user_id', auth()->user()->id);
        } else {
            $product_query->where('products.added_by', 'admin');
        }
        $products = $product_query->where('products.auction_product', 0)
            ->where('products.wholesale_product', 0)
            ->where('products.published', 1)
            ->where('products.approved', 1)
            ->select('products.*', 'product_stocks.id as stock_id', 'product_stocks.variant', 'product_stocks.price as stock_price', 'product_stocks.qty as stock_qty', 'product_stocks.image as stock_image')
            ->orderBy('products.created_at', 'desc');

        if ($request_data['category'] != null) {
            $arr = explode('-', $request_data['category']);
            if ($arr[0] == 'category') {
                $category_ids = CategoryUtility::children_ids($arr[1]);
                $category_ids[] = $arr[1];
                $products = $products->whereIn('products.category_id', $category_ids);
            }
        }

        if ($request_data['brand'] != null) {
            $products = $products->where('products.brand_id', $request_data['brand']);
        }

        if ($request_data['keyword'] != null) {
            $products = $products->where('products.name', 'like', '%' . $request_data['keyword'] . '%')->orWhere('products.barcode', $request_data['keyword']);
        }

        return $products->paginate(16);
    }

    public static function get_shipping_address($request) : array {
        if ($request->address_id != null) {
            $address = Address::findOrFail($request->address_id);
            $data['name'] = $address->user->name;
            $data['email'] = $address->user->email;
            $data['address'] = $address->address;
            $data['country'] = $address->country->name;
            $data['state'] = $address->state->name;
            $data['city'] = $address->city->name;
            $data['postal_code'] = $address->postal_code;
            $data['phone'] = $address->phone;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['country'] = Country::find($request->country_id)->name;
            $data['state'] = State::find($request->state_id)->name;
            $data['city'] = City::find($request->city_id)->name;
            $data['postal_code'] = $request->postal_code;
            $data['phone'] = $request->phone;
        }

        return $data;
    }
}
