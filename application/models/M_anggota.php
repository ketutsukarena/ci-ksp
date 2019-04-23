<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_anggota extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  function code_otomatis(){
    $this->db->select('(id_nasabah) as kode',false);
    $this->db->order_by('id_nasabah', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('tb_nasabah');
      if($query->num_rows()<>0){
        $data = $query->row();
        $kode = intval($data->kode)+1;
      }else{
        $kode = 1;
      }
    $set = str_pad($kode,11,"0",STR_PAD_LEFT);
    $code  = $set;
    return $code;
  }

  // function code_foto(){
  //   $this->db->select('(id_nasabah) as kode',false);
  //   $this->db->order_by('id_nasabah', 'desc');
  //   $this->db->limit(1);
  //   $query = $this->db->get('tb_nasabah');
  //     if($query->num_rows()<>0){
  //       $data = $query->row();
  //       $kode = intval($data->kode);
  //     }else{
  //       $kode = 1;
  //     }
  //   $set = str_pad($kode,11,"0",STR_PAD_LEFT);
  //   $code  = $set;
  //   return $code;
  // }

  public function SelectAll()
  {
    $this->db->select('*')
    ->from('tb_nasabah')
    ->where("(Status='Anggota' OR Status='Anggota & Nasabah')")
    ->order_by('id_nasabah', 'ASC');
    return $this->db->get();
  }

  public function cekktp($ktp)
  {
    $this->db->select('*')
    ->from('tb_nasabah')
    ->where('no_ktp', $ktp);
    return $this->db->get()->row_array();
  }

  public function insert($data)
  {
    $this->db->insert('tb_nasabah', $data);
    return $this->db->affected_rows();
  }

  public function SelectById($id)
  {
    $this->db->select('*')
    ->from('tb_nasabah')
    ->where('id_nasabah', $id);
    return $this->db->get();
  }

  public function update($id, $data)
  {
    $this->db->where('id_nasabah', $id)
    ->update('tb_nasabah', $data);
    return $this->db->affected_rows();
  }

  public function delete($where,$table)
  {
    $this->db->where($where);
    $row = $this->db->get($table)->row();
    unlink("./img/".$row->foto);
    $this->db->delete($table, $where);
  }

  public function SelectByStatus($id)
  {
    $this->db->select('*')
    ->from('tb_nasabah')
    ->where('id_nasabah', $id);
    return $this->db->get()->row_array();
  }

  public function upstatus($id, $data)
  {
    $this->db->where('id_nasabah', $id)
    ->update('tb_nasabah', $data);
    return $this->db->affected_rows();
  }

  public function delrek($id)
  {
    $this->db->where('id_nasabah', $id);
    $this->db->delete('tb_reknasabah');
  }
}
