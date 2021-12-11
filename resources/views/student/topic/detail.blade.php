@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ url('/student/subject/'.$subject['id'].'/course/'.$course['id'].'/topic') }}" class="text-white"><i class="icon-arrow-left text-white mr-2"></i>Kembali</a>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="{{ route('dashboard') }}">Daftar Pelajaran</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/student/subject/'.$subject['id'].'/course/') }}">List Materi</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/student/subject/'.$subject['id'].'/course/'.$course['id'].'/topic') }}">List Bab</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Detail</li>
                </ol>
            </nav>
            <h5 class="text-white font-weight-bold text-capitalize mt-2">{{ $subject['name'] }} | {{ $course['description'] }} | {{ $topic['name'] }}</h5>
        </div>
    </div>
    <div class="pb-3">
        <h5 class="color-black font-weight-bold text-capitalize">daftar ulasan</h5>
        <div id="render-content" style="display: none;">

        </div>
        <div id="loading-content" style="display: none;">
            <a class="color-black font-weight-bold">Terdapat <span class="text-white">...</span> Ulasan!</a>
            <div class="mt-3">
                <a href="javascript:void(0)" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                    <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                    <div class="ml-3">
                    <p class="text-dark text-uppercase text-dark pt-3">...</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <hr class="bg-white">
    <div class="pb-3">
        <div id="render-exercise" style="display: none;">
        </div>

        <div id="loading-exercise" style="display: none;">
            <div class="row-clearfix mt-5">
                <h5 class="color-black font-weight-bold text-capitalize">...</h5>
                <a class="color-black font-weight-bold">Terdapat <span class="text-white">...</span> Latihan!</a>
                <div class="mt-3">
                    <a href="" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                        <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="fa fa-puzzle-piece text-white"></i></div>
                        <div class="ml-3">
                        <p class="text-dark text-uppercase text-dark pt-3">...</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr class="bg-white">
    <div class="pb-3">
        <div id="render-exam" style="display: none;">
        </div>

        <div id="loading-exam" style="display: none;">
            <div class="row-clearfix mt-5">
                <h5 class="color-blue-2 font-weight-bold text-capitalize">.........</h5>
                <a class="color-black font-weight-bold">Terdapat <span class="color-blue-2">...</span> Ulangan!</a>
                <div class="mt-3">
                    <a href="javascript::void(0)" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                        <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                        <div class="ml-3">
                        <p class="text-dark text-uppercase text-dark pt-3">.........</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/pages/custom.js')}}"></script>
<script type="text/javascript">
    let subject = {!! json_encode($subject) !!}
    let course = {!! json_encode($course) !!}
    let topic = {!! json_encode($topic) !!}

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#loading-content").show('fast');
    $("#render-content").hide('fast');
    $('#loading-exam').show('fast');
    $('#loading-exercise').show('fast');

    getContent()
    getActivity()

    function getContent() {
        url = "{{ url('/student/subject/course/topic/content') }}"

        $.ajax({
            type: "get",
            url: url,
            data: {
                topic_id:topic.id,
            },
            success: function (response) {
                renderContent(response)
            },
            error: function (e) {
                swal('Gagal Mengambil Data !')
            }
        });
    }

    function renderContent(data) {
        let html = ``
        let menuContent = ``

        html += `
            <a class="color-black font-weight-bold">Terdapat <span class="text-white">${data.total}</span> Ulasan!</a>
        `
        $.each(data.data, function (key, content) {
            html += `
            <div class="mt-3">
                <a href="{{ url('/student/subject/${subject.id}/course/${course.id}/topic/${topic.id}/content/${content.id}') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                    <div class="d-flex align-items-center justify-content-center w35 rounded-circle cursor-pointer ml-2 ${content.content_result !== null ? 'bg-grey-1' : 'bg-blue-2'}" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                    <div class="ml-3">
                    <p class="text-dark text-uppercase text-dark pt-3">${content.name}</p>
                    </div>
                </a>
            </div>
            `
            menuContent += `
            <a href="{{url('/student/subject/${subject.id}/course/${course.id}/topic/${topic.id}/content/${content.id}')}}" class="text-capitalize"><span>${content.name}</span></a>
            `
        });

        $("#render-content").html(html);
        $("#menu-content").html(menuContent);
        $("#loading-content").hide('fast');
        $("#render-content").show('fast');
    }

    function getActivity() {
        url = "{{ url('/student/subject/course/topic/activity') }}"

        $.ajax({
            type: "get",
            url: url,
            data: {
                topic_id:topic.id,
            },
            success: function (response) {
                renderActivity(response);
            },
            error: function (e) {
                swal('Gagal Mengambil Data !')
            }
        });
    }

    function renderActivity(data) {
        let htmlExerciseMain = ``
        let htmlExercise = ``
        let htmlExam = ``
        let htmlExamMain = ``

        $.each(data.EXAM, function (key, exam) {
            htmlExam += `
            <div class="mt-3">
                <a href="javascript:void(0)" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover" onclick="confirmExam('${exam.id}', '${exam.name}', ${exam.activity_result !== null ? true : false})">
                    <div class="d-flex align-items-center justify-content-center w35 ${exam.activity_result !== null ? 'bg-green' : 'bg-blue-2'} rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="fa fa-puzzle-piece text-white"></i></div>
                    <div class="ml-3">
                    <p class="text-uppercase pt-3 text-dark">${exam.name}</p>
                    </div>
                </a>
            </div>
            `
        });

        $.each(data.EXERCISE, function (key, exercise) {
            htmlExercise += `
            <div class="mt-3">
                <a href="{{ url('/student/subject/${subject.id}/course/${course.id}/topic/${topic.id}/activity/${exercise.id}') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                    <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="fa fa-puzzle-piece text-white"></i></div>
                    <div class="ml-3">
                    <p class="text-dark text-uppercase text-dark pt-3">${exercise.name}</p>
                    </div>
                </a>
            </div>
            `
        });


        htmlExerciseMain = `
            <h5 class="color-black font-weight-bold text-capitalize">daftar latihan</h5>
            <a class="color-black font-weight-bold">Terdapat <span class="text-white">${data.total_exercise}</span> Latihan!</a>
            ${htmlExercise}
        `

        htmlExamMain = `
            <h5 class="color-black font-weight-bold text-capitalize">daftar ulangan</h5>
            <a class="color-black font-weight-bold">Terdapat <span class="text-white">${data.total_exam}</span> Ulangan!</a>
            ${htmlExam}
        `

        $('#render-exam').html(htmlExamMain);
        $('#render-exercise').html(htmlExerciseMain);
        $('#render-exercise').show('fast');
        $('#render-exam').show('fast');
        $('#loading-exam').hide('fast');
        $('#loading-exercise').hide('fast');
    }

    function confirmExam(activityId, name, finish) {
        if (finish === true) {
            swal(`Anda sudah mengerjakan ulangan ${name}!`)
        } else {
            swal({
                title: `Mulai Ulangan ${name}?`,
                confirmButtonText: "Ya !",
                cancelButtonText: "Tidak !",
                closeOnConfirm: false,
                showCancelButton: true,
            }, function () {
                window.location.href = `{{ url('/student/subject/${subject.id}/course/${course.id}/topic/${topic.id}/activity/${activityId}') }}`
            });
        }
    }

</script>
@endsection
