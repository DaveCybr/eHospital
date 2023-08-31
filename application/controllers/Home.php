<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
  public $poli = array('Poli Umum');
  public $kode_poli = array('UMU');
  public $hari = array('Mon'=>'Senin','Tue'=>'Selasa','Wed'=>'Rabu','Thu'=>'Kamis','Fri'=>"jum'at",'Sat'=>'Sabtu','Sun'=>'Minggu');
  public $bulan = array('Bulan','Jan','Feb','Mar','Apr','Mei','Jun','Juli','Aug','Sep','Okt','Nov','Des');
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelHome');
    $this->load->model('ModelKBinaan');
  }

  function index()
  {
    // $data = json_decode(PCareLama());
    // die(var_dump($data->metaData->message));
    $data['body'] = "Home/home2";
    $data['total_pasien'] = $this->ModelHome->count_all_pasien();
    $data['last_pasien'] = $this->ModelHome->count_last_pasien();
    $data['pasien_baru'] = $this->ModelHome->count_pasien_baru();
    $data['pasien_kemarin'] = $this->ModelHome->count_pasien_kemarin();
    $data['pasien_bulan_ini'] = $this->ModelHome->count_pasien_bulan_ini();

    $data['kunjungan'] = $this->ModelHome->count_all_kunjungan();
    $data['last_kunjungan'] = $this->ModelHome->count_last_kunjungan();
    $data['kunjungan_baru'] = $this->ModelHome->count_kunjungan_baru();
    $data['kunjungan_kemarin'] = $this->ModelHome->count_kunjungan_kemarin();
    $data['kunjungan_bulan_lalu'] = $this->ModelHome->count_kunjungan_bulan_lalu();
    $data['kunjungan_bulan_ini'] = $this->ModelHome->count_kunjungan_bulan_ini();
    $data['total_kamar'] = $this->ModelHome->count_total_kamar();
    $data['kamar_kosong'] = $this->ModelHome->count_kamar_kosong();
    $data['kamar_terisi'] = $this->ModelHome->count_kamar_terisi();

    $data['kunjlab'] = $this->ModelHome->count_lab();
    $data['s_analis'] = $this->ModelHome->sudah();
    $data['b_analis'] = $this->ModelHome->belum();
    if ($_SESSION['jabatan']=='lab') {
      $data['body'] = "Home/home_lab";
      $data['daftar'] = $this->ModelHome->get_daftar();
      $data['kunjungan_baru'] = $this->ModelHome->count_kunjungan_baru_lab();
      $data['kunjungan_kemarin'] = $this->ModelHome->count_kunjungan_kemarin_lab();
      $data['kunjungan_bulan_lalu'] = $this->ModelHome->count_kunjungan_bulan_lalu_lab();
      $data['kunjungan_bulan_ini'] = $this->ModelHome->count_kunjungan_bulan_ini_lab();
    }
    if ($_SESSION['jabatan']=='direktur' || $_SESSION['jabatan']=='root') {
      $data['body'] = "Home/home_direktur";
      $data['hutang_rekanan'] = $this->ModelHome->count_hutang_rekanan();
      $data['kb_perawat'] = $this->ModelKBinaan->getPerawat()->result();
      $data['kb_dokter'] = $this->ModelKBinaan->getDokter()->result();
    }
    $data['daftar_tt'] = $this->ModelHome->get_tt();
    $this->load->view('index',$data);
  }
  function kamar_kosong()
  {
    $data['kamar'] = $this->ModelHome->kamar_kosong();
    $this->load->view('Home/kamar_kosong',$data);
  }
  function jadwal_operasi()
  {
    $data['jadwal_operasi'] = $this->ModelHome->jadwal_operasi();
    $this->load->view('Home/jadwal_operasi',$data);
  }
  function kunjungan_saat_ini()
  {
    $data['kunjungan'] = $this->ModelHome->get_kunjungan_baru();
    // die(var_dump($data['kunjungan']));
    $this->load->view('Home/kunjungan',$data);
  }

  function pasien_baru()
  {
    $data['pasien'] = $this->ModelHome->get_pasien_baru();
    // die(var_dump($data['kunjungan']));
    $this->load->view('Home/pasien_baru',$data);
  }
  function filter_harian(){
    $today = date("Y-m-d");
    $respone = array();
    for ($i=0; $i < count($this->kode_poli) ; $i++) {
      $data_kunjungan = $this->ModelHome->get_hari_ini($this->kode_poli[$i],$today)->row_array();
      $markPoint = array();
      $markLine = array();
      array_push($markPoint,array('type'=>'max','name'=>'Max'));
      array_push($markPoint,array('type'=>'min','name'=>'Min'));
      array_push($markLine,array('type'=>'average','name'=>'Rata-rata'));
      $data = array(
        'name' => $this->poli[$i],
        'type' => 'bar',
        'data' => array((int)$data_kunjungan['jumlah']),
        'markPoint' => array('data'=>$markPoint),
        'markLine' => array('data'=>$markLine)
      );
      array_push($respone,$data);
    }
    echo json_encode(array('label' => array('Kunjungan Pasien Hari Ini'),'data' => $respone));

  }

  function filter_data(){
      $jenis_filter = $this->input->post('jenis');
      if ($jenis_filter=='mingguan') {
        $filter = date("Y-m-d",strtotime('-6 days'));
      }else{
        $filter = date("Y-m-d");
      }
      $respone = array();
      $label_grafik = array();
      $poli_gigi = array();
      $poli_umum = array();
      $poli_internis = array();
      $poli_obsgyn = array();
      $igd = array();
      $ozon = array();
      $bulan = date('m',strtotime($filter));
      $tahun = date('Y',strtotime($filter));
      $jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
      if ($jenis_filter=='mingguan') {
        $i=0;
        $stop = 7;
      }else if($jenis_filter=='bulanan'){
        $i=1;
        $stop = $jml_hari;
      }else{
        $i=1;
        $stop = 12;
      }
      for ($i; $i <= $stop ; $i++) {
        if ($jenis_filter=='mingguan') {
          $filter_tanggal = date('Y-m-d',strtotime('+'.$i.' days',strtotime($filter)));
        }else if ($jenis_filter=='bulanan'){
          $filter_tanggal = date('Y-m-d',mktime(0,0,0,$bulan,$i,$tahun));
        }
        for ($j=0;$j<count($this->kode_poli);$j++){
          if ($jenis_filter=='tahunan') {
            $data_kunjungan = $this->ModelHome->get_tahun_ini($this->kode_poli[$j],$i,$tahun)->row_array();
          }else{
            $data_kunjungan = $this->ModelHome->get_hari_ini($this->kode_poli[$j],$filter_tanggal)->row_array();
          }
           switch ($j) {
             case 0:
               array_push($poli_umum,(int) $data_kunjungan['jumlah']);
               break;
             case 1:
               array_push($poli_gigi,(int) $data_kunjungan['jumlah']);
               break;
             case 2:
               array_push($poli_internis,(int) $data_kunjungan['jumlah']);
               break;
             case 3:
               array_push($poli_obsgyn,(int) $data_kunjungan['jumlah']);
               break;
             case 4:
               array_push($igd,(int) $data_kunjungan['jumlah']);
               break;
               case 5:
                 array_push($ozon,(int) $data_kunjungan['jumlah']);
                 break;
           }
        }
        if ($jenis_filter=='mingguan') {
          array_push($label_grafik,$this->hari[date('D',strtotime($filter_tanggal))]);
        }else if($jenis_filter=='bulanan'){
          array_push($label_grafik,$i);
        }else{
           array_push($label_grafik,$this->bulan[$i]);
        }

      }
      for ($i=0; $i < count($this->kode_poli) ; $i++) {
        $data_mingguan;
        $markPoint = array();
        $markLine = array();
        array_push($markPoint,array('type'=>'max','name'=>'Max'));
        array_push($markPoint,array('type'=>'min','name'=>'Min'));
        array_push($markLine,array('type'=>'average','name'=>'Rata-rata'));
        switch ($i) {
          case 0:
            $data_mingguan = $poli_umum;
            break;
          case 1:
            $data_mingguan = $poli_gigi;
            break;
          case 2:
            $data_mingguan = $poli_internis;
            break;
          case 3:
            $data_mingguan = $poli_obsgyn;
            break;
          case 4:
            $data_mingguan = $igd;
            break;
            case 5:
              $data_mingguan = $ozon;
              break;
        }
        $data = array(
          'name' => $this->poli[$i],
          'type' => 'line',
          'data' => $data_mingguan,
          'markPoint' => array('data'=>$markPoint),
          'markLine' => array('data'=>$markLine)
        );
        array_push($respone,$data);
      }
       echo json_encode(array('label' => $label_grafik,'data' => $respone));

  }
  // function filter_mingguan(){
  //     $filter = date("Y-m-d",strtotime('-6 days'));
  //     $respone = array();
  //     $label_grafik = array();
  //     $poli_gigi = array();
  //     $poli_umum = array();
  //     $poli_internis = array();
  //     $poli_obsgyn = array();
  //     $igd = array();
  //     for ($i=0; $i < 7 ; $i++) {
  //       $filter_tanggal = date('Y-m-d',strtotime('+'.$i.' days',strtotime($filter)));
  //       for ($j=0;$j<count($this->kode_poli);$j++){
  //          $data_kunjungan = $this->ModelHome->get_hari_ini($this->kode_poli[$j],$filter_tanggal)->row_array();
  //          switch ($j) {
  //            case 0:
  //              array_push($poli_umum,(int) $data_kunjungan['jumlah']);
  //              break;
  //            case 1:
  //              array_push($poli_gigi,(int) $data_kunjungan['jumlah']);
  //              break;
  //            case 2:
  //              array_push($poli_internis,(int) $data_kunjungan['jumlah']);
  //              break;
  //            case 3:
  //              array_push($poli_obsgyn,(int) $data_kunjungan['jumlah']);
  //              break;
  //            case 4:
  //              array_push($igd,(int) $data_kunjungan['jumlah']);
  //              break;
  //          }
  //       }
  //       array_push($label_grafik,$this->hari[date('D',strtotime($filter_tanggal))]);
  //     }
  //     for ($i=0; $i < count($this->kode_poli) ; $i++) {
  //       $data_mingguan;
  //       $markPoint = array();
  //       $markLine = array();
  //       array_push($markPoint,array('type'=>'max','name'=>'Max'));
  //       array_push($markPoint,array('type'=>'min','name'=>'Min'));
  //       array_push($markLine,array('type'=>'average','name'=>'Rata-rata'));
  //       switch ($i) {
  //         case 0:
  //           $data_mingguan = $poli_umum;
  //           break;
  //         case 1:
  //           $data_mingguan = $poli_gigi;
  //           break;
  //         case 2:
  //           $data_mingguan = $poli_internis;
  //           break;
  //         case 3:
  //           $data_mingguan = $poli_obsgyn;
  //           break;
  //         case 4:
  //           $data_mingguan = $igd;
  //           break;
  //       }
  //       $data = array(
  //         'name' => $this->poli[$i],
  //         'type' => 'bar',
  //         'data' => $data_mingguan,
  //         'markPoint' => array('data'=>$markPoint),
  //         'markLine' => array('data'=>$markLine)
  //       );
  //       array_push($respone,$data);
  //     }
  //      echo json_encode(array('label' => $label_grafik,'data' => $respone));
  //
  // }
  // {
  //     name:'Site A',
  //     type:'bar',
  //     data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3],
  //     markPoint : {
  //         data : [
  //             {type : 'max', name: 'Max'},
  //             {type : 'min', name: 'Min'}
  //         ]
  //     },
  //     markLine : {
  //         data : [
  //             {type : 'average', name: 'Average'}
  //         ]
  //     }
  // },
  function tes(){
    $data = $this->db->order_by("nik","asc")->get("pegawai")->result();
    $date = date("Y");
    $no =1;
    foreach ($data as $value) {
      $baru = str_pad($no,3,"0",STR_PAD_LEFT);
      $nik_b = $date.$baru;
      // die($nik_b);

      if ($value->nama!="Admin") {

          $this->db->where("nama",$value->nama);
          $up = $this->db->update("pegawai",array("NIK"=>$nik_b));
          if ($up) {
            echo "berhasil <br>";
          }
      }
      $no++;
    }
  }
  public function update_jasa(){
    $data = $this->db->get("jasa_pelayanan")->result();
    // die(var_dump($data));
    foreach ($data as $value) {
      $this->db->where("jsmedis",$value->nama);
      $this->db->update("tindakan",array("kodejasa"=>$value->kode_baru));
      $this->db->reset_query();
    }
    echo "Selesai";
  }

}
?>
