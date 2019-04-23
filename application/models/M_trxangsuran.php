<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_trxangsuran extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function insert($data)
  {
    $this->db->insert('tb_trx_angsuran', $data);
    $id = $this->db->insert_id();
    return (isset($id)) ? $id : FALSE;
  }

  public function insert_kas($data_kas)
  {
    $this->db->insert('tb_kas', $data_kas);
    return $this->db->affected_rows();
  }

  public function update_pjm($id, $data_pjm)
  {
    $this->db->where('id_trx', $id)
    ->update('tb_trx_pinjaman', $data_pjm);
    return $this->db->affected_rows();
  }

  public function SelectAll()
  {
    $this->db->select('*')
             ->from('tb_trx_angsuran as a')
             ->join('tb_trx_pinjaman as p','a.id_trx=p.id_trx')
             ->join('tb_kredit as k','p.id_kredit=k.id_kredit')
             ->join('tb_nasabah as n','k.id_nasabah=n.id_nasabah')
             ->group_by('n.id_nasabah');
   return $this->db->get();
  }

  public function SelectDetail($id_trx)
  {
    $this->db->select('*')
             ->from('tb_trx_angsuran')
             ->where('id_trx', $id_trx)
             ->order_by('bulan_ke', 'ASC');
   return $this->db->get();
  }

  public function SelectData($id_trx)
  {
    $this->db->select('pinjam.*,(pinjam.total_pinjaman - pinjam.total_pinjaman_bayar) as sisa_pinjam, tor.*, nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
             ->from('tb_trx_pinjaman as pinjam')
             ->join('tb_kredit as tor','pinjam.id_kredit=tor.id_kredit')
             ->join('tb_nasabah as nas','tor.id_nasabah=nas.id_nasabah')
             ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
             ->where('pinjam.id_trx',$id_trx)
             ->order_by('pinjam.id_kredit', 'ASC');
    return $this->db->get();
  }
}
