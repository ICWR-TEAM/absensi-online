<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tag wajib -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Halaman Daftar . Reza Admin</title>

    <!-- pertama Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/dist/css/bootstrap.min.css') }}">
    <!-- kemudian Font awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!-- dan Reza Admin CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/dist/css/reza-admin.min.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/dist/img/Reza_Admin.ico') }}">
</head>
<body>

    <div class="container-fluid">
        <div class="register">
            <div class="register__content mt-3">
                <div class="register__head">
                    <h5 class=""><h2>Buat Akun</h2></h5>
                </div>
                <div class="register__form">
                    <form>
                        <div class="form-row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" name="first-name" placeholder="Nama Depan ..." class="form form--focus-blue mt-0">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="last-name" placeholder="Nama Belakang ..." class="form form--focus-blue mt-0">
                            </div>
                        </div>

                        <input type="email" name="email" placeholder="Email ..." class="form form--focus-blue">

                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password ..." class="form form--focus-blue">
                            <small id="input-help" class="form-text text-muted">Masukkan kombinasi dari paling sedikit 8 karakter dan angka</small>
                        </div>

                        <input type="password" name="password-repeat" placeholder="Ulangi Password ..." class="form form--focus-blue">

                        <div class="register__form-action mt-3">
                            <div class="form-check mb-2 mb-sm-0">
                                <input type="checkbox" name="input_check" id="input_check" class="form form--focus-blue">
                                <label for="input_check" class="label--check">Saya setuju dengan <a href="#">syarat-syarat</a></label>
                            </div>
                            <button type="submit" class="btn btn--blue">Daftar</button>
                        </div>
                    </form>
                </div>
                <div class="register__alt">
                    <a href="" class="btn btn--register-alt-google mb-2"><span class="fa fa-google"></span> Daftar dengan Google</a>
                    <a href="" class="btn btn--register-alt-facebook"><span class="fa fa-facebook"></span> Daftar dengan Facebook</a>
                </div>
            </div>
            <a href="" class="btn btn--link mb-3">Sudah punya akun? Login!</a>
        </div>
    </div>

</body>
</html>
