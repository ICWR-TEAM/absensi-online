@extends("user/layout/master")
@section("title", "Pembaruan administrator")
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
                        <img src="{{ asset('img/update.jpg') }}" alt=""  style="max-width: 250px;">
                    </div>
                    <br>
                    <p class="text-center text-danger">
                        Presensi belum update, silahkan hubungi administrator untuk pembaruan absensi!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
