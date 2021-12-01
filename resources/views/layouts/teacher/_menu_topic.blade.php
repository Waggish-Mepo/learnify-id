{{-- ini nanti diganti aja request nya yaa sesuai data dr controller --}}
<li class="{{ Request::is('subject/*/course/*/topic/*') && request()->route('topic_id') == 1 ? 'active' : '' }}">
    <a href="{{ url('/subject/'.'matematika'.'/course/'.'1'.'/topic/'.'1') }}" class="text-capitalize"><i class="icon-book-open"></i><span>bentuk-bentuk aljabar</span></a>
</li>
<li class="{{ Request::is('subject/*/course/*/topic/*') && request()->route('topic_id') == 2 ? 'active' : '' }}">
    <a href="" class="text-capitalize"><i class="icon-book-open"></i><span>persamaan kuadrat</span></a>
</li>