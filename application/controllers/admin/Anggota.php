<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['login'])) {
      redirect(site_url('auth/error'));
    }if ($this->session->login['level']=="Ketua") {
      redirect(site_url('ketua/dashboard'));
    }if ($this->session->login['level']=="Bagian Tabungan") {
      redirect(site_url('bagtab/dashboard'));
    }if ($this->session->login['level']=="Bagian Kredit") {
      redirect(site_url('bagkre/dashboard'));
    }
    $this->load->model('M_anggota', 'anggota');
    $this->load->model('M_user', 'user');
    $this->load->model('M_reknasabah', 'rek');
  }

  function index()
  {
    $data['vAng'] = $this->anggota->SelectAll()->result();
    $data['content'] = 'anggota/view';
		$this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('ktp', 'No. KTP', 'required|min_length[16]|max_length[16]|numeric');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('admin/anggota'));
    }else{
      $ktp = $this->input->post('ktp', TRUE);
      $cek = $this->anggota->cekktp($ktp);
      if (isset($cek)) {
        $this->session->set_flashdata('same', 'Gagal.!');
        redirect(site_url('admin/anggota'));
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
        $year = $now->format('Y');
        $month = $now->format('n');
        $tgl = $now->format('Y-m-d');

        $data = array(
          'id_nasabah' => $this->anggota->code_otomatis(),
          'no_ktp' => $ktp,
          'nama' => $this->input->post('nama', TRUE),
          'jk' => $this->input->post('gender', TRUE),
          'pekerjaan' => $this->input->post('kerja', TRUE),
          'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
          'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
          'agama' => $this->input->post('agama', TRUE),
          'email' => $this->input->post('email', TRUE),
          'no_hp' => $this->input->post('no_hp', TRUE),
          'alamat' => $this->input->post('alamat', TRUE),
          'foto' => $this->upload->data('file_name'),
          'tgl_daftar' => $tgl,
          'status' => 'Anggota',
          'bln_akhir' => $month,
          'thn_akhir' => $year,
        );
        $result = $this->anggota->insert($data);
        $this->session->set_flashdata('success', 'Berhasil.!');
        redirect(site_url('admin/anggota'));
      }
    }
  }

  public function edit($id)
  {
    $data['edit'] = $this->anggota->SelectById($id)->row();
    $data['content'] = 'anggota/edit';
    $this->load->view('index',$data);
  }

  public function update()
  {
    $this->form_validation->set_rules('ktp', 'No. KTP', 'required|min_length[16]|max_length[16]|numeric');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('admin/anggota'));
    }else{
      $ktp = $this->input->post('ktp', TRUE);
      $id = $this->input->post('id');
      $img = $this->input->post('img');

      if ($_FILES['img']['name']==""){
        $data = array(
          'no_ktp' => $ktp,
          'nama' => $this->input->post('nama', TRUE),
          'jk' => $this->input->post('gender', TRUE),
          'pekerjaan' => $this->input->post('kerja', TRUE),
          'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
          'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
          'agama' => $this->input->post('agama', TRUE),
          'email' => $this->input->post('email', TRUE),
          'no_hp' => $this->input->post('no_hp', TRUE),
          'alamat' => $this->input->post('alamat', TRUE),
        );
        $result = $this->anggota->update($id, $data);
        $this->session->set_flashdata('success', 'Berhasil.!');
        redirect(site_url('admin/anggota'));
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
          'pekerjaan' => $this->input->post('kerja', TRUE),
          'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
          'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
          'agama' => $this->input->post('agama', TRUE),
          'email' => $this->input->post('email', TRUE),
          'no_hp' => $this->input->post('no_hp', TRUE),
          'alamat' => $this->input->post('alamat', TRUE),
          'foto' => $this->upload->data('file_name'),
        );
        $result = $this->anggota->update($id, $data);
        $this->session->set_flashdata('success', 'Berhasil.!');
        redirect(site_url('admin/anggota'));
      }
    }
  }

  public function hapus($id)
  {
    $where = array('id_nasabah' => $id);
    $this->anggota->delete($where,'tb_nasabah');
    redirect(site_url('admin/anggota'));
  }

  public function status()
  {
    $id = $this->input->post('id');
    $result = $this->anggota->SelectByStatus($id);
    echo json_encode($result);
  }

  public function upstatus()
  {
    $now = new DateTime('Asia/Kuala_Lumpur');
    $thn = $now->format('Y');
    $tgl = $now->format('Y-m-d');

    $kd = $this->session->login['kode'];
    $norek = $kd."/".$thn;

    $id = $this->input->post('id');
    $ktp = $this->input->post('ktp');
    $status = $this->input->post('st');
    if ($status=="Anggota & Nasabah") {
        $hasil = $this->rek->checkrek($id);
        if (isset($hasil)) {
          redirect(site_url('admin/anggota'));
        }else {
          $st = "Anggota & Nasabah";
          $data = array(
            'status' => $st,
          );
          $result = $this->anggota->upstatus($id, $data);

          $datarek = array(
            'id_reknasabah' => $this->rek->idrek(),
            'no_rek' => $norek,
            'id_nasabah' => $id,
            'tgl_bukarek' => $tgl,
            'saldo_akhir' => "0",
            'rek_status' => "Baru",
            'id_user' => $this->session->login['id_user'],
          );
          $resultrek = $this->rek->insert($datarek);

          $datauser  = array(
            'id_nasabah' => $id,
            'username' => $ktp,
            'password' => md5('12345'),
            'level' => 'Nasabah',
            'kode_user' => '-',
            'st' => 'Aktif'
          );
          $resultrek = $this->user->insert_nasabah($datauser);
          redirect(site_url('admin/anggota'));
        }
    }else{
      $st = "Anggota";
      $data = array(
        'status' => $st,
      );
      $result = $this->anggota->upstatus($id, $data);

      $this->anggota->delrek($id);
      redirect(site_url('admin/anggota'));
    }
  }
}
