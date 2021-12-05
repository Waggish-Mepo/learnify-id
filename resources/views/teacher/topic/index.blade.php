@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ url('/subject/'. $subject_id .'/course/'. $course_id) }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/subject/'. $subject_id .'/course/'. $course_id) }}">List Bab</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Bab</li>
                </ol>
            </nav>
        </div>
    </div>
    <h5 class="color-blue-2 font-weight-bold text-uppercase">matematika | aljabar | bentuk-bentuk aljabar</h5>
    <div class="alert alert-primary my-4 rounded" role="alert">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center h4 bg-primary rounded-circle mr-2 mt-2" data-toggle="tooltip" data-placement="top" title="alert"><i class="icon-info text-white"></i></div>
            Guru dapat mengubah dan menambahkan materi pembelajaran, latihan dan ulangan.
        </div>
    </div>
    <div class="py-3">
        <h5 class="color-blue-2 font-weight-bold text-capitalize">daftar ulasan</h5>
        <div class="" id="loading-contents" style="display: none;">
            <div class="d-flex justify-content-between mt-3 align-items-end font-weight-bold">
                <a class="color-black">Terdapat <span class="color-blue-2">...</span> Ulasan!</a>
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
        <div id="render-contents" style="display: none;">
        </div>
        <div class="mt-3 pl-3">
            <a href="#" class="mt-3 color-blue-2" data-toggle="modal" data-target="#modal-add-content">+ Tambah Ulasan</a>
        </div>
    </div>
    <hr class="bg-black">
    <div class="py-3">
        <h5 class="color-blue-2 font-weight-bold text-capitalize">daftar latihan</h5>
        <a class="color-black font-weight-bold">Terdapat <span class="color-blue-2">1</span> Latihan!</a>
        <div class="mt-3">
            <a href="" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="fa fa-puzzle-piece text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">latihan bentuk-bentuk aljabar</p>
                </div>
            </a>
        </div>
        <div class="mt-3 pl-3">
            <a href="#" class="mt-3 color-blue-2" data-toggle="modal" data-target="#modal-add-activity">+ Tambah Latihan</a>
        </div>
    </div>
    <hr class="bg-dark">
    <div class="py-3">
        <h5 class="color-blue-2 font-weight-bold text-capitalize">daftar ulangan</h5>
        <a class="color-black font-weight-bold">Terdapat <span class="color-blue-2">1</span> Ulangan!</a>
        <div class="mt-3">
            <a href="" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="fa fa-puzzle-piece text-white"></i></div>
                <div class="ml-3">
                <p class="text-dark text-uppercase text-dark pt-3">ulangan bentuk-bentuk aljabar</p>
                </div>
            </a>
        </div>
        <div class="mt-3 pl-3">
            <a href="#" class="mt-3 color-blue-2" data-toggle="modal" data-target="#modal-add-exam">+ Tambah Ulangan</a>
        </div>
    </div>
</div>
@include('layouts.teacher._modal_add_content')
@include('layouts.teacher._modal_add_activity')
@include('layouts.teacher._modal_add_exam')
@endsection

@section('script')
<script>
    let topicId = {!! json_encode($topic_id) !!};

    $("#loading-contents").show('fast');
    $("#render-contents").hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    getContents()
    function getContents() {
        url = "{{ url('/subject/course/topic/contents') }}"

        $.ajax({
            type: "get",
            url: url,
            data: {
                topic_id:topicId,
            },
            success: function (response) {
                renderContents(response);
            }, 
            error: function (e) {
                swal('Gagal Mengambil Data !')
            }
        });
    }
    
    function renderContents(data) {
        let html = ``
        let menuContent = ``

            html += `
            <a class="color-black font-weight-bold">Terdapat <span class="color-blue-2">${data.total}</span> Ulasan!</a>
            `
                $.each(data.data, function (key, content) { 
                    html += `
                    <div class="mt-3">
                        <a href="{{url('/subject/'. $subject_id .'/course/'. $course_id .'/topic/'. $topic_id .'/content/${content.id}')}}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                            <div class="ml-3">
                            <p class="text-dark text-uppercase text-dark pt-3">${content.name} <span class="bold text-black-50">(${content.status})</span></p>
                            </div>
                        </a>
                    </div>
                    `
                    menuContent += `
                    <a href="{{url('/subject/'. $subject_id .'/course/'. $course_id .'/topic/'. $topic_id .'/content/${content.id}')}}" class="text-capitalize"><span>${content.name}</span></a>
                    `
                });
            html +=`</div>
            `

        $("#render-contents").html(html);
        $("#menu-content").html(menuContent);
        $("#loading-contents").hide('fast');
        $("#render-contents").show('fast');
    }

    function createContent() {
        name = $("input[type=text][name=title_content]").val();
        button = $("#btn-create-content");
        
        if (name === '') {
            swal('Nama ulasan harus diisi !')
        } else {
            $.ajax({
                type: "post",
                url: "{{ url('subject/course/topic/content') }}",
                data: {
                    topic_id:topicId,
                    name,
                },
                beforeSend: function () {
                    button.html('Menyimpan...')
                },
                success: function (response) {
                    button.html('Tambah')
                    $("#modal-add-content").modal('hide')
                    resetValue()
                    getContents()
                    swal('Berhasil menambahkan ulasan!')
                },
                error: function (e) {
                    button.html('Tambah')
                    swal('Gagal menambah ulasan. Silahkan coba lagi!')
                }
            });
        }
    }

    function resetValue() {
        $("input[type=text][name=title_content]").val('');
    }
</script>
@endsection