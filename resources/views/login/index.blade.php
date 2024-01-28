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
    <link rel="icon" href="https://incrustwerush.org/img/site/icon.ico">
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

                        <!-- Captcha -->
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>&nbsp;
                            <button type="button" class="btn btn-danger" id="reload">&#x21bb;</button>
                        </div>
                        <input id="captcha" type="text" class="form-control col-md-12 mt-2 @error('captcha') is-invalid @enderror" placeholder="Masukan kode captcha..." name="captcha">
                        @error("captcha")
                            <div class="invalid-feedback">
                                Captcha harus benar!
                            </div>
                        @enderror
                        <div class="login__form-action mt-3">
                            <!-- <button type="submit" class="btn btn--blue col-md-12 mb-2 mb-sm-0">Login</button> -->
                            <input type="submit" name="submit" class="btn btn--blue col-md-12 mb-2 mb-sm-0" value="Login">
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('login.create') }}" class="btn btn--link mb-3">Buat Akun</a>
        </div><!-- login -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        $(document).ready(function () {
            $('#reload').click(function () {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('reload-captcha') }}",
                    success: function (data) {
                        $(".captcha span").html(data.captcha);
                    },
                    error: function () {
                        console.log('Error loading captcha');
                    }
                });
            });
        });
        @if(session('error'))
            Swal.fire({
              title: "Gagal!",
              text: "Username atau password salah!",
              icon: "error"
            });
        @endif
        @if(session('not_acc'))
            Swal.fire({
              title: "Gagal!",
              text: "Akun belum aktif, silahkan hubungi operator!",
              icon: "error"
            });
        @endif
    </script>

</body>
</html>
