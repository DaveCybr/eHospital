<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->view("vendor/autoload.php");
    $this->load->model("ModelChat");
    $this->load->model("ModelPasien");
    $this->load->model("ModelPegawai");
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelAPO");
  }

  function Chat($norm=null, $no_kunjungan=null)
  {
    $tgl = date("Y-m-d");
    $poli = $_SESSION['poli'];
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('jenis_pasien', 'kunjungan.sumber_dana = jenis_pasien.kode_jenis',"left");
    $this->db->order_by('no_antrian', 'ASC');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    if ($poli == null) {
      $this->db->where(array('sudah' => 0, 'tgl'=>$tgl,'acc_ranap !='=>1));
    }else {
      if ($poli=='IGD' || $poli=='GIG') {
        $this->db->where(array('sudah' => 0, 'tgl'=>$tgl, 'tupel_kode_tupel' => $poli ,'acc_ranap !='=>1));
      }else{
        $this->db->where(array('sudah' => 0, 'tgl'=>$tgl, 'acc_ranap !='=>1));
        $this->db->group_start()
                ->where('tupel_kode_tupel !=','IGD')
                ->or_where('tupel_kode_tupel !=','GIG')
                ->group_end();
      }
    }
    $kunjungan = $this->db->get('kunjungan')->result();
    $data = array(
      'body'            => 'APO/Chat',
      'chat'            => $this->ModelChat->getKonsul($norm, $no_kunjungan)->result(),
      'riwayat'         => $this->ModelChat->getKonsulRiwayat($norm)->result(),
      'no_kunjungan'    => $no_kunjungan,
      'norm'            => $norm,
      'kunjungan'       => $kunjungan,

    );
    // die(var_dump($data['kunjungan_sudah']));
		$this->load->view('APO/indexChat',$data);
  }

  function statusChat($norm, $no_kunjungan, $status)
  {
    $this->db->where("pegawai_NIK", $_SESSION["nik"]);
    $this->db->update("status_dokter", array('status_online' => $status ));
    redirect("APO/Konsultasi/Chat/".$norm."/".$no_kunjungan);
  }

  function listStatusDokter($tupel)
  {
    $dokter = $this->ModelAPO->getStatusDokter($tupel);
    if ($dokter->num_rows() > 0) {
      $message = array(
        'status'            => 200,
        'message'           => "Data success"
      );
    }else{
      $message = array(
        'status'            => 500,
        'message'           => "Data Dokter Kosong"
      );
    }
    echo json_encode(array('response' => $dokter->result(), 'message'=>$message));
  }

  function ChatPasien($norm, $no_kunjungan)
  {
    $tgl = date('Y-m-d');
    $konsul = $this->ModelChat->getKonsul($norm,$no_kunjungan);
    $data = array(
      'body'            => 'APO/Pasien/Chat',
      'chat'            => $konsul->result(),
      'no_kunjungan'    => $no_kunjungan,
      'norm'            => $norm,

    );
    // die(var_dump($data['kunjungan_sudah']));
		$this->load->view('APO/Pasien/index',$data);
  }

  public function getChat($norm, $no_kunjungan)
  {
    $chat = $this->ModelChat->getKonsul($norm, $no_kunjungan);
    $data = array();
    foreach ($chat->result() as $value) {
      $ar = array(
        'text' => $value->text,
        'status' => $value->status,
        'waktui' => date("H:i:s d-m-Y", strtotime($value->waktu)),
        'nama_pasien' => $this->ModelPasien->get_data_edit($value->pasien_noRM)->row_array()["namapasien"],
        'nama_pegawai' => $this->ModelPegawai->get_data_edit($value->pegawai_NIK)["nama"],
       );
       array_push($data, $ar);
    }
    if ($chat->num_rows() > 0) {
      $data = array(
        'status'            => 1,
        'data'              => $data,
        'pesan'             => "Berhasil",
      );
      echo json_encode($data);
    }else{
      $data = array(
        'status'            => 0,
        'data'              => $chat->result(),
        'pesan'             => "Tidak Ada Chat",
      );
      echo json_encode($data);
    }

  }

  public function pesanDokter()
  {
    $data = array(
      'pegawai_NIK' => $_SESSION['nik'],
      'pasien_noRM' => $this->input->post("pasien_noRM"),
      'text'        => $this->input->post("text"),
      'waktu'        => date("Y-m-d H:i:s"),
      'status'      => "2",
      'no_kunjungan'=> $this->input->post("no_kunjungan"),
    );
    if ($this->db->insert("chat_konsul", $data)) {
      $this->db->where("pasien_noRM", $this->input->post("pasien_noRM"));
      $this->db->update("chat_konsul", array('status_baca' => "0"));
          $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
          );
          $pusher = new Pusher\Pusher(
            '4f343bacaa7b3063150d',
            '8b7ea5bf2355c1b85330',
            '975255',
            $options
          );
          $data["jam"] = date("H:i:s");
          $data["tgl"] = date("d-m-Y");
          $data["waktui"] = date("H:i:s d-m-Y");
          $data["nama_pegawai"] = $this->ModelPegawai->get_data_edit($_SESSION['nik'])["nama"];
          $data["nama_pasien"] = $this->ModelPasien->get_data_edit($this->input->post("pasien_noRM"))->row_array()["namapasien"];
          $data["pasien_noRM"] = $this->input->post("pasien_noRM");
          $pusher->trigger('my-Pasien', $this->input->post("pasien_noRM"), $data);
          echo json_encode($data);
        }else {
          echo "0";
        }
  }

  public function pesanPasien()
  {
    $data = array(
      'pegawai_NIK' => "0",
      'pasien_noRM' => $this->input->post("pasien_noRM"),
      'text'        => $this->input->post("text"),
      'waktu'        => date("Y-m-d H:i:s"),
      'status'      => "1",
      'no_kunjungan'=> $this->input->post("no_kunjungan"),
    );
    if ($this->db->insert("chat_konsul", $data)) {
      $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        '4f343bacaa7b3063150d',
        '8b7ea5bf2355c1b85330',
        '975255',
        $options
      );
      $data["jam"] = date("H:i:s");
      $data["tgl"] = date("d-m-Y");
      $data["waktui"] = date("H:i:s d-m-Y");
      $data["nama_pasien"] = $this->ModelPasien->get_data_edit($this->input->post("pasien_noRM"))->row_array()["namapasien"];
      $pusher->trigger('E-klinik', "my-konsul", $data);
      echo json_encode($data);
    }else {
      echo "0";
    }
  }

  public function pesanPasienAwal($norm,$nokun,$nik)
  {
    $data = array(
      'pegawai_NIK' => $nik,
      'pasien_noRM' => $norm,
      'text'        => "Halo Dokter",
      'waktu'        => date("Y-m-d H:i:s"),
      'status'      => "1",
      'no_kunjungan'=> $nokun,
    );
    if ($this->db->insert("chat_konsul", $data)) {
      $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        '4f343bacaa7b3063150d',
        '8b7ea5bf2355c1b85330',
        '975255',
        $options
      );
      $data["jam"] = date("H:i:s");
      $data["tgl"] = date("d-m-Y");
      $data["waktui"] = date("H:i:s d-m-Y");
      $data["nama_pasien"] = $this->ModelPasien->get_data_edit($this->input->post("pasien_noRM"))->row_array()["namapasien"];
      $pusher->trigger('E-klinik', "my-konsul", $data);
      redirect("APO/Konsultasi/ChatPasien/".$norm."/".$nokun);
    }else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Memulai Konsultasi'));
      redirect("APO/Home");
    }
  }



}
