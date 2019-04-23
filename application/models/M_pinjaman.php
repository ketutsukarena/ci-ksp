<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pinjaman extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function insert($data)
  {
    $this->db->insert('tb_trx_pinjaman', $data);
    $id = $this->db->insert_id();
    return (isset($id)) ? $id : FALSE;
  }

  public function insert_kas($data_kas)
  {
    $this->db->insert('tb_kas', $data_kas);
    return $this->db->affected_rows();
  }

  public function insert_kass($data_kass)
  {
    $this->db->insert('tb_kas', $data_kass);
    return $this->db->affected_rows();
  }

  public function SelectAll()
  {
    $this->db->select('pinjam.*,(pinjam.total_pinjaman - pinjam.total_pinjaman_bayar) as sisa_pinjam, tor.*, nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
             ->from('tb_trx_pinjaman as pinjam')
             ->join('tb_kredit as tor','pinjam.id_kredit=tor.id_kredit')
             ->join('tb_nasabah as nas','tor.id_nasabah=nas.id_nasabah')
             ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
             ->order_by('pinjam.id_kredit', 'ASC');
    return $this->db->get();
  }

  public function SelectAllp($id)
  {
    $this->db->select('pinjam.*,(pinjam.total_pinjaman - pinjam.total_pinjaman_bayar) as sisa_pinjam, tor.*, nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
             ->from('tb_trx_pinjaman as pinjam')
             ->join('tb_kredit as tor','pinjam.id_kredit=tor.id_kredit')
             ->join('tb_nasabah as nas','tor.id_nasabah=nas.id_nasabah')
             ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
             ->where_not_in('pinjam.id_trx',$id)
             ->order_by('pinjam.id_kredit', 'ASC');
    return $this->db->get();
  }

}
