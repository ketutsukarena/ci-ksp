<section class="content-header">
  <h1>Laporan Keuangan
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Laporan Keuangan</li>
  </ol>
</section>

<section class="content">
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="pull-left header">
          <form action="<?php base_url('ketua/laporankeuangan'); ?>" method="post">
          <select name="idtutupbuku">
              <?php
                foreach ($tutupbuku as $a) {
                 echo "<option";
                 if ($a->id_tutup_buku == $idtutupbuku){
                   echo " selected=selected";
                 }
                 echo " value=".$a->id_tutup_buku."> Periode : ".$a->tgl_awal." s/d ".$a->tgl_akhir."</option>";
                }
                ?>
          </select>
          <li>
          <button class="btn btn-primary" type="submit" name="Submit">Pilih</button>
          </li>
         </form>
        </li>
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Buku Besar</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Neraca Saldo</a></li>
        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Laba Rugi</a></li>
        <li><a href="#tab_4" data-toggle="tab">Neraca</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="box-status">
            <div class="row">
              <div class="col-md-2">
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
          <?php foreach ($akun as $a) {?>
          <h4 class="box-title">Buku Besar <?php echo $a->nama_akun; ?></h4>
          <div class="box-body">
            <div class="table-responsive">
              <table id="tunda" class="table table-bordered table-hover dataTable">
                <thead>
                  <tr>
                    <th style="text-align:center;">No</th>
                    <th style="text-align:center;">Tgl Transaksi</th>
                    <th style="text-align:center;">Keterangan</th>
                    <th>Ref.</th>
                    <th>Debet</th>
                    <th style="text-align:center;">Kredit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $this->load->model('M_jurnal', 'jurnal');
                    $where = array( 'id_tutup_buku' => $idtutupbuku,
                                    'tb_jurnal_detail.id_akun' => $a->id_akun);
                    $jurnal = $this->jurnal->selectwhere($where)->result();
                    $no = 1;
                    foreach ($jurnal as $i) { ?>
                  <tr>
                    <th style="text-align:center;"><?php echo $no ?></th>
                    <td style="text-align:center;"><?php echo date("d M Y", strtotime($i->tgl_transaksi)) ?></td>
                    <td><?php echo $i->keterangan ?></td>
                    <td><?php echo "Referensi" ?></td>
                    <td><?php echo $i->debet; ?></td>
                    <td><?php echo $i->kredit; ?></td>
                  </tr>
                  <?php $no = $no+1; } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4" style="text-align:right;">total : </td>
                    <td>
                      <?php 
                        echo $this->jurnal->totaldebetwhere($where);                  
                      ?>
                    </td>
                    <td>
                      <?php 
                        echo $this->jurnal->totalkreditwhere($where);                  
                      ?>
                      </td>
                  </tr>
                  <tr>
                    <td colspan="4" style="text-align:right;">Saldo : </td>
                    <td colspan="2">
                      <?php 
                      if ($a->bertambah == 'd'){
                        echo $this->jurnal->totaldebetwhere($where) - $this->jurnal->totalkreditwhere($where);
                      }else{
                        echo $this->jurnal->totalkreditwhere($where) - $this->jurnal->totaldebetwhere($where);
                      }
                      ?>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
                    <?php } ?>
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
                    <th style="text-align:center;">Kode Akun</th>
                    <th style="text-align:center;">Nama Akun</th>
                    <th style="text-align:center;">Debet</th>
                    <th style="text-align:center;">Kredit</th>
                    <th style="text-align:center;">Saldo</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $this->load->model('M_jurnal', 'jurnal');
                    $totaldebet = 0;
                    $totalkredit = 0;
                    foreach ($akun as $i) {
                    $where = array( 'id_tutup_buku' => $idtutupbuku,
                                    'tb_jurnal_detail.id_akun' => $i->id_akun);
                      $debet = $this->jurnal->totaldebetwhere($where);
                      $kredit = $this->jurnal->totalkreditwhere($where);
                      ?>
                  <tr>
                    <th style="text-align:center;"><?php echo $i->id_akun ?></th>
                    <td style="text-align:center;"><?php echo $i->nama_akun ?></td>
                    <td><?php echo $debet ?></td>
                    <td><?php echo $kredit ?></td>
                    <td><?php
                      if ($i->bertambah == 'd'){
                        echo $debet-$kredit;
                      }else{
                        echo $kredit-$debet;
                      }
                      ?>
                    </td>
                  </tr>
                  <?php 
                    $totaldebet = $totaldebet + $debet;
                    $totalkredit = $totalkredit + $kredit ;
                    } 
                  ?>
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
              <table id="terima" class="table table-bordered table-hover dataTable">
                <thead>
                  <tr>
                    <th style="text-align:center;">Kode Akun</th>
                    <th style="text-align:center;">Nama Akun</th>
                    <th style="text-align:center;">Saldo</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $this->load->model('M_jurnal', 'jurnal');
                    $laba = 0;
                    foreach ($akun as $i) {
                      if(substr($i->id_akun,0,1) == 4 || substr($i->id_akun,0,1) == 5 ){
                        $where = array( 'id_tutup_buku' => $idtutupbuku,
                                        'tb_jurnal_detail.id_akun' => $i->id_akun);
                          $debet = $this->jurnal->totaldebetwhere($where);
                          $kredit = $this->jurnal->totalkreditwhere($where);
                          ?>
                      <tr>
                        <th style="text-align:center;"><?php echo $i->id_akun ?></th>
                        <td style="text-align:center;"><?php echo $i->nama_akun ?></td>
                        <td>
                          <?php
                          if ($i->bertambah == 'd'){
                            $saldo = $debet-$kredit;
                          }else{
                            $saldo = $kredit-$debet;
                          }
                          echo $saldo;
                          ?>
                        </td>
                      </tr>
                      <?php
                        if ($i->bertambah == 'd'){
                          $laba = $laba-$saldo;
                        }else{
                          $laba = $laba+$saldo;
                        }
                      } 
                    } 
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2" style="text-align:right;">Laba Rugi Bulan Berjalan : </td>
                    <td>
                      <?php 
                        echo $laba;                  
                      ?>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
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
                    <th style="text-align:center;">Kode Akun</th>
                    <th style="text-align:center;">Nama Akun</th>
                    <th style="text-align:center;">Saldo</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $this->load->model('M_jurnal', 'jurnal');
                    foreach ($akun as $i) {
                      if(substr($i->id_akun,0,1) == 1 || substr($i->id_akun,0,1) == 2 || substr($i->id_akun,0,1) == 3 ){
                        $where = array( 'id_tutup_buku' => $idtutupbuku,
                                        'tb_jurnal_detail.id_akun' => $i->id_akun);
                          $debet = $this->jurnal->totaldebetwhere($where);
                          $kredit = $this->jurnal->totalkreditwhere($where);
                          ?>
                      <tr>
                        <th style="text-align:center;"><?php echo $i->id_akun ?></th>
                        <td style="text-align:center;"><?php echo $i->nama_akun ?></td>
                        <td>
                          <?php
                          if ($i->bertambah == 'd'){
                            $saldo = $debet-$kredit;
                          }else{
                            $saldo = $kredit-$debet;
                          }
                          echo $saldo;
                          ?>
                        </td>
                      </tr>
                      <?php
                      } 
                    } 
                  ?>
                  <tr>
                        <td colspan="2" style="text-align:center;">Laba Rugi Bulan berjalan </td>
                        <td>
                          <?php
                            echo $laba;
                          ?>
                        </td>
                      </tr>
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