@foreach ($courses as $course)
@if (Request::is('subject/*/course/*'))
    <li class="{{request()->route('course_id') == $course['id'] ? 'active' : '' }}">
        <a href="{{ route('teacher.subject.course', ['subject_id' => $subject['id'],'course_id' => $course['id']]) }}" class="text-capitalize">
            <i class="icon-book-open"></i><span>{{ $course['description'] }}</span>
        </a>
    </li>
@else
    <li class="{{ request()->route('course_id') == $course['id'] ? 'active' : '' }}">
        <a href="{{ route('teacher.progress.subject.course', ['subject_id' => $subject['id'],'course_id' => $course['id']]) }}" class="text-capitalize">
            <i class="icon-book-open"></i><span>{{ $course['description'] }}</span>
        </a>
    </li>
@endif
    
@endforeach
