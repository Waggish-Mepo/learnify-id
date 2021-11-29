
<!doctype html>
<html lang="en">

<head>
<title>Login</title>
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
                <div class="login-img">
                    <img class="img-fluid" src="{{asset('assets/images/login-page.svg')}}" />
                </div>
                <form class="form-auth-small my-auto" action="{{route('auth')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="signin-username" class="control-label sr-only">Username</label>
                        <input type="text" class="form-control round" id="signin-username" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Password</label>
                        <input type="password" class="form-control round" id="signin-password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox">
                            <span>Ingat saya</span>
                        </label>								
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block">MASUK</button>
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
</body>
</html>
