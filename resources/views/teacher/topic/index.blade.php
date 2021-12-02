@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ url('/subject/'.'matematika'.'/course/'.'1') }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/subject/'.'matematika'.'/course/'.'1') }}">List Bab</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Bab</li>
                </ol>
            </nav>
        </div>
    </div>
    <h5 class="color-blue-2 font-weight-bold text-uppercase">matematika | aljabar | bentuk-bentuk aljabar</h5>
    <div class="alert alert-primary my-4 rounded" role="alert">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center h4 bg-primary rounded-circle mr-2 mt-2" data-toggle="tooltip" data-placement="top" title="alert"><i class="icon-info text-white"></i></div>
            Guru dapat mengubah dan menambahkan materi pembelajaran, latihan dan ulangan.
        </div>
    </div>
    <div class="py-3">
        <h5 class="color-blue-2 font-weight-bold text-capitalize">daftar ulasan</h5>
        <a class="color-black font-weight-bold">Terdapat <span class="color-blue-2">1</span> Ulasan!</a>
        <div class="mt-3">
            <a href="{{ url('/subject/'.'matematika'.'/course/'.'1'.'/topic/'.'1'.'/detail/content/'.'1') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">materi bentuk-bentuk aljabar</p>
                </div>
            </a>
        </div>
        <div class="mt-3 pl-3">
            <a href="#" class="mt-3 color-blue-2" data-toggle="modal" data-target="#modal-add-content">+ Tambah Ulasan</a>
        </div>
    </div>
    <hr class="bg-dark">
    <div class="py-3">
        <h5 class="color-blue-2 font-weight-bold text-capitalize">daftar latihan</h5>
        <a class="color-black font-weight-bold">Terdapat <span class="color-blue-2">1</span> Latihan!</a>
        <div class="mt-3">
            <a href="" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">latihan bentuk-bentuk aljabar</p>
                </div>
            </a>
        </div>
        <div class="mt-3 pl-3">
            <a href="#" class="mt-3 color-blue-2" data-toggle="modal" data-target="#modal-add-activity">+ Tambah Latihan</a>
        </div>
    </div>
    <hr class="bg-dark">
    <div class="py-3">
        <h5 class="color-blue-2 font-weight-bold text-capitalize">daftar ulangan</h5>
        <a class="color-black font-weight-bold">Terdapat <span class="color-blue-2">1</span> Ulangan!</a>
        <div class="mt-3">
            <a href="" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">ulangan bentuk-bentuk aljabar</p>
                </div>
            </a>
        </div>
        <div class="mt-3 pl-3">
            <a href="#" class="mt-3 color-blue-2" data-toggle="modal" data-target="#modal-add-exam">+ Tambah Ulangan</a>
        </div>
    </div>
</div>
@include('layouts.teacher._modal_add_content')
@include('layouts.teacher._modal_add_activity')
@include('layouts.teacher._modal_add_exam')
@endsection

@section('script')
@endsection