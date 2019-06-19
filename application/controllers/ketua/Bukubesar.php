<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bukubesar extends CI_Controller{

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
    $this->load->model('M_Akun', 'akun');
    $this->load->model('M_jurnal', 'jurnal');
  }
  public function index(){
    $data['akun'] = $this->akun->SelectAll()->result();
    $data['jurnal'] = $this->jurnal->select()->result();
    $data['content'] = 'bukubesar/view';
    $this->load->view('index',$data);
  }
}