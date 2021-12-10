
@foreach ($subjects as $subject)
    @if (Request::is('subject/*'))
        <li class="{{ request()->route('subject_id') == $subject['id'] ? 'active' : '' }}">
            <a href="{{ route('teacher.subject', ['subject_id' => $subject['id']]) }}"><i class="icon-book-open"></i><span>{{ $subject['name'] }}</span></a>
        </li>
    @else
        <li class="{{ request()->route('subject_id') == $subject['id'] ? 'active' : '' }}">
            <a href="{{ route('teacher.progress.subject', ['subject_id' => $subject['id']]) }}"><i class="icon-book-open"></i><span>{{ $subject['name'] }}</span></a>
        </li>
    @endif
@endforeach
