<section class="content-header">
  <h1>Data Pengajuan Kredit
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Pengajuan Kredit</li>
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
      <?php } if($this->session->flashdata('berhasil')){?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <strong><?php echo $this->session->flashdata('berhasil');?></strong> Data berhasil diperbaharui.
        </div>
      <?php } if($this->session->flashdata('gagal')){?>
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <strong><?php echo $this->session->flashdata('gagal');?></strong>Data gagal diperbaharui.
        </div>
      <?php } if($this->session->flashdata('terima')){?>
        <div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <strong><?php echo $this->session->flashdata('terima');?></strong> Data pengajuan kredit diterima.
        </div>
      <?php } if($this->session->flashdata('tolak')){?>
        <div class="alert alert-warning">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <strong><?php echo $this->session->flashdata('tolak');?></strong> Data pengajuan kredit ditolak.
        </div>
      <?php } ?>
  </div>
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="pull-left header"><i class="fa fa-th"></i> Status Pengajuan</li>
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Tunda</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Terima</a></li>
        <li><a href="#tab_3" data-toggle="tab">Tolak</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="box-status">
            <div class="row">
              <div class="col-md-2">
                <label>Tambah Data</label>
                <div class="box-footer">
                  <button type="button" class="btn btn-success" name="button" data-toggle="modal" data-target="#add_kreditor"><i class="fa fa-plus"> Tambah</i></button>
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
          <div class="box-body">
            <div class="table-responsive">
              <table id="tunda" class="table table-bordered table-hover dataTable">
                <thead>
                <tr>
                  <th style="text-align:center;">No</th>
                  <th>Tgl Permohonan</th>
                  <th>No. Rekening</th>
                  <th>Nama Debitur</th>
                  <th>Jaminan</th>
                  <th>Nominal (Rp.)</th>
                  <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($vTunda as $i) {?>
                  <tr>
                    <td style="text-align:center;"><?php echo $no++;?></td>
                    <td><?php echo date("d/m/Y", strtotime($i->tgl_permohonan)); ?></td>
                    <td><?php echo $i->reknasabah; ?></td>
                    <td><?php echo $i->nama; ?></td>
                    <td><?php echo $i->jaminan; ?></td>
                    <td style="text-align:right;"><?php echo number_format($i->nominal_permohonan,0,'.',',')?></td>
                    <td style="text-align:center;">
                      <a href="<?php echo base_url('bagkre/kredit/edit/'.$i->id_kredit)?>" type="button" class="btn btn-sm btn-primary" ><i class="fa fa-pencil"></i></a>
                      <a href="javascript:if(confirm('Apa anda yakin ingin menghapus data <?php echo $i->nama?>?')){document.location='<?php echo base_url('ketua/akun/hapus/'.$i->id_kredit)?>';}" type="button" name="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          <div class="box-status">
            <div class="row">
              <div class="col-md-offset-10 col-md-2">
                <label>Cetak Report</label>
                <div class="box-footer">
                  <a href="<?php echo base_url('report/crda') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
                  <a href="#" type="button" class="btn btn-primary"><i class="fa fa-print"> .xls</i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table id="terima" class="table table-bordered table-hover dataTable">
                <thead>
                <tr>
                  <th style="text-align:center;">No</th>
                  <th>Tgl Permohonan</th>
                  <th>No. Rekening</th>
                  <th>Nama Debitur</th>
                  <th>Jaminan</th>
                  <th>Nominal (Rp.)</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($vTerima as $i) {?>
                  <tr>
                    <td style="text-align:center;"><?php echo $no++;?></td>
                    <td><?php echo date("d/m/Y", strtotime($i->tgl_permohonan)); ?></td>
                    <td><?php echo $i->reknasabah; ?></td>
                    <td><?php echo $i->nama; ?></td>
                    <td><?php echo $i->jaminan; ?></td>
                    <td style="text-align:right;"><?php echo number_format($i->nominal_permohonan,0,'.',',')?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
          <div class="box-status">
            <div class="row">
              <div class="col-md-offset-10 col-md-2">
                <label>Cetak Report</label>
                <div class="box-footer">
                  <a href="<?php echo base_url('report/crda') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
                  <a href="#" type="button" class="btn btn-primary"><i class="fa fa-print"> .xls</i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table id="tolak" class="table table-bordered table-hover dataTable">
                <thead>
                <tr>
                  <th style="text-align:center;">No</th>
                  <th>Tgl Permohonan</th>
                  <th>No. Rekening</th>
                  <th>Nama Debitur</th>
                  <th>Jaminan</th>
                  <th>Nominal (Rp.)</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($vTolak as $i) {?>
                  <tr>
                    <td style="text-align:center;"><?php echo $no++;?></td>
                    <td><?php echo date("d/m/Y", strtotime($i->tgl_permohonan)); ?></td>
                    <td><?php echo $i->reknasabah; ?></td>
                    <td><?php echo $i->nama; ?></td>
                    <td><?php echo $i->jaminan; ?></td>
                    <td style="text-align:right;"><?php echo number_format($i->nominal_permohonan,0,'.',',')?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
</div>
</section>

<div class="modal fade" id="add_kreditor">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="text-align:center;">Tambah Pengajuan Kredit</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step">
                      <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                      <p>Data Debitur</p>
                  </div>
                  <div class="stepwizard-step">
                      <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                      <p>Data Penjamin</p>
                  </div>
                  <div class="stepwizard-step">
                      <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                      <p>Data Pengajuan</p>
                  </div>
              </div>
          </div>
          <?php echo form_open_multipart('bagkre/kredit/tambah','class="form-horizontal"'); ?>
              <div class="row setup-content" id="step-1">
                  <div class="col-xs-12">
                      <div class="col-md-12">
                        <h5><label class="control-label">DATA PRIBADI DEBITUR</label></h5>
                        <hr style="margin-top:0px !important;">
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Cari Nasabah</label>
                              <div class="col-sm-9">
                                <?php $jsNasabah = "var prdName = new Array();\n" ?>
                                <select name="id_nasabah" onchange="dtNasabah(this.value)" class="form-control select2" style="width: 100%" required>
                                  <option disabled selected>Cari data nasabah</option>
                                  <?php foreach ($vResult as $row) {
                                    echo '<option value="'. $row['id_nasabah']. '">' . $row['reknasabah'] . ' - '. $row['nama'] .'</option>';
                                    $jsNasabah .= "prdName['".$row['id_nasabah']."'] = {
                                      ktp:'".addslashes($row['no_ktp'])."',
                                      status:'".addslashes($row['status'])."',
                                      jk:'".addslashes($row['jk'])."',
                                      tlp:'".addslashes($row['no_hp'])."',
                                      tmp:'".addslashes($row['tempat_lahir'])."',
                                      tgl:'".addslashes(date("d-m-Y", strtotime($row['tgl_lahir'])))."',
                                      alamat:'".addslashes($row['alamat'])."',
                                      job:'".addslashes($row['pekerjaan'])."'
                                    };\n";
                                  }?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-md-2 col-sm-2 control-label">No. KTP</label>
                              <div class="col-md-3 col-sm-9">
                                <input class="form-control" type="text" placeholder="No. KTP" id="e_ktp" disabled>
                              </div>
                              <label class="col-md-3 col-sm-2 control-label">Status</label>
                              <div class="col-md-3 col-sm-8">
                                <input class="form-control" type="text" placeholder="Status nasabah" id="e_status" disabled>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-md-2 col-sm-2 control-label">Jenis Kelamin</label>
                              <div class="col-md-3 col-sm-9">
                                <input class="form-control" type="text" placeholder="Jenis kelamin" id="e_jk" disabled>
                              </div>
                              <label class="col-md-3 col-sm-2 control-label">Telp.</label>
                              <div class="col-md-3 col-sm-8">
                                <input class="form-control" type="text" placeholder="Telepon" id="e_tlp" disabled>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-md-2 col-sm-3 control-label">Tampat Lahir</label>
                              <div class="col-md-3 col-sm-9">
                                <input class="form-control" type="text" placeholder="Tempat lahir" id="e_tmp" disabled>
                              </div>
                              <label class="col-md-3 col-sm-3 control-label">Tgl Lahir</label>
                              <div class="col-md-3 col-sm-8">
                                <input class="form-control" type="text" placeholder="Tanggal lahir" id="e_tgl" disabled>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Alamat Debitur</label>
                              <div class="col-sm-9">
                                <textarea class="form-control" name="name" rows="1" cols="80" placeholder="Alamat debitur" id="e_alamat" disabled></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <h5><label class="control-label">INFORMASI PEKERJAAN DEBITUR</label></h5>
                        <hr style="margin-top:0px !important;">
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Nama Perusahaan</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Masukkan nama perusahaan" name="c_name" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-md-2 col-sm-3 control-label">Pekerjaan</label>
                              <div class="col-md-3 col-sm-9">
                                <input class="form-control" type="text" placeholder="Pekerjaan" id="e_job" disabled>
                              </div>
                              <label class="col-md-3 col-sm-3 control-label">Telp.</label>
                              <div class="col-md-3 col-sm-8">
                                <input class="form-control" type="text" placeholder="Masukkan nomor telepon perusahaan" name="c_tlp">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Alamat Perusahaan</label>
                              <div class="col-sm-9">
                                <textarea class="form-control" name="c_alamat" rows="1" cols="80" placeholder="Masukkan alamat lengkap perusahaan anda bekerja"></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                          <button class="btn btn-primary nextBtn pull-right" type="button" >Next</button>
                      </div>
                  </div>
              </div>
              <div class="row setup-content" id="step-2">
                  <div class="col-xs-12">
                      <div class="col-md-12">
                        <h5><label class="control-label">DATA PENJAMIN/PENANGGUNG DEBITUR</label></h5>
                        <hr style="margin-top:0px !important;">
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Nama</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Masukkan nama penjamin/penanggung" name="pj_name" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Hubungan</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Masukkan keterangan hubungan dengan debitur" name="pj_hub" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-md-2 col-sm-3 control-label">Pekerjaan</label>
                              <div class="col-md-3 col-sm-9">
                                <input class="form-control" type="text" placeholder="Masukkan pekerjaan penjamin/penanggung" name="pj_job">
                              </div>
                              <label class="col-md-3 col-sm-3 control-label">Telp.</label>
                              <div class="col-md-3 col-sm-8">
                                <input class="form-control" type="text" placeholder="Masukkan nomor telepon penjamin/penanggung" name="pj_tlp" required>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Alamat</label>
                              <div class="col-sm-9">
                                <textarea class="form-control" name="pj_alamat" rows="1" cols="80" placeholder="Masukkan alamat lengkap penjamin/penanggung" required></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                          <button class="btn btn-primary nextBtn pull-right" type="button" >Next</button>
                      </div>
                  </div>
              </div>
              <div class="row setup-content" id="step-3">
                  <div class="col-xs-12">
                      <div class="col-md-12">
                        <h5><label class="control-label">DATA PERMOHONAN KREDIT</label></h5>
                        <hr style="margin-top:0px !important;">
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-md-2 col-sm-3 control-label">Status Rumah</label>
                              <div class="col-md-9 col-sm-9">
                                <div class="radio-list" style="margin-bottom:5px;">
                                  <label class="radio-inline"><input name="pk_rumah" id="r1" onclick="st_rumah()" value="Milik Sendiri" type="radio">Milik Sendiri</label>
                                  <label class="radio-inline"><input name="pk_rumah" id="r2" onclick="st_rumah()" value="Sewa/Kontrak" type="radio">Sewa/Kontrak</label>
                                  <label class="radio-inline"><input name="pk_rumah" id="r3" onclick="st_rumah()" value="Lain-lainnya" type="radio">Lain-lain</label>
                                </div>
                                <input type="text" class="form-control" placeholder="Tambahkan keterangan status rumah" name="pk_rumah" id="rOther">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-md-2 col-sm-3 control-label">Jaminan Kredit</label>
                              <div class="col-md-9 col-sm-9">
                                <textarea class="form-control" rows="1" cols="80" name="pk_jaminan" placeholder="Masukkan jaminan yang dapat debitur berikan, lengkap sesuai surat-surat jaminan" required></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-md-2 col-sm-3 control-label">Nominal</label>
                              <div class="col-md-9 col-sm-9">
                                <div class="input-group">
                                  <span class="input-group-addon">Rp.</span>
                                  <input class="form-control rp" placeholder="Tanpa pemisah titik" type="text" name="pk_nom">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="col-md-2 col-sm-3 control-label">Untuk Keperluan</label>
                              <div class="col-md-9 col-sm-9">
                                <textarea class="form-control" name="pk_ket" placeholder="Masukkan untuk keperluan apa?" rows="1" cols="80" required></textarea>
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
                      </div>
                  </div>
              </div>
              <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  <?php echo $jsNasabah; ?>
  function dtNasabah(id){
    document.getElementById('e_ktp').value = prdName[id].ktp;
    document.getElementById('e_status').value = prdName[id].status;
    document.getElementById('e_jk').value = prdName[id].jk;
    document.getElementById('e_tlp').value = prdName[id].tlp;
    document.getElementById('e_tmp').value = prdName[id].tmp;
    document.getElementById('e_tgl').value = prdName[id].tgl;
    document.getElementById('e_alamat').value = prdName[id].alamat;
    document.getElementById('e_job').value = prdName[id].job;
  };
</script>
