<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'SIARJU') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>SIARJU</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        <div class="ribbon-wrapper">
            <div class="ribbon bg-primary">
              Admin
            </div>
          </div>
      <p class="login-box-msg">Masuk untuk akses sistem</p>

      <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Masukan Username" value="{{ old('username') }}" name="username" required autocomplete="username" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="form-group mt-4 mb-4">
            <div class="captcha">
                <span>{!!captcha_img("flat")!!}</span>
                <button type="button" class="btn btn-danger" class="reload" id="reload">
                    &#x21bb;
                </button>
            </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('captcha') is-invalid @enderror" placeholder="Masukan captcha"
                     name="captcha" required autocomplete="captcha" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">

                    </div>
                </div>
                @error('captcha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
          <div class="col-6">
            <a href="{{route('login')}}" class="btn btn-danger btn-block">Batal</a>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });

</script>
</body>
</html>
