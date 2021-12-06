@extends('layouts.app')

@section('content')
<div class="block-header px-4">
    <div class="d-flex flex-column m-auto pt-5">
        <h3 class="text-capitalize text-white text-center">materi bentuk-bentuk aljabar | latihan minggu 1</h3>
        <div class="h-auto p-4 mt-3 w-100 bg-white shadow-sm rounded">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 text-white" data-toggle="tooltip" data-placement="top" title="materi"><span class="font-weight-bold">3</span>/3</div>
                </div>
                <div>
                    <a href="#" class="color-blue-2 d-flex align-items-center js-sweetalert" data-type="confirm-back" data-toggle="tooltip" title="Kembali">
                        <i class="fa fa-sign-out"></i>
                        <span class="ml-1">Kembali</span>
                    </a>
                </div>
            </div>
            <div class="py-2 w-50 m-auto">
                <img src="{{asset('assets/images/result_a.svg')}}" width="150" class="d-block m-auto">
                <p class="text-center color-black font-18">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem in eius similique odio quasi laborum quos ipsum incidunt adipisci temporibus! Lorem ipsum dolor sit amet...</p>
            </div>
        </div>
    </div>
    <div class="my-4">
        <div class="mt-2">
            <a href="" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-hover">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">A</div>
            <div class="ml-3">
                <p class="text-dark text-capilatize pt-3">Lorem ipsum dolor sit amet.</p>
            </div>
            </a>
        </div>
        <div class="mt-2">
            <a href="" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-hover">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">B</div>
            <div class="ml-3">
                <p class="text-dark text-capilatize pt-3">Lorem ipsum.</p>
            </div>
            </a>
        </div>
        <div class="mt-2">
            <a href="" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-hover">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">C</div>
            <div class="ml-3">
                <p class="text-dark text-capilatize pt-3">Lorem ipsum dolor.</p>
            </div>
            </a>
        </div>
        <div class="mt-2">
            <a href="" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-hover">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">D</div>
            <div class="ml-3">
                <p class="text-dark text-capilatize pt-3">Lorem.</p>
            </div>
            </a>
        </div>
    </div>
    <div class="d-flex">
        <a href="{{ url('/student/subject/'.'matematika'.'/course/'.'1'.'/topic/'.'1'.'/activity/'.'1'.'/2') }}" class="btn btn-light shadow rounded"><i class="fa fa-chevron-left mr-2"></i>Sebelumnya</a>
        {{-- ini href nya buat testing ke soal selanjutnya. nnti index selanjutnya dr ini di hapus aja okeyy --}}
        <a href="" class="btn btn-success shadow rounded ml-3">Kumpulkan<i class="fa fa-chevron-right ml-2"></i></a>
    </div>
</div>
@endsection

@section('script')
@endsection