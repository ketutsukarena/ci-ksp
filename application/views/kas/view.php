<section class="content-header">
  <h1>
    Data Kas
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('ketua/dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Data Kas</li>
  </ol>
</section>

<section class="content">
  <div class="row">
   <div class="col-md-12">
     <div class="box box-success">
       <div class="box-header">
         <h3 class="box-title">View Riwayat Data Kas</h3>
         <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
         <div class="row">
           <div class="col-md-offset-10 col-md-2">
             <label>Cetak Report</label>
             <div class="box-footer">
               <a href="<?php echo base_url('report/crdn') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
               <button class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> .xls</button>
             </div>
           </div>
         </div>
       </div>
      <!-- /.box-header -->
      <div class="box-body">
      <div class="table-responsive">
        <table id="export2excel" class="table table-bordered table-hover dataTable">
          <thead>
          <tr>
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">Tgl Transaksi</th>
            <th>Jenis Transaksi</th>
            <th style="text-align:center;">Kode Akun</th>
            <th>Nama Akun</th>
            <th>Debet</th>
            <th style="text-align:center;">Kredit</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($dtkas as $i) {
              if ($i->debet==0) {
                 $debet="";
              }else {
                 $debet = number_format($i->debet,2,'.',',');
              };
              if ($i->kredit==0) {
                 $kredit="";
              }else {
                 $kredit = number_format($i->kredit,2,'.',',');
              }
              ?>
            <tr>
              <td style="text-align:center;"><?php echo $no++;?></td>
              <td><?php echo date("d/m/Y", strtotime($i->tgl_transaksi)) ?></td>
              <td><?php echo $i->status; ?></td>
              <td style="text-align:center;"><?php echo $i->id_akun; ?></td>
              <td><?php echo $i->nama_akun; ?></td>
              <td style="text-align:right;"><?php echo $debet; ?></td>
              <td style="text-align:right;"><?php echo $kredit; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
   </div>
  </div>
</section>
