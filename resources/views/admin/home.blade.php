@extends('layout_dashboard/master')

@section('title', 'home')

@section('main')
<!-- main -->
<main class="main main--ml-sidebar-width">
    <div class="row">
        <header class="main__header col-12 mb-2">
            <div class="main__title">
                <h4>Main</h4>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Main</li>
                </ul>
            </div>
        </header>
        @if($cek_hari==0)
        <div class="card text-white bg-danger mb-3 col-md-12">
          <div class="card-body">
            <h5 class="card-title">Peringatan!!!</h5>
            <p class="card-text">Silahkan update pengaturan presensi pada menu <a href='{{ route("tambah.absensi") }}' class="text-white">"Atur presensi > Buat presensi"</a>, jika tidak maka user tidak bisa melakukan presensi.</p>
          </div>
        </div>
        @endif
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
