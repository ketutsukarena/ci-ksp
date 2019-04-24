<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller{

  public function __construct()
  {
    //tes perubahan
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
  }

  function index()
  {
    $data['vAkun'] = $this->akun->SelectAll()->result();

    $data['content'] = 'akun/view';
		$this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('kd','Kode Akun','required|numeric');
    $this->form_validation->set_rules('nm','Nama Akun','required');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('ketua/akun'));
    }else{
      $id = $this->input->post('kd', TRUE);
      $cek = $this->akun->cekakun($id);
      if (isset($cek)) {
        $this->session->set_flashdata('same', 'Gagal.!');
        redirect(site_url('ketua/akun'));
      }else {
        $data = array(
          'id_akun' => $id,
          'nama_akun' => $this->input->post('nm', TRUE),
        );
        $result = $this->akun->insert($data);
        $this->session->set_flashdata('success', 'Berhasil.!');
        redirect(site_url('ketua/akun'));
      }
    }
  }

  public function edit()
  {
    $id = $this->input->post('id');
    $result = $this->akun->SelectById($id);
    echo json_encode($result);
  }

  public function update()
  {
    $this->form_validation->set_rules('nm','Nama Akun','required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('ketua/akun'));
    }else{
      $id = $this->input->post('id');
      $data = array(
        'nama_akun' => $this->input->post('nm', TRUE),
      );
      $result = $this->akun->update($id, $data);
      $this->session->set_flashdata('success', 'Berhasil.!');
      redirect(site_url('ketua/akun'));
    }
  }

  public function hapus($id)
  {
    $this->akun->delete($id);
    redirect(site_url('ketua/akun'));
  }

}
