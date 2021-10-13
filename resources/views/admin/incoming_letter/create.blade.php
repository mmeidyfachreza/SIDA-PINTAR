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
<x-page-header name="Surat Masuk"/>
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
                        <h3 class="card-title">Tambah Data Surat Masuk</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('surat-masuk.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ref_number">Nomor Surat</label>
                                <input type="text" class="form-control" id="ref_number" name="ref_number"
                                    placeholder="Masukan Nomor Surat" value="{{old('ref_number')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="date" placeholder="dd/mm/yyyy" value="{{old('date')}}" autocomplete="off" required/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content">Perihal/Isi Singkat</label>
                                <input type="text" class="form-control" id="content" name="content"
                                    placeholder="Masukan Perihal/Isi Singkat" value="{{old('content')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="purpose">Tujuan</label>
                                <input type="text" class="form-control" id="purpose" name="purpose"
                                    placeholder="Masukan Tujuan" value="{{old('purpose')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Keterangan</label>
                                <textarea class="form-control" id="description" name="description" id="description" cols="30" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">File Surat</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file" name="file">
                                        <label class="custom-file-label" for="file">Pilih file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('surat-masuk.index')}}" class="btn btn-danger">Batal</a>
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

        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });

    });
  </script>
@endsection
