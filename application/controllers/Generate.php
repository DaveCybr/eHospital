<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function index()
  {
    echo "generate";
  }

  function obat()
  {
    $obat = $this->db->get('obat')->result();
    foreach ($obat as $value) {
      $this->db->where('idobat', $value->idobat);
      $this->db->update('obat', array('stok' => '1000', 'stok_berjalan'=>'1000' ));
    }
  }

}
