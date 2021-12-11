@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="clearfix mb-3">
        {{-- if nya semnentara, nanti diganti. pokoknya ngambil role --}}
        @if (request()->route('role') === "STUDENT")
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Learnify.id</a></li>
                    <li class="breadcrumb-item active">Kelola Akun</li>
                    <li class="breadcrumb-item active" aria-current="page">Akun Siswa</li>
                </ol>
            </nav>
            <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Akun Siswa</h1>
        @endif
        @if (request()->route('role') === "TEACHER")
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Learnify.id</a></li>
                    <li class="breadcrumb-item active">Kelola Akun</li>
                    <li class="breadcrumb-item active" aria-current="page">Akun Guru</li>
                </ol>
            </nav>
            <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Akun Guru</h1>
        @endif
        @if (request()->route('role') === "ADMIN")
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Learnify.id</a></li>
                    <li class="breadcrumb-item active">Kelola Akun</li>
                    <li class="breadcrumb-item active" aria-current="page">Akun Admin</li>
                </ol>
            </nav>
            <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Akun Admin</h1>
        @endif
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" id="index-account" href="#Users">Akun</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" id="create-account" href="#addUser">Tambah Akun</a></li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="Users">
                        <div class="row my-3">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                @if(request()->route('role') === "STUDENT")
                                    <a class="btn btn-primary" href="{{url('/export-excel-student')}}" target="_blank" rel="noopener noreferrer"><i class="icon-arrow-down mr-2"></i>Export Akun</a>
                                @elseif(request()->route('role') === "TEACHER")
                                    <a class="btn btn-primary" href="{{url('/export-excel-teacher')}}" target="_blank" rel="noopener noreferrer"><i class="icon-arrow-down mr-2"></i>Export Akun</a>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="input-group">
                                <input type="search" class="form-control bg-white rounded text-dark" placeholder="Search" aria-label="Search"
                                aria-describedby="search-addon" onkeyup="searchAccount(event)" onkeydown="searchAccount(event)" onchange="searchAccount(event)"/>
                                <button type="button" class="btn btn-outline-primary"><i class="icon-magnifier"></i></button>
                                </div>
                            </div>
                        </div>
                        @include("admin.statistik._table")
                    </div>
                    <div class="tab-pane" id="addUser">
                        <div class="d-flex justify-content-between my-3">
                            <div></div>
                            @if(request()->route('role') === "STUDENT" || request()->route('role') === 'TEACHER')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-import-account"><i class="icon-arrow-down mr-2"></i>Import Akun</button>
                            @endif
                        </div>
                        @if(request()->route('role') === "STUDENT")
                            @include('admin.statistik.forms.students')
                        @elseif(request()->route('role') === 'TEACHER')
                            @include('admin.statistik.forms.teachers')
                        @else
                            @include('admin.statistik._form')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@csrf
    @include('layouts.admin._modal_import_account')
    @include('layouts.admin._modal_edit_account')
</div>
@endsection

@section('script')
<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/pages/ui/dialogs.js')}}"></script>
<script type="text/javascript">
    let role = "{{ request()->route('role') }}"
    let accounts = {}

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(`#loading-${role}`).show('slow');
    $(`#panel-${role}`).hide('slow');
    $(`#empty-${role}`).hide('slow');
    getAccount()
    function getAccount() {
        $.ajax({
            type: "get",
            url: "{{ url('account') }}",
            data: {role},
            success: function (response) {
                if (response.data.length === 0) {
                    $(`#empty-${role}`).show('fast');
                    $(`#loading-${role}`).hide('fast');
                    $(`#panel-${role}`).hide('fast');
                } else {
                    accounts = response.data
                    renderAccount(response);
                }
            }
        });
    }

    function renderAccount(data) {
        let html = ``
        let no = 1
        $.each(data.data, function (key, account) {
            html += `
            <tr>
                <td class="width45">${no}</td>
                <td>
                    <h6 class="mb-0">${account.name}</h6>
                    <span>${account.email === null ? '-' : account.email}</span>
                </td>
                ${role === 'STUDENT' ? `<td>${account.nis === null ? '-' : account.nis}</td>` : ''}
                ${role === 'STUDENT' ? `<td>${account.grade}</td>` : ''}
                <td>${account.username}</td>
                <td>${account.status === 1 ? 'Active' : 'Non Active'}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" data-target="#modal-edit-account" onclick="editAccount('${account.id}')"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-sm btn-primary js-sweetalert" title="Reset Password" data-type="reset-password" onclick="showResetPasswordMessage('${account.id}', '${account.username}')" title="Reset Password"><i class="fa fa-lock text-white"></i></button>
                </td>
            </tr>
            `
            no++
        });

        $(`#render-accounts`).html(html);
        $(`#panel-${role}`).show('slow');
        $(`#loading-${role}`).hide('fast');
        $(`#empty-${role}`).hide('fast');
    }

    function resetValue() {
        $(`input[name=${role}Name]`).val('');
        $(`input[name=${role}Email]`).val('');
        $('input[name=editName]').val('')
        $('input[name=editEmail]').val('')
        $(`input[name=editStatus]`).prop('checked', false)
        if (role === 'STUDENT') {
            $(`input[name=${role}Nis]`).val('');
            $('input[name=editNis]').val('')
        }
    }

    function createAccount() {
        let name = $(`input[name=${role}Name]`).val();
        let email = $(`input[name=${role}Email]`).val();
        let data = {
                name,
                email,
                role
            }
        if (role === 'STUDENT') {
            let nis = $(`input[name=${role}Nis]`).val();
            let grade = $(`select[name=${role}Grade]`).val();
            data['nis'] = nis
            data['grade'] = grade
        }
        let btnSubmit = $(`#${role}-submit`)

        $.ajax({
            type: "post",
            url: "{{ url('account') }}",
            data: data,
            beforeSend: function () {
                btnSubmit.html('Menyimpan...')
            },
            success: function (response) {
                btnSubmit.html('Tambah')
                $(`#${role}-alert`).show('fast');
                accounts.push(response)
                // resetValue()
                getAccount()
            },
            error: function (e) {
                btnSubmit.html('Tambah')
                alert('Tambah akun belum berhasil, silahkan coba lagi!')
            }
        });
    }

    function editAccount(accountId) {
        let dataAccount = accounts.find(account => account.id === accountId);
        $('input[type=hidden][name=idAccount]').val(dataAccount.id)
        $('input[name=editName]').val(dataAccount.name)
        $('input[name=editEmail]').val(dataAccount.email)
        $(`input[name=editStatus][value=${dataAccount.status}]`).prop('checked', true)
        if (role === 'STUDENT') {
            $('input[name=editNis]').val(dataAccount.nis)
            $(`select[name=editGrade] option[value=${dataAccount.grade}]`).attr('selected','selected');
        }
    }

    function updateAccount() {
        let id = $('input[type=hidden][name=idAccount]').val()
        let name = $('input[name=editName]').val()
        let email = $('input[name=editEmail]').val()
        let status = $('input[name=editStatus]:checked').val()
        let data = {
            id,
            name,
            email,
            status,
            role
        }

        if (role === 'STUDENT') {
            let nis = $('input[name=editNis]').val()
            let grade = $('select[name=editGrade]').val()
            data['nis'] = nis
            data['grade'] = grade
        }

        let button = $('#update-button')
        $.ajax({
            type: "patch",
            url: "{{ url('account') }}",
            data: data,
            beforeSend: function () {
                button.html('Menyimpan...')
            },
            success: function (response) {
                $(`#update-alert`).show('fast');
                $(`#global-username`).html(response.name);
                setTimeout(function() {
                    $(`#update-alert`).hide('fast')
                    $('#modal-edit-account').modal('hide')
                }, 1000);
                button.html('Simpan')
                getAccount()
                resetValue()

            },
            error: function (e) {
                button.html('Simpan')
                swal('Edit akun belum berhasil, silahkan coba lagi!')
            }
        });
    }

    function resetPassword(id, username) {
        $.ajax({
            type: "get",
            url: "{{ url('account-reset') }}",
            data: {
                id,
                username
            },
            success: function (response) {
                swal("Berhasil mereset akun!");
            },
            error: function () {
                swal("Gagal mereset akun!");
            }
        });
    }

    function searchAccount(e){
        let value = e.currentTarget.value

        $('#render-accounts tr').each(function(){
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
                {
                    found = 'true';
                }
            });
            if(found == 'true')
            {
                $(this).show();
            }
            else
            {
                $(this).hide();
            }
        });
    }

    $('#inputGroupFile04').on('change', (e) => {
        $('#input-excel-label').html(e.target.files[0].name);
    })

</script>
@endsection
