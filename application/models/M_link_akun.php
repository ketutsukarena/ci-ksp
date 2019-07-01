<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_link_akun extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    public function selectbyid($id_jenis_transaksi){
        $this->db->select('*');
        $this->db->from('tb_link_akun');
        $this->db->where('id_jenis_transaksi', $id_jenis_transaksi);
        return $this->db->get();
        
        
        
        
        
    }
    
    
}
                        
/* End of file M_link_akun.php */
    
                        