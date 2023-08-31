<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class JenisPasien extends CI_Controller{

    public $jenis_pasien = array();

    public function __construct()
    {
      parent::__construct();
      // $this->load->library(array('ion_auth', 'form_validation'));
      $this->load->helper(array('url', 'language'));
      $this->load->model('ModelJenisPasien');
      $this->jenis_pasien = array(

         'jenis_pasien'   => $this->input->post('jenis_pasien'),
      );
    }

    function index()
    {
      $data = array(
        'body' => 'JenisPasien/list',
        'jenis_pasien' => $this->ModelJenisPasien->get_data()
       );
      $this->load->view('index', $data);
    }

    function input()
    {
      $data = array(
        'form' => 'JenisPasien/form',
        'body' => 'JenisPasien/input',
       );
      $this->load->view('index', $data);
    }

    public function insert()
    {
      if ($this->db->insert('jenis_pasien', $this->jenis_pasien)) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect(base_url().'JenisPasien');
      } else {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
        redirect(base_url().'JenisPasien');
      }

    }

    public function edit()
    {
      $id = $this->uri->segment(3);
      // die( $this->ModelJenisPasien->get_data_edit($id)->row_array());
      $data = array(
        'form' => 'JenisPasien/form',
        'body' => 'JenisPasien/edit',
        'jenis_pasien' => $this->ModelJenisPasien->get_data_edit($id)->row_array()
       );
      $this->load->view('index', $data);
    }

    public function update()
    {
      $kode_jenis = $this->input->post('kode_jenis');
      $this->db->where('kode_jenis',$kode_jenis);
      if ($this->db->update('jenis_pasien', $this->jenis_pasien)) {
        redirect(base_url().'JenisPasien');
      } else {
        // code...
      }

    }

    public function delete()
    {
      $id = $this->input->post('id');
      $cek_data = $this->db->where_in('jenis_pasien_kode_jenis',$id)->get('pasien')->num_rows();
      if ($cek_data>0) {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Hapus Data Jenis Pasien,Data Master Masih Digunakan!!!!'));
      }else{
        $this->db->where_in('kode_jenis', $id);
        $delete = $this->db->delete('jenis_pasien');
        if ($delete) {
            $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Jenis Pasien'));
        }else{
            $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Hapus Data Jenis Pasien'));
        };
      }
      redirect(base_url().'JenisPasien');
    }

  }
?>
