<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nasabah extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
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

  public function SelectAll()
  {
    $this->db->select('nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
    ->from('tb_nasabah as nas')
    ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
    ->where("(nas.status='Nasabah' OR nas.status='Anggota & Nasabah')")
    ->order_by('nas.id_nasabah', 'ASC');
    return $this->db->get();
  }

  public function SelectAllp($id)
  {
    $this->db->select('nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
    ->from('tb_nasabah as nas')
    ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
    ->where("(nas.status='Nasabah' OR nas.status='Anggota & Nasabah')")
    ->where_not_in('nas.id_nasabah',$id)
    ->order_by('nas.id_nasabah', 'ASC');
    return $this->db->get();
  }

  public function cekktp($ktp)
  {
    $this->db->select('*')
    ->from('tb_nasabah')
    ->where('no_ktp', $ktp)
    ->where('status', 'Nasabah');
    return $this->db->get()->row_array();
  }

  public function insert($data)
  {
    $this->db->insert('tb_nasabah', $data);
    return $this->db->affected_rows();
  }
  public function SelectById($id)
  {
    $this->db->select('n.*, rn.*, CONCAT(rn.id_reknasabah,'.',"/",'.',rn.no_rek) AS reknasabah')
    ->from('tb_nasabah as n')
    ->join('tb_reknasabah as rn','n.id_nasabah=rn.id_nasabah')
    ->where('rn.id_nasabah', $id);
    return $this->db->get();
  }

  public function SelectByIdRek($id)
  {
    $this->db->select('n.*, rn.*, CONCAT(rn.id_reknasabah,'.',"/",'.',rn.no_rek) AS reknasabah')
    ->from('tb_nasabah as n')
    ->join('tb_reknasabah as rn','n.id_nasabah=rn.id_nasabah')
    ->where('rn.id_reknasabah', $id);
    return $this->db->get();
  }

  public function update($id, $data)
  {
    $this->db->where('id_nasabah', $id)
    ->update('tb_nasabah', $data);
    return $this->db->affected_rows();
  }

  public function delete($where,$id,$table)
  {
    $this->db->where($where);
    $row = $this->db->get($table)->row();
    unlink("./img/".$row->foto);
    $this->db->delete($table, $where);

    $this->db->delete('tb_reknasabah', array('id_nasabah' => $id));
    $this->db->delete('tb_user', array('id_nasabah' => $id));
  }
}
