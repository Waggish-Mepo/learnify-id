@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ url('/student/subject/'.$subject['id'].'/course/') }}" class="text-white"><i class="icon-arrow-left text-white mr-2"></i>Kembali</a>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="{{ route('dashboard') }}">Daftar Pelajaran</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{ url('/student/subject/'.$subject['id'].'/course/') }}">List Materi</a></li>
                <li class="breadcrumb-item active text-dark" aria-current="page">List Bab</li>
                </ol>
            </nav>
            <h5 class="text-white font-weight-bold text-capitalize mt-2">{{ $subject['name'] }} | {{ $course['description'] }}</h5>
        </div>
    </div>

    <div id="render-topic" style="display: none;">
        
    </div>

    <div id="loading-topic" style="display: none;">
        <a class="color-black font-weight-bold pt-3">Terdapat <span class="text-white">...</span> Latihan!</a>
        <div class="mt-3">
            <a href="javascript:void(0)" class="d-flex align-items-center justify-content-between p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="bab"><i class="icon-book-open text-white"></i></div>
                    <div class="ml-3">
                        <p class="text-dark text-uppercase pt-3">...</p>
                    </div>
                </div>
                <div class="img-roket"><img src="{{asset('assets/images/roket.svg')}}" width="35"></div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/pages/custom.js')}}"></script>
<script type="text/javascript">
    let subject = {!! json_encode($subject) !!}
    let course = {!! json_encode($course) !!}

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    getTopic()

    $("#loading-topic").show('fast');
    $("#render-topic").hide('fast');


    function getTopic() {
        let url = "{{ url('student/subject/course/topic') }}"
        $.ajax({
            type: "get",
            url: url,
            data: {
                subject_id:subject.id,
                course_id:course.id
            },
            success: function (response) {
                renderTopic(response);
            }, 
            error: function (e) {
                swal('Gagal Mengambil Data !')
            }
        });
    }

    function renderTopic(data) {
        let html = `<a class="color-black font-weight-bold pt-3">Terdapat <span class="text-white">${data.total}</span> Bab!</a>`

        $.each(data.data, function (key, topic) { 
            html += `
            <div class="mt-3">
                <a href="{{ url('/student/subject/${subject.id}/course/${course.id}/topic/${topic.id}') }}" class="d-flex align-items-center justify-content-between p-2 w-100 bg-white shadow-sm rounded border-hover">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="bab"><i class="icon-book-open text-white"></i></div>
                        <div class="ml-3">
                            <p class="text-dark text-uppercase pt-3">${topic.name}</p>
                        </div>
                    </div>
                    <div class="img-roket"><img src="{{asset('assets/images/roket.svg')}}" width="35"></div>
                </a>
            </div>
            `
        });

        $("#render-topic").html(html);
        $("#loading-topic").hide('fast');
        $("#render-topic").show('fast');
    }
</script>
@endsection