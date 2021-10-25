@extends('base')
@section('content')
<!-- Content Header (Page header) -->
<x-page-header name="Surat keluar"/>
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
                                <a href="{{route('surat-keluar.create')}}" class="btn btn-primary btn-sm">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">No</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Jenis Surat</th>
                            <th>Tujuan</th>
                            <th>Keterangan</th>
                            <th>Yang Mengesahkan/Tanda Terima</th>
                            <th>File Surat</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $x=1?>
                            @foreach ($outLetters as $key => $outLetter)
                                <tr>
                                    <td>{{$outLetters->firstItem() + $key}}</td>
                                    <td>{{$outLetter->ref_number}}</td>
                                    <td>{{$outLetter->date}}</td>
                                    <td>{{$outLetter->type}}</td>
                                    <td>{{$outLetter->purpose}}</td>
                                    <td>{{$outLetter->description}}</td>
                                    <td>{{$outLetter->validator}}</td>
                                    <td>
                                        <form action="{{route('outletter.print')}}" method="POST" target="_blank">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$outLetter->id}}">
                                            <button type="submit" class="btn btn-primary">Print</button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-warning" href="{{route('surat-keluar.edit',$outLetter->id)}}"><i
                                                    class="fa fa-pen"></i></a>
                                            <form action="{{route('surat-keluar.destroy',$outLetter->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete-data" type="submit"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    {{$outLetters->setPath(url()->current())->links('pagination::bootstrap-4')}}
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
