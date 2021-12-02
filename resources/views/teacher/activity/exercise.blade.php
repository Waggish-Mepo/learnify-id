@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ url('/subject/'.'matematika'.'/course/'.'1'.'/topic/'.'1') }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
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
                <input type="text" class="form-control" id="title" placeholder="Masukkan judul latihan" name="exercise_title">
            </div>
            <div class="form-group mb-3">
                <label for="description" class="font-18">Deskripsi Pengerjaan</label>
                <textarea type="text" class="form-control" id="desc" placeholder="Masukkan deskripsi pengerjaan" name="exercise_desc"></textarea>
            </div>
            <div class="mb-4">
                <p class="font-18 mb-1">Daftar Soal</p>
                <a id="add-question" href="#modal-exercise" data-toggle="modal" class="color-blue-2 py-1"><i class="fa fa-plus mr-1"></i> Tambah Soal</a>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-blue-2 text-white d-flex flex-row justify-content-between py-0 align-content-center">
                    <p class="my-auto font-16">Soal 1</p>
                    <button class="btn btn-link text-decoration-none" type="button" id="1-question-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v text-white font-16"></i></button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="1-question-menu-1">
                        <button onclick="btnEditQuestion(1)" class="dropdown-item color-blue-2" type="button" data-toggle="modal" data-target="#modal-exercise"><i class="fa fa-edit color-blue-2"></i> Edit</button>
                        <button class="dropdown-item color-red-1" type="button"><i class="fa fa-trash color-red-1"></i> Hapus</button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="font-16 color-black" style="font-family: 'Roboto', sans-serif;" id="1-question">Apa pengertian dari persamaan kuadrat</p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="1_exercise_answer" value="Ya tau">
                        <label class="form-check-label" id="1-answer-1">Ya tau</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="1_exercise_answer" value="Tanya saya">
                        <label class="form-check-label" id="1-answer-2">Tanya saya</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="1_exercise_answer" value="Salah" checked>
                        <label class="form-check-label" id="1-answer-3">Salah</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="1_exercise_answer" value="Benar">
                        <label class="form-check-label" id="1-answer-4">Benar</label>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-blue-2 text-white d-flex flex-row justify-content-between py-0 align-content-center">
                    <p class="my-auto font-16">Soal 1</p>
                    <button class="btn btn-link text-decoration-none" type="button" id="2-question-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v text-white font-16"></i></button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="2-question-menu-1">
                        <button onclick="btnEditQuestion(2)" class="dropdown-item color-blue-2" type="button" data-toggle="modal" data-target="#modal-exercise"><i class="fa fa-edit color-blue-2"></i> Edit</button>
                        <button class="dropdown-item color-red-1" type="button"><i class="fa fa-trash color-red-1"></i> Hapus</button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="font-16 color-black" style="font-family: 'Roboto', sans-serif;" id="2-question">Apa pengertian dari persamaan kuadrat</p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="2_exercise_answer" value="Ya ndak tau" checked>
                        <label class="form-check-label" id="2-answer-1">Ya ndak tau</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="2_exercise_answer" value="Kok tanya saya">
                        <label class="form-check-label" id="2-answer-2">Kok tanya saya</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="2_exercise_answer" value="Benar">
                        <label class="form-check-label" id="2-answer-3">Benar</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="2_exercise_answer" value="Salah">
                        <label class="form-check-label" id="2-answer-4">Salah</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('layouts.teacher._modal_exercise')
@endsection

@section('script')
    <script>
        $('#add-question').click(function(){
            $('#title-modal-exercise').html('Tambah Soal');
            $('#btn-modal-exercise').html('Tambah Soal');
            $('input[name=exercise_answer]').attr('checked', false);
            $('textarea[name=question]').html('');

            for (let i = 0; i < 5; i++) {
                $(`textarea[name=answer${i}]`).html('');
            }
        });

        function btnEditQuestion(id){
            $('input[name=exercise_answer]').attr('checked', false);

            let question = $(`#${id}-question`).html();
            let answer = [$(`#${id}-answer-1`).html(), $(`#${id}-answer-2`).html(), $(`#${id}-answer-3`).html(), $(`#${id}-answer-4`).html()];
            let selected = $(`input[name=${id}_exercise_answer]:checked`).val();

            $('#title-modal-exercise').html('Edit Soal');
            $('#btn-modal-exercise').html('Edit Soal');
            $('textarea[name=question]').html(question);
            
            $.each(answer, function(index, value ) {
                $(`textarea[name=answer${index + 1}]`).html(value);
                $(`#i-answer-${index + 1}`).val(value);
            });

            $(`input[name=exercise_answer][value='${selected}']`).attr('checked', 'checked');

        };
    </script>
@endsection