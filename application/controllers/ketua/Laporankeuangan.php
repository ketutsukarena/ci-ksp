<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Laporankeuangan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['login'])) {
        redirect(site_url('auth/error'));
        }if ($this->session->login['level']=="Admin") {
        redirect(site_url('admin/adashboard'));
        }if ($this->session->login['level']=="Bagian Tabungan") {
        redirect(site_url('bagtab/tdashboard'));
        }if ($this->session->login['level']=="Bagian Kredit") {
        redirect(site_url('bagkre/kdashboard'));
        }
        $this->load->model('M_Akun', 'akun');
        $this->load->model('M_jurnal', 'jurnal');
        $this->load->model('M_tutupbuku', 'tutupbuku');
    }

    function index()
    {
        if ($this->input->post('idtutupbuku') == NULL){
            $idtb = $this->tutupbuku->getidmax();
        }else{
            $idtb = $this->input->post('idtutupbuku');
        }
        $where = array('id_tutup_buku' => $idtb);

        $data['akun'] = $this->akun->SelectAll()->result();
        $data['jurnal'] = $this->jurnal->selectwhere($where)->result();
        $data['tutupbuku'] = $this->tutupbuku->select()->result();
        $data['idtutupbuku'] = $idtb;
        $data['content'] = 'laporankeuangan/sementara';
		$this->load->view('index',$data);
     }
        
}
        
    /* End of file  ketua/Laporankeuangan.php */
        
                            