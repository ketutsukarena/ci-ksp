<div class="modal fade" id="editdata">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="text-align:center;">Edit Anggota</h4>
      </div>
      <div class="modal-body">
          <?php echo form_open_multipart('admin/anggota/tambah','class="form-horizontal"'); ?>
            <div class="box-body">
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Kode Anggota</label>
                    <div class="col-md-10 col-sm-9">
                      <input class="form-control" type="text" name="kd" id="e_kd" readonly>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">No. KTP</label>
                    <div class="col-md-10 col-sm-9">
                      <input class="form-control" name="ktp" placeholder="Masukkan nomor identitas kependudukan" type="text" id="e_ktp" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Nama</label>
                    <div class="col-md-10 col-sm-9">
                      <input class="form-control" name="nama" placeholder="Masukkan nama lengkap" type="text" id="e_nama" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Jenis Kelamin</label>
                    <div class="col-md-4 col-sm-9">
                      <div class="radio-list">
                        <label class="radio-inline"><input name="gender" id="e_gender" value="Laki-laki" type="radio">Laki-laki</label>
                        <label class="radio-inline"><input name="gender" id="e_gender" value="Perempuan" type="radio">Perempuan</label>
                      </div>
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">Agama</label>
                    <div class="col-md-4 col-sm-9">
                      <select class="form-control" tabindex="1" name="agama" id="e_agama">
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
                      <input class="form-control" placeholder="Masukkan tempat lahir" name="tempat_lahir" id="e_tmplahir" type="text" >
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">Tgl Lahir</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" name="tgl_lahir" type="date" id="e_lahir">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Email</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" placeholder="Masukkan alamat email" name="email" type="email" id="e_email">
                    </div>
                    <label class="col-md-2 col-sm-3 control-label">No. HP</label>
                    <div class="col-md-4 col-sm-9">
                      <input class="form-control" placeholder="Masukkan nomor handphone" name="no_hp" type="text" id="e_hp">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="col-md-2 col-sm-3 control-label">Alamat</label>
                    <div class="col-md-4 col-sm-9">
                      <textarea class="form-control" name="alamat" id="e_alamat" rows="8" cols="50" placeholder="Masukkan alamat lengkap" ></textarea>
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
function edit(id){
  $.ajax({
    url:"<?php echo site_url('admin/anggota/edit');?>",
    type:"POST",
    dataType: 'json',
    data:{id:id},
    cache:false,
    success:function(result){
      $('#e_kd').val(result['kode_anggota']);
      $('#e_ktp').val(result['no_ktp']);
      $('#e_nama').val(result['nama']);
      $('input:radio[id=e_gender]:checked').val(result['jk']);
      $('select[id=e_agama]').val(result['agama']);
      $('#e_tmplahir').val(result['tempat_lahir']);
      $('#e_lahir').val(result['tgl_lahir']);
      $('#e_email').val(result['email']);
      $('#e_hp').val(result['no_hp']);
      $('#e_alamat').val(result['alamat']);
      $('#e_alamat').val(result['alamat']);

      $('#e_alamat').val(result['alamat']);
    }
  });
}
</script>
