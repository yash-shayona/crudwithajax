<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(Request $req)
    {
        $search = $req->search;
        $column_name = $req->column_name;
        $sort_type = $req->sort_type;
        if ($search) {
            if ($column_name && $sort_type) {
                $resp_data = [];
                $resp_data['i'] = 1;
                $limit = 5;
                $resp_data['limit'] = $limit;
                $resp_data['page'] = 1;
                $resp_data['search'] = $search;
                $resp_data['column_name'] = $column_name;
                $resp_data['sort_type'] = $sort_type;
                $resp_data['url'] = url('/product/search/' . $search . '/sortproduct');
                $count = Product::where('status', 1)->where('prod_name', 'LIKE', "%$search%")->orWhere('prod_desc', 'LIKE', "%$search%")->orderBy($column_name, $sort_type)->get();
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->offset(0)
                    ->limit(5)
                    ->where('status', 1)
                    ->where('prod_name', 'LIKE', "%$search%")
                    ->orWhere('prod_desc', 'LIKE', "%$search%")
                    ->orderBy($column_name, $sort_type)
                    ->get()
                    ->toArray();
                $total = count($count);
                $resp_data['total'] = $total;
                $resp_data['product'] = $product;
                $resp_data['active'] = 'btn btn-warning';
                return view("Product.product-list", $resp_data);
            } else {
                $resp_data = [];
                $resp_data['i'] = 1;
                $limit = 5;
                $resp_data['limit'] = $limit;
                $resp_data['page'] = 1;
                $resp_data['search'] = $search;
                $resp_data['url'] = url('/product/search/' . $search . '/sortproduct');
                $count = Product::where('status', 1)->where('prod_name', 'LIKE', "%$search%")->orWhere('prod_desc', 'LIKE', "%$search%")->get();
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->offset(0)
                    ->limit(5)
                    ->where('status', 1)
                    ->where('prod_name', 'LIKE', "%$search%")
                    ->orWhere('prod_desc', 'LIKE', "%$search%")
                    ->get()
                    ->toArray();
                $total = count($count);
                $resp_data['total'] = $total;
                $resp_data['product'] = $product;
                $resp_data['column_name'] = $column_name;
                $resp_data['sort_type'] = $sort_type;
                $resp_data['active'] = 'btn btn-warning';
                return view("Product.product-list", $resp_data);
            }
        } else {
            if ($column_name && $sort_type) {
                $resp_data = [];
                $resp_data['i'] = 1;
                $limit = 5;
                $resp_data['limit'] = $limit;
                $resp_data['page'] = 1;
                $resp_data['search'] = '';
                $resp_data['column_name'] = $column_name;
                $resp_data['sort_type'] = $sort_type;
                $resp_data['url'] = url('/product/sortproduct');
                $count = Product::where('status', 1)->orderBy($column_name, $sort_type)->get();
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->offset(0)
                    ->limit(5)
                    ->where('status', 1)
                    ->orderBy($column_name, $sort_type)
                    ->get()
                    ->toArray();
                $total = count($count);
                $resp_data['total'] = $total;
                $resp_data['product'] = $product;
                $resp_data['active'] = 'btn btn-warning';
                return view("Product.product-list", $resp_data);
            } else {
                $resp_data = [];
                $resp_data['i'] = 1;
                $limit = 5;
                $resp_data['limit'] = $limit;
                $resp_data['page'] = 1;
                $resp_data['search'] = '';
                $resp_data['column_name'] = $column_name;
                $resp_data['sort_type'] = $sort_type;
                $resp_data['url'] = url('/product/sortproduct');
                $count = Product::all()->where('status', 1);
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->offset(0)
                    ->limit(5)
                    ->where('status', 1)
                    ->get()
                    ->toArray();
                $total = count($count);
                $resp_data['total'] = $total;
                $resp_data['product'] = $product;
                $resp_data['active'] = 'btn btn-warning';
                return view("Product.product-list", $resp_data);
            }
        }
    }

    public function add()
    {
        $url = url("/product/store");
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        $subcategory = SubCategory::select('subcategory_id', 'subcategory_name')->get()->toArray();
        $resp_data['url'] = $url;
        $resp_data['subcategory'] = $subcategory;
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
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        $subcategory = SubCategory::select('subcategory_id', 'subcategory_name')->get()->toArray();
        $resp_data['url'] = $url;
        $resp_data['page'] = $page;
        $resp_data['product'] = $product;
        $resp_data['category'] = $category;
        $resp_data['subcategory'] = $subcategory;
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

    public function getdata(Request $req)
    {
        $search = $req->search;
        $page = $req->page;
        $column_name = $req->column_name;
        $sort_type = $req->sort_type;
        if ($search) {
            if ($column_name && $sort_type) {
                $resp_data['page'] = $page;
                $resp_data['search'] = $search;
                $count = Product::where('status', 1)->where('prod_name', 'LIKE', "%$search%")->orWhere('prod_desc', 'LIKE', "%$search%")->orderBy(decrypt($column_name),decrypt($sort_type))->get();
                $limit = 5;
                $offset = ($page - 1) * $limit;
                $i = ($page - 1) * $limit + 1;
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->offset($offset)
                    ->limit(5)
                    ->where('status', 1)
                    ->where('prod_name', 'LIKE', "%$search%")
                    ->orWhere('prod_desc', 'LIKE', "%$search%")
                    ->orderBy(decrypt($column_name),decrypt($sort_type))
                    ->get()
                    ->toArray();
                $total = count($count);
                $resp_data['i'] = $i;
                $resp_data['limit'] = $limit;
                $resp_data['product'] = $product;
                $resp_data['total'] = $total;
                $resp_data['active'] = 'btn btn-secondary';
                $resp_data['column_name'] = decrypt($column_name);
                $resp_data['sort_type'] = decrypt($sort_type);
                $resp_data['url'] = url('/product/search/' . $search . '/sortproduct');
                $resp_data['total_page'] = ceil($total / $limit);
                return view("Product.product-list", $resp_data);
            }
            else{
                $resp_data['page'] = $page;
                $resp_data['search'] = $search;
                $count = Product::where('status', 1)->where('prod_name', 'LIKE', "%$search%")->orWhere('prod_desc', 'LIKE', "%$search%")->get();
                $limit = 5;
                $offset = ($page - 1) * $limit;
                $i = ($page - 1) * $limit + 1;
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->offset($offset)
                    ->limit(5)
                    ->where('status', 1)
                    ->where('prod_name', 'LIKE', "%$search%")
                    ->orWhere('prod_desc', 'LIKE', "%$search%")
                    ->get()
                    ->toArray();
                $total = count($count);
                $resp_data['i'] = $i;
                $resp_data['limit'] = $limit;
                $resp_data['product'] = $product;
                $resp_data['total'] = $total;
                $resp_data['active'] = 'btn btn-secondary';
                $resp_data['url'] = url('/product/search/' . $search . '/sortproduct');
                $resp_data['column_name'] = $column_name;
                $resp_data['sort_type'] = $sort_type;
                $resp_data['total_page'] = ceil($total / $limit);
                return view("Product.product-list", $resp_data);
            }
        } else {
            if($column_name && $sort_type){
                $resp_data['page'] = $page;
                $resp_data['search'] = $search;
                $resp_data['url'] = url('/product/sortproduct/page/' . $page);
                $count = Product::where('status', 1)->orderBy(decrypt($column_name),decrypt($sort_type))->get();
                $limit = 5;
                $offset = ($page - 1) * $limit;
                $i = ($page - 1) * $limit + 1;
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->offset($offset)
                    ->limit(5)
                    ->where('status', 1)
                    ->orderBy(decrypt($column_name),decrypt($sort_type))
                    ->get()
                    ->toArray();
                $total = count($count);
                $resp_data['i'] = $i;
                $resp_data['limit'] = $limit;
                $resp_data['product'] = $product;
                $resp_data['total'] = $total;
                $resp_data['column_name'] = decrypt($column_name);
                $resp_data['sort_type'] = decrypt($sort_type);
                $resp_data['active'] = 'btn btn-secondary';
                $resp_data['total_page'] = ceil($total / $limit);
                return view("Product.product-list", $resp_data);
            }
            else{
                $resp_data['page'] = $page;
                $resp_data['search'] = $search;
                $resp_data['url'] = url('/product/sortproduct');
                $count = Product::all()->where('status', 1);
                $limit = 5;
                $offset = ($page - 1) * $limit;
                $i = ($page - 1) * $limit + 1;
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->offset($offset)
                    ->limit(5)
                    ->where('status', 1)
                    ->get()
                    ->toArray();
                $total = count($count);
                $resp_data['i'] = $i;
                $resp_data['limit'] = $limit;
                $resp_data['product'] = $product;
                $resp_data['total'] = $total;
                $resp_data['column_name'] = $column_name;
                $resp_data['sort_type'] = $sort_type;
                $resp_data['active'] = 'btn btn-secondary';
                $resp_data['total_page'] = ceil($total / $limit);
                return view("Product.product-list", $resp_data);
            }
        }
    }
    public function editview(Request $req)
    {
        $id = $req->id;
        $url = url('/product/edit/' . $id);
        $product = Product::where('id', $id)->get()->toArray();
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        // return view('Product.product-editview',['product'=> $product,'category'=> $category,'url'=>$url]);
        return response()->json(['url' => $url, 'product' => $product, 'category' => $category]);
    }

    public function updatepost(Request $req)
    {
        $id = $req->id;
        $page = $req->page;
        $array = $req->all();
        $prodid = $array['id'];
        $array['id'] = decrypt($prodid);
        unset($array["_token"]);
        unset($array["page"]);
        $array['updated_at'] = date('Y-m-d H:i:s');
        $table = Product::where('id', decrypt($id))->update($array);
        if ($table) {
            return redirect('/product')->with(['page' => $page, 'success' => 'Record Updated Successfully']);
            // return response()->json(['message' => 'Record Updated Successfully']);
        } else {
            return redirect('/product')->with(['page' => $page, 'error' => 'Record Updated Failed']);
            // return response()->json(['message' => 'Record Updated Failed']);
        }
    }

    public function deleteajax(Request $req)
    {
        $id = $req->id;
        $page = $req->page;
        $table = Product::where('id', decrypt($id))->update(['status' => 0]);
        if ($table) {
            // return response()->json(['message' => 'Record Deleted Successfully']);
            return redirect('/product')->with(['page' => $page, 'success' => 'Record Deleted Successfully']);
        } else {
            // return response()->json(['message' => 'Record Deleted Failed']);
            return redirect('/product')->with(['page' => $page, 'error' => 'Record Deleted Failed']);
        }
    }

    public function productajax()
    {
        $resp_data['title'] = 'Product';
        return view('Product.product-list-ajax', $resp_data);
    }

    public function getproduct(Request $req)
    {
        $page = $req->page;
        $search = $req->search;
        $column_name = $req->column_name;
        $sort_type = $req->sort_type;
        // dd($sort_type);
        $html = "";
        $limit = 5;
        $offset = ($page - 1) * $limit;
        if ($page) {
            if ($search) {
                if ($column_name && $sort_type) {
                    $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                        ->offset($offset)
                        ->limit(5)
                        ->where('status', 1)
                        ->where('prod_name', 'LIKE', "%$search%")
                        ->orWhere('prod_desc', 'LIKE', "%$search%")
                        ->orderBy($column_name, $sort_type)
                        ->get()
                        ->toArray();

                    if ($product) {
                        $i = ($page - 1) * $limit + 1;
                        foreach ($product as $p) {
                            if ($p['subcategory_id'] == null || $p['subcategory'] == null || $p['category'] == null) {
                                $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>No Subcategory For This Item</td><td>No Category For This Item</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                            } else {
                                foreach ($p['subcategory'] as $s) {
                                    foreach ($p['category'] as $c) {
                                        $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>" . $s['subcategory_name'] . "</td><td>" . $c['category_name'] . "</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                                    }
                                }
                            }
                        }
                    } else {
                        $html .= "<tr><td colspan='7' class='text-center'>No Data Found...</td></tr>";
                    }
                } else {
                    $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                        ->offset($offset)
                        ->limit(5)
                        ->where('status', 1)
                        ->where('prod_name', 'LIKE', "%$search%")
                        ->orWhere('prod_desc', 'LIKE', "%$search%")
                        ->get()
                        ->toArray();

                    if ($product) {
                        $i = ($page - 1) * $limit + 1;
                        foreach ($product as $p) {
                            if ($p['subcategory_id'] == null || $p['subcategory'] == null || $p['category'] == null) {
                                $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>No Subcategory For This Item</td><td>No Category For This Item</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                            } else {
                                foreach ($p['subcategory'] as $s) {
                                    foreach ($p['category'] as $c) {
                                        $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>" . $s['subcategory_name'] . "</td><td>" . $c['category_name'] . "</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                                    }
                                }
                            }
                        }
                    } else {
                        $html .= "<tr><td colspan='7' class='text-center'>No Data Found...</td></tr>";
                    }
                }
            } else {
                if ($column_name && $sort_type) {
                    $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                        ->offset($offset)
                        ->limit(5)
                        ->where('status', 1)
                        ->orderBy($column_name, $sort_type)
                        ->get()
                        ->toArray();
                    if ($product) {
                        $i = ($page - 1) * $limit + 1;
                        foreach ($product as $p) {
                            if ($p['subcategory_id'] == null || $p['subcategory'] == null || $p['category'] == null) {
                                $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>No Subcategory For This Item</td><td>No Category For This Item</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                            } else {
                                foreach ($p['subcategory'] as $s) {
                                    foreach ($p['category'] as $c) {
                                        $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>" . $s['subcategory_name'] . "</td><td>" . $c['category_name'] . "</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                                    }
                                }
                            }
                        }
                    } else {
                        $html .= "<tr><td colspan='7' class='text-center'>No Data Found...</td></tr>";
                    }
                } else {
                    $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                        ->offset($offset)
                        ->limit(5)
                        ->where('status', 1)
                        ->get()
                        ->toArray();
                    if ($product) {
                        $i = ($page - 1) * $limit + 1;
                        foreach ($product as $p) {
                            if ($p['subcategory_id'] == null || $p['subcategory'] == null || $p['category'] == null) {
                                $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>No Subcategory For This Item</td><td>No Category For This Item</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                            } else {
                                foreach ($p['subcategory'] as $s) {
                                    foreach ($p['category'] as $c) {
                                        $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>" . $s['subcategory_name'] . "</td><td>" . $c['category_name'] . "</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                                    }
                                }
                            }
                        }
                    } else {
                        $html .= "<tr><td colspan='7' class='text-center'>No Data Found...</td></tr>";
                    }
                }
            }
        } else {
            if ($search) {
                if ($column_name && $sort_type) {
                    $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                        ->offset(0)
                        ->limit(5)
                        ->where('status', 1)
                        ->where('prod_name', 'LIKE', "%$search%")
                        ->orWhere('prod_desc', 'LIKE', "%$search%")
                        ->orderBy($column_name, $sort_type)
                        ->get()
                        ->toArray();
                    // dd($product);
                    if ($product) {
                        $i = 1;
                        $page = 1;
                        foreach ($product as $p) {
                            if ($p['subcategory_id'] == null || $p['subcategory'] == null || $p['category'] == null) {
                                $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>No Subcategory For This Item</td><td>No Category For This Item</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                            } else {
                                foreach ($p['subcategory'] as $s) {
                                    foreach ($p['category'] as $c) {
                                        $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>" . $s['subcategory_name'] . "</td><td>" . $c['category_name'] . "</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                                    }
                                }
                            }
                        }
                    } else {
                        $html .= "<tr><td colspan='7' class='text-center'>No Data Found...</td></tr>";
                    }
                } else {
                    $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                        ->offset(0)
                        ->limit(5)
                        ->where('status', 1)
                        ->where('prod_name', 'LIKE', "%$search%")
                        ->orWhere('prod_desc', 'LIKE', "%$search%")
                        ->get()
                        ->toArray();
                    // dd($product);
                    if ($product) {
                        $i = 1;
                        $page = 1;
                        foreach ($product as $p) {
                            if ($p['subcategory_id'] == null || $p['subcategory'] == null || $p['category'] == null) {
                                $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>No Subcategory For This Item</td><td>No Category For This Item</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                            } else {
                                foreach ($p['subcategory'] as $s) {
                                    foreach ($p['category'] as $c) {
                                        $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>" . $s['subcategory_name'] . "</td><td>" . $c['category_name'] . "</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                                    }
                                }
                            }
                        }
                    } else {
                        $html .= "<tr><td colspan='7' class='text-center'>No Data Found...</td></tr>";
                    }
                }
            } else {
                if ($column_name && $sort_type) {
                    $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                        ->offset(0)
                        ->limit(5)
                        ->where('status', 1)
                        ->orderBy($column_name, $sort_type)
                        ->get()
                        ->toArray();

                    if ($product) {
                        $i = 1;
                        $page = 1;
                        foreach ($product as $p) {
                            if ($p['subcategory_id'] == null || $p['subcategory'] == null || $p['category'] == null) {
                                $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>No Subcategory For This Item</td><td>No Category For This Item</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                            } else {
                                foreach ($p['subcategory'] as $s) {
                                    foreach ($p['category'] as $c) {
                                        $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>" . $s['subcategory_name'] . "</td><td>" . $c['category_name'] . "</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                                    }
                                }
                            }
                        }
                    } else {
                        $html .= "<tr><td colspan='7' class='text-center'>No Data Found...</td></tr>";
                    }
                } else {
                    if($req->limit){
                        $limit=$req->limit;
                    }
                    else{
                        $limit=5;
                    }
                    $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                        ->offset(0)
                        ->limit($limit)
                        ->where('status', 1)
                        ->get()
                        ->toArray();

                    if ($product) {
                        $i = 1;
                        $page = 1;
                        foreach ($product as $p) {
                            if ($p['subcategory_id'] == null || $p['subcategory'] == null || $p['category'] == null) {
                                $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>No Subcategory For This Item</td><td>No Category For This Item</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                            } else {
                                foreach ($p['subcategory'] as $s) {
                                    foreach ($p['category'] as $c) {
                                        $html .= "<tr><td><input class='form-check-input chkid' style='border-color: #888888;' type='checkbox' id=".$p['id']."></td><td>" . $i++ . "</td><td>" . $p['prod_name'] . "</td><td>" . $p['prod_desc'] . "</td><td>" . $s['subcategory_name'] . "</td><td>" . $c['category_name'] . "</td><td><a href=" . url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']) . "><button class='btn btn-info'>Edit</button></a></td><td><a href=" . url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']) . "><button class='btn btn-danger'>Delete</button></a></td></tr>";
                                    }
                                }
                            }
                        }
                    } else {
                        $html .= "<tr><td colspan='7' class='text-center'>No Data Found...</td></tr>";
                    }
                }
            }
        }
        return response()->json($html);
    }

    public function addajax()
    {
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        return view('Product.product-add-ajax', ['category' => $category]);
    }

    public function storeajax(Request $req)
    {
        $array = $req->all();
        unset($array["_token"]);
        $array['status'] = 1;
        $array['created_at'] = date('Y-m-d H:i:s');
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
        $page = $req->page;
        $product = Product::where('id', decrypt($id))->get()->toArray();
        $category = Category::select('category_id', 'category_name')->get()->toArray();
        return view('Product.product-update-ajax', ['category' => $category, 'product' => $product, 'id' => $id, 'page' => $page]);
    }

    public function pagination(Request $req)
    {
        $html = "";
        if ($req->page) {
            if ($req->search) {
                $page = $req->page;
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->where('status', 1)
                    ->where('prod_name', 'LIKE', "%$req->search%")
                    ->orWhere('prod_desc', 'LIKE', "%$req->search%")
                    ->get()
                    ->toArray();

                $total_records = count($product);
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
                $page = $req->page;
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->where('status', 1)
                    ->get()
                    ->toArray();

                $total_records = count($product);
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
            }
        } else {
            if ($req->search) {
                $page = $req->page;
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->where('status', 1)
                    ->where('prod_name', 'LIKE', "%$req->search%")
                    ->orWhere('prod_desc', 'LIKE', "%$req->search%")
                    ->get()
                    ->toArray();

                $total_records = count($product);
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
            } else {
                $page = $req->page;
                $product = Product::select('id', 'prod_name', 'prod_desc', 'subcategory_id')->with('category', 'subcategory')
                    ->where('status', 1)
                    ->get()
                    ->toArray();

                $total_records = count($product);
                if($req->limit){
                    $limit=$req->limit;
                }
                else{
                    $limit = 5;
                }
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
        }
        return response()->json($html);
    }

    public function bulkdelete(Request $req){
        $idarr=$req->chkids;
        foreach($idarr as $id){
            $table=Product::where('id',$id)->update(['status'=>0]);
        }
        if($table){
            $message='Records Deleted Successfully';
        }
        else{
            $message='Records Deleted Failed';
        }
        return response()->json(['message'=>$message]);
    }
}
