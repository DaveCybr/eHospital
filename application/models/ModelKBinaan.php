<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKBinaan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getDokter($iddokter = null)
  {
    $this->db->join("pegawai", "pegawai.NIK = kb_dokter.pegawai_NIK");
    if ($iddokter != null || $iddokter != "") {
      $this->db->where("pegawai_NIK", $iddokter);
    }
    return $this->db->get("kb_dokter");
  }
  public function getDokterPJ($iddokter = null)
  {
    $this->db->join("pegawai", "pegawai.NIK = kb_dokter.pegawai_NIK");
    if ($iddokter != null || $iddokter != "") {
      $this->db->where("idkb_dokter", $iddokter);
    }
    return $this->db->get("kb_dokter");
  }

  public function getPerawat($iddokter = null, $idperawat = null)
  {
    $this->db->join("pegawai", "pegawai.NIK = kb_perawat.pegawai_NIK");
    if ($idperawat != null || $idperawat != "") {
      $this->db->where("pegawai_NIK", $idperawat);
    }
    if ($iddokter != null || $iddokter != "") {
      $this->db->where("kb_dokter_idkb_dokter", $iddokter);
    }
    return $this->db->get("kb_perawat");
  }

  public function getPerawatPJ($idperawat = null)
  {
    $this->db->join("pegawai", "pegawai.NIK = kb_perawat.pegawai_NIK");
    if ($idperawat != null || $idperawat != "") {
      $this->db->where("idkb_perawat", $idperawat);
    }
    return $this->db->get("kb_perawat");
  }

  public function getKeluarga($idkeluarga = null, $idperawat = null)
  {
    $this->db->join("pasien", "pasien.noRM = pasien_binaan.pasien_noRM");
    if ($idkeluarga != null || $idkeluarga != "") {
      $this->db->where("pasien_noRM", $idkeluarga);
    }
    if ($idperawat != null || $idperawat != "") {
      $this->db->where("kb_perawat_idkb_perawat", $idperawat);
    }
    return $this->db->get("pasien_binaan");
  }

  public function getPasien($norm)
  {
    $this->db->where("noRM", $norm);
    return $this->db->get("pasien");
  }

  public function getKunjungan($norm, $tgl=null)
  {
    $this->db->join("pasien_binaan","kb_kunjungan.pasien_binaan_idpasien_binaan = pasien_binaan.idpasien_binaan");
    if ($tgl == null || $tgl == "") {
      $tgl = date("Y-m");
    }
    $this->db->where("LEFT(tanggal, 7) =", date("Y-m", strtotime($tgl)));
    $this->db->where("pasien_binaan.pasien_noRM", $norm);
    return $this->db->get("kb_kunjungan");
  }

  public function getPeriksa($norm, $tgl=null)
  {
    $this->db->join("pasien","kunjungan.pasien_noRM=pasien.noRM");
    $this->db->where("pasien.noRM", $norm);
    $this->db->where("kunjungan.tgl", $tgl);
    return $this->db->get("kunjungan");
  }

  public function getAllKunjungan($tgl=null, $idperawat=null)
  {
    $this->db->select("kb_kunjungan.*, pasien_binaan.*");
    $this->db->join("pasien_binaan","kb_kunjungan.pasien_binaan_idpasien_binaan = pasien_binaan.idpasien_binaan");
    $this->db->join("kb_perawat","kb_perawat.idkb_perawat = pasien_binaan.kb_perawat_idkb_perawat");
    if ($tgl == null || $tgl == "") {
      $tgl = date("Y-m");
    }
    if ($idperawat != null || $idperawat != "") {
      $this->db->where("kb_perawat.pegawai_NIK", $idperawat);
    }
    $this->db->where("LEFT(tanggal, 7) =", date("Y-m", strtotime($tgl)));
    return $this->db->get("kb_kunjungan");
  }

  public function kunjunganAkhir($norm)
  {
    $this->db->join("periksa", "kunjungan.no_urutkunjungan = periksa.kunjungan_no_urutkunjungan");
    $this->db->where("pasien_noRM", $norm);
    $this->db->limit(1);
    $this->db->order_by("tgl","DESC");
    return $this->db->get("kunjungan");
  }

  public function cekPasien($norm)
  {
    $this->db->where("pasien_noRM", $norm);
    return $this->db->get("pasien_binaan");
  }

  public function getAnggotaKeluarga($normKK)
  {
    $this->db->join("pasien", "pasien.noRM = pasien_binaan.pasien_noRM");
    $this->db->where("pasien_binaan.norm_kk", $normKK);
    return $this->db->get("pasien_binaan");
  }

  function get_riwayat_penyakit($no_rm){
    $this->db->join('penyakit','diagnosa.kodesakit=penyakit.kodeicdx');
    $this->db->where('pasien_noRM', $no_rm);
    $this->db->group_by("kodeicdx");
    return $this->db->get_where('diagnosa')->result();
  }

  function get_riwayat_dm($no_rm){
    $this->db->join('penyakit','diagnosa.kodesakit=penyakit.kodeicdx');
    $this->db->where('pasien_noRM', $no_rm);
    $this->db->like('kodeicdx', "E11");
    return $this->db->get_where('diagnosa');
  }

  function get_riwayat_ht($no_rm){
    $this->db->join('penyakit','diagnosa.kodesakit=penyakit.kodeicdx');
    $this->db->where('pasien_noRM', $no_rm);
    $this->db->group_start();
    $this->db->where('kodeicdx', "I11");
    $this->db->or_where('kodeicdx', "I10");
    $this->db->group_end();
    return $this->db->get_where('diagnosa');
  }

}
