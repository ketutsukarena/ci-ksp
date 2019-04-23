<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function totalpinjaman()
  {
    $this->db->select('SUM(total) as t')
    ->from('tb_trx_simpanan');
    $hasil = $this->db->get()->row_array();
    $p = $hasil['t'];
    return $p;
  }

  public function total_pengurus()
  {
    $this->db->select('COUNT(id_user) as t')
    ->from('tb_user');
    $hasil = $this->db->get()->row_array();
    $p = $hasil['t'];
    return $p;
  }

  public function debet()
  {
    $this->db->select('SUM(debet) as d')
    ->from('tb_kas');
    $hasil = $this->db->get()->row_array();
    $kk = $hasil['d'];
    return $kk;
  }

  public function kredit()
  {
    $this->db->select('SUM(kredit) as k')
    ->from('tb_kas');
    $hasil = $this->db->get()->row_array();
    $pp = $hasil['k'];
    return $pp;
  }

  public function totalkas()
  {
    $this->db->select('SUM(debet - kredit) as t')
    ->from('tb_kas');
    $hasil = $this->db->get()->row_array();
    $pp = $hasil['t'];
    return $pp;
  }

  public function total_anggota()
  {
    $this->db->select('COUNT(id_nasabah) as t')
    ->from('tb_nasabah')->where("(Status='Anggota' OR Status='Anggota & Nasabah')");
    $hasil = $this->db->get()->row_array();
    $p = $hasil['t'];
    return $p;
  }

  public function total_simpanan()
  {
    $this->db->select('SUM(total) as t')
    ->from('tb_trx_simpanan');
    $hasil = $this->db->get()->row_array();
    $p = $hasil['t'];
    return $p;
  }

  public function total_biaya()
  {
    $this->db->select('SUM(nominal) as t')
    ->from('tb_trx_biaya');
    $hasil = $this->db->get()->row_array();
    $p = $hasil['t'];
    return $p;
  }

  public function total_pendapatan()
  {
    $this->db->select('SUM(nominal) as t')
    ->from('tb_trx_pendapatan');
    $hasil = $this->db->get()->row_array();
    $p = $hasil['t'];
    return $p;
  }

  public function total_nasabah()
  {
    $this->db->select('COUNT(id_nasabah) as t')
    ->from('tb_nasabah')->where("(Status='Nasabah' OR Status='Anggota & Nasabah')");
    $hasil = $this->db->get()->row_array();
    $p = $hasil['t'];
    return $p;
  }

  public function total_tabungan()
  {
    $this->db->select('SUM(saldo_akhir) as t')
    ->from('tb_reknasabah');
    $hasil = $this->db->get()->row_array();
    $p = $hasil['t'];
    return $p;
  }

  public function total_setoran()
  {
    $this->db->select('SUM(kredit) as t')
    ->from('tb_trx_tabungan');
    $hasil = $this->db->get()->row_array();
    $p = $hasil['t'];
    return $p;
  }

  public function total_penarikan()
  {
    $this->db->select('SUM(debet) as t')
    ->from('tb_trx_tabungan');
    $hasil = $this->db->get()->row_array();
    $p = $hasil['t'];
    return $p;
  }
}
