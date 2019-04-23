<section class="content-header">
  <h1>
    Pegawai
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Pegawai</li>
  </ol>
</section>

<section class="content">
<div class="row">
 <div class="col-md-12">
   <div class="box box-success">
     <div class="box-header">
       <h3 class="box-title">View Data Pegawai</h3>
       <button type="button" class="btn btn-success pull-right" name="button" data-toggle="modal" data-target="#tambahpegawai"><i class="fa fa-plus"> Tambah</i></button>
     </div>
     <!-- /.box-header -->
     <div class="box-body">
     <div class="table-responsive">
       <table id="example1" class="table table-bordered table-hover dataTable">
         <thead>
         <tr>
           <th>No. KTP</th>
           <th>Nama</th>
           <th>Jenis Kelamin</th>
           <th>Status</th>
           <th style="text-align:center;">Aksi</th>
         </tr>
         </thead>
         <tbody>
           <tr>
             <td>0123456789123456</td>
             <td>I Wayan Bajra Winarta, SH</td>
             <td>Laki-laki</td>
             <td>Manager</td>
             <td>
               <center>
                 <a href="#"><button class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i></button></a>
                 <a href="#"> <button class="btn btn-danger btn-sm"> <i class="fa fa-trash-o"></i></button></a>
               </center>
             </td>
           </tr>
           <tr>
             <td>0123456789123457</td>
             <td>I Wayan Suma</td>
             <td>Laki-laki</td>
             <td>Bagian Kredit</td>
             <td>
               <center>
                 <a href="#"><button class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i></button></a>
                 <a href="#"> <button class="btn btn-danger btn-sm"> <i class="fa fa-trash-o"></i></button></a>
               </center>
             </td>
           </tr>
           <tr>
             <td>0123456789123458</td>
             <td>Ni Putu Wikarini</td>
             <td>Perempuan</td>
             <td>Bagian Tabungan</td>
             <td>
               <center>
                 <a href="#"><button class="btn btn-primary btn-sm"> <i class="fa fa-pencil"></i></button></a>
                 <a href="#"> <button class="btn btn-danger btn-sm"> <i class="fa fa-trash-o"></i></button></a>
               </center>
             </td>
           </tr>
         </tbody>
       </table>
     </div>
     <!-- /.box-body -->
   </div>
   </div>
</div>
</div>
</section>

<div class="modal fade" id="tambahpegawai">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="text-align:center;">Tambah Pegawai</h4>
      </div>
      <div class="modal-body">
          <?php echo form_open_multipart('','class="form-horizontal"'); ?>
            <div class="box-body">
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">No. KTP</label>
                    <div class="col-sm-10">
                      <input class="form-control" placeholder="Email" type="email">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input class="form-control" placeholder="Email" type="email">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <div class="radio-list">
                          <label class="radio-inline"><input name="jns_kelamin" value="Pria" type="radio"> Pria </label>
                          <label class="radio-inline"><input name="jns_kelamin" value="Wanita" type="radio"> Wanita </label>
                      </div>
                      <div class="sp-error"><?php echo form_error('jns_kelamin'); ?></div>                </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Username</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" placeholder="Email" type="email">
                      <div class="sp-error"><?php echo form_error('agama'); ?></div>
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">Password</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" placeholder="Email" type="date">
                      <div class="sp-error"><?php echo form_error('agama'); ?></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Tempat Lahir</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" placeholder="Email" type="email">
                      <div class="sp-error"><?php echo form_error('agama'); ?></div>
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">Tgl Lahir</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" placeholder="Email" type="date">
                      <div class="sp-error"><?php echo form_error('agama'); ?></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Jabatan</label>
                    <div class="col-md-4 col-sm-9">
                      <select class="form-control" tabindex="1" name="agama">
                        <option value="" disabled="" selected="">--- Pilihan ---</option>
                          <option value="Hindu">Bagian Tabungan</option>
                          <option value="Islam">Bagian Kredit</option>
                      </select>
                      <div class="sp-error"><?php echo form_error('agama'); ?></div>
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">Agama</label>
                    <div class="col-md-4 col-sm-9">
                      <select class="form-control" tabindex="1" name="agama">
                        <option value="" disabled="" selected="">--- Pilihan ---</option>
                          <option value="Hindu">Hindu</option>
                          <option value="Islam">Islam</option>
                          <option value="Budha">Budha</option>
                          <option value="Kristen Katolik">Kristen Katolik</option>
                          <option value="Kristen Protestan">Kristen Protestan</option>
                      </select>
                      <div class="sp-error"><?php echo form_error('agama'); ?></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Email</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" placeholder="Email" type="email">
                      <div class="sp-error"><?php echo form_error('agama'); ?></div>
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">No. HP</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" placeholder="Email" type="date">
                      <div class="sp-error"><?php echo form_error('agama'); ?></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Alamat</label>
                    <div class="col-md-4 col-sm-9">
                      <textarea class="form-control" name="alamat" rows="8" cols="50" placeholder="Masukkan alamat lengkap" value="<?php echo set_value('alamat');?>"></textarea>
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
      <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Keluar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
