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
    </div>
</main>

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


        // $('.addbtn').click(function() {
        //     $.ajax({
        //         url: '{{ url("/subcategory/add") }}',
        //         type: "GET",
        //         success: function(response) {
        //             window.open('/subcategory/add', '_SELF');
        //         },
        //         error: function(e) {
        //             $('#message').text(e.responseText);
        //         }
        //     });
        // });
    });
</script>
@include('footer')