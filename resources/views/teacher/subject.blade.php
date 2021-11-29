@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ route('dashboard') }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Learnify.id</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Materi</li>
                </ol>
            </nav>
        <h3 class="color-blue-2 font-weight-bold mt-3 text-uppercase" style="font-size: 1.8rem;">matematika</h3>
        </div>
    </div>
    <div class="row-clearfix">
        <p class="font-weight-bold">Terdapat <span class="color-blue-2">100</span> Materi!</p>
        <div class="mt-3">
            <div class="d-flex align-items-center p-3 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <a href="#" class="text-dark text-uppercase text-dark pt-3">matematika | aljabar</a>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div class="d-flex align-items-center p-3 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <a href="#" class="text-dark text-uppercase text-dark pt-3">matematika | logaritma</a>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div class="d-flex align-items-center p-3 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <a href="#" class="text-dark text-uppercase text-dark pt-3">matematika | bilbul</a>
                </div>
            </div>
        </div>
        <div class="mt-4 pl-3">
            <a href="#" class="mt-3 color-blue-2">+ Tambah Materi</a>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection