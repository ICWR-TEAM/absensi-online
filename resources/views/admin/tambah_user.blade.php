@extends("login.master")
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
        </div>

    </div><!-- row -->
</main>

@endsection
