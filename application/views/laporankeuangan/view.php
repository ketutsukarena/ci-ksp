
<section class="content" id="bukubesar">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
      <!-- menu -->
      <div class="row">
    <ul class="navbar-nav" >
        <li class="btn active"> <a href="#bukubesar">Buku Besar</a> </li>
        <li class="btn"> <a href="#neracasaldo">Neraca Saldo</a> </li>
        <li class="btn"> <a href="#neraca">Neraca</a> </li>
        <li class="btn"> <a href="#labarugi">Laba-Rugi</a> </li>
    </ul>
    </div>
      <!-- menu -->
      <div class="box-header">
          <h2>Buku Besar</h2>
          <div class="row">
            <div class="col-md-12">
              <div class="box-footer">
              <label>Cetak Report</label>
                <a href="<?php echo base_url('report/crdn') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
                <button class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> .xls</button>
              </div>
            </div>
          </div>
        </div>
      <?php foreach ($akun as $a) {?>
      <div class="box-body">
        <h4 class="box-title">Buku Besar <?php echo $a->nama_akun; ?></h4>
      <div class="table-responsive">
        <table id="export2excel" class="table table-bordered table-hover dataTable">
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
              $jurnal = $this->jurnal->selectbyakun($a->id_akun)->result();
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
                  echo $this->jurnal->totaldebetbyakun($a->id_akun);                  
                ?>
              </td>
              <td>
                <?php 
                  echo $this->jurnal->totalkreditbyakun($a->id_akun);                  
                ?>
                </td>
            </tr>
            <tr>
              <td colspan="4" style="text-align:right;">Saldo : </td>
              <td colspan="2">
                <?php 
                  echo $this->jurnal->totaldebetbyakun($a->id_akun) - $this->jurnal->totalkreditbyakun($a->id_akun);
                ?>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
      <hr bordered="1px"/>
<?php } ?>
    </div>
   </div>
  </div>
</section>



<!-- neraca saldo -->

<section class="content" id="neracasaldo">
  <div class="row">
   <div class="col-md-12">
     <div class="box box-success">
      <!-- menu -->
      <div class="row">
    <ul class="navbar-nav" >
        <li class="btn active"> <a href="#bukubesar">Buku Besar</a> </li>
        <li class="btn"> <a href="#neracasaldo">Neraca Saldo</a> </li>
        <li class="btn"> <a href="#neraca">Neraca</a> </li>
        <li class="btn"> <a href="#labarugi">Laba-Rugi</a> </li>
    </ul>
    </div>
      <!-- menu -->
        <div class="box-header">
          <h2>Neraca Saldo</h2>
          <div class="row">
            <div class="col-md-12">
              <div class="box-footer">
              <label>Cetak Report</label>
                <a href="<?php echo base_url('report/crdn') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
                <button class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> .xls</button>
              </div>
            </div>
          </div>
        </div>
      <!-- /.box-header -->
      <div class="box-body">
        <h4 class="box-title">Data Neraca Saldo</h4>
      <div class="table-responsive">
        <table id="export2excel" class="table table-bordered table-hover dataTable">
          <thead>
          <tr>
            <th style="text-align:center;">Kode Akun</th>
            <th style="text-align:center;">Nama Akun</th>
            <th style="text-align:center;">Kredit</th>
            <th style="text-align:center;">Kredit</th>
          </tr>
          </thead>
          <tbody>
            <?php
              $this->load->model('M_jurnal', 'jurnal');
              $totaldebet = 0;
              $totalkredit = 0;
              foreach ($akun as $i) {
                $debet = $this->jurnal->totaldebetbyakun($i->id_akun);
                $kredit = $this->jurnal->totalkreditbyakun($i->id_akun);
                ?>
            <tr>
              <th style="text-align:center;"><?php echo $i->id_akun ?></th>
              <td style="text-align:center;"><?php echo $i->nama_akun ?></td>
              <td><?php echo $debet ?></td>
              <td><?php echo $kredit ?></td>
            </tr>
            <?php 
              $totaldebet = $totaldebet + $debet;
              $totalkredit = $totalkredit + $kredit ;
              } 
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2" style="text-align:right;">Saldo : </td>
              <td>
                <?php 
                  echo $totaldebet;                  
                ?>
              </td>
              <td>
                <?php 
                  echo $totalkredit;                  
                ?>
                </td>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
   </div>
  </div>
</section>
<!-- neraca saldo -->


<!-- Neraca -->

<section class="content" id="neraca">
  <div class="row">
   <div class="col-md-12">
     <div class="box box-success">
      <!-- menu -->
      <div class="row">
    <ul class="navbar-nav" >
        <li class="btn active"> <a href="#bukubesar">Buku Besar</a> </li>
        <li class="btn"> <a href="#neracasaldo">Neraca Saldo</a> </li>
        <li class="btn"> <a href="#neraca">Neraca</a> </li>
        <li class="btn"> <a href="#labarugi">Laba-Rugi</a> </li>
    </ul>
    </div>
      <!-- menu -->
        <div class="box-header">
          <h2>Neraca</h2>
          <div class="row">
            <div class="col-md-12">
              <div class="box-footer">
              <label>Cetak Report</label>
                <a href="<?php echo base_url('report/crdn') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
                <button class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> .xls</button>
              </div>
            </div>
          </div>
        </div>
      <!-- /.box-header -->
      <div class="box-body">
        <h4 class="box-title">Data Neraca</h4>
      <div class="table-responsive">
        <table id="export2excel" class="table table-bordered table-hover dataTable">
          <thead>
          <tr>
            <th style="text-align:center;">Kode Akun</th>
            <th style="text-align:center;">Nama Akun</th>
            <th style="text-align:center;">Kredit</th>
            <th style="text-align:center;">Kredit</th>
          </tr>
          </thead>
          <tbody>
            <?php
              $this->load->model('M_jurnal', 'jurnal');
              $totaldebet = 0;
              $totalkredit = 0;
              foreach ($akun as $i) {
                $debet = $this->jurnal->totaldebetbyakun($i->id_akun);
                $kredit = $this->jurnal->totalkreditbyakun($i->id_akun);
                ?>
            <tr>
              <th style="text-align:center;"><?php echo $i->id_akun ?></th>
              <td style="text-align:center;"><?php echo $i->nama_akun ?></td>
              <td><?php echo $debet ?></td>
              <td><?php echo $kredit ?></td>
            </tr>
            <?php 
              $totaldebet = $totaldebet + $debet;
              $totalkredit = $totalkredit + $kredit ;
              } 
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2" style="text-align:right;">Saldo : </td>
              <td>
                <?php 
                  echo $totaldebet;                  
                ?>
              </td>
              <td>
                <?php 
                  echo $totalkredit;                  
                ?>
                </td>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
   </div>
  </div>
</section>
<!-- Neraca -->

<!-- Laba rugi -->

<section class="content" id="labarugi">
  <div class="row">
   <div class="col-md-12">
     <div class="box box-success">
      <!-- menu -->
      <div class="row">
    <ul class="navbar-nav" >
        <li class="btn active"> <a href="#bukubesar">Buku Besar</a> </li>
        <li class="btn"> <a href="#neracasaldo">Neraca Saldo</a> </li>
        <li class="btn"> <a href="#neraca">Neraca</a> </li>
        <li class="btn"> <a href="#labarugi">Laba-Rugi</a> </li>
    </ul>
    </div>
      <!-- menu -->
        <div class="box-header">
          <h2>Laba Rugi</h2>
          <div class="row">
            <div class="col-md-12">
              <div class="box-footer">
              <label>Cetak Report</label>
                <a href="<?php echo base_url('report/crdn') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
                <button class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> .xls</button>
              </div>
            </div>
          </div>
        </div>
      <!-- /.box-header -->
      <div class="box-body">
        <h4 class="box-title">Data Laba Rugi</h4>
      <div class="table-responsive">
        <table id="export2excel" class="table table-bordered table-hover dataTable">
          <thead>
          <tr>
            <th style="text-align:center;">Kode Akun</th>
            <th style="text-align:center;">Nama Akun</th>
            <th style="text-align:center;">Kredit</th>
            <th style="text-align:center;">Kredit</th>
          </tr>
          </thead>
          <tbody>
            <?php
              $this->load->model('M_jurnal', 'jurnal');
              $totaldebet = 0;
              $totalkredit = 0;
              foreach ($akun as $i) {
                $debet = $this->jurnal->totaldebetbyakun($i->id_akun);
                $kredit = $this->jurnal->totalkreditbyakun($i->id_akun);
                ?>
            <tr>
              <th style="text-align:center;"><?php echo $i->id_akun ?></th>
              <td style="text-align:center;"><?php echo $i->nama_akun ?></td>
              <td><?php echo $debet ?></td>
              <td><?php echo $kredit ?></td>
            </tr>
            <?php 
              $totaldebet = $totaldebet + $debet;
              $totalkredit = $totalkredit + $kredit ;
              } 
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2" style="text-align:right;">Saldo : </td>
              <td>
                <?php 
                  echo $totaldebet;                  
                ?>
              </td>
              <td>
                <?php 
                  echo $totalkredit;                  
                ?>
                </td>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
   </div>
  </div>
</section>
<!-- Laba rugi -->