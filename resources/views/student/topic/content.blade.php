@extends('layouts.app')

@section('content')
<div class="block-header px-4">
    <div class="d-flex flex-column m-auto pt-5">
        <h3 class="text-capitalize text-white text-center">{{ $title }}</h3>
        <div class="h-auto p-4 mt-3 w-100 bg-white shadow-sm rounded">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ url('/student/subject/'.$subject_id.'/course/'.$course_id.'/topic/'.$topic_id) }}" class="color-blue-2 d-flex align-items-center">
                    <i class="fa fa-sign-out"></i>
                    <span class="ml-1">Keluar</span>
                </a>
                <div></div>
            </div>
            <div id="content" class="color-black">{!! $content !!}</div>
            @if($finished === true)
                <button type="button" disabled class="btn bg-blue-2 text-white mt-3 float-right text-capitalize">sudah dibaca</button>
            @else
                <button type="button" onclick="finishContent()" class="btn bg-blue-2 text-white mt-3 float-right text-capitalize">tandai telah dibaca!</button>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function finishContent() {
        let contentId = "{!! $content_id !!}";
        let topicId = "{!! $topic_id !!}";

        let url = "{{ url('student/subject/course/topic/content') }}"
        $.ajax({
            type: "post",
            url: url,
            data: {
                content_id: contentId,
                topic_id: topicId,
            },
            success: function (response) {
                window.location.reload();
            }
        });
    }
</script>
<script src="{{asset('assets/js/pages/custom.js')}}"></script>
@endsection
