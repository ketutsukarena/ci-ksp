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
       <h3 class="box-title">Transaksi Kredit</h3>
     </div>
     <div class="box-body">
     <?php echo form_open_multipart('bagkre/pinjaman/tambah','class="form-horizontal"'); ?>
     <h5><label class="control-label" style="text-transform: uppercase;">Permohonan Kredit</label></h5>
     <hr style="margin-top:0px !important;">
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-sm-2 control-label">Pilih Debitur</label>
           <div class="col-sm-9">
             <?php $jsKreditor = "var prdName = new Array();\n" ?>
             <select name="id_kredit" onchange="pilihKreditor(this.value)" class="form-control select2" style="width: 100%">
               <option disabled selected>Cari data debitur</option>
               <?php foreach ($vResult as $row) {
                 echo '<option value="'. $row['id_kredit']. '">' . $row['reknasabah'] . ' - '. $row['nama'] .'</option>';
                 $jsKreditor .= "prdName['".$row['id_kredit']."'] ={
                   ktp:'".addslashes($row['no_ktp'])."',
                   status:'".addslashes($row['status'])."',
                   tgl:'".addslashes(date("d/m/Y", strtotime($row['tgl_permohonan'])))."',
                   nom:'".addslashes(number_format($row['nominal_permohonan'],0,'.',','))."',
                   ket:'".addslashes($row['ket_permohonan'])."'
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
           <label class="col-md-2 col-sm-3 control-label">No. KTP</label>
           <div class="col-md-3 col-sm-9">
             <input class="form-control" type="text" id="e_ktp" placeholder="Nomor kartu tanda penduduk" readonly>
           </div>
           <label class="col-md-3 col-sm-3 control-label">Status</label>
           <div class="col-md-3 col-sm-9">
             <input class="form-control" type="text" id="e_status" placeholder="Status" readonly>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Tanggal</label>
           <div class="col-md-3 col-sm-9">
             <input class="form-control" type="text" id="e_tgl" placeholder="Tanggal permohonan kredit" readonly>
           </div>
           <label class="col-md-3 col-sm-3 control-label">Nominal</label>
           <div class="col-md-3 col-sm-9">
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control" type="text" id="e_nom" placeholder="Nominal permohonan" readonly>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Untuk Keperluan</label>
           <div class="col-md-9 col-sm-9">
             <textarea class="form-control" rows="1" cols="80" id="e_ket" placeholder="Keterangan keperluan permohonan kredit" readonly></textarea>
           </div>
         </div>
       </div>
     </div>
     <h5><label class="control-label" style="text-transform: uppercase;">Realisasi Kredit</label></h5>
     <hr style="margin-top:0px !important;">
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-sm-2 control-label">Kode Transaksi</label>
           <div class="col-sm-9">
             <select name="akun" class="form-control" style="width: 100%" readonly>
               <?php foreach ($vAkun as $j) {
                 $p = $j['id_akun'];
                 if ($p==301) {
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
         <label class="col-md-2 col-sm-3 control-label">Pinjaman Pokok</label>
         <div class="col-md-9 col-sm-9">
           <div class="input-group">
             <span class="input-group-addon">Rp.</span>
             <input class="form-control rp" type="text" name="pokok_pinjam" id="e_pokok" placeholder="Masukkan nominal pinjaman pokok yang telah disetujui">
           </div>
         </div>
       </div>
     </div>
     <div class="col-sm-12">
       <div class="form-group">
         <label class="col-md-2 col-sm-3 control-label">Jangka Waktu</label>
         <div class="col-md-3 col-sm-9">
           <div class="input-group">
             <input class="form-control" type="text" name="jangka" id="e_jangka" placeholder="Masukkan jangka waktu">
             <span class="input-group-addon">bulan</span>
           </div>
         </div>
         <label class="col-md-3 col-sm-3 control-label">Angsuran Pokok</label>
         <div class="col-md-3 col-sm-9">
           <div class="input-group">
             <span class="input-group-addon">Rp.</span>
             <input class="form-control rp" type="text" name="angsur_pokok" id="e_angsurpokok" placeholder="Angsuran pokok perbulan" readonly>
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
               <input class="form-control" type="text" name="bungapersen" id="e_bunga" placeholder="Masukkan bunga">
               <span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;</span>
             </div>
           </div>
           <label class="col-md-3 col-sm-3 control-label">Angsuran Bunga</label>
           <div class="col-md-3 col-sm-9">
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control" type="text" name="angsur_bunga" id="e_angsurbunga" readonly placeholder="Angsuran bunga perbulan">
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
               <input class="form-control" type="text" name="angsur_total" id="e_totalangsur" readonly>
               <span class="input-group-addon">per Bulan</span>
             </div>
           </div>
         </div>
       </div>
       <div class="form-row">
         <div class="col-sm-12">
           <div class="form-group">
             <label class="col-md-2 col-sm-3 control-label">Biaya Administrasi</label>
             <div class="col-md-3 col-sm-9">
               <div class="input-group">
                 <span class="input-group-addon">Rp.</span>
                 <input class="form-control rp" type="text" name="biaya_admin" id="e_admin" placeholder="Biaya administrasi">
               </div>
             </div>
             <label class="col-md-3 col-sm-3 control-label">Biaya Materai</label>
             <div class="col-md-3 col-sm-9">
               <div class="input-group">
                 <span class="input-group-addon">Rp.</span>
                 <input class="form-control rp" type="text" name="biaya_materai" id="e_materai" placeholder="Biaya materai">
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Total Biaya Kredit</label>
           <div class="col-md-9 col-sm-9">
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control" type="text" id="e_jumlahbiaya" placeholder="Total biaya kredit (biaya administras + biaya materai)" readonly>
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
</section>

<script type="text/javascript">
  <?php echo $jsKreditor; ?>
  function pilihKreditor(id){
    document.getElementById('e_ktp').value = prdName[id].ktp;
    document.getElementById('e_status').value = prdName[id].status;
    document.getElementById('e_tgl').value = prdName[id].tgl;
    document.getElementById('e_nom').value = prdName[id].nom;
    document.getElementById('e_ket').value = prdName[id].ket;
  };
  $(document).ready(function(){
    $('#e_jangka').keyup(function(){
      var pokok=parseFloat($('#e_pokok').val().replace(/,/g, ''));
      var jangka=parseFloat($('#e_jangka').val());

      var angsurpokok = pokok/jangka;
      $('#e_angsurpokok').val(String(angsurpokok).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
    });

    $('#e_bunga').keyup(function(){
      var pokok=parseFloat($('#e_pokok').val().replace(/,/g, ''));
      var bunga=parseFloat($('#e_bunga').val());
      var jangka=parseFloat($('#e_jangka').val());

      var angsurbunga = ((pokok*bunga)/100)/jangka;
      $('#e_angsurbunga').val(String(angsurbunga).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
    });

    $('#e_bunga').keyup(function(){
      var pokok=parseFloat($('#e_angsurpokok').val().replace(/,/g, ''));
      var bunga=parseFloat($('#e_angsurbunga').val().replace(/,/g, ''));

      var total = pokok+bunga;
      $('#e_totalangsur').val(String(total).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
    });

    $('#e_materai').keyup(function(){
      var admin=parseFloat($('#e_admin').val().replace(/,/g, ''));
      var materai=parseFloat($('#e_materai').val().replace(/,/g, ''));

      var jumlah = admin+materai;
      $('#e_jumlahbiaya').val(String(jumlah).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
    });
  });
</script>
