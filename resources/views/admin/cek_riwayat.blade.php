@extends("layout_dashboard/master")
@section("title", "Cek riwayat presensi")
@section("main")

<style media="screen">
    pre {
        white-space: pre-wrap;
        word-wrap: break-word;
        text-align: justify;
    }
</style>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<main class="main main--ml-sidebar-width">
    <div class="row">
        <header class="main__header col-12 mb-2">
            <div class="main__title">
                <h4>Riwayat presensi</h4>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Riwayat presensi</li>
                </ul>
            </div>
        </header>
        @if($cek_hari==0)
        <div class="container">
            <div class="card text-white bg-danger mb-3 col-md-12">
                <div class="card-body">
                    <h5 class="card-title">Peringatan!!!</h5>
                    <p class="card-text">Silahkan update pengaturan presensi pada menu <a href='{{ route("tambah.absensi") }}' class="text-white">"Atur presensi > Buat presensi"</a>, jika tidak maka user tidak bisa melakukan presensi.</p>
                </div>
            </div>
        </div>
        @endif
        <div class="container">
            <a href="{{ route('admin.download_riwayat') }}" class="btn btn--blue col-md-12"><i class="fa fa-download"></i> Download riwayat presensi</a>
            <pre>
                <table class="table table-hover table-striped" id="table">
                    <thead>
                        <tr><!-- berikan waktu download ///////////////////////////////////-->
                            <th width="25px">No</th>
                            <th width="200px">Nama</th>
                            <th width="250px">Gambar</th>
                            <th width="100px">Keterangan</th>
                            <th width="150px">Waktu presensi</th>
                            <th width="250px">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($riwayat as $var)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $var->name }}</td>
                            <td>@if($var->keterangan=="Hadir")<img src="{{ $var->gambar }}" alt="Gambar presensi..." width="200px"> @else <img src="{{ asset('img/user_icon.png') }}" alt="" width="200px"> @endif</td>
                            <td>@if($var->keterangan=="Hadir") <span class="badge badge-success">Hadir</span> @else <span class="badge badge-secondary">Belum presensi</span> @endif</td>
                            <td>@if($var->updated_at == null) Belum melakukan presensi @else {{ $var->updated_at }} @endif</td>
                            <td>{{ $var->deskripsi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </pre>
        </div>
    </div><!-- row -->
</main>
@endsection
@push("script")
<script type="text/javascript" src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
   $('#table').DataTable();
} );
</script>
@endpush
