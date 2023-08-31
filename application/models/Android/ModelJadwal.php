<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelJadwal extends CI_Model{
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

  public function get_jadwal($tanggal){
    $data = $this->db
    ->select("jadwal.*,nama,jabatan,keahlian")
    ->like("hari",$tanggal,"BOTH")
    ->order_by("jam_mulai")
    ->join("pegawai","pegawai.NIK=jadwal.pegawai_NIK")
    ->get("jadwal")->result();
    $response = array();
    foreach ($data as $value) {
      $jam_mulai = explode(":",$value->jam_mulai);
      $jam_akhir = explode(":",$value->jam_akhir);
      $selisih = ($jam_akhir[0]-$jam_mulai[0])/2;
      $jam = array();
      for ($i=0; $i < $selisih ; $i++) {
        $j = implode(":",$jam_mulai);
        $jam_mulai[0] = $jam_mulai[0]+2;
        $jam_mulai[0] = str_pad($jam_mulai[0],2,"0",STR_PAD_LEFT);
        array_push($jam,array(
          'jam' => $j."-".implode(":",$jam_mulai)));
      }
      // die(var_dump($jam));
      array_push($response,array(
          'NIK' => $value->pegawai_NIK,
          'dokter' => $value->nama,
          'jadwal' => $jam
      ));
    }
    return $response;
  }

  public function get_kamar(){
    $data = $this->db
    ->select("CONCAT('Tempat tidur kosong ',count(*)) as jumlah,CONCAT(nama_kamar,' ( kelas ',kelas, ' )') as nama_kamar")
    ->group_by("nama_kamar")
    ->order_by("kelas","DESC")
    ->order_by("nama_kamar","ASC")
    ->get_where("tempat_tidur",array("status_terisi"=>0))->result();
    return $data;
  }

  public function get_operasi(){
    $response = array();
    $data = $this->db
    ->join("pegawai","pegawai.NIK=jadwal_operasi.pegawai_NIK")
    ->where("tanggal >=",date("Y-m-d"))
    ->get("jadwal_operasi")->result();
    foreach ($data as $value) {
      $tgl = $this->hari[date("D",strtotime($value->tanggal))].", ".date("d-m-Y",strtotime($value->tanggal));
      array_push($response,array(
        'nama' => $value->nama,
        'jadwal' => $tgl." Jam ".$value->jam." di Ruang Operasi"
      ));
    }
    return $response;
  }

  public function get_slot($dokter,$tanggal,$jam,$interval){
    // $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
    $interval = $interval*10;
    // $jam = strtotime($jam);
    $response = array();
    $now = date("H:i",strtotime("+12 minutes"));
    // die($jam);
    for ($i=0; $i < $interval ; $i++) {
      $jam = date("H:i",strtotime("+6 minutes",strtotime($jam)));
      $cek = $this->db->get_where("booking",array('tanggal'=>$tanggal,'jam'=>$jam,'pegawai_NIK'=>$dokter))->num_rows();
      if (date("Y-m-d")==$tanggal) {
          if (strtotime($now) > strtotime($jam)) {
              $sts =0;
          }else{
            $sts =1;
          }
      }else{
        $sts=1;
      }
      array_push($response,array(
        'jam' => $jam,
        'status' => $cek==0 && $sts==1?0:1,
      ));
    }
    // die(var_dump($response));
    return $response;

  }

  public function get_bank($id){
    $book = $this->db->get_where("booking",array("idbooking"=>$id))->row_array();
    $waktuawal  = date_create(); //waktu di setting
    $waktuakhir = date_create(date("Y-m-d H:i",strtotime($book['akhir_bayar']))); //2019-02-21 09:35 waktu sekarang
    $diff  = date_diff($waktuawal, $waktuakhir);
    $batas = array(
      'jam' => $diff->h,
      'menit' => $diff->i,
      'detik' => $diff->s
    );
    $bank = $this->db->get("bank")->result();
    $response = array(
      'total' => number_format($book['nominal']),
      'batas' => $batas,
      'bank' => $bank
    );
    return $response;

  }
}
