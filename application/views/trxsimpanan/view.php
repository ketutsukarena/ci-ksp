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
       <h3 class="box-title">View Data Simpanan</h3>
       <div class="row">
         <div class="col-md-offset-10 col-md-2">
           <label>Cetak Report</label>
           <div class="box-footer">
             <a href="<?php echo base_url('report/crts') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
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
           <th>No. Identitas</th>
           <th>Nama</th>
           <th>Jenis Kelamin</th>
           <th>Alamat</th>
           <th>Total Simpanan</th>
           <th style="text-align:center; width:15%;">Aksi</th>
         </tr>
         </thead>
         <tbody>
           <?php
           $no = 1;
           foreach ($vTrx as $n) {?>
           <tr>
             <td style="text-align:center;"><?php echo $no++;?></td>
             <td><?php echo $n->no_ktp; ?></td>
             <td><?php echo $n->nama; ?></td>
             <td><?php echo $n->jk; ?></td>
             <td><?php echo $n->alamat; ?></td>
             <td><?php echo "Rp. ",number_format($n->tsim,0,'','.'); ?></td>
             <td style="text-align:center;">
               <a href="<?php echo base_url('admin/trxsimdet/all/'.$n->id_nasabah)?>" type="button" name="button" class="btn btn-sm btn-primary"><i class="fa fa-bars"></i></a>
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
