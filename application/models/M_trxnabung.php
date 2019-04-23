<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_trxnabung extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function insert($data)
  {
    $this->db->insert('tb_trx_tabungan', $data);
    $id = $this->db->insert_id();
    return (isset($id)) ? $id : FALSE;
  }

  public function updatesaldo($id, $data_rek)
  {
    $this->db->where('id_reknasabah', $id)
    ->update('tb_reknasabah', $data_rek);
    return $this->db->affected_rows();
  }

  public function insert_kas($data_kas)
  {
    $this->db->insert('tb_kas', $data_kas);
    return $this->db->affected_rows();
  }

  public function SelectAllTabungan()
  {
    $this->db->select('t.*, r.*, n.*, CONCAT(r.id_reknasabah,'.',"/",'.',r.no_rek) AS reknasabah')
    ->from('tb_trx_tabungan as t')
    ->join('tb_reknasabah as r','t.id_reknasabah=r.id_reknasabah')
    ->join('tb_nasabah as n','r.id_nasabah=n.id_nasabah')
    ->where("(n.status='Nasabah' OR n.status='Anggota & Nasabah')")
    ->where('t.id_akun','201')
    ->order_by('t.id_trx', 'DESC');
    return $this->db->get();
  }

  public function SelectAllPenarikan()
  {
    $this->db->select('t.*, r.*, n.*, CONCAT(r.id_reknasabah,'.',"/",'.',r.no_rek) AS reknasabah')
    ->from('tb_trx_tabungan as t')
    ->join('tb_reknasabah as r','t.id_reknasabah=r.id_reknasabah')
    ->join('tb_nasabah as n','r.id_nasabah=n.id_nasabah')
    ->where("(n.status='Nasabah' OR n.status='Anggota & Nasabah')")
    ->where('t.id_akun','202')
    ->order_by('t.id_trx', 'DESC');
    return $this->db->get();
  }
}
