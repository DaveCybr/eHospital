<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'vendor/autoload.php';

class ApiPcare extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelPeriksa');
    $this->load->model('ModelPasien');
    $this->load->model('MApi');
  }

  function cekKode()
  {
    date_default_timezone_set('UTC');
    $TimeStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
    $c = curl_init();

    $data = "1693";
    $secretKey ="4qLEB05C09";
    $username = "tamangading";
    $password = "Dokterku@09";
    $user_key = "974250aadc2c1ec2bbb5353763a9f282";
    $keyDecrypt = $data.$secretKey.$TimeStamp;
    // Computes the signature by hashing the salt with the secret key as the key
    $signature = hash_hmac('sha256', $data."&".$TimeStamp, $secretKey, true);
    // base64 encode…
    $encodedSignature = base64_encode($signature);
    //	die(var_dump($secretKey));
    $kodeaplikasi = "095";
    $XAuthorization	= base64_encode($username.":".$password.":".$kodeaplikasi);

    $curl = curl_init();

    $u = "dokter/0/100";
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://apijkn.bpjs-kesehatan.go.id/pcare-rest/".$u,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_POSTFIELDS => "",
      CURLOPT_CONNECTTIMEOUT => 30,
      CURLOPT_FOLLOWLOCATION => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "authorization: Basic Og==",
        "cache-control: no-cache",
        "content-type: application/json",
        "x-authorization: Basic ".$XAuthorization,
        "x-cons-id: ".$data,
        "x-signature: ".$encodedSignature,
        "x-timestamp: ".$TimeStamp,
        "user_key: ".$user_key
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        var_dump($response); die();
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $rest = json_decode($response);
          // echo $rest->response;
          if ($rest->metaData->code == 200) {
            $decrype = $this->stringDecrypt($keyDecrypt, $rest->response);
            $rest->response = json_decode($decrype);
          }
          echo json_encode($rest);
        }
      }

      function stringDecrypt($key, $string){
        $encrypt_method = 'AES-256-CBC';
        // hash
        $key_hash = hex2bin(hash('sha256', $key));
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        // return $output;
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
      }

      function coba_api_lama()
      {
        $tes = array(
        "kdProviderPeserta" => "0189B016",
        "tglDaftar"         => "26-08-2022",
        "noKartu"           => "0001703320277",
        "kdPoli"            => "001",
        "keluhan"           => "tes skit gigi",
        "kunjSakit"         => true,
        "sistole"           => 0,
        "diastole"          => 0,
        "beratBadan"        => 0,
        "tinggiBadan"       => 0,
        "respRate"          => 0,
        // "lingkarPerut"      => 0,
        "heartRate"         => 0,
        "rujukBalik"        => 0,
        "kdTkp"             => 10
        );
        $bridge = PCare("pendaftaran","POST",json_encode($tes));
        echo json_encode($bridge);
        // $url = "peserta/0001703320277"; //nokartu bpjs pak ely
        // echo Pcare($url);
      }

      function getPeserta_api_baru()
      {
        // $bridge = PcareV4("peserta/0002078775494");
        $bridge = PcareV4("peserta/0002078775494");
        echo json_encode($bridge);
      }


      function addPendaftaran()
      {
        $tes = array(
        "kdProviderPeserta"=> "02080401",
        "tglDaftar"=> "28-09-2022",
        "noKartu"=> "0002085648175",
        "kdPoli"=> "001",
        "keluhan"=> "tes sakit",
        "kunjSakit"=> true,
        "sistole"=> 120,
        "diastole"=> 80,
        "beratBadan"=> 35,
        "tinggiBadan"=> 100,
        "respRate"=> 12,
        "lingkarPerut"=> 25,
        "heartRate"=> 80,
        "rujukBalik"=> 0,
        "kdTkp"=> "10"
        );
        // echo json_encode($data_pcare);
        // $bridge = PcareV4("peserta/0002078775494");
        $bridge = PcareV4("pendaftaran","POST","text/plain",json_encode($tes));
        echo json_encode($bridge);
        //$bridge=https://apijkn-dev.bpjs-kesehatan.go.id/pcare-rest-dev/pendaftaran
        // echo json_encode($bridge->response->kdProviderPst->kdProvider);

        // echo json_encode(PcareV4('dokter/0/100'));
      }

      public function getDiagnosa()
      {
        $bridge = PcareV4("diagnosa/H11/0/100");
        // $bridge = PcareV4("pendaftaran/tglDaftar/29-07-2022/0/100");
        echo json_encode($bridge);
      }
      function getPendaftaran_api_baru()
      {
        $tanggal = date("d-m-Y");
        $bridge = PcareV4("pendaftaran/tglDaftar/$tanggal/0/100");
        // $bridge = PcareV4("pendaftaran/tglDaftar/29-07-2022/0/100");
        echo json_encode($bridge);
      }

      public function getPendaftaranByNoUrut()
      {
        $bridge = PcareV4("pendaftaran/noUrut/A1/tglDaftar/28-09-2022");
        // $bridge = PcareV4("pendaftaran/tglDaftar/29-07-2022/0/100");
        echo json_encode($bridge);
      }

      function hapusPendaftaran_api_baru()
      {
        $bridge = PcareV4("pendaftaran/peserta/0002085648175/tglDaftar/28-09-2022/noUrut/A1/kdPoli/001","DELETE","application/json; charset=utf-8");
        echo json_encode($bridge);
      }

      function getSpesialisKhusus()
      {
        // $bridge = PcareV4("spesialis/khusus");
        $bridge = PcareV4("spesialis/sarana");
        // $bridge = json_decode(PCare("spesialis/khusus"));
        echo json_encode($bridge);
      }

      function addKunjungan()
      {
        $data_khusus = array(
        'kdKhusus' => "HDL",
        'kdSubSpesialis' => null,
        'catatan' => "Sudah Bisa hemodialisa",
        );
        $data_rujuk = array(
        'tglEstRujuk' => "02-10-2018" ,
        'kdppk' =>"0116R028" ,
        'subSpesialis' => null,
        'khusus' => $data_khusus,
        );
        // $data_pcare = array(
        //   "noKunjungan" => "A2",
        //   "noKartu"     => "0002078775494",
        //   "tglDaftar"   => "04-08-2022",
        //   "kdPoli"      => "001",
        //   "keluhan"     => "tes sakitt",
        //   "kdSadar"     => "01",
        //   "sistole"     => 120,
        //   "diastole"    => 80,
        //   "beratBadan"  => 45,
        //   "tinggiBadan" => 160,
        //   "respRate"    => 45,
        //   "heartRate"   => 65,
        //   "lingkarPerut"   => 25,
        //   "terapi"      => "catatan",
        //   "kdStatusPulang" => "3",
        //   "tglPulang"   => "04-08-2022",
        //   "kdDokter"    => "387099", //kd Dr. Alin
        //   "kdDiag1"     =>"G44.2",
        //   "kdDiag2"     => null,
        //   "kdDiag3"     => null,
        //   "kdPoliRujukInternal" =>null,
        //   // "rujukLanjut" => $data_rujuk,
        //   "rujukLanjut" => null,
        //   "kdTacc"      => 0,
        //   "alasanTacc"  => null
        // );

        $tes = array(
        // "noKunjungan" =>"A4",
        // "noKartu"     =>"0002078775494",
        // "tglDaftar"   =>"02-09-2022",
        // "kdPoli"      =>"001",
        // "keluhan"     =>"tes sakit dulu",
        // "kdSadar"     =>"01",
        // "sistole"     =>120,
        // "diastole"    =>75,
        // "beratBadan"  =>70,
        // "tinggiBadan" =>180,
        // "respRate"    =>18,
        // "heartRate"   =>80,
        // "lingkarPerut"=>25,
        // "terapi"      =>0,
        // "kdStatusPulang"=>"3",
        // "tglPulang"     =>"02-09-2022",
        // "kdDokter"    =>"387099",
        // "kdDiag1"     =>"R51",
        // "kdDiag2"     =>null,
        // "kdDiag3"     =>null,
        // "kdPoliRujukInternal"=>null,
        // "rujukLanjut" =>null,
        // "kdTacc"      =>0,
        // "alasanTacc"  =>null

        "noKunjungan"=> "B1-9",
    "noKartu"=> "0002086963852",
    "tglDaftar"=> "12-12-2022",
    "kdPoli"=> "002",
    "keluhan"=> "CABUT",
    "kdSadar"=> "01",
    "sistole"=> 120,
    "diastole"=> 80,
    "beratBadan"=> 60,
    "tinggiBadan"=> 160,
    "respRate"=> 20,
    "heartRate"=> 80,
    "lingkarPerut"=> 60,
    "terapi"=> 0,
    "kdStatusPulang"=> "3",
    "tglPulang"=> "12-12-2022",
    "kdDokter"=> "207285",
    "kdDiag1"=> "K03.3",
    "kdDiag2"=> null,
    "kdDiag3"=> null,
    "kdPoliRujukInternal"=> null,
    "rujukLanjut"=> null,
    "kdTacc"=> 0,
    "alasanTacc"=> null
        );

        // $bridge = PcareV4("kunjungan","POST","text/plain",json_encode($data_pcare));
        $bridge = Tes("kunjungan","POST","text/plain",json_encode($tes));
        // echo json_encode($bridge);
        // echo json_encode($data_pcare);
        echo json_encode($bridge);
      }

      public function editKunjungan($value='')
      {
        $tes = array(
        "noKunjungan" =>"0189B0160922Y000004",
        "noKartu"     =>"0002078775494",
        "tglDaftar"   =>"02-09-2022",
        "kdPoli"      =>"001",
        "keluhan"     =>"tes sakit",
        "kdSadar"     =>"01",
        "sistole"     =>120,
        "diastole"    =>75,
        "beratBadan"  =>70,
        "tinggiBadan" =>180,
        "respRate"    =>18,
        "heartRate"   =>80,
        "lingkarPerut"=>25,
        "terapi"      =>0,
        "kdStatusPulang"=>"3",
        "tglPulang"     =>"02-09-2022",
        "kdDokter"    =>"387099",
        "kdDiag1"     =>"R51",
        "kdDiag2"     =>null,
        "kdDiag3"     =>null,
        "kdPoliRujukInternal"=>null,
        "rujukLanjut" =>null,
        "kdTacc"      =>0,
        "alasanTacc"  =>null
        );

        // $bridge = PcareV4("kunjungan","POST","text/plain",json_encode($data_pcare));
        $bridge = PcareV4("kunjungan","PUT","text/plain",json_encode($tes));
        // echo json_encode($bridge);
        // echo json_encode($data_pcare);
        echo json_encode($bridge);
      }


      public function addMCU()
      {
        $data = array(
        "kdMCU"=> 0,
        "noKunjungan"=> "0189B0160922Y000004",
        "kdProvider"=> "0189B016",
        "tglPelayanan"=> "03-09-2022",
        "tekananDarahSistole"=> 0,
        "tekananDarahDiastole"=> 0,
        "radiologiFoto"=> null,
        "darahRutinHemo"=> 0,
        "darahRutinLeu"=> 0,
        "darahRutinErit"=> 7,
        "darahRutinLaju"=> 0,
        "darahRutinHema"=> 0,
        "darahRutinTrom"=>0,
        "lemakDarahHDL"=> 0,
        "lemakDarahLDL"=> 0,
        "lemakDarahChol"=> 0,
        "lemakDarahTrigli"=> 0,
        "gulaDarahSewaktu"=> 76,
        "gulaDarahPuasa"=> 34,
        "gulaDarahPostPrandial"=> 54,
        "gulaDarahHbA1c"=> 65,
        "fungsiHatiSGOT"=> 0,
        "fungsiHatiSGPT"=> 0,
        "fungsiHatiGamma"=> 0,
        "fungsiHatiProtKual"=> 0,
        "fungsiHatiAlbumin"=> 0,
        "fungsiGinjalCrea"=> 0,
        "fungsiGinjalUreum"=> 0,
        "fungsiGinjalAsam"=> 0,
        "fungsiJantungABI"=> 0,
        "fungsiJantungEKG"=> null,
        "pemeriksaanLain"=> null,
        "fungsiJantungEcho"=> null,
        "funduskopi"=> null,
        "keterangan"=> null
        );
        $bridge = PcareV4("MCU","POST","text/plain",json_encode($data));
        echo json_encode($bridge);
      }

      public function getMCU()
      {
        $bridge = PcareV4("MCU/kunjungan/0189B0160822Y000042");
        echo json_encode($bridge);
      }

      public function deleteMCU()
      {
        $bridge = PcareV4("MCU/5770411/0189B0160822Y000041");
        echo json_encode($bridge);
      }


      public function getRiwayatKunjungan()
      {
        $bridge = PcareV4("kunjungan/peserta/0002048126319");
        echo json_encode($bridge);

      }

      public function updateRiwayatKunjungan()
      {
        $bridge = PcareV4("kunjungan/peserta/0002048126319");
        $temp = array();
        foreach ($bridge->response->list  as $val) {
          if ($val->tglKunjungan == '03-12-2022') {
          $date = $val->tglKunjungan;
          $nokun = $val->noKunjungan;
          $nokartu = $val->peserta->noKartu;
          $pasien_noRM = $this->ModelPasien->cek_nobpjs($nokartu)["noRM"];
          $cek_kunjungan = $this->MApi->cek_kunjungan(date('Y-m-d', strtotime($date)),$pasien_noRM)->row();
          if (!empty($cek_kunjungan)) {
            $nokunjungan = $cek_kunjungan->no_urutkunjungan;
            $keluhan = $val->keluhan;
            $cek_periksa = $this->MApi->cek_periksa(date('Y-m-d', strtotime($date)),$pasien_noRM)->row();
            if ($cek_periksa==null || $cek_periksa=='') {
              $data_periksa = array(
                'tanggal' => date('Y-m-d', strtotime($date)),
                'no_rm' => $pasien_noRM,
                'keluhan' => $keluhan,
                'kunjungan_no_urutkunjungan' => $nokunjungan,
              );
            if ($this->db->insert('periksa',$data_periksa)) {
              array_push($temp,"true");
            }else {
                array_push($temp,"false");
            }
                // array_push($temp,$data_periksa);
            }
          }else {
            array_push($temp,"kosong");
          }
        }
        }

        echo json_encode($temp);
      }

      public function insert_diagnosa()
      {
        $data = array(
          'kodesakit' => "B35.1" ,
          'operator' =>"3509191608960006" ,
          'periksa_idperiksa' =>"329858",
          'pasien_noRM' => "00054716",
        );
        echo json_encode($this->db->insert('diagnosa',$data));
        // code...
      }

      public function getRiwayatPendaftaran()
      {
        $date = "07-12-2022";
        $url = "pendaftaran/tglDaftar/".$date."/0/1000";
        $response = PcareV4($url);
        echo json_encode($response);
      }

      function getDokter()
      {
        $bridge = PcareV4("dokter/0/100");
        // $bridge = PCare("dokter/0/100");
        echo json_encode($bridge);
      }

      public function hapusKunjungan()
      {
        // echo "string";
        $bridge = PcareV4("kunjungan/0189B0160922Y000017","DELETE", "application/json; charset=utf-8");
        echo json_encode($bridge);
        // var_dump($bridge);
      }

      public function addTindakan()
      {
        $data = array(
        "kdTindakanSK"=> 0,
        "noKunjungan"=> "0189B0160922Y000004",
        "kdTindakan"=> "01001",
        "biaya"=> 600000,
        "keterangan"=> "kecelakaan",
        "hasil"=> 1498
        );
        // $bridge = PCare("tindakan","POST",json_encode($data));
        $bridge = PcareV4("tindakan","POST","text/plain",json_encode($data));
        echo json_encode($bridge);
      }

      public function editTindakan()
      {
        $data = array(
        "kdTindakanSK"=> 50309832,
        "noKunjungan"=> "0189B0160922Y000004",
        "kdTindakan"=> "01001",
        "biaya"=> 600000,
        "keterangan"=> "sehat",
        "hasil"=> 1498
        );
        // $bridge = PCare("tindakan","POST",json_encode($data));
        $bridge = PcareV4("tindakan","PUT","text/plain",json_encode($data));
        echo json_encode($bridge);
      }

      public function hapusTindakan()
      {

        // $bridge = PCare("tindakan","POST",json_encode($data));
        $bridge = PcareV4("tindakan/50309833/kunjungan/0189B0160922Y000004","DELETE");
        echo json_encode($bridge);
      }

      public function get_tindakan()
      {

        // $bridge = PCare("tindakan","POST",json_encode($data));
        $bridge = PcareV4("tindakan/kdTkp/20/0/100");
        echo json_encode($bridge);
      }

      public function get_tindakan_by_kunjungan($value='')
      {
        $bridge = PcareV4("tindakan/kunjungan/0189B0160922Y000004");
        echo json_encode($bridge);
      }

      public function getPeserta()
      {
        $bridge = PcareV4("peserta/0001534292818");
        echo json_encode($bridge);
      }

      public function add_obat_kunjunganDPHO()
      {
        $data = array(
        "kdObatSK"=>0,
        "noKunjungan"=> "0189B0160822Y000058",
        "racikan"=> false,
        "kdRacikan"=> null,
        "obatDPHO"=> true,
        "kdObat"=> "130103506",
        "signa1"=> 3,
        "signa2"=> 1,
        "jmlObat"=> 9,
        "jmlPermintaan"=> 12,
        "nmObatNonDPHO"=> null
        );
        $bridge =PcareV4('obat/kunjungan','POST', 'text/plain', json_encode($data));
        echo json_encode($bridge);
      }



      public function add_obat_kunjungannon()
      {
        $data = array(
        "kdObatSK"=>0,
        "noKunjungan"=> "0189B0160922Y000004",
        "racikan"=> false,
        "kdRacikan"=> null,
        "obatDPHO"=> false,
        "kdObat"=> null,
        "signa1"=> 3,
        "signa2"=> 1,
        "jmlObat"=> 9,
        "jmlPermintaan"=> 12,
        "nmObatNonDPHO"=> "Dextro mabuk coy"
        );
        $bridge =PcareV4('obat/kunjungan','POST', 'text/plain', json_encode($data));
        echo json_encode($bridge);
      }

      public function get_obat()
      {
        $bridge =PcareV4('obat/dpho/para/0/100');
        echo json_encode($bridge);
      }

      public function get_obat_kunjungan()
      {
        $bridge = PcareV4Tes('obat/kunjungan/0189B0161222Y002186');
        echo json_encode($bridge);
      }

      public function hapus_obat_kunjungan()
      {
        $bridge =PcareV4('obat/230146342/kunjungan/0189B0160822Y000058','DELETE');
        echo json_encode($bridge);
      }

      public function GetFaskesRujukanSub()
      {
        $bridge =PcareV4('spesialis/rujuk/subspesialis/26/sarana/4/tglEstRujuk/20-09-2022');
        echo json_encode($bridge);

        // code...
      }

      public function getRujukan()
      {
        $bridge =PcareV4('kunjungan/rujukan/0189B0161022Y000003');
        echo json_encode($bridge);

      }

      public function rujuk_eksternal()
      {
        $id ='314348';
        $kodeppk = "0189R010";
        $kode_rujuk = "26";


        $data_rujuk = array(
        'tglEstRujuk' => "04-10-2022",
        'kdppk' => $kodeppk ,
        'subSpesialis' => array(
        'kdSubSpesialis1' => $kode_rujuk,
        'kdSarana' => null,
        // 'catatan' => null
        // 'kdSarana' => 1
        ),
        'khusus' => null
        );

        $data = $this->db
        ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
        ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
        ->where("no_urutkunjungan",$id)->get("kunjungan")
        ->row_array();

        $data_pcare = array(
        "noKunjungan"         => "0189B0160922Y000022",
        "noKartu"             => "0002083880935",
        "keluhan"             => "tes 1",
        "kdSadar"             => "01",
        "sistole"             => 120,
        "diastole"            => 80,
        "beratBadan"          => intval($data["bb"]),
        "tinggiBadan"         => intval($data["tb"]),
        "respRate"            => 12,
        "heartRate"           => 90,
        "lingkarPerut"        => 25,
        "terapi"              => null,
        "kdStatusPulang"      => 4,
        "tglPulang"           => "04-10-2022",
        "kdDokter"            => "387099",
        "kdDiag1"             => "R56.0",
        "kdDiag2"             => null,
        "kdDiag3"             => null,
        // "tglDaftar"   => date("d-m-Y",strtotime($data['tgl'])),
        // "kdPoli"      => $data['kdpcare'],
        "kdPoliRujukInternal" => null,
        "rujukLanjut"         => $data_rujuk,
        // "rujukLanjut" => null,
        "kdTacc"      => 1,
        "alasanTacc"  => "< 3 Hari"
        );

        $data_pcare2 = array(
        "noKunjungan"         => "0189B0161022Y000002",
        "noKartu"             => "0002085648175",
        "keluhan"             => "tes 1",
        "kdSadar"             => "01",
        "sistole"             => 120,
        "diastole"            => 80,
        "beratBadan"          => intval($data["bb"]),
        "tinggiBadan"         => intval($data["tb"]),
        "respRate"            => 18,
        "heartRate"           => 80,
        "lingkarPerut"        => 22,
        "terapi"              => null,
        "kdStatusPulang"      => "4",
        "tglPulang"           => "26-09-2022",
        "kdDokter"            => "387099",
        "kdDiag1"             => "R51",
        "kdDiag2"             => null,
        "kdDiag3"             => null,
        // "tglDaftar"   => date("d-m-Y",strtotime($data['tgl'])),
        // "kdPoli"      => $data['kdpcare'],
        "kdPoliRujukInternal" => null,
        "rujukLanjut"         => $data_rujuk,
        // "rujukLanjut" => null,
        "kdTacc"      => 1,
        "alasanTacc"  => "< 3 Hari"
        );
        $bridge = PcareV4("kunjungan","PUT","text/plain",json_encode($data_pcare2));
        $dataAR = array(
          'bridge'  => $bridge,
          'data'    => $data_pcare2
        );
        echo json_encode($dataAR);
      }

      public function spesialis()
      {
        $tes = PcareV4("spesialis");
        echo json_encode($tes);
      }

      public function subSpesialis()
      {
        $tes = PcareV4("spesialis/ANA/subspesialis");
        echo json_encode($tes);

      }





    }
