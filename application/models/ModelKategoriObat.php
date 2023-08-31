<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKategoriObat extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    return $this->db->get('kategori_obat')->result();
  }

  public function get_data_edit($id){
    return $this->db->get_where('kategori_obat',array('idkategori_obat'=>$id));
  }
}
