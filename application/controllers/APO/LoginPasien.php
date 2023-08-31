<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginPasien extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index(){
		$this->session->set_flashdata('item', 'value');
		$this->load->view('APO/Pasien/Login');
	}

  function aksi_login(){
		$kode   = $this->input->post("no");
		$tanggal= $this->input->post("tgl");

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
                 $data_session = array(
     							'noRM'        => $dataPasien["noRM"],
     							'noBPJS'      => $dataPasien["noBPJS"],
     							'nama'        => $dataPasien["namapasien"],
     							'jenis'       => 1,
                  'jabatan'     => "pasien"
     						);
                $_SESSION['noRM'] = $dataPasien["noRM"];
     						$this->session->set_userdata($data_session);
                echo "berhasil";
               }else{
                echo "BPJS Anda Tidak Aktif Karena : ".$json->response->ketAktif;
               }
             }else {
               echo "Faskes Anda di ".$json->response->kdProviderPst->nmProvider;
             }
           }else {
             $data_session = array(
              'noRM'        => $dataPasien["noRM"],
              'nama'        => $dataPasien["namapasien"],
              'jenis'       => 2,
              'jabatan'     => "pasien"
            );
            $this->session->set_userdata($data_session);
            echo "Berhasil Sebagai Daftar Umum";
           }
         }else {
           $data_session = array(
            'noRM'        => $dataPasien["noRM"],
            'nama'        => $dataPasien["namapasien"],
            'jenis'       => 2,
            'jabatan'     => "pasien"
          );
          $this->session->set_userdata($data_session);
          echo "Berhasil Sebagai Daftar Umum";
         }
      }else {
        echo "p";
      }

    }else {
      echo "up";
    }
	}

  public function logout()
  {
    $this->session->sess_destroy();
    redirect("APO/LoginPasien");
  }

}
