<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trxbiaya extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['login'])) {
      redirect(site_url('auth/error'));
    }if ($this->session->login['level']=="Ketua") {
      redirect(site_url('ketua/ktdashboard'));
    }if ($this->session->login['level']=="Bagian Tabungan") {
      redirect(site_url('bagtab/tdashboard'));
    }if ($this->session->login['level']=="Bagian Kredit") {
      redirect(site_url('bagkre/kdashboard'));
    }
    $this->load->model('M_biaya', 'biaya');
    $this->load->model('M_trxbiaya', 'trx');
    $this->load->model('M_link_akun', 'linkakun');
    $this->load->model('M_jurnal','jurnal');
    
  }

  function index()
  {
    $data['Vb'] = $this->biaya->SelectAll()->result_array();
    $data['ResultVb'] = $this->trx->SelectAll()->result();

    $data['content'] = 'biaya/trx';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
    $now = new DateTime('Asia/Kuala_Lumpur');
    $tgl = $now->format('Y-m-d');
    $ket = $this->input->post('ket');
    $nom = str_replace(',', '',$this->input->post('biaya'));

    $this->form_validation->set_rules('ket','Keterangan','required');

    if ($this->form_validation->run() == FALSE)
    {
     $this->session->set_flashdata('error', 'Gagal.!');
     redirect(site_url('admin/trxbiaya'));
    }else{
     $data = array(
       'id_biaya' => $this->input->post('id'),
       'nominal' => $nom,
       'keterangan' => $ket,
       'tgl_transaksi' => $tgl,
     );
     $id_trx = $this->trx->insert($data);

     $kas = array(
       'jns_transaksi' => $id_trx,
       'status' => 'TRX-Biaya',
       'tgl_transaksi' => $tgl,
       'id_akun' => $this->input->post('id_akun'),
       'debet' => '0',
       'kredit' => $nom,
     );
     $result = $this->trx->insert_kas($kas);

      
      // tambah jurnal

      $idjurnal= $this->jurnal->getidmax() + 1;

      // gambar bukti
        $img = $_FILES['img']['name'];
        $config['upload_path']='./img/bukti';
        $config['allowed_types']='jpg|png|jpeg';
        $config['file_name'] = $idjurnal;
        $config['overwrite'] = TRUE;
        $config['file_ext_tolower'] = TRUE;
        $config['remove_space'] = TRUE;
        $this->load->library('upload',$config);
        $this->upload->do_upload('img');

        $images = $this->upload->data();

        $config['img_library'] = 'gd2';
        $config['source_image'] = './img/bukti'.$images['file_name'];
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
        // gambar bukti

      $keterangan = $ket;
      $id_jenis_transaksi = "7";
      $nominal = $nom;
      $bukti = $this->upload->data('file_name');
      
      include_once("tambah_jurnal.php");
      //tambah jurnal

     $this->session->set_flashdata('success', 'Berhasil.!');
     redirect(site_url('admin/trxbiaya'));
    }
  }

  public function edit()
  {
    $id = $this->input->post('id');
    $result = $this->trx->SelectById($id);
    echo json_encode($result);
  }

  public function update()
  {
    $now = new DateTime('Asia/Kuala_Lumpur');
    $tgl = $now->format('Y-m-d');

    $this->form_validation->set_rules('ket','Keterangan','required');

    if ($this->form_validation->run() == FALSE)
    {
     $this->session->set_flashdata('error', 'Gagal.!');
     redirect(site_url('admin/trxbiaya'));
    }else{
     $id = $this->input->post('id_trx');
     $data = array(
       'id_biaya' => $this->input->post('id_biaya'),
       'nominal' => str_replace(',', '',$this->input->post('biaya')),
       'keterangan' => $this->input->post('ket'),
       'tgl_transaksi' => $tgl,
     );
     $result = $this->trx->update($id, $data);

     $kas = array(
       'jns_transaksi' => $id,
       'tgl_transaksi' => $tgl,
       'kredit' => str_replace(',', '',$this->input->post('biaya')),
     );
     $result = $this->trx->update_kas($id, $kas);
     $this->session->set_flashdata('success', 'Berhasil.!');
     redirect(site_url('admin/trxbiaya'));
    }
  }

  public function hapus($id)
  {
    $this->trx->delete($id);
    redirect(site_url('admin/trxbiaya'));
  }
}
