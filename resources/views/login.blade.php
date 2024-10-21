<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
</head>
<body class="hold-transition login-page login-layout">
  <div class="login-box">
    <div class="card card-outline login-card">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <form action="login.html" method="post">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><span class="fas fa-user"></span></span>
            </div>
            <input type="email" class="form-control" placeholder="Username">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><span class="fas fa-lock"></span></span>
            </div>
            <input type="password" class="form-control" placeholder="Password">
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-block btn-light custom-button-login">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
</body>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</html>