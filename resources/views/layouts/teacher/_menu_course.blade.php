{{-- ini nanti diganti aja request nya yaa sesuai data dr controller --}}
<li class="{{ Request::is('subject/*/course/*') && request()->route('course_id') == 1 ? 'active' : '' }}">
    <a href="{{ url('/subject/'.'matematika'.'/course/'.'1') }}" class="text-capitalize"><i class="icon-book-open"></i><span>matematika | aljabar</span></a>
</li>
<li class="{{ Request::is('subject/*/course/*') && request()->route('course_id') == 2 ? 'active' : '' }}">
    <a href="" class="text-capitalize"><i class="icon-book-open"></i><span>matematika | bilbul</span></a>
</li>