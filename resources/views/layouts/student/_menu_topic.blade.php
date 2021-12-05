<li class="{{ Request::is('student/subject/*/course/*') && request()->route('course_id') == '1' ? 'active' : '' }}">
    <a href="{{ url('/student/subject/'.'matematika'.'/course/'.'1') }}"><i class="icon-book-open"></i><span>aljabar</span></a>
</li>