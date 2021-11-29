
<!doctype html>
<html lang="en">

<head>
<title>Error 404 Halaman Tidak Ditemukan</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<link rel="icon" href="{{asset('assets/images/logo-learnifyid.svg')}}" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/animate-css/vivify.min.css')}}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">

</head>

<body class="theme-cyan font-montserrat light_version">
<!-- Page Loader -->
@extends('layouts._loader')

<div class="auth-main2 particles_js">
    <div class="auth_div vivify fadeInTop">
        <div class="card">            
            <div class="body">
                <div class="d-flex flex-row flex-wrap justify-content-center align-items-center w-100">
                    <div class="col text-center text-sm-right">
                        <h3 class="bold" style="color: #4BCAE3">404!</h3>
                        <h3 class="bold" style="color: #00B4D8">Aduh,</h3>
                        <h3 class="bold" style="color: #00B4D8">Kamu Tersesat.</h3>
                        <a href="{{ route('dashboard') }}" style="color: #4BCAE3"><i class="fa fa-chevron-left font-11"></i> Kembali</a>
                    </div>
                    <div class="col">
                        <img class="img-fluid" src="{{asset('assets/images/error-page.svg')}}" style="min-width: 260px;"/>
                    </div>
                </div>
                <div class="pattern">
                    <span class="red"></span>
                    <span class="indigo"></span>
                    <span class="blue"></span>
                    <span class="green"></span>
                    <span class="orange"></span>
                </div>
            </div>            
        </div>
    </div>
    <div id="particles-js"></div>
</div>
<!-- END WRAPPER -->
    
<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>
</body>
</html>
