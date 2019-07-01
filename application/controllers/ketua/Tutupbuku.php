<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Tutupbuku extends CI_Controller {

  public function __construct()
  {
    //tes perubahan
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
    $this->load->model('M_tutupbuku', 'tutupbuku');
  }


  public function index(){
    $data['content'] = 'tutupbuku/view';
    $this->load->view('index',$data);
  }

  public function tutupbuku(){
    $id_tutup_buku = $this->tutupbuku->getidmax() + 1;
    $tglawal = $this->tutupbuku->gettglawal(0);
    $tglakhir = $this->tutupbuku->gettglakhir(0);

    // print_r($tglawal);
    
    $data_tutup = array(  'id_tutup_buku' => $id_tutup_buku, 
                          'tgl_awal'      => $tglawal,
                          'tgl_akhir'     => $tglakhir
    );
    $this->tutupbuku->insert($data_tutup);

    $data = array('id_tutup_buku' => $id_tutup_buku);
    $this->tutupbuku->updatejurnal('NULL',$data);
    redirect(site_url('ketua/tutupbuku'));
    

  }
        
}
        
    /* End of file  ketua/Tutupbuku.php */
        