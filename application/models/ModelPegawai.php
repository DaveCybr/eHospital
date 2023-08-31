<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPegawai extends CI_Model{

  public function __construct()
  {
    parent::__construct();


  }

  public function get_data(){
    return $this->db->get('pegawai')->result();
  }
  public function get_dokter(){
    return $this->db
    ->like("jabatan","DOKTER","both")
    ->get('pegawai')->result();
  }

  public function get_data_edit($nik)
  {
    return $this->db->get_where('pegawai', array('NIK' => $nik))->row_array();
  }
  public function get_jadwal(){
    $this->db->join("pegawai","pegawai_NIK=NIK");
    return $this->db->get("jadwal")->result();
  }
  public function get_jadwal_1(){
    $time = date("H:i:s");
    $this->db->join("pegawai","pegawai_NIK=NIK");
    return $this->db->get_where("jadwal",array("TIME(jam_mulai) <="=>$time,'TIME(jam_akhir) >='=>$time))->result();
  }
  public function get_data_dokter(){
    $this->db->like('jabatan',"DOKTER","both");
    return $this->db->get('pegawai')->result();
  }

}
