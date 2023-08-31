<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelPekerjaan');
    $this->load->model('ModelJenisPasien');
    $this->load->model('ModelTujuanPelayanan');
    $this->load->model('ModelTempatTidur');
    $this->load->model('ModelPasien');
    $this->load->model('ModelJenisPasien');
    $this->load->model('ModelAkuntansi');
    $this->load->model('ModelKunjungan');
    $this->data_kunjungan = array(

      // 'no_urutkunjungan' => $this->input->post('no_urutkunjungan'),
      'tgl' => date("Y-m-d", strtotime($this->input->post('tgl'))),
      'tupel_kode_tupel' => $this->input->post('tujuan_pelayanan'),
      'jenis_kunjungan' => $this->input->post('jenis_kunjungan'),
      'sumber_dana' => $this->input->post('jenis_pembayaran'),
      'bb' => $this->input->post('bb'),
      'tb' => $this->input->post('tb'),
      'keluhan' => $this->input->post('keluhan'),
      'sudah' => '0',
      'pasien_baru' => '1',
      'kunjungansakit' => 1,
      'sistole' => 0,
      'diastole' => 0,
      'nadi' => 0,
      'rr' => 0,
      'pasien_noRM' => $this->input->post('pasien_noRM'),
      'administrasi' => 0,
      'status_deposit' => 1

    );
  }

  function pasien($norm)
  {
    $tgl = date('Y-m-d');
    $data = array(
      'body'            => 'APO/Pasien/Kunjungan',
      'tupel' => $this->ModelTujuanPelayanan->get_poli_online(1),
      'pasien' => $this->ModelPasien->get_data_edit($norm)->row_array(),
      'jenis_pasien' => $this->ModelJenisPasien->get_data(),
      'noRM' => $this->ModelPasien->generete_noRM(),
    );
    // die(var_dump($data['kunjungan_sudah']));
		$this->load->view('APO/Pasien/index',$data);
  }

  public function insert()
  {
    // die(var_dump($this->data_kunjungan['kunjungansakit']));
    $tupel = $this->input->post('tujuan_pelayanan');
    $no_antrian = null;
    if ($this->ModelKunjungan->total($tupel) > 0 ) {
      foreach ($this->ModelKunjungan->max_no($tupel)->result() as $value) {
        $no_antrian = $value->no_antrian + 1;
      }
    } else {
      $no_antrian = 1;
    }
    $this->data_kunjungan['NIK'] = "198603072012112000"; /* NIK MBak IIM*/
    $this->data_kunjungan['jam_daftar'] = date('H:i:s');
    $this->data_kunjungan['no_antrian'] = $no_antrian;
    $this->data_kunjungan['status_online'] = 1;
    $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($tupel)->row_array();
    // echo "<pre>";
    // print_r($tujuan_pelayanan);
    // echo "</pre>";
    // die();
    // die(var_dump($this->data_kunjungan));
    $pasien = $this->ModelPasien->get_data_edit($this->data_kunjungan['pasien_noRM'])->row_array();
    if ($pasien['tgl_daftar']!=date("Y-m-d")) {
      $this->data_kunjungan['administrasi'] =1;
    }
    if ($this->db->insert('kunjungan', $this->data_kunjungan)) {
      $idkun = $this->db->insert_id();
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
        $provider = $this->Core->get_pcare();
        $data_pcare = array(
          "kdProviderPeserta" => $provider['kdppk'],
          "tglDaftar"         => date("d-m-Y"),
          "noKartu"           => $pasien['noBPJS'],
          "kdPoli"            => $tujuan_pelayanan['kdpcare'],
          "keluhan"           => $this->data_kunjungan['keluhan'],
          "kunjSakit"         => $tujuan_pelayanan['polisakit']==1?true:false,
          "sistole"           => 0,
          "diastole"          => 0,
          "beratBadan"        => $this->data_kunjungan['bb'],
          "tinggiBadan"       => $this->data_kunjungan['tb'],
          "respRate"          => 0,
          "heartRate"         => 0,
          "rujukBalik"        => 0,
          "kdTkp"             => 10
        );
        // echo "<pre>";
        // print_r($data_pcare);
        // echo "</pre>";
        // die();
        $bridge = PCare("pendaftaran","POST",json_encode($data_pcare));
        $bridge = json_decode($bridge);
        // echo "<pre>";
        // print_r($bridge);
        // echo "</pre>";
        // die();
        if ($bridge->metaData->code==201) {
          $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan Dan Bridging'));
          $this->db->where("no_urutkunjungan",$no_kunjungan['no_urutkunjungan'])->update("kunjungan",array("nourut_pcare"=>$bridge->response->message,"status_bridging"=>1));
          // die(var_dump($bridge));
        }else{
          if ($bridge->metaData->code==412) {
            // code...
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->response[0]->field." ".$bridge->response[0]->message.' '.$bridge->metaData->message));
          }else{
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->metaData->message));

          }

        }
      }else{
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      }

      redirect(base_url().'APO/Home');
      // echo json_encode($bridge);
    } else {
      echo "salah";
    }
  }

  public function jenis_pelayanan($jenis = 1)
  {
    $tupel = $this->ModelTujuanPelayanan->get_poli_online($jenis);
    $html = "<div class=\"input-group-prepend\">
              <span class=\"input-group-text\" id=\"basic-addon1\"><i class=\"ti-notepad\"></i></span>
            </div>
    <select name=\"tujuan_pelayanan\" id=\"select\" class=\"form-control tujuan_pelayanan\" onchange=\"no_urut()\">";
    foreach ($tupel as $value) {
      $html .= "<option value='$value->kode_tupel'>$value->tujuan_pelayanan</option>";
    }
    if ($jenis == 1) {
      $html .= "<option value='998'>Kunjungan Online</option>";
    }
    $html .= "</select>";
    echo $html;
  }

}
