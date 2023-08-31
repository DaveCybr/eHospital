<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelLaporan');
    $this->load->model('ModelTujuanPelayanan');
    $this->load->library("excel");
  }


  public function grafik_dm_ht(){

    $awal = date("Y-m-d",strtotime("-6 month"));
    $jumlah_pasien =  $this->db
    ->select("noRM,jenis_pasien_kode_jenis")
    ->group_start()
      ->where("kodesakit","E11","after")
      ->or_where("kodesakit","E11.9","after")
      // ->or_like("kodesakit","E12","after")
      // ->or_like("kodesakit","E13","after")
      // ->or_like("kodesakit","E14","after")
    ->group_end()
    ->join("diagnosa","diagnosa.pasien_noRM=noRM")
    ->join("kunjungan","kunjungan.pasien_noRM=noRM")
    ->group_by("noRM")
    // ->where("jenis_pasien_kode_jenis",7)
    // ->where("MONTH(diagnosa.jam) <",date("m",strtotime("-6 month")))
    ->where("DATE(diagnosa.jam) <",date("Y-m-d",strtotime($awal)))
    ->get("pasien")->num_rows();
    $jumlah_pasien_ht =  $this->db
    ->select("noRM,jenis_pasien_kode_jenis")
    ->group_start()
      ->where("kodesakit","I10","after")
      // ->or_like("kodesakit","I11","after")
      // ->or_like("kodesakit","I12","after")
      // ->or_like("kodesakit","I13","after")
      // ->or_like("kodesakit","I14","after")
      // ->or_like("kodesakit","I15","after")
    ->group_end()
    ->join("diagnosa","diagnosa.pasien_noRM=noRM")
    ->join("kunjungan","kunjungan.pasien_noRM=noRM")
    ->group_by("noRM")
    ->where("DATE(diagnosa.jam) <",date("Y-m-d",strtotime($awal)))
    ->get("pasien")->num_rows();
    $data = array();
    $data_ht = array();
    $dm_plus = array();
    $ht_plus = array();
    $label = array();
    array_push($data,$jumlah_pasien);
    array_push($data_ht,$jumlah_pasien_ht);
    array_push($dm_plus,0);
    array_push($ht_plus,0);
    $awal_baru = $awal;
    for ($i=1; $i <= 6 ; $i++) {
      $tanggal = date("Y-m-d",strtotime("+".$i." month",strtotime($awal)));
      $penambahan_bulanan = $this->db
      ->select("diagnosa.*")
      ->from("pasien")
      ->group_start()
        ->like("kodesakit","E10","after")
        ->or_like("kodesakit","E11","after")
        ->or_like("kodesakit","E12","after")
        ->or_like("kodesakit","E13","after")
        ->or_like("kodesakit","E14","after")
      ->group_end()
      ->join("diagnosa","diagnosa.pasien_noRM=noRM")
      ->join("kunjungan","kunjungan.pasien_noRM=noRM")
      ->group_by("noRM")
      ->order_by("diagnosa.jam","ASC")
      ->get_compiled_select();
      $penambahan_bulanan = $this->db->from(" (".$penambahan_bulanan.") as a")
      ->where("DATE(jam) >=",date("Y-m-d",strtotime($awal_baru)))
      ->where("DATE(jam) <",date("Y-m-d",strtotime($tanggal)))
      ->get()->num_rows();
      $jumlah_pasien += $penambahan_bulanan;
      array_push($data,$jumlah_pasien);

      $penambahan_bulanan_ht = $this->db
      ->select("diagnosa.*")
      ->from("pasien")
      ->group_start()
        ->like("kodesakit","I10","after")
        ->or_like("kodesakit","I11","after")
        ->or_like("kodesakit","I12","after")
        ->or_like("kodesakit","I13","after")
        ->or_like("kodesakit","I14","after")
        ->or_like("kodesakit","I15","after")
      ->group_end()
      ->join("diagnosa","diagnosa.pasien_noRM=noRM")
      ->join("kunjungan","kunjungan.pasien_noRM=noRM")
      ->group_by("noRM")
      ->order_by("diagnosa.jam","ASC")
      ->get_compiled_select();
      $penambahan_bulanan_ht = $this->db->from(" (".$penambahan_bulanan_ht.") as a")
      ->where("DATE(jam) >=",date("Y-m-d",strtotime($awal_baru)))
      ->where("DATE(jam) <",date("Y-m-d",strtotime($tanggal)))
      ->get()->num_rows();
      $jumlah_pasien_ht += $penambahan_bulanan_ht;
      array_push($data_ht,$jumlah_pasien_ht);

      array_push($dm_plus,$penambahan_bulanan);
      array_push($ht_plust,$penambahan_bulanan_ht);




      $awal_baru = $tanggal;
      array_push($label,date("M Y",strtotime($tanggal)));



    }



    $awal = date("Y-m-d",strtotime("-6 month"));


    // $label = array();
    // array_push($data,$jumlah_pasien);
    // $awal_baru = $awal;
    // for ($i=1; $i <= 6 ; $i++) {
    //   $tanggal = date("Y-m-d",strtotime("+".$i." month",strtotime($awal)));
    //
    //   $awal_baru = $tanggal;
    //   array_push($label,date("M Y",strtotime($tanggal)));
    // }


    $data = array(
      'body' => 'Laporan/chart_dm_ht',
      'label' => $label,
      'data_dm' => $data,
      'data_ht' => $data_ht,
      'dm_plus' => $dm_plus,
      'ht_plus' => $ht_plus,
      // 'pasien' => $pasien,

    );
    $this->load->view('index',$data);
  }


  public function prb_aktif(){
    $pasien =  $this->db
    // ->where("pstprb","DM")
    // ->or_where("pstprb","HT")
    // ->or_where("pstprb","DM, HT")
    // ->or_group_start()
    //   ->like("pstprb","DM","both")
    //   ->or_like("pstprb","HT","both")
    //   ->or_like("pstprb","DM, HT","both")
    // ->group_end()
    ->group_start()
      ->where("kodesakit","E11","after")
      ->or_where("kodesakit","E11.9","after")
      // ->or_like("kodesakit","E12","after")
      // ->or_like("kodesakit","E13","after")
      // ->or_like("kodesakit","E14","after")
      // ->or_like("kodesakit","I10","after")
      // ->or_like("kodesakit","I11","after")
      // ->or_like("kodesakit","I12","after")
      // ->or_like("kodesakit","I13","after")
      // ->or_like("kodesakit","I14","after")
      // ->or_like("kodesakit","I15","after")
    ->group_end()
    // ->where("pstprb !=",NULL)
    // ->where("pstprb !=","")
    ->join("diagnosa","diagnosa.pasien_noRM=noRM")
    ->group_by("noRM")
    ->get("pasien")->result();

    $prb_dm = $this->db
    ->where("pstprb","DM")
    ->group_start()
      ->where("pstprol","")
      ->or_where("pstprol",NULL)
    ->group_end()
    ->get("pasien")->num_rows();

    $prb_ht = $this->db
    ->where("pstprb","HT")
    ->group_start()
      ->where("pstprol","")
      ->or_where("pstprol",NULL)
    ->group_end()
    ->get("pasien")->num_rows();

    $prb_dm_ht = $this->db
    ->where("pstprb","DM, HT")
    ->group_start()
      ->where("pstprol","")
      ->or_where("pstprol",NULL)
    ->group_end()
    ->get("pasien")->num_rows();

    $pro_prb_dm = $this->db
    ->where("pstprb","DM")
    ->where("pstprol","DM")
    ->get("pasien")->num_rows();

    $pro_prb_ht = $this->db
    ->where("pstprb","HT")
    ->where("pstprol","HT")
    ->get("pasien")->num_rows();

    $pro_prb_dm_ht = $this->db
    ->where("pstprb","DM, HT")
    ->where("pstprol","DM, HT")
    ->get("pasien")->num_rows();


    $data = array(
      'body' => 'Laporan/prb_aktif',
      'pasien' => $pasien,
      'prb_dm' => $prb_dm,
      'prb_ht' => $prb_ht,
      'prb_dm_ht' =>$prb_dm_ht,
      'pro_prb_dm' => $pro_prb_dm,
      'pro_prb_ht' => $pro_prb_ht,
      'pro_prb_dm_ht' => $pro_prb_dm_ht,
    );
    $this->load->view('index',$data);
  }

  public function get_riwayat_dm(){
    $pasien_noRM = $this->input->post("norm");
    $data = $this->db
    // ->where("MONTH(tgl)",date("m"))
    // ->where("YEAR(tgl)",date("Y"))
    ->where("pasien_noRM",$pasien_noRM)
    ->group_start()
      ->where("gl_puasa !=",0)
      // ->or_where("gl_post_prandial !=",0)
    ->group_end()
    ->order_by("no_urutkunjungan","DESC")
    ->join("periksa","kunjungan_no_urutkunjungan=no_urutkunjungan")
    ->get("kunjungan")->result();
    $html = "";
    $no=1;
    foreach ($data as $value) {
      $html .= "<tr>
        <td>".$no."</td>
        <td>".date("d-m-Y",strtotime($value->tgl))."</td>
        <td>".$value->gl_puasa."</td>
      </tr>";
      $no++;
    }
    echo $html;
  }

  public function get_riwayat_ht(){
    $pasien_noRM = $this->input->post("norm");
    $data = $this->db
    // ->where("MONTH(tgl)",date("m"))
    // ->where("YEAR(tgl)",date("Y"))
    ->where("pasien_noRM",$pasien_noRM)
    ->order_by("no_urutkunjungan","DESC")
    ->join("periksa","kunjungan_no_urutkunjungan=no_urutkunjungan")
    ->get("kunjungan")->result();
    $html = "";
    $no=1;
    foreach ($data as $value) {
      $html .= "<tr>
        <td>".$no."</td>
        <td>".date("d-m-Y",strtotime($value->tgl))."</td>
        <td>".$value->osiastole."</td>
        <td>".$value->odiastole."</td>
      </tr>";
      $no++;
    }
    echo $html;
  }

  public function pasien_diabetes($bulan=null,$tahun=null)
  {
    if ($bulan==null) {
      $bulan = date("m");
    }
    if ($tahun==null) {
      $tahun=date("Y");
    }
    $pasien =  $this->db
    ->group_start()
      ->where("kodesakit","E11","after")
      ->or_where("kodesakit","E11.9","after")
      // ->or_like("kodesakit","E12","after")
      // ->or_like("kodesakit","E13","after")
      // ->or_like("kodesakit","E14","after")
    ->group_end()
    ->join("pasien","diagnosa.pasien_noRM=noRM")
    ->join("kunjungan","kunjungan.pasien_noRM=noRM")
    ->group_by("noRM")
    ->order_by("noRM","DESC")
    ->get_where("diagnosa",array("jenis_pasien_kode_jenis"=>7))->num_rows();
    $pasien_non_bpjs =  $this->db
    ->group_start()
      ->where("kodesakit","E11","after")
      ->or_where("kodesakit","E11.9","after")
      // ->or_like("kodesakit","E12","after")
      // ->or_like("kodesakit","E13","after")
      // ->or_like("kodesakit","E14","after")
    ->group_end()
    ->join("pasien","diagnosa.pasien_noRM=noRM")
    ->group_by("noRM")
    ->get_where("diagnosa",array("jenis_pasien_kode_jenis !="=>7))->num_rows();

    $pasien_aktif = $this->db
    ->like("pstprol","DM","both")
    ->get_where("pasien",['prolanis_aktif'=>1])->result();
    $total_pasien_prolanis = $this->db
    ->like("pstprol","DM","both")
    ->group_start()
      ->where("pstprb","")
      ->or_where("pstprb",NULL)
    ->group_end()
    ->get("pasien")->num_rows();
    $total_pasien_prb = $this->db
    ->like("pstprb","DM","both")
    ->group_start()
      ->where("pstprol","")
      ->or_where("pstprol",NULL)
    ->group_end()
    ->get("pasien")->num_rows();
    $total_pasien_pro_prb = $this->db
    ->like("pstprb","DM","both")
    ->like("pstprol","DM","both")
    ->get("pasien")->num_rows();
    $data = array(
      'body' => 'Laporan/diabet_index',
      'pasien' => $pasien,
      'pro' => $total_pasien_prolanis,
      'prb' => $total_pasien_prb,
      'pro_prb' => $total_pasien_pro_prb,
      'tot_non' =>$pasien_non_bpjs,
      'bulan' => $bulan,
      'tahun'=>$tahun,
      'pasien_aktif' => $pasien_aktif
    );
    $this->load->view('index',$data);
  }

  public function get_data_dm(){
    // $pasien =  $this->db
    // ->group_start()
    //   ->like("kodesakit","E10","after")
    //   ->or_like("kodesakit","E11","after")
    //   ->or_like("kodesakit","E12","after")
    //   ->or_like("kodesakit","E13","after")
    //   ->or_like("kodesakit","E14","after")
    // ->group_end()
    // ->join("pasien","diagnosa.pasien_noRM=noRM")
    // ->join("kunjungan","kunjungan.pasien_noRM=noRM")
    // ->group_by("noRM")
    // ->order_by("noRM","DESC")
    // ->get_where("diagnosa",array("jenis_pasien_kode_jenis"=>7))->result();
    $this->load->model("Datatable");
    $setup = array(
      'table' => 'diagnosa', //nama tabel dari database
      'column_order' => array(null, 'noRM','namapasien'), //field yang ada di table user
      'column_search' => array('noRM','namapasien'), //field yang diizin untuk pencarian
      'order' => array('noRM' => 'DESC'), // default order
      'join' => array(
        "pasien" => array('kolom'=>"diagnosa.pasien_noRM=noRM",'jenis'=>"inner"),
        "kunjungan" => array('kolom'=>"kunjungan.pasien_noRM=noRM",'jenis'=>"inner"),
      ),
      'group_select' => array(
        array('tipe'=>'like','kolom'=>"kodesakit",'nilai'=>"E10",'jenis'=>'after'),
        array('tipe'=>'or_like','kolom'=>"kodesakit",'nilai'=>"E11",'jenis'=>'after'),
        // array('tipe'=>'or_like','kolom'=>"kodesakit",'nilai'=>"E12",'jenis'=>'after'),
        // array('tipe'=>'or_like','kolom'=>"kodesakit",'nilai'=>"E13",'jenis'=>'after'),
        // array('tipe'=>'or_like','kolom'=>"kodesakit",'nilai'=>"E14",'jenis'=>'after')
      ),
      'group'=> "noRM",

    );
    // die(var_dump($setup));
    $this->Datatable->setup($setup);
    $list = $this->Datatable->get_datatables();
    // die();
    $data_response = array();
    $no = $_POST['start'];
    foreach ($list as $data) {
        $res = $this->ModelLaporan->cek_kunj($data->noRM);
        if ($res != NULL) {
          if (($res->gl_puasa <=130 && $res->gl_puasa >=80)) {
            $bg = "#3fc380";
            $status = "Terkendali";
          }else{
            $bg = "#e74c3c";
            $status="Tidak";
          }

          $warna = "#ffffff";
        }else{
          $bg = "";
          $warna = "";
          $status="Belum Berkunjung";
        }
        $id_check = $data->noRM;
        $no++;
        $row = array();
        $row[] =  $no;
        $row[] =  $data->noRM;
        $row[] =  $data->noBPJS;
        $row[] =  $data->namapasien;
        $row[] =  $data->pstprol;
        $row[] =  $data->pstprb;
        $row[] =  $status;
        $row[] =  '<button  type="button" class="btn btn-warning btn-sm riwayat" norm="'.$data->noRM.'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Riwayat">
                Riwayat
              </button>';

        $data_response[] = $row;
      }

      $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->Datatable->count_all(),
          "recordsFiltered" => $this->Datatable->count_filtered(),
          "data" => $data_response,
      );
      //output dalam format JSON
      echo json_encode($output);

  }
  public function pasien_hipertensi($bulan=null,$tahun=null)
  {
    if ($bulan==null) {
      $bulan = date("m");
    }
    if ($tahun==null) {
      $tahun=date("Y");
    }

    $pasien_aktif = $this->db
    ->like("pstprol","HT","both")
    ->get_where("pasien",['prolanis_aktif'=>1])->result();
    $pasien =  $this->db
    ->group_start()
      ->where("kodesakit","I10","after")
      // ->or_like("kodesakit","I11","after")
      // ->or_like("kodesakit","I12","after")
      // ->or_like("kodesakit","I13","after")
      // ->or_like("kodesakit","I14","after")
      // ->or_like("kodesakit","I15","after")
      // ->or_like("kodesakit","I16","after")
    ->group_end()
    ->join("pasien","pasien_noRM=noRM")
    ->join("kunjungan","kunjungan.pasien_noRM=noRM")
    ->group_by("noRM")
    ->order_by("noRM","DESC")
    ->get_where("diagnosa",array("jenis_pasien_kode_jenis"=>7))->num_rows();
    $pasien_non =  $this->db
    ->group_start()
      ->where("kodesakit","I10","after")
    //   ->or_like("kodesakit","I11","after")
    //   ->or_like("kodesakit","I12","after")
    //   ->or_like("kodesakit","I13","after")
    //   ->or_like("kodesakit","I14","after")
    //   ->or_like("kodesakit","I15","after")
    //   ->or_like("kodesakit","I16","after")
    ->group_end()
    ->join("pasien","pasien_noRM=noRM")
    ->join("kunjungan","kunjungan.pasien_noRM=noRM")
    ->group_by("noRM")
    ->order_by("noRM","DESC")
    ->get_where("diagnosa",array("jenis_pasien_kode_jenis !="=>7))->num_rows();
    $total_pasien_prolanis = $this->db
    ->like("pstprol","HT","both")
    ->group_start()
      ->where("pstprb","")
      ->or_where("pstprb",NULL)
    ->group_end()
    ->get("pasien")->num_rows();
    $total_pasien_prb = $this->db
    ->where("pstprb","HT","both")
    ->group_start()
      ->where("pstprol","")
      ->or_where("pstprol",NULL)
    ->group_end()
    ->get("pasien")->num_rows();
    $total_pasien_pro_prb = $this->db
    ->where("pstprb","HT","both")
    ->where("pstprol","HT","both")
    ->get("pasien")->num_rows();
    $data = array(
      'body' => 'Laporan/hipertensi_index',
      'pasien' => $pasien,
      'pasien_non' => $pasien_non,
      'pro' => $total_pasien_prolanis,
      'prb' => $total_pasien_prb,
      'pro_prb' => $total_pasien_pro_prb,
      'bulan'=> $bulan,
      'tahun' => $tahun,
      'pasien_aktif' => $pasien_aktif
    );
    $this->load->view('index',$data);
  }


  public function kesakitan()
  {
    $data = array(
      'body' => 'Laporan/kesakitan/index'
    );
    $this->load->view('index',$data);
  }

  public function pelayanan()
  {
    $data = array(
      'body' => 'Laporan/pelayanan/index'
    );
    $this->load->view('index',$data);
  }
  public function pxbpjs()
  {
    $data = array(
      'body' => 'Laporan/pxbpjs'
    );
    $this->load->view('index',$data);
  }
  public function pasieninhealt()
  {
    $data = array(
      'body' => 'Laporan/pasieninhealt'
    );
    $this->load->view('index',$data);
  }
  public function cari_diagnosa()
  {
    $data = array(
      'body' => 'Laporan/cari_diagnosa'
    );
    $this->load->view('index',$data);
  }

  public function cetak_diagnosa()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $diagnosa = $this->input->post('diagnosa');
    $jenis_kelamin = $this->input->post('jenis_kelamin');
    $usia = $this->input->post('usia');
    $data = array(
      'kunjungan' => $this->ModelLaporan->get_diagnosa($from,$till,$diagnosa,$jenis_kelamin,$usia),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data['kunjungan']));
    $this->load->view('Laporan/cetak_diagnosa',$data);
  }

  public function rekap_pasien()
  {
    $data = array(
      'body' => 'Laporan/rekap_pasien'
    );
    $this->load->view('index',$data);
  }

  public function cetak_rekap_pasien()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $diagnosa = explode(",",$this->input->post('diagnosa'));
    // $jenis_kelamin = $this->input->post('jenis_kelamin');
    // $usia = $this->input->post('usia');
    // die(var_dump($diagnosa));
    // $data = array(
    //   'kunjungan' => ,
    //   'mulai' => date('d-m-Y',strtotime($from)),
    //   'sampai' => date('d-m-Y',strtotime($till))
    // );
    // die(print_r($data['kunjungan']));
    // $this->load->view('Laporan/cetak_rekap_pasien',$data);
    $data = $this->ModelLaporan->get_diagnosa2($from,$till,$diagnosa);
      $excel = new PHPExcel();

      $excel->getActiveSheet()->setCellValue('A1', "No");
      $excel->getActiveSheet()->setCellValue('B1', "No RM");
      $excel->getActiveSheet()->setCellValue('C1', "Kunjungan Terakhir");
      $excel->getActiveSheet()->setCellValue('D1', "Nama Pasien");
      $excel->getActiveSheet()->setCellValue('E1', "Tanggal Lahir");
      $excel->getActiveSheet()->setCellValue('F1', "Usia");
      $excel->getActiveSheet()->setCellValue('G1', "Jenis Kelamin");
      $excel->getActiveSheet()->setCellValue('H1', "Nomor Telepon");
      $excel->getActiveSheet()->setCellValue('I1', "Diagnosa");
      $excel->getActiveSheet()->setCellValue('J1', "Penyakit");
      $i = 2;
      $no = 1;
      foreach ($data as $value)
      {
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i,$no);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i,$no);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i,$value->noRM);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i,date("d-m-Y",strtotime($value->kunjungan_terakhir)));
            $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i,$value->namapasien);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i,date("d-m-Y",strtotime($value->tgl_lahir)));
            $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $i,$this->Core->Umur($value->tgl_lahir));
            $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $i,$value->jenis_kelamin);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $i,str_pad($value->telepon, 12, "0", STR_PAD_LEFT));
            $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $i,$value->kode);
            $excel->getActiveSheet()->setCellValueByColumnAndRow(9, $i,$value->penyakit);
            $i++;
            $no++;
          }
      $excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="Rekap Pasien .xls"');

      $excel_writer->save('php://output');

  }
  public function cetak_kesakitan()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'kesakitan' => $this->ModelLaporan->get_kesakitan($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/kesakitan/kesakitan',$data);
  }

  public function cetak_pelayanan()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'pelayanan' => $this->ModelLaporan->get_pelayanan($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/pelayanan/pelayanan',$data);
  }
  public function cetak_pxbpjs()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'pxbpjs' => $this->ModelLaporan->get_pxbpjs($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/cetak_pxbpjs',$data);
  }
  public function cetak_pasieninhealt()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'pasieninhealt' => $this->ModelLaporan->get_pasieninhealt($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/cetak_pasieninhealt',$data);
  }


  public function kunjungan()
  {
    $data = array(
      'body' => 'Laporan/kunjungan/index',
      'tupel' => $this->ModelTujuanPelayanan->get_data()
    );
    // die(print_r($data));
    $this->load->view('index',$data);
  }
  public function lab()
  {
    $data = array(
      'body' => 'Laporan/lab/index',
      // 'tupel' => $this->ModelTujuanPelayanan->get_data()
    );
    // die(print_r($data));
    $this->load->view('index',$data);
  }
  public function cetak_kunjungan()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $tupel = $this->input->post('tupel');
    if ($tupel=='') {
      $data = array(
        'kunjungan' => $this->ModelLaporan->get_kunjungan($from,$till),
        'mulai' => date('d-m-Y',strtotime($from)),
        // 'lama' => $this->ModelLaporan->get_kunjungan_lama($from,$till),
        // 'baru' => $this->ModelLaporan->get_kunjungan_baru($from,$till),
        'lama' => 0,
        'baru' => 0,
        'sampai' => date('d-m-Y',strtotime($till)),
        'tupel' => 'Semua'

      );
    }else{
      $data_tupel = $this->ModelTujuanPelayanan->get_data_edit($tupel)->row_array();
      $data = array(
        'kunjungan' => $this->ModelLaporan->get_kunjungan($from,$till,$tupel),
        'mulai' => date('d-m-Y',strtotime($from)),
        // 'lama' => $this->ModelLaporan->get_kunjungan_lama($from,$till,$tupel),
        // 'baru' => $this->ModelLaporan->get_kunjungan_baru($from,$till,$tupel),
        'lama' => 0,
        'baru' => 0,

        'sampai' => date('d-m-Y',strtotime($till)),
        'tupel' => $data_tupel['tujuan_pelayanan']
      );
      // die(var_dump($data['kunjungan']));
    }

    // die(print_r($data));
    $this->load->view('Laporan/kunjungan/kunjungan',$data);
  }

  public function kesakitan_umur(){
    $data = array(
      'body' => 'Laporan/kesakitan/index_umur'
    );
    $this->load->view('index',$data);
  }
  public function kunjungan_umur(){
    $data = array(
      'body' => 'Laporan/kunjungan/index_umur'
    );
    $this->load->view('index',$data);
  }
  public function cetak_kesakitan_umur()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'data_html' => $this->ModelLaporan->get_kesakitan_umur($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/kesakitan/kesakitan_umur',$data);
  }
  public function cetak_kunjungan_umur()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'data_html' => $this->ModelLaporan->get_kunjungan_umur($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/kunjungan/kunjungan_umur',$data);
  }

  public function kunjungan_poli(){
    $data = array(
      'body' => 'Laporan/kunjungan/index_tupel'
    );
    $this->load->view('index',$data);
  }
  public function cetak_kunjungan_poli()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'data_html' => $this->ModelLaporan->get_kunjungan_poli($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/kunjungan/kunjungan_poli',$data);
  }
  public function kunjungan_laborat(){
    $data = array(
      'body' => 'Laporan/kunjungan/index_laborat'
    );
    $this->load->view('index',$data);
  }
  public function cetak_kunjungan_laborat(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'laborat' => $this->ModelLaporan->get_kunjungan_laborat($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/kunjungan/kunjungan_laborat',$data);
  }
  public function cetak_rekap_lab(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $data = array(
      'laborat' => $this->ModelLaporan->get_rekap_lab($from,$till),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    $this->load->view('Laporan/lab/laborat',$data);
  }
  public function cetak_kunjungan_laborat_detail(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $tupel = $this->input->post('poli');
    $data = array(
      'laborat' => $this->ModelLaporan->get_rekap_lab_detail($from,$till,$tupel),
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );

    // die(print_r($data));
    $this->load->view('Laporan/lab/laborat_detail',$data);
  }

  public function jasa(){
    $data = array(
      'body' => 'Laporan/jasa'
    );
    $this->load->view('index',$data);
  }
  public function jasa_all(){
    $data = array(
      'body' => 'Laporan/jasa_all',
      'pegawai' => $this->ModelLaporan->get_dokter()
    );
    $this->load->view('index',$data);
  }
  public function get_jasa_all(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $nik = $this->input->post('nik');
    // echo json_encode($nik);
    // $from = "2019-06-01";
    // $till = "2019-07-04";
    // $nik = "10804130";
    $data = $this->ModelLaporan->get_pendapatan_jasa_all($from,$till,$nik);
    // die(var_dump($data));
    // // die(var_dump($data));
    echo json_encode($data);
  }
  public function get_jasa(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    // $from = "2019-06-15";
    // $till = "2019-06-21";
    $data = $this->ModelLaporan->get_pendapatan_jasa($from,$till);
    // die(var_dump($data));
    echo json_encode($data);
  }

  public function kunjungan_rajal_ranap()
  {
    $data = array(
      'body' => 'Laporan/rajal_ranap/index'
    );
    $this->load->view('index',$data);
  }

  public function cetak_rekap_ranap_rajal()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');

    $rawat = $this->ModelLaporan->get_rajal_ranap($from,$till);
    $data = array(
      'rawat' => $rawat,
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // // die(print_r($data));
    $this->load->view('Laporan/rajal_ranap/rajal_ranap',$data);
  }

  public function laba(){
    $data = array(
      'body' => 'Laporan/laba'
    );
    $this->load->view('index',$data);
  }
  public function buku_besar(){
    $data = array(
      'body' => 'Laporan/buku_besar'
    );
    $this->load->view('index',$data);
  }
  public function buku_besar_detail(){
    $data = array(
      'body' => 'Laporan/buku_besar_detail',
      'buku' => $this->ModelLaporan->get_buku()
    );
    $this->load->view('index',$data);
  }
  public function get_buku_besar(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    // $from = "2019-06-20";
    // $till = "2019-06-30";
    $data = $this->ModelLaporan->get_buku_besar($from,$till);
    echo json_encode($data);
  }
  public function get_buku_besar_detail(){
    $norek = $this->input->post("norek");
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    // $from = "2019-06-20";
    // $till = "2019-06-30";
    $data = $this->ModelLaporan->get_buku_besar_detail($from,$till,$norek);
    echo json_encode($data);
  }
  public function get_laba(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    // $from = "2019-08-20";
    // $till = "2019-08-30";
    $data = $this->ModelLaporan->get_laba_rugi($from,$till);
    echo json_encode($data);
  }

  public function rujukan()
  {
    $data = array(
      'body' => 'Laporan/rujukan/index'
    );
    $this->load->view('index',$data);
  }

  public function rekap_rujukan()
  {
      $from = $this->input->post('tgl_mulai');
      $till = $this->input->post('tgl_sampai');

      $rujukan = $this->ModelLaporan->get_rekap_rujukan_internal($from,$till, 1)->result();

      $data = array(
        'rujukan' => $rujukan,
        'mulai' => date('d-m-Y',strtotime($from)),
        'sampai' => date('d-m-Y',strtotime($till))
      );
      // // die(print_r($data));
      $this->load->view('Laporan/rujukan/rekap',$data);
  }

  public function rekap_rujukan_detail()
  {
      $from = $this->input->post('tgl_mulai');
      $till = $this->input->post('tgl_sampai');

      $rujukan = $this->ModelLaporan->get_rekap_rujukan_internal($from,$till)->result();

      $data = array(
        'rujukan' => $rujukan,
        'mulai' => date('d-m-Y',strtotime($from)),
        'sampai' => date('d-m-Y',strtotime($till))
      );
      // // die(print_r($data));
      $this->load->view('Laporan/rujukan/rekap_detail',$data);
  }

  public function kunjungan_dokter(){
    $data = array(
      'data' => $this->ModelLaporan->get_kunjungan_dokter()
    );
    $this->load->view("Laporan/kunjungan_dokter",$data);
  }

  public function pemakaian_obat(){
    $data = array(
      'body' => 'Laporan/pemakaian_obat'
    );
    $this->load->view('index',$data);
  }

  public function cetak_pemakaian_obat(){
    $from = $this->input->post('tgl_mulai');
    $unit = $this->input->post("unit");
    $data = array(
      'data' => $this->ModelLaporan->get_pemakaian_obat($from,$unit),
      'mulai' => date('d-m-Y',strtotime($from)),
      'unit' => $unit==''?"Semua Unit":$unit,
    );
    // die(var_dump($data['data']));
    $this->load->view("Laporan/cetak_pemakaian_obat",$data);
  }


  function cetak_ht(){
    $tanggal = $this->uri->segment(3);
    $excel = new PHPExcel();

    // die(var_dump($data));
    //Merge cells

    $data =  $this->db
    ->group_start()
    ->where("kodesakit","I10","after")
    ->group_end()
    ->join("pasien","pasien_noRM=noRM")
    ->join("kunjungan","kunjungan.pasien_noRM=noRM")
    ->group_by("noRM")
    ->order_by("noRM","DESC")
    ->get_where("diagnosa",array("jenis_pasien_kode_jenis"=>7))->result();

    //inisialisai lebar cells
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);

    //set font
    $fontStyle = array(
      'font' => array(
        'size' => 16,
        'bold' => true
      ),
      'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    $fontStyle2 = array(
      'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'c0c0c0'
          )
      ),
      'font' => array(
        'size' => 10,
        'bold' => true
      ),
      'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
      ),
      'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )

    );
    //set style
    $excel->getActiveSheet()
      ->getStyle("A1:G1")
      ->applyFromArray($fontStyle2);
    $excel->getActiveSheet()->setCellValue('A1', 'NO');
    $excel->getActiveSheet()->setCellValue('B1', 'NO RM');
    $excel->getActiveSheet()->setCellValue('C1', 'NO BPJS');
    $excel->getActiveSheet()->setCellValue('D1', 'NAMA PASIEN');
    $excel->getActiveSheet()->setCellValue('E1', 'UMUR');
    $excel->getActiveSheet()->setCellValue('F1', 'NOMOR TELEPON');
    $excel->getActiveSheet()->setCellValue('G1', 'KUNJUNGAN TERAKHIR');
    $i = 2;
    $no = 1;
    foreach ($data as $value)
    {
          $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i,$no);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i,$value->noRM);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i,$value->noBPJS);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i,$value->namapasien);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i,$this->Core->umur($value->tgl_lahir));
          $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $i,$value->telepon);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $i,$value->kunjungan_terakhir);
          $i++;
          $no++;
        }
    $excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');

    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attachment;filename="pasien ht bpjs.xls"');

    $excel_writer->save('php://output');

  }


  function cetak_dm(){
    $tanggal = $this->uri->segment(3);
    $excel = new PHPExcel();
    // die(var_dump($data));
    //Merge cells

    $data =  $this->db
    ->group_start()
      ->where("kodesakit","E11","after")
      ->or_where("kodesakit","E11.9","after")
    ->group_end()
    ->join("pasien","diagnosa.pasien_noRM=noRM")
    ->join("kunjungan","kunjungan.pasien_noRM=noRM")
    ->group_by("noRM")
    ->order_by("noRM","DESC")
    ->get_where("diagnosa",array("jenis_pasien_kode_jenis"=>7))->result();

    //inisialisai lebar cells
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);

    //set font
    $fontStyle = array(
      'font' => array(
        'size' => 16,
        'bold' => true
      ),
      'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    $fontStyle2 = array(
      'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'c0c0c0'
          )
      ),
      'font' => array(
        'size' => 10,
        'bold' => true
      ),
      'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
      ),
      'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )

    );
    //set style
    $excel->getActiveSheet()
      ->getStyle("A1:G1")
      ->applyFromArray($fontStyle2);
    $excel->getActiveSheet()->setCellValue('A1', 'NO');
    $excel->getActiveSheet()->setCellValue('B1', 'NO RM');
    $excel->getActiveSheet()->setCellValue('C1', 'NO BPJS');
    $excel->getActiveSheet()->setCellValue('D1', 'NAMA PASIEN');
    $excel->getActiveSheet()->setCellValue('E1', 'UMUR');
    $excel->getActiveSheet()->setCellValue('F1', 'NOMOR TELEPON');
    $excel->getActiveSheet()->setCellValue('G1', 'KUNJUNGAN TERAKHIR');
    $i = 2;
    $no = 1;
    foreach ($data as $value)
    {
          $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $i,$no);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i,$value->noRM);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i,$value->noBPJS);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i,$value->namapasien);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i,$this->Core->umur($value->tgl_lahir));
          $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $i,$value->telepon);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $i,$value->kunjungan_terakhir);
          $i++;
          $no++;
        }
    $excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');

    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attachment;filename="pasien dm bpjs.xls"');

    $excel_writer->save('php://output');

  }



}
