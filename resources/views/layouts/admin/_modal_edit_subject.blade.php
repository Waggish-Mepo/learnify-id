<div class="modal fade" id="modal-edit-subject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{url('/subjects')}}">
                @method('PATCH')
                @csrf
                <input type="hidden" id="edit-subject-id" name="subject_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <input type="text" id="edit-subject-name" name="subject_name" class="form-control text-dark">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
