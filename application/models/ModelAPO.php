<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAPO extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getKunjungan($norm, $tgl = null)
  {
    if ($tgl != null || $tgl != "") {
      $tgl = date("Y-m-d");
    }else {
      $tgl = date("Y-m-d", strtotime($tgl));
    }
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('jenis_pasien', 'kunjungan.sumber_dana = jenis_pasien.kode_jenis',"left");
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->where("tgl", $tgl);
    $this->db->where("pasien_noRM", $norm);
    return $this->db->get('kunjungan');
  }

  public function get_data($tgl){
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('jenis_pasien', 'kunjungan.sumber_dana = jenis_pasien.kode_jenis',"left");
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    return $this->db->get('kunjungan')->result();
  }

  function getStatusDokter($tupel)
  {
    $this->db->join("pegawai","pegawai.NIK = status_dokter.pegawai_NIK");
    $this->db->where("idtupel", $tupel);
    return $this->db->get("status_dokter");
  }

  function getStatusDokterChat($nik)
  {
    $this->db->join("pegawai","pegawai.NIK = status_dokter.pegawai_NIK");
    $this->db->where("pegawai.NIK", $nik);
    return $this->db->get("status_dokter");
  }



}
