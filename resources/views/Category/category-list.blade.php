@extends('default')
@section('title', $title ?? '')

@section('content')
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
        <table class="table table-bordered text-center ajax-table">
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
                    <td><a href="{{ url('/category/getprodlist/'.encrypt($c['category_id'])) }}"><?php echo $c['category_name']; ?></a></td>
                    <td><a href="{{ url('/category/edit/').'/'.encrypt($c['category_id']) }}"><button class="btn btn-info">Edit</button></a></td>
                    <td><a href="{{ url('/category/delete/').'/'.encrypt($c['category_id']) }}"><button class="btn btn-danger">Delete</button></a></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </table>
        <div class="pagination">

        </div>
    </div>
</main>
@endsection

@section('custom_script')
<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ url("/ajaxdata") }}',
            type: 'GET',
            success: function(response) {
                $('.ajax-table').html(response);
            },
            error: function(response) {
                $('.ajax-table').html(response);
            }
        });

            $('.pagination').on('click', '.pgbtn', function() {
                var id = this.id;
                $.ajax({
                    url: '{{ url("/ajaxdata") }}',
                    type: 'GET',
                    data: {
                        'page': id
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            $('.ajax-table').html(response);
                        } else {
                            $('.ajax-table').html(response);
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });
            });


        $.ajax({
            url: '{{ url("/catpagination") }}',
            type: 'GET',
            success: function(response) {
                $('.pagination').html(response);
            },
            error: function(e) {
                $('.pagination').html(e.responseText);
            }
        });


        $('.pagination').on('click', '.pgbtn', function() {
            var id = this.id;
            $.ajax({
                url: '{{ url("/catpagination") }}',
                type: "GET",
                data: {
                    'page': id
                },
                success: function(response) {
                    $('.pagination').html(response);
                },
                error: function(response) {
                    $('.pagination').html(response);
                }
            });
        });
    });
</script>
@endsection