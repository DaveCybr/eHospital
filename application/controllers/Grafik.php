<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller{
  public $bulan = array('Bulan','Jan','Feb','Mar','Apr','Mei','Jun','Juli','Aug','Sep','Okt','Nov','Des');

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelPekerjaan');
    $this->load->model('ModelPasien');
  }

  function index()
  {
    $data = array(
      'body'      => "Grafik/ozon",
      'pekerjaan'   => $this->ModelPekerjaan->get_data()
    );
    $this->load->view('index', $data);
  }

  function filter_harian(){
    $label_grafik = array();
    $today = date("Y-m-d");
    $respone = array();
    $markPoint = array();
    $markLine = array();
    array_push($markPoint,array('type'=>'max','name'=>'Max'));
    array_push($markPoint,array('type'=>'min','name'=>'Min'));
    array_push($markLine,array('type'=>'average','name'=>'Rata-rata'));
    for ($i=1; $i <= 12 ; $i++) {
      array_push($label_grafik,$this->bulan[$i]);
    }
    $data = array(
        'name' => 'Ozon Mayor',
        'type' => 'bar',
        'data' => array(0,0,0,0,0,0,0,0,0,0,0,0),
        'markPoint' => array('data'=>$markPoint),
        // 'markLine' => array('data'=>$markLine)
    );
    array_push($respone,$data);
    $data = array(
        'name' => 'Ozon Plastik',
        'type' => 'bar',
        'data' => array(0,0,0,0,0,0,0,0,0,0,0,0),
        'markPoint' => array('data'=>$markPoint),
        // 'markLine' => array('data'=>$markLine)
    );
    array_push($respone,$data);
    echo json_encode(array('label' => $label_grafik,'data' => $respone));

  }

  function filter_data(){
    $tahun= date("Y",strtotime($this->input->post("tanggal")));
    $layanan = $this->input->post("unit");
    $data_mayor1 = array();
    $data_plastik1 = array();
    $label_grafik = array();
    // $tahun = "2019";
    // $layanan = "RANAP";
    $total_mayor =0;
    $total_plastik = 0;
    for ($i=1; $i <=12 ; $i++) {
      if ($layanan == "RANAP") {
        $data_mayor = $this->db
        ->select("count(*) as jumlah")
        ->join("periksa","periksa.idperiksa=tindakan.periksa_idperiksa")
        ->get_where("tindakan",array("kodejasa"=>"063","MONTH(tanggal)"=>$i,"YEAR(tanggal)"=>$tahun,"unit_layanan"=>"RANAP"))->row_array();
      }else{
        $data_mayor = $this->db
        ->select("count(*) as jumlah")
        ->join("periksa","periksa.idperiksa=tindakan.periksa_idperiksa")
        ->get_where("tindakan",array("kodejasa"=>"063","MONTH(tanggal)"=>$i,"YEAR(tanggal)"=>$tahun,"unit_layanan !="=>"RANAP"))->row_array();
      }
      if ($layanan == "RANAP") {
        $data_plastik = $this->db
        ->select("count(*) as jumlah")
        ->join("periksa","periksa.idperiksa=tindakan.periksa_idperiksa")
        ->get_where("tindakan",array("kodejasa"=>"082","MONTH(tanggal)"=>$i,"YEAR(tanggal)"=>$tahun,"unit_layanan"=>"RANAP"))->row_array();
      }else{
        $data_plastik = $this->db
        ->select("count(*) as jumlah")
        ->join("periksa","periksa.idperiksa=tindakan.periksa_idperiksa")
        ->get_where("tindakan",array("kodejasa"=>"082","MONTH(tanggal)"=>$i,"YEAR(tanggal)"=>$tahun,"unit_layanan !="=>"RANAP"))->row_array();
      }
      $total_mayor += $data_mayor['jumlah'];
      $total_plastik += $data_plastik['jumlah'];
      array_push($data_mayor1,$data_mayor['jumlah']);
      array_push($data_plastik1,$data_plastik['jumlah']);
      array_push($label_grafik,$this->bulan[$i]);
    }
    $respone = array();
    $markPoint = array();
    $markLine = array();
    array_push($markPoint,array('type'=>'max','name'=>'Max'));
    array_push($markPoint,array('type'=>'min','name'=>'Min'));
    array_push($markLine,array('type'=>'average','name'=>'Rata-rata'));
    $data = array(
        'name' => 'Ozon Mayor',
        'type' => 'bar',
        'data' => $data_mayor1,
        'markPoint' => array('data'=>$markPoint),
        // 'markLine' => array('data'=>$markLine)
    );
    array_push($respone,$data);
    $data = array(
        'name' => 'Ozon Plastik',
        'type' => 'bar',
        'data' => $data_plastik1,
        'markPoint' => array('data'=>$markPoint),
        // 'markLine' => array('data'=>$markLine)
    );
    array_push($respone,$data);
    $total_kunjungan = $total_mayor+$total_plastik;
    echo json_encode(array('label' => $label_grafik,'data' => $respone,'mayor'=>$total_mayor,'plastik'=>$total_plastik,'total'=>$total_kunjungan,'tahun'=>$tahun));
  }


}
