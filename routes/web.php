<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect("/product");
});

Route::get('/product',[ProductController::class,'product']);
Route::get('/product/add',[ProductController::class,'add']);
Route::post('/product/store',[ProductController::class,'store']);
// Route::get('/product/edit',[ProductController::class,'editajax']);
Route::get('/product/edit/{id}',[ProductController::class,'editajax']);
Route::get('/product/update/{id}',[ProductController::class,'updateajax']);
Route::post('/product/update/{id}',[ProductController::class,'updatepost']);
Route::get('/product/page/{page?}/edit/{id}',[ProductController::class,'edit']);
// Route::post('/product/update',[ProductController::class,'updateajax']);
Route::post('/product/page/{page?}/update/{id}',[ProductController::class,'update']);
Route::get('/product/page/{page?}/delete/{id}',[ProductController::class,'delete']);
Route::get('/product/delete/{id}',[ProductController::class,'deleteajax']);
Route::get('/product/page',function(){
    return redirect('/product');
});
Route::get('/product/page/{page?}',[ProductController::class,'getdata']);


Route::get('/category',[CategoryController::class,'category']);
Route::get('/category/add',[CategoryController::class,'add']);
Route::post('/category/store',[CategoryController::class,'store']);
Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
Route::post('/category/update/{id}',[CategoryController::class,'update']);
Route::get('/category/delete/{id}',[CategoryController::class,'delete']);
Route::get('/category/getprodlist/{id}',[CategoryController::class,'getprodlist']);
