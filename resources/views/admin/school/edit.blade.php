@extends('base')
@section('plugin')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
                        <h3 class="card-title">Edit Data Sekolah</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('sekolah.update',$school->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Sekolah</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name', $school->name)}}"
                                    placeholder="Masukan Nama Sekolah" required>
                            </div>
                            <div class="form-group">
                                <label for="headmaster">Nama Kepala Sekolah</label>
                                <input type="text" class="form-control" id="headmaster" name="headmaster" value="{{old('headmaster', $school->headmaster)}}"
                                    placeholder="Masukan Nama Kepala Sekolah" required>
                            </div>
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="{{old('nip', $school->nip)}}"
                                    placeholder="Masukan NIP" required>
                            </div>
                            <div class="form-group">
                                <label>Tingkat Sekolah</label>
                                <select class="form-control select2" style="width: 100%;" name="level">
                                    @foreach ($levels as $level)
                                    <option value="{{$level}}" @if ($school->level==$level) selected @endif>{{$level}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="ijazah">Foto Siswa</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input class="custom-file-input" type="file" accept="image/*" name="photo" onchange="preview_image(event)">
                                        <label class="custom-file-label" for="photo">Pilih file</label>
                                    </div>
                                </div>
                                <br>
                                <img style="width:30%" id="output_image" src="{{asset('storage/photos/'.$school->photo)}}"/>
                            </div> --}}
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('sekolah.index')}}" class="btn btn-danger">Batal</a>
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
        //Date picker

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
