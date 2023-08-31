<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KBDokter extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelPegawai");
    $this->load->model("ModelKBinaan");
  }

  function index()
  {
    $data = array(
      'body' => 'KeluargaBinaan/list_dokter',
      'pegawai'=> $this->ModelPegawai->get_data(),
      'dokter'=> $this->ModelKBinaan->getDokter()->result(),
     );
    $this->load->view('index', $data);
  }

  public function tambah_dokter($iddokter)
  {
    $data = array(
      'pegawai_NIK' => $iddokter,
    );
    if ($this->ModelKBinaan->getDokter($iddokter)->num_rows() <= 0) {
      if ($this->db->insert("kb_dokter", $data)) {
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      }else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
      }
    }else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Data Sudah Ada'));
    }
    redirect("K_Binaan/KBDokter");
  }

  function list_perawat($iddokter)
  {
    $data = array(
      'body' => 'KeluargaBinaan/list_perawat',
      'pegawai' => $this->ModelPegawai->get_data(),
      'dokter'  => $this->ModelKBinaan->getDokterPJ($iddokter)->row_array(),
      'perawat' => $this->ModelKBinaan->getPerawat($iddokter)->result(),
     );
    $this->load->view('index', $data);
  }

  public function tambah_perawat($idperawat, $iddokter)
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

  function HapusDokter($id)
  {
    if ($this->db->where("pegawai_NIK", $id)->delete("kb_dokter")) {
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Menghapus Data'));
    }else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Menghapus Data'));
    }
    redirect("K_Binaan/KBDokter");
  }

  function HapusPerawat($id, $iddokter)
  {
    if ($this->db->where("pegawai_NIK", $id)->delete("kb_perawat")) {
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Menghapus Data'));
    }else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Menghapus Data'));
    }
    redirect("K_Binaan/KBDokter/list_perawat/".$iddokter);
  }

}
