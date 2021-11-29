<li class="header">Main</li>
<li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i><span>Dashboard</span></a></li>
<li class="{{ Request::is('admin/statistik/accounts/*') ? 'active open' : '' }}">
    <a href="#" class="has-arrow"><i class="icon-user"></i><span>Kelola Akun</span></a>
    <ul>
        {{-- params sementara, nanti diganti data id roles --}}
        <li class="{{ Request::is('admin/statistik/accounts/STUDENT') ? 'active open' : '' }}"><a href="{{ route('admin.statistik.accounts', ['role' => "STUDENT"]) }}">Akun Siswa</a></li>
        <li class="{{ Request::is('admin/statistik/accounts/TEACHER') ? 'active open' : '' }}"><a href="{{ route('admin.statistik.accounts', ['role' => "TEACHER"]) }}">Akun Guru</a></li>
        <li class="{{ Request::is('admin/statistik/accounts/ADMIN') ? 'active open' : '' }}"><a href="{{ route('admin.statistik.accounts', ['role' => "ADMIN"]) }}">Akun Admin</a></li>
    </ul>
</li>
<li class="{{ Request::is('admin/subjects') ? 'active' : '' }}"><a href="{{ route('admin.subjects') }}"><i class="icon-book-open"></i><span>Kelola Mapel</span></a></li>