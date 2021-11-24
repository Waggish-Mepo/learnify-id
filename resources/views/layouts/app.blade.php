<!doctype html>
<html lang="en">

<head>
<title>Smart School | Home</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/animate-css/vivify.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/vendor/c3/c3.min.css')}}"/>

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">

</head>
<body class="theme-cyan font-montserrat light_version">

<!-- Page Loader -->
@extends('layouts._loader')

<!-- Theme Setting -->
@extends('layouts._theme_setting')

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div id="wrapper">

    @extends('layouts._navbar')

    @extends('layouts._sidebar')

    <div id="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

</div>

@extends('layouts.script')
@yield('script')

</body>
</html>
