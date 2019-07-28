<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angsuran extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_pinjaman', 'pinjam');
    $this->load->model('M_akun', 'akun');
    $this->load->model('M_trxangsuran', 'angsuran');
    $this->load->model('M_link_akun', 'linkakun');
    $this->load->model('M_jurnal','jurnal');
  }

  function index()
  {
    $cek_status = $this->db->select('id_trx')->from('tb_trx_pinjaman')->where('status_pinjaman','Lunas')->get()->result_array();
    if (!empty($cek_status)) {
      $id = array();
      foreach ($cek_status as $a) {
        $id[] = $a['id_trx'];
      }
      $data['vResult'] = $this->pinjam->SelectAllp($id)->result_array();
    }else {
      $data['vResult'] = $this->pinjam->SelectAll()->result_array();
    }

    $data['vAkun'] = $this->akun->SelectAll()->result_array();
    $data['content'] = 'trxangsuran/input';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('id_pinjaman', 'Pilih Kreditor', 'required');
    if ($this->form_validation->run() == FALSE)
    {
      echo "Data Salah";
      // $this->session->set_flashdata('error', 'Gagal.!');
      // redirect(site_url('bagtab/nasabah'));
    }else{
      $now = new DateTime('Asia/Kuala_Lumpur');
      $tgl = $now->format('Y-m-d');

      $id = $this->input->post('id_pinjaman');
      $jangka = $this->input->post('jangka');
      $bln = $this->input->post('bln');

      $sisa_angsuran = str_replace(',', '',$this->input->post('sisa'));
      $total_angsuran = str_replace(',', '',$this->input->post('angsur_total'));

      $hasil = $sisa_angsuran + $total_angsuran;
      $data = array(
        'id_trx' => $id,
        'tgl_transaksi' => $tgl,
        'id_akun' => $this->input->post('akun'),
        'bulan_ke' => $this->input->post('bln'),
        'nominal_angsuran' => $total_angsuran,
      );
      $id_trx = $this->angsuran->insert($data);

      if ($jangka==$bln) {
        $data_pjm = array(
          'total_bulan' => $this->input->post('bln'),
          'total_pinjaman_bayar' => $hasil,
          'status_pinjaman' => 'Lunas',
        );
        $this->angsuran->update_pjm($id, $data_pjm);
      }else {
        $data_pjm = array(
          'total_bulan' => $this->input->post('bln'),
          'total_pinjaman_bayar' => $hasil,
          'status_pinjaman' => 'Belum Lunas',
        );
        $this->angsuran->update_pjm($id, $data_pjm);
      }

      $data_kas = array(
        'jns_transaksi' => $id_trx,
        'status' => 'TRX-Angsuran',
        'tgl_transaksi' => $tgl,
        'id_akun' => $this->input->post('akun'),
        'debet' => $total_angsuran,
        'kredit' => '0',
      );
      $id_trx = $this->angsuran->insert_kas($data_kas);

      // tambah jurnal
      $idjurnal= $this->jurnal->getidmax() + 1;
      $keterangan = "Angsuran";
      $id_jenis_transaksi = "2";
      $nominal = $total_angsuran;
      include("tambah_jurnal.php");
      //tambah jurnal

      $this->session->set_flashdata('success', 'Berhasil.!');
      redirect(site_url().'bagkre/v_angsuran/detail/'.$id);
    }
  }
}
