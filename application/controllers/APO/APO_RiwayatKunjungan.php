<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APO_RiwayatKunjungan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelPeriksa");
    $this->load->model("ModelPasien");
    $this->load->model("ModelKunjungan");
  }

  function riwayat($norm)
  {
    $data = array(
      'status'          => 1,
      'riwayat'            => $this->ModelPeriksa->get_riwayat_kunjungan($norm),
      'body'            => 'APO/Pasien/Riwayat',
      // 'pasien'  => $this->ModelPasien->get_data_edit($norm)->row_array(),
    );
    $this->load->view('APO/Pasien/index',$data);
  }

  function getList($norm)
  {
    $data = array(
      'status'  => 1,
      'data' => $this->ModelPeriksa->get_riwayat_kunjungan($norm),
      // 'pasien'  => $this->ModelPasien->get_data_edit($norm)->row_array(),
    );
    echo json_encode($data);
  }

  public function getRiwayat($nokun)
  {
    $periksa = $this->ModelPeriksa->get_periksa_pasien($nokun);
    $idperiksa = $periksa["idperiksa"];
    $diagnosa = $this->db
    ->join("penyakit","diagnosa.kodesakit=penyakit.kodeicdx")
    ->where("periksa_idperiksa",$idperiksa)
    ->get("diagnosa")->result();

    $resep = $this->db
    ->join("detail_resep","resep.no_resep=detail_resep.resep_no_resep")
    ->join("obat","detail_resep.obat_idobat=obat.idobat")
    ->where("periksa_idperiksa",$idperiksa)
    ->get("resep")->result();

    if ($idperiksa == null || $idperiksa =="") {
      $data = array(
        'status'  => 0,
        'periksa' => $periksa,
        'diagnosa'=> $diagnosa,
        'resep'   => $resep,
      );
      echo json_encode($data);
    }else {
      $data = array(
        'status'  => 1,
        'periksa' => $periksa,
        'diagnosa'=> $diagnosa,
        'resep'   => $resep,
      );
      echo json_encode($data);
    }

  }

}
