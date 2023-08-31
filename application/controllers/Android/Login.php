<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Android/ModelDaftar");
  }
  function login_android(){
		$norm = $this->input->post("username");
		$password = $this->input->post("password");
    if (strlen($norm) > 8) {
      $cek = $this->db->get_where("pasien_sementara",array("noRM"=>$norm));
    }else{
      $cek = $this->db->get_where("pasien",array("noRM"=>$norm));
    }
		if ($cek->num_rows() > 0) {
			$data = $cek->row_array();
      if ($data['password']==NULL) {
        $ps = explode("-",$data['tgl_lahir']);
        $data['password']=$ps[2].$ps[1].$ps[0];
        if ($password==$data['password']) {
  				$res = array(
  					'data' => array(
  						'noRM' => $data['noRM'],
  						'pasien' => $data['namapasien']
  					),
  					'status' => array(
  						'status' => 1,
  						'message' => "Anda Berhasil Login"
  					)
  				);
  			}else{
  				$res = array(
  					'data' => array(
  						'noRM' => NULL,
  						'pasien' => NULL
  					),
  					'status' => array(
  						'status' => 4,
  						'message' => "Password Anda Salah"
  					)
  				);
  			}
        if (strlen($norm) > 8) {
          $this->db->where("noRM",$norm)->update("pasien_sementara",array("password"=>$data['password']));
        }else{
          $this->db->where("noRM",$norm)->update("pasien",array("password"=>$data['password']));
        }
      }else{
        if ($password==$data['password']) {
  				$res = array(
  					'data' => array(
  						'noRM' => $data['noRM'],
  						'pasien' => $data['namapasien']
  					),
  					'status' => array(
  						'status' => 1,
  						'message' => "Anda Berhasil Login"
  					)
  				);
  			}else{
  				$res = array(
  					'data' => array(
  						'noRM' => NULL,
  						'pasien' => NULL
  					),
  					'status' => array(
  						'status' => 4,
  						'message' => "Password Anda Salah"
  					)
  				);
  			}
      }

		}else{
			$res = array(
				'data' => array(
					'noRM' => NULL,
					'pasien' => NULL
				),
				'status' => array(
					'status' => 2,
					'message' => "Nomor Rekam Medis Tidak Ditemukan"
				)
			);
		}
		echo json_encode($res);
	}
}
