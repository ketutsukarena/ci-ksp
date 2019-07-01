<section class="content-header">
  <h1>
    Data Jurnal
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Data Jurnal</li>
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
       <h3 class="box-title">View Data Jurnal</h3>
       <div class="row">
         <div class="col-md-2">
           <!-- kosong -->
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
           <th>No</th>
           <th>Tgl Transaksi</th>
           <th>Keterangan</th>
           <th>Akun</th>
           <th>Debet</th>
           <th>Kredit</th>
           <th>user</th>
         </tr>
         </thead>
         <tbody>
           <?php
           foreach ($jurnal as $n) {?>
           <tr>
             <td><?php echo $n->id_jurnal_detail; ?></td>
             <td><?php echo $n->tgl_transaksi; ?></td>
             <td><?php echo $n->keterangan; ?></td>
             <td><?php echo $n->nama_akun; ?></td>
             <td><?php echo $n->debet; ?></td>
             <td><?php echo $n->kredit; ?></td>
             <td><?php echo $n->username; ?></td>
           </tr>
           <?php } ?>
           
         </tbody>
         <tfoot>
            <tr>
             <td align="right" colspan="4"><b>Total</b></td>
             <td><b><?php echo $totaldebet; ?></b></td>
             <td colspan="2"><b><?php echo $totalkredit; ?></b></td>
           </tr>
         </tfoot>
       </table>
     </div>
     <!-- /.box-body -->
   </div>
   </div>
</div>
</div>
</section>
