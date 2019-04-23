<section class="content-header">
  <h1>
    Data Nasabah
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Data Nasabah</li>
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
      <?php } if($this->session->flashdata('same')){?>
        <div class="alert alert-warning">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <strong><?php echo $this->session->flashdata('same');?></strong> No. KTP telah digunakan
        </div>
      <?php } ?>
  </div>
 <div class="col-md-12">
   <div class="box box-success">
     <div class="box-header">
       <h3 class="box-title">View Data Nasabah</h3>
       <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
       <div class="row">
         <div class="col-md-2">
           <label>Tambah Data</label>
           <div class="box-footer">
             <button type="button" class="btn btn-success" name="button" data-toggle="modal" data-target="#add"><i class="fa fa-plus"> Tambah</i></button>
           </div>
         </div>
         <div class="col-md-offset-8 col-md-2">
           <label>Cetak Report</label>
           <div class="box-footer">
             <a href="<?php echo base_url('report/crdn') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
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
           <th>No. Rek</th>
           <th>No. Identitas</th>
           <th>Nama</th>
           <th>Jenis Kelamin</th>
           <th>Alamat</th>
           <th>No. HP</th>
           <th>Status</th>
           <th style="text-align:center;width:10%;">Aksi</th>
         </tr>
         </thead>
         <tbody>
           <?php
           $no = 1;
           foreach ($vResult as $n) {?>
           <tr>
             <td style="text-align:center;"><?php echo $no++;?></td>
             <td><?php echo $n->reknasabah; ?></td>
             <td><?php echo $n->no_ktp; ?></td>
             <td><?php echo $n->nama; ?></td>
             <td><?php echo $n->jk; ?></td>
             <td><?php echo $n->alamat; ?></td>
             <td><?php echo $n->no_hp; ?></td>
             <td><?php echo $n->status; ?></td>
             <td style="text-align:center;">
               <a href="<?php echo base_url('bagtab/nasabah/edit/'.$n->id_nasabah)?>" type="button" name="button" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
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

<div class="modal fade" id="add">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="text-align:center;">Tambah Nasabah</h4>
      </div>
      <div class="modal-body">
          <?php echo form_open_multipart('bagtab/nasabah/tambah','class="form-horizontal"'); ?>
            <div class="box-body">
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Nasabah dari</label>
                    <div class="col-md-6 col-sm-9">
                      <?php $jsUser = "var prdName = new Array();\n" ?>
                      <select name="id_user" onchange="valUser(this.value)" class="form-control" style="width: 100%">
                        <option disabled selected>Pilih Kolektor</option>
                        <?php foreach ($vUser as $row) {
                          echo '<option value="'.$row->id_user.'">'.$row->level.' - '.$row->nama.'</option>';
                          $jsUser .= "prdName['".$row->id_user."'] ={kduser:'".addslashes($row->kode_user)."'};\n";
                        }?>
                      </select>
                    </div>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" name="kd_user" type="text" id="e_kd" readonly>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">No. KTP</label>
                    <div class="col-md-10 col-sm-9">
                      <input class="form-control" name="ktp" placeholder="Masukkan nomor identitas kependudukan" type="text" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Nama</label>
                    <div class="col-md-10 col-sm-9">
                      <input class="form-control" name="nama" placeholder="Masukkan nama lengkap" type="text" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Jenis Kelamin</label>
                    <div class="col-md-10 col-sm-9">
                      <div class="radio-list">
                        <label class="radio-inline"><input name="gender" value="Laki-laki" type="radio">Laki-laki</label>
                        <label class="radio-inline"><input name="gender" value="Perempuan" type="radio">Perempuan</label>
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
                      <input class="form-control" name="kerja" placeholder="Masukkan pekerjaan" type="text" required>
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">Agama</label>
                    <div class="col-md-4 col-sm-9">
                      <select class="form-control" tabindex="1" name="agama" >
                          <option value="" disabled="" selected="">--- Pilihan ---</option>
                          <option value="Hindu">Hindu</option>
                          <option value="Islam">Islam</option>
                          <option value="Budha">Budha</option>
                          <option value="Kristen Katolik">Kristen Katolik</option>
                          <option value="Kristen Protestan">Kristen Protestan</option>
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
                      <input class="form-control" placeholder="Masukkan tempat lahir" name="tempat_lahir" type="text">
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">Tgl Lahir</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" name="tgl_lahir" type="date" >
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Email</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" placeholder="Masukkan alamat email" name="email" type="email">
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">No. HP</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" placeholder="Masukkan nomor handphone" name="no_hp" type="text">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Alamat</label>
                    <div class="col-md-4 col-sm-9">
                      <textarea class="form-control" name="alamat" rows="7" cols="50" placeholder="Masukkan alamat lengkap" ></textarea>
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
         <?php echo form_close(); ?>
       </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
<?php echo $jsUser; ?>
function valUser(id){
  document.getElementById('e_kd').value = prdName[id].kduser;
};
</script>
