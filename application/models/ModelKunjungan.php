<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKunjungan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function get_data_jenis($id){
    return $this->db
    ->select("jenis_pasien.*")
    ->join("jenis_pasien","kunjungan.sumber_dana=jenis_pasien.kode_jenis")
    ->get_where("kunjungan",array("no_urutkunjungan"=>$id))->row_array();
  }
// model pcare
  public function get_daftar_pcare($tgl){
    $this->db
            ->order_by("no_urutkunjungan","DESC")
            ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
            ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
            ->group_start()
                ->where("sumber_dana",7)
                ->or_where("sumber_dana",9)
            ->group_end()
            ->where(array("status_bridging"=>"0"));

    // $this->db->where(array('sumber_dana' => 7, 'tgl'=>$tgl,'status_bridging'=>1));
    // $this->db->or_where()
    return $this->db->get('kunjungan')->result();
  }
  public function get_periksa_pcare($tgl){
    $this->db
      ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
      ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
      ->group_start()
        ->where("sumber_dana",7)
        ->or_where("sumber_dana",9)
      ->group_end()
      ->where(array("status_bridging_pemeriksaan"=>"0","sudah >="=>3));
      return $this->db->get('kunjungan')->result();
  }

  public function get_data($tgl){
    $poli = $_SESSION['poli'];
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('jenis_pasien', 'kunjungan.sumber_dana = jenis_pasien.kode_jenis',"left");
    $this->db->order_by('tupel_kode_tupel', 'ASC');
    $this->db->order_by('no_antrian', 'ASC');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    if ($poli == null) {
      $this->db->where(array('sudah' => 0, 'tgl'=>$tgl,'acc_ranap !='=>1));
    }else {
      // if ($poli=='IGD' || $poli=='GIG') {
        $this->db->where(array('sudah' => 0, 'tgl'=>$tgl, 'tupel_kode_tupel' => $poli ,'acc_ranap !='=>1));
      // }else{
      //   $this->db->where(array('sudah' => 0, 'tgl'=>$tgl, 'acc_ranap !='=>1));
      //   $this->db->group_start()
      //           ->where('tupel_kode_tupel !=','IGD')
      //           ->or_where('tupel_kode_tupel !=','GIG')
      //           ->group_end();
      // }
    }
    // $this->db->where('acc_ranap !=',1);
    return $this->db->get('kunjungan')->result();
  }

  public function get_data_ugd($tgl){
    $poli = $_SESSION['poli'];
    $this->db->join('pasien', 'pasien.noRM = view_pasien.pasien_noRM');
    $this->db->join('jenis_pasien', 'view_pasien.sumber_dana = jenis_pasien.kode_jenis',"left");
    $this->db->order_by('no_antrian', 'ASC');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = view_pasien.tupel_kode_tupel');
    $this->db->where(array('sudah' => 0, 'tgl'=>$tgl, 'tupel_kode_tupel' => $poli ,'acc_ranap !='=>1));
    return $this->db->get('view_pasien')->result();
  }
  public function get_data_sudah($tgl){
    $poli = $_SESSION['poli'];
    if ($_SESSION['jabatan']=='resepsionis') {
      $poli=null;
    }
    $poliwhere = "";
    if ($poli == null || $poli == '') {
      $poliwhere = "";
    }else{
      // $poliwhere = "&& kunjungan.tupel_kode_tupel = '$poli'";
      $this->db->where("kunjungan.tupel_kode_tupel",$poli);
    }

    $data = $this->db
    ->join("jenis_pasien","kunjungan.sumber_dana=jenis_pasien.kode_jenis")
    ->join("tujuan_pelayanan","kunjungan.tupel_kode_tupel=tujuan_pelayanan.kode_tupel")
    ->join("pasien","kunjungan.pasien_noRM=pasien.noRM")
    ->where("sudah !=",0)
    ->where("tgl",$tgl)
    // ->order_by("jam_daftar","DESC")
    ->order_by('tupel_kode_tupel', 'ASC')
    ->order_by('no_antrian', 'ASC')
    ->get("kunjungan")->result();
    // die(var_dump($data));
    return $data;
    // $query = $this->db
    // // ->order_by("no_antrian","DESC")
    // ->query("Select * from jenis_pasien,kunjungan,tujuan_pelayanan, pasien where sudah != 0 && kunjungan.pasien_noRM = pasien.noRM && jenis_pasien.kode_jenis=kunjungan.sumber_dana && tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel && kunjungan.tgl = '$tgl'".$poliwhere." ORDER BY jam_daftar DESC");
    // return $query->result();
  }

  public function get_data_sudah_ugd($tgl){

    $this->db->where("view_pasien.tupel_kode_tupel","IGD");

    $data = $this->db
    ->join("jenis_pasien","view_pasien.sumber_dana=jenis_pasien.kode_jenis")
    ->join("tujuan_pelayanan","view_pasien.tupel_kode_tupel=tujuan_pelayanan.kode_tupel")
    ->join("pasien","view_pasien.pasien_noRM=pasien.noRM")
    ->where("sudah !=",0)
    ->where("tgl",$tgl)
    ->order_by("jam_daftar","DESC")
    ->get("view_pasien")->result();
    // die(var_dump($data));
    return $data;
    // $query = $this->db
    // // ->order_by("no_antrian","DESC")
    // ->query("Select * from jenis_pasien,kunjungan,tujuan_pelayanan, pasien where sudah != 0 && kunjungan.pasien_noRM = pasien.noRM && jenis_pasien.kode_jenis=kunjungan.sumber_dana && tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel && kunjungan.tgl = '$tgl'".$poliwhere." ORDER BY jam_daftar DESC");
    // return $query->result();
  }


  function max_no($tupel,$kode)
  {
    $tgl = date('Y-m-d');
    $this->db->select_max('no_antrian');
    $this->db->join("pasien","pasien_noRM=noRM");
    $this->db->where(array('tgl' => $tgl ,'jenis_pasien_kode_jenis'=>$kode, 'tupel_kode_tupel' => $tupel ));
    $result = $this->db->get('kunjungan');
    return $result;
  }

  function total($tupel,$kode)
  {
    $tgl = date('Y-m-d');
    $query = $this->db
    ->join("pasien","pasien_noRM=noRM")
    ->where(array('tgl' => $tgl ,'jenis_pasien_kode_jenis'=>$kode, 'tupel_kode_tupel' => $tupel ))
    ->get("kunjungan")->num_rows();
    return $query;
  }

  public function get_data_edit($no_urutkunjungan){
    return $this->db->get_where('kunjungan',array('no_urutkunjungan' => $no_urutkunjungan ))->row_array();
  }
  public function get_data_edit_baru($no_urutkunjungan){
    return $this->db
    ->join("tempat_tidur","tempat_tidur.no_tt=kunjungan.tempat_tidur_no_tt")
    ->get_where('kunjungan',array('no_urutkunjungan' => $no_urutkunjungan ))->row_array();
  }
  public function get_data_edit_ranap($no_urutkunjungan){
    return $this->db
    ->join("tempat_tidur","kunjungan.tempat_tidur_no_tt=tempat_tidur.no_tt")
    ->get_where('kunjungan',array('no_urutkunjungan' => $no_urutkunjungan ))->row_array();
  }

  function riwayat($noRM)
  {
    $this->db->where('pasien_noRM', $noRM);
    return $this->db->get('kunjungan');
  }

  function cek_kunjungan_pcare($tanggal,$no_urut,$nobpjs)
  {
    $this->db->join("pasien","pasien.noRM = kunjungan.pasien_noRM");
    $this->db->where("kunjungan.tgl",date('Y-m-d', strtotime($tanggal)));
    $this->db->where("kunjungan.sumber_dana","7");
    $this->db->where("kunjungan.nourut_pcare",$no_urut);
    $this->db->where("pasien.noBPJS",$nobpjs);
    return $this->db->get("kunjungan");
  }

}
