@foreach ($topics as $thisTopic)
@if (Request::is('subject/*/course/*/topic/*'))
    <li class="{{ request()->route('topic_id') == $thisTopic['id'] ? 'active' : '' }}">
        <a href="{{ url('/subject/'.$subject['id'].'/course/'.$course['id'].'/topic/'.$thisTopic['id']) }}" class="text-capitalize"><i class="icon-notebook"></i><span>{{ $thisTopic['name'] }}</span></a>
    </li>
@else
    <li class="{{ request()->route('topic_id') == $thisTopic['id'] ? 'active' : '' }}">
        <a href="{{ url('/progress/subject/'.$subject['id'].'/course/'.$course['id'].'/topic/'.$thisTopic['id']) }}" class="text-capitalize"><i class="icon-notebook"></i><span>{{ $thisTopic['name'] }}</span></a>
    </li>
@endif
@endforeach