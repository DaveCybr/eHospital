<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiPasien extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function CekBpjs()
  {
    // $bpjs = "0001534292818";
    $bpjs = $this->input->post("BPJS");
    echo $bridge = PCare("peserta/".$bpjs,"GET");
  }

  function getJenis()
  {
    echo json_encode($this->db->get("jenis_pasien")->result());
  }

  function CekPasien()
  {
    $kode = $this->input->post("kode");
    $this->db->where("noRM", $kode);
    $this->db->or_where('noBPJS', $kode);
    $pasien = $this->db->get("pasien");
    $data["jumlah"] = $pasien->num_rows();
    if ($pasien->num_rows() > 0) {
      $data["pesan"]  = "Pasien Ditemukan";
      $data["norm"]   = $pasien->row_array()["noRM"];
    }else {
      $data["pesan"] = "No.BPJS atau No. Rekam Medis Tidak Ditemukan";
    }
    echo json_encode($data);
  }

  function getPasien()
  {
    $kode = $this->input->post("norm");
    $this->db->where("noRM", $kode);
    $this->db->join("jenis_pasien","jenis_pasien.kode_jenis = pasien.jenis_pasien_kode_jenis");
    $pasien = $this->db->get("pasien");
    $data["jml"] = $pasien->num_rows();
    if ($data["jml"] > 0) {
      $data["pesan"] = "Data Ditemukan";
    }else {
      $data["pesan"] = "Data Pasien Tidak Ditemukan, Mohon Hubungi Resepsionis. Terimakasih";
    }
    $data["data"] = $pasien->row_array();
    $data["data"]["tanggal_lahir"] = date("d-m-Y", strtotime($data["data"]["tgl_lahir"]));
    echo json_encode($data);
  }
}
