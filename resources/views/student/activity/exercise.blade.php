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
                    <div id="index-q" class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 text-white" data-toggle="tooltip" data-placement="top" title="materi"></div>
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
            <button id="btn-answer-a" onclick="choiceAnswer(indexQuestion, 'a')" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-success border-white">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">A</div>
            <div class="ml-3">
                <p id="answer-a" class="text-dark text-capilatize pt-3"></p>
            </div>
            </button>
        </div>
        <div class="mt-2">
            <button id="btn-answer-b" onclick="choiceAnswer(indexQuestion, 'b')" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-success border-white">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">B</div>
            <div class="ml-3">
                <p id="answer-b" class="text-dark text-capilatize pt-3"></p>
            </div>
            </button>
        </div>
        <div class="mt-2">
            <button id="btn-answer-c" onclick="choiceAnswer(indexQuestion, 'c')" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-success border-white">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">C</div>
            <div class="ml-3">
                <p id="answer-c" class="text-dark text-capilatize pt-3"></p>
            </div>
            </but>
        </div>
        <div class="mt-2">
            <button id="btn-answer-d" onclick="choiceAnswer(indexQuestion, 'd')" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-success border-white">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">D</div>
            <div class="ml-3">
                <p id="answer-d" class="text-dark text-capilatize pt-3"></p>
            </div>
            </button>
        </div>
    </div>
    <div class="d-flex">
        <button id="previous-q" onclick="previousQuestion((indexQuestion - 1), questions)" class="btn btn-light shadow rounded disabled" disabled><i class="fa fa-chevron-left mr-2"></i>Sebelumnya</button>
        <button id="next-q" onclick="nextQuestion((indexQuestion + 1), questions)" class="btn btn-light shadow rounded ml-3">Selanjutnya<i class="fa fa-chevron-right ml-2"></i></button>
        <button id="submit-q" onclick="submitQuestion(answers)" class="btn btn-success shadow rounded ml-3 d-none">Kumpulkan<i class="fa fa-chevron-right ml-2"></i></button>
    </div>
</div>
@endsection

@section('script')
<script>
    let activity = `{!! $activity !!}`;
    let answers = [];
    let indexQuestion = 0;
    let selectedAnswer = '';

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
                questions = response.data;
                renderQuestion(0, questions);
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

        $('#index-q').html(`
        <span class="font-weight-bold">${indexQuestion + 1}</span>/${questions.length}
        `);
        $(`#btn-answer-${selectedAnswer}`).addClass('border-white');

        if (answers.some(({no}) => no === index)) {
            $(`#btn-answer-${answers[index]['answer'].toLowerCase()}`).removeClass('border-white');
            selectedAnswer = answers[index]['answer'].toLowerCase();
        }

        if (indexQuestion > 0) {
            $('#previous-q').removeClass('disabled');
            $('#previous-q').prop('disabled', false);

            if (indexQuestion === (questions.length - 1)) {
                $('#next-q').addClass('d-none');
                $('#submit-q').removeClass('d-none');
            }
        } else {
            $('#previous-q').addClass('disabled');
            $('#previous-q').prop('disabled', true);
        }
    }

    function choiceAnswer(index, answer) {
        $(`#btn-answer-${selectedAnswer}`).addClass('border-white');
        console.log(answers);

        if (answers.some(({no}) => no === index)) {
            answers[index]['answer'] = answer.toUpperCase();
            $(`#btn-answer-${answer}`).removeClass('border-white');
            selectedAnswer = answer;
        } else {
            answers.push({no: index, answer: answer.toUpperCase()});
        }
    }

    function nextQuestion(index, data) {
        renderQuestion(index, questions);
    }

    function previousQuestion(index, data) {
        renderQuestion(index, data);

        if (index !== (questions.length - 1)) {
            $('#next-q').removeClass('d-none');
            $('#submit-q').addClass('d-none');
        }
    }

    function submitQuestion() {
        let url = `{{ url('student/subject/course/topic/question/submit') }}`

        $.ajax({
            type: "get",
            url: url,
            data: {
                activity_id:activity.id,
                answers: answers,
            },
            success: function (response) {
                questions = response.data;
                renderQuestion(0, questions);
            }, 
            error: function (e) {
                swal('Gagal Mengambil Data !')
            }
        });
    }
</script>
@endsection