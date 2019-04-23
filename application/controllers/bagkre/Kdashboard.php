<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kdashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['login'])) {
      redirect(site_url('auth/error'));
    }if ($this->session->login['level']=="Admin") {
      redirect(site_url('admin/adashboard'));
    }if ($this->session->login['level']=="Bagian Tabungan") {
      redirect(site_url('bagtab/tdashboard'));
    }if ($this->session->login['level']=="Ketua") {
      redirect(site_url('ketua/ktdashboard'));
    }
    $this->load->model('M_dashboard', 'dash');
  }

  function index()
  {
    $data['jum'] = $this->dash->totalpinjaman();
    $data['kas'] = $this->dash->totalkas();
    $data['kre'] = $this->dash->kredit();
    $data['deb'] = $this->dash->debet();
    $data['content'] = 'dashboard/dashboard_bk';
		$this->load->view('index',$data);
  }
}
