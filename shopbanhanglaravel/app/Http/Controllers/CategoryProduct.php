<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
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
    public function add_category_product()
    {
        # code...
        $this->AdminAuthCheck();
        return view('admin.add_category_product');
    }
    // hiển thị danh mục sản phẩm
    public function all_category_product()
    {
        # code...
        // lấy dữ liệu từ db ra
        $this->AdminAuthCheck();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);

    }
    //  thêm danh mục sản phẩm
    public function save_category_product(Request $request)
    {
        # code...
        $this->AdminAuthCheck();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        DB::table('tbl_category_product')->insert($data);

        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id)
    {
        # code...
        $this->AdminAuthCheck();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id)
    {
        # code...
        $this->AdminAuthCheck();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','update danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function delete_category_product($category_product_id)
    {
        # code...
        $this->AdminAuthCheck();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }


    // end function Admin Page

    // show sản phẩm theo danh mục ra trang chủ
    public function show_category_home(Request $request, $category_id)
    {
        # code...


        // lấy category và brand từ db theo category_status=1 nghĩa là trạng thái hiển thị
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        //  lấy category từ db theo category_id
        $category_by_id = DB::table ('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();

         foreach ($category_by_id as $key => $val) {
             # code...
               // seo
                $meta_desc = $val->category_desc;
                $meta_keywords = $val->meta_keywords;
                $meta_title= $val->category_name;

                $url_canonical = $request->url();
                // ---

         }
        $category_name=DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_name',$category_name);
    }

}
