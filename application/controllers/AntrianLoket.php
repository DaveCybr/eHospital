<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AntrianLoket extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelAdmisi');
  }

  public function index(){

		$this->load->view('AntrianLoket/antrian');
  }

  public function list(){
    $data = array(
      'body' => 'AntrianLoket/list',
      'baru_belum' => $this->ModelAdmisi->get_antrian('B',0),
      'baru_sudah' => $this->ModelAdmisi->get_antrian('B',1),
      'lama_belum' => $this->ModelAdmisi->get_antrian('L',0),
      'lama_sudah' => $this->ModelAdmisi->get_antrian('L',1 ),
    );
		$this->load->view('index',$data);
  }

  public function baru(){
      $antrian = $this->db->limit(1,0)->order_by('idantrian_loket','DESC')->get_where('antrian_loket',array('tanggal'=>date("Y-m-d"),'jenis_kunjungan'=>'B'))->row_array();
      // die(var_dump($antrian));
      if (!empty($antrian)) {
        // code...
        $no = $antrian['no_antrian']+1;
      }else{
        $no=1;
      }
      $data= array(
        'tanggal' => date("Y-m-d"),
        'no_antrian' => $no,
        'jenis_kunjungan' => 'B',
      );
      $this->db->insert('antrian_loket',$data);
      redirect(base_url()."AntrianLoket");
  }
  public function lama(){
      $antrian = $this->db->limit(1,0)->order_by('idantrian_loket','DESC')->get_where('antrian_loket',array('tanggal'=>date("Y-m-d"),'jenis_kunjungan'=>'L'))->row_array();
      // die(var_dump($antrian));
      if (!empty($antrian)) {
        // code...
        $no = $antrian['no_antrian']+1;
      }else{
        $no=1;
      }
      $data= array(
        'tanggal' => date("Y-m-d"),
        'no_antrian' => $no,
        'jenis_kunjungan' => 'L',
      );
      $this->db->insert('antrian_loket',$data);
      redirect(base_url()."AntrianLoket");
  }
  public function setuju(){
    $nokun = $this->uri->segment(3);
    $nama_wali = $this->input->post("namawali");
    $ktp = $this->input->post("ktp");
    $alamat = $this->input->post("alamat");
    $telp  = $this->input->post("telp");
    $kamar = $this->input->post("kamar");
    $data = array(
      'wali_ranap' => $nama_wali,
      'ktp_wali' => $ktp,
      'acc_ranap' => 1,
      'alamat_wali'=>$alamat,
      'tlp_wali' => $telp,
      'ttd_wali' => $this->input->post('signature'),
      'tempat_tidur_no_tt' => $kamar,
      'sts_wali' => $this->input->post('setuju'),
    );
    $this->db->where('no_urutkunjungan',$nokun);
    $this->db->update('kunjungan',$data);
    $this->db->where('no_tt',$kamar);
    $this->db->update('tempat_tidur',array('status_terisi'=>1));
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Proses admisi berhasil dilakukan"));
    redirect(base_url()."Admisi");
  }

  public function signature(){
    $data = array(
      'kunjungan' => $this->ModelAdmisi->get_data(null)
    );
    // die(var_dump($data['kunjungan']));
    $this->load->view("Admisi/signature",$data);
  }
  public function panggil(){
    $antrian = $this->input->post('antrian');
    // $antrian = "OZO-1";
    // $signature = $this->input->post('ttd');
    // // echo $signature;
    // $hit = $this->db->get_where('kunjungan',array('no_urutkunjungan'=>$nokun))->num_rows();
    // if ($hit == 0) {
    //   $this->session->set_flashdata('pesan',"0");
    //   redirect(base_url()."Admisi/signature");
    // }else{
    $baru = explode("-",$antrian);
    $date = date("Y-m-d");
    $cek = $this->db->get_where("antrian",array('tanggal'=>$date))->num_rows();
    $no = $baru[1];
    if ($baru[0]=='UMU') {
      $data = array(
        'UMU' => $no
      );
    }
    if ($baru[0]=='OBG') {
      $data = array(
        'OBG' => $no
      );
    }
    if ($baru[0]=='INT') {
      $data = array(
        'INTERNIS' => $no
      );
    }
    if ($baru[0]=='GIG') {
      $data = array(
        'GIG' => $no
      );
    }
    if ($baru[0]=='OZO') {
      $data = array(
        'OZO' => $no
      );
    }
    if ($cek > 0) {
      $this->db->where("tanggal",$date);
      $this->db->update("antrian",$data);
    }else{
      $data['tanggal'] = $date;
      $this->db->insert('antrian',$data);
    }
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
      $data = array(
        'no_antrian' => $antrian
        // 'nokun' => $nokun
      );
      $pusher->trigger('ci_pusher3', 'my-event3',$data);
      echo "Panggilan dilakukan";
    //
    //   $this->session->set_flashdata('pesan',"1");
    //   redirect(base_url()."Admisi/signature");
    // }
  }
  public function print($id=null){
    $data_pasien = $this->ModelAdmisi->get_detail($id);
    $data = array(
      'data' => $data_pasien,
      'pasien' => $this->ModelAdmisi->get_pasien($id),
      'rujuk' => $this->db->get_where('rujukan_internal',array('kunjungan_no_urutkunjungan'=>$id,'tujuan_poli'=>"RANAP"))->row_array()
    );
    $this->load->view('Admisi/print2',$data);
  }

}
