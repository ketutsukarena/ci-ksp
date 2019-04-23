<section class="content-header">
  <h1>Data Permohonan Kredit
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Transaksi Simpanan Anggota</li>
  </ol>
</section>

<section class="content">
<div class="row">
  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('/img/'.$edit->foto)?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?php echo $edit->nama;?></h3>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Nomor Rekening</b> <a class="pull-right"><?php echo $edit->reknasabah;?></a>
          </li>
          <li class="list-group-item">
            <b>Saldo Rekening</b> <a class="pull-right"><?php echo "Rp. ",number_format($edit->saldo_akhir,2,'.',','); ?></a>
          </li>
          <li class="list-group-item">
            <b>Tgl Pengajuan</b> <a class="pull-right"><?php echo date("d/m/Y", strtotime($edit->tgl_permohonan)); ?></a>
          </li>
          <li class="list-group-item text-center">
            <b>Konfirmasi Pengajuan :</b>
          </li>
        <a href="<?php echo base_url('bagkre/kredit/terima/'.$edit->id_kredit);?>" class="btn btn-success" style="width:49%;"><b>Terima</b></a>
        <a href="<?php echo base_url('bagkre/kredit/tolak/'.$edit->id_kredit);?>" class="btn btn-danger" style="width:49%;"><b>Tolak</b></a>
      </ul>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="box box-primary">
      <?php echo form_open_multipart('bagkre/kredit/update','class="form-horizontal"'); ?>
        <div class="box-body">
        <h5><label class="control-label">DATA PRIBADI DEBITUR</label></h5>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Lengkap</label>
              <div class="col-sm-9">
                <input type="hidden" name="id" class="form-control" value="<?php echo $edit->id_kredit;?>" readonly>
                <input type="text" class="form-control" value="<?php echo $edit->nama;?>" disabled>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-md-2 col-sm-2 control-label">No. KTP</label>
              <div class="col-md-3 col-sm-9">
                <input class="form-control" type="text" value="<?php echo $edit->no_ktp;?>" disabled>
              </div>
              <label class="col-md-3 col-sm-2 control-label">Status</label>
              <div class="col-md-3 col-sm-8">
                <input class="form-control" type="text" value="<?php echo $edit->status;?>" disabled>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-md-2 col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-md-3 col-sm-9">
                <input class="form-control" type="text" value="<?php echo $edit->jk;?>" disabled>
              </div>
              <label class="col-md-3 col-sm-2 control-label">Telp.</label>
              <div class="col-md-3 col-sm-8">
                <input class="form-control" type="text" value="<?php echo $edit->no_hp;?>" disabled>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-md-2 col-sm-3 control-label">Tampat Lahir</label>
              <div class="col-md-3 col-sm-9">
                <input class="form-control" type="text" value="<?php echo $edit->tempat_lahir;?>" disabled>
              </div>
              <label class="col-md-3 col-sm-3 control-label">Tgl Lahir</label>
              <div class="col-md-3 col-sm-8">
                <input class="form-control" type="text" value="<?php echo date("d/m/Y", strtotime($edit->tgl_lahir));?>" disabled>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-2 control-label">Alamat Debitur</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="name" rows="1" cols="80" disabled><?php echo $edit->alamat;?></textarea>
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
                <input type="text" class="form-control" placeholder="Masukkan nama perusahaan" name="c_name" value="<?php echo $edit->nama_perusahaan;?>">
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-md-2 col-sm-3 control-label">Pekerjaan</label>
              <div class="col-md-3 col-sm-9">
                <input class="form-control" type="text" value="<?php echo $edit->pekerjaan;?>" disabled>
              </div>
              <label class="col-md-3 col-sm-3 control-label">Telp.</label>
              <div class="col-md-3 col-sm-8">
                <input class="form-control" type="text" placeholder="Masukkan nomor telepon perusahaan" value="<?php echo $edit->telp_perusahaan;?>" name="c_tlp">
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-2 control-label">Alamat Perusahaan</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="c_alamat" rows="1" cols="80" placeholder="Masukkan alamat lengkap perusahaan anda bekerja"><?php echo $edit->alamat_perusahaan;?></textarea>
              </div>
            </div>
          </div>
        </div>
        <h5><label class="control-label">DATA PENJAMIN/PENANGGUNG DEBITUR</label></h5>
        <hr style="margin-top:0px !important;">
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Masukkan nama penjamin/penanggung" name="pj_name" value="<?php echo $edit->nama_penanggung;?>">
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-2 control-label">Hubungan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Masukkan keterangan hubungan dengan debitur" name="pj_hub" value="<?php echo $edit->hubungan;?>">
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-md-2 col-sm-3 control-label">Pekerjaan</label>
              <div class="col-md-3 col-sm-9">
                <input class="form-control" type="text" placeholder="Masukkan pekerjaan penjamin/penanggung" name="pj_job" value="<?php echo $edit->pekerjaan_penanggung;?>">
              </div>
              <label class="col-md-3 col-sm-3 control-label">Telp.</label>
              <div class="col-md-3 col-sm-8">
                <input class="form-control" type="text" placeholder="Masukkan nomor telepon penjamin/penanggung" name="pj_tlp" value="<?php echo $edit->telp_penanggung;?>">
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="pj_alamat" rows="1" cols="80" placeholder="Masukkan alamat lengkap penjamin/penanggung"><?php echo $edit->alamat_penanggung;?></textarea>
              </div>
            </div>
          </div>
        </div>
        <h5><label class="control-label">DATA PERMOHONAN KREDIT</label></h5>
        <hr style="margin-top:0px !important;">
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-md-2 col-sm-3 control-label">Status Rumah</label>
              <div class="col-md-9 col-sm-9">
                <input type="text" class="form-control" placeholder="Tambahkan keterangan status rumah" name="pk_rumah" value="<?php echo $edit->status_rumah;?>">
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-md-2 col-sm-3 control-label">Jaminan Kredit</label>
              <div class="col-md-9 col-sm-9">
                <textarea class="form-control" rows="1" cols="80" name="pk_jaminan" placeholder="Masukkan jaminan yang dapat debitur berikan, lengkap sesuai surat-surat jaminan"><?php echo $edit->jaminan;?></textarea>
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
                  <input class="form-control rp" placeholder="Tanpa pemisah titik" type="text" name="pk_nom" value="<?php echo $edit->nominal_permohonan;?>">
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
                <textarea class="form-control" name="pk_ket" placeholder="Masukkan untuk keperluan apa?" rows="1" cols="80" ><?php echo $edit->ket_permohonan;?></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-offset-2 col-sm-10">
            <div class="form-group">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
</section>
