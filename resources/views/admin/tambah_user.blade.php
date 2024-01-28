@extends("layout_dashboard.master")
@section('title', 'Tambah user')
@section("main")

<!-- main -->
<main class="main main--ml-sidebar-width">
    <div class="row">
        <header class="main__header col-12 mb-2">
            <div class="main__title">
                <h4>Tambah user</h4>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah user</li>
                </ul>
            </div>
        </header>

        <div class="container">
            @if($cek_hari==0)
            <div class="card text-white bg-danger mb-3 col-md-12">
              <div class="card-body">
                <h5 class="card-title">Peringatan!!!</h5>
                <p class="card-text">Silahkan update pengaturan presensi pada menu <a href='{{ route("tambah.absensi") }}' class="text-white">"Atur presensi > Buat presensi"</a>, jika tidak maka user tidak bisa melakukan presensi.</p>
              </div>
            </div>
            @endif
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Tambah user</h5>
                <h6 class="card-subtitle mb-2 text-muted">Menambahkan user melalui file excel [<a href="{{ asset('file/contoh.xlsx') }}">Contoh file</a>]</h6>
                <small class="text-muted">*Catatan: data tidak boleh duplikat dengan tabel yang sudah ada & data excel minimal 8 baris.</small>
                <hr>
                <form method="post" action="{{route('import.excel.user')}}" enctype="multipart/form-data" class="mb-3">
                    @csrf
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="validatedCustomFile" required>
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <div class="invalid-feedback">{{ $errors->first('file') }}</div>
                    </div>
                    <input type="submit" name="submit" value="Tambahkan" class="btn btn--blue mt-3 col-md-12">
                </form>
              </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Tambah user manual</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Menambahkan user manual melalui form</h6>
                    <form class="" method="post">
                        @csrf
                        <label for="nama" class=""> <strong>Nama:</strong> </label>
                        <input type="text" name="nama" value="{{old('nama')}}" placeholder="Nama..." class="form-control @error('nama') is-invalid @enderror" required>
                        @error("nama")
                        <div class="invalid-feedback">
                            Nama harus terisi!
                        </div>
                        @enderror
                        <label for="email" class="mt-3"> <strong>Email:</strong> </label>
                        <input type="email" name="email" value="{{old('email')}}" placeholder="Email..." class="form-control @error('email') is-invalid @enderror" required>
                        @error("email")
                        <div class="invalid-feedback">
                            Format email tidak valid!
                        </div>
                        @enderror
                        <label for="role" class="mt-3"> <strong>Role:</strong> </label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                            <option>Pilih role...</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        @error("role")
                        <div class="invalid-feedback">
                            Role harus berisi admin/user!
                        </div>
                        @enderror
                        <label class="mt-3"> <strong>Password:</strong> </label>
                        <input type="" name="password" value="{{old('password')}}" placeholder="Password..." class="form-control @error('password') is-invalid @enderror" id="rubah_form_password" required>
                        @error('password')
                        <div class="invalid-feedback">
                            Password harus berisi minimal 8 karakter!
                        </div>
                        @enderror
                        <div class="row container">
                            <input type="checkbox" name="" onclick="click_change()">&nbsp;
                            <div id="rubah_tulisan_password">Sembunyikan password</div>
                        </div>
                        <input type="submit" name="submit" value="Tambah user" class="btn btn--blue col-md-12 mt-3">
                    </form>
                </div>
            </div>
        </div>

    </div><!-- row -->
</main>
@push("script")
<script type="text/javascript">
    function click_change() {
        var tulisan = document.getElementById("rubah_tulisan_password");
        var form = document.getElementById("rubah_form_password");
        if (form.type == "password") {
            tulisan.innerHTML = "Sembunyikan password";
            form.type = "text";
        }else {
            tulisan.innerHTML = "Tampilkan password";
            form.type = "password";
        }
    }

    @if(session("berhasil_import"))
    Swal.fire({
      title: "Berhasil!",
      text: "Anda berhasil import user dengan otomatis!",
      icon: "success"
    });
    @elseif(session("gagal_import"))
    Swal.fire({
      title: "Gagal!",
      text: "Anda gagal import user dengan otomatis, silahkan cek konfigurasi!",
      icon: "error"
    });
    @endif
    @if(session("gagal_import_duplicate"))
    Swal.fire({
      title: "Gagal!",
      text: "Data duplicate / data kurang, silahkan cek ulang!",
      icon: "error"
    });
    @endif
    @if(session("berhasil"))
    Swal.fire({
      title: "Berhasil!",
      text: "Berhasil tambah user!",
      icon: "success"
    });
    @endif
    @if(session("gagal"))
    Swal.fire({
      title: "Gagal!",
      text: "Gagal tambah user, silahkan cek konfigurasi!",
      icon: "error"
    });
    @endif
    @if(session("duplicate_email"))
    Swal.fire({
      title: "Gagal!",
      text: "Gagal tambah user, karena data duplicate!",
      icon: "error"
    });
    @endif
</script>
@endpush
@endsection
