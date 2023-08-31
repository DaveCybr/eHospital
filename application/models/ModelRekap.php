<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelRekap extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data($from,$till){
      $data = $this->db
      ->select("acc_ranap,count(*) as jumlah,tupel_kode_tupel,tujuan_pelayanan")
      ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
      ->group_by("tupel_kode_tupel")
      ->get_where('kunjungan',array('DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))
      ->result();
      $respon = array();
      $total_billing = 0;
      $total_non_billing = 0;
      $total_kunjungan = 0;
      $total_rujuk = 0;
      foreach ($data as $value) {
        $data1 = $this->db
        ->get_where('kunjungan',array('DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till,'tupel_kode_tupel'=>$value->tupel_kode_tupel))
        ->result();
        $billing = 0 ;
        $non_billing = 0;
        $rujuk = 0;
        foreach ($data1 as $value1) {
          if($value1->acc_ranap==1){
            $rujuk++;
          }else if(($value1->billing == NULL || $value1->billing !=1) && $value1->acc_ranap!=1) {
            $non_billing++;
          }else{
            $billing++;
          }
        }
        $res = array(
          'tujuan' => $value->tujuan_pelayanan,
          'jumlah' => $value->jumlah,
          'billing' => $billing,
          'non_billing' => $non_billing,
          'rujuk' => $rujuk
        );
        $total_rujuk += $rujuk;
        $total_billing += $billing;
        $total_non_billing += $non_billing;
        $total_kunjungan += $value->jumlah;
        array_push($respon,$res);

      }
      $res = array(
        'tujuan' => "TOTAL",
        'jumlah' => $total_kunjungan,
        'billing' => $total_billing,
        'non_billing' => $total_non_billing,
        'rujuk' => $total_rujuk
      );
      array_push($respon,$res);

      $jurnal = $this->db
      ->select("SUM(kredit) as kredit,norek,namarek")
      ->group_by("norek")
      ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
      ->like("norek","4","after")
      ->get_where('jurnal',array('DATE(tanggal) >='=>$from,'DATE(tanggal) <='=>$till,'kredit !='=>NULL))
      ->result();
      // die(var_dump($jurnal));

      return array('kunjungan'=>$respon,'jurnal'=>$jurnal);
  }




}
