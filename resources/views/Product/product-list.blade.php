@extends('default')

@section('content')
<div class="message"></div>
<main>

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif

    <a href="{{ url('/product/add') }}"><button class="btn btn-primary mt-3 mx-5">Add</button></a>


    <div class="categorytable mt-3 container">
        <table class="table table-bordered text-center">
            <tr>
                <td colspan="5">
                    <form action="/product" method="get"><input type="text" class="form-control w-25 d-inline" name="search" id="search" placeholder="Search"><input type="submit" class="mx-2 btn btn-success" value="Search"></form>
                </td>
                <td colspan="2">
                    <form action="{{ $url }}" method="post">
                        @csrf
                        <select name="column_name" id="column_name" class="form-select w-50 d-inline">
                            <option value="">Sort By</option>
                            <option value="id">Product No</option>
                            <option value="prod_name">Product Name</option>
                            <option value="prod_desc">Product Description</option>
                            <option value="subcategory_id">Product SubCategory</option>
                            <option value="category_id">Product Category</option>
                        </select>
                        <select name="sort_type" id="sort_type" class="form-select w-25 d-inline">
                            <option value="asc">Type</option>
                            <option value="asc">Asc</option>
                            <option value="desc">Desc</option>
                        </select>
                        <input type="submit" value="Sort" class="mx-1 btn btn-secondary">
                    </form>
                </td>
            </tr>
            <tr>
                <th>Product No</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product SubCategory</th>
                <th>Product Category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            // echo "<pre>";
            // print_r($product);
            foreach ($product as $p) {
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $p['prod_name']; ?></td>
                    <td><?php echo $p['prod_desc']; ?></td>
                    <td><?php echo $p['subcategory'][0]['subcategory_name']; ?></td>
                    <td><?php echo $p['category'][0]['category_name']; ?></td>
                    <td><a href="<?php echo url('/product/page/' . $page . '/edit') . '/' . encrypt($p['id']); ?>"><button class="btn btn-info editbtn">Edit</button></a></td>
                    <td><a href="<?php echo url('/product/page/' . $page . '/delete') . '/' . encrypt($p['id']); ?>"><button class="btn btn-danger deletebtn">Delete</button></a></td>
                    <!-- <td><a href="{{ url('/product/page/'.$page.'/'.'delete/').'/'.encrypt($p['id']) }}"><button class="btn btn-danger" onclick="confirm('Are You Sure Want To Delete ?')">Delete</button></a></td> -->
                </tr>
            <?php
                $i++;
            }
            ?>
        </table>
        <div class="pagination">
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
            }
            $total_page = ceil($total / $limit);
            if ($page >= 2) {
                if ($search) {
                    if ($column_name && $sort_type) {
                        echo '<a href="/product/sortproduct/'.encrypt($column_name).'/'.encrypt($sort_type).'/search/' . $search . '/page/' . ($page - 1) . '"><button class="btn btn-warning mx-1">Prev</button></a>';
                    }
                    else{
                        echo '<a href="/product/search/' . $search . '/page/' . ($page - 1) . '"><button class="btn btn-warning mx-1">Prev</button></a>';
                    }
                } else {
                    if ($column_name && $sort_type) {
                        echo '<a href="/product/sortproduct/'. encrypt($column_name).'/' .encrypt($sort_type).'/page/'. ($page - 1) . '"><button class="btn btn-warning mx-1">Prev</button></a>';
                    }
                    else{
                        echo '<a href="/product/page/' . ($page - 1) . '"><button class="btn btn-warning mx-1">Prev</button></a>';
                    }
                }
            }
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page) {
                    if ($search) {
                        if($column_name && $sort_type){
                            echo '<a href="/product/sortproduct/'.encrypt($column_name).'/'.encrypt($sort_type).'/search/' . $search . '/page/' . $i . '"><button class="' . $active . ' mx-1">' . $i . '</button></a>';
                        }
                        else{
                            echo '<a href="/product/search/' . $search . '/page/' . $i . '"><button class="' . $active . ' mx-1">' . $i . '</button></a>';
                        }
                    } else {
                        if ($column_name && $sort_type) {
                            echo '<a href="/product/sortproduct/'.encrypt($column_name).'/'.encrypt($sort_type).'/page/' . $i . '"><button class="' . $active . ' mx-1">' . $i . '</button></a>';
                        }
                        else{
                            echo '<a href="/product/page/' . $i . '"><button class="' . $active . ' mx-1">' . $i . '</button></a>';
                        }
                    }
                } else {
                    if ($search) {
                        if ($column_name && $sort_type) {
                            echo '<a href="/product/sortproduct/'.encrypt($column_name).'/'.encrypt($sort_type).'/search/' . $search . '/page/' . $i . '"><button class="btn btn-warning mx-1">' . $i . '</button></a>';
                        }
                        else{
                            echo '<a href="/product/search/' . $search . '/page/' . $i . '"><button class="btn btn-warning mx-1">' . $i . '</button></a>';
                        }
                    } else {
                        if ($column_name && $sort_type) {
                            echo '<a href="/product/sortproduct/'.encrypt($column_name).'/'.encrypt($sort_type).'/page/' . $i . '"><button class="btn btn-warning mx-1">' . $i . '</button></a>';
                        } else {
                            echo '<a href="/product/page/' . $i . '"><button class="btn btn-warning mx-1">' . $i . '</button></a>';
                        }
                    }
                }
            }
            if ($page < $total_page) {
                if ($search) {
                    if ($column_name && $sort_type) {
                        echo '<a href="/product/sortproduct/'.encrypt($column_name).'/'.encrypt($sort_type).'/search/' . $search . '/page/' . ($page + 1) . '"><button class="btn btn-warning mx-1">Next</button></a>';
                    }
                    else{
                        echo '<a href="/product/search/' . $search . '/page/' . ($page + 1) . '"><button class="btn btn-warning mx-1">Next</button></a>';
                    }
                } else {
                    if ($column_name && $sort_type) {
                        echo '<a href="/product/sortproduct/'.encrypt($column_name).'/'.encrypt($sort_type).'/page/' . ($page + 1) . '"><button class="btn btn-warning mx-1">Next</button></a>';
                    }
                    else{
                        echo '<a href="/product/page/' . ($page + 1) . '"><button class="btn btn-warning mx-1">Next</button></a>';
                    }
                }
            }
            ?>

        </div>
    </div>

</main>
@endsection