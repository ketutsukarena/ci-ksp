<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tdashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['login'])) {
      redirect(site_url('auth/error'));
    }if ($this->session->login['level']=="Admin") {
      redirect(site_url('admin/adashboard'));
    }if ($this->session->login['level']=="Ketua") {
      redirect(site_url('ketua/ktdashboard'));
    }if ($this->session->login['level']=="Bagian Kredit") {
      redirect(site_url('bagkre/kdashboard'));
    }
    $this->load->model('M_dashboard', 'dash');
  }

  function index()
  {
    $data['satu'] = $this->dash->total_nasabah();
    $data['dua'] = $this->dash->total_tabungan();
    $data['tiga'] = $this->dash->total_setoran();
    $data['empat'] = $this->dash->total_penarikan();
    $data['content'] = 'dashboard/dashboard_bt';
		$this->load->view('index',$data);
  }
}
