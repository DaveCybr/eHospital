<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    // $this->load->library(array('ion_auth', 'form_validation'));
    $this->load->helper(array('url', 'language'));
    $this->load->model('ModelHutang');
    $this->load->model('ModelAkuntansi');
  }

  function index()
  {
    $data = array(
      'body' => 'Hutang/list',
      'hutang' => $this->ModelHutang->get_data()->result(),
      'lunas' => $this->ModelHutang->get_data_lunas()->result(),
      'form_dialog' => 'Hutang/form_dialog'
    );
    $this->load->view('index', $data);
  }
  function lunasi($no_nota){
    $data_pembelian = $this->db->get_where("pembelian_obat",array('no_nota'=>$no_nota))->row_array();
    $kode_akun = $this->ModelAkuntansi->generete_notrans();
    $jam = date("H:i:s");
    $bayar = abs($data_pembelian['sisa']);
    $data = array(
      'sisa' => 0,
      'status' => 'Lunas',
      'bayar' => $bayar
    );

    $jurnal_kas = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi pembelian obat dengan nomor transaksi '.$pembelian_obat['no_nota'].' pada tanggal '.date("d-m-Y"),
      'norek' => '111.001',
      'debet' =>  0,
      'kredit' => $bayar,
      'no_transaksi' => $kode_akun,
      'jam' => $jam
    );
    $this->db->insert('jurnal',$jurnal_kas);

    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Transaksi pembelian obat dengan nomor transaksi '.$pembelian_obat['no_nota'].' pada tanggal '.date("d-m-Y"),
      'norek' => '211.001',
      'debet' => $bayar,
      'kredit' =>0,
      'no_transaksi' => $kode_akun,
      'jam' => $jam
      );
      $this->db->insert('jurnal',$jurnal1);


      $this->db->where('no_nota',$no_nota);
      $this->db->update('pembelian_obat',$data);
      $this->db->reset_query();
      $this->db->where('pembelian_obat_no_nota',$no_nota);
      $this->db->update('hutang',array('total_hutang'=>0));
      $this->session->set_flashdata('notif',$this->Notif->berhasil("Hutang telah dilunasi"));
      redirect(base_url()."Hutang");
    }

    public function data_hutang()
    {
      $tanggal = $this->input->post('tanggal');
      $data = array(
      'hutang' => $this->ModelHutang->get_data_hutang($tanggal)->result(),
      );
      $this->load->view('Hutang/belum_lunas',$data);

      // code...
    }

    public function data_lunas()
    {
      $tanggal = $this->input->post('tanggal');
      $data = array(
      'lunas' => $this->ModelHutang->get_data_lunas($tanggal)->result(),
      );
      $this->load->view('Hutang/lunas',$data);
      // code...
    }

  }
  ?>
