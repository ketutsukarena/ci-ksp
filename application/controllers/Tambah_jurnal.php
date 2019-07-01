<?php
    // tambah jurnal
    $this->load->model('M_jurnal','jurnal');
    $idjurnal= $this->jurnal->getidmax() + 1;
    $tgl_transaksi = $now->format('Y-m-d');
    $datajurnal = array(
    'id_jurnal' => $idjurnal,
    'tgl_transaksi' => $tgl_transaksi,
    'keterangan' => $keterangan,
    'id_user' => $this->session->login['id_user'],
    'id_tutup_buku' => '0'
    );
    $this->jurnal->Insert($datajurnal);

    // tambah jurnal detail

    $linkakun = $this->linkakun->selectbyid($id_jenis_transaksi)->result();
    foreach ($linkakun as $a) {
    if ($a->dk == 'd'){
        $debet = $nominal;
        $kredit = 0;
    }else{
        $debet=0;
        $kredit=$nominal;
    }
    $datajurnaldetail = array(
        'id_jurnal' => $idjurnal,
        'id_akun'   => $a->id_akun,
        'debet'     => $debet,
        'kredit'    => $kredit
    );
    $this->jurnal->InsertJurnalDetail($datajurnaldetail);
    }
?>