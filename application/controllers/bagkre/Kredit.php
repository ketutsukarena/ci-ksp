<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kredit extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_nasabah', 'nasabah');
    $this->load->model('M_kredit', 'kredit');
  }

  function index()
  {
    $kreditor = $this->kredit->SelectAll()->result_array();
    if (!empty($kreditor)) {
      $id = array();
      foreach ($kreditor as $k) {
        $id[] = $k['id_nasabah'];
      }
      $data['vResult'] = $this->nasabah->SelectAllp($id)->result_array();
    }else {
      $data['vResult'] = $this->nasabah->SelectAll()->result_array();
    }

    $data['vTunda'] = $this->kredit->SelectTunda()->result();
    $data['vTerima'] = $this->kredit->SelectTerima()->result();
    $data['vTolak'] = $this->kredit->SelectTolak()->result();
    $data['content'] = 'kredit/input';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('id_nasabah', 'Cari Nasabah', 'required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('bagkre/kredit'));
    }else{
      $c_name = $this->input->post('c_name');
        if (empty($c_name)) {$c_name = '-';};
      $c_alamat = $this->input->post('c_alamat');
        if (empty($c_alamat)) {$c_alamat = '-';};
      $c_tlp = $this->input->post('c_tlp');
        if (empty($c_tlp)) {$c_tlp = '-';};

      $now = new DateTime('Asia/Kuala_Lumpur');
      $tgl = $now->format('Y-m-d');

      $data = array(
        'id_nasabah' => $this->input->post('id_nasabah'),
        'nama_perusahaan' => $c_name,
        'alamat_perusahaan' => $c_alamat,
        'telp_perusahaan' => $c_tlp,
        'nama_penanggung' => $this->input->post('pj_name'),
        'pekerjaan_penanggung' => $this->input->post('pj_job'),
        'alamat_penanggung' => $this->input->post('pj_alamat'),
        'telp_penanggung' => $this->input->post('pj_tlp'),
        'hubungan' => $this->input->post('pj_hub'),
        'status_rumah' => $this->input->post('pk_rumah'),
        'jaminan' => $this->input->post('pk_jaminan'),
        'nominal_permohonan' => str_replace(',', '',$this->input->post('pk_nom')),
        'ket_permohonan' => $this->input->post('pk_ket'),
        'tgl_permohonan' => $tgl,
        'status_permohonan' => 'Tunda',
      );
      $result = $this->kredit->insert($data);
      $this->session->set_flashdata('success', 'Berhasil.!');
      redirect(site_url('bagkre/kredit'));
    }
  }

  public function edit($id)
  {
    $data['edit'] = $this->kredit->SelectById($id)->row();
    $data['content'] = 'kredit/edit';
    $this->load->view('index',$data);
  }

  public function update()
  {
    $this->form_validation->set_rules('pj_name', 'Nama', 'required');
    $this->form_validation->set_rules('pj_hub', 'Hubungan', 'required');
    $this->form_validation->set_rules('pj_job', 'Pekerjaan', 'required');
    $this->form_validation->set_rules('pj_tlp', 'Telp.', 'required');
    $this->form_validation->set_rules('pj_alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('pk_rumah', 'Status Rumah', 'required');
    $this->form_validation->set_rules('pk_jaminan', 'Jaminan Kredit', 'required');
    $this->form_validation->set_rules('pk_nom', 'Nominal', 'required');
    $this->form_validation->set_rules('pk_ket', 'Untuk Keperluan', 'required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('gagal', 'Gagal.!');
      redirect(site_url('bagkre/kredit'));
    }else{
      $id = $this->input->post('id');
      $data = array(
        'nama_perusahaan' => $this->input->post('c_name'),
        'telp_perusahaan' => $this->input->post('c_tlp'),
        'alamat_perusahaan' => $this->input->post('c_alamat'),
        'nama_penanggung' => $this->input->post('pj_name'),
        'hubungan' => $this->input->post('pj_hub'),
        'pekerjaan_penanggung' => $this->input->post('pj_job'),
        'alamat_penanggung' => $this->input->post('pj_alamat'),
        'telp_penanggung' => $this->input->post('pj_tlp'),
        'status_rumah' => $this->input->post('pk_rumah'),
        'jaminan' => $this->input->post('pk_jaminan'),
        'nominal_permohonan' => str_replace(',', '',$this->input->post('pk_nom')),
        'ket_permohonan' => $this->input->post('pk_ket'),
      );
      $result = $this->kredit->update($id, $data);
      $this->session->set_flashdata('berhasil', 'Gagal.!');
      redirect(site_url('bagkre/kredit'));
    }
  }

  public function terima($id)
  {
    $data = array(
      'status_permohonan' => 'Terima',
    );
    $this->kredit->st_permohonan($id, $data);
    $this->session->set_flashdata('terima', 'Diterima.!');
    redirect(site_url('bagkre/kredit'));
  }

  public function tolak($id)
  {
    $data = array(
      'status_permohonan' => 'Tolak',
    );
    $this->kredit->st_permohonan($id, $data);
    $this->session->set_flashdata('tolak', 'Ditolak.!');
    redirect(site_url('bagkre/kredit'));
  }

}
