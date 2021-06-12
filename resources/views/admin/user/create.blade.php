@extends('base')
@section('plugin')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<x-page-header :name="$page"/>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        <li>Proses Gagal!!!</li>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Akun Sekolah</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('akun-sekolah.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukan Nama" value="{{old('name')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Nomor HP</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="Masukan Nomor HP" value="{{old('phone_number')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="npsn">NPSN</label>
                                <input type="text" class="form-control" id="npsn" name="npsn"
                                    placeholder="Masukan NPSN" value="{{old('npsn')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukan Password" required>
                            </div>
                            @if (auth()->guard("admin")->check())
                            <div class="form-group">
                                <label>Nama Sekolah</label>
                                <select class="form-control select2" style="width: 100%;" name="school_id">
                                    @foreach ($schools as $school)
                                        <option value="{{$school->id}}" {{ $school->id === old('school_id') ? 'selected' : '' }}>{{$school->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            @else
                            <div class="form-group">
                                <label>Nama Sekolah</label>
                                <input type="text" value="{{$schools->name}}" class="form-control" disabled>
                                <input type="hidden" name="school_id" value="{{$schools->id}}">
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="photo">Foto Akun Sekolah</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input class="custom-file-input" type="file" accept="image/*" name="photo" onchange="preview_image(event)" required>
                                        <label class="custom-file-label" for="photo">Pilih file</label>
                                    </div>
                                </div>
                                <br>
                                <img style="width:30%" id="output_image"/>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('siswa.index')}}" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
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
@section('javascript')
<!-- Select2 -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        bsCustomFileInput.init();
        $('.select2').select2()

    });
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
  </script>
@endsection
