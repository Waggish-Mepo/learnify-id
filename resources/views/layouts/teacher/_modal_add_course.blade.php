<div class="modal fade" id="modal-add-course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <div class="form-group">
                <input type="hidden" name="subject_id" value="{{ $subject['id'] }}">
                <label for="name" class="col-form-label">Materi</label>
                <input type="text" class="form-control text-dark" name="name" placeholder="Masukkan materi baru">
            </div>
            <div class="form-group">
                <label>Kelas</label>
                <select name="grade" class="form-control show-tick text-dark" id="">
                    @foreach ($grades as $key => $grade)
                        <option value="{{$key}}">{{$grade}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn-create" onclick="createCourse()">Tambah</button>
        </div>
        </div>
    </div>
</div>
</div>