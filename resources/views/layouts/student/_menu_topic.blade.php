@foreach ($courses as $thisCourse)
    <li class="{{ Request::is('student/subject/*/course/*/topic') && request()->route('course_id') == $thisCourse['id'] ? 'active' : '' }}">
        <a href="{{ url('/student/subject/'.$subject['id'].'/course/'.$course['id'].'/topic') }}"><i class="icon-book-open"></i><span>{{ $thisCourse['description'] }}</span></a>
    </li>
@endforeach