<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pcare extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {

    $data = array(
      'form' => 'Pcare/form',
      'body' => 'Pcare/input',
      'pcare' => $this->db->get("pcare")->row()
    );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'form' => 'Satuan/form',
      'body' => 'Satuan/input',
    );
    $this->load->view('index', $data);
  }
  function non_aktifkan(){
    $this->db->where("id",1);
    if ($this->db->update('pcare', array('status'  => 0))) {
      $this->session->set_flashdata('Notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      redirect('Pcare');
    } else {
      echo "salah";
    }
  }

  function aktifkan(){
    $this->db->where("id",1);
    if ($this->db->update('pcare', array('status'  => 1))) {
      $this->session->set_flashdata('Notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      redirect('Pcare');
    } else {
      echo "salah";
    }
  }

  public function insert()
  {
    $this->db->where("id",1);
    if ($this->db->update('pcare', array('passpcare'  => $this->input->post('password'),"pegawai_NIK"=>$_SESSION['nik'],'update_terakhir'=>date("Y-m-d H:i:s")))) {
      $this->session->set_flashdata('Notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      redirect('Pcare');
    } else {
      echo "salah";
    }

  }

  public function edit()
  {
    $id = $this->uri->segment(3);
    // die( $this->ModelJenisPasien->get_data_edit($id)->row_array());
    $data = array(
    'form' => 'Satuan/form',
    'body' => 'Satuan/edit',
    'satuan' => $this->ModelSatuan->get_data_edit($id)->row_array()
    );
    $this->load->view('index', $data);
  }


  public function delete()
  {
    $id = $this->input->post('id');
    $this->db->where_in('idsatuan', $id);
    $delete = $this->db->delete('satuan');
    if ($delete == true) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Satuan'));
    }else{
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Satuan'));
    };
    redirect('Satuan');
  }


  public function dokter()
  {
    // die(var_dump(PCare("tindakan/kdTkp/20/0/1000")));
    // $no = "0002468339403";
    // $url = "peserta/".$no;
    $url = "poli/fktp/0/2";
    echo Pcare($url);
    // $response = json_decode(Pcare($url));
    // echo "<pre>";
    // print_r($response);
    // echo "<pre>";
    // die();
  }

  public function coba()
  {
    $consID = '20563';
    $consSecret = '1cQB4BD0FC';

    $username = 'tamangading';
    $userpass = 'Dokterku@09';
    $kodeapl = '095';
    $mip2 = 'https://new-api.bpjs-kesehatan.go.id/pcare-rest-v3.0/';

    date_default_timezone_set('UTC');
    $TimeStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
    $var1 = $consID."&".$TimeStamp;
    // Computes the signature by hashing the salt with the secret key as the key
    $signature = hash_hmac('sha256', $var1, $consSecret, true);
    // base64 encode…
    $encodedSignature = base64_encode($signature);

    $kodeaplikasi = "095";
    $XAuthorization	= base64_encode($username.":".$userpass.":".$kodeapl);

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $mip2."poli/fktp/0/2",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    "authorization: Basic Og==",
    "cache-control: no-cache",
    "content-type: application/json",
    //"postman-token: 11d8d7be-e260-fdf0-5b23-3e2c291080bc",
    "x-authorization: Basic ".$XAuthorization,
    "x-cons-id: ".$consID,
    "x-signature: ".$encodedSignature,
    "x-timestamp: ".$TimeStamp
    ),
    ));
    //echo "consID ".$consID , "consSecret ".$consSecret;
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #: " . $err;
    } else {
      echo $response;
    }
  }

  public function tujuan_pelayanan()
  {
    // die(var_dump(PCare("tindakan/kdTkp/20/0/1000")));
    $no = "0002468339403";
    $url = "peserta/".$no;

    // $url = "poli/fktp/0/20";
    $response = json_decode(Pcare($url));
    echo "<pre>";
      print_r($response);
      echo "<pre>";
        die();
      }


      public function sinkron_pasien()
      {
        // die(var_dump(PCare("tindakan/kdTkp/20/0/1000")));

        $data = $this->db
        ->group_by("bpjs")
        ->where("status",NULL)
        ->get("pasien_prolanis")
        ->result();
        foreach ($data as $value) {
          $no = $value->bpjs;
          $url = "peserta/".$no;
          $response = json_decode(Pcare($url));
          $cek = $this->db->get_where("pasien",['noBPJS'=>$no])->num_rows();
          if ($cek > 0) {
            $this->db->where("bpjs",$no)
            ->update("pasien_prolanis",['status'=>1]);
            $this->db->where("noBPJS",$no)->update("pasien",['pstprb'=>$response->response->pstPrb,'pstprol'=>$response->response->pstProl,'prolanis_aktif'=>1]);
          }
          echo "Selesai";
          // echo "<pre>";
          // print_r($response);
          // echo "<pre>";
          // die();
        }


      }

      public function cek_kunjungan()
      {
        // die(var_dump(PCare("tindakan/kdTkp/20/0/1000")));
        // $no = "0002302442987";
        // $url = "pendaftaran/tglDaftar/14-08-2021/0/1000";
        $url = "peserta/0001703320277";

        $response = json_decode(Pcare($url));
        echo "<pre>";
          print_r($response);
          echo "<pre>";
            die();
          }

          public function cek_poli()
          {
            // die(var_dump(PCare("tindakan/kdTkp/20/0/1000")));
            // $no = "0002302442987";
            $url = "poli/fktp/0/100";

            $response = json_decode(Pcare($url));
            echo "<pre>";
              print_r($response);
              echo "<pre>";
                die();
              }

              public function cek_mcu()
              {
                // die(var_dump(PCare("tindakan/kdTkp/20/0/1000")));
                $no = "0189B0160221Y000134";
                $url = "mcu/kunjungan/".$no;

                $response = json_decode(Pcare($url), "GET");
                echo "<pre>";
                  print_r($response);
                  echo "<pre>";
                    die();
                  }

                  // public function cek_kunjungan()
                  // {
                  //   // die(var_dump(PCare("tindakan/kdTkp/20/0/1000")));
                  //   $no = "0189B0160221Y000134";
                  //   $url = "mcu/kunjungan/".$no;
                  //
                  //   $response = json_decode(Pcare($url), "GET");
                  //   echo "<pre>";
                  //   print_r($response);
                  //   echo "<pre>";
                  //   die();
                  // }


                }
                ?>
