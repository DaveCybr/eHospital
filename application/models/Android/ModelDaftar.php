<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelDaftar extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_booking(){
    return $this->db
    ->join("pegawai","pegawai.NIK=booking.pegawai_NIK")
    ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=booking.tupel_kode_tupel")
    ->where("DATE(tanggal)>=",date("Y-m-d",strtotime("-1 days")))
    ->order_by("tanggal")
    ->get("booking")->result();
  }

  public function get_history($norm){
    $txt_status = ['Belum bayar','Menunggu Verifikasi','Lunas','Berakhir',"Waktu Pembayaran Habis"];
    $response = array();
    $data = $this->db
    ->join("pegawai","pegawai.NIK=booking.pegawai_NIK")
    ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=booking.tupel_kode_tupel")
    ->get_where("booking",array("noRM"=>$norm))->result();
    foreach ($data as $value) {
      if ($value->status_booking==2 || $value->status_booking==1) {
        $sts = $value->status_booking;
      }else{
        if (date("Y-m-d") > date("Y-m-d",strtotime($value->tanggal))) {
          $sts = 3;
        }else{
          if ( date("H:i") > date("H:i",strtotime($value->akhir_bayar)) && $value->status_bayar==0) {
            $sts = 4;
          }else{
            $sts = $value->status_booking;
          }
        }
      }
      array_push($response,array(
        'dokter' => $value->nama,
        'tgl' => date("d-m-Y",strtotime($value->tanggal))." ".$value->jam,
        'status' => $sts,
        'txt_status' => $txt_status[$sts],
        'poli' => $value->tujuan_pelayanan,
        'id' => $value->idbooking
      ));
    }
    // die(var_dump($response));
    return $response;
  }
}
