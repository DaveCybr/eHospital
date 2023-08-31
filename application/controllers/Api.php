<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelPasien");
  }

  public function index()
  {
    $this->ModelPasien->get_pasien();
  }

  public function webhook(){
    header('Access-Control-Allow-Origin: *');
    // $pesan = $_POST['pesan'];
    $data = json_decode(file_get_contents('php://input'), true);
    // $data = file_get_contents('php://input');
    // $data = json_decode(array_keys($_POST)[0], true);
    $pesan = $data['pesan'];
    if ($pesan == "#info") {
      echo "Whatsapp Gateway Esolusindo";
    }else{
      $pesan = explode("#",$pesan);
      // var_dump($pesan);
      // echo "jumlah ".count($pesan);
      // die();
      if (count($pesan) > 2) {
        $cek = $this->db->get_where("pasien",array("noBPJS"=>$pesan[2]))->row();
        if (!empty($cek)) {
          echo "Data Ditemukan, Nama Pasien ".$cek->namapasien;
        }else{
          echo "Data tidak ditemukan";
        }
      }else{
        echo "Ketik  #cek#nomor bpjs";
      }
    }
    // echo $data;
  }


}
