<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('adminAsset') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('adminAsset') }}/css/mdb.min.css">
    <link rel="stylesheet" href="{{ asset('adminAsset') }}/css/sidenav.css">
    <link rel="stylesheet" href="{{ asset('adminAsset') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('adminAsset') }}/css/responsive.css">
    <link rel="stylesheet" href="{{ asset('adminAsset') }}/css/datatables.min.css">
    <link rel="stylesheet" href="{{ asset('adminAsset') }}/css/datatables-select.min.css">
</head>
<body class="fix-header fix-sidebar">

@include('layout.menu')

@yield('content')


<script type="text/javascript" src="{{ asset('adminAsset') }}/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/popper.min.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/bootstrap.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/mdb.min.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/sidebarmenu.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/sticky-kit.min.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/custom.min-2.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/datatables.min.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/datatables-select.min.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/custom.js"></script>
<script type="text/javascript" src="{{ asset('adminAsset') }}/js/axios.min.js"></script>
</body>
</html>
