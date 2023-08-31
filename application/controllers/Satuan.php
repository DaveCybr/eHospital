<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Satuan extends CI_Controller{

    public $satuan = array();

    public function __construct()
    {
      parent::__construct();

      $this->load->model('ModelSatuan');

      $this->satuan = array(
         'nama_satuan'  => $this->input->post('nama_satuan'),
      );
    }

    function index()
    {
      $data = array(
        'body' => 'Satuan/list',
        'satuan' => $this->ModelSatuan->get_data()
       );
      $this->load->view('index', $data);
    }

    function input()
    {
      $data = array(
        'form' => 'Satuan/form',
        'body' => 'Satuan/input',
       );
      $this->load->view('index', $data);
    }

    public function insert()
    {
      if ($this->db->insert('satuan', array('nama_satuan'  => $this->input->post('nama_satuan'),))) {
        $this->session->set_flashdata('Notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        redirect('Satuan');
      } else {
        echo "salah";
      }

    }

    public function edit()
    {
      $id = $this->uri->segment(3);
      // die( $this->ModelJenisPasien->get_data_edit($id)->row_array());
      $data = array(
        'form' => 'Satuan/form',
        'body' => 'Satuan/edit',
        'satuan' => $this->ModelSatuan->get_data_edit($id)->row_array()
       );
      $this->load->view('index', $data);
    }

    public function update()
    {
      $idsatuan = $this->input->post('idsatuan');
      $this->db->where('idsatuan',$idsatuan);
      if ($this->db->update('satuan', $this->satuan)) {
        redirect('Satuan');
      } else {
        // code...
      }

    }

    public function delete()
    {
      $id = $this->input->post('id');
      $this->db->where_in('idsatuan', $id);
      $delete = $this->db->delete('satuan');
      if ($delete == true) {
          $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Satuan'));
      }else{
          $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Satuan'));
      };
      redirect('Satuan');
      }


  }
?>
