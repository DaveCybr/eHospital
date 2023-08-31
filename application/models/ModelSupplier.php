<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelSupplier extends CI_Model{

  function get_data()
  {
    return $this->db->get('supplier')->result();
  }

  function get_data_edit($kode)
  {
    return $this->db->get_where('supplier', array('kode_sup' => $kode , ))->row_array();
  }

  public function generete_kodesup(){
    $get_data = $this->db->select_max("kode_sup")->get('supplier')->row_array();
    if($get_data){
      $kd = (int) $get_data['kode_sup'];
      $kd = $kd+1;
      $kode_sup = str_pad($kd,3,"0",STR_PAD_LEFT);
    }else{
      $kode_sup = "001";
    }
    return $kode_sup;
  }

}
