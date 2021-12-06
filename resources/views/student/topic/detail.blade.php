@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ url('/student/subject/'.'matematika'.'/course/') }}" class="text-white"><i class="icon-arrow-left text-white mr-2"></i>Kembali</a>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="{{ route('dashboard') }}">Daftar Pelajaran</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/student/subject/'.'matematika'.'/course/') }}">List Materi</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/student/subject/'.'matematika'.'/course/'.'1') }}">List Bab</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Detail</li>
                </ol>
            </nav>
            <h5 class="text-white font-weight-bold text-capitalize mt-2">bentuk-bentuk aljabar</h5>
        </div>
    </div>
    <div class="pb-3">
        <h5 class="color-black font-weight-bold text-capitalize">daftar ulasan</h5>
        <a class="color-black font-weight-bold">Terdapat <span class="text-white">1</span> Ulasan!</a>
        <div class="mt-3">
            <a href="{{ url('/student/subject/'.'matematika'.'/course/'.'1'.'/topic/'.'1'.'/content/'.'1') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">pengertian</p>
                </div>
            </a>
        </div>
    </div>
    <hr class="bg-white">
    <div class="pb-3">
        <h5 class="color-black font-weight-bold text-capitalize">latihan ulangan</h5>
        <a class="color-black font-weight-bold">Terdapat <span class="text-white">1</span> Latihan!</a>
        <div class="mt-3">
            <a href="{{ url('/student/subject/'.'matematika'.'/course/'.'1'.'/topic/'.'1'.'/activity/'.'1') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="fa fa-puzzle-piece text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">latihan minggu ke-1</p>
                </div>
            </a>
        </div>
    </div>
    <hr class="bg-white">
    <div class="pb-3">
        <h5 class="color-black font-weight-bold text-capitalize">daftar ulangan</h5>
        <a class="color-black font-weight-bold">Terdapat <span class="text-white">1</span> Ulangan!</a>
        <div class="mt-3">
            <a href="" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="fa fa-puzzle-piece text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">ulangan minggu ke-1</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection