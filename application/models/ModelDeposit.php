<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelDeposit extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_kunjungan()
  {
    $this->db->order_by("no_urutkunjungan","DESC");
    $this->db->join("pasien","pasien.noRM=kunjungan.pasien_noRM");
    $this->db->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel");
    return $this->db->get_where('kunjungan',array('tgl'=>date("Y-m-d")))->result();
  }

  function get_data($tanggal)
  {
    $this->db->order_by("no_urutkunjungan","DESC");
    $this->db->join("pasien","pasien.noRM=kunjungan.pasien_noRM");
    $this->db->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel");
    return $this->db->get_where('kunjungan',array('tgl'=>$tanggal))->result();
  }

}
?>
