<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelSusut extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    $this->db->join('inventaris','noninven=noinven');
    return $this->db->get_where('susut',array('nilbuku >'=>0))->result();
  }

}
