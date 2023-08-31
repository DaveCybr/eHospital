<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class JenisObat extends CI_Controller{

    public $jenis_obat = array();

    public function __construct()
    {
      parent::__construct();
      // $this->load->library(array('ion_auth', 'form_validation'));
      $this->load->helper(array('url', 'language'));
      $this->load->model('ModelJenisObat');
      $this->jenis_obat = array(
        'jenis_obat'            => $this->input->post('jenis_obat'),
      );
    }

    function index()
    {
      $data = array(
        'body' => 'JenisObat/list',
        'jenis_obat' => $this->ModelJenisObat->get_data()
       );
      $this->load->view('index', $data);
    }

    function input()
    {
      $data = array(
        'form' => 'JenisObat/form',
        'body' => 'JenisObat/input',
       );
      $this->load->view('index', $data);
    }

    public function insert()
    {
      if ($this->db->insert('jenis_obat', $this->jenis_obat)) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect(base_url().'JenisObat');
      } else {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
        redirect(base_url().'JenisObat');
      }

    }

    public function edit()
    {
      $id = $this->uri->segment(3);
      // die( $this->ModelJenisObat->get_data_edit($id)->row_array());
      $data = array(
        'form' => 'JenisObat/form',
        'body' => 'JenisObat/edit',
        'jenis_obat' => $this->ModelJenisObat->get_data_edit($id)->row_array()
       );
      $this->load->view('index', $data);
    }

    public function update()
    {
      $idjenis_obat = $this->input->post('idjenis_obat');
      $this->db->where('idjenis_obat',$idjenis_obat);
      $berhasil = $this->db->update('jenis_obat', $this->jenis_obat);
      if ($berhasil) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Update data Jenis Obat'));
        redirect(base_url().'JenisObat');
      } else {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Update data Jenis Obat'));
        redirect(base_url().'JenisObat');
      }

    }

    public function delete()
    {
      $id = $this->input->post('id');
      $cek_data = $this->db->where_in('jenis_obat_idjenis_obat	',$id)->get('obat')->num_rows();
      if ($cek_data>0) {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Hapus Data Jenis Obat,Data Master Masih Digunakan!!!!'));
      }else{
        $this->db->where_in('idjenis_obat', $id);
        $delete = $this->db->delete('jenis_obat');
        if ($delete) {
            $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Jenis Obat'));
        }else{
            $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Hapus Data Jenis Obat'));
        };
      }
      redirect(base_url().'JenisObat');
    }

  }
?>
