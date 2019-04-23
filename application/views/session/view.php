<section class="content-header">
  <h1>
    Data Pengurus
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('ketua/dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Data Pengurus</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <?php echo validation_errors();
        if($this->session->flashdata('error')){?>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $this->session->flashdata('error');?></strong> Data gagal ditambahkan.
          </div>
        <?php } if($this->session->flashdata('success')){?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $this->session->flashdata('success');?></strong> Data berhasil ditambahkan.
          </div>
        <?php } if($this->session->flashdata('berhasil')){?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $this->session->flashdata('berhasil');?></strong> Data berhasil dirubah.
          </div>
        <?php } if($this->session->flashdata('gagal')){?>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $this->session->flashdata('gagal');?></strong> Data gagal dirubah.
          </div>
        <?php } if($this->session->flashdata('same')){?>
          <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $this->session->flashdata('same');?></strong> Anggota sudah ditambahkan menjadi pengurus.
          </div>
      <?php } ?>
    </div>
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Pengurus</h3>
          <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           </div>
        </div>
          <div class="box-body">
            <?php echo form_open_multipart('ketua/user/tambah','class="form-horizontal"'); ?>
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kode Anggota</label>
                  <div class="col-sm-10">
                    <select name="kode_anggota" class="form-control select2" style="width: 100%">
                      <option disabled selected>Pilih kode anggota</option>
                      <?php foreach ($vAnggota as $row) {
                        echo '<option value="'. $row['id_nasabah']. '">' . $row['no_ktp'], " - ",$row['nama'] . '</option>';
                      }?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input class="form-control" placeholder="Masukkan username" name="user" type="text" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input class="form-control" placeholder="Masukkan password" name="pass" type="password">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-md-2 col-sm-3 control-label">Level Akses</label>
                  <div class="col-md-4 col-sm-9">
                    <select class="form-control" name="lvl" id="e_lvl">
                        <option value="" disabled="" selected="">--- Pilihan ---</option>
                        <option value="Ketua">Ketua</option>
                        <option value="Admin">Admin</option>
                        <option value="Kolektor">Kolektor</option>
                        <option value="Bagian Tabungan">Bagian Tabungan</option>
                        <option value="Bagian Kredit">Bagian Kredit</option>
                    </select>                  </div>
                  <label class="col-md-2 col-sm-3 control-label">Kode Kolektor</label>
                  <div class="col-md-4 col-sm-9">
                    <input class="form-control" type="text" name="user_kode" id="id_kolektor">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-offset-2 col-sm-10">
                <div class="form-group">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
       <?php echo form_close(); ?>
     </div>
   </div>

   <div class="col-md-12">
     <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">View Data Pengurus</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <div class="table-responsive">
        <table id="example23" class="table table-bordered table-hover dataTable">
          <thead>
          <tr>
            <th style="text-align:center;">No</th>
            <th>No. Identitas</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Level</th>
            <th>Kode</th>
            <th>Status</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($vUser as $i) {?>
            <tr>
              <td style="text-align:center;"><?php echo $no++;?></td>
              <td><?php echo $i->no_ktp; ?></td>
              <td><?php echo $i->nama; ?></td>
              <td><?php echo $i->username; ?></td>
              <td><?php echo $i->level; ?></td>
              <td><?php echo $i->kode_user; ?></td>
              <td><?php echo $i->st; ?></td>
              <td style="text-align:center;">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editdata" onclick="edituser(<?php echo $i->id_user;?>)"><i class="fa fa-pencil"></i></button>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
   </div>
  </div>
 </div>
</section>

<div class="modal fade" id="editdata">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="text-align:center;">Edit Data Pengurus</h4>
      </div>
      <div class="modal-body">
          <?php echo form_open_multipart('ketua/user/update','class="form-horizontal"'); ?>
            <div class="box-body">
              <input class="form-control" placeholder="Masukkan id simpanan" type="hidden" name="id" id="iduser_edit">
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kode Anggota</label>
                  <div class="col-sm-9">
                    <select name="kd" id="anggota_edit" class="form-control" style="width: 100%" readonly>
                      <?php foreach ($vAnggota as $row) {
                        echo '<option value="'. $row['id_nasabah']. '">' . $row['no_ktp'], " - ",$row['nama'] . '</option>';
                      }?>
                    </select>
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
                  <label class="col-sm-3 control-label">Re-Enter Password</label>
                  <div class="col-sm-9">
                    <input class="form-control" placeholder="Masukkan password baru" name="pass" id="pass_edit" type="password" >
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Level Akses</label>
                  <div class="col-sm-9">
                    <select id="disabledSelect" class="form-control e_lvl" tabindex="1" name="lvl" >
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
                    <input class="form-control kd" name="user_kode" id="kode_edit" type="text" required>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-3 col-sm-3 control-label">Status</label>
                    <div class="col-md-9 col-sm-9">
                      <div class="radio-list">
                        <label class="radio-inline"><input name="status" id="radio_aktif" value="Aktif" type="radio">Aktif</label>
                        <label class="radio-inline"><input name="status" id="radio_nonaktif" value="Tidak Aktif" type="radio">Tidak Aktif</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <div class="col-md-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Keluar</button>
                  </div>
                </div>
              </div>
         <?php echo form_close(); ?>
       </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  function edituser(id_user){
    $.ajax({
      url:"<?php echo site_url('ketua/user/edit');?>",
      type:"POST",
      dataType: 'json',
      data:{id:id_user},
      cache:false,
      success:function(result){
        $('#iduser_edit').val(result['id_user']);
        $('#anggota_edit').val(result['id_nasabah']);
        $('#user_edit').val(result['username']);
        $('select[id=disabledSelect]').val(result['level']).attr( "readonly", true);
        if (((result['level'])=="Ketua") || ((result['level'])=="Admin") || ((result['level'])=="Bagian Kredit") || ((result['level'])=="Bagian Tabungan")) {
          $('#kode_edit').val(result['kode_user']).attr( "readonly", true);
        }else {
          $('#kode_edit').val(result['kode_user']).attr( "readonly", false);
        }

        if ((result['st']) == "Aktif") {
          $('#radio_aktif').attr("checked", true);
          $('#radio_nonaktif').attr("checked", false);
        }
        else{
          $('#radio_aktif').attr("checked", false);
          $('#radio_nonaktif').attr("checked", true);
        }
      }
    });
  };
  $('#e_lvl').change(function(){
    if ($(this).val() == "Kolektor") {
      $('#id_kolektor').attr( "readonly", false);
    }else {
      $('#id_kolektor').attr( "readonly", true);
    }
  });
  $('.e_lvl').change(function(){
    if ($(this).val() == "Kolektor") {
      $('.kd').attr( "readonly", false);
    }else {
      $('.kd').attr( "readonly", true);
    }
  });
</script>
