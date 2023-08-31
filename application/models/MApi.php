<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MApi extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

public function cek_kunjungan($date,$nourut)
{
  $this->db->where('tgl',$date);
  // $this->db->where('no_urutkunjungan',$nourut);
  return $this->db->get('kunjungan');
}

public function cek_periksa($date,$no_rm)
{
  $this->db->where('tanggal',$date);
  $this->db->where('no_rm',$no_rm);
  return $this->db->get('periksa');
}

}
