@foreach ($subjects as $thisSubject)
    <li class="{{ Request::is('student/subject/*') && request()->route('subject_id') == $thisSubject['id'] ? 'active' : '' }}">
        <a href="{{ url('/student/subject/'.$thisSubject['id'].'/course/') }}"><i class="icon-book-open"></i><span>{{ $thisSubject['name'] }}</span></a>
    </li>
@endforeach