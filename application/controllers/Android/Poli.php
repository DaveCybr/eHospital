<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poli extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelTujuanPelayanan");
  }
  function get_poli(){
    $data = $this->ModelTujuanPelayanan->get_data();
    echo json_encode($data);
	}
}
