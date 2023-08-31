<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class PenanggungJawab extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelPegawai');
  }

  public function index(){
    $data = array(
      'body'            => 'PenanggungJawab/index',
      'dokter'       => $this->ModelPegawai->get_dokter(),
      'penanggung_jawab' => $this->db->get("penanggung_jawab")->row_array()

    );
		$this->load->view('index',$data);
  }

  public function update(){
    $nama = $this->input->post("nama");
    $this->db->where("id_penanggungjawab",1);
    $this->db->update("penanggung_jawab",array("nama"=>$nama));
    redirect(base_url()."PenanggungJawab");
  }




}
