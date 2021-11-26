@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="clearfix mb-3">
        {{-- if nya semnentara, nanti diganti. pokoknya ngambil role --}}
        @if (request()->route('role') === "STUDENT")
            <h1>Akun Siswa</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.accounts', ['role' => "STUDENT"]) }}">Smart School</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.accounts', ['role' => "STUDENT"]) }}">Kelola Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Akun Siswa</li>
                </ol>
            </nav>
            <h1 class="text-primary font-weight-bold my-4" style="font-size: 1.8rem;">Akun Siswa</h1>
        @endif
        @if (request()->route('role') === "TEACHER")
            <h1>Akun Guru</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.accounts', ['role' => "TEACHER"]) }}">Smart School</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.accounts', ['role' => "TEACHER"]) }}">Kelola Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Akun Guru</li>
                </ol>
            </nav>
            <h1 class="text-primary font-weight-bold my-4" style="font-size: 1.8rem;">Akun Guru</h1>
        @endif
        @if (request()->route('role') === "ADMIN")
            <h1>Akun Admin</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.accounts', ['role' => "ADMIN"]) }}">Smart School</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.accounts', ['role' => "ADMIN"]) }}">Kelola Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Akun Admin</li>
                </ol>
            </nav>
            <h1 class="my-4 text-primary" style="font-size: 1.8rem;">Akun Admin</h1>
        @endif
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Users">Akun</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#addUser">Tambah Akun</a></li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="Users">
                        <div class="row my-3">
                            <div class="col-lg-8 col-md-12 col-sm-12"></div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="input-group">
                                <input type="search" class="form-control bg-white rounded text-dark" placeholder="Search" aria-label="Search"
                                aria-describedby="search-addon" />
                                <button type="button" class="btn btn-outline-primary"><i class="icon-magnifier"></i></button>
                                </div>
                            </div>
                        </div>
                        {{-- ntar if nya di ganti --}}
                        @if(request()->route('role') === "STUDENT")
                            @include('admin.statistik.tables.students')
                        @endif
                        @if(request()->route('role') === "TEACHER")
                            @include('admin.statistik.tables.teachers')
                        @endif
                        @if(request()->route('role') === "ADMIN")
                            @include('admin.statistik.tables.admins')
                        @endif
                    </div>
                    <div class="tab-pane" id="addUser">
                        <div class="d-flex justify-content-between my-3">
                            <div></div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-import-account"><i class="icon-arrow-down mr-2"></i>Import Akun</button>
                        </div>
                        {{-- ntar if nya di ganti --}}
                        @if(request()->route('role') === "STUDENT")
                            @include('admin.statistik.forms.students')
                        @endif
                        @if(request()->route('role') === "TEACHER")
                            @include('admin.statistik.forms.teachers')
                        @endif
                        @if(request()->route('role') === "ADMIN")
                            @include('admin.statistik.forms.admins')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin._modal_edit_account')
    @include('layouts.admin._modal_import_account')
</div>
@endsection

@section('script')
<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/pages/ui/dialogs.js')}}"></script>
@endsection
