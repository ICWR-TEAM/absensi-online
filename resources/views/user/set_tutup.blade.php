@extends("user/layout/master")
@section("title", "Presensi tutup")
@push("css")
<style>
.content {
    height: 100vh;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endpush
@section("main")
<div class="content">
    <div class="container">
        <div class=" d-flex justify-content-center">
            <div class="card border-danger shadow" style="min-width: 250px">
                <div class="card-body">
                    <div class=" d-flex justify-content-center">
                        <img src="{{ asset('img/stop.jpg') }}" alt=""  style="max-width: 250px;">
                    </div>
                    <p class="text-center text-danger">
                        Presensi ditutup, silahkan hubungi administrator untuk membukanya!
                        <br>
                        [ <a href="{{ route('user.logout') }}">Logout</a> ]
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
