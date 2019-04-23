<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_biaya extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  function id_function(){
    $this->db->select('(id_biaya) as kode',false);
    $this->db->order_by('id_biaya', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('tb_biaya');
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
    $this->db->select('SUBSTRING(kode_biaya,2) as kode',false);
    $this->db->order_by('kode_biaya', 'desc');
    $query = $this->db->get('tb_biaya');
    if($query->num_rows()<>0){
         $data = $query->row();
         $kode = intval($data->kode)+1;
       }else{
         $kode = 1;
       }
     $code  = "B".$kode;
    return $code;
  }

  public function SelectAll()
  {
    $this->db->select('b.*, a.*')
    ->from('tb_biaya as b')
    ->join('tb_akun as a','b.id_akun=a.id_akun')
    ->order_by('id_biaya', 'ASC');
    return $this->db->get();
  }

  public function insert($data)
  {
    $this->db->insert('tb_biaya', $data);
    return $this->db->affected_rows();
  }

  public function SelectById($id)
  {
    $this->db->select('*')
    ->from('tb_biaya')
    ->where('id_biaya', $id);
    return $this->db->get()->row_array();
  }

  public function update($id, $data)
  {
    $this->db->where('id_biaya', $id)
    ->update('tb_biaya', $data);
    return $this->db->affected_rows();
  }

  public function delete($id)
  {
    $this->db->where('id_biaya', $id);
    $this->db->delete('tb_biaya');
  }
}
