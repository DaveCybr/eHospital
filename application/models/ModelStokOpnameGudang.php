<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelStokOpnameGudang extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function list_batch($id_obat)
  {

    $this->db->where("idobat",$id_obat);
    $this->db->where("stok_akhir !=",0);
    $this->db->join("obat","idobat=obat_idobat");
    return $this->db->get("list_batch_gudang");
  }

  public function list_batch_baru($id_obat)
  {
    $this->db->where("idobat",$id_obat);
    $this->db->where("stok_akhir",0);

    $this->db->limit(1,0);
    $this->db->order_by("idgudang_obat","DESC");
    $this->db->join("obat","idobat=obat_idobat");
    return $this->db->get("list_batch_gudang");
  }

  public function get_list_stokopname()
  {
    $this->db->where("unit_obat","GUDANG");
    return $this->db->get("stok_opname");
  }

  public function get_list(){

    $data = $this->db
    ->select("stok_opname.*,unit_obat")

    ->group_by("MONTH(stok_opname.tanggal),YEAR(stok_opname.tanggal)")
    ->where("unit_obat","GUDANG")
    ->get("stok_opname")->result();
    $bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $respone = array();
    // die(var_dump($data));
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
    $data = $this->db
    ->select("idobat,stok_opname.*,SUM(jumlah_komp) as komputer,SUM(jumlah_real) as asli,SUM(jumlah_real)-SUM(jumlah_komp) as selisih")
    ->join("obat","obat.nama_obat=nama")
    ->group_by("nama")
    ->where("unit_obat","GUDANG")
    ->get_where("stok_opname",array('MONTH(stok_opname.tanggal)'=>$pecah[1],"YEAR(stok_opname.tanggal)"=>$pecah[0]))->result();
    return $data;
  }

}
