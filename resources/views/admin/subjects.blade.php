@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="clearfix mb-3">
        <h1>Kelola Mapel</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.subjects') }}">Smart School</a></li>
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
                                        <th>Mata Pelajaran</th>
                                        <th>Nama Guru</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Matematika</td>
                                        <td>marsha</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" data-target="#modal-edit-subject"><i class="fa fa-edit"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Bahasa Indonesia</td>
                                        <td>sussie</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" data-target="#modal-edit-subject"><i class="fa fa-edit"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="addSubject">
                        <div class="body mt-2">
                            <form id="formSubject">
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <input type="text" class="form-control text-dark">
                            </div>
                            <div class="form-group teacher-field">
                                <label for="teacher" class="col-form-label">Guru 1</label>
                                <select class="form-control show-tick text-dark" id="teacher">
                                    <option hidden selected>--pilih guru--</option>
                                    <option value="user">user 1</option>
                                    <option>user 2</option>
                                    <option>user 3</option>
                                </select>
                            </div>
                            <div class="form-group teacher-field">
                                <label for="teacher" class="col-form-label">Guru 2</label>
                                <select class="form-control show-tick text-dark" id="teacher">
                                    <option hidden selected>--pilih guru--</option>
                                    <option>user 1</option>
                                    <option>user 2</option>
                                    <option>user 3</option>
                                </select>
                            </div>
                            <div id="newSelect"></div>
                            <div class="d-flex flex-wrap mt-2">
                                <a href="#" id="addTeacherInput" onclick="addInput('newSelect', 'teacher-field')">+ Tambah Input Guru</a>
                                <a href="#" id="reduceTeacherInput" class="text-danger ml-3" onclick="reduceInput('teacher-field')">- Kurangi Input Guru</a>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div></div>
                                <button type="button" class="btn btn-primary">Tambah</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin._modal_edit_subject')
</div>
@endsection

@section('script')
<script>
function addInput(eSelect, allSelect) {
    // data dari db
    var array = ["user 1","user 2","user 3"];
    // get all teacher field, set as counter (for label)
    var allTeacherSelect = document.getElementsByClassName(allSelect);
    var counter = allTeacherSelect.length;
    counter++;
    var label = document.createElement("label");
    label.className = "col-form-label";
    label.innerText = "Guru " + counter;
    // create select
    var select = document.createElement("select");
    select.className = "form-control show-tick text-dark";
    //appends option
    for (var i = 0; i < (array.length+1); i++) {
        var option = document.createElement("option");
        if(i === array.length){
            option.setAttribute("hidden", true);
            option.setAttribute("selected", true);
            option.text = "--pilih guru--";
            select.insertBefore(option, select.firstChild);
        }else{
            option.value = array[i];
            option.text = array[i];
            select.appendChild(option);
        }
    }

    // set name select (terserah)
    // select.name = "select";

    // create parent element
    var div = document.createElement("div");
    div.className = "form-group " + allSelect;
    div.appendChild(label);
    div.appendChild(select);
    // append new select element
    var newTeacherField = document.getElementById(eSelect);
    newTeacherField.appendChild(div);
    console.log(newTeacherField);
}; 

function reduceInput(el){
    var teacherField = document.getElementsByClassName(el);
    if(teacherField.length > 0){
        teacherField[teacherField.length-1].remove();   
    }
}
</script>
@endsection
