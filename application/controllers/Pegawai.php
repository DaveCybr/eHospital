<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Pegawai extends CI_Controller{

    public $data_pegawai = array();

    public function __construct()
    {
      parent::__construct();
      $this->data_pegawai = array(
        'NIK'             => $this->input->post('nik'),
        'nama'            => $this->input->post('nama'),
        'status_karyawan' => $this->input->post('status_karyawan'),
        'jabatan'         => $this->input->post('jabatan'),
        'alamat'          => $this->input->post('alamat'),
        'kota'            => $this->input->post('kota'),
        'tgl_lahir'       => $this->input->post('tgl_lahir'),
        'telepon'         => $this->input->post('telepon'),
        'tgl_masuk'       => $this->input->post('tgl_masuk'),
        'tgl_keluar'      => $this->input->post('tgl_keluar'),
        'gapok'           => $this->input->post('gapok'),
        'uang_makan'      => $this->input->post('uang_makan'),
        'uang_bensin'     => $this->input->post('uang_bensin'),
        'tunjangan_keluarga'=> $this->input->post('tunjangan_keluarga'),
        'tunjangan_profesi' => $this->input->post('tunjangan_profesi'),
        'tunjangan_jabatan' => $this->input->post('tunjangan_jabatan'),
        'tunjangan_bpjskes' => $this->input->post('tunjangan_bpjskes'),
        'tunjangan_bpjstk'  => $this->input->post('tunjangan_wbpjstk'),
        'potongan_bpjskes'  => $this->input->post('potongan_bpjskes'),
        'potongan_bpjstk'   => $this->input->post('potongan_bpjstk'),
        'tgl_isi'           => date('Y-m-d'),
        'jam_isi'           => date('H:i:s'),
        'operator'          => $_SESSION['id_login']
      );

      $this->load->model("ModelPegawai");
      $this->load->model("ModelUsers");
    }

    function index()
    {
      $data = array(
        'body' => 'Pegawai/list',
        'pegawai'=> $this->ModelPegawai->get_data()
       );
      $this->load->view('index', $data);
    }

    function input()
    {
      $data = array(
        'form' => 'Pegawai/form',
        'body' => 'Pegawai/input',
       );
      $this->load->view('index', $data);
    }

    public function insert()
    {
      if ($this->db->insert('pegawai', $this->data_pegawai)) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect('Pegawai');
      } else {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      }

    }

    public function edit()
    {
      $nik = $this->uri->segment(3);
      $data = array(
        'form'      => 'Pegawai/form',
        'body'      => 'Pegawai/edit',
        'pegawai'   => $this->ModelPegawai->get_data_edit($nik),
        'user'      => $this->ModelUsers->get_account($nik)->result(),
       );
      $this->load->view('index', $data);
    }

    public function update()
    {
      echo $nik = $this->input->post('nik');
      $this->db->where('NIK',$nik);
      if ($this->db->update('pegawai', $this->data_pegawai)) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect('Pegawai');
      } else {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      }

    }

    function delete()
    {
      $id = $this->input->post('id');
      $cek = $this->db->where_in('pegawai_NIK', $id)->get('user')->num_rows();
      if ($cek>0) {
          $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Pegawai, Data masih Terrelasi!!!'));

              // $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Pegawai, Data masih Terrelasi!!!'));
        redirect('Pegawai');
      }else{
        $this->db->where_in('NIK', $id);
        if ($delete = $this->db->delete('pegawai')) {
            $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Pegawai'));
        }else{
            $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Pegawai, Data masih Terrelasi!!!'));
        };
        redirect('Pegawai');
      }

    }

  }
?>
