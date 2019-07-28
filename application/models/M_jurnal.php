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
      $this->db->select('tb_jurnal_detail.*,tb_jurnal.*,tb_akun.*,tb_user.*');
      $this->db->from('tb_jurnal_detail');
      $this->db->join('tb_jurnal', 'tb_jurnal_detail.id_jurnal = tb_jurnal.id_jurnal', 'left');
      $this->db->join('tb_akun', 'tb_jurnal_detail.id_akun = tb_akun.id_akun', 'left');
      $this->db->join('tb_user', 'tb_jurnal.id_user = tb_user.id_user', 'left');      
      $this->db->order_by('id_jurnal_detail', 'asc');
      return $this->db->get();
    }
    public function Selectwhere($where)
    {
      $this->db->select('tb_jurnal_detail.*,tb_jurnal.*,tb_akun.*,tb_user.*');
      $this->db->from('tb_jurnal_detail');
      $this->db->join('tb_jurnal', 'tb_jurnal_detail.id_jurnal = tb_jurnal.id_jurnal', 'left');
      $this->db->join('tb_akun', 'tb_jurnal_detail.id_akun = tb_akun.id_akun', 'left');
      $this->db->join('tb_user', 'tb_jurnal.id_user = tb_user.id_user', 'left');      
      $this->db->order_by('id_jurnal_detail', 'asc');
      $this->db->where($where);
      return $this->db->get();
    }

    public function selectbyakun($id_akun){
      $this->db->select('tb_jurnal_detail.*,tb_jurnal.*,tb_akun.*');
      $this->db->from('tb_jurnal_detail');
      $this->db->join('tb_jurnal', 'tb_jurnal_detail.id_jurnal = tb_jurnal.id_jurnal', 'left');
      $this->db->join('tb_akun', 'tb_jurnal_detail.id_akun = tb_akun.id_akun', 'left');
      $this->db->where('tb_jurnal_detail.id_akun', $id_akun);   
      $this->db->order_by('id_jurnal_detail', 'asc');
      return $this->db->get();

    }


    public function Insert($data)
    {
      $this->db->insert('tb_jurnal', $data);
    }

    public function getidmax()
    {
      $query = $this->db->query("SELECT MAX(id_jurnal) AS id FROM tb_jurnal");
      return $query->row()->id;
    }

    public function totaldebetwhere($where){
      $this->db->select('SUM(debet) as t');
      $this->db->from('tb_jurnal_detail');
      $this->db->join('tb_jurnal', 'tb_jurnal_detail.id_jurnal = tb_jurnal.id_jurnal', 'left');
      $this->db->where($where);      
      $hasil = $this->db->get()->row_array();
      return $hasil['t'];
    }
    
    public function totalkreditwhere($where){
      $this->db->select('SUM(kredit) as t');
      $this->db->from('tb_jurnal_detail');
      $this->db->join('tb_jurnal', 'tb_jurnal_detail.id_jurnal = tb_jurnal.id_jurnal', 'left');
      $this->db->where($where);      
      $hasil = $this->db->get()->row_array();
      return $hasil['t'];
    }

    Public function InsertJurnalDetail($data){
      
      $this->db->insert('tb_jurnal_detail', $data);
      
    }
  }

/* End of file M_jurnal.php */
    
                        