@extends('layout_dashboard/master')

@section('title', 'home')

@section('main')

<style media="screen">
    pre {
        white-space: pre-wrap;
        word-wrap: break-word;
        text-align: justify;
    }
</style>
<!-- main -->
<main class="main main--ml-sidebar-width">
    <div class="row">
        <header class="main__header col-12 mb-2">
            <div class="main__title">
                <h4>Dashboard</h4>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
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
        <div class="col-md-6 mb-2">
            <section class="info-box info-box--blue shadow border-0">
                <div class="info-box__icon"><span class="fa fa-shopping-bag"></span></div>
                <div class="info-box__description">
                    <h2>Jumlah Admin</h2>
                    <h1>{{ $data_admin->count() }}</h1>
                    <time class="">Terakhir: {{ $data_admin->latest("updated_at")->first()->updated_at }}</time>
                </div>
                <a class="info-box__btn-detail" href="{{ route('action.user') }}"><span class="fa fa-arrow-right"></span></a>
            </section>
        </div>
        <div class="col-md-6 mb-2">
            <section class="info-box info-box--blue shadow border-0">
                <div class="info-box__icon"><span class="fa fa-shopping-bag"></span></div>
                <div class="info-box__description">
                    <h2>Jumlah User</h2>
                    <h1>{{ $data_user->count() }}</h1>
                    <time class="">Terakhir: {{ $data_user->latest("updated_at")->first()->updated_at }}</time>
                </div>
                <a class="info-box__btn-detail" href="{{ route('action.user') }}"><span class="fa fa-arrow-right"></span></a>
            </section>
        </div>
        <div class="container mt-3">
            <div class="card border-0">
                <div class="card-body shadow">
                    <div class="card-title">
                        <h2>Data user</h2>
                        <hr>
                    </div>
                    <pre>
                        <table id="users-table" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="50px">No</th>
                                    <th width="250px">Nama</th>
                                    <th width="200px">email</th>
                                    <th width="150px">Role</th>
                                    <th width="100px">Accept</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach($data_user_in_table as $d)
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{$d->email}}</td>
                                    <td>{{$d->role}}</td>
                                    <td><div class="badge @if($d->accept=='yes') badge-primary @else badge-warning @endif">{{$d->accept}}</div></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </pre>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <div class="card border-0">
                <div class="card-body shadow">
                    <section class="chart">
                        <div class="chart__header">
                            <h6>Grafik presensi user {{ explode(" ", $data_absensi->updated_at)[0] }}</h6>
                        </div>
                        <div class="chart__body">
                            <canvas id="pie_chart"></canvas>
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </div><!-- row -->
</main>
@endsection
@if(session("success_login"))
    @push("script")
    <script type="text/javascript">
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          }
        });
        Toast.fire({
          icon: "success",
          title: "Berhasil login!"
        });
    </script>

    @endpush
@endif
    @push("script")
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        //datatables
        $(document).ready(function(){
            $("#users-table").DataTable();
        });

        // Pie Chart
        const pieChart = document.querySelector("#pie_chart").getContext('2d');
        let configPieChart = {
            type: 'pie',
            data: {
                labels: ['Yang sudah presensi','Yang belum presensi'],
                datasets: [{
                    data: [{{ $count_hadirRiwayatPresensi }}, {{ $count_allUsers - $count_hadirRiwayatPresensi }}],
                    backgroundColor: [
                        "#1bd741",
                        "#dd2525"
                    ]
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true
                },
                tooltips: {
                    titleFontFamily: 'sans-serif',
                    bodyFontFamily: 'sans-serif',
                    backgroundColor: '#fff',
                    titleFontColor: '#333',
                    bodyFontColor: '#333',
                    borderColor: '#e2e2e2',
                    borderWidth: '1',
                }
            }
        }
        new Chart(pieChart, configPieChart);
    </script>
    @endpush
