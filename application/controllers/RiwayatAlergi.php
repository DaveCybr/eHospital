<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiwayatAlergi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelRiwayatAlergi');
    $this->load->model('ModelPasien');
    $this->data_RiwayatAlergi = array(
      'alergi_reaksi'   => $this->input->post('alergi_reaksi'),
      'konsumsi'        => $this->input->post('konsumsi'),
      'jenis_penyakit'  => $this->input->post('jenis_penyakit'),
      'pasien_noRM'     => $this->input->post('pasien_noRM'),
      'tgl_alergi'      => $this->input->post('tgl_alergi')
    );

  }

  function list($pasien)
  {
    $data = array(
      'body'  => 'RiwayatAlergi/list',
      'riwayat_alergi'=> $this->ModelRiwayatAlergi->get_data($pasien)->result(),
      'pasien' => $this->ModelPasien->get_data_edit($pasien)->row_array()
     );
    $this->load->view('index', $data);
  }

  function input($pasien, $kunjungan)
  {
    $data = array(
      'form' => 'RiwayatAlergi/form',
      'body' => 'RiwayatAlergi/input',
      'pasien' => $this->ModelPasien->get_data_edit($pasien)->row_array(),
      'kunjungan' => $kunjungan
     );
    $this->load->view('index', $data);
  }

  function edit($pasien,$idriwayatalergi,$kunjungan)
  {
    $data = array(
      'form' => 'RiwayatAlergi/form',
      'body' => 'RiwayatAlergi/update',
      'pasien' => $this->ModelPasien->get_data_edit($pasien)->row_array(),
      'riwayatalergi' => $this->ModelRiwayatAlergi->get_data_edit($pasien, $idriwayatalergi)->row_array(),
      'kunjungan' => $kunjungan
     );
    $this->load->view('index', $data);
  }

  function insert()
  {

    if ($this->db->insert('riwayat_alergi', $this->data_RiwayatAlergi)) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect('Periksa/index/'.$this->input->post('idkunjungan'));
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
    }
  }

  function update()
  {
    $this->db->where('idriwayat_alergi', $this->input->post('idriwayat_alergi'));
    if ($this->db->update('riwayat_alergi', $this->data_RiwayatAlergi)) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect('Periksa/index/'.$this->input->post('idkunjungan'));
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
    }
  }

  function delete()
  {
    $id = $this->input->post('id');
    $this->db->where_in('idriwayat_alergi', $id);
    $delete = $this->db->delete('riwayat_alergi');
    if ($delete == true) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Pegawai'));
    }else{
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Pegawai, Data masih Terrelasi!!!'));
    };
    redirect('Periksa/index/'.$this->input->post('idkunjungan'));
  }

}
