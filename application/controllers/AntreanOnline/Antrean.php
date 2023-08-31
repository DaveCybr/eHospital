<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Antrean extends CI_Controller{
  public $key = "DokterkuTamanGading";
  public $username = "tamangading";

  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelKunjungan");
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
        !array_key_exists("kodepoli",$data) || !array_key_exists("tanggalperiksa",$data) || !array_key_exists("keluhan",$data)
        ) {
          $response = array(
            'response' => array(),
            'metadata' => array(
              'message' => 'Field Tidak Lengkap',
              'code' => 203
            )
          );
        }else{
          $nomor_kartu = $data['nomorkartu'];
          $nik = $data['nik'];
          $kodepoli = $data['kodepoli'];
          $tanggal = $data['tanggalperiksa'];
          $keluhan = $data['keluhan'];
          $tupel = $this->db->where("kdpcare",$kodepoli)->get("tujuan_pelayanan")->row();
          $cek_peserta = $this->db->where("LPAD(noBPJS,13,0)",$nomor_kartu)->get("pasien")->row();
          if (!empty($cek_peserta)) {
            $pasien_noRM = $cek_peserta->noRM;
            $no_antrian = 1;
            if ($this->ModelKunjungan->total($tupel->kode_tupel,7) > 0 ) {
              foreach ($this->ModelKunjungan->max_no($tupel->kode_tupel,7)->result() as $value) {
                $no_antrian = $value->no_antrian + 1;
              }
            }
            $periksa = $this->db->order_by("idperiksa","DESC")->get_where("periksa",array("no_rm"=>$pasien_noRM,'obb !='=>0,'otb !='=>0,'obb !='=>null,"otb !="=>null))->row_array();
            if (!empty($periksa)) {
                $bb = $periksa['obb'];
                $tb = $periksa['otb'];
            }else{
                $bb = 0;
                $tb = 0;
            }

            $data_kunjunganPcare = array(
              'tgl' => date("Y-m-d"),
              'tupel_kode_tupel' => $tupel->kode_tupel,
              'jenis_kunjungan' => "1",
              'sumber_dana' => "7",
              'bb' => $bb,
              'tb' => $tb,
              'keluhan' => $keluhan,
              'sudah' => '0',
              'kunjungansakit' => 1,
              'sistole' => 0,
              'diastole' => 0,
              'nadi' => 0,
              'rr' => 0,
              'pasien_noRM' => $pasien_noRM,
              'asal_pasien' => "Datang Sendiri",
              'administrasi' => 0,
              'status_deposit' => 1,
              'sudah' => 0,
              'status_bridging' => 1,
              'no_antrian' => $no_antrian,
              'jam_daftar' => date('H:i:s'),
              'NIK' => "198609052011042000", //nik afi
              // 'nourut_pcare' => $no_pcare,
            );
            // echo $cek_kunjungan->num_rows()." --> ".$no_pcare." ".$no_bpjs." ".$val->poli->kdPoli." ".$val->peserta->nama."<br>";
            $this->db->insert('kunjungan', $data_kunjunganPcare);
            $hari_ini = date("Y-m-d");
            $this->db->where('noRM',$pasien_noRM);
            $this->db->update('pasien',array('kunjungan_terakhir'=>$hari_ini));
            $sisa = $this->db
            ->join("pasien","pasien_noRM=noRM")
            ->where(["tgl"=>date("Y-m-d",strtotime($tanggal)),'sudah'=>0,'tupel_kode_tupel'=>$tupel->kode_tupel,'jenis_pasien_kode_jenis'=>7])
            ->get("kunjungan")
            ->num_rows();
            $terakhir = $this->db
            ->order_by("no_urutkunjungan","DESC")
            ->join("pasien","pasien_noRM=noRM")
            ->join("tujuan_pelayanan","tupel_kode_tupel=kode_tupel")
            ->where(['sudah'=>1,'tupel_kode_tupel'=>$tupel->kode_tupel,
              'jenis_pasien_kode_jenis'=>7,
            ])
            ->get("kunjungan")
            ->row();
            if (!empty($terakhir)) {
              $antrian_panggil = $terakhir->kd_antrian_bpjs.$terakhir->no_antrian;
              $p = $terakhir->no_antrian;
            }else{
              $antrian_panggil = "A0";
              $p = 0;
            }

            $response = array(
              'response' => array(
                'nomorantrean' => $tupel->kd_antrian_bpjs.$no_antrian,
                'angkaantran' => $no_antrian,
                'namapoli' => ucwords($tupel->tujuan_pelayanan),
                'sisaantrean' => $no_antrian-$p,
                'antreanpanggil' => $antrian_panggil,
                'keterangan' => 'Apabila antrean terlewat harap ambil antrean kembali'
              ),
              'metadata' => array(
                'messages' => "Ok",
                "code" => 200
              )
            );
          }else{
            $response = array(
              'response' => array(),
              'metadata' => array(
                'message' => 'Pasien Baru',
                'code' => 202
              )
            );
          }

        }
        echo json_encode($response);
      }

      // var_dump($data);
      // echo json_encode($response);
    }
  }

  public function status($kodepoli=NULL, $tanggal = NULL){
    $jwt = new JWT();
    $header = $this->input->request_headers();
    // die(var_dump($header));
    if (!empty($header['x-username']) && !empty($header['x-token'])) {
      $input_username = $header['x-username'];
      $input_token = $header['x-token'];
      $data_token = $jwt->decode($input_token,$this->key);
      if ($data_token->userid==1 && $this->username==$input_username) {
        if ($kodepoli ==NULL || $tanggal == NULL ) {
          $response = array(
            'response' => array(),
            'metadata' => array(
              'message' => 'Parameter Tidak Lengkap',
              'code' => 201
            )
          );
        }else{
            $tupel = $this->db->where("kdpcare",$kodepoli)->get("tujuan_pelayanan")->row();
            $jumlah = $this->db
            ->order_by("no_urutkunjungan","DESC")
            ->join("pasien","pasien_noRM=noRM")
            ->join("tujuan_pelayanan","tupel_kode_tupel=kode_tupel")
            ->where(['tupel_kode_tupel'=>$tupel->kode_tupel,
              'jenis_pasien_kode_jenis'=>7,
              'tgl' => date("Y-m-d")
            ])
            ->get("kunjungan")
            ->num_rows();

            $terakhir = $this->db
            ->order_by("no_urutkunjungan","DESC")
            ->join("pasien","pasien_noRM=noRM")
            ->join("tujuan_pelayanan","tupel_kode_tupel=kode_tupel")
            ->where(['sudah'=>1,'tupel_kode_tupel'=>$tupel->kode_tupel,
              'jenis_pasien_kode_jenis'=>7,
            ])
            ->get("kunjungan")
            ->row();
            if (!empty($terakhir)) {
              $antrian_panggil = $terakhir->kd_antrian_bpjs.$terakhir->no_antrian;
              $p = $terakhir->no_antrian;
            }else{
              $antrian_panggil = "A0";
              $p = 0;
            }

            $response = array(
              'response' => array(
                'namapoli' => $tupel->tujuan_pelayanan,
                'totalantrean' => $jumlah,
                'sisaantrean' => $jumlah-$p,
                'antreanpanggil' => $antrian_panggil,
                'keterangan' => 'Apabila antrean terlewat harap ambil antrean kembali'
              ),
              'metadata' => array(
                'messages' => "Ok",
                "code" => 200
              )
            );


        }
        echo json_encode($response);
      }

    }
  }

  public function sisapeserta($nomorkartu=NULL,$kodepoli=NULL, $tanggal=NULL){
    $jwt = new JWT();
    $header = $this->input->request_headers();
    // die(var_dump($header));
    if (!empty($header['x-username']) && !empty($header['x-token'])) {

      $input_username = $header['x-username'];
      $input_token = $header['x-token'];
      $data_token = $jwt->decode($input_token,$this->key);
      if ($data_token->userid==1 && $this->username==$input_username) {
        $data = json_decode(file_get_contents('php://input'),true);
        if ($nomorkartu==NULL || $kodepoli==NULL || $tanggal==NULL) {
          $response = array(
            'response' => array(),
            'metadata' => array(
              'message' => 'Parameter Tidak Lengkap',
              'code' => 201
            )
          );
        }else{
          $nomor_kartu = $nomorkartu;
          $cek_peserta = $this->db->where("LPAD(noBPJS,13,0)",$nomor_kartu)->get("pasien")->row();
          if (!empty($cek_peserta)) {
            $tupel = $this->db->where("kdpcare",$kodepoli)->get("tujuan_pelayanan")->row();

            $pasien_noRM = $cek_peserta->noRM;
            $cek_kunjungan = $this->db
            ->where(['pasien_noRM'=>$pasien_noRM,'tgl'=>$tanggal,'tupel_kode_tupel'=>$tupel->kode_tupel])
            ->get("kunjungan")->row();
            // die(var_dump($cek_kunjungan));
            if (!empty($cek_kunjungan)) {
              $no_antrian = $cek_kunjungan->no_antrian;
              $terakhir = $this->db
              ->order_by("no_urutkunjungan","DESC")
              ->join("pasien","pasien_noRM=noRM")
              ->join("tujuan_pelayanan","tupel_kode_tupel=kode_tupel")
              ->where(['sudah'=>1,'tupel_kode_tupel'=>$tupel->kode_tupel,
                'jenis_pasien_kode_jenis'=>7,
              ])
              ->get("kunjungan")
              ->row();
              if (!empty($terakhir)) {
                $antrian_panggil = $terakhir->kd_antrian_bpjs.$terakhir->no_antrian;
                $p = $terakhir->no_antrian;
              }else{
                $antrian_panggil = "A0";
                $p = 0;
              }
              $sisa = $no_antrian-$p;
              $response = array(
                'response' => array(
                  'nomorantrean' => $tupel->kd_antrian_bpjs.$no_antrian,
                  'namapoli' => ucwords($tupel->tujuan_pelayanan),
                  'sisaantrean' => $sisa < 0?0:$sisa,
                  'antreanpanggil' => $antrian_panggil,
                  'keterangan' => 'Apabila antrean terlewat harap ambil antrean kembali'
                ),
                'metadata' => array(
                  'messages' => "Ok",
                  "code" => 200
                )
              );
            }else{
              $response = array(
                'response' => array(),
                'metadata' => array(
                  'message' => 'Data Tidak Ditemukan',
                  'code' => 201
                )
              );
            }

          }else{
            $response = array(
              'response' => array(),
              'metadata' => array(
                'message' => 'Data Tidak Ditemukan',
                'code' => 201
              )
            );
          }

        }
        echo json_encode($response);
      }

    }
  }


  public function batal(){
    $jwt = new JWT();
    $header = $this->input->request_headers();
    // die(var_dump($header));
    if (!empty($header['x-username']) && !empty($header['x-token'])) {

      $input_username = $header['x-username'];
      $input_token = $header['x-token'];
      $data_token = $jwt->decode($input_token,$this->key);
      if ($data_token->userid==1 && $this->username==$input_username) {
        $data = json_decode(file_get_contents('php://input'),true);
        if (!array_key_exists("nomorkartu",$data) || !array_key_exists("kodepoli",$data) || !array_key_exists("tanggalperiksa",$data)
        ) {
          $response = array(
            'response' => array(),
            'metadata' => array(
              'message' => 'Field Tidak Lengkap',
              'code' => 203
            )
          );
        }else{
          $nomor_kartu = $data['nomorkartu'];
          $kodepoli = $data['kodepoli'];
          $tanggal = $data['tanggalperiksa'];
          $tupel = $this->db->where("kdpcare",$kodepoli)->get("tujuan_pelayanan")->row();
          $cek_peserta = $this->db->where("LPAD(noBPJS,13,0)",$nomor_kartu)->get("pasien")->row();
          if (!empty($cek_peserta)) {
            $pasien_noRM = $cek_peserta->noRM;
            $this->db->where(['pasien_noRM'=>$pasien_noRM,'tgl'=>$tanggal,'tupel_kode_tupel'=>$tupel->kode_tupel]);
            if ($this->db->delete("kunjungan")) {
              $response = array(
                'metadata' => array(
                  'messages' => "Ok",
                  "code" => 200
                )
              );
            }else{
              $response = array(
                'response' => array(),
                'metadata' => array(
                  'message' => 'Gagal',
                  'code' => 201
                )
              );
            }


          }else{
            $response = array(
              'response' => array(),
              'metadata' => array(
                'message' => 'Gagal, Data Tidak Ditemukan',
                'code' => 201
              )
            );
          }

        }
        echo json_encode($response);
      }

    }
  }

}
