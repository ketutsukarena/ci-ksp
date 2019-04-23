<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trxbiaya extends CI_Controller{

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
    $this->load->model('M_biaya', 'biaya');
    $this->load->model('M_trxbiaya', 'trx');
  }

  function index()
  {
    $data['Vb'] = $this->biaya->SelectAll()->result_array();
    $data['ResultVb'] = $this->trx->SelectAll()->result();

    $data['content'] = 'biaya/trx';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
    $now = new DateTime('Asia/Kuala_Lumpur');
    $tgl = $now->format('Y-m-d');

    $this->form_validation->set_rules('ket','Keterangan','required');

    if ($this->form_validation->run() == FALSE)
    {
     $this->session->set_flashdata('error', 'Gagal.!');
     redirect(site_url('admin/trxbiaya'));
    }else{
     $data = array(
       'id_biaya' => $this->input->post('id'),
       'nominal' => str_replace(',', '',$this->input->post('biaya')),
       'keterangan' => $this->input->post('ket'),
       'tgl_transaksi' => $tgl,
     );
     $id_trx = $this->trx->insert($data);

     $kas = array(
       'jns_transaksi' => $id_trx,
       'status' => 'TRX-Biaya',
       'tgl_transaksi' => $tgl,
       'id_akun' => $this->input->post('id_akun'),
       'debet' => '0',
       'kredit' => str_replace(',', '',$this->input->post('biaya')),
     );
     $result = $this->trx->insert_kas($kas);
     $this->session->set_flashdata('success', 'Berhasil.!');
     redirect(site_url('admin/trxbiaya'));
    }
  }

  public function edit()
  {
    $id = $this->input->post('id');
    $result = $this->trx->SelectById($id);
    echo json_encode($result);
  }

  public function update()
  {
    $now = new DateTime('Asia/Kuala_Lumpur');
    $tgl = $now->format('Y-m-d');

    $this->form_validation->set_rules('ket','Keterangan','required');

    if ($this->form_validation->run() == FALSE)
    {
     $this->session->set_flashdata('error', 'Gagal.!');
     redirect(site_url('admin/trxbiaya'));
    }else{
     $id = $this->input->post('id_trx');
     $data = array(
       'id_biaya' => $this->input->post('id_biaya'),
       'nominal' => str_replace(',', '',$this->input->post('biaya')),
       'keterangan' => $this->input->post('ket'),
       'tgl_transaksi' => $tgl,
     );
     $result = $this->trx->update($id, $data);

     $kas = array(
       'jns_transaksi' => $id,
       'tgl_transaksi' => $tgl,
       'kredit' => str_replace(',', '',$this->input->post('biaya')),
     );
     $result = $this->trx->update_kas($id, $kas);
     $this->session->set_flashdata('success', 'Berhasil.!');
     redirect(site_url('admin/trxbiaya'));
    }
  }

  public function hapus($id)
  {
    $this->trx->delete($id);
    redirect(site_url('admin/trxbiaya'));
  }
}
