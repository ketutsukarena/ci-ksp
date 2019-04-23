<section class="content-header">
  <h1>
    Detail Data Angsuran
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Detail Data Angsuran</li>
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
       <h3 class="box-title">Detail Data Angsuran</h3>
       <div class="row">
         <div class="col-md-offset-1 col-md-4">
           <table class="table">
             <?php foreach ($vD as $a) ?>
             <tr>
               <td class="kophead">Nama Debitur</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo $a->nama; ?></span></td>
             </tr>
             <tr>
               <td class="kophead">Total Pinjaman</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo "Rp. ",number_format($a->total_pinjaman,0,'.',','); ?></span></td>
             </tr>
             <tr>
               <td class="kophead">Jangka Waktu</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo $a->jangka_waktu," Bulan"; ?></span></td>
             </tr>
             <tr>
               <td class="kophead">Bunga (%)</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo $a->persenbunga,"%"; ?></span></td>
             </tr>
             <tr>
               <td class="kophead">Status</td>
               <td class="kophead">:</td>
               <td class="kophead"><span><?php echo $a->status_pinjaman; ?></span></td>
             </tr>
           </table>
         </div>
       </div>
     </div>
     <!-- /.box-header -->
     <div class="box-body">
       <div class="row">
         <div class="col-md-offset-1 col-md-10">
           <div class="table-responsive">
             <table id="example23" class="table table-bordered table-hover dataTable">
               <thead>
               <tr>
                 <th style="width:5%;">No.</th>
                 <th style="text-align:center;">Tanggal</th>
                 <th style="text-align:center;">Sandi</th>
                 <th style="text-align:center;">Bulan Ke</th>
                 <th style="text-align:center;">Total</th>
               </tr>
               </thead>
               <tbody>
                 <?php
                 $no = 1;
                 foreach ($vDet as $n) {?>
                 <tr>
                   <td><?php echo $no++ ?></td>
                   <td style="text-align:center;"><?php echo date("d/m/Y", strtotime($n->tgl_transaksi));?></td>
                   <td style="text-align:center;"><?php echo $n->id_akun; ?></td>
                   <td style="text-align:center;"><?php echo "Bulan ke-" ,$n->bulan_ke; ?></td>
                   <td style="text-align:center;"><?php echo number_format($n->nominal_angsuran*$n->bulan_ke,0,'.',',')?></td>
                 </tr>
                 <?php } ?>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     <!-- /.box-body -->
   </div>
   </div>
</div>
</div>
</section>
