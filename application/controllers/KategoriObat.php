<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class KategoriObat extends CI_Controller{

    public $kategori_obat = array();

    public function __construct()
    {
      parent::__construct();
      // $this->load->library(array('ion_auth', 'form_validation'));
      $this->load->helper(array('url', 'language'));
      $this->load->model('ModelKategoriObat');
      $this->kategori_obat = array(
        'kategori_obat'            => $this->input->post('kategori_obat'),
      );
    }

    function index()
    {
      $data = array(
        'body' => 'KategoriObat/list',
        'kategori_obat' => $this->ModelKategoriObat->get_data()
       );
      $this->load->view('index', $data);
    }

    function input()
    {
      $data = array(
        'form' => 'KategoriObat/form',
        'body' => 'KategoriObat/input',
       );
      $this->load->view('index', $data);
    }

    public function insert()
    {
      if ($this->db->insert('kategori_obat', $this->kategori_obat)) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect(base_url().'KategoriObat');
      } else {
        echo "salah";
      }

    }

    public function edit()
    {
      $id = $this->uri->segment(3);
      // die( $this->ModelKategoriObat->get_data_edit($id)->row_array());
      $data = array(
        'form' => 'KategoriObat/form',
        'body' => 'KategoriObat/edit',
        'kategori_obat' => $this->ModelKategoriObat->get_data_edit($id)->row_array()
       );
      $this->load->view('index', $data);
    }

    public function update()
    {
      $idkategori_obat = $this->input->post('idkategori_obat');
      $this->db->where('idkategori_obat',$idkategori_obat);
      if ($this->db->update('kategori_obat', $this->kategori_obat)) {
        redirect(base_url().'KategoriObat');
      } else {
        // code...
      }

    }

    public function delete()
    {
      $id = $this->input->post('id');
      $cek_data = $this->db->where_in('kategori_obat_idkategori_obat	',$id)->get('obat')->num_rows();
      if ($cek_data>0) {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Hapus Data Kategori Obat,Data Master Masih Digunakan!!!!'));
      }else{
        $this->db->where_in('idkategori_obat', $id);
        $delete = $this->db->delete('kategori_obat');
        if ($delete) {
          
            $this->session->set_flashdata('notif', $this->Notif->berhasil()('Berhasil Hapus Data Kategori Obat'));
        }else{
            $this->session->set_flashdata('alert', $this->Notif->gagal('Gagal Hapus Data Kategori Obat'));
        };
      }
      redirect(base_url().'KategoriObat');
    }

  }
