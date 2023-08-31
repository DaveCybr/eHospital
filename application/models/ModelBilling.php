<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelBilling extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function detail_bhp($id_kunjungan){
    return $this->db
    ->join("obat","obat.idobat=pemakaian_obat.id_obat")
    ->get_where("pemakaian_obat",array("nourut_kunjungan"=>$id_kunjungan))->result();
  }
  public function total_bhp($id_kunjungan){
    return $this->db
    ->select("SUM(total_harga) as jumlah")
    ->get_where("pemakaian_obat",array("nourut_kunjungan"=>$id_kunjungan))->row_array();
  }
  public function get_riwayat_kamar($id_kunjungan){
    return $this->db
    ->join("tempat_tidur","tempat_tidur.no_tt=riwayat_pindahkamar.id_bed")
    ->get_where("riwayat_pindahkamar",array("id_kunjungan"=>$id_kunjungan))->result();
  }
  function data_list()
  {
    $date = date("Y-m-d");
    // $this->db->where("billing",NULL);
    return $this->db
    ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
    ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
    ->join("jenis_pasien","jenis_pasien.kode_jenis=kunjungan.sumber_dana")
    ->where("acc_ranap !=",1)
    ->where("sudah < ",5)
    ->where("tgl",$date)
    ->where("billing",NULL)
    ->order_by("jam_daftar","ASC")
    ->get("kunjungan");
    // return $query = $this->db->query("Select * from kunjungan,tujuan_pelayanan, pasien,jenis_pasien where jenis_pasien.kode_jenis=kunjungan.sumber_dana && acc_ranap != 1 && sudah < 5 && kunjungan.pasien_noRM = pasien.noRM && tgl='".$date."' && tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel ORDER BY no_urutkunjungan DESC");
  }
  function data_filter($tanggal,$sts,$poli)
  {
    $this->db->join('tujuan_pelayanan',"kunjungan.tupel_kode_tupel=tujuan_pelayanan.kode_tupel");
    $this->db->join('pasien','pasien.noRM=kunjungan.pasien_noRM');
    $this->db->join('jenis_pasien','jenis_pasien.kode_jenis=kunjungan.sumber_dana');
    $this->db->order_by("no_urutkunjungan","DESC");
    if ($tanggal!=null || $tanggal!='') {
      $this->db->where('tgl',$tanggal);
    }
    if ($sts!=null || $sts!='') {
      if ($sts==0) {
        $sts=NULL;
      }
      $this->db->where('billing',$sts);
    }
    if ($poli!=null || $poli!='') {
      $this->db->where('kode_tupel',$poli);
    }
    $this->db->where('acc_ranap !=',1);
    return $this->db->get('kunjungan')->result();
  }

  function list_laporan()
  {
    return $query = $this->db->query("Select * from kunjungan,tujuan_pelayanan, pasien, billing where kunjungan.pasien_noRM = pasien.noRM && tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel && billing.kunjungan_no_urutkunjungan = kunjungan.no_urutkunjungan");
  }

  function data_periksa($id_kun){
      return $this->db->get_where('periksa',array('kunjungan_no_urutkunjungan'=>$id_kun));
  }
  function data_ranap($id){
    $this->db->join('rujukan_internal','kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where("kunjungan",array('no_urutkunjungan'=>$id,'tujuan_poli'=>"RANAP"))->row_array();
  }
  function get_all_periksa($id){
    return $this->db->get_where('periksa',array('rujukan_internal_idrujukan_internal'=>$id))->result();
  }

  function data_resep($periksa){
    return $this->db->get_where('resep',array('periksa_idperiksa'=>$periksa));
  }

  function total_resep($no_resep){
    $this->db->select_sum('total_harga');
    $this->db->join("resep","resep_no_resep=no_resep");
    $this->db->join("periksa","periksa_idperiksa=idperiksa");

    return $this->db->get_where('detail_resep',array('no_resep'=>$no_resep));
  }

  function detail_resep($no_resep){
    $this->db->join('obat',"obat.idobat=detail_resep.obat_idobat");
    return $this->db->get_where('detail_resep',array('resep_no_resep'=>$no_resep));
  }
  function detail_resep2($no_resep){
    if (!empty($no_resep)) {
      $this->db->join('obat',"obat.idobat=detail_resep.obat_idobat");
      $this->db->where_in('resep_no_resep',$no_resep);
      return $this->db->get('detail_resep');
    }
  }
  function japel($kun)
  {
      $this->db->join('periksa', 'periksa.idperiksa = tindakan.periksa_idperiksa');
      $this->db->join('kunjungan', 'kunjungan.no_urutkunjungan = periksa.kunjungan_no_urutkunjungan');
      $this->db->where('kunjungan.no_urutkunjungan = '.$kun);
      return $this->db->get('tindakan');
  }
  function japel2($kun)
  {
      $this->db->select("harga,SUM(harga) as harga_tot,jsmedis,COUNT(*) as jumlah");
      $this->db->join('periksa', 'periksa.idperiksa = tindakan.periksa_idperiksa');
      $this->db->join('kunjungan', 'kunjungan.no_urutkunjungan = periksa.kunjungan_no_urutkunjungan');
      $this->db->where('kunjungan.no_urutkunjungan = '.$kun);
      $this->db->group_by('kodejasa');
      return $this->db->get('tindakan');
  }
  function japel_ranap($id)
  {
      return $this->db->get_where('tindakan',array('periksa_idperiksa'=>$id));
  }
  function totaljapel($kun)
  {
      $this->db->select_sum('harga');
      $this->db->join('periksa', 'periksa.idperiksa = tindakan.periksa_idperiksa');
      $this->db->join('kunjungan', 'kunjungan.no_urutkunjungan = periksa.kunjungan_no_urutkunjungan');
      $this->db->where('kunjungan.no_urutkunjungan = '.$kun);
      return $this->db->get('tindakan');
  }

  function lab($kun)
  {
      $this->db->join('labkunjungan', 'labkunjungan.nokunjlab = detaillab.nourutlab');
      $this->db->join('periksa', 'periksa.idperiksa = labkunjungan.periksa_idperiksa');
      $this->db->join('kunjungan', 'kunjungan.no_urutkunjungan = periksa.kunjungan_no_urutkunjungan');
      $this->db->where('kunjungan.no_urutkunjungan = '.$kun);
      return $this->db->get('detaillab');
  }
  function lab2($kun)
  {
      $this->db->select('SUM(harga) as total_harga,harga,COUNT(*) as jumlah,nama,kodelab');
      $this->db->join('labkunjungan', 'labkunjungan.nokunjlab = detaillab.nourutlab');
      $this->db->join('periksa', 'periksa.idperiksa = labkunjungan.periksa_idperiksa');
      $this->db->join('kunjungan', 'kunjungan.no_urutkunjungan = periksa.kunjungan_no_urutkunjungan');
      $this->db->where('kunjungan.no_urutkunjungan = '.$kun);
      $this->db->group_by("kodelab");
      return $this->db->get('detaillab');
  }
  function totallab($kun)
  {
      $this->db->select_sum('harga');
      $this->db->join('labkunjungan', 'labkunjungan.nokunjlab = detaillab.nourutlab');
      $this->db->join('periksa', 'periksa.idperiksa = labkunjungan.periksa_idperiksa');
      $this->db->join('kunjungan', 'kunjungan.no_urutkunjungan = periksa.kunjungan_no_urutkunjungan');
      $this->db->where('kunjungan.no_urutkunjungan = '.$kun);
      return $this->db->get('detaillab');
  }
  function totallab_ranap($id)
  {
      $this->db->select_sum('harga');
      $this->db->join('labkunjungan', 'labkunjungan.nokunjlab = detaillab.nourutlab');
      $this->db->join('periksa', 'periksa.idperiksa = labkunjungan.periksa_idperiksa');
      $this->db->where('idperiksa',$id);
      return $this->db->get('detaillab');
  }

  function terbilang($numb){

      $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
      if($numb < 12)
        return " " . $huruf[$numb];
      elseif ($numb < 20)
        return $this->terbilang($numb - 10) . " belas";
      elseif ($numb < 100)
        return $this->terbilang($numb / 10) . " puluh" . $this->terbilang($numb % 10);
      elseif ($numb < 200)
        return " seratus" . $this->terbilang($numb - 100);
      elseif ($numb < 1000)
        return $this->terbilang($numb / 100) . " ratus" . $this->terbilang($numb % 100);
      elseif ($numb < 2000)
        return " seribu" . $this->terbilang($numb - 1000);
      elseif ($numb < 1000000)
        return $this->terbilang($numb / 1000) . " ribu" . $this->terbilang($numb % 1000);
      elseif ($numb < 1000000000)
        return $this->terbilang($numb / 1000000) . " juta" . $this->terbilang($numb % 1000000);
      elseif ($numb >= 1000000000)
        return false;

  }

  function biaya()
  {
    return $this->db->get('biayaadmin');
  }

  //ModelRanap
  function get_kamar($id){
    return $this->db->get_where('tempat_tidur',array("no_tt"=>$id));
  }
  function get_all_periksa2($nokun){
    return $this->db->get_where('periksa',array('kunjungan_no_urutkunjungan'=>$nokun))->result();
  }

  function get_all_resep($id){
    $this->db->join('detail_resep','resep.no_resep=detail_resep.resep_no_resep');
    return $this->db->get_where('resep',array('periksa_idperiksa'=>$id))->result();
  }
  function get_tot_dapur($id_kunjungan){
    return $this->db->select("SUM(harga) as jumlah")
    ->get_where('dapur',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->row_array();

  }
  function get_detil_dapur($id_kunjungan){
    return $this->db
    ->order_by('iddapur','desc')
    ->get_where('dapur',array('kunjungan_no_urutkunjungan'=>$id_kunjungan))->result();

  }

}
?>
