<?php

namespace App\Http\Controllers;

use Illuminate\Database\Console\DbCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryProductController extends Controller
{
    public function AuthLogin() {
        $admin_id = session()->get('admin_id');
        if(is_null($admin_id)) {
            return back()->send();
        }
    }
    

    public function add_category_product() {
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    
    public function all_category_product() {
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        // code Hieu tutorials
        // $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        // return view('admin_layout')->with('admin.all_category_product',$manager_category_product);

        // code Senhoangisdadev
        return view('admin.all_category_product')->with('all_category_product',$all_category_product);
    }
    
    public function save_category_product(Request $request) {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        session()->put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    
    // Active display or hide
    public function unactive_category_product($category_product_id) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=> 0]);
        return Redirect::to('all-category-product');
    }
    
    public function active_category_product($category_product_id) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=> 1]);
        return Redirect::to('all-category-product');
    }

    // Edit
    public function edit_category_product($category_product_id) {
        $this->AuthLogin();
        $info_category_products = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        return view('admin.edit_category_product')->with('info_category_products',$info_category_products);
    }

    public function update_category_product(Request $request,$category_product_id) {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        session()->put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    
    public function delete_category_product($category_product_id) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        return Redirect::to('all-category-product');
    }
}
