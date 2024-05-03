<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TestController;
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

// Route::get('/', function () {
//     return redirect("/product");
// });
// Route::redirect('/','/product');
// Route::get('/product',[ProductController::class,'product']);
// Route::post('/product/sortproduct',[ProductController::class,'product']);
// Route::post('/product/search/{search?}/sortproduct',[ProductController::class,'product']);
// Route::get('/product/add',[ProductController::class,'add']);
// Route::post('/product/store',[ProductController::class,'store']);
// Route::get('/product/page/{page?}/edit/{id}',[ProductController::class,'edit']);
// Route::post('/product/page/{page?}/update/{id}',[ProductController::class,'update']);
// Route::get('/product/page/{page?}/delete/{id}',[ProductController::class,'delete']);
// Route::get('/product/page',function(){
//     return redirect('/product');
// });
// Route::get('/product/page/{page?}',[ProductController::class,'getdata']);
// Route::get('/product/search/{search?}/page/{page?}',[ProductController::class,'getdata']);
// Route::get('/product/sortproduct/{column_name?}/{sort_type?}/page/{page?}',[ProductController::class,'getdata']);
// Route::get('/product/sortproduct/{column_name?}/{sort_type?}/search/{search?}/page/{page?}',[ProductController::class,'getdata']);



Route::get('/product',[ProductController::class,'productajax']);
Route::get('/product/add',[ProductController::class,'addajax']);
Route::get('/getproduct',[ProductController::class,'getproduct']);
// Route::get('/product/edit',[ProductController::class,'editajax']);
Route::post('/product/store',[ProductController::class,'storeajax']);
// Route::get('/product/edit/{id}',[ProductController::class,'editajax']);
Route::get('/product/page/{page}/edit/{id}',[ProductController::class,'editajax']);
// Route::get('/product/update/{id}',[ProductController::class,'updateajax']);
Route::post('/product/update/{id}',[ProductController::class,'updatepost']);
// Route::post('/product/update',[ProductController::class,'updateajax']);
// Route::get('/product/delete/{id}',[ProductController::class,'deleteajax']);
Route::get('/product/page/{page}/delete/{id}',[ProductController::class,'deleteajax']);
Route::get('/pagination',[ProductController::class,'pagination']);
Route::get('/product/bulkdelete',[ProductController::class,'bulkdelete']);


Route::get('/category',[CategoryController::class,'category']);
Route::get('/category/add',[CategoryController::class,'add']);
Route::post('/category/store',[CategoryController::class,'store']);
Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
Route::post('/category/update/{id}',[CategoryController::class,'update']);
Route::get('/category/delete/{id}',[CategoryController::class,'delete']);
Route::get('/category/getprodlist/{id}',[CategoryController::class,'getprodlist']);
Route::get('/ajaxdata',[CategoryController::class,'ajaxdata']);
Route::get('/catpagination',[CategoryController::class,'pagination']);

Route::get('/subcategory',[SubcategoryController::class,'subcategory']);
Route::get('/getsubcategory',[SubcategoryController::class,'getsubcategory']);
Route::get('/subcategory/add',[SubcategoryController::class,'add']);
Route::get('/getcategory',[SubcategoryController::class,'getcategory']);
Route::post('/subcategory/save',[SubcategoryController::class,'save']);
Route::get('/getcattosubcat',[SubcategoryController::class,'getcattosubcat']);
Route::get('/subcategory/edit/{id}',[SubcategoryController::class,'edit']);
Route::post('/subcategory/update/{id}',[SubcategoryController::class,'update']);
Route::get('/subcategory/delete/{id}',[SubcategoryController::class,'delete']);
Route::get('/subcatpagination',[SubcategoryController::class,'pagination']);

Route::get('/prodtocat',[TestController::class,'prodtocat']);
Route::get('/foreach',[TestController::class,'foreach']);
Route::get('/js',[TestController::class,'js']);
Route::get('/sandwichleavearr',[TestController::class,'sandleavearr']);
Route::get('/form',[TestController::class,'form']);
Route::post('/form',[TestController::class,'save']);