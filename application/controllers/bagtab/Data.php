<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['login'])) {
      redirect(site_url('auth/error'));
    }if ($this->session->login['level']=="Admin") {
      redirect(site_url('admin/adashboard'));
    }if ($this->session->login['level']=="Ketua") {
      redirect(site_url('ketua/ktdashboard'));
    }if ($this->session->login['level']=="Bagian Kredit") {
      redirect(site_url('bagkre/kdashboard'));
    }
    $this->load->model('M_reknasabah', 'rek');
    $this->load->model('M_nasabah', 'nasabah');
    $this->load->model('M_datatabungan', 'data');
    $this->load->model('M_akun', 'akun');
  }

  function index()
  {
    $data['vTab'] = $this->data->SelectAll()->result();

    $data['content'] = 'trxtabungan/view';
    $this->load->view('index',$data);
  }

  public function det($id_reknasabah)
  {
    $data['vAkun'] = $this->akun->SelectAll()->result_array();
    $data['vDet'] = $this->data->SelectDetail($id_reknasabah)->result();
    $data['vD'] = $this->data->SelectData($id_reknasabah)->result();

    $data['content'] = 'trxtabungan/detail';
    $this->load->view('index',$data);
  }

  public function pembungaan()
  {
    $now = new DateTime('Asia/Kuala_Lumpur');
    $tgl = $now->format('Y/m/1');
    $tglbunga = $now->format('Y/m/t');
    $bln = $now->format('m');

    $select_bunga = $this->db->select('*')->from('tb_bungatabungan')->get()->row();
    $id_bunga = $select_bunga->id_akun;
    $nominal_bunga = $select_bunga->nominal;
    //LAMA
    $querylama = $this->db->select('trx.id_reknasabah')
                      ->from('tb_trx_tabungan trx')
                      ->join('tb_reknasabah as rek','trx.id_reknasabah=rek.id_reknasabah')
                      ->where('rek.rek_status','Lama')
                      ->where('MONTH(trx.tgl_transaksi)',$bln)
                      ->group_by('rek.id_reknasabah')->get();
      $pplama = $querylama->result_array();
      if (!$pplama) {
        // redirect(site_url('bagtab/data'));
      }else {
        $idlama = array();
        foreach ($pplama as $value) {
          $idlama[] = $value['id_reknasabah'];
        };

        $a = $this->db->select('trx.id_reknasabah, rek.saldo_akhir, MIN(trx.saldo) as saldo_min')// 1 2 3 4
                      ->from('tb_trx_tabungan as trx')
                      ->join('tb_reknasabah as rek','trx.id_reknasabah=rek.id_reknasabah')
                      ->where_in('trx.id_reknasabah', $idlama)
                      ->where('trx.kredit >',100000)
                      ->group_by('trx.id_reknasabah')
                      ->get();
        $resultlama = $a->result();

        $j = 0;
        foreach ($resultlama as $rl) {
          $k[$j] = array(
            array(
              'id_reknasabah' => $rl->id_reknasabah,
              'tgl_transaksi' => $tglbunga,
              'id_akun' => $id_bunga,
              'debet' =>'0',
              'kredit' => (($rl->saldo_min*$nominal_bunga)/12),
              'saldo' => $rl->saldo_akhir + (($rl->saldo_min*$nominal_bunga)/12),
              'id_user' => '1',
            ),

            array(
              'id_reknasabah' => $rl->id_reknasabah,
              'saldo_akhir' => $rl->saldo_akhir + (($rl->saldo_min*$nominal_bunga)/12),
              'rek_status' => "Lama",
            ),

            array(
              'jns_transaksi' => $rl->id_reknasabah,
              'status' => 'TRX-Tabungan',
              'tgl_transaksi' => $tglbunga,
              'id_akun' => $id_bunga,
              'debet' => '0',
              'kredit' => (($rl->saldo_min*$nominal_bunga)/12),
            ),
           );
           $j=$j+1;
        }

        for ($g=0; $g < $j; $g++) {
          $this->db->insert('tb_trx_tabungan',$k[$g][0]);
          $this->db->where('id_reknasabah', $k[$g][1]['id_reknasabah'])->update('tb_reknasabah', $k[$g][1]);
          $this->db->insert('tb_kas',$k[$g][2]);
        }
      }
    //BARU
    $query = $this->db->select('trx.id_reknasabah')
                      ->from('tb_trx_tabungan trx')
                      ->join('tb_reknasabah as rek','trx.id_reknasabah=rek.id_reknasabah')
                      ->where('rek.rek_status','Baru')
                      ->where('trx.id_akun','202')
                      ->where('MONTH(trx.tgl_transaksi)',$bln)
                      ->group_by('rek.id_reknasabah')->get();
      $pp = $query->result_array();
      if (!$pp) {
        redirect(site_url('bagtab/data'));
      }else {
        $id = array();
        foreach ($pp as $value) {
          $id[] = $value['id_reknasabah'];
        };

        //TIDAK DAPAT BUNGA BULAN AWAL NABUNG
        $not_bunga = $this->db->select('id_reknasabah')// 1 2 3 4
                  ->from('tb_trx_tabungan')
                  ->where_in('id_reknasabah', $id)
                  ->group_by('id_reknasabah')
                  ->get();
        $result = $not_bunga->result();
        $i1 = 0;
        foreach ($result as $q) {
          $w[$i1] = array(
            'id_reknasabah' => $q->id_reknasabah,
            'rek_status' => "Lama",
           );
           $i1=$i1+1;
        }
        for ($r=0; $r < $i1; $r++) {
          $this->db->where('id_reknasabah', $w[$r]['id_reknasabah'])->update('tb_reknasabah', $w[$r]);
        }

        //DAPAT BUNGA BULAN AWAL NABUNG
        $bunga = $this->db->select('trx.id_reknasabah, trx.saldo, rek.saldo_akhir')// 1 2 3 4
                  ->from('tb_trx_tabungan as trx')
                  ->join('tb_reknasabah as rek','trx.id_reknasabah=rek.id_reknasabah')
                  ->where_not_in('trx.id_reknasabah', $id)
                  ->where('trx.tgl_transaksi', $tgl)
                  ->where('trx.kredit >',100000)
                  ->group_by('trx.id_reknasabah')
                  ->get();
        $result2 = $bunga->result();

        $i = 0;
        foreach ($result2 as $rb) {
          $x[$i] = array(
            array(
              'id_reknasabah' => $rb->id_reknasabah,
              'tgl_transaksi' => $tglbunga,
              'id_akun' => $id_bunga,
              'debet' =>'0',
              'kredit' => (($rb->saldo*$nominal_bunga)/12),
              'saldo' => $rb->saldo_akhir + (($rb->saldo*$nominal_bunga)/12),
              'id_user' => '1',
            ),

            array(
              'id_reknasabah' => $rb->id_reknasabah,
              'saldo_akhir' => $rb->saldo_akhir + (($rb->saldo*$nominal_bunga)/12),
              'rek_status' => "Lama",
            ),

            array(
              'jns_transaksi' => $rb->id_reknasabah,
              'status' => 'TRX-Tabungan',
              'tgl_transaksi' => $tglbunga,
              'id_akun' => $id_bunga,
              'debet' => '0',
              'kredit' => (($rb->saldo*$nominal_bunga)/12),
            ),
           );
           $i=$i+1;
        }
        for ($y=0; $y < $i; $y++) {
          $this->db->insert('tb_trx_tabungan',$x[$y][0]);
          $this->db->where('id_reknasabah', $x[$y][1]['id_reknasabah'])->update('tb_reknasabah', $x[$y][1]);
          $this->db->insert('tb_kas',$x[$y][2]);
        }
        redirect(site_url('bagtab/data'));
      }
  }
}
