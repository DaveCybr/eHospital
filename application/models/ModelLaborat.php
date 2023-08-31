<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLaborat extends CI_Model{

  function get_data()
  {
    return $this->db->get('laborat')->result();
  }

  function get_data_edit($kode)
  {
    return $this->db->get_where('laborat', array('kode_lab' => $kode , ))->row_array();
  }

  function get_datasub($kode)
  {
    if (strlen($kode)==2) {
      $cek = $this->db
      ->like('kode_lab', $kode,'after')
      ->where('hrg_1',0)->get('laborat');
      if ($cek->num_rows() > 1) {
        return $cek;
      }else{
        return $this->db
        ->like('kode_lab', $kode,'after')
        ->get('laborat');
      }
    }else{
      $data_lab = $this->db->get_where('laborat',array('kode_lab'=>$kode))->row_array();
      if ($data_lab['hrg_1']==0) {
        $kode = substr($kode,0,2);
        $this->db->like('kode_lab', $kode,'after');
        $this->db->where('hrg_1',0);
        return $this->db->get('laborat');
      }else{
        $data = $this->db->get_where('laborat',array('kode_lab'=>substr($kode,0,2)))->num_rows();
        if ($data > 1) {
          $kode = substr($kode,0,2);
          $this->db->like('kode_lab', $kode,'after');
          // $this->db->where('hrg_1',0);
          return $this->db->get('laborat');
        }else{
          $this->db->like('kode_lab', $kode,'after');
          return $this->db->get('laborat');
        }
      }
    }

  }

  function get_data_type()
  {
    $sql = "SELECT kode_lab, jenis_lab, LENGTH(kode_lab) as type FROM `laborat`";
    return $this->db->query($sql);
  }
  function get_permintaan($id_periksa){
    $datakun = $this->db->get_where('labkunjungan',array('periksa_idperiksa'=>$id_periksa))->row_array();
    // die(var_dump($datakun));
    return $this->db->where_in('nourutlab',$datakun['nokunjlab'])->get('detaillab')->result();
  }

}
