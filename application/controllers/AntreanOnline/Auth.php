<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  public function index(){
    $jwt = new JWT();
    $key = "DokterkuTamanGading";
    $username = "tamangading";
    $password = "Dokt3rku";
    $header = $this->input->request_headers();
    // die(var_dump($header));
    if (!empty($header['x-username'])) {
      $input_username = $header['x-username'];
      $input_password = $header['x-password'];;
      // var_dump($input_password);
      $data = array(
        'userid' => 1,
        'user' => "Taman Gading",
      );
      if ($username==$input_username && $password==$input_password) {
        $token = $jwt->encode($data,$key);
        $response = array(
          'response' => array(
            'token' => $token,
          ),
          'metadata' => array(
            'message' => 'Ok',
            'code' => 200
          )
        );

      }else{
        $response = array(
          'response' => array(
            'token' => NULL,
          ),
          'metadata' => array(
            'message' => 'NOT AUTHORIZED',
            'code' => 201
          )
        );
      }
      echo json_encode($response);
    }
  }

}
