@extends('layouts.app')

@section('content')
<div class="block-header px-4">
    <div class="d-flex flex-column m-auto pt-5">
        <h3 class="text-capitalize text-white text-center">materi bentuk-bentuk aljabar | latihan minggu 1</h3>
        <div class="h-auto p-4 mt-3 w-100 bg-white shadow-sm rounded">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <a href="#" class="color-blue-2 d-flex align-items-center js-sweetalert" data-type="confirm-back" data-toggle="tooltip" title="Kembali">
                        <i class="fa fa-sign-out"></i>
                        <span class="ml-1">Keluar</span>
                    </a>
                </div>
                <div>
                    <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 text-white" data-toggle="tooltip" data-placement="top" title="materi"><span class="font-weight-bold">1</span>/3</div>
                </div>
            </div>
            <div class="py-2 w-50 m-auto">
                <p id="question" class="text-center color-black font-18">
                </p>
            </div>
        </div>
    </div>
    <div class="my-4">
        <div class="mt-2">
            <a href="" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-hover">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">A</div>
            <div class="ml-3">
                <p id="answer-a" class="text-dark text-capilatize pt-3"></p>
            </div>
            </a>
        </div>
        <div class="mt-2">
            <a href="" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-hover">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">B</div>
            <div class="ml-3">
                <p id="answer-b" class="text-dark text-capilatize pt-3"></p>
            </div>
            </a>
        </div>
        <div class="mt-2">
            <a href="" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-hover">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">C</div>
            <div class="ml-3">
                <p id="answer-c" class="text-dark text-capilatize pt-3"></p>
            </div>
            </a>
        </div>
        <div class="mt-2">
            <a href="" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-hover">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">D</div>
            <div class="ml-3">
                <p id="answer-d" class="text-dark text-capilatize pt-3"></p>
            </div>
            </a>
        </div>
    </div>
    <div class="d-flex">
        <a href="#" class="btn btn-light shadow rounded disabled"><i class="fa fa-chevron-left mr-2"></i>Sebelumnya</a>
        <button onclick="nextQuestion((indexQuestion + 1), question)" class="btn btn-light shadow rounded ml-3">Selanjutnya<i class="fa fa-chevron-right ml-2"></i></button>
    </div>
</div>
@endsection

@section('script')
<script>
    let activity = `{!! $activity !!}`;
    let questions = {};
    let answer = {};
    let indexQuestion = 0;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    getQuestion()
    function getQuestion() {
        let url = `{{ url('student/subject/course/topic/question') }}`

        $.ajax({
            type: "get",
            url: url,
            data: {
                activity_id:activity.id,
            },
            success: function (response) {
                // questions = response.data
                question = response.data;
                renderQuestion(0, question);
                console.log(question);
            }, 
            error: function (e) {
                swal('Gagal Mengambil Data !')
            }
        });
    }

    function renderQuestion(index, data) {
        indexQuestion = index;
        $('#question').html(data[index]['question']);
        $('#answer-a').html(data[index]['choices']['A']);
        $('#answer-b').html(data[index]['choices']['B']);
        $('#answer-c').html(data[index]['choices']['C']);
        $('#answer-d').html(data[index]['choices']['D']);
    }

    function nextQuestion(index, data) {
        renderQuestion(index, question);
    }

    function previousQuestion(index, data) {

    }
</script>
@endsection