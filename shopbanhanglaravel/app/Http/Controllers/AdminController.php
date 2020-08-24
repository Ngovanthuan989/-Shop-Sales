<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// database
use DB;
use App\Login;
use App\Social;
use Socialite;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{

//    login facebook

    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);

            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',


                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('admin_id',$account->user)->first();

            Session::put('admin_name',$account_name->admin_name);
             Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }
    }





    //kiểm tra xem có tồn tại admin_id hay không nếu không trả về trang admim để đăng nhập
    public function AuthLogin()
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
    public function index()
    {
        # code...

        return view('admin_login');
    }
    public function show_dashboard()
    {
        # code...
        $this->AuthLogin();
        return view('admin.dasboard');
    }

    // đăng nhập trả về trang dasboard
    public function dashboard(Request $request)
    {
        # code...

        // cách 1
    //      $admin_email = $request->admin_email;
    //      $admin_password = md5($request->admin_password);

    //      $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();


    //    if ($result ) {
    //        # code...
    //        Session::put('admin_name',$result->admin_name);
    //        Session::put('admin_id',$result->admin_id);
    //        return Redirect::to('/dashboard');
    //    }else{
    //         Session::put('message','Tài Khoản Hoặc Mật Khẩu Sai!');
    //         return Redirect::to('/admin');
    //    }


    // cách 2 dùng model

       $data = $request->all();
       $admin_email = $data['admin_email'];
       $admin_password = md5($data['admin_password']);
       $login =Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        //   $login_count = $login->count();
       if ($login) {
           # code...
           Session::put('admin_name',$login->admin_name);
           Session::put('admin_id',$login->admin_id);
           return Redirect::to('/dashboard');
        }else{
                 Session::put('message','Tài Khoản Hoặc Mật Khẩu Sai!');
                return Redirect::to('/admin');
         }
    }
    //  đăng xuất
    public function logout()
    {
        # code...
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');

        }
}
