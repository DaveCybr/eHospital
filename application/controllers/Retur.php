<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Retur extends CI_Controller{

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
        'form' => 'ReturObat/form',
        'body' => 'ReturObat/list',
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
        $jml_satuan_kecil = $jumlah[$i];
        $stok = $data_obat['stok']-$jml_satuan_kecil;
        $stok_berjalan = $data_obat['stok_berjalan']-$jml_satuan_kecil;
        $harga = $data_obat['harga_1'];
        $total = $harga*$jml_satuan_kecil;
        $detail_retur = array(
          'jumlah' => $jumlah[$i],
          'idobat' => $id_obat[$i],
          'tanggal' => date("Y-m-d"),
          'nik_akun' => $_SESSION['nik'],
          'id_pembelian' => $idp[$i],
          'kode_transaksi' => $kode

        );
        $this->db->insert('retur', $detail_retur);
        $update = array(
          'stok' => $stok,
          'stok_berjalan' => $stok_berjalan
        );
        $this->db->where('idobat',$id_obat[$i]);
        $this->db->update('obat',$update);
        $detail = $this->db->join("obat","obat.idobat=detail_pembelian_obat.obat_idobat")->get_where("detail_pembelian_obat",array('iddetail_pembelian_obat'=>$idp[$i]))->row_array();
        if ($detail['retur']==null) {
          $jml = $jml_satuan_kecil ;
        }else{
          $jml = $detail['retur']+$jml_satuan_kecil;
        }
        $this->db->where('iddetail_pembelian_obat',$idp[$i]);
        $this->db->update('detail_pembelian_obat',array('retur'=>$jml));
        if ($detail['stok_awal']!=1) {
          $kerugian += $detail['hrg_beli_satuan_kecil']*$jumlah[$i];
          // code...
        }else{
          $kerugian += $detail['harga_beli_satuan_kecil']*$jumlah[$i];
        }
      }
      $jam = date("H:i:s");
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Retur obat pada tanggal '.date("d-m-Y"),
        'norek' => '10202',
        'debet' => $kerugian,
        'kredit' => 0,
        'no_transaksi' => $kode_jurnal,
        'jam' => $jam
      );
      $jurnal1 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Retur obat pada tanggal '.date("d-m-Y"),
        'norek' => '10501',
        'debet' => 0,
        'kredit' => $kerugian,
        'no_transaksi' => $kode_jurnal,
        'jam' => $jam
      );
      $this->db->insert('jurnal',$jurnal);
      $this->db->insert('jurnal',$jurnal1);

      $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
      redirect(base_url().'Retur');
    }


  }
?>
