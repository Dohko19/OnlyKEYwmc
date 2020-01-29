<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminLTE/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition lockscreen" style="background-color: #add8e6">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="{{ route('admin.users.index') }}">
        <img src="{{ url('images/logowmc.png') }}" width="200px" alt=""></a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">KEY</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="{{ url('images/key.png') }}" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form method="GET" action="{{ route('admin.index') }}" class="lockscreen-credentials">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Presiona para entrar" disabled>

        <div class="input-group-append">
          <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Bienvenido a KEY WMC
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2020 <b>
  </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="adminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
