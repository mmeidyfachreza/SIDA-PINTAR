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
<x-page-header name="Surat Keluar"/>
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
                        <h3 class="card-title">Edit Data Surat Keluar</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('surat-keluar.update',$outLetter->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ref_number">Nomor Surat</label>
                                <input type="text" class="form-control" id="ref_number" name="ref_number"
                                    placeholder="Masukan Nomor Surat" value="{{old('ref_number',$outLetter->ref_number)}}" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="date" placeholder="dd/mm/yyyy" value="{{old('date',$outLetter->date)}}" autocomplete="off" required/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type">Jenis Surat</label>
                                <input type="text" class="form-control" id="type" name="type"
                                    placeholder="Masukan Jenis Surat" value="{{old('type',$outLetter->type)}}" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Perihal/Isi Singkat</label>
                                <textarea class="form-control" id="ckeditor" placeholder="Masukan Isi Surat" name="content">
                                    {{old('content',$outLetter->content)}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="purpose">Tujuan</label>
                                <input type="text" class="form-control" id="purpose" name="purpose"
                                    placeholder="Masukan Tujuan" value="{{old('purpose',$outLetter->purpose)}}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Keterangan</label>
                                <textarea class="form-control" id="description" name="description" id="description" cols="30" rows="2" required>{{old('description',$outLetter->description)}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="validator">Yang Mengesahkan/Tanda Terima</label>
                                <input type="text" class="form-control" id="validator" name="validator"
                                    placeholder="Masukan Yang Mengesahkan" value="{{old('validator',$outLetter->validator)}}" required>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('surat-keluar.index')}}" class="btn btn-danger">Batal</a>
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
<script src="{{asset('assets/plugins/ckeditor/build/ckeditor.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>

ClassicEditor
				.create( document.querySelector( '#ckeditor' ), {

				toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'outdent',
						'indent',
						'|',
						'blockQuote',
						'insertTable',
						'undo',
						'redo'
					]
				},
				language: 'en',
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
					licenseKey: '',



				} )
				.then( editor => {
					window.editor = editor;




				} )
				.catch( error => {
					console.error( 'Oops, something went wrong!' );
					console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
					console.warn( 'Build id: wn6y37zb5yf6-8ek9xs5l5res' );
					console.error( error );
				} );
    $(function () {
        //Initialize Select2 Elements
        bsCustomFileInput.init();

        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });

    });
  </script>
@endsection
