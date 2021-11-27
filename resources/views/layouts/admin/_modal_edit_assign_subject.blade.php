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
                    <input type="text" class="form-control text-dark" id="assign-subject-name" value="" disabled>
                    <input type="hidden" name="subject_id" id="assign-subject-id">
                    <input type="hidden" name="subject_teacher_id" id="assign-subject-teacher-id">
                </div>

                <div id="newSelectInModal"></div>
                <div class="d-flex flex-wrap mt-2">
                    <a href="#" id="addTeacherInput" onclick="addInput('newSelectInModal','teacher-field-modal')">+ Tambah Guru</a>
                    <a href="#" id="reduceTeacherInput" class="text-danger ml-3" onclick="reduceInput('teacher-field-modal')">- Kurangi Input Guru</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit-assign-button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
</div>
