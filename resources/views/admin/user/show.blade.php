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
                                            <td><a href="{{route('admin.download',['type'=>"certificates",'name'=>$student->ijazah ?? 'default'])}}">Download</a></td>
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
                            <div class="card-footer">
                            @if (auth()->guard('admin')->check())
                                @if ($student->school->level=="sd")
                                    <a href="{{route('student.sd')}}" class="btn btn-danger">Kembali</a>
                                @elseif ($student->school->level=="smp")
                                    <a href="{{route('student.smp')}}" class="btn btn-danger">Kembali</a>
                                @endif
                            @else
                                <a href="{{route('siswa.index')}}" class="btn btn-danger">Kembali</a>
                            @endif
                        </div>
                          </div>
                          <!-- /.card -->
                        </div>
                        <!-- /.col -->
                      </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
