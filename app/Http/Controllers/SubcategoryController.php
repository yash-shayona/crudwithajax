<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
        $html = '';
        $subcategory = SubCategory::select('subcategory_id', 'subcategory_name', 'category_id')->with('category')->where('status', 1)->get()->toArray();
        if ($subcategory) {
            $i = 1;
            foreach ($subcategory as $key => $value) {
                foreach ($value['category'] as $k => $v) {
                    $html .= "<tr><td>" . $i . "</td><td>" . $value['subcategory_name'] . "</td><td>" . $v['category_name'] . "</td><td><a href=" . url('/subcategory/edit') . '/' . $value['subcategory_id'] . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/subcategory/delete') . '/' . $value['subcategory_id'] . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                }
                $i++;
            }
        } else {
            $html .= "<tr><td colspan='5'>No Records Found...</td></tr>";
        }
        return response()->json($html);
    }

    // public function add()
    // {
    //     return view('SubCategory.subcategory-add-ajax');
    // }
    public function add()
    {
        $url = url('/subcategory/save');
        $resp_data['url'] = $url;
        return view('SubCategory.subcategory-add', $resp_data);
    }

    public function getcategory(Request $req)
    {
        $id = $req->id;
        $category = Category::select('category_id', 'category_name')->where('status', 1)->get()->toArray();
        $subcategory = SubCategory::select('subcategory_id', 'subcategory_name', 'category_id')->where('subcategory_id', $id)->where('status', 1)->get()->toArray();

        foreach ($category as $key => $value) {
            if (isset($id)) {
                $selected = "selected";
            } else {
                $selected = "";
            }
        }

        $html = '<option value="">Select</option>';

        foreach ($category as $key => $value) {
            if (isset($id)) {
                if ($value['category_id'] == $subcategory[0]['category_id']) {
                    $html .= "<option value=" . $value['category_id'] . " " . $selected . ">" . $value['category_name'] . "</option>";
                } else {
                    $html .= "<option value=" . $value['category_id'] . ">" . $value['category_name'] . "</option>";
                }
            } else {
                $html .= "<option value=" . $value['category_id'] . ">" . $value['category_name'] . "</option>";
            }
        }

        return response()->json($html);
    }

    public function save(Request $req)
    {
        $array = $req->all();
        unset($array['_token']);
        $array['status'] = 1;
        $array['created_at'] = date('Y-m-d H:i:s');
        $table = SubCategory::insert($array);
        if ($table) {
            // return response()->json('Record Inserted Successfully');
            return redirect('/subcategory')->with('success','Record Inserted Successfully');
        } else {
            // return response()->json('Record Inserted Failed');
            return redirect('/subcategory')->with('error','Record Inserted Failed');
        }
    }

    public function getcattosubcat(Request $req)
    {
        $id = $req->id;
        $prodid = $req->prodid;
        $category = Category::select('category_id', 'category_name')->with('subcategory')->where('category_id', $id)->where('status', 1)->get()->toArray();
        $product = Product::select('subcategory_id')->where('id', $prodid)->get()->toArray();
        $selected = "";
        if (isset($prodid)) {
            for ($i = 0; $i < count($category[0]['subcategory']); $i++) {
                if ($product[0]['subcategory_id'] == $category[0]['subcategory'][$i]['subcategory_id']) {
                    $selected = "selected";
                } else {
                    echo "";
                }
            }
        }
        $html = '';

        for ($i = 0; $i < count($category[0]['subcategory']); $i++) {
            if (isset($prodid)) {
                if ($product[0]['subcategory_id'] == $category[0]['subcategory'][$i]['subcategory_id']) {
                    $html .= "<option value=" . $category[0]['subcategory'][$i]['subcategory_id'] . " " . $selected . " >" . $category[0]['subcategory'][$i]['subcategory_name'] . "</option>";
                } else {
                    $html .= "<option value=" . $category[0]['subcategory'][$i]['subcategory_id'] . ">" . $category[0]['subcategory'][$i]['subcategory_name'] . "</option>";
                }
            } else {
                $html .= "<option value=" . $category[0]['subcategory'][$i]['subcategory_id'] . ">" . $category[0]['subcategory'][$i]['subcategory_name'] . "</option>";
            }
        }

        // foreach($category as $c){
        //     // print_r($c);
        //     foreach($c as $sc){
        //         print_r($sc);
        //         // $html.='<option>'.$sc.'</option>';
        //     }
        // }
        return response()->json($html);
    }

    public function prodtocat()
    {
        $prod = Product::with('category')->get()->toArray();
        echo "<pre>";
        print_r($prod);
    }

    public function edit($id)
    {
        $table = SubCategory::with('category')->where("subcategory_id", $id)->where('status', 1)->get()->toArray();
        $url = url("/subcategory/update") . '/' . $id;
        $resp_data['url'] = $url;
        $resp_data['subcategory'] = $table;
        return view('SubCategory.subcategory-add', $resp_data);
    }

    public function update(Request $req,$id){
        $array=$req->all();
        unset($array['_token']);
        // $array['updated_at']=date('Y-m-d H:i:s');
        $table=SubCategory::where('subcategory_id',$id)->update($array);
        if($table){
            return redirect('/subcategory')->with('success','Record Updated Successfully');
        }
        else{
            return redirect('/subcategory')->with('error','Record Update Failed');
        }
    }

    public function delete($id){
        $table=SubCategory::where('subcategory_id',$id)->update(['status'=>0]);
        if($table){
            return redirect('/subcategory')->with('success','Record Deleted Successfully');
        }
        else{
            return redirect('/subcategory')->with('error','Record Deleted Failed');
        }
    }
}
