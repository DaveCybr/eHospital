<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelStokApotek extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data(){
  return $this->db->get('permintaan_unit')->result();
  }

}
