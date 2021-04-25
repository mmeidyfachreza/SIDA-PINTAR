@extends('base')
@section('plugin')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <section>
              <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Pencarian Data Siswa</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{route('search.student')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <select class="form-control select2" style="width: 100%;" name="school">
                                @foreach ($schools as $data)
                                    <option value="{{$data}}">{{$data}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tingkat</label>
                            <select class="form-control select2" style="width: 100%;" name="level">
                                @foreach ($levels as $data)
                                    <option value="{{$data}}">{{$data}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" placeholder="masukan NIS" value="{{old('nis')}}" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                  </form>
                </div>
            </section>
            @isset($student)
            <section>
                <section class="content">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-3">

                          <!-- Profile Image -->
                          <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                              <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{asset('storage/avatars/default.jpg')}}"
                                     alt="User profile picture">
                              </div>

                              <h3 class="profile-username text-center">{{$student->name}}</h3>

                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->

                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                          <div class="card">
                            <div class="card-header p-2">
                              <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Biodata</a></li>
                              </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                              <div class="tab-content">

                                <div class="active tab-pane" id="settings">
                                    <table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <td>NIS</td>
                                            <td>{{$student->nis}}</td>
                                          </tr>
                                          <tr>
                                            <td>Nama</td>
                                            <td>{{$student->name}}</td>
                                          </tr>
                                          <tr>
                                            <td>Alamat</td>
                                            <td>{{$student->address}}</td>
                                          </tr>
                                          <tr>
                                            <td>Tempat Lahir</td>
                                            <td>{{$student->birth_place}}</td>
                                          </tr>
                                          <tr>
                                            <td>Tanggal Lahir</td>
                                            <td>{{$student->birth_date}}</td>
                                          </tr>
                                          <tr>
                                            <td>Agama</td>
                                            <td>{{$student->religion}}</td>
                                          </tr>
                                          <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>{{$student->gender}}</td>
                                          </tr>
                                          <tr>
                                            <td>Nama Ayah</td>
                                            <td>{{$student->father_name}}</td>
                                          </tr>
                                          <tr>
                                            <td>Nomor HP Ayah</td>
                                            <td>{{$student->father_phone}}</td>
                                          </tr>
                                          <tr>
                                            <td>Nama Ibu</td>
                                            <td>{{$student->mother_name}}</td>
                                          </tr>
                                          <tr>
                                            <td>Nomor HP Ibu</td>
                                            <td>{{$student->mother_phone}}</td>
                                          </tr>
                                          <tr>
                                            <td>Nama Wali</td>
                                            <td>{{$student->guardian_name}}</td>
                                          </tr>
                                          <tr>
                                            <td>Nomor HP Wali</td>
                                            <td>{{$student->guardian_phone}}</td>
                                          </tr>
                                          <tr>
                                            <td>Asal Sekolah</td>
                                            <td>{{$student->school}}</td>
                                          </tr>
                                          <tr>
                                            <td>Tingkat</td>
                                            <td>{{$student->level}}</td>
                                          </tr>
                                          <tr>
                                            <td>Angkatan Tahun</td>
                                            <td>{{$student->entry_year}}</td>
                                          </tr>
                                          <tr>
                                            <td>Lulus Tahun</td>
                                            <td>{{$student->graduated_year}}</td>
                                          </tr>
                                          <tr>
                                            <td>Ijazah</td>
                                            <td><a href="{{route('admin.download',['type'=>"certificates",'name'=>$student->certificate ?? 'default'])}}">Download File </a>(saat ini tidak bisa karena server gratis)</td>
                                          </tr>
                                          <tr>
                                            <td>Surat Pernyataan</td>
                                            <td><a href="{{route('admin.download',['type'=>"certificates",'name'=>$student->certificate ?? 'default'])}}">Download File </a>(saat ini tidak bisa karena server gratis)</td>
                                          </tr>

                                        </tbody>
                                      </table>
                                </div>
                                <!-- /.tab-pane -->
                              </div>
                              <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div><!-- /.container-fluid -->
                  </section>
              </section>
            @endisset



        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
@section('javascript')
<!-- Select2 -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        //Date picker
        $('#reservationdate2').datetimepicker({
            format: 'DD/MM/YYYY'
        });

    })

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
