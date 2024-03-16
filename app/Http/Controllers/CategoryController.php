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

    public function ajaxdata()
    {
        $html = "<table class='table table-bordered text-center ajax-table'><tr><th>Category No</th><th>Category Name</th><th>Edit</th><th>Delete</th></tr></table>";
        $category = Category::select('category_id', 'category_name')->where('status', 1)->get()->toArray();
        if ($category) {
            $i = 1;
            foreach ($category as $c) {
                $html .= "<tr><td>" . $i . "</td><td><a href='/category/getprodlist/".encrypt($c['category_id'])."'>" . $c['category_name'] . "</a></td><td><a href='/category/edit/" . encrypt($c['category_id']) . "'><button class='btn btn-info'>Edit</button></a></td><td><a href='/category/delete/" . encrypt($c['category_id']) . "'><button class='btn btn-danger'>Delete</button></a></td></tr>";
                $i++;
            }
        }
        return response()->json($html);
    }
}
