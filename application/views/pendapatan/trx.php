<section class="content-header">
  <h1>
    Pendapatan
    <small>401 Kas Masuk</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Akun</li>
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
          <h3 class="box-title">Transaksi Pendapatan</h3>
        </div>
          <div class="box-body">
            <?php echo form_open_multipart('admin/trxpendapatan/tambah','class="form-horizontal"'); ?>
            <div class="form-row">
              <input class="form-control" id="e_akun" name="id_akun" type="hidden" readonly>
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kode</label>
                  <div class="col-sm-10">
                    <?php $jsPendapatan = "var prdName = new Array();\n" ?>
                    <select name="id" onchange="changeAkun(this.value)" class="form-control" style="width: 100%">
                      <option disabled selected>Pilih jenis pendapatan</option>
                      <?php foreach ($Vb as $n) {
                        echo '<option value="'. $n['id_pendapatan']. '">' . $n['kode_pendapatan'] . ' - '. $n['nama'] .'</option>';
                        $jsPendapatan .= "prdName['".$n['id_pendapatan']."'] ={akun:'".addslashes($n['id_akun'])."'};\n";
                      }?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nominal</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <span class="input-group-addon">Rp.</span>
                      <input class="form-control rp" placeholder="Masukkan nominal pendapatan" name="pendapatan" type="text" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="ket" rows="2" placeholder="Masukkan keterangan pemasukan pendapatan" required></textarea>
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
            <th>Tgl Transaksi</th>
            <th>Kode Pendapatan</th>
            <th>Nama Pendapatan</th>
            <th>Nominal</th>
            <th>Keterangan</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($ResultVb as $n) {?>
            <tr>
              <td style="text-align:center;"><?php echo $no++;?></td>
              <td><?php echo date("d/m/Y", strtotime($n->tgl_transaksi)); ?></td>
              <td><?php echo $n->kode_pendapatan; ?></td>
              <td><?php echo $n->nama; ?></td>
              <td><?php echo "Rp. ",number_format($n->nominal,0,'','.'); ?></td>
              <td><?php echo $n->keterangan; ?></td>
              <td style="text-align:center;">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editdata" onclick="edit_trx_pendapatan(<?php echo $n->id_trx;?>)"><i class="fa fa-pencil"></i></button>
                <a href="javascript:if(confirm('Apa anda yakin ingin menghapus data pendapatan <?php echo $n->nama?>?')){document.location='<?php echo base_url('admin/trxpendapatan/hapus/'.$n->id_trx)?>';}" type="button" name="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
          <?php echo form_open_multipart('admin/trxpendapatan/update','class="form-horizontal"'); ?>
            <div class="box-body">
              <input class="form-control" type="hidden" name="id_trx" id="id_edit">
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <select name="id_pendapatan" id="e_id" class="form-control" style="width: 100%">
                      <option disabled selected>Pilih jenis pendapatan</option>
                      <?php foreach ($Vb as $n) {
                        echo '<option value="'. $n['id_pendapatan']. '">' . $n['kode_pendapatan'] . ' - '. $n['nama'] .'</option>';
                      }?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nominal</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <span class="input-group-addon">Rp.</span>
                      <input class="form-control rp" placeholder="Masukkan nominal pendapatan" id="nominal_edit" name="pendapatan" type="text" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Keterangan</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="ket" id="e_ket" rows="2" placeholder="Masukkan keterangan pemasukan pendapatan" required></textarea>
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
  <?php echo $jsPendapatan; ?>
  function changeAkun(id){
    document.getElementById('e_akun').value = prdName[id].akun;
  };
  function edit_trx_pendapatan(id_trx){
    $.ajax({
      url:"<?php echo site_url('admin/trxpendapatan/edit');?>",
      type:"POST",
      dataType: 'json',
      data:{id:id_trx},
      cache:false,
      success:function(result){
        $('#id_edit').val(result['id_trx']);
        $('#nominal_edit').val(String(result['nominal']).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
        $('#e_id').val(result['id_pendapatan']);
        $('#e_ket').val(result['keterangan']);
      }
    });
  }
</script>
