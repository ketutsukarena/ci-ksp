<section class="content-header">
  <h1>
    Transaksi
    <small>Data Simpanan Anggota</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li><a href="#">Data Simpanan</a></li>
    <li class="active">View</li>
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
       <h3 class="box-title">Detail Transaksi Simpanan Anggota</h3>
       <?php foreach ($vAng as $a) ?>
       <div class="row">
         <div class="col-md-4">
           <table class="table">
             <tr>
               <td class="kophead">No. Identitas</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo $a->no_ktp; ?></span></td>
             </tr>
             <tr>
               <td class="kophead">Nama</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo $a->nama; ?></span></td>
             </tr>
             <tr>
               <td class="kophead">Total Simpanan</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo "Rp. ",number_format($a->tsim,0,'','.'); ?></span></td>
             </tr>
           </table>
         </div>
       </div>
     </div>
     <!-- /.box-header -->
     <div class="box-body">
     <div class="table-responsive">
       <table id="example1" class="table table-bordered table-hover dataTable">
         <thead>
         <tr>
           <th>No</th>
           <th>Tgl Transaksi</th>
           <th>Kode Transaksi</th>
           <th>Jenis Simpanan</th>
           <th>Nominal</th>
           <th>Jumlah Bulan</th>
           <th>Total</th>
           <th style="text-align:center; width:8%;">Aksi</th>
         </tr>
         </thead>
         <tbody>
           <?php
           $no = 1;
          foreach ($vDet as $n) {?>
           <tr>
             <td style="text-align:center;"><?php echo $no++;?></td>
             <td><?php echo date("d/m/Y", strtotime($n->tgl_transaksi)); ?></td>
             <td><?php echo $n->kode_transaksi; ?></td>
             <td><?php echo $n->nama_simpanan; ?></td>
             <td><?php echo "Rp. ",number_format($n->nominal,0,'','.');?></td>
             <td><?php echo $n->jumlah_bln; ?></td>
             <td><?php echo "Rp. ", number_format($n->total,0,'','.'); ?></td>
             <td style="text-align:center;">
               <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editdata" onclick="edit(<?php echo $n->id_trx;?>)"><i class="fa fa-bars"></i></button>
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
        <h4 class="modal-title" style="text-align:center;">Detail Transaksi</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-hover dataTable">
            <thead>
            <tr>
              <th>No</th>
              <th>Jenis</th>
              <th>Nominal</th>
              <th>Bulan</th>
              <th>Tahun</th>
            </tr>
            </thead>
            <tbody id="tbkonten">
            </tbody>
          </table>
        </div>
       </div>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
function edit(id_trx){
  $.ajax({
    url:"<?php echo site_url('admin/trxsimdet/det');?>",
    type:"POST",
    dataType: 'json',
    data:{id:id_trx},
    cache:false,
    success:function(result){
      var tabledata ='';
      var bln = '';
      $.each(result, function(index, el){
        if (el['bulan']==1) {
          bln = "Januari";
        }else if (el['bulan']==2) {
          bln = "Februari";
        }else if (el['bulan']==3) {
          bln = "Maret";
        }else if (el['bulan']==4) {
          bln = "April";
        }else if (el['bulan']==5) {
          bln = "Mei";
        }else if (el['bulan']==6) {
          bln = "Juni";
        }else if (el['bulan']==7) {
          bln = "Juli";
        }else if (el['bulan']==8) {
          bln = "Agustus";
        }else if (el['bulan']==9) {
          bln = "September";
        }else if (el['bulan']==10) {
          bln = "Oktober";
        }else if (el['bulan']==11) {
          bln = "November";
        }else if (el['bulan']==12) {
          bln = "Desember";
        }else {
          bln = "Salah Bulan";
        }
      tabledata += '<tr><td>'+(index+1)+'</td><td>'+el['nama_simpanan']+'</td><td>Rp. '+el['nominal']+'</td><td>'+bln+'</td><td>'+el['tahun']+'</td></tr>';
      });
      $('#tbkonten').html(tabledata);
      //console.log(tabledata);
    }
  });
}
</script>
