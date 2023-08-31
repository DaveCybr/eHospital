<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelPiutang');
    $this->load->model('ModelKunjungan');
    $this->load->model('ModelAkuntansi');
  }

  public function index(){
    $data = array(
      'body'            => 'Piutang/list',
      'piutang'       => $this->ModelPiutang->get_data(),
    );
		$this->load->view('index',$data);
  }
  public function bayar(){
    $no_rm = $this->input->post("no_rm");
    $nokun = $this->input->post('nokun');
    $kode_akun = $this->ModelAkuntansi->generete_notrans();
    $jumlah_bayar =  $this->input->post('jumlah_bayar');
    $data_kunjungan = $this->ModelKunjungan->get_data_edit($nokun);
    $tupel = $data_kunjungan['tupel_kode_tupel'];
    $data = array(
      'tanggal' => date("Y-m-d"),
      'jumlah_bayar' =>$jumlah_bayar,
      'kunjungan_no_urutkunjungan' => $nokun,
    );
    $this->db->insert("piutang_pasien",$data);
    if ($tupel=='UMU') {
      $norek = "40001";
    }else if($tupel=='GIG'){
      $norek = "40002";
    }else if($tupel=="INT"){
      $norek = "40003";
    }else if($tupel=="OBG"){
      $norek = "40004";
    }else if($tupel == "OZO"){
      $norek = "40005";
    }else if($tupel=="IGD"){
      $norek = "40006";
    }else{
      $norek = NULL;
    }
    $jurnal = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Pembayaran piutang nomor kunjungan '.$nokun,
      'norek' => $norek,
      'debet' => $jumlah_bayar,
      'kredit' => 0,
      'no_transaksi' => $kode_akun,
      'jam' => date("H:i:s"),
      'no_urut' => $nokun,
      'pasien_noRM' =>$no_rm
    );
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Pembayaran piutang nomor kunjungan '.$nokun,
      'norek' => '10201',
      'debet' => 0,
      'kredit' => $jumlah_bayar,
      'no_transaksi' => $kode_akun,
      'jam' => date("H:i:s"),
      'no_urut' => $nokun,
      'pasien_noRM' =>$no_rm
    );
    $this->db->insert("jurnal",$jurnal);
    $this->db->insert("jurnal",$jurnal1);
    $this->session->set_flashdata("notif",$this->Notif->berhasil("Pembayaran berhasil dilakukakn"));
    redirect(base_url()."Piutang/");
  }



}
