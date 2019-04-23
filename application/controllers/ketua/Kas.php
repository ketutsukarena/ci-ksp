<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas extends CI_Controller{

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
    $data['dtkas'] = $this->db->select('kas.*, akun.*')
                            ->from('tb_kas as kas')
                            ->join('tb_akun as akun','kas.id_akun=akun.id_akun')
                            ->get()->result();
    $data['content'] = 'kas/view';
    $this->load->view('index',$data);
  }
}
