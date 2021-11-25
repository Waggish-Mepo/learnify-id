<li class="header">Main</li>
<li><a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i><span>Dashboard</span></a></li>
<li class="active open">
    <a href="#" class="has-arrow"><i class="icon-user"></i><span>Kelola Akun</span></a>
    <ul>
        {{-- params sementara, nanti diganti data id roles --}}
        <li><a href="{{ route('admin.statistik.account', ['role' => "STUDENT"]) }}">Akun Siswa</a></li>
        <li><a href="{{ route('admin.statistik.account', ['role' => "TEACHER"]) }}">Akun Guru</a></li>
        <li><a href="{{ route('admin.statistik.account', ['role' => "ADMIN"]) }}">Akun Admin</a></li>
    </ul>
</li>