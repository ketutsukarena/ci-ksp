<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_trxsimpan_det extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function insert($data_detsimpanan)
  {
    $this->db->insert('tb_trx_simpanan_det', $data_detsimpanan);
    return $this->db->affected_rows();
  }

  public function SelectDet($id)
  {
    $this->db->select('trx.*, jns.*')
    ->from('tb_trx_simpanan as trx')
    ->join('tb_jns_simpanan as jns','trx.id_simpanan=jns.id_simpanan')
    ->where('trx.id_nasabah', $id)
    ->order_by('trx.id_simpanan','ASC');
    return $this->db->get();
  }

  public function SelectAng($id)
  {
    $this->db->select('trx.*, ang.*, SUM(trx.total) as tsim')
    ->from('tb_trx_simpanan as trx')
    ->join('tb_nasabah as ang','trx.id_nasabah=ang.id_nasabah')
    ->where('trx.id_nasabah', $id);
    return $this->db->get();
  }

  public function SelectByDet($id)
  {
    $this->db->select('trx.*, trx_det.*, jns.*')
    ->from('tb_trx_simpanan_det as trx_det')
    ->join('tb_trx_simpanan as trx', 'trx.id_trx=trx_det.id_trx')
    ->join('tb_jns_simpanan as jns', 'trx.id_simpanan=jns.id_simpanan')
    ->where('trx_det.id_trx', $id);
    return $this->db->get()->result_array();
  }

  public function Selectxx($id)
  {
    $this->db->select('trx.*, trx_det.*, jns.*')
    ->from('tb_trx_simpanan_det as trx_det')
    ->join('tb_trx_simpanan as trx', 'trx.id_trx=trx_det.id_trx')
    ->join('tb_jns_simpanan as jns', 'trx.id_simpanan=jns.id_simpanan')
    ->where('trx.id_nasabah', $id)
    ->order_by('trx_det.id_trx','ASC');
    return $this->db->get();
  }
}
