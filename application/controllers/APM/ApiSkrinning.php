<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiSkrinning extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function simpanSkrinning()
  {
    $dataWhere = array(
      'p1' => $this->input->post("p1"),
      'p2' => $this->input->post("p2"),
      'p3' => $this->input->post("p3"),
      'p4' => $this->input->post("p4"),
      'p5' => $this->input->post("p5"),
      'p6' => $this->input->post("p6"),
      'p7' => $this->input->post("p7"),
    );
    $skrinning = $this->db->get_where("skrinning", $dataWhere)->row_array();
    $data = array(
      'pasien_norm' => $this->input->post("norm"),
      'skrinning_idskrinning' => $skrinning["idskrinning"],
      'waktu'       => date("Y-m-d H:i:s")
     );
    if ($this->db->insert("hasil_skrinning", $data)) {
      $data = array(
        'idskrinning' => $skrinning["idskrinning"],
        'status'      => strtoupper("Resiko ".$skrinning["skor"])
      );
      echo json_encode($data);
    }else {
      echo "0";
    }
  }

}
