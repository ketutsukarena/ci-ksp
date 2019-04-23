<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biaya extends CI_Controller{

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
    $this->load->model('M_biaya', 'biaya');
  }

  function index()
  {
    $data['idfunction'] = $this->biaya->code_otomatis();
    $data['vAkun'] = $this->akun->SelectAll()->result_array();
    $data['vB'] = $this->biaya->SelectAll()->result();

    $data['content'] = 'biaya/view';
		$this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('nm','Nama Biaya','required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('ketua/biaya'));
    }else{
      $data = array(
        'id_biaya' => $this->biaya->id_function(),
        'kode_biaya' => $this->input->post('biaya',TRUE),
        'id_akun' => $this->input->post('akun',TRUE),
        'nama' => $this->input->post('nm', TRUE),
      );
      $result = $this->biaya->insert($data);
      $this->session->set_flashdata('success', 'Berhasil.!');
      redirect(site_url('ketua/biaya'));
    }
  }

  public function edit()
  {
    $id = $this->input->post('id');
    $result = $this->biaya->SelectById($id);
    echo json_encode($result);
  }

  public function update()
  {
    $this->form_validation->set_rules('nm','Nama Biaya','required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('gagal', 'Gagal.!');
      redirect(site_url('ketua/biaya'));
    }else{
      $id = $this->input->post('id');
      $data = array(
        'nama' => $this->input->post('nm'),
      );
      $result = $this->biaya->update($id, $data);
      $this->session->set_flashdata('berhasil', 'Berhasil.!');
      redirect(site_url('ketua/biaya'));

    }
  }

  public function hapus($id)
  {
    $this->biaya->delete($id);
    redirect(site_url('ketua/biaya'));
  }
}
