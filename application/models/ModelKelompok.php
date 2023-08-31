<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKelompok extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    return $this->db->get('kelompok')->result();
  }

  public function get_data_edit($id){
    return $this->db->get_where('kelompok',array('norek'=>$id));
  }
}
