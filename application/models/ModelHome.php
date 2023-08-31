<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelHome extends CI_Model{
  public $hari = array(
    'Sun' => "Minggu",
    'Mon' => "Senin",
    'Tue' => "Selasa",
    'Wed' => "Rabu",
    'Thu' => "Kamis",
    'Fri' => "Jum'at",
    'Sat' => "Sabtu"
  );
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function count_hutang_rekanan(){
    $date = "2020-05-03";
    return $this->db
    ->select("(SUM(kredit)-SUM(debet)) as total")
    ->get_where("jurnal",array("norek"=>"211.001","DATE(tanggal) >= "=>$date))->row_array();
  }

  public function jadwal_operasi(){
    $data = $this->db
    ->group_by("tanggal")
    ->order_by("tanggal")
    ->get_where("jadwal_operasi",array("DATE(tanggal)>="=>date("Y-m-d")))->result();
    $respone = array();
    if (!empty($data)) {
      foreach ($data as $value) {
        array_push($respone,array(
          'hari' => $this->hari[date("D",strtotime($value->tanggal))].", ".date("d-m-Y",strtotime($value->tanggal)),
          'jenis' => 0,
        ));
        $jam = $this->db
        ->join("pegawai","pegawai.NIK=jadwal_operasi.pegawai_NIK")
        ->order_by("jam")
        ->get_where("jadwal_operasi",array("tanggal"=>$value->tanggal))->result();
        foreach ($jam as $j) {
          array_push($respone,array(
            'hari' => NULL,
            'jam' => $j->jam,
            'dokter' => $j->nama,
            'kamar' => "Kamar Operasi",
            'statu' => "Terpakai",
            'jenis' => 1
          ));
        }
      }
    }
    // die(var_dump($respone));
    return $respone;
  }

  public function get_daftar(){
    return $this->db
    ->select("count(*) as jumlah,unit_layanan")
    ->group_by('unit_layanan')
    ->join("periksa","periksa.idperiksa=labkunjungan.periksa_idperiksa")
    ->get_where('labkunjungan',array('status'=>1,'DATE(jam)'=>date("Y-m-d")))->result();
  }

  public function get_tt(){
    return $this->db
    ->group_by("nama_kamar")
    ->select("nama_kamar,kelas,tarif,count(*) as kapasitas,biaya_makan")
    ->get("tempat_tidur")
    ->result();
  }
  public function count_lab(){
    $this->db->select("count(*) as total");
    return $this->db->get_where('labkunjungan',array('DATE(tanggal)'=>date("Y-m-d")))->row_array();
  }
  public function sudah(){
    $this->db->select("count(*) as total");
    return $this->db->get_where('labkunjungan',array('DATE(tanggal)'=>date("Y-m-d"),'status'=>2))->row_array();
  }
  public function belum(){
    $this->db->select("count(*) as total");
    return $this->db->get_where('labkunjungan',array('DATE(tanggal)'=>date("Y-m-d"),'status'=>1))->row_array();
  }

  public function count_total_kamar(){
    $this->db->select("count(*) as jumlah");
    return $this->db->get('tempat_tidur')->row_array();
  }
  public function count_kamar_kosong(){
    $this->db->select("count(*) as jumlah");
    return $this->db->get_where('tempat_tidur',array('status_terisi'=>0))->row_array();
  }
  public function kamar_kosong(){
    return $this->db->get_where('tempat_tidur',array('status_terisi'=>0))->result();
  }
  public function count_kamar_terisi(){
    $this->db->select("count(*) as jumlah");
    return $this->db->get_where('tempat_tidur',array('status_terisi'=>1))->row_array();
  }
  public function get_hari_ini($kode_tupel,$tgl){
    $this->db->select("count(*) as jumlah,tupel_kode_tupel");
    return $this->db->get_where('kunjungan',array('tupel_kode_tupel'=>$kode_tupel,'tgl'=>$tgl));
  }
  public function get_tahun_ini($kode_tupel,$bln,$thn){
    $this->db->select("count(*) as jumlah,tupel_kode_tupel");
    return $this->db->get_where('kunjungan',array('tupel_kode_tupel'=>$kode_tupel,'month(tgl)'=>$bln,'year(tgl)'=>$thn));
  }

  public function count_all_pasien(){
    $this->db->select('count(*) as total');
    return $this->db->get('pasien')->row_array();
  }
  public function count_last_pasien(){
    $date = date("Y-m-d",strtotime("-1 month"));
    $date1 = date("Y-m-t",strtotime($date));
    $this->db->select('count(*) as total');
    return $this->db->get_where('pasien',array('DATE(tgl_daftar) <='=>$date1))->row_array();
  }
  public function count_all_kunjungan(){

    $this->db->select('count(*) as total');
    return $this->db->get('kunjungan')->row_array();
  }
  public function count_last_kunjungan(){
    $date = date("Y-m-d",strtotime("-1 month"));
    $date1 = date("Y-m-t",strtotime($date));
    $this->db->select('count(*) as total');
    return $this->db->get_where('kunjungan',array('DATE(tgl) <='=>$date1))->row_array();
  }
  public function count_pasien_baru(){
    $date = date("Y-m-d");
    $this->db->select("count(*) as total");
    return $this->db->get_where("pasien",array('tgl_daftar'=>$date))->row_array();
  }
  public function get_pasien_baru(){
    $date = date("Y-m-d");
    return $this->db->get_where("pasien",array('tgl_daftar'=>$date))->result();
  }
  public function count_pasien_kemarin(){
    $date = date("Y-m-d",strtotime("-1 days"));
    $this->db->select("count(*) as total");
    return $this->db->get_where("pasien",array('tgl_daftar'=>$date))->row_array();
  }
  public function count_pasien_bulan_ini(){
    $date = date("m");
    $date2 = date("Y");
    $this->db->select("count(*) as total");
    return $this->db->get_where("pasien",array('MONTH(tgl_daftar)'=>$date,'YEAR(tgl_daftar)'=>$date2))->row_array();
  }

  public function count_kunjungan_baru(){
    $date = date("Y-m-d");
    $this->db->select("count(*) as total");
    return $this->db->get_where("kunjungan",array('tgl'=>$date))->row_array();
  }
  public function get_kunjungan_baru(){
    $date = date("Y-m-d");
    return $this->db
    ->join('tujuan_pelayanan',"tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
    ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
    ->get_where("kunjungan",array('tgl'=>$date))->result();
  }
  public function count_kunjungan_kemarin(){
    $date = date("Y-m-d",strtotime("-1 days"));
    $this->db->select("count(*) as total");
    return $this->db->get_where("kunjungan",array('tgl'=>$date))->row_array();
  }

  public function count_kunjungan_bulan_ini(){
    $date = date("m");
    $year = date("Y");
    $this->db->select("count(*) as total");
    return $this->db->get_where("kunjungan",array('MONTH(tgl)'=>$date,"YEAR(tgl)"=>$year))->row_array();
  }
  public function count_kunjungan_bulan_lalu(){
    $date = date("Y-m-d",strtotime("-1 month"));
    // die($date);
    $bulan = date("m",strtotime($date));
    $year = date("Y",strtotime($date));
    $this->db->select("count(*) as total");
    return $this->db->get_where("kunjungan",array('MONTH(tgl)'=>$bulan,"YEAR(tgl)"=>$year))->row_array();
  }


  public function count_kunjungan_baru_lab(){
    $date = date("Y-m-d");
    $this->db->select("count(*) as total");
    return $this->db->get_where("labkunjungan",array('DATE(jam)'=>$date))->row_array();
  }

  public function count_kunjungan_kemarin_lab(){
    $date = date("Y-m-d",strtotime("-1 days"));
    $this->db->select("count(*) as total");
    return $this->db->get_where("labkunjungan",array('DATE(jam)'=>$date))->row_array();
  }

  public function count_kunjungan_bulan_ini_lab(){
    $date = date("m");
    $year = date("Y");
    $this->db->select("count(*) as total");
    return $this->db->get_where("labkunjungan",array('MONTH(jam)'=>$date,"YEAR(jam)"=>$year))->row_array();
  }
  public function count_kunjungan_bulan_lalu_lab(){
    $date = date("Y-m-d",strtotime("-1 month"));
    // die($date);
    $bulan = date("m",strtotime($date));
    $year = date("Y",strtotime($date));
    $this->db->select("count(*) as total");
    return $this->db->get_where("labkunjungan",array('MONTH(jam)'=>$bulan,"YEAR(jam)"=>$year))->row_array();
  }
}
