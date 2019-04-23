<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_trxpendapatan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function insert($data)
  {
    $this->db->insert('tb_trx_pendapatan', $data);
    $id = $this->db->insert_id();
    return (isset($id)) ? $id : FALSE;
  }

  public function insert_kas($kas)
  {
    $this->db->insert('tb_kas', $kas);
    return $this->db->affected_rows();
  }

  public function SelectAll()
  {
    $this->db->select('trx.*, b.*, a.*')
    ->from('tb_trx_pendapatan as trx')
    ->join('tb_pendapatan as b','trx.id_pendapatan=b.id_pendapatan')
    ->join('tb_akun as a','b.id_akun=a.id_akun');
    return $this->db->get();
  }

  public function SelectById($id)
  {
    $this->db->select('*')
    ->from('tb_trx_pendapatan')
    ->where('id_trx', $id);
    return $this->db->get()->row_array();
  }

  public function update($id, $data)
  {
    $this->db->where('id_trx', $id)
    ->update('tb_trx_pendapatan', $data);
    return $this->db->affected_rows();
  }

  public function update_kas($id, $data)
  {
    $this->db->where('jns_transaksi', $id)
    ->where('status', "TRX-Pendapatan")
    ->update('tb_kas', $data);
    return $this->db->affected_rows();
  }

  public function delete($id)
  {
    $this->db->delete('tb_trx_pendapatan', array('id_trx' => $id));
    $this->db->delete('tb_kas', array('jns_transaksi' => $id, 'status' => 'TRX-Pendapatan'));
  }
}
