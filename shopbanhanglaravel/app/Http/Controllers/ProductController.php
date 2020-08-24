<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    //
    public function AdminAuthCheck()
    {
        # code...
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            # code...
            return Redirect::to('dasboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product()
    {
        # code...
        $this->AdminAuthCheck();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();


        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);

    }
    // hiển thị danh mục sản phẩm
    public function all_product()
    {
        # code...
        // lấy dữ liệu từ db ra
        $this->AdminAuthCheck();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);

    }
    //  thêm thương hiệu sản phẩm
    public function save_product(Request $request)
    {
        # code...
        $this->AdminAuthCheck();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;


        $get_image =$request->file('product_image');

        if ($get_image) {
            # code...
            // lấy tên cảu file ảnh
            $get_name_image = $get_image->getClientOriginalName();
            // phân tách chuỗi qua dấu chấm '.';
            $name_image = current(explode('.',$get_name_image));
            // lấy đuôi mở rộng của ảnh như:png,jpg,...
            $new_image =$name_image.rand(0,99). '.'.$get_image->getClientOriginalExtension();
            // di chuyển ảnh vào thư mục public/upload/product
            $get_image->move ('public/upload/product',$new_image);
            // thêm ảnh vào db
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);

            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('all-product');
        }

        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);

        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id)
    {
        # code...
        $this->AdminAuthCheck();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request,$product_id)
    {
        # code...
        $this->AdminAuthCheck();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;


        $get_image =$request->file('product_image');

        if ($get_image) {
            # code...
            // lấy tên cảu file ảnh
            $get_name_image = $get_image->getClientOriginalName();
            // phân tách chuỗi qua dấu chấm '.';
            $name_image = current(explode('.',$get_name_image));
            // lấy đuôi mở rộng của ảnh như:png,jpg,...
            $new_image =$name_image.rand(0,99). '.'.$get_image->getClientOriginalExtension();
            // di chuyển ảnh vào thư mục public/upload/product
            $get_image->move ('public/upload/product',$new_image);
            // thêm ảnh vào db
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);

            Session::put('message','Cập nhập phẩm thành công');
            return Redirect::to('all-product');
        }

        $data['product_image'] = '';
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','cập nhập sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function delete_product($product_id)
    {
        # code...
        $this->AdminAuthCheck();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    // and Admin pages



    public function details_product(Request $request, $product_id)
    {
        # code...
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();


        foreach($details_product as $key => $value){
            $category_id =$value->category_id;

            $meta_desc = $value->product_desc;
            $meta_keywords = $value->product_content;
            $meta_title= $value->product_name;

            $url_canonical = $request->url();
        }


        // lấy ra tất cả sản phẩm thuộc category_id lấy đc trên foreach
        // whereNotIn('tbl_product.product_id',[$product_id]) để lấy ra sản phẩm liên quan trừ sản phẩm đang xem thông qua product_id
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate',$related_product)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
}
