<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function subcategory()
    {
        return view('SubCategory.sub-category-list');
    }

    public function getsubcategory()
    {
        $subcategory = SubCategory::select('subcategory_id', 'subcategory_name', 'category_id')->with('category')->where('status', 1)->get()->toArray();
        return response()->json($subcategory);
    }

    public function add()
    {
        return view('SubCategory.sub-category-add');
    }

    public function getcategory()
    {
        $category = Category::select('category_id', 'category_name')->where('status', 1)->get()->toArray();
        return response()->json($category);
    }

    public function save(Request $req)
    {
        $array = $req->all();
        unset($array['_token']);
        $array['status'] = 1;
        $array['created_at'] = date('Y-m-d H:i:s');
        $table = SubCategory::insert($array);
        if ($table) {
            return response()->json('Record Inserted Successfully');
        } else {
            return response()->json('Record Inserted Failed');
        }
    }

    public function getcattosubcat(Request $req)
    {
        $id = $req->id;
        $category = Category::select('category_id', 'category_name')->with('subcategory')->where('category_id', $id)->where('status',1)->get();
        // dd($category);
        $html='';
        foreach($category as $c){
            // print_r($c);
            $html.='<option>'.$c->subcategory[0]["subcategory_name"].'</option>';
        }
        return response()->json($html);
    }
}
