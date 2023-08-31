<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAdmisi extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_pengumuman(){
    return $this->db->get("pengumuman")->result();
  }


  public function info_kamar(){
    $data = $this->db
    ->select("tempat_tidur.*,count(*) as jml")
    ->where("status_terisi",0)
    ->where("no_tt !=","21")
    ->where("no_tt !=","22")
    ->where("kelas !=","(tidak ada)")
    ->group_by("kelas")
    ->order_by("kelas","ASC")
    ->get("tempat_tidur")->result();
    $kelas1 = $this->db
    ->where("status_terisi",0)
    ->where("kelas",1)
    ->get("tempat_tidur")->num_rows();

    $kelas2 = $this->db
    ->where("status_terisi",0)
    ->where("kelas",2)
    ->get("tempat_tidur")->num_rows();

    $kelas3 = $this->db
    ->where("status_terisi",0)
    ->where("kelas",3)
    ->get("tempat_tidur")->num_rows();
    // $html = "";
    // if (!empty($data)) {
    //   $html .= "<center><h2>Kamar tersedia</h2></center><br>";
    //   foreach ($data as $value) {
    //     $html .= "<center><h4> Kelas ".$value->kelas." => ".$value->jml." TT</h4></center>";
    //   }
    // }else{
      $html = "<center><h2>Kamar tersedia</h2></center><br>
      <center><h4>Kelas 1 => ".$kelas1." TT</h4></center>
      <center><h4>Kelas 2 => ".$kelas2." TT</h4></center>
      <center><h4>Kelas 3 => ".$kelas3." TT</h4></center>";
    // }
    return $html;

  }
  public function get_antrian($jenis,$status){
    $tanggal = date("Y-m-d");
    return $this->db
    ->group_by("no_antrian")
    ->get_where('antrian_loket',array('tanggal'=>$tanggal,'jenis_kunjungan'=>$jenis,'panggilan'=>$status))->result();
  }
  public function get_data($tgl){
    $this->db->distinct();
    $this->db->group_by("no_urutkunjungan");
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->join('rujukan_internal','kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where('kunjungan',array('kunjungan.sudah <='=>5,'tujuan_poli'=>'RANAP','acc_ranap'=>0))->result();
  }
  public function hit_data($tgl){
    $this->db->distinct();
    $this->db->group_by("no_urutkunjungan");
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->join('rujukan_internal','kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where('kunjungan',array('sudah <='=>5,'tujuan_poli'=>'RANAP','acc_ranap'=>0))->num_rows();
  }

  public function get_data_sudah($tgl){
    $tanggal = date("Y-m-d",strtotime("-14 days"));
    $this->db->distinct();
    $this->db->group_by("kunjungan.no_urutkunjungan");
    $this->db->order_by("kunjungan_no_urutkunjungan","DESC");
    $this->db->join("tempat_tidur","tempat_tidur.no_tt=kunjungan.tempat_tidur_no_tt");
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->join('rujukan_internal','kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where('kunjungan',array('DATE(tgl) >'=>$tanggal,'kunjungan.sudah <'=>5,'tujuan_poli'=>'RANAP','acc_ranap'=>1))->result();
  }
  public function get_data_edit($no_urutkunjungan){
    $this->db->join("rujukan_internal","rujukan_internal.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan");
    return $this->db->get_where('kunjungan',array('no_urutkunjungan' => $no_urutkunjungan ))->row_array();
  }
  public function get_detail($id){
    $this->db->join('pasien','kunjungan.pasien_noRM=pasien.noRM');
    $this->db->get_where('kunjungan',array('no_urutkunjungan'=>$id))->row_array();
  }
  public function get_pasien($id){
    $this->db->join('pasien',"kunjungan.pasien_noRM=pasien.noRM");
    return $this->db->get_where('kunjungan',array('no_urutkunjungan'=>$id))->row_array();
  }
  public function get_kamar(){
    return $this->db->get_where('tempat_tidur',array('status_terisi'=>0))->result();
  }

  public function get_video(){
    return $this->db->get("video_antrian")->result();
  }


}
