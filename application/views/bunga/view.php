<section class="content-header">
  <h1>
    Bunga Tabungan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('ketua/dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Bunga Tabungan</li>
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
            <strong><?php echo $this->session->flashdata('gagal');?></strong> Data gagal ditambahkan.
          </div>
      <?php } if($this->session->flashdata('same')){?>
        <div class="alert alert-warning">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <strong><?php echo $this->session->flashdata('same');?></strong> Kode akun telah terpakai.
        </div>
      <?php } ?>
    </div>
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Bunga Tabungan</h3>
        </div>
        <?php echo form_open_multipart('ketua/bungatabungan/tambah','class="form-horizontal"'); ?>
          <div class="box-body">
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kode Akun</label>
                  <div class="col-sm-10">
                    <select name="akun" class="form-control" style="width: 100%" readonly>
                      <?php foreach ($vAkun as $j) {
                        $p = $j['id_akun'];
                        if ($p==203) {
                          echo '<option selected value="'.$j['id_akun'].'">'.$j['id_akun'].' - '.$j['nama_akun'].'</option>';
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
                  <label class="col-sm-2 control-label">Bunga (%)</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="nm" placeholder="Masukkan persen bunga tabungan" type="text">
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
        <h3 class="box-title">View Bunga Tabungan</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <div class="table-responsive">
        <table id="example23" class="table table-bordered table-hover dataTable">
          <thead>
          <tr>
            <th style="text-align:center;">No</th>
            <th>Kode Akun</th>
            <th>Nama Akun</th>
            <th>Bunga (%)</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($vResult as $i) {?>
            <tr>
              <td style="text-align:center;"><?php echo $no++;?></td>
              <td><?php echo $i->id_akun; ?></td>
              <td><?php echo $i->nama_akun; ?></td>
              <td><?php echo $i->nominal; ?></td>
              <td style="text-align:center;">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editdata" onclick="editbungatabungan(<?php echo $i->id_bunga;?>)"><i class="fa fa-pencil"></i></button>
                <a href="javascript:if(confirm('Apa anda yakin ingin menghapus data <?php echo $i->nama_akun?>?')){document.location='<?php echo base_url('ketua/akun/hapus/'.$i->id_akun)?>';}" type="button" name="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title" style="text-align:center;">Edit Bunga Tabungan</h4>
      </div>
      <div class="modal-body">
          <?php echo form_open_multipart('ketua/bungatabungan/update','class="form-horizontal"'); ?>
            <div class="box-body">
              <div class="form-row">
                <input class="form-control" name="id" id="e_id" type="hidden" readonly>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kode Akun</label>
                  <div class="col-sm-9">
                    <input class="form-control" placeholder="Masukkan kode akun" name="akun" id="e_akun" type="text" readonly>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Bunga (%)</label>
                  <div class="col-sm-9">
                    <input class="form-control" placeholder="Masukkan nama akun" name="nm" id="e_bunga" type="text">
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
  </div>
</div>

<script type="text/javascript">
  function editbungatabungan(id_bunga){
    $.ajax({
      url:"<?php echo site_url('ketua/bungatabungan/edit');?>",
      type:"POST",
      dataType: 'json',
      data:{id:id_bunga},
      cache:false,
      success:function(result){
        $('#e_id').val(result['id_bunga']);
        $('#e_akun').val(result['id_akun']+' - '+result['nama_akun']);
        $('#e_bunga').val(result['nominal']);
      }
    });
  }
</script>
