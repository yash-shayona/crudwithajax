@include('header')

<main>
    
    <div class="container-fluid mt-5">
        <div class="productform">
            <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                @csrf
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
                            <input type="submit" class="btn btn-success" value="@if(isset($product[0]['id'])){{ 'Update' }}@else{{ 'Submit' }} @endif">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</main>

@include('footer')