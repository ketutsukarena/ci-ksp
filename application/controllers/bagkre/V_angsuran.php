<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class V_angsuran extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_pinjaman', 'pinjam');
    $this->load->model('M_akun', 'akun');
    $this->load->model('M_trxangsuran', 'angsuran');
  }

  function index()
  {
    $data['vResult'] = $this->angsuran->SelectAll()->result();

    $data['content'] = 'trxangsuran/view';
    $this->load->view('index',$data);
  }

  public function detail($id_trx)
  {
    $data['vDet'] = $this->angsuran->SelectDetail($id_trx)->result();
    $data['vD'] = $this->angsuran->SelectData($id_trx)->result();

    $data['content'] = 'trxangsuran/detail';
    $this->load->view('index',$data);
  }

}
