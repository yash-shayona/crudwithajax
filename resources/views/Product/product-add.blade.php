@extends('default')

@section('content')
<main>

    <div class="container-fluid mt-5">
        <div class="productform">
            <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" value="@if(isset($product[0]['id'])){{ encrypt($product[0]['id']) }}@else""@endif">
                <table>
                    <tr>
                        <td>
                            <label for="prod_name">Product Name</label>
                        </td>
                        <td>
                            <input type="text" name="prod_name" id="prod_name" placeholder="Enter Product Name" value="@if(isset($product[0]['prod_name'])){{ $product[0]['prod_name'] }}@else""@endif">@error('prod_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="prod_desc">Product Description</label>
                        </td>
                        <td>
                            <textarea name="prod_desc" id="prod_desc" cols="30" rows="4">@if(isset($product[0]['prod_desc'])){{ $product[0]['prod_desc'] }}@else @endif</textarea>@error('prod_desc')<div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="category">Product Category</label>
                        </td>
                        <td>
                            <select name="category_id" id="category">
                                <option value="">Select</option>
                                @foreach($category as $c)
                                @if(isset($product[0]['category_id']))
                                @foreach($product as $p)
                                <option value="{{ $c['category_id'] }}" @if($p['category_id']==$c['category_id']) {{ "selected" }} @endif>{{ $c['category_name'] }}</option>
                                @endforeach
                                @else
                                <option value="{{ $c['category_id'] }}">{{ $c['category_name'] }}</option>
                                @endif

                                @endforeach
                            </select>@error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="category">Product SubCategory</label>
                        </td>
                        <td>
                            <select name="subcategory_id" id="subcategory">
                                <option value="">Select</option>
                                <!-- @foreach($subcategory as $s)
                                @if(isset($product[0]['category_id']))
                                @foreach($product as $p)
                                <option value="{{ $s['subcategory_id'] }}" @if($p['category_id']==$s['subcategory_id']) {{ "selected" }} @endif>{{ $s['subcategory_name'] }}</option>
                                @endforeach
                                @else
                                <option value="{{ $s['subcategory_id'] }}">{{ $s['subcategory_name'] }}</option>
                                @endif
                                
                                @endforeach -->
                            </select>@error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="btn btn-success" value="@if(isset($product[0]['id'])){{ 'Update' }}@else{{ 'Submit' }} @endif">
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
        var prodid = $('#id').val();
        if (prodid) {
            if ($('#category option:selected').each) {
                $('#category option:selected').each(function() {
                    var id = this.value;

                    $.ajax({
                        url: '{{ url("/getcattosubcat") }}',
                        type: 'GET',
                        data: {
                            id,
                            prodid
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $('#subcategory').html(response);
                            } else {
                                $('#subcategory').html(`<option value="">No SubCategory Available...</option>`);
                            }
                        },
                        error: function(e) {
                            console.log(e.responseText);
                        }
                    });
                });

                $('#category').on('change', function() {
                    var id = this.value;
                    var prodid = $('#id').val();
                    $.ajax({
                        url: '{{ url("/getcattosubcat") }}',
                        type: 'GET',
                        data: {
                            id,
                            prodid
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $('#subcategory').html(response);
                            } else {
                                $('#subcategory').html(`<option value="">No SubCategory Available...</option>`);
                            }
                        },
                        error: function(e) {
                            console.log(e.responseText);
                        }
                    });
                })

            }
        } else {
            $('#category').on('change', function() {
                var id = this.value;
                $.ajax({
                    url: '{{ url("/getcattosubcat") }}',
                    type: 'GET',
                    data: {
                        id
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            $('#subcategory').html(response);
                        } else {
                            $('#subcategory').html(`<option value="">No SubCategory Available...</option>`);
                        }

                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });
            })

        }
    });
</script>
@endsection