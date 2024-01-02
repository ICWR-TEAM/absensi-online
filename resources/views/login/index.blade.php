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
                        <input type="password" name="password" value="{{ old('password') }}" placeholder="Password..." class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <div class="invalid-feedback">
                            Password tidak boleh kosong!
                        </div>
                        @enderror
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
                    </form>
                </div>
            </div>
            <a href="{{ route('login.create') }}" class="btn btn--link mb-3">Buat Akun</a>
        </div><!-- login -->
    </div>

</body>
</html>
