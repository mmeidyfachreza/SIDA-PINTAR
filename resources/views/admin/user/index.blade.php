@extends('base')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <div style="float:left" class="card-title">List Data</div>
                        <div style="float:right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('akun-sekolah.create')}}" class="btn btn-primary btn-sm">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th>NPSN</th>
                            <th>Nomor HP</th>
                            <th>Asal Sekolah</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $x=1?>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$x++}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->npsn}}</td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>{{$user->school->name}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-info" href="{{route('akun-sekolah.show',$user->id)}}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-warning" href="{{route('akun-sekolah.edit',$user->id)}}"><i
                                                    class="fa fa-pen"></i></a>
                                            <form action="{{route('akun-sekolah.destroy',$user->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete-data" type="submit"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    {{$users->links('pagination::bootstrap-4')}}
                  </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
