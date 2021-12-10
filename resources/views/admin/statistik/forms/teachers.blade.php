<div class="body mt-2">
    <div class="w-100">
        <div class="alert alert-success" id="{{ request()->route('role') }}-alert" role="alert" style="display: none;">
            Akun berhasil dibuat!.
        </div>
    </div>
    <div class="row clearfix" onclick="$('#{{ request()->route('role') }}-alert').hide('fast')">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="{{ request()->route('role') }}Name" class="form-control text-dark">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="{{ request()->route('role') }}Email" class="form-control text-dark">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <button type="button" id="{{ request()->route('role') }}-submit" class="btn btn-primary" onclick="createAccount()">Tambah</button>
    </div>
</div>
