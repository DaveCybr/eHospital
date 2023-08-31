<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelRekap");
  }

  public function index(){
    $data = array(
      'body'            => 'Rekap/list',
    );
		$this->load->view('index',$data);
  }

  public function get_data()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    // $till = "2019-07-25";
    // $from = "2019-07-24";
    $data = $this->ModelRekap->get_data($from,$till);
    echo json_encode($data);
  }


}
?>
