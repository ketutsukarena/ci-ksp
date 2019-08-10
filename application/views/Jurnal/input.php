<section class="content">
    <div class="col-md-12">
    <?php 
        if($this->session->flashdata('gagal')){?>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $this->session->flashdata('gagal');?></strong> Data gagal ditambahkan.
          </div>
        <?php } ?>
        <div class="box box-info">
            <div class="box-body">
                <form action="http://localhost/ci-ksp/ketua/jurnal/tambahtmp/" class="form-horizontal" method="post">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kode Akun</label>
                                <div class="col-sm-4">
                                    <select name="akun" class="form-control" style="width: 100%" required>
                                        <option disabled selected>--Pilih akun--</option>
                                        <?php foreach ($akun as $a) { ?>
                                        <option value="<?php echo $a->id_akun ?>"><?php echo $a->id_akun." - ".$a->nama_akun ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                        <input type="radio" name="dk" value="debet" /> debet 
                                        <input type="radio" name="dk" value="kredit" /> Kredit
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nominal</label>
                            <div class="col-sm-10">
                            <input class="form-control" placeholder="Masukkan jumlah" name="nominal" type="text" >
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
                </form>


            <!-- view -->
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Akun</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no=1;
                    $totaldebet = 0;
                    $totalkredit = 0;
                    foreach ($tmpjurnal as $n) {?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $n->id_akun." - ".$n->nama_akun; ?></td>
                        <td><?php echo $n->debet; ?></td>
                        <td><?php echo $n->kredit; ?></td>
                        <td> 
                            <a href="<?php echo base_url('ketua/jurnal/deletetmp/'.$n->id)?>" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php 
                            $totaldebet = $totaldebet + $n->debet;
                            $totalkredit = $totalkredit + $n->kredit;
                        } ?>
                    
                    </tbody>
                    <tfoot>
                        <tr>
                        <td align="right" colspan="2"><b>Total</b></td>
                        <td>
                            <input type="text" name="debet" value="<?php echo $totaldebet ?>" disabled>
                        </td>
                        <td>
                            <input type="text" name="kredit" value="<?php echo $totalkredit ?>" disabled>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            <!-- view -->

            <form action="<?php echo base_url('ketua/jurnal/tambah/'.$totaldebet.'/'.$totalkredit)?>" method="post">
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10">
                            <input class="form-control" placeholder="keterangan" name="keterangan" type="text" >
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
                </form>
            </div>  
        </div>
    </div>
</div>

</section>

