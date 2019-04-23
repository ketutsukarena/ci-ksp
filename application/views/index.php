<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php if ($this->session->login['level']=="Ketua") {
      echo "Ketua | KSP Winangun Kerthi";
    }elseif ($this->session->login['level']=="Admin") {
      echo "Admin | KSP Winangun Kerthi";
    }elseif ($this->session->login['level']=="Bagian Tabungan") {
      echo "Bagian Tabungan | KSP Winangun Kerthi";
    }elseif ($this->session->login['level']=="Bagian Kredit") {
      echo "Bagian Kredit | KSP Winangun Kerthi";
    } ?>
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/style.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css')?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/morris.js/morris.css')?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/jvectormap/jquery-jvectormap.css')?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')?>">
  <!--Dropify-->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/dropify/dist/css/dropify.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>">
  <!-- Select2 -->
 <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.css')?>">
 <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>KSP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>KSP</b> Winangun Kerthi</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php $foto = $this->session->login['foto']; ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('/img/'.$foto)?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->login['nama']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('/img/'.$foto)?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $this->session->login['nama']; ?>
                  <small><?php echo $this->session->login['level']; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#editprofile" onclick="edit(<?php echo $this->session->login['id_user'];?>)">Login</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#logout">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <?php $this->load->view('sidebar'); ?>
    </section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php $this->load->view($content); ?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<div class="modal fade" id="logout">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Yakin ingin keluar?</h4>
      </div>
      <div class="modal-body">
        <p>Klik tombol "keluar" jika yakin ingin keluar dari halaman admin.</p>
      </div>
      <div class="modal-footer">
        <a href="<?php echo base_url('auth/logout') ?>" class="btn btn-primary">Keluar</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editprofile">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="text-align:center;">Edit Login</h4>
      </div>
      <div class="modal-body">
          <?php echo form_open_multipart('auth/update','class="form-horizontal"'); ?>
            <div class="box-body">
              <input class="form-control" placeholder="Masukkan id simpanan" type="hidden" name="id" id="iduser_edit">
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Anggota</label>
                  <div class="col-sm-9">
                    <input class="form-control" placeholder="Masukkan kode anggota"  name="kd" id="anggota_edit" type="text" disabled>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-9">
                    <input class="form-control" placeholder="Masukkan username" name="user" id="user_edit" type="text" required>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-9">
                    <input class="form-control" placeholder="Masukkan password baru" name="pass" id="pass_edit" type="text" required>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Level Akses</label>
                  <div class="col-sm-9">
                    <select id="disabledSelect" class="form-control" tabindex="1" name="lvl" >
                        <option value="" disabled="" selected="">--- Pilihan ---</option>
                        <option value="Ketua">Ketua</option>
                        <option value="Admin">Admin</option>
                        <option value="Kolektor">Kolektor</option>
                        <option value="Bagian Tabungan">Bagian Tabungan</option>
                        <option value="Bagian Kredit">Bagian Kredit</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kode</label>
                  <div class="col-sm-9">
                    <input class="form-control" name="user_kode" id="kode_edit" type="text" required>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <div class="col-md-offset-3 col-sm-9">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </div>
         <?php echo form_close(); ?>
       </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js')?>"></script>
<!-- jQuery file upload -->
<script src="<?php echo base_url('assets/plugins/dropify/dist/js/dropify.js')?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/mask/dist/jquery.mask.min.js')?>"></script>

<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
<script src="<?php echo base_url('assets/exporttoexcel/jquery.table2excel.min.js');?>"></script>

<script type="text/javascript">
  $("button").click(function() {
	    $("#export2excel").table2excel({
	      exclude: ".noExl",
	      name: "Worksheet Name",
	      filename: "Report",
	      fileext: ".xlsx",
	      exclude_img: true,
	      exclude_links:true,
	      exclude_inputs:true
	    });
	  });

function edit(id_user){
  $.ajax({
    url:"<?php echo site_url('auth/edit');?>",
    type:"POST",
    dataType: 'json',
    data:{id:id_user},
    cache:false,
    success:function(result){
      $('#iduser_edit').val(result['id_user']);
      $('#anggota_edit').val(result['no_ktp']+' - '+result['nama']);
      $('#user_edit').val(result['username']);
      $('select[id=disabledSelect]').val(result['level']).prop( "disabled", true);
      if (((result['level'])=="Ketua") || ((result['level'])=="Admin") || ((result['level'])=="Bagian Kredit") || ((result['level'])=="Bagian Tabungan")) {
        $('#kode_edit').val(result['kode_user']).prop( "disabled", true);
      }else {
        $('#kode_edit').val(result['kode_user']).prop( "disabled", false);
      }
    }
  });
};
  $('#e_lvl').change(function(){
    if ($(this).val() == "Kolektor") {
      $('#id_kolektor').prop( "disabled", false);
    }else {
      $('#id_kolektor').prop( "disabled", true);
    }
  });

  $(document).ready(function() {
    $('.dropify').dropify();
  });
  $(document).ready(function(){
    $('.rp' ).mask('0,000,000,000', {reverse: true});
  });
  // $(document).ready(function(){
  //   $('[data-toggle="tooltip"]').tooltip();
  // });
  $(function () {
    $('.select2').select2()
    $('#example1').DataTable()
    $('#tunda').DataTable()
    $('#terima').DataTable()
    $('#tolak').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
    $('#export2excel').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'scrollY'     : 300
    });
  });

  $('#example23').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
  });

  function st_rumah() {
    if (document.getElementById('r1').checked || document.getElementById('r2').checked) {
      document.getElementById('rOther').disabled=true;
    }else {
      document.getElementById('rOther').disabled=false;
    }
  };

  //Javascript Form-Wizard
  $(document).ready(function () {
    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');
    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.attr('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
</body>
</html>
