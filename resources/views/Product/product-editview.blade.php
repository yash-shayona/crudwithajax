@extends('default')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<main>
<div class="message">

</div>
    <div class="container-fluid mt-5">
        <div class="productform">
            <form method="post" enctype="multipart/form-data" id="updateprodform">
                @csrf
                <table>
                    <input type="hidden" name="id" class="id" value="@if(isset($product[0]['id'])){{ $product[0]['id'] }}@else""@endif">
                    <tr>
                        <td>
                            <label for="prod_name">Product Name</label>
                        </td>
                        <td>
                            <input type="text" name="prod_name" id="prod_name" placeholder="Enter Product Name" value="@if(isset($product[0]['prod_name'])){{ $product[0]['prod_name'] }}@else""@endif">@error('prod_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="prod_desc">Product Description</label>
                        </td>
                        <td>
                            <textarea name="prod_desc" id="prod_desc" cols="30" rows="4">@if(isset($product[0]['prod_desc'])){{ $product[0]['prod_desc'] }}@else @endif</textarea>@error('prod_desc')<div class="alert alert-danger">{{ $message }}</div>
                            @enderror<br><br>
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
                            @enderror<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" class="btn btn-success" id="updatebtn" value="@if(isset($product[0]['id'])){{ 'Update' }}@else{{ 'Submit' }} @endif">
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
        var path=window.location.pathname;
        // alert(path);
        // $('#updateprodform').submit(function(event){
        //     // event.preventDefault();

        //     var form =$('#updateprodform')[0];
        //     var data = new FormData(form);
        //     console.log(data);
        // });
        $('#updatebtn').click(function() {
            var id = $('.id').val();
            // alert(id);
            // var prodname = $()
            $.ajax({
                url: '/product/update/' + id,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:$('#updateprodform').serialize(),
                success: function(response) {
                    $('.message').text(response.message);
                    // console.log(response);
                    // window.location.href;
                    window.open('/product','_SELF');
                },
                error:function(e){
                    $('.message').text(e.responseText);
                }
            });
        });
    });
</script>
@endsection
