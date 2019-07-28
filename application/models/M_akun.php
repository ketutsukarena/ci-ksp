<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akun extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function SelectAll()
  {
    $this->db->select('*')
    ->from('tb_akun')
    ->order_by('id_akun', 'ASC');
    return $this->db->get();
  }

  public function Selectwhere($where)
  {
    $this->db->select('*')
    ->from('tb_akun')
    ->where($where)
    ->order_by('id_akun', 'ASC');
    return $this->db->get();
  }

  public function cekakun($id)
  {
    $this->db->select('id_akun')
    ->from('tb_akun')
    ->where('id_akun', $id);
    return $this->db->get()->row_array();
  }

  public function insert($data)
  {
    $this->db->insert('tb_akun', $data);
    return $this->db->affected_rows();
  }

  public function SelectById($id)
  {
    $this->db->select('*')
    ->from('tb_akun')
    ->where('id_akun', $id);
    return $this->db->get()->row_array();
  }

  public function update($id, $data)
  {
    $this->db->where('id_akun', $id)
    ->update('tb_akun', $data);
    return $this->db->affected_rows();
  }

  public function delete($id)
  {
    $this->db->where('id_akun', $id);
    $this->db->delete('tb_akun');
  }
}
