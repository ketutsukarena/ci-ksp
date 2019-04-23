<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->library('pdf');
    $this->load->model('M_anggota', 'anggota');
    $this->load->model('M_nasabah', 'nasabah');
    $this->load->model('M_trxsimpan', 'trx');
    $this->load->model('M_datatabungan', 'data');
    $this->load->model('M_trxsimpan_det', 'trx_det');
  }

  function index()
  {

  }

  public function cts($id){ //Cetak Transaksi Simpanan per Anggota
    $pdf = new FPDF('p','mm','A4');
    $pdf->AddPage();
    //header
    $pdf->Image('assets/img/logo-kop.png', 14,10,20,19);
    $pdf->SetFont('Times','B', 14);
    $pdf->Cell(0,7,'KOPERASI SIMPAN PINJAM WINANGUN KERTHI',0,1,'C');
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,6,'BADAN HUKUM NO. : 15 / BH / DISKOP.PKM / 2006',0,1,'C');
    $pdf->SetFont('Times','B', 11);
    $pdf->Cell(0,5,'Jl. A. Yani No. 379 Peguyangan, Denpasar Utara - Kota Denpasar, Bali 80239',0,1,'C');
    $pdf->Cell(0,5,'Telp. (0361) 421626',0,1,'C');
    $pdf->SetLineWidth(1);
    $pdf->Line(10,34,200,34);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,35,200,35);
    $pdf->Cell(10,10,'',0,1);
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,1,'REPORT',0,1,'C');
    $pdf->Cell(0,10,'SIMPANAN ANGGOTA',0,1,'C');
    $pdf->SetFont('Times','', 12);

    $p = $this->trx_det->SelectAng($id)->row();

    $pdf->Cell(5,5,'',0,1);
    $pdf->Cell(30,4,'No. Identitas',0,0,'');
    $pdf->Cell(7,4,' : ',0,0);
    $pdf->Cell(83,4,$p->no_ktp,0,0,'');
    $pdf->Cell(30,4,'Total Simpanan',0,0,'');
    $pdf->Cell(7,4,' : ',0,0);
    $pdf->Cell(0,4,'Rp. '.number_format($p->tsim,0,'','.'),0,0,'');

    $pdf->Cell(5,6,'',0,1);
    $pdf->Cell(30,4,'Nama Anggota',0,0);
    $pdf->Cell(7,4,' : ',0,0);
    $pdf->Cell(0,4,$p->nama,0,0,'');

    $pdf->Cell(5,6,'',0,1);
    $pdf->Cell(30,4,'Alamat',0,0);
    $pdf->Cell(7,4,' : ',0,0);
    $pdf->Cell(0,4,$p->alamat,0,0,'');

    $pdf->Cell(10,10,'',0,1);
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(35,6,'Tanggal',1,0,'C');
    $pdf->Cell(45,6,'Jenis',1,0,'C');
    $pdf->Cell(45,6,'Bulan',1,0,'C');
    $pdf->Cell(30,6,'Tahun',1,0,'C');
    $pdf->Cell(35,6,'Nominal',1,1,'C');

    $pdf->SetFont('Times','',10);
    $q = $this->trx_det->Selectxx($id)->result();
    foreach ($q as $row){
      if ($row->bulan=="1") {
          $bln = "Januari";
      }elseif ($row->bulan=="2") {
          $bln = "Februari";
      }elseif ($row->bulan=="3") {
          $bln = "Maret";
      }elseif ($row->bulan=="4") {
          $bln = "April";
      }elseif ($row->bulan=="5") {
          $bln = "Mei";
      }elseif ($row->bulan=="6") {
          $bln = "Juni";
      }elseif ($row->bulan=="7") {
          $bln = "Juli";
      }elseif ($row->bulan=="8") {
          $bln = "Agustus";
      }elseif ($row->bulan=="9") {
          $bln = "September";
      }elseif ($row->bulan=="10") {
          $bln = "Oktober";
      }elseif ($row->bulan=="11") {
          $bln = "November";
      }elseif ($row->bulan=="12") {
          $bln = "Desember";
      }else {
          $bln = "Bulan salah";
      }
      $pdf->Cell(35,6,date("d/m/Y", strtotime($row->tgl_transaksi)),1,0,'C');
      $pdf->Cell(45,6,$row->nama_simpanan,1,0,'C');
      $pdf->Cell(45,6,$bln,1,0,'C');
      $pdf->Cell(30,6,$row->tahun,1,0,'C');
      $pdf->Cell(8,6,'Rp.',1,0);
      $pdf->Cell(27,6,number_format($row->nominal,0,'','.'),1,1,'R');
    }

    $pdf->SetFont('Times','B',10);
    $pdf->Cell(155,6,'Total Simpanan',1,0,'C');
    $pdf->Cell(8,6,'Rp.',1,0);
    $pdf->Cell(27,6,number_format($p->tsim,0,'','.'),1,0,'R');
    $pdf->Output();
  }

  public function crts(){
    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();
    //header
    $pdf->Image('assets/img/logo-kop.png', 30,10,22,22);
    //$pdf->Image('assets/img/logo-kop.png', 240,10,22,22);
    $pdf->SetFont('Times','B', 14);
    $pdf->Cell(0,7,'KOPERASI SIMPAN PINJAM WINANGUN KERTHI',0,1,'C');
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,6,'BADAN HUKUM NO. : 15 / BH / DISKOP.PKM / 2006',0,1,'C');
    $pdf->SetFont('Times','B', 11);
    $pdf->Cell(0,5,'Jl. Ahmad Yani No. 379 Kelurahan Peguyangan Kecamatan Denpasar Utara Kota Denpasar, Bali - 80239',0,1,'C');
    $pdf->Cell(0,5,'Telp. (0361) 421626 email: koperasi_winangunkerthi@gmail.com ',0,1,'C');
    $pdf->SetLineWidth(1);
    $pdf->Line(10,34,288,34);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,35,288,35);
    $pdf->Cell(10,10,'',0,1);
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,1,'REPORT',0,1,'C');
    $pdf->Cell(0,10,'REKAP DATA SIMPANAN ANGGOTA',0,1,'C');
    $pdf->SetFont('Times','', 12);

    $pdf->Cell(10,5,'',0,1);
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(10,6,'No',1,0,'C');
    $pdf->Cell(35,6,'No. Identitas',1,0,'C');
    $pdf->Cell(70,6,'Nama Anggota',1,0,'C');
    $pdf->Cell(27,6,'Jenis Kelamin',1,0,'C');
    $pdf->Cell(100,6,'Alamat',1,0,'C');
    $pdf->Cell(35,6,'Total Simpanan',1,1,'C');
    $pdf->SetFont('Times','',10);

    $q = $this->trx->SelectAll()->result();
    $no = 1;
    foreach ($q as $row){
      $pdf->Cell(10,6,$no++.'.',1,0,'C');
      $pdf->Cell(35,6,$row->no_ktp,1,0);
      $pdf->Cell(70,6,$row->nama,1,0);
      $pdf->Cell(27,6,$row->jk,1,0);
      $pdf->Cell(100,6,$row->alamat,1,0);
      $pdf->Cell(8,6,'Rp.',1,0);
      $pdf->Cell(27,6,number_format($row->tsim,0,'','.'),1,1,'R');
    }

    $pdf->Output();
  }

  public function cda($id){ //Cetak Data perAnggota
    $pdf = new FPDF('p','mm','A4');
    $pdf->AddPage();
    //header
    $pdf->Image('assets/img/logo-kop.png', 14,10,20,19);
    $pdf->SetFont('Times','B', 14);
    $pdf->Cell(0,7,'KOPERASI SIMPAN PINJAM WINANGUN KERTHI',0,1,'C');
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,6,'BADAN HUKUM NO. : 15 / BH / DISKOP.PKM / 2006',0,1,'C');
    $pdf->SetFont('Times','B', 11);
    $pdf->Cell(0,5,'Jl. A. Yani No. 379 Peguyangan, Denpasar Utara - Kota Denpasar, Bali 80239',0,1,'C');
    $pdf->Cell(0,5,'Telp. (0361) 421626',0,1,'C');
    $pdf->SetLineWidth(1);
    $pdf->Line(10,34,200,34);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,35,200,35);
    $pdf->Cell(0,2,'',0,1);

    $pdf->SetFont('Times','', 12);
    $pdf->Cell(135,8,'',0,0);
    // $pdf->Cell(30,8,'Kode Anggota',0,0);
    // $pdf->Cell(5,8,':',0,0);
    // $pdf->Cell(35,8,'ANG-001',0,0);
    $pdf->Cell(0,10,'',0,1);

    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,6,'FORMULIR',0,1,'C');
    $pdf->Cell(0,6,'ANGGOTA KOPERASI',0,1,'C');
    $pdf->Cell(0,4,'',0,1);

    $pdf->SetFont('Times','', 12);
    $pdf->Cell(50,6,'Ketentuan',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(3,6,'*',0,0);
    $pdf->Cell(140,6,'Setiap anggota wajib membayar iuran pokok dan iuran wajib.',0,1);
    $pdf->Cell(55,6,'',0,0);
    $pdf->Cell(3,6,'*',0,0);
    $pdf->Cell(140,6,'Iuran pokok dibayar sekali pada saat mendaftar menjadi anggota senilai',0,1);
    $pdf->Cell(55,6,'',0,0);
    $pdf->Cell(3,6,'',0,0);
    $pdf->Cell(140,6,'Rp. 1.000.000,-',0,1);
    $pdf->Cell(55,6,'',0,0);
    $pdf->Cell(3,6,'*',0,0);
    $pdf->Cell(140,6,'Iuran wajib dibayar perBulan senilai Rp. 10.000,-',0,1);
    $pdf->Cell(0,6,'',0,1);

    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(50,6,'Data Diri Anggota',0,0);

    $p = $this->anggota->SelectById($id)->row();
    if ($p->status=="Anggota") {
        $status = "1";
    }else{
        $status = "2";
    };
    $pdf->SetFont('Times','', 12);
    $pdf->Cell(5,8,'',0,1);

    $pdf->Image('img/'.$p->foto, 160,101,32,32);
    $pdf->Cell(10,8,'',0,0);
    $pdf->Cell(50,8,'No. Identitas',0,0);
    $pdf->Cell(5,8,':',0,0);
    $pdf->Cell(35,8,$p->no_ktp,0,1);
    $pdf->Cell(10,8,'',0,0);
    $pdf->Cell(50,8,'Nama',0,0);
    $pdf->Cell(5,8,':',0,0);
    $pdf->Cell(35,8,$p->nama,0,1);

    $pdf->Cell(10,8,'',0,0);
    $pdf->Cell(50,8,'Jenis Kelamin',0,0);
    $pdf->Cell(5,8,':',0,0);
    $pdf->Cell(85,8,$p->jk,0,1);

    $pdf->Cell(10,8,'',0,0);
    $pdf->Cell(50,8,'Tempat, Tgl Lahir',0,0);
    $pdf->Cell(5,8,':',0,0);
    $pdf->Cell(85,8,$p->tempat_lahir.', '.date("d-m-Y", strtotime($p->tgl_lahir)),0,1);

    // $pdf->Cell(35,8,'Jenis Kelamin',0,0);
    // $pdf->Cell(5,8,':',0,0);
    // $pdf->Cell(35,8,'Laki-laki',0,1);
    $pdf->Cell(10,8,'',0,0);
    $pdf->Cell(50,8,'Agama',0,0);
    $pdf->Cell(5,8,':',0,0);
    $pdf->Cell(88,8,$p->agama,0,0);
    $pdf->SetFont('courier','', 8);
    $pdf->Cell(50,8,'(foto anggota)',0,1);

    $pdf->SetFont('Times','', 12);
    $pdf->Cell(10,8,'',0,0);
    $pdf->Cell(50,8,'Alamat',0,0);
    $pdf->Cell(5,8,':',0,0);
    $pdf->Cell(50,1,'',0,1);
    $pdf->Cell(65,8,'',0,0);
    $pdf->MultiCell(45,6,$p->alamat,0,'L',false);

    $pdf->Cell(10,8,'',0,0);
    $pdf->Cell(50,8,'No. HP',0,0);
    $pdf->Cell(5,8,':',0,0);
    $pdf->Cell(85,8,$p->no_hp,0,1);

    $pdf->Cell(10,8,'',0,0);
    $pdf->Cell(50,8,'Email',0,0);
    $pdf->Cell(5,8,':',0,0);
    $pdf->Cell(85,8,$p->email,0,1);

    $pdf->Cell(10,8,'',0,0);
    $pdf->Cell(50,8,'Status',0,0);
    $pdf->Cell(5,8,':',0,0);
    $pdf->Cell(85,8,$status.' ('.$p->status.')',0,1);

    $pdf->Cell(0,20,'',0,1);
    $pdf->Cell(25,8,'',0,0);
    $pdf->Cell(5,8,'Menerima',0,0);
    $pdf->Cell(105,8,'',0,0);
    $pdf->Cell(50,8,'Mengetahui',0,1);
    $pdf->Cell(0,20,'',0,1);
    $pdf->Cell(8,8,'',0,0);
    $pdf->Cell(60,8,'(Admin KSP Winangun Kerthi)',0,0,'C');
    $pdf->Cell(45,8,'',0,0);
    $pdf->Cell(70,8,'('.$p->nama.')',0,1,'C');
    $pdf->SetFont('Times','',10);

    $pdf->Output();
  }

  public function crda(){ // Cetak Rekap Data Anggota
    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();
    //header
    $pdf->Image('assets/img/logo-kop.png', 30,10,22,22);
    //$pdf->Image('assets/img/logo-kop.png', 240,10,22,22);
    $pdf->SetFont('Times','B', 14);
    $pdf->Cell(0,7,'KOPERASI SIMPAN PINJAM WINANGUN KERTHI',0,1,'C');
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,6,'BADAN HUKUM NO. : 15 / BH / DISKOP.PKM / 2006',0,1,'C');
    $pdf->SetFont('Times','B', 11);
    $pdf->Cell(0,5,'Jl. Ahmad Yani No. 379 Kelurahan Peguyangan Kecamatan Denpasar Utara Kota Denpasar, Bali - 80239',0,1,'C');
    $pdf->Cell(0,5,'Telp. (0361) 421626 email: koperasi_winangunkerthi@gmail.com ',0,1,'C');
    $pdf->SetLineWidth(1);
    $pdf->Line(10,34,288,34);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,35,288,35);
    $pdf->Cell(10,10,'',0,1);
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,1,'REPORT',0,1,'C');
    $pdf->Cell(0,10,'REKAP DATA ANGGOTA',0,1,'C');

    $pdf->SetFont('courier','', 9);
    $pdf->Cell(200,4,'',0,0,'C');
    $pdf->Cell(30,4,'Ket. Status',0,0,'C');
    $pdf->Cell(5,4,':',0,0,'C');
    $pdf->Cell(30,4,'1 (Anggota)',0,1);
    $pdf->Cell(235,4,'',0,0,'C');
    $pdf->Cell(50,4,'2 (Anggota & Nasabah)',0,1);
    $pdf->Cell(10,4,'',0,1);
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(10,6,'No',1,0,'C');
    $pdf->Cell(32,6,'No. Identitas',1,0,'C');
    $pdf->Cell(55,6,'Nama Anggota',1,0,'C');
    $pdf->Cell(25,6,'Jenis Kelamin',1,0,'C');
    $pdf->Cell(30,6,'Agama',1,0,'C');
    $pdf->Cell(85,6,'Alamat',1,0,'C');
    //$pdf->Cell(30,6,'Email',1,0,'C');
    $pdf->Cell(27,6,'No. HP',1,0,'C');
    $pdf->Cell(15,6,'Status',1,1,'C');
    $pdf->SetFont('Times','',10);

     $q = $this->anggota->SelectAll()->result();
     //var_dump($q);
     $no = 1;
     foreach ($q as $row){
       if ($row->status=="Anggota") {
          $status = "1";
       }else {
          $status ="2";
       };
       $pdf->Cell(10,6,$no++.'.',1,0,'C');
       $pdf->Cell(32,6,$row->no_ktp,1,0,'C');
       $pdf->Cell(55,6,$row->nama,1,0);
       $pdf->Cell(25,6,$row->jk,1,0);
       $pdf->Cell(30,6,$row->agama,1,0);
       $pdf->Cell(85,6,$row->alamat,1,0);
       //$pdf->Cell(30,6,'Email',1,0,'C');
       $pdf->Cell(27,6,$row->no_hp,1,0);
       $pdf->Cell(15,6,$status,1,1,'C');
     }

    $pdf->Output();
  }

  public function crdn(){ // Cetak Rekap Data Nasabah
    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();
    //header
    $pdf->Image('assets/img/logo-kop.png', 30,10,22,22);
    //$pdf->Image('assets/img/logo-kop.png', 240,10,22,22);
    $pdf->SetFont('Times','B', 14);
    $pdf->Cell(0,7,'KOPERASI SIMPAN PINJAM WINANGUN KERTHI',0,1,'C');
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,6,'BADAN HUKUM NO. : 15 / BH / DISKOP.PKM / 2006',0,1,'C');
    $pdf->SetFont('Times','B', 11);
    $pdf->Cell(0,5,'Jl. Ahmad Yani No. 379 Kelurahan Peguyangan Kecamatan Denpasar Utara Kota Denpasar, Bali - 80239',0,1,'C');
    $pdf->Cell(0,5,'Telp. (0361) 421626 email: koperasi_winangunkerthi@gmail.com ',0,1,'C');
    $pdf->SetLineWidth(1);
    $pdf->Line(10,34,288,34);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,35,288,35);
    $pdf->Cell(10,10,'',0,1);
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,1,'REPORT',0,1,'C');
    $pdf->Cell(0,10,'REKAP DATA NASABAH',0,1,'C');

    $pdf->SetFont('courier','', 9);
    $pdf->Cell(200,4,'',0,0,'C');
    $pdf->Cell(30,4,'Ket. Status',0,0,'C');
    $pdf->Cell(5,4,':',0,0,'C');
    $pdf->Cell(30,4,'1 (Nasabah)',0,1);
    $pdf->Cell(235,4,'',0,0,'C');
    $pdf->Cell(50,4,'2 (Anggota & Nasabah)',0,1);
    $pdf->Cell(10,4,'',0,1);
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(10,6,'No',1,0,'C');
    $pdf->Cell(30,6,'No. Rekening',1,0,'C');
    $pdf->Cell(32,6,'No. Identitas',1,0,'C');
    $pdf->Cell(55,6,'Nama Anggota',1,0,'C');
    $pdf->Cell(25,6,'Jenis Kelamin',1,0,'C');
    $pdf->Cell(85,6,'Alamat',1,0,'C');
    //$pdf->Cell(30,6,'Email',1,0,'C');
    $pdf->Cell(27,6,'No. HP',1,0,'C');
    $pdf->Cell(15,6,'Status',1,1,'C');
    $pdf->SetFont('Times','',10);

     $q = $this->nasabah->SelectAll()->result();
     $no = 1;
     foreach ($q as $row){
       if ($row->status=="Nasabah") {
          $status = "1";
       }else {
          $status ="2";
       };
       $pdf->Cell(10,6,$no++.'.',1,0,'C');
       $pdf->Cell(30,6,$row->reknasabah,1,0);
       $pdf->Cell(32,6,$row->no_ktp,1,0,'C');
       $pdf->Cell(55,6,$row->nama,1,0);
       $pdf->Cell(25,6,$row->jk,1,0);
       $pdf->Cell(85,6,$row->alamat,1,0);
       //$pdf->Cell(30,6,'Email',1,0,'C');
       $pdf->Cell(27,6,$row->no_hp,1,0);
       $pdf->Cell(15,6,$status,1,1,'C');
     }

    $pdf->Output();
  }

  public function crtn(){ // Cetak Rekap Tabungan Nasabah
    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();
    //header
    $pdf->Image('assets/img/logo-kop.png', 30,10,22,22);
    //$pdf->Image('assets/img/logo-kop.png', 240,10,22,22);
    $pdf->SetFont('Times','B', 14);
    $pdf->Cell(0,7,'KOPERASI SIMPAN PINJAM WINANGUN KERTHI',0,1,'C');
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,6,'BADAN HUKUM NO. : 15 / BH / DISKOP.PKM / 2006',0,1,'C');
    $pdf->SetFont('Times','B', 11);
    $pdf->Cell(0,5,'Jl. Ahmad Yani No. 379 Kelurahan Peguyangan Kecamatan Denpasar Utara Kota Denpasar, Bali - 80239',0,1,'C');
    $pdf->Cell(0,5,'Telp. (0361) 421626 email: koperasi_winangunkerthi@gmail.com ',0,1,'C');
    $pdf->SetLineWidth(1);
    $pdf->Line(10,34,288,34);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,35,288,35);
    $pdf->Cell(10,10,'',0,1);
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,1,'REPORT',0,1,'C');
    $pdf->Cell(0,10,'REKAP DATA TABUNGAN NASABAH',0,1,'C');

    $pdf->Cell(10,4,'',0,1);
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(10,6,'No',1,0,'C');
    $pdf->Cell(30,6,'No. Rekening',1,0,'C');
    $pdf->Cell(60,6,'Nama Anggota',1,0,'C');
    $pdf->Cell(25,6,'Jenis Kelamin',1,0,'C');
    $pdf->Cell(90,6,'Alamat',1,0,'C');
    $pdf->Cell(27,6,'No. HP',1,0,'C');
    $pdf->Cell(35,6,'Saldo',1,1,'C');
    $pdf->SetFont('Times','',10);

     $q = $this->data->SelectAll()->result();
     $no = 1;
     foreach ($q as $row){
       $pdf->Cell(10,6,$no++.'.',1,0,'C');
       $pdf->Cell(30,6,$row->reknasabah,1,0);
       $pdf->Cell(60,6,$row->nama,1,0);
       $pdf->Cell(25,6,$row->jk,1,0);
       $pdf->Cell(90,6,$row->alamat,1,0);
       $pdf->Cell(27,6,$row->no_hp,1,0);
       $pdf->Cell(8,6,'Rp. ',1,0);
       $pdf->Cell(27,6,number_format($row->saldo_akhir,2,'.',','),1,1,'R');
     }

     $p = $this->db->select('SUM(saldo_akhir) AS sakhir')
     ->from('tb_reknasabah')
     ->get()->row();
     $pdf->SetFont('Times','B',10);
     $pdf->Cell(242,6,'Total Saldo Tabungan Anggota',1,0,'C');
     $pdf->Cell(8,6,'Rp. ',1,0);
     $pdf->Cell(27,6,number_format($p->sakhir,2,'.',','),1,1,'R');

    $pdf->Output();
  }

  public function ctn($id_reknasabah){ //Cetak Data perAnggota
    $pdf = new FPDF('p','mm','A4');
    $pdf->AddPage();
    //header
    $pdf->Image('assets/img/logo-kop.png', 14,10,20,19);
    $pdf->SetFont('Times','B', 14);
    $pdf->Cell(0,7,'KOPERASI SIMPAN PINJAM WINANGUN KERTHI',0,1,'C');
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(0,6,'BADAN HUKUM NO. : 15 / BH / DISKOP.PKM / 2006',0,1,'C');
    $pdf->SetFont('Times','B', 11);
    $pdf->Cell(0,5,'Jl. A. Yani No. 379 Peguyangan, Denpasar Utara - Kota Denpasar, Bali 80239',0,1,'C');
    $pdf->Cell(0,5,'Telp. (0361) 421626',0,1,'C');
    $pdf->SetLineWidth(1);
    $pdf->Line(10,34,200,34);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,35,200,35);
    $pdf->Cell(0,5,'',0,1);

    $pdf->SetFont('Times','B', 12);

    $pdf->Cell(0,6,'REPORT',0,1,'C');
    $pdf->Cell(0,6,'BUKU TABUNGAN',0,1,'C');
    $pdf->Cell(0,4,'',0,1);

    $i = $this->data->SelectData($id_reknasabah)->row();

    $pdf->SetFont('Times','', 12);
    $pdf->Cell(35,6,'No. Rekening',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(100,6,$i->reknasabah,0,0);
    $pdf->Cell(35,6,'disahkan oleh',0,1);
    $pdf->Cell(35,6,'No. Identitas',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(94,6,$i->no_ktp,0,0);
    $pdf->Cell(35,6,'KSP Winangun Kerthi',0,1);
    $pdf->Cell(35,6,'Nama',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(35,6,$i->nama,0,1);
    $pdf->Cell(35,6,'Alamat',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->MultiCell(60,6,$i->alamat,0,'L',false);
    $pdf->Cell(35,6,'Pekerjaan',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(95,6,$i->pekerjaan,0,0);
    $pdf->Cell(40,6,'Pengurus',0,1,'C');

    $pdf->Cell(0,10,'',0,1);
    $pdf->MultiCell(105,6,'KSP. Winangun Kerthi dibebaskan dari segala kerugian dan atau tuntutan yang timbul karena kehilangan / pemalsuan atau penyalahgunaan atas buku Tabungan ini.',0,'L',false);
    $pdf->Cell(0,6,'',0,1);

    // $pdf->SetLineWidth(1);
    // $pdf->Line(70,125,70,150);
    $pdf->SetFont('Times','BU', 12);
    $pdf->Cell(0,10,'Kode Transaksi',0,1,'C');
    $pdf->SetFont('Times','', 12);
    $pdf->Cell(55,6,'',0,0);
    $pdf->Cell(10,6,'201',0,0);
    $pdf->Cell(4,6,':',0,0);
    $pdf->Cell(30,6,'Penyetoran',0,0);
    $pdf->Cell(10,6,'203',0,0);
    $pdf->Cell(4,6,':',0,0);
    $pdf->Cell(40,6,'Bunga',0,1);

    $pdf->Cell(55,6,'',0,0);
    $pdf->Cell(10,6,'202',0,0);
    $pdf->Cell(4,6,':',0,0);
    $pdf->Cell(30,6,'Penarikan',0,0);
    $pdf->Cell(10,6,'204',0,0);
    $pdf->Cell(4,6,':',0,0);
    $pdf->Cell(40,6,'Koreksi',0,1);

    $pdf->SetFont('Times','B', 12);


    $pdf->Cell(0,10,'',0,1);
    $pdf->SetFont('Times','B', 12);
    $pdf->Cell(30,8,'Tanggal',1,0,'C');
    $pdf->Cell(20,8,'Sandi',1,0,'C');
    $pdf->Cell(40,8,'Debet',1,0,'C');
    $pdf->Cell(40,8,'Kredit',1,0,'C');
    $pdf->Cell(40,8,'Saldo',1,0,'C');
    $pdf->Cell(20,8,'Ket.',1,1,'C');

    $pdf->SetFont('Courier','', 10);
    $row = $this->data->SelectDetail($id_reknasabah)->result();

    foreach ($row as $n){
      if ($n->debet==0) {
         $debet="";
      }else {
         $debet = number_format($n->debet,2,'.',',');
      };
      if ($n->kredit==0) {
         $kredit="";
      }else {
         $kredit = number_format($n->kredit,2,'.',',');
      }
      if ($n->id_user=='1') {
         $ket = 'ADM';
      }else {
         $ket = $n->kode_user;
      }

      $pdf->Cell(30,6,date("d/m/Y", strtotime($n->tgl_transaksi)),1,0,'C');
      $pdf->Cell(20,6,$n->id_akun,1,0,'C');
      $pdf->Cell(40,6,$debet,1,0,'R');
      $pdf->Cell(40,6,$kredit,1,0,'R');
      $pdf->Cell(40,6,number_format($n->saldo,2,'.',','),1,0,'R');
      $pdf->Cell(20,6,$ket,1,1,'C');
    }


    $pdf->Output();
  }
}
