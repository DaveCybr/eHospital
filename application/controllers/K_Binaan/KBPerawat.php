<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KBPerawat extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelKBinaan");
    $this->load->model("ModelPegawai");
  }

  

}
