<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class ReturGudang extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->helper(array('url', 'language'));
      $this->load->model('ModelPembelianObat');
      $this->load->model('ModelSupplier');
      $this->load->model('ModelObat');
      $this->load->model("ModelPeriksa");
      $this->load->model("ModelAkuntansi");
    }

    function index()
    {
      $data = array(
        'form' => 'ReturGudang/form',
        'body' => 'ReturGudang/list',
        'obat' => $this->ModelObat->get_data()
      );
      $this->load->view('index', $data);
    }
    function tes(){
      echo $this->ModelObat->generate_kode();
    }


    function insert(){
      $kode_jurnal = $this->ModelAkuntansi->generete_notrans();
      $id_obat = $this->input->post('id_obat');
      $no_batch = $this->input->post('no_batch');
      $jumlah = $this->input->post('jumlah');
      $tanggal_expired = $this->input->post('ed');
      $idp = $this->input->post('id_pengadaan');
      $kode = $this->ModelObat->generate_kode();
      $count = count($id_obat);
      $kerugian = 0;
      for($i=0;$i<$count;$i++){
        $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
        $pengadaan = $this->db->where("iddetail_pembelian_obat",$idp[$i])->get("detail_pembelian_obat")->row();
        $detail_retur = array(
          'jumlah' => $jumlah[$i],
          'idobat' => $id_obat[$i],
          'tanggal' => date("Y-m-d"),
          'nik_akun' => $_SESSION['nik'],
          'id_pembelian' => $idp[$i],
          'kode_transaksi' => $kode,
          'jenis_retur' => 1,
          'id_gudang' => $pengadaan->id_gudang,
          'unit' => $pengadaan->unit
        );
        $this->db->insert('retur', $detail_retur);
      }
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
      redirect(base_url().'ReturGudang');
    }


  }
?>
