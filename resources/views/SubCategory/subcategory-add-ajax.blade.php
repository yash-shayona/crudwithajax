@extends('default')

@section('content')
<div id="message" class="alert alert-success" style="display: none;">
</div>
<main>
    <div class="container-fluid mt-5">
        <div class="productform">
            <form enctype="multipart/form-data" id="ajax-form">
                @csrf
                <table>
                    <tr>
                        <td>
                            <label for="subcategory_name">SubCategory Name</label>
                        </td>
                        <td>
                            <input class="form-control" type="text" name="subcategory_name" id="subcategory_name" placeholder="Enter SubCategory Name" value="@if(isset($category[0]['category_name'])){{ $category[0]['category_name'] }}@else""@endif">
                            @error('category_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="category_name">Category Name</label>
                        </td>
                        <td><select name="category_id" id="category_name" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button name="submitbtn" class="btn btn-success">Submit</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</main>
@endsection

@section('custom_script')
<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ url("/getcategory") }}',
            type: 'GET',
            success: function(response) {
                for (var i = 0; i < response.length; i++) {
                    $('#category_name').append(`<option value="`+response[i]['category_id']+`">`+response[i]['category_name']+`</option>`)
                }
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });

        $('#ajax-form').submit(function(event){
            event.preventDefault();
            var form = $('#ajax-form')[0];
            var data = new FormData(form);
            $('button[name=submitbtn]').prop('disabled',true);
            $.ajax({
                url:'{{ url("/subcategory/save") }}',
                type:'POST',
                data:data,
                processData:false,
                contentType:false,
                success:function(response){
                    $('#message').text(response).css('display','block');
                    window.setTimeout(function(){
                        window.open('/subcategory','_SELF');
                    },2000);
                },
                error:function(e){
                    $('#message').text(e.responseText);
                }
            })
        })
    });
</script>
@endsection