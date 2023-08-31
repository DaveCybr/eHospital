<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelDemografi extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  function get_tt($id){
    return $this->db->get_where("timbang_terima",array("id_timbangterima"=>$id))->row_array();
  }
  function get_pasien($nokun){
    return $this->db
    ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
    ->get_where("kunjungan",array("no_urutkunjungan"=>$nokun));
  }

  function get_demografi($noRM)
  {
    $this->db->where(array('pasien_noRM' => $noRM, ));
    return $this->db->get('demografi');
  }

  function get_asesmen_kunjungan($kunjungan)
  {
    $this->db->where(array('kunjungan_no_urutkunjungan' => $kunjungan, ));
    return $this->db->get('demografi');
  }

  function get_asesmen_igd_kunjungan($kunjungan)
  {
    $this->db->where(array('kunjungan_no_urutkunjungan' => $kunjungan, ));
    return $this->db->get('asesmen_igd');
  }

  function getObservasiLanjutan($kunjungan)
  {
    $this->db->where("kunjungan_no_urutkunjungan",$kunjungan);
    return $this->db->get("observasi");
  }

  function getAsesmenIGD($kunjungan)
  {
    $this->db->where("kunjungan_no_urutkunjungan",$kunjungan);
    $this->db->order_by("idasesmen_igd", "DESC");
    return $this->db->get("asesmen_igd");
  }

}
