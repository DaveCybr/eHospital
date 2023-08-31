<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiwayatKunjungan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelPeriksa");
  }

  function getList($norm)
  {
    $data = array(
      'riwayat' => $this->ModelPeriksa->get_riwayat_kunjungan($norm),
      'pasien'  => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
    );
    echo json_encode($data);
  }

}
