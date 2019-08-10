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
        $this->load->model('M_akun','akun');
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
    public function tambahtmp(){
        if (empty($this->input->post('akun'))){
            $data['content'] = 'jurnal/input';
            $data['akun'] = $this->akun->SelectAll()->result();
            $data['tmpjurnal'] = $this->jurnal->selecttmpjurnal()->result();
            $this->load->view('index', $data);        
        }else{
            if ($this->input->post('dk')=='debet') {
                $debet = $this->input->post('nominal');
                $kredit = 0;
            }elseif($this->input->post('dk')=='kredit') {
                $kredit = $this->input->post('nominal');
                $debet = 0;
            }else{
                $this->session->set_flashdata('gagal', 'Debet/Kredit harus diisi!!!');
                redirect(base_url('ketua/jurnal/tambahtmp/'),'refresh');

            }
            $data = array('id_akun' => $this->input->post('akun'),
                            'debet' => $debet,
                            'kredit' => $kredit);
            $this->jurnal->inserttmpjurnal($data);
            redirect(base_url('ketua/jurnal/tambahtmp/'),'refresh');
        }
    }
    public function tambah($totaldebet,$totalkredit){
        // tambah jurnal
        if ($totaldebet == $totalkredit) {
            $idjurnal= $this->jurnal->getidmax() + 1;
            $now = new DateTime('Asia/Kuala_Lumpur');
            $tgl_transaksi = $now->format('Y-m-d');
            $keterangan = "JU - ".$this->input->post('keterangan');
            $datajurnal = array(
            'id_jurnal' => $idjurnal,
            'tgl_transaksi' => $tgl_transaksi,
            'keterangan' => $keterangan,
            'id_user' => $this->session->login['id_user'],
            'id_tutup_buku' => '0' );
            $this->jurnal->Insert($datajurnal);

            // tambah jurnal detail
            
            $tmpjurnal = $this->jurnal->selecttmpjurnal()->result();
            foreach ($tmpjurnal as $a) {
            $datajurnaldetail = array(
                'id_jurnal' => $idjurnal,
                'id_akun'   => $a->id_akun,
                'debet'     => $a->debet,
                'kredit'    => $a->kredit
            );
            $this->jurnal->InsertJurnalDetail($datajurnaldetail);
            }
            $this->jurnal->deletetmpjurnalall();
            
            $this->session->set_flashdata('sukses', ' Berhasil menambahkan data jurnal umum!');
            redirect(base_url('ketua/jurnal/tambahtmp/'),'refresh');

        }else{
            $this->session->set_flashdata('gagal', 'Jumlah Debet dan Kredit Harus sama !!!');
            redirect(base_url('ketua/jurnal/tambahtmp/'),'refresh');
        }
    }
    public function deletetmp($id){
        $this->jurnal->deletetmpjurnal($id);
        redirect(base_url('ketua/jurnal/tambahtmp/'),'refresh');
    }
}
        
    /* End of file  bagtab/Jurnal.php */
        
                            