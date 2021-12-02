@foreach ($courses as $course)
    <li class="{{ Request::is('subject/*/course/*') && request()->route('course_id') == $course['id'] ? 'active' : '' }}">
        <a href="{{ route('teacher.subject.course', ['subject_id' => $subject['id'],'course_id' => $course['id']]) }}" class="text-capitalize">
            <i class="icon-book-open"></i><span>{{ $course['description'] }}</span>
        </a>
    </li>
@endforeach
