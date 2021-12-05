<div class="modal fade" id="modal-add-activity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Latihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetValue()">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name" class="col-form-label">Judul Latihan</label>
                <input type="text" class="form-control text-dark" name="nameExercise" placeholder="Masukkan judul latihan baru">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="createExercise()" id="btn-exercise">Tambah</button>
        </div>
        </div>
    </div>
</div>
</div>