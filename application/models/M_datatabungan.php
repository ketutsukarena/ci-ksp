<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datatabungan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function SelectAll()
  {
    $this->db->select('t.*, r.*, n.*, CONCAT(r.id_reknasabah,'.',"/",'.',r.no_rek) AS reknasabah')
    ->from('tb_trx_tabungan as t')
    ->join('tb_reknasabah as r','t.id_reknasabah=r.id_reknasabah')
    ->join('tb_nasabah as n','r.id_nasabah=n.id_nasabah')
    ->where("(n.status='Nasabah' OR n.status='Anggota & Nasabah')")
    ->group_by('r.id_reknasabah');
    return $this->db->get();
  }

  public function SelectData($id_reknasabah)
  {
    $this->db->select('t.*, r.*, n.*, CONCAT(r.id_reknasabah,'.',"/",'.',r.no_rek) AS reknasabah')
    ->from('tb_trx_tabungan as t')
    ->join('tb_reknasabah as r','t.id_reknasabah=r.id_reknasabah')
    ->join('tb_nasabah as n','r.id_nasabah=n.id_nasabah')
    ->where("(n.status='Nasabah' OR n.status='Anggota & Nasabah')")
    ->where('r.id_reknasabah',$id_reknasabah);
    return $this->db->get();
  }

  public function SelectDetail($id_reknasabah)
  {
    $this->db->select('trx.*, us.*')
    ->from('tb_trx_tabungan as trx')
    ->join('tb_user as us','us.id_user=trx.id_user')
    ->where('trx.id_reknasabah',$id_reknasabah);
    return $this->db->get();
  }
}
