<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Admin | KSP Winangun Kerthi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('')?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('')?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('')?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('')?>assets/dist/css/AdminLTE.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
    <center><img src="<?php echo base_url();?>assets/img/logo-kop.png" alt="Logo Koperasi Winangun Kerthi" title="Logo Koperasi Winangun Kerthi"></center>
    <p style="text-align:center;"><b>KSP Winangun Kerthi</b></p>
    <p class="login-box-msg">Login Admin</p>

    <?php echo form_open(''); ?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
      </div>
    <?php echo form_close();?>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="<?php echo base_url('auth')?>" class="btn btn-success btn-block btn-flat" type="submit">Login Anggota</a>
    </div>

  </div>
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url('')?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('')?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
