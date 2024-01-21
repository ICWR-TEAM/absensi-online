<!-- sidebar -->
<aside class="sidebar">
    <ul class="sidebar__nav">
        <li class="sidebar__item sidebar__item--header">Dashboard</li>
        <li class="sidebar__item">
            <a href="{{ route('admin') }}"><span class="fa fa-home"></span> Home</a>
        </li>
        <li class="sidebar__item sidebar__item--header mt-3">Manajemen</li>
        <li class="sidebar__item">
            <a href="{{ route('tambah.absensi') }}"><span class="fa fa-plus"></span> Buat presensi</a>
        </li>
        <li class="sidebar__item">
            <a href="{{ route('admin.cek_riwayat') }}"><span class="fa fa-history"></span> Riwayat presensi</a>
        </li>
        <li class="sidebar__item">
            <a class="sidebar__btn-dropdown" href="#">
                <span class="fa fa-user"></span> User
            </a>
            <ul class="sidebar__dropdown">
                <li class="sidebar__dropdown-item"><a href="{{route('tambah.user')}}">Tambah</a></li>
                <li class="sidebar__dropdown-item"><a href="{{ route('action.user') }}">Aksi user</a></li>
            </ul>
        </li>
        <li class="sidebar__item sidebar__item--header mt-3">Sistem</li>
        <li class="sidebar__item">
            <a href="{{ route('admin.logout') }}"><span class="fa fa-sign-out"></span> Logout</a>
        </li>
    </ul>
</aside>
