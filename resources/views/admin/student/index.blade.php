@extends('base')
@section('plugin')
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection
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
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-sm">
                                    Import Data Siswa
                                </button>
                                <a href="{{route('siswa.create')}}" class="btn btn-primary btn-sm">Tambah Data</a>
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
                            <th>NISN</th>
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
                                    <td>{{$student->nisn}}</td>
                                    <td>{{$student->school_year}}</td>
                                    <td>{{$student->father_name}}</td>
                                    <td>{{$student->school->name ?? ""}}</td>
                                    <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-info" href="{{route('siswa.show',$student->id)}}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-warning" href="{{route('siswa.edit',$student->id)}}"><i
                                                    class="fa fa-pen"></i></a>
                                            <form action="{{route('siswa.destroy',$student->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete-data" type="submit"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
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
        <div class="modal fade" id="modal-sm">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Import Data Siswa</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{route('student.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <p>Pastikan mengikuti format excel yang telah disediakan sebelum melakukan import data</p>
                    <p><a href="{{route('student.format.export')}}" class="btn btn-success btn-sm">Download Format Excel</a></p>

                        <div class="form-group">
                            <label for="studentImport">Upload File Excel</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="studentImport" name="studentImport" required>
                                    <label class="custom-file-label" for="studentImport">Pilih file</label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="page" value="{{$page}}">

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Proses</button>
                </div>
              </div>
            </form>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('javascript')
<!-- bs-custom-file-input -->
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        bsCustomFileInput.init();

    });
  </script>
@endsection
