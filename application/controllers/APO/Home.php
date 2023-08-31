<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->view("vendor/autoload.php");
    $this->load->model("ModelChat");
    $this->load->model("ModelPasien");
    $this->load->model("ModelPegawai");
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelAPO");
    $this->load->model("ModelChat");
  }

  function index()
  {
    $tgl = date('Y-m-d');
    $kunjungan = $this->ModelAPO->getKunjungan($_SESSION['noRM'], $tgl);
    $konsul = $this->ModelChat->getKonsul($_SESSION['noRM'],$kunjungan->row_array()['no_urutkunjungan']);
    $status_konsul = 0;
    $status = 0;
    if ($kunjungan->num_rows() > 0) {
      $status = 1;
    }
    if ($konsul->num_rows() > 0) {
      $status_konsul = 1;
    }
    $sisaAntrianUmum="--";
    $sisaAntrianUmum2="";
    $sisaAntrianGigi="--";
    $antrian = $this->db->get_where("antrian",array('tanggal'=>date("Y-m-d")))->row_array();
    $antrian['UMU']==null?"--":$sisaAntrianUmum = "U".$antrian['UMU'];
    $antrian['UMU2']==null?"--":$sisaAntrianUmum2 = " & U".$antrian['UMU2'];
    $antrian['GIG']==null?"--":$sisaAntrianGigi = "G".$antrian['GIG'];
    $data = array(
      'body'            => 'APO/Pasien/home',
      'status'          => $status,
      'status_konsul'  => $status_konsul,
      'kunjungan'       => $kunjungan->row_array(),
      'pasien'          => $this->ModelPasien->get_data_edit($_SESSION['noRM'])->row_array(),
      'antrian_Umum'    => $sisaAntrianUmum.$sisaAntrianUmum2,
      'antrian_Gigi'    => $sisaAntrianGigi,
      // 'status_dokter'   => $this->ModelAPO->getStatusDokter()->result(),
    );
    // die(var_dump($data['kunjungan_sudah']));
		$this->load->view('APO/Pasien/index',$data);
  }

}
