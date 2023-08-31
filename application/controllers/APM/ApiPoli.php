<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiPoli extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_poli()
  {
    $this->db->order_by("kdpcare","ASC");
    echo json_encode($this->db->get_where("tujuan_pelayanan",array('polisakit' => 1 ))->result());
  }

}
