<div class="modal fade" id="modal-assign-subject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Guru Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Mata Pelajaran</label>
                <input type="text" class="form-control text-dark" value="judul mapel" disabled>
            </div>
            {{-- jumlah nya sesuai sama di data db-nya --}}
            <div class="form-group teacher-field-modal">
                <label for="teacher" class="col-form-label">Guru 1</label>
                <select class="form-control show-tick text-dark" id="teacher">
                    <option hidden>--pilih guru--</option>
                    <option>user 1</option>
                    <option>user 2</option>
                    <option>user 3</option>
                </select>
            </div>
            <div class="form-group teacher-field-modal">
                <label for="teacher" class="col-form-label">Guru 2</label>
                <select class="form-control show-tick text-dark" id="teacher">
                    <option hidden>--pilih guru--</option>
                    <option>user 1</option>
                    <option>user 2</option>
                    <option>user 3</option>
                </select>
            </div>
            <div id="newSelectInModal"></div>
            <div class="d-flex flex-wrap mt-2">
                <a href="#" id="addTeacherInput" onclick="addInput('newSelectInModal','teacher-field-modal')">+ Tambah Guru</a>
                <a href="#" id="reduceTeacherInput" class="text-danger ml-3" onclick="reduceInput('teacher-field-modal')">- Kurangi Input Guru</a>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Simpan</button>
        </div>
        </div>
    </div>
</div>
</div>
