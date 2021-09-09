<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
// use Symfony\Component\HttpFoundation\Session\Session;

session_start();

class AdminController extends Controller
{
    public function AuthLogin() {
        $admin_id = session()->get('admin_id');
        if(is_null($admin_id)) {
            return back()->send();
        }
    }

    public function index () {
        return view('admin_login');
    }
    
    public function show_dashboard () {
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    
    public function dashboard (Request $request) {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)
        ->where('admin_password',$admin_password)
        ->first();
        
        if($result) {
            // Session::put('admin_name',$result->admin_name);
            session()->put('admin_name', $result->admin_name);
            session()->put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        }else{
            $request->session()->put('message_login', 'Mật khẩu hoặc tài khoản không chính xác');
            return Redirect::to('/admin');
        };
        // return view('admin.dashboard');
    }
    
    public function logout () {
        echo 'hello';
    }
}
