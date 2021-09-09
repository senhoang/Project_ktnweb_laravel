<?php

namespace App\Http\Controllers;

use Illuminate\Database\Console\DbCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function AuthLogin() {
        $admin_id = session()->get('admin_id');
        if(is_null($admin_id)) {
            return back()->send();
        }
    }

    // SHOW
    public function all_product() {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->leftJoin('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->leftJoin('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->get();
        return view('admin.all_product')->with('all_product',$all_product);
    }
    
    // Active display or hide
    public function unactive_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=> 0]);
        return Redirect::to('all-product');
    }
    
    public function active_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=> 1]);
        return Redirect::to('all-product');
    }
    
    // CREATE
    public function add_product() {
        $this->AuthLogin();
        $categorys = DB::table('tbl_category_product')->orderBy('category_name', 'asc')->get();
        $brands = DB::table('tbl_brand_product')->orderBy('brand_name', 'asc')->get();
        return view('admin.add_product')->with('categorys',$categorys)->with('brands',$brands);
    }
    
    public function save_product(Request $request) {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        
        $this->validate($request, [
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $name_image = time().'.'.$image->getClientOriginalExtension();
            
            $data['product_image'] = $name_image;
            DB::table('tbl_product')->insert($data);
            $image->move('public/uploads/products', $name_image);

            session()->put('message', 'Thêm sản phẩm thành công !');
            return back();
        }
    }

    // UPDATE - EDIT
    public function edit_product($product_id) {
        $this->AuthLogin();
        $info_products =  DB::table('tbl_product')
        ->leftJoin('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->leftJoin('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->where('tbl_product.product_id', $product_id)
        ->get();

        $categorys = DB::table('tbl_category_product')->orderBy('category_name', 'asc')->get();
        $brands = DB::table('tbl_brand_product')->orderBy('brand_name', 'asc')->get();

        return view('admin.edit_product')->with('info_products',$info_products)->with('categorys',$categorys)->with('brands',$brands);;
    }

    public function update_product(Request $request,$product_id,$product_image) {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        
        if ($request->hasFile('product_image')) {
            $this->validate($request, [
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('product_image');
            $name_image = time().'.'.$image->getClientOriginalExtension();
            
            $data['product_image'] = $name_image;
            $image->move('public/uploads/products', $name_image);
            if(File::exists('public/uploads/products'.$product_image)) {
                File::delete('public/uploads/products'.$product_image);
            }
        }

        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        session()->put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    
    // DELETE
    public function delete_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        return Redirect::to('all-product');
    }
}
