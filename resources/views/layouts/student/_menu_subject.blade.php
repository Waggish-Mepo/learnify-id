<li class="{{ Request::is('student/subject/*') && request()->route('subject_id') == 'matematika' ? 'active' : '' }}">
    <a href="{{ url('/student/subject/'.'matematika'.'/course/') }}"><i class="icon-book-open"></i><span>matematika | umum</span></a>
</li>