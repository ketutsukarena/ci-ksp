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
    <p class="login-box-msg">Silahkan login untuk melanjutkan aktivitas</p>

    <?php echo validation_errors();
      if($this->session->flashdata('gagal')){?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-warning"></i> Gagal!</h4>
          <?php echo $this->session->flashdata('gagal');?>
        </div>
      <?php }
      if($this->session->flashdata('berhasil')){?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
          <?php echo $this->session->flashdata('berhasil');?>
        </div>
      <?php } ?>
    <?php echo form_open('auth/updatepass'); ?>
      <input type="hidden" class="form-control" name="id_user" value="<?php echo $edit; ?>" required>
      <div class="form-group has-feedback">
        <input type="password" id="pw1" class="form-control form-password" placeholder="Masukkan password baru" name="newpass" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="pw2" class="form-control form-password" placeholder="Masukkan konfirmasi password baru"  required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <input type="checkbox" class="form-checkbox"> Show password
      <div class="row">
        <div class="col-xs-12">
          <button class="btn btn-primary btn-block btn-flat" type="submit">Submit</button>
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
<script type="text/javascript">
            window.onload = function () {
                document.getElementById("pw1").onchange = validatePassword;
                document.getElementById("pw2").onchange = validatePassword;
            }
            function validatePassword(){
                var pass2=document.getElementById("pw2").value;
                var pass1=document.getElementById("pw1").value;
                if(pass1!=pass2)
                    document.getElementById("pw2").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
                else
                    document.getElementById("pw2").setCustomValidity('');
            }
            	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('.form-password').attr('type','text');
			}else{
				$('.form-password').attr('type','password');
			}
		});
	});
        </script>
</body>
</html>
