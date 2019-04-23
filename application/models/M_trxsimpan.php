<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_trxsimpan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  // function code_otomatis(){
  //   $this->db->select('SUBSTRING(kode_transaksi,7) as kode',false);
  //   $this->db->order_by('kode_transaksi', 'desc');
  //   $query = $this->db->get('tb_trx_simpanan');
  //   if($query->num_rows()<>0){
  //        $data = $query->row();
  //        $kode = intval($data->kode)+1;
  //      }else{
  //        $kode = 1;
  //      }
  //    $code  = "TRX/S/".$kode;
  //   return $code;
  // }

  public function insert($data_simpanan)
  {
    $this->db->insert('tb_trx_simpanan', $data_simpanan);
    $id = $this->db->insert_id();
    return (isset($id)) ? $id : FALSE;
  }

  public function SelectAll()
  {
    $this->db->select('trx.*, ang.*, jns.*, SUM(trx.total) as tsim')
    ->from('tb_nasabah as ang')
    ->join('tb_trx_simpanan as trx', 'trx.id_nasabah=ang.id_nasabah')
    ->join('tb_jns_simpanan as jns', 'trx.id_simpanan=jns.id_simpanan')
    ->group_by('trx.id_nasabah');
    return $this->db->get();
  }

  public function update_anggota($id, $data_anggota)
  {
    $this->db->where('id_nasabah', $id)
    ->update('tb_nasabah', $data_anggota);
    return $this->db->affected_rows();
  }

  public function insert_kas($data_kas)
  {
    $this->db->insert('tb_kas', $data_kas);
    return $this->db->affected_rows();
  }

  public function reset_nasabah($id)
  {
    $this->db->select('id_nasabah')
    ->where('id_trx', $id);
    $query = $this->db->get('tb_trx_simpanan');
    $data = $query->row();
    $id_nasabah = $data->id_nasabah;
    return $id_nasabah;
  }

  public function reset_bulan($id)
  {
    $this->db->select('bulan as b')
    ->where('id_trx', $id)
    ->order_by('bulan', 'ASC');
    $query = $this->db->get('tb_trx_simpanan_det');
    $data = $query->row();
    $bln = $data->b;
    return $bln;
  }

  public function reset_tahun($id)
  {
    $this->db->select('tahun as t')
    ->where('id_trx', $id)
    ->order_by('tahun', 'ASC');
    $query = $this->db->get('tb_trx_simpanan_det');
    $data = $query->row();
    $thn = $data->t;
    return $thn;
  }

  public function updata_hasil($id, $data_hasil)
  {
    $this->db->where('id_nasabah', $id)
    ->update('tb_nasabah', $data_hasil);
    return $this->db->affected_rows();
  }

  public function delete($id)
  {
    $this->db->delete('tb_trx_simpanan', array('id_trx' => $id));
    $this->db->delete('tb_trx_simpanan_det', array('id_trx' => $id));
    $this->db->delete('tb_kas', array('jns_transaksi' => $id, 'status' => 'TRX-Simpanan'));
  }
}
