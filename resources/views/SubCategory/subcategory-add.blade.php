@extends('default')

@section('content')
<main>
    <div class="container-fluid mt-5">
        <div class="productform">
            <form action="{{ $url }}" method="post" enctype="multipart/form-data" id="ajax-form">
                <input type="hidden" id="id" value="<?php isset($subcategory[0]['subcategory_id']) ? print($subcategory[0]['subcategory_id']) : '' ?>">
                @csrf
                <table>
                    <tr>
                        <td>
                            <label for="subcategory_name">SubCategory Name</label>
                        </td>
                        <td>
                            <input class="form-control" type="text" name="subcategory_name" id="subcategory_name" placeholder="Enter SubCategory Name" value="<?php isset($subcategory[0]['subcategory_name']) ? print($subcategory[0]['subcategory_name']) : '' ?>">
                            @error('subcategory_name')
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
                            <button class="btn btn-success">Submit</button>
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
        var id = $('#id').val();
        if (id) {
        $.ajax({
            url: '{{ url("/getcategory") }}',
            type: 'GET',
            data: {
                id
            },
            success: function(response) {
                $('#category_name').html(response);
            },
            error: function(e) {
                $('#category_name').html(response);
            }
        });
    }
    else{
        $.ajax({
            url: '{{ url("/getcategory") }}',
            type: 'GET',
            success: function(response) {
                $('#category_name').html(response);
            },
            error: function(e) {
                $('#category_name').html(response);
            }
        });
    }
    });
</script>
@endsection