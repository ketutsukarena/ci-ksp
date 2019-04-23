<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pendapatan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  function id_function(){
    $this->db->select('(id_pendapatan) as kode',false);
    $this->db->order_by('id_pendapatan', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('tb_pendapatan');
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

  function code_otomatis(){
    $this->db->select('SUBSTRING(kode_pendapatan,2) as kode',false);
    $this->db->order_by('kode_pendapatan', 'desc');
    $query = $this->db->get('tb_pendapatan');
    if($query->num_rows()<>0){
         $data = $query->row();
         $kode = intval($data->kode)+1;
       }else{
         $kode = 1;
       }
     $code  = "P".$kode;
    return $code;
  }

  public function SelectAll()
  {
    $this->db->select('b.*, a.*')
    ->from('tb_pendapatan as b')
    ->join('tb_akun as a','b.id_akun=a.id_akun')
    ->order_by('id_pendapatan', 'ASC');
    return $this->db->get();
  }

  public function insert($data)
  {
    $this->db->insert('tb_pendapatan', $data);
    return $this->db->affected_rows();
  }

  public function SelectById($id)
  {
    $this->db->select('*')
    ->from('tb_pendapatan')
    ->where('id_pendapatan', $id);
    return $this->db->get()->row_array();
  }

  public function update($id, $data)
  {
    $this->db->where('id_pendapatan', $id)
    ->update('tb_pendapatan', $data);
    return $this->db->affected_rows();
  }

  public function delete($id)
  {
    $this->db->where('id_pendapatan', $id);
    $this->db->delete('tb_pendapatan');
  }
}
