<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trxpendapatan extends CI_Controller{

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
    $this->load->model('M_pendapatan', 'pen');
    $this->load->model('M_trxpendapatan', 'trx');
    $this->load->model('M_link_akun', 'linkakun');
    $this->load->model('M_jurnal','jurnal');
    
  }

  function index()
  {
    $data['Vb'] = $this->pen->SelectAll()->result_array();
    $data['ResultVb'] = $this->trx->SelectAll()->result();

    $data['content'] = 'pendapatan/trx';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
    $now = new DateTime('Asia/Kuala_Lumpur');
    $tgl = $now->format('Y-m-d');
    $ket = $this->input->post('ket');
    $nom = str_replace(',', '',$this->input->post('pendapatan'));

    $this->form_validation->set_rules('ket','Keterangan','required');

    if ($this->form_validation->run() == FALSE)
    {
     $this->session->set_flashdata('error', 'Gagal.!');
     redirect(site_url('admin/trxpendapatan'));
    }else{
     $data = array(
       'id_pendapatan' => $this->input->post('id'),
       'nominal' => $nom,
       'keterangan' => $ket,
       'tgl_transaksi' => $tgl,
     );
     $id_trx = $this->trx->insert($data);

     $kas = array(
       'jns_transaksi' => $id_trx,
       'status' => 'TRX-Pendapatan',
       'tgl_transaksi' => $tgl,
       'id_akun' => $this->input->post('id_akun'),
       'debet' => $nom,
       'kredit' => '0',
     );
     $result = $this->trx->insert_kas($kas);

     // tambah jurnal

      $idjurnal= $this->jurnal->getidmax() + 1;
      $keterangan = $ket;
      $id_jenis_transaksi = "8";
      $nominal = $nom;
      
      include_once("tambah_jurnal.php");
      //tambah jurnal

     $this->session->set_flashdata('success', 'Berhasil.!');
     redirect(site_url('admin/trxpendapatan'));
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
     $this->session->set_flashdata('gagal', 'Gagal.!');
     redirect(site_url('admin/trxpendapatan'));
    }else{
     $id = $this->input->post('id_trx');
     $data = array(
       'id_pendapatan' => $this->input->post('id_pendapatan'),
       'nominal' => str_replace(',', '',$this->input->post('pendapatan')),
       'keterangan' => $this->input->post('ket'),
       'tgl_transaksi' => $tgl,
     );
     $result = $this->trx->update($id, $data);

     $kas = array(
       'jns_transaksi' => $id,
       'tgl_transaksi' => $tgl,
       'debet' => str_replace(',', '',$this->input->post('pendapatan')),
     );
     $result = $this->trx->update_kas($id, $kas);
     $this->session->set_flashdata('berhasil', 'Berhasil.!');
     redirect(site_url('admin/trxpendapatan'));
    }
  }

  public function hapus($id)
  {
    $this->trx->delete($id);
    redirect(site_url('admin/trxpendapatan'));
  }

}
