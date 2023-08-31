<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelRiwayatAlergi extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data($pasien)
  {
    $this->db->where('pasien_noRM',$pasien);
    return $this->db->get('riwayat_alergi');
  }

  function get_data_edit($pasien, $idriwayatalergi)
  {
    $this->db->where('idriwayat_alergi', $idriwayatalergi);
    $this->db->where('pasien_noRM',$pasien);
    return $this->db->get('riwayat_alergi');
  }


}
