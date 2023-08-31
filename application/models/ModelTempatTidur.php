<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelTempatTidur extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data()
  {
    return $this->db->get_where('tempat_tidur',array("hapus !="=>1))->result();
  }

  function get_data_edit($id)
  {
    return $this->db->get_where('tempat_tidur', array('no_tt' => $id , ))->row_array();
  }

}
