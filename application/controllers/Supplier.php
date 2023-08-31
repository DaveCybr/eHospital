<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller{

  public $data_supplier = array();

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelSupplier');

    $this->data_supplier = array(
      'nama'    => $this->input->post('nama'),
      'alamat'  => $this->input->post('alamat'),
      'kota'    => $this->input->post('kota'),
      'telepon' => $this->input->post('telepon')
    );
  }

  function index()
  {
    $data = array(
      'body'  => 'Supplier/list',
      'supplier'=> $this->ModelSupplier->get_data()
     );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'form' => 'Supplier/form',
      'body' => 'Supplier/input',
      'kode_sup' => $this->ModelSupplier->generete_kodesup(),
     );
    $this->load->view('index', $data);
  }

  function edit()
  {
    $kode = $this->uri->segment(3);
    $data = array(
      'form' => 'Supplier/form',
      'body' => 'Supplier/update',
      'supplier' => $this->ModelSupplier->get_data_edit($kode)
     );
    $this->load->view('index', $data);
  }

  function insert()
  {
    $this->data_supplier['kode_sup'] = $this->input->post('kode_sup');
    if ($this->db->insert('supplier', $this->data_supplier)) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect('Supplier');
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
    }
  }

  function update()
  {
    $this->db->where('kode_sup', $this->input->post('kode_sup'));
    if ($this->db->update('supplier', $this->data_supplier)) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect('Supplier');
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
    }
  }

  function delete()
  {
    $id = $this->input->post('id');
    $this->db->where_in('kode_sup', $id);
    $delete = $this->db->delete('supplier');
    if ($delete == true) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Pegawai'));
    }else{
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Pegawai, Data masih Terrelasi!!!'));
    };
    redirect('Supplier');
  }

}
