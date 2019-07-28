<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Jurnal extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['login'])) {
        redirect(site_url('auth/error'));
        }if ($this->session->login['level']=="Admin") {
        redirect(site_url('admin/adashboard'));
        }if ($this->session->login['level']=="Bagian Tabungan") {
        redirect(site_url('ketua/ktdashboard'));
        }if ($this->session->login['level']=="Bagian Kredit") {
        redirect(site_url('bagkre/kdashboard'));
        }
        $this->load->model('M_jurnal', 'jurnal');
        $this->load->model('M_tutupbuku', 'tutupbuku');
        
    }
    

    public function index()
    {
        if ($this->input->post('idtutupbuku') == NULL){
            $where = array('id_tutup_buku' => '0' );    
        }else{
            $where = array('id_tutup_buku' => $this->input->post('idtutupbuku'));
        }
        print_r($this->input->post('idtutupbuku'));
        $data['jurnal'] = $this->jurnal->Selectwhere($where)->result();
        $data['totaldebet'] = $this->jurnal->totaldebetwhere($where);
        $data['totalkredit'] = $this->jurnal->totalkreditwhere($where);
        $data['tutupbuku'] = $this->tutupbuku->select()->result();
        $data['idtutupbuku'] = $this->input->post('idtutupbuku');
        $data['content'] = 'jurnal/view';
        $this->load->view('index',$data);
    }        
}
        
    /* End of file  bagtab/Jurnal.php */
        
                            