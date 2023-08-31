<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAkuntansi extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function get_jurnal(){
    return $this->db
    ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
    // ->group_by("norek,no_transaksi")
    ->get_where("jurnal",array("tanggal"=>date("Y-m-d")))->result();
  }
  public function get_jurnal1($from,$till){
    return $this->db
    ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
    ->get_where("jurnal",array("DATE(tanggal) >="=> $from,'DATE(tanggal) <='=>$till))->result();
  }
  public function get_bank(){
    return $this->db
    ->like("namarek","BANK","after")
    ->get("mbesar")->result();
  }
  public function get_kas(){
    return $this->db
    ->like("norek_mbesar","111","after")
    ->get("mbesar")->result();
  }
  public function get_mbesar(){
    return $this->db->get("mbesar")->result();
  }
  public function generete_notrans(){
    $tanggal = date("Ymd");
    $get_data = $this->db
    ->order_by("idtransaksi","desc")
    ->like("no_transaksi",$tanggal)->get('jurnal')->row_array();
    $no = substr($get_data['no_transaksi'],-3);
    if($get_data){
      $kode = (int) $no;
      $kode = $kode+1;
      $kode_1 = str_pad($kode,3,"0",STR_PAD_LEFT);
    }else{
      $kode_1 = "001";
    }
    $kode = $tanggal.$kode_1;
    return $kode;
  }

}
