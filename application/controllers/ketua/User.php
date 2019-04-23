<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

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
    $this->load->model('M_user', 'user');
    $this->load->model('M_anggota', 'anggota');
  }

  function index()
  {
    $data['vAnggota'] = $this->anggota->SelectAll()->result_array();
    $data['vUser'] = $this->user->SelectAll()->result();

    $data['content'] = 'session/view';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
     $this->form_validation->set_rules('kode_anggota','Kode Anggota','required');
     $this->form_validation->set_rules('user','Username','required');
     $this->form_validation->set_rules('pass','Password','required');
     if ($this->form_validation->run() == FALSE)
     {
       $this->session->set_flashdata('error', 'Gagal.!');
       redirect(site_url('ketua/pengurus'));
     }else{
       $id = $this->input->post('kode_anggota', TRUE);
       $lvl = $this->input->post('lvl', TRUE);
         if (($lvl == "Ketua") OR ($lvl == "Bagian Kredit")){
             $kuser = "-";
         }elseif($lvl == "Admin") {
             $kuser = "ADM";
         }elseif($lvl == "Bagian Tabungan") {
             $kuser = "BG";
         }else{
           $kuser = $this->input->post('user_kode');
         };
       $r = $this->user->cekuser($id);
       if (isset($r)) {
         $this->session->set_flashdata('same', 'Gagal.!');
         redirect(site_url('ketua/pengurus'));
       }else{
         $data = array(
           'id_nasabah' => $id,
           'username' => $this->input->post('user',TRUE),
           'password' => md5($this->input->post('pass', TRUE)),
           'level' => $lvl,
           'kode_user' => $kuser,
           'st' => "Aktif",
         );
         $result = $this->user->insert($data);
         $this->session->set_flashdata('success', 'Berhasil.!');
         redirect(site_url('ketua/pengurus'));
       }
    }
  }

  public function edit()
  {
    $id = $this->input->post('id');
    $result = $this->user->SelectById($id);
    echo json_encode($result);
  }

  public function update()
  {
    $this->form_validation->set_rules('user','Username','required');
    $this->form_validation->set_rules('pass','Password','required');
  //  $this->form_validation->set_rules('kd','Kode Anggota','is_unique[tb_user.id_nasabah]');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('gagal', 'Gagal.!');
      redirect(site_url('ketua/pengurus'));
    }else{
      $id = $this->input->post('id', TRUE);
      $lvl = $this->input->post('lvl', TRUE);
        if (($lvl == "Ketua") OR ($lvl == "Bagian Kredit")){
            $kuser = "-";
        }elseif($lvl == "Admin") {
            $kuser = "ADM";
        }elseif($lvl == "Bagian Tabungan") {
            $kuser = "BG";
        }else{
          $kuser = $this->input->post('user_kode');
        };
      $data = array(
        'id_nasabah' =>$this->input->post('kd'),
        'username' => $this->input->post('user'),
        'password' => md5($this->input->post('pass')),
        'level' => $lvl,
        'kode_user' =>$kuser,
        'st' => $this->input->post('status'),
      );
      $result = $this->user->update($id, $data);
      $this->session->set_flashdata('berhasil', 'Berhasil.!');
      redirect(site_url('ketua/pengurus'));
    }
  }

  public function hapus($id)
  {
    $this->user->delete($id);
    redirect(site_url('ketua/pengurus'));
  }
}
?>
