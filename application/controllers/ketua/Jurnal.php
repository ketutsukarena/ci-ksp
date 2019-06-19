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
        
    }
    

    public function index()
    {
        $data['jurnal'] = $this->jurnal->Select()->result();
        $data['totaldebet'] = $this->jurnal->totaldebet();
        $data['totalkredit'] = $this->jurnal->totalkredit();
        $data['content'] = 'jurnal/view';
        $this->load->view('index',$data);
    }        
}
        
    /* End of file  bagtab/Jurnal.php */
        
                            