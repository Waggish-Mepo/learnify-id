<div class="modal fade" id="modal-edit-account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name" class="col-form-label">Nama</label>
                <input type="text" class="form-control text-dark" id="name">
            </div>
            <div class="form-group">
                <label for="email" class="col-form-label">Email</label>
                <input type="email" class="form-control text-dark" id="email">
            </div>
            <div class="form-group">
                <label for="status" class="col-form-label">Status</label>
                <select class="form-control show-tick text-dark" id="status">
                    <option>Aktif</option>
                    <option>Non-Aktif</option>
                </select>
            </div>
            @if(request()->route('role') === "STUDENT")
            <div class="form-group">
                <label for="number" class="col-form-label">NIS</label>
                <input type="number" class="form-control text-dark" id="number">
            </div>
            @endif
            @if(request()->route('role') === "TEACHER")
            <div class="form-group">
                {{-- nanti ambil data subject --}}
                <label for="status" class="col-form-label">Mata Pelajaran</label>
                <select class="form-control show-tick text-dark" id="status">
                    <option hidden>--pilih mata pelajaran--</option>
                    <option>Matematika</option>
                    <option>Bahasa Indonesia</option>
                    <option>Bahasa Inggris</option>
                    <option>PJOK</option>
                </select>
            </div>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Simpan</button>
        </div>
        </div>
    </div>
</div>
</div>
