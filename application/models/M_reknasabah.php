<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_reknasabah extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function idrek(){
    $this->db->select('(id_reknasabah) as kode',false);
    $this->db->order_by('id_reknasabah', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('tb_reknasabah');
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

  public function SelectAll()
  {
    $this->db->select('n.*, rn.*, CONCAT(rn.id_reknasabah,'.',"/",'.',rn.no_rek) AS reknasabah')
    ->from('tb_nasabah as n')
    ->join('tb_reknasabah as rn','n.id_nasabah=rn.id_nasabah')
    ->where("(n.status='Nasabah' OR n.status='Anggota & Nasabah')")
    ->order_by('n.id_nasabah', 'ASC');
    return $this->db->get();
  }

  public function cekrek($id)
  {
    $this->db->select('*')
    ->from('tb_reknasabah')
    ->where('id_nasabah', $id);
    return $this->db->get();
  }
  public function insert($datarek)
  {
    $this->db->insert('tb_reknasabah', $datarek);
    return $this->db->affected_rows();
  }
}
