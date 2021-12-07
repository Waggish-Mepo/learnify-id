@foreach ($activities as $thisActivity)
    <li class="{{ Request::is('subject/*/course/*/topic/*') && request()->route('activity_id') == $thisActivity['id'] ? 'active' : '' }}">
        <a href="{{ url('/subject/'.$subject['id'].'/course/'.$course['id'].'/topic/'.$topic['id'].'/activity/'. $thisActivity['id']) }}" class="text-capitalize"><i class="icon-puzzle"></i><span>{{ $thisActivity['name'] }}</span></a>
    </li>
@endforeach