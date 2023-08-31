<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kejur extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelKelompok");
  }

  function index()
  {
    $data = array(
      'body'      => "Kelompok/list",
      'kelompok'   => $this->ModelKelompok->get_data()
    );
    $this->load->view('index', $data);
  }
  function input()
  {
    $data = array(
      'body'      => "Kelompok/input",
      'form' => 'Kelompok/form'
    );
    $this->load->view('index', $data);
  }

  function insert(){
    $id_kel = $this->input->post('norek');
    $nama_kel = $this->input->post('nama_kel');
    $hit = $this->db->get_where("kelompok",array('norek'=>$id_kel))->num_rows();
    if($hit>0){
      redirect(base_url().'Kejur');
    }
    $data = array(
      'norek' => $id_kel,
      'namakel' => $nama_kel
    );
    $this->db->insert('kelompok',$data);
    redirect(base_url().'Kejur');
  }

  function edit()
  {
    $id = $this->uri->segment(3);
    $kelompok = $this->ModelKelompok->get_data_edit($id)->row_array();
    $data = array(
      'body'        => "Kelompok/edit",
      'form' => "Kelompok/form",
      'kelompok' => $kelompok
    );
    $this->load->view('index', $data);
  }

    function update()
    {
      $id = $this->input->post('norek');
      $data = array(
        'namakel'   => $this->input->post('nama_kel'),
      );
      $this->db->where('norek', $id);
      $this->db->update('kelompok', $data);
      redirect(base_url().'Kejur');
    }

    function delete()
    {
      $id = $this->input->post('id');
      $this->db->where_in('norek', $id);
      $this->db->delete('kelompok');
      redirect(base_url().'Kejur');
    }

}
