$datanasabah = $this->db->select('id_reknasabah, rek_status')
                        ->from('tb_reknasabah')
                        ->get()->result();
foreach ($datanasabah as $dtnasabah) {
  $status = $dtnasabah->rek_status;
  if ($status=="Lama") { // NASABAH LAMA
    $id_rek = $dtnasabah->id_reknasabah;



  }else{ // NASABAH BARU
    $now = new DateTime();
    $tgl = $now->format('Y/m/1');
    $bln = $now->format('m');
    $id_rek = $dtnasabah->id_reknasabah;
        $query = $this->db->select('id_reknasabah')// 1 2 3 4
                          ->from('tb_trx_tabungan')
                          ->where('id_reknasabah', $id_rek)
                          ->where('id_akun','202')
                          ->where('MONTH(tgl_transaksi)',$bln)
                          ->group_by('id_reknasabah')->get();
          $pp = $query->result_array();

          $id = array();
          foreach ($pp as $value) {
            $id[] = $value['id_reknasabah'];
          };

          $bunga = $this->db->select('id_reknasabah')// 1 2 3 4
                             ->from('tb_trx_tabungan')
                             ->where_not_in('id_reknasabah', $id)
                             ->where('tgl_transaksi', $tgl)
                             ->where('kredit >',100000)
                             ->group_by('id_reknasabah')
                             ->get();
           $result = $bunga->result_array();
           var_dump($result);
  }
}


/////KAK ARI
$now = new DateTime();
$tgl = $now->format('Y/m/1');
$tgl_now = $now->format('Y/m/d');
$bln = $now->format('m');
 //Proses pemberian bunga tabungan bli ari
 //Kondisinya, jika dia nabung tgl 1 pada bulan itu
 //Dan tidak pernah melakukan penarikan dengan id_akun 202, baru bisa dapet bunga
 //wait kar bace malu

// $hasil = $this->db->select('id_reknasabah')
//                   ->from('tb_trx_tabungan')
//                   //->from('tb_reknasabah as rek','trx.id_reknasabah=rek.id_reknasabah')
//                   ->where('tgl_transaksi',$tgl) // 1 - 15
//                   ->group_by('id_reknasabah')
//                   ->get()->result();
                  //var_dump($hasil);

//foreach ($hasil as $h) {
    $query = $this->db->select('id_reknasabah')// 1 2 3 4
                      ->from('tb_trx_tabungan')
                      ->where('id_akun','202')
                      ->where('MONTH(tgl_transaksi)',$bln)
                      ->group_by('id_reknasabah')->get();
    $pp = $query->result_array();

    //result
    $id = array();
    foreach ($pp as $key => $value) {
      $id[] = $value['id_reknasabah'];
    }
    $a = $this->db->select('id_reknasabah, ')// 1 2 3 4
              ->from('tb_trx_tabungan')
              ->where_in('id_reknasabah', $id)
              ->group_by('id_reknasabah')
              ->get();
    $result = $a->result_array();
    echo "Tidak dapat bunga:<br/>";
    var_dump($result);

    //yang dapat bunga
    echo "<br/>Dapat Bunga:<br/>";

    $bunga = $this->db->select('id_reknasabah')// 1 2 3 4
              ->from('tb_trx_tabungan')
              ->where_not_in('id_reknasabah', $id)
              ->where('tgl_transaksi', $tgl)
              ->where('kredit >',100000)
              ->group_by('id_reknasabah')
              ->get();
    $result2 = $bunga->result_array();
    var_dump($result2);
    // $r = 0;
    // $s = 0;
         // foreach ($pp as $p) {
         //   if ($h->id_reknasabah == $p->id_reknasabah) {
         //  }else{
           //  // $now = new DateTime();
           //  // $tgl_now = $now->format('Y/m/d');
           //  // $saldo_akhir = $h->saldo_akhir;
           //  // $saldo_awal = $h->saldo;
           //  // $hasilbunga = ((($saldo_awal*4)/100)/12);
           //  //
           //  // $qwerty = $hasilbunga + $saldo_akhir;
           //  // $data = array(
           //  //   'id_reknasabah' => $h->id_reknasabah,
           //  //   'tgl_transaksi' => $tgl_now,
           //  //   'id_akun' => '203',
           //  //   'debet' => '0',
           //  //   'kredit' => $hasilbunga,
           //  //   'saldo' => $qwerty,
           //  // );
           //
           //    //  $this->trxbunga->insert($data);
//            }
//          }
// }
