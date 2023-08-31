<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelAkuntansi');
  }

  public function index(){
    $data = array(
      'body'            => 'Admisi/list',
      'kunjungan'       => $this->ModelAdmisi->get_data(null),
      'kunjungan_sudah' => $this->ModelAdmisi->get_data_sudah(null),

    );
		$this->load->view('antrian',$data);
  }

  public function masuk(){
    $data = array(
      'body'      => "Kas/masuk",
      'kas' => $this->ModelAkuntansi->get_kas(),
      'mbesar' => $this->ModelAkuntansi->get_mbesar()
    );
    $this->load->view('index',$data);
  }
  public function keluar(){
    $data = array(
      'body'      => "Kas/keluar",
      'kas' => $this->ModelAkuntansi->get_kas(),
      'mbesar' => $this->ModelAkuntansi->get_mbesar()
    );
    $this->load->view('index',$data);
  }
  public function input_kasmasuk(){
    $tanggal = $this->input->post("tanggal");
    $norek_utama = $this->input->post("norek_utama");
    $norek_detail = $this->input->post("norek_detail");
    $jumlah_detail = $this->input->post("jumlah_detail");
    $kode = $this->ModelAkuntansi->generete_notrans();
    $total = 0;
    $jam = date('h:i:s');
    $keterangan = $this->input->post("keterangan");
    for ($i=0; $i <count($norek_detail) ; $i++) {
      $data = array(
        'tanggal' => $tanggal,
        'norek' => $norek_detail[$i],
        'keterangan'  => $keterangan,
        'debet' => 0,
        'kredit' => $jumlah_detail[$i],
        'jam' => $jam,
        'no_transaksi' => $kode
      );
      $total += $jumlah_detail[$i];
      $this->db->insert("jurnal",$data);
    }
    $this->db->reset_query();
    $data = array(
      'tanggal' => $tanggal,
      'norek' => $norek_utama,
      'keterangan'  => $keterangan,
      'debet' => $total,
      'kredit' => 0,
      'jam' => $jam,
      'no_transaksi' => $kode
    );
    $this->db->insert("jurnal",$data);
    $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil menyimpan data"));
    redirect(base_url()."Kas/masuk");
  }
  public function input_kaskeluar(){
    $tanggal = $this->input->post("tanggal");
    $norek_utama = $this->input->post("norek_utama");
    $norek_detail = $this->input->post("norek_detail");
    $jumlah_detail = $this->input->post("jumlah_detail");
    $kode = $this->ModelAkuntansi->generete_notrans();
    $total = 0;
    $jam = date('h:i:s');
    $keterangan = $this->input->post("keterangan");
    for ($i=0; $i <count($norek_detail) ; $i++) {
      $data = array(
        'tanggal' => $tanggal,
        'norek' => $norek_detail[$i],
        'keterangan'  => $keterangan,
        'kredit' => 0,
        'debet' => $jumlah_detail[$i],
        'jam' => $jam,
        'no_transaksi' => $kode
      );
      $total += $jumlah_detail[$i];
      $this->db->insert("jurnal",$data);
    }
    $this->db->reset_query();
    $data = array(
      'tanggal' => $tanggal,
      'norek' => $norek_utama,
      'keterangan'  => $keterangan,
      'kredit' => $total,
      'debet' => 0,
      'jam' => $jam,
      'no_transaksi' => $kode
    );
    $this->db->insert("jurnal",$data);
    $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil menyimpan data"));
    redirect(base_url()."Kas/keluar");

  }

}
?>
