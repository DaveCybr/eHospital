<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelAkuntansi');
  }

  public function index(){
    $data = array(
      'body'      => "Jurnal/index",
      'bank' => $this->ModelAkuntansi->get_bank(),
      'mbesar' => $this->ModelAkuntansi->get_mbesar()
    );
    $this->load->view('index',$data);
  }
  public function list(){
    $data = array(
      'body'      => "Jurnal/list",
      'jurnal' => $this->ModelAkuntansi->get_jurnal(),
    );
    if (isset($_POST['submit'])) {
      $from = $this->input->post('tgl_mulai');
      $till = $this->input->post('tgl_sampai');
      $data['mulai'] = $from;
      $data['sampai'] = $till;
      $data['jurnal'] = $this->ModelAkuntansi->get_jurnal1($from,$till);
    }
    $this->load->view('index',$data);
  }

  public function input(){
    $tanggal = $this->input->post("tanggal");
    $norek_detail = $this->input->post("norek_detail");
    $debet = $this->input->post("debet");
    $kredit = $this->input->post("kredit");

    $kode = $this->ModelAkuntansi->generete_notrans();
    $total = 0;
    $jam = date('h:i:s');
    $keterangan = $this->input->post("keterangan");
    for ($i=0; $i <count($norek_detail) ; $i++) {
      $data = array(
        'tanggal' => $tanggal,
        'norek' => $norek_detail[$i],
        'keterangan'  => $keterangan,
        'debet' => $debet[$i],
        'kredit' => $kredit[$i],
        'jam' => $jam,
        'no_transaksi' => $kode
      );
      $total += $jumlah_detail[$i];
      $this->db->insert("jurnal",$data);
    }
    $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil menyimpan data"));
    redirect(base_url()."Jurnal");
  }

}
?>
