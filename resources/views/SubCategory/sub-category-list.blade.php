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

    <a href="{{ url('/subcategory/add') }}">
        <button class="btn btn-primary mt-3 mx-5 addbtn">Add</button>
    </a>
    <div id="message"></div>

    <div class="categorytable mt-3 container">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Sub Category No</th>
                    <th>Sub Category Name</th>
                    <th>Category Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="subcategory-ajax-table">

            </tbody>
        </table>
        <div class="subcatpagination">

        </div>
    </div>
</main>
@endsection

@section('custom_script')
<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ url("/getsubcategory") }}',
            type: 'GET',
            success: function(response) {
                if (response.length > 0) {
                    $('#subcategory-ajax-table').html(response);
                } else {
                    $('#subcategory-ajax-table').html(response);
                }
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });

        if ($('.subcatpagination')) {
            $('.subcatpagination').on('click', '.pgbtn', function() {
                var id = this.id;
                $.ajax({
                    url: '{{ url("/getsubcategory") }}',
                    type: 'GET',
                    data: {
                        'page': id
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            $('#subcategory-ajax-table').html(response);
                        } else {
                            $('#subcategory-ajax-table').html(response);
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });
            })

        }

        $('.subcatpagination').on('click','.pgbtn',function(){
            var id=this.id;
            $.ajax({
                url:'{{ url("/subcatpagination") }}',
                type:"GET",
                data:{
                    'page':id
                },
                success:function(response){
                    $('.subcatpagination').html(response);
                },
                error:function(response){
                    $('.subcatpagination').html(response);
                }
            });
        })


        $.ajax({
            url: '{{ url("/subcatpagination") }}',
            type: "GET",
            success: function(response) {
                $('.subcatpagination').html(response);
            },
            error: function(e) {
                $('.subcatpagination').html(response);
            }
        });
    });
</script>
@endsection