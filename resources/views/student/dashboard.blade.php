@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mt-2">
        <div class="col-md-12">
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-capitalize text-white f-15">Hai {{ $user['name'] }}, mau belajar apa hari ini?</div>
            </div>
        </div>
    </div>
    <div id="quotes-card"></div>
    <div id="render-subject" style="display: none;">

    </div>

    <div class="" id="loading-subject" style="display: none;">
        <div class="mt-3">
            <a href="javascript:void(0)" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                <div class="ml-3">
                    <p class="text-dark text-uppercase pt-3">...</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $("#quotes-card").hide();
    $( document ).ready(function() {
        getQuote()
        getSubject()
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#loading-subject").show('fast');
    $("#render-subject").hide('fast');

    function getQuote() {
        url = "https://api.quotable.io/random"

        $.ajax({
            type: "get",
            url: url,
            success: function (response) {
                renderQuote(response);
            },
            error: function (e) {
                swal('Gagal Mengambil Data Quote!')
            }
        });
    }
    function renderQuote(data) {
        let html = ``

            html += `
            <div class="mt-4 mb-5 opacity-90">
                <div class="d-flex alignt-items-center w-75 bg-white shadow-xs rounded-lg pl-2">
                    <div class="d-flex align-items-center">
                        <div style="width: 40px !important; height: 40px !important;" class="align-items-center d-flex justify-content-center w-motif bg-red rounded-circle cursor-pointer ml-2" ><i class="fa fa-lightbulb-o text-white"></i></div>
                    </div>`
                    html += `
                    <div class="ml-3 mr-2">
                        <p class="text-dark text-capitalize pt-3">
                        <span class="font-weight-bold">
                            motivasi untukmu!
                        </span>
                            <br>
                            <q>${data.content}</q>
                        </p>
                    </div>`
                    html +=`
                </div>
            </div>
            `
        $("#quotes-card").html(html);
        $("#quotes-card").show('fast');
    }

    function getSubject() {
        url = "{{ url('student/subject') }}"

        $.ajax({
            type: "get",
            url: url,
            success: function (response) {
                console.log(response);
                renderSubject(response);
            },
            error: function (e) {
                swal('Gagal Mengambil Data !')
            }
        });
    }

    function renderSubject(data) {
        html = ``

        $.each(data, function (key, subject) {
            html += `
            <div class="mt-3">
                <a href="{{ url('/student/subject/${subject.id}/course/') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
                    <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
                    <div class="ml-3">
                        <p class="text-dark text-uppercase pt-3">${subject.name}</p>
                    </div>
                </a>
            </div>
            `
        });

        $("#render-subject").html(html);
        $("#loading-subject").hide('fast');
        $("#render-subject").show('fast');
    }
</script>
@endsection
