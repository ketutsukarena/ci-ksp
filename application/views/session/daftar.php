<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register | KSP Winangun Kerthi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/dropify/dist/css/dropify.css">
  <style media="screen">
  body{
    background-color: #ecf0f5 !important;
  }
  .box-title{
    font-size: 14px !important;
    font-weight: 600;
    margin-top: 10px !important;
    text-transform: uppercase;
  }
  .sp-error{
    font-size: 12px;
    color: red;
  }
  .control-label{
    font-weight: 500 !important;
  }
  </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition">
  <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 20px;">
      <tbody>
        <tr>
          <td style="vertical-align: top; padding-bottom:10px;" align="center">
            <img src="<?php echo base_url();?>assets/img/logo-kop.png" alt="Logo Koperasi Winangun Kerthi" style="border:none"><br/>
            <img src="<?php echo base_url();?>assets/img/logo-text-kop.png" alt="admin Responsive web app kit" style="border:none">
          </td>
        </tr>
      </tbody>
    </table>
  <section class="content">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <div class="box box-info">
        <div class="box-body">
          <?php echo form_open_multipart('nasabah/insert','class="form-horizontal"'); ?>
          <div class="form-body">
              <h3 class="box-title">Data Diri</h3>
              <hr>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">No. KTP <span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" name="ktp" placeholder="Masukkan nomor induk kependudukan" value="<?php echo set_value('ktp');?>" type="text">
                            <div class="sp-error"><?php echo form_error('ktp'); ?></div>
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Nama <span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" name="nama" placeholder="Masukkan nama" value="<?php echo set_value('nama');?>" type="text">
                            <div class="sp-error"><?php echo form_error('nama'); ?></div>
                          </div>
                        </div>
                      </div>
                      <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label col-md-3">Jenis Kelamin <span style="color:red;">*</span></label>
                              <div class="col-md-9">
                                  <div class="radio-list">
                                      <label class="radio-inline">
                                          <input name="jns_kelamin" value="Pria" type="radio"> Pria </label>
                                      <label class="radio-inline">
                                          <input name="jns_kelamin" value="Wanita" type="radio"> Wanita </label>
                                  </div>
                                  <div class="sp-error"><?php echo form_error('jns_kelamin'); ?></div>
                              </div>
                          </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label col-md-3">Agama <span style="color:red;">*</span></label>
                              <div class="col-md-9">
                                  <select class="form-control" tabindex="1" name="agama">
                                    <option value="" disabled="" selected="">--- Pilihan ---</option>
                                      <option value="Hindu">Hindu</option>
                                      <option value="Islam">Islam</option>
                                      <option value="Budha">Budha</option>
                                      <option value="Kristen Katolik">Kristen Katolik</option>
                                      <option value="Kristen Protestan">Kristen Protestan</option>
                                  </select>
                                  <div class="sp-error"><?php echo form_error('agama'); ?></div>
                              </div>
                          </div>
                      </div>
                      <!--/span-->
                  </div>
                  <!--/row-->
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tempat Lahir <span style="color:red;">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control" name="tempat_lahir" placeholder="Masukkan tempat lahir" value="<?php echo set_value('tempat_lahir');?>" type="text">
                                <div class="sp-error"><?php echo form_error('tempat_lahir'); ?></div>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Lahir <span style="color:red;">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control" name="tgl_lahir" placeholder="dd/mm/yyyy" type="date">
                                <div class="sp-error"><?php echo form_error('tgl_lahir'); ?></div>
                            </div>
                        </div>
                </div>
              <!--/span-->
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Email <span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" name="email" placeholder="Masukkan email" value="<?php echo set_value('email');?>" type="text">
                            <div class="sp-error"><?php echo form_error('email'); ?></div>
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">No. HP <span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" name="no_hp" placeholder="Masukkan nomor handphone" value="<?php echo set_value('no_hp');?>" type="text">
                            <div class="sp-error"><?php echo form_error('no_hp'); ?></div>
                        </div>
                    </div>
                </div>
                <!--/span-->
                </div>
                <!--/row-->
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="control-label col-md-3">Alamat <span style="color:red;">*</span></label>
                          <div class="col-md-9">
                            <textarea class="form-control" name="alamat" rows="8" cols="50" placeholder="Masukkan alamat lengkap" value="<?php echo set_value('alamat');?>"></textarea>
                            <div class="sp-error"><?php echo form_error('alamat'); ?></div>
                          </div>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-3">Foto <span style="color:red;">*</span></label>
                            <div class="col-md-9">
                              <input type="file" id="input-file-now" class="dropify" name="img" />
                            </div>
                          </div>
                          </div>
                      </div>
                  </div>
                  <h3 class="box-title">Data Login</h3>
                  <hr>
                  <!--/row-->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Username <span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" name="user" placeholder="Masukkan username" value="<?php echo set_value('user');?>" type="text">
                            <div class="sp-error"><?php echo form_error('user'); ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Password <span style="color:red;">*</span></label>
                        <div class="col-md-9">
                          <input class="form-control" name="pass" placeholder="Masukkan password" value="<?php echo set_value('pass');?>" type="text">
                          <div class="sp-error"><?php echo form_error('pass'); ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <h3 class="box-title">Informasi Umum</h3>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-xs-2">-</label>
                            <div class="col-md-9 col-xs-9">
                                <p class="form-control-static">Dimohonkan setelah melakukan pendaftaran anggota pada website agar membawa fotocopy ktp dan fotocopy kartu keluarga ke kantor koperasi.</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-2 col-md-8">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                          </div>
                      </div>
                  </div>
            <?php echo form_close(); ?>
        </div>
      </div>
      </div>
    </div>
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 10px;">
    <tbody>
      <tr>
        <td style="vertical-align: top;" align="center">
          <p>Sudah punya akun? <a href="<?php echo base_url('auth')?>">Masuk</a></p>
        </td>
      </tr>
    </tbody>
  </table>
  </section>

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery file upload -->
<script src="<?php echo base_url()?>assets/plugins/dropify/dist/js/dropify.js"></script><script>
  $(document).ready(function() {
      $('.dropify').dropify();
    });
</script>
</body>
</html>
