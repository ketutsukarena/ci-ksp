<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class V_pinjaman extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_kredit', 'kredit');
    $this->load->model('M_pinjaman', 'pinjam');

  }

  function index()
  {
    $data['vResult'] = $this->pinjam->SelectAll()->result();

    $data['content'] = 'trxkredit/view';
    $this->load->view('index',$data);
  }

}
