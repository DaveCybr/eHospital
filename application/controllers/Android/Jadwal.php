<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Android/ModelJadwal");
  }
  function jadwal_dokter(){
    $tanggal = $this->input->post("tanggal");
    // $tanggal = "27-01-2020";
    $tanggal = date("Y-m-d",strtotime($tanggal));
    $tanggal = date("D",strtotime($tanggal));
    $data = $this->ModelJadwal->get_jadwal($tanggal);
    // echo "<pre>";
    // print_r(array("data"$data));
    // echo "</pre>";
    echo json_encode(array("data"=>$data));
	}

  function get_kamar(){
    $data = $this->ModelJadwal->get_kamar();
    echo json_encode($data);
  }

  function get_operasi(){
    $data = $this->ModelJadwal->get_operasi();
    echo json_encode($data);
  }

  function get_slot(){
    $jam = substr($this->input->post("jam"),0,5);
    $interval = 2;
    $tanggal = $this->input->post("tanggal");
    // $tanggal = "2020-01-31";
    $tanggal = date("Y-m-d",strtotime($tanggal));
    $dokter = $this->input->post("NIK");
    $data = $this->ModelJadwal->get_slot($dokter,$tanggal,$jam,$interval);
    echo json_encode($data);
  }




}
