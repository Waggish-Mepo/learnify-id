<li class="header">Main</li>
<li><a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i><span>Dashboard</span></a></li>
<li>
    <a href="#" class="has-arrow"><i class="icon-user"></i><span>Kelola Akun</span></a>
    <ul>
        {{-- params sementara, nanti diganti data id roles --}}
        <li><a href="{{ route('admin.statistik.account', ['role_id' => 1]) }}">Akun Siswa</a></li>
        <li><a href="{{ route('admin.statistik.account', ['role_id' => 2]) }}">Akun Guru</a></li>
        <li><a href="{{ route('admin.statistik.account', ['role_id' => 3]) }}">Akun Admin</a></li>
    </ul>
</li>