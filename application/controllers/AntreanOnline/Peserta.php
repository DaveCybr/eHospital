<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Peserta extends CI_Controller{
  public $key = "DokterkuTamanGading";
  public $username = "tamangading";

  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelPasien");
  }

  public function index(){
    $jwt = new JWT();
    $header = $this->input->request_headers();
    // die(var_dump($header));
    if (!empty($header['x-username']) && !empty($header['x-token'])) {

      $input_username = $header['x-username'];
      $input_token = $header['x-token'];
      $data_token = $jwt->decode($input_token,$this->key);
      if ($data_token->userid==1 && $this->username==$input_username) {
        $data = json_decode(file_get_contents('php://input'),true);
        
        if (!array_key_exists("nomorkartu",$data) || !array_key_exists("nik",$data) ||
        !array_key_exists("nomorkk",$data) || !array_key_exists("nama",$data) || !array_key_exists("jeniskelamin",$data)
        ) {
          $response = array(
            'response' => array(),
            'metadata' => array(
              'message' => 'Field Tidak Lengkap',
              'code' => 203
            )
          );
        }else{
          $data_pasien = array(
            'provinsi' => strtoupper($data['namaprop']),
            // 'tinggal_dengan' => $tinggal_dengan,
            // 'status_kawin' => $this->input->post('perkawinan') ,
            'noRM' => $this->ModelPasien->generete_noRM(),
            'noBPJS' => $data['nomorkartu'],
            'namapasien' => strtoupper($data['nama']),
            'tgl_lahir' => $data['tanggallahir'],
            'jenis_kelamin' => $data['jeniskelamin'],
            // 'agama' => $this->input->post('agama'),
            // 'suku' => $this->input->post('suku'),
            'alamat' => strtoupper($data['alamat']),
            'kota' => $data['namadati2'],
            // 'telepon' => $this->input->post('telepon'),
            // 'pekerjaan' => $this->input->post('pekerjaan'),
            'tgl_daftar' => date("Y-m-d"),
            // 'email' => $this->input->post('email'),
            'tgl_masuk' => date("Y-m-d"),
            'kunjungan_terakhir' => date("Y-m-d"),
            'jenis_pasien_kode_jenis' => 7,
            // 'suami_istri' => strtoupper($this->input->post('suami_istri')),
            // 'orangtua' => strtoupper($this->input->post('orangtua'))
          );
          // echo $cek_kunjungan->num_rows()." --> ".$no_pcare." ".$no_bpjs." ".$val->poli->kdPoli." ".$val->peserta->nama."<br>";
          $this->db->insert('pasien', $data_pasien);
          $response = array(
            'metadata' => array(
              'messages' => "Ok",
              "code" => 200
            )
          );


        }
        echo json_encode($response);
      }

      // var_dump($data);
      // echo json_encode($response);
    }
  }

}
