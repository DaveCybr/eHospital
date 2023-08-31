<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelResep extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }


  public function get_kunjungan($resep){
    $this->db->join('periksa','periksa.idperiksa=resep.periksa_idperiksa');
    $this->db->join('kunjungan','periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan');
    return $this->db->get_where('resep',array('no_resep'=>$resep))->row_array();

  }
  public function get_resep_beri($kode){
    return $this->db
    ->select("SUM(jumlah_beri) as jumlah_beri,no_batch,jumlah_resep,nama_obat,obat.idobat,detail_resep_diberikan.signa")
    ->order_by("idobat")
    ->group_by("idobat")
    ->join("detail_resep","detail_resep_diberikan.id_detail_resep=detail_resep.iddetail_resep")
    ->join("obat","detail_resep.obat_idobat=obat.idobat")
    ->get_where("detail_resep_diberikan",array("detail_resep_diberikan.resep_no_resep"=>$kode))->result();
  }
  public function get_data(){
    $this->db
    ->join("periksa","periksa.idperiksa=resep.periksa_idperiksa")
    ->join("kunjungan","kunjungan.no_urutkunjungan=periksa.kunjungan_no_urutkunjungan")
    ->join("jenis_pasien","kunjungan.sumber_dana=jenis_pasien.kode_jenis");
    return $this->db->get('resep')->result();
  }
  public function get_dokter($kode){
    return $this->db
    ->join("periksa","periksa.idperiksa=resep.periksa_idperiksa")
    ->join("pegawai","resep.kode_dokter=pegawai.NIK")
    ->join("kunjungan","periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan")
    ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
    ->get_where("resep",array("no_resep"=>$kode))->row_array();
  }

public function get_riwayat($noRM){
  return $this->db
  ->get_where("riwayat_alergi",array("pasien_noRM"=>$noRM))->result();
}
  public function get_data_edit($id){
    return $this->db->get_where('resep',array('no_resep'=>$id))->row_array();
  }

  public function generate_no_resep(){
    $get_data = $this->db->select_max("no_resep")->get('resep')->row_array();
    if($get_data){
      $kode = (int) substr($get_data['no_resep'],3);
      $kode = $kode+1;
      $kode_res = "RES".str_pad($kode,9,"0",STR_PAD_LEFT);
    }else{
      $kode_res = "RES000000001";
    }
    return $kode_res;
  }
  public function get_resep(){
    $this->db->join("periksa","resep.periksa_idperiksa=periksa.idperiksa");
    $this->db->join("pasien","periksa.no_rm=pasien.noRM");
    $this->db->join('kunjungan',"periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan");
    $this->db->join('tujuan_pelayanan',"tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel");
    $this->db->join('jenis_pasien',"kunjungan.sumber_dana=jenis_pasien.kode_jenis");
    $this->db->where("ambil",NULL);
    $this->db->order_by("jam_daftar");
    $this->db->select("acc_ranap,sumber_dana,jenis_pasien,resep.tanggal as tanggal,status_resep,pasien.noRM,tujuan_pelayanan,no_resep,namapasien,kunjungan.billing as billing,ambil");
    return $this->db->get_where("resep",array('DATE(kunjungan.tgl)'=>date("Y-m-d")))->result();
  }
public function get_resep_sudah(){
  $this->db->join("periksa","resep.periksa_idperiksa=periksa.idperiksa");
  $this->db->join("pasien","periksa.no_rm=pasien.noRM");
  $this->db->join('kunjungan',"periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan");
  $this->db->join('tujuan_pelayanan',"tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel");
  $this->db->join('jenis_pasien',"kunjungan.sumber_dana=jenis_pasien.kode_jenis");
  $this->db->where("ambil !=",0);
  $this->db->order_by("jam_daftar");
  $this->db->select("acc_ranap,sumber_dana,jenis_pasien,resep.tanggal as tanggal,status_resep,pasien.noRM,tujuan_pelayanan,no_resep,namapasien,kunjungan.billing as billing,ambil");
  return $this->db->get_where("resep",array('DATE(resep.tanggal)'=>date("Y-m-d")))->result();
  }

  public function get_tebusan($kode){
    $this->db->join('obat','obat.idobat=detail_resep.obat_idobat');
    $this->db->order_by("obat.idobat");
    $this->db->join('resep','resep.no_resep=detail_resep.resep_no_resep');
    return $this->db->get_where('detail_resep',array('resep_no_resep'=>$kode))->result();
  }
  public function get_tebusan2($kode){
    $this->db->join('obat','obat.idobat=detail_resep_diberikan.obat_idobat');
    return $this->db->get_where('detail_resep_diberikan',array('resep_no_resep'=>$kode))->result();
  }
  public function get_pasien($kode){
    $this->db->join("periksa","resep.periksa_idperiksa=periksa.idperiksa");
    $this->db->join("pasien","periksa.no_rm=pasien.noRM");
    $this->db->join('kunjungan',"periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan");
    $this->db->join('tujuan_pelayanan',"tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel");
    $this->db->join("jenis_pasien","jenis_pasien.kode_jenis=kunjungan.sumber_dana");
    $this->db->select("sumber_dana,jenis_pasien,kunjungan.keluhan,pasien.noRM,tujuan_pelayanan,no_resep,namapasien,kunjungan.billing as billing,ambil");
    return $this->db->get_where("resep",array('no_resep'=>$kode))->row_array();
  }
  function get_list_batch($id_obat){
    $this->db->join("obat","obat.idobat=detail_pembelian_obat.obat_idobat");
    $this->db->select("iddetail_pembelian_obat as id_pengadaan,no_batch,obat.idobat,nama_obat,ifNull(jumlah_satuan_kecil-ifNull(jumlah_terjual,0),0) as stok,tanggal_expired as ed, detail_pembelian_obat.satuan_beli as satuan_beli, detail_pembelian_obat.hrg_beli_satuan_kecil as harga_beli");
    return $this->db->get_where("detail_pembelian_obat",array('obat_idobat'=>$id_obat,'stok !='=>0))->result();
  }
  function get_list_batch2($id_obat){
    $this->db->select("iddetail_pembelian_obat as id_pengadaan,no_batch,idobat,nama_obat,tanggal_expired as ed,stok");
    return $this->db->get_where("list_batch",array('idobat'=>$id_obat,'stok !='=>0))->result();
  }
  function get_list_batch_retur($id_obat){
    if ($_SESSION['jabatan']=="pumu" || $_SESSION['jabatan']=="pugd") {
      $unit = "UGD";
    }else{
      $unit = "APOTEK";
    }
    $this->db->select("iddetail_pembelian_obat as id_pengadaan,no_batch,idobat,nama_obat,tanggal_expired as ed,stok");
    return $this->db->get_where("list_batch",array('idobat'=>$id_obat,'stok !='=>0,"unit"=>$unit))->result();
  }
  function data_filter($tanggal,$sts,$poli,$ambil,$jenis)
  {
    // $this->db->join("periksa","resep.periksa_idperiksa=periksa.idperiksa");
    // $this->db->join("pasien","periksa.no_rm=pasien.noRM");
    // $this->db->join('kunjungan',"periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan");
    // $this->db->join('tujuan_pelayanan',"tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel");
    // $this->db->select("acc_ranap,resep.tanggal as tanggal,status_resep,pasien.noRM,tujuan_pelayanan,no_resep,namapasien,kunjungan.billing as billing,ambil");
    // return $this->db->get_where("resep",array('DATE(resep.tanggal)'=>date("Y-m-d")))->result();
    $this->db->join("periksa","resep.periksa_idperiksa=periksa.idperiksa");
    $this->db->join("pasien","periksa.no_rm=pasien.noRM");
    $this->db->join('kunjungan',"periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan");
    $this->db->join('tujuan_pelayanan',"tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel");
    $this->db->join('jenis_pasien',"kunjungan.sumber_dana=jenis_pasien.kode_jenis");
    $this->db->where("ambil",NULL);
    $this->db->order_by("jam_daftar");
    $this->db->select("acc_ranap,sumber_dana,jenis_pasien,resep.tanggal as tanggal,status_resep,pasien.noRM,tujuan_pelayanan,no_resep,namapasien,kunjungan.billing as billing,ambil");
    return $this->db->get_where("resep",array('DATE(resep.tanggal)'=>date("Y-m-d")))->result();

    // $this->db->join("periksa","resep.periksa_idperiksa=periksa.idperiksa");
    // $this->db->join("pasien","periksa.no_rm=pasien.noRM");
    // $this->db->join('kunjungan',"periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan");
    // $this->db->join('tujuan_pelayanan',"tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel");
    // $this->db->select("acc_ranap,resep.tanggal as tanggal,status_resep,pasien.noRM,tujuan_pelayanan,no_resep,namapasien,kunjungan.billing as billing,ambil,kode_tupel");
    if ($tanggal!=null || $tanggal!='') {
      $this->db->where('DATE(resep.tanggal)',$tanggal);
    }
    if ($sts!=null || $sts!='') {
      if ($sts==0) {
        $sts=NULL;
      }
      $this->db->where('kunjungan.billing',$sts);
    }
    if ($poli!=null || $poli!='') {
      $this->db->where('kode_tupel',$poli);
    }
    if ($ambil!=null || $ambil!='') {
      if ($ambil==0) {
        $ambil=NULL;
      }
      $this->db->where('ambil',$ambil);
    }
    if ($jenis!=null || $jenis!='') {
        $this->db->where('sumber_dana',$jenis);
    }
    return $this->db->get('resep')->result();
  }
}
