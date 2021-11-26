<div class="body mt-2">
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control text-dark">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control text-dark">
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control text-dark">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label for="status" class="col-form-label">Subject</label>
                {{-- get data nya dari table subjects --}}
                <select class="form-control show-tick text-dark" id="status">
                    <option hidden>--choose subject--</option>
                    <option>Matematika</option>
                    <option>Bahasa Indonesia</option>
                    <option>Bahasa Inggris</option>
                    <option>PJOK</option>
                </select>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <div></div>
        {{-- pas post, ntar kirim data role nya sesuai sama route --}}
        <button type="button" class="btn btn-primary">Tambah</button>
    </div>
</div>