<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laborat extends CI_Controller{

  public $data_supplier = array();

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelLaborat');

    $this->data_laborat = array(
      'nama_kelompok'     => $this->input->post('nama_kelompok'),
      'jenis_lab'         => $this->input->post('jenis_lab'),
      'nilai_normal'      => $this->input->post('nilai_normal'),
      'hrg_1'             => $this->input->post('hrg_1'),
      'hrg_2'             => $this->input->post('hrg_2'),
      'hrg_3'             => $this->input->post('hrg_3'),
      'hrg_4'             => $this->input->post('hrg_4'),
      'hrg_5'             => $this->input->post('hrg_5'),
      'bpjs'              => $this->input->post('bpjs'),
      'jasa_dokter_1'     => $this->input->post('jasa_dokter_1'),
      'jasa_dokter_2'     => $this->input->post('jasa_dokter_2'),
      'jasa_dokter_3'     => $this->input->post('jasa_dokter_3'),
      'jasa_dokter_4'     => $this->input->post('jasa_dokter_4'),
      'jasa_dokter_5'     => $this->input->post('jasa_dokter_5'),
      'jasa_perawat_1'    => $this->input->post('jasa_perawat_1'),
      'jasa_perawat_2'    => $this->input->post('jasa_perawat_2'),
      'jasa_perawat_3'    => $this->input->post('jasa_perawat_3'),
      'jasa_perawat_4'    => $this->input->post('jasa_perawat_4'),
      'jasa_perawat_5'    => $this->input->post('jasa_perawat_5'),
      'jasa_resepsionis_1'=> $this->input->post('jasa_resepsionis_1'),
      'jasa_resepsionis_2'=> $this->input->post('jasa_resepsionis_2'),
      'jasa_resepsionis_3'=> $this->input->post('jasa_resepsionis_3'),
      'jasa_resepsionis_4'=> $this->input->post('jasa_resepsionis_4'),
      'jasa_resepsionis_5'=> $this->input->post('jasa_resepsionis_5'),
      'jasa_analis_1'     => $this->input->post('jasa_analis_1'),
      'jasa_analis_2'     => $this->input->post('jasa_analis_2'),
      'jasa_analis_3'     => $this->input->post('jasa_analis_3'),
      'jasa_analis_4'     => $this->input->post('jasa_analis_4'),
      'jasa_analis_5'     => $this->input->post('jasa_analis_5'),
      'jasa_ob_1'         => $this->input->post('jasa_ob_1'),
      'jasa_ob_2'         => $this->input->post('jasa_ob_2'),
      'jasa_ob_3'         => $this->input->post('jasa_ob_3'),
      'jasa_ob_4'         => $this->input->post('jasa_ob_4'),
      'jasa_ob_5'         => $this->input->post('jasa_ob_5'),
      'jasa_admin_1'      => $this->input->post('jasa_admin_1'),
      'jasa_admin_2'      => $this->input->post('jasa_admin_2'),
      'jasa_admin_3'      => $this->input->post('jasa_admin_3'),
      'jasa_admin_4'      => $this->input->post('jasa_admin_4'),
      'jasa_admin_5'      => $this->input->post('jasa_admin_5'),
    );
  }

  function index()
  {
    $data = array(
      'body'  => 'Laborat/list',
      'laborat'=> $this->ModelLaborat->get_data()
     );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'form' => 'Laborat/form',
      'body' => 'Laborat/input',
     );
    $this->load->view('index', $data);
  }

  function edit()
  {
    $kode = $this->uri->segment(3);
    $data = array(
      'form' => 'Laborat/form',
      'body' => 'Laborat/edit',
      'laborat' => $this->ModelLaborat->get_data_edit($kode)
     );
    $this->load->view('index', $data);
  }

  function insert()
  {
    $this->data_laborat['kode_lab'] = $this->input->post('kode_lab');
    if ($this->db->insert('laborat', $this->data_laborat)) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect(base_url().'Laborat');
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      redirect(base_url().'Laborat');
    }
  }

  function update()
  {
    $this->db->where('kode_lab', $this->input->post('kode_lab'));
    if ($this->db->update('laborat', $this->data_laborat)) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect(base_url().'Laborat');
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      redirect(base_url().'Laborat');
    }
  }

  function delete()
  {
    $id = $this->input->post('id');
    $this->db->where_in('kode_lab', $id);
    $delete = $this->db->delete('laborat');
    if ($delete == true) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Pegawai'));
    }else{
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Pegawai, Data masih Terrelasi!!!'));
    };
    redirect(base_url().'Laborat');
  }

}
