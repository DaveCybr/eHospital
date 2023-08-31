<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TujuanPelayanan extends CI_Controller {

  private $tupel = array();

  public function __construct()
  {
    parent::__construct();

    $this->load->model('ModelTujuanPelayanan');

    $this->tupel = array(
      'kode_tupel' => $this->input->post('kode'),
      'kd_antrian' => $this->input->post('kd_antrian'),
      'tujuan_pelayanan' => $this->input->post('tujuan_pelayanan'),
      'polisakit' => $this->input->post('polisakit'),

    );
  }

	public function index()
	{

    $data = array(
      'body' => 'TujuanPelayanan/list',
      'tujuan_pelayanan' => $this->ModelTujuanPelayanan->get_data_all(),
    );
		$this->load->view('index',$data);
	}

  public function input(){
    $data = array(
      'form' => 'TujuanPelayanan/form',
      'body' => 'TujuanPelayanan/input',
      //'tujuan_pelayanan' => $this->ModelTujuanPelayanan->get_data(),
    );
		$this->load->view('index',$data);
  }

  public function insert(){

    if ($this->db->insert('tujuan_pelayanan', $this->tupel)) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect(base_url().'TujuanPelayanan');
    } else {
      echo "salah";
    }

  }
  public function edit()
  {
    $id = $this->uri->segment(3);
    // die( $this->ModelJenisPasien->get_data_edit($id)->row_array());
    $data = array(
      'form' => 'TujuanPelayanan/form',
      'body' => 'TujuanPelayanan/edit',
      'tujuan_pelayanan' => $this->ModelTujuanPelayanan->get_data_edit($id)->row_array()
     );
    $this->load->view('index', $data);
  }

  public function update()
  {
    $this->db->where('kode_tupel', $this->input->post('kode_tupel'));
    if ($this->db->update('tujuan_pelayanan', $this->tupel)) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect('TujuanPelayanan');
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
    }



  }

  public function delete()
  {
    $id = $this->input->post('id');
    $this->db->where_in('kode_tupel', $id);
    $delete = $this->db->delete('tujuan_pelayanan');
    if ($delete == true) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Tujuan Pelayanan'));
    }else{
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Tujuan Pelayanan!'));
    };
    redirect('TujuanPelayanan');
    }


}
