@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ route('teacher.progress-siswa') }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher.progress-siswa') }}">Progress Siswa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Materi</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div id="render-course" style="display: none;">
        
    </div>

    <div class="" id="loading-course" style="display: none;">
        <div class="row-clearfix mt-5">
            <h5 class="color-blue-2 font-weight-bold text-uppercase">........</h5>
            <div class="d-flex justify-content-between mt-3 align-items-end font-weight-bold">
                <a class="color-black">Terdapat <span class="color-blue-2">...</span> Materi!</a>
                <a href="javascript::void(0)" class="color-blue-2">... <i class="fa fa-chevron-right color-blue-2 font-12"></i></a>
            </div>
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
@include('layouts.teacher._modal_add_course')
@endsection

@section('script')
<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script type="text/javascript">
    let user = {!! json_encode(Auth::user()) !!};
    let subject = {!! json_encode($subject) !!};


    $("#loading-course").show('fast');
    $("#render-course").hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    getCourse()
    function getCourse() {
        url = "{{ url('/progress/subject/course') }}"

        $.ajax({
            type: "get",
            url: url,
            data: {
                teacher_id:user.id,
                subject_id:subject.id
            },
            success: function (response) {
                renderCourse(response);
            }, 
            error: function (e) {
                swal('Gagal Mengambil Data !')
            }
        });
    }
    
    function renderCourse(data) {
        let html = ``

            html += `
            <div class="row-clearfix mt-5">
                <h5 class="color-blue-2 font-weight-bold text-uppercase">${subject.name}</h5>
                <div class="d-flex justify-content-between mt-3 align-items-end font-weight-bold">
                    <a class="color-black">Terdapat <span class="color-blue-2">${data.total}</span> Materi!</a>
                </div>`
                $.each(data.data, function (key, course) { 
                    html += `
                    <div class="mt-3">
                        <a href="{{ url('progress/subject/${subject.id}/course/${course.id}') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                            <div class="ml-3">
                            <p class="text-dark text-uppercase text-dark pt-3">${subject.name} Kelas ${course.grade} | ${course.description}</p>
                            </div>
                        </a>
                    </div>
                    `
                });
            html +=`</div>
            `

        $("#render-course").html(html);
        $("#loading-course").hide('fast');
        $("#render-course").show('fast');
    }
    
</script>
@endsection