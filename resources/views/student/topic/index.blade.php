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
                <li class="breadcrumb-item active text-dark" aria-current="page">List Bab</li>
                </ol>
            </nav>
            <h5 class="text-white font-weight-bold text-capitalize mt-2">matematika | aljabar</h5>
        </div>
    </div>
    <a class="color-black font-weight-bold pt-3">Terdapat <span class="text-white">2</span> Latihan!</a>
    <div class="mt-3">
        <a href="{{ url('/student/subject/'.'matematika'.'/course/'.'1'.'/detail') }}" class="d-flex align-items-center justify-content-between p-2 w-100 bg-white shadow-sm rounded border-hover">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="bab"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                    <p class="text-dark text-uppercase pt-3">bentuk-bentuk aljabar</p>
                </div>
            </div>
            <div class="img-roket"><img src="{{asset('assets/images/roket.svg')}}" width="35"></div>
        </a>
    </div>
    <div class="mt-3">
        <a href="" class="d-flex align-items-center justify-content-between p-2 w-100 bg-white shadow-sm rounded border-hover">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="bab"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                    <p class="text-dark text-uppercase pt-3">pengertian aljabar</p>
                </div>
            </div>
            <div class="img-roket"><img src="{{asset('assets/images/roket.svg')}}" width="35"></div>
        </a>
    </div>
</div>
@endsection

@section('script')
@endsection