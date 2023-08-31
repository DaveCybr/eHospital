<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelJabatan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data()
  {
    return $this->db->get('jabatan');
  }

  function get_data_edit($id)
  {
    $this->db->where('idjabatan', $id);
    return $this->db->get('jabatan');
  }

}
