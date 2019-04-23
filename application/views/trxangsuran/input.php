<section class="content-header">
  <h1>
    Transaksi Kredit
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Transaksi Kredit</li>
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
       <h3 class="box-title">Transaksi Angsuran</h3>
     </div>
     <div class="box-body">
     <?php echo form_open_multipart('bagkre/angsuran/tambah','class="form-horizontal"'); ?>
     <h5><label class="control-label" style="text-transform: uppercase;">Data Pinjaman</label></h5>
     <hr style="margin-top:0px !important;">
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-sm-2 control-label">Pilih Kreditor</label>
           <div class="col-sm-9">
             <?php $jsKredit = "var prdName = new Array();\n" ?>
             <select name="id_pinjaman" onchange="selectPinjaman(this.value)" class="form-control select2" style="width: 100%">
               <option disabled selected>Cari data kreditor</option>
               <?php foreach ($vResult as $row) {
                 echo '<option value="'. $row['id_trx']. '">' . $row['reknasabah'] . ' - '. $row['nama'] .'</option>';
                 $jsKredit .= "prdName['".$row['id_trx']."'] ={
                   a:'".addslashes(number_format($row['nominal_pinjaman'],0,'.',','))."',
                   b:'".addslashes($row['jangka_waktu'])."',
                   c:'".addslashes($row['persenbunga'])."',
                   d:'".addslashes(number_format($row['angsuranpokok'],0,'.',','))."',
                   e:'".addslashes(number_format($row['angsuranbunga'],0,'.',','))."',
                   f:'".addslashes(number_format($row['angsurantotal'],0,'.',','))."',
                   g:'".addslashes(number_format($row['total_pinjaman'],0,'.',','))."',
                   h:'".addslashes(date("d/m/Y", strtotime($row['tgl_realisasi'])))."',
                   i:'".addslashes(number_format($row['sisa_pinjam'],0,'.',','))."',
                   j:'".addslashes($row['total_bulan']+1)."',
                   k:'".addslashes(number_format($row['total_pinjaman_bayar'],0,'.',','))."',
                 };\n";
               }?>
             </select>
           </div>
         </div>
       </div>
     </div>
     <div class="col-sm-12">
       <div class="form-group">
         <label class="col-md-2 col-sm-3 control-label">Tgl Realisasi</label>
         <div class="col-md-3 col-sm-9">
           <input class="form-control rp" type="text" id="e_tglrealisasi" placeholder="Tanggal realisasi" readonly>
         </div>
         <label class="col-md-3 col-sm-3 control-label">Pinjaman Pokok</label>
         <div class="col-md-3 col-sm-9">
           <div class="input-group">
             <span class="input-group-addon">Rp.</span>
             <input class="form-control rp" type="text" id="e_pokok" placeholder="Pinjaman pokok" readonly>
           </div>
         </div>
       </div>
     </div>
     <div class="col-sm-12">
       <div class="form-group">
         <label class="col-md-2 col-sm-3 control-label">Jangka Waktu</label>
         <div class="col-md-3 col-sm-9">
           <div class="input-group">
             <input class="form-control" type="text" name="jangka" id="e_jangka" placeholder="Jangka waktu" readonly>
             <span class="input-group-addon">bulan</span>
           </div>
         </div>
         <label class="col-md-3 col-sm-3 control-label">Angsuran Pokok</label>
         <div class="col-md-3 col-sm-9">
           <div class="input-group">
             <span class="input-group-addon">Rp.</span>
             <input class="form-control rp" type="text" id="e_angsurpokok" placeholder="Angsuran pokok perbulan" readonly>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Bunga (%)</label>
           <div class="col-md-3 col-sm-9">
             <div class="input-group">
               <input class="form-control" type="text" id="e_bunga" placeholder="Bunga pinjaman" readonly>
               <span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;</span>
             </div>
           </div>
           <label class="col-md-3 col-sm-3 control-label">Angsuran Bunga</label>
           <div class="col-md-3 col-sm-9">
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control" type="text" id="e_angsurbunga" placeholder="Angsuran bunga perbulan" readonly>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Total Angsuran</label>
           <div class="col-md-9 col-sm-9">
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control" type="text" name="angsur_total" id="e_totalangsur" placeholder="Total angsuran perbulan" readonly>
               <span class="input-group-addon">per Bulan</span>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Total Pinjaman</label>
           <div class="col-md-9 col-sm-9">
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control" type="text" id="e_totalpinjam" placeholder="Total pinjaman" readonly>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Sisa Pinjaman</label>
           <div class="col-md-9 col-sm-9">
             <input class="form-control" type="hidden" name="sisa" id="e_totalpinjam_tempo" readonly>
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control" type="text" id="e_sisa_pinjam" placeholder="Total pinjaman" readonly>
             </div>
           </div>
         </div>
       </div>
     </div>
     <h5><label class="control-label" style="text-transform: uppercase;">Bayar Kredit</label></h5>
     <hr style="margin-top:0px !important;">
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-sm-2 control-label">Kode Transaksi</label>
           <div class="col-sm-9">
             <select name="akun" class="form-control" style="width: 100%" readonly>
               <?php foreach ($vAkun as $j) {
                 $p = $j['id_akun'];
                 if ($p==302) {
                   echo '<option selected value="'.$j['id_akun'].'">'.$j['id_akun'].' - '.$j['nama_akun'].'</option>';
                 }
               }?>
             </select>
           </div>
         </div>
       </div>
     </div>
     <div class="col-sm-12">
       <div class="form-group">
         <label class="col-md-2 col-sm-3 control-label">Angsuran Bulan</label>
         <div class="col-md-9 col-sm-9">
           <div class="input-group">
             <span class="input-group-addon">Ke</span>
             <input class="form-control rp" id="e_bln" type="text" name="bln" readonly>
           </div>
         </div>
       </div>
     </div>
     <div class="col-sm-12">
       <div class="form-group">
         <label class="col-md-2 col-sm-3 control-label">Bayar Angsuran</label>
         <div class="col-md-9 col-sm-9">
           <div class="input-group">
             <span class="input-group-addon">Rp.</span>
             <input class="form-control rp" type="text" id="e_bayar">
           </div>
         </div>
       </div>
     </div>
     <div class="col-sm-12">
       <div class="form-group">
         <label class="col-md-2 col-sm-3 control-label">Sisa Bayar</label>
         <div class="col-md-9 col-sm-9">
           <div class="input-group">
             <span class="input-group-addon">Rp.</span>
             <input class="form-control rp" type="text" id="e_sisa" placeholder="" readonly>
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
</section>

 <script type="text/javascript">
  <?php echo $jsKredit; ?>

  function selectPinjaman(id){
    document.getElementById('e_pokok').value = prdName[id].a;
    document.getElementById('e_jangka').value = prdName[id].b;
    document.getElementById('e_bunga').value = prdName[id].c;
    document.getElementById('e_angsurpokok').value = prdName[id].d;
    document.getElementById('e_angsurbunga').value = prdName[id].e;
    document.getElementById('e_totalangsur').value = prdName[id].f;
    document.getElementById('e_totalpinjam').value = prdName[id].g;
    document.getElementById('e_tglrealisasi').value = prdName[id].h;
    document.getElementById('e_sisa_pinjam').value = prdName[id].i;
    document.getElementById('e_bln').value = prdName[id].j;
    document.getElementById('e_totalpinjam_tempo').value = prdName[id].k;
  };

  $(document).ready(function(){
    $('#e_bayar').keyup(function(){
      var total=parseFloat($('#e_totalangsur').val().replace(/,/g, ''));
      var bayar=parseFloat($('#e_bayar').val().replace(/,/g, ''));

      var sisa = bayar-total;
      $('#e_sisa').val(String(sisa).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
    });
  });
</script>
