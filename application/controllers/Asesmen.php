<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asesmen extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelPasien');
    $this->load->model('ModelDemografi');
    $this->load->model('ModelKunjungan');
    $this->load->model('ModelPeriksa');
    $this->load->model('ModelJenisPasien');
  }

  function input()
  {
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(4))->row_array();
    $data = array(
      'pasien'        => $pasien,
      'idkunjungan' => $this->uri->segment(3),
      'body'          => 'Demografi/input2',
      'jenispasien'   => $this->ModelKunjungan->get_data_jenis($this->uri->segment(3)),
      'kunjungan'     => $this->ModelKunjungan->get_data_edit($this->uri->segment(3)),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'riwayat'     => $this->ModelPeriksa->get_riwayat_obgyn($pasien['noRM'])->result()
    );
    $this->load->view('index', $data);
  }
  function input2()
  {
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(4))->row_array();
    $data = array(
      'pasien'        => $pasien,
      'idkunjungan' => $this->uri->segment(3),
      'body'          => 'Demografi/input22',
      'jenispasien'   => $this->ModelKunjungan->get_data_jenis($this->uri->segment(3)),
      'kunjungan'     => $this->ModelKunjungan->get_data_edit($this->uri->segment(3)),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'riwayat'     => $this->ModelPeriksa->get_riwayat_obgyn($pasien['noRM'])->result()
    );
    $this->load->view('index', $data);
  }

  function keperawatan(){
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(4))->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'pasien'        => $pasien,
      'body'          => 'Demografi/form_keperawatan',
      'jenispasien'   => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'kunjungan'     => $this->ModelKunjungan->get_data_edit($this->uri->segment(3)),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'demografi' => $this->ModelDemografi->get_demografi($pasien['noRM'])->row_array(),
    );

    $this->load->view('index', $data);
  }


  function input_lama()
  {
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(4))->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'pasien'        => $pasien,
      'body'          => 'Demografi/input_lama',
      'jenispasien'   => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'kunjungan'     => $this->ModelKunjungan->get_data_edit($this->uri->segment(3)),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'demografi' => $this->ModelDemografi->get_demografi($pasien['noRM'])->row_array(),
    );

    $this->load->view('index', $data);
  }
  function edit_lama()
  {
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(4))->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'pasien'        => $pasien,
      'body'          => 'Demografi/edit_lama',
      'jenispasien'   => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'kunjungan'     => $this->ModelKunjungan->get_data_edit($this->uri->segment(3)),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'demografi' => $this->ModelDemografi->get_demografi($pasien['noRM'])->row_array(),
    );

    $this->load->view('index', $data);
  }
  function insert_lama(){
    // die(var_dump($this->input->post('nokun')));
    $data_asesmen = array(
      'bb' => $this->input->post('bb'),
      'tb' => $this->input->post('tb'),
      'suhu' => $this->input->post('temp'),
      'kesadaran' => $this->input->post('kesadaran'),
      'sistole' => $this->input->post('siastole'),
      'diastole' => $this->input->post('diastole'),
      'nadi' => $this->input->post('nadi'),
      'rr' => $this->input->post('rr')
     );
     // die(print_r($data_asesmen));
     $this->db->where('no_urutkunjungan',$this->input->post('nokun'));
     $this->db->update('kunjungan',$data_asesmen);
     $this->session->set_flashdata('notif',$this->Notif->berhasil("Berhasil menyimpan data asesmen"));
     redirect('Periksa/index/'.$this->input->post('nokun'));

  }
  function update_lama(){
    // die(var_dump($this->input->post('nokun')));
    $data_asesmen = array(
      'bb' => $this->input->post('bb'),
      'tb' => $this->input->post('tb'),
      'suhu' => $this->input->post('temp'),
      'kesadaran' => $this->input->post('kesadaran'),
      'sistole' => $this->input->post('siastole'),
      'diastole' => $this->input->post('diastole'),
      'nadi' => $this->input->post('nadi'),
      'rr' => $this->input->post('rr')
     );
     // die(print_r($data_asesmen));
     $cek = $this->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$this->input->post('nokun')))->num_rows();
     if ($cek>0) {
       $data = array(
         'otemp'             => $this->input->post('temp'),
         'obb'               => $this->input->post('bb'),
         'otb'               => $this->input->post('tb'),
         'osadar'            => $this->input->post('kesadaran'),
         'osiastole'         => $this->input->post('siastole'),
         'odiastole'         => $this->input->post('diastole'),
         'onadi'             => $this->input->post('nadi'),
         'orr'               => $this->input->post('rr'),
       );
       $this->db->where('kunjungan_no_urutkunjungan',$this->input->post('nokun'));
       $this->db->update('periksa',$data);
     }
     $this->db->where('no_urutkunjungan',$this->input->post('nokun'));
     $this->db->update('kunjungan',$data_asesmen);
     $this->session->set_flashdata('notif',$this->Notif->berhasil("Berhasil menyimpan data asesmen"));
     redirect('Periksa/index/'.$this->input->post('nokun'));

  }
  function insert()
  {
    $tinggal_dengan = $this->input->post('tinggal_dengan');
    if ($this->input->post('tinggal_dengan')=='lain') {
      $tinggal_dengan = $this->input->post('tinggal_dengan_lain');
    } else {
      $tinggal_dengan = $this->input->post('tinggal_dengan');
    }

    $pekerjaan = $this->input->post('pekerjaan');
    if ($this->input->post('pekerjaan')=='lain') {
      $pekerjaan = $this->input->post('pekerjaan_lain');
    } else {
      $pekerjaan = $this->input->post('pekerjaan');
    }

    $cara_pembayaran = $this->input->post('cara_pembayaran');
    if ($this->input->post('cara_pembayaran')=='lain') {
      $cara_pembayaran = $this->input->post('cara_pembayaran_lain');
    } else {
      $cara_pembayaran = $this->input->post('cara_pembayaran');
    }

    $agama = $this->input->post('agama');
    if ($this->input->post('agama')=='lain') {
      $agama = $this->input->post('agama_lain');
    } else {
      $agama = $this->input->post('agama');
    }

    $kebiasaan = $this->input->post('kebiasaan');
    if ($this->input->post('kebiasaan')=='lain') {
      $kebiasaan = $this->input->post('kebiasaan_lain');
    } else {
      $kebiasaan = $this->input->post('kebiasaan');
    }

    $bahasa = $this->input->post('bahasa');
    if ($this->input->post('bahasa')=='lain') {
      $bahasa = $this->input->post('bahasa_lain');
    } else {
      $bahasa = $this->input->post('bahasa');
    }

    $potensi = $this->input->post('potensi');
    if ($this->input->post('potensi')=='lain') {
      $potensi = $this->input->post('potensi_lain');
    } else {
      $potensi = $this->input->post('potensi');
    }

    $alergi = $this->input->post('alergi');
    if ($this->input->post('alergi')=='lain') {
      $alergi = $this->input->post('alergi_lain');
    } else {
      $alergi = $this->input->post('alergi');
    }

    $mst1 = $this->input->post('mst_1');
    if ($this->input->post('mst_1') == "lain") {
      $mst1 = $this->input->post('mst_1_lain');
    }


    $data_asesmen = array(
      'pasien_noRM'     => $this->input->post('no_rm'),
      'kunjungan_no_urutkunjungan' => $this->input->post('nokun'),
      'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan'),
      'jam_kunjungan' => $this->input->post('tanggal_jam_kunjungan'),
      'sumberdata'      => $this->input->post('sumberdata'),
      'rujukan'         => $this->input->post('rujukan'),
      'dokter'          => $this->input->post('dokter'),
      'rs'              => $this->input->post('rs'),
      'aak_lainnya'     => $this->input->post('aak_lainnya'),
      'diagnosa_rujukan'=> $this->input->post('diagnosa_rujukan'),
      'keadaan'         => $this->input->post('keadaan'),
      'GCS_E'           => $this->input->post('GCS_E'),
      'GCS_M'           => $this->input->post('GCS_M'),
      'GCS_V'           => $this->input->post('GCS_V'),
      'td'              => $this->input->post('td'),
      'rr'              => $this->input->post('rr'),
      'suhu'            => $this->input->post('suhu'),
      'siastole'  => $this->input->post("siastole"),
      'diastole' => $this->input->post("diastole"),
      'nadi' => $this->input->post("nadi"),
      'kesadaran' => $this->input->post("kesadaran"),
      'hr'              => $this->input->post('hrtandavital'),
      'alatbantu'       => $this->input->post('alatbantu'),
      'cacattubuh'      => $this->input->post('cacattubuh'),
      'adl'             => $this->input->post('adl'),
      'semosi'          => $this->input->post('semosi'),
      'seperkawinan'    => $this->input->post('seperkawinan'),
      'tinggal_dengan'  => $tinggal_dengan,
      'pekerjaan'       => $pekerjaan,
      'cara_pembayaran' => $cara_pembayaran,
      'agama'           => $agama,
      'kebiasaan'       => $kebiasaan,
      'kebudayaan'      => $this->input->post('kebudayaan'),
      'kebudayaan_lain' => $this->input->post('kebudayaan_lain'),
      'masbir'         => $this->input->post('masbir'),
      'masbir_lain'     => $this->input->post('masbir_lain'),
      'bahasa'          => $bahasa,
      'potensi'         => $potensi,
      'alergi'          => $alergi,
      'alergi_reaksi'   => $this->input->post('alergi_reaksi'),
      'penyakit_dahulu' => implode(",",$this->input->post('penyakit_dahulu')),
      'penyakit_dahulu_lain' => $this->input->post('penyakit_dahulu_lain'),
      'riwayat_penyakit_keluarga'=> implode(",",$this->input->post('riwayat_penyakit_keluarga')),
      'riwayat_operasi' => $this->input->post('riwayat_operasi'),
      'riwayat_tranfusi'=> $this->input->post('riwayat_tranfusi'),
      'golongan_darah'  => $this->input->post('golongan_darah'),
      'keluhan_nyeri'   => $this->input->post('keluhan_nyeri'),
      'penyebab_provoke'=> $this->input->post('penyebab_provoke'),
      'kualitas_quality'=> !empty($this->input->post('kualitas_quality'))?implode(",",$this->input->post('kualitas_quality')):NULL,
      'lokasi_radius'   => $this->input->post('lokasi_radius'),
      'intensitas'      => $this->input->post('intensitas'),
      'intensitas_score'=> $this->input->post('intensitas_score'),
      'kategori_nyeri'  => $this->input->post('kategori_nyeri'),
      'durasi_nyeri_mk'  => $this->input->post('durasi_nyeri_mk'),
      'durasi_nyeri_bl' => $this->input->post('durasi_nyeri_bl'),
      'durasi_nyeri_f'  => $this->input->post('durasi_nyeri_f'),
      'nyeri_hilang'    => $this->input->post('nyeri_hilang'),
      'prj_umur'        => $this->input->post('prj_umur'),
      'prj_skor'        => $this->input->post('prj_skor'),
      'prj_kategori'    => $this->input->post('prj_kategori'),
      'pn_bb'           => $this->input->post('pn_bb'),
      'pn_tb'           => $this->input->post('pn_tb'),
      'pn_lila'         => $this->input->post('pn_lila'),
      'pn_imt'          => $this->input->post('pn_imt'),
      'mst_1'           => $mst1,
      'mst_2'           => $this->input->post('mst_2'),
      'mst_skor'        => $this->input->post('mst_skor'),
      'strongkids1'      => $this->input->post('strongkids1'),
      'strongkids2'      => $this->input->post('strongkids2'),
      'strongkids3'      => $this->input->post('strongkids3'),
      'strongkids4'      => $this->input->post('strongkids4'),
      'strongkids_skor'  => $this->input->post('strongkids_skor'),

      //Obgyn
      'menarche_umur'     => $this->input->post('manarcheumur'),
      'lamahaid'          => $this->input->post('lamahaid'),
      'siklus'            => $this->input->post('siklus'),
      'keluhan_obgyn'     => implode(', ',$this->input->post('keluhan_obgyn')),
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
      'komplikasi'        => implode(', ',$this->input->post('Komplikasi')),

     );
     // die(print_r($data_asesmen));
     if (!empty($this->input->post('thnpartus'))) {
       $tahunpartus       = $this->input->post('thnpartus');
       $tempatpartus      = $this->input->post('tempatpartus');
       $umurhamil        = $this->input->post('umur');
       $jenispersalinan   = $this->input->post('jenis_persalinan');
       $penolong          = $this->input->post('penolong');
       $penyulit          = $this->input->post('penyulit');
       $jk                = $this->input->post('jk');
       $bb                = $this->input->post('bb');
       $hm                = $this->input->post('hm');
       for ($i=0; $i < count($tahunpartus) ; $i++) {
         $dataobgyn = array(
           'tahunpartus'       => $tahunpartus[$i],
           'tempatpartus'      => $tempatpartus[$i],
           'umurhamil'         => $umurhamil[$i],
           'jenispersalinan'   => $jenispersalinan[$i],
           'penolong'          => $penolong[$i],
           'penyulit'          => $penyulit[$i],
           'jk'                => $jk[$i],
           'bb'                => $bb[$i],
           'hm'                => $hm[$i],
           'pasien_noRM'       => $this->input->post('no_rm'),
           'opr'               => $_SESSION['nik'],
           'tanggal'           => date('Y-m-d H:i:s')
          );
          $this->db->insert('riwayat_obgyn', $dataobgyn);

       }

     }
     $this->db->where('no_urutkunjungan',$this->input->post('nokun'));
     $this->db->update('kunjungan',array(
       'bb' => $this->input->post('pn_bb'),
       'tb' => $this->input->post('pn_tb'),
       'suhu' => $this->input->post('suhu'),
       'kesadaran' => $this->input->post('kesadaran'),
       'sistole' => $this->input->post('siastole'),
       'diastole' => $this->input->post('diastole'),
       'nadi' => $this->input->post('nadi'),
       'rr' => $this->input->post('rr')
     ));
     $count = $this->ModelDemografi->get_demografi($this->uri->segment(3))->num_rows();
     $this->session->set_flashdata('notif',$this->Notif->berhasil("Berhasil menyimpan data asesmen"));
     $this->db->insert('demografi',$data_asesmen);
     redirect('Periksa/index/'.$this->input->post('nokun'));
     // if ($count <= 1) {
     //  $this->db->where('pasien_noRM', $this->input->post('no_rm'));
     //  $this->db->update('demografi', $data_asesmen);
     // }else {
     //
     // }

  }

  function input_igd()
  {
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(4))->row_array();
    $data = array(
      'pasien'        => $pasien,
      'body'          => 'Demografi/input_igd',
      'jenispasien'   => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'kunjungan'     => $this->ModelKunjungan->get_data_edit($this->uri->segment(3)),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'asesmen'       => $this->ModelDemografi->getAsesmenIGD($this->uri->segment(3))->row_array()
    );
    $this->load->view('index', $data);
  }

  function observasi()
  {
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(4))->row_array();
    $data = array(
      'pasien'        => $pasien,
      'body'          => 'Demografi/observasi_lanjutan',
      'jenispasien'   => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'kunjungan'     => $this->ModelKunjungan->get_data_edit($this->uri->segment(3)),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'observasi'     => $this->ModelDemografi->getObservasiLanjutan($this->uri->segment(3))->result()
    );
    $this->load->view('index', $data);
  }

  function insert_Observasi($value='')
  {
    $kunjungan = $this->input->post('kunjungan');
    $pasien = $this->input->post('pasien');
    $data = array(
      'tgl'   => $this->input->post("tanggal"),
      'jam'   => $this->input->post("jam"),
      'gcs'   => $this->input->post('gcs'),
      'td'    => $this->input->post('td'),
      'n'     => $this->input->post('n'),
      'rr'    => $this->input->post('rr'),
      's'     => $this->input->post('s'),
      'sat'   => $this->input->post('sat'),
      'keluhan'=> $this->input->post('keluhan'),
      'kunjungan_no_urutkunjungan' => $kunjungan,
      'perawat'=> $_SESSION['nik']
    );
    if ($this->db->insert('observasi', $data)) {
      redirect("Asesmen/observasi/".$kunjungan."/".$pasien);
    }
  }

  function insert_igd()
  {
    $cidera = $this->input->post("cidera");
    $luka = $this->input->post("luka");
    if (!empty($cidera)) {
      $cidera = implode(",",$cidera);
    }else{
      $cidera = NULL;
    }
    if (!empty($luka)) {
      $luka = implode(",",$luka);
    }else{
      $luka = NULL;
    }
    $data = array(
      'pasien'            => $this->input->post('no_rm'),
      'perawat'           => $_SESSION['nik'],
      'kunjungan_no_urutkunjungan' => $this->input->post('nokun'),
      'tanggal'           => $this->input->post('tanggal_kunjungan'),
      'jam'               => $this->input->post('tanggal_jam_kunjungan'),
      'sumberdata'        => $this->input->post('sumberdata'),
      'sumberdatalain'    => $this->input->post('sumberdatalain'),
      'rujukan'           => $this->input->post('rujukan'),
      'rujukandokter'     => $this->input->post('rujukandokter'),
      'rujukanrs'         => $this->input->post('rujukanrs'),
      'rujukanlain'       => $this->input->post('rujukanlain'),
      'diagnosa_rujukan'  => $this->input->post('diagnosa_rujukan'),

      'keluhan_utama'     => $this->input->post('keluhan_utama'),
      'riwayat_penyakit'  => $this->input->post('riwayat_penyakit'),
      'airway'            => $this->input->post('airway'),
      'breathing'         => $this->input->post('breathing'),
      'rr'                => $this->input->post('rr'),

      // 'td'                => $this->input->post('td'),
      'kesadaran'       => $this->input->post('kesadaran'),
      'sistole'           => $this->input->post('siastole'),
      'diastole'          => $this->input->post('diastole'),
      'n'                 => $this->input->post('n'),
      'crt'               => $this->input->post('crt'),
      'warna_kulit'       => $this->input->post('warna_kulit'),
      'pendarahan'       => $this->input->post('pendarahan'),
      'tugor_kulit'       => $this->input->post('tugor_kulit'),
      'respon'            => $this->input->post('respon'),
      'pupil'             => $this->input->post('pupil'),
      'pupil_lain'        => $this->input->post('pupil_lain'),
      'reflek1'           => $this->input->post('reflek1'),
      'reflek2'           => $this->input->post('reflek2'),
      'GCS_E'             => $this->input->post('GCS_E'),
      'GCS_V'             => $this->input->post('GCS_V'),
      'GCS_M'             => $this->input->post('GCS_M'),

      'cidera'            => $cidera,
      'cidera_lain'       => $this->input->post('cidera_lain'),
      'luka'              => $luka,
      'luka_lain'         => $this->input->post('luka_lain'),
      'skalanyeri'        => $this->input->post('skalanyeri'),
      'bb'                => $this->input->post('bb'),
      'tb'                => $this->input->post('tb'),
      'skala_cidera' => $this->input->post("skalacidera"),
      'airway_bebas'      => $this->input->post('airway_bebas'),
      'airway_obstruksi'  => $this->input->post('airway_obstruksi'),
      'sub_obstruksi'     => $this->input->post('sub_obstruksi'),
      'lain_sub_obstruksi'=> $this->input->post('lain_sub_obstruksi'),
      'airway_polanafas'  => $this->input->post('airway_polanafas'),
      'polanafas_frekuensi'=> $this->input->post('polanafas_frekuensi'),
      'airway_suaranafas' => $this->input->post('airway_suaranafas'),
      'sub_suaranafas'    => $this->input->post('sub_suaranafas'),
      // 'circulationtd'     => $this->input->post('circulationtd'),
      'nadi'              => $this->input->post('nadi'),
      'suhu'              => $this->input->post('suhu'),
      'sub_perfusi'       => $this->input->post('sub_perfusi'),
      'sub_capilary'      => $this->input->post('sub_capilary'),
      'bunyijantung'      => $this->input->post('bunyijantung'),
      'turgor'            => $this->input->post('turgor'),
      'mokusamulut'       => $this->input->post('mokusamulut'),
      'bab'               => $this->input->post('bab'),
      'bak'               => $this->input->post('bak'),
      'sub_tingkatkesadaran'=> $this->input->post('sub_tingkatkesadaran'),
      'GCS_E2'            => $this->input->post('GCS_E2'),
      'GCS_V2'            => $this->input->post('GCS_V2'),
      'GCS_M2'            => $this->input->post('GCS_M2'),
      'pupil'             => $this->input->post('pupil'),
      'rc'                => $this->input->post('rc'),
      'kepala'            => $this->input->post('kepala'),
      'leher'             => $this->input->post('leher'),
      'dada'              => $this->input->post('dada'),
      'perut'             => $this->input->post('perut'),
      'extermitas'        => $this->input->post('extermitas'),
      'dlukabakar'        => $this->input->post('dlukabakar'),
      'skala'             => $this->input->post('skala'),
      'lokasi'            => $this->input->post('lokasi'),
      'fraktur'           => $this->input->post('fraktur'),
      'dislokasi'         => $this->input->post('dislokasi'),
      'makanan'           => $this->input->post('makanan'),
      'gigitanbinatang'   => $this->input->post('gigitanbinatang'),
      'zatkimia'          => $this->input->post('zatkimia'),
      'narkotik'          => $this->input->post('narkotik'),
      'takgelisah'        => $this->input->post('takgelisah'),
      'rendahdiri'        => $this->input->post('rendahdiri'),
      'sedih'             => $this->input->post('sedih'),
      'menarikdiri'       => $this->input->post('menarikdiri'),
      'takut'             => $this->input->post('takut'),
      'gelisah'           => $this->input->post('gelisah'),
      'marah'             => $this->input->post('marah'),
      'kombaik'           => $this->input->post('kombaik'),
      'bantuanspiritual'  => $this->input->post('bantuanspiritual'),
      'gravida'           => $this->input->post('gravida'),
      'taper'             => $this->input->post('taper'),
      'pembukaan'         => $this->input->post('pembukaan'),
      'ketuban'           => $this->input->post('ketuban'),

      'jnb1'              => $this->input->post('jnb1'),
      'jnb2'              => $this->input->post('jnb2'),
      'jnb3'              => $this->input->post('jnb3'),
      'jnb4'              => $this->input->post('jnb4'),
      'polanafas1'        => $this->input->post('polanafas1'),
      'polanafas2'        => $this->input->post('polanafas2'),
      'polanafas3'        => $this->input->post('polanafas3'),
      'polanafas4'        => $this->input->post('polanafas4'),
      'curahjantung'      => $this->input->post('curahjantung'),
      'perfusijaringan'   => $this->input->post('perfusijaringan'),
      'keseimbangancariran'=> $this->input->post('keseimbangancariran'),
      'peningkatanTIK'    => $this->input->post('peningkatanTIK'),
      'adaptasinyeri'     => $this->input->post('adaptasinyeri'),
      'resikocidera'      => $this->input->post('resikocidera'),
      'klienaktifitas'    => $this->input->post('klienaktifitas'),
      'kerusakanintergritas'=> $this->input->post('kerusakanintergritas'),
      'tidakinfeksi'      => $this->input->post('tidakinfeksi'),
      'hipotermi'         => $this->input->post('hipotermi'),
      'cemas'             => $this->input->post('cemas'),

      'healtheducation1'  => $this->input->post('healtheducation1'),
      'healtheducation2'  => $this->input->post('healtheducation2'),
      'posisiklien1'      => $this->input->post('posisiklien1'),
      'posisiklienlain'   => $this->input->post('posisiklienlain'),
      'pengamantempattidur'=> $this->input->post('pengamantempattidur'),
      'neccollar'         => $this->input->post('neccollar'),
      'fingersweep'       => $this->input->post('fingersweep'),
      'headtuil'          => $this->input->post('headtuil'),
      'jawthurst'         => $this->input->post('jawthurst'),
      'chinlift'          => $this->input->post('chinlift'),
      'orofaring'         => $this->input->post('orofaring'),
      'nasofaring'        => $this->input->post('nasofaring'),
      'suction'           => $this->input->post('suction'),
      'abdominal'         => $this->input->post('abdominal'),
      'chesthrust'        => $this->input->post('chesthrust'),
      'backblow'          => $this->input->post('backblow'),
      'monitornafas'      => $this->input->post('monitornafas'),
      'berioksigen'       => $this->input->post('berioksigen'),
      'nassal'            => $this->input->post('nassal'),
      'sm'                => $this->input->post('sm'),
      'bvm'               => $this->input->post('bvm'),
      'mnr'               => $this->input->post('mnr'),
      'mr'                => $this->input->post('mr'),
      'nafasdalam'        => $this->input->post('nafasdalam'),
      'chestfisi'         => $this->input->post('chestfisi'),
      'rpj'               => $this->input->post('rpj'),
      'ecg'               => $this->input->post('ecg'),
      'hentikanperdarahan'=> $this->input->post('hentikanperdarahan'),
      'rehidrasi'         => $this->input->post('rehidrasi'),
      'circulationlain'   => $this->input->post('circulationlain'),
      'bebatbidai'        => $this->input->post('bebatbidai'),
      'rangsel'           => $this->input->post('rangsel'),
      'tekniksi'          => $this->input->post('tekniksi'),
      'rawatluka'         => $this->input->post('rawatluka'),
      'kliensuhu'         => $this->input->post('kliensuhu'),
      'kompres'           => $this->input->post('kompres'),
      'jenisracun'        => $this->input->post('jenisracun'),
      'kumbahlambung'     => $this->input->post('kumbahlambung'),
      'bhsp'              => $this->input->post('bhsp'),
      'suasana'           => $this->input->post('suasana'),
      'bataspengunjung'   => $this->input->post('bataspengunjung'),
      'kecemasan'         => $this->input->post('kecemasan'),
      'ungkapperasaan'    => $this->input->post('ungkapperasaan'),
      'potensinafas'      => $this->input->post('potensinafas'),
      'vitalsign'         => $this->input->post('vitalsign'),
      'observasifrekuensi'=> $this->input->post('observasifrekuensi'),
      'sianosis'          => $this->input->post('sianosis'),
      'keseimbanganintake'=> $this->input->post('keseimbanganintake'),
      'GCSpupil'          => $this->input->post('GCSpupil'),
      'peradangan'        => $this->input->post('peradangan'),
      'lingkarabdomen'    => $this->input->post('lingkarabdomen'),
      'hb'                => $this->input->post('hb'),
      'ett'               => $this->input->post('ett'),
      'nebulizer'         => $this->input->post('nebulizer'),
      'pasangiv'          => $this->input->post('pasangiv'),
      'pasangtranfusi'    => $this->input->post('pasangtranfusi'),
      'ngt'               => $this->input->post('ngt'),
      'kateter'           => $this->input->post('kateter'),
      'wt'                => $this->input->post('wt'),
      'pemberianobat'     => $this->input->post('pemberianobat'),
      'pemberiananti'     => $this->input->post('pemberiananti'),
      'pemberianlaboratorium'=>$this->input->post('pemberianlaboratorium'),
      'radiologi'         => $this->input->post('radiologi'),
      'lainradio'         => $this->input->post('lainradio'),
    );
    if ($this->db->insert("asesmen_igd", $data)) {
      $this->db->where('no_urutkunjungan',$this->input->post('nokun'));
      $this->db->update('kunjungan',array(
        'bb' => $this->input->post('bb'),
        'tb' => $this->input->post('tb'),
        'suhu' => $this->input->post('suhu'),
        'kesadaran' => $this->input->post('kesadaran'),
        'sistole' => $this->input->post('siastole'),
        'diastole' => $this->input->post('diastole'),
        'nadi' => $this->input->post('nadi'),
        'rr' => $this->input->post('rr')
      ));
      redirect("Periksa/index/".$this->input->post('nokun'));
    }
  }
  public function timbang_terima(){
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(4))->row_array();
    $data = array(
      'pasien'        => $pasien,
      'body'          => 'Demografi/input_tt',
      'jenispasien'   => $this->ModelKunjungan->get_data_jenis($this->uri->segment(3)),
      'kunjungan'     => $this->ModelKunjungan->get_data_edit($this->uri->segment(3)),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
    );
    $this->load->view('index', $data);
  }
  public function edit_timbang_terima(){
    $pasien = $this->ModelPasien->get_data_edit($this->uri->segment(4))->row_array();
    $data = array(
      'pasien'        => $pasien,
      'body'          => 'Demografi/edit_tt',
      'jenispasien'   => $this->ModelKunjungan->get_data_jenis($this->uri->segment(3)),
      'kunjungan'     => $this->ModelKunjungan->get_data_edit($this->uri->segment(3)),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3)),
      'tt' => $this->ModelDemografi->get_tt($this->uri->segment(5)),
    );
    $this->load->view('index', $data);
  }
  public function detail_tt(){
    $pasien = $this->ModelDemografi->get_pasien($this->uri->segment(4))->row_array();
    $data = array(
      'pasien'        => $pasien,
      'body'          => 'Demografi/detail_tt',
      'jenispasien'   => $this->ModelKunjungan->get_data_jenis($this->uri->segment(4)),
      'kunjungan'     => $this->ModelKunjungan->get_data_edit($this->uri->segment(4)),
      'periksa'       => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(4)),
      'timbang' => $this->ModelDemografi->get_tt($this->uri->segment(3))
    );
    $this->load->view('index', $data);
  }
  public function insert_timbangterima(){
    // $nokun = $this->uri->segment(3);
    $nokun = $this->input->post("nomerkun");
    $data = array(
      'kunjungan_no_urutkunjungan' => $nokun,
      'sistole' => $this->input->post('siastole'),
      'diastole' => $this->input->post('diastole'),
      'suhu' => $this->input->post('suhu'),
      'nadi' => $this->input->post('nadi'),
      'respirasi' => $this->input->post('rr'),
      'keluhan_umum' => $this->input->post('keluhan'),
      'keluhan_napas' => !empty($this->input->post('keluhan_napas'))?implode(",",$this->input->post('keluhan_napas')):NULL,
      'irama_napas' => $this->input->post('irama_napas'),
      'suara_napas' => !empty($this->input->post('suara_napas'))?implode(",",$this->input->post('suara_napas')):NULL,
      'oksigen' => $this->input->post('oksigen'),
      'nyeri_dada' => $this->input->post('nyeri_dada'),
      'irama_jantung' => $this->input->post('irama_jantung'),
      'crt' => $this->input->post('crt'),
      'konjungtiva' => $this->input->post('konjungtiva'),
      'kesadaran' => $this->input->post('kesadaran'),
      'gcs_e' => $this->input->post('GCS_E'),
      'gcs_v' => $this->input->post('GCS_V'),
      'gcs_m'  => $this->input->post('GCS_M'),
      'keluhan_pusing' => $this->input->post('keluhan_pusing'),
      'pupil' => $this->input->post('pupil'),
      'diameter_pupil' => $this->input->post('diameter1')."/".$this->input->post('diameter2'),
      'nyeri' => $this->input->post('nyeri_saraf'),
      'skala_nyeri' => $this->input->post('skala_nyeri'),
      'lokasi_nyeri' => $this->input->post('lokasi_nyeri'),
      'keluhan_perkemihan' => !empty($this->input->post('keluhan_kemih'))?implode(",",$this->input->post('keluhan_kemih')):NULL,
      'anuria' => !empty($this->input->post('anuria'))?implode(",",$this->input->post('anuria')):NULL,
      'kandung_kemih' => $this->input->post('kandung_kemih'),
      'nyeri_tekan' => $this->input->post('nyeri_tekan'),
      'alat_bantu'  => !empty($this->input->post('alatbantu'))?implode(",",$this->input->post('alatbantu')):NULL,
      'intake_cair'  => $this->input->post('intake_cair'),
      'oral'  => $this->input->post('oral'),
      'parenteral'  => $this->input->post('parenteral'),
      'produksi_urine'  => $this->input->post('produksi_urine'),
      'warna_urine'  => $this->input->post('warna_urine'),
      'bau_urine'  => $this->input->post('bau_urine'),
      'abdomen'  => $this->input->post('abdomen'),
      'mukosa_mulut'  => !empty($this->input->post('mukosa_mulut'))?implode(",",$this->input->post('mukosa_mulut')):NULL,
      'tenggorokan'  => !empty($this->input->post('tenggorokan'))?implode(",",$this->input->post('tenggorokan')):NULL,
      'abdomen_2'  => !empty($this->input->post('abdomen_2'))?implode(",",$this->input->post('abdomen_2')):NULL,
      'lokasi_nyeri_tekan' => $this->input->post("lokasi_nyeri_tekan"),
      'lokasi_jejas' => $this->input->post("lokasi_jejas"),
      'mual'  => $this->input->post('mual'),
      'muntah'  => $this->input->post('muntah'),
      'bising_usus'  => $this->input->post('bising_usus'),
      'ngt'  => $this->input->post('ngt'),
      'diet'  => $this->input->post('diet')=="lain"?$this->input->post('diet_lain'):$this->input->post('diet'),
      'frekuensi'  => $this->input->post('frekuensi'),
      'jumlah'  => $this->input->post('jumlah'),
      'jenis'  => $this->input->post('jenis'),
      'bab'  => $this->input->post('bab'),
      'konsistensi'  => $this->input->post('konsistensi'),
      'konstipasi'  => $this->input->post('konstipasi'),
      'sendi'  => $this->input->post('sendi'),
      'frakture'  => $this->input->post('fraktur'),
      'lokasi_frakture'  => $this->input->post('lokasi_fraktur'),
      'gips'  => $this->input->post('gips'),
      'lokasi_gips'  => $this->input->post('lokasi_gips'),
      'syndrome'  => $this->input->post('syndrome'),
      'kulit'  => !empty($this->input->post('kulit'))?implode(",",$this->input->post('kulit')):NULL,
      'akral'  => !empty($this->input->post('akral'))?implode(",",$this->input->post('akral')):NULL,
      'turgor'  => !empty($this->input->post('turgor'))?implode(",",$this->input->post('turgor')):NULL,
      'jenis_luka'  => $this->input->post('jenis_luka'),
      'jenis_luka2'  => !empty($this->input->post('jenisluka2'))?implode(",",$this->input->post('jenisluka2')):NULL,
      'luas_luka'  => $this->input->post('luas_luka'),
      'lainnya'  => $this->input->post('lainnya'),
      'rekomendasi'  => $this->input->post('rekomendasi'),
      'waktu_timbangterima'  => date("Y-m-d h:i:s"),
      'perawat_jaga'  => $_SESSION['nik'],
    );
    $this->db->insert('timbang_terima',$data);
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Berhasil input timbang terima"));
    redirect("Ranap");
  }
  public function update_timbangterima($id){
    // $nokun = $this->uri->segment(3);
    $nokun = $this->input->post("nomerkun");
    $data = array(
      // 'kunjungan_no_urutkunjungan' => $nokun,
      'sistole' => $this->input->post('siastole'),
      'diastole' => $this->input->post('diastole'),
      'suhu' => $this->input->post('suhu'),
      'nadi' => $this->input->post('nadi'),
      'respirasi' => $this->input->post('rr'),
      'keluhan_umum' => $this->input->post('keluhan'),
      'keluhan_napas' => !empty($this->input->post('keluhan_napas'))?implode(",",$this->input->post('keluhan_napas')):NULL,
      'irama_napas' => $this->input->post('irama_napas'),
      'suara_napas' => !empty($this->input->post('suara_napas'))?implode(",",$this->input->post('suara_napas')):NULL,
      'oksigen' => $this->input->post('oksigen'),
      'nyeri_dada' => $this->input->post('nyeri_dada'),
      'irama_jantung' => $this->input->post('irama_jantung'),
      'crt' => $this->input->post('crt'),
      'konjungtiva' => $this->input->post('konjungtiva'),
      'kesadaran' => $this->input->post('kesadaran'),
      'gcs_e' => $this->input->post('GCS_E'),
      'gcs_v' => $this->input->post('GCS_V'),
      'gcs_m'  => $this->input->post('GCS_M'),
      'keluhan_pusing' => $this->input->post('keluhan_pusing'),
      'pupil' => $this->input->post('pupil'),
      'diameter_pupil' => $this->input->post('diameter1')."/".$this->input->post('diameter2'),
      'nyeri' => $this->input->post('nyeri_saraf'),
      'skala_nyeri' => $this->input->post('skala_nyeri'),
      'lokasi_nyeri' => $this->input->post('lokasi_nyeri'),
      'keluhan_perkemihan' => !empty($this->input->post('keluhan_kemih'))?implode(",",$this->input->post('keluhan_kemih')):NULL,
      'anuria' => !empty($this->input->post('anuria'))?implode(",",$this->input->post('anuria')):NULL,
      'kandung_kemih' => $this->input->post('kandung_kemih'),
      'nyeri_tekan' => $this->input->post('nyeri_tekan'),
      'alat_bantu'  => !empty($this->input->post('alatbantu'))?implode(",",$this->input->post('alatbantu')):NULL,
      'intake_cair'  => $this->input->post('intake_cair'),
      'oral'  => $this->input->post('oral'),
      'parenteral'  => $this->input->post('parenteral'),
      'produksi_urine'  => $this->input->post('produksi_urine'),
      'warna_urine'  => $this->input->post('warna_urine'),
      'bau_urine'  => $this->input->post('bau_urine'),
      'abdomen'  => $this->input->post('abdomen'),
      'mukosa_mulut'  => !empty($this->input->post('mukosa_mulut'))?implode(",",$this->input->post('mukosa_mulut')):NULL,
      'tenggorokan'  => !empty($this->input->post('tenggorokan'))?implode(",",$this->input->post('tenggorokan')):NULL,
      'abdomen_2'  => !empty($this->input->post('abdomen_2'))?implode(",",$this->input->post('abdomen_2')):NULL,
      'lokasi_nyeri_tekan' => $this->input->post("lokasi_nyeri_tekan"),
      'lokasi_jejas' => $this->input->post("lokasi_jejas"),
      'mual'  => $this->input->post('mual'),
      'muntah'  => $this->input->post('muntah'),
      'bising_usus'  => $this->input->post('bising_usus'),
      'ngt'  => $this->input->post('ngt'),
      'diet'  => $this->input->post('diet')=="lain"?$this->input->post('diet_lain'):$this->input->post('diet'),
      'frekuensi'  => $this->input->post('frekuensi'),
      'jumlah'  => $this->input->post('jumlah'),
      'jenis'  => $this->input->post('jenis'),
      'bab'  => $this->input->post('bab'),
      'konsistensi'  => $this->input->post('konsistensi'),
      'konstipasi'  => $this->input->post('konstipasi'),
      'sendi'  => $this->input->post('sendi'),
      'frakture'  => $this->input->post('fraktur'),
      'lokasi_frakture'  => $this->input->post('lokasi_fraktur'),
      'gips'  => $this->input->post('gips'),
      'lokasi_gips'  => $this->input->post('lokasi_gips'),
      'syndrome'  => $this->input->post('syndrome'),
      'kulit'  => !empty($this->input->post('kulit'))?implode(",",$this->input->post('kulit')):NULL,
      'akral'  => !empty($this->input->post('akral'))?implode(",",$this->input->post('akral')):NULL,
      'turgor'  => !empty($this->input->post('turgor'))?implode(",",$this->input->post('turgor')):NULL,
      'jenis_luka'  => $this->input->post('jenis_luka'),
      'jenis_luka2'  => !empty($this->input->post('jenisluka2'))?implode(",",$this->input->post('jenisluka2')):NULL,
      'luas_luka'  => $this->input->post('luas_luka'),
      'lainnya'  => $this->input->post('lainnya'),
      'rekomendasi'  => $this->input->post('rekomendasi'),
      'waktu_timbangterima'  => date("Y-m-d h:i:s"),
      'perawat_jaga'  => $_SESSION['nik'],
    );
    $this->db->where("id_timbangterima",$id);
    $this->db->update('timbang_terima',$data);
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Berhasil update timbang terima"));
    redirect("Ranap");
  }
  public function test_push(){
    $this->load->view("vendor/autoload.php");
    $options = array(
      'cluster' => 'ap1',
      'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
      '58f10ec738925cc9cf18',
      '989571a4920f2374328e',
      '627660',
      $options
    );
    $data['message'] = array('nama_depan'=>'Fendrik','nama_tengah'=>"Nurul");
  $pusher->trigger('my-channel100', 'my-event100', $data);

  }

}
