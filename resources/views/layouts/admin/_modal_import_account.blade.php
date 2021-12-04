<div class="modal fade" id="modal-import-account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Import Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <form @if( request()->route('role') === "STUDENT") action="{{url('/import-excel-student')}}" @else action="{{url('/import-excel-teacher') }}" @endif  enctype="multipart/form-data" method="post">
            @csrf
            <p>Import File</p>
            <div class="input-group mb-2">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="excel-file" id="inputGroupFile04" accept=".xlsx" aria-describedby="inputGroupFile04">
                    <label class="custom-file-label" id="input-excel-label" for="inputGroupFile04">Choose file</label>
                </div>
            </div>
            @if(request()->route('role') === "STUDENT")
                <a href="{{url('/download-excel-student')}}" target="_blank" rel="noopener noreferrer">Download format disini</a>
            @elseif(request()->route('role') === "TEACHER")
                <a href="{{url('/download-excel-teacher')}}" target="_blank" rel="noopener noreferrer">Download format disini</a>
            @endif
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
        </div>
    </div>
</div>
</div>
