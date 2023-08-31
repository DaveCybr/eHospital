<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelMbesar extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  function get_data_mbesar()
  {
    return $this->db->get('mbesar')->result();
  }

  function get_data_edit($id)
  {
    $data = $this->db->where('norek_mbesar', $id)->get('mbesar');
    if (!$data->num_rows()>0) {
      $idd = ' '.$id;
      $data = $this->db->where('norek_mbesar', $idd)->get('mbesar');
    }
    return $data;
  }


}
