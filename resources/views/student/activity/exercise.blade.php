@extends('layouts.app')

@section('content')
<div class="block-header px-4" id="render-question">
</div>
<div class="block-header" id="score-under-60" style="display: none;">
    <div class="m-auto pt-5 result m-auto">
        <div class="p-4 bg-white shadow-sm rounded">
            <img src="{{asset('assets/images/result_c.svg')}}" alt="C" class="d-block m-auto">
            <h5 class="color-black font-weight-bold text-capitalize text-center mt-3 mb-2">yahh!</h5>
            <p class="h2 color-blue-2 font-weight-bold text-capitalize text-center mb-2 result-score">60</p>
            <div class="d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded cursor-pointer" data-toggle="tooltip" data-placement="top" title="XP"><span class="text-white font-weight-bold">XP</span></div>
                <div class="ml-1 text-dark">+<span class="gained-xp"></span> XP</div>
            </div>
            <p class="text-dark my-2 text-center">Semangat, ya! Coba lagi yuk.</p>
            <div class="d-flex mt-3 align-items-center">
                <div class="m-auto">
                <a href="" class="btn btn-repeat bg-blue-2 color-black font-weight-bold mr-2 opacity-50">Ulangi</a>
                <a href="{{ url('student/subject/'.$subjectId.'/course/'.$courseId.'/topic/'.$topic['id']) }}" class="btn bg-blue-2 text-white font-weight-bold">Selesai</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block-header" id="score-under-80" style="display: none;">
    <div class="m-auto pt-5 result m-auto">
        <div class="p-4 bg-white shadow-sm rounded">
            <img src="{{asset('assets/images/result_b.svg')}}" alt="B" class="d-block m-auto">
            <h5 class="color-black font-weight-bold text-capitalize text-center mt-3 mb-2">keren!</h5>
            <p class="h2 color-blue-2 font-weight-bold text-capitalize text-center mb-2 result-score">80</p>
            <div class="d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded cursor-pointer" data-toggle="tooltip" data-placement="top" title="XP"><span class="text-white font-weight-bold">XP</span></div>
                <div class="ml-1 text-dark">+<span class="gained-xp"></span> XP</div>
            </div>
            <p class="text-dark my-2 text-center">Kamu berhasil menjawab soal dengan benar!</p>
            <div class="d-flex mt-3 align-items-center">
                <div class="m-auto">
                <a href="" class="btn btn-repeat bg-blue-2 color-black font-weight-bold mr-2 opacity-50">Ulangi</a>
                <a href="{{url('student/subject/'.$subjectId.'/course/'.$courseId.'/topic/'.$topic['id'])}}" class="btn bg-blue-2 text-white font-weight-bold">Selesai</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block-header" id="score-under-100" style="display: none;">
    <div class="m-auto pt-5 result m-auto">
        <div class="p-4 bg-white shadow-sm rounded">
            <img src="{{asset('assets/images/result_a.svg')}}" alt="A" class="d-block m-auto">
            <h5 class="color-black font-weight-bold text-capitalize text-center mt-3 mb-2">waw!</h5>
            <p class="h2 color-blue-2 font-weight-bold text-capitalize text-center mb-2 result-score">100</p>
            <div class="d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded cursor-pointer" data-toggle="tooltip" data-placement="top" title="XP"><span class="text-white font-weight-bold">XP</span></div>
                <div class="ml-1 text-dark">+<span class="gained-xp"></span> XP</div>
            </div>
            <p class="text-dark my-2 text-center">Kamu berhasil menjawab soal dengan benar!</p>
            <div class="d-flex mt-3 align-items-center">
                <div class="m-auto">
                <a href="" class="btn btn-repeat bg-blue-2 color-black font-weight-bold mr-2 opacity-50">Ulangi</a>
                <a href="{{url('student/subject/'.$subjectId.'/course/'.$courseId.'/topic/'.$topic['id'])}}" class="btn bg-blue-2 text-white font-weight-bold">Selesai</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    let topic = {!! json_encode($topic) !!}
    let activity = {!! json_encode($activity) !!}
    let user = {!! json_encode($user) !!}
    let answerSet = {}
    let answeres = {}
    let choices = {}
    let totalQuestion = 0

    console.log(activity);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    getQuestion()
    function getQuestion() {
        let url = "{{ url('/student/subject/course/topic/activity/question') }}"

        $.ajax({
            type: "post",
            url: url,
            data: {
                activity_id:activity.id,
                user_id:user.id
            },
            success: function (response) {
                totalQuestion = response.total
                renderQuestion(response)
            }
        });
    }

    function renderQuestion(data) {
        let html = ``

        $.each(data.data, function (key, question) {
            answeres[question.id] = question.answer
            choices[question.id] = question.choices
            html += `
            <div id="question-${question.id}" style="${key + 1 === 1 ? '' : 'display:none;'}">
            <div class="d-flex flex-column m-auto pt-5">
                <h3 class="text-capitalize text-white text-center">{{ $topic['name'] }} | {{ $activity['name'] }}</h3>
                <div class="h-auto p-4 mt-3 w-100 bg-white shadow-sm rounded">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <a href="{{ url('student/subject/'.$subjectId.'/course/'.$courseId.'/topic/'.$topic['id']) }}" class="color-blue-2 d-flex align-items-center js-sweetalert" data-type="confirm-back" data-toggle="tooltip" title="Kembali">
                                <i class="fa fa-sign-out"></i>
                                <span class="ml-1">Keluar</span>
                            </a>
                        </div>
                        <div>
                            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 text-white" data-toggle="tooltip" data-placement="top" title="materi"><span class="font-weight-bold">${key + 1}</span>/${data.total}</div>
                        </div>
                    </div>
                    <div class="py-2 w-sm-50 w-100 m-auto">
                        <p class="text-center color-black font-18">
                            ${question.question}
                        </p>
                    </div>
                </div>
            </div>
            <div class="my-4" id="choice-${question.id}">`
                $.each(question.choices, function (keyChoice, choice) {
                    html += `
                    <div class="mt-2" id="answer-${question.id}-${keyChoice}">
                        <a href="javascript:void(0)" class="d-flex align-items-center p-1 font-12 w-100 bg-white shadow rounded border-hover" onclick="setAnswer('${keyChoice}', '${question.id}')">
                        <div class="choice d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2 opacity-50 color-black font-weight-bold">${keyChoice}</div>
                        <div class="ml-3">
                            <p class="text-dark text-capilatize pt-3">${choice}</p>
                        </div>
                        </a>
                    </div>
                    `
                });
            html += `</div>`
            if (key === 0 && data.total === 1) {
                html += `
                <div class="d-flex">
                    <a href="javascript:void(0)" class="btn btn-light shadow rounded disabled"><i class="fa fa-chevron-left mr-2"></i>Sebelumnya</a>
                    <a href="javascript:void(0)" class="btn btn-success shadow rounded ml-3" onclick="collectQuestion()">Kumpulkan<i class="fa fa-chevron-right ml-2"></i></a>
                </div>
                `
            } else if (key === 0) {
                html += `
                <div class="d-flex">
                    <a href="javascript:void(0)" class="btn btn-light shadow rounded disabled"><i class="fa fa-chevron-left mr-2"></i>Sebelumnya</a>
                    <a href="javascript:void(0)" class="btn btn-light shadow rounded ml-3" onclick="nextQuestion('${question.id}', '${data.data[key + 1].id}')">Selanjutnya<i class="fa fa-chevron-right ml-2"></i></a>
                </div>
                `
            } else if (key === (data.total - 1)) {
                html += `
                <div class="d-flex">
                    <a href="javascript:void(0)" class="btn btn-light shadow rounded" onclick="prevQuestion('${question.id}', '${data.data[key - 1].id}')"><i class="fa fa-chevron-left mr-2"></i>Sebelumnya</a>
                    <a href="javascript:void(0)" class="btn btn-success shadow rounded ml-3" onclick="collectQuestion()">Kumpulkan<i class="fa fa-chevron-right ml-2"></i></a>
                </div>
                `
            } else {
                html += `
                <div class="d-flex">
                    <a href="javascript:void(0)" class="btn btn-light shadow rounded" onclick="prevQuestion('${question.id}', '${data.data[key - 1].id}')"><i class="fa fa-chevron-left mr-2"></i>Sebelumnya</a>
                    <a href="javascript:void(0)" class="btn btn-light shadow rounded ml-3" onclick="nextQuestion('${question.id}', '${data.data[key + 1].id}')">Selanjutnya<i class="fa fa-chevron-right ml-2"></i></a>
                </div>
                `
            }

            html += `</div>`
        });


        $("#render-question").html(html);
    }

    function nextQuestion(currentId, nextId) {
        $(`#question-${currentId}`).hide('fast');
        $(`#question-${nextId}`).show('fast');
    }

    function prevQuestion(currentId, prevId) {
        $(`#question-${currentId}`).hide('fast');
        $(`#question-${prevId}`).show('fast');
    }

    function setAnswer(answer, questionId) {
        let choiceTotal = $(`#choice-${questionId}`).children()
        let currentChoice = choices[questionId]
        $.each(currentChoice, function (key, choice) {
            $(`#answer-${questionId}-${key} .choice`).removeClass('bg-orange-1').addClass('bg-blue-2')
        });

        $(`#answer-${questionId}-${answer} .choice`).addClass('bg-orange-1').removeClass('bg-blue-2')
        answerSet[questionId] = answer
    }

    function collectQuestion() {
        let totalAnswer = Object.keys(answerSet).length

        if (totalAnswer === totalQuestion) {
            sendAnswer()
        } else {
        swal({
            title: `Ada beberapa soal yang belum diisi apakah anda yakin ingin mengumpulkan?`,
            confirmButtonText: "Ya !",
            cancelButtonText: "Tidak !",
            closeOnConfirm: false,
            showCancelButton: true,
        }, function () {
            sendAnswer()
        });
        }
    }

    function sendAnswer() {
        let url = "{{ url('/student/subject/course/topic/activity/finish') }}"
        let totalCorrectAnswer = 0

        $.each(answeres, function (questionId, thisAnswer) {
            if (answerSet[questionId] == undefined) {
                totalCorrectAnswer += 0
            } else {
                if (answerSet[questionId] === thisAnswer) {
                    totalCorrectAnswer += 1
                } else {
                    totalCorrectAnswer += 0
                }
            }
        });

        $.ajax({
            type: "post",
            url: url,
            data: {
                total_question:totalQuestion,
                correct_answer:totalCorrectAnswer,
                activity_id:activity.id,
                student_id:user.id
            },
            success: function (response) {
                if (response.score <= 60) {
                    $("#render-question").hide();
                    if(activity.type === 'EXAM') {
                        $('.btn-repeat').addClass('d-none');
                    } else {
                        $('.btn-repeat').removeClass('d-none');
                    }
                    $("#score-under-60").show();
                } else if (response.score > 60 && response.score <= 80) {
                    $("#render-question").hide();
                    if(activity.type === 'EXAM') {
                        $('.btn-repeat').addClass('d-none');
                    } else {
                        $('.btn-repeat').removeClass('d-none');
                    }
                    $("#score-under-80").show();
                } else if (response.score > 80 && response.score <= 100) {
                    $("#render-question").hide();
                    if(activity.type === 'EXAM') {
                        $('.btn-repeat').addClass('d-none');
                    } else {
                        $('.btn-repeat').removeClass('d-none');
                    }
                    $("#score-under-100").show();
                }
                $('.result-score').html(response.score);
                $('.gained-xp').html(response.experience);
            },
            error: function (e) {
                swal('Gagal mengirim soal, silahkan coba lagi!');
                backupAnswer()
            }
        });
    }

    function backupAnswer() {
        $.each(answerSet, function (questionId, thisAnswer) {
            setAnswer(thisAnswer, questionId)
        });
    }
</script>
@endsection
