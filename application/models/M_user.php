<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function verify($user, $pass)
  {
    $this->db->select('user.*, det.*')
    ->from('tb_user as user')
    ->join('tb_nasabah as det','user.id_nasabah=det.id_nasabah')
    ->where('username', $user)
    ->where('password', $pass)
    ->where('user.st','Aktif');
    return $this->db->get()->row_array();
  }

  // public function verify($user, $pass)
  // {
  //   $this->db->select('*')
  //   ->from('tb_user as user')
  //   ->where('username', $user)
  //   ->where('password', $pass);
  //   return $this->db->get()->row_array();
  // }

  public function cekuser($id)
  {
    $this->db->select('id_nasabah')
    ->from('tb_user')
    ->where('id_nasabah', $id);
    return $this->db->get()->row_array();
  }

  // public function ceklevel($lvl)
  // {
  //   $this->db->select('level')
  //   ->from('tb_user')
  //   ->where('level', $lvl);
  //   return $this->db->get()->row_array();
  // }

  public function insert($data)
  {
    $this->db->insert('tb_user', $data);
    return $this->db->affected_rows();
  }

  public function insert_nasabah($datauser)
  {
    $this->db->insert('tb_user', $datauser);
    return $this->db->affected_rows();
  }

  public function SelectAll()
  {
    $this->db->select('user.*, anggota.*')
    ->from('tb_user as user')
    ->join('tb_nasabah as anggota', 'user.id_nasabah=anggota.id_nasabah')
    ->group_by('user.id_user', 'ASC');
    return $this->db->get();
  }

  public function SelectById($id)
  {
    $this->db->select('user.*, anggota.*')
    ->from('tb_user as user')
    ->join('tb_nasabah as anggota', 'user.id_nasabah=anggota.id_nasabah')
    ->where('user.id_user', $id);
    return $this->db->get()->row_array();
  }

  public function update($id, $data)
  {
    $this->db->where('id_user', $id)
    ->update('tb_user', $data);
    return $this->db->affected_rows();
  }

  public function SelectKolektor()
  {
    $this->db->select('user.*, anggota.*')
    ->from('tb_user as user')
    ->join('tb_nasabah as anggota', 'user.id_nasabah=anggota.id_nasabah')
    ->where("(user.level='Kolektor' OR user.level='Bagian Tabungan')")
    ->group_by('user.id_user', 'ASC');
    return $this->db->get();
  }

  public function delete($id)
  {
    $this->db->where('id_user', $id);
    $this->db->delete('tb_user');
  }

    public function verifikasi($id)
  {
    $this->db->select('*')
    ->from('tb_user as user')
    ->where('kd_reset', $id);
    return $this->db->get()->row_array();
  }

  public function uppass($id, $data)
  {
    $this->db->where('id_user', $id)
    ->update('tb_user', $data);
    return $this->db->affected_rows();
  }

}
