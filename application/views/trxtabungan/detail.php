<section class="content-header">
  <h1>
    Data Tabungan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Detail Data Tabungan</li>
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
      <?php } ?>
  </div>
 <div class="col-md-12">
   <div class="box box-success">
     <div class="box-header">
       <h3 class="box-title">Data Tabungan Nasabah</h3>
       <div class="row">
         <div class="col-md-8">
           <table class="table">
             <?php foreach ($vD as $a) ?>
             <tr>
               <td class="kophead">No. Rek</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo $a->reknasabah; ?></span></td>
             </tr>
             <tr>
               <td class="kophead">No. KTP</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo $a->no_ktp; ?></span></td>
             </tr>
             <tr>
               <td class="kophead">Nama</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo $a->nama; ?></span></td>
             </tr>
             <tr>
               <td class="kophead">Alamat</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo $a->alamat; ?></span></td>
             </tr>
             <tr>
               <td class="kophead">Saldo Tabungan</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo "Rp. ",number_format($a->saldo_akhir,2,'.',','); ?></span></td>
             </tr>
           </table>
         </div>
         <div class="col-md-offset-2 col-md-2">
           <label>Cetak Report</label>
           <div class="box-footer">
             <a href="<?php echo base_url('report/ctn/'.$a->id_reknasabah) ?>" type="button" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
             <a href="#" type="button" class="btn btn-sm btn-primary"><i class="fa fa-print"> .xls</i></a>
           </div>
           <div class="box-footer">
             <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editdata" onclick="edit(<?php echo $a->id_reknasabah;?>)"><i class="fa fa-pencil"> Koreksi (204)</i></button>
           </div>
         </div>
       </div>
     </div>
     <!-- /.box-header -->
     <div class="box-body">
     <div class="table-responsive">
       <table id="example1" class="table table-bordered table-hover dataTable">
         <thead>
         <tr>
           <th style="text-align:center;">No</th>
           <th style="text-align:center;">Tanggal</th>
           <th style="text-align:center;">Sandi</th>
           <th style="text-align:center;">Debet</th>
           <th style="text-align:center;">Kredit</th>
           <th style="text-align:center;">Saldo</th>
           <th style="text-align:center;">Ket</th>
         </tr>
         </thead>
         <tbody>
           <?php
           $no = 1;
           foreach ($vDet as $n) {
             if ($n->debet==0) {
                $debet="";
             }else {
                $debet = number_format($n->debet,2,'.',',');
             };
             if ($n->kredit==0) {
                $kredit="";
             }else {
                $kredit = number_format($n->kredit,2,'.',',');
             }
             if ($n->id_user=='1') {
                $ket = 'ADM';
             }else {
                $ket = $n->kode_user;
             }
             ?>
           <tr>
             <td style="text-align:center;"><?php echo $no++;?></td>
             <td style="text-align:center;"><?php echo date("d/m/Y", strtotime($n->tgl_transaksi));?></td>
             <td style="text-align:center;"><?php echo $n->id_akun; ?></td>
             <td style="text-align:right;"><?php echo $debet; ?></td>
             <td style="text-align:right;"><?php echo $kredit; ?></td>
             <td style="text-align:right;"><?php echo number_format($n->saldo,2,'.',','); ?></td>
             <td style="text-align:center;"><?php echo $ket; ?></td>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="text-align:center;">Koreksi</h4>
      </div>
      <div class="modal-body">
          <?php echo form_open_multipart('bagtab/koreksi/tambah','class="form-horizontal"'); ?>
          <div class="box-body">
            <input class="form-control" name="id_rek" type="hidden" value="<?php echo $a->id_reknasabah; ?>">
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Untuk Tgl</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" name="tgl" type="date">
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">Saldo Akhir</label>
                    <div class="col-md-4 col-sm-9">
                      <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        <input class="form-control" name="saldo" type="text" id="a" readonly value="<?php echo number_format($a->saldo_akhir,0,'.',',') ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Kode Transaksi</label>
                    <div class="col-sm-10">
                      <select name="akun" class="form-control" style="width: 100%" required>
                        <?php foreach ($vAkun as $j) {
                          $p = $j['id_akun'];
                          if ($p==204) {
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
                    <label class="col-sm-2 control-label">Nominal</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        <input class="form-control rp" placeholder="Masukkan nominal" name="nominal" id="b" type="text">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Koreksi ke</label>
                    <div class="col-md-10 col-sm-9">
                      <div class="radio-list">
                        <label class="radio-inline"><input name="k" id="aa" value="Kredit" type="radio">Kredit / Bertambah</label>
                        <label class="radio-inline"><input name="k" id="ab" value="Debet" type="radio">Debet / Berkurang</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Saldo Hasil</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        <input class="form-control rp" placeholder="Nominal saldo akhir setelah dikoreksi" id="c" type="text" readonly>
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
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  if ($('#aa').click(function(){
    var tot=parseInt($('#a').val().replace(/,/g, ''));
    var jml=parseInt($('#b').val().replace(/,/g, ''));

    var jumlah=tot + jml;
    $('#c').val(String(jumlah).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
  }))if ($('#ab').click(function(){
    var tot=parseInt($('#a').val().replace(/,/g, ''));
    var jml=parseInt($('#b').val().replace(/,/g, ''));

    var jumlah=tot - jml;
    $('#c').val(String(jumlah).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
  }));
});
</script>
