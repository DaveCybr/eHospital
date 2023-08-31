<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KBPasien extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelKBinaan");
    $this->load->model("ModelPasien");
    $this->load->model("ModelTujuanPelayanan");
    $this->load->model("ModelJenisPasien");
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelPekerjaan");
    $this->load->model("ModelPeriksa");
    $this->data_kunjungan = array(
      'no_urutkunjungan' => $this->input->post('no_urutkunjungan'),
      'tgl' => $this->input->post('tgl'),
      'tupel_kode_tupel' => $this->input->post('tujuan_pelayanan'),
      'jenis_kunjungan' => $this->input->post('jenis_kunjungan'),
      'sumber_dana' => $this->input->post('jenis_pembayaran'),
      'bb' => $this->input->post('bb'),
      'tb' => $this->input->post('tb'),
      'keluhan' => $this->input->post('keluhan'),
      'sudah' => '0',
      'pasien_baru' => $this->input->post('pasien_baru'),
      'kunjungansakit' => (int)$this->input->post('kunjungansakit'),
      'sistole' => $this->input->post('sistole'),
      'diastole' => $this->input->post('diastole'),
      'nadi' => $this->input->post('nadi'),
      'rr' => $this->input->post('rr'),
      'pasien_noRM' => $this->input->post('pasien_noRM'),
      'asal_pasien' => $this->input->post('asal_pasien'),
      'administrasi' => 0,
      'status_deposit' => 1
    );
  }

  public function coba()
  {
    echo json_encode($this->ModelKBinaan->getPeriksa("00061887", "2021-02-01")->row_array());
  }
  public function cobaPcare()
  {
    $bridge = PCare("kunjungan/peserta/0002302442987");
    // echo $bridge;
    $bridgePcare = json_decode(PCare("kunjungan/peserta/0002302442987"));
    $kunjunganPcare = $bridgePcare->response->list[0];
    echo json_encode($bridgePcare->response->list[0]);
  }

  function index()
  {
    $nik = $_SESSION['nik'];
    if ($this->ModelKBinaan->getPerawat(null, $nik)->num_rows() > 0) {
      $idperawat = $this->ModelKBinaan->getPerawat(null, $nik)->row_array()["idkb_perawat"];
      $data = array(
        'body' => 'KeluargaBinaan/list_keluarga',
        'perawat' => $this->ModelKBinaan->getPerawatPJ($idperawat)->row_array(),
        'keluarga' => $this->ModelKBinaan->getKeluarga(null, $idperawat),
       );
      $this->load->view('index', $data);
    }else {
      $data = array(
        'body' => 'KeluargaBinaan/Tidak',
       );
      $this->load->view('index', $data);
    }
  }

  public function getKeluarga($idperawat)
  {
    $data = array(
      'body' => 'KeluargaBinaan/list_keluarga',
      'perawat' => $this->ModelKBinaan->getPerawatPJ($idperawat)->row_array(),
      'keluarga' => $this->ModelKBinaan->getKeluarga(null, $idperawat),
      'tupel' => $this->ModelTujuanPelayanan->get_poli_sakit(),
      'jenis_pasien' => $this->ModelJenisPasien->get_data(),
      'list_pekerjaan' => $this->ModelPekerjaan->get_data(),
     );
    $this->load->view('index', $data);
  }

  public function filter_keluarga($idperawat)
  {
    $tanggal      = $this->input->post("tanggal");
    $status_kunjungan      = $this->input->post("status_kunjungan");
    $data = array(
      'perawat' => $this->ModelKBinaan->getPerawatPJ($idperawat)->row_array(),
      'keluarga' => $this->ModelKBinaan->getKeluarga(null, $idperawat),
      'tanggal' => $tanggal,
      'status_kunjungan' => $status_kunjungan,
      'tupel' => $this->ModelTujuanPelayanan->get_poli_sakit(),
      'jenis_pasien' => $this->ModelJenisPasien->get_data(),
      'list_pekerjaan' => $this->ModelPekerjaan->get_data(),
     );
    $this->load->view('KeluargaBinaan/filter_binaan', $data);
  }

  public function printPasien()
  {
    $tanggal      = $this->input->post("tanggal");
    @$idkb_dokter = $this->input->post("idkb");
    $data = array(
      'perawat' => $this->ModelKBinaan->getPerawat($idkb_dokter)->result(),
      'tanggal' => $tanggal,
      'iddokter'  => $idkb_dokter
     );
    $this->load->view('KeluargaBinaan/printPasien', $data);
  }

  public function inputKeluarga($idperawat)
  {
    $data = array(
      'body' => 'KeluargaBinaan/inputKeluarga',
      'perawat' => $this->ModelKBinaan->getPerawatPJ($idperawat)->row_array(),
      'keluarga' => $this->ModelKBinaan->getKeluarga(null, $idperawat)->result(),
     );
    $this->load->view('index', $data);
  }

  public function editKeluarga($idperawat, $normKK)
  {
    $data = array(
      'body' => 'KeluargaBinaan/editKeluarga',
      'perawat' => $this->ModelKBinaan->getPerawatPJ($idperawat)->row_array(),
      'anggota' => $this->ModelKBinaan->getAnggotaKeluarga($normKK)->result(),
     );
    $this->load->view('index', $data);
  }

  public function getPerawat()
  {
    $data = array(
      'body' => 'KeluargaBinaan/list_allperawat',
      'perawat' => $this->ModelKBinaan->getPerawat()->result(),
      'dokter' => $this->ModelKBinaan->getDokter()->result(),
     );
    $this->load->view('index', $data);
  }

  public function filterPerawat()
  {
    $tanggal      = $this->input->post("tanggal");
    @$idkb_dokter  = $this->input->post("idkb");
    $data = array(
      'perawat' => $this->ModelKBinaan->getPerawat($idkb_dokter)->result(),
      'tanggal' => $tanggal
     );
    $this->load->view('KeluargaBinaan/filter_perawat', $data);
  }

  public function filter_diagnosa($norm)
  {
    $data = array(
      'data_penyakit' => $this->ModelKBinaan->get_riwayat_penyakit($norm),
     );
    $this->load->view('KeluargaBinaan/filter_diagnosa', $data);
  }

  public function filter_kunjungan($norm)
  {
    $data = array(
      'pasien' => $this->ModelPasien->get_data_edit($norm)->row_array()
     );
    $this->load->view('Periksa/riwayat/riwayat_kunjungan2', $data);
  }

  public function cek()
  {
    echo json_encode($this->ModelKBinaan->kunjunganAkhir("0001534292818")->row_array());
  }

  function get_data_pasien($idperawat)
{
  $list = $this->ModelPasien->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $field) {
      $no++;
      $row = array();
      // $row[] = $this->ModelPasien->no($field->noRM, $no);
      $row[] = $field->noRM;
      $row[] = $field->namapasien;
      $row[] = $field->jenis_kelamin;
      $row[] = $this->ModelPasien->umur($field->tgl_lahir);
      $row[] = $field->alamat.", ".$field->kota.", ".$field->provinsi;
      $row[] = "
      <button onclick=\"tambah('$field->noRM','$field->namapasien')\" type=\"button\" class=\"btn btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Tambah Kepala Keluarga\" data-original-title=\"Edit\">
        <i class=\"fa fa-plus\"></i>
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

public function tambah_pasien($idperawat, $norm)
{
  $data = array(
    'pegawai_NIK' => $idperawat,
    'kb_dokter_idkb_dokter' => $iddokter
  );
  if ($this->ModelKBinaan->getPerawat(null, $idperawat)->num_rows() <= 0) {
    if ($this->db->insert("kb_perawat", $data)) {
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
    }else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
    }
  }else {
    $this->session->set_flashdata('notif', $this->Notif->gagal('Data Sudah Ada'));
  }
  redirect("K_Binaan/KBDokter/list_perawat/".$iddokter);
}

public function insert_pasien()
{
  $idkb         = $this->input->post("idkb_perawat");
  $norm         = $this->input->post("norm");
  $normKK       = $this->input->post("status_kepala");
  $statusK      = $this->input->post("status_keluarga");
  $data = array();
    for ($i=0; $i < sizeof($norm); $i++) {
      $ar = array(
        'norm_kk'       => $normKK,
        'pasien_noRM'   => $norm[$i],
        'kb_perawat_idkb_perawat' => $idkb,
        'status_pasien' => $statusK[$i]
      );
      array_push($data, $ar);
    }
    if ($this->db->insert_batch("pasien_binaan", $data)) {
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
    }else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
    }
  redirect("K_Binaan/KBPasien/getKeluarga/".$idkb);
}

public function update_pasien()
{
  $idkb         = $this->input->post("idkb_perawat");
  $norm         = $this->input->post("norm");
  $normKK       = $this->input->post("status_kepala");
  $statusK      = $this->input->post("status_keluarga");
    for ($i=0; $i < sizeof($norm); $i++) {
      $ar = array(
        'norm_kk'       => $normKK,
        'pasien_noRM'   => $norm[$i],
        'kb_perawat_idkb_perawat' => $idkb,
        'status_pasien' => $statusK[$i]
      );
      if ($this->ModelKBinaan->cekPasien($norm[$i])->num_rows() > 0) {
        $this->db->where("pasien_noRM", $norm[$i])->update("pasien_binaan", $ar);
      }else {
        if ($this->db->insert("pasien_binaan", $ar)) {
          $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        }else {
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        }
      }
    }
  redirect("K_Binaan/KBPasien/getKeluarga/".$idkb);
}

// public function insert_kunjungan()
// {
//   // $data_kbk = array(
//   //   'pasien_binaan_idpasien_binaan' => $binaan['idbinaan'],
//   //   'pegawai_NIK'                   => $_SESSION['nik'],
//   //   'status_kunjungan'              => "1",
//   //   'tanggal'                       => date("Y-m-d"),
//   //   'waktu'                         => date("H:i:s"),
//   // );
//   // $this->db->insert("kb_kunjungan", $data_kbk);
//   // if ()) {
//   //   echo "1";
//   // }else {
//   //   echo "0";
//   // }
// }

public function insert_kunjungan()
{
  $binaan = $this->db->where("pasien_noRM", $this->data_kunjungan['pasien_noRM'])->get("pasien_binaan")->row_array();
  $idkb_perawat = $binaan['kb_perawat_idkb_perawat'];
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
  $this->data_kunjungan['NIK'] = $_SESSION['nik'];
  $this->data_kunjungan['jam_daftar'] = date('H:i:s');
  $this->data_kunjungan['no_antrian'] = $no_antrian;
  $pasien = $this->ModelPasien->get_data_edit($this->data_kunjungan['pasien_noRM'])->row_array();
  if ($pasien['tgl_daftar']!=date("Y-m-d")) {
    $this->data_kunjungan['administrasi'] =1;
  }
  if ($pasien['jenis_pasien_kode_jenis']==7) {
    $cek_kunjungan = $this->db->get_where("kunjungan",array(
      "pasien_noRM"=>$this->data_kunjungan['pasien_noRM'],
      'tgl'=>date("Y-m-d"),
      'tupel_kode_tupel'=>$this->data_kunjungan['tupel_kode_tupel']))->num_rows();
    if ($cek_kunjungan>0) {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Pasien telah berkunjung pada poli yang sama hari ini'));
      redirect(base_url().'Kunjungan');
    }
  }
  if ($this->db->insert('kunjungan', $this->data_kunjungan)) {

    if ($this->ModelKBinaan->getKunjungan($this->data_kunjungan['pasien_noRM'], date("Y-m"))->num_rows() <= 0) {
      $idkun = $this->db->insert_id();
      $data_kbk = array(
        'pasien_binaan_idpasien_binaan' => $binaan['idpasien_binaan'],
        'pegawai_NIK'                   => $_SESSION['nik'],
        'status_kunjungan'              => "1",
        'tanggal'                       => date("Y-m-d"),
        'waktu'                         => date("H:i:s"),
      );
      $this->db->insert("kb_kunjungan", $data_kbk);
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
      $data_pcare = array(
        "kdProviderPeserta" => $this->input->post("kdprovider"),
        "tglDaftar"         => date("d-m-Y"),
        "noKartu"           => $pasien['noBPJS'],
        "kdPoli"            => $tujuan_pelayanan['kdpcare'],
        "keluhan"           => $this->data_kunjungan['keluhan'],
        "kunjSakit"         => $this->data_kunjungan['kunjungansakit']==1?true:false,
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
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan Dan Bridging'));
        $this->db->where("no_urutkunjungan",$no_kunjungan['no_urutkunjungan'])->update("kunjungan",array("nourut_pcare"=>$bridge->response->message,"status_bridging"=>1));
        // die(var_dump($bridge));
      }else{
        if ($bridge->metaData->code==412) {
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->response[0]->field." ".$bridge->response[0]->message.' '.$bridge->metaData->message));
        }else{
          $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Bridging, '.$bridge->metaData->message));
        }
      }
    }else{
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
    }
    redirect(base_url().'K_Binaan/KBPasien/getKeluarga/'.$idkb_perawat);
  } else {
    redirect(base_url().'K_Binaan/KBPasien/getKeluarga/'.$idkb_perawat);
  }
}

  function HapusPasien($id, $idperawat)
  {
    $this->db->where("pasien_binaan_idpasien_binaan", $id)->delete("kb_kunjungan");
    if ($this->db->where("idpasien_binaan", $id)->delete("pasien_binaan")) {
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Menghapus Data'));
    }else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Menghapus Data'));
    }
    redirect("K_Binaan/KBPasien/getKeluarga/".$idperawat);
  }

}
