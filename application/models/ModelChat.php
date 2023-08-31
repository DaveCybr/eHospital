<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelChat extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getKonsul($norm, $no_urutkunjungan = null)
  {
    if ($no_urutkunjungan != null || $no_urutkunjungan != '') {
      $this->db->where("no_kunjungan", $no_urutkunjungan);
    }
    $this->db->where("pasien_noRM", $norm);
    $this->db->order_by('waktu', 'ASC');
    return $this->db->get('chat_konsul');
  }

  public function getKonsulRiwayat($norm)
  {
    $this->db->where("pasien_noRM", $norm);
    $this->db->group_by('no_kunjungan');
    $this->db->order_by('waktu', 'ASC');
    return $this->db->get('chat_konsul');
  }

  public function getChatBaca($norm,$status)
  {
    $this->db->where("pasien_noRM", $norm);
    $this->db->where("status_baca", $status);
    $this->db->where("pegawai_NIK", "0");
    $this->db->order_by('waktu', 'ASC');
    return $this->db->get('chat_konsul');
  }

}
