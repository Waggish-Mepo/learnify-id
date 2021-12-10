@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ url('/subject/'. $subject_id .'/course/'. $course_id .'/topic/'. $topic_id) }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
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
            <button id="btn-save" onclick="updateContent()" type="button" class="btn bg-blue-2 text-white mr-2 d-flex align-items-center">
            <i class="fa fa-save mr-2"></i>Simpan
            </button>
            <button id="btn-publish" onclick="publishContent()" type="button" class="btn btn-primary d-flex align-items-center">
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
            <div class="form-group mb-3">
                <label for="title">Estimasi Waktu Baca (Menit)</label>
                <input type="number" class="form-control" id="estimation" placeholder="0" name="estimation">
            </div>
            <div class="form-group mb-3">
                <label for="exp">Poin Experience</label>
                <input type="number" min="0" max="100" class="form-control" id="exp" placeholder="Masukkan poin untuk siswa" name="activity_exp">
            </div>
            <textarea id="editor" name="content"></textarea>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
   let user = {!! json_encode(Auth::user()) !!};
   let topicId = {!! json_encode($topic_id) !!};
   let contentId = {!! json_encode($content_id) !!};

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
      mediaEmbed: {
         previewsInData: true,
      }
   }  )
   .then( newEditor => {
      editor = newEditor;
   } )
   .catch( error => {
      console.error( error );
   } );

   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

   function getContents() {
      url = "{{ url('/subject/course/topic/contents') }}"

      $.ajax({
         type: "get",
         url: url,
         data: {
               topic_id:topicId,
         },
         success: function (response) {
               renderContents(response);
         },
         error: function (e) {
               swal('Gagal Mengambil Data !')
         }
      });
   }

   function renderContents(data) {
      let menuContent = ``;
      $.each(data.data, function (key, content) {
         menuContent += `
            <a href="{{url('/subject/'. $subject_id .'/course/'. $course_id .'/topic/'. $topic_id .'/content/${content.id}')}}"
            class="{{ Request::is('subject/'. $subject_id .'/course/'. $course_id .'/topic/'. $topic_id .'/content/${content.id}') ? 'active' : '' }}"><i class="icon-book-open"></i>
               <span>${content.name}</span>
            </a>
         `;
      });

      $("#menu-content").html(menuContent);
   }

   getContent()

   function getContent() {
      url = "{{ url('/subject/course/topic/content') }}"

      $.ajax({
         type: "get",
         url: url,
         data: {
               content_id:contentId,
         },
         success: function (response) {
               getContents();
               renderContent(response);
         },
         error: function (e) {
               swal('Gagal Mengambil Data !')
         }
      });
   }

   function renderContent(data) {
      if (data.status === 'DRAFT') {
         $('#btn-save').prop('disabled', false);
         $('#btn-publish').html('<i class="icon-cloud-upload mr-2"></i>Terbitkan');
         $('input[type=text][name=title]').prop('disabled', false);
         $('input[type=number][name=estimation]').prop('disabled', false);
         $('input[type=number][name=activity_exp]').prop('disabled', false);
         editor.isReadOnly = false;
      } else if (data.status === 'PUBLISHED') {
         $('#btn-save').prop('disabled', true);
         $('#btn-publish').html('<i class="icon-cloud-upload mr-2"></i>Edit');
         $('input[type=text][name=title]').prop('disabled', true);
         $('input[type=number][name=estimation]').prop('disabled', true);
         $('input[type=number][name=activity_exp]').prop('disabled', true);
         editor.isReadOnly = true;
      }

      $('input[type=text][name=title]').val(data.name);
      $('input[type=number][name=estimation]').val(data.estimation);
      $('input[type=number][name=activity_exp]').val(data.experience);
      editor.setData(data.content);
   }

   function updateContent() {
      let title = $('input[type=text][name=title]').val();
      let estimation = $('input[type=number][name=estimation]').val();
      let experience = $('input[type=number][name=activity_exp]').val();
      let content = editor.getData();

      url = "{{ url('/subject/course/topic/content') }}"

      $.ajax({
         type: "patch",
         url: url,
         data: {
               topic_id:topicId,
               content_id:contentId,
               title:title,
               estimation:estimation,
               experience:experience,
               content:content
         },
         beforeSend: function (response) {
               $('#btn-save').html('<i class="fa fa-save mr-2"></i>Menyimpan ...');
         },
         success: function (response) {
               getContents();
               renderContent(response);
               swal({
                  title: "Ulasan berhasil disimpan!",
                  text: "Terbitkan ulasan?",
                  confirmButtonText: "Ya",
                  confirmButtonColor: "#007bff",
                  showCancelButton: true,
                  cancelButtonText: "Tidak",
                  closeOnConfirm: false,
               }, function () {
                     publishContent();
               });
               $('#btn-save').html('<i class="fa fa-save mr-2"></i>Simpan');
         },
         error: function (e) {
               swal('Gagal Memperbarui Data!')
               $('#btn-save').html('<i class="fa fa-save mr-2"></i>Simpan');
         }
      });
   }

   function publishContent(){
      let title = $('input[type=text][name=title]').val();
      let status = $('#btn-publish').html() === '<i class="icon-cloud-upload mr-2"></i>Edit' ? 'DRAFT' : 'PUBLISHED';
      let estimation = $('input[type=number][name=estimation]').val();
      let experience = $('input[type=number][name=activity_exp]').val();
      let content = editor.getData();

      if ((title === '' || (estimation === '0' || estimation === '') || content === '') && status === 'PUBLISHED'){
         swal({
            title: "Judul, Estimasi, dan Konten tidak boleh kosong",
            text: "Isi judul, estimasi, dan konten terlebih dahulu untuk menerbitkan ulasan",
            closeOnConfirm: false,
         });
      } else if (status === 'PUBLISHED') {
         swal({
            title: "Sudah simpan ulasan?",
            text: "Harap menyimpan ulasan terlebih dahulu sebelum diterbitkan",
            confirmButtonText: "Sudah",
            confirmButtonColor: "#007bff",
            showCancelButton: true,
            cancelButtonText: "Belum",
         }, function () {
            window.location = `{{ url('/subject/'. $subject_id .'/course/'. $course_id .'/topic/'. $topic_id .'/content/'. $content_id .'/publish/${status}') }}`;
         });
      } else {
         swal({
            title: "Ingin mengubah ulasan?",
            text: "Ulasan tidak dapat diakses oleh murid jika dalam keadaan edit (draft)",
            confirmButtonText: "Ubah",
            confirmButtonColor: "#007bff",
            showCancelButton: true,
            cancelButtonText: "Tidak",
         }, function () {
         window.location = `{{ url('/subject/'. $subject_id .'/course/'. $course_id .'/topic/'. $topic_id .'/content/'. $content_id .'/publish/${status}') }}`;
         });
      }
   }
</script>
@endsection
