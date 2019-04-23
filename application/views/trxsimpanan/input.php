<section class="content-header">
  <h1>
    Transaksi Simpanan Anggota
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Transaksi Simpanan Anggota</li>
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
     <div class="box-header with-border">
       <h3 class="box-title">Simpanan Anggota</h3>
     </div>
     <div class="box-body">
     <?php echo form_open_multipart('admin/trxsim/tambah','class="form-horizontal"'); ?>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-sm-2 control-label">Kode Anggota</label>
           <div class="col-sm-9">
             <?php $jsAnggota = "var prdName = new Array();\n" ?>
             <select name="id_nasabah" onchange="changeValue(this.value)" class="form-control select2" style="width: 100%">
               <option disabled selected>Pilih kode anggota</option>
               <?php foreach ($vAng as $row) {
                 echo '<option value="'. $row['id_nasabah']. '">' . $row['no_ktp'] . ' - '. $row['nama'] .'</option>';
                 $jsAnggota .= "prdName['".$row['id_nasabah']."'] ={bln:'".addslashes($row['bln_akhir'])."',thn:'".addslashes($row['thn_akhir'])."'};\n";
               }?>
             </select>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Mulai Bulan</label>
           <div class="col-md-4 col-sm-9">
             <input class="form-control" type="text" name="mulai_bln" placeholder="Mulai bulan" id="prd_bulan" readonly>
           </div>
           <label class="col-md-2 col-sm-3 control-label">Tahun</label>
           <div class="col-md-3 col-sm-8">
             <input class="form-control" type="text" name="thn" placeholder="Tahun" id="prd_tahun" readonly>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Jenis Simpanan</label>
           <div class="col-md-4 col-sm-9">
               <?php $jsSimpanan = "var prdSim = new Array();\n" ?>
               <select name="id_simpanan" onchange="changeVal(this.value)" id="jns_simpanan" class="form-control" style="width: 100%">
                 <option disabled selected>Pilih jenis simpanan</option>
                 <?php foreach ($vJs as $rw) {
                   echo '<option value="'. $rw['id_simpanan']. '">' .$rw['id_simpanan'], ". ", $rw['nama_simpanan']. '</option>';
                   $jsSimpanan .= "prdSim['".$rw['id_simpanan']."'] ={
                     nom:'".addslashes(number_format($rw['nominal'],0,'.',','))."',
                     akun:'".addslashes($rw['id_akun'])."'
                   };\n";
                 }?>
               </select>
           </div>
           <label class="col-md-2 col-sm-3 control-label">Nominal</label>
           <div class="col-md-3 col-sm-8">
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control" placeholder="Tanpa pemisah titik" type="text" name="nominal" id="Rpsimpanan" readonly>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Jumlah Bulan Bayar</label>
           <div class="col-md-4 col-sm-9">
             <select class="form-control" tabindex="1" name="jml_bln" id="bln">
                 <option value="0" disabled="" selected="">--- Pilihan ---</option>
                 <option value="1">1 Bulan</option>
                 <option value="2">2 Bulan</option>
                 <option value="3">3 Bulan</option>
                 <option value="4">4 Bulan</option>
                 <option value="5">5 Bulan</option>
                 <option value="6">6 Bulan</option>
                 <option value="7">7 Bulan</option>
                 <option value="8">8 Bulan</option>
                 <option value="9">9 Bulan</option>
                 <option value="10">10 Bulan</option>
                 <option value="11">11 Bulan</option>
                 <option value="12">12 Bulan</option>
             </select>
           </div>
           <input class="form-control" type="hidden" name="id_akun" id="e_akun" readonly>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Total Bayar</label>
           <div class="col-md-4 col-sm-9">
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control" placeholder="Tanpa pemisah titik" type="text" name="total" id="Totalbayar" readonly>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Tunai</label>
           <div class="col-md-4 col-sm-9">
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control rp" placeholder="Tanpa pemisah titik" type="text" name="kd" id="Tunaibayar">
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="form-row">
       <div class="col-sm-12">
         <div class="form-group">
           <label class="col-md-2 col-sm-3 control-label">Sisa</label>
           <div class="col-md-4 col-sm-9">
             <div class="input-group">
               <span class="input-group-addon">Rp.</span>
               <input class="form-control" placeholder="Tanpa pemisah titik" type="text" name="kd" id="Sisa" readonly>
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
  <?php echo $jsAnggota; ?>
        function changeValue(id){
          document.getElementById('prd_bulan').value = prdName[id].bln;
              if ($('#prd_bulan').val()==1) {
                  $('#prd_bulan').val('Januari');
              }else if ($('#prd_bulan').val()==2) {
                  $('#prd_bulan').val('Februari');
              }else if ($('#prd_bulan').val()==3) {
                  $('#prd_bulan').val('Maret');
              }else if ($('#prd_bulan').val()==4) {
                  $('#prd_bulan').val('April');
              }else if ($('#prd_bulan').val()==5) {
                  $('#prd_bulan').val('Mei');
              }else if ($('#prd_bulan').val()==6) {
                  $('#prd_bulan').val('Juni');
              }else if ($('#prd_bulan').val()==7) {
                  $('#prd_bulan').val('Juli');
              }else if ($('#prd_bulan').val()==8) {
                  $('#prd_bulan').val('Agustus');
              }else if ($('#prd_bulan').val()==9) {
                  $('#prd_bulan').val('September');
              }else if ($('#prd_bulan').val()==10) {
                  $('#prd_bulan').val('Oktober');
              }else if ($('#prd_bulan').val()==11) {
                  $('#prd_bulan').val('Nopember');
              }else if ($('#prd_bulan').val()==12) {
                  $('#prd_bulan').val('Desember');
              }else {
                  $('#prd_bulan').val('Pilihan');
              }
          document.getElementById('prd_tahun').value = prdName[id].thn;
        };
  <?php echo $jsSimpanan; ?>
  function changeVal(id_simpanan){
    document.getElementById('Rpsimpanan').value = prdSim[id_simpanan].nom;
    document.getElementById('e_akun').value = prdSim[id_simpanan].akun;
  };

  $(document).ready(function(){
    $('#bln').click(function(){
      var simpanan=parseInt($('#Rpsimpanan').val().replace(/,/g, ''));
      var bulan=parseInt($('#bln').val());

      var total=simpanan*bulan;
      $('#Totalbayar').val(String(total).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
    });
  });

  $(document).ready(function(){
    $('#Tunaibayar').keyup(function(){
      var tot=parseInt($('#Totalbayar').val().replace(/,/g, ''));
      var jml=parseInt($('#Tunaibayar').val().replace(/,/g, ''));

      var jumlah=jml-tot;
      $('#Sisa').val(String(jumlah).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
    });
  });

  $('#jns_simpanan').change(function(){
    if ($(this).val() == 1) {
      $('select[id=bln]').val('1').attr("readonly", true);
    }else{
      $('select[id=bln]').val('0').attr("readonly", false);
    }
  });

</script>
