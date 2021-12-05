<li class="{{ Request::is('subject/*/exercise/*') && request()->route('subject_id') == 'matematika' ? 'active' : '' }}">
    <a href="{{ route('teacher.subject', ['subject_id' => "matematika"]) }}"><i class="icon-puzzle"></i><span>Latihan Minggu 1</span></a>
</li>
<li class="{{ Request::is('subject/*/exercise/*') && request()->route('subject_id') == 'bahasa_indonesia' ? 'active' : '' }}">
    <a href="{{ route('teacher.subject', ['subject_id' => "bahasa_indonesia"]) }}"><i class="icon-puzzle"></i><span>Latihan Minggu 2</span></a>
</li>