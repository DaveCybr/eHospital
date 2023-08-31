<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apo_Login extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelPasien");
    $this->load->model("ModelTujuanPelayanan");
  }

  function LoginPasien()
  {
    $kode     = $this->input->post("kode");
    $tanggal  = $this->input->post("tanggal");

    $res = array();
    $this->db->where("noRM", $kode);
    $this->db->or_where('noBPJS', $kode);
    $pasien = $this->db->get("pasien");
    if ($pasien->num_rows() > 0) {
      $dataPasien = $pasien->row_array();
      $tgl_lahir = date("dmY", strtotime($dataPasien["tgl_lahir"]));
      if ($tanggal == $tgl_lahir) {
        // Jenis pasien 1 = BPJS, 2 = UMUM
        $res = array(
          // 'status'  => 1,
          // 'pesan'   => "Selamat Anda Berhasil Login",
          'norm'    => $dataPasien["noRM"],
          'nobpjs'  => $dataPasien["noBPJS"],
          'nama'    => $dataPasien["namapasien"],
         );
         $bpjs = $dataPasien["noBPJS"];
         // $bpjs = "0002503701235";
         $bridge = PCare("peserta/".$bpjs,"GET");
         $json = json_decode($bridge);
         // kode provider KDTG
         $providerKDTG = "0189B016";
         if ($dataPasien["jenis_pasien_kode_jenis"] == 7) {
           if ($json->metaData->code == 200) {
             if ($json->response->kdProviderPst->kdProvider == $providerKDTG) {
               if ($json->response->aktif == true) {
                 $res['status'] = 1;
                 $res['pesan']  = "Selamat Anda Berhasil Login Sebagai Pasien BPJS";
                 $res['jenis']  = 1;
               }else{
                 $res['status'] = 0;
                 $res['pesan'] = "BPJS Anda Tidak Aktif Karena : ".$json->response->ketAktif;
               }
             }else {
               $res['status'] = 0;
               $res['pesan'] = "Faskes Anda di ".$json->response->kdProviderPst->nmProvider;
             }
           }else {
             $res['status'] = 1;
             $res['pesan']  = "Selamat Anda Berhasil Login Sebagai Pasien UMUM";
             $res['jenis']  = 2;
           }
         }else {
           $res['status'] = 1;
           $res['pesan']  = "Selamat Anda Berhasil Login Sebagai Pasien UMUM";
           $res['jenis']  = 2;
         }

      }else {
        $res = array(
          'status'  => 0,
          'pesan'   => "Tanggal Lahir Anda Salah Mohon Untuk Cek Ulang!!! ",
         );
      }

    }else {
      $res = array(
        'status'  => 0,
        'pesan'   => "No BPJS atau No Rekam Medis Anda Tidak Terdaftar",
       );
    }
    echo json_encode($res);

  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect("APO/Apo_Login");
  }

  public function cek()
  {
    $bpjs = "0002074343690";
    echo $bridge = PCare("peserta/".$bpjs,"GET");

  }

  function cekPoli()
  {
    echo $bridge = PCare("poli/fktp/0/20","GET");
  }
  function getKunjungan()
  {
    echo $bridge = PCare("kunjungan/peserta/0001534292818","GET");
  }
  function getKunjunganall()
  {
    echo $bridge = PCare("pendaftaran/tglDaftar/13-10-2020/0/200","GET");
  }

  function cekKunjungan()
  {
    $data_pcare = array(
      "kdProviderPeserta" => "0189B016",
      "tglDaftar"         => date("d-m-Y"),
      "noKartu"           => "0001534293641",
      "kdPoli"            => "998",
      "keluhan"           => "pusing",
      "kunjSakit"         => true,
      "sistole"           => 0,
      "diastole"          => 0,
      "beratBadan"        => 0,
      "tinggiBadan"       => 0,
      "respRate"          => 0,
      "heartRate"         => 0,
      "rujukBalik"        => 0,
      "kdTkp"             => 10
    );
    echo $bridge = PCare("pendaftaran","POST",json_encode($data_pcare));
    // echo json_encode($this->ModelTujuanPelayanan->get_data_edit("999")->row_array());
  }



}
