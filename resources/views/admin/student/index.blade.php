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
                                <a href="{{route('siswa.create')}}" class="btn btn-primary btn-sm">Tambah</a>
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
                            <th>NIS</th>
                            <th>Tahun Pelajaran</th>
                            <th>Nama Orang Tua</th>
                            <th>Asal Sekolah</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $x=1?>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{$x++}}</td>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->nis}}</td>
                                    <td>{{$student->school_year}}</td>
                                    <td>{{$student->father_name}}</td>
                                    <td>{{$student->school->name}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-warning" href="{{route('siswa.edit',$student->id)}}"><i
                                                    class="c-icon c-icon-1xl cil-pencil"></i></a>
                                            {{-- <a class="btn btn-info" href="{{route('siswa.show',$student->id)}}"><i class="fa fa-eye"></i></a>
                                            
                                            <form action="{{route('siswa.destroy',$student->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete-data" type="submit"><i
                                                        class="c-icon c-icon-1xl cil-trash"></i></button>
                                            </form> --}}
                                            <a class="btn btn-info" href="{{route('statement_letter',$student->id)}}" target="_blank"><i class="fa fa-file"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    {{$students->links('pagination::bootstrap-4')}}
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
