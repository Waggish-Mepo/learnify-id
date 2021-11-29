@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-2">
        <div class="col-md-6 col-sm-12">
            <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Dashboard</h1>
        </div>
    </div>
    <div class="row-clearfix mt-3">
        <h5 class="color-blue-2 font-weight-bold text-uppercase">matematika | xii</h5>
        <div class="d-flex justify-content-between mt-3 align-items-end font-weight-bold">
            <a class="color-black">Terdapat <span class="color-blue-2">100</span> Materi!</a>
            <a href="{{ route('teacher.subject', ['subject_id' => 'matematika']) }}" class="color-blue-2">Lihat Semua</a>
        </div>
        <div class="mt-3">
            <a href="{{ route('teacher.subject.course', ['subject_id' => 'matematika','course_id' => 1]) }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">matematika | aljabar</p>
                </div>
            </a>
        </div>
        <div class="mt-3">
            <a href="{{ route('teacher.subject.course', ['subject_id' => 'matematika','course_id' => 1]) }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">matematika | logaritma</p>
                </div>
            </a>
        </div>
    </div>
    <div class="row-clearfix mt-5">
        <h5 class="color-blue-2 font-weight-bold text-uppercase">bahasa indonesia | xii</h5>
        <div class="d-flex justify-content-between mt-3 align-items-end font-weight-bold">
            <a class="color-black">Terdapat <span class="color-blue-2">50</span> Materi!</a>
            <a href="{{ route('teacher.subject', ['subject_id' => 'bahasa_indonesia']) }}" class="color-blue-2">Lihat Semua</a>
        </div>
        <div class="mt-3">
            <a href="{{ route('teacher.subject.course', ['subject_id' => 'bahasa_indonesia','course_id' => 2]) }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">bahasa indonesia | puisi</p>
                </div>
            </a>
        </div>
        <div class="mt-3">
            <a href="{{ route('teacher.subject.course', ['subject_id' => 'bahasa_indonesia','course_id' => 2]) }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">bahasa indonesia | cerpen</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection