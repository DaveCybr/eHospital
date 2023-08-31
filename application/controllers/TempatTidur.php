<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class TempatTidur extends CI_Controller{
    private $data_tt = array();

    public function __construct()
    {
      parent::__construct();
      $this->data_tt = array(

        'no_tt'             => $this->input->post('no_tt'),
        'nama_kamar'        => $this->input->post('nama_kamar'),
        'kelas'             => $this->input->post('kelas'),
        'tarif'             => $this->input->post('tarif'),
        'biaya_makan'       => $this->input->post('biaya_makan'),
        'biaya_air'         => $this->input->post('biaya_air'),
        'biaya_listrik'     => $this->input->post('biaya_listrik'),
        'biaya_kebersihan'  => $this->input->post('biaya_kebersihan'),
        'biaya_laundry'     => $this->input->post('biaya_laundry'),
        'biaya_perawatan'   => $this->input->post('biaya_perawatan'),
        'status_terisi'     => $this->input->post('status_terisi'),
        'biaya_makan_penunggu' => $this->input->post('biaya_makan_penunggu'),

      );
          $this->load->model("ModelTempatTidur");


    }

    function index()
    {
      $data = array(
        'body' => 'TempatTidur/list',
        'tempat_tidur'=> $this->ModelTempatTidur->get_data()
       );
      $this->load->view('index', $data);
    }

    function input()
    {
      $data = array(
        'form' => 'TempatTidur/form',
        'body' => 'TempatTidur/input',
        //'tempat_tidur' => $this->ModelTempatTidur->get_data(),
       );
      $this->load->view('index', $data);
    }

    public function insert()
    {
      if ($this->db->insert('tempat_tidur', $this->data_tt)) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect('TempatTidur');
      } else {
        echo "salah";
      }

    }

    public function edit()
    {
      $id = $this->uri->segment(3);
      $data = array(
        'form' => 'TempatTidur/form',
        'body' => 'TempatTidur/edit',
        'tempat_tidur' => $this->ModelTempatTidur->get_data_edit($id)
       );
      $this->load->view('index', $data);
    }

    public function update()
    {
      $no_tt = $this->input->post('no_tt');
      $this->db->where('no_tt',$no_tt);
      if ($this->db->update('tempat_tidur', $this->data_tt)) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect('TempatTidur');
      } else {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      }


    }

    function delete()
    {
      $id = $this->input->post('id');
      $this->db->where_in('no_tt', $id);
      $delete = $this->db->update('tempat_tidur',array("hapus"=>1));
      if ($delete == true) {
          $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Tempat Tidur'));
      }else{
          $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Tempat Tidur, Data masih Terrelasi!!!'));
      };
      redirect('TempatTidur');
    }

    function setup(){
      $data = array(
        'body' => 'TempatTidur/setup',
        'tempat_tidur'=> $this->ModelTempatTidur->get_data()
       );
      $this->load->view('index', $data);
    }

    function setup_kamar(){
      $id = $this->uri->segment(3);
      $this->db->where('no_tt', $id);
      $this->db->update("tempat_tidur",array("status_terisi"=>2));
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil'));
      redirect('TempatTidur');
    }

    function ready(){
      $id = $this->uri->segment(3);
      $this->db->where('no_tt', $id);
      $this->db->update("tempat_tidur",array("status_terisi"=>0));
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil'));
      redirect('TempatTidur');
    }

  }
?>
