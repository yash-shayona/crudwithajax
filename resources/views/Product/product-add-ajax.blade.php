@include('header')

<div class="alert alert-success message" style="display: none;">

</div>

<main>

    <div class="container-fluid mt-5">
        <div class="productform">
            <form id="proddataform" enctype="multipart/form-data">
                @csrf
                <table>
                    <tr>
                        <td>
                            <label for="prod_name">Product Name</label>
                        </td>
                        <td>
                            <input type="text" name="prod_name" id="prod_name" placeholder="Enter Product Name" value="@if(isset($product[0]['prod_name'])){{ $product[0]['prod_name'] }}@else""@endif" required>
                            @error('prod_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="prod_desc">Product Description</label>
                        </td>
                        <td>
                            <textarea name="prod_desc" id="prod_desc" cols="30" rows="4" required>@if(isset($product[0]['prod_desc'])){{ $product[0]['prod_desc'] }}@else @endif</textarea>@error('prod_desc')<div class="alert alert-danger">{{ $message }}</div>
                            @enderror<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="category">Product Category</label>
                        </td>
                        <td>
                            <select name="category_id" id="category" required>
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
                            <input type="submit" class="btn btn-success submitbtn" value="@if(isset($product[0]['id'])){{ 'Update' }}@else{{ 'Submit' }} @endif">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#proddataform').submit(function(event) {
            event.preventDefault();

            var form = $('#proddataform')[0];
            var data = new FormData(form);

            $('.submitbtn').prop('disabled',true);

            $.ajax({
                url:'{{ url("/product/store") }}',
                type:"POST",
                data:data,
                processData:false,
                contentType:false,
                success:function(response){
                    $('.message').text(response.message).css('display','block');
                    window.setTimeout(function(){
                        window.open('/product','_SELF');
                    },2000);
                },
                error:function(e){
                    $('.message').text(response.message).css('display','block').attr('class','alert alert-danger');
                }
            })
        });
    });
</script>

@include('footer')