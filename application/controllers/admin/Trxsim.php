<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trxsim extends CI_Controller{

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
    $this->load->model('M_trxsimpan', 'trx');
    $this->load->model('M_trxsimpan_det', 'trx_det');
    $this->load->model('M_anggota', 'anggota');
    $this->load->model('M_jnsimpan', 'simpan');
  }

  function index()
  {
    $data['vAng'] = $this->anggota->SelectAll()->result_array();
    $data['vJs'] = $this->simpan->SelectAll()->result_array();

    $data['content'] = 'trxsimpanan/input';
    $this->load->view('index',$data);
  }

  public function tambah()
  {
    $now = new DateTime('Asia/Kuala_Lumpur');
    $tgl = $now->format('Y-m-d');
    //$tgl = date("d-m-Y", strtotime($t));

    $bln =  $this->input->post('mulai_bln');
    if ($bln == "Januari") { $bln = "1";
    }elseif ($bln == "Februari") { $bln = "2";
    }elseif ($bln == "Maret") { $bln = "3";
    }elseif ($bln == "April") { $bln = "4";
    }elseif ($bln == "Mei") { $bln = "5";
    }elseif ($bln == "Juni") { $bln = "6";
    }elseif ($bln == "Juli") { $bln = "7";
    }elseif ($bln == "Agustus") { $bln = "8";
    }elseif ($bln == "September") { $bln = "9";
    }elseif ($bln == "Oktober") { $bln = "10";
    }elseif ($bln == "Nopember") { $bln = "11";
    }elseif ($bln == "Desember") { $bln = "12";}
    $data_simpanan = array(
      //'kode_transaksi' => $this->trx->code_otomatis(),
      'id_nasabah' => $this->input->post('id_nasabah'),
      'id_simpanan' => $this->input->post('id_simpanan'),
      'jumlah_bln' => $this->input->post('jml_bln'),
      'bln_mulai' => $bln,
      'total' => str_replace(',', '',$this->input->post('total')),
      'tgl_transaksi' => $tgl,
      );
    $id_trx = $this->trx->insert($data_simpanan);

    //insert data ke tb_trx_simpanan_detail
    $nom = str_replace(',', '',$this->input->post('nominal'));
    $jum_bln = $this->input->post('jml_bln');
    $thn = $this->input->post('thn');

    $i=0;
    $k=0;
    $t=$thn;
    while ($i < $jum_bln) {
      $k=$i+$bln;
      if ($k >= 13) {
          $k=$k-12;
          $t=$thn+1;
      }
      $data_detsimpanan = array(
        'id_trx' => $id_trx,
        'bulan' => $k,
        'nominal' =>$nom,
        'tahun' => $t,
      );
      $i++;
      $result = $this->trx_det->insert($data_detsimpanan);
    }

    //update bulan dan tahun di tb_nasabah
    $id_sim = $this->input->post('id_simpanan');
    $id = $this->input->post('id_nasabah');
    if ($id_sim==1) {
      $data_anggota = array(
        'bln_akhir' =>$bln,
        'thn_akhir' => $t,
      );
      $result = $this->trx->update_anggota($id, $data_anggota);
    }elseif ($id_sim==2) {
      $bln_a = $bln;
      $thn_a = $this->input->post('thn');
      $jum_bln = $this->input->post('jml_bln');
      $hh = $bln_a + $jum_bln;
      if ($hh >= 13) {
          $hh = $hh - 12;
          $thn_a = $thn_a + 1;
      }
      $data_anggota = array(
        'bln_akhir' =>$hh,
        'thn_akhir' => $thn_a,
      );
      $result = $this->trx->update_anggota($id, $data_anggota);
    }

    //insert kas
    $data_kas = array(
      'jns_transaksi' => $id_trx,
      'status' => 'TRX-Simpanan',
      'tgl_transaksi' => $tgl,
      'id_akun' => $this->input->post('id_akun'),
      'debet' => str_replace(',', '',$this->input->post('total')),
      'kredit' => '0',
    );
    $result = $this->trx->insert_kas($data_kas);
    redirect(site_url('admin/trxsim/view'));
  }

  //function hapus ke tb_trx_simpanan, tb_trx_simpanan_det, tb_kas
  public function hapus($id)
  {
    $id_nasabah = $this->trx->reset_nasabah($id);
    $bulan = $this->trx->reset_bulan($id);
    $tahun = $this->trx->reset_tahun($id);
    $data_hasil = array(
      'bln_akhir' => $bulan,
      'thn_akhir' => $tahun,
    );

    $result = $this->trx->updata_hasil($id_nasabah, $data_hasil);

    $this->trx->delete($id);
    redirect(site_url('admin/trxsim/view'));
  }
}

?>
