@extends("layout_dashboard.master")
@section('title', 'Tambah user')
@section("main")

<!-- main -->
<main class="main main--ml-sidebar-width">
    <div class="row">
        <header class="main__header col-12 mb-2">
            <div class="main__title">
                <h4>Main</h4>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah user</li>
                </ul>
            </div>
        </header>

        <div class="container">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Tambah user</h5>
                <h6 class="card-subtitle mb-2 text-muted">Menambahkan user melalui file excel</h6>
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
                @if(session("berhasil_import"))
                <div class="alert alert--success">
                    <div class="alert__icon">
                        <span class="fa fa-check-circle"></span>
                    </div>
                    <div class="alert__description">
                        <p>Berhasil import user!</p>
                    </div>
                    <div class="alert__action">
                        <a class="alert__close-btn">&times;</a>
                    </div>
                </div><!-- alert -->
                @elseif(session("gagal_import"))
                <div class="alert alert--danger">
                    <div class="alert__icon">
                        <span class="fa fa-ban"></span>
                    </div>
                    <div class="alert__description">
                        <p>Gagal import user, silahkan hubungi administrator!</p>
                    </div>
                    <div class="alert__action">
                        <a class="alert__close-btn">&times;</a>
                    </div>
                </div><!-- alert -->
                @endif
                @if(session("gagal_import_duplicate"))
                <div class="alert alert--danger">
                    <div class="alert__icon">
                        <span class="fa fa-ban"></span>
                    </div>
                    <div class="alert__description">
                        <p>{{ session("gagal_import_duplicate") }}!</p>
                    </div>
                    <div class="alert__action">
                        <a class="alert__close-btn">&times;</a>
                    </div>
                </div><!-- alert -->
                @endif
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
                    @if(session("berhasil"))
                    <div class="alert alert--success mt-3">
                        <div class="alert__icon">
                            <span class="fa fa-check-circle"></span>
                        </div>
                        <div class="alert__description">
                            <p>Berhasil tambah user!</p>
                        </div>
                        <div class="alert__action">
                            <a class="alert__close-btn">&times;</a>
                        </div>
                    </div><!-- alert -->
                    @endif
                    @if(session("gagal"))
                    <div class="alert alert--danger mt-3">
                        <div class="alert__icon">
                            <span class="fa fa-ban"></span>
                        </div>
                        <div class="alert__description">
                            <p>Gagal tambah user, silahkan hubungi administrator!</p>
                        </div>
                        <div class="alert__action">
                            <a class="alert__close-btn">&times;</a>
                        </div>
                    </div>
                    @endif
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
</script>
@endpush
@endsection
