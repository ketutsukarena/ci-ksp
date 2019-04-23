<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_user', 'M_Auth'); //nama model, alis model
  }

  function index()
  {
    $this->load->view('session/login');
  }

  // public function admin()
  // {
  //   $this->load->view('session/login-admin');
  // }
  //
  // public function register()
  // {
  //   $this->load->view('session/daftar');
  // }
  //
  // public function alert()
  // {
  //   $this->load->view('session/pemberitahuan');
  // }

  public function verify()
  {
    $user = $this->input->post('user', TRUE);
    $pass = md5($this->input->post('pass', TRUE));
    $result = $this->M_Auth->verify($user, $pass);
    if (($result['level']=="Kolektor") || ($result['level']=="Nasabah")) {
      $this->session->set_flashdata('gagal','Login gagal, username atau password salah!');
      redirect(site_url(''));
    }else {
      if ($result <> null) {
        $data = array(
          'id_user' => $result['id_user'],
          'id_nasabah' => $result['id_nasabah'],
          'username' => $result['username'],
          'password' => $result['password'],
          'level' => $result['level'],
          'kode' => $result['kode_user'],
          'foto' => $result['foto'],
          'nama' => ($result['nama']),
        );
        $this->session->set_userdata('login', $data);
        if ($this->session->login['level']=="Ketua") {
          redirect(site_url('ketua/dashboard'));
        }if ($this->session->login['level']=="Admin") {
          redirect(site_url('admin/dashboard'));
        }if ($this->session->login['level']=="Bagian Tabungan") {
          redirect(site_url('bagtab/dashboard'));
        }if ($this->session->login['level']=="Bagian Kredit") {
          redirect(site_url('bagkre/dashboard'));
        }
      }else {
        $this->session->set_flashdata('gagal','Login gagal, username atau password salah!');
        redirect(site_url(''));
      }
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('login');
    redirect('');
  }

  public function error()
  {
    $this->load->view('404');
  }

  public function edit()
  {
    $id = $this->input->post('id');
    $result = $this->M_Auth->SelectById($id);
    echo json_encode($result);
  }

  public function update()
  {
    $this->form_validation->set_rules('user','Username','required');
    $this->form_validation->set_rules('pass','Password','required');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('gagal', 'Gagal.!');
      redirect(site_url(''));
    }else{
      $id = $this->input->post('id', TRUE);
      $data = array(
        'username' => $this->input->post('user'),
        'password' => md5($this->input->post('pass', TRUE)),
        'kode_user' => $kuser,
      );
      $result = $this->M_Auth->update($id, $data);
      $this->session->unset_userdata('login');
      $this->session->set_flashdata('berhasil', 'Perubahan berhasil disimpan, silahkan login kembali');
      redirect(site_url(''));
    }
  }

  public function reset()
  {
    $this->load->view('session/reset');
  }
  
  public function verif()
  {
    $this->load->view('session/verifikasi');
  }
  public function verifikasi()
  {
    $id = $this->input->post('kode');
      $result = $this->M_Auth->verifikasi($id);
      redirect(site_url('auth/new_password/'.$result['id_user']));
  }

  public function new_password($id_user)
  {
    $data['edit'] = $id_user;
    $this->load->view('session/pass_baru',$data);
  }

  public function updatepass()
  {
      $id = $this->input->post('id_user');
      $data = array(
        'password' => md5($this->input->post('newpass')),
      );
      $result = $this->M_Auth->uppass($id,$data);
      redirect(site_url(''));
  }
}
