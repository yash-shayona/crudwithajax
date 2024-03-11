@include('header')

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

    <a href="{{ url('/category/add') }}"><button class="btn btn-primary mt-3 mx-5">Add</button></a>


    <div class="categorytable mt-3 container">
        <table class="table table-bordered">
            <tr>
                <th>Category No</th>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            // echo "<pre>";
            // print_r($category);
            $i = 1;
            foreach ($category as $c) {
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><a href="{{ url('/category/getprodlist/'.$c['category_id']) }}"><?php echo $c['category_name']; ?></a></td>
                    <td><a href="{{ url('/category/edit/').'/'.encrypt($c['category_id']) }}"><button class="btn btn-info">Edit</button></a></td>
                    <td><a href="{{ url('/category/delete/').'/'.encrypt($c['category_id']) }}"><button class="btn btn-danger">Delete</button></a></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </table>
    </div>
</main>
@include('footer')