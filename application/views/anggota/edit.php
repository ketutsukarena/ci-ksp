<section class="content-header">
  <h1>
    Anggota
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Anggota</li>
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
</div>
<div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('/img/'.$edit->foto)?>" alt="User profile picture">
              <h3 class="profile-username text-center"><?php echo $edit->nama;?></h3>
              <p class="text-muted text-center"><?php echo $edit->status ?></p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $edit->email; ?></a>
                </li>
                <li class="list-group-item">
                  <b>No. HP</b> <a class="pull-right"><?php echo $edit->no_hp; ?></a>
                </li>
              </ul>
              <center><a href="<?php echo base_url('report/cda/'.$edit->id_nasabah) ?>" type="button" target="_blank" class="btn btn-primary"><i class="fa fa-print"> Cetak Report</i></a></center>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Edit Data Anggota</h3>
            </div>
            <?php echo form_open_multipart('admin/anggota/update','class="form-horizontal"'); ?>
              <div class="box-body">
                <div class="row">
                  <div class="col-sm-12">
                    <input class="form-control" type="hidden" name="id" value="<?php echo $edit->id_nasabah;?>" readonly>
                    <div class="form-row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">No. KTP</label>
                          <div class="col-sm-10">
                            <input class="form-control" name="ktp" placeholder="Masukkan nomor identitas kependudukan" value="<?php echo $edit->no_ktp;?>" type="text" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Nama</label>
                          <div class="col-sm-10">
                            <input class="form-control" name="nama" placeholder="Masukkan nama lengkap" value="<?php echo $edit->nama;?>" type="text" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Jenis Kelamin</label>
                          <div class="col-sm-10">
                            <div class="radio-list">
                                <label class="radio-inline">
                                  <input name="gender" value="Laki-laki" type="radio" <?php if($edit->jk=="Laki-laki"){echo 'checked';}?>>Laki-laki
                                </label>
                                <label class="radio-inline">
                                  <input name="gender" value="Perempuan" type="radio" <?php if($edit->jk=="Perempuan"){echo 'checked';}?>>Perempuan
                                </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label">Pekerjaan</label>
                          <div class="col-md-4 col-sm-9">
                            <input class="form-control" name="kerja" placeholder="Masukkan pekerjaan" value="<?php echo $edit->pekerjaan;?>" type="text" required>
                          </div>
                          <label class="col-md-2 col-sm-3 control-label">Agama</label>
                          <div class="col-md-4 col-sm-9">
                            <select class="form-control" tabindex="1" name="agama" >
                                <option value="Hindu" <?php if($edit->agama=='Hindu'){ echo 'selected';}?>>Hindu</option>
                                <option value="Islam" <?php if($edit->agama=='Islam'){ echo 'selected';}?>>Islam</option>
                                <option value="Budha" <?php if($edit->agama=='Budha'){ echo 'selected';}?>>Budha</option>
                                <option value="Kristen Katolik" <?php if($edit->agama=='Kristen Katolik'){ echo 'selected';}?>>Kristen Katolik</option>
                                <option value="Kristen Protestan" <?php if($edit->agama=='Kristen Protestan'){ echo 'selected';}?>>Kristen Protestan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label">Tempat Lahir</label>
                          <div class="col-md-4 col-sm-9">
                            <input class="form-control" placeholder="Masukkan tempat lahir" name="tempat_lahir" value="<?php echo $edit->tempat_lahir;?>" type="text" >
                          </div>
                          <label class="col-md-2 col-sm-3 control-label">Tgl Lahir</label>
                          <div class="col-md-4 col-sm-9">
                            <input class="form-control" name="tgl_lahir" type="date" value="<?php echo $edit->tgl_lahir;?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label">Email</label>
                          <div class="col-md-4 col-sm-9">
                            <input class="form-control" placeholder="Masukkan alamat email" value="<?php echo $edit->email;?>" name="email" type="email">
                          </div>
                          <label class="col-md-2 col-sm-3 control-label">No. HP</label>
                          <div class="col-md-4 col-sm-9">
                            <input class="form-control" placeholder="Masukkan nomor handphone" value="<?php echo $edit->no_hp;?>" name="no_hp" type="text" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="col-md-2 col-sm-3 control-label">Alamat</label>
                          <div class="col-md-4 col-sm-9">
                            <textarea class="form-control" name="alamat" rows="8" cols="50" placeholder="Masukkan alamat lengkap"><?php echo $edit->alamat;?></textarea>
                          </div>
                          <label class="col-md-2 col-sm-3 control-label">Foto</label>
                          <div class="col-md-4 col-sm-9">
                            <input type="file" id="input-file-now" class="dropify" name="img" />
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
        <!-- /.col -->
      </div>
</section>
