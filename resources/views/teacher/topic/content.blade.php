@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ url('/subject/'.'matematika'.'/course/'.'1'.'/topic/'.'1') }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
        </div>
    </div>
    <div class="alert alert-primary my-4 rounded" role="alert">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center h4 bg-primary rounded-circle mr-2 mt-2" data-toggle="tooltip" data-placement="top" title="alert"><i class="icon-info text-white"></i></div>
            Terbitkan ulasan agar siswa dapat membaca atau menonton materi yang diberikan.
        </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
        <div></div>
        <div class="d-flex">
            <button type="button" class="btn bg-blue-2 text-white mr-2 d-flex align-items-center">
            <i class="fa fa-save mr-2"></i>Simpan
            </button>
            <button type="button" class="btn btn-primary d-flex align-items-center">
                <i class="icon-cloud-upload mr-2"></i>Terbitkan
            </button>
        </div>
    </div>
    <div class="bg-white mt-3 px-3 py-4 text-dark">
        <form>
            <div class="form-group mb-3">
                <label for="title">Judul Ulasan</label>
                <input type="text" class="form-control" id="title" placeholder="Masukkan judul ulasan" name="title">
            </div>
            <div id="editor"></div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    class MyUploadAdapter {
       constructor(loader) {
          this.loader = loader;
          this.url = '{{ route('upload-image') }}';
       }
       upload() {
          return this.loader.file.then(
             (file) =>
                new Promise((resolve, reject) => {
                   this._initRequest();
                   this._initListeners(resolve, reject, file);
                   this._sendRequest(file);
                })
          );
       }
       abort() {
          if (this.xhr) {
             this.xhr.abort();
          }
       }
       _initRequest() {
          const xhr = (this.xhr = new XMLHttpRequest());
          xhr.open("POST", this.url, true);
          xhr.setRequestHeader("x-csrf-token", "{{ csrf_token() }}");
          xhr.responseType = "json";
       }
       _initListeners(resolve, reject, file) {
          const xhr = this.xhr;
          const loader = this.loader;
          const genericErrorText = `Couldn't upload file: ${file.name}.`;
          xhr.addEventListener("error", () => reject(genericErrorText));
          xhr.addEventListener("abort", () => reject());
          xhr.addEventListener("load", () => {
             const response = xhr.response;
             if (!response || response.error) {
                return reject(response && response.error ? response.error.message : genericErrorText);
             }
             resolve({
                default: response.url,
             });
          });
          if (xhr.upload) {
             xhr.upload.addEventListener("progress", (evt) => {
                if (evt.lengthComputable) {
                   loader.uploadTotal = evt.total;
                   loader.uploaded = evt.loaded;
                }
             });
          }
       }
       _sendRequest(file) {
          const data = new FormData();
          data.append("upload", file);
          this.xhr.send(data);
       }
    }

    function SimpleUploadAdapterPlugin(editor) {
       editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
          return new MyUploadAdapter(loader);
       };
    }

    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        extraPlugins: [ SimpleUploadAdapterPlugin ],
    }  )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>
@endsection