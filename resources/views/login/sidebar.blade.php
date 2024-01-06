<!-- sidebar -->
<aside class="sidebar">
    <ul class="sidebar__nav">
        <li class="sidebar__item sidebar__item--header">Dashboard</li>
        <li class="sidebar__item">
            <a href="{{ route('admin') }}"><span class="fa fa-home"></span> Home</a>
        </li>
        <li class="sidebar__item">
            <a class="sidebar__btn-dropdown" href="#">
                <span class="fa fa-user"></span> User siswa
            </a>
            <ul class="sidebar__dropdown">
                <li class="sidebar__dropdown-item"><a href="{{route('tambah.user')}}">Tambah</a></li>
                <li class="sidebar__dropdown-item"><a href="{{ route('action.user') }}">Aksi user</a></li>
        </ul>
        </li>
        <li class="sidebar__item">
            <a href="#"><span class="fa fa-area-chart"></span> Kemajuan</a>
        </li>

        <li class="sidebar__item sidebar__item--header mt-3">Konten</li>
        <li class="sidebar__item sidebar__item--dropdown-active">
            <a class="sidebar__btn-dropdown" href="#">
                <span class="fa fa-file-text"></span> Artikel
            </a>
            <ul class="sidebar__dropdown sidebar__dropdown--show">
                <li class="sidebar__dropdown-item sidebar__dropdown-item--active"><a href="#">HTML</a></li>
                <li class="sidebar__dropdown-item"><a href="#">CSS</a></li>
            </ul>
        </li>
        <li class="sidebar__item">
            <a class="sidebar__btn-dropdown" href="#">
                <span class="fa fa-video-camera"></span> Video
            </a>
            <ul class="sidebar__dropdown">
                <li class="sidebar__dropdown-item"><a href="#">PHP</a></li>
                <li class="sidebar__dropdown-item"><a href="#">Javascript</a></li>
        </ul>
        </li>
        <li class="sidebar__item">
            <a href="{{ route('admin.logout') }}"><span class="fa fa-sign-out"></span> Logout</a>
        </li>
    </ul>
</aside>
