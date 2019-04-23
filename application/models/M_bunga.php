<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bunga extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function SelectAll()
  {
    $this->db->select('*')
             ->from('tb_bungatabungan as b')
             ->join('tb_akun as a','b.id_akun=a.id_akun');
    return $this->db->get();
  }

  public function cekakun($id)
  {
    $this->db->select('id_akun')
    ->from('tb_bungatabungan')
    ->where('id_akun', $id);
    return $this->db->get()->row_array();
  }

  public function insert($data)
  {
    $this->db->insert('tb_bungatabungan', $data);
    return $this->db->affected_rows();
  }

  public function SelectById($id)
  {
    $this->db->select('*')
    ->from('tb_bungatabungan as b')
    ->join('tb_akun as a','b.id_akun=a.id_akun')
    ->where('b.id_bunga', $id);
    return $this->db->get()->row_array();
  }

  public function update($id, $data)
  {
    $this->db->where('id_bunga', $id)
    ->update('tb_bungatabungan', $data);
    return $this->db->affected_rows();
  }

  public function delete($id)
  {
    $this->db->where('id_bunga', $id);
    $this->db->delete('tb_bungatabungan');
  }
}
