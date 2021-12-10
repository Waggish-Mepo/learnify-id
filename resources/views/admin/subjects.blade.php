@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="clearfix mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.subjects') }}">Learnify.id</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kelola Mapel</li>
            </ol>
        </nav>
        <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Kelola Mata Pelajaran</h1>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#mapel">Mapel</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#addSubject">Tambah Mapel</a></li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="mapel">
                        <div class="row my-3">
                            <div class="col-lg-8 col-md-12 col-sm-12"></div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="input-group">
                                <input type="search" class="form-control bg-white rounded text-dark" placeholder="Search" aria-label="Search"
                                aria-describedby="search-addon" />
                                <button type="button" class="btn btn-outline-primary"><i class="icon-magnifier"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mapel</th>
                                        <th>Tim Guru</th>
                                        <th>Pilih Guru</th>
                                        <th>Edit Mapel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $key => $subject)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$subject['name']}}</td>
                                        <td>{{$subject['teacher_details'] ? $subject['teacher_details_string'] : 'Belum dipilih'}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" onclick="openAssignModal('{{$subject['name']}}', '{{$subject['id']}}', '{{$subject['subject_teacher']['id']}}', '{{$key}}')"><i class="icon-user"></i></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" onclick="openEditModal('{{$subject['name']}}', '{{$subject['id']}}')"><i class="fa fa-edit"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="addSubject">
                        <div class="body mt-2">
                            <form method="POST" action="{{url('/subjects')}}">
                            @csrf
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <input type="text" class="form-control text-dark" name="subject_name">
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin._modal_edit_subject')
    @include('layouts.admin._modal_edit_assign_subject')
</div>
@endsection

@section('script')
<script>

//global variable
let allSubjects = {!! json_encode($subjects) !!};

function openAssignModal(name, subjectId, subjectTeacherId, key){
    $('#modal-assign-subject').modal('show');
    $('#assign-subject-name').val(name);
    $('#assign-subject-id').val(subjectId);
    $('#assign-subject-teacher-id').val(subjectTeacherId);

    let subjectData = allSubjects[key];
    $.each(subjectData.teacher_details, (i, item) => {
        addInput('newSelectInModal','teacher-field-modal');
        $(`#option-${item.id}`).attr("selected", true);
    })
}

$('#submit-assign-button').click((e) => {
    let subjectId = $('#assign-subject-id').val();
    let subjectTeacherId = $('#assign-subject-teacher-id').val();
    let teacherInputs = $("select[name='teachers']");
    let url = "{!! url('/assign-subject') !!}"

    let teacherIds = [];
    $.each(teacherInputs, (i, input) => {
        teacherIds.push(input.value)
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "post",
        url: url,
        data: {subjectId, subjectTeacherId, teacherIds},
        beforeSend: function() {
            $('#submit-assign-button').attr('disabled', true)
        },
        success: function (response) {
            window.location.reload();
        }
    });

})

function openEditModal(name, id) {
    $('#modal-edit-subject').modal('show');
    $('#edit-subject-name').val(name);
    $('#edit-subject-id').val(id);
}


function addInput(eSelect, allSelect) {
    // data dari db
    let array = {!! json_encode($teachers) !!}

    // get all teacher field, set as counter (for label)
    var allTeacherSelect = document.getElementsByClassName(allSelect);
    var counter = allTeacherSelect.length;
    var label = document.createElement("label");
    var select = document.createElement("select");
    select.id = `input-${counter}`;
    select.className = "form-control show-tick text-dark";
    select.name = `teachers`;

    counter++;
    label.className = "col-form-label";
    label.innerText = "Guru " + counter;

    // create select
    //appends option
    for (var i = 0; i < (array.length+1); i++) {
        var option = document.createElement("option");
        if(i === array.length){
            option.setAttribute("hidden", true);
            option.setAttribute("selected", true);
            option.text = "--pilih guru--";
            select.insertBefore(option, select.firstChild);
        }else{
            option.id = `option-${array[i]['id']}`;
            option.value = array[i]['id'];
            option.text = array[i]['name'];
            select.appendChild(option);
        }
    }

    // create parent element
    var div = document.createElement("div");
    div.className = "form-group " + allSelect;
    div.appendChild(label);
    div.appendChild(select);
    // append new select element
    var newTeacherField = document.getElementById(eSelect);
    newTeacherField.appendChild(div);
};

function reduceInput(el){
    var teacherField = document.getElementsByClassName(el);
    if(teacherField.length > 0){
        teacherField[teacherField.length-1].remove();
    }
}
</script>
@endsection
