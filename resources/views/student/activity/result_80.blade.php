@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="m-auto pt-5 result m-auto">
        <div class="p-4 bg-white shadow-sm rounded">
            <img src="{{asset('assets/images/result_b.svg')}}" alt="B" class="d-block m-auto">
            <h5 class="color-black font-weight-bold text-capitalize text-center mt-3 mb-2">keren!</h5>
            <p class="h2 color-blue-2 font-weight-bold text-capitalize text-center mb-2">80</p>
            <div class="d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded cursor-pointer" data-toggle="tooltip" data-placement="top" title="XP"><span class="text-white font-weight-bold">XP</span></div>
                <div class="ml-1 text-dark">+8 XP</div>
            </div>
            <p class="text-dark my-2 text-center">Kamu berhasil menjawab soal dengan benar!</p>
            <div class="d-flex mt-3 align-items-center">
                <div class="m-auto">
                <a href="#" class="btn bg-blue-2 color-black font-weight-bold mr-2 opacity-50">Ulangi</a>
                <a href="#" class="btn bg-blue-2 text-white font-weight-bold">Selesai</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection