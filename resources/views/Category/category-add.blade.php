@extends('default')

@section('content')
<main>
    <div class="container-fluid mt-5">
        <div class="productform">
            <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                @csrf
                <table>
                    <tr>
                        <td>
                            <label for="category_name">Category Name</label>
                        </td>
                        <td>
                            <input type="text" name="category_name" id="category_name" placeholder="Enter Category Name" value="@if(isset($category[0]['category_name'])){{ $category[0]['category_name'] }}@else""@endif">
                            @error('category_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="btn btn-success" value="@if(isset($category[0]['category_id'])){{ 'Update' }}@else{{ 'Submit' }} @endif">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</main>
@endsection