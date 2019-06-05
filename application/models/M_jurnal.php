<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
  class M_jurnal extends CI_Model {
      
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    
    public function Select()
    {
      $this->db->select('no, tgl_transaksi, nama_akun, debet, kredit');      
      $this->db->from('tb_jurnal'); 
      $this->db->join('tb_akun', 'tb_jurnal.id_akun = tb_akun.id_akun', 'left');
      $this->db->order_by('no', 'asc');
      return $this->db->get();
    }

    public function Insert($data)
    {
      $this->db->insert('tb_jurnal', $data);
    }

    public function getno()
    {
      $query = $this->db->query("SELECT MAX(no) AS nomor FROM tb_jurnal");
      return $query->row()->nomor;
    }

    public function totaldebet(){
      $this->db->select('SUM(debet) as t');
      $this->db->from('tb_jurnal');
      $hasil = $this->db->get()->row_array();
      $pp = $hasil['t'];
      return $pp;
    }
    
    public function totalkredit(){
      $this->db->select('SUM(kredit) as t');
      $this->db->from('tb_jurnal');
      $hasil = $this->db->get()->row_array();
      $pp = $hasil['t'];
      return $pp;
    }
  }

/* End of file M_jurnal.php */
    
                        