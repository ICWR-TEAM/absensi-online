@extends("login/master")

@section("title","Aksi user")

@section('main')
<!-- main -->
<main class="main main--ml-sidebar-width">
    <div class="row">
        <header class="main__header col-12 mb-2">
            <div class="main__title">
                <h4>Aksi user</h4>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                    <li class="breadcrumb-item active">Aksi user</li>
                </ul>
            </div>
        </header>
    </div><!-- row -->
    <table id="users-table" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th width="50px">No</th>
          <th width="400px">Nama</th>
          <th width="300px">email</th>
          <th width="150px">Role</th>
          <th>Accept</th>
        </tr>
      </thead>
      <tbody>
          @foreach($data as $d)
          <tr>
              <td>1</td>
              <td>{{ $d->name }}</td>
              <td>{{$d->email}}</td>
              <td>{{$d->role}}</td>
              <td>asd</td>
          </tr>
          @endforeach
      </tbody>
    </table>

</main>
@endsection
