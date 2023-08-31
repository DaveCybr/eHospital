<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KunjunganLab extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelKunjunganLab");
    $this->load->model("ModelPasien");
    $this->load->model("ModelLaborat");
    $this->load->model("ModelAkuntansi");
  }

  function index()
  {
    $tgl = date('Y-m-d');
    $data = array(
      'body'        => 'KunjunganLab/index',
      'permintaan'  => $this->ModelKunjunganLab->list_permintaan($tgl)->result()
    );
    $this->load->view('index',$data);
  }

  function filter()
  {
    $tgl = $this->uri->segment(3);
    $no = 0;

    foreach ($this->ModelKunjunganLab->list_permintaan($tgl)->result() as $value) {
      $no++;
      $id_check = $value->no_urutkunjungan;
      $k = $value->kode_tupel;
      $warna = "badge-primary";
      if ($k == "UMU"){$warna = "badge-success";}elseif($k == "IGD"){$warna = "badge-danger";}elseif($k == "OBG"){$warna = "badge-info";}elseif ($k == "GIG") {$warna = "badge-warning";}
      if ($value->jenis_kunjungan == 1) {
        $jenis = "Baru";
      } else {
        $jenis = "Lama";
      }
      if ($value->status==1) {
        $sts_input = '<span class="badge badge-pill badge-danger">Belum Input</span>';
      }else{
        $sts_input = '<span class="badge badge-pill badge-success">Sudah Input</span>';
      }
      if ($value->billing != 1 ) {
        $status = '<span class="badge badge-pill badge-danger">Belum Billing</span>';
      }else{
        $status = '<span class="badge badge-pill badge-success">Sudah Billing</span>';
      }
      $button_edit = '';
      if ($value->billing != 1 ) {
        if ($value->status == 1) {
          $button_edit = '<a href="'.base_url().'KunjunganLab/periksa/'.$value->no_urutkunjungan.'/'.$value->nokunjlab.'">
            <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analisa">
              <i class="fa fa-flask"></i> Analisa
            </button>
          </a>';
        }else{
          $button_edit = '<a href="'.base_url().'KunjunganLab/edit/'.$value->no_urutkunjungan.'/'.$value->nokunjlab.'">
            <button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Analisa">
              <i class="fa fa-edit"></i> Edit
            </button>
          </a>';
        }
      }else{
        if ($value->status==1) {
          $button_edit .= '<a href="'.base_url().'KunjunganLab/periksa/'.$value->no_urutkunjungan.'/'.$value->nokunjlab.'">
            <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analisa">
              <i class="fa fa-flask"></i> Analisa
            </button>
          </a>';
        }
      }
      $button_edit .= '<a href="'.base_url().'KunjunganLab/cetak_hasil/'.$value->no_urutkunjungan.'/'.$value->nokunjlab.'" target="_blank">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cetak Hasil">
          <i class="fa fa-print"></i>
        </button>
      </a>';

      echo "
      <tr>
        <td>$no</td>
        <td>$value->pasien_noRM</td>
        <td>$value->namapasien</td>
        <td><h4><span class=\"badge badge-pill $warna \">$value->tujuan_pelayanan</span></h4></td>
        <td>".date("H:i:s",strtotime($value->jam))."</td>
        <td>".$sts_input."</td>
        <td>".$status."</td>
        <td>".$button_edit."
        </td>
      </tr>";
    }
  }

  function periksa()
  {
    $id     = $this->uri->segment(3);
    $nokun  = $this->uri->segment(4);
    $data = array(
    'body'        => 'KunjunganLab/periksa',
    'kunjungan'   => $this->ModelKunjunganLab->data_kunjungan_lab($nokun)->row_array(),
    'lab'         => $this->ModelKunjunganLab->periksa_lab($nokun)->result()
    );
    $this->load->view('index',$data);
  }

  function edit()
  {
    $id     = $this->uri->segment(3);
    $nokun  = $this->uri->segment(4);
    $data = array(
    'body'        => 'KunjunganLab/edit',
    'kunjungan'   => $this->ModelKunjunganLab->data_kunjungan_lab($nokun)->row_array(),
    'lab'         => $this->ModelKunjunganLab->periksa_lab($nokun)->result()
    );
    $this->load->view('index',$data);
  }


  function input_labkun()
  {
    $nokunlab = $this->input->post('nokunlab');
    $idlab        = $this->input->post('idlab');
    $kodelab        = $this->input->post('kodelab');
    $id           = $this->input->post('id');
    $harga        = $this->input->post('hrg');
    $nilai_normal = $this->input->post('nilai_normal');
    $hasil        = $this->input->post('hasil');
    $nama_lab        = $this->input->post('nama_lab');
    $analis  = $_SESSION['karyawan'];
    $nik = $this->input->post("nik");
    $data_knj = $this->ModelKunjunganLab->get_kunj($idlab);
    $nokun = $data_knj['no_urutkunjungan'];
    $data_kunjungan = $this->db->get_where("kunjungan",array("no_urutkunjungan"=>$nokun))->row_array();
    $count = count($id);
    $status = 0;
    $total_harga = 0;
    $temp = array();
    for ($i=0; $i < $count; $i++) {
      $data = array(
      'hasil'         => $hasil[$i],
      'nilainormal'   => $nilai_normal[$i],
      'opr'           => $_SESSION['nik'],
      'jam'           => date('H:i:s'),
      'harga'         => $harga[$i],
      'komisi'        => $harga[$i],
      // 'id'        => $id[$i]
      );
      // array_push($temp,$data);
      $this->db->where('iddetaillab', $id[$i]);
      $insert = $this->db->update('detaillab', $data);
      $this->db->reset_query();
      // $insert = true;
      if ($insert == true) {
        $status = 1;
      }else {
        $status = 0;
      }
      $total_harga += $harga[$i];
    }
    $norm = $data_knj['pasien_noRM'];
    $kode = $this->ModelAkuntansi->generete_notrans();
    $jam = date('Y-m-d H:i:s');
    if ($data_knj['acc_ranap']==1) {
      if ($data_kunjungan['sumber_dana']==7 || $data_kunjungan['sumber_dana']==9) {
        $norek = "412.005";
      }else{
        $norek = "412.002";
      }
    }else{
      $tupel = $data_kunjungan['tupel_kode_tupel'];
      if ($tupel=='IGD') {
        if ($data_kunjungan['sumber_dana']==7 || $data_kunjungan['sumber_dana']==9) {
          $norek = "412.006";
        }else{
          $norek = "412.003";
        }
      }else{
        if ($data_kunjungan['sumber_dana']==7 || $data_kunjungan['sumber_dana']==9) {
          $norek = "412.004";
        }else{
          $norek = "412.001";
        }
      }
    }

    if ($data_kunjungan['sumber_dana']==7) {
      $bridging_mcu = array(
      "kdMCU"=> 0, //default
      "noKunjungan"=> $data_kunjungan['nokun_bridging'],
      "kdProvider"=> "0189B016",
      "tglPelayanan"=> date('d-m-Y', strtotime($this->input->post('tanggal'))),
      "tekananDarahSistole"=> 0, //default
      "tekananDarahDiastole"=> 0, //default
      "radiologiFoto"=> null, //default
      "darahRutinHemo"=> 0, //default
      "darahRutinLeu"=> 0, //default
      "darahRutinErit"=> 0, //default
      "darahRutinLaju"=> 0, //default
      "darahRutinHema"=> 0, //default
      "darahRutinTrom"=> 0, //default
      "lemakDarahHDL"=> 0, //default
      "lemakDarahLDL"=> 0, //default
      "lemakDarahChol"=> 0, //default
      "lemakDarahTrigli"=> 0, //default
      "gulaDarahSewaktu"=> 0, //default
      "gulaDarahPuasa"=> 0, //default
      "gulaDarahPostPrandial"=> 0, //default
      "gulaDarahHbA1c"=> 0, //default
      "fungsiHatiSGOT"=> 0, //default
      "fungsiHatiSGPT"=> 0, //default
      "fungsiHatiGamma"=> 0, //default
      "fungsiHatiProtKual"=> 0, //default
      "fungsiHatiAlbumin"=> 0, //default
      "fungsiGinjalCrea"=> 0, //default
      "fungsiGinjalUreum"=> 0, //default
      "fungsiGinjalAsam"=> 0, //default
      "fungsiJantungABI"=> 0, //default
      "fungsiJantungEKG"=> null, //default
      "fungsiJantungEcho"=> null, //default
      "funduskopi"=> null, //default
      "pemeriksaanLain"=> null, //default
      "keterangan"=> null //default
      );
      $detail_kunjungan_lab = $this->ModelKunjunganLab->detail_kunjungan_lab($nokunlab)->result();
      for ($i=0; $i <sizeof($detail_kunjungan_lab) ; $i++) {
        if (in_array($detail_kunjungan_lab[$i]->pcare, $bridging_mcu)) {
          $bridging_mcu[$detail_kunjungan_lab[$i]->pcare] = intval($detail_kunjungan_lab[$i]->hasil); //replace element array default dengan nilai terbaru dari database.
        }
      }
      $bridge = PcareV4("MCU","POST","text/plain",json_encode($bridging_mcu));
    }

    $jurnal4 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => $norek,
      'debet' => 0,
      'kredit' => $total_harga,
      'pasien_noRM' => $norm,
      'no_urut' => $nokun,
      'no_transaksi' => $kode,
      'jam' => $jam
    );
    $jurnal3 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
      'norek' => '113.001',
      'debet' => $total_harga,
      'kredit' => 0,
      'pasien_noRM' => $norm,
      'no_urut' => $nokun,
      'no_transaksi' => $kode,
      'jam' => $jam
    );
    if ($data_kunjungan['sumber_dana']==7 || $data_kunjungan['sumber_dana']==9) {
      $jurnal3['norek'] = "213.002";
    }
    $this->db->insert("jurnal",$jurnal3);
    $this->db->insert("jurnal",$jurnal4);

    if ($status == 1) {
      $this->db->where('nokunjlab', $idlab);
      $this->db->update('labkunjungan', array('status' => 2,'lab_out'=>date("Y-m-d h:i:s"),'analis' => $_SESSION['nik']));
      if ($data_kunjungan['sumber_dana']==7 && $bridge->metaData->code == 201) {
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan dan Bridging'));
        redirect(base_url()."KunjunganLab");
      }else{

        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        redirect(base_url()."KunjunganLab");
      }

    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      redirect(base_url()."KunjunganLab");
    }
  }
  public function cetak_hasil()
  {
    $id = $this->uri->segment(4);
    $catatan = $this->db->get("catatan_covid")->result();
    $data = array(
    'hasil_lab' => $this->ModelKunjunganLab->periksa_lab($id)->result(),
    'data_lab' => $this->ModelKunjunganLab->data_kunjungan_lab($id)->row_array(),
    'data_lab_2' => $this->ModelKunjunganLab->data_kunjungan_lab_2($id)->row_array(),
    'dokter' => $this->db->get("penanggung_jawab")->row_array(),
    'catatan' => $catatan
    // 'data_pasien' => $this->ModelKunjunganLab->get_data_pasien($id)
    );
    // die(print_r($catatan));
    $this->load->view('KunjunganLab/hasil2',$data);
  }
  public function hapus($id1=null,$id2=null,$idlab=null,$url){
    $nourut = $this->db->get_where("detaillab",array("iddetaillab"=>$idlab))->row_array();
    $this->db->where("iddetaillab",$idlab);
    $this->db->delete("detaillab");
    $nums = $this->db->get_where("detaillab",array("nourutlab"=>$nourut['nourutlab']))->num_rows();
    if ($nums==0) {
      $this->db->where("nokunjlab",$nourut['nourutlab']);
      $this->db->delete("labkunjungan");
      $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil Menghapus Data"));
      redirect(base_url()."KunjunganLab");
    }else{
      $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil Menghapus Data"));
      redirect(base_url()."KunjunganLab/".$url."/".$id1."/".$id2);
    }

  }

  public function hapus_kunjungan($id){
    $this->db->where_in("nourutlab",$id);
    $this->db->delete("detaillab");
    $this->db->where("nokunjlab",$id);
    $this->db->delete("labkunjungan");
    $this->session->set_flashdata("notif",$this->Notif->berhasil('Berhasil hapus data'));
    redirect(base_url()."KunjunganLab");
  }

}
?>
