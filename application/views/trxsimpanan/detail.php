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
       <h3 class="box-title">Data Simpanan Anggota</h3>
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
         <div class="col-md-offset-6 col-md-2">
                  <label for="exampleInputEmail1">Cetak Report</label>
                <div class="box-footer">
                  <a href="<?php echo base_url('report/cts/'.$a->id_nasabah) ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
                  <a href="<?php echo base_url('admin/report/report/'.$a->id_nasabah) ?>" type="button" class="btn btn-primary"><i class="fa fa-print"> .xls</i></a>
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
           <th>Jenis Simpanan</th>
           <th>Nominal</th>
           <th>Bulan</th>
           <th>Tahun</th>
         </tr>
         </thead>
         <tbody>
           <?php
           $no = 1;
          foreach ($vXx as $n) {
            if ($n->bulan=="1") {
                $bln = "Januari";
            }elseif ($n->bulan=="2") {
                $bln = "Februari";
            }elseif ($n->bulan=="3") {
                $bln = "Maret";
            }elseif ($n->bulan=="4") {
                $bln = "April";
            }elseif ($n->bulan=="5") {
                $bln = "Mei";
            }elseif ($n->bulan=="6") {
                $bln = "Juni";
            }elseif ($n->bulan=="7") {
                $bln = "Juli";
            }elseif ($n->bulan=="8") {
                $bln = "Agustus";
            }elseif ($n->bulan=="9") {
                $bln = "September";
            }elseif ($n->bulan=="10") {
                $bln = "Oktober";
            }elseif ($n->bulan=="11") {
                $bln = "November";
            }elseif ($n->bulan=="12") {
                $bln = "Desember";
            }else {
                $bln = "Bulan salah";
            }
          ?>
           <tr>
             <td style="text-align:center;"><?php echo $no++;?></td>
             <td><?php echo date("d/m/Y", strtotime($n->tgl_transaksi))?></td>
             <td><?php echo $n->nama_simpanan; ?></td>
             <td><?php echo "Rp. ",number_format($n->nominal,0,'','.');?></td>
             <td><?php echo $bln; ?></td>
             <td><?php echo $n->tahun; ?></td>
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
