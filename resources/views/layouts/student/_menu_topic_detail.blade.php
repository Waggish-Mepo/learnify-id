@foreach ($topics as $thisTopic)
    <li class="{{ Request::is('student/subject/*/course/*/topic/*') && request()->route('topic_id') == $thisTopic['id'] ? 'active' : '' }}">
        <a href="{{ url('/student/subject/'.$subject['id'].'/course/'.$course['id'].'/topic/'.$thisTopic['id']) }}" class="text-capitalize"><i class="icon-notebook"></i><span>{{ $thisTopic['name'] }}</span></a>
    </li>
@endforeach