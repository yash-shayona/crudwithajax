<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product()
    {
        $limit = 5;
        $resp_data['limit'] = $limit;
        $resp_data['page'] = 1;
        $count = Product::all()->where('status', 1);
        $product = Product::with('category')
            ->offset(0)
            ->limit(5)
            ->where('status', 1)
            ->get()
            ->toArray();
        $total = count($count);
        $resp_data['total'] = $total;
        $resp_data['product'] = $product;
        return view("Product.product-list", $resp_data);
    }

    public function add()
    {
        $url = url("/product/store");
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        // dd($category);
        $resp_data['url'] = $url;
        $resp_data['category'] = $category;
        return view("Product.product-add", $resp_data);
    }

    public function store(Request $req)
    {
        $array = $req->all();
        $req->validate([
            "prod_name" => "required",
            "prod_desc" => "required"
        ]);
        unset($array["_token"]);
        $array['status'] = 1;
        $array['created_at'] = date('Y-m-d H:i:s');
        // dd($array);
        $table = Product::insert($array);
        if ($table) {
            return redirect('/product')->with(['success' => 'Record Inserted Successfully']);
        } else {
            return redirect('/product')->with(['error' => 'Record Inserted Failed']);
        }
    }

    public function edit($page, $id)
    {
        $url = url('/product/page/' . $page . '/' . 'update/' . $id);
        $id = decrypt($id);
        $product = Product::where('id', $id)->get()->toArray();
        // dd($product);
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        $resp_data['url'] = $url;
        $resp_data['page'] = $page;
        $resp_data['product'] = $product;
        $resp_data['category'] = $category;
        return view('Product.product-add', $resp_data);
    }
    // public function editajax(Request $req)
    // {
    //     $id = $req->id;
    //     $url = url('/product/update/' . $id);
    //     // $id = decrypt($id);
    //     $product = Product::where('id', $id)->get()->toArray();
    //     // dd($product);
    //     $category = Category::select('category_id', 'category_name')->get()->toArray();
    //     // $resp_data['url'] = $url;
    //     // $resp_data['page'] = $page;
    //     // $resp_data['product'] = $product;
    //     // $resp_data['category'] = $category;
    //     // return view('Product.product-add',['product'=> $product,'category'=> $category,'url'=>$url]);
    //     return response()->json(['url' => $url, 'product' => $product, 'category' => $category]);
    // }

    public function update($page, Request $req, $id)
    {
        $id = decrypt($id);
        $array = $req->all();
        $array['id'] = $id;
        // dd($array);
        unset($array["_token"]);
        $array['updated_at'] = date('Y-m-d H:i:s');
        $table = Product::where('id', $id)->update($array);
        if ($table) {
            return redirect('/product/page/' . $page)->with(['success' => 'Record Updated Successfully']);
        } else {
            return redirect('/product/page/' . $page)->with(['error' => 'Record Updated Failed']);
        }
    }
    public function updateajax(Request $req)
    {
        // $id = decrypt($id);
        // $array = $req->all();
        // $array['id'] = $id;
        // dd($array);
        // unset($array["_token"]);
        // $array['updated_at'] = date('Y-m-d H:i:s');
        // $table = Product::where('id', $id)->update($array);
        // if ($table) {
        // return redirect('/product/page/' . $page)->with(['success' => 'Record Updated Successfully']);
        // } else {
        // return redirect('/product/page/' . $page)->with(['error' => 'Record Updated Failed']);
        // }
        $id = $req->id;
        $url = url('/product/update/' . $id);
        $product = Product::where('id', $id)->get()->toArray();
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        return view('Product.product-editview', ['product' => $product, 'category' => $category, 'url' => $url]);
    }

    public function delete($page, $id)
    {
        $id = decrypt($id);
        $table = Product::where('id', $id)->update(['status' => 0]);
        if ($table) {
            return redirect('/product/page/' . $page)->with(['success' => 'Record Deleted Successfully']);
        } else {
            return redirect('/product/page/' . $page)->with(['error' => 'Record Deleted Failed']);
        }
    }

    public function getdata($page)
    {

        $resp_data['page'] = $page;
        $count = Product::all();
        $limit = 5;
        $offset = ($page - 1) * $limit;
        $product = Product::with('category')
            ->offset($offset)
            ->limit(5)
            ->where('status', 1)
            ->get()
            ->toArray();
        $total = count($count);
        $resp_data['limit'] = $limit;
        $resp_data['product'] = $product;
        $resp_data['total'] = $total;
        $resp_data['total_page'] = ceil($total / $limit);
        return view("Product.product-list", $resp_data);
    }
    public function editview(Request $req)
    {
        // dd($req->all());
        $id = $req->id;
        $url = url('/product/edit/' . $id);
        $product = Product::where('id', $id)->get()->toArray();
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        // return view('Product.product-editview',['product'=> $product,'category'=> $category,'url'=>$url]);
        return response()->json(['url' => $url, 'product' => $product, 'category' => $category]);
    }

    public function updatepost(Request $req)
    {
        // $url= url('/product');
        $id = $req->id;
        $array = $req->all();
        // dd($array);
        unset($array["_token"]);
        $array['updated_at'] = date('Y-m-d H:i:s');
        $table = Product::where('id', $id)->update($array);
        if ($table) {
            return response()->json(['message' => 'Record Updated Successfully']);
        } else {
            return response()->json(['message' => 'Record Updated Failed']);
        }
    }

    public function deleteajax(Request $req)
    {
        $id = $req->id;
        $table = Product::where('id', $id)->update(['status' => 0]);
        if ($table) {
            return response()->json(['message' => 'Record Deleted Successfully']);
        } else {
            return response()->json(['message' => 'Record Deleted Failed']);
        }
    }

    public function productajax()
    {
        return view('Product.product-list-ajax');
    }

    public function getproduct()
    {
        $product = Product::with('category')
            ->where('status', 1)
            ->get()
            ->toArray();
        return response()->json(['product'=>$product]);
    }

    public function addajax(){
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        return view('Product.product-add-ajax',['category'=>$category]);
    }

    public function storeajax(Request $req){
        $array = $req->all();
        unset($array["_token"]);
        $array['status'] = 1;
        $array['created_at'] = date('Y-m-d H:i:s');
        // dd($array);
        $table = Product::insert($array);
        if ($table) {
            return response()->json(['message' => 'Record Inserted Successfully']);
        } else {
            return response()->json(['message' => 'Record Inserted Failed']);
        }
    }

    public function editajax(Request $req)
    {
        $id = $req->id;
        $product = Product::where('id', $id)->get()->toArray();
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        return view('Product.product-update-ajax',['category'=>$category,'product'=>$product,'id'=>$id]);
    }
}
