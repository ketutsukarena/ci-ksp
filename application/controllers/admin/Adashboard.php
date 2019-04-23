<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['login'])) {
      redirect(site_url('auth/error'));
    }if ($this->session->login['level']=="Ketua") {
      redirect(site_url('ketua/ktdashboard'));
    }if ($this->session->login['level']=="Bagian Tabungan") {
      redirect(site_url('bagtab/tdashboard'));
    }if ($this->session->login['level']=="Bagian Kredit") {
      redirect(site_url('bagkre/kdashboard'));
    }
    $this->load->model('M_dashboard', 'dash');
  }

  function index()
  {
    $data['satu'] = $this->dash->total_anggota();
    $data['dua'] = $this->dash->total_simpanan();
    $data['tiga'] = $this->dash->total_biaya();
    $data['empat'] = $this->dash->total_pendapatan();
    $data['content'] = 'dashboard/dashboard_admin';
		$this->load->view('index',$data);
  }
}
