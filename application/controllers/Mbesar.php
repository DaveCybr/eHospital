<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbesar extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelMbesar');

    $this->load->model('ModelKelompok');
  }

  function index()
  {
    $data = array(
      'body'      => "Mbesar/list",
      'buku_besar'   => $this->ModelMbesar->get_data_mbesar()
    );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'body'      => "Mbesar/input",
      'form' => 'Mbesar/form',
      'kelompok' => $this->ModelKelompok->get_data()
    );
    $this->load->view('index', $data);
  }

  function insert(){
    $id_kel = $this->input->post('norek');
    $nama_kel = $this->input->post('nama_rek');
    $hit = $this->db->get_where("kelompok",array('norek'=>$id_kel))->num_rows();
    if($hit>0){
      $this->session->set_flashdata('notif',$this->Notif->gagal("Nomor rekening telah ada"));
      redirect(base_url().'Mbesar');
    }
    $data = array(
      'norek_mbesar' => $id_kel,
      'namarek' => $nama_kel,
      'posisi' => $this->input->post('rugi_laba'),
      'posneraca' => $this->input->post('pos'),
    );
    $this->db->insert('mbesar',$data);
    redirect(base_url().'Mbesar');
  }

  function edit()
  {
    $id = $this->uri->segment(3);
    $mbesar = $this->ModelMbesar->get_data_edit($id)->row_array();
    // die(var_dump($mbesar));
    $data = array(
      'body'        => "Mbesar/edit",
      'form' => "Mbesar/form_edit",
      'mbesar' => $mbesar,
      'kelompok' => $this->ModelKelompok->get_data()
    );
    $this->load->view('index', $data);
  }

    function update()
    {
      $id = $this->input->post('norek');
      $data = array(
        'namarek'   => $this->input->post('nama_rek'),
        'posisi' => $this->input->post('rugi_laba'),
        'posneraca' => $this->input->post('pos')
      );
      $this->db->where('norek_mbesar', $id);
      $this->db->update('mbesar', $data);
      $this->session->set_flashdata('notif',$this->Notif->berhasil("Berhasil update data"));
      redirect(base_url().'Mbesar');
    }

    function delete()
    {
      $id = $this->input->post('id');
      $this->db->where_in('norek', $id);
      $this->db->delete('kelompok');
      redirect(base_url().'Kejur');
    }
    //
    // function update_rm(){
    //   $data = $this->db->get("pasien")->result();
    //   foreach ($data as $value) {
    //     $baru = "00".$value->noRM;
    //     $ins = array(
    //       'no_rm_baru' => $baru
    //     );
    //     $rm = $value->noRM;
    //     $this->db->where('noRM',$rm);
    //     $this->db->update('pasien',$ins);
    //   }
    // }
    // function update_rm_baru(){
    //   $data = $this->db->limit(5000,1000)->get("pasien")->result();
    //   foreach ($data as $value) {
    //     $baru = $value->no_rm_baru;
    //     $ins = array(
    //       'noRM' => $baru
    //     );
    //     $rm = $value->no_rm_baru;
    //     $this->db->where('no_rm_baru',$rm);
    //     $this->db->update('pasien',$ins);
    //   }
    // }
    // function Mbesar_harian(){
    //   $data = array(
    //     'body'      => "Mbesar/harian/list",
    //     'Mbesar' => $this->ModelMbesar->get_data()
    //   );
    //   $this->load->view('index', $data);
    //
    // }
    // function harian_input(){
    //   $data = array(
    //     'body'      => "Mbesar/harian/input",
    //     'form' => 'Mbesar/harian/form',
    //     // 'kelompok' => $this->ModelKelompok->get_data()
    //   );
    //   $this->load->view('index', $data);
    //
    // }

}
