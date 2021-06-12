@extends('base')
@section('plugin')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<x-page-header :name="$page"/>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @isset($sdCount)
            <div class="col-lg-6 col-9">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$sdCount}}</h3>

                        <p>Total Siswa SD</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('student.sd')}}" class="small-box-footer">Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            @endisset
            @isset($smpCount)
            <div class="col-lg-6 col-9">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$smpCount}}</h3>

                        <p>Total Siswa SMP</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('student.smp')}}" class="small-box-footer">Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            @endisset
            @isset($studentCount)
            <div class="col-lg-12 col-12">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$studentCount}}</h3>

                        <p>Total Siswa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('siswa.index')}}" class="small-box-footer">Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            @endisset
        </div>
        <!-- /.row -->
        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Total Siswa Antar Sekolah</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Sekolah</th>
                    <th>Total Siswa</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($schools as $key => $school)
                    <tr>
                        <td>{{$schools->firstItem() + $key}}</td>
                        <td>{{$school->name}}</td>
                        <td>{{$school->students_count}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{$schools->setPath(url()->current())->links('pagination::bootstrap-4')}}
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        <section>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pencarian Data Siswa</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('dashboard.search')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if (auth()->guard("admin")->check())
                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <select class="form-control select2" style="width: 100%;" name="school_id">
                                @foreach ($schools as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
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
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" placeholder="masukan NISN"
                                value="{{old('nisn',$request->nisn ?? "")}}" required>
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
                                            src="{{asset('storage/avatars/default.jpg')}}" alt="User profile picture">
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
                                        <li class="nav-item"><a class="nav-link active" href="#settings"
                                                data-toggle="tab">Biodata</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">

                                        <div class="active tab-pane" id="settings">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>NISN</td>
                                                        <td>{{$student->nisn}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>{{$student->name}}</td>
                                                    </tr>
                                                    {{-- <tr>
                                            <td>Alamat</td>
                                            <td>{{$student->address}}</td>
                                                    </tr> --}}
                                                    <tr>
                                                        <td>Tempat Lahir</td>
                                                        <td>{{$student->birth_place}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Lahir</td>
                                                        <td>{{date('d-m-Y', strtotime($student->birth_date))}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Orang Tua</td>
                                                        <td>{{$student->father_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Agama</td>
                                                        <td>{{$student->religion}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Kelamin</td>
                                                        <td>{{$student->gender}}</td>
                                                    </tr>
                                                    {{--
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

                                                    --}}
                                                    <tr>
                                                        <td>Nama Wali</td>
                                                        <td>{{$student->guardian_name ?? "-"}}</td>
                                                    </tr>
                                                    {{-- <tr>
                                            <td>Nomor HP Wali</td>
                                            <td>{{$student->guardian_phone ?? "-"}}</td>
                                                    </tr> --}}
                                                    <tr>
                                                        <td>Asal Sekolah</td>
                                                        <td>{{$student->school->name}}</td>
                                                    </tr>
                                                    {{-- <tr>
                                            <td>Angkatan Tahun</td>
                                            <td>{{$student->entry_year}}</td>
                                                    </tr>
                                                    --}}
                                                    <tr>
                                                        <td>Lulus Tahun</td>
                                                        <td>{{$student->graduated_year}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tahun Pelajaran</td>
                                                        <td>{{$student->school_year}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nomor Ijazah</td>
                                                        <td>{{$student->ijazah_number ?? "data tidak ada"}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ijazah</td>
                                                        @if ($student->ijazah)
                                                        <td><a
                                                                href="{{route('admin.download',['type'=>"certificates",'name'=>$student->ijazah ?? 'default'])}}">Download</a>
                                                        </td>
                                                        @else
                                                        <td>Data tidak ada</td>
                                                        @endif

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
