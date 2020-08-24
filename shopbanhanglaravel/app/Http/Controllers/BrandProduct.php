<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Brand;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
    // kiểm tra xem có tồn tại admin_id không .Nếu không trả về trang admin để đăng nhập
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
    public function add_brand_product()
    {
        # code...
        $this->AdminAuthCheck();
        return view('admin.add_brand_product');
    }
    // hiển thị danh mục sản phẩm
    public function all_brand_product()
    {
        # code...
        // lấy dữ liệu từ db ra
        $this->AdminAuthCheck();
        //  cách 1
        // $all_brand_product = DB::table('tbl_brand')->get();


        // cách 2 dùng model
        // $all_brand_product = Brand::all();
        $all_brand_product = Brand::orderBy('brand_id','DESC')->get();
        // -----------------

        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);

    }
    //  thêm thương hiệu sản phẩm
    public function save_brand_product(Request $request)
    {
        # code...
        $this->AdminAuthCheck();
        // cách làm 1
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // $data['brand_status'] = $request->brand_product_status;


        // DB::table('tbl_brand')->insert($data);

        // cách làm 2 dùng model
        $data = $request->all();
        $brand= new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        // ----------------------
        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id)
    {
        # code...
        $this->AdminAuthCheck();
        // cách 1
        // $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();


        //  cách 2 dùng model
        $edit_brand_product = Brand::find($brand_product_id);
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id)
    {
        # code...
        $this->AdminAuthCheck();
        // cách 1
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);


        // cách làm 2 dùng model
        $data = $request->all();
        $brand= Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        // ----------------------
        Session::put('message','update thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function delete_brand_product($brand_product_id)
    {
        # code...
        $this->AdminAuthCheck();

        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    // end function Admin Page



      // show sản phẩm theo thương hiệu ra trang chủ
      public function show_brand_home($brand_id)
      {
          # code...
          // lấy category và brand từ db theo category_status=1 nghĩa là trạng thái hiển thị
          $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
          $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

          //  lấy brand từ db theo category_id
          $brand_by_id = DB::table ('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->get();


          $brand_name=DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();

          return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
      }

}
