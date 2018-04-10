<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="format-detection" content="telephone=yes"/>
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    {{--<link href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" />--}}
    <title>党建</title>
    <link rel="stylesheet" href="/css/head.css" type="text/css" />
    <link rel="stylesheet" href="/css/SecondPage.css" type="text/css" />
    <link rel="stylesheet" href="/css/nav.css" type="text/css" />

    @section('css')
    @show()

</head>
@section('style')
@show()

<body>

@include('front.layouts.header')

@section('main')
@show()

@include('front.layouts.footer')

<script src="/script/jquery-3.2.1.js"></script>
<script src="/script/sweetalert2.all.min.js"></script>
<script src="/script/head.js"></script>
<script src="/script/child-list.js"></script>
<script src="/script/show.js"></script>

@include('sweetalert::alert')

@section('js')
@show()

</body>
</html>

