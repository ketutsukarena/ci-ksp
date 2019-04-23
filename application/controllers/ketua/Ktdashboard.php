<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ktdashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['login'])) {
      redirect(site_url('auth/error'));
    }if ($this->session->login['level']=="Admin") {
      redirect(site_url('admin/adashboard'));
    }if ($this->session->login['level']=="Bagian Tabungan") {
      redirect(site_url('bagtab/tdashboard'));
    }if ($this->session->login['level']=="Bagian Kredit") {
      redirect(site_url('bagkre/kdashboard'));
    }
    $this->load->model('M_dashboard', 'dash');
  }

  function index()
  {
    $data['satu'] = $this->dash->total_pengurus();
    $data['dua'] = $this->dash->totalkas();
    $data['tiga'] = $this->dash->kredit();
    $data['empat'] = $this->dash->debet();
    $data['content'] = 'dashboard/dashboard_ketua';
		$this->load->view('index',$data);
  }
}
