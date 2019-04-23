<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kredit extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function insert($data)
  {
    $this->db->insert('tb_kredit', $data);
    return $this->db->affected_rows();
  }


  public function SelectTunda()
  {
    $this->db->select('tor.*, nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
             ->from('tb_kredit as tor')
             ->join('tb_nasabah as nas','nas.id_nasabah=tor.id_nasabah')
             ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
             ->where('tor.status_permohonan','tunda')
             ->order_by('tor.id_kredit', 'ASC');
    return $this->db->get();
  }

  public function SelectTerima()
  {
    $this->db->select('tor.*, nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
             ->from('tb_kredit as tor')
             ->join('tb_nasabah as nas','nas.id_nasabah=tor.id_nasabah')
             ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
             ->where('tor.status_permohonan','terima')
             ->order_by('tor.id_kredit', 'ASC');
    return $this->db->get();
  }

  public function SelectTolak()
  {
    $this->db->select('tor.*, nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
             ->from('tb_kredit as tor')
             ->join('tb_nasabah as nas','nas.id_nasabah=tor.id_nasabah')
             ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
             ->where('tor.status_permohonan','tolak')
             ->order_by('tor.id_kredit', 'ASC');
    return $this->db->get();
  }

  public function SelectAll()
  {
    $this->db->select('t.id_nasabah')
             ->from('tb_kredit as t')
             ->join('tb_trx_pinjaman as p','t.id_kredit=p.id_kredit')
             ->where('p.status_pinjaman','Belum Lunas');
    return $this->db->get();
  }

  public function SelectKreditorp($id)
  {
    $this->db->select('tor.*, nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
             ->from('tb_kredit as tor')
             ->join('tb_nasabah as nas','nas.id_nasabah=tor.id_nasabah')
             ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
             ->where_not_in('tor.id_kredit',$id)
             ->where('tor.status_permohonan','Terima')
             ->order_by('tor.id_kredit', 'ASC');
    return $this->db->get();
  }

  public function SelectKreditor()
  {
    $this->db->select('tor.*, nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
             ->from('tb_kredit as tor')
             ->join('tb_nasabah as nas','nas.id_nasabah=tor.id_nasabah')
             ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
             ->where('tor.status_permohonan','Terima')
             ->order_by('tor.id_kredit', 'ASC');
    return $this->db->get();
  }

  public function SelectById($id)
  {
    $this->db->select('tor.*, nas.*, reknas.*, CONCAT(reknas.id_reknasabah,'.',"/",'.',reknas.no_rek) AS reknasabah')
             ->from('tb_kredit as tor')
             ->join('tb_nasabah as nas','nas.id_nasabah=tor.id_nasabah')
             ->join('tb_reknasabah as reknas','nas.id_nasabah=reknas.id_nasabah')
             ->where('tor.id_kredit',$id);
    return $this->db->get();
  }

  public function st_permohonan($id, $data)
  {
    $this->db->where('id_kredit', $id)
    ->update('tb_kredit', $data);
    return $this->db->affected_rows();
  }

  public function update($id, $data)
  {
    $this->db->where('id_kredit', $id)
    ->update('tb_kredit', $data);
    return $this->db->affected_rows();
  }
}
