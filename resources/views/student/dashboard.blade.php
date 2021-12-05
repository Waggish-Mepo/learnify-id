@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mt-2">
        <div class="col-md-12">
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-capitalize text-white f-15">hai fema, mau belajar apa hari ini?</div>
                <div class="form-outline position-relative bg-white w-search rounded">
                    <input type="text" id="form1" class="form-control search pl-sm-5 pl-4" placeholder="Contoh : Aljabar" />
                    <div class="position-absolute i-search">
                        <i class="fa fa-search color-grey"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="quotes-card"></div>
    <div class="mt-3">
        <a href="{{ url('/student/subject/'.'matematika'.'/course/') }}" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
            <div class="ml-3">
                <p class="text-dark text-uppercase pt-3">matematika | umum</p>
            </div>
        </a>
    </div>
    <div class="mt-3">
        <a href="" class="d-flex align-items-center p-2 w-100 bg-white shadow-sm rounded border-hover">
            <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="icon-book-open text-white"></i></div>
            <div class="ml-3">
                <p class="text-dark text-uppercase pt-3">bahasa inggris | bisnis</p>
            </div>
        </a>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $("#quotes-card").hide();
    $( document ).ready(function() {
        getQuote();
    });
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
                <div class="d-flex align-items-center w-75 bg-white shadow-xs rounded-lg pl-2">
                    <div class="d-sm-flex d-none align-items-center justify-content-center w-motif bg-red rounded-circle cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="materi"><i class="fa fa-lightbulb-o text-white"></i></div>`
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
</script>
@endsection