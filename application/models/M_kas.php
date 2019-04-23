<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kas extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  function code_otomatis(){
    $this->db->select('Right(tb_kas.id_kas,3) as kode',false);
    $this->db->order_by('id_kas', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('tb_kas');
      if($query->num_rows()<>0){
        $data = $query->row();
        $kode = intval($data->kode)+1;
      }else{
        $kode = 1;
      }
    $set = str_pad($kode,7,"0",STR_PAD_LEFT);
    $code  = "KAS".$set;
    return $code;
  }
}
