<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApmPendaftaran extends CI_Controller{

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
  }

  function DaftarKunjungan()
  {
    $sumberdana = "1";
    $poli = $this->input->post("poli");
    $tupel = $this->db->get_where("tujuan_pelayanan",array('tujuan_pelayanan' => $poli ))->row_array()["kode_tupel"];
    $sumberdana = $this->input->post("jenis_pembayaran_asuransi");
    $respon_json = array();

    $no_antrian = null;
    if ($this->ModelKunjungan->total($tupel) > 0 ) {
      foreach ($this->ModelKunjungan->max_no($tupel)->result() as $value) {
        $no_antrian = $value->no_antrian + 1;
      }
    } else {
      $no_antrian = 1;
    }
    $this->data_kunjungan['NIK'] = "Mandiri";
    $this->data_kunjungan['tupel_kode_tupel'] = $tupel;
    $this->data_kunjungan['sumber_dana'] = $sumberdana;
    $this->data_kunjungan['tgl'] = date("Y-m-d");
    $this->data_kunjungan['status_online'] = 2;
    $this->data_kunjungan['jam_daftar'] = date('H:i:s');
    $this->data_kunjungan['skrinning_idskrinning'] = $this->input->post("idskrinning");
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
      $kdAntrian = $this->db->get_where("tujuan_pelayanan", array('kode_tupel' => $tupel))->row_array();
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
            'no_antrian'      => $kdAntrian["kd_antrian"]."-".$no_antrian,
          );
          // die(var_dump($bridge));
        }
      }
      $respon_json = array(
        'status'  => 1,
        'pesan'   => "Selamat Anda Berhasil Mendaftar Kunjungan Di Klinik Dokterku Taman Gading",
        'no_antrian'      => $kdAntrian["kd_antrian"]."-".$no_antrian,
      );
    } else {
      $respon_json = array(
        'status'  => 0,
        'pesan'   => "Mohon Maaf Anda Gagal Mendaftar, Mohon Ulangi Lagi Dan Periksa Koneksi Internet Anda !!",
      );
    }
    echo json_encode($respon_json);
  }

  function DaftarPasien()
  {
    $jenis_pasien = $this->db->get_where("jenis_pasien", array('jenis_pasien' => $this->input->post("jenis_pasien")))->row_array();
    $tgl_lahir = date("Y-m-d", strtotime($this->input->post('tgl_lahir')));
    $hitung = $this->db->get_where("pasien",array("namapasien"=>$this->input->post('namapasien'),'tgl_lahir'=>$tgl_lahir))->num_rows();
    if ($hitung > 0) {
      $response = array('status' => 0, 'pesan' => "Tidak dapat membuat no rm baru,data pasien telah ada!");
      echo json_encode($response);
    }else{
      $norm = $this->ModelPasien->generete_noRM();
    $data_pasien = array(
      'provinsi' => $this->input->post('provinsi'),
      'tinggal_dengan' => $this->input->post("tinggal_dengan"),
      'noRM' => $norm,
      'noBPJS' => $this->input->post('noBPJS'),
      'noAsuransiLain' => $this->input->post('noAsuransiLain'),
      'namapasien' => strtoupper($this->input->post('namapasien')),
      'tgl_lahir' => date("Y-m-d", strtotime($this->input->post('tgl_lahir'))),
      'jenis_kelamin' => $this->input->post('jk'),
      'agama' => $this->input->post('agama'),
      'alamat' => strtoupper($this->input->post('alamat')),
      'kota' => $this->input->post('kota'),
      'telepon' => $this->input->post('telepon'),
      'pekerjaan' => $this->input->post('pekerjaan'),
      'tgl_daftar' => date("Y-m-d"),
      'tgl_masuk' => date("Y-m-d"),
      'kunjungan_terakhir' => date("Y-m-d"),
      'jenis_pasien_kode_jenis' => $jenis_pasien["kode_jenis"],
      'orangtua' => strtoupper($this->input->post('orangtua')),
    );
    // echo json_encode($data_pasien);
    $insert_data = $this->db->insert('pasien',$data_pasien);
    if ($insert_data) {
      $response = array(
        'status'  => 1,
        'pesan'   => "Selamat Berhasil Mendaftar",
        'norm'    => $norm
      );
      echo json_encode($response);
    }else {
      $response = array('status' => 0, 'pesan' => "Mohon maaf Gagal Daftar, Mohon Mendaftar Ulang");
      echo json_encode($response);
    }
    }
  }

}
