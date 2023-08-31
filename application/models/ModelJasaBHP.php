<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelJasaBHP extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data()
  {
    $this->db
    ->group_by("kode_jasa")
    ->select("count(*) as jumlah,kode_jasa,nama")
    ->join('jasa_pelayanan','jasa_pelayanan.kode_jasa=tindakan_bhp.jasa_pelayanan_kode_jasa');
    return $this->db->get_where('tindakan_bhp')->result();
  }
  function get_edit($kode){
    return $this->db
    ->join("obat","obat.idobat=obat_idobat")
    ->get_where("tindakan_bhp",array("jasa_pelayanan_kode_jasa"=>$kode))->result();
  }

}
?>
