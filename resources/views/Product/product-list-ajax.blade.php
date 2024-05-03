@extends('default')
@section('custom_css')
<style>
    .sort {
        opacity: 0;
    }

    .sort:hover {
        opacity: 0.5;
    }
</style>
@endsection
@section('title', $title ?? '')

@section('content')
<div class="message alert alert-success" style="display: none;"></div>
<!-- <div class="message alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
</div> -->
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

    <div class="producttable mt-5 container">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <td colspan="1" style="background-color: bisque;"><button class="btn btn-primary addbtn">Add</button></td>
                    <td colspan="3" style="background-color: bisque;">
                        <input type="text" placeholder="Search" name="search" id="search" class="form-control w-50 mx-auto">
                    </td>
                    <td colspan="3" style="background-color: bisque;"><label for="limit" class="form-label">Records per page : </label> <select name="limit" id="limit" class="form-select w-25 d-inline">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select></td>
                    <td colspan="1" style="background-color: bisque;"><input type="button" value="Delete" class="btn btn-danger" name="bulkdltbtn"></td>
                </tr>
                <tr>
                    <th class=""><input class="form-check-input" style="border-color: #888888;" type="checkbox" name="allidschkbox"></th>
                    <th class="prod_sort">Product No<i class="fa-solid fa-sort ms-2 sort" style="cursor: pointer;" data-sort_type="asc" data-column_name="id"></i></th>
                    <th class="prod_sort">Product Name<i class="fa-solid fa-sort ms-2 sort" style="cursor: pointer;" data-sort_type="asc" data-column_name="prod_name"></i></th>
                    <th class="prod_sort">Product Description<i class="fa-solid fa-sort ms-2 sort" style="cursor: pointer;" data-sort_type="asc" data-column_name="prod_desc"></i></th>
                    <th class="prod_sort">Product SubCategory<i class="fa-solid fa-sort ms-2 sort" style="cursor: pointer;" data-sort_type="asc" data-column_name="subcategory_id"></i></th>
                    <th class="prod_sort">Product Category<i class="fa-solid fa-sort ms-2 sort" style="cursor: pointer;" data-sort_type="asc" data-column_name="category_id"></i></th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="ajax-prod-table">

            </tbody>
        </table>

        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id">
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">
        <div class="pagination">

        </div>
    </div>

</main>
@endsection

@section('custom_script')
<script>
    function GetURLParameter(sParam) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) {
                return decodeURIComponent(sParameterName[1]);
            }
        }
    }


    $(document).ready(function() {
        if ($('.pagination')) {
            $('.pagination').on('click', '.pgbtn', function() {
                var id = this.id;
                var column_name = $('#hidden_column_name').val();
                var order = $('#hidden_sort_type').val();
                $.ajax({
                    url: '{{ url("/getproduct") }}',
                    type: 'GET',
                    data: {
                        'page': id,
                        'search': search,
                        'column_name': column_name,
                        'sort_type': order
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            $('.ajax-prod-table').html(response);
                        } else {
                            $('.ajax-prod-table').html(response);
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });
            })

        }

        $('.producttable').on('change', '#limit', function() {
            var limit = this.value;
            $.ajax({
                url: '{{ url("/getproduct") }}',
                type: 'GET',
                data: {
                    'page': page,
                    'search': search,
                    'limit': limit
                },
                success: function(response) {
                    if (response.length > 0) {
                        $('.ajax-prod-table').html(response);
                    } else {
                        $('.ajax-prod-table').html(response);
                    }
                },
                error: function(e) {
                    console.log(e.responseText);
                }
            });

            $.ajax({
                url: '{{ url("/pagination") }}',
                type: 'GET',
                data: {
                    'page': page,
                    'search': search,
                    'limit': limit
                },
                success: function(response) {
                    $('.pagination').html(response);
                },
                error: function(response) {
                    $('.pagination').html(response);
                }
            });

            $('.pagination').on('click', '.pgbtn', function() {
                var id = this.id;
                var column_name = $('#hidden_column_name').val();
                var order = $('#hidden_sort_type').val();
                $.ajax({
                    url: '{{ url("/pagination") }}',
                    type: 'GET',
                    data: {
                        'page': id,
                        'search': search,
                        'column_name': column_name,
                        'sort_type': order,
                        'limit':limit
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

        // var page = GetURLParameter('page');
        if ('{{ session()->has("page") }}') {
            var page = '{{ session()->get("page") }}';
        }
        var search = null;
        let timer;
        $('.producttable').on('input', '#search', function() {
            search = this.value;
            clearTimeout(timer);
            timer = setTimeout(function() {
                $.ajax({
                    url: '{{ url("/getproduct") }}',
                    type: 'GET',
                    data: {
                        'page': page,
                        'search': search
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            $('.ajax-prod-table').html(response);
                        } else {
                            $('.ajax-prod-table').html(response);
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });

                $.ajax({
                    url: '{{ url("/pagination") }}',
                    type: 'GET',
                    data: {
                        'page': page,
                        'search': search
                    },
                    success: function(response) {
                        $('.pagination').html(response);
                    },
                    error: function(response) {
                        $('.pagination').html(response);
                    }
                });
            }, 1000);
        })
        $.ajax({
            url: '{{ url("/getproduct") }}',
            type: 'GET',
            data: {
                'page': page,
            },
            success: function(response) {
                if (response.length > 0) {
                    $('.ajax-prod-table').html(response);
                } else {
                    $('.ajax-prod-table').html(response);
                }
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });

        $('.pagination').on('click', '.pgbtn', function() {
            var id = this.id;
            var column_name = $('#hidden_column_name').val();
            var order = $('#hidden_sort_type').val();
            $.ajax({
                url: '{{ url("/pagination") }}',
                type: 'GET',
                data: {
                    'page': id,
                    'search': search,
                    'column_name': column_name,
                    'sort_type': order
                },
                success: function(response) {
                    $('.pagination').html(response);
                },
                error: function(response) {
                    $('.pagination').html(response);
                }
            });
        });

        $.ajax({
            url: '{{ url("/pagination") }}',
            type: 'GET',
            data: {
                'page': page,
            },
            success: function(response) {
                $('.pagination').html(response);
            },
            error: function(response) {
                $('.pagination').html(response);
            }
        });
    });

    $('.addbtn').click(function() {
        $.ajax({
            url: '{{ url("/product/add") }}',
            type: "GET",
            success: function(response) {
                window.open('/product/add', '_SELF')
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    $('.ajax-prod-table').on('click', '.editbtn', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: '/product/edit' + '/' + id,
            type: 'GET',
            data: {
                id
            },
            success: function(response) {
                window.open('/product/edit/' + id, '_SELF');
            }
        });
    });

    $('.ajax-prod-table').on('click', '.deletebtn', function() {
        var id = $(this).attr('data-id');
        var obj = $(this);
        console.log(id);
        $.ajax({
            url: '/product/delete' + '/' + id,
            type: 'GET',
            data: {
                id
            },
            success: function(response) {
                $('.message').text(response.message).css('display', 'block');
                $(obj).parent().parent().remove();
                window.setTimeout(function() {
                    window.open(window.location.href, "_SELF");
                }, 2000);

                // console.log(response);
            },
            error: function(e) {
                $('.message').text(e.responseText);
            }
        });
    });

    var column_name = null;
    var order = null;

    $('.prod_sort').on('click', '.sort', function() {
        var search = $('#search').val();
        var column_name = $(this).data('column_name');
        var sort_type = $(this).data('sort_type');
        var order = '';
        if (sort_type == 'asc') {
            $(this).data('sort_type', 'desc');
            order = 'desc';
        } else {
            $(this).data('sort_type', 'asc');
            order = 'asc';
        }
        if (order == 'asc') {
            $(this).attr('class', 'fa-solid fa-sort-up mx-2 sort').css('opacity', '1');
        } else {
            $(this).attr('class', 'fa-solid fa-sort-down mx-2 sort').css('opacity', '1');
        }
        $('#hidden_column_name').val(column_name);
        $('#hidden_sort_type').val(order);
        $.ajax({
            url: '{{ url("/getproduct") }}',
            type: 'GET',
            data: {
                'search': search,
                'column_name': column_name,
                'sort_type': order
            },
            success: function(response) {
                if (response.length > 0) {
                    $('.ajax-prod-table').html(response);
                } else {
                    $('.ajax-prod-table').html(response);
                }
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });

        $.ajax({
            url: '{{ url("/pagination") }}',
            type: 'GET',
            data: {
                'search': search,
                'column_name': column_name,
                'sort_type': order
            },
            success: function(response) {
                $('.pagination').html(response);
            },
            error: function(response) {
                $('.pagination').html(response);
            }
        });
    });

    $('input[name=bulkdltbtn]').click(function() {
        var chkids = null;
        var obj = null;
        chkids = $('.chkid:checked').map(function() {
            obj = $(this);
            return this.id;
        }).toArray();
        if (chkids.length !== 0) {
            if (confirm('Are you sure want to perform this action ? This action cannot retrive.')) {
                $.ajax({
                    url: '{{ url("/product/bulkdelete") }}',
                    type: 'GET',
                    data: {
                        chkids
                    },
                    success: function(response) {
                        if (response.message) {
                            $('.message').text(response.message).css('display', 'block');
                            window.open(window.location.href, "_SELF");
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });
            }

        } else {
            alert('Select at least one item');
        }
    });
</script>
@endsection