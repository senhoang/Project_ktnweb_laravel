<?php

namespace App\Http\Controllers;

use Illuminate\Database\Console\DbCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BrandProductController extends Controller
{
    public function AuthLogin() {
        $admin_id = session()->get('admin_id');
        if(is_null($admin_id)) {
            return back()->send();
        }
    }
    

    public function all_brand_product() {
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand_product')->get();
        // code Hieu tutorials
        // $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        // return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
        
        // code Senhoangisdadev
        return view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    }
    
    public function add_brand_product() {
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    
    public function save_brand_product(Request $request) {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('tbl_brand_product')->insert($data);
        session()->put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }
    
    // Active display or hide
    public function unactive_brand_product($brand_product_id) {
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=> 0]);
        return Redirect::to('all-brand-product');
    }
    
    public function active_brand_product($brand_product_id) {
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=> 1]);
        return Redirect::to('all-brand-product');
    }

    // Edit
    public function edit_brand_product($brand_product_id) {
        $this->AuthLogin();
        $info_brand_products = DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->get();
        return view('admin.edit_brand_product')->with('info_brand_products',$info_brand_products);
    }

    public function update_brand_product(Request $request,$brand_product_id) {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update($data);
        session()->put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    
    public function delete_brand_product($brand_product_id) {
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->delete();
        return Redirect::to('all-brand-product');
    }
}
