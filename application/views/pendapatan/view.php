<section class="content-header">
  <h1>
    Jenis Pendapatan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('ketua/dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Jenis Pendapatan</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="form-row">
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
              <strong><?php echo $this->session->flashdata('berhasil');?></strong> Data berhasil diperbaharui.
            </div>
          <?php } if($this->session->flashdata('gagal')){?>
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-warning"></i><?php echo $this->session->flashdata('gagal');?></h4>Data gagal diperbaharui.
            </div>
          <?php } ?>
      </div>
    </div>
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Jenis Pendapatan</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
          <div class="box-body">
            <?php echo form_open_multipart('ketua/pendapatan/tambah','class="form-horizontal"'); ?>
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kode Akun</label>
                  <div class="col-sm-10">
                    <select name="akun" class="form-control" style="width: 100%" required>
                      <option disabled selected>Pilih kode akun pendapatan</option>
                      <?php foreach ($vAkun as $j) {
                        $p = substr($j['id_akun'], 0, -2);
                        if ($p==4) {
                          echo '<option value="'.$j['id_akun'].'">'.$j['id_akun'].' - '.$j['nama_akun'].'</option>';
                        }
                      }?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kode Pendapatan</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" name="pendapatan" value="<?= $idfunction;?>" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Pendapatan</label>
                  <div class="col-sm-10">
                    <input class="form-control" placeholder="Masukkan nama biaya" name="nm" type="text" >
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-offset-2 col-sm-10">
                <div class="form-group">
                  <div class="col-sm-10">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
        <h3 class="box-title">View Data Jenis Pendapatan</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <div class="table-responsive">
        <table id="example23" class="table table-bordered table-hover dataTable">
          <thead>
          <tr>
            <th style="text-align:center;">No</th>
            <th>Kode Pendapatan</th>
            <th>Kode Akun</th>
            <th>Nama Pendapatan</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
          </thead>
          <tbody id="showData">
            <?php
            $no = 1;
            foreach ($vP as $i) {?>
            <tr>
              <td style="text-align:center;"><?php echo $no++;?></td>
              <td><?php echo $i->kode_pendapatan; ?></td>
              <td><?php echo $i->id_akun; ?></td>
              <td><?php echo $i->nama; ?></td>
              <td style="text-align:center;">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editdata" onclick="editpendapatan(<?php echo $i->id_pendapatan;?>)"><i class="fa fa-pencil"></i></button>
                <a href="javascript:if(confirm('Apa anda yakin ingin menghapus biaya dengan kode <?php echo $i->kode_pendapatan?>?')){document.location='<?php echo base_url('ketua/pendapatan/hapus/'.$i->id_pendapatan)?>';}" type="button" name="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title" style="text-align:center;">Edit Jenis Pendapatan</h4>
      </div>
      <div class="modal-body">
          <?php echo form_open_multipart('ketua/pendapatan/update','class="form-horizontal"'); ?>
            <div class="box-body">
              <div class="form-row">
                <input class="form-control" type="hidden" name="id" id="id_edit" readonly>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kode Biaya</label>
                  <div class="col-sm-9">
                    <input class="form-control" id="pendapatan_edit" type="text" readonly>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Biaya</label>
                  <div class="col-sm-9">
                    <input class="form-control" placeholder="Masukkan nama pendapatan" name="nm" id="nama_edit" type="text">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <div class="col-md-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button class="btn btn-danger" data-dismiss="modal">Keluar</button>
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
  function editpendapatan(id_pendapatan){
    $.ajax({
      url:"<?php echo site_url('ketua/pendapatan/edit');?>",
      type:"POST",
      dataType: 'json',
      data:{id:id_pendapatan},
      cache:false,
      success:function(result){
        $('#id_edit').val(result['id_pendapatan']);
        $('#pendapatan_edit').val(result['id_akun']+' - '+result['kode_pendapatan']);
        $('#nama_edit').val(result['nama']);
      }
    });
  }

</script>
