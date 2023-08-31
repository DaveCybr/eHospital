<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembelianObat extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url', 'language'));
    $this->load->model('ModelPembelianObat');
    $this->load->model('ModelSupplier');
    $this->load->model('ModelObat');
    $this->load->model('ModelAkuntansi');
  }

  function index()
  {
    $data = array(
      'body' => 'PembelianObat/list',
      'pembelian_obat' => $this->ModelPembelianObat->get_data(),
      'form_dialog' => 'PembelianObat/form_dialog2',
    );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'form' => 'PembelianObat/form',
      'form_dialog' => 'PembelianObat/form_dialog',
      'body' => 'PembelianObat/input',
      'supplier' => $this->ModelSupplier->get_data(),
      'obat' => $this->ModelObat->get_data()
    );
    $this->load->view('index', $data);
  }

  public function insert()
  {
    $no_nota = $this->ModelPembelianObat->generate_no_nota();
    $sisa = $this->input->post('sisa');
    $jatuh_tempo = date("Y-m-d", strtotime($this->input->post("jatuh_tempo")));
    if ($sisa < 0) {
      $status = "Belum Lunas";
    } else {
      $status = "Lunas";
      $sisa = 0;
    }
    $pembelian_obat = array(
      'no_nota' => $no_nota,
      'no_nota_supplier' => $this->input->post('no_nota_supplier'),
      'supplier_kode_sup' => $this->input->post('supplier'),
      'tanggal_masuk' => date("Y-m-d", strtotime($this->input->post('tanggal_masuk'))),
      // 'total_bayar' => $this->input->post('bayar'),
      'total_transaksi' => $this->input->post("tot_harga"),
      'total_ppn' => $this->input->post("tot_ppn"),
      'total_diskon' => $this->input->post("tot_diskon"),
      'total_bayar' => $this->input->post("bayar_final"),
      'bayar' => $this->Core->combine_harga($this->input->post("bayar")),
      'sisa' => $sisa,
      'status' => $status
    );
    $jam = date("H:i:s");
    $kode = $no_nota;
    $kode_akun = $this->ModelAkuntansi->generete_notrans();
    if ($sisa > 0) {
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi pembelian obat dengan nomor transaksi ' . $pembelian_obat['no_nota'] . ' pada tanggal ' . date("d-m-Y"),
        'norek' => '116.001',
        'debet' => $pembelian_obat['bayar'],
        'kredit' => 0,
        'no_transaksi' => $kode_akun,
        'jam' => $jam
      );
      $this->db->insert('jurnal', $jurnal);
      if ($pembelian_obat['total_bayar'] > 0) {
        $jurnal_kas = array(
          'tanggal' => date("Y-m-d"),
          'keterangan' => 'Transaksi pembelian obat dengan nomor transaksi ' . $pembelian_obat['no_nota'] . ' pada tanggal ' . date("d-m-Y"),
          'norek' => '111.001',
          'debet' => 0,
          'kredit' => $pembelian_obat['total_bayar'],
          'no_transaksi' => $kode_akun,
          'jam' => $jam
        );
        $this->db->insert('jurnal', $jurnal_kas);
      }
      $jurnal1 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi pembelian obat dengan nomor transaksi ' . $pembelian_obat['no_nota'] . ' pada tanggal ' . date("d-m-Y"),
        'norek' => '211.001',
        'debet' => 0,
        'kredit' => $sisa,
        'no_transaksi' => $kode_akun,
        'jam' => $jam
      );
      $this->db->insert('jurnal', $jurnal1);
    } else {
      $jurnal1 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi pembelian obat dengan nomor transaksi ' . $pembelian_obat['no_nota'] . ' pada tanggal ' . date("d-m-Y"),
        'norek' => '111.001',
        'debet' => 0,
        'kredit' => $pembelian_obat['total_bayar'],
        'no_transaksi' => $kode_akun,
        'jam' => $jam
      );
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi pembelian obat dengan nomor transaksi ' . $pembelian_obat['no_nota'] . ' pada tanggal ' . date("d-m-Y"),
        'norek' => '116.001',
        'debet' => $pembelian_obat['total_bayar'],
        'kredit' => 0,
        'no_transaksi' => $kode_akun,
        'jam' => $jam
      );
      $this->db->insert('jurnal', $jurnal);
      $this->db->insert('jurnal', $jurnal1);
    }
    // $this->db->insert("jurnal",$jurnal);
    // $this->db->insert("jurnal",$jurnal1);
    if ($this->db->insert('pembelian_obat', $pembelian_obat)) {
      $id_obat = $this->input->post('id_obat');
      $no_batch = $this->input->post('no_batch');
      $jumlah = $this->input->post('jumlah');
      $hrg_beli = $this->input->post('harga_beli');
      $diskon = $this->input->post('diskon');
      $tanggal_expired = $this->input->post('ed');
      $ppn = $this->input->post('ppn');
      $ttl_harga = $this->input->post('ttl_harga');
      $count = count($id_obat);
      $total_harga = 0;
      $total_diskon = 0;
      $total_ppn = 0;
      $satuan = $this->input->post("satuan");
      $satuan_beli = $this->input->post('satuan_beli');
      for ($i = 0; $i < $count; $i++) {
        //menghitung harga persatuan
        $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
        $satuan_besar;
        $satuan_sedang;
        $satuan_kecil;
        $jml_satuan_kecil;
        $hrg_beli_satuan_kecil;
        $hrg_beli;
        $stok;
        $stok_berjalan;
        $satuan_besar = $data_obat['jml_satuan_besar'];
        $satuan_sedang = $data_obat['jml_satuan_sedang'];
        $satuan_kecil = $data_obat['jml_satuan_kecil'];
        if ($satuan[$i] == $data_obat['satuan_besar']) {
          $jml_satuan_kecil =  (int)$jumlah[$i] * (int)$satuan_besar * (int)$satuan_sedang * (int)$satuan_kecil;
        } else if ($satuan[$i] == $data_obat['satuan_sedang']) {
          $jml_satuan_kecil =  (int)$jumlah[$i] * (int)$satuan_sedang * (int)$satuan_kecil;
        } else {
          $jml_satuan_kecil =  (int)$jumlah[$i] * (int)$satuan_kecil;
        }
        $hrg_beli_satuan_kecil = (int) ($ttl_harga[$i] / $jml_satuan_kecil);
        $stok = $jml_satuan_kecil + $data_obat['stok'];
        $stok_berjalan = $jml_satuan_kecil + $data_obat['stok_berjalan'];
        $detail_pembelian_obat = array(
          'no_batch' => $no_batch[$i],
          'jumlah' => $jumlah[$i],
          'jumlah_satuan_kecil' => $jml_satuan_kecil,
          'hrg_beli' => $this->Core->combine_harga($hrg_beli[$i]),
          'hrg_beli_satuan_kecil' => $hrg_beli_satuan_kecil,
          'diskon' => $diskon[$i],
          'tanggal_expired' => $tanggal_expired[$i],
          'pembelian_obat_no_nota' => $no_nota,
          'obat_idobat' => $id_obat[$i],
          'ppn' => $ppn[$i],
          'total_harga' => $ttl_harga[$i],
          'satuan_beli' => $satuan[$i]
        );
        $this->db->insert('detail_pembelian_obat', $detail_pembelian_obat);

        $detail_pembelian_obat = array(
          'obat_idobat' => $id_obat[$i],
          'tanggal' => date("Y-m-d", strtotime($this->input->post('tanggal_masuk'))),
          'ed' => $tanggal_expired[$i],
          'no_batch' => $no_batch[$i],
          'jumlah_stok' => $jml_satuan_kecil,
          'harga' => $hrg_beli_satuan_kecil,
          'satuan_obat' => $satuan[$i],
          'no_nota' => $no_nota,
        );
        $this->db->insert('gudang_obat', $detail_pembelian_obat);

        $update = array(
          'harga_beli_satuan_kecil' => $hrg_beli_satuan_kecil,
          'harga_beli_satuan_sedang' => (int)$hrg_beli_satuan_kecil * $satuan_sedang,
          'harga_beli_satuan_besar' => (int)$hrg_beli_satuan_kecil * $satuan_sedang * $satuan_besar,
          'stok' => $stok,
          'stok_berjalan' => $stok_berjalan
        );
        $this->db->where('idobat', $id_obat[$i]);
        $this->db->update('obat', $update);
      }
      $this->db->insert('hutang', array(
        'tanggal' => date("Y-m-d"),
        'total_hutang' => $sisa,
        'pembelian_obat_no_nota' => $no_nota,
        'tanggal_jatuh_tempo' => $jatuh_tempo
      ));
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Nota Pembelian Berhasil Disimpan!!!!'));
      redirect(base_url() . 'PembelianObat');
    }
  }

  public function hapus_detail()
  {
    $id = $this->input->post('id');
    $data = $this->db->where('iddetail_pembelian_obat', $id)->get('detail_pembelian_obat')->row_array();
    $id_obat = $data['obat_idobat'];
    $data_obat = $this->ModelObat->get_data_edit($id_obat)->row_array();
    $stok = $data_obat['stok'] - $data['jumlah_satuan_kecil'];
    $stok_berjalan = $data_obat['stok_berjalan'] - $data['jumlah_satuan_kecil'];
    $update_stok = array(
      'stok' => $stok,
      'stok_berjalan' => $stok_berjalan
    );
    $this->db->where('idobat', $id_obat);
    $this->db->update('obat', $update_stok);
    $this->db->where_in('iddetail_pembelian_obat', $id);
    $delete = $this->db->delete('detail_pembelian_obat');
    if ($delete) {
      $res = array(
        'success' => true
      );
    } else {
      $res = array(
        'success' => false
      );
    }
    echo json_encode($res);
  }
  public function get_detail()
  {
    $no_nota = $this->input->post('no_nota');
    // $no_nota = "00000000046";
    $data_detail = $this->ModelPembelianObat->get_detail_nota($no_nota);
    if (empty($data_detail)) {
      $data_detail = $this->ModelPembelianObat->get_detail_nota2($no_nota);
    }
    echo json_encode($data_detail);
  }

  public function cek_status_hutang($t_bayar, $sisa)
  {
    if ($t_bayar <= 0) {
      $data = array(
        'sisa' => $sisa,
        'status' => 'hutang'
      );
    } else {
      if ($sisa > 0) {
        $data = array(
          'sisa' => $sisa,
          'status' => 'belum lunas'
        );
      } else {
        $data = array(
          'sisa' => $sisa,
          'status' => 'lunas'
        );
      }
    }
    return $data;
  }

  public function edit($no_nota = null)
  {
    $data = array(
      'form' => 'PembelianObat/form_edit',
      'form_dialog' => 'PembelianObat/form_dialog',
      'body' => 'PembelianObat/edit',
      'nota' => $this->ModelPembelianObat->get_data_edit($no_nota)->row_array(),
      'detail_nota' => $this->ModelPembelianObat->get_detail($no_nota),
      'supplier' => $this->ModelSupplier->get_data(),
      'obat' => $this->ModelObat->get_data()
    );
    $this->load->view('index', $data);
  }

  public function update($no_nota)
  {
    $sisa = $this->input->post('sisa');
    $jatuh_tempo = $this->input->post("jatuh_tempo");
    if ($sisa > 0) {
      $status = "Belum Lunas";
    } else {
      $status = "Lunas";
    }
    $detil = $this->db->where_in('pembelian_obat_no_nota', $no_nota)->get('detail_pembelian_obat')->result();
    foreach ($detil as $value) {
      if ($value->jumlah_terjual == null) {
        $terjual = 0;
      } else {
        $terjual = $value->jumlah_terjual;
      }
      $jumlah = (int)$value->jumlah_satuan_kecil - (int)$terjual;
      $data_obat = $this->db->get_where('obat', array('idobat' => $value->obat_idobat))->row_array();
      $stok = (int)$data_obat['stok'] - $jumlah;
      $stok_berjalan = (int)$data_obat['stok_berjalan'] - $jumlah;
      $this->db->where('idobat', $data_obat['idobat']);
      $this->db->update('obat', array('stok' => $stok, 'stok_berjalan' => $stok_berjalan));
    }
    $this->db->where_in('pembelian_obat_no_nota', $no_nota);
    $this->db->delete('detail_pembelian_obat');
    $pembelian_obat = array(
      'no_nota_supplier' => $this->input->post('no_nota_supplier'),
      'supplier_kode_sup' => $this->input->post('supplier'),
      'tanggal_masuk' => $this->input->post('tanggal_masuk'),
      'total_bayar' => $this->input->post('bayar'),
      'total_transaksi' => $this->input->post("tot_harga"),
      'total_ppn' => $this->input->post("tot_ppn"),
      'total_diskon' => $this->input->post("tot_diskon"),
      'total_bayar' => $this->input->post("bayar_final"),
      'bayar' => $this->input->post("bayar"),
      'sisa' => $sisa,
      'status' => $status
    );
    $this->db->where('no_nota', $no_nota);
    if ($this->db->update('pembelian_obat', $pembelian_obat)) {
      $id_obat = $this->input->post('id_obat');
      $no_batch = $this->input->post('no_batch');
      $jumlah = $this->input->post('jumlah');
      $hrg_beli = $this->input->post('harga_beli');
      $diskon = $this->input->post('diskon');
      $tanggal_expired = $this->input->post('ed');
      $ppn = $this->input->post('ppn');
      $ttl_harga = $this->input->post('ttl_harga');
      $count = count($id_obat);
      $total_harga = 0;
      $total_diskon = 0;
      $total_ppn = 0;
      $satuan = $this->input->post("satuan");
      $satuan_beli = $this->input->post('satuan_beli');
      for ($i = 0; $i < $count; $i++) {
        //menghitung harga persatuan
        $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
        $satuan_besar;
        $satuan_sedang;
        $satuan_kecil;
        $jml_satuan_kecil;
        $hrg_beli_satuan_kecil;
        $hrg_beli;
        $stok;
        $stok_berjalan;
        $satuan_besar = $data_obat['jml_satuan_besar'];
        $satuan_sedang = $data_obat['jml_satuan_sedang'];
        $satuan_kecil = $data_obat['jml_satuan_kecil'];
        if ($satuan[$i] == $data_obat['satuan_besar']) {
          $jml_satuan_kecil =  (int)$jumlah[$i] * (int)$satuan_besar * (int)$satuan_sedang * (int)$satuan_kecil;
        } else if ($satuan[$i] == $data_obat['satuan_sedang']) {
          $jml_satuan_kecil =  (int)$jumlah[$i] * (int)$satuan_sedang * (int)$satuan_kecil;
        } else {
          $jml_satuan_kecil =  (int)$jumlah[$i] * (int)$satuan_kecil;
        }
        $hrg_beli_satuan_kecil = (int) ($ttl_harga[$i] / $jml_satuan_kecil);
        $stok = $jml_satuan_kecil + $data_obat['stok'];
        $stok_berjalan = $jml_satuan_kecil + $data_obat['stok_berjalan'];
        $detail_pembelian_obat = array(
          'no_batch' => $no_batch[$i],
          'jumlah' => $jumlah[$i],
          'jumlah_satuan_kecil' => $jml_satuan_kecil,
          'hrg_beli' => $hrg_beli[$i],
          'hrg_beli_satuan_kecil' => $hrg_beli_satuan_kecil,
          'diskon' => $diskon[$i],
          'tanggal_expired' => $tanggal_expired[$i],
          'pembelian_obat_no_nota' => $no_nota,
          'obat_idobat' => $id_obat[$i],
          'ppn' => $ppn[$i],
          'total_harga' => $ttl_harga[$i],
          'satuan_beli' => $satuan[$i]
        );
        $this->db->insert('detail_pembelian_obat', $detail_pembelian_obat);
        $update = array(
          'harga_beli_satuan_kecil' => $hrg_beli_satuan_kecil,
          'harga_beli_satuan_sedang' => (int)$hrg_beli_satuan_kecil * $satuan_sedang,
          'harga_beli_satuan_besar' => (int)$hrg_beli_satuan_kecil * $satuan_sedang * $satuan_besar,
          'stok' => $stok,
          'stok_berjalan' => $stok_berjalan
        );
        $this->db->where('idobat', $id_obat[$i]);
        $this->db->update('obat', $update);
      }
      $this->db->where('pembelian_obat_no_nota', $no_nota)->update('hutang', array('tanggal' => date("Y-m-d"), 'total_hutang' => $sisa, 'tanggal_jatuh_tempo' => $jatuh_tempo));
      $this->session->set_flashdata('notif', $this->Notif->berhasil('Nota Pembelian Berhasil Disimpan!!!!'));
      redirect(base_url() . 'PembelianObat');
    }
  }


  public function delete()
  {
    $no_nota = $this->input->post('id');
    $this->db->where_in('pembelian_obat_no_nota', $no_nota);
    $this->db->delete('hutang');
    $detil = $this->db->where_in('pembelian_obat_no_nota', $no_nota)->get('detail_pembelian_obat')->result();
    foreach ($detil as $value) {
      if ($value->jumlah_terjual == null) {
        $terjual = 0;
      } else {
        $terjual = $value->jumlah_terjual;
      }
      $jumlah = (int)$value->jumlah_satuan_kecil - (int)$terjual;
      $data_obat = $this->db->get_where('obat', array('idobat' => $value->obat_idobat))->row_array();
      $stok = (int)$data_obat['stok'] - $jumlah;
      $stok_berjalan = (int)$data_obat['stok_berjalan'] - $jumlah;
      $this->db->where('idobat', $data_obat['idobat']);
      $this->db->update('obat', array('stok' => $stok, 'stok_berjalan' => $stok_berjalan));
    }
    $this->db->where_in('pembelian_obat_no_nota', $no_nota);
    $delete_detail = $this->db->delete('detail_pembelian_obat');
    if ($delete_detail) {
      $this->db->where_in('no_nota', $no_nota);
      $delete = $this->db->delete('pembelian_obat');
      if ($delete) {
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Hapus Data Pembelian Obat'));
      } else {
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Gagal Hapus Data Pembelian Obat'));
      };
    } else {
      $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Hapus Data!!!!'));
    }
    redirect(base_url() . 'PembelianObat');
  }

  public function get_obat()
  {
    $data_obat = $this->ModelObat->get_data_edit($this->input->post('id_obat'))->row_array();
    echo json_encode($data_obat);
  }

  public function get_satuan()
  {
    $id_obat = $this->input->post('id_obat');
    $data_obat = $this->ModelObat->get_data_edit($id_obat)->row_array();
    $data_satuan = array();
    if ($data_obat != null) {
      array_push($data_satuan, array(
        'label' => 'satuan_besar',
        'satuan' => $data_obat['satuan_besar'],
        'harga_satuan' => $data_obat['harga_beli_satuan_besar'],
        'jml_satuan' => $data_obat['jml_satuan_besar']
      ));
      array_push($data_satuan, array(
        'label' => 'satuan_sedang',
        'satuan' => $data_obat['satuan_sedang'],
        'harga_satuan' => $data_obat['harga_beli_satuan_sedang'],
        'jml_satuan' => $data_obat['jml_satuan_sedang']
      ));
      array_push($data_satuan, array(
        'label' => 'satuan_kecil',
        'satuan' => $data_obat['satuan_kecil'],
        'harga_satuan' => $data_obat['harga_beli_satuan_kecil'],
        'jml_satuan' => $data_obat['jml_satuan_kecil']
      ));
    }
    echo json_encode($data_satuan);
  }

  public function set_tanggal()
  {
    $data = $this->db->get("hutang")->result();
    foreach ($data as $value) {
      $tgl = $value->tanggal;
      $jatuh_tempo = date("Y-m-d", strtotime($tgl, strtotime("+30 days")));
      $this->db->where("idhutang", $value->idhutang)->update("hutang", array("tanggal_jatuh_tempo" => $jatuh_tempo));
      $this->db->where("no_nota", $value->pembelian_obat_no_nota)->update("pembelian_obat", array("tanggal_masuk" => $tgl));
    }
    echo "selesai";
  }
}
