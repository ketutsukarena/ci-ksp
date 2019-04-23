<section class="content-header">
  <h1>
    Setoran Tabungan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Transaksi Setoran Tabungan</li>
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
         <h3 class="box-title">Tambah Transaksi</h3>
       </div>
       <?php echo form_open_multipart('bagtab/nabung/tambah','class="form-horizontal"'); ?>
       <div class="box-body">
         <div class="form-row">
           <div class="col-sm-12">
             <div class="form-group">
               <div class="col-md-6 col-sm-12 "></div>
               <label class="col-md-2 col-sm-3 control-label">Saldo Akhir</label>
               <div class="col-md-4 col-sm-9">
                 <div class="input-group">
                   <span class="input-group-addon">Rp.</span>
                   <input class="form-control" id="e_saldoakhir" name="saldo" type="text" readonly>
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
                     if ($p==201) {
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
               <label class="col-md-2 col-sm-3 control-label">No. Rekening</label>
               <div class="col-md-10 col-sm-9">
                 <?php $jsRek = "var prdName = new Array();\n" ?>
                 <select name="id_rek" onchange="changeRek(this.value)" class="form-control select2" style="width: 100%">
                   <option disabled selected>Pilih nomor rekening tabungan</option>
                   <?php foreach ($vResult as $row) {
                     echo '<option value="'. $row['id_reknasabah']. '">' . $row['reknasabah'] . ' - '. $row['nama'] .'</option>';
                     $jsRek .= "prdName['".$row['id_reknasabah']."'] ={
                       saldo_last:'".addslashes(number_format($row['saldo_akhir'],0,'.',','))."'
                     };\n";
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
                   <input class="form-control rp" placeholder="Masukkan nominal penyetoran tunai" name="nominal" type="text" id="e_nominal">
                 </div>
               </div>
             </div>
           </div>
         </div>
         <div class="form-row">
           <div class="col-sm-12">
             <div class="form-group">
               <label class="col-sm-2 control-label">Sisa Saldo</label>
               <div class="col-sm-10">
                 <div class="input-group">
                   <span class="input-group-addon">Rp.</span>
                   <input class="form-control rp" placeholder="Sisa saldo setelah melakukan setoran tabungan" id="e_sisa" type="text" readonly>
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
      <?php echo form_close(); ?>
     </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="box box-success">
     <div class="box-header">
       <h3 class="box-title">View Transaksi Setoran</h3>
     </div>
     <!-- /.box-header -->
     <div class="box-body">
     <div class="table-responsive">
       <table id="example23" class="table table-bordered table-hover dataTable">
         <thead>
         <tr>
           <th style="text-align:center;">No</th>
           <th>Tgl Transaksi</th>
           <th>No. Rekening</th>
           <th>Nama Nasabah</th>
           <th>Penyetoran</th>
           <th>Saldo</th>
         </tr>
         </thead>
         <tbody>
           <?php
           $no = 1;
           foreach ($vNabung as $i) {?>
           <tr>
             <td style="text-align:center;"><?php echo $no++;?></td>
             <td><?php echo date("d/m/Y", strtotime($i->tgl_transaksi))?></td>
             <td><?php echo $i->reknasabah; ?></td>
             <td><?php echo $i->nama; ?></td>
             <td style="text-align:right;"><?php echo number_format($i->kredit,2,'.',','); ?></td>
             <td style="text-align:right;"><?php echo number_format($i->saldo,2,'.',','); ?></td>
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

<script type="text/javascript">
  <?php echo $jsRek; ?>
  function changeRek(id){
    document.getElementById('e_saldoakhir').value = prdName[id].saldo_last;
  };
  $(document).ready(function(){
    $('#e_nominal').keyup(function(){
      var a=parseInt($('#e_saldoakhir').val().replace(/,/g, ''));
      var b=parseInt($('#e_nominal').val().replace(/,/g, ''));

      var c=a+b;
      $('#e_sisa').val(String(c).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
    });
  });
</script>
