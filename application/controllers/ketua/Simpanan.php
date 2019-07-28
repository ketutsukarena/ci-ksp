<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simpanan extends CI_Controller{

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
    $this->load->model('M_jnsimpan', 'simpan'); //nama model, alis model
  }

  function index()
  {
    $data['vJS'] = $this->simpan->SelectAll()->result();
    $data['vAkun'] = $this->akun->SelectAll()->result_array();

    $data['content'] = 'jns_simpanan/view';
		$this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('kd','Jenis','required');
    $this->form_validation->set_rules('biaya','Nominal','required');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('ketua/simpanan'));
    }else{
      $id_akun = $this->input->post('kd', TRUE);
      $cek = $this->simpan->cekakun($id_akun);
      if (isset($cek)) {
        $this->session->set_flashdata('same', 'Gagal.!');
        redirect(site_url('ketua/simpanan'));
      }else {
        $data = array(
          'id_akun' => $id_akun,
          'nama_simpanan' => $this->akun->SelectById($id_akun)['nama_akun'],
          'nominal' => str_replace(',', '',$this->input->post('biaya')),
        );
        $result = $this->simpan->insert($data);
        $this->session->set_flashdata('success', 'Berhasil.!');
        redirect(site_url('ketua/simpanan'));
      }
    }
  }

  public function edit()
  {
    $id = $this->input->post('id');
    $result = $this->simpan->SelectById($id);
    echo json_encode($result);
  }

  public function update()
  {
    $this->form_validation->set_rules('jenis','Jenis','required');
    $this->form_validation->set_rules('biaya','Nominal','required');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('gagal', 'Gagal.!');
      redirect(site_url('ketua/simpanan'));
    }else{
      $id = $this->input->post('id', TRUE);
      $data = array(
        'nominal' => str_replace(',', '',$this->input->post('biaya')),
      );
      $result = $this->simpan->update($id, $data);
      $this->session->set_flashdata('berhasil', 'Berhasil.!');
      redirect(site_url('ketua/simpanan'));
    }
  }

  public function hapus($id_simpanan)
  {
    $this->simpan->delete($id_simpanan);
    redirect(site_url('ketua/simpanan'));
  }

}
