<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelHutang extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    $this->db->join('supplier',"supplier.kode_sup=pembelian_obat.supplier_kode_sup");
    $this->db->join('hutang',"hutang.pembelian_obat_no_nota=pembelian_obat.no_nota");
    $this->db->order_by('pembelian_obat.tanggal_masuk','DESC');
    return $this->db->get_where('pembelian_obat',array('status'=>'Belum Lunas'));
  }

  public function get_data_hutang($tanggal=null)
  {
    $this->db->join('supplier',"supplier.kode_sup=pembelian_obat.supplier_kode_sup");
    $this->db->join('hutang',"hutang.pembelian_obat_no_nota=pembelian_obat.no_nota");
    $this->db->where('pembelian_obat.status','Belum Lunas');
    if ($tanggal != '' || $tanggal != null) {
      $this->db->where('pembelian_obat.tanggal_masuk',$tanggal);
    }
    $this->db->order_by('pembelian_obat.tanggal_masuk','DESC');
    return $this->db->get('pembelian_obat');
  }

  public function get_data_lunas($tanggal=null)
  {
    $this->db->join('supplier',"supplier.kode_sup=pembelian_obat.supplier_kode_sup");
    $this->db->join('hutang',"hutang.pembelian_obat_no_nota=pembelian_obat.no_nota");
    if ($tanggal != '' || $tanggal != null) {
      $this->db->where('pembelian_obat.tanggal_masuk',$tanggal);
    }
    $this->db->where('pembelian_obat.status','Lunas');
    $this->db->order_by('pembelian_obat.tanggal_masuk','DESC');
    return $this->db->get_where('pembelian_obat');
  }
}
