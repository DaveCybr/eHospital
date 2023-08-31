<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelInventaris extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data()
  {
    $this->db->join("ruangan","inventaris.ruangan_idruangan=ruangan.idruangan");
    return $this->db->get('inventaris');
  }

  function get_akun($norek){
    return $this->db
    ->get_where("mbesar",array("norek_mbesar"=>$norek))->row_array();
  }

  function get_data_edit($id)
  {
    $this->db->join("ruangan","inventaris.ruangan_idruangan=ruangan.idruangan");
    $this->db->where('noinven', $id);
    return $this->db->get('inventaris')->row_array();
  }
  public function generate_noinven(){
    $get_data = $this->db->select_max("noinven")->get('inventaris')->row_array();
    if($get_data){
      $kode = (int) $get_data['noinven'];
      $kode = $kode+1;
      $kode_noinven = str_pad($kode,4,"0",STR_PAD_LEFT);
    }else{
      $kode_noinven = "0001";
    }
    return $kode_noinven;
  }
  public function generate_notrans(){
    $get_data = $this->db->select_max("no_transaksi")->get('jurnal')->row_array();
    $date = date('Ymd');
    if(!empty($get_data)){
      $kode_transaksi = substr($get_data['no_transaksi'],8);
      if ($kode_transaksi==$date) {
          $no_transaksi = (int) substr($get_data['no_transaksi'],-3);
          $no_transaksi += 1;
          $no = str_pad($no_transaksi,3,"0",STR_PAD_LEFT);
      }else{
          $no = '001';
      }
    }else{
      $no = '001';
    }
    $no_trans = $date.$no;
    return $no_trans;
  }

}
