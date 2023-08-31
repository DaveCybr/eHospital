

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periksa extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelPasien');
    $this->load->model('ModelKunjungan');
    $this->load->model('ModelJenisPasien');
    $this->load->model('ModelLaborat');
    $this->load->model('ModelPenyakit');
    $this->load->model('ModelJasaPelayanan');
    $this->load->model('ModelResep');
    $this->load->model('ModelObat');
    $this->load->model('ModelPeriksa');
    $this->load->model('ModelTujuanPelayanan');
    $this->load->model('ModelDemografi');
    $this->load->model('ModelRiwayatAlergi');
    $this->load->model('ModelJasaBHP');
    $this->load->model('ModelAkuntansi');
  }

  function index()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $hiv = $this->db
      ->group_start()
      ->like("kodesakit", "B20", "after")
      ->or_like("kodesakit", "B21", "after")
      ->or_like("kodesakit", "B22", "after")
      ->or_like("kodesakit", "B23", "after")
      ->group_end()
      ->where(array("pasien_noRM" => $kunjungan['pasien_noRM']))
      ->get("diagnosa")->num_rows();

    $dm = $this->db
      ->group_start()
      ->like("kodesakit", "E10", "after")
      ->or_like("kodesakit", "E11", "after")
      ->or_like("kodesakit", "E12", "after")
      ->or_like("kodesakit", "E13", "after")
      ->or_like("kodesakit", "E14", "after")
      // ->or_like("kodesakit","E15","after")
      // ->or_like("kodesakit","E16","after")
      ->group_end()
      ->where(array("pasien_noRM" => $kunjungan['pasien_noRM']))
      ->get("diagnosa")->num_rows();
    // $prolanis = $this->db
    // ->group_start()
    //   ->like("kodesakit","E10","after")
    //   ->or_like("kodesakit","I10","after")
    //   ->or_like("kodesakit","A39","after")
    //   ->or_like("kodesakit","M32","after")
    //   ->or_like("kodesakit","A49","after")
    //   ->or_like("kodesakit","F20","after")
    //   ->or_like("kodesakit","G40","after")
    //   ->or_like("kodesakit","J44","after")
    //   ->or_like("kodesakit","J45","after")
    // ->group_end()
    // ->where(array("pasien_noRM"=>$kunjungan['pasien_noRM']))
    // ->get("diagnosa")->num_rows();
    $prolanis = $pasien['pstprol'];
    $pcare = $this->db->get("pcare")->row();
    if ($pcare->status == 0) {
      $rujuk = NULL;
      $sarana = NULL;
    } else {
      // $rujuk = json_decode(PCare("spesialis/khusus"));
      // $sarana = json_decode(PCare("spesialis/khusus"));
      $rujuk = PcareV4("spesialis/khusus");
      $sarana = PcareV4("spesialis/sarana");
    }

    $data = array(
      'idkunjungan'     => $this->uri->segment(3),
      'kunjungan'       => $kunjungan,
      'body'        => 'Periksa/index2',
      // 'body'            => 'Periksa/index3', link untuk PcareV4
      // 'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'pasien'          => $pasien,
      'jenispasien'     => @$this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'tupel'           => $this->ModelTujuanPelayanan->get_data_edit($kunjungan['tupel_kode_tupel'])->row_array(),
      // 'riwayat_alergi'=> $this->ModelRiwayatAlergi->get_data($kunjungan['pasien_noRM'])->result(),
      'riwayat_alergi'  => NULL,
      'periksa'         => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'rujuk'           =>  $rujuk,
      'sarana'          =>  $sarana,
      'hiv'             => $hiv,
      'prolanis'        => $prolanis,
      'lab'             => $this->ModelLaborat->get_data(),
      'dm'              => $dm
      // 'sarana' => NULL,
      // 'rujuk' => NULL,

      // 'rujuk' =>  NULL,
      // 'sarana' =>  NULL,
    );
    // die("lalala");
    $this->load->view('index', $data);
  }

  public function tes()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $hiv = $this->db
      ->group_start()
      ->like("kodesakit", "B20", "after")
      ->or_like("kodesakit", "B21", "after")
      ->or_like("kodesakit", "B22", "after")
      ->or_like("kodesakit", "B23", "after")
      ->group_end()
      ->where(array("pasien_noRM" => $kunjungan['pasien_noRM']))
      ->get("diagnosa")->num_rows();
    // $prolanis = $this->db
    // ->group_start()
    //   ->like("kodesakit","E10","after")
    //   ->or_like("kodesakit","I10","after")
    //   ->or_like("kodesakit","A39","after")
    //   ->or_like("kodesakit","M32","after")
    //   ->or_like("kodesakit","A49","after")
    //   ->or_like("kodesakit","F20","after")
    //   ->or_like("kodesakit","G40","after")
    //   ->or_like("kodesakit","J44","after")
    //   ->or_like("kodesakit","J45","after")
    // ->group_end()
    // ->where(array("pasien_noRM"=>$kunjungan['pasien_noRM']))
    // ->get("diagnosa")->num_rows();
    $prolanis = $pasien['pstprol'];
    $pcare = $this->db->get("pcare")->row();
    if ($pcare->status == 0) {
      $rujuk = NULL;
      $sarana = NULL;
    } else {
      // $rujuk = json_decode(PCare("spesialis/khusus"));
      // $sarana = json_decode(PCare("spesialis/khusus"));
      $rujuk = PcareV4("spesialis/khusus");
      $sarana = PcareV4("spesialis/sarana");
    }

    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'kunjungan'   => $kunjungan,
      'body'        => 'Periksa/index2',
      // 'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'pasien' => $pasien,
      'jenispasien' => @$this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'tupel'       => $this->ModelTujuanPelayanan->get_data_edit($kunjungan['tupel_kode_tupel'])->row_array(),
      // 'riwayat_alergi'=> $this->ModelRiwayatAlergi->get_data($kunjungan['pasien_noRM'])->result(),
      'riwayat_alergi' => NULL,
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'rujuk' =>  $rujuk,
      'sarana' =>  $sarana,
      'hiv' => $hiv,
      'prolanis' => $prolanis,
      // 'sarana' => NULL,
      // 'rujuk' => NULL,

      // 'rujuk' =>  NULL,
      // 'sarana' =>  NULL,
    );
    // die("lalala");
    $this->load->view('index', $data);
  }


  public function pulang($id = null)
  {
    $this->db->where('no_urutkunjungan', $id);
    $this->db->update('kunjungan', array('siap_pulang' => 1));
    $data = $this->db
      ->join("pasien", "pasien.noRM=kunjungan.pasien_noRM")
      ->where("no_urutkunjungan", $id)->get("kunjungan")
      ->row_array();
    $this->session->set_flashdata('notif', $this->Notif->berhasil("Pasien Telah Siap Di Pulangkan!!!"));
    redirect(base_url() . "Kunjungan");
  }
  public function bataL_pulang($id = null)
  {
    $this->db->where('no_urutkunjungan', $id);
    $this->db->update('kunjungan', array('siap_pulang' => 0));
    $this->session->set_flashdata('notif', $this->Notif->berhasil("Pasien Telah Dibatalkan Pulang!!!"));
    redirect(base_url() . "Kunjungan");
  }

  function pemeriksaan()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $dm = $this->db
      ->group_start()
      ->like("kodesakit", "E10", "after")
      ->or_like("kodesakit", "E11", "after")
      ->or_like("kodesakit", "E12", "after")
      ->or_like("kodesakit", "E13", "after")
      ->or_like("kodesakit", "E14", "after")
      // ->or_like("kodesakit","E15","after")
      // ->or_like("kodesakit","E16","after")
      ->group_end()
      ->where(array("pasien_noRM" => $kunjungan['pasien_noRM']))
      ->get("diagnosa")->num_rows();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'kunjungan'   => $kunjungan,
      'body'        => 'Periksa/pemeriksaan2',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'dm' => $dm
    );

    $this->load->view('index', $data);
  }
  function edit_pemeriksaan()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'kunjungan'   => $kunjungan,
      'body'        => 'Periksa/edit_pemeriksaan',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))
    );
    $this->load->view('index', $data);
  }
  function update_pemeriksaan($id = "")
  {

    $riwayat_dulu = $this->input->post('riwayat_dulu');
    if ($this->input->post('riwayat_dulu') == "lain") {
      $riwayat_dulu = $this->input->post('lain_ridul');
    } else {
      $riwayat_dulu = $this->input->post('riwayat_dulu');
    }

    $periksa = array(
      'kunjungan_no_urutkunjungan' => $this->input->post('nokun'),
      'tanggal' => date('Y-m-d'),
      'no_rm'   => $this->input->post('no_rm'),
      'keluhan' => $this->input->post('keluhan'),
      'riwayat_dulu'      => $riwayat_dulu,
      'riwayat_skrg'      => $this->input->post('riwayat_skrg'),
      'otemp'             => $this->input->post('temp'),
      'obb'               => $this->input->post('bb'),
      'otb'               => $this->input->post('tb'),
      'osadar'            => $this->input->post('kesadaran'),
      'osiastole'         => $this->input->post('siastole'),
      'odiastole'         => $this->input->post('diastole'),
      'onadi'             => $this->input->post('nadi'),
      'orr'               => $this->input->post('rr'),
      'ospo2'              => $this->input->post('spo2'),
      'kmata'             => $this->input->post('mata'),
      'ktelinga'          => $this->input->post('telinga'),
      'ktonsil'           => $this->input->post('tonsil'),
      'kleher'            => $this->input->post('leher'),
      'khidung'           => $this->input->post('hidung'),
      'kgilut'            => $this->input->post('gigimulut'),
      'klain'             => $this->input->post('lainkl'),
      'phepar'            => $this->input->post('hepar'),
      'pusus'             => $this->input->post('usus'),
      'pdinperut'         => $this->input->post('dinperut'),
      'puluhati'          => $this->input->post('uluhati'),
      'plien'             => $this->input->post('lien'),
      'plain'             => $this->input->post('lainperut'),
      'tcor'              => $this->input->post('corejantung'),
      'tparu'             => $this->input->post('paru'),
      'tlain'             => $this->input->post('lainthorak'),
      'uginjal'           => $this->input->post('ginjal'),
      'ulain'             => $this->input->post('lainurogenital'),
      'eatas'             => $this->input->post('exatas'),
      'ebawah'            => $this->input->post('exbawah'),
      'elain'             => $this->input->post('lainex'),
      'unit_layanan'      => $_SESSION['poli'],
      'operator' => $_SESSION['nik'],
      'gl_puasa'  => $this->input->post('gl_puasa'),
      'gl_sewaktu'  => $this->input->post('gl_sewaktu'),
      'gl_post_prandial'  => $this->input->post('gl_post_prandial'),
      'gl_hba'  => $this->input->post('gl_hba'),
    );
    if ($this->db->where("idperiksa", $id)->update('periksa', $periksa)) {
      $this->db->reset_query();
      // $this->db->where('no_urutkunjungan', $this->input->post('nokun'));
      // $this->db->update('kunjungan',array('sudah' => '1',));
      $this->session->set_flashdata('notif', $this->Notif->berhasil("Berhasil Merubah Data"));
      // redirect(base_url().'Periksa/tindakan/'.$id); link update PcareV4
      redirect(base_url() . 'Periksa/index/' . $this->input->post('nokun'));
    } else {
      $this->session->set_flashdata('notif', $this->Notif->berhasil("Gagal Merubah Data"));
      // redirect(base_url().'Periksa/tindakan/'.$id); link update PcareV4
      redirect(base_url() . 'Periksa/index/' . $this->input->post('nokun'));
    }
  }

  function input_pemeriksaan()
  {
    $riwayat_dulu = $this->input->post('riwayat_dulu');
    if ($this->input->post('riwayat_dulu') == "lain") {
      $riwayat_dulu = $this->input->post('lain_ridul');
    } else {
      $riwayat_dulu = $this->input->post('riwayat_dulu');
    }

    $periksa = array(
      'kunjungan_no_urutkunjungan' => $this->input->post('nokun'),
      'tanggal' => date('Y-m-d'),
      'no_rm'   => $this->input->post('no_rm'),
      'keluhan' => $this->input->post('keluhan'),
      'riwayat_dulu'      => $riwayat_dulu,
      'riwayat_skrg'      => $this->input->post('riwayat_skrg'),
      'otemp'             => $this->input->post('temp'),
      'obb'               => $this->input->post('bb'),
      'otb'               => $this->input->post('tb'),
      'olingkar_perut'    => $this->input->post('lingkar_perut'),
      'osadar'            => $this->input->post('kesadaran'),
      'osiastole'         => $this->input->post('siastole'),
      'odiastole'         => $this->input->post('diastole'),
      'onadi'             => $this->input->post('nadi'),
      'orr'               => $this->input->post('rr'),
      'ospo2'             => $this->input->post('spo2'),
      'kmata'             => $this->input->post('mata'),
      'ktelinga'          => $this->input->post('telinga'),
      'ktonsil'           => $this->input->post('tonsil'),
      'kleher'            => $this->input->post('leher'),
      'khidung'           => $this->input->post('hidung'),
      'kgilut'            => $this->input->post('gigimulut'),
      'klain'             => $this->input->post('lainkl'),
      'phepar'            => $this->input->post('hepar'),
      'pusus'             => $this->input->post('usus'),
      'pdinperut'         => $this->input->post('dinperut'),
      'puluhati'          => $this->input->post('uluhati'),
      'plien'             => $this->input->post('lien'),
      'plain'             => $this->input->post('lainperut'),
      'tcor'              => $this->input->post('corejantung'),
      'tparu'             => $this->input->post('paru'),
      'tlain'             => $this->input->post('lainthorak'),
      'uginjal'           => $this->input->post('ginjal'),
      'ulain'             => $this->input->post('lainurogenital'),
      'eatas'             => $this->input->post('exatas'),
      'ebawah'            => $this->input->post('exbawah'),
      'elain'             => $this->input->post('lainex'),
      'unit_layanan'      => $_SESSION['poli'],
      'operator' => $_SESSION['nik'],
      'gl_puasa'  => $this->input->post('gl_puasa'),
      'gl_sewaktu'  => $this->input->post('gl_sewaktu'),
      'gl_post_prandial'  => $this->input->post('gl_post_prandial'),
      'gl_hba'  => $this->input->post('gl_hba'),

    );
    // echo json_encode($periksa);
    if ($this->db->insert('periksa', $periksa)) {
      $idperiksa = $this->db->insert_id();
      // $this->db->reset_query();
      $nokun = $this->input->post('nokun');
      $data_kunjungan = $this->db->get_where("kunjungan", array("no_urutkunjungan" => $nokun))->row();
      if ($_SESSION['poli'] == "IGD" && $data_kunjungan->rujuk_poli == 1) {
        $this->db->where('kunjungan_no_urutkunjungan', $this->input->post('nokun'));
        $this->db->where('tujuan_poli', "IGD");
        $this->db->update('rujukan_internal', array('sudah' => '1',));
      } else {
        $this->db->where('no_urutkunjungan', $this->input->post('nokun'));
        $this->db->update('kunjungan', array('sudah' => '1',));
      }
      // $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      // redirect(base_url().'Periksa/index/'.$this->input->post('nokun'));
      $this->session->set_flashdata('notif', $this->Notif->berhasil("Berhasil Tersimpan"));
      redirect(base_url() . 'Periksa/tindakan/' . $idperiksa);
    } else {
      // $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      // redirect(base_url().'Periksa/index/'.$this->input->post('nokun'));
      $this->session->set_flashdata('notif', $this->Notif->gagal("Gagal Tersimpan"));
      redirect(base_url() . 'Periksa/tindakan/' . $idperiksa);
    }
  }

  function kunjungan()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'kunjungan'   => $kunjungan,
      'body'        => 'Periksa/kunjungan',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))
    );

    $this->load->view('index', $data);
  }

  function lab()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'no_urutkunjungan' => $periksa['kunjungan_no_urutkunjungan'],
      'body'        => 'Periksa/lab',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data_type()->result(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($kunjungan['pasien_noRM'])
    );

    $this->load->view('index', $data);
    // echo $periksa['kunjungan_no_urutkunjungan'];
  }
  function edit_lab()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/edit_lab',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data_type()->result(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($kunjungan['pasien_noRM']),
      'permintaan_lab' => $this->ModelLaborat->get_permintaan($this->uri->segment(3))
    );

    $this->load->view('index', $data);
    // echo $periksa['kunjungan_no_urutkunjungan'];
  }
  function labsearch()
  {
    $lab = $this->ModelLaborat->get_datasub($this->uri->segment(3))->result();
    foreach ($lab as $data) {
      echo "<tr>
        <td><input hidden value='$data->kode_lab' name='kode_lab[]'>$data->kode_lab</td>
        <td><input hidden value='$data->jenis_lab' name='jenis_lab[]'><input hidden value='$data->hrg_1' name='harga_lab[]'>$data->jenis_lab</td>
        <td><button type=\"button\" onclick='deleteRowlab(this)' class=\"btn btn-circle btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Lab\"><i class=\"fa fa-trash\"></i></button></td>
      </tr>
      ";
    }
  }

  function labsearchkode()
  {
    $lab = $this->ModelLaborat->get_data_edit($this->uri->segment(3));
    echo $lab['kode_lab'];
  }

  function tindakan()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan'   => $this->uri->segment(3),
      'body'          => 'Periksa/tindakan',
      'pasien'        => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien'   => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'penyakit'      => $this->ModelPenyakit->get_data(),
      'modaljapel'    => $this->ModelJasaPelayanan->get_data(),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),

      'kunjungan'     => $kunjungan,
      'data_periksa'  => $periksa,

    );
    $this->load->view('index', $data);
  }


  public function data_modal()
  {
    $kunjungan_no_urutkunjungan = $this->input->post('kunjungan_no_urutkunjungan');
    $data = array(
      'periksa'  => $this->ModelPeriksa->get_periksa_pasien($kunjungan_no_urutkunjungan),
      'kunjungan' => $this->ModelKunjungan->get_data_edit($kunjungan_no_urutkunjungan),
      'edit' => 1,
      'judul' => 'Hasil Periksa',
      'link' => base_url() . "Periksa/edit_pemeriksaan/" . $kunjungan_no_urutkunjungan,
    );
    $this->load->view('Periksa/modal_new2', $data);
  }
  function tindakan2()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/tindakan2',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'penyakit'    => $this->ModelPenyakit->get_data(),
      'modaljapel'   => $this->ModelJasaPelayanan->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))

    );
    $this->load->view('index', $data);
  }
  function edit_tindakan()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $dignosa = $this->ModelPeriksa->get_diagnosa($periksa['idperiksa'])->result();
    $tindakan = $this->ModelPeriksa->get_tindakan($periksa['idperiksa'])->result();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/edit_tindakan',
      'tindakan' => $tindakan,
      'diagnosa' => $dignosa,
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'penyakit'    => $this->ModelPenyakit->get_data(),
      'modaljapel'   => $this->ModelJasaPelayanan->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))

    );
    $this->load->view('index', $data);
  }

  function get_data_penyakit()
  {
    $list = $this->ModelPenyakit->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->kodeicdx;
      $row[] = $field->nama_penyakit;
      $row[] = $field->indonesia;
      $row[] = $this->ModelPenyakit->yatidak($field->wabah);
      $row[] = $this->ModelPenyakit->yatidak($field->nular);
      $row[] = $this->ModelPenyakit->yatidak($field->bpjs);
      $row[] = $this->ModelPenyakit->yatidak($field->non_spesialis);
      $row[] = "<button onclick=\"select_diagnosa(`$field->kodeicdx`,`$field->nama_penyakit`)\" type=\"button\" class=\"btn btn-circle btn-primary\" data-toggle=\"tooltip\" data-placement=\"right\" data-original-title=\"SUBMIT\" data-dismiss=\"modal\"><i class=\"fas fa-edit\"></i></button>";

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->ModelPenyakit->count_all(),
      "recordsFiltered" => $this->ModelPenyakit->count_filtered(),
      "data" => $data,
    );
    //output dalam format JSON
    echo json_encode($output);
  }

  function caridiagnosa()
  {
    $penyakit = $this->ModelPenyakit->get_data_edit($this->uri->segment(3));
    echo $penyakit['kodeicdx'] . " " . $penyakit['nama_penyakit'];
  }

  function update_ditin()
  {
    $operator   = $_SESSION['nik'];
    $periksa    = $this->input->post('nopem');
    $pegawai = $this->db->where("NIK", $operator)->get("pegawai")->row_array();
    $kode = $this->ModelAkuntansi->generete_notrans();
    $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
    $nokun = $data_periksa['kunjungan_no_urutkunjungan'];
    $jam        = date('Y-m-d H:i:s');
    $norm       = $this->input->post('no_rm');
    $kodesakit  = $this->input->post('kode_penyakit');
    $status_penyakit = $this->input->post('status_penyakit');
    // $this->db->where('no_urutkunjungan',$data_periksa['kunjungan_no_urutkunjungan']);
    // $this->db->update('kunjungan',array('sudah'=>2));
    $this->db->where_in("periksa_idperiksa", $periksa);
    $this->db->delete("diagnosa");
    $this->db->reset_query();
    $this->db->where_in("periksa_idperiksa", $periksa);
    $this->db->delete("tindakan");
    $this->db->reset_query();
    $count    = count($kodesakit);
    $status   = 0;
    $icd = [null, null, null];

    for ($i = 0; $i < $count; $i++) {
      $data = array(
        'kodesakit'         => $kodesakit[$i],
        'operator'          => $operator,
        'jam'               => $jam,
        'status_sakit'      => $status_penyakit[$i],
        'periksa_idperiksa' => $periksa,
        'pasien_noRM'       => $norm
      );
      $icd[$i] = $kodesakit[$i];
      $insert = $this->db->insert('diagnosa', $data);
      $this->db->reset_query();
      if ($insert == true) {
        $status = 1;
      } else {
        $status = 0;
      }
    }
    $data_pasien = $this->ModelPasien->get_data_edit($norm)->row_array();
    $data_kunjungan = $this->db->get_where("kunjungan", array("no_urutkunjungan" => $nokun))->row_array();


    $pcare = $this->db->get("pcare")->row();
    if ($pcare->status == 0) {
      // $bridgePcare = "";
      // $rujuk = NULL;
      // $sarana = NULL;
    } else {
      $bridgePcare = json_decode(PcareV4("kunjungan/peserta/" . $data_pasien['noBPJS']));
      // $rujuk = json_decode(PCare("spesialis/khusus"));
      // $sarana = json_decode(PCare("spesialis/khusus"));
    }
    if (!empty($bridgePcare) || $bridgePcare != "") {
      $kunjunganPcare = $bridgePcare->response->list[0];
      $kesadaran = array(
        'KOMPOMENTIS' => "01",
        'SAMNOLENSE' => "02",
        'STUPOR' => "03",
        'KOMA' => "04"

      );
      $pulang = "3";
      if ($data_kunjungan['rujuk_poli'] == 1) {
        $r = 005;
      } else {
        $r = null;
      }
      $data_pcare = array(
        "noKunjungan" => $kunjunganPcare->noKunjungan,
        "noKartu"     => $data_pasien['noBPJS'],
        "tglDaftar"   => date("d-m-Y", strtotime($data_kunjungan['tgl'])),
        "kdPoli"      => null,
        "keluhan"     => $data_kunjungan['keluhan'],
        "kdSadar"     => $data_periksa['osadar'] == NULL ? "01" : $kesadaran[$data_periksa['osadar']],
        "sistole"     => $data_periksa["osiastole"],
        "diastole"    => $data_periksa["odiastole"],
        "beratBadan"  => $data_periksa["obb"],
        "tinggiBadan" => $data_periksa["otb"],
        "respRate"    => $data_periksa["orr"],
        "heartRate"   => $data_periksa["onadi"],
        "terapi"      => $data_periksa["oterapi"],
        "kdStatusPulang" => $pulang,
        "tglPulang"   => date("Y-m-d"),
        "kdDokter"    => $pegawai['kode_bpjs'],
        "kdDiag1"     => $icd[0],
        "kdDiag2"     => $icd[1],
        "kdDiag3"     => $icd[2],
        "kdPoliRujukInternal" => $r,
        "rujukLanjut" => null,
        "kdTacc"      => 0,
        "alasanTacc"  => null
      );

      $bridge = PcareV4("kunjungan", "PUT", json_encode($data_pcare));
    }

    $kode_jasa        = $this->input->post('kode_jasa');
    $jasa             = $this->input->post('jasa');
    $harga            = $this->input->post('harga');
    $japeldokter      = $this->input->post('japeldokter');
    $japelperawat     = $this->input->post('japelperawat');
    $japeladmin       = $this->input->post('japeladmin');
    $japelresepsionis = $this->input->post('japelresepsionis');

    $total = $this->input->post("total");
    $dapat = $this->input->post("pendapatan");
    $j_dokter = $this->input->post("j_dokter");
    $j_perawat = $this->input->post("j_perawat");
    $j_resepsionis = $this->input->post("j_resepsione");
    $j_admin = $this->input->post("j_admin");

    $count_jasa = count($kode_jasa);
    $total_jasa = 0;
    $total_menev_dokter = 0;
    $total_menev_perawat = 0;
    $total_menev_admin = 0;
    $total_menev_resepsionis = 0;
    for ($i = 0; $i < $count_jasa; $i++) {

      $data = array(
        'kodejasa'          => $kode_jasa[$i],
        'jsmedis'           => $jasa[$i],
        'harga'             => $harga[$i],
        'operator'          => $operator,
        'japel_dokter'      => $japeldokter[$i],
        'japel_perawat'     => $japelperawat[$i],
        'japel_admin'       => $japeladmin[$i],
        'japel_resepsionis' => $japelresepsionis[$i],
        'pasien_noRM'       => $norm,
        'periksa_idperiksa' => $periksa,
      );
      $insert = $this->db->insert('tindakan', $data);
      $this->db->reset_query();
      if ($insert == true) {
        $status = 1;
      } else {
        $status = 0;
      }
      $total_jasa += $harga[$i];
      $total_menev_dokter += $japeldokter[$i];
      $total_menev_perawat += $japelperawat[$i];
      $total_menev_admin += $japeladmin[$i];
      $total_menev_resepsionis += $japelresepsionis[$i];
    }
    $jam = date("H:i:s");



    if ($total_jasa != $total) {
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
        'norek' => '113.001',
        'debet' => 0,
        'kredit' => 0,
        'pasien_noRM' => $norm,
        'no_urut' => $nokun,
        'no_transaksi' => $kode,
        'jam' => $jam
      );
      $t_jasa = $total_jasa > $total ? $total_jasa - $total : $total - $total_jasa;
      $debet = $total_jasa > $total ? $t_jasa : 0;
      $kredit = $total_jasa > $total ? 0 : $t_jasa;
      $jurnal['debet'] = $debet;
      $jurnal['kredit'] = $kredit;
      $this->db->insert('jurnal', $jurnal);
    }

    $pendapatan = $total_jasa - ($total_menev_dokter + $total_menev_perawat + $total_menev_admin + $total_menev_resepsionis);
    $data_kunjungan = $this->db->get_where("kunjungan", array("no_urutkunjungan" => $nokun))->row_array();
    $tupel = $data_kunjungan['tupel_kode_tupel'];
    if ($tupel == 'UMU') {
      $norek = "411.005";
    } else if ($tupel == 'GIG') {
      $norek = "411.006";
    } else if ($tupel == "INT") {
      $norek = "411.007";
    } else if ($tupel == "OBG") {
      $norek = "411.008";
    } else if ($tupel == "OZO") {
      $norek = "411.009";
    } else if ($tupel == "IGD") {
      $norek = "411.010";
    } else {
      $norek = NULL;
    }



    if ($total_menev_resepsionis != $j_resepsionis) {
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
        'norek' => '212.005',
        'debet' => 0,
        'kredit' => $total_menev_resepsionis,
        'pasien_noRM' => $norm,
        'no_urut' => $nokun,
        'no_transaksi' => $kode,
        'jam' => $jam
      );
      $res = $total_menev_resepsionis > $j_resepsionis ? $total_menev_resepsionis - $j_resepsionis : $j_resepsionis - $total_menev_resepsionis;
      $kredit = $total_menev_resepsionis > $j_resepsionis ? $res : 0;
      $debet = $total_menev_resepsionis > $j_resepsionis ? 0 : $res;
      $jurnal['debet'] = $debet;
      $jurnal['kredit'] = $kredit;
      $this->db->insert('jurnal', $jurnal);
    } else {
      $pendapatan += $total_menev_resepsionis;
    }

    if ($total_menev_perawat != $j_perawat) {
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
        'norek' => '212.003',
        'debet' => 0,
        'kredit' => $total_menev_resepsionis,
        'pasien_noRM' => $norm,
        'no_urut' => $nokun,
        'no_transaksi' => $kode,
        'jam' => $jam
      );
      $per = $total_menev_perawat > $j_perawat ? $total_menev_perawat - $j_perawat : $j_perawat - $total_menev_perawat;
      $kredit = $total_menev_perawat > $j_perawat ? $per : 0;
      $debet = $total_menev_perawat > $j_perawat ? 0 : $per;
      $jurnal['debet'] = $debet;
      $jurnal['kredit'] = $kredit;
      $this->db->insert('jurnal', $jurnal);
    } else {
      $pendapatan += $total_menev_resepsionis;
    }

    if ($total_menev_dokter != $j_dokter) {
      if ($pegawai['keahlian'] == "UM") {
        $no = "212.002";
      } else {
        $no = "212.001";
      }
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
        'norek' => $no,
        'debet' => 0,
        'kredit' => $total_menev_dokter,
        'pasien_noRM' => $norm,
        'no_urut' => $nokun,
        'no_transaksi' => $kode,
        'jam' => $jam
      );
      $dok = $total_menev_dokter > $j_dokter ? $total_menev_dokter - $j_dokter : $j_dokter - $total_menev_dokter;
      $kredit = $total_menev_dokter > $j_dokter ? $dok : 0;
      $debet = $total_menev_dokter > $j_dokter ? 0 : $dok;
      $jurnal['debet'] = $debet;
      $jurnal['kredit'] = $kredit;
      $this->db->insert('jurnal', $jurnal);
    } else {
      $pendapatan += $total_menev_dokter;
    }
    if ($pendapatan != $dapat) {
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
        'norek' => $norek,
        'debet' => 0,
        'kredit' => $pendapatan,
        'pasien_noRM' => $norm,
        'no_urut' => $nokun,
        'no_transaksi' => $kode,
        'jam' => $jam
      );
      $pen = $pendapatan > $dapat ? $pendapatan - $dapat : $dapat - $pendapatan;
      $kredit = $pendapatan > $dapat ? $pen : 0;
      $debet = $pendapatan > $dapat ? 0 : $pen;
      $jurnal['debet'] = $debet;
      $jurnal['kredit'] = $kredit;
      $this->db->insert('jurnal', $jurnal);
    }

    if ($status == 1) {
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
    }
  }
  function input_ditin()
  {
    $operator   = $_SESSION['nik'];
    $pegawai = $this->db->where("NIK", $operator)->get("pegawai")->row_array();
    $jam        = date('Y-m-d H:i:s');
    $periksa    = $this->input->post('nopem');
    $norm       = $this->input->post('no_rm');
    $kodesakit  = $this->input->post('kode_penyakit');
    $status_penyakit = $this->input->post('status_penyakit');
    $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
    $data_kunjungan = $this->db->get_where("kunjungan", array("no_urutkunjungan" => $data_periksa['kunjungan_no_urutkunjungan']))->row();

    if ($_SESSION['poli'] == "IGD" && $data_kunjungan->rujuk_poli == 1) {
      $this->db->where('kunjungan_no_urutkunjungan', $data_periksa['kunjungan_no_urutkunjungan']);
      $this->db->where('tujuan_poli', "IGD");
      $this->db->update('rujukan_internal', array('sudah' => '1',));
    } else {
      $this->db->where('no_urutkunjungan', $data_periksa['kunjungan_no_urutkunjungan']);
      $this->db->update('kunjungan', array('sudah' => '1',));
    }
    $kode = $this->ModelAkuntansi->generete_notrans();
    $nokun = $data_periksa['kunjungan_no_urutkunjungan'];
    $count    = count($kodesakit);
    $status   = 0;
    $icd = [null, null, null];

    for ($i = 0; $i < $count; $i++) {
      $data = array(
        'kodesakit'         => $kodesakit[$i],
        'operator'          => $operator,
        'jam'               => $jam,
        'status_sakit'      => $status_penyakit[$i],
        'periksa_idperiksa' => $periksa,
        'pasien_noRM'       => $norm
      );
      $icd[$i] = $kodesakit[$i];
      $insert = $this->db->insert('diagnosa', $data);
      $this->db->reset_query();
      if ($insert == true) {
        $status = 1;
      } else {
        $status = 0;
      }
    }

    $kode_jasa        = $this->input->post('kode_jasa');
    $jasa             = $this->input->post('jasa');
    $harga            = $this->input->post('harga');
    $japeldokter      = $this->input->post('japeldokter');
    $japelperawat     = $this->input->post('japelperawat');
    $japeladmin       = $this->input->post('japeladmin');
    $japelresepsionis = $this->input->post('japelresepsionis');

    $count_jasa = count($kode_jasa);

    $total_jasa = 0;
    $total_menev_dokter = 0;
    $total_menev_perawat = 0;
    $total_menev_admin = 0;
    $total_menev_resepsionis = 0;
    for ($i = 0; $i < $count_jasa; $i++) {

      $data = array(
        'kodejasa'          => $kode_jasa[$i],
        'jsmedis'           => $jasa[$i],
        'harga'             => $harga[$i],
        'operator'          => $operator,
        'japel_dokter'      => $japeldokter[$i],
        'japel_perawat'     => $japelperawat[$i],
        'japel_admin'       => $japeladmin[$i],
        'japel_resepsionis' => $japelresepsionis[$i],
        'pasien_noRM'       => $norm,
        'periksa_idperiksa' => $periksa,
      );
      $insert = $this->db->insert('tindakan', $data);
      $this->db->reset_query();
      if ($insert == true) {
        $status = 1;
      } else {
        $status = 0;
      }
      $total_jasa += $harga[$i];
      $total_menev_dokter += $japeldokter[$i];
      $total_menev_perawat += $japelperawat[$i];
      $total_menev_admin += $japeladmin[$i];
      $total_menev_resepsionis += $japelresepsionis[$i];
    }
    $jam = date("H:i:s");
    if ($pegawai['keahlian'] == "UM") {
      $no = "212.002";
    } else {
      $no = "212.001";
    }
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
      'norek' => $no,
      'debet' => 0,
      'kredit' => $total_menev_dokter,
      'pasien_noRM' => $norm,
      'no_urut' => $nokun,
      'no_transaksi' => $kode,
      'jam' => $jam
    );
    $jurnal2 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
      'norek' => '212.003',
      'debet' => 0,
      'kredit' => $total_menev_perawat,
      'pasien_noRM' => $norm,
      'no_urut' => $nokun,
      'no_transaksi' => $kode,
      'jam' => $jam
    );
    $pendapatan = $total_jasa - ($total_menev_dokter + $total_menev_perawat + $total_menev_admin + $total_menev_resepsionis);
    $data_kunjungan = $this->db->get_where("kunjungan", array("no_urutkunjungan" => $nokun))->row_array();
    $tupel = $data_kunjungan['tupel_kode_tupel'];
    if ($tupel == 'GIG') {
      $norek = "411.006";
    } else if ($tupel == "INT") {
      $norek = "411.007";
    } else if ($tupel == "OBG") {
      $norek = "411.008";
    } else if ($tupel == "OZO") {
      $norek = "411.009";
    } else if ($tupel == "IGD") {
      $norek = "411.010";
    } else {
      $norek = "411.005";
    }
    $jurnal3 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
      'norek' => $norek,
      'debet' => 0,
      'kredit' => $pendapatan,
      'pasien_noRM' => $norm,
      'no_urut' => $nokun,
      'no_transaksi' => $kode,
      'jam' => $jam
    );

    if ($data_kunjungan['sumber_dana'] == 7) {
      $nojur = "113.002";
    } else {
      $nojur = "113.001";
    }

    $jurnal4 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
      'norek' => $nojur,
      'debet' => $total_jasa,
      'kredit' => 0,
      'pasien_noRM' => $norm,
      'no_urut' => $nokun,
      'no_transaksi' => $kode,
      'jam' => $jam
    );

    if ($data_kunjungan['sumber_dana'] == 7 || $data_kunjungan['sumber_dana'] == 9) {
      if ($total_menev_dokter != 0) {
        $this->db->insert('jurnal', $jurnal1);
      }
      if ($total_menev_perawat != 0) {
        $this->db->insert('jurnal', $jurnal2);
      }
      if ($tupel == 'GIG') {
        $norek = "411.006";
      } else if ($tupel == "IGD") {
        $norek = "411.010";
      } else {
        $norek = "411.005";
      }
      $jurnal3['norek'] = $norek;
      $this->db->insert('jurnal', $jurnal3);
    } else {
      $this->db->insert('jurnal', $jurnal4);
      if ($total_menev_dokter != 0) {
        $this->db->insert('jurnal', $jurnal1);
      }
      if ($total_menev_perawat != 0) {
        $this->db->insert('jurnal', $jurnal2);
      }
      $this->db->insert('jurnal', $jurnal3);
    }


    $jurnal2 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
      'norek' => '212.005',
      'debet' => 0,
      'kredit' => $total_menev_resepsionis,
      'pasien_noRM' => $norm,
      'no_urut' => $nokun,
      'no_transaksi' => $kode,
      'jam' => $jam
    );
    if ($total_menev_resepsionis != 0) {
      // code...
      $this->db->insert('jurnal', $jurnal2);
    }
    $jurnal2 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
      'norek' => '212.006',
      'debet' => 0,
      'kredit' => $total_menev_admin,
      'pasien_noRM' => $norm,
      'no_urut' => $nokun,
      'no_transaksi' => $kode,
      'jam' => $jam
    );
    if ($total_menev_admin != 0) {
      $this->db->insert('jurnal', $jurnal2);
    }
    $data_pasien = $this->ModelPasien->get_data_edit($norm)->row_array();
    $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($data_kunjungan['tupel_kode_tupel'])->row_array();
    if ($data_kunjungan['sumber_dana'] == 7 || $data_kunjungan['sumber_dana'] == 9) {
      if ($total_jasa != 0) {
        $jurnal4['norek'] = "213.002";
        $jurnal4['debet'] = $total_jasa;
        $jurnal4['kredit'] = 0;
        $this->db->insert("jurnal", $jurnal4);
      }
    }

    if ($data_pasien['jenis_pasien_kode_jenis'] == 7 && $_SESSION['poli'] != "IGD") {
      $kesadaran = array(
        'KOMPOMENTIS' => "01",
        'SAMNOLENSE' => "02",
        'STUPOR' => "03",
        'KOMA' => "04"

      );
      $pulang = "3";
      if ($data_kunjungan['rujuk_poli'] == 1) {
        $r = 005;
      } else {
        $r = null;
      }
      $data_pcare = array(
        // "noKunjungan" => null,
        "noKunjungan" => $data_kunjungan['nourut_pcare'],
        "noKartu"     => $data_pasien['noBPJS'],
        "tglDaftar"   => date("d-m-Y", strtotime($data_kunjungan['tgl'])),
        "kdPoli"      => $tujuan_pelayanan['kdpcare'],
        "keluhan"     => $data_kunjungan['keluhan'],
        "kdSadar"     => $data_periksa['osadar'] == NULL ? "01" : $kesadaran[$data_periksa['osadar']],
        "sistole"     => intval($data_periksa["osiastole"]),
        "diastole"    => intval($data_periksa["odiastole"]),
        "beratBadan"  => intval($data_periksa["obb"]),
        "tinggiBadan" => intval($data_periksa["otb"]),
        "respRate"    => intval($data_periksa["orr"]),
        "heartRate"   => intval($data_periksa["onadi"]),
        "lingkarPerut" => intval($data_periksa["olingkar_perut"]),
        "terapi"      => intval($data_periksa["oterapi"]),
        "kdStatusPulang" => $pulang,
        "tglPulang"   =>  date("d-m-Y"),
        "kdDokter"    => $pegawai['kode_bpjs'],
        "kdDiag1"     => $icd[0],
        "kdDiag2"     => $icd[1],
        "kdDiag3"     => $icd[2],
        "kdPoliRujukInternal" => $r,
        "rujukLanjut" => null,
        "kdTacc"      => 0,
        "alasanTacc"  => null
      );

      $pcare = $this->db->get("pcare")->row();
      if ($pcare->status == 0) {
        $bridge = "";
        $rujuk = NULL;
        $sarana = NULL;
      } else {
        // $bridge = PCare("kunjungan","POST",json_encode($data_pcare));
        $bridge = PcareV4("kunjungan", "POST", "text/plain", json_encode($data_pcare));
        $rujuk = PcareV4("spesialis/khusus");
        $sarana = PcareV4("spesialis/sarana");
        // $rujuk = json_decode(PCare("spesialis/khusus"));
        // $rujuk = json_decode(PCare("spesialis/khusus"));
      }
      $bridge = $bridge;
      if (!empty($bridge) || $bridge != "") {
        // $bridge = json_decode($bridge);
        if ($bridge->metaData->code == 201) {
          $this->db->where("no_urutkunjungan", $data_periksa['kunjungan_no_urutkunjungan'])->update("kunjungan", array("nokun_bridging" => $bridge->response[0]->message, 'status_bridging_pemeriksaan' => 1));
          $nokun =  $bridge->response[0]->message;
          $kode_tindakan = $this->input->post("kode_bpjs");

          for ($i = 0; $i < count($kode_tindakan); $i++) {
            $data = array(
              "kdTindakanSK" => 0,
              "noKunjungan" => $nokun,
              "kdTindakan" => $kode_tindakan[$i],
              "biaya" => 0,
              "keterangan" => null,
              "hasil" => 0
            );
            // $bridge = PCare("tindakan","POST",json_encode($data));
            $bridge = PcareV4("tindakan", "POST", "text/plain", json_encode($data));
          }

          if ($data_periksa["gl_sewaktu"] != 0 || $data_periksa["gl_puasa"] != 0 || $data_periksa["gl_post_prandial"] != 0 || $data_periksa["gl_hba"] != 0) {
            $data_lab = array(
              "kdMCU" => 0,
              "noKunjungan" => $nokun,
              "kdProvider" => "0189B016",
              "tglPelayanan" => date("d-m-Y"),
              "tekananDarahSistole" => $data_periksa["osiastole"] == NULL ? 120 : $data_periksa["osiastole"],
              "tekananDarahDiastole" => $data_periksa["odiastole"] == NULL ? 75 : $data_periksa["odiastole"],
              "radiologiFoto" => null,
              "darahRutinHemo" => 0,
              "darahRutinLeu" => 0,
              "darahRutinErit" => 7,
              "darahRutinLaju" => 0,
              "darahRutinHema" => 0,
              "darahRutinTrom" => 0,
              "lemakDarahHDL" => 0,
              "lemakDarahLDL" => 0,
              "lemakDarahChol" => 0,
              "lemakDarahTrigli" => 0,
              "gulaDarahSewaktu" => intval($data_periksa["gl_sewaktu"]),
              "gulaDarahPuasa" => intval($data_periksa["gl_puasa"]),
              "gulaDarahPostPrandial" => intval($data_periksa["gl_post_prandial"]),
              "gulaDarahHbA1c" => intval($data_periksa["gl_hba"]),
              "fungsiHatiSGOT" => 0,
              "fungsiHatiSGPT" => 0,
              "fungsiHatiGamma" => 0,
              "fungsiHatiProtKual" => 0,
              "fungsiHatiAlbumin" => 0,
              "fungsiGinjalCrea" => 0,
              "fungsiGinjalUreum" => 0,
              "fungsiGinjalAsam" => 0,
              "fungsiJantungABI" => 0,
              "fungsiJantungEKG" => null,
              "fungsiJantungEcho" => null,
              "funduskopi" => null,
              "pemeriksaanLain" => null,
              "keterangan" => null
            );
            PcareV4("mcu", "POST", "text/plain", json_encode($data_lab));
            // PCare("mcu","POST",json_encode($data_lab));
            // echo json_encode($bridge);
          }
          $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan dan Terbridging'));
        } else {
          if ($bridge->metaData->code == 412) {
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response->field . " " . $bridge->response[0]->message . ' ' . $bridge->metaData->message));
          } else {
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response->field . " " . $bridge->metaData->message));
          }
        }
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, Pcare Bermasalah'));
      }
    } else {
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
    }


    if ($status == 1) {
      // redirect(base_url()."Periksa/index/".$data_periksa['kunjungan_no_urutkunjungan']);
      redirect(base_url() . "Periksa/resep/" . $periksa);
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
      // redirect(base_url()."Periksa/resep/".$periksa);
    }
  }

  function input_labkun()
  {
    $tanggal        = date('Y-m-d ');
    $jam            = date('Y-m-d H:i:d');
    $kodedok        = $_SESSION['nik'];
    $periksa_idperiksa = $this->input->post('nopem');
    $rujukan        = $this->input->post('rujukan');
    $perawat1       = $this->input->post('perawat1');
    $perawat2       = $this->input->post('perawat2');
    $periksa        = $this->input->post('nopem');
    $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
    $norm = $this->input->post("no_rm");
    $kode_akun = $this->ModelAkuntansi->generete_notrans();
    $nokun = $data_periksa['kunjungan_no_urutkunjungan'];
    $data_kunjungan = $this->db->get_where("kunjungan", array("no_urutkunjungan" => $nokun))->row();

    if ($_SESSION['poli'] == "IGD" && $data_kunjungan->rujuk_poli == 1) {
      $this->db->where('kunjungan_no_urutkunjungan', $data_periksa['kunjungan_no_urutkunjungan']);
      $this->db->where('tujuan_poli', "IGD");
      $this->db->update('rujukan_internal', array('sudah' => '1',));
    } else {
      $this->db->where('no_urutkunjungan', $data_periksa['kunjungan_no_urutkunjungan']);
      $this->db->update('kunjungan', array('sudah' => '1',));
    }
    $labkunjungan = array(
      'tanggal'     => $tanggal,
      'rujukan'     => $rujukan,
      'kodedok'     => $kodedok,
      'jam'         => $jam,
      'perawat1'    => $perawat1,
      'perawat2'    => $perawat2,
      'yan_lab'     => "0",
      'periksa_idperiksa' => $this->input->post('nopem')
    );
    if ($this->db->insert('labkunjungan', $labkunjungan)) {
      $labkun = $this->db->get_where('labkunjungan', $labkunjungan)->row_array();
      $idlabkun = $labkun['nokunjlab'];
      $kode_lab     = $this->input->post('kode_lab');
      $jenis        = $this->input->post('jenis_lab');
      $count = count($kode_lab);
      $harga = $this->input->post('harga_lab');
      $list_kode = array();
      $status = 0;
      if ($count == 0) {
        $this->db->where('periksa_idperiksa', $this->input->post('nopem'))->delete('labkunjungan');
      } else {
        $total_harga_lab = 0;
        for ($i = 0; $i < $count; $i++) {
          // die($kode);
          $kode = substr($kode_lab[$i], 0, 2);
          if ($harga[$i] == 0 && !in_array($kode, $kode_lab, TRUE) && !in_array($kode, $list_kode, TRUE)) {

            $hit = $this->db->get_where('laborat', array('kode_lab' => $kode,))->num_rows();
            // die(var_dump($hit));
            if ($hit > 0) {
              $lab = $this->ModelLaborat->get_data_edit($kode);
              // die(var_dump($lab));
              $data = array(
                'nourutlab'           => $idlabkun,
                'kodelab'             => $lab['kode_lab'],
                'nama'                => $lab['jenis_lab'],
                'harga' => $lab['hrg_1'],
                'komisi' => $lab['hrg_1']
              );
              $insert = $this->db->insert('detaillab', $data);
              $this->db->reset_query();
              array_push($list_kode, $kode);
              $total_harga_lab += $data['harga'];
            }
          }
          $data = array(
            'nourutlab'           => $idlabkun,
            'kodelab'             => $kode_lab[$i],
            'nama'                => $jenis[$i],
            'harga' => $harga[$i],
            'komisi' => $harga[$i]
          );
          $insert = $this->db->insert('detaillab', $data);
          $this->db->reset_query();
          if ($insert == true) {
            $status = 1;
          } else {
            $status = 0;
          }
          $data_lab = $this->db->get_where("laborat", array('kode_lab' => $kode_lab[$i]))->row_array();
          $total_harga_lab += $data_lab['jasa_dokter_1'] + $data_lab['jasa_perawat_1'] + $data_lab['jasa_resepsionis_1'] + $data_lab['jasa_analis_1'] + $data_lab['jasa_ob_1'] + $data_lab['jasa_admin_1'];
        }
      }
      if ($status == 1) {
        $jam = date("H:i:s");
        $jurnal1 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
          'norek' => '10701',
          'debet' => $total_harga_lab,
          'kredit' => 0,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode_akun,
          'jam' => $jam
        );
        $jurnal2 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
          'norek' => '20601',
          'debet' => 0,
          'kredit' => $total_harga_lab,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode_akun,
          'jam' => $jam
        );
        if ($total_harga_lab != 0) {
          // $this->db->insert('jurnal',$jurnal1);
          // $this->db->insert('jurnal',$jurnal2);
        }
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        redirect("Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        redirect("Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
      }
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect("Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
    }
  }
  function edit_labkun()
  {
    $tanggal        = date('Y-m-d ');
    $jam            = date('Y-m-d H:i:d');
    $kodedok        = $_SESSION['nik'];
    $periksa_idperiksa = $this->input->post('nopem');
    $rujukan        = $this->input->post('rujukan');
    $perawat1       = $this->input->post('perawat1');
    $perawat2       = $this->input->post('perawat2');
    $periksa        = $this->input->post('nopem');
    $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
    $nokun = $data_periksa['kunjungan_no_urutkunjungan'];
    $norm = $data_periksa['no_rm'];
    $data_kunjungan = $this->db->get_where("kunjungan", array("no_urutkunjungan" => $data_periksa['kunjungan_no_urutkunjungan']))->row();

    if ($_SESSION['poli'] == "IGD" && $data_kunjungan->rujuk_poli == 1) {
      $this->db->where('kunjungan_no_urutkunjungan', $data_periksa['kunjungan_no_urutkunjungan']);
      $this->db->where('tujuan_poli', "IGD");
      $this->db->update('rujukan_internal', array('sudah' => '1',));
    } else {
      $this->db->where('no_urutkunjungan', $data_periksa['kunjungan_no_urutkunjungan']);
      $this->db->update('kunjungan', array('sudah' => '1',));
    }
    $datakun_lab = $this->db->get_where('labkunjungan', array('periksa_idperiksa' => $periksa))->row_array();
    $data_detail = $this->db->where_in('nourutlab', $datakun_lab['nokunjlab'])->get("detaillab")->result();
    $harga_awal = 0;
    $harga_akhir = 0;
    $kode_akun = $this->ModelAkuntansi->generete_notrans();
    foreach ($data_detail as $value) {
      $harga_awal += $value->harga;
    }

    $this->db->where_in('nourutlab', $datakun_lab['nokunjlab']);
    $this->db->delete('detaillab');
    $labkunjungan = array(
      'tanggal'     => $tanggal,
      'rujukan'     => $rujukan,
      'kodedok'     => $kodedok,
      'jam'         => $jam,
      'perawat1'    => $perawat1,
      'perawat2'    => $perawat2,
      'yan_lab'     => "0",
      'periksa_idperiksa' => $this->input->post('nopem')
    );
    $this->db->where('periksa_idperiksa', $periksa);
    if ($this->db->update('labkunjungan', $labkunjungan)) {
      $labkun = $this->db->get_where('labkunjungan', $labkunjungan)->row_array();
      $idlabkun = $labkun['nokunjlab'];
      $kode_lab     = $this->input->post('kode_lab');
      $jenis        = $this->input->post('jenis_lab');
      $count = count($kode_lab);
      $harga = $this->input->post('harga_lab');

      $list_kode = array();
      $status = 0;
      if ($count == 0) {
        $this->db->where('periksa_idperiksa', $this->input->post('nopem'))->delete('labkunjungan');
      } else {
        for ($i = 0; $i < $count; $i++) {
          $kode = substr($kode_lab[$i], 0, 2);
          // die($kode);
          if ($harga[$i] == 0 && !in_array($kode, $kode_lab, TRUE) && !in_array($kode, $list_kode, TRUE)) {

            $hit = $this->db->get_where('laborat', array('kode_lab' => $kode,))->num_rows();
            // die(var_dump($hit));
            if ($hit > 0) {
              $lab = $this->ModelLaborat->get_data_edit($kode);
              // die(var_dump($lab));
              $data = array(
                'nourutlab'           => $idlabkun,
                'kodelab'             => $lab['kode_lab'],
                'nama'                => $lab['jenis_lab'],
                'harga' => $lab['hrg_1'],
                'komisi' => $lab['hrg_1']
              );
              $insert = $this->db->insert('detaillab', $data);
              $this->db->reset_query();
              array_push($list_kode, $kode);
            }
          }
          $data = array(
            'nourutlab'           => $idlabkun,
            'kodelab'             => $kode_lab[$i],
            'nama'                => $jenis[$i],
            'harga' => $harga[$i],
            'komisi' => $harga[$i]
          );
          $harga_akhir += $harga[$i];
          $insert = $this->db->insert('detaillab', $data);
          $this->db->reset_query();
          if ($insert == true) {
            $status = 1;
          } else {
            $status = 0;
          }
        }
      }
      if ($status == 1) {
        $jam = date("H:i:s");
        $jurnal1 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
          'norek' => '10701',
          'debet' => 0,
          'kredit' => 0,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode_akun,
          'jam' => $jam
        );
        $jurnal2 = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi nomor kunjungan ' . $nokun,
          'norek' => '50004',
          'debet' => 0,
          'kredit' => 0,
          'pasien_noRM' => $norm,
          'no_urut' => $nokun,
          'no_transaksi' => $kode_akun,
          'jam' => $jam
        );
        // if ($harga_awal>$harga_akhir) {
        //   $harga_selisih = $harga_awal-$harga_akhir;
        //   $jurnal1['kredit'] = $harga_selisih;
        //   $jurnal2['debet'] = $harga_selisih;
        // }else{
        //   $harga_selisih = $harga_akhir-$harga_awal;
        //   $jurnal1['debet'] = $harga_selisih;
        //   $jurnal2['kredit'] = $harga_selisih;
        // }
        // $this->db->insert('jurnal',$jurnal1);
        // $this->db->insert('jurnal',$jurnal2);
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        redirect("Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        redirect("Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
      }
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect("Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
    }
  }

  function resep()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();

    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/resep',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'resep'       => $this->ModelObat->get_data(),
      'no_resep'    => $this->ModelResep->generate_no_resep(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'obat'        => $this->ModelObat->get_data()
    );
    $this->load->view('index', $data);
  }

  function cariobat()
  {
    // $idobat = "000112";
    $idobat = $this->input->post('idobat');
    $obat = $this->ModelObat->get_data_edit($idobat)->row_array();
    if ($_SESSION['poli'] == 'IGD') {
      // die('a');
      $stok_obat = $this->db
        ->select("SUM(stok) as stok")
        ->where("idobat", $idobat)
        ->where("unit", "UGD")
        ->where("stok >", "0")
        ->get("list_batch")->row();
      if (@$stok_obat->stok <= 0) {
        $status = 0;
      } else {
        $status = 1;
      }
      $stok = @$stok_obat->stok + 0;
    } else {
      // die('b');
      $stok_obat = $this->db->select("idobat, nama_obat, unit, SUM(stok) as stok")
        ->group_by("idobat")
        ->where("unit", "APOTEK")
        ->where("idobat", $idobat)
        ->get('list_batch')->row();
      // $stok_obat = $this->db
      // ->select("*")
      // ->where("idobat",$idobat)
      // ->where("unit","APOTEK")
      // ->where("stok >","0")
      // ->get("list_batch")->row();
      if (@$stok_obat->stok <= 0) {
        $status = 0;
      } else {
        $status = 1;
      }
      $stok = @$stok_obat->stok + 0;
    }

    if ($_SESSION['poli'] == 'OZO') {
      $harga = $obat['harga_ozon'];
    } else {
      $harga = $obat['harga_1'];
    }

    $data = array(
      'id_obat' => $idobat,
      'nama_obat' => $obat['nama_obat'],
      'label_harga' => "Rp." . number_format($obat['harga_1'], 2, ",", "."),
      'harga' => $harga,
      'dosis' => $obat['dosis'],
      'stok' => $stok,
      'status' => $status,
      'kdbpjs' => $obat['kdbpjs']
    );
    // echo json_encode($stok_obat);
    echo json_encode($data);
  }

  public function input_resep()
  {
    $hasil_sortir_signa = array();  //untuk mendapatkan angka saja
    $tanggal        = date('Y-m-d h:i:s');
    $kode_dokter    = $_SESSION['nik'];
    $norm           = $this->input->post('no_rm');
    $perawat1       = $this->input->post('perawat1');
    $perawat2       = $this->input->post('perawat2');
    $no_resep       = $this->ModelResep->generate_no_resep();
    $periksa        = $this->input->post('nopem');
    $data_periksa   = $this->ModelPeriksa->get_data_edit($periksa);
    $kode           = $this->ModelAkuntansi->generete_notrans();
    $nokun         = $data_periksa['kunjungan_no_urutkunjungan'];
    $row = $this->db->get_where("resep", array("periksa_idperiksa" => $periksa))->num_rows();
    $rm = $this->input->post("no_rm");
    $alergi_reaksi = $this->input->post("alergi_reaksi");
    $konsumsi = $this->input->post("konsumsi");
    $jenis_penyakit = $this->input->post("jenis_penyakit");
    $tgl_alergi = $this->input->post("tgl_alergi");
    $data_kunjungan = $this->ModelKunjungan->get_data_edit($nokun);
    // echo json_encode($data_kunjungan);
    if ($data_kunjungan['sumber_dana'] == 7) {
      $data_update_billing = array(
        'billing' => '0',
      );
      $this->db->where('no_urutkunjungan', $nokun);
      $this->db->update('kunjungan', $data_update_billing);
    }

    if (!empty($alergi_reaksi)) {
      for ($i = 0; $i < count($alergi_reaksi); $i++) {
        $ra = array(
          'alergi_reaksi' => $alergi_reaksi[$i],
          'jenis_penyakit' => $jenis_penyakit[$i],
          'konsumsi' => $konsumsi[$i],
          'tgl_alergi' => $tgl_alergi[$i],
          'pasien_noRM' => $rm
        );
        $this->db->insert("riwayat_alergi", $ra);
        $this->db->reset_query();
      }
    }


    $daftar_obat = $this->input->post('kode');
    if (empty($daftar_obat)) {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal membuat resep, obat tidak dipilih'));
      redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
    } else {
      if ($row > 0) {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal,Resep telah dibuat sebelumnya'));
        redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
      } else {
        $data_kunjungan = $this->db->get_where("kunjungan", array("no_urutkunjungan" => $data_periksa['kunjungan_no_urutkunjungan']))->row();

        if ($_SESSION['poli'] == "IGD" && $data_kunjungan->rujuk_poli == 1) {
          $this->db->where('kunjungan_no_urutkunjungan', $data_periksa['kunjungan_no_urutkunjungan']);
          $this->db->where('tujuan_poli', "IGD");
          $this->db->update('rujukan_internal', array('sudah' => '1',));
        } else {
          $this->db->where('no_urutkunjungan', $data_periksa['kunjungan_no_urutkunjungan']);
          $this->db->update('kunjungan', array('sudah' => '1',));
        }

        $resep = array(
          'tanggal'     => $tanggal,
          'kode_dokter' => $kode_dokter,
          'perawat1'    => $perawat1,
          'perawat2'    => $perawat2,
          'no_resep'    => $no_resep,
          'periksa_idperiksa' => $periksa,
          'status_resep' => 1
        );
        if ($this->db->insert('resep', $resep)) {
          $id_obat      = $this->input->post('kode');
          $harga     = $this->input->post('harga');
          $jumlah       = $this->input->post('jumlah');
          $signa       = $this->input->post('signa');
          $total_harga       = $this->input->post('ttl_harga');
          $count = count($id_obat);

          $total_hpp_obat = 0;

          for ($i = 0; $i < $count; $i++) {
            $data_sortir_signa = explode(' ', $signa[$i]); //pilih number signa;
            array_push($hasil_sortir_signa, $data_sortir_signa);
            $obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
            $data = array(
              'harga'          => $harga[$i],
              'jumlah'         => $jumlah[$i],
              'total_harga'    => $harga[$i] * $jumlah[$i],
              'resep_no_resep' => $no_resep,
              'obat_idobat'    => $id_obat[$i],
              'signa'          => $signa[$i],
            );

            $insert = $this->db->insert('detail_resep', $data);
            $res_id = $this->db->insert_id();
            $this->db->reset_query();
            // $this->db->where('kunjungan',$periksa);
            if ($insert == true) {
              $status = 1;
            } else {
              $status = 0;
            }

            //FIFO RESEP
            $loop = true;
            $jm_resep = $jumlah[$i];
            $jumlah_tersimpan = 0;
            if ($jumlah[$i] > 0) {
              do {
                if ($_SESSION['poli'] == 'IGD') {
                  $list_batch = $this->db
                    ->order_by("tanggal_expired", "ASC")
                    ->get_where("list_batch", array("idobat" => $id_obat[$i], "stok >" => 0, "unit" => "UGD"))->row_array();
                } else {
                  $list_batch = $this->db
                    ->order_by("tanggal_expired", "ASC")
                    ->get_where("list_batch", array("idobat" => $id_obat[$i], "stok >" => 0, "unit" => "APOTEK"))->row_array();
                }
                $jumlah_tersedia = $list_batch['stok'];
                if (empty($list_batch)) {
                  break;
                }
                if ($jumlah[$i] < $jumlah_tersedia && $jumlah[$i] > 0) {
                  $loop = false;
                  $beri = $jumlah[$i];
                  $jumlah[$i] = 0;
                } else {
                  $sisa = $jumlah[$i] - $jumlah_tersedia;
                  $beri =  $jumlah_tersedia;
                  $jumlah[$i] = $sisa;
                }
                $resep_diberikan = array(
                  'id_detail_resep' => $res_id,
                  'jumlah_resep' => $jm_resep,
                  'jumlah_beri' => $beri,
                  'resep_no_resep' => $no_resep,
                  'obat_idobat' => $id_obat[$i],
                  'signa' => $signa[$i],
                  'no_batch' => $list_batch['no_batch'],
                  'id_pengadaan' => $list_batch['iddetail_pembelian_obat'],
                  'tanggal' => date("Y-m-d"),
                  'unit' => $list_batch['unit']
                );
                $this->db->insert("detail_resep_diberikan", $resep_diberikan);
                $jumlah_tersimpan += $beri;
              } while ($jumlah[$i] > 0);
            }
            $this->db->where("iddetail_resep", $res_id)->update("detail_resep", array("jumlah" => $jumlah_tersimpan, "total_harga" => $harga[$i] * $jumlah_tersimpan));
            $total_hpp_obat += $obat['harga_beli_satuan_kecil'] * $jumlah[$i];
          }
          if ($status == 1) {
            $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
            redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
          } else {
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
            redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
          }
          // echo json_encode($hasil_sortir_signa);
        } else {
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
          redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
        }
      }
    }
  }

  public function bridge_ulang3()
  {
    $id = $this->uri->segment(3);
    // $bridge = BridgingPemeriksaanRajal($id);
    $data_kunjungan = $this->db
      ->join("pasien", "pasien_noRM=noRM")
      ->get_where("kunjungan", array("no_urutkunjungan" => $id))->row_array();
    $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($data_kunjungan['tupel_kode_tupel'])->row_array();
    $data_periksa = $this->db->get_where("periksa", array("kunjungan_no_urutkunjungan" => $id))->row_array();
    $dokter = $this->db->get_where("pegawai", array("NIK" => $data_periksa["operator"]))->row_array();
    $diagnosa = $this->db
      ->join("periksa", "periksa_idperiksa=idperiksa")
      ->join("kunjungan", "kunjungan_no_urutkunjungan=no_urutkunjungan")
      ->group_by("kodesakit")
      ->get_where("diagnosa", array("no_urutkunjungan" => $id))->result();
    $icd = [null, null, null];
    $no = 0;
    foreach ($diagnosa as $value) {
      $icd[$no] = $value->kodesakit;
      $no++;
    }
    $data_kunjungan['noBPJS'] = strlen($data_kunjungan['noBPJS']) > 13 ? trim($data_kunjungan['noBPJS']) : str_pad($data_kunjungan['noBPJS'], 13, "0", STR_PAD_LEFT);
    if (strlen($data_kunjungan['noBPJS']) > 13) {
      $this->db->where("noRM", $data_kunjungan['noRM'])->update("pasien", array('noBPJS' => $data_kunjungan['noBPJS']));
    }
    if (strlen($data_kunjungan['noBPJS']) < 13) {
      $this->db->where("noRM", $data_kunjungan['noRM'])->update("pasien", array('noBPJS' => $data_kunjungan['noBPJS']));
    }
    $kesadaran = array(
      'KOMPOMENTIS' => "01",
      'SAMNOLENSE' => "02",
      'STUPOR' => "03",
      'KOMA' => "04"

    );
    $pulang = "3";
    if ($data_kunjungan['rujuk_poli'] == 1) {
      $r = "005";
    } else {
      // $r = "003";
      $r = null;
    }
    $data_periksa['osadar'] = $data_periksa['osadar'] == NULL ? "KOMPOMENTIS" : $data_periksa['osadar'];
    $data_pcare = array(
      "noKunjungan" => $data_kunjungan['nourut_pcare'],
      "noKartu"     =>  $data_kunjungan['noBPJS'],
      "tglDaftar"   => date("d-m-Y", strtotime($data_kunjungan['tgl'])),
      "kdPoli"      => $tujuan_pelayanan['kdpcare'],
      "keluhan"     => $data_kunjungan['keluhan'] == NULL ? $data_periksa["keluhan"] : $data_kunjungan['keluhan'],
      "kdSadar"     => $kesadaran[$data_periksa['osadar']],
      "sistole"     => intval($data_periksa["osiastole"] == NULL ? 120 : $data_periksa["osiastole"]),
      "diastole"    => intval($data_periksa["odiastole"] == NULL ? 75 : $data_periksa["odiastole"]),
      "beratBadan"  => intval($data_periksa["obb"] == NULL ? $data_kunjungan['bb'] : $data_periksa["obb"]),
      "tinggiBadan" => intval($data_periksa["otb"] == NULL ? $data_kunjungan['tb'] : $data_periksa["otb"]),
      "respRate"    => intval($data_periksa["orr"] == NULL ? 18 : $data_periksa["orr"]),
      "heartRate"   => intval($data_periksa["onadi"] == NULL ? 80 : $data_periksa["onadi"]),
      "lingkarPerut" => intval($data_periksa["olingkar_perut"] == NULL || $data_periksa["olingkar_perut"] == 0 ? 80 : $data_kunjungan["lingkar_perut"]),
      "terapi"      => intval($data_periksa["oterapi"]),
      "kdStatusPulang" => $pulang,
      "tglPulang"   => date("d-m-Y"),
      "kdDokter"    => $dokter['kode_bpjs'],
      // "kdDokter"    => '256044  ',
      "kdDiag1"     => $icd[0],
      "kdDiag2"     => $icd[1],
      "kdDiag3"     => $icd[2],
      "kdPoliRujukInternal" => $r,
      "rujukLanjut" => null,
      "kdTacc"      => 0,
      "alasanTacc"  => null
    );
    // echo json_encode($data_pcare);
    $bridge = PcareV4("kunjungan", "POST", "text/plain", json_encode($data_pcare));
    // echo json_encode(array('bridge' => $bridge, 'pcare' => $data_pcare));
    // die();
    $bridge = json_decode($bridge);
    if ($bridge->metaData->code == 201) {
      $nokun =  $bridge->response->message;
      $kode_tindakan = array();
      $tindakan = $this->db
        ->join("periksa", "periksa_idperiksa=idperiksa")
        ->join("kunjungan", "kunjungan_no_urutkunjungan=no_urutkunjungan")
        ->get_where("tindakan", array("no_urutkunjungan" => $id))->result();
      foreach ($tindakan as $value) {
        array_push($kode_tindakan, $value->kode_jasa);
      }
      for ($i = 0; $i < count($kode_tindakan); $i++) {
        $data = array(
          "kdTindakanSK" => 0,
          "noKunjungan" => $nokun,
          "kdTindakan" => $kode_tindakan[$i],
          "biaya" => 0,
          "keterangan" => null,
          "hasil" => 0
        );
        PcareV4("tindakan", "POST", "text/plain", json_encode($data));
      }
      if ($data_periksa["gl_sewaktu"] != 0 || $data_periksa["gl_puasa"] != 0 || $data_periksa["gl_post_prandial"] != 0 || $data_periksa["gl_hba"] != 0) {
        $data_lab = array(
          "kdMCU" => 0,
          "noKunjungan" => $nokun,
          "kdProvider" => "0189B016",
          "tglPelayanan" => date("d-m-Y"),
          "tekananDarahSistole" => $data_periksa["osiastole"] == NULL ? 120 : $data_periksa["osiastole"],
          "tekananDarahDiastole" => $data_periksa["odiastole"] == NULL ? 75 : $data_periksa["odiastole"],
          "radiologiFoto" => null,
          "darahRutinHemo" => 0,
          "darahRutinLeu" => 0,
          "darahRutinErit" => 0,
          "darahRutinLaju" => 0,
          "darahRutinHema" => 0,
          "darahRutinTrom" => 0,
          "lemakDarahHDL" => 0,
          "lemakDarahLDL" => 0,
          "lemakDarahChol" => 0,
          "lemakDarahTrigli" => 0,
          "gulaDarahSewaktu" => $data_periksa["gl_sewaktu"],
          "gulaDarahPuasa" => $data_periksa["gl_puasa"],
          "gulaDarahPostPrandial" => $data_periksa["gl_post_prandial"],
          "gulaDarahHbA1c" => $data_periksa["gl_hba"],
          "fungsiHatiSGOT" => 0,
          "fungsiHatiSGPT" => 0,
          "fungsiHatiGamma" => 0,
          "fungsiHatiProtKual" => 0,
          "fungsiHatiAlbumin" => 0,
          "fungsiGinjalCrea" => 0,
          "fungsiGinjalUreum" => 0,
          "fungsiGinjalAsam" => 0,
          "fungsiJantungABI" => 0,
          "fungsiJantungEKG" => null,
          "fungsiJantungEcho" => null,
          "funduskopi" => null,
          "pemeriksaanLain" => null,
          "keterangan" => null
        );
        PcareV4("MCU", "POST", "text/plain", json_encode($data_lab));
      }
      if ($bridge->metaData->code == 201) {
        $this->db->where("no_urutkunjungan", $id)->update("kunjungan", array("nokun_bridging" => @$bridge->response[0]->message, 'status_bridging_pemeriksaan' => 1));
        $this->session->set_flashdata('notif', $this->Notif->berhasil("(success bridging)!!!"));
      } else {
        if ($bridge->metaData->code == 412) {
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response->field . " " . $bridge->response->message . ' ' . $bridge->metaData->message));
        } elseif ($bridge->metaData->code == 304) {
          $this->db->where("no_urutkunjungan", $id)->update("kunjungan", array('status_bridging_pemeriksaan' => 1));
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . @$bridge->response . ', ' . @$bridge->metaData->message));
        } else {
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . @$bridge->metaData->message));
        }
      }
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging ' . $bridge->metaData->message));
    }
    redirect("Periksa/index/" . $id);
  }

  function obgyn()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/poli/obgyn',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'riwayat'     => $this->ModelPeriksa->get_riwayat_obgyn($kunjungan['pasien_noRM'])->result()
    );

    $this->load->view('index', $data);
  }

  function insert_obgyn($value = '')
  {
    $dataobgyn = array(
      'manarche_umur'     => $this->input->post('manarcheumur'),
      'lamahaid'          => $this->input->post('lamahaid'),
      'siklus'            => $this->input->post('siklus'),
      'keluhan_obgyn'     => implode(', ', $this->input->post('keluhan_obgyn')),
      'g'                 => $this->input->post('g'),
      'p'                 => $this->input->post('p'),
      'a'                 => $this->input->post('a'),
      'hpht'              => $this->input->post('hpht'),
      'hpl'               => $this->input->post('hpl'),
      'uk'                => $this->input->post('uk'),
      'keluhanhamil'      => $this->input->post('keluhan_kehamilan'),
      'infertilitas'      => $this->input->post('infertilitas'),
      'infeksivirus'      => $this->input->post('Infeksi'),
      'pms'               => $this->input->post('PMS'),
      'cervitiscronis'    => $this->input->post('Cervitiscronis'),
      'endometriosis'     => $this->input->post('Endometriosis'),
      'myoma'             => $this->input->post('Myoma'),
      'ok'                => $this->input->post('ok'),
      'perkosaan'         => '',
      'pcb'               => $this->input->post('pcb'),
      'fag'               => $this->input->post('fag'),
      'gatal'             => $this->input->post('gatal'),
      'berbau'            => $this->input->post('berbau'),
      'warna'             => $this->input->post('warna'),
      'metodekb'          => $this->input->post('metodekb'),
      'lamakb'            => $this->input->post('lamakb'),
      'lamakb_bln'  => $this->input->post('lamakb_bln'),
      'pernah_kb' => $this->input->post('pernahkb'),
      'komplikasi'        => implode(', ', $this->input->post('Komplikasi')),
      'kunjungan_no_urutkunjungan' => $this->input->post('nokun'),
      'tanggal' => date('Y-m-d'),
      'no_rm'   => $this->input->post('no_rm'),
      'unit_layanan'  => $_SESSION['poli']
    );
    if ($this->db->insert('periksa', $dataobgyn)) {
      $this->db->reset_query();
      $this->db->where('no_urutkunjungan', $this->input->post('nokun'));
      $this->db->update('kunjungan', array('sudah' => '1',));
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect(base_url() . 'Periksa/index/' . $this->input->post('nokun'));
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      redirect(base_url() . 'Periksa/index/' . $this->input->post('nokun'));
    }
  }
  public function pemakaianObat()
  {
    $data = array(
      'form' => 'PemakaianObat/form',
      'body' => 'PemakaianObat/list',
      'obat' => $this->ModelObat->get_data()
    );
    $this->load->view('index', $data);
  }

  public function kandungan()
  {
    $tgl = $this->input->post('hpht');
    $hpht1 = date("Y-m-d", strtotime($tgl));
    $hpl = date("d-m-Y", strtotime("+280 days", strtotime($hpht1)));
    $hpht      = strtotime($hpht1);
    $sekarang = time(); // Waktu sekarang
    $uk       = $sekarang - $hpht;
    $uk = floor($uk / (60 * 60 * 24));
    $uk = floor($uk / 7) . " Minggu";
    if ($tgl == '') {
      $res = array(
        'uk' => "ulangi pilih hpht",
        'hpl' => "ulangi pilih hpht"
      );
    } else {
      $res = array(
        'uk' => $uk,
        'hpl' => $hpl
      );
    }
    // die(var_dump($res));
    echo json_encode($res);
  }
  public function rujuk()
  {
    $nokun = $this->uri->segment(3);
    $tujuan = $this->input->post("tujuan_poli");
    $data = array(
      'poli' => $_SESSION['poli'],
      'tujuan_poli' => $tujuan,
      'kunjungan_no_urutkunjungan' => $nokun
    );
    $this->db->insert('rujukan_internal', $data);
    $this->db->where('no_urutkunjungan', $nokun);
    if ($tujuan == "RANAP") {
      $this->db->update('kunjungan', array('rujukan_internal' => 1));
    } else {
      $this->db->update('kunjungan', array('rujuk_poli' => 1));
    }
    $this->session->set_flashdata('notif', $this->Notif->berhasil("Pasien telah dirujuk atau dialihkan ke unit layanan lain"));
    redirect(base_url() . "Kunjungan");
  }
  function edit_resep()
  {
    $periksa = $this->ModelPeriksa->get_data_edit($this->uri->segment(3));
    $kunjungan = $this->ModelKunjungan->get_data_edit($periksa['kunjungan_no_urutkunjungan']);
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'body'        => 'Periksa/resep_edit',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'resep'       => $this->ModelObat->get_data(),
      'no_resep'    => $this->ModelResep->generate_no_resep(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'riwayat'     => $this->ModelResep->get_riwayat($kunjungan['pasien_noRM']),
      'obat' => $this->ModelObat->get_data()
    );
    if ($this->uri->segment(4) != '') {
      $data_obat = $this->db->join('obat', 'obat.idobat=detail_resep.obat_idobat')
        ->where_in("resep_no_resep", $this->uri->segment(4))
        ->get('detail_resep')->result();
      $data['resep_lama'] = $data_obat;
    }
    $this->load->view('index', $data);
  }

  public function update_resep($no_resep)
  {
    $tanggal        = date('Y-m-d h:i:s');
    $kode_dokter    = $_SESSION['nik'];
    $periksa        = $this->input->post('nopem');
    $data_periksa = $this->ModelPeriksa->get_data_edit($periksa);
    $nokun = $data_periksa['kunjungan_no_urutkunjungan'];
    $norm = $data_periksa['no_rm'];
    $detil_resep = $this->db->where_in('resep_no_resep', $no_resep)->get('detail_resep')->result();
    $rm = $this->input->post("no_rm");
    $alergi_reaksi = $this->input->post("alergi_reaksi");
    $konsumsi = $this->input->post("konsumsi");
    $jenis_penyakit = $this->input->post("jenis_penyakit");
    $tgl_alergi = $this->input->post("tgl_alergi");
    if (!empty($alergi_reaksi)) {
      for ($i = 0; $i < count($alergi_reaksi); $i++) {
        $ra = array(
          'alergi_reaksi' => $alergi_reaksi[$i],
          'jenis_penyakit' => $jenis_penyakit[$i],
          'konsumsi' => $konsumsi[$i],
          'tgl_alergi' => $tgl_alergi[$i],
          'pasien_noRM' => $rm
        );
        $this->db->insert("riwayat_alergi", $ra);
        $this->db->reset_query();
      }
    }

    $harga_awal = 0;
    $harga_akhir = 0;
    $this->db->where_in('resep_no_resep', $no_resep);
    $this->db->delete('detail_resep');
    $this->db->reset_query();
    $this->db->where_in('resep_no_resep', $no_resep);
    $this->db->delete('detail_resep_diberikan');
    $this->db->reset_query();
    // die();
    $resep = array(
      'tanggal'     => $tanggal,
      'kode_dokter' => $kode_dokter,
    );
    if ($this->db->where('no_resep', $no_resep)->update('resep', $resep)) {
      $id_obat      = $this->input->post('kode');
      $harga     = $this->input->post('harga');
      $jumlah       = $this->input->post('jumlah');
      $signa       = $this->input->post('signa');
      $total_harga       = $this->input->post('ttl_harga');
      $count = count($id_obat);
      for ($i = 0; $i < $count; $i++) {
        $harga_akhir += $total_harga[$i];
        $obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
        $data = array(
          'harga'          => $harga[$i],
          'jumlah'         => $jumlah[$i],
          'total_harga'    => $harga[$i] * $jumlah[$i],
          'resep_no_resep' => $no_resep,
          'obat_idobat'    => $id_obat[$i],
          'signa' => $signa[$i],
        );
        $insert = $this->db->insert('detail_resep', $data);
        $res_id = $this->db->insert_id();
        $this->db->reset_query();
        if ($insert == true) {
          $status = 1;
        } else {
          $status = 0;
        }

        //FIFO RESEP
        $loop = true;
        $jm_resep = $jumlah[$i];
        $jumlah_tersimpan = 0;
        if ($jumlah[$i] > 0) {
          do {
            if ($_SESSION['poli'] == 'IGD') {
              $list_batch = $this->db
                ->order_by("tanggal_expired", "ASC")
                ->get_where("list_batch", array("idobat" => $id_obat[$i], "stok >" => 0, "unit" => "UGD"))->row_array();
            } else {
              $list_batch = $this->db
                ->order_by("tanggal_expired", "ASC")
                ->get_where("list_batch", array("idobat" => $id_obat[$i], "stok >" => 0, "unit" => "APOTEK"))->row_array();
            }
            if (empty($list_batch)) {
              break;
            }
            $jumlah_tersedia = $list_batch['stok'];
            if ($jumlah[$i] < $jumlah_tersedia && $jumlah[$i] > 0) {
              $loop = false;
              $beri = $jumlah[$i];
              $jumlah[$i] = 0;
            } else {
              $sisa = $jumlah[$i] - $jumlah_tersedia;
              $beri =  $jumlah_tersedia;
              $jumlah[$i] = $sisa;
            }
            $resep_diberikan = array(
              'id_detail_resep' => $res_id,
              'jumlah_resep' => $jm_resep,
              'jumlah_beri' => $beri,
              'resep_no_resep' => $no_resep,
              'obat_idobat' => $id_obat[$i],
              'signa' => $signa[$i],
              'no_batch' => $list_batch['no_batch'],
              'id_pengadaan' => $list_batch['iddetail_pembelian_obat'],
              'tanggal' => date("Y-m-d"),
              'unit' => $list_batch['unit']
            );
            $this->db->insert("detail_resep_diberikan", $resep_diberikan);
            $this->db->reset_query();
            $jumlah_tersimpan += $beri;
          } while ($jumlah[$i] > 0);
        }
        $this->db->where("iddetail_resep", $res_id)->update("detail_resep", array("jumlah" => $jumlah_tersimpan, "total_harga" => $harga[$i] * $jumlah_tersimpan));
      }

      if ($status == 1) {
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Edit Resep'));
        redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
      }
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect(base_url() . "Periksa/index/" . $data_periksa['kunjungan_no_urutkunjungan']);
    }
  }

  public function get_bhp()
  {
    $japel = $this->input->post("kode");
    $bhp = $this->ModelJasaBHP->get_edit($japel);
    // $jml = count($bhp);
    $html = '';
    if (!empty($bhp)) {
      foreach ($bhp as $value) {
        $data_batch = $this->ModelPeriksa->get_bhp_batch($value->idobat);
        $option = '';
        foreach ($data_batch as $data) {
          $option .= "<option value='" . $data->iddetail_pembelian_obat . "'>" . $data->no_batch . "</option>";
        }
        $select = '<select name="id_pengadaan[]" id="select" class="select' . $japel . ' mdb-select colorful-select dropdown-info sm-form">' . $option . '</select>';
        $html .= '<tr class="bhp' . $japel . '">
          <td>' . $value->idobat . '/' . $value->nama_obat . '</td>
          <td><input class="form-control" type="number" value="' . $value->jumlah . '"></td>
          <td>' . $select . '</td>
          <td><button type="button" onclick="deleteBhp(this)" class="btn-danger btn btn-circle" data-toggle="tooltip" data-placement="top" data-original-title="Hapus Jasa"><i class="fa fa-trash"></i></button></td>
        </tr>';
      }
    }
    echo $html;
  }

  public function rujuk_eksternal()
  {
    $kodeppk = $this->input->post("kodeppk");
    $jenis = $this->input->post("jenis");
    $sub = $this->input->post("sub");
    $jadwal = $this->input->post("jadwal");
    $nmppk = $this->input->post("nmppk");
    $kode_rujuk = $this->input->post("kode_rujuk");
    $id = $this->input->post("nomor_kunjungan");
    $tacc = $this->input->post("tacc");
    $alasan = $this->input->post("alasan_tacc");
    $tgl = $this->input->post("est_rujuk");
    // $tacc = "1";
    // $alasan = ">= 3 - 7 Hari";
    if ($jenis == "sub_spesialis") {
      $data_rujuk = array(
        'tglEstRujuk' => date("d-m-Y", strtotime($tgl)),
        'kdppk' => $kodeppk,
        'subSpesialis' => array(
          'kdSubSpesialis1' => $kode_rujuk,
          'kdSarana' => $this->input->post('sarana_input')
        ),
        'khusus' => null
      );
    } else {
      $data_rujuk = array(
        'tglEstRujuk' => date("d-m-Y", strtotime($tgl)),
        'kdppk' => $kodeppk,
        'subSpesialis' => null,
        'khusus' => array(
          "kdKhusus" => $kode_rujuk,
          "kdSubSpesialis" => $sub,
          "catatan" => $this->input->post("catatan")
        )
      );
    }

    $data = $this->db
      ->join("tujuan_pelayanan", "tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
      ->join("pasien", "pasien.noRM=kunjungan.pasien_noRM")
      ->where("no_urutkunjungan", $id)->get("kunjungan")
      ->row_array();
    // die(var_dump($data));
    $kesadaran = array(
      'KOMPOMENTIS' => "01",
      'SAMNOLENSE' => "02",
      'STUPOR' => "03",
      'KOMA' => "04"

    );
    $periksa = $this->db->get_where("periksa", array("kunjungan_no_urutkunjungan" => $id))->row_array();
    $dokter = $this->db->get_where("pegawai", array("NIK" => $periksa["operator"]))->row_array();
    $diagnosa = $this->db->get_where("diagnosa", array("periksa_idperiksa" => $periksa["idperiksa"]))->result();
    $icd = [null, null, null];
    $no = 0;
    foreach ($diagnosa as $value) {
      $icd[$no] = $value->kodesakit;
      $no++;
    }
    $data['noBPJS'] = strlen($data['noBPJS']) > 13 ? trim($data['noBPJS']) : str_pad($data['noBPJS'], 13, "0", STR_PAD_LEFT);
    if (strlen($data['noBPJS']) > 13) {
      $this->db->where("noRM", $data['noRM'])->update("pasien", array('noBPJS' => $data['noBPJS']));
    }
    if (strlen($data['noBPJS']) < 13) {
      $this->db->where("noRM", $data['noRM'])->update("pasien", array('noBPJS' => $data['noBPJS']));
    }
    // $data_pcare = array(
    // "noKunjungan" => null,
    // "noKartu"     => $data['noBPJS'],
    // "tglDaftar"   => date("d-m-Y",strtotime($data['tgl'])),
    // "kdPoli"      => $data['kdpcare'],
    // "keluhan"     => $data['keluhan'],
    // "kdSadar"     => $periksa['osadar']==NULL?"01":$kesadaran[$periksa['osadar']],
    // "sistole"     => $periksa["osiastole"],
    // "diastole"    => $periksa["odiastole"],
    // "beratBadan"  => $data["bb"],
    // "tinggiBadan" => $data["tb"],
    // "respRate"    => $periksa["orr"],
    // "heartRate"   => $periksa["onadi"],
    // "lingkarPerut"   => $periksa["olingkar_perut"],
    // "terapi"      => $periksa["oterapi"],
    // "kdStatusPulang" => 4,
    // "tglPulang"   => date("d-m-Y",strtotime($data['tgl'])),
    // "kdDokter"    => $dokter['kode_bpjs'],
    // "kdDiag1"     => $icd[0],
    // "kdDiag2"     => $icd[1],
    // "kdDiag3"     => $icd[2],
    // "kdPoliRujukInternal" => null,
    // "rujukLanjut" => $data_rujuk,
    // // "rujukLanjut" => null,
    // "kdTacc"      => $tacc,
    // "alasanTacc"  => $alasan
    // );
    $data_pcare = array(
      "noKunjungan"    => null,
      "noKartu"        => $data['noBPJS'],
      "keluhan"        => $data['keluhan'] == NULL ? $periksa['keluhan'] : $data['keluhan'],
      "kdSadar"        => $periksa['osadar'] == NULL ? "01" : $kesadaran[$periksa['osadar']],
      "sistole"        => intval($periksa["osiastole"]),
      "diastole"       => intval($periksa["odiastole"]),
      "beratBadan"     => intval($data["bb"]),
      "tinggiBadan"    => intval($data["tb"]),
      "respRate"       => intval($periksa["orr"]),
      "heartRate"      => intval($periksa["onadi"]),
      "lingkarPerut"   => intval($periksa["olingkar_perut"]),
      "terapi"         => $periksa["oterapi"],
      "kdStatusPulang" => "4",
      "tglPulang"      => date("d-m-Y", strtotime($data['tgl'])),
      "kdDokter"       => $dokter['kode_bpjs'],
      "kdDiag1"        => $icd[0],
      "kdDiag2"        => $icd[1],
      "kdDiag3"        => $icd[2],
      "kdPoliRujukInternal" => null,
      "rujukLanjut"    => $data_rujuk,
      // "rujukLanjut" => null,
      "kdTacc"         => intval($tacc),
      "alasanTacc"     => $alasan
    );
    // die(var_dump($data_pcare));
    if ($data['jenis_pasien_kode_jenis'] == 7) {

      if ($data['status_bridging_pemeriksaan'] == 0) {
        // code...

        // code...
        $bridge = PcareV4("kunjungan", "POST", json_encode($data_pcare));
        // $dataAR = array(
        //   'data'    => $data_pcare,
        //   'bridge'  => $bridge,
        // );
        // echo json_encode($dataAR); die();
        // die(var_dump($bridge));
        if ($bridge->metaData->code == 200) {
          $this->db->where("no_urutkunjungan", $id)->update("kunjungan", array('tgl_rujuk' => $tgl, 'rs_rujuk' => $nmppk, 'jadwal_rs' => $jadwal, 'rujuk_lanjut' => 1, "nokun_bridging" => $bridge->reseponse->message, 'status_bridging_pemeriksaan' => 1));
          $this->session->set_flashdata('notif', $this->Notif->berhasil("(success bridging dan membuat rujukan)!!!"));
        } else {
          if ($bridge->metaData->code == 412) {
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response[0]->field . " " . $bridge->response[0]->message . ' ' . $bridge->metaData->message));
          } elseif ($bridge->metaData->code == 304) {
            $this->db->where("no_urutkunjungan", $id)->update("kunjungan", array('status_bridging_pemeriksaan' => 1));
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response . ', ' . $bridge->metaData->message));
          } else {
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->metaData->message));
          }
        }
      } else {
        $data_pcare['noKunjungan'] = $data['nokun_bridging'];
        $bridge = PcareV4("kunjungan", "PUT", "text/plain", json_encode($data_pcare));
        // $bridge = PcareV4("kunjungan","PUT",json_encode($data_pcare));
        // $bridge = json_decode($bridge);
        // $dataAR = array(
        //   'data'    => $data_pcare,
        //   'bridge'  => $bridge,
        // );
        // echo json_encode($dataAR); die();
        if ($bridge->metaData->code == 200) {
          $this->db->where("no_urutkunjungan", $id)->update("kunjungan", array('tgl_rujuk' => $tgl, 'rs_rujuk' => $nmppk, 'jadwal_rs' => $jadwal, 'rujuk_lanjut' => 1));
          $this->session->set_flashdata('notif', $this->Notif->berhasil("(success membuat rujukan)!!!"));
        } else {
          if ($bridge->metaData->code == 412) {
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response[0]->field . " " . $bridge->response[0]->message . ' ' . $bridge->metaData->message));
          } elseif ($bridge->metaData->code == 304) {
            $this->db->where("no_urutkunjungan", $id)->update("kunjungan", array('status_bridging_pemeriksaan' => 1));
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response . ', ' . $bridge->metaData->message));
          } else {
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->metaData->message));
          }
        }
      }
      // die(var_dump($bridge));
    } else {
      $this->session->set_flashdata('notif', $this->Notif->berhasil("Bukan pasien bpjs!!!"));
    }
    // redirect(base_url()."Periksa/index/".$id);
    redirect(base_url() . "Periksa/tes/" . $id);
    // die(var_dump($data_pcare));
    // echo "<pre>";
    // print_r($bridge);
    // echo "</pre>";
    // // die();
  }

  function CetakRujukan()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    // $d = json_decode(PCare('kunjungan/rujukan/'.$kunjungan['nokun_bridging']));
    $d = PcareV4('kunjungan/rujukan/' . $kunjungan['nokun_bridging']);
    // $d = json_decode(PCare('kunjungan/peserta/0000114484634'));
    // echo "<pre>";
    // print_r($d);
    // echo "</pre>";
    // die();
    // die(var_dump($d));
    $this->load->view('Periksa/cetak_rujukan', array(
      'data' => @$d->response,
      'kunjungan' => $kunjungan,
    ));
  }


  public function get_riwayat()
  {
    $idperiksa = $this->input->post("idperiksa");
    // $idperiksa = "219995";

    $periksa = $this->db
      ->join("kunjungan", "kunjungan_no_urutkunjungan=no_urutkunjungan")
      ->get_where("periksa", array("idperiksa" => $idperiksa))->row_array();
    $html_gigi = "";
    $html_gigi2 = "";
    $html_gigi3 = "";
    $html_gigi4 = "";
    if (!empty($periksa)) {
      if ($periksa["tupel_kode_tupel"] == "GIG") {
        for ($i = 18; $i >= 14; $i--) {
          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
              <span><center>' . $i . '</center><img src="' . base_url("desain/assets/images/gambar_gigi.PNG") . '"></span></span>';
          } else {
            $html_gigi .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                <span><center>' . $i . '</center><img src="' . base_url("desain/assets/images/gambar_gigi.PNG") . '"></span></span>';
          }
        }
        for ($i = 13; $i >= 11; $i--) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                  <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          } else {
            $html_gigi .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                    <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          }
        }

        $html_gigi .= '<span>|</span>';

        for ($i = 21; $i <= 23; $i++) {
          // die();
          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi .=  '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                      <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          } else {
            $html_gigi .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                        <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          }
        }
        for ($i = 24; $i <= 28; $i++) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                          <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          } else {
            $html_gigi .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                            <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          }
        }



        for ($i = 55; $i >= 54; $i--) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi2 .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                              <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          } else {
            $html_gigi2 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          }
        }
        for ($i = 53; $i >= 51; $i--) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi2 .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                  <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          } else {
            $html_gigi2 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                    <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          }
        }

        $html_gigi2 .= '<span>|</span>';

        for ($i = 61; $i <= 63; $i++) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi2 .=  '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                      <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          } else {
            $html_gigi2 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                        <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          }
        }
        for ($i = 64; $i <= 65; $i++) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi2 .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                          <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          } else {
            $html_gigi2 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                            <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          }
        }


        for ($i = 85; $i >= 84; $i--) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi3 .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                              <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          } else {
            $html_gigi3 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                                <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          }
        }
        for ($i = 83; $i >= 81; $i--) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi3 .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                                  <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          } else {
            $html_gigi3 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                                    <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          }
        }

        $html_gigi3 .= '<span>|</span>';

        for ($i = 71; $i <= 73; $i++) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi3 .=  '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                                      <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          } else {
            $html_gigi3 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                                        <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          }
        }
        for ($i = 74; $i <= 75; $i++) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi3 .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                                          <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          } else {
            $html_gigi3 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                                            <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          }
        }


        for ($i = 48; $i >= 44; $i--) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi4 .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                                              <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          } else {
            $html_gigi4 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                                                <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          }
        }
        for ($i = 43; $i >= 41; $i--) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi4 .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                                                  <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          } else {
            $html_gigi4 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                                                    <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          }
        }

        $html_gigi4 .= '<span>|</span>';

        for ($i = 31; $i <= 33; $i++) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi4 .=  '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                                                      <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          } else {
            $html_gigi4 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                                                        <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi.PNG"></span></span>';
          }
        }
        for ($i = 34; $i <= 38; $i++) {

          if (@$periksa['gigi_' . $i] != null) {
            $html_gigi4 .= '<span style="background-color:#01c0c8" tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="' . $periksa['gigi_' . $i] . '">
                                                                          <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          } else {
            $html_gigi4 .= '<span tittle="Gigi ' . $i . '" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
                                                                            <span><center>' . $i . '</center><img src="' . base_url() . 'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
          }
        }
      }
    }

    $diagnosa = $this->db
      ->join("penyakit", "diagnosa.kodesakit=penyakit.kodeicdx")
      ->where("periksa_idperiksa", $idperiksa)
      ->get("diagnosa")->result();

    $resep = $this->db
      ->join("detail_resep", "resep.no_resep=detail_resep.resep_no_resep")
      ->join("obat", "detail_resep.obat_idobat=obat.idobat")
      ->where("periksa_idperiksa", $idperiksa)
      ->get("resep")->result();

    $html_diagnosa = '';
    $html_resep = '';
    $no = 1;
    foreach ($diagnosa as $value) {
      $html_diagnosa .= "
                                                                      <tr>
                                                                        <td>" . $no++ . "</td>
                                                                        <td>" . $value->kodeicdx . "</td>
                                                                        <td>" . $value->nama_penyakit . " (" . $value->indonesia . ")" . "</td>
                                                                      </tr>
                                                                      ";
    }
    $no = 1;
    foreach ($resep as $value) {
      $html_resep .= "
                                                                      <tr>
                                                                        <td>" . $no++ . "</td>
                                                                        <td>" . $value->no_resep . "</td>
                                                                        <td>" . $value->obat_idobat . "</td>
                                                                        <td>" . $value->nama_obat . "</td>
                                                                        <td>" . $value->jumlah . "</td>
                                                                        <td>" . $value->satuan_kecil . "</td>
                                                                        <td>" . $value->signa . "</td>
                                                                      </tr>
                                                                      ";
    }
    // echo $html_gigi;
    // die();
    echo json_encode(array(
      "resep" => $html_resep,
      "diagnosa" => $html_diagnosa,
      "html_gigi" => $html_gigi,
      "html_gigi2" => $html_gigi2,
      "html_gigi3" => $html_gigi3,
      "html_gigi4" => $html_gigi4,
      'poli' => $periksa['tupel_kode_tupel']
    ));
    // echo json_encode($idperiksa);
  }

  public function get_riwayat2()
  {
    $idperiksa = $this->input->post("idperiksa");
    // $idperiksa = "219995";

    // $periksa = $this->db
    // ->join("kunjungan","kunjungan_no_urutkunjungan=no_urutkunjungan")
    // ->get_where("periksa",array("idperiksa"=>$idperiksa))->row_array();
    // $html_gigi = "";$html_gigi2 = "";$html_gigi3 = "";$html_gigi4 = "";
    // if (!empty($periksa)) {
    //   if ($periksa["tupel_kode_tupel"]=="GIG") {
    //     for($i=18;$i>=14;$i--){
    //       if (@$periksa['gigi_'.$i]!=null) {
    //         $html_gigi.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //           <span><center>'.$i.'</center><img src="'.base_url("desain/assets/images/gambar_gigi.PNG").'"></span></span>';
    //         }else{
    //           $html_gigi.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //             <span><center>'.$i.'</center><img src="'.base_url("desain/assets/images/gambar_gigi.PNG").'"></span></span>';
    //           }
    //         }
    //         for($i=13;$i>=11;$i--){
    //
    //           if (@$periksa['gigi_'.$i]!=null) {
    //             $html_gigi.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //               <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //             }else{
    //               $html_gigi.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                 <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //               }
    //
    //
    //             }
    //
    //             $html_gigi.='<span>|</span>';
    //
    //             for($i=21;$i<=23;$i++){
    //               // die();
    //               if (@$periksa['gigi_'.$i]!=null) {
    //                 $html_gigi.=  '<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                   <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                 }else{
    //                   $html_gigi.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                     <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                   }
    //
    //
    //                 }
    //                 for($i=24;$i<=28;$i++){
    //
    //                   if (@$periksa['gigi_'.$i]!=null) {
    //                     $html_gigi.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                       <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                     }else{
    //                       $html_gigi.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                         <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                       }
    //
    //
    //                     }
    //
    //
    //
    //                     for($i=55;$i>=54;$i--){
    //
    //                       if (@$periksa['gigi_'.$i]!=null) {
    //                         $html_gigi2.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                           <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                         }else{
    //                           $html_gigi2.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                             <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                           }
    //
    //
    //                         }
    //                         for($i=53;$i>=51;$i--){
    //
    //                           if (@$periksa['gigi_'.$i]!=null) {
    //                             $html_gigi2.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                               <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                             }else{
    //                               $html_gigi2.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                 <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                               }
    //
    //
    //                             }
    //
    //                             $html_gigi2.='<span>|</span>';
    //
    //                             for($i=61;$i<=63;$i++){
    //
    //                               if (@$periksa['gigi_'.$i]!=null) {
    //                                 $html_gigi2.=  '<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                                   <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                                 }else{
    //                                   $html_gigi2.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                     <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                                   }
    //
    //
    //                                 }
    //                                 for($i=64;$i<=65;$i++){
    //
    //                                   if (@$periksa['gigi_'.$i]!=null) {
    //                                     $html_gigi2.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                                       <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                                     }else{
    //                                       $html_gigi2.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                         <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                                       }
    //
    //
    //                                     }
    //
    //
    //                                     for($i=85;$i>=84;$i--){
    //
    //                                       if (@$periksa['gigi_'.$i]!=null) {
    //                                         $html_gigi3.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                                           <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                                         }else{
    //                                           $html_gigi3.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                             <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                                           }
    //
    //
    //                                         }
    //                                         for($i=83;$i>=81;$i--){
    //
    //                                           if (@$periksa['gigi_'.$i]!=null) {
    //                                             $html_gigi3.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                                               <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                                             }else{
    //                                               $html_gigi3.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                                 <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                                               }
    //
    //
    //                                             }
    //
    //                                             $html_gigi3.='<span>|</span>';
    //
    //                                             for($i=71;$i<=73;$i++){
    //
    //                                               if (@$periksa['gigi_'.$i]!=null) {
    //                                                 $html_gigi3.=  '<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                                                   <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                                                 }else{
    //                                                   $html_gigi3.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                                     <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                                                   }
    //
    //
    //                                                 }
    //                                                 for($i=74;$i<=75;$i++){
    //
    //                                                   if (@$periksa['gigi_'.$i]!=null) {
    //                                                     $html_gigi3.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                                                       <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                                                     }else{
    //                                                       $html_gigi3.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                                         <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                                                       }
    //
    //
    //                                                     }
    //
    //
    //                                                     for($i=48;$i>=44;$i--){
    //
    //                                                       if (@$periksa['gigi_'.$i]!=null) {
    //                                                         $html_gigi4.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                                                           <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                                                         }else{
    //                                                           $html_gigi4.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                                             <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                                                           }
    //
    //
    //                                                         }
    //                                                         for($i=43;$i>=41;$i--){
    //
    //                                                           if (@$periksa['gigi_'.$i]!=null) {
    //                                                             $html_gigi4.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                                                               <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                                                             }else{
    //                                                               $html_gigi4.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                                                 <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                                                               }
    //
    //
    //                                                             }
    //
    //                                                             $html_gigi4.='<span>|</span>';
    //
    //                                                             for($i=31;$i<=33;$i++){
    //
    //                                                               if (@$periksa['gigi_'.$i]!=null) {
    //                                                                 $html_gigi4.=  '<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                                                                   <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                                                                 }else{
    //                                                                   $html_gigi4.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                                                     <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi.PNG"></span></span>';
    //                                                                   }
    //
    //
    //                                                                 }
    //                                                                 for($i=34;$i<=38;$i++){
    //
    //                                                                   if (@$periksa['gigi_'.$i]!=null) {
    //                                                                     $html_gigi4.='<span style="background-color:#01c0c8" tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="'.$periksa['gigi_'.$i].'">
    //                                                                       <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                                                                     }else{
    //                                                                       $html_gigi4.='<span tittle="Gigi '.$i.'" href="#" id="gigi_18" class="gigi" data-toggle="tooltip" data-placement="top" data-original-title="">
    //                                                                         <span><center>'.$i.'</center><img src="'.base_url().'desain/assets/images/gambar_gigi_2.PNG"></span></span>';
    //                                                                       }
    //
    //
    //                                                                     }
    //
    //
    //
    //
    //
    //
    //
    //
    //                                                                   }
    //
    //
    //
    //                                                                 }
    //
    //                                                                 $diagnosa = $this->db
    //                                                                 ->join("penyakit","diagnosa.kodesakit=penyakit.kodeicdx")
    //                                                                 ->where("periksa_idperiksa",$idperiksa)
    //                                                                 ->get("diagnosa")->result();
    //
    //                                                                 $resep = $this->db
    //                                                                 ->join("detail_resep","resep.no_resep=detail_resep.resep_no_resep")
    //                                                                 ->join("obat","detail_resep.obat_idobat=obat.idobat")
    //                                                                 ->where("periksa_idperiksa",$idperiksa)
    //                                                                 ->get("resep")->result();
    //
    //                                                                 $html_diagnosa = '';
    //                                                                 $html_resep = '';
    //                                                                 $no = 1;
    //                                                                 foreach ($diagnosa as $value) {
    //                                                                   $html_diagnosa .= "
    //                                                                   <tr>
    //                                                                     <td>".$no++."</td>
    //                                                                     <td>".$value->kodeicdx."</td>
    //                                                                     <td>".$value->nama_penyakit." (".$value->indonesia.")"."</td>
    //                                                                   </tr>
    //                                                                   ";
    //                                                                 }
    //                                                                 $no = 1;
    //                                                                 foreach ($resep as $value) {
    //                                                                   $html_resep .= "
    //                                                                   <tr>
    //                                                                     <td>".$no++."</td>
    //                                                                     <td>".$value->no_resep."</td>
    //                                                                     <td>".$value->obat_idobat."</td>
    //                                                                     <td>".$value->nama_obat."</td>
    //                                                                     <td>".$value->jumlah."</td>
    //                                                                     <td>".$value->satuan_kecil."</td>
    //                                                                     <td>".$value->signa."</td>
    //                                                                   </tr>
    //                                                                   ";
    //                                                                 }
    //                                                                 // echo $html_gigi;
    //                                                                 // die();
    //                                                                 echo json_encode(array("resep" => $html_resep,
    //                                                                 "diagnosa"=>$html_diagnosa,
    //                                                                 "html_gigi"=>$html_gigi,
    //                                                                 "html_gigi2"=>$html_gigi2,
    //                                                                 "html_gigi3"=>$html_gigi3,
    //                                                                 "html_gigi4"=>$html_gigi4,
    //                                                                 'poli' => $periksa['tupel_kode_tupel']
    //                                                                 ));
    echo json_encode($idperiksa);
  }
  public function bridging_ugd()
  {
    $id = $this->uri->segment(3);
    $data = $this->db
      ->join("pasien", "pasien.noRM=view_pasien.pasien_noRM")
      ->where("no_urutkunjungan", $id)
      ->where("tupel_kode_tupel", "IGD")
      ->get("view_pasien")
      ->row_array();

    $dokter = $this->db->get_where("pegawai", array("NIK" => $data["NIK"]))->row_array();
    $periksa = $this->db->get_where("periksa", array("kunjungan_no_urutkunjungan" => $id))->row_array();
    $diagnosa = $this->db->get_where("diagnosa", array("periksa_idperiksa" => $periksa["idperiksa"]))->row_array();
    $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($data['tupel_kode_tupel'])->row_array();
    $data['noBPJS'] = strlen($data['noBPJS']) > 13 ? trim($data['noBPJS']) : str_pad($data['noBPJS'], 13, "0", STR_PAD_LEFT);
    if (strlen($data['noBPJS']) > 13) {
      $this->db->where("noRM", $data['noRM'])->update("pasien", array('noBPJS' => $data['noBPJS']));
    }
    if (strlen($data['noBPJS']) < 13) {
      $this->db->where("noRM", $data['noRM'])->update("pasien", array('noBPJS' => $data['noBPJS']));
    }
    $no = $data['noBPJS'];
    // $no = "0001541606308";
    $url = "peserta/" . $no;
    $response = json_decode(Pcare($url));
    $provider = $this->Core->get_pcare();
    // die(var_dump($response));
    if ($response->metaData->code == 200) {
      $pro = $response->response->kdProviderPst->kdProvider;
    } else {
      $pro = $provider['kdppk'];
    }
    $data_pcare = array(
      "kdProviderPeserta" => $pro,
      "tglDaftar"         => date("d-m-Y", strtotime($data['tgl'])),
      "noKartu"           => $data['noBPJS'],
      "kdPoli"            => $tujuan_pelayanan['kdpcare'],
      "keluhan"           => $data['keluhan'],
      "kunjSakit"         => $data['kunjungansakit'] == 1 ? true : false,
      "sistole"           => 0,
      "diastole"          => 0,
      "beratBadan"        => $data['bb'],
      "tinggiBadan"       => $data['tb'],
      "respRate"          => 0,
      "heartRate"         => 0,
      "rujukBalik"        => 0,
      "kdTkp"             => 10
    );

    $bridge = PCare("pendaftaran", "POST", json_encode($data_pcare));

    $bridge = json_decode($bridge);

    if ($bridge->metaData->code == 201) {
      if ($data['rujuk_poli'] == 1) {
        $this->db->where("kunjungan_no_urutkunjungan", $id);
        $this->db->update("rujukan_internal", array("nourut_pcare" => $bridge->response->message, "status_bridging" => 1));
      } else {
        $this->db->where("no_urutkunjungan", $id);
        $this->db->update("kunjungan", array("nourut_pcare" => $bridge->response->message, "status_bridging" => 1));
      }

      redirect("Periksa/bridging_pemeriksaan_ugd/" . $id);
    } else {
      if ($bridge->metaData->code == 428) {
        $this->db->where("kunjungan_no_urutkunjungan", $id);
        $this->db->update("rujukan_internal", array("status_bridging" => 1));
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response));
      } else if ($bridge->metaData->code == 412) {
        // code...
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response[0]->field . " " . $bridge->response[0]->message . ' ' . $bridge->metaData->message));
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->metaData->message));
      }
      redirect("Periksa/index/" . $id);
    }
  }

  public function bridging_pemeriksaan_ugd()
  {
    $id = $this->uri->segment(3);
    $data = $this->db
      ->join("pasien", "pasien.noRM=kunjungan.pasien_noRM")
      ->where("no_urutkunjungan", $id)->get("kunjungan")
      ->row_array();

    $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit("IGD")->row_array();
    $kesadaran = array(
      'KOMPOMENTIS' => "01",
      'SAMNOLENSE' => "02",
      'STUPOR' => "03",
      'KOMA' => "04"

    );
    $periksa = $this->db
      ->order_by("idperiksa", "DESC")
      ->get_where("periksa", array("kunjungan_no_urutkunjungan" => $id, "unit_layanan" => "IGD"))->row_array();
    $dokter = $this->db->get_where("pegawai", array("NIK" => $periksa["operator"]))->row_array();
    $diagnosa = $this->db
      ->join("periksa", "periksa_idperiksa=idperiksa")
      ->join("kunjungan", "kunjungan_no_urutkunjungan=no_urutkunjungan")
      ->group_by("kodesakit")
      ->get_where("diagnosa", array("no_urutkunjungan" => $id))->result();
    $icd = [null, null, null];
    $no = 0;
    foreach ($diagnosa as $value) {
      $icd[$no] = $value->kodesakit;
      $no++;
    }
    $data_pcare = array(
      "noKunjungan" => null,
      "noKartu"     => $data['noBPJS'],
      "tglDaftar"   => date("d-m-Y", strtotime($data['tgl'])),
      "kdPoli"      => $tujuan_pelayanan['kdpcare'],
      "keluhan"     => $data['keluhan'],
      "kdSadar"     => $periksa['osadar'] == NULL ? "01" : $kesadaran[$periksa['osadar']],
      "sistole"     => $periksa["osiastole"],
      "diastole"    => $periksa["odiastole"],
      "beratBadan"  => $data["bb"],
      "tinggiBadan" => $data["tb"],
      "respRate"    => $periksa["orr"],
      "heartRate"   => $periksa["onadi"],
      "terapi"      => $periksa["oterapi"],
      "kdStatusPulang" => 3,
      "tglPulang"   => date("d-m-Y", strtotime($data['tgl'])),
      "kdDokter"    => $dokter['kode_bpjs'],
      "kdDiag1"     => $icd[0],
      "kdDiag2"     => $icd[1],
      "kdDiag3"     => $icd[2],
      "kdPoliRujukInternal" => null,
      "rujukLanjut" => null,
      "kdTacc"      => 0,
      "alasanTacc"  => null
    );
    $bridge = PCare("kunjungan", "POST", json_encode($data_pcare));
    $bridge = json_decode($bridge);
    if ($bridge->metaData->code == 201) {
      if ($data['rujuk_poli'] == 1) {
        $this->db->where("kunjungan_no_urutkunjungan", $id)
          ->update("rujukan_internal", array("nokun_bridging" => $bridge->reseponse->message, 'status_bridging_pemeriksaan' => 1));
      } else {
        $this->db->where("no_urutkunjungan", $id)
          ->update("kunjungan", array("nokun_bridging" => $bridge->reseponse->message, 'status_bridging_pemeriksaan' => 1));
      }
      $this->session->set_flashdata('notif', $this->Notif->berhasil("(success bridging)!!!"));
    } else {
      if ($bridge->metaData->code == 412) {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response[0]->field . " " . $bridge->response[0]->message . ' ' . $bridge->metaData->message));
      } elseif ($bridge->metaData->code == 304) {
        if ($data['rujukan_internal'] == 1) {
          $this->db->where("kunjungan_no_urutkunjungan", $id)
            ->update("rujukan_internal", array("nokun_bridging" => $bridge->reseponse->message, 'status_bridging_pemeriksaan' => 1));
        } else {
          $this->db->where("no_urutkunjungan", $id)
            ->update("kunjungan", array("nokun_bridging" => $bridge->reseponse->message, 'status_bridging_pemeriksaan' => 1));
        }
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response . ', ' . $bridge->metaData->message));
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->metaData->message));
      }
    }

    redirect("Periksa/index/" . $id);
  }
  public function ambil_nokun_terbaru()
  {
    $id = $this->uri->segment(3);
    $noKartu = $this->uri->segment(4);
    $bridge = PcareV4("kunjungan/peserta/" . $noKartu);
    if ($bridge->metaData->code == 200) {
      $data = $bridge->response->list[0];
      $this->db
        ->where("no_urutkunjungan", $id)
        ->update("kunjungan", array('nokun_bridging' => $data->noKunjungan));
      redirect(base_url("Periksa/index/" . $id));
    } else {
      redirect(base_url("Periksa/index/" . $id));
    }
  }
  public function bridge_ulang()
  {
    $id = $this->uri->segment(3);
    // $bridge = BridgingPemeriksaanRajal($id);

    $bridge = BridgingPemeriksaanRajal($id);
    echo json_encode($bridge);
    // if ($bridge->metaData->code==201) {
    //   $this->db->where("no_urutkunjungan",$id)->update("kunjungan",array("nokun_bridging"=>$bridge->reseponse->message,'status_bridging_pemeriksaan'=>1));
    //   $this->session->set_flashdata('notif',$this->Notif->berhasil("(success bridging)!!!"));
    // }else{
    //   if ($bridge->metaData->code==412) {
    //     $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->response[0]->field." ".$bridge->response[0]->message.' '.$bridge->metaData->message));
    //   }elseif ($bridge->metaData->code==304) {
    //     $this->db->where("no_urutkunjungan",$id)->update("kunjungan",array('status_bridging_pemeriksaan'=>1));
    //     $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->response.', '.$bridge->metaData->message));
    //
    //   }else{
    //     $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->metaData->message));
    //
    //   }
    // }
    // redirect("Periksa/index/".$id);
  }

  public function bridge_ulang2()
  {
    $id = $this->uri->segment(3);
    // $bridge = BridgingPemeriksaanRajal($id);
    $data_kunjungan = $this->db
      ->join("pasien", "pasien_noRM=noRM")
      ->get_where("kunjungan", array("no_urutkunjungan" => $id))->row_array();
    $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($data_kunjungan['tupel_kode_tupel'])->row_array();
    $data_periksa = $this->db->get_where("periksa", array("kunjungan_no_urutkunjungan" => $id))->row_array();
    $dokter = $this->db->get_where("pegawai", array("NIK" => $data_periksa["operator"]))->row_array();
    $diagnosa = $this->db
      ->join("periksa", "periksa_idperiksa=idperiksa")
      ->join("kunjungan", "kunjungan_no_urutkunjungan=no_urutkunjungan")
      ->group_by("kodesakit")
      ->get_where("diagnosa", array("no_urutkunjungan" => $id))->result();
    $icd = [null, null, null];
    $no = 0;
    foreach ($diagnosa as $value) {
      $icd[$no] = $value->kodesakit;
      $no++;
    }
    $data_kunjungan['noBPJS'] = strlen($data_kunjungan['noBPJS']) > 13 ? trim($data_kunjungan['noBPJS']) : str_pad($data_kunjungan['noBPJS'], 13, "0", STR_PAD_LEFT);
    if (strlen($data_kunjungan['noBPJS']) > 13) {
      $this->db->where("noRM", $data_kunjungan['noRM'])->update("pasien", array('noBPJS' => $data_kunjungan['noBPJS']));
    }
    if (strlen($data_kunjungan['noBPJS']) < 13) {
      $this->db->where("noRM", $data_kunjungan['noRM'])->update("pasien", array('noBPJS' => $data_kunjungan['noBPJS']));
    }
    $kesadaran = array(
      'KOMPOMENTIS' => "01",
      'SAMNOLENSE' => "02",
      'STUPOR' => "03",
      'KOMA' => "04"

    );
    $pulang = "3";
    if ($data_kunjungan['rujuk_poli'] == 1) {
      $r = "005";
    } else {
      // $r = "003";
      $r = null;
    }
    $data_periksa['osadar'] = $data_periksa['osadar'] == NULL ? "KOMPOMENTIS" : $data_periksa['osadar'];
    $data_pcare = array(
      "noKunjungan" => $data_kunjungan['nourut_pcare'],
      "noKartu"     =>  $data_kunjungan['noBPJS'],
      "tglDaftar"   => date("d-m-Y", strtotime($data_kunjungan['tgl'])),
      "kdPoli"      => $tujuan_pelayanan['kdpcare'],
      "keluhan"     => $data_kunjungan['keluhan'] == NULL ? $data_periksa["keluhan"] : $data_kunjungan['keluhan'],
      "kdSadar"     => $kesadaran[$data_periksa['osadar']],
      "sistole"     => intval($data_periksa["osiastole"] == NULL ? 120 : $data_periksa["osiastole"]),
      "diastole"    => intval($data_periksa["odiastole"] == NULL ? 75 : $data_periksa["odiastole"]),
      "beratBadan"  => intval($data_periksa["obb"] == NULL ? $data_kunjungan['bb'] : $data_periksa["obb"]),
      "tinggiBadan" => intval($data_periksa["otb"] == NULL ? $data_kunjungan['tb'] : $data_periksa["otb"]),
      "respRate"    => intval($data_periksa["orr"] == NULL ? 18 : $data_periksa["orr"]),
      "heartRate"   => intval($data_periksa["onadi"] == NULL ? 80 : $data_periksa["onadi"]),
      "lingkarPerut" => intval($data_periksa["olingkar_perut"] == NULL || $data_periksa["olingkar_perut"] == 0 ? 80 : $data_kunjungan["lingkar_perut"]),
      "terapi"      => intval($data_periksa["oterapi"]),
      "kdStatusPulang" => $pulang,
      "tglPulang"   => date("d-m-Y"),
      "kdDokter"    => $dokter['kode_bpjs'],
      // "kdDokter"    => '256044  ',
      "kdDiag1"     => $icd[0],
      "kdDiag2"     => $icd[1],
      "kdDiag3"     => $icd[2],
      "kdPoliRujukInternal" => $r,
      "rujukLanjut" => null,
      "kdTacc"      => 0,
      "alasanTacc"  => null
    );
    $bridge = PcareV4("kunjungan", "POST", "text/plain", json_encode($data_pcare));
    echo json_encode(array('bridge' => $bridge, 'pcare' => $data_pcare));
    // $bridge = json_decode($bridge);
    if ($bridge->metaData->code == 201) {
      $nokun =  $bridge->response->message;
      $kode_tindakan = array();
      $tindakan = $this->db
        ->join("periksa", "periksa_idperiksa=idperiksa")
        ->join("kunjungan", "kunjungan_no_urutkunjungan=no_urutkunjungan")
        ->get_where("tindakan", array("no_urutkunjungan" => $id))->result();
      foreach ($tindakan as $value) {
        array_push($kode_tindakan, $value->kode_jasa);
      }
      for ($i = 0; $i < count($kode_tindakan); $i++) {
        $data = array(
          "kdTindakanSK" => 0,
          "noKunjungan" => $nokun,
          "kdTindakan" => $kode_tindakan[$i],
          "biaya" => 0,
          "keterangan" => null,
          "hasil" => 0
        );
        PcareV4("tindakan", "POST", "text/plain", json_encode($data));
      }
      if ($data_periksa["gl_sewaktu"] != 0 || $data_periksa["gl_puasa"] != 0 || $data_periksa["gl_post_prandial"] != 0 || $data_periksa["gl_hba"] != 0) {
        $data_lab = array(
          "kdMCU" => 0,
          "noKunjungan" => $nokun,
          "kdProvider" => "0189B016",
          "tglPelayanan" => date("d-m-Y"),
          "tekananDarahSistole" => $data_periksa["osiastole"] == NULL ? 120 : $data_periksa["osiastole"],
          "tekananDarahDiastole" => $data_periksa["odiastole"] == NULL ? 75 : $data_periksa["odiastole"],
          "radiologiFoto" => null,
          "darahRutinHemo" => 0,
          "darahRutinLeu" => 0,
          "darahRutinErit" => 0,
          "darahRutinLaju" => 0,
          "darahRutinHema" => 0,
          "darahRutinTrom" => 0,
          "lemakDarahHDL" => 0,
          "lemakDarahLDL" => 0,
          "lemakDarahChol" => 0,
          "lemakDarahTrigli" => 0,
          "gulaDarahSewaktu" => $data_periksa["gl_sewaktu"],
          "gulaDarahPuasa" => $data_periksa["gl_puasa"],
          "gulaDarahPostPrandial" => $data_periksa["gl_post_prandial"],
          "gulaDarahHbA1c" => $data_periksa["gl_hba"],
          "fungsiHatiSGOT" => 0,
          "fungsiHatiSGPT" => 0,
          "fungsiHatiGamma" => 0,
          "fungsiHatiProtKual" => 0,
          "fungsiHatiAlbumin" => 0,
          "fungsiGinjalCrea" => 0,
          "fungsiGinjalUreum" => 0,
          "fungsiGinjalAsam" => 0,
          "fungsiJantungABI" => 0,
          "fungsiJantungEKG" => null,
          "fungsiJantungEcho" => null,
          "funduskopi" => null,
          "pemeriksaanLain" => null,
          "keterangan" => null
        );
        PcareV4("MCU", "POST", "text/plain", json_encode($data_lab));
      }
      if ($bridge->metaData->code == 201) {
        $this->db->where("no_urutkunjungan", $id)->update("kunjungan", array("nokun_bridging" => @$bridge->response[0]->message, 'status_bridging_pemeriksaan' => 1));
        $this->session->set_flashdata('notif', $this->Notif->berhasil("(success bridging)!!!"));
      } else {
        if ($bridge->metaData->code == 412) {
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response->field . " " . $bridge->response->message . ' ' . $bridge->metaData->message));
        } elseif ($bridge->metaData->code == 304) {
          $this->db->where("no_urutkunjungan", $id)->update("kunjungan", array('status_bridging_pemeriksaan' => 1));
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . @$bridge->response . ', ' . @$bridge->metaData->message));
        } else {
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . @$bridge->metaData->message));
        }
      }
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging ' . $bridge->metaData->message));
    }
    redirect("Periksa/index/" . $id);
  }

  public function bridge_ulang_pendaftaran()
  {
    $id = $this->uri->segment(3);
    $bridge = BridgingPendaftaran($id);
    if ($bridge->metaData->code == 201) {
      $this->db->where("no_urutkunjungan", $id);
      $this->db->update("kunjungan", array("nourut_pcare" => $bridge->response->message, "status_bridging" => 1));
      $this->session->set_flashdata('notif', $this->Notif->berhasil("(success bridging)!!!"));
    } else {
      if ($bridge->metaData->code == 428) {
        $this->db->where("no_urutkunjungan", $id);
        $this->db->update("kunjungan", array("status_bridging" => 1));
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response));
      } else if ($bridge->metaData->code == 412) {
        // code...
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->response[0]->field . " " . $bridge->response[0]->message . ' ' . $bridge->metaData->message));
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . $bridge->metaData->message));
      }
    }
    redirect("Periksa/index/" . $id);
  }

  public function bridge_ulang_pendaftaran2()
  {
    $id = $this->uri->segment(3);

    $data = $this->db
      ->join("pasien", "pasien.noRM=kunjungan.pasien_noRM")
      ->where("no_urutkunjungan", $id)->get("kunjungan")
      ->row_array();
    $dokter = $this->db->get_where("pegawai", array("NIK" => $data["NIK"]))->row_array();
    $periksa = $this->db->get_where("periksa", array("kunjungan_no_urutkunjungan" => $id))->row_array();
    $diagnosa = $this->db->get_where("diagnosa", array("periksa_idperiksa" => $periksa["idperiksa"]))->row_array();
    $tujuan_pelayanan = $this->ModelTujuanPelayanan->get_data_edit($data['tupel_kode_tupel'])->row_array();
    $data['noBPJS'] = strlen($data['noBPJS']) > 13 ? trim($data['noBPJS']) : str_pad($data['noBPJS'], 13, "0", STR_PAD_LEFT);
    if (strlen($data['noBPJS']) > 13) {
      $this->db->where("noRM", $data['noRM'])->update("pasien", array('noBPJS' => $data['noBPJS']));
    }
    if (strlen($data['noBPJS']) < 13) {
      $this->db->where("noRM", $data['noRM'])->update("pasien", array('noBPJS' => $data['noBPJS']));
    }
    // $no = $data['noBPJS'];
    // // $no = "0001541606308";
    // $url = "peserta/".$no;
    // $response = json_decode(Pcare($url));
    $response = PcareV4("peserta/" . $data['noBPJS']);
    $provider = $this->Core->get_pcare();
    // die(var_dump($response));
    if ($response->metaData->code == 200) {
      $pro = $response->response->kdProviderPst->kdProvider;
    } else {
      $pro = $provider['kdppk'];
    }
    $data_pcare = array(
      "kdProviderPeserta" => $pro,
      "tglDaftar"         => date("d-m-Y", strtotime($data['tgl'])),
      "noKartu"           => $data['noBPJS'],
      "kdPoli"            => $tujuan_pelayanan['kdpcare'],
      "keluhan"           => $data['keluhan'],
      "kunjSakit"         => $data['kunjungansakit'] == 1 ? true : false,
      "sistole"           => intval($data['sistole']),
      "diastole"          => intval($data['diastole']),
      "beratBadan"        => intval($data['bb']),
      "tinggiBadan"       => intval($data['tb']),
      "lingkarPerut"      => intval($data['lingkar_perut']),
      "respRate"          => intval($data['rr']),
      "heartRate"         => intval($data['heartRate']),
      "rujukBalik"        => 0,
      "kdTkp"             => "10"
    );

    $bridge = PcareV4("pendaftaran", "POST", "text/plain", json_encode($data_pcare));
    if ($bridge->metaData->code == 201) {
      $this->db->where("no_urutkunjungan", $id);
      $this->db->update("kunjungan", array("nourut_pcare" => @$bridge->response->message, "status_bridging" => 1));
      $this->session->set_flashdata('notif', $this->Notif->berhasil("(success bridging)!!!"));
    } else {
      if ($bridge->metaData->code == 428) {
        $this->db->where("no_urutkunjungan", $id);
        $this->db->update("kunjungan", array("status_bridging" => 1));
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . @$bridge->response));
      } else if ($bridge->metaData->code == 412) {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . @$bridge->response->field . " " . @$bridge->response->message . ' ' . @$bridge->metaData->message));
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, ' . @$bridge->metaData->message));
      }
    }

    redirect(base_url('Periksa/index/' . $id));
    // echo json_encode($bridge);
  }
}
