<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nabung extends CI_Controller{

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
    $this->load->model('M_reknasabah', 'rek');
    $this->load->model('M_nasabah', 'nasabah');
    $this->load->model('M_trxnabung', 'nabung');
    $this->load->model('M_akun', 'akun');
  }

  function index()
  {
    $data['vResult'] = $this->rek->SelectAll()->result_array();
    $data['vAkun'] = $this->akun->SelectAll()->result_array();
    $data['vNabung'] = $this->nabung->SelectAllTabungan()->result();

    $data['content'] = 'trxtabungan/inputnabung';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('nominal','Nominal','required');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('bagtab/nabung'));
    }else{
      $now = new DateTime('Asia/Kuala_Lumpur');
      $tgl = $now->format('Y-m-d');
      $idakun = $this->input->post('akun');
      $nom = str_replace(',', '',$this->input->post('nominal'));
      $id = $this->input->post('id_rek');

      $saldoakhir = str_replace(',', '',$this->input->post('saldo'));
      $hasil = $saldoakhir + $nom;
      $data = array(
        'id_reknasabah' => $id,
        'tgl_transaksi' => $tgl,
        'id_akun' => $idakun,
        'debet' => '0',
        'kredit' => $nom,
        'saldo' => $hasil,
        'id_user' => $this->session->login['id_user'],
      );
      $id_trx = $this->nabung->insert($data);

      $data_rek = array(
        'saldo_akhir' => $hasil,
      );
      $result = $this->nabung->updatesaldo($id, $data_rek);

      $data_kas = array(
        'jns_transaksi' => $id_trx,
        'status' => 'TRX-Tabungan',
        'tgl_transaksi' => $tgl,
        'id_akun' => $idakun,
        'debet' => $nom,
        'kredit' => '0',
      );
      $result = $this->nabung->insert_kas($data_kas);

      $this->session->set_flashdata('success', 'Berhasil.!');
      redirect(site_url('bagtab/nabung'));
    }
  }

}
