{{-- ulasan --}}
<li class="{{ Request::is('subject/*/course/*/topic/*/detail/*') && request()->route('content_id') == 1 ? 'active' : '' }}">
    <a href="{{ url('/subject/'.'matematika'.'/course/'.'1'.'/topic/'.'1'.'/detail/content/'.'1') }}" class="text-capitalize"><i class="icon-book-open"></i><span>materi bentuk-bentuk aljabar</span></a>
</li>
<div class="border my-2"></div>
{{-- latihan --}}
<li class="{{ Request::is('subject/*/course/*/topic/*/detail/*') && request()->route('activity_id') == 1 ? 'active' : '' }}">
    <a href="" class="text-capitalize"><i class="icon-book-open"></i><span>latihan bentuk-bentuk aljabar</span></a>
</li>
<div class="border my-2"></div>
{{-- ulangan --}}
<li class="{{ Request::is('subject/*/course/*/topic/*/detail/*') && request()->route('exam_id') == 1 ? 'active' : '' }}">
    <a href="" class="text-capitalize"><i class="icon-book-open"></i><span>ulangan bentuk-bentuk aljabar</span></a>
</li>