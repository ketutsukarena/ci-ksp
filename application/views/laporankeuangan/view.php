<!-- Collect the nav links, forms, and other content for toggling -->

<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav">
        <li class=""> <a href="#bukubesar">Buku Besar <span class="sr-only">(current)</span></a> </li>
        <li class=""> <a href="#neracasaldo">Neraca Saldo</a> </li>
        <li class=""> <a href="#neraca">Neraca</a> </li>
        <li class=""> <a href="#contact">Laba-Rugi</a> </li>
    </ul>
</div>
<!-- /.navbar-collapse -->

<section class="content-header" id="bukubesar">
  <div class="row">
    <div class=" col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Buku Besar</h3>
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
    </div>
  </div>
</section>

<?php foreach ($akun as $a) {

?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <!-- <div class="box-header">
          <h3 class="box-title">Buku Besar <?php //echo $a->nama_akun; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
          <div class="row">
            <div class="col-md-offset-10 col-md-2">
              <label>Cetak Report</label>
              <div class="box-footer">
                <a href="<?php //echo base_url('report/crdn') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
                <button class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> .xls</button>
              </div>
            </div>
          </div>
        </div> -->
      <!-- /.box-header -->
      <div class="box-body">
        <h3 class="box-title">Buku Besar <?php echo $a->nama_akun; ?></h3>
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
    </div>
   </div>
  </div>
</section>
<?php } ?>

<!-- Collect the nav links, forms, and other content for toggling -->

<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav">
        <li class=""> <a href="#bukubesar">Buku Besar <span class="sr-only">(current)</span></a> </li>
        <li class=""> <a href="#neracasaldo">Neraca Saldo</a> </li>
        <li class=""> <a href="#neraca">Neraca</a> </li>
        <li class=""> <a href="#contact">Laba-Rugi</a> </li>
    </ul>
</div>
<!-- /.navbar-collapse -->



<!-- neraca saldo -->
<section class="content-header" id="bukubesar">
  <div class="row">
    <div class=" col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Neraca Saldo</h3>
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
    </div>
  </div>
</section>

<section class="content">
  <div class="row">
   <div class="col-md-12">
     <div class="box box-success">
       <div class="box-header">
         <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
         <div class="row">
           <div class="col-md-offset-10 col-md-2">
             <label>Cetak Report</label>
             <div class="box-footer">
               <a href="<?php echo base_url('report/crdn') ?>" type="button" class="btn btn-primary" target="_blank"><i class="fa fa-print"> .pdf</i></a>
               <button class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> .xls</button>
             </div>
           </div>
         </div>
       </div>
      <!-- /.box-header -->
      <div class="box-body">
        <h3 class="box-title">Data Neraca Saldo</h3>
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


<section class="content-header" id="neracasaldo">
    <div class=" col-md-12">
        <h1 align="center">
            Neraca Saldo
        </h1>
    </div>
</section>

<!-- Collect the nav links, forms, and other content for toggling -->

<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav">
        <li class=""> <a href="#bukubesar">Buku Besar <span class="sr-only">(current)</span></a> </li>
        <li class=""> <a href="#neracasaldo">Neraca Saldo</a> </li>
        <li class=""> <a href="#neraca">Neraca</a> </li>
        <li class=""> <a href="#contact">Laba-Rugi</a> </li>
    </ul>
</div>
<!-- /.navbar-collapse -->

<section class="content-header" id="neraca">
    <div class=" col-md-12">
        <h1 align="center">
            Neraca
        </h1>
    </div>
</section>

<!-- Collect the nav links, forms, and other content for toggling -->

<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav">
        <li class=""> <a href="#bukubesar">Buku Besar <span class="sr-only">(current)</span></a> </li>
        <li class=""> <a href="#neracasaldo">Neraca Saldo</a> </li>
        <li class=""> <a href="#neraca">Neraca</a> </li>
        <li class=""> <a href="#contact">Laba-Rugi</a> </li>
    </ul>
</div>
<!-- /.navbar-collapse -->

<section class="content-header" id="contact">
    <div class=" col-md-12">
        <h1 align="center">
            Laba-Rugi
        </h1>
    </div>
</section>
