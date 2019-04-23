<section class="content-header">
  <h1>
    Data Transaksi Pinjaman Kredit
    <small></small>
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
        <h3 class="box-title">View Data Transaksi Pinjaman Kredit</h3>
        <div class="row">
          <div class="col-md-2">
            <label>Tambah Data</label>
            <div class="box-footer">
              <a href="<?php echo base_url('bagkre/pinjaman') ?>" type="button" class="btn btn-success"><i class="fa fa-plus"> Tambah</i></a>
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
            <th>Pinjaman Pokok</th>
            <th>Jangka Waktu</th>
            <th>Bunga(%)</th>
            <th>Total Pinjaman</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($vResult as $i) {?>
            <tr>
              <td style="text-align:center;"><?php echo $no++;?></td>
              <td><?php echo date("d/m/Y", strtotime($i->tgl_realisasi)); ?></td>
              <td><?php echo $i->nama; ?></td>
              <td style="text-align:right;"><?php echo number_format($i->nominal_pinjaman,0,'.',',')?></td>
              <td><?php echo $i->jangka_waktu,' bulan'; ?></td>
              <td><?php echo $i->persenbunga; ?></td>
              <td style="text-align:right;"><?php echo number_format($i->total_pinjaman,0,'.',',')?></td>
              <td style="text-align:center;">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editdata" onclick="editakun(<?php echo $i->id_trx;?>)"><i class="fa fa-bars"></i></button>
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
