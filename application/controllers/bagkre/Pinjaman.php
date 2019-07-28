<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_kredit', 'kredit');
    $this->load->model('M_akun', 'akun');
    $this->load->model('M_pinjaman', 'pinjam');
    $this->load->model('M_link_akun', 'linkakun');
    $this->load->model('M_jurnal','jurnal');
  }

  function index()
  {
    $id_kredit = $this->db->select('id_kredit')->from('tb_trx_pinjaman')->get()->result_array();
    if (!empty($id_kredit)) {
      $id = array();
      foreach ($id_kredit as $a) {
        $id[] = $a['id_kredit'];
      }
      $data['vResult'] = $this->kredit->SelectKreditorp($id)->result_array();
    }else {
      $data['vResult'] = $this->kredit->SelectKreditor()->result_array();
    }

    $data['vAkun'] = $this->akun->SelectAll()->result_array();
    $data['content'] = 'trxkredit/input';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('id_kredit', 'Pilih Kreditor', 'required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('error', 'Gagal.!');
      redirect(site_url('bagkre/pinjaman'));
    }else{
      $now = new DateTime('Asia/Kuala_Lumpur');
      $tgl = $now->format('Y-m-d');
      $admin = str_replace(',', '',$this->input->post('biaya_admin'));
      $materai = str_replace(',', '',$this->input->post('biaya_materai'));
      $biaya_pinjaman = $admin + $materai;
      $nom =  str_replace(',', '',$this->input->post('pokok_pinjam'));
      $idkredit = $this->input->post('id_kredit');

      $data = array(
        'id_kredit' => $idkredit,
        'id_akun' => $this->input->post('akun'),
        'tgl_realisasi' => $tgl,
        'nominal_pinjaman' => $nom,
        'persenbunga' => $this->input->post('bungapersen'),
        'angsuranpokok' => str_replace(',', '',$this->input->post('angsur_pokok')),
        'angsuranbunga' => str_replace(',', '',$this->input->post('angsur_bunga')),
        'angsurantotal' => str_replace(',', '',$this->input->post('angsur_total')),
        'biaya_admin' => $admin,
        'biaya_materai' => $materai,
        'jangka_waktu' => $this->input->post('jangka'),
        'total_pinjaman' => str_replace(',', '',$this->input->post('angsur_total')) * $this->input->post('jangka'),
        'total_pinjaman_bayar' => '0',
        'total_bulan' => '0',
        'status_pinjaman' => 'Belum Lunas',
      );
      $id_trx = $this->pinjam->insert($data);

      $data_kas = array(
        'jns_transaksi' => $id_trx,
        'status' => 'TRX-Pinjaman',
        'tgl_transaksi' => $tgl,
        'id_akun' => $this->input->post('akun'),
        'debet' => '0',
        'kredit' => $nom,
      );
      $this->pinjam->insert_kas($data_kas);

      $data_kass = array(
        'jns_transaksi' => $id_trx,
        'status' => 'TRX-Pinjaman',
        'tgl_transaksi' => $tgl,
        'id_akun' => '401',
        'debet' => $biaya_pinjaman,
        'kredit' => '0',
      );
      $this->pinjam->insert_kass($data_kass);

      
     // tambah jurnal pinjaman

      $idjurnal= $this->jurnal->getidmax() + 1;
      $debitur = $this->kredit->SelectKreditorp($idkredit)->row();
      $keterangan = "Kredit";
      $id_jenis_transaksi = "1";
      $nominal = $nom;
      include("tambah_jurnal.php");

      //tambah jurnal pendapatan biaya admin dan materai
      $idjurnal= $this->jurnal->getidmax() + 1;
      $keterangan = "Biaya admin dan materai kredit";
      $id_jenis_transaksi = "8";
      $nominal = $biaya_pinjaman;
      include("tambah_jurnal.php");
      // end jurnal


      $this->session->set_flashdata('success', 'Berhasil.!');
      redirect(site_url('bagkre/pinjaman/view'));
    }
  }
}
