@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12">
            <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Progress Siswa</h1>
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
@endsection

@section('script')
    <script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        let user = {!! json_encode($user) !!};


        $("#loading-course").show('fast');
        $("#render-course").hide('fast');

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
                    teacher_id:user.id
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

            $.each(data, function (key, subject) { 
                html += `
                <div class="row-clearfix mt-5">
                    <h5 class="color-blue-2 font-weight-bold text-uppercase">${subject.name}</h5>
                    <div class="d-flex justify-content-between mt-3 align-items-end font-weight-bold">
                        <a class="color-black">Terdapat <span class="color-blue-2">${subject.count_course}</span> Materi!</a>
                        <a href="{{ url('progress/subject/${subject.id}/course') }}" class="color-blue-2">Lihat Semua <i class="fa fa-chevron-right color-blue-2 font-12"></i></a>
                    </div>`
                    $.each(subject.courses, function (key, course) { 
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
            });

            $("#render-course").html(html);
            $("#loading-course").hide('fast');
            $("#render-course").show('fast');
        }
        
    </script>
@endsection