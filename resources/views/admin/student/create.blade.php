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
                        <h3 class="card-title">Tambah Data Siswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('siswa.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn"
                                    placeholder="Masukan NIS" value="{{old('nisn')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukan Nama" value="{{old('name')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="birth_place">Tempat Lahir</label>
                                <input type="text" class="form-control" id="birth_place" name="birth_place"
                                    placeholder="Masukan Tempat Lahir" value="{{old('birth_place')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                      <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="birth_date" placeholder="dd/mm/yyyy" value="{{old('birth_date')}}" autocomplete="off" required/>
                                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                            </div>
                            <div class="form-group">
                                <label for="father_name">Nama Orang Tua</label>
                                <input type="text" class="form-control" id="father_name" name="father_name"
                                    placeholder="Masukan Nama" value="{{old('father_name')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control select2" style="width: 100%;" name="gender">
                                    @foreach ($genders as $gender)
                                    <option value="{{$gender}}" {{ $gender == old('gender') ? 'selected' : '' }}>{{$gender}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <select class="form-control select2" style="width: 100%;" name="religion">
                                    @foreach ($religions as $religion)
                                    <option value="{{$religion}}" {{ $religion == old('religion') ? 'selected' : '' }}>{{$religion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" id="address" name="address" id="address" cols="30" rows="2" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="father_phone">Nomor HP Ayah</label>
                                <input type="text" class="form-control" id="father_phone" name="father_phone"
                                    placeholder="Masukan Nomor HP" required>
                            </div>
                            <div class="form-group">
                                <label for="mother_name">Nama Ibu</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name"
                                    placeholder="Masukan Nama" required>
                            </div>
                            <div class="form-group">
                                <label for="mother_phone">Nomor HP Ibu</label>
                                <input type="text" class="form-control" id="mother_phone" name="mother_phone"
                                    placeholder="Masukan Nomor HP" required>
                            </div>
                             --}}
                             <div class="form-group">
                                <label for="guardian_name">Nama Wali</label>
                                <input type="text" class="form-control" id="guardian_name" name="guardian_name"
                                    placeholder="Masukan Nama (tidak wajib)" value="{{old('guardian_name')}}">
                            </div>
                            {{-- <div class="form-group">
                                <label for="guardian_phone">Nomor HP Wali</label>
                                <input type="text" class="form-control" id="guardian_phone" name="guardian_phone"
                                    placeholder="Masukan Nomor HP (tidak wajib)">
                            </div> --}}
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

                            {{-- <div class="form-group">
                                <label>Tahun Angkatan</label>
                                  <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                      <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate2" name="entry_year" required/>
                                      <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                            </div>
                             --}}
                             <div class="form-group">
                                <label>Tahun Lulus</label>
                                  <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                      <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate3" name="graduated_year" value="{{old('graduated_year')}}" required/>
                                      <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                            </div>
                            <div class="form-group">
                                <label for="school_year">Tahun Pelajaran</label>
                                <input type="text" class="form-control" id="school_year" name="school_year"
                                    placeholder="Masukan Tahun Pelajaran" value="{{old('school_year')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="ijazah">Ijazah</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="ijazah" name="ijazah" required>
                                        <label class="custom-file-label" for="ijazah">Pilih file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ijazah_number">Nomor Ijazah</label>
                                <input type="text" class="form-control" id="ijazah_number" name="ijazah_number"
                                    placeholder="Masukan Nomor Ijazah" value="{{old('ijazah_number')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="ijazah">Foto Siswa</label>
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
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        //Date picker
        $('#reservationdate2').datetimepicker({
            format: 'YYYY'
        });
        $('#reservationdate3').datetimepicker({
            format: 'YYYY'
        });

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
