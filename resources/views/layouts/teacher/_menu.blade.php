<li class="header">Main</li>
<li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="icon-home"></i><span>Dashboard</span></a></li>
<li class="{{ Request::is('progress') ? 'active' : '' }}"><a href="{{ route('teacher.progress-siswa') }}"><i class="fa fa-bar-chart"></i><span>Progress Siswa</span></a></li>