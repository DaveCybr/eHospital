<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class JasaPelayanan extends CI_Controller{

    public $jasa_pelayanan = array();

    public function __construct()
    {
      parent::__construct();
      $this->load->helper(array('url', 'language'));
      $this->load->model('ModelJasaPelayanan');
      $this->load->model("ModelTujuanPelayanan");
      $this->jasa_pelayanan = array(
         'kode_jasa' => $this->input->post('kode_jasa'),
         'nama' => $this->input->post('nama'),
         'hrg_1' => $this->input->post('hrg_1'),
         'hrg_2' => $this->input->post('hrg_2'),
         'hrg_3' => $this->input->post('hrg_3'),
         'hrg_4' => $this->input->post('hrg_4'),
         'hrg_5' => $this->input->post('hrg_5'),
         'jasa_dokter_1' => $this->input->post('jasa_dokter_1'),
         'jasa_dokter_2' => $this->input->post('jasa_dokter_2'),
         'jasa_dokter_3' => $this->input->post('jasa_dokter_3'),
         'jasa_dokter_4' => $this->input->post('jasa_dokter_4'),
         'jasa_dokter_5' => $this->input->post('jasa_dokter_5'),
         'jasa_perawat_1' => $this->input->post('jasa_perawat_1'),
         'jasa_perawat_2' => $this->input->post('jasa_perawat_2'),
         'jasa_perawat_3' => $this->input->post('jasa_perawat_3'),
         'jasa_perawat_4' => $this->input->post('jasa_perawat_4'),
         'jasa_perawat_5' => $this->input->post('jasa_perawat_5'),
         'jasa_resepsionis_1' => $this->input->post('jasa_resepsionis_1'),
         'jasa_resepsionis_2' => $this->input->post('jasa_resepsionis_2'),
         'jasa_resepsionis_3' => $this->input->post('jasa_resepsionis_3'),
         'jasa_resepsionis_4' => $this->input->post('jasa_resepsionis_4'),
         'jasa_resepsionis_5' => $this->input->post('jasa_resepsionis_5'),
         'jasa_analis_1' => $this->input->post('jasa_analis_1'),
         'jasa_analis_2' => $this->input->post('jasa_analis_2'),
         'jasa_analis_3' => $this->input->post('jasa_analis_3'),
         'jasa_analis_4' => $this->input->post('jasa_analis_4'),
         'jasa_analis_5' => $this->input->post('jasa_analis_5'),
         'jasa_admin_1' => $this->input->post('jasa_admin_1'),
         'jasa_admin_2' => $this->input->post('jasa_admin_2'),
         'jasa_admin_3' => $this->input->post('jasa_admin_3'),
         'jasa_admin_4' => $this->input->post('jasa_admin_4'),
         'jasa_admin_5' => $this->input->post('jasa_admin_5'),
         'jasa_ob_1' => $this->input->post('jasa_ob_1'),
         'jasa_ob_2' => $this->input->post('jasa_ob_2'),
         'jasa_ob_3' => $this->input->post('jasa_ob_3'),
         'jasa_ob_4' => $this->input->post('jasa_ob_4'),
         'jasa_ob_5' => $this->input->post('jasa_ob_5'),
         'tujuan_pelayanan_kode_tupel' => $this->input->post('poli'),
      );
    }

    function index()
    {
      $data = array(
        'body' => 'JasaPelayanan/list',
        'jasa_pelayanan' => $this->ModelJasaPelayanan->get_data()
       );
      $this->load->view('index', $data);
    }

    function input()
    {
      $data = array(
        'form' => 'JasaPelayanan/form',
        'body' => 'JasaPelayanan/input',
        'tupel' => $this->ModelTujuanPelayanan->get_data(),
       );
      $this->load->view('index', $data);
    }

    public function insert()
    {
      $hit = $this->db->get_where('jasa_pelayanan',array('kode_jasa'=>$this->jasa_pelayanan['kode_jasa']))->num_rows();
      if ($hit>0) {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Kode Jasa Telah Digunakan'));
        redirect(base_url().'JasaPelayanan/input');
      }else{
        if ($this->db->insert('jasa_pelayanan', $this->jasa_pelayanan)) {
          $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
          redirect(base_url().'JasaPelayanan');
        } else {
          echo "salah";
        }
      }

    }

    public function edit()
    {
      $id = $this->uri->segment(3);
      $data = array(
        'form' => 'JasaPelayanan/form',
        'body' => 'JasaPelayanan/edit',
        'jasa_pelayanan' => $this->ModelJasaPelayanan->get_data_edit($id)->row_array(),
        'tupel' => $this->ModelTujuanPelayanan->get_data(),
       );
      $this->load->view('index', $data);
    }

    public function update()
    {
      $kode_jasa = $this->input->post('kode_jasa');
      $this->db->where('kode_jasa',$kode_jasa);
      if ($this->db->update('jasa_pelayanan', $this->jasa_pelayanan)) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect(base_url().'JasaPelayanan');
      } else {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
        redirect(base_url().'JasaPelayanan');
      }

    }

    public function delete()
    {
      $id = $this->input->post('id');
      // $cek_data = $this->db->where_in('jasa_pelayanan_kode_jasa',$id)->get('pasien')->num_rows();
        $this->db->where_in('kode_jasa', $id);
        $delete = $this->db->delete('jasa_pelayanan');
        if ($delete) {
            $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Hapus Data Jasa Pelayanan'));
        }else{
            $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Hapus Data Jasa Pelayanan'));
        };
      redirect(base_url().'JasaPelayanan');
    }

    // public function test()
    // {
    //   foreach ($this->ModelJasaPelayanan->get_data() as $value) {
    //     $harga = $value->hrg_1 * 10;
    //     $this->db->where('kode_jasa', $value->kode_jasa);
    //     $this->db->update('jasa_pelayanan', array('hrg_1' => $harga, ));
    //   }
    // }

  }
?>
