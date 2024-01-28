@extends("user/layout/master")
@section("title", "Dashboard user")
@section("main")
<!-- <div class="d-flex align-items-center mt-5 mb-5" style="height: 100vh;"> -->
<div class="p-5">
    <div class="container">
        <div class="card border-0">
            <div class="card-body shadow">
                <div class="card-title">
                    <h2 class="text-center">Hallo, {{$value->name}} 👋</h2>
                    <div class="d-flex align-items-center justify-content-center">
                        <hr style="border: 1px solid black; width: 250px; margin-top: 10px;">
                    </div>
                    <div class="container mt-3">
                        <form method="POST" action="{{route('user.simpan')}}">
                            @csrf
                            <label for="deskripsi"> <strong>Deskripsi: </strong> </label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" cols="80" class="form-control mb-3 mt-1" placeholder="Deskripsi"></textarea>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="card" style="width:300px;">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div id="my_camera"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <input type=button value="Ambil gambar" onClick="take_snapshot()" class="btn btn-secondary">
                                <input type="hidden" name="image" class="image-tag">
                            </div>
                            <div id="sembunyikan" style="display: none;">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="card" style="width:300px;">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div id="results">Hasil foto anda setelah ambil gambar disini...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="d-flex align-items-center justify-content-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div id="results">Hasil foto anda setelah ambil gambar disini...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-12 text-center">
                                    <br/>
                                    <input type="submit" name="" value="Absen" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                        @error("image")
                            <div class="alert alert--danger">
                                <div class="alert__icon">
                                    <span class="fa fa-ban"></span>
                                </div>
                                <div class="alert__description">
                                    <p>Gambar harus ada, silahkan hubungi administrator!</p>
                                </div>
                                <div class="alert__action">
                                    <a class="alert__close-btn">&times;</a>
                                </div>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push("script")

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

<script language="JavaScript">
    Webcam.set({
        width: 300,
        height: 200,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach( '#my_camera' );

    function take_snapshot() {
        document.getElementById("sembunyikan").style.display = "block";
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'" style="max-width: 100%; height: auto;"/>';
        } );
    }

</script>


@endpush
@endsection
