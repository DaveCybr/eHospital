<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelKelompok");
  }

  function index()
  {
    $data = array(
      'body'      => "Kelompok/list",
      'kelompok'   => $this->ModelKelompok->get_data()
    );
    $this->load->view('index', $data);
  }


}
