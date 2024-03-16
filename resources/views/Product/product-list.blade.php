@include('header')
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
        <table class="table table-bordered">
            <tr>
                <th>Product No</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            // echo "<pre>";
            // print_r($product);
            $i = 1;
            foreach ($product as $p) {
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $p['prod_name']; ?></td>
                    <td><?php echo $p['prod_desc']; ?></td>
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
            $total_page = ceil($total / $limit);
            if ($page >= 2) {
                echo '<a href="/product/page/' . ($page - 1) . '"><button class="btn btn-warning mx-1">Prev</button></a>';
            }
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page) {
                    echo '<a href="/product/page/' . $i . '"><button class="'.$active.' mx-1">' . $i . '</button></a>';
                } else {
                    echo '<a href="/product/page/' . $i . '"><button class="btn btn-warning mx-1">' . $i . '</button></a>';
                }
            }
            if ($page < $total_page) {
                echo '<a href="/product/page/' . ($page + 1) . '"><button class="btn btn-warning mx-1">Next</button></a>';
            }
            ?>

        </div>
    </div>

</main>

@include('footer')