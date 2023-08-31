<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Peserta extends CI_Controller{

    public $jumlah_peserta = array();

    public function __construct()
    {
      parent::__construct();

      $this->load->model('ModelPeserta');

      $this->jumlah_peserta = array(
         'nama_jumlah_peserta'  => $this->input->post('nama_jumlah_peserta'),
      );
    }

    function index()
    {
      $data = array(
        'body' => 'Peserta/list',
        'jumlah_peserta' => $this->ModelPeserta->get_data()
       );
      $this->load->view('index', $data);
    }

    function input()
    {
      $data = array(
        'form' => 'Peserta/form',
        'body' => 'Peserta/input',
       );
      $this->load->view('index', $data);
    }

    public function insert()
    {
      if ($this->db->insert('jumlah_peserta', array('tanggal'  => $this->input->post('tanggal'),'jumlah'  => $this->input->post('jumlah'),))) {
        $this->session->set_flashdata('Notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        redirect('Peserta');
      } else {
        echo "salah";
      }

    }

    public function edit()
    {
      $id = $this->uri->segment(3);
      // die( $this->ModelJenisPasien->get_data_edit($id)->row_array());
      $data = array(
        'form' => 'Peserta/form',
        'body' => 'Peserta/edit',
        'jumlah_peserta' => $this->ModelPeserta->get_data_edit($id)->row_array()
       );
      $this->load->view('index', $data);
    }

    public function update()
    {
      $idjumlah_peserta = $this->input->post('idjumlah_peserta');
      $this->db->where('idjumlah_peserta',$idjumlah_peserta);
      if ($this->db->update('jumlah_peserta', $this->jumlah_peserta)) {
        redirect('Peserta');
      } else {
        // code...
      }

    }

    public function delete()
    {
      $id = $this->input->post('id');
      $this->db->where_in('id', $id);
      $delete = $this->db->delete('jumlah_peserta');
      if ($delete == true) {
          $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Peserta'));
      }else{
          $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Peserta'));
      };
      redirect('Peserta');
      }


  }
?>
