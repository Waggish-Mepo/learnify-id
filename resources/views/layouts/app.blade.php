<!doctype html>
<html lang="en">

<head>
<title>Learnify.id</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="icon" href="{{asset('assets/images/logo-learnifyid.svg')}}" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/animate-css/vivify.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.3.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/sweetalert/sweetalert.css')}}">

<link rel="stylesheet" href="{{asset('assets/vendor/c3/c3.min.css')}}"/>

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/teacher.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/student.css')}}">
</head>
<body class="theme-cyan font-montserrat light_version">

<!-- Page Loader -->
@extends('layouts._loader')

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div id="wrapper">

    @extends('layouts._navbar')

    @extends('layouts._sidebar')

    @if (Auth::user()->role === "STUDENT")
        @if (Auth::user()->role === "STUDENT" && Request::is('student/subject/*/course/*/topic/*/*'))
            <div id="main-content" class="main-student w-100">
                <div class="container-fluid position-relative container-student">
                    <div class="position-absolute top-img">
                        <img src="{{asset('assets/images/top.svg')}}" width="120">
                    </div>
                    @yield('content')
                    <div class="position-absolute bottom-img-activity">
                        <img src="{{asset('assets/images/bottom.svg')}}" id="img-bg-bottom-activity">
                    </div>
                </div>
            </div>
        @else
            <div id="main-content" class="main-student">
                <div class="container-fluid position-relative container-student">
                    <div class="position-absolute top-img">
                        <img src="{{asset('assets/images/top.svg')}}" width="120">
                    </div>
                    @yield('content')
                    
                </div>
                <div class="position-absolute bottom-img">
                        <img src="{{asset('assets/images/bottom.svg')}}" id="img-bg-bottom">
                    </div>
            </div>
            
        @endif
    @else
        <div id="main-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    @endif

</div>


<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/c3.bundle.js')}}"></script>
{{-- <script src="{{asset('assets/js/index.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery/jquery.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
<script src="{{asset('assets/vendor/jquery-sparkline/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/vendor/metisMenu/metisMenu.js')}}"></script> --}}

<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>

<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/pages/ui/dialogs.js')}}"></script>
<script src="{{asset('assets/js/pages/custom.js')}}"></script>
<script>
    if ({{ $pw_matches ?? 'false' }}) {
        swal({
            title: 'Password kamu belum diganti!',
            text: 'Ganti password untuk memperkuat keamanan akun kamu',
            showCancelButton: true,
            confirmButtonColor: "#17C2D7",
            confirmButtonText: "Ganti Password",
            cancelButtonText: "Lewati",
            closeOnConfirm: false,
        }, function () {
            window.location = `{{ route('change-password') }}`;
        })
    }
</script>
<script src="{{asset('assets/vendor/ckeditor/build/ckeditor.js')}}"></script>
@yield('script')

</body>
</html>
