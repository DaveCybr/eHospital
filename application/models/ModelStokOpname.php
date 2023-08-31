<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelStokOpname extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function list_batch($id_obat)
  {
    if ($_SESSION['jabatan']=='pumu' || $_SESSION['jabatan']=='pugd') {
      $asal = "UGD";
    }else{
      $asal = "APOTEK";
    }
    $this->db->where("idobat",$id_obat);
    $this->db->where("unit",$asal);
    $this->db->where("stok !=",0);
    // $this->db->where("unit",$asal);
    return $this->db->get("list_batch");
  }
  public function list_batch_baru($id_obat)
  {
    if ($_SESSION['jabatan']=='pumu' || $_SESSION['jabatan']=='pugd') {
      $asal = "UGD";
    }else{
      $asal = "APOTEK";
    }
    $this->db->where("idobat",$id_obat);
    $this->db->where("unit",$asal);
    $this->db->limit(1,0);
    $this->db->order_by("iddetail_pembelian_obat","DESC");

    // $this->db->where("stok",0);
    // $this->db->where("unit",$asal);
    return $this->db->get("list_batch");
  }

  public function get_list_stokopname()
  {
    if ($_SESSION['jabatan']=='pumu' || $_SESSION['jabatan']=='pugd') {
      $asal = "UGD";
    }else{
      $asal = "APOTEK";
    }
    $this->db->join("detail_pembelian_obat","detail_pembelian_obat.iddetail_pembelian_obat=stok_opname.id_pengadaan");
    $this->db->where("unit",$asal);
    return $this->db->get("stok_opname");
  }

  public function get_list(){
    if ($_SESSION['jabatan']=='pumu' || $_SESSION['jabatan']=='pugd') {
      $asal = "UGD";
    }else{
      $asal = "APOTEK";
    }
    $data = $this->db
    ->select("stok_opname.*,unit")
    ->group_by("MONTH(stok_opname.tanggal),YEAR(stok_opname.tanggal)")
    ->join("detail_pembelian_obat","detail_pembelian_obat.iddetail_pembelian_obat=stok_opname.id_pengadaan")
    ->where("unit",$asal)
    ->get("stok_opname")->result();
    $bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $respone = array();
    foreach ($data as $value) {
      $pecah = explode("-",$value->tanggal);
      $res = array(
        'waktu' => date("d-m-Y",strtotime($value->tanggal)),
        'tanggal' => $value->tanggal
      );
      array_push($respone,$res);
    }
    return $respone;
  }

  public function get_opname($tanggal){
    $pecah = explode("-",$tanggal);
    if ($_SESSION['jabatan']=='pumu' || $_SESSION['jabatan']=='pugd') {
      $asal = "UGD";
    }else{
      $asal = "APOTEK";
    }
    $data = $this->db
    ->select("stok_opname.obat_idobat,stok_opname.*,SUM(jumlah_komp) as komputer,SUM(jumlah_real) as asli,SUM(jumlah_real)-SUM(jumlah_komp) as selisih")
    ->join("detail_pembelian_obat","detail_pembelian_obat.iddetail_pembelian_obat=stok_opname.id_pengadaan")
    ->group_by("nama")
    ->where("unit",$asal)
    ->get_where("stok_opname",array('MONTH(stok_opname.tanggal)'=>$pecah[1],"YEAR(stok_opname.tanggal)"=>$pecah[0]))->result();
    return $data;
  }

}
