@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ route('dashboard') }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Bab</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row-clearfix">
        <h5 class="color-blue-2 font-weight-bold text-uppercase">matematika | aljabar</h5>
        <a class="color-black font-weight-bold">Terdapat <span class="color-blue-2">10</span> Bab!</a>
        <div class="mt-3">
            <a href="" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">bentuk-bentuk aljabar</p>
                </div>
            </a>
        </div>
        <div class="mt-3">
            <a href="{{ route('subject.course') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">sifat-sifat aljabar</p>
                </div>
            </a>
        </div>
        <div class="mt-3">
            <a href="{{ route('subject.course') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">contoh soal aljabar</p>
                </div>
            </a>
        </div>
        <div class="mt-4 pl-3">
            <a href="#" class="mt-3 color-blue-2">+ Tambah Bab</a>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection