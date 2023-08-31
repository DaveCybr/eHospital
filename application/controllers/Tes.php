<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller{
  public $obat = array();
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url', 'language'));
    $this->load->model('ModelObat');
    $this->load->model('ModelJenisObat');
    $this->load->model('ModelKategoriObat');
    $this->load->model('ModelSatuan');
    $this->load->model('ModelAkuntansi');
  }


  function index()
  {
    $data = array(
      'form' => 'KartuStokApotik/form',
      'body' => 'KartuStokApotik/list',
      'obat' => $this->ModelObat->get_data()
    );
    $this->load->view('index', $data);
  }

  function apotik()
  {
    $data = array(
      'form' => 'KartuStokApotik/form_apotik',
      'body' => 'KartuStokApotik/list',
      'obat' => $this->ModelObat->get_data()
    );
    $this->load->view('index', $data);
  }

  public function cek_stok(){
    $kode = $this->input->post("idobat");
    $jumlah = $this->input->post("jumlah");
    $obat = $this->db->where("idobat",$kode)->get("obat")->row_array();
    if ($jumlah > $obat['stok_berjalan']) {
      $status = 0;
    }else{
      $status = 1;
    }
    $data = array(
      'status' => $status,
      'kode' => $kode,
      'nama_obat' => $obat['nama_obat'],
      'sisa' => $obat['stok_berjalan'],
    );
    echo json_encode($data);
  }

  public function cetak(){
    $kode = $this->uri->segment(3);
    $data = array(
      'data' =>$this->ModelObat->get_kartu_stok($kode),
    );
    $this->load->view('KartuStokApotik/cetak', $data);
  }

  public function cetak_apotik(){
    $kode = $this->uri->segment(3);
    $data = array(
      'data_apotek' =>$this->ModelObat->get_kartu_stok_apotek($kode),
    );
    // echo json_encode($data);
    $this->load->view('KartuStokApotik/cetak', $data);
  }

  public function cetak_baru(){
    $kode = $this->uri->segment(3);
    $data = array(
      // 'data' =>$this->ModelObat->get_kartu_stok_gudang($kode),
      // 'data_ugd' =>$this->ModelObat->get_kartu_stok_ugd($kode),
      'data_apotek' =>$this->ModelObat->get_kartu_stok_apotek($kode),
    );
    $this->load->view('KartuStokApotik/cetak', $data);
  }



}
?>
