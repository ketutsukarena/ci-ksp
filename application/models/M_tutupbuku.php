<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_tutupbuku extends CI_Model {
                        

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function insert($data){
        $this->db->insert('tb_tutup_buku', $data);
    }

    public function updatejurnal($id_tutup_buku, $data){
        $this->db->where('id_tutup_buku', $id_tutup_buku);
        $this->db->update('tb_jurnal', $data);
    }

    public function getidmax()
    {
        // $this->db->select('MAX(id_tutup_buku) AS id');
        // $this->db->from('tb_tutup_buku');
        // $this->db->get()->row->id;
        
      $query = $this->db->query("SELECT MAX(id_tutup_buku) AS id FROM tb_tutup_buku");
      return $query->row()->id;
    }
    
    public function gettglawal($id_tutup_buku){
        $this->db->select('*');
        $this->db->from('tb_jurnal');
        $this->db->where('id_tutup_buku', $id_tutup_buku);
        $this->db->order_by('tgl_transaksi', 'asc');
        $this->db->limit(1);         
        return $this->db->get()->row()->tgl_transaksi;
        
        
        //     $query = $this->db->query("SELECT tgl_transaksi FROM tb_jurnal WHERE id_tutup_buku = ".$id_tutup_buku." ORDER BY ");
        //   return $query->row()->tglawal;
    }
    
    public function gettglakhir($id_tutup_buku){
        $this->db->select('*');
        $this->db->from('tb_jurnal');
        $this->db->where('id_tutup_buku', $id_tutup_buku);
        $this->db->order_by('tgl_transaksi', 'desc');
        $this->db->limit(1);
        return $this->db->get()->row()->tgl_transaksi;
    }
}
                        
/* End of file M_tutupbuku.php */
    
                        