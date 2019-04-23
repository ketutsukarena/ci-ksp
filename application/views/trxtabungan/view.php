<section class="content-header">
  <h1>
    Data Tabungan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Data Tabungan</li>
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
       <h3 class="box-title">View Data Simpanan</h3>
       <div class="row">
         <div class="col-md-2">
           <label>Proses Pembungaan</label>
           <div class="box-footer">
             <?php
                 $now = new DateTime();
                 $tgl_today = $now->format('d');
                 $tgl_lastday= $now->format('t');
                  if ($tgl_today == $tgl_lastday) { ?>
             <a href="<?php echo base_url('bagtab/data/pembungaan') ?>"><button type="button" class="btn btn-primary" name="button"><i class="fa fa-print"> Bunga</i></button></a>
           <?php }else { ?>
             <a href="<?php echo base_url('bagtab/data/pembungaan') ?>"><button type="button" class="btn btn-primary" name="button" disabled><i class="fa fa-print"> Bunga</i></button></a>
           <?php } ?>
           </div>
         </div>
         <div class="col-md-offset-8 col-md-2">
           <label>Cetak Report</label>
           <div class="box-footer">
             <a href="<?php echo base_url('report/crtn') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
             <a href="#" type="button" class="btn btn-primary"><i class="fa fa-print"> .xls</i></a>
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
           <th>No.</th>
           <th>No. Rekening</th>
           <th>Nama</th>
           <th>Total Tabungan</th>
           <th style="text-align:center; width:15%;">Aksi</th>
         </tr>
         </thead>
         <tbody>
           <?php
           $no = 1;
           foreach ($vTab as $n) {?>
           <tr>
             <td style="text-align:center;"><?php echo $no++;?></td>
             <td><?php echo $n->reknasabah; ?></td>
             <td><?php echo $n->nama; ?></td>
             <td><?php echo "Rp. ",number_format($n->saldo_akhir,2,'.',','); ?></td>
             <td style="text-align:center;">
               <a href="<?php echo base_url('bagtab/data/det/'.$n->id_reknasabah) ?>" type="button" class="btn btn-sm btn-primary"><i class="fa fa-bars"></i></a>
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
