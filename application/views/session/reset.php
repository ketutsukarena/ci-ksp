<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | KSP Winangun Kerthi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('')?>assets/bower_components/bootstrap/dist/css/bootstrap.css">
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
  <!-- /.login-logo -->
  <div class="login-box-body">
    <center><img src="<?php echo base_url();?>assets/img/logo-kop.png" alt="Logo Koperasi Winangun Kerthi" title="Logo Koperasi Winangun Kerthi"></center>
    <p style="text-align:center;"><b>KSP Winangun Kerthi</b></p>
    <p class="login-box-msg">Email Terdaftar</p>
    <?php echo form_open('http://ajusadiyoga.000webhostapp.com/android/forget_emailweb.php'); ?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Silahkan masukkan email terdaftar" name="email" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button class="btn btn-primary btn-block btn-flat" type="submit">Kirim</button>
        </div>
      </div>
    <?php echo form_close(); ?>
    <br>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="<?php echo base_url('')?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('')?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
