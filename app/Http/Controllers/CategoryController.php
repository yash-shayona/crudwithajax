<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function category()
    {
        $resp_data['title']='Category';
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

    public function ajaxdata(Request $req)
    {
        $page = $req->page;
        if ($page) {
            $limit = 5;
            $offset = ($page - 1) * $limit;
            $html = "<table class='table table-bordered text-center ajax-table'><tr><th>Category No</th><th>Category Name</th><th>Edit</th><th>Delete</th></tr></table>";
            $category = Category::select('category_id', 'category_name')
            ->where('status', 1)
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->toArray();
            if ($category) {
                $i = ($page-1)*$limit+1;
                foreach ($category as $c) {
                    $html .= "<tr><td>" . $i . "</td><td><a href='/category/getprodlist/" . encrypt($c['category_id']) . "'>" . $c['category_name'] . "</a></td><td><a href='/category/edit/" . encrypt($c['category_id']) . "'><button class='btn btn-info'>Edit</button></a></td><td><a href='/category/delete/" . encrypt($c['category_id']) . "'><button class='btn btn-danger'>Delete</button></a></td></tr>";
                    $i++;
                }
            } else {
                $html .= "<tr><td colspan='4'>No Records Found...</td></tr>";
            }
            return response()->json($html);
        }else{
            $html = "<table class='table table-bordered text-center ajax-table'><tr><th>Category No</th><th>Category Name</th><th>Edit</th><th>Delete</th></tr></table>";
            $category = Category::select('category_id', 'category_name')
            ->where('status', 1)
            ->offset(0)
            ->limit(5)
            ->get()
            ->toArray();
            if ($category) {
                $i=1;
                foreach ($category as $c) {
                    $html .= "<tr><td>" . $i . "</td><td><a href='/category/getprodlist/" . encrypt($c['category_id']) . "'>" . $c['category_name'] . "</a></td><td><a href='/category/edit/" . encrypt($c['category_id']) . "'><button class='btn btn-info'>Edit</button></a></td><td><a href='/category/delete/" . encrypt($c['category_id']) . "'><button class='btn btn-danger'>Delete</button></a></td></tr>";
                    $i++;
                }
            } else {
                $html .= "<tr><td colspan='4'>No Records Found...</td></tr>";
            }
            return response()->json($html);
        }

    }

    public function pagination(Request $req)
    {
        $html = "";
        if ($req->page) {
            $page = $req->page;
            $total_records = count(Category::select('category_id', 'category_name')
                ->where('status', 1)
                ->get()
                ->toArray());
            $limit = 5;
            $active = "btn btn-secondary";
            $total_page = ceil($total_records / $limit);
            if ($page >= 2) {
                $html .= "<button class='btn btn-warning pgbtn' id='" . ($page - 1) . "'>Prev</button>";
            }
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page) {
                    $html .= "<button class='" . $active . " pgbtn' id='" . $i . "' style='margin-left:10px;'>" . $i . "</button>";
                } else {
                    $html .= "<button class='btn btn-warning pgbtn' id='" . $i . "' style='margin-left:10px;'>" . $i . "</button>";
                }
            }
            if ($page < $total_page) {
                $html .= "<button class='btn btn-warning pgbtn' id='" . ($page + 1) . "' style='margin-left:10px;'>Next</button>";
            }
        } else {
            $total_records = count(Category::select('category_id', 'category_name')
                ->where('status', 1)
                ->get()
                ->toArray());

            $limit = 5;
            $page = 1;
            $total_page = ceil($total_records / $limit);

            if ($page >= 2) {
                $html .= "<button class='btn btn-warning pgbtn' id='" . ($page - 1) . "'>Prev</button>";
            }
            for ($i = 1; $i <= $total_page; $i++) {
                $html .= "<button class='btn btn-warning pgbtn' id='" . $i . "' style='margin-left:10px;'>" . $i . "</button>";
            }
            if ($page < $total_page) {
                $html .= "<button class='btn btn-warning pgbtn' id='" . ($page + 1) . "' style='margin-left:10px;'>Next</button>";
            }
        }
        return response()->json($html);
    }
}
