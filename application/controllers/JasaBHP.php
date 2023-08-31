<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JasaBHP extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelJabatan');
    $this->load->model('ModelUsers');
    $this->load->model("ModelJasaBHP");
    $this->load->model("ModelJasaPelayanan");
    $this->load->model("ModelObat");
  }

  function index()
  {
    $data = array(
      'body'      => "JasaBHP/list",
      'bhp'   => $this->ModelJasaBHP->get_data()
    );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'body'      => "JasaBHP/input",
      'form' => "JasaBHP/form",
      'jasa_pelayanan'   => $this->ModelJasaPelayanan->get_data(),
      'obat' => $this->ModelObat->get_data()

    );
    $this->load->view('index', $data);
  }

  function edit($kode)
  {
    $data = array(
      'body'      => "JasaBHP/edit",
      'form' => "JasaBHP/form_edit",
      'jasa_pelayanan'   => $this->ModelJasaPelayanan->get_data(),
      'obat' => $this->ModelObat->get_data(),
      'japel' => $this->ModelJasaPelayanan->get_data_edit($kode)->row_array(),
      'bhp' => $this->ModelJasaBHP->get_edit($kode)


    );
    $this->load->view('index', $data);
  }

  function insert()
  {
    $japel = $this->input->post("id_japel");
    $kode_obat = $this->input->post("kode_obat");
    $jumlah = $this->input->post("jumlah");
    if (!empty($kode_obat)) {
      for ($i=0; $i < count($kode_obat) ; $i++) {
        $data = array(
          'obat_idobat'     => $kode_obat[$i],
          'jasa_pelayanan_kode_jasa'   => $japel,
          'jumlah'       => $jumlah[$i]
        );
        $this->db->insert('tindakan_bhp', $data);
      }
      $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil menyimpan data"));
      redirect(base_url().'JasaBHP');
    }else{
      $this->session->set_flashdata("notif",$this->Notif->gagal("Silahkan pilih bahan"));
      redirect(base_url().'JasaBHP/input');
    }
  }

  function update()
  {
    $japel = $this->input->post("id_japel");
    $kode_obat = $this->input->post("kode_obat");
    $jumlah = $this->input->post("jumlah");
    if (!empty($kode_obat)) {
      $this->db->where_in("jasa_pelayanan_kode_jasa",$japel);
      $this->db->delete("tindakan_bhp");
      for ($i=0; $i < count($kode_obat) ; $i++) {
        $data = array(
          'obat_idobat'     => $kode_obat[$i],
          'jasa_pelayanan_kode_jasa'   => $japel,
          'jumlah'       => $jumlah[$i]
        );
        $this->db->insert('tindakan_bhp', $data);
      }
      $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil menyimpan data"));
      redirect(base_url().'JasaBHP');
    }else{
      $this->session->set_flashdata("notif",$this->Notif->gagal("Silahkan pilih bahan"));
      redirect(base_url().'JasaBHP/input');
    }
  }

  function hapus()
  {
    $id = $this->input->post("id");
    $this->db->where_in('jasa_pelayanan_kode_jasa', $id);
    $this->db->delete('tindakan_bhp');
    $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil Hapus Data"));
    redirect(base_url().'JasaBHP');
  }



}
