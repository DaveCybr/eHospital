<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelTujuanPelayanan extends CI_Model{

  function get_data()
  {
    return $this->db->query("SELECT * FROM `tujuan_pelayanan` WHERE polisakit != 2 ORDER BY tujuan_pelayanan DESC")->result();
  }

  function get_data_all()
  {
    return $this->db->query("SELECT * FROM `tujuan_pelayanan`")->result();
  }

  function get_kdpcare($kode)
  {
    return $this->db->get_where('tujuan_pelayanan',array('kdpcare'=>$kode));
  }

  public function get_data_edit($id){
    return $this->db->get_where('tujuan_pelayanan',array('kode_tupel'=>$id));
  }

  public function get_poli_sakit(){
    return $this->db->get_where("tujuan_pelayanan",array("polisakit"=>1))->result();
  }

  public function get_poli_sehat(){
    return $this->db->get_where("tujuan_pelayanan",array("polisakit"=>0))->result();
  }

  public function get_poli_online($jenis){
    // $this->db->where("kdpcare","999");
    $this->db->or_where("polisakit",$jenis);
    return $this->db->get("tujuan_pelayanan")->result();
  }

  function get_data_pcare(){
    $data_pacare = getSemuaPoliPCare();
    $data_poli = $this->db->get("tujuan_pelayanan")->result();
    $response = array();
    //echo json_encode($data_pacare); die();
    foreach ($data_pacare as $value) {
      $status = 0;
      $pol = $value['poli'];
      foreach($data_poli as $val){
          if ($val->kdpcare==$value["kdpoli"]) {
            $status = 1;
            $pol = $val->tujuan_pelayanan;
            break;
          }
      }
      array_push($response,array(
        'nm' =>strtoupper($value["poli"]),
        'nama_poli' => strtoupper($pol)."  <span class='badge badge-success'> (PCARE)</span>",
        'kode' => $value["kdpoli"],
        'status' => $status,
        'polisakit' => $value["poliSakit"]
      ));
    }
    // echo "<pre>";
    // print_r($response);
    // echo "</pre>";
    // die();
    return $response;
  }


}
