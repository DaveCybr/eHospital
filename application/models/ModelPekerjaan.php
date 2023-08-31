<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPekerjaan extends CI_Model{

  function get_data()
  {
    return $this->db->get('pekerjaan')->result();
  }
  function get_provinsi()
  {
    return $this->db->get('provinsi')->result();
  }
  function get_kota($provinsi)
  {
    return $this->db
    // ->join("provinsi","provinsi.idprovinsi=kota.provinsi_idprovinsi")
    ->get_where('kota',array("provinsi_idprovinsi"=>$provinsi))->result();
  }
  function get_data_edit($kode)
  {
    return $this->db->get_where('pekerjaan', array('idpekerjaan' => $kode , ))->row_array();
  }

}
