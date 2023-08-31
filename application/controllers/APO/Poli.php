<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poli extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelTujuanPelayanan");
  }

  function get_poli()
  {
    echo json_encode($this->ModelTujuanPelayanan->get_data());
  }

}
