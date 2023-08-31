<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPiutang extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    return $this->db
    ->select("idpiutang_pasien,SUM(jumlah_bayar) as bayar,total,COUNT(*) as pembayaran,namapasien,kunjungan_no_urutkunjungan,noRM")
    ->join("kunjungan","piutang_pasien.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan")
    ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
    ->group_by("kunjungan_no_urutkunjungan")
    ->get("piutang_pasien")->result();
  }

}
