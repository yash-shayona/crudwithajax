@include('header')
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

    <button class="btn btn-primary mt-3 mx-5 addbtn">Add</button>


    <div class="categorytable mt-3 container">
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>Product No</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product SubCategory</th>
                <th>Product Category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="ajax-prod-table">

        </tbody>
        </table>

    </div>

</main>

@include('footer')
<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ url("/getproduct") }}',
            type: 'GET',
            success: function(response) {
                // console.log(response);
                if (response.length > 0) {
                    // for (var i = 0; i < response.product.length; i++) {
                    //     if (response.product[i]['subcategory_id'] == null || response.product[i]['subcategory'].length == 0) {
                    //         $('.ajax-prod-table').append(`<tr>
                    //     <td>` + (i + 1) + `</td>
                    //     <td>` + response.product[i]['prod_name'] + `</td>
                    //     <td>` + response.product[i]['prod_desc'] + `</td>
                    //     <td>No Subcategory For This Item</td>
                    //     <td>No Category For This Item</td>
                    //     <td><button class="btn btn-info editbtn" data-id="` + response.product[i]['id'] + `">Edit</button></td>
                    //     <td><button class="btn btn-danger deletebtn" data-id="` + response.product[i]['id'] + `">Delete</button></td>
                    //     </tr>`);
                    //     } else {
                    //         $('.ajax-prod-table').append(`<tr>
                    //     <td>` + (i + 1) + `</td>
                    //     <td>` + response.product[i]['prod_name'] + `</td>
                    //     <td>` + response.product[i]['prod_desc'] + `</td>
                    //     <td>` + response.product[i]['subcategory'][0]['subcategory_name'] + `</td>
                    //     <td>` + response.product[i]['category'][0]['category_name'] + `</td>
                    //     <td><button class="btn btn-info editbtn" data-id="` + response.product[i]['id'] + `">Edit</button></td>
                    //     <td><button class="btn btn-danger deletebtn" data-id="` + response.product[i]['id'] + `">Delete</button></td>
                    //     </tr>`);
                    //     }
                    // }
                    $('.ajax-prod-table').html(response);
                } 
                else {
                    // $('.ajax-prod-table').append(`<tr><td colspan='6' class="text-center">No Data Found...</td></tr>`);
                    $('.ajax-prod-table').html(response);
                }
            },
            error: function(e) {
                console.log(e.responseText);
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
</script>