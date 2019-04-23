<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bungatabungan extends CI_Controller{

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
    $this->load->model('M_akun', 'akun');
    $this->load->model('M_bunga', 'bunga');
  }

  function index()
  {
    $data['vAkun'] = $this->akun->SelectAll()->result_array();

    $data['vResult'] = $this->bunga->SelectAll()->result();
    $data['content'] = 'bunga/view';
		$this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('nm','Bunga (%)','required');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('ketua/bungatabungan'));
    }else{
      $id = $this->input->post('akun', TRUE);
      $cek = $this->bunga->cekakun($id);
      if (isset($cek)) {
        $this->session->set_flashdata('same', 'Gagal.!');
        redirect(site_url('ketua/bungatabungan'));
      }else {
        $data = array(
          'id_akun' => $id,
          'nominal' => $this->input->post('nm', TRUE),
        );
        $result = $this->bunga->insert($data);
        $this->session->set_flashdata('success', 'Berhasil.!');
        redirect(site_url('ketua/bungatabungan'));
      }
    }
  }

  public function edit()
  {
    $id = $this->input->post('id');
    $result = $this->bunga->SelectById($id);
    echo json_encode($result);
  }

  public function update()
  {
    $this->form_validation->set_rules('nm','Bunga (%)','required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('gagal', 'Gagal.!');
      redirect(site_url('ketua/bungatabungan'));
    }else{
      $id = $this->input->post('id');
      $data = array(
        'nominal' => $this->input->post('nm'),
      );
      $result = $this->bunga->update($id, $data);
      $this->session->set_flashdata('berhasil', 'Berhasil.!');
      redirect(site_url('ketua/bungatabungan'));

    }
  }

  public function hapus($id)
  {
    $this->biaya->delete($id);
    redirect(site_url('ketua/bungatabungan'));
  }
}
