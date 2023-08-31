<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apo_Pendaftaran extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->data_kunjungan = array(
      'no_urutkunjungan'      => $this->input->post('no_urutkunjungan'),
      // 'tgl'                   => $this->input->post('tgl'),
      // 'tupel_kode_tupel'      => $this->input->post('tujuan_pelayanan'),
      'jenis_kunjungan'       => $this->input->post('jenis_kunjungan'),
      // 'sumber_dana'           => $this->input->post('jenis_pembayaran'),
      'bb'                    => $this->input->post('bb'),
      'tb'                    => $this->input->post('tb'),
      'keluhan'               => $this->input->post('keluhan'),
      'sudah'                 => '0',
      'pasien_baru'           => $this->input->post('pasien_baru'),
      'kunjungansakit'        => $this->input->post('kunjungansakit'),
      'sistole'               => $this->input->post('sistole'),
      'diastole'              => $this->input->post('diastole'),
      'nadi'                  => $this->input->post('nadi'),
      'rr'                    => $this->input->post('rr'),
      'pasien_noRM'           => $this->input->post('pasien_noRM'),
      'asal_pasien'           => $this->input->post('asal_pasien'),
      'administrasi'          => 0,
      'status_deposit'        => 1
    );
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelPasien");
    $this->load->model("ModelTujuanPelayanan");
    $this->load->model("ModelJenisPasien");
    $this->load->model("ModelAPO");

  }

  function DaftarKunjungan()
  {
    $tupel = "UMU";
    $sumberdana = "1";
    $poli = $this->input->post("poli");
    $jenis_pembayaran_asuransi = $this->input->post("jenis_pembayaran_asuransi");
    if ($poli == "UMUM") {
      $tupel = "UMU";
    }elseif ($poli == "GIGI") {
      $tupel = "GIG";
    }elseif ($poli == "Kunjungan Online-Sehat") {
      $tupel = "999";
    }
    if ($jenis_pembayaran_asuransi == "1") {
      $sumberdana = "7";
    }else {
      $sumberdana = "1";
    }
    $respon_json = array();

    $no_antrian = null;
    if ($this->ModelKunjungan->total($tupel) > 0 ) {
      foreach ($this->ModelKunjungan->max_no($tupel)->result() as $value) {
        $no_antrian = $value->no_antrian + 1;
      }
    } else {
      $no_antrian = 1;
    }
    $this->data_kunjungan['NIK'] = "online";
    $this->data_kunjungan['tupel_kode_tupel'] = $tupel;
    $this->data_kunjungan['sumber_dana'] = $sumberdana;
    $this->data_kunjungan['tgl'] = date("Y-m-d");
    $this->data_kunjungan['status_online'] = 1;
    $this->data_kunjungan['jam_daftar'] = date('H:i:s');
    $this->data_kunjungan['no_antrian'] = $no_antrian;
    $pasien = $this->ModelPasien->get_data_edit($this->data_kunjungan['pasien_noRM'])->row_array();
    if ($pasien['tgl_daftar']!=date("Y-m-d")) {
      $this->data_kunjungan['administrasi'] =1;
    }
    if ($this->db->insert('kunjungan', $this->data_kunjungan)) {
      $idkun = $this->db->insert_id();
      $this->db->reset_query();
      $hari_ini = date("Y-m-d");
      $this->db->where('noRM',$this->data_kunjungan['pasien_noRM']);
      $this->db->update('pasien',array('kunjungan_terakhir'   =>$hari_ini,
                                       'idkunjungan_online'   =>$idkun
                                      ));
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

      if ($pasien['jenis_pasien_kode_jenis']==7) {
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
        $data_pcare = array(
          "kdProviderPeserta" => $provider['kdppk'],
          "tglDaftar"         => date("d-m-Y"),
          "noKartu"           => $pasien['noBPJS'],
          "kdPoli"            => $tujuan_pelayanan['kdpcare'],
          "keluhan"           => $this->data_kunjungan['keluhan'],
          "kunjSakit"         => isset($sehat)?false:true,
          "sistole"           => 0,
          "diastole"          => 0,
          "beratBadan"        => $this->data_kunjungan['bb'],
          "tinggiBadan"       => $this->data_kunjungan['tb'],
          "respRate"          => 0,
          "heartRate"         => 0,
          "rujukBalik"        => 0,
          "kdTkp"             => 10
        );
        $bridge = PCare("pendaftaran","POST",json_encode($data_pcare));
        $bridge = json_decode($bridge);
        if ($bridge->metaData->code==201) {
          // $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan Dan Bridging'));
          $this->db->where("no_urutkunjungan",$no_kunjungan['no_urutkunjungan'])->update("kunjungan",array("nourut_pcare"=>$bridge->response->message,"status_bridging"=>1));
          $respon_json = array(
            'status'  => 1,
            'pesan'   => "Selamat Anda Berhasil Mendaftar Kunjungan Di Klinik Dokterku Taman Gading",
          );
          // die(var_dump($bridge));
        }
      }
      $respon_json = array(
        'status'  => 1,
        'pesan'   => "Selamat Anda Berhasil Mendaftar Kunjungan Di Klinik Dokterku Taman Gading",
      );
    } else {
      $respon_json = array(
        'status'  => 0,
        'pesan'   => "Mohon Maaf Anda Gagal Mendaftar, Mohon Ulangi Lagi Dan Periksa Koneksi Internet Anda !!",
      );
    }
    echo json_encode($respon_json);
  }

  public function getDataPendaftaran($norm)
  {
    $tgl = date('Y-m-d');
    $pasien = $this->ModelPasien->get_data_edit($norm)->row_array();
    $kunjungan = $this->ModelAPO->getKunjungan($norm, $tgl)->row_array();
    $sisaAntrianUmum="--";
    $sisaAntrianUmum2="";
    $sisaAntrianGigi="--";
    $antrian = $this->db->get_where("antrian",array('tanggal'=>date("Y-m-d")))->row_array();
    $antrian['UMU']==null?"--":$sisaAntrianUmum = "U".$antrian['UMU'];
    $antrian['UMU2']==null?"--":$sisaAntrianUmum2 = " & U".$antrian['UMU2'];
    $antrian['GIG']==null?"--":$sisaAntrianGigi = "G".$antrian['GIG'];
    $kunjungan["antrian_Umum"] = $sisaAntrianUmum.$sisaAntrianUmum2;
    $kunjungan["antrian_Gigi"] = $sisaAntrianGigi;
    $kunjungan["nokun"] = $pasien['idkunjungan_online'];
    $kunjungan["kode_jenis_pasien"] = $pasien['jenis_pasien_kode_jenis'];
    $kunjungan["nama_jenis_pasien"] = $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array()["jenis_pasien"];
    echo json_encode($kunjungan);
  }

}
