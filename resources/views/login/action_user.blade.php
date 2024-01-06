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
    <pre>
        <table id="users-table" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="50px">No</th>
              <th width="250px">Nama</th>
              <th width="200px">email</th>
              <th width="150px">Role</th>
              <th width="100px">Accept</th>
              <th width="150px">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach($data as $d)
              <tr>
                  <td>1</td>
                  <td>{{ $d->name }}</td>
                  <td>{{$d->email}}</td>
                  <td>{{$d->role}}</td>
                  <td><div class="badge @if($d->accept=='yes') badge-primary @else badge-warning @endif">{{$d->accept}}</div></td>
                  <td>@if($d->accept=="no")<a style="font-size: 15px;" href="@if($d->accept=='no') {{url('admin/user/accept/'.$d->id)}} @endif" class="badge badge-success text-white">Terima</a>@endif <a href="{{url('admin/user/delete/'.$d->id)}}" style="font-size: 15px;" class="badge badge-danger text-white">Delete</a></td>
              </tr>
              @endforeach
          </tbody>
        </table>
    </pre>

</main>
@push("script")

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#users-table").DataTable();
    });
</script>
@endpush
@endsection
