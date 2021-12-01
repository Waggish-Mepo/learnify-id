
@foreach ($subjects as $subject)
    <li class="{{ Request::is('subject/*') && request()->route('subject_id') == $subject['id'] ? 'active' : '' }}">
        <a href="{{ route('teacher.subject', ['subject_id' => $subject['id']]) }}"><i class="icon-book-open"></i><span>{{ $subject['name'] }}</span></a>
    </li>
@endforeach