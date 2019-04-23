<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller{

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
    $this->load->model('M_pendapatan', 'pendapatan');
  }

  function index()
  {
    $data['idfunction'] = $this->pendapatan->code_otomatis();
    $data['vAkun'] = $this->akun->SelectAll()->result_array();
    $data['vP'] = $this->pendapatan->SelectAll()->result();

    $data['content'] = 'pendapatan/view';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('nm','Nama Pendapatan','required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('ketua/pendapatan'));
    }else{
      $data = array(
        'id_pendapatan' => $this->pendapatan->id_function(),
        'kode_pendapatan' => $this->input->post('pendapatan',TRUE),
        'id_akun' => $this->input->post('akun',TRUE),
        'nama' => $this->input->post('nm', TRUE),
      );
      $result = $this->pendapatan->insert($data);
      $this->session->set_flashdata('success', 'Berhasil.!');
      redirect(site_url('ketua/pendapatan'));
    }
  }

  public function edit()
  {
    $id = $this->input->post('id');
    $result = $this->pendapatan->SelectById($id);
    echo json_encode($result);
  }

  public function update()
  {
    $this->form_validation->set_rules('nm','Nama Biaya','required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('gagal', 'Gagal.!');
      redirect(site_url('ketua/pendapatan'));
    }else{
      $id = $this->input->post('id');
      $data = array(
        'nama' => $this->input->post('nm'),
      );
      $result = $this->pendapatan->update($id, $data);
      $this->session->set_flashdata('berhasil', 'Berhasil.!');
      redirect(site_url('ketua/pendapatan'));

    }
  }

  public function hapus($id)
  {
    $this->pendapatan->delete($id);
    redirect(site_url('ketua/pendapatan'));
  }

}
