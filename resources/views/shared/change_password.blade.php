
<!doctype html>
<html lang="en">

<head>
<title>Reset Password</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<link rel="icon" href="{{asset('assets/images/logo-learnifyid.svg')}}" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/animate-css/vivify.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/sweetalert/sweetalert.css')}}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/animation.css')}}">

</head>

<body class="theme-cyan font-montserrat light_version">
<!-- Page Loader -->
@extends('layouts._loader')

<div class="auth-main2 particles_js">
    <div class="auth_div vivify fadeInTop">
        <div class="card">
            <div class="body justify-content-around">
                <div class="login-img">
                    @include('shared.svg.pw')
                </div>
                <form class="form-auth-small my-auto" action="{{route('update-password')}}" method="post">
                    <img src="{{asset('assets/images/logo-with-name-learnifyid.svg')}}" alt="Smart School Logo" class="img-fluid">
                    @csrf
                    @method("PATCH")
                    <p class="text-center" style="font-size: 12px;">Silahkan ganti password anda.</p>

                    <div class="form-group">
                        <label for="old_password" class="control-label sr-only">password_lama</label>
                        <input type="password" class="form-control round" id="old_password" name="old_password" placeholder="Password Lama" required>

                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label sr-only">password_baru</label>
                        <input type="password" class="form-control round" id="password" name="password" placeholder="Password Baru" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="control-label sr-only">password_baru</label>
                        <input type="password" class="form-control round" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password Baru" required>
                    </div>
                    <button type="submit" class="btn bg-blue-2 text-white btn-round btn-block">Simpan</button>
                    <a href="{{route('dashboard')}}" type="button" class="btn bg-blue-2 text-white btn-round btn-block">Kembali ke Dashboard</a>
                </form>
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
@include('sweetalert::alert')
</body>
</html>
