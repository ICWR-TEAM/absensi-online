<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman daftar</title>
    <link rel="stylesheet" href="{{ asset('/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dist/css/reza-admin.min.css') }}">
    <link rel="icon" href="{{ asset('/dist/img/Reza_Admin.ico') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="register">
            <div class="register__content mt-3">
                <div class="register__head">
                    <h5 class=""><h2>Buat Akun</h2></h5>
                </div>
                <div class="register__form" style="margin-top: -25px;">
                    <form method="post" enctype="application/x-www-form-urlencoded" class="mb-3">
                        @csrf
                        <label for=""> <strong>Nama:</strong> </label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama ..." class="form-control @error('nama') is-invalid @enderror" required>
                        @error("nama")
                            <div class="invalid-feedback">
                                Nama harus ada!
                            </div>
                        @enderror

                        <label for="" class="mt-3"> <strong>Email:</strong> </label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email ..." class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="invalid-feedback">
                                Format email salah!
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for=""> <strong>Password:</strong> </label>
                            <input type="password" name="password" value="" placeholder="Password ..." id="change_password"class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    Password harus mengandung karakter angka, huruf minimal 8 karakter, minimal 1 huruf kapital, minimal 1 simbol(@$!'%*#?&) dan harus sama dengan "ulangi password"!
                                </div>
                            @enderror
                            <div class="row container">
                                <input type="checkbox" name="" value="" onclick='click_hidden()' id="asd"> <label for="asd"><small id="hidden_password" class="form-text text-muted mt-2"> &nbsp;Lihat password</small></label>
                            </div>
                        </div>
                        <label for=""> <strong>Ulangi password:</strong> </label>
                        <input type="password" name="password_repeat" value="" placeholder="Ulangi Password ..." class="form-control @error('password_repeat') is-invalid @enderror" required>
                        @error('password_repeat')
                            <div class="invalid-feedback">
                                Ulangi password harus terisi!
                            </div>
                        @enderror

                        <!-- Captcha -->
                        <div class="captcha mt-3">
                            <span>{!! captcha_img() !!}</span>&nbsp;
                            <button type="button" class="btn btn-danger" id="reload">&#x21bb;</button>
                        </div>
                        <input id="captcha" type="text" class="form-control col-md-12 mt-2 @error('captcha') is-invalid @enderror" placeholder="Masukan kode captcha..." name="captcha">
                        @error("captcha")
                            <div class="invalid-feedback">
                                Captcha harus benar!
                            </div>
                        @enderror

                        <div class="register__form-action mt-3">
                            <button type="submit" class="btn btn--blue col-md-12">Daftar</button>
                        </div>
                    </form>
                    @if(session("berhasil"))
                    <div class="alert alert--success">
                        <div class="alert__icon">
                            <span class="fa fa-check-circle"></span>
                        </div>
                        <div class="alert__description">
                            <p>Berhasil membuat akun, silahkan menunggu konfirmasi administrator selanjutnya!</p>
                        </div>
                        <div class="alert__action">
                            <a class="alert__close-btn">&times;</a>
                        </div>
                    </div>
                    @elseif(session('gagal'))
                    <div class="alert alert--danger">
                        <div class="alert__icon">
                            <span class="fa fa-ban"></span>
                        </div>
                        <div class="alert__description">
                            <p>Gagal membuat akun, silahkan menghubungi administrator!</p>
                        </div>
                        <div class="alert__action">
                            <a class="alert__close-btn">&times;</a>
                        </div>
                    </div>
                    @endif
                    @if(session('email_exists'))
                    <div class="alert alert--danger">
                        <div class="alert__icon">
                            <span class="fa fa-ban"></span>
                        </div>
                        <div class="alert__description">
                            <p>Email sudah ada, silahkan hubungi operator!</p>
                        </div>
                        <div class="alert__action">
                            <a class="alert__close-btn">&times;</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <a href="{{ route('login') }}" class="btn btn--link mb-3">Sudah punya akun? Login!</a>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script type="text/javascript">
    function click_hidden(){
        var input_hidden = document.getElementById("change_password");
        var tulisan_hidden = document.getElementById("hidden_password");
        if (input_hidden.type == "password") {
            input_hidden.type = "text";
            tulisan_hidden.innerHTML = "&nbsp;Sembunyikan password"
        }else{
            input_hidden.type = "password";
            tulisan_hidden.innerHTML = "&nbsp;Lihat password"
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
    </script>
</body>
</html>
