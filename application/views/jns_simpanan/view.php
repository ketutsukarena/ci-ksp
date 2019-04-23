<section class="content-header">
  <h1>
    Jenis Simpanan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('ketua/dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Jenis Simpanan</li>
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
            <strong><?php echo $this->session->flashdata('same');?></strong> Kode akun telah digunakan.
          </div>
        <?php } ?>
    </div>
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Jenis Simpanan</h3>
        </div>
          <div class="box-body">
            <?php echo form_open_multipart('ketua/simpanan/tambah','class="form-horizontal"'); ?>
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kode Akun</label>
                  <div class="col-sm-10">
                    <?php $jsAkun = "var prdAkun = new Array();\n" ?>
                    <select name="kd" onchange="document.getElementById('Rr').value = prdAkun[this.value]" class="form-control" style="width: 100%">
                      <option disabled selected>Pilih kode akun simpanan</option>
                      <?php foreach ($vAkun as $j) {
                        $p = substr($j['id_akun'], 0, -2);
                        if ($p==1) {
                          echo '<option value="'.$j['id_akun'].'">'.$j['id_akun'].' - '.$j['nama_akun'].'</option>';
                          $jsAkun .= "prdAkun['".$j['id_akun']."'] = '".addslashes()."';\n";
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
                  <label class="col-sm-2 control-label">Biaya</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <span class="input-group-addon">Rp.</span>
                      <input class="form-control" placeholder="Masukkan nama jenis simpanan" id="Rr" name="jenis" type="hidden">
                      <input class="form-control rp" placeholder="Masukkan nominal biaya simpanan" name="biaya" type="text" >
                    </div>
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
        <h3 class="box-title">View Data Jenis Simpanan</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <div class="table-responsive">
        <table id="example23" class="table table-bordered table-hover dataTable">
          <thead>
          <tr>
            <th style="text-align:center;">No</th>
            <th>Kode Akun</th>
            <th>Jenis Simpanan</th>
            <th>Nominal</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($vJS as $i) {?>
            <tr>
              <td style="text-align:center;"><?php echo $no++;?></td>
              <td><?php echo $i->id_akun; ?></td>
              <td><?php echo $i->nama_simpanan; ?></td>
              <td><?php echo "Rp. ",number_format($i->nominal,0,'.',','); ?></td>
              <td style="text-align:center;">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editdata" onclick="editsimpanan(<?php echo $i->id_simpanan;?>)"><i class="fa fa-pencil"></i></button>
                <a href="javascript:if(confirm('Apa anda yakin ingin menghapus data <?php echo $i->nama_simpanan?>?')){document.location='<?php echo base_url('ketua/simpanan/hapus/'.$i->id_simpanan)?>';}" type="button" name="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title" style="text-align:center;">Edit Jenis Simpanan</h4>
      </div>
      <div class="modal-body">
          <?php echo form_open_multipart('ketua/simpanan/update','class="form-horizontal"'); ?>
            <div class="box-body">
              <input class="form-control" placeholder="Masukkan id simpanan" type="hidden" name="id" id="id_edit">
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis</label>
                  <div class="col-sm-10">
                    <input class="form-control" placeholder="Masukkan nama jenis simpanan" name="jenis" id="nama_edit" type="text" readonly>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nominal</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <span class="input-group-addon">Rp.</span>
                      <input class="form-control" placeholder="Masukkan nominal biaya simpanan" name="biaya" id="nominal_edit" type="text" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <div class="col-md-offset-2 col-sm-10">
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

<script type="text/javascript">
<?php echo $jsAkun; ?>
function editsimpanan(id_simpanan){
  $.ajax({
    url:"<?php echo site_url('ketua/simpanan/edit');?>",
    type:"POST",
    dataType: 'json',
    data:{id:id_simpanan},
    cache:false,
    success:function(result){
      $('#id_edit').val(result['id_simpanan']);
      $('#nama_edit').val(result['id_akun']+' - '+result['nama_simpanan']);

      $('#nominal_edit').  val(String(result['nominal']).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
    }
  });
}
</script>
