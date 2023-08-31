<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelObat extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data_gudang()
  {

    return $this->db
      ->select("obat.*,sum(stok_akhir) as stok")
      ->join("list_batch_gudang", "obat.idobat=list_batch_gudang.obat_idobat", "left")
      ->group_by("obat.idobat")
      ->get("obat")->result();
  }

  public function get_data_UGD()
  {
    $this->db->select("list_batch.idobat, list_batch.nama_obat, unit, SUM(list_batch.stok) as stok, obat.satuan_kecil");
    $this->db->group_by("list_batch.idobat");
    $this->db->join("obat", "obat.idobat = list_batch.idobat");
    $this->db->where("list_batch.unit", "UGD");
    return $this->db->get('list_batch')->result();
  }

  public function get_data_apotek()
  {
    $this->db->select("list_batch.idobat, list_batch.nama_obat, unit, SUM(list_batch.stok) as stok, obat.satuan_kecil");
    $this->db->group_by("list_batch.idobat");
    $this->db->join("obat", "obat.idobat = list_batch.idobat");
    $this->db->where("list_batch.unit", "APOTEK");
    return $this->db->get('list_batch')->result();
  }

  public function get_data()
  {
    // $this->db->limit(10);
    $this->db->join('jenis_obat', "jenis_obat.idjenis_obat=obat.jenis_obat_idjenis_obat", "left");
    $this->db->join('kategori_obat', "kategori_obat.idkategori_obat=obat.kategori_obat_idkategori_obat", "left");
    return $this->db->get('obat')->result();
  }

  public function get_data_edit($id)
  {
    $this->db->join('jenis_obat', "jenis_obat.idjenis_obat=obat.jenis_obat_idjenis_obat", "left");
    $this->db->join('kategori_obat', "kategori_obat.idkategori_obat=obat.kategori_obat_idkategori_obat", "left");
    return $this->db->get_where('obat', array('idobat' => $id));
  }
  public function generate_kode($length = 10)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
  public function get_kadaluarsa()
  {
    $date = date("Y-m-d");
    $batas = date("Y-m-d", strtotime("+30 days"));
    return $this->db
      ->join("obat", "obat.idobat=detail_pembelian_obat.obat_idobat")
      ->select("no_batch,nama_obat,idobat,(IFNULL(jumlah,0)-IFNULL(jumlah_terjual,0)) as jumlah,tanggal_expired")
      ->get_where("detail_pembelian_obat", array("DATE(tanggal_expired) >=" => $date, "DATE(tanggal_expired) <=" => $batas, 'jumlah !=' => 0))
      ->result();
  }

  public function get_resep($id)
  {
    return $this->db
      ->get_where("detail_resep_diberikan", array("id_detail_resep" => $id));
  }

  public function get_batch($id)
  {
    return $this->db
      ->get_where("detail_resep_diberikan", array("id_detail_resep" => $id));
  }
  public function get_pengadaan($id)
  {
    return $this->db
      ->get_where("detail_pembelian_obat", array("iddetail_pembelian_obat" => $id));
  }


  public function get_kartu_stok($id)
  {
    $stok_awal = $this->db
      ->select("SUM(jumlah_satuan_kecil) as jumlah,nama_obat")
      ->join("obat", "obat.idobat=detail_pembelian_obat.obat_idobat")
      ->where(array("obat_idobat" => $id, "stok_awal" => 1))
      ->get("detail_pembelian_obat")->row_array();
    $tgl = "2020-03-01";

    // Convert Ke Date Time
    $biday = new DateTime($tgl);
    $today = new DateTime();

    $diff = $today->diff($biday);
    $lama = $diff->days;
    $sisa_stok = $stok_awal['jumlah'];
    $data = array();
    for ($i = 0; $i <= $lama; $i++) {
      $tgl_baru = date("Y-m-d", strtotime("+" . $i . " days", strtotime($tgl)));
      // die(var_dump($tgl_baru));
      $penerimaan = $this->db
        ->select("SUM(jumlah_satuan_kecil) as jumlah")
        ->where(array("obat_idobat" => $id, "stok_awal" => NULL, "DATE(tanggal)" => $tgl_baru))
        ->get("detail_pembelian_obat")->row_array();
      $stok_opname = $this->db->select("SUM(selisih) as jumlah")
        ->where(array("obat_idobat" => $id, "DATE(tanggal)" => $tgl_baru))
        ->get("stok_opname")->row_array();
      $retur = $this->db->select("SUM(jumlah) as jumlah")
        ->where(array("idobat" => $id, "DATE(tanggal)" => $tgl_baru))
        ->get("retur")->row_array();
      $persediaan = $sisa_stok + $penerimaan['jumlah'] + $stok_opname['jumlah'] - $retur['jumlah'];
      $pengeluaran = $this->db
        ->select("SUM(jumlah) as jumlah")
        ->join("resep", "resep.no_resep=detail_resep.resep_no_resep")
        ->where(array("obat_idobat" => $id, "DATE(tanggal)" => $tgl_baru))
        ->get("detail_resep")->row_array();
      $sisa = $persediaan - $pengeluaran['jumlah'];
      // if ($stok_awal!=NULL && $tgl_baru=="2020-03-15") {
      //   array_push($data,array(
      //     'tgl' => date("d-m-Y",strtotime($tgl_baru)),
      //     'nama_obat' => $stok_awal['nama_obat'],
      //     'kode_obat' => $id,
      //     'stok_awal' => $sisa_stok,
      //     'penerimaan' => $penerimaan['jumlah']==NULL?0:$penerimaan['jumlah'],
      //     'persediaan' => $persediaan,
      //     'pengeluaran' => $pengeluaran['jumlah']==NULL?0:$pengeluaran['jumlah'],
      //     'sisa_stok' => $sisa,
      //
      //   ));
      // }else{
      if ($penerimaan['jumlah'] != NULL || $pengeluaran['jumlah'] != NULL || $stok_opname['jumlah'] != NULL || $retur['jumlah'] != NULL) {
        array_push($data, array(
          'tgl' => date("d-m-Y", strtotime($tgl_baru)),
          'nama_obat' => $stok_awal['nama_obat'],
          'kode_obat' => $id,
          'stok_awal' => $sisa_stok,
          'penerimaan' => $penerimaan['jumlah'] == NULL ? 0 : $penerimaan['jumlah'],
          'persediaan' => $persediaan,
          'pengeluaran' => $pengeluaran['jumlah'] == NULL ? 0 : $pengeluaran['jumlah'],
          'stok_opname' => $stok_opname['jumlah'] == NULL ? 0 : $stok_opname['jumlah'],
          'retur' => $retur['jumlah'] == NULL ? 0 : $retur['jumlah'],
          'sisa_stok' => $sisa,

        ));
      }
      // }
      $sisa_stok = $sisa;
    }
    // die(var_dump($data))
    return $data;
  }

  public function get_kartu_stok_gudang($id)
  {
    $stok_awal = $this->db
      ->select("SUM(jumlah_stok) as jumlah,nama_obat")
      ->join("obat", "obat.idobat=gudang_obat.obat_idobat")
      ->where(array("obat_idobat" => $id, "stok_awal" => 1))
      ->get("gudang_obat")->row_array();
    $tgl = "2020-05-03";

    // Convert Ke Date Time
    $biday = new DateTime($tgl);
    $today = new DateTime();

    $diff = $today->diff($biday);
    $lama = $diff->days;
    $sisa_stok = $stok_awal['jumlah'];
    $data = array();
    // var_dump($lama);
    // die();
    for ($i = 0; $i <= $lama; $i++) {
      $tgl_baru = date("Y-m-d", strtotime("+" . $i . " days", strtotime($tgl)));
      // die(var_dump($tgl_baru));
      $penerimaan = $this->db
        ->select("SUM(jumlah_stok) as jumlah")
        ->where(array("obat_idobat" => $id, "stok_awal" => NULL, "DATE(tanggal)" => $tgl_baru))
        ->get("gudang_obat")->row_array();
      $stok_opname = $this->db->select("SUM(selisih) as jumlah")
        ->where(array("obat_idobat" => $id, "DATE(tanggal)" => $tgl_baru, "unit_obat" => "GUDANG"))
        ->get("stok_opname")->row_array();
      $retur = $this->db->select("SUM(jumlah) as jumlah")
        ->where(array("idobat" => $id, "DATE(tanggal)" => $tgl_baru))
        ->get("retur")->row_array();

      $persediaan = $sisa_stok + $penerimaan['jumlah'] + $retur['jumlah'] + $stok_opname['jumlah'];
      $pengeluaran_apotek = $this->db
        ->select("SUM(jumlah_satuan_kecil) as jumlah")
        ->where(array("obat_idobat" => $id, "unit" => "APOTEK", "DATE(tanggal)" => $tgl_baru))
        ->get("detail_pembelian_obat")->row_array();
      $pengeluaran_ugd = $this->db
        ->select("SUM(jumlah_satuan_kecil) as jumlah")
        ->where(array("obat_idobat" => $id, "unit" => "UGD", "DATE(tanggal)" => $tgl_baru))
        ->get("detail_pembelian_obat")->row_array();
      $pengeluaran_ugd['jumlah'] = $pengeluaran_ugd['jumlah'] == NULL ? 0 : $pengeluaran_ugd['jumlah'];
      $pengeluaran_apotek['jumlah'] = $pengeluaran_apotek['jumlah'] == NULL ? 0 : $pengeluaran_apotek['jumlah'];
      $pengeluaran = $pengeluaran_ugd['jumlah'] + $pengeluaran_apotek['jumlah'];
      $sisa = $persediaan - $pengeluaran;

      if ($penerimaan['jumlah'] != NULL || $pengeluaran_apotek['jumlah'] != 0 || $pengeluaran_ugd['jumlah'] != 0 || $stok_opname['jumlah'] != NULL || $retur['jumlah'] != NULL) {
        array_push($data, array(
          'tgl' => date("d-m-Y", strtotime($tgl_baru)),
          'nama_obat' => $stok_awal['nama_obat'],
          'kode_obat' => $id,
          'stok_awal' => $sisa_stok,
          'penerimaan' => $penerimaan['jumlah'] == NULL ? 0 : $penerimaan['jumlah'],
          'persediaan' => $persediaan,
          'pengeluaran_ugd' => $pengeluaran_ugd['jumlah'],
          'pengeluaran_apotek' => $pengeluaran_apotek['jumlah'],
          'stok_opname' => $stok_opname['jumlah'] == NULL ? 0 : $stok_opname['jumlah'],
          'retur' => $retur['jumlah'] == NULL ? 0 : $retur['jumlah'],
          'sisa_stok' => $sisa,
        ));
      }
      $sisa_stok = $sisa;
    }
    // die(var_dump($data))
    return $data;
  }


  public function get_kartu_stok_gudang2($id)
  {
    $stok_awal = $this->db
      ->select("SUM(jumlah_stok) as jumlah,nama_obat")
      ->join("obat", "obat.idobat=gudang_obat.obat_idobat")
      ->where(array("obat_idobat" => $id, "stok_awal" => 1))
      ->get("gudang_obat")->row_array();
    $tgl = "2020-05-03";

    // Convert Ke Date Time
    $biday = new DateTime($tgl);
    $today = new DateTime();

    $diff = $today->diff($biday);
    $lama = $diff->days;
    $sisa_stok = $stok_awal['jumlah'];
    $data = array();
    // var_dump($lama);
    // die();
    for ($i = 0; $i <= $lama; $i++) {
      $tgl_baru = date("Y-m-d", strtotime("+" . $i . " days", strtotime($tgl)));
      // die(var_dump($tgl_baru));
      $penerimaan = $this->db
        ->select("SUM(jumlah_stok) as jumlah")
        ->where(array("obat_idobat" => $id, "stok_awal" => NULL, "DATE(tanggal)" => $tgl_baru))
        ->get("gudang_obat")->row_array();
      $stok_opname = $this->db->select("SUM(selisih) as jumlah")
        ->where(array("obat_idobat" => $id, "DATE(tanggal)" => $tgl_baru, "unit_obat" => "GUDANG"))
        ->get("stok_opname")->row_array();
      $retur = $this->db->select("SUM(jumlah) as jumlah")
        ->where(array("idobat" => $id, "DATE(tanggal)" => $tgl_baru))
        ->get("retur")->row_array();

      // $persediaan = $sisa_stok+$penerimaan['jumlah']+$retur['jumlah']+$stok_opname['jumlah'];
      // $pengeluaran_apotek = $this->db
      // ->select("SUM(jumlah_satuan_kecil) as jumlah")
      // ->where(array("obat_idobat"=>$id,"unit"=>"APOTEK","DATE(tanggal)" => $tgl_baru))
      // ->get("detail_pembelian_obat")->row_array();
      // $pengeluaran_ugd = $this->db
      // ->select("SUM(jumlah_satuan_kecil) as jumlah")
      // ->where(array("obat_idobat"=>$id,"unit"=>"UGD","DATE(tanggal)" => $tgl_baru))
      // ->get("detail_pembelian_obat")->row_array();
      // $pengeluaran_ugd['jumlah'] = $pengeluaran_ugd['jumlah']==NULL?0:$pengeluaran_ugd['jumlah'];
      // $pengeluaran_apotek['jumlah'] = $pengeluaran_apotek['jumlah']==NULL?0:$pengeluaran_apotek['jumlah'];
      // $pengeluaran = $pengeluaran_ugd['jumlah']+$pengeluaran_apotek['jumlah'];
      // $sisa = $persediaan-$pengeluaran;
      //
      // if ($penerimaan['jumlah']!=NULL || $pengeluaran_apotek['jumlah']!=0 || $pengeluaran_ugd['jumlah']!=0 || $stok_opname['jumlah']!=NULL || $retur['jumlah']!=NULL) {
      //   array_push($data,array(
      //     'tgl' => date("d-m-Y",strtotime($tgl_baru)),
      //     'nama_obat' => $stok_awal['nama_obat'],
      //     'kode_obat' => $id,
      //     'stok_awal' => $sisa_stok,
      //     'penerimaan' => $penerimaan['jumlah']==NULL?0:$penerimaan['jumlah'],
      //     'persediaan' => $persediaan,
      //     'pengeluaran_ugd' => $pengeluaran_ugd['jumlah'],
      //     'pengeluaran_apotek' => $pengeluaran_apotek['jumlah'],
      //     'stok_opname' => $stok_opname['jumlah']==NULL?0:$stok_opname['jumlah'],
      //     'retur' => $retur['jumlah']==NULL?0:$retur['jumlah'],
      //     'sisa_stok' => $sisa,
      //   ));
      // }
      // $sisa_stok = $sisa;
      array_push($data, $sisa_stok);
    }
    // // die(var_dump($data))
    // return $data;
    return $data;
  }



  public function get_kartu_stok_semua($id)
  {
    $batas = "2020-08-31";
    $stok_awal = $this->db
      ->select("SUM(jumlah_stok) as jumlah,nama_obat")
      ->join("obat", "obat.idobat=gudang_obat.obat_idobat")
      ->where(array("obat_idobat" => $id, "DATE(tanggal) <" => $batas))
      ->get("gudang_obat")
      ->row_array();
    $stok_opname = $this->db->select("SUM(selisih) as jumlah")
      ->where(array("obat_idobat" => $id, "DATE(tanggal) <" => $batas, "unit_obat" => "GUDANG"))
      ->get("stok_opname")->row_array();

    $pengeluaran = $this->db
      ->select("SUM(jumlah_satuan_kecil) as jumlah")
      ->where(array("obat_idobat" => $id, "id_gudang !=" => NULL, "DATE(tanggal) <" => $batas))
      ->get("detail_pembelian_obat")->row_array();
    $sisa_stok = $stok_awal['jumlah'];
    $persediaan = $sisa_stok + $stok_opname['jumlah'];
    $sisa = $persediaan - $pengeluaran['jumlah'];

    $pengeluaran_semua = $this->db
      ->select("SUM(jumlah_satuan_kecil) as jumlah")
      ->where(array("obat_idobat" => $id, "DATE(tanggal) <" => $batas))
      ->get("detail_pembelian_obat")->row_array();
    $pengeluaran_semua = $this->db
      ->select("SUM(jumlah_satuan_kecil) as jumlah")
      ->where(array("obat_idobat" => $id, "DATE(tanggal) <" => $batas))
      ->get("detail_pembelian_obat")->row_array();

    $stok_opname = $this->db->select("SUM(selisih) as jumlah")
      ->where(array("obat_idobat" => $id, "unit_obat !=" => "GUDANG"))
      ->get("stok_opname")->row_array();
    echo $stok_opname['jumlah'];
    die();
    // Convert Ke Date Time
    $biday = new DateTime($tgl);
    $today = new DateTime();

    $diff = $today->diff($biday);
    $lama = $diff->days;
    $sisa_stok = $stok_awal['jumlah'];
    $data = array();
    // var_dump($lama);
    // die();
    for ($i = 0; $i <= $lama; $i++) {
      $tgl_baru = date("Y-m-d", strtotime("+" . $i . " days", strtotime($tgl)));
      // die(var_dump($tgl_baru));
      $penerimaan = $this->db
        ->select("SUM(jumlah_stok) as jumlah")
        ->where(array("obat_idobat" => $id, "stok_awal" => NULL, "DATE(tanggal)" => $tgl_baru))
        ->get("gudang_obat")->row_array();
      $stok_opname = $this->db->select("SUM(selisih) as jumlah")
        ->where(array("obat_idobat" => $id, "DATE(tanggal)" => $tgl_baru, "unit_obat" => "GUDANG"))
        ->get("stok_opname")->row_array();
      $retur = $this->db->select("SUM(jumlah) as jumlah")
        ->where(array("idobat" => $id, "DATE(tanggal)" => $tgl_baru))
        ->get("retur")->row_array();

      $persediaan = $sisa_stok + $penerimaan['jumlah'] + $retur['jumlah'] + $stok_opname['jumlah'];
      $pengeluaran = $this->db
        ->select("SUM(jumlah_satuan_kecil) as jumlah")
        ->where(array("obat_idobat" => $id, "DATE(tanggal)" => $tgl_baru))
        ->get("detail_pembelian_obat")->row_array();
      $sisa = $persediaan - $pengeluaran['jumlah'];

      if ($penerimaan['jumlah'] != NULL || $pengeluaran['jumlah'] != NULL || $stok_opname['jumlah'] != NULL || $retur['jumlah'] != NULL) {
        array_push($data, array(
          'tgl' => date("d-m-Y", strtotime($tgl_baru)),
          'nama_obat' => $stok_awal['nama_obat'],
          'kode_obat' => $id,
          'stok_awal' => $sisa_stok,
          'penerimaan' => $penerimaan['jumlah'] == NULL ? 0 : $penerimaan['jumlah'],
          'persediaan' => $persediaan,
          'pengeluaran' => $pengeluaran['jumlah'] == NULL ? 0 : $pengeluaran['jumlah'],
          'stok_opname' => $stok_opname['jumlah'] == NULL ? 0 : $stok_opname['jumlah'],
          'retur' => $retur['jumlah'] == NULL ? 0 : $retur['jumlah'],
          'sisa_stok' => $sisa,

        ));
      }


      $sisa_stok = $sisa;
    }
    // die(var_dump($data))
    return $data;
  }


  public function get_kartu_stok_ugd($id)
  {
    $so = "2020-08-30";
    $batas = "2020-08-31";
    $stok_awal = $this->db
      ->select("SUM(jumlah_satuan_kecil) as jumlah,nama_obat")
      ->join("obat", "obat.idobat=detail_pembelian_obat.obat_idobat")
      ->where(array("obat_idobat" => $id, "unit" => "UGD", "id_gudang !=" => NULL, "DATE(tanggal) <" => $batas))
      ->get("detail_pembelian_obat")
      ->row_array();
    // $stok_opname = $this->db->select("SUM(selisih) as jumlah")
    // ->where(array("obat_idobat"=>$id,"DATE(tanggal) <" => $batas,"unit_obat"=>"GUDANG"))
    // ->get("stok_opname")->row_array();
    //
    $pengeluaran = $this->db
      ->select("SUM(jumlah_beri) as jumlah")
      ->join("detail_pembelian_obat", "id_pengadaan=iddetail_pembelian_obat")
      ->where(array("detail_pembelian_obat.obat_idobat" => $id, "detail_pembelian_obat.unit" => "UGD", "DATE(detail_resep_diberikan.tanggal) <" => $batas))
      ->get("detail_resep_diberikan")->row_array();
    // $sisa_stok = $stok_awal['jumlah'];
    // $persediaan = $sisa_stok+$stok_opname['jumlah'];
    // $sisa = $persediaan-$pengeluaran['jumlah'];
    //
    // $pengeluaran_semua = $this->db
    // ->select("SUM(jumlah_satuan_kecil) as jumlah")
    // ->where(array("obat_idobat"=>$id,"DATE(tanggal) <" => $batas))
    // ->get("detail_pembelian_obat")->row_array();
    // $pengeluaran_semua = $this->db
    // ->select("SUM(jumlah_satuan_kecil) as jumlah")
    // ->where(array("obat_idobat"=>$id,"DATE(tanggal) <" => $batas))
    // ->get("detail_pembelian_obat")->row_array();
    //
    $stok_opname = $this->db->select("SUM(jumlah_real) as jumlah")
      ->join("detail_pembelian_obat", "id_pengadaan=iddetail_pembelian_obat")
      ->where(array("detail_pembelian_obat.obat_idobat" => $id, "unit" => "UGD", "DATE(stok_opname.tanggal)" => $so))
      ->get("stok_opname")->row_array();
    // echo $stok_opname['jumlah']."<br>";
    //
    // var_dump($pengeluaran['jumlah']);
    // die();
    // Convert Ke Date Time
    $biday = new DateTime($batas);
    $today = new DateTime();

    $diff = $today->diff($biday);
    $lama = $diff->days;

    $stok_opname['jumlah'] = $stok_opname['jumlah'] == NULL ? 0 : $stok_opname['jumlah'];
    $pengeluaran['jumlah'] = $pengeluaran['jumlah'] == NULL ? 0 : $pengeluaran['jumlah'];
    $sisa_stok = $stok_awal['jumlah'] + $stok_opname['jumlah'] - $pengeluaran['jumlah'];
    $sisa_stok = $stok_opname['jumlah'];
    $data = array();
    array_push($data, array(
      'tgl' => date("d-m-Y", strtotime($so)),
      'nama_obat' => $stok_awal['nama_obat'],
      'kode_obat' => $id,
      'stok_awal' => $sisa_stok,
      'penerimaan' => 0,
      'persediaan' => $sisa_stok,
      'pengeluaran' => 0,
      'stok_opname' => 0,
      'retur' => 0,
      'sisa_stok' => $sisa_stok,

    ));
    // var_dump($sisa_stok);
    // die();
    for ($i = 0; $i <= $lama; $i++) {
      $tgl_baru = date("Y-m-d", strtotime("+" . $i . " days", strtotime($batas)));
      // die(var_dump($tgl_baru));
      $penerimaan = $this->db
        ->select("SUM(jumlah_satuan_kecil) as jumlah")
        ->where(array("obat_idobat" => $id, "unit" => "UGD", "DATE(tanggal)" => $tgl_baru))
        ->get("detail_pembelian_obat")->row_array();
      $stok_opname = $this->db->select("SUM(selisih) as jumlah")
        ->join("detail_pembelian_obat", "iddetail_pembelian_obat=id_pengadaan")
        ->where(array("detail_pembelian_obat.obat_idobat" => $id, "DATE(stok_opname.tanggal)" => $tgl_baru, "unit" => "UGD"))
        ->get("stok_opname")->row_array();
      $retur = $this->db->select("SUM(retur.jumlah) as jumlah")
        ->join("detail_pembelian_obat", "id_pembelian=iddetail_pembelian_obat")
        ->where(array("idobat" => $id, "DATE(retur.tanggal)" => $tgl_baru, "detail_pembelian_obat.unit" => "UGD"))
        ->get("retur")->row_array();

      $persediaan = $sisa_stok + $penerimaan['jumlah'] - $retur['jumlah'] + $stok_opname['jumlah'];
      $pengeluaran = $this->db
        ->select("SUM(jumlah_beri) as jumlah")
        ->join("detail_pembelian_obat", "iddetail_pembelian_obat=id_pengadaan")
        ->where(array("detail_pembelian_obat.obat_idobat" => $id, "DATE(detail_resep_diberikan.tanggal)" => $tgl_baru, "detail_pembelian_obat.unit" => "UGD"))
        ->get("detail_resep_diberikan")->row_array();
      $pemakaian = $this->db
        ->select("SUM(jumlah) as jumlah")
        ->where(array("id_obat" => $id, "DATE(tanggal)" => $tgl_baru, "unit" => "UGD"))
        ->get("pemakaian_obat")->row_array();



      $sisa = $persediaan - $pengeluaran['jumlah'] - $pemakaian['jumlah'];

      if ($pemakaian['jumlah'] != NULL || $penerimaan['jumlah'] != NULL || $pengeluaran['jumlah'] != NULL || $stok_opname['jumlah'] != NULL || $retur['jumlah'] != NULL) {
        array_push($data, array(
          'tgl' => date("d-m-Y", strtotime($tgl_baru)),
          'nama_obat' => $stok_awal['nama_obat'],
          'kode_obat' => $id,
          'stok_awal' => $sisa_stok,
          'penerimaan' => $penerimaan['jumlah'] == NULL ? 0 : $penerimaan['jumlah'],
          'persediaan' => $persediaan,
          // 'pengeluaran' => $pengeluaran['jumlah']==NULL?0:$pengeluaran['jumlah']+$pemakaian['jumlah']==NULL?0:$pemakaian['jumlah'],
          'pengeluaran' => $pengeluaran['jumlah'] + $pemakaian['jumlah'] == NULL ? 0 : $pengeluaran['jumlah'] + $pemakaian['jumlah'],
          'stok_opname' => $stok_opname['jumlah'] == NULL ? 0 : $stok_opname['jumlah'],
          'retur' => $retur['jumlah'] == NULL ? 0 : $retur['jumlah'],
          'sisa_stok' => $sisa,

        ));
      }


      $sisa_stok = $sisa;
    }
    // die(var_dump($data))
    return $data;
  }

  public function get_kartu_stok_apotek($id)
  {
    $so = "2020-08-30";
    $batas = "2020-08-31";
    $stok_awal = $this->db
      ->select("SUM(jumlah_satuan_kecil) as jumlah,nama_obat")
      ->join("obat", "obat.idobat=detail_pembelian_obat.obat_idobat")
      ->where(array("obat_idobat" => $id, "unit" => "APOTEK", "id_gudang !=" => NULL, "DATE(tanggal) <" => $batas))
      ->get("detail_pembelian_obat")
      ->row_array();
    // $stok_opname = $this->db->select("SUM(selisih) as jumlah")
    // ->where(array("obat_idobat"=>$id,"DATE(tanggal) <" => $batas,"unit_obat"=>"GUDANG"))
    // ->get("stok_opname")->row_array();
    //
    $pengeluaran = $this->db
      ->select("SUM(jumlah_beri) as jumlah")
      ->join("detail_pembelian_obat", "id_pengadaan=iddetail_pembelian_obat")
      ->where(array("detail_pembelian_obat.obat_idobat" => $id, "detail_pembelian_obat.unit" => "APOTEK", "DATE(detail_resep_diberikan.tanggal) <" => $batas))
      ->get("detail_resep_diberikan")->row_array();
    // $sisa_stok = $stok_awal['jumlah'];
    // $persediaan = $sisa_stok+$stok_opname['jumlah'];
    // $sisa = $persediaan-$pengeluaran['jumlah'];
    //
    // $pengeluaran_semua = $this->db
    // ->select("SUM(jumlah_satuan_kecil) as jumlah")
    // ->where(array("obat_idobat"=>$id,"DATE(tanggal) <" => $batas))
    // ->get("detail_pembelian_obat")->row_array();
    // $pengeluaran_semua = $this->db
    // ->select("SUM(jumlah_satuan_kecil) as jumlah")
    // ->where(array("obat_idobat"=>$id,"DATE(tanggal) <" => $batas))
    // ->get("detail_pembelian_obat")->row_array();
    //
    $stok_opname = $this->db->select("SUM(jumlah_real) as jumlah")
      ->join("detail_pembelian_obat", "id_pengadaan=iddetail_pembelian_obat")
      ->where(array("detail_pembelian_obat.obat_idobat" => $id, "unit" => "APOTEK", "DATE(stok_opname.tanggal)" => $so))
      ->get("stok_opname")->row_array();
    // echo $stok_opname['jumlah']."<br>";
    //
    // var_dump($stok_opname['jumlah']);
    // die();
    // Convert Ke Date Time
    $biday = new DateTime($batas);
    $today = new DateTime();

    $diff = $today->diff($biday);
    $lama = $diff->days;

    $stok_opname['jumlah'] = $stok_opname['jumlah'] == NULL ? 0 : $stok_opname['jumlah'];

    // $pengeluaran['jumlah'] = $pengeluaran['jumlah']==NULL?0:$pengeluaran['jumlah'];
    // $sisa_stok = $stok_awal['jumlah']+$stok_opname['jumlah']-$pengeluaran['jumlah'];
    $sisa_stok = $stok_opname['jumlah'];
    $data = array();
    // var_dump($sisa_stok);
    // die();

    array_push($data, array(
      'tgl' => date("d-m-Y", strtotime($so)),
      'nama_obat' => $stok_awal['nama_obat'],
      'kode_obat' => $id,
      'stok_awal' => $sisa_stok,
      'penerimaan' => 0,
      'persediaan' => $sisa_stok,
      'pengeluaran' => 0,
      'stok_opname' => 0,
      'retur' => 0,
      'sisa_stok' => $sisa_stok,

    ));
    for ($i = 0; $i <= $lama; $i++) {
      $tgl_baru = date("Y-m-d", strtotime("+" . $i . " days", strtotime($batas)));
      // die(var_dump($tgl_baru));
      $penerimaan = $this->db
        ->select("SUM(jumlah_satuan_kecil) as jumlah")
        ->where(array("obat_idobat" => $id, "unit" => "APOTEK", "DATE(tanggal)" => $tgl_baru))
        ->get("detail_pembelian_obat")->row_array();
      $stok_opname = $this->db->select("SUM(selisih) as jumlah")
        ->join("detail_pembelian_obat", "iddetail_pembelian_obat=id_pengadaan")
        ->where(array("detail_pembelian_obat.obat_idobat" => $id, "DATE(stok_opname.tanggal)" => $tgl_baru, "unit" => "APOTEK"))
        ->get("stok_opname")->row_array();
      $retur = $this->db->select("SUM(retur.jumlah) as jumlah")
        ->join("detail_pembelian_obat", "id_pembelian=iddetail_pembelian_obat")
        ->where(array("idobat" => $id, "DATE(retur.tanggal)" => $tgl_baru, "detail_pembelian_obat.unit" => "APOTEK"))
        ->get("retur")->row_array();

      $persediaan = $sisa_stok + $penerimaan['jumlah'] - $retur['jumlah'] + $stok_opname['jumlah'];
      $pengeluaran = $this->db
        ->select("SUM(jumlah_beri) as jumlah")
        ->join("detail_pembelian_obat", "iddetail_pembelian_obat=id_pengadaan")
        ->where(array("detail_pembelian_obat.obat_idobat" => $id, "DATE(detail_resep_diberikan.tanggal)" => $tgl_baru, "detail_pembelian_obat.unit" => "APOTEK"))
        ->get("detail_resep_diberikan")->row_array();

      $pemakaian = $this->db
        ->select("SUM(jumlah) as jumlah")
        ->where(array("id_obat" => $id, "DATE(tanggal)" => $tgl_baru, "unit" => "APOTEK"))
        ->get("pemakaian_obat")->row_array();



      $sisa = $persediaan - $pengeluaran['jumlah'] - $pemakaian['jumlah'];

      if ($pemakaian['jumlah'] != NULL || $penerimaan['jumlah'] != NULL || $pengeluaran['jumlah'] != NULL || $stok_opname['jumlah'] != NULL || $retur['jumlah'] != NULL) {
        array_push($data, array(
          'tgl' => date("d-m-Y", strtotime($tgl_baru)),
          'nama_obat' => $stok_awal['nama_obat'],
          'kode_obat' => $id,
          'stok_awal' => $sisa_stok,
          'penerimaan' => $penerimaan['jumlah'] == NULL ? 0 : $penerimaan['jumlah'],
          'persediaan' => $persediaan,
          // 'pengeluaran' => $pengeluaran['jumlah']==NULL?0:$pengeluaran['jumlah']+$pemakaian['jumlah']==NULL?0:$pemakaian['jumlah'],
          'pengeluaran' => $pengeluaran['jumlah'] + $pemakaian['jumlah'] == NULL ? 0 : $pengeluaran['jumlah'] + $pemakaian['jumlah'],
          'stok_opname' => $stok_opname['jumlah'] == NULL ? 0 : $stok_opname['jumlah'],
          'retur' => $retur['jumlah'] == NULL ? 0 : $retur['jumlah'],
          'sisa_stok' => $sisa,

        ));
      }


      $sisa_stok = $sisa;
    }
    // die(var_dump($data))
    return $data;
  }

  // public function get_stok_apotek($id){
  //   $this->db->select("SUM(stok) as stok");
  //   // $this->db->get('kategori_obat',"kategori_obat.idkategori_obat=obat.kategori_obat_idkategori_obat","left");
  //   $this->db->where(array("id_obat"=>$id,"DATE(tanggal)" => $tgl_baru,"unit"=>"UGD"))
  //   return $this->db->get('list_batch')->result();
  // }
}
