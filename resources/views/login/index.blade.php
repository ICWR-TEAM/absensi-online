<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tag wajib -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="{{ asset('/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dist/css/reza-admin.min.css') }}">
    <link rel="icon" href="{{ asset('/dist/img/Reza_Admin.ico') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="login">
            <div class="login__content mt-3">
                <div class="login__head">
                    <h2 class="mt-3">Selamat datang!</h2>
                </div>
                <div class="login__form">
                    <form method="post" enctype="application/x-www-form-urlencoded">
                        @csrf
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="example@example.com" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">
                                Email tidak boleh kosong!
                            </div>
                        @enderror
                        <label for="password" class="mt-3"><strong>Password:</strong></label>
                        <input type="password" id="change_password" name="password" value="{{ old('password') }}" placeholder="Password..." class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <div class="invalid-feedback">
                            Password tidak boleh kosong!
                        </div>
                        @enderror
                        <div class="container">
                            <div class="row">
                                <input type="checkbox" value="" onclick="click_change()" id="asd">
                                <label for="asd"><small id="hidden_password" class="form-text text-muted mt-2"> &nbsp;Lihat password</small></label>
                            </div>
                        </div>
                        <div class="login__form-action mt-3">
                            <!-- <button type="submit" class="btn btn--blue col-md-12 mb-2 mb-sm-0">Login</button> -->
                            <input type="submit" name="submit" class="btn btn--blue col-md-12 mb-2 mb-sm-0" value="Login">
                        </div>
                        @if(session('error'))
                            <div class="alert alert--danger mt-3">
                                <div class="alert__icon">
                                    <span class="fa fa-ban"></span>
                                </div>
                                <div class="alert__description">
                                    <p>Username atau password salah!</p>
                                </div>
                                <div class="alert__action">
                                    <a class="alert__close-btn">&times;</a>
                                </div>
                            </div>
                        @endif
                        @if(session('not_acc'))
                            <div class="alert alert--danger mt-3">
                                <div class="alert__icon">
                                    <span class="fa fa-ban"></span>
                                </div>
                                <div class="alert__description">
                                    <p>Akun belum aktif, silahkan hubungi operator!</p>
                                </div>
                                <div class="alert__action">
                                    <a class="alert__close-btn">&times;</a>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <a href="{{ route('login.create') }}" class="btn btn--link mb-3">Buat Akun</a>
        </div><!-- login -->
    </div>
    <script type="text/javascript">
        var tulisan_hidden = document.getElementById("hidden_password");
        var password = document.getElementById("change_password");
        function click_change() {
            if (password.type == "password") {
                tulisan_hidden.innerHTML = "&nbsp;Sembunyikan password";
                password.type = "text";
            }else{
                tulisan_hidden.innerHTML = "&nbsp;Lihat password";
                password.type = "password";
            }
        }
    </script>
</body>
</html>
