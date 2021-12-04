@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ url('/subject/'.$subject['id'].'/course/'.$course['id'].'/topic/'.$topic['id']) }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
        </div>
    </div>
    <div class="alert alert-primary my-4 rounded" role="alert">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center h4 bg-primary rounded-circle mr-2 mt-2" data-toggle="tooltip" data-placement="top" title="alert"><i class="icon-info text-white"></i></div>
            Terbitkan latihan agar siswa dapat mengerjakan latihan yang dibagikan
        </div>
    </div>
    <div class="d-flex justify-content-end mt-5">
        <div class="d-flex">
            <button type="button" class="btn bg-blue-2 text-white mr-2 d-flex align-items-center">
            <i class="fa fa-save mr-2"></i>Simpan
            </button>
            <button type="button" class="btn btn-primary d-flex align-items-center">
                <i class="icon-cloud-upload mr-2"></i>Terbitkan
            </button>
        </div>
    </div>
    <div class="bg-white mt-3 px-3 py-4 text-dark">
        <form>
            <div class="form-group mb-3">
                <label for="title" class="font-18">Judul Latihan</label>
                <input type="text" class="form-control" id="title" placeholder="Masukkan judul latihan" name="activity_title" value="{{ $activity['name'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="description" class="font-18">Deskripsi Pengerjaan</label>
                <textarea type="text" class="form-control" id="desc" placeholder="Masukkan deskripsi pengerjaan" name="activity_desc">{{ $activity['description'] }}</textarea>
            </div>
            <div class="mb-4">
                <p class="font-18 mb-1">Daftar Soal</p>
                <a id="add-question" onclick="addQuestion()" href="#modal-add-question" data-toggle="modal" class="color-blue-2 py-1"><i class="fa fa-plus mr-1"></i> Tambah Soal</a>
            </div>

            <div id="render-question" style="display: none;">

            </div>

            <div id="loading-question" style="display: none;">
                <div class="card mb-3">
                    <div class="card-header bg-blue-2 text-white d-flex flex-row justify-content-between py-0 align-content-center">
                        <p class="my-auto font-16">Soal ...</p>
                        <button class="btn btn-link text-decoration-none" type="button" id="2-question-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v text-white font-16"></i></button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="2-question-menu-1">
                            <button onclick="" class="dropdown-item color-blue-2" type="button" data-toggle="modal" data-target="#modal-exercise"><i class="fa fa-edit color-blue-2"></i> Edit</button>
                            <button class="dropdown-item color-red-1" type="button"><i class="fa fa-trash color-red-1"></i> Hapus</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="font-16 color-black" style="font-family: 'Roboto', sans-serif;">...</p>
    
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="..." checked>
                            <label class="form-check-label">...</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="...">
                            <label class="form-check-label">...</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="...">
                            <label class="form-check-label">...</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="...">
                            <label class="form-check-label">...</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('layouts.teacher._modal_add_question')
@include('layouts.teacher._modal_update_question')
@endsection

@section('script')
    <script>
        let activity = {!! json_encode($activity) !!};

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#loading-question').show('fast');
        $('#render-question').hide('fast');

        getQuestion()
        function getQuestion() {
            let url = `{{ url('subject/course/topic/question') }}`

            $.ajax({
                type: "get",
                url: url,
                data: {
                    activity_id:activity.id,
                },
                success: function (response) {
                    console.log(response);
                    
                    renderQuestion(response.data);
                }, 
                error: function (e) {
                    swal('Gagal Mengambil Data !')
                }
            });
        }

        function renderQuestion(data) {
            let html = ``

            $.each(data, function (key, question) { 
                html += `
                <div class="card mb-3">
                    <div class="card-header bg-blue-2 text-white d-flex flex-row justify-content-between py-0 align-content-center">
                        <p class="my-auto font-16">Soal ${question.order}</p>
                        <button class="btn btn-link text-decoration-none" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v text-white font-16"></i></button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menu">
                            <button onclick="editQuestion('${question.id}')" class="dropdown-item color-blue-2" type="button" data-toggle="modal" data-target="#modal-exercise"><i class="fa fa-edit color-blue-2"></i> Edit</button>
                            <button class="dropdown-item color-red-1" type="button" onclick="destroyQuestion('${question.id}')"><i class="fa fa-trash color-red-1"></i> Hapus</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="font-16 color-black" style="font-family: 'Roboto', sans-serif;" id="1-question">
                            ${question.question}
                        </p>`

                        $.each(question.choices, function (key, choice) { 
                            html += `<div class="form-check">
                                <input class="form-check-input" type="radio" name="${question.id}_activity_answer" value="${key}" ${key == question.answer ? 'checked' : ''}>
                                <label class="form-check-label" id="1-answer-1">${choice}</label>
                            </div>`
                        });

                html +=`</div>
                </div>
                `
            });

            $('#render-question').html(html);
            $('#render-question').show('fast');
            $('#loading-question').hide('fast');
        }

        function resetValue() {
            $('input[name=activity_answer]').attr('checked', false)
            $('textarea[name=question]').val('')
            $("textarea[name=explanation]").val('')
            for (let i = 0; i < 5; i++) {
                $(`textarea[name=answer_${i}]`).val('');
            }
        }

        function addQuestion() {
            $('input[name=activity_answer]').attr('checked', false);
            $('textarea[name=question]').val('');
            $("textarea[name=explanation]").val('')

            for (let i = 0; i < 5; i++) {
                $(`textarea[name=answer_${i}]`).val('');
            }
        }

        function createQuestion() {
            let question = $("textarea[name=question]").val()
            let explanation = $("textarea[name=explanation]").val()
            let choices = {}
            let answer = $("input[type=radio][name=activity_answer]:checked")
            choices['A'] = $("textarea[name=answer_1]").val()
            choices['B'] = $("textarea[name=answer_2]").val()
            choices['C'] = $("textarea[name=answer_3]").val()
            choices['D'] = $("textarea[name=answer_4]").val()
            
            button = $("#btn-add-activity");
            
            
            if (question === '' || explanation === '' || answer.length === 0) {
                swal('Lengkapi form secara benar !')
            } else {
                $.ajax({
                    type: "post",
                    url: "{{ url('subject/course/topic/question') }}",
                    data: {
                        question,
                        choices,
                        answer:answer.val(),
                        explanation,
                        activity_id:activity.id
                    },
                    beforeSend: function () {
                        button.html('Menyimpan...')
                    },
                    success: function (response) {
                        button.html('Tambah')
                        $("#modal-add-question").modal('hide')
                        resetValue()
                        getQuestion()
                        swal('Berhasil menambahkan soal!')
                    },
                    error: function (e) {
                        button.html('Tambah')
                        swal('Gagal menambah soal. Silahkan coba lagi!')
                    }
                })
            }
        }
    </script>
@endsection