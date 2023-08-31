<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelRuangan");
  }

  function index()
  {
    $data = array(
      'body'      => "Ruangan/list",
      'ruangan'   => $this->ModelRuangan->get_data()
    );
    $this->load->view('index', $data);
  }
  function input()
  {
    $data = array(
      'body'      => "Ruangan/input",
      'form' => 'Ruangan/form',
    );
    $this->load->view('index', $data);
  }

  function insert(){
    $nama_ruangan = $this->input->post('nama');

    $data = array(
      'namaruangan' => $nama_ruangan
    );
    $this->db->insert('ruangan',$data);
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Berhasil input data"));
    redirect(base_url().'Ruangan');
  }

  function edit()
  {
    $id = $this->uri->segment(3);
    $Ruangan = $this->ModelRuangan->get_data_edit($id);
    $data = array(
      'body'        => "Ruangan/edit",
      'form' => "Ruangan/form",
      'ruangan' => $Ruangan
    );
    $this->load->view('index', $data);
  }

    function update()
    {
      $id = $this->input->post('id');
      $data = array(
        'namaruangan'   => $this->input->post('nama'),
      );
      $this->db->where('idruangan', $id);
      $this->db->update('ruangan', $data);
      $this->session->set_flashdata('notif',$this->Notif->berhasil("berhasil update data"));
      redirect(base_url().'Ruangan');
    }

    function delete()
    {
      $id = $this->input->post('id');
      $cek = $this->db->where_in("ruangan_idruangan",$id)->get('inventaris')->num_rows();
      if ($cek>1) {
        $this->session->set_flashdata('notif',$this->Notif->gagal("Tidak dapat mengahapus data"));
        redirect(base_url().'Ruangan');
      }else{
        $this->db->where_in('idruangan', $id);
        $this->db->delete('ruangan');
        $this->session->set_flashdata('notif',$this->Notif->berhasil("Berhasil menghapus data"));
        redirect(base_url().'Ruangan');
      }
    }

}
