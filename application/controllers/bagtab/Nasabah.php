<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nasabah extends CI_Controller{

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
    $this->load->model('M_nasabah', 'nasabah');
    $this->load->model('M_reknasabah', 'rek');
    $this->load->model('M_user', 'user');
  }

  function index()
  {
    $data['vResult'] = $this->nasabah->SelectAll()->result();
    $data['vUser'] = $this->user->SelectKolektor()->result();

    $data['content'] = 'nasabah/view';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('ktp', 'No. KTP', 'required|min_length[16]|max_length[16]|numeric');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('id_user', 'Nasabah dari', 'required');
    $this->form_validation->set_rules('agama', 'Agama', 'required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('bagtab/nasabah'));
    }else{
      $ktp = $this->input->post('ktp', TRUE);
      $cek = $this->nasabah->cekktp($ktp);
      if (isset($cek)) {
        $this->session->set_flashdata('same', 'Gagal.!');
        redirect(site_url('bagtab/nasabah'));
      }else {
        $img = $_FILES['img']['name'];
        $config['upload_path']='./img/';
        $config['allowed_types']='jpg|png|jpeg';
        $config['file_name'] = $ktp;
        $config['overwrite'] = TRUE;
        $config['file_ext_tolower'] = TRUE;
        $config['remove_space'] = TRUE;
        $this->load->library('upload',$config);
        $this->upload->do_upload('img');

        $images = $this->upload->data();

        $config['img_library'] = 'gd2';
        $config['source_image'] = './img/'.$images['file_name'];
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['quality'] = '100%';
        $config['width'] = 512;
        $config['height'] = 512;
        $config['new_image'] = './img/'.$images['file_name'];
        $this->load->library('image_lib',$config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }

        $now = new DateTime('Asia/Kuala_Lumpur');
        $tgl = $now->format('Y-m-d');
        $id = $this->nasabah->code_otomatis();
        $data = array(
          'id_nasabah' => $id,
          'no_ktp' => $ktp,
          'nama' => $this->input->post('nama', TRUE),
          'jk' => $this->input->post('gender', TRUE),
          'pekerjaan' => $this->input->post('kerja',TRUE),
          'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
          'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
          'agama' => $this->input->post('agama', TRUE),
          'email' => $this->input->post('email', TRUE),
          'no_hp' => $this->input->post('no_hp', TRUE),
          'alamat' => $this->input->post('alamat', TRUE),
          'foto' => $this->upload->data('file_name'),
          'tgl_daftar' => $tgl,
          'status' => 'Nasabah',
          'bln_akhir' => '0',
          'thn_akhir' => '0',
        );
        $result = $this->nasabah->insert($data);

        $datauser  = array(
          'id_nasabah' => $id,
          'username' => $ktp,
          'password' => md5('12345'),
          'level' => 'Nasabah',
          'kode_user' => '-',
          'st' => 'Aktif',
        );
        $resultrek = $this->user->insert_nasabah($datauser);

        $now = new DateTime('Asia/Kuala_Lumpur');
        $thn = $now->format('Y');
        $kd = $this->input->post('kd_user');
        $norek = $kd."/".$thn;
        $hasil = $this->rek->cekrek($id);
        if (isset($hasil)) {
          redirect(site_url('bagtab/nasabah'));
        }else {
          $datarek = array(
            'id_reknasabah' => $this->rek->idrek(),
            'no_rek' => $norek,
            'id_nasabah' => $id,
            'tgl_bukarek' => $tgl,
            'saldo_akhir' => "0",
            'rek_status' => "Baru",
            'id_user' => $this->input->post('id_user'),
          );
          $resultrek = $this->rek->insert($datarek);
          $this->session->set_flashdata('success', 'Berhasil.!');
          redirect(site_url('bagtab/nasabah'));
        }
      }
    }
  }

  public function edit($id)
  {
    $data['edit'] = $this->nasabah->SelectById($id)->row();
    $data['content'] = 'nasabah/edit';
    $this->load->view('index',$data);
  }

  public function update()
  {
    $this->form_validation->set_rules('ktp', 'No. KTP', 'required|min_length[16]|max_length[16]|numeric');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('bagtab/nasabah'));
    }else{
      $ktp = $this->input->post('ktp', TRUE);
      $id = $this->input->post('id');
      $img = $this->input->post('img');
      if ($_FILES['img']['name']==""){
        $data = array(
          'no_ktp' => $ktp,
          'nama' => $this->input->post('nama', TRUE),
          'jk' => $this->input->post('gender', TRUE),
          'pekerjaan' => $this->input->post('kerja',TRUE),
          'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
          'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
          'agama' => $this->input->post('agama', TRUE),
          'email' => $this->input->post('email', TRUE),
          'no_hp' => $this->input->post('no_hp', TRUE),
          'alamat' => $this->input->post('alamat', TRUE),
        );
        $result = $this->nasabah->update($id, $data);
        $this->session->set_flashdata('success', 'Berhasil.!');
        redirect(site_url('bagtab/nasabah'));
      }else {
        $img = $_FILES['img']['name'];
        $config['upload_path']='./img/';
        $config['allowed_types']='jpg|png|jpeg';
        $config['file_name'] = $ktp;
        $config['overwrite'] = TRUE;
        $config['file_ext_tolower'] = TRUE;
        $config['remove_space'] = TRUE;
        $this->load->library('upload',$config);
        $this->upload->do_upload('img');

        $images = $this->upload->data();

        $config['img_library'] = 'gd2';
        $config['source_image'] = './img/'.$images['file_name'];
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['quality'] = '100%';
        $config['width'] = 512;
        $config['height'] = 512;
        $config['new_image'] = './img/'.$images['file_name'];
        $this->load->library('image_lib',$config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
        $data = array(
          'no_ktp' => $ktp,
          'nama' => $this->input->post('nama', TRUE),
          'jk' => $this->input->post('gender', TRUE),
          'pekerjaan' => $this->input->post('kerja',TRUE),
          'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
          'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
          'agama' => $this->input->post('agama', TRUE),
          'email' => $this->input->post('email', TRUE),
          'no_hp' => $this->input->post('no_hp', TRUE),
          'alamat' => $this->input->post('alamat', TRUE),
          'foto' => $this->upload->data('file_name'),
        );
        $result = $this->nasabah->update($id, $data);
        $this->session->set_flashdata('success', 'Berhasil.!');
        redirect(site_url('bagtab/nasabah'));
      }
    }
  }

  public function hapus($id)
  {
    $where = array('id_nasabah' => $id);
    $this->nasabah->delete($where,$id,'tb_nasabah');
    redirect(site_url('bagtab/nasabah'));
  }
}
