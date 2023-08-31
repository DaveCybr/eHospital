<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelPasien");

    $this->load->model("Android/ModelDaftar");
    $this->load->model("Android/ModelJadwal");
    $this->load->library('upload');
    $this->load->library('ciqrcode');
  }

  function register(){
    $namapasien = strtoupper($this->input->post("nama"));
    $alamat = strtoupper($this->input->post("alamat"));
    $nohp = $this->input->post("nohp");
    $tgl_lahir = date("Y-m-d",strtotime($this->input->post("tgllahir")));
    $tgl = explode("-",$tgl_lahir);
    $pass = $tgl[2].$tgl[1].$tgl[0];
    $data = array(
      'noRM' => $this->ModelPasien->generete_noRM_sementara(),
      'namapasien'=>$namapasien,
      'alamat'=>$alamat,
      'tgl_lahir'=>$tgl_lahir,
      'telepon' => $nohp,
      'tgl_daftar' => date("Y-m-d"),
      'password' => $pass
    );
    if ($this->db->insert("pasien_sementara",$data)) {
      $data['status'] = 1;
    }else{
      $data['status'] =0;
    }
    echo json_encode($data);

	}

  public function upload(){
    $DefaultId = 0;
    $idbook = $this->input->post("idbooking");
   $ImageData = $_POST['image_data'];

   $ImageName = $_POST['image_tag'];

   $ImagePath = "./foto/pembayaran/$idbook.jpg";


   // $ServerURL = "shadi/$ImagePath";

   // $InsertSQL = "INSERT INTO imageupload (image_path,image_name) values('$ServerURL','$ImageName')";

   file_put_contents($ImagePath,base64_decode($ImageData));
   $this->db->where("idbooking",$idbook)->update("booking",array("status_bayar"=>1,'status_booking'=>1));
   echo "Your Image Has Been Uploaded.";
  }

  public function bank(){
    $idbook = $this->input->post("idbooking");
    $data = $this->ModelJadwal->get_bank($idbook);
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    echo json_encode($data);
  }

  public function simpan_booking(){
    $tupel = array(
      'POLI UMUM' => "UMU",
      'POLI OZON' => "OZO",
      'POLI GIGI' => "GIG",
      'OBSBYN' => "OBG",
      'INTERNIS' => "INT",
      'IGD' => "IGD",
    );
    $data = array(
      'tanggal' => date("Y-m=d",strtotime($this->input->post("tanggal"))),
      'jam' => date("H:i",strtotime($this->input->post("jam"))),
      'pegawai_NIK' => $this->input->post("nik"),
      'noRM' => $this->input->post("noRM"),
      'tupel_kode_tupel' => $tupel[$this->input->post("poli")],
      'jenis_pasien' => $this->input->post("jenis_pasien"),
      'keluhan' => $this->input->post("keluhan"),
      'berat' => $this->input->post("berat"),
      'tinggi' => $this->input->post("tinggi"),
      'status_booking' => 0,
      'akhir_bayar' => date("Y-m-d H:i:s",strtotime("+60 minutes",strtotime(date("Y-m-d H:i:s"))))
    );
    $last = $this->db
    ->order_by("idbooking","DESC")
    ->get_where("booking",array("DATE(tanggal)"=>date("Y-m-d")))->row_array();
    $data['nominal'] = $last['nominal']==NULL?200000:$last['nominal']+1;
    $this->db->insert("booking",$data);
    $data['idbooking'] = $this->db->insert_id();
    $data['nominal'] = number_format($data['nominal']);
    echo json_encode($data);
  }

  public function qrcode(){
    $idbook = $this->input->post("idbooking");
    // $kunjungan = array(
    //   ''
    // );
    $book = $this->db
    ->join("pegawai","pegawai.NIk=booking.pegawai_NIK")
    ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=booking.tupel_kode_tupel")
    ->get_where("booking",array("idbooking"=>$idbook))->row_array();
    $data = array(
      'noantrian' => $book['antrian'],
      'dokter' => $book['nama'],
      'poli' => $book['tujuan_pelayanan'],
      'tanggal' => date("d-m-Y",strtotime($book['tanggal'])),
      'jam' => "Pukul ".$book['jam']." WIB",
      'qr' => base_url()."foto/qrcode_pembayaran/".$idbook.".png",
    );
    echo json_encode($data);
  }

  public function get_history(){
    $norm = $this->input->post("norm");
    // $norm = "200201001";
    $data = $this->ModelDaftar->get_history($norm);
    echo json_encode(array("data"=>$data));
  }


}
