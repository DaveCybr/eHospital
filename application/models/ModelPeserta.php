<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPeserta extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    return $this->db
    ->order_by("id","DESC")
    ->get('jumlah_peserta')->result();
  }

  public function get_data_edit($id){
    return $this->db->get_where('jumlah_peserta',array('idjumlah_peserta'=>$id));
  }
}
