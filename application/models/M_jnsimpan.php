<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jnsimpan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function SelectAll()
  {
    $this->db->select('sim.*, akun.*')
    ->from('tb_jns_simpanan as sim')
    ->join('tb_akun as akun', 'akun.id_akun=sim.id_akun')
    ->order_by('id_simpanan', 'ASC');
    return $this->db->get();
  }

  public function cekakun($id_akun)
  {
    $this->db->select('id_akun')
    ->from('tb_jns_simpanan')
    ->where('id_akun', $id_akun);
    return $this->db->get()->row_array();
  }

  public function insert($data)
  {
    $this->db->insert('tb_jns_simpanan', $data);
    return $this->db->affected_rows();
  }

  public function SelectById($id)
  {
    $this->db->select('*')
    ->from('tb_jns_simpanan')
    ->where('id_simpanan', $id);
    return $this->db->get()->row_array();
  }

  public function update($id, $data)
  {
    $this->db->where('id_simpanan', $id)
    ->update('tb_jns_simpanan', $data);
    return $this->db->affected_rows();
  }

  public function delete($id_simpanan)
  {
    $this->db->where('id_simpanan', $id_simpanan);
    $this->db->delete('tb_jns_simpanan');
  }
}
