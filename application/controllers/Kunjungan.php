<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends CI_Controller {
  private $data_kunjungan = array();
  private $pasien ;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelPekerjaan');
    $this->load->model('ModelJenisPasien');
    $this->load->model('ModelTujuanPelayanan');
    $this->load->model('ModelTempatTidur');
    $this->load->model('ModelPasien');
    $this->load->model('ModelJenisPasien');
    $this->load->model('ModelAkuntansi');
    $this->load->model('ModelKBinaan');
    $this->data_kunjungan = array(

      'no_urutkunjungan' => $this->input->post('no_urutkunjungan'),
      'tgl' => $this->input->post('tgl'),
      'tupel_kode_tupel' => $this->input->post('tujuan_pelayanan'),
      'jenis_kunjungan' => $this->input->post('jenis_kunjungan'),
      'sumber_dana' => $this->input->post('jenis_pembayaran'),
      'bb' => $this->input->post('bb'),
      'tb' => $this->input->post('tb'),
      'imt' => $this->input->post('imt'),
      'lingkar_perut' => $this->input->post('lingkarPerut'),
      'keluhan' => $this->input->post('keluhan'),
      'sudah' => '0',
      'pasien_baru' => $this->input->post('pasien_baru'),
      'kunjungansakit' => (int)$this->input->post('kunjungansakit'),
      'sistole' => $this->input->post('sistole'),
      'diastole' => $this->input->post('diastole'),
      'nadi' => $this->input->post('heartRate'), //nadi=heartRate
      'rr' => $this->input->post('rr'),
      'heartRate' => $this->input->post('heartRate'),
      'spo2' => $this->input->post('spo2'),
      'suhu' => $this->input->post('suhu'),
      'pasien_noRM' => $this->input->post('pasien_noRM'),
      'asal_pasien' => $this->input->post('asal_pasien'),
      'administrasi' => 0,
      'status_deposit' => 1

    );

    $this->load->model("ModelTujuanPelayanan");
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelTempatTidur");
    $this->load->model("ModelChat");

  }

  function index()
  {
    // die(var_dump(PCareLama()));
    $tgl = date('Y-m-d');
    $no_antrian = null;
    if ($this->ModelKunjungan->total("UMU",1) > 0 ) {
      foreach ($this->ModelKunjungan->max_no("UMU",1)->result() as $value) {
        $no_antrian = $value->no_antrian;
      }
    } else {
      $no_antrian = 0;
    }
    if ($_SESSION['poli']=="IGD") {
      $data_belum = $this->ModelKunjungan->get_data_ugd($tgl);
      $data_sudah = $this->ModelKunjungan->get_data_sudah_ugd($tgl);
    }else{
      $data_belum = $this->ModelKunjungan->get_data($tgl);
      $data_sudah = $this->ModelKunjungan->get_data_sudah($tgl);
    }
    // $this->sinkronKunjungan();
    $data = array(
    'body'            => 'Kunjungan/list',
    'kunjungan'       => $data_belum,
    'kunjungan_sudah' => $data_sudah,
    // 'daftar_pcare'    => NULL,
    // 'periksa_pcare'   => NULL,
    'daftar_pcare'    => $this->ModelKunjungan->get_daftar_pcare($tgl),
    'periksa_pcare'   => $this->ModelKunjungan->get_periksa_pcare($tgl),
    'tupel'           => $this->ModelTujuanPelayanan->get_data(),
    'no_antrian'       => $no_antrian,
    'jenis_pasien' => $this->ModelJenisPasien->get_data()
    );
    // die(var_dump($data['kunjungan_sudah']));
    $this->load->view('index',$data);
  }



  function sinkronKunjungan()
  {
    $t = date("d-m-Y H:i:s");
    date_default_timezone_set("Asia/Jakarta");
    $t = date("H:i:s",strtotime("Asia/Jakarta"));
    $list_data = array();
    $url = "pendaftaran/tglDaftar/".date('d-m-Y')."/0/1";
    $response = PcareV4($url);
    if ($response->metaData->code==200) {
      $count = $response->response->count;
      $page = ceil($count / 10);
      for ($i=0; $i <= $page; $i++) { 
        $limit = $i * 10;
        $url = "pendaftaran/tglDaftar/".date('d-m-Y')."/$limit/10";
        $response = PcareV4($url);
        // echo json_encode($response);
        if ($response->metaData->code==200) {
          $rest_data = $response->response->list;
          foreach ($rest_data as $key => $value) {
            array_push($list_data,$value);
          }
        }
      }
    } else {
      if ($response->metaData->code==204) {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Tidak Ada Data kunjungan Hari ini'));
      }else {
        $this->session->set_flashdata('notif', $this->Notif->gagal($response->metaData->message));
      }
    }

    if (sizeof($list_data) > 0) {
      // echo json_encode($list_data);
      foreach ($list_data as $val) {
        $no_pcare = $val->noUrut;
        $no_bpjs = $val->peserta->noKartu;
        $pasien_noRM = $this->ModelPasien->cek_nobpjs($no_bpjs)["noRM"];
        if (empty($pasien_noRM)) {
          $pasien_noRM = $this->ModelPasien->generete_noRM();
          $data_pasien = array(
          // 'provinsi' => $this->input->post('provinsi'),
          // 'tinggal_dengan' => $tinggal_dengan,
          // 'status_kawin' => $this->input->post('perkawinan') ,
          'noRM' => $pasien_noRM,
          'noBPJS' => $no_bpjs,
          // 'noAsuransiLain' => $this->input->post('noAsuransiLain'),
          'namapasien' => strtoupper($val->peserta->nama),
          'tgl_lahir' => date("Y-m-d",strtotime($val->peserta->tglLahir)),
          'jenis_kelamin' => $val->peserta->sex,
          // 'agama' => $this->input->post('agama'),
          // 'suku' => $this->input->post('suku'),
          // 'alamat' => strtoupper($this->input->post('alamat')),
          // 'kota' => $this->input->post('kota'),
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
          $insert_data = $this->db->insert('pasien',$data_pasien);
        }
        $cek_kunjungan = $this->ModelKunjungan->cek_kunjungan_pcare(date("Y-m-d"), $no_pcare, $no_bpjs);
        if ($cek_kunjungan->num_rows() < 1) {
          $kode_tupel = $this->ModelTujuanPelayanan->get_kdpcare($val->poli->kdPoli)->row_array()['kode_tupel'];
          $no_antrian = 1;
          if ($this->ModelKunjungan->total($kode_tupel,7) > 0 ) {
            foreach ($this->ModelKunjungan->max_no($kode_tupel,7)->result() as $value) {
              $no_antrian = $value->no_antrian + 1;
            }
          }
          $kunjungansakit = 1;
          if ($val->kunjSakit == true) {
            $kunjungansakit = 1;
          }else {
            $kunjungansakit = 0;
          }
          $sudah = 1;
          if ($val->status == "Baru") {
            $sudah = 0;
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
          'tupel_kode_tupel' => $kode_tupel,
          'jenis_kunjungan' => "1",
          'sumber_dana' => "7",
          'bb' => $bb,
          'tb' => $tb,
          // 'keluhan' => $val->keluhan,
          'keluhan' => '',
          'sudah' => '0',
          'kunjungansakit' => (int)$kunjungansakit,
          'sistole' => 0,
          'diastole' => 0,
          'nadi' => 0,
          'rr' => 0,
          'pasien_noRM' => $pasien_noRM,
          'asal_pasien' => "Datang Sendiri",
          'administrasi' => 0,
          'status_deposit' => 1,
          'sudah' => $sudah,
          'status_bridging' => 1,
          'no_antrian' => $no_antrian,
          'jam_daftar' => $t,
          'NIK' => $_SESSION['nik'],
          'nourut_pcare' => $no_pcare,
          'web_antrian' => 1
          );
          // echo $cek_kunjungan->num_rows()." --> ".$no_pcare." ".$no_bpjs." ".$val->poli->kdPoli." ".$val->peserta->nama."<br>";
          $this->db->insert('kunjungan', $data_kunjunganPcare);
          $hari_ini = date("Y-m-d");
          $this->db->where('noRM',$pasien_noRM);
          $this->db->update('pasien',array('kunjungan_terakhir'=>$hari_ini));
        }
      }
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Sinkronisasi'));
    }else{
      if ($response->metaData->code==204) {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Tidak Ada Data kunjungan Hari ini'));
      }else {
        $this->session->set_flashdata('notif', $this->Notif->gagal($response->metaData->message));
      }
    }
    redirect(base_url("Kunjungan"));
  }

  function sinkronKunjungan_test()
  {
    $url = "pendaftaran/tglDaftar/".date('d-m-Y')."/0/1000";
    $response = PcareV4Tes($url);
    // echo json_encode($response); die();
    $t = date("d-m-Y H:i:s");
    // echo date_default_timezone_get();
    $t = date("H:i:s",strtotime("+7 hour"));
    // die($t);
    // echo json_encode($response);
    // echo "<pre>";
    // print_r($response);
    // echo "</pre>";
    // die();
    //WHERE tgl = "2021-08-18" AND sumber_dana = "7" AND nourut_pcare = "1" kartu bpjs
    if ($response->metaData->code==200) {
      $list_data = $response->response->list;
      // echo json_encode($list_data);
      foreach ($list_data as $val) {
        $no_pcare = $val->noUrut;
        $no_bpjs = $val->peserta->noKartu;
        $pasien_noRM = $this->ModelPasien->cek_nobpjs($no_bpjs)["noRM"];
        if (empty($pasien_noRM)) {
          $pasien_noRM = $this->ModelPasien->generete_noRM();
          $data_pasien = array(
          // 'provinsi' => $this->input->post('provinsi'),
          // 'tinggal_dengan' => $tinggal_dengan,
          // 'status_kawin' => $this->input->post('perkawinan') ,
          'noRM' => $pasien_noRM,
          'noBPJS' => $no_bpjs,
          // 'noAsuransiLain' => $this->input->post('noAsuransiLain'),
          'namapasien' => strtoupper($val->peserta->nama),
          'tgl_lahir' => date("Y-m-d",strtotime($val->peserta->tglLahir)),
          'jenis_kelamin' => $val->peserta->sex,
          // 'agama' => $this->input->post('agama'),
          // 'suku' => $this->input->post('suku'),
          // 'alamat' => strtoupper($this->input->post('alamat')),
          // 'kota' => $this->input->post('kota'),
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
          $insert_data = $this->db->insert('pasien',$data_pasien);
        }
        $cek_kunjungan = $this->ModelKunjungan->cek_kunjungan_pcare(date("Y-m-d"), $no_pcare, $no_bpjs);
        if ($cek_kunjungan->num_rows() < 1) {
          $kode_tupel = $this->ModelTujuanPelayanan->get_kdpcare($val->poli->kdPoli)->row_array()['kode_tupel'];
          $no_antrian = 1;
          if ($this->ModelKunjungan->total($kode_tupel,7) > 0 ) {
            foreach ($this->ModelKunjungan->max_no($kode_tupel,7)->result() as $value) {
              $no_antrian = $value->no_antrian + 1;
            }
          }
          $kunjungansakit = 1;
          if ($val->kunjSakit == true) {
            $kunjungansakit = 1;
          }else {
            $kunjungansakit = 0;
          }
          $sudah = 1;
          if ($val->status == "Baru") {
            $sudah = 0;
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
          'tupel_kode_tupel' => $kode_tupel,
          'jenis_kunjungan' => "1",
          'sumber_dana' => "7",
          'bb' => $bb,
          'tb' => $tb,
          // 'keluhan' => $val->keluhan,
          'keluhan' => '',
          'sudah' => '0',
          'kunjungansakit' => (int)$kunjungansakit,
          'sistole' => 0,
          'diastole' => 0,
          'nadi' => 0,
          'rr' => 0,
          'pasien_noRM' => $pasien_noRM,
          'asal_pasien' => "Datang Sendiri",
          'administrasi' => 0,
          'status_deposit' => 1,
          'sudah' => $sudah,
          'status_bridging' => 1,
          'no_antrian' => $no_antrian,
          'jam_daftar' => $t,
          'NIK' => $_SESSION['nik'],
          'nourut_pcare' => $no_pcare,
          'web_antrian' => 1
          );
          // echo $cek_kunjungan->num_rows()." --> ".$no_pcare." ".$no_bpjs." ".$val->poli->kdPoli." ".$val->peserta->nama."<br>";
          $this->db->insert('kunjungan', $data_kunjunganPcare);
          $hari_ini = date("Y-m-d");
          $this->db->where('noRM',$pasien_noRM);
          $this->db->update('pasien',array('kunjungan_terakhir'=>$hari_ini));
        }
      }
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Sinkronisasi'));
    }else{
      if ($response->metaData->code==204) {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Tidak Ada Data kunjungan Hari ini'));
      }else {
        $this->session->set_flashdata('notif', $this->Notif->gagal($response->metaData->message));
      }
    }
    redirect(base_url("Kunjungan"));
  }

  public function test()
  {
    $temp = array();
    $url = "pendaftaran/tglDaftar/".date('d-m-Y')."/0/1000";
    $response = PcareV4($url);

    $t = date("d-m-Y H:i:s");
    $t = date("H:i:s",strtotime("+7 hour"));

    if ($response->metaData->code==200) {
      $list_data = $response->response->list;
      // echo json_encode($list_data);
      foreach ($list_data as $val) {
        $no_pcare = $val->noUrut;
        $no_bpjs = $val->peserta->noKartu;
        $pasien_noRM = $this->ModelPasien->cek_nobpjs($no_bpjs)["noRM"];
        if (empty($pasien_noRM)) {
          $pasien_noRM = $this->ModelPasien->generete_noRM();
          $data_pasien = array(
          // 'provinsi' => $this->input->post('provinsi'),
          // 'tinggal_dengan' => $tinggal_dengan,
          // 'status_kawin' => $this->input->post('perkawinan') ,
          'noRM' => $pasien_noRM,
          'noBPJS' => $no_bpjs,
          // 'noAsuransiLain' => $this->input->post('noAsuransiLain'),
          'namapasien' => strtoupper($val->peserta->nama),
          'tgl_lahir' => date("Y-m-d",strtotime($val->peserta->tglLahir)),
          'jenis_kelamin' => $val->peserta->sex,
          // 'agama' => $this->input->post('agama'),
          // 'suku' => $this->input->post('suku'),
          // 'alamat' => strtoupper($this->input->post('alamat')),
          // 'kota' => $this->input->post('kota'),
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
          // $insert_data = $this->db->insert('pasien',$data_pasien);
          $data_kosong1 = 'pasien kosong1';
          array_push($temp,$data_kosong1);
        }
        $cek_kunjungan = $this->ModelKunjungan->cek_kunjungan_pcare(date("Y-m-d"), $no_pcare, $no_bpjs);
        if ($cek_kunjungan->num_rows() < 1) {
          $kode_tupel = $this->ModelTujuanPelayanan->get_kdpcare($val->poli->kdPoli)->row_array()['kode_tupel'];
          // $no_antrian = 1;
          // if ($this->ModelKunjungan->total($kode_tupel,7) > 0 ) {
          //   foreach ($this->ModelKunjungan->max_no($kode_tupel,7)->result() as $value) {
          //     $no_antrian = $value->no_antrian + 1;
          //   }
          // }
          // $kunjungansakit = 1;
          // if ($val->kunjSakit == true) {
          //   $kunjungansakit = 1;
          // }else {
          //   $kunjungansakit = 0;
          // }
          // $sudah = 1;
          // if ($val->status == "Baru") {
          //   $sudah = 0;
          // }
          //
          // $periksa = $this->db->order_by("idperiksa","DESC")->get_where("periksa",array("no_rm"=>$pasien_noRM,'obb !='=>0,'otb !='=>0,'obb !='=>null,"otb !="=>null))->row_array();
          // if (!empty($periksa)) {
          //   $bb = $periksa['obb'];
          //   $tb = $periksa['otb'];
          // }else{
          //   $bb = 0;
          //   $tb = 0;
          // }
          //
          // $data_kunjunganPcare = array(
          // 'tgl' => date("Y-m-d"),
          // 'tupel_kode_tupel' => $kode_tupel,
          // 'jenis_kunjungan' => "1",
          // 'sumber_dana' => "7",
          // 'bb' => $bb,
          // 'tb' => $tb,
          // 'keluhan' => $val->keluhan,
          // 'sudah' => '0',
          // 'kunjungansakit' => (int)$kunjungansakit,
          // 'sistole' => 0,
          // 'diastole' => 0,
          // 'nadi' => 0,
          // 'rr' => 0,
          // 'pasien_noRM' => $pasien_noRM,
          // 'asal_pasien' => "Datang Sendiri",
          // 'administrasi' => 0,
          // 'status_deposit' => 1,
          // 'sudah' => $sudah,
          // 'status_bridging' => 1,
          // 'no_antrian' => $no_antrian,
          // 'jam_daftar' => $t,
          // 'NIK' => $_SESSION['nik'],
          // 'nourut_pcare' => $no_pcare,
          // 'web_antrian' => 1
          // );
          // // // echo $cek_kunjungan->num_rows()." --> ".$no_pcare." ".$no_bpjs." ".$val->poli->kdPoli." ".$val->peserta->nama."<br>";
          // // $this->db->insert('kunjungan', $data_kunjunganPcare);
          // // $hari_ini = date("Y-m-d");
          // // $this->db->where('noRM',$pasien_noRM);
          // // $this->db->update('pasien',array('kunjungan_terakhir'=>$hari_ini));
          // array_push($temp,$data_kunjunganPcare);
          $data_kosong = 'num lebih dari 1';
          array_push($temp,$data_kosong);
        }
        // echo json_encode('pasien kosong');
        // $data_kosong3 = 'pasien kosong3';
        array_push($temp, $cek_kunjungan->num_rows());
      }
      array_push($temp,$list_data);
      // echo json_encode($temp);
      // $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Sinkronisasi'));
    }else{
      if ($response->metaData->code==204) {
        // $this->session->set_flashdata('notif', $this->Notif->gagal('Tidak Ada Data kunjungan Hari ini'));
      }else {
        // $this->session->set_flashdata('notif', $this->Notif->gagal($response->metaData->message));
      }
    }
    echo json_encode($response);
  }

  function sinkronKunjungan2()
  {
    date_default_timezone_set('Asia/Jakarta');
    $url = "pendaftaran/tglDaftar/".date('d-m-Y')."/0/1000";
    // die(date("d-m-Y H:i:s"));
    $response = PcareV4($url);
    echo "<pre>";
      print_r($response);
      echo "</pre>";
      die();
      //WHERE tgl = "2021-08-18" AND sumber_dana = "7" AND nourut_pcare = "1" kartu bpjs
      $list_data = $response->response->list;
      // echo json_encode($list_data);
      foreach ($list_data as $val) {
        $no_pcare = $val->noUrut;
        $no_bpjs = $val->peserta->noKartu;
        $cek_kunjungan = $this->ModelKunjungan->cek_kunjungan_pcare(date("Y-m-d"), $no_pcare, $no_bpjs);
        $pasien_noRM = $this->ModelPasien->cek_nobpjs($no_bpjs)["noRM"];
        if ($cek_kunjungan->num_rows() < 1) {
          $kode_tupel = $this->ModelTujuanPelayanan->get_kdpcare($val->poli->kdPoli)->row_array()['kode_tupel'];
          $no_antrian = 1;
          if ($this->ModelKunjungan->total($kode_tupel,7) > 0 ) {
            foreach ($this->ModelKunjungan->max_no($kode_tupel,7)->result() as $value) {
              $no_antrian = $value->no_antrian + 1;
            }
          }
          $kunjungansakit = 1;
          if ($val->kunjSakit == true) {
            $kunjungansakit = 1;
          }else {
            $kunjungansakit = 0;
          }
          $sudah = 1;
          if ($val->status == "Baru") {
            $sudah = 0;
          }
          $data_kunjunganPcare = array(
          'tgl' => date("Y-m-d"),
          'tupel_kode_tupel' => $kode_tupel,
          'jenis_kunjungan' => "1",
          'sumber_dana' => "7",
          'bb' => "0",
          'tb' => "0",
          'keluhan' => $val->keluhan,
          'sudah' => '0',
          'kunjungansakit' => (int)$kunjungansakit,
          'sistole' => 0,
          'diastole' => 0,
          'nadi' => 0,
          'rr' => 0,
          'pasien_noRM' => $pasien_noRM,
          'asal_pasien' => "Datang Sendiri",
          'administrasi' => 0,
          'status_deposit' => 1,
          'sudah' => $sudah,
          'status_bridging' => 1,
          'no_antrian' => $no_antrian,
          'jam_daftar' => date('H:i:s'),
          'NIK' => $_SESSION['nik'],
          'nourut_pcare' => $no_pcare,
          );
          // echo $cek_kunjungan->num_rows()." --> ".$no_pcare." ".$no_bpjs." ".$val->poli->kdPoli." ".$val->peserta->nama."<br>";
          $this->db->insert('kunjungan', $data_kunjunganPcare);
          $hari_ini = date("Y-m-d");
          $this->db->where('noRM',$pasien_noRM);
          $this->db->update('pasien',array('kunjungan_terakhir'=>$hari_ini));
        }
      }
    }


    function sinkronKunjungan_coba()
    {
      $url = "pendaftaran/tglDaftar/".date('d-m-Y')."/0/1000";
      // die($url);
      $response = json_decode(Pcare($url));
      $t = date("d-m-Y H:i:s");
      // echo date_default_timezone_get();
      $t = date("H:i:s",strtotime("+7 hour"));
      // die($t);
      echo "<pre>";
        print_r($response);
        echo "</pre>";
        die();
        //WHERE tgl = "2021-08-18" AND sumber_dana = "7" AND nourut_pcare = "1" kartu bpjs
        if ($response->metaData->code==200) {
          $list_data = $response->response->list;
          // echo json_encode($list_data);
          foreach ($list_data as $val) {
            $no_pcare = $val->noUrut;
            $no_bpjs = $val->peserta->noKartu;
            $pasien_noRM = $this->ModelPasien->cek_nobpjs($no_bpjs)["noRM"];
            if (empty($pasien_noRM)) {
              $pasien_noRM = $this->ModelPasien->generete_noRM();
              $data_pasien = array(
              // 'provinsi' => $this->input->post('provinsi'),
              // 'tinggal_dengan' => $tinggal_dengan,
              // 'status_kawin' => $this->input->post('perkawinan') ,
              'noRM' => $pasien_noRM,
              'noBPJS' => $no_bpjs,
              // 'noAsuransiLain' => $this->input->post('noAsuransiLain'),
              'namapasien' => strtoupper($val->peserta->nama),
              'tgl_lahir' => date("Y-m-d",strtotime($val->peserta->tglLahir)),
              'jenis_kelamin' => $val->peserta->sex,
              // 'agama' => $this->input->post('agama'),
              // 'suku' => $this->input->post('suku'),
              // 'alamat' => strtoupper($this->input->post('alamat')),
              // 'kota' => $this->input->post('kota'),
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
              $insert_data = $this->db->insert('pasien',$data_pasien);
            }
            $cek_kunjungan = $this->ModelKunjungan->cek_kunjungan_pcare(date("Y-m-d"), $no_pcare, $no_bpjs);
            if ($cek_kunjungan->num_rows() < 1) {
              $kode_tupel = $this->ModelTujuanPelayanan->get_kdpcare($val->poli->kdPoli)->row_array()['kode_tupel'];
              $no_antrian = 1;
              if ($this->ModelKunjungan->total($kode_tupel,7) > 0 ) {
                foreach ($this->ModelKunjungan->max_no($kode_tupel,7)->result() as $value) {
                  $no_antrian = $value->no_antrian + 1;
                }
              }
              $kunjungansakit = 1;
              if ($val->kunjSakit == true) {
                $kunjungansakit = 1;
              }else {
                $kunjungansakit = 0;
              }
              $sudah = 1;
              if ($val->status == "Baru") {
                $sudah = 0;
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
              'tupel_kode_tupel' => $kode_tupel,
              'jenis_kunjungan' => "1",
              'sumber_dana' => "7",
              'bb' => $bb,
              'tb' => $tb,
              'keluhan' => $val->keluhan,
              'sudah' => '0',
              'kunjungansakit' => (int)$kunjungansakit,
              'sistole' => 0,
              'diastole' => 0,
              'nadi' => 0,
              'rr' => 0,
              'pasien_noRM' => $pasien_noRM,
              'asal_pasien' => "Datang Sendiri",
              'administrasi' => 0,
              'status_deposit' => 1,
              'sudah' => $sudah,
              'status_bridging' => 1,
              'no_antrian' => $no_antrian,
              'jam_daftar' => $t,
              'NIK' => $_SESSION['nik'],
              'nourut_pcare' => $no_pcare,
              );
              // echo $cek_kunjungan->num_rows()." --> ".$no_pcare." ".$no_bpjs." ".$val->poli->kdPoli." ".$val->peserta->nama."<br>";
              $this->db->insert('kunjungan', $data_kunjunganPcare);
              $hari_ini = date("Y-m-d");
              $this->db->where('noRM',$pasien_noRM);
              $this->db->update('pasien',array('kunjungan_terakhir'=>$hari_ini));
            }
          }
        }
        redirect(base_url("Kunjungan"));
      }

      function filter_belum()
      {
        $tgl = $this->uri->segment(3);
        $no = 0;
        echo "<table id=\"example_blm\" class=\"datatables table table-striped table-hover table-bordered\">
          <thead>
            <tr>
              <th>#</th>
              <th>No Urut Pcare</th>
              <th>Pasien</th>
              <th>Keluhan</th>
              <th>BPJS</th>
              <th>No Asuransi lain</th>
              <th>Umur</th>
              <th>Tujuan</th>
              <th>Jam</th>
              <th>Jenis</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>";
            if ($_SESSION['poli']=="IGD") {
              $data_belum = $this->ModelKunjungan->get_data_ugd($tgl);
            }else{
              $data_belum = $this->ModelKunjungan->get_data($tgl);
            }
            foreach ($data_belum as $value) {
              $no++;
              $id_check = $value->no_urutkunjungan;
              $k = $value->kode_tupel;
              $warna = "badge-primary";
              $type = "IN";
              if ($k == "UMU"){$warna = "badge-success";$type = "U";}elseif ($k == "IGD") {$warna = "badge-danger";$type="IG";}elseif($k == "OBG"){$warna = "badge-info";$type = "O";}elseif ($k == "GIG") {$warna = "badge-warning";$type = "G";}
              if ($value->jenis_kunjungan == 1) {
                $jenis = "Lama";
              } else {
                $jenis = "Baru";
              }
              if ($value->status_deposit==1) {
                $depo = base_url()."Periksa/index/".$value->no_urutkunjungan;
                $depo_dis = "";
              }else{
                $depo = "#";
                $depo_dis = "disabled";
              }
              if($value->sumber_dana == 7){
                $jp = "<h4><span class='badge badge-pill badge-success'>".$value->jenis_pasien."</h4>";
                }else {
                  $jp = "<h4><span class='badge badge-pill badge-danger'>".$value->jenis_pasien."</h4>";
                  }
                  $umur = $this->Core->umur($value->tgl_lahir);
                  $noan = $value->sumber_dana==7?$value->kd_antrian_bpjs."".$value->no_antrian:$value->kd_antrian."".$value->no_antrian;
                  echo "
                  <tr>
                    <td>$noan</td>
                    <td>$value->nourut_pcare</td>
                    <td>$value->namapasien</td>
                    <td>$value->keluhan</td>
                    <td>$value->noBPJS</td>
                    <td>$value->noAsuransiLain</td>
                    <td>$umur</td>
                    <td><h4><span class=\"badge badge-pill $warna \">$value->tujuan_pelayanan</span></h4></td>
                    <td>$value->jam_daftar</td>
                    <td>$jp</td>
                    <td>
                      <a href='".$depo."'>
                        <button ".$depo_dis." type=\"button\" class=\"btn btn-primary ntn-sm periksa\">
                          <i class=\"fa fa-medkit\"></i> Periksa
                        </button>
                      </a>
                      <a href='".base_url()."Kunjungan/delete/".$value->no_urutkunjungan."'>
                        <button type=\"button\" class=\"btn btn-danger hapus-kunjungan btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-title=\"Hapus Kunjungan\" data-original-title=\"Hapus Data Pasien\">
                          <i class=\"fa fa-cut\"></i>
                        </button>
                      </a>
                      <a href='".base_url()."Pasien/edit/".$value->pasien_noRM."/".$value->no_urutkunjungan."'>
                        <button type=\"button\" class=\"btn btn-warning hapus-kunjungan btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-title=\"Edit Data Pasien\" data-original-title=\"Edit Kunjungan\">
                          <i class=\"fa fa-edit\"></i>
                        </button>
                      </a>
                      <a href=''>
                        <button type=\"button\" no_kun=\".$value->no_urutkunjungan.\" no_rm=\".$value->noRM.\" class=\"btn btn-primary ganti-kunjungan btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"Ganti Tujuan Pelayanan Pasien\">
                          <i class=\"fa fa-edit\"></i>
                        </button>
                      </a>
                    </td>
                  </tr>";
                }
                echo "</tbody>
              </table>";
            }

            function filter_sudah()
            {
              $tgl = $this->uri->segment(3);
              $no = 0;
              echo "<table id=\"example_sdh\" class=\"datatables table table-striped table-hover table-bordered\">
                <thead>
                  <tr>
                    <th>#asd</th>
                    <th>No Antrian</th>
                    <th>Antrian Pcare</th>
                    <th>Nama Pasien</th>

                    <th>Keluhan</th>
                    <th>BPJS</th>
                    <th>No Asuransi lain</th>
                    <th>Tujuan Pelayanan</th>
                    <th>Jam</th>
                    <th>Jenis</th>
                    <th class=\"periksa\">Opsi</th>

                  </tr>
                </thead>
                <tbody>";
                  if ($_SESSION['poli']=="IGD") {
                    $data_sudah = $this->ModelKunjungan->get_data_sudah_ugd($tgl);
                  }else{
                    $data_sudah = $this->ModelKunjungan->get_data_sudah($tgl);
                  }
                  foreach ($data_sudah as $value) {
                    $no++;
                    $id_check = $value->no_urutkunjungan;
                    $k = $value->kode_tupel;
                    $warna = "badge-primary";
                    $type = "IN";
                    if ($k == "UMU"){$warna = "badge-success";$type = "U";}elseif ($k == "IGD") {$warna = "badge-danger";$type="IG";}elseif($k == "OBG"){$warna = "badge-info";$type = "O";}elseif ($k == "GIG") {$warna = "badge-warning";$type = "G";}
                    if ($value->jenis_kunjungan == 1) {
                      $jenis = "Lama";
                    } else {
                      $jenis = "Baru";
                    }
                    if ($value->sudah == 1) {
                      $status = "Sudah Diperiksa";
                    } elseif ($value->sudah == 2) {
                      $status = "Pelayanan TINDAKAN";
                    } elseif ($value->sudah == 3) {
                      $status = "Permintaan Laborat";
                    } elseif ($value->sudah == 4) {
                      $status = "Pengambilan Resep";
                    } elseif ($value->sudah == 5) {
                      $status = "Pasien Pulang";
                    }
                    if ($value->siap_pulang==0) {
                      $pulang = '<a href="'.base_url()."Periksa/pulang/".$value->no_urutkunjungan.'">
                        <button type="button" class="btn btn-success periksa">
                          <i class="fa fa-home"></i> Siap Pulang
                        </button>
                      </a>';
                    }else{
                      $pulang = "";
                    }
                    if ($value->status_deposit==1) {
                      $depo = base_url()."Periksa/index/".$value->no_urutkunjungan;
                      $depo_dis = "";
                    }else{
                      $depo = "#";
                      $depo_dis = "disabled";
                    }
                    if($value->sumber_dana == 7){
                      $jp = "<h4><span class='badge badge-pill badge-success'>".$value->jenis_pasien."</h4>";
                      }else {
                        $jp = "<h4><span class='badge badge-pill badge-danger'>".$value->jenis_pasien."</h4>";
                        }
                        $umur = $this->Core->umur($value->tgl_lahir);
                        echo '
                        <tr>
                          <td>'.$no.'</td>
                          <td>'.$value->kd_antrian." ".$value->no_antrian.'</td>
                          <td>'.$value->nourut_pcare.'</td>
                          <td>'.$value->namapasien.'</td>
                          <td>'.$value->keluhan.'</td>
                          <td>'.$value->noBPJS.'</td>
                          <td>'.$value->noAsuransiLain.'</td>
                          <td><h4><span class="badge badge-pill '.$warna.' ">'.$value->tujuan_pelayanan.'</span></h4></td>
                          <td>'.$value->jam_daftar.'</td>
                          <td>'.$jp.'</td>
                          <td class="periksa">
                            <a href="'.base_url().'Periksa/index/'.$value->no_urutkunjungan.'">
                              <button type="button" class="btn btn-sm btn-primary periksa" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Periksa">
                                <i class="fa fa-stethoscope"></i>
                              </button>
                            </a>
                          </td>
                        </tr>';
                      }
                      echo "</tbody>
                    </table>";
                  }

                  function tgl()
                  {
                    echo date('Y-m-d');
                  }

                  function no_urut(){
                    $tupel = $this->uri->segment(3);
                    $sumber_dana = $this->uri->segment(4);
                    $no_antrian = null;
                    if ($this->ModelKunjungan->total($tupel,$sumber_dana) > 0 ) {
                      foreach ($this->ModelKunjungan->max_no($tupel,$sumber_dana)->result() as $value) {
                        $no_antrian = $value->no_antrian;
                      }
                    } else {
                      $no_antrian = 0;
                    }
                    echo $no_antrian;
                  }

                  function input()
                  {
                    $tupel = $this->input->post('tujuan_pelayanan');
                    $no_antrian = null;
                    if ($this->ModelKunjungan->total("UMU",1) > 0 ) {
                      foreach ($this->ModelKunjungan->max_no("UMU",1)->result() as $value) {
                        $no_antrian = $value->no_antrian;
                      }
                    } else {
                      $no_antrian = 0;
                    }

                    $data = array(
                    'form' => 'Kunjungan/form',
                    'body' => 'Kunjungan/input',
                    'tupel' => $this->ModelTujuanPelayanan->get_poli_sakit(),
                    'tempat_tidur' => $this->ModelTempatTidur->get_data(),
                    'pasien' => $this->ModelPasien->get_data(),
                    'no_antrian' => $no_antrian,
                    'jenis_pasien' => $this->ModelJenisPasien->get_data(),
                    'noRM' => $this->ModelPasien->generete_noRM(),
                    'list_pekerjaan' => $this->ModelPekerjaan->get_data(),
                    );
                    $this->load->view('index',$data);
                  }

                  public function hitung_riwayat($noRM)
                  {
                    $hitung_riwayat = $this->ModelKunjungan->riwayat($noRM)->num_rows();
                    echo $hitung_riwayat;
                  }

                  // public function insert()
                  // {
                  //   @$binaan = @$this->db->where("pasien_noRM", $this->data_kunjungan['pasien_noRM'])->get("pasien_binaan")->row_array();
                  //   $idkb_perawat = $binaan['kb_perawat_idkb_perawat'];
                  //   $pasien = $this->ModelPasien->get_data_edit($this->data_kunjungan['pasien_noRM'])->row_array();
                  //   // die(var_dump($this->data_kunjungan['kunjungansakit']));
                  //   $tupel = $this->input->post('tujuan_pelayanan');
                  //   $no_antrian = null;
                  //   if ($this->ModelKunjungan->total($tupel,$pasien['jenis_pasien_kode_jenis']) > 0 ) {
                  //     foreach ($this->ModelKunjungan->max_no($tupel,$pasien['jenis_pasien_kode_jenis'])->result() as $value) {
                  //       $no_antrian = $value->no_antrian + 1;
                  //     }
                  //   } else {
                  //     $no_antrian = 1;
                  //   }
                  //   $this->data_kunjungan['NIK'] = $_SESSION['nik'];
                  //   $this->data_kunjungan['jam_daftar'] = date('H:i:s');
                  //   $this->data_kunjungan['no_antrian'] = $no_antrian;
                  //   if ($pasien['tgl_daftar']!=date("Y-m-d")) {
                  //     $this->data_kunjungan['administrasi'] =1;
                  //   }
                  //   if ($pasien['jenis_pasien_kode_jenis']==7) {
                  //     $cek_kunjungan = $this->db->get_where("kunjungan",array(
                  //     "pasien_noRM"=>$this->data_kunjungan['pasien_noRM'],
                  //     'tgl'=>date("Y-m-d"),
                  //     'tupel_kode_tupel'=>$this->data_kunjungan['tupel_kode_tupel']))->num_rows();
                  //     if ($cek_kunjungan>0) {
                  //       $this->data_kunjungan['status_bridging'] = 1;
                  //       // $this->session->set_flashdata('notif', $this->Notif->gagal('Pasien telah berkunjung pada poli yang sama hari ini'));
                  //       // redirect(base_url().'Kunjungan');
                  //     }
                  //   }
                  //   if ($this->db->insert('kunjungan', $this->data_kunjungan)) {
                  //     $idkun = $this->db->insert_id();
                  //
                  //     if ($this->ModelKBinaan->cekPasien($this->data_kunjungan['pasien_noRM'])->num_rows() > 0) {
                  //       if ($this->ModelKBinaan->getKunjungan($this->data_kunjungan['pasien_noRM'], date("Y-m"))->num_rows() <= 0) {
                  //         $idkun = $this->db->insert_id();
                  //         $data_kbk = array(
                  //         'pasien_binaan_idpasien_binaan' => $binaan['idpasien_binaan'],
                  //         'pegawai_NIK'                   => $_SESSION['nik'],
                  //         'status_kunjungan'              => "2",
                  //         'tanggal'                       => date("Y-m-d"),
                  //         'waktu'                         => date("H:i:s"),
                  //         );
                  //         $this->db->insert("kb_kunjungan", $data_kbk);
                  //       }
                  //     }
                  //
                  //     $this->db->reset_query();
                  //     $hari_ini = date("Y-m-d");
                  //     $this->db->where('noRM',$this->data_kunjungan['pasien_noRM']);
                  //     $this->db->update('pasien',array('kunjungan_terakhir'=>$hari_ini));
                  //     $this->load->view("vendor/autoload.php");
                  //     $options = array(
                  //     'cluster' => 'ap1',
                  //     'useTLS' => true
                  //     );
                  //     $pusher = new Pusher\Pusher(
                  //     '675f0026406b7776bd51',
                  //     'd1653951c9960b175c0b',
                  //     '957846',
                  //     $options
                  //     );
                  //     $pasien = $this->ModelPasien->get_data_edit($this->data_kunjungan['pasien_noRM'])->row_array();
                  //     $jenis_pasien = $this->db->get_where("jenis_pasien",array('kode_jenis'=>$this->data_kunjungan['sumber_dana']))->row_array();
                  //     $no_kunjungan = $this->db
                  //     ->select_max('no_urutkunjungan')->get('kunjungan')->row_array();
                  //     $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($tupel)->row_array();
                  //     $this->data_kunjungan['nama'] = $pasien['namapasien'];
                  //     $this->data_kunjungan['tujuan_pelayanan'] = $tujuan_pelayanan['tujuan_pelayanan'];
                  //     $this->data_kunjungan['noBPJS'] = $pasien['noBPJS'];
                  //     $this->data_kunjungan['umur'] = $this->Core->umur($pasien['tgl_lahir']);
                  //     $this->data_kunjungan['kd_antrian'] = $tujuan_pelayanan['kd_antrian'];
                  //     $this->data_kunjungan['jp'] = $jenis_pasien['jenis_pasien'];
                  //     $this->data_kunjungan['badge'] = $jenis_pasien['kode_jenis']==7?'<h4><span class="badge badge-pill badge-success">'.$jenis_pasien['jenis_pasien'].'</span><h4>':'<h4><span class="badge badge-pill badge-danger">'.$jenis_pasien['jenis_pasien'].'</span><h4>';
                  //
                  //       $this->data_kunjungan['url'] = base_url()."Periksa/index/".$no_kunjungan['no_urutkunjungan'];
                  //       // $this->data_kunjungan['url'] = "#";
                  //       $pusher->trigger('ci_pusher', 'my-event',$this->data_kunjungan);
                  //
                  //       if ($pasien['jenis_pasien_kode_jenis']==7 && $this->data_kunjungan['tupel_kode_tupel']!="IGD" ) {
                  //         //pcare
                  //         $sehat = $this->input->post("kunj_sehat");
                  //         $provider = $this->Core->get_pcare();
                  //         $pasien['noBPJS'] = strlen($pasien['noBPJS'])>13?trim($pasien['noBPJS']):str_pad($pasien['noBPJS'],13,"0",STR_PAD_LEFT);
                  //         if (strlen($pasien['noBPJS'])> 13) {
                  //           $this->db->where("noRM",$pasien['noRM'])->update("pasien",array('noBPJS'=>$pasien['noBPJS']));
                  //         }
                  //         if (strlen($pasien['noBPJS'])< 13) {
                  //           $this->db->where("noRM",$pasien['noRM'])->update("pasien",array('noBPJS'=>$pasien['noBPJS']));
                  //         }
                  //         $bridge = PcareV4("peserta/".$pasien['noBPJS']);
                  //         $data_pcare = array(
                  //         "kdProviderPeserta" => $bridge->response->kdProviderPst->kdProvider,
                  //         "tglDaftar"         => date("d-m-Y",strtotime($this->data_kunjungan['tgl'])),
                  //         "noKartu"           => $pasien['noBPJS'],
                  //         "kdPoli"            => $tujuan_pelayanan['kdpcare'],
                  //         "keluhan"           => $this->data_kunjungan['keluhan'],
                  //         "kunjSakit"         => $this->data_kunjungan['kunjungansakit']==1?true:false,
                  //         "sistole"           => 0,
                  //         "diastole"          => 0,
                  //         "beratBadan"        => $this->data_kunjungan['bb'],
                  //         "tinggiBadan"       => $this->data_kunjungan['tb'],
                  //         "respRate"          => 0,
                  //         "lingkarPerut"      => 0,
                  //         "heartRate"         => 0,
                  //         "rujukBalik"        => 0,
                  //         "kdTkp"             => 10
                  //         );
                  //
                  //         // echo json_encode($data_pcare);
                  //         // $bridge = PcareV4("pendaftaran","POST","text/plain", json_encode($data_pcare));
                  //         // echo json_encode($bridge);
                  //       echo json_encode($data_pcare);
                  //         // die(var_dump(($bridge)));
                  //         // $bridge = json_decode($bridge);
                  //         // if ($bridge->metaData->code==201) {
                  //         //   $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan Dan Bridging'));
                  //         //   $this->db->where("no_urutkunjungan",$no_kunjungan['no_urutkunjungan'])->update("kunjungan",array("nourut_pcare"=>$bridge->response->message,"status_bridging"=>1));
                  //         //   // die(var_dump($bridge));
                  //         // }else{
                  //         //   if ($bridge->metaData->code==412) {
                  //         //     // code...
                  //         //     $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->response[0]->field." ".$bridge->response[0]->message.' '.$bridge->metaData->message));
                  //         //   }else{
                  //         //     $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->metaData->message));
                  //         //
                  //         //   }
                  //         //
                  //         // }
                  //       }else{
                  //         // $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
                  //       }
                  //
                  //       // redirect(base_url().'Kunjungan');
                  //     } else {
                  //       // echo "salah";
                  //     }
                  //
                  //
                  //   }

                    public function insert2()
                    {
                      @$binaan = @$this->db->where("pasien_noRM", $this->data_kunjungan['pasien_noRM'])->get("pasien_binaan")->row_array();
                      $idkb_perawat = $binaan['kb_perawat_idkb_perawat'];
                      $pasien = $this->ModelPasien->get_data_edit($this->data_kunjungan['pasien_noRM'])->row_array();
                      // die(var_dump($this->data_kunjungan['kunjungansakit']));
                      $tupel = $this->input->post('tujuan_pelayanan');
                      $no_antrian = null;
                      if ($this->ModelKunjungan->total($tupel,$pasien['jenis_pasien_kode_jenis']) > 0 ) {
                        foreach ($this->ModelKunjungan->max_no($tupel,$pasien['jenis_pasien_kode_jenis'])->result() as $value) {
                          $no_antrian = $value->no_antrian + 1;
                        }
                      } else {
                        $no_antrian = 1;
                      }
                      $this->data_kunjungan['NIK'] = $_SESSION['nik'];
                      $this->data_kunjungan['jam_daftar'] = date('H:i:s');
                      $this->data_kunjungan['no_antrian'] = $no_antrian;
                      if ($pasien['tgl_daftar']!=date("Y-m-d")) {
                        $this->data_kunjungan['administrasi'] =1;
                      }
                      if ($pasien['jenis_pasien_kode_jenis']==7) {
                        $cek_kunjungan = $this->db->get_where("kunjungan",array(
                        "pasien_noRM"=>$this->data_kunjungan['pasien_noRM'],
                        'tgl'=>date("Y-m-d"),
                        'tupel_kode_tupel'=>$this->data_kunjungan['tupel_kode_tupel']))->num_rows();
                        if ($cek_kunjungan>0) {
                          $this->data_kunjungan['status_bridging'] = 1;
                          $this->session->set_flashdata('notif', $this->Notif->gagal('Pasien telah berkunjung pada poli yang sama hari ini'));
                          redirect(base_url().'Kunjungan');
                        }
                      }
                      // echo json_encode($this->data_kunjungan); die();
                      if ($this->db->insert('kunjungan', $this->data_kunjungan)) {
                        $idkun = $this->db->insert_id();

                        // echo json_encode($idkun);
                        if ($this->ModelKBinaan->cekPasien($this->data_kunjungan['pasien_noRM'])->num_rows() > 0) {
                          if ($this->ModelKBinaan->getKunjungan($this->data_kunjungan['pasien_noRM'], date("Y-m"))->num_rows() <= 0) {
                            $idkun = $this->db->insert_id();
                            $data_kbk = array(
                            'pasien_binaan_idpasien_binaan' => $binaan['idpasien_binaan'],
                            'pegawai_NIK'                   => $_SESSION['nik'],
                            'status_kunjungan'              => "2",
                            'tanggal'                       => date("Y-m-d"),
                            'waktu'                         => date("H:i:s"),
                            );
                            $this->db->insert("kb_kunjungan", $data_kbk);
                            // echo json_encode($data_kbk);
                          }
                        }

                        $this->db->reset_query();
                        $hari_ini = date("Y-m-d");
                        $this->db->where('noRM',$this->data_kunjungan['pasien_noRM']);
                        $this->db->update('pasien',array('kunjungan_terakhir'=>$hari_ini));
                        $this->load->view("vendor/autoload.php");
                        $options = array(
                        'cluster' => 'ap1',
                        'useTLS' => true
                        );
                        $pusher = new Pusher\Pusher(
                        '675f0026406b7776bd51',
                        'd1653951c9960b175c0b',
                        '957846',
                        $options
                        );
                        $pasien = $this->ModelPasien->get_data_edit($this->data_kunjungan['pasien_noRM'])->row_array();
                        $jenis_pasien = $this->db->get_where("jenis_pasien",array('kode_jenis'=>$this->data_kunjungan['sumber_dana']))->row_array();
                        $no_kunjungan = $this->db
                        ->select_max('no_urutkunjungan')->get('kunjungan')->row_array();
                        $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($tupel)->row_array();
                        $this->data_kunjungan['nama'] = $pasien['namapasien'];
                        $this->data_kunjungan['tujuan_pelayanan'] = $tujuan_pelayanan['tujuan_pelayanan'];
                        $this->data_kunjungan['noBPJS'] = $pasien['noBPJS'];
                        $this->data_kunjungan['umur'] = $this->Core->umur($pasien['tgl_lahir']);
                        $this->data_kunjungan['kd_antrian'] = $tujuan_pelayanan['kd_antrian'];
                        $this->data_kunjungan['jp'] = $jenis_pasien['jenis_pasien'];
                        $this->data_kunjungan['badge'] = $jenis_pasien['kode_jenis']==7?'<h4><span class="badge badge-pill badge-success">'.$jenis_pasien['jenis_pasien'].'</span><h4>':'<h4><span class="badge badge-pill badge-danger">'.$jenis_pasien['jenis_pasien'].'</span><h4>';

                          $this->data_kunjungan['url'] = base_url()."Periksa/index/".$no_kunjungan['no_urutkunjungan'];
                          // $this->data_kunjungan['url'] = "#";
                          $pusher->trigger('ci_pusher', 'my-event',$this->data_kunjungan);
                          // echo json_encode($pasien);
                          //
                          if ($pasien['jenis_pasien_kode_jenis']==7 && $this->data_kunjungan['tupel_kode_tupel']!="IGD" ) {
                            //pcare
                            $sehat = $this->input->post("kunj_sehat");
                            $provider = $this->Core->get_pcare();
                            $pasien['noBPJS'] = strlen($pasien['noBPJS'])>13?trim($pasien['noBPJS']):str_pad($pasien['noBPJS'],13,"0",STR_PAD_LEFT);
                            if (strlen($pasien['noBPJS'])> 13) {
                              $this->db->where("noRM",$pasien['noRM'])->update("pasien",array('noBPJS'=>$pasien['noBPJS']));
                            }
                            if (strlen($pasien['noBPJS'])< 13) {
                              $this->db->where("noRM",$pasien['noRM'])->update("pasien",array('noBPJS'=>$pasien['noBPJS']));
                            }
                            $bridge_get_kdProviderPst = PcareV4("peserta/".$pasien['noBPJS']);
                            if ($bridge_get_kdProviderPst->response !=''||$bridge_get_kdProviderPst->response !=null) {
                              if ($bridge_get_kdProviderPst->response->kdProviderPst->kdProvider !=''||$bridge_get_kdProviderPst->response->kdProviderPst->kdProvider !=null) {
                                $data_pcare = array(
                                // "kdProviderPeserta" => "0189B016",
                                "kdProviderPeserta" => $bridge_get_kdProviderPst->response->kdProviderPst->kdProvider,
                                "tglDaftar"         => date("d-m-Y",strtotime($this->data_kunjungan['tgl'])),
                                "noKartu"           => $pasien['noBPJS'],
                                "kdPoli"            => $tujuan_pelayanan['kdpcare'],
                                "keluhan"           => $this->data_kunjungan['keluhan'],
                                "kunjSakit"         => $this->data_kunjungan['kunjungansakit']==1?true:false,
                                "sistole"           => intval($this->data_kunjungan['sistole']),
                                "diastole"          => intval($this->data_kunjungan['diastole']),
                                "beratBadan"        => intval($this->data_kunjungan['bb']),
                                "tinggiBadan"       => intval($this->data_kunjungan['tb']),
                                "respRate"          => intval($this->data_kunjungan['rr']),
                                "lingkarPerut"      => intval($this->input->post('lingkarPerut')),
                                "heartRate"         => intval($this->data_kunjungan['heartRate']),
                                "rujukBalik"        => 0,
                                "kdTkp"             => "10"
                                );
                                $bridge_pendaftaran = PcareV4("pendaftaran","POST","text/plain", json_encode($data_pcare));
                                if (@$bridge_pendaftaran->metaData->code==201) {
                                  $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan Dan Bridging'));
                                  $this->db->where("no_urutkunjungan",$no_kunjungan['no_urutkunjungan'])->update("kunjungan",array("nourut_pcare"=>@$bridge_pendaftaran->response->message,"status_bridging"=>1));
                                }else{
                                  if (@$bridge_pendaftaran->metaData->code==412) {
                                    $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.@$bridge_pendaftaran->response[0]->field." ".@$bridge_pendaftaran->response[0]->message.' '.@$bridge_pendaftaran->metaData->message));
                                  }else{
                                    $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.@$bridge_pendaftaran->metaData->message));
                                  }

                                }
                              }else {
                                $this->session->set_flashdata('notif', $this->Notif->gagal('Data Disimpan, namun gagal bridging kode provider peserta '.@$bridge_get_kdProviderPst->response->kdProviderPst->kdProvider));
                              }

                            } else {
                              $this->session->set_flashdata('notif', $this->Notif->warning()('Data Disimpan Namun Gagal Bridging, response '.@$bridge_pendaftaran->response));
                            }
                          }else{
                            $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
                          }

                          redirect(base_url().'Kunjungan');
                        } else {
                          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
                          redirect(base_url().'Kunjungan');
                        }
                    }

                    public function bridge_ulang(){
                      //pcare
                      $id = $this->uri->segment(3);
                      $data = $this->db
                      ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
                      ->where("no_urutkunjungan",$id)->get("kunjungan")
                      ->row_array();
                      $dokter = $this->db->get_where("pegawai",array("NIK"=>$data["NIK"]))->row_array();
                      $periksa = $this->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id))->row_array();
                      $diagnosa = $this->db->get_where("diagnosa",array("periksa_idperiksa"=>$periksa["idperiksa"]))->row_array();
                      $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($data['tupel_kode_tupel'])->row_array();
                      $data['noBPJS'] = strlen($data['noBPJS'])>13?trim($data['noBPJS']):str_pad($data['noBPJS'],13,"0",STR_PAD_LEFT);
                      if (strlen($data['noBPJS'])> 13) {
                        $this->db->where("noRM",$data['noRM'])->update("pasien",array('noBPJS'=>$data['noBPJS']));
                      }
                      if (strlen($data['noBPJS'])< 13) {
                        $this->db->where("noRM",$data['noRM'])->update("pasien",array('noBPJS'=>$data['noBPJS']));
                      }
                      $no = $data['noBPJS'];
                      // $no = "0001541606308";
                      $url = "peserta/".$no;
                      // $response = json_decode(Pcare($url));
                      $response = PcareV4($url);
                      $provider = $this->Core->get_pcare();
                      // die(var_dump($response));
                      if (@$response->metaData->code==200){
                        if ($response->response->kdProviderPst->kdProvider!=null) {
                          $pro = @$response->response->kdProviderPst->kdProvider;
                          // code...
                        }else {
                          // code...
                          $pro = @$provider['kdppk'];
                        }
                        // $pro = @$response->response->kdProviderPst->kdProvider;
                      }else{
                        $pro = @$provider['kdppk'];
                      }
                      $data_pcare = array(
                      "kdProviderPeserta" => $pro,
                      "tglDaftar"         => date("d-m-Y",strtotime($data['tgl'])),
                      "noKartu"           => $data['noBPJS'],
                      "kdPoli"            => $tujuan_pelayanan['kdpcare'],
                      "keluhan"           => $data['keluhan'],
                      "kunjSakit"         => $data['kunjungansakit']==1?true:false,
                      "sistole"           => intval($data['sistole']),
                      "diastole"          => intval($data['diastole']),
                      "beratBadan"        => intval($data['bb']),
                      "tinggiBadan"       => intval($data['tb']),
                      "respRate"          => intval($data['rr']),
                      "lingkarPerut"      => intval($data['lingkar_perut']),
                      "heartRate"         => intval($data['heartRate']),
                      "rujukBalik"        => 0,
                      "kdTkp"             => "10"
                      );

                      // die(var_dump($data_pcare));
                      $bridge = PcareV4("pendaftaran","POST"," text/plain",json_encode($data_pcare));
                      // $bridge = $bridge;
                    //   die(var_dump($bridge));
                    // echo json_encode($bridge);

                      if ($bridge->metaData->code==201) {
                        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan Dan Bridging'));
                        $this->db->where("no_urutkunjungan",$id);
                        $this->db->update("kunjungan",array("nourut_pcare"=>$bridge->response->message,"status_bridging"=>1));
                      }else{
                        if ($bridge->metaData->code==428) {
                          $this->db->where("no_urutkunjungan",$id);
                        $this->db->update("kunjungan",array("status_bridging"=>1));
                          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.@$bridge->response));
                        }else if ($bridge->metaData->code==412) {
                          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.@$bridge->response->field." ".@$bridge->response->message.' '.@$bridge->metaData->message));
                          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.@$bridge->response->field." ".@$bridge->response->message.' '.@$bridge->metaData->message));
                        }else{
                          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.@$bridge->metaData->message));
                        }
                      }
                      redirect("Kunjungan");
                    }

                    public function ganti_tupel()
                    {
                      $tupel = $this->input->post('tupel');
                      $nokun = $this->input->post("nokun");
                      $no_rm = $this->input->post("no_rm");
                      $no_antrian = null;
                      $pasien = $this->ModelPasien->get_data_edit($no_rm)->row_array();
                      if ($this->ModelKunjungan->total($tupel,$pasien['jenis_pasien_kode_jenis']) > 0 ) {
                        foreach ($this->ModelKunjungan->max_no($tupel,$pasien['jenis_pasien_kode_jenis'])->result() as $value) {
                          $no_antrian = $value->no_antrian + 1;
                        }
                      } else {
                        $no_antrian = 1;
                      }
                      // $data_update['NIK'] = $_SESSION['nik'];
                      // $data_update['jam_daftar'] = date('H:i:s');
                      $data_update['no_antrian'] = $no_antrian;
                      $data_update['tupel_kode_tupel'] = $tupel;
                      $data_update['sumber_dana'] = $this->input->post("jenis");
                      $this->db->where('no_urutkunjungan',$nokun);
                      if ($this->db->update('kunjungan', $data_update)) {
                        // $this->db->where('noRM',$data_kunjungan['pasien_noRM']);
                        // $this->db->update('pasien',array('kunjungan_terakhir'=>date("Y-m-d")));
                        $this->load->view("vendor/autoload.php");
                        $options = array(
                        'cluster' => 'ap1',
                        'useTLS' => true
                        );
                        $pusher = new Pusher\Pusher(
                        '675f0026406b7776bd51',
                        'd1653951c9960b175c0b',
                        '957846',
                        $options
                        );
                        // die(var_dump($pasien));
                        $no_kunjungan = $this->db->where('no_urutkunjungan',$nokun)->get('kunjungan')->row_array();
                        $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($tupel)->row_array();
                        $data_update['nama'] = $pasien['namapasien'];
                        $data_update['pasien_noRM'] = $no_rm;
                        $data_update['jenis_kunjungan'] = $no_kunjungan['jenis_kunjungan'];
                        $data_update['jam_daftar'] = $no_kunjungan['jam_daftar'];
                        $data_update['tujuan_pelayanan'] = $tujuan_pelayanan['tujuan_pelayanan'];
                        $data_update['url'] = base_url()."Periksa/index/".$no_kunjungan['no_urutkunjungan'];
                        $pusher->trigger('ci_pusher', 'my-event',$data_update);
                        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
                        redirect(base_url().'Kunjungan');
                      } else {
                        echo "salah";
                      }


                    }




                    public function edit_keluhan()
                    {
                      $nokun = $this->input->post("nokun");
                      $keluhan = $this->input->post("keluhan");
                      $bb = $this->input->post("bb");
                      $tb = $this->input->post("tb");
                      $imt = $this->input->post("imt");
                      $sistole = $this->input->post("sistole");
                      $diastole = $this->input->post("diastole");
                      $nadi = $this->input->post("nadi");
                      $rr = $this->input->post("rr");
                      $spo2 = $this->input->post("spo2");


                      $data = array(
                      'keluhan' => $keluhan,
                      'bb' => $bb,
                      'tb' => $tb,
                      'imt' => $imt,
                      'sistole' => $sistole,
                      'diastole' => $diastole,
                      'heartRate' => $nadi,
                      'nadi' => $nadi,
                      'rr' => $rr,
                      'spo2' => $spo2
                      );
                      $this->db->where('no_urutkunjungan',$nokun);
                      if ($this->db->update('kunjungan', $data)) {
                        // $this->db->where('noRM',$data_kunjungan['pasien_noRM']);
                        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
                        redirect(base_url().'Kunjungan');
                      } else {
                        echo "salah";
                      }


                    }
                    public function edit()
                    {
                      $id = $this->uri->segment(3);
                      $data = array(
                      'form' => 'Kunjungan/form',
                      'body' => 'Kunjungan/edit',
                      // 'jenis_pasien' => $this->ModelJenisPasien->get_data(),
                      // 'pasien' => $this->ModelPasien->get_data_edit($noRM)->row_array(),
                      'tupel' => $this->ModelTujuanPelayanan->get_data(),
                      'tempat_tidur' => $this->ModelTempatTidur->get_data(),
                      'kunjungan' => $this->ModelKunjungan->get_data_edit($id)

                      );
                      $this->load->view('index', $data);
                    }

                    public function update()
                    {
                      $nik = $this->input->post('no_urutkunjungan_id');
                      $this->db->where('no_urutkunjungan',$no_urutkunjungan);
                      if ($this->db->update('kunjungan', $this->data_kunjungan)) {
                        // code...
                      } else {
                        // code...
                      }

                    }

                    function delete()
                    {
                      $no_urutkunjungan = $this->uri->segment(3);
                      $kunjungan = $this->db
                      ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
                      ->where('no_urutkunjungan', $no_urutkunjungan)->get('kunjungan')->row_array();
                      if ($kunjungan['sudah']>=1) {
                        $this->session->set_flashdata('notif', $this->Notif->gagal('Tidak dapat menghapus data kunjungan ini'));
                      }else{
                        $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
                        if ($kunjungan['nourut_pcare'] != NULL) {
                          $url = "pendaftaran/peserta/".$pasien['noBPJS']."/tglDaftar/".date("d-m-Y",strtotime($kunjungan['tgl']))."/noUrut/".$kunjungan['nourut_pcare']."/kdPoli/".$kunjungan['kdpcare'];
                          $bridge = PCare($url,'DELETE');
                        }
                        // die(var_dump($bridge));
                        $this->db->where_in('no_urutkunjungan', $no_urutkunjungan);
                        $delete = $this->db->delete('kunjungan');
                        if ($delete == true) {
                          $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Hapus Data Kunjungan'));
                        }else{
                          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Hapus Data Kunjungan, Pasien Sudah Di Periksa!!!'));
                        };
                      }
                      redirect(base_url().'Kunjungan');

                    }

                    public function delete2()
                    {
                      $no_urutkunjungan = $this->uri->segment(3);
                      $kunjungan = $this->db
                      ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
                      ->where('no_urutkunjungan', $no_urutkunjungan)->get('kunjungan')->row_array();
                      // echo json_encode($kunjungan);
                      if ($kunjungan['sudah']>=1) {
                        // echo json_encode("a");
                        $this->session->set_flashdata('notif', $this->Notif->gagal('Tidak dapat menghapus data kunjungan ini'));
                      }else{
                        // echo json_encode("b");
                        $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
                        // echo json_encode($pasien);

                        if ($kunjungan['nourut_pcare'] != NULL) {
                          // echo json_encode("c");
                          $url =  "pendaftaran/peserta/".$pasien['noBPJS']."/tglDaftar/".date("d-m-Y",strtotime($kunjungan['tgl']))."/noUrut/".$kunjungan['nourut_pcare']."/kdPoli/".$kunjungan['kdpcare'];
                          $bridge = PcareV4($url,'DELETE');
                          // echo json_encode($url);
                        }
                        $this->db->where_in('no_urutkunjungan', $no_urutkunjungan);
                        $delete = $this->db->delete('kunjungan');
                        // echo json_encode($delete);
                        if ($delete == true) {
                          $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Hapus Data Kunjungan'));
                        }else{
                          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Hapus Data Kunjungan, Pasien Sudah Di Periksa!!!'));
                        };
                      }
                      redirect(base_url().'Kunjungan');

                    }


                    function get_data_pasien()
                    {
                      $list = $this->ModelPasien->get_datatables();
                      $data = array();
                      $no = $_POST['start'];
                      foreach ($list as $field) {
                        $no++;
                        $row = array();
                        $row[] = $no;
                        $row[] = $field->noBPJS;
                        $row[] = $field->namapasien;

                        $row[] = $field->jenis_kelamin;
                        $row[] = $this->Core->umur($field->tgl_lahir);
                        $row[] = $field->alamat;
                        $row[] = $field->telepon;
                        $row[] = "<button data-dismiss=\"modal\" onclick=\"pilih_pasien('$field->noRM', '".str_replace("'","",$field->namapasien)."','".str_replace("'","",$field->alamat)."' ,'$field->jenis_pasien_kode_jenis')\" type=\"button\" class=\"btn btn-circle btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Pilih\">
                          <i class=\"fa fa-edit\"></i>
                        </button>";

                        $data[] = $row;
                      }

                      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->ModelPasien->count_all(),
                      "recordsFiltered" => $this->ModelPasien->count_filtered(),
                      "data" => $data,
                      );
                      //output dalam format JSON
                      echo json_encode($output);
                    }


                    public function bridge_ulang_pemeriksaan(){
                      $id= $this->uri->segment(3);
                      $data = $this->db
                      ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
                      ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
                      ->where("no_urutkunjungan",$id)->get("kunjungan")
                      ->row_array();
                      // die(var_dump($data));
                      $kesadaran = array(
                      'KOMPOMENTIS' => "01",
                      'SAMNOLENSE' => "02",
                      'STUPOR' => "03",
                      'KOMA' => "04"

                      );
                      $periksa = $this->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id))->row_array();
                      $dokter = $this->db->get_where("pegawai",array("NIK"=>$periksa["operator"]))->row_array();
                      $diagnosa = $this->db->get_where("diagnosa",array("periksa_idperiksa"=>$periksa["idperiksa"]))->row_array();
                      $data['noBPJS'] = strlen($data['noBPJS'])>13?trim($data['noBPJS']):str_pad($data['noBPJS'],13,"0",STR_PAD_LEFT);
                      if (strlen($data['noBPJS'])> 13) {
                        $this->db->where("noRM",$data['noRM'])->update("pasien",array('noBPJS'=>$data['noBPJS']));
                      }
                      if (strlen($data['noBPJS'])< 13) {
                        $this->db->where("noRM",$data['noRM'])->update("pasien",array('noBPJS'=>$data['noBPJS']));
                      }
                      $data_pcare = array(
                      "noKunjungan" => null,
                      "noKartu"     => $data['noBPJS'],
                      "tglDaftar"   => date("d-m-Y",strtotime($data['tgl'])),
                      "kdPoli"      => $data['kdpcare'],
                      "keluhan"     => $data['keluhan'],
                      "kdSadar"     => $periksa['osadar']==NULL?"01":$kesadaran[$periksa['osadar']],
                      // "sistole"     => $periksa["osiastole"],
                      // "diastole"    => $periksa["odiastole"],
                      "sistole"     => $periksa["osiastole"]==NULL?120:$periksa["osiastole"],
                      "diastole"    => $periksa["odiastole"]==NULL?75:$periksa["odiastole"],
                      "beratBadan"  => $data['bb']==NULL?0:intval($data["bb"]),
                      "tinggiBadan" => $data["tb"]==NULL?0:intval($data["tb"]),
                      // "respRate"    => $periksa["orr"],
                      // "heartRate"   => $periksa["onadi"],
                      "respRate"    => $periksa["orr"]==NULL?18:$periksa["orr"],
                      "heartRate"   => $periksa["onadi"]==NULL?80:$periksa["onadi"],
                      "lingkarPerut"   => $periksa["olingkar_perut"]==NULL?0:intval($periksa["olingkar_perut"]),

                      "terapi"      => $periksa["oterapi"],
                      "kdStatusPulang" => 3,
                      "tglPulang"   => date("d-m-Y",strtotime($data['tgl'])),
                      "kdDokter"    => $dokter['kode_bpjs'],
                      "kdDiag1"     => $diagnosa["kodesakit"],
                      "kdDiag2"     => null,
                      "kdDiag3"     => null,
                      "kdPoliRujukInternal" => null,
                      "rujukLanjut" => null,
                      "kdTacc"      => 0,
                      "alasanTacc"  => null
                      );
                      // die(var_dump($data_pcare));
                      if ($data['jenis_pasien_kode_jenis']==7) {
                        // code...
                        // $bridge = PCare("kunjungan","POST",json_encode($data_pcare));
                        $bridge = PcareV4("kunjungan","POST","text/plain",json_encode($data_pcare));
                        // $bridge = json_decode($bridge);
                        if ($bridge->metaData->code==201) {
                          $this->db->where("no_urutkunjungan",$id)->update("kunjungan",array("nokun_bridging"=>$bridge->reseponse->message,'status_bridging_pemeriksaan'=>1));
                          $this->session->set_flashdata('notif',$this->Notif->berhasil("(success bridging)!!!"));
                        }else{
                          if ($bridge->metaData->code==412) {
                            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->response[0]->field." ".$bridge->response[0]->message.' '.$bridge->metaData->message));
                          }elseif ($bridge->metaData->code==304) {
                            $this->db->where("no_urutkunjungan",$id)->update("kunjungan",array('status_bridging_pemeriksaan'=>1));
                            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->response.', '.$bridge->metaData->message));

                          }else{
                            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->metaData->message));

                          }
                        }
                        // die(var_dump($bridge));
                      }else{
                        $this->session->set_flashdata('notif',$this->Notif->berhasil("Bukan pasien bpjs!!!"));
                      }
                      // die(var_dump($data_pcare));
                      // echo "<pre>";
                      // print_r($bridge);
                      // echo "</pre>";
                      // // die();
                      redirect(base_url()."Kunjungan");
                    }

                    public function ambil_poli(){
                      $polisakit = $this->input->post("polisakit");
                      // if ($polisakit=="true") {
                      //   $polisakit=1;
                      // }else{
                      //   $polisakit =0;
                      // }
                      $data = $this->db->get_where("tujuan_pelayanan",array("polisakit"=>$polisakit))->result();
                      $html = "";
                      foreach ($data as $value) {
                        $html .= '<option value="'.$value->kode_tupel.'">'.$value->tujuan_pelayanan.'</option>';
                      }
                      echo $html;
                    }

                  }
