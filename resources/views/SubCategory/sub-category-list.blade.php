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

    <!-- <a href="{{ url('/subcategory/add') }}"> -->
    <button class="btn btn-primary mt-3 mx-5 addbtn">Add</button>
    <!-- </a> -->
    <div id="message"></div>

    <div class="categorytable mt-3 container">
        <table class="table table-bordered subcategory-ajax-table text-center">
            <tr>
                <th>Sub Category No</th>
                <th>Sub Category Name</th>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </table>
    </div>
</main>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ url("/getsubcategory") }}',
            type: 'GET',
            success: function(response) {
                if (response.length > 0) {
                    for (var i = 0; i < response.length; i++) {
                        $('.subcategory-ajax-table').append(`<tr>
                    <td>`+(i+1)+`</td>
                    <td>`+response[i]['subcategory_name']+`</td>
                    <td>`+response[i]['category'][0]['category_name']+`</td>
                    <td><button class="btn btn-info">Edit</button></td>
                    <td><button class="btn btn-danger">Delete</button></td>
                    </tr>`);
                    }
                } else {
                    $('.subcategory-ajax-table').append(`<tr>
                    <td colspan="5" class="text-center">No Records Found...</td>
                    </tr>`);
                }
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });


        $('.addbtn').click(function() {
            $.ajax({
                url: '{{ url("/subcategory/add") }}',
                type: "GET",
                success: function(response) {
                    window.open('/subcategory/add', '_SELF');
                },
                error: function(e) {
                    $('#message').text(e.responseText);
                }
            });
        });
    });
</script>
@include('footer')