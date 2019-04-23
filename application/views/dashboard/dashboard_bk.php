<section class="content-header">
  <h1>
    Dashboard
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">
<div class="row">
  <div class="col-md-12">
    <div class="callout callout-danger">
      <h4>Hi!</h4>
      <p>Selamat datang <b><?php echo $this->session->login['nama'];?></b>, anda dapat mengelola data sesuai hak akses sebagai <b><?php echo $this->session->login['level'];?></b>.</p>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">

        <h3><?php echo "Rp. ",number_format($jum, 0,'', '.'); ?></h3>
        <p>Total Simpanan</p>
      </div>
      <div class="icon">
        <i class="ion ion-social-github"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo "Rp. ",number_format($deb, 0,'', '.'); ?></h3>
        <p>Kas Debet (Masuk)</p>
      </div>
      <div class="icon">
        <i class="ion ion-social-android"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3><?php echo "Rp. ",number_format($kre, 0,'', '.'); ?></h3>
        <p>Kas Kredit (Keluar)</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-pulse-strong"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo "Rp. ",number_format($kas, 0,'', '.'); ?></h3>
        <p>Saldo Kas Akhir</p>
      </div>
      <div class="icon">
        <i class="ion ion-social-apple"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
</section>
