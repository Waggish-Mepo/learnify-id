<li class="{{ Request::is('student/subject/*/course/*') && request()->route('course_id') == '1' ? 'active' : '' }}">
    <a href="{{ url('/student/subject/'.'matematika'.'/course/'.'1'.'/detail') }}"><i class="icon-book-open"></i><span>bentuk-bentuk aljabar</span></a>
</li>