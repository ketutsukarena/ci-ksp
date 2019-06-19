<?php $status = $this->session->login['level'];
      $foto = $this->session->login['foto']; ?>
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url('/img/'.$foto)?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->login['username']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->login['level']; ?></a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <?php if ($status=="Ketua") { ?>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN MENU</li>
      <li class="<?php echo activate_menu('ktdashboard');?>"><a href="<?php echo site_url('ketua/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="<?php echo activate_menu('user');?>"><a href="<?php echo site_url('ketua/pengurus');?>"><i class="fa fa-users"></i> <span>Data Pengurus</span></a></li>
      <li class="<?php echo activate_menu('biaya'); echo activate_menu('pendapatan'); echo activate_menu('simpanan'); echo activate_menu('akun'); echo activate_menu('bungatabungan');?> treeview">
        <a href="#">
          <i class="fa fa-book"></i> <span>Data Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php echo activate_menu('akun');?>"><a href="<?php echo site_url('ketua/akun');?>"><i class="fa fa-circle-o"></i> <span>Jenis Akun</span></a></li>
          <li class="<?php echo activate_menu('simpanan');?>"><a href="<?php echo base_url('ketua/simpanan');?>"><i class="fa fa-circle-o"></i> Jenis Simpanan </a></li>
          <li class="<?php echo activate_menu('biaya');?>"><a href="<?php echo base_url('ketua/biaya');?>"><i class="fa fa-circle-o"></i> Jenis Biaya</a></li>
          <li class="<?php echo activate_menu('pendapatan');?>"><a href="<?php echo base_url('ketua/pendapatan');?>"><i class="fa fa-circle-o"></i> Jenis Pendapatan </a></li>
          <li class="<?php echo activate_menu('bungatabungan');?>"><a href="<?php echo base_url('ketua/bungatabungan');?>"><i class="fa fa-circle-o"></i> Bunga Tabungan </a></li>
        </ul>
      </li>
      <li class="<?php echo activate_menu('kas');?>"><a href="<?php echo site_url('ketua/kas');?>"><i class="fa fa-database"></i> <span>Data Kas</span></a></li>
        <li class="<?php echo activate_menu('data');?>"><a href="<?php echo base_url('ketua/jurnal');?>"><i class="fa fa-users"></i> <span>Jurnal</span></a></li>
      <li class="<?php echo activate_menu('kas');?>"><a href="<?php echo site_url('ketua/tutupbuku');?>"><i class="fa fa-book"></i> <span>Tutup Buku</span></a></li>
      <li class="<?php echo activate_menu('biaya'); echo activate_menu('pendapatan'); echo activate_menu('simpanan'); echo activate_menu('akun'); echo activate_menu('bungatabungan');?> treeview">
        <a href="#">
          <i class="fa fa-book"></i> <span>Laporan Keuangan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php echo activate_menu('bukubesar');?>"><a href="<?php echo site_url('ketua/bukubesar');?>"><i class="fa fa-circle-o"></i> <span>Buku Besar</span></a></li>
          <li class="<?php echo activate_menu('neracasaldo');?>"><a href="<?php echo base_url('ketua/neracasaldo');?>"><i class="fa fa-circle-o"></i>Neraca Saldo </a></li>
          <li class="<?php echo activate_menu('neraca');?>"><a href="<?php echo base_url('ketua/neraca');?>"><i class="fa fa-circle-o"></i>Neraca</a></li>
          <li class="<?php echo activate_menu('labarugi');?>"><a href="<?php echo base_url('ketua/labarugi');?>"><i class="fa fa-circle-o"></i>Laba-Rugi</a></li>
        </ul>
      </li>
    </ul>

  <?php } elseif ($status=="Admin") { ?>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN MENU</li>
      <li class="<?php echo activate_menu('adashboard');?>"><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="<?php echo activate_menu('anggota');?>"><a href="<?php echo base_url('admin/anggota');?>"><i class="fa fa-users"></i> <span>Data Anggota</span></a></li>
      <li class="<?php echo activate_menu('trxsim'); echo activate_menu('trxsimdet');?>  treeview">
        <a href="#">
          <i class="fa fa-briefcase"></i> <span>Data Simpanan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php echo activate_menu('trxsim');?>"><a href="<?php echo base_url('admin/trxsim');?>"><i class="fa fa-circle-o"></i> Pembayaran</a></li>
          <li class="<?php echo activate_menu('trxsimdet');?>"><a href="<?php echo base_url('admin/trxsim/view');?>"><i class="fa fa-circle-o"></i> Lihat Data</a></li>
        </ul>
      </li>
      <li class="<?php echo activate_menu('trxbiaya'); echo activate_menu('trxpendapatan');?> treeview">
        <a href="#">
          <i class="fa fa-book"></i> <span>Transaksi Lainnya</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php echo activate_menu('trxbiaya');?>"><a href="<?php echo base_url('admin/trxbiaya');?>"><i class="fa fa-circle-o"></i> Biaya</a></li>
          <li class="<?php echo activate_menu('trxpendapatan');?>"><a href="<?php echo base_url('admin/trxpendapatan');?>"><i class="fa fa-circle-o"></i> Pendapatan </a></li>
        </ul>
      </li>
    </ul>

    <?php } elseif ($status=="Bagian Tabungan") { ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <li class="<?php echo activate_menu('tdashboard');?>"><a href="<?php echo base_url('bagtab/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="<?php echo activate_menu('nasabah');?>"><a href="<?php echo base_url('bagtab/nasabah');?>"><i class="fa fa-users"></i> <span>Data Nasabah</span></a></li>
        <li class="<?php echo activate_menu('nabung'); echo activate_menu('penarikan');?> treeview">
          <a href="#">
            <i class="fa fa-briefcase"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo activate_menu('nabung');?>"><a href="<?php echo base_url('bagtab/nabung');?>"><i class="fa fa-circle-o"></i> Setoran</a></li>
            <li class="<?php echo activate_menu('penarikan');?>"><a href="<?php echo base_url('bagtab/penarikan');?>"><i class="fa fa-circle-o"></i> Penarikan</a></li>
          </ul>
        </li>
        <li class="<?php echo activate_menu('data');?>"><a href="<?php echo base_url('bagtab/data');?>"><i class="fa fa-users"></i> <span>Data Tabungan</span></a></li>
      </ul>
    <?php } elseif ($status=="Bagian Kredit") { ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <li class="<?php echo activate_menu('kdashboard');?>"><a href="<?php echo base_url('bagkre/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="<?php echo activate_menu('kredit');?>"><a href="<?php echo site_url('bagkre/kredit');?>"><i class="fa fa-database"></i> <span>Data Pengajuan Kredit</span></a></li>
        <li class="<?php echo activate_menu('pinjaman'); echo activate_menu('v_pinjaman');?> treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Data Transaksi Kredit</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo activate_menu('pinjaman');?>"><a href="<?php echo base_url('bagkre/pinjaman');?>"><i class="fa fa-circle-o"></i> Tambah </a></li>
            <li class="<?php echo activate_menu('v_pinjaman');?>"><a href="<?php echo base_url('bagkre/pinjaman/view');?>"><i class="fa fa-circle-o"></i> Lihat Data</a></li>
          </ul>
        </li>
        <li class="<?php echo activate_menu('angsuran'); echo activate_menu('v_angsuran');?> treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Data Transaksi Angsuran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo activate_menu('angsuran');?>"><a href="<?php echo base_url('bagkre/angsuran');?>"><i class="fa fa-circle-o"></i> Tambah </a></li>
            <li class="<?php echo activate_menu('v_angsuran');?>"><a href="<?php echo base_url('bagkre/angsuran/view');?>"><i class="fa fa-circle-o"></i> Lihat Data</a></li>
          </ul>
        </li>
      </ul>
    <?php } ?>
