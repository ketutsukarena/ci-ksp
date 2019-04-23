<section class="content-header">
  <h1>
    Data Transaksi Angsuran Kredit
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Transaksi Angsuran Kredit</li>
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
        <h3 class="box-title">View Data Transaksi Angsuran Kredit</h3>
        <div class="row">
          <div class="col-md-2">
            <label>Tambah Data</label>
            <div class="box-footer">
              <a href="<?php echo base_url('bagkre/angsuran') ?>" type="button" class="btn btn-success"><i class="fa fa-plus"> Tambah</i></a>
            </div>
          </div>
          <div class="col-md-offset-8 col-md-2">
            <label>Cetak Report</label>
            <div class="box-footer">
              <a href="<?php echo base_url('report/crda') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
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
            <th>Nama</th>
            <th>Jangka Waktu</th>
            <th>Total Pinjaman</th>
            <th>Sisa Bulan</th>
            <th>Sisa Pinjaman</th>
            <th>Status</th>
            <th style="width:10%;text-align:center;">Aksi</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($vResult as $i) {?>
            <tr>
              <td style="text-align:center;"><?php echo $no++;?></td>
              <td><?php echo date("d/m/Y", strtotime($i->tgl_realisasi));?></td>
              <td><?php echo $i->nama; ?></td>
              <td style="text-align:right;"><?php echo $i->jangka_waktu," bulan"; ?></td>
              <td style="text-align:right;"><?php echo number_format($i->total_pinjaman,0,'.',','); ?></td>
              <td style="text-align:right;"><?php echo $i->jangka_waktu-$i->total_bulan," bulan"; ?></td>
              <td style="text-align:right;"><?php echo number_format($i->total_pinjaman-$i->total_pinjaman_bayar,0,'.',','); ?></td>
              <td><?php echo $i->status_pinjaman; ?></td>
              <td style="text-align:center;">
                <a href="<?php echo base_url('bagkre/v_angsuran/detail/'.$i->id_trx) ?>" type="button" class="btn btn-sm btn-primary"><i class="fa fa-bars"></i></a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    </div>
 </div>
</div>
</section>
