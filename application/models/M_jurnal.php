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
      $this->db->select('*');      
      $this->db->from('tb_jurnal');      
      $this->db->order_by('no', 'desc');
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
  }

/* End of file M_jurnal.php */
    
                        