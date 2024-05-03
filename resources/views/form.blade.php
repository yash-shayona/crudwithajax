@extends('default')
@section('title', $title ?? 'Form')

@section('content')
<form action="" method="post" id="ajaxform">
    @csrf
    <input type="hidden" name="dbid" id="dbid">
    <label for="fname">First Name : </label>
    <input type="text" id="fname" name="first_name"><br>
    <label for="mname">Middle Name : </label>
    <input type="text" id="mname" name="middle_name"><br>
    <label for="lname">Last Name : </label>
    <input type="text" id="lname" name="last_name"><br>
</form>
@endsection