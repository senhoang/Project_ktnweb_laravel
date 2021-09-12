<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\CategoryProductController;
use \App\Http\Controllers\BrandProductController;
use \App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);


// Backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

// Category Product
// SHOW Category Product
Route::get('/all-category-product', [CategoryProductController::class, 'all_category_product']);
// Active Category Product
Route::get('/unactive-category-product/{category_product_id}', [CategoryProductController::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProductController::class, 'active_category_product']);
// ADD Category Product
Route::get('/add-category-product', [CategoryProductController::class, 'add_category_product']);
Route::post('/save-category-product', [CategoryProductController::class, 'save_category_product']);
// EDIT Category Product
Route::get('/edit-category-product/{category_product_id}', [CategoryProductController::class, 'edit_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProductController::class, 'update_category_product']);
// DELETE Category Product
Route::get('/delete-category-product/{category_product_id}', [CategoryProductController::class, 'delete_category_product']);


// Brand Product
// SHOW Brand Product
Route::get('/all-brand-product', [BrandProductController::class, 'all_brand_product']);
// Active Brand Product
Route::get('/unactive-brand-product/{brand_product_id}', [BrandProductController::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProductController::class, 'active_brand_product']);
// ADD Brand Product
Route::get('/add-brand-product', [BrandProductController::class, 'add_brand_product']);
Route::post('/save-brand-product', [BrandProductController::class, 'save_brand_product']);
// EDIT Brand Product
Route::get('/edit-brand-product/{brand_product_id}', [BrandProductController::class, 'edit_brand_product']);
Route::post('/update-brand-product/{brand_product_id}', [BrandProductController::class, 'update_brand_product']);
// DELETE Brand Product
Route::get('/delete-brand-product/{brand_product_id}', [BrandProductController::class, 'delete_brand_product']);


//  Product
// SHOW  Product
Route::get('/all-product', [ProductController::class, 'all_product']);
// Active  Product
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);
// ADD  Product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);
// EDIT  Product
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::post('/update-product/{product_id}/{product_image}', [ProductController::class, 'update_product']);
// DELETE  Product
Route::get('/delete-product/{product_id}/{product_image}', [ProductController::class, 'delete_product']);