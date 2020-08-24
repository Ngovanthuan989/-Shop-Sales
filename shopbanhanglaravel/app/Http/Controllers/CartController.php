<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CartController extends Controller
{
    //
    public function save_cart(Request $request)
    {

        # code...
        $productId = $request->productId_hidden;
        $quantiLy = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();



        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantiLy;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);

        return Redirect::to('/show-cart');
    }
    public function show_cart()
    {
        # code...
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();



        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function delete_to_cart($rowId)
    {
        # code...
           Cart::update($rowId,0);
           return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request)
    {
        # code...
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;

        Cart::update($rowId, $qty);

        return Redirect::to('/show-cart');
    }
}
