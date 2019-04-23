<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_trxbiaya extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  // function code_otomatis(){
  //   $this->db->select('SUBSTRING(no_rek,2) as kode',true);
  //   $this->db->order_by('no_rek', 'desc');
  //   $query = $this->db->get('tb_reknasabah');
  //   if($query->num_rows()<>0){
  //        $data = $query->row();
  //        $kode = intval($data->kode)+1;
  //      }else{
  //        $kode = 1;
  //      }
  //    $code  = $kode;
  //   return $code;
  // }

  public function SelectAll()
  {
    $this->db->select('trx.*, b.*, a.*')
    ->from('tb_trx_biaya as trx')
    ->join('tb_biaya as b','trx.id_biaya=b.id_biaya')
    ->join('tb_akun as a','b.id_akun=a.id_akun');
    return $this->db->get();
  }

  public function insert($data)
  {
    $this->db->insert('tb_trx_biaya', $data);
    $id = $this->db->insert_id();
    return (isset($id)) ? $id : FALSE;
  }

  public function insert_kas($kas)
  {
    $this->db->insert('tb_kas', $kas);
    return $this->db->affected_rows();
  }

  public function SelectById($id)
  {
    $this->db->select('*')
    ->from('tb_trx_biaya')
    ->where('id_trx', $id);
    return $this->db->get()->row_array();
  }

  public function update($id, $data)
  {
    $this->db->where('id_trx', $id)
    ->update('tb_trx_biaya', $data);
    return $this->db->affected_rows();
  }

  public function update_kas($id, $data)
  {
    $this->db->where('jns_transaksi', $id)
    ->where('status', "TRX-Biaya")
    ->update('tb_kas', $data);
    return $this->db->affected_rows();
  }

  public function delete($id)
  {
    $this->db->delete('tb_trx_biaya', array('id_trx' => $id));
    $this->db->delete('tb_kas', array('jns_transaksi' => $id, 'status' => 'TRX-Biaya'));
  }
}
