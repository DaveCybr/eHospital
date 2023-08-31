<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelRuangan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data()
  {
    return $this->db->get('ruangan')->result();
  }

  function get_data_edit($id){
    return $this->db->get_where('ruangan',array('idruangan'=>$id))->row_array();
  }
}
?>
