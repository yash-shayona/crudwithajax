<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function category()
    {
        $category = Category::where('status', 1)->get()->toArray();
        $resp_data['category'] = $category;
        return view("Category.category-list", $resp_data);
    }

    public function add()
    {
        $url = url('/category/store');
        $resp_data['url'] = $url;
        return view("Category.category-add", $resp_data);
    }

    public function store(Request $req)
    {
        $array = $req->all();
        $req->validate([
            "category_name" => "required",
        ]);
        unset($array["_token"]);
        $array['status'] = 1;
        $array['created_at'] = date('Y-m-d H:i:s');
        $table = Category::insert($array);
        if ($table) {
            return redirect('/category')->with(['success' => 'record inserted successfully']);
        } else {
            return redirect('/category')->with(['error' => 'record inserted failed']);
        }
    }

    public function getprodlist($id)
    {
        $table = Category::with('product')->where('category_id', decrypt($id))->get()->toArray();
        $resp_data['prodlist'] = $table;
        return view('Category.category-product-list', $resp_data);
    }

    public function edit($id)
    {
        $url = url('/category/update/' . $id);
        $id = decrypt($id);
        $category = Category::where('category_id', $id)->get()->toArray();
        $resp_data['url'] = $url;
        $resp_data['category'] = $category;
        return view("Category.category-add", $resp_data);
    }
    public function update(Request $req, $id)
    {
        $id = decrypt($id);
        $array = $req->all();
        $array['category_id'] = $id;
        unset($array["_token"]);
        $array['updated_at'] = date('Y-m-d H:i:s');
        $table = Category::where('category_id', $id)->update($array);
        if ($table) {
            return redirect('/category')->with(['success' => 'record updated successfully']);
        } else {
            return redirect('/category')->with(['error' => 'record updated failed']);
        }
    }

    public function delete($id)
    {
        $id = decrypt($id);
        $table = Category::where('category_id', $id)->update(['status' => 0]);
        if ($table) {
            return redirect('/category')->with(['success' => 'Record Deleted Successfully']);
        } else {
            return redirect('/category')->with(['error' => 'Record Deleted Failed']);
        }
    }
}
