<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    @include('header')
    @yield('custom_css')
    <title>@yield('title')</title>

</head>

<body>

    <header>
        <!-- Navigation -->
        @include('nav')
    </header>

    <body>
    @yield('content')
    <!-- /#page-wrapper -->

    @include('footer')
    
    @yield('custom_script')

</body>

</html>