@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="clearfix mb-3">
        {{-- if nya semnentara, nanti diganti. pokoknya ngambil role --}}
        @if (request()->route('role') === "STUDENT")
            <h1>Akun Siswa</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.account', 1) }}">Smart School</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.account', 1) }}">Kelola Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Akun Siswa</li>
                </ol>
            </nav>
            <h1 class="text-primary font-weight-bold my-4" style="font-size: 1.8rem;">Akun Siswa</h1>
        @endif
        @if (request()->route('role') === "TEACHER")
            <h1>Akun Guru</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.account', 2) }}">Smart School</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.account', 2) }}">Kelola Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Akun Guru</li>
                </ol>
            </nav>
            <h1 class="text-primary font-weight-bold my-4" style="font-size: 1.8rem;">Akun Guru</h1>
        @endif
        @if (request()->route('role') === "ADMIN")
            <h1>Akun Admin</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.account', 3) }}">Smart School</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.statistik.account', 3) }}">Kelola Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Akun Admin</li>
                </ol>
            </nav>
            <h1 class="text-primary font-weight-bold my-4" style="font-size: 1.8rem;">Akun Admin</h1>
        @endif
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Users">Akun</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#addUser">Tambah Akun</a></li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="Users">
                        <div class="row my-3">
                            <div class="col-lg-8 col-md-12 col-sm-12"></div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="input-group">
                                <input type="search" class="form-control bg-white rounded" placeholder="Search" aria-label="Search"
                                aria-describedby="search-addon" />
                                <button type="button" class="btn btn-outline-primary"><i class="icon-magnifier"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            {{-- di atur di controller, return data users yang role nya sesuai route --}}
                            <table class="table table-hover table-custom spacing8">
                                <thead>
                                    <tr>
                                        <th class="w60">#</th>
                                        <th class="w60">Name</th>
                                        <th></th>
                                        <th>NIS</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th class="w100">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="width45">1</td>
                                        <td class="width45">
                                            <div class="avtar-pic w35 bg-pink" data-toggle="tooltip" data-placement="top" title="Avatar Name"><span>MN</span></div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">Marshall Nichols</h6>
                                            <span>marshall-n@gmail.com</span>
                                        </td>
                                        <td>11220987</td>
                                        <td>marsha</td>
                                        <td>active</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-default" data-toggle="modal" title="Edit" data-target="#modal-edit-account"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-sm btn-primary reset-alert" title="Delete" data-type="confirm"><i class="fa fa-lock text-white" onclick="showConfirmMessage()"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width45">2</td>
                                        <td>
                                            <img src="{{asset('assets/images/xs/avatar5.jpg')}}"  data-toggle="tooltip" data-placement="top" title="Avatar Name" alt="Avatar" class="w35 h35 rounded">
                                        </td>
                                        <td>
                                            <h6 class="mb-0">Susie Willis</h6>
                                            <span>sussie-w@gmail.com</span>
                                        </td>
                                        <td>11890765</td>
                                        <td>sussie</td>
                                        <td>active</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" data-target="#modal-edit-account"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-sm btn-primary reset-alert" title="Delete" data-type="confirm"><i class="fa fa-lock text-white" onclick="showConfirmMessage()"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="addUser">
                        <div class="d-flex justify-content-between my-3">
                            <div></div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-import-account"><i class="icon-arrow-down mr-2"></i>Import Akun</button>
                        </div>
                        <div class="body mt-2">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>NIS</label>
                                        <input type="number" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div></div>
                                {{-- pas post, ntar kirim data role_id nya sesuai sama route --}}
                                <button type="button" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin._modal_edit_account')
    @include('layouts.admin._modal_import_account')
</div>
@endsection

@section('script')
<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script>

    $(document).ready(() => {
        console.log('test')
    })
function showConfirmMessage() {
    swal({
        title: "Kamu yakin ingin reset password akun ini?",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Yakin!",
        cancelButtonText: "Tidak!",
        closeOnConfirm: false
    }, function () {
        swal("Ubah Password!", "nanti ini muncul modal baru buat ubah pw");
    });
}
</script>
@endsection
