<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'SIARJU') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}"">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}"">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}"">
</head>
<body class="hold-transition login-page" style="height: 70vh">
<div class="login-box" style="width: 80%">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>SISTEM</b></a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Hasil Pencarian Siswa Berdasarkan NISN</p>

        <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Tahun Pelajaran</th>
                <th>Nama Orang Tua</th>
                <th>Asal Sekolah</th>
                <th>Nomor Ijazah</th>
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
                        <td>{{$student->school->name}}</td>
                        <td>{{$student->ijazah_number}}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a href="{{url('/')}}" class="btn btn-danger btn-block">Kembali</a>
    </div>
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
