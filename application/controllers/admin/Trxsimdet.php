<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trxsimdet extends CI_Controller{

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
    $this->load->model('M_trxsimpan', 'trx');
    $this->load->model('M_trxsimpan_det', 'trx_det');
    $this->load->model('M_anggota', 'anggota');
    $this->load->model('M_jnsimpan', 'simpan');
  }

  function index()
  {
    $data['vTrx'] = $this->trx->SelectAll()->result();

    $data['content'] = 'trxsimpanan/view';
    $this->load->view('index',$data);
  }

  public function trx($id)
  {
    $data['vAng'] = $this->trx_det->SelectAng($id)->result();
    $data['vDet'] = $this->trx_det->SelectDet($id)->result();

    $data['content'] = 'trxsimpanan/det_trx';
    $this->load->view('index',$data);
  }

  public function det()
  {
    $id = $this->input->post('id');
    $result = $this->trx_det->SelectByDet($id);
    echo json_encode($result);
  }

  public function all($id)
  {
    $data['vAng'] = $this->trx_det->SelectAng($id)->result();
    $data['vXx'] = $this->trx_det->Selectxx($id)->result();

    $data['content'] = 'trxsimpanan/detail';
    $this->load->view('index',$data);
  }
}
?>
