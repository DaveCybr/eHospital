<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelDapur extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_kunjungan($nokun)
  {
    $this->db->join('tempat_tidur','kunjungan.tempat_tidur_no_tt=tempat_tidur.no_tt');
    return $this->db->get_where('kunjungan',array('no_urutkunjungan'=>$nokun))->row_array();
  }
  function get_dapur($nokun){
    $this->db->order_by("iddapur",'desc');
    return $this->db->get_where('dapur',array('kunjungan_no_urutkunjungan'=>$nokun));
  }

  function get_hari_ini($nokun,$tgl){
    return $this->db->get_where('dapur',array('kunjungan_no_urutkunjungan'=>$nokun,'DATE(timestamp)'=>$tgl))->num_rows();

  }

}
?>
