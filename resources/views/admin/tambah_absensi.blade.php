@extends("layout_dashboard/master")
@section("title","Tambah presensi")
@section("main")

<!-- main -->
<main class="main main--ml-sidebar-width">
    <div class="row">
        <header class="main__header col-12 mb-2">
            <div class="main__title">
                <h4>Tambah presensi</h4>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah presensi</li>
                </ul>
            </div>
        </header>
    </div><!-- row -->
    <form method="post" action="{{route('tambah.absensi')}}">
        @csrf
        <div class="card">
            <div class="card-body">
                <strong>Buka atau tutup presensi:</strong>
                <br>
                <input type="radio" name="buka_atau_tutup" value="buka" id="buka" @if($value->buka_atau_tutup==="buka") checked @endif> <label for="buka">Buka</label>
                <br>
                <input type="radio" name="buka_atau_tutup" value="tutup" id="tutup" @if($value->buka_atau_tutup==="tutup") checked @endif> <label for="tutup">Tutup</label>
                @error("buka_atau_tutup")
                <div class="invalid-feedback">
                    Opsi harus ada yang dipilih!
                </div>
                @enderror
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <strong>Buka otomatis</strong>
                <br>
                <input type="radio" name="buka_otomatis" value="iya" id="change_buka_otomatis" @if(old('buka_otomatis', $value->buka_otomatis)==="iya") checked @endif> <label for="change_buka_otomatis">Iya</label>
                <br>
                <input type="radio" name="buka_otomatis" value="tidak" id="change_buka_otomatis_to_no" @if(old('buka_otomatis', $value->buka_otomatis)==="tidak") checked @endif> <label for="change_buka_otomatis_to_no">Tidak</label>
                @error("buka_otomatis")
                <small class="form-text form-text--red">Opsi harus ada yang dipilih!</small>
                @enderror

                <input type="hidden" name="waktu_buka" value="{{ $value->buka_otomatis == 'iya' ? $value->waktu_buka : '' }}" class="form-control" id="waktu_buka">

                @error("waktu_buka")
                <small class="form-text form-text--red">Waktu harus terisi, silahkan pilih "iya" kembali!</small>
                @enderror
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <strong>Tutup otomatis</strong>
                <br>
                <input type="radio" name="tutup_otomatis" value="iya" id="change_tutup_otomatis" @if(old('tutup_otomatis', $value->tutup_otomatis)==="iya") checked @endif> <label for="change_tutup_otomatis">Iya</label>
                <br>
                <input type="radio" name="tutup_otomatis" value="tidak" id="change_tutup_otomatis_to_no" @if(old('tutup_otomatis', $value->tutup_otomatis)==="tidak") checked @endif> <label for="change_tutup_otomatis_to_no">Tidak</label>
                @error("tutup_otomatis")
                <small class="form-text form-text--red">Opsi harus ada yang dipilih!</small>
                @enderror

                <input type="hidden" name="waktu_tutup" value="{{ $value->tutup_otomatis == 'iya' ? $value->waktu_tutup : '' }}" class="form-control" id="waktu_tutup">

                @error("waktu_tutup")
                <small class="form-text form-text--red">Waktu harus terisi, silahkan pilih "iya" kembali!</small>
                @enderror
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <strong>Deskripsi</strong>
                <textarea name="deskripsi" rows="8" cols="80" class="form-control mt-3" placeholder="Deskripsi...">{{ old("deskripsi") ? old("deskripsi") : $value->deskripsi }}</textarea>
            </div>
        </div>
        <!-- <input type="submit" name="submit" value="Tambah presensi" class="btn btn--blue col-md-12 mt-3"> -->
        <button type="submit" name="button" class="btn btn--blue col-md-12 mt-3">Tambah presensi</button>
    </form>

</main>

@push("script")
<script>
    //buka otomatis
    document.getElementById('change_buka_otomatis').addEventListener('click', function () {
        buka_otomatis();
    });
    document.getElementById('change_buka_otomatis_to_no').addEventListener('click', function () {
        buka_otomatis_to_no();
    });
    function buka_otomatis() {
        var value_waktubuka = document.getElementById("waktu_buka");
        value_waktubuka.type = "time";
    }
    function buka_otomatis_to_no() {
        var value_waktubuka = document.getElementById("waktu_buka");
        value_waktubuka.type = "hidden";
    }

    //tutup otomatis
    document.getElementById('change_tutup_otomatis').addEventListener('click', function () {
        tutup_otomatis();
    });
    document.getElementById('change_tutup_otomatis_to_no').addEventListener('click', function () {
        tutup_otomatis_to_no();
    });
    function tutup_otomatis() {
        var value_waktututup = document.getElementById("waktu_tutup");
        value_waktututup.type = "time";
    }
    function tutup_otomatis_to_no() {
        var value_waktututup = document.getElementById("waktu_tutup");
        value_waktututup.type = "hidden";
    }

    $(document).ready(function() {
      $('form').submit(function(e) {
        e.preventDefault();
        const form = this;

        Swal.fire({
          title: 'Apakah Anda akan memperbarui presensi?',
          html: "Jika yakin maka daftar riwayat presensi akan terhapus, jika ingin cek/mengunduh daftar riwayat presensi silahkan pencet [<a href='{{ route('admin.cek_riwayat') }}'>Disini</a>]!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, tambahkan!'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });

    @if(session("berhasil_update"))

    Swal.fire({
      title: "Berhasil!",
      text: "Anda berhasil memperbarui presensi!",
      icon: "success"
    });


    @elseif(session("gagal_update"))

    Swal.fire({
      title: "Gagal!",
      text: "Anda gagal update berita, silahkan cek konfigurasi!",
      icon: "error"
    });


    @endif






</script>

@endpush

@endsection("main")
