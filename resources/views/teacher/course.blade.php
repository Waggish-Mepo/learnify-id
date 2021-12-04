@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ route('dashboard') }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Bab</li>
                </ol>
            </nav>
        </div>
    </div>

    <div id="render-topic" style="display: none;">
        
    </div>

    <div class="" id="loading-topic" style="display: none;">
        <div class="row-clearfix mt-5">
            <h5 class="color-blue-2 font-weight-bold text-uppercase">........</h5>
            <div class="d-flex justify-content-between mt-3 align-items-end font-weight-bold">
                <a class="color-black">Terdapat <span class="color-blue-2">...</span> Bab!</a>
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
@include('layouts.teacher._modal_add_topic')
@endsection

@section('script')
<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script text="text/javascript">
    let user = {!! json_encode(Auth::user()) !!};
    let subject = {!! json_encode($subject) !!};
    let course = {!! json_encode($course) !!};


    $("#loading-course").show('fast');
    $("#render-course").hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    getCourseTopic()
    function getCourseTopic() {
        url = "{{ url('/subject/course/topic') }}"

        $.ajax({
            type: "get",
            url: url,
            data: {
                teacher_id:user.id,
                subject_id:subject.id,
                course_id:course.id
            },
            success: function (response) {
                renderCourseTopic(response);
            }, 
            error: function (e) {
                swal('Gagal Mengambil Data !')
            }
        });
    }
    
    function renderCourseTopic(data) {
        let html = ``

            html += `
            <div class="row-clearfix mt-5">
                <h5 class="color-blue-2 font-weight-bold text-uppercase">${subject.name} | ${course.description}</h5>
                <div class="d-flex justify-content-between mt-3 align-items-end font-weight-bold">
                    <a class="color-black">Terdapat <span class="color-blue-2">${data.total}</span> Materi!</a>
                </div>`
                $.each(data.data, function (key, topic) { 
                    html += `
                    <div class="mt-3">
                        <a href="{{ url('subject/${subject.id}/course/${course.id}/topic/${topic.id}') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-notebook"></i></div>
                            <div class="ml-3">
                            <p class="text-dark text-uppercase text-dark pt-3">${topic.name}</p>
                            </div>
                        </a>
                    </div>
                    `
                });
            html +=`</div>
            `

        html += `
        <div class="mt-4 pl-3">
            <a href="#" class="mt-3 color-blue-2" data-toggle="modal" data-target="#modal-add-topic">+ Tambah Bab</a>
        </div>
        `

        $("#render-topic").html(html);
        $("#loading-topic").hide('fast');
        $("#render-topic").show('fast');
    }

    function createCourseTopic() {
        name = $("input[type=text][name=name]").val();
        button = $("#btn-create")
        
        if (name === '') {
            swal('Nama materi harus diisi !')
        } else {
            $.ajax({
                type: "post",
                url: "{{ url('subject/course/topic') }}",
                data: {
                    subject_id:subject.id,
                    course_id:course.id,
                    name,
                },
                beforeSend: function () {
                    button.html('Menyimpan...')
                },
                success: function (response) {
                    button.html('Tambah')
                    $("#modal-add-topic").modal('hide')
                    resetValue()
                    getCourseTopic()
                    swal('Berhasil menyimpan materi !')
                },
                error: function (e) {
                    button.html('Tambah')
                    swal('Gagal menyimpan materi. Silahkan coba lagi !')
                }
            });
        }
    }

    function resetValue() {
        $("input[type=text][name=name]").val('');
    }
</script>
@endsection