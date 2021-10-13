@extends('base')
@section('content')
<!-- Content Header (Page header) -->
<x-page-header name="Surat Masuk"/>
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
                                <a href="{{route('surat-masuk.create')}}" class="btn btn-primary btn-sm">Tambah</a>
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
                            <th>Perihal/Isi Singkat</th>
                            <th>Tujuan</th>
                            <th>Keterangan</th>
                            <th>File Surat</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $x=1?>
                            @foreach ($inLetters as $key => $inLetter)
                                <tr>
                                    <td>{{$inLetters->firstItem() + $key}}</td>
                                    <td>{{$inLetter->ref_number}}</td>
                                    <td>{{$inLetter->date}}</td>
                                    <td>{{$inLetter->purpose}}</td>
                                    <td>{{$inLetter->content}}</td>
                                    <td>{{$inLetter->description}}</td>
                                    <td><a href="{{route('letter.download',$inLetter->id)}}">Download</a></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-warning" href="{{route('surat-masuk.edit',$inLetter->id)}}"><i
                                                    class="fa fa-pen"></i></a>
                                            <form action="{{route('surat-masuk.destroy',$inLetter->id)}}" method="POST">
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
                    {{$inLetters->setPath(url()->current())->links('pagination::bootstrap-4')}}
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
