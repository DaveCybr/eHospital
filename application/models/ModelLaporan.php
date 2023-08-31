<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLaporan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function cek_kunj($pasien_noRM,$bulan,$tahun){
    $data = $this->db
    ->where("MONTH(tgl)",$bulan)
    ->where("YEAR(tgl)",$tahun)
    ->where("pasien_noRM",$pasien_noRM)
    ->group_start()
      ->where("gl_puasa !=",0)
      // ->or_where("gl_post_prandial !=",0)
    ->group_end()
    ->order_by("no_urutkunjungan","DESC")
    ->join("periksa","kunjungan_no_urutkunjungan=no_urutkunjungan")
    ->get("kunjungan")->row();

    return $data;
  }
  public function cek_kunj_ht($pasien_noRM,$bulan,$tahun){
    $data = $this->db
    ->where("MONTH(tgl)",$bulan)
    ->where("YEAR(tgl)",$tahun)
    ->where("pasien_noRM",$pasien_noRM)
    ->join("pasien","kunjungan.pasien_noRM=noRM")
    ->join("periksa","kunjungan_no_urutkunjungan=no_urutkunjungan")
    ->order_by("no_urutkunjungan","DESC")
    ->get("kunjungan")->row();


    return $data;
  }

  public function get_diagnosa($from,$till,$diagnosa,$jenis_kelamin,$usia){
    $this->db->where("DATE(tgl_kunjungan) >=",$from);
    $this->db->where("DATE(tgl_kunjungan) <=",$till);
    if ($diagnosa!="") {
      $this->db->where("kodeicdx",$diagnosa);
    }
    if ($jenis_kelamin != "") {
      $this->db->where("jenis_kelamin",$jenis_kelamin);
    }
    if ($usia!="") {
      $usia = explode(",",$usia);
      $batas_atas = date("Y-m-d",strtotime("-".$usia[0]." years"));
      $batas_bawah = date("Y-m-d",strtotime("-".$usia[1]." years"));
      $this->db->where("DATE(tgl_lahir) >=",$batas_bawah);
      $this->db->where("DATE(tgl_lahir) <=",$batas_atas);
    }
    $this->db->group_by("no_urutkunjungan");
    $this->db->select("*,group_concat(kodeicdx) as kode,group_concat(nama_penyakit) as penyakit");
    return $this->db->get("view_kunjungan_pasien")->result();

  }

  public function get_diagnosa2($from,$till,$diagnosa){
    // $this->db->select("pasien.*,group_concat(kodeicdx) as kode,group_concat(nama_penyakit) as penyakit");
    // $this->db->where("DATE(tgl_kunjungan) >=",$from);
    // $this->db->where("DATE(tgl_kunjungan) <=",$till);
    // $this->db->where_in("kodeicdx",$diagnosa);
    // $this->db->join("pasien","pasien.noRM=view_kunjungan_pasien.noRM");
    // $this->db->group_by("noRM");
    // return $this->db->get("view_kunjungan_pasien")->result();

    // $nokun = array();
    // $kunjungan = $this->db->get_where("kunjungan",array("DATE(tgl) >="=>$from,"DATE(tgl) <="=>$till))->result();
    // foreach ($kunjungan as $value) {
    //   array_push($nokun,$value->no_urutkunjungan);
    // }
    // $idperiksa = array();
    // $periksa = $this->db->where_in("kunjungan_no_urutkunjungan",$nokun)->get('periksa')->result();
    // foreach ($periksa as $value) {
    //   array_push($idperiksa,$value->idperiksa);
    // }
    $data = $this->db
    ->select("*,group_concat(kodeicdx) as kode,group_concat(nama_penyakit) as penyakit")
    // ->where_in("periksa_idperiksa",$idperiksa)
    ->where_in("kodesakit",$diagnosa)
    ->join("penyakit","kodesakit=kodeicdx")
    ->group_by("noRM")
    ->get_where("view_diagnosa_pasien",array("DATE(jam) >="=>$from,"DATE(jam) <="=>$till))->result();
    return $data;

  }

  public function get_pemakaian_obat($from,$unit){
    if ($unit=='') {
      return $this->db
      ->select("*,SUM(jumlah_beri) as beri")
      ->group_by("idobat")
      ->where("DATE(tanggal)",$from)
      ->join("obat","obat.idobat=detail_resep_diberikan.obat_idobat")
      ->get("detail_resep_diberikan")->result();
    }else{
      return $this->db
      ->select("*,SUM(jumlah_beri) as beri")
      ->group_by("idobat")
      ->join("obat","obat.idobat=detail_resep_diberikan.obat_idobat")
      ->join("detail_pembelian_obat","detail_resep_diberikan.id_pengadaan=detail_pembelian_obat.iddetail_pembelian_obat")
      ->get_where("detail_resep_diberikan",array("unit"=>$unit,"DATE(detail_resep_diberikan.tanggal)"=>$from))->result();
    }
  }

  public function get_buku(){
    return $this->db->get("mbesar")->result();
  }
  public function get_buku_besar($from,$till){
    $response = array();
    $aktiva = $this->db->get_where("mbesar",array("LENGTH(norek_mbesar) "=>3,"norek_mbesar <"=>200))->result();
    $total_debet = 0;
    $total_kredit =0;
    $total_saldo = 0;
    foreach ($aktiva as $akt) {
      $res = $this->db
      ->select("norek,tanggal,SUM(debet) as debet,SUM(kredit) as kredit")
      // ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
      ->where(array("SUBSTRING(norek,1,3)"=>$akt->norek_mbesar,"DATE(tanggal)>="=>$from,"DATE(tanggal) <="=>$till,"debet !="=>NULL,"kredit !="=>NULL))
      // ->group_by('norek')
      ->get("jurnal")->row_array();
      if ($res['debet']!=NULL) {
        $total_debet+=$res['debet'];
        $total_kredit+=$res['kredit'];
        $total_saldo += $res['debet']-$res['kredit'];
        array_push($response,array(
          'norek' => $akt->norek_mbesar,
          'namarek' => $akt->namarek,
          'debet' => $res['debet'],
          'kredit' => $res['kredit'],
          'saldo' => $res['debet']-$res['kredit'],
          'jenis' => 1
        ));
      }
    }
    array_push($response,array(
      'norek' =>NULL,
      'namarek' => "Total Aset",
      'debet' => $total_debet,
      'kredit' => $total_kredit,
      'saldo' => $total_saldo,
      'jenis' => 0
    ));

    $pasiva = $this->db->get_where("mbesar",array("LENGTH(norek_mbesar) "=>3,"norek_mbesar >="=>200,"norek_mbesar <"=>300))->result();
    $total_debet = 0;
    $total_kredit =0;
    $total_saldo = 0;
    foreach ($pasiva as $pasv) {
      $res = $this->db
      ->select("norek,tanggal,SUM(debet) as debet,SUM(kredit) as kredit")
      // ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
      ->where(array("SUBSTRING(norek,1,3)"=>$pasv->norek_mbesar,"DATE(tanggal)>="=>$from,"DATE(tanggal) <="=>$till,"debet !="=>NULL,"kredit !="=>NULL))
      // ->group_by('norek')
      ->get("jurnal")->row_array();
      if ($res['debet']!=NULL) {
        $total_debet+=$res['debet'];
        $total_kredit+=$res['kredit'];
        $total_saldo += $res['kredit']-$res['debet'];
        array_push($response,array(
          'norek' => $pasv->norek_mbesar,
          'namarek' => $pasv->namarek,
          'debet' => $res['debet'],
          'kredit' => $res['kredit'],
          'saldo' => $res['kredit']-$res['debet'],
          'jenis' => 1
        ));
      }
    }
    array_push($response,array(
      'norek' =>NULL,
      'namarek' => "Total Libialitas",
      'debet' => $total_debet,
      'kredit' => $total_kredit,
      'saldo' => $total_saldo,
      'jenis' => 0
    ));

    $modal = $this->db->get_where("mbesar",array("LENGTH(norek_mbesar) "=>3,"norek_mbesar >="=>300,"norek_mbesar <"=>400))->result();
    $total_debet = 0;
    $total_kredit =0;
    $total_saldo = 0;
    foreach ($modal as $mod) {
      $res = $this->db
      ->select("norek,tanggal,SUM(debet) as debet,SUM(kredit) as kredit")
      // ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
      ->where(array("SUBSTRING(norek,1,3)"=>$mod->norek_mbesar,"DATE(tanggal)>="=>$from,"DATE(tanggal) <="=>$till,"debet !="=>NULL,"kredit !="=>NULL))
      // ->group_by('norek')
      ->get("jurnal")->row_array();
      if ($res['debet']!=NULL) {
        $total_debet+=$res['debet'];
        $total_kredit+=$res['kredit'];
        $total_saldo += $res['kredit']-$res['debet'];
        array_push($response,array(
          'norek' => $mod->norek_mbesar,
          'namarek' => $mod->namarek,
          'debet' => $res['debet'],
          'kredit' => $res['kredit'],
          'saldo' => $res['kredit']-$res['debet'],
          'jenis' => 1
        ));
      }
    }
    array_push($response,array(
      'norek' =>NULL,
      'namarek' => "Total Modal",
      'debet' => $total_debet,
      'kredit' => $total_kredit,
      'saldo' => $total_saldo,
      'jenis' => 0
    ));

    $pendapatan = $this->db->get_where("mbesar",array("LENGTH(norek_mbesar) "=>3,"norek_mbesar >="=>400,"norek_mbesar <"=>500))->result();
    $total_debet = 0;
    $total_kredit =0;
    $total_saldo = 0;
    foreach ($pendapatan as $pend) {
      $res = $this->db
      ->select("norek,tanggal,SUM(debet) as debet,SUM(kredit) as kredit")
      // ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
      ->where(array("SUBSTRING(norek,1,3)"=>$pend->norek_mbesar,"DATE(tanggal)>="=>$from,"DATE(tanggal) <="=>$till,"debet !="=>NULL,"kredit !="=>NULL))
      // ->group_by('norek')
      ->get("jurnal")->row_array();
      if ($res['debet']!=NULL) {
        $total_debet+=$res['debet'];
        $total_kredit+=$res['kredit'];
        $total_saldo += $res['kredit']-$res['debet'];
        array_push($response,array(
          'norek' => $pend->norek_mbesar,
          'namarek' => $pend->namarek,
          'debet' => $res['debet'],
          'kredit' => $res['kredit'],
          'saldo' => $res['kredit']-$res['debet'],
          'jenis' => 1
        ));
      }
    }
    array_push($response,array(
      'norek' =>NULL,
      'namarek' => "Total Pendapatan",
      'debet' => $total_debet,
      'kredit' => $total_kredit,
      'saldo' => $total_saldo,
      'jenis' => 0
    ));

    $beban = $this->db->get_where("mbesar",array("LENGTH(norek_mbesar) "=>3,"norek_mbesar >="=>500))->result();
    $total_debet = 0;
    $total_kredit =0;
    $total_saldo = 0;
    foreach ($beban as $beb) {
      $res = $this->db
      ->select("norek,tanggal,SUM(debet) as debet,SUM(kredit) as kredit")
      // ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
      ->where(array("SUBSTRING(norek,1,3)"=>$beb->norek_mbesar,"DATE(tanggal)>="=>$from,"DATE(tanggal) <="=>$till,"debet !="=>NULL,"kredit !="=>NULL))
      // ->group_by('norek')
      ->get("jurnal")->row_array();
      if ($res['debet']!=NULL) {
        $total_debet+=$res['debet'];
        $total_kredit+=$res['kredit'];
        $total_saldo += $res['kredit']-$res['debet'];
        array_push($response,array(
          'norek' => $beb->norek_mbesar,
          'namarek' => $beb->namarek,
          'debet' => $res['debet'],
          'kredit' => $res['kredit'],
          'saldo' => $res['kredit']-$res['debet'],
          'jenis' => 1
        ));
      }
    }
    array_push($response,array(
      'norek' =>NULL,
      'namarek' => "Total Beban",
      'debet' => $total_debet,
      'kredit' => $total_kredit,
      'saldo' => $total_saldo,
      'jenis' => 0
    ));


    return $response;
  }
  public function get_buku_besar_detail($from,$till,$kode){
    return $this->db
    ->select("norek,tanggal,namarek,SUM(debet) as debet,SUM(kredit) as kredit")
    ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
    ->where(array("DATE(tanggal)>="=>$from,"DATE(tanggal) <="=>$till,"debet !="=>NULL,"kredit !="=>NULL))
    ->group_by('norek')
    ->like('norek',$kode,"after")
    ->get("jurnal")->result();
  }
  public function get_laba_rugi($from,$till){
    $data_pendapatan = $this->db
    ->select("norek,tanggal,namarek,SUM(debet) as debet,SUM(kredit) as kredit")
    ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
    ->where(array("DATE(tanggal) >="=>$from,"DATE(tanggal) <="=>$till))
    ->like("norek","4","after")
    ->or_like("norek","8","after")
    ->group_by('norek')
    ->get("jurnal")->result();
    $data_pengeluaran = $this->db
    ->select("norek,tanggal,namarek,SUM(debet) as debet")
    ->join("mbesar","mbesar.norek_mbesar=jurnal.norek")
    ->where(array("DATE(tanggal)>="=>$from,"DATE(tanggal) <="=>$till))
    ->like("norek","5","after")
    ->or_like("norek","6","after")
    ->or_like("norek","7","after")
    ->group_by('norek')
    ->get("jurnal")->result();
    $respon = array(
      'pendapatan' => $data_pendapatan,
      'pengeluaran' => $data_pengeluaran
    );
    // die(var_dump($respon));
    return $respon;
  }
  public function get_dokter(){
    return $this->db
    ->like('jabatan',"DOKTER","both")
    ->get('pegawai')->result();
  }
  public function get_pendapatan_jasa_all($from,$till,$nik){
    $this->db->join("periksa","periksa.idperiksa=tindakan.periksa_idperiksa");
    $this->db->select("jsmedis,SUM(japel_dokter) as jumlah");
    $this->db->group_by("kodejasa");
    return $this->db->get_where("tindakan",array("japel_dokter !="=>0,"DATE(tanggal) >="=>$from,'DATE(tanggal) <='=>$till,'tindakan.operator'=>$nik))->result();
    // die(var_dump($data));
  }
  public function get_pendapatan_jasa($from,$till){
    $this->db->join("periksa","periksa.idperiksa=tindakan.periksa_idperiksa");
    $this->db->select("jsmedis,SUM(japel_dokter) as jumlah");
    $this->db->group_by("kodejasa");
    return $this->db->get_where("tindakan",array("japel_dokter !="=>0,"DATE(tanggal) >="=>$from,'DATE(tanggal) <='=>$till,'tindakan.operator'=>$_SESSION['nik']))->result();
    // die(var_dump($data));
  }
  function get_pelayanan($from,$till){
    $kunjungan = $this->db
    ->join("pasien","pasien_noRM=noRM")
    ->get_where("kunjungan",array("DATE(tgl) >="=>$from,"DATE(tgl) <="=>$till))->result();

    $kunjungan_baru = array(
      'l' => 0,
      'p' => 0,
      'total' => 0
    );
    $kunjungan_lama = array(
      'l' => 0,
      'p' => 0,
      'total' => 0
    );
    $rawat_jalan_baru = array(
      'l' => 0,
      'p' => 0,
      'total' => 0
    );
    $rawat_jalan_lama = array(
      'l' => 0,
      'p' => 0,
      'total' => 0
    );
    $kunjungan_gigi_baru = array(
      'l' => 0,
      'p' => 0
    );
    $kunjungan_gigi_lama = array(
      'l' => 0,
      'p' => 0,
      'total' => 0
    );

    $kunjungan_umur_baru = array(
      'l' => 0,
      'p' => 0,
      'total' => 0
    );

    $kunjungan_umur_lama = array(
      'l' => 0,
      'p' => 0,
      'total' => 0
    );

    foreach ($kunjungan as $value) {
      $umur = $this->Core->umur_baru($value->tgl_lahir);
      if ($value->jenis_kunjungan==0) {
        if ($value->jenis_kelamin=="L") {
          $kunjungan_baru['l']+=1;
        }else{
          $kunjungan_baru['p']+=1;
        }
        if ($value->acc_ranap==0) {
          if ($value->jenis_kelamin=="L") {
            $rawat_jalan_baru['l']+=1;
          }else{
            $rawat_jalan_baru['p']+=1;
          }
          if ($umur > 60) {
            if ($value->jenis_kelamin=="L") {
              $kunjungan_umur_baru['l']+=1;
            }else{
              $kunjungan_umur_baru['p']+=1;
            }

          }

        }
        if ($value->tupel_kode_tupel=="GIG") {
          if ($value->jenis_kelamin=="L") {
            $kunjungan_gigi_baru['l']+=1;
          }else{
            $kunjungan_gigi_baru['p']+=1;
          }
        }
      }else{
        if ($value->jenis_kelamin=="L") {
          $kunjungan_lama['l']+=1;
        }else{
          $kunjungan_lama['p']+=1;
        }
        if ($value->acc_ranap==0) {
          if ($value->jenis_kelamin=="L") {
            $rawat_jalan_lama['l']+=1;
          }else{
            $rawat_jalan_lama['p']+=1;
          }

          if ($umur > 60) {
            if ($value->jenis_kelamin=="L") {
              $kunjungan_umur_lama['l']+=1;
            }else{
              $kunjungan_umur_lama['p']+=1;
            }

          }
        }

        if ($value->tupel_kode_tupel=="GIG") {
          if ($value->jenis_kelamin=="L") {
            $kunjungan_gigi_lama['l']+=1;
          }else{
            $kunjungan_gigi_lama['p']+=1;
          }
        }



      }
    }
    $kunjungan_baru['total'] = $kunjungan_baru['p']+  $kunjungan_baru['l'];
    $kunjungan_lama['total'] =  $kunjungan_lama['p']+  $kunjungan_lama['l'];
    $rawat_jalan_baru['total'] =$rawat_jalan_baru['p']+$rawat_jalan_baru['l'];
    $rawat_jalan_lama['total'] =$rawat_jalan_lama['p']+$rawat_jalan_lama['l'];
    $kunjungan_gigi_baru['total'] =  $kunjungan_gigi_baru['p'] +$kunjungan_gigi_baru['l'];
    $kunjungan_gigi_lama['total'] =$kunjungan_gigi_lama['p']+$kunjungan_gigi_lama['l'];
    $kunjungan_umur_baru['total'] =  $kunjungan_umur_baru['p'] +$kunjungan_umur_baru['l'];
    $kunjungan_umur_lama['total'] =$kunjungan_umur_lama['p']+$kunjungan_umur_lama['l'];
    $res = array(
      'kunjungan_baru' => $kunjungan_baru,
      'kunjungan_lama' => $kunjungan_lama,
      'rawat_jalan_baru' => $rawat_jalan_baru,
      'rawat_jalan_lama' => $rawat_jalan_lama,
      'kunjungan_gigi_baru' => $kunjungan_gigi_baru,
      'kunjungan_gigi_lama' => $kunjungan_gigi_lama,
      'kunjungan_umur_baru' => $kunjungan_umur_baru,
      'kunjungan_umur_lama' => $kunjungan_umur_lama
    );

    // die(var_dump($res['kunjungan_baru']));

    return $res;
  }



  function get_kesakitan($from,$till)
  {
    $response = array();
    $data_penyakit = $this->db->select('indonesia,nama_penyakit,kodeicdx,count(*) as jumlah')
    ->limit(10,0)
    ->order_by('jumlah',"DESC")
    ->group_by("kodeicdx")
    ->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till))
    ->result();
    $t_lama = 0;
    $t_baru = 0;
    $t_nosts = 0;
    $grand = 0;
    foreach ($data_penyakit as $value) {
      $lama = $this->db->select('count(*) as lama')
      ->get_where('view_kunjungan_pasien',array('kodeicdx'=>$value->kodeicdx,'DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>1))->row_array();
      $baru = $this->db->select('count(*) as baru')
      ->get_where('view_kunjungan_pasien',array('kodeicdx'=>$value->kodeicdx,'DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>0))->row_array();
      $no_sts = $this->db->select('count(*) as no_sts')
      ->get_where('view_kunjungan_pasien',array('kodeicdx'=>$value->kodeicdx,'DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>null))->row_array();
      $data = array(
        'kode' => $value->kodeicdx,
        'nama' => $value->nama_penyakit." (".$value->indonesia.")",
        'no_sts' => $no_sts['no_sts'],
        'lama' => $lama['lama'],
        'baru' => $baru['baru'],
        'total' => $value->jumlah,
      );
      $t_lama = $t_lama + $lama['lama'];
      $t_baru = $t_baru + $baru['baru'];
      $t_nosts = $t_nosts + $no_sts['no_sts'];
      array_push($response,$data);
    }
    $grand = $t_lama+$t_baru+$t_nosts;
    $data = array(
      'kode' => "#",
      'nama' => "GRAND TOTAL",
      'no_sts' => $t_nosts,
      'lama' => $t_lama,
      'baru' => $t_baru,
      'total' => $grand,
    );
    array_push($response,$data);
    // die(print_r($response));
    return $response;
    // return $this->db->get('mbesar')->result();
  }
  public function get_rekap_lab($from,$till){
    return $this->db
    ->group_by("periksa.unit_layanan")
    ->select("COUNT(*) as jumlah,unit_layanan")
    ->join("periksa","periksa.idperiksa=labkunjungan.periksa_idperiksa")
    ->get_where("labkunjungan",array("DATE(labkunjungan.tanggal) >="=>$from,"DATE(labkunjungan.tanggal) <="=>$till))
    ->result();
  }
  public function get_rekap_lab_detail($from,$till,$tupel){
    $this->db->join("periksa","periksa.idperiksa=labkunjungan.periksa_idperiksa");
    $this->db->join("pasien","periksa.no_rm=pasien.noRM");
    $this->db->where(array("DATE(labkunjungan.tanggal) >="=>$from,"DATE(labkunjungan.tanggal) <="=>$till));
    $this->db->group_start();
    for($i=0;$i<count($tupel);$i++){
      // if ($i==0) {
        $this->db->or_where("unit_layanan",$tupel[$i]);
      // }else{
      //   $this->db->or_where("unit_layanan",$tupel[$i]);
      // }

    }
    $this->db->group_end();
    return $this->db->get("labkunjungan")->result();
  }

  public function get_pxbpjs($from,$till){
    $jumlah_kunjungan = $this->db
    ->join("pasien","kunjungan.pasien_noRM=pasien.noRM")
    ->where(array("pasien.jenis_pasien_kode_jenis"=>7,"DATE(tgl) >="=>$from,"DATE(tgl) <="=>$till))
    ->get("kunjungan")->num_rows();
    $kunjungan_sakit = $this->db
    ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
    ->join("pasien","kunjungan.pasien_noRM=pasien.noRM")
    ->where(array("pasien.jenis_pasien_kode_jenis"=>7,"polisakit"=>1,"DATE(tgl) >="=>$from,"DATE(tgl) <="=>$till))
    ->get("kunjungan")->num_rows();
    $kunjungan_sehat = $this->db
    ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
    ->join("pasien","kunjungan.pasien_noRM=pasien.noRM")
    ->where(array("pasien.jenis_pasien_kode_jenis"=>7,"polisakit !="=>1,"DATE(tgl) >="=>$from,"DATE(tgl) <="=>$till))
    ->get("kunjungan")->num_rows();
    $jumlah_kontak_komunikasi = $this->db
    ->join("pasien","kunjungan.pasien_noRM=pasien.noRM")
    ->group_by("noRM")
    ->where(array("pasien.jenis_pasien_kode_jenis"=>7,"DATE(tgl) >="=>$from,"DATE(tgl) <="=>$till))
    ->get("kunjungan")->num_rows();
    $response = array();
    $jumlah_peserta = $this->db
    ->order_by("tanggal","DESC")
    ->get("jumlah_peserta")->row();
    array_push($response,array(
      'label' => "KUNJUNGAN BPJS",
      'jumlah' => $jumlah_kunjungan
    ));
    array_push($response,array(
      'label' => "KUNJUNGAN SAKIT",
      'jumlah' => $kunjungan_sakit
    ));
    array_push($response,array(
      'label' => "KUNJUNGAN SEHAT",
      'jumlah' => $jumlah_kunjungan-$kunjungan_sakit
    ));
    array_push($response,array(
      'label' => "KUNJUNGAN PROLANIS",
      'jumlah' => 0
    ));
    array_push($response,array(
      'label' => "Jml. Kontak komunikasi PROLANIS",
      'jumlah' => 0,
    ));
    array_push($response,array(
      'label' => "JUMLAH KONTAK KOMUNIKASI",
      'jumlah' => $jumlah_kontak_komunikasi
    ));
    array_push($response,array(
      'label' => "KONTAK KOMUNIKASI",
      'jumlah' => $jumlah_kontak_komunikasi/$jumlah_peserta->jumlah." Mil"
    ));
    // die(var_dump($response));
    return $response;
  }

  public function get_pasieninhealt($form,$till)
  {
  return $this->db->get_where('pasien_inhealt',array('DATE(tgl) >='=>$form,'DATE(tgl) <='=>$till))->result();
  }


  public function get_kunjungan($from,$till,$tupel=null){

    if ($tupel==null || $tupel=='' || $tupel==NULL) {
      return $this->db
      ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
      ->order_by("no_urutkunjungan")
      ->group_by("no_urutkunjungan")
      ->get_where('kunjungan',array('DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))
      ->result();
    }else{
      // $kunjungan = $this->db->order_by("no_urutkunjungan")->group_by("no_urutkunjungan")->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'kode_tupel'=>$tupel))
      // ->result();
      return $this->db
      ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
      ->order_by("no_urutkunjungan")
      ->group_by("no_urutkunjungan")
      ->get_where('kunjungan',array('DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till,'tupel_kode_tupel'=>$tupel))
      ->result();

    }

  }
  public function get_kunjungan_baru($from,$till,$tupel=null){
    if ($tupel==null || $tupel=='' || $tupel==NULL) {
      $kunjungan = $this->db->select('count(*) as jumlah')->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>0))
      ->row_array();
    }else{
      $kunjungan = $this->db->select('count(*) as jumlah')->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>0,'kode_tupel'=>$tupel))
      ->row_array();
    }
    return $kunjungan['jumlah'];
  }
  public function get_kunjungan_lama($from,$till,$tupel=null){
    if ($tupel==null || $tupel=='' || $tupel==NULL) {
      $kunjungan = $this->db->select('count(*) as jumlah')->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>1))
      ->row_array();
    }else{
      $kunjungan = $this->db->select('count(*) as jumlah')->get_where('view_kunjungan_pasien',array('DATE(tgl_kunjungan) >='=>$from,'DATE(tgl_kunjungan) <='=>$till,'jenis_kunjungan'=>1,'kode_tupel'=>$tupel))
      ->row_array();
    }
    return $kunjungan['jumlah'];
  }
      function get_kesakitan_umur($from,$till){
        $data_res = array();
        $res_akhir = array();
        $data = $this->db->group_by("kodeicdx")->get_where("view_kunjungan_pasien",array("DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->result();
        // die(print_r($data));
        foreach ($data as $value) {
          $data_orang = $this->db->get_where("view_kunjungan_pasien",array("DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till,"kodeicdx"=>$value->kodeicdx))->result();
          // die(print_r($data_orang));
          $u_0hr = 0;
          $u_8hr = 0;
          $u_1bln = 0;
          $u_1thn = 0;
          $u_5thn = 0;
          $u_10thn = 0;
          $u_15thn = 0;
          $u_20thn = 0;
          $u_45thn =0;
          $u_55thn = 0;
          $u_60thn = 0;
          $u_65thn =0;
          $u_70thn =0;
          foreach ($data_orang as $key) {
            $biday = new DateTime($key->tgl_lahir);
          	$today = new DateTime();
          	$diff = $today->diff($biday);
            // die(print_r($diff));
            if ($diff->y<=1) {
              if ($diff->m<=0) {
                if ($diff->d==0 && $diff->d<=7 ) {
                  $u_0hr +=1;
                }else if($diff->d>7 && $diff->d<=28){
                  $u_8hr+=1;
                }else{
                  $u_1bln +=1;
                }
              }else{
                $u_1bln+=1;
              }
            }else if($diff->y>0 && $diff->y<=4){
              $u_1thn +=1;
            }else if($diff->y>4 && $diff->y<=9){
              $u_5thn +=1;
            }else if($diff->y>9 && $diff->y<=14){
              $u_10thn +=1;
            }else if($diff->y>14 && $diff->y<=19){
              $u_15thn +=1;
            }else if($diff->y>19 && $diff->y<=44){
              $u_20thn +=1;
            }else if($diff->y>44 && $diff->y<=54){
              $u_45thn +=1;
            }else if($diff->y>54 && $diff->y<=64){
              $u_55thn +=1;
            }else if($diff->y>64 && $diff->y<=69){
              $u_65thn +=1;
            }else{
              $u_70thn +=1;
            }
          }
          $total = $u_0hr+$u_8hr+$u_1bln+$u_1thn+$u_5thn+$u_10thn+$u_15thn+$u_20thn+$u_45thn+$u_55thn+$u_65thn+$u_70thn;
          $data_sakit = array(
            "ID_ICD" => $value->kodeicdx,
            "ENG" => $value->nama_penyakit,
            "IND" => $value->nama_penyakit,
            "NOL_HARI" => $u_0hr,
            "LAPAN_HARI" => $u_8hr,
            "BULAN" => $u_1bln,
            "TAHUN_1" => $u_1thn,
            "TAHUN_2" => $u_5thn,
            "TAHUN_3" => $u_10thn,
            "TAHUN_4" => $u_15thn,
            "TAHUN_5" => $u_20thn,
            "TAHUN_6" => $u_45thn,
            "TAHUN_7" => $u_55thn,
            "TAHUN_8" => $u_65thn,
            "TAHUN_9" => $u_70thn,
            "TOTAL" => $total,
          );
          array_push($data_res,$data_sakit);
          // die(print_r($data_res));
        }
        foreach ($data_res as $key => $value) {
          $tt[$key] = $value['TOTAL'];
        }
        array_multisort($tt,SORT_DESC,$data_res);
        $pnjng = count($data_res);
        if ($pnjng>10) {
          for ($i=0; $i <= 9 ; $i++) {
            array_push($res_akhir,$data_res[$i]);
          }
        }else{
          for ($i=0; $i < $pnjng ; $i++) {
            array_push($res_akhir,$data_res[$i]);
          }
        }
        // echo "<pre>";
          // die(print_r($res_akhir));
        // echo "</pre>";
        // die();
        $u_0hr = 0;
        $u_8hr = 0;
        $u_1bln = 0;
        $u_1thn = 0;
        $u_5thn = 0;
        $u_10thn = 0;
        $u_15thn = 0;
        $u_20thn = 0;
        $u_45thn =0;
        $u_55thn = 0;
        $u_60thn = 0;
        $u_65thn =0;
        $u_70thn =0;
        $total = 0;
        foreach ($res_akhir as $value) {
          $u_0hr += $value['NOL_HARI'];
          $u_8hr += $value["LAPAN_HARI"];
          $u_1bln += $value["BULAN"];
          $u_1thn += $value["TAHUN_1"];
          $u_5thn += $value["TAHUN_2"];
          $u_10thn += $value["TAHUN_3"];
          $u_15thn += $value["TAHUN_4"];
          $u_20thn += $value["TAHUN_5"];
          $u_45thn += $value["TAHUN_6"];
          $u_45thn += $value["TAHUN_7"];
          $u_55thn += $value["TAHUN_8"];
          $u_60thn += $value["TAHUN_9"];
          $u_65thn += $value["TAHUN_9"];
          $u_70thn += $value["TAHUN_9"];
          $total += $value["TOTAL"];
        }
        $data_sakit = array(
          "ID_ICD" => "#",
          "ENG" => "<b>GRAND TOTAL</b>",
          "IND" => "<b>GRAND TOTAL</b>",
          "NOL_HARI" => $u_0hr,
          "LAPAN_HARI" => $u_8hr,
          "BULAN" => $u_1bln,
          "TAHUN_1" => $u_1thn,
          "TAHUN_2" => $u_5thn,
          "TAHUN_3" => $u_10thn,
          "TAHUN_4" => $u_15thn,
          "TAHUN_5" => $u_20thn,
          "TAHUN_6" => $u_45thn,
          "TAHUN_7" => $u_55thn,
          "TAHUN_8" => $u_65thn,
          "TAHUN_9" => $u_70thn,
          "TOTAL" => $total,
        );
        array_push($res_akhir,$data_sakit);
        // die(print_r($res_akhir));
        return $res_akhir;
      }
      function get_kunjungan_umur($from,$till){
        $data_res = array();
        $res_akhir = array();
        // $data = $this->db->group_by("kodeicdx")->get_where("view_kunjungan_pasien",array("DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->result();
        // die(print_r($data));
        // foreach ($data as $value) {
          $data_orang = $this->db->group_by("no_urutkunjungan")->get_where("view_kunjungan_pasien",array("DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->result();
          // die(print_r($data_orang));
          $u_0hr = 0;
          $u_8hr = 0;
          $u_1bln = 0;
          $u_1thn = 0;
          $u_5thn = 0;
          $u_10thn = 0;
          $u_15thn = 0;
          $u_20thn = 0;
          $u_45thn =0;
          $u_55thn = 0;
          $u_60thn = 0;
          $u_65thn =0;
          $u_70thn =0;
          foreach ($data_orang as $key) {
            $biday = new DateTime($key->tgl_lahir);
          	$today = new DateTime();
          	$diff = $today->diff($biday);
            // die(print_r($diff));
            if ($diff->y<=1) {
              if ($diff->m<=0) {
                if ($diff->d==0 && $diff->y<=7 ) {
                  $u_0hr +=1;
                }else if($diff->d>7 && $diff->d<=28){
                  $u_8hr+=1;
                }else{
                  $u_1bln +=1;
                }
              }else{
                $u_1bln+=1;
              }
            }else if($diff->y>0 && $diff->y<=4){
              $u_1thn +=1;
            }else if($diff->y>4 && $diff->y<=9){
              $u_5thn +=1;
            }else if($diff->y>9 && $diff->y<=14){
              $u_10thn +=1;
            }else if($diff->y>14 && $diff->y<=19){
              $u_15thn +=1;
            }else if($diff->y>19 && $diff->y<=44){
              $u_20thn +=1;
            }else if($diff->y>44 && $diff->y<=54){
              $u_45thn +=1;
            }else if($diff->y>54 && $diff->y<=59){
              $u_55thn +=1;
            }else if($diff->y>59 && $diff->y<=64){
              $u_60thn +=1;
            }else if($diff->y>64 && $diff->y<=69){
              $u_65thn +=1;
            }else{
              $u_70thn +=1;
            }
          }
          $total = $u_0hr+$u_8hr+$u_1bln+$u_1thn+$u_5thn+$u_10thn+$u_15thn+$u_20thn+$u_45thn+$u_55thn+$u_60thn+$u_65thn+$u_70thn;
          $data_sakit = array(
            "ID_ICD" => "Tidak Ada",
            "ENG" => "Tidak Ada",
            "IND" => "Tidak Ada",
            "NOL_HARI" => $u_0hr,
            "LAPAN_HARI" => $u_8hr,
            "BULAN" => $u_1bln,
            "TAHUN_1" => $u_1thn,
            "TAHUN_2" => $u_5thn,
            "TAHUN_3" => $u_10thn,
            "TAHUN_4" => $u_15thn,
            "TAHUN_5" => $u_20thn,
            "TAHUN_6" => $u_45thn,
            "TAHUN_7" => $u_45thn,
            "TAHUN_8" => $u_55thn,
            "TAHUN_9" => $u_60thn,
            "TAHUN_9" => $u_65thn,
            "TAHUN_9" => $u_70thn,
            "TOTAL" => $total,
          );
          array_push($data_res,$data_sakit);
          // die(print_r($data_res));
        // }
        // foreach ($data_res as $key => $value) {
        //   $tt[$key] = $value['TOTAL'];
        // }
        // array_multisort($tt,SORT_DESC,$data_res);
        // $pnjng = count($data_res);
        // if ($pnjng>10) {
        //   for ($i=0; $i <= 9 ; $i++) {
        //     array_push($res_akhir,$data_res[$i]);
        //   }
        // }else{
        //   for ($i=0; $i < $pnjng ; $i++) {
        //     array_push($res_akhir,$data_res[$i]);
        //   }
        // }
        // echo "<pre>";
          // die(print_r($res_akhir));
        // echo "</pre>";
        // die();
        // $u_0hr = 0;
        // $u_8hr = 0;
        // $u_1bln = 0;
        // $u_1thn = 0;
        // $u_5thn = 0;
        // $u_10thn = 0;
        // $u_15thn = 0;
        // $u_20thn = 0;
        // $u_45thn =0;
        // $u_55thn = 0;
        // $u_60thn = 0;
        // $u_65thn =0;
        // $u_70thn =0;
        // $total = 0;
        // foreach ($res_akhir as $value) {
        //   $u_0hr += $value['NOL_HARI'];
        //   $u_8hr += $value["LAPAN_HARI"];
        //   $u_1bln += $value["BULAN"];
        //   $u_1thn += $value["TAHUN_1"];
        //   $u_5thn += $value["TAHUN_2"];
        //   $u_10thn += $value["TAHUN_3"];
        //   $u_15thn += $value["TAHUN_4"];
        //   $u_20thn += $value["TAHUN_5"];
        //   $u_45thn += $value["TAHUN_6"];
        //   $u_45thn += $value["TAHUN_7"];
        //   $u_55thn += $value["TAHUN_8"];
        //   $u_60thn += $value["TAHUN_9"];
        //   $u_65thn += $value["TAHUN_9"];
        //   $u_70thn += $value["TAHUN_9"];
        //   $total += $value["TOTAL"];
        // }
        // $data_sakit = array(
        //   "ID_ICD" => "#",
        //   "ENG" => "<b>GRAND TOTAL</b>",
        //   "IND" => "<b>GRAND TOTAL</b>",
        //   "NOL_HARI" => $u_0hr,
        //   "LAPAN_HARI" => $u_8hr,
        //   "BULAN" => $u_1bln,
        //   "TAHUN_1" => $u_1thn,
        //   "TAHUN_2" => $u_5thn,
        //   "TAHUN_3" => $u_10thn,
        //   "TAHUN_4" => $u_15thn,
        //   "TAHUN_5" => $u_20thn,
        //   "TAHUN_6" => $u_45thn,
        //   "TAHUN_7" => $u_45thn,
        //   "TAHUN_8" => $u_55thn,
        //   "TAHUN_9" => $u_60thn,
        //   "TAHUN_9" => $u_65thn,
        //   "TAHUN_9" => $u_70thn,
        //   "TOTAL" => $total,
        // );
        // array_push($res_akhir,$data_sakit);
        // die(print_r($res_akhir));
        return $data_res;
      }
      function get_kunjungan_poli($from,$till){
      $data_res = array();
      $this->db->group_by("tujuan_pelayanan");
      $this->db->where(array("DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till));
      $this->db->where("jenis_kelamin !=","");
      $data = $this->db->get("kunjungan_2")->result();
      // echo $data;
      // die();

      foreach ($data as $value) {
        // $total = 0;
        $data_BL = $this->db->select("COUNT(*) as JUMLAH")->get_where("kunjungan_2",array('tujuan_pelayanan'=>$value->tujuan_pelayanan,"jenis_kelamin"=>'L',"jenis_kunjungan ="=>"0","DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->row_array();
        $data_BP = $this->db->select("COUNT(*) as JUMLAH")->get_where("kunjungan_2",array('tujuan_pelayanan'=>$value->tujuan_pelayanan,"jenis_kelamin"=>'P',"jenis_kunjungan ="=>"0","DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->row_array();
        $data_LL = $this->db->select("COUNT(*) as JUMLAH")->get_where("kunjungan_2",array('tujuan_pelayanan'=>$value->tujuan_pelayanan,"jenis_kelamin"=>'L',"jenis_kunjungan"=>"1","DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->row_array();
        $data_LP = $this->db->select("COUNT(*) as JUMLAH")->get_where("kunjungan_2",array('tujuan_pelayanan'=>$value->tujuan_pelayanan,"jenis_kelamin"=>'P',"jenis_kunjungan"=>"1","DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till))->row_array();
        $total = $data_BL['JUMLAH']+$data_BP['JUMLAH']+$data_LL['JUMLAH']+$data_LP['JUMLAH'];
        $dt = array(
          "TUPEL" => $value->tujuan_pelayanan,
          "BARU_L" => $data_BL['JUMLAH'],
          "BARU_P" => $data_BP['JUMLAH'],
          "LAMA_L" => $data_LL['JUMLAH'],
          "LAMA_P" => $data_LP['JUMLAH'],
          "TOTAL" => $total
        );
        array_push($data_res,$dt);
      }
      // die(print_r($data_res));
      return $data_res;
    }

    public function get_kunjungan_laborat($from,$till){
      return $this->db->select("kodelab,nama,count(*) as jumlah")
      ->join('detaillab','detaillab.nourutlab=labkunjungan.nokunjlab')
      ->group_by('kodelab')
      ->get_where('labkunjungan',array('DATE(tanggal) >='=>$from,'DATE(tanggal) <='=>$till))
      ->result();
    }

    public function get_opname($from,$till,$kelompok){
      $response = array();
      $obat = $this->db->order_by('nama_obat')->get('obat')->result();
      if ($kelompok=="APOTEK"||$kelompok=="UGD") {
        foreach ($obat as $value) {
          $hitung =  $this->db->get_where('batch_pengadaan',array('DATE(tgl) < '=>$from))->row_array();
          if ($hitung<=0) {
            // die("lalala");
            $stok_awal = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('status_stok_awal'=>1,'idobat'=>$value->idobat,'unit'=>$kelompok))->row_array();
            $pengadaan = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('idobat'=>$value->idobat,'unit'=>$kelompok,'DATE(tgl) >='=>$from,'DATE(tgl)<='=>$till))->row_array() ;
            $pemakaian = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pemakaian',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'unit'=>$kelompok,'DATE(tgl) <='=>$till))->row_array();
            // $resep = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
            $resep = $this->db
            ->select("SUM(jumlah) as jumlah")
            // ->join('detail_resep',"detail_resep.iddetail_resep=detail_resep_diberikan.id_detail_resep")

            ->get_where('view_resep',array('idobat'=>$value->idobat,'unit'=>$kelompok,'DATE(tanggal) >='=>$from,'DATE(tanggal) <='=>$till))->row_array();
            $retur = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_retur_unit',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'unit'=>$kelompok,'DATE(tgl) <='=>$till))->row_array();
            $obat_rusak = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_obat_rusak',array('idobat'=>$value->idobat,'unit'=>$kelompok,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();

            $stok_awal = ($stok_awal['jumlah']!=null) ? $stok_awal['jumlah'] : 0;
            $pengadaan = ($pengadaan['jumlah']!=null) ? $pengadaan['jumlah'] : 0;
            $pemakaian = ($pemakaian['jumlah']!=null) ? $pemakaian['jumlah'] : 0;
            $resep = ($resep['jumlah']!=null) ? $resep['jumlah'] : 0;
            $retur = ($retur['jumlah']!=null) ? $retur['jumlah'] : 0;
            $obat_rusak = ($obat_rusak['jumlah']!=null) ? $obat_rusak['jumlah'] : 0;

            $persediaan = $pengadaan+$stok_awal;
            $total_pakai = $pemakaian+$retur+$resep+$obat_rusak;
            $sisa = $persediaan-$total_pakai;

            // if ($value->idobat="INJ0030") {
            //   // code...
            //   die(var_dump($sisa));
            // }

          }
          else{
            $this->db->reset_query();
            $date = "2020-05-03";
            $stok = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('DATE(tgl) <='=>$from,"unit" =>$kelompok,'idobat'=>$value->idobat))->row_array();
            $pemakaian1 = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pemakaian',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) <='=>$from,'DATE(tgl) >=' => $date))->row_array();
            $resep1 = $this->db
            ->select("SUM(jumlah) as jumlah")
            // ->join('detail_resep',"detail_resep.iddetail_resep=detail_resep_diberikan.id_detail_resep")
            ->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tanggal) >='=>$date,"unit" =>$kelompok,'DATE(tanggal) <='=>$from))->row_array();

            $retur1 = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_retur_unit',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) <='=>$from,'DATE(tgl) >='=>$date))->row_array();
            $obat_rusak1 = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_obat_rusak',array('idobat'=>$value->idobat,'DATE(tgl) <='=>$from,"unit" =>$kelompok,'DATE(tgl) >='=>$date))->row_array();
            $stok = ($stok['jumlah']!=null) ? $stok['jumlah'] : 0;
            $pemakaian1 = ($pemakaian1['jumlah']!=null) ? $pemakaian1['jumlah'] : 0;
            $resep1 = ($resep1['jumlah']!=null) ? $resep1['jumlah'] : 0;
            $retur1 = ($retur1['jumlah']!=null) ? $retur1['jumlah'] : 0;
            $obat_rusak1 = ($obat_rusak1['jumlah']!=null) ? $obat_rusak1['jumlah'] : 0;
            $total_pakai1 = $pemakaian1+$retur1+$resep1+$obat_rusak1;
            $stok_awal = $stok-$total_pakai1;
            $pengadaan = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
            $pemakaian = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pemakaian',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
            // $resep = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
            // if ($value->idobat=="INJ0030") {
            //   die(var_dump($stok_awal));
            // }
            $resep = $this->db
            ->select("SUM(jumlah) as jumlah")
            // ->join('detail_resep',"detail_resep.iddetail_resep=detail_resep_diberikan.id_detail_resep")
            ->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tanggal) > '=>$from,"unit" =>$kelompok,'DATE(tanggal) <='=>$till))->row_array();

            $retur = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_retur_unit',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) > '=>$from,'DATE(tgl) <='=>$till))->row_array();
            $obat_rusak = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_obat_rusak',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) > '=>$from,'DATE(tgl) <='=>$till))->row_array();
            $pengadaan = ($pengadaan['jumlah']!=null) ? $pengadaan['jumlah'] : 0;
            $pemakaian = ($pemakaian['jumlah']!=null) ? $pemakaian['jumlah'] : 0;
            $resep = ($resep['jumlah']!=null) ? $resep['jumlah'] : 0;
            $retur = ($retur['jumlah']!=null) ? $retur['jumlah'] : 0;
            $obat_rusak = ($obat_rusak['jumlah']!=null) ? $obat_rusak['jumlah'] : 0;
            $persediaan = $pengadaan+$stok_awal;
            $total_pakai = (int)$pemakaian+$retur+$resep+$obat_rusak;
            $sisa = $persediaan-$total_pakai;

          }
          $data = array(
            'idobat' => $value->idobat,
            'nama' => $value->nama_obat,
            'harga' => "Rp.".number_format($value->harga_beli_satuan_kecil),
            'satuan_kecil' => $value->satuan_kecil,
            'stok_awal' => $stok_awal,
            'pengadaan' => $pengadaan,
            'persediaan' => $persediaan,
            'pemakaian' => $total_pakai,
            'retur' => $retur,
            'rusak' => $obat_rusak,
            'sisa' => $sisa,
          );
          array_push($response,$data);
        }
      }else{
        foreach ($obat as $value) {
          $hitung =  $this->db->get_where('batch_pengadaan',array('DATE(tgl) < '=>$from))->row_array();
          if ($hitung<=0) {
            // die("lalala");
            $stok_awal = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('status_stok_awal'=>1,'idobat'=>$value->idobat,'unit'=>$kelompok))->row_array();
            $pengadaan = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('idobat'=>$value->idobat,'unit'=>$kelompok,'DATE(tgl) >='=>$from,'DATE(tgl)<='=>$till))->row_array() ;
            $pemakaian = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pemakaian',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'unit'=>$kelompok,'DATE(tgl) <='=>$till))->row_array();
            // $resep = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
            $resep = $this->db
            ->select("SUM(jumlah) as jumlah")
            // ->join('detail_resep',"detail_resep.iddetail_resep=detail_resep_diberikan.id_detail_resep")

            ->get_where('view_resep',array('idobat'=>$value->idobat,'unit'=>$kelompok,'DATE(tanggal) >='=>$from,'DATE(tanggal) <='=>$till))->row_array();
            $retur = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_retur_unit',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'unit'=>$kelompok,'DATE(tgl) <='=>$till))->row_array();
            $obat_rusak = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_obat_rusak',array('idobat'=>$value->idobat,'unit'=>$kelompok,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();

            $stok_awal = ($stok_awal['jumlah']!=null) ? $stok_awal['jumlah'] : 0;
            $pengadaan = ($pengadaan['jumlah']!=null) ? $pengadaan['jumlah'] : 0;
            $pemakaian = ($pemakaian['jumlah']!=null) ? $pemakaian['jumlah'] : 0;
            $resep = ($resep['jumlah']!=null) ? $resep['jumlah'] : 0;
            $retur = ($retur['jumlah']!=null) ? $retur['jumlah'] : 0;
            $obat_rusak = ($obat_rusak['jumlah']!=null) ? $obat_rusak['jumlah'] : 0;

            $persediaan = $pengadaan+$stok_awal;
            $total_pakai = $pemakaian+$retur+$resep+$obat_rusak;
            $sisa = $persediaan-$total_pakai;

            // if ($value->idobat="INJ0030") {
            //   // code...
            //   die(var_dump($sisa));
            // }

          }
          else{
            $this->db->reset_query();
            $date = "2020-05-03";
            $stok = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('DATE(tgl) <='=>$from,"unit" =>$kelompok,'idobat'=>$value->idobat))->row_array();
            $pemakaian1 = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pemakaian',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) <='=>$from,'DATE(tgl) >=' => $date))->row_array();
            $resep1 = $this->db
            ->select("SUM(jumlah) as jumlah")
            // ->join('detail_resep',"detail_resep.iddetail_resep=detail_resep_diberikan.id_detail_resep")
            ->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tanggal) >='=>$date,"unit" =>$kelompok,'DATE(tanggal) <='=>$from))->row_array();

            $retur1 = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_retur_unit',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) <='=>$from,'DATE(tgl) >='=>$date))->row_array();
            $obat_rusak1 = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_obat_rusak',array('idobat'=>$value->idobat,'DATE(tgl) <='=>$from,"unit" =>$kelompok,'DATE(tgl) >='=>$date))->row_array();
            $stok = ($stok['jumlah']!=null) ? $stok['jumlah'] : 0;
            $pemakaian1 = ($pemakaian1['jumlah']!=null) ? $pemakaian1['jumlah'] : 0;
            $resep1 = ($resep1['jumlah']!=null) ? $resep1['jumlah'] : 0;
            $retur1 = ($retur1['jumlah']!=null) ? $retur1['jumlah'] : 0;
            $obat_rusak1 = ($obat_rusak1['jumlah']!=null) ? $obat_rusak1['jumlah'] : 0;
            $total_pakai1 = $pemakaian1+$retur1+$resep1+$obat_rusak1;
            $stok_awal = $stok-$total_pakai1;
            $pengadaan = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pengadaan',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
            $pemakaian = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_pemakaian',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
            // $resep = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tgl) >='=>$from,'DATE(tgl) <='=>$till))->row_array();
            // if ($value->idobat=="INJ0030") {
            //   die(var_dump($stok_awal));
            // }
            $resep = $this->db
            ->select("SUM(jumlah) as jumlah")
            // ->join('detail_resep',"detail_resep.iddetail_resep=detail_resep_diberikan.id_detail_resep")
            ->get_where('view_resep',array('idobat'=>$value->idobat,'DATE(tanggal) > '=>$from,"unit" =>$kelompok,'DATE(tanggal) <='=>$till))->row_array();

            $retur = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_retur_unit',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) > '=>$from,'DATE(tgl) <='=>$till))->row_array();
            $obat_rusak = $this->db->select('SUM(jumlah) as jumlah')->get_where('view_obat_rusak',array('idobat'=>$value->idobat,"unit" =>$kelompok,'DATE(tgl) > '=>$from,'DATE(tgl) <='=>$till))->row_array();
            $pengadaan = ($pengadaan['jumlah']!=null) ? $pengadaan['jumlah'] : 0;
            $pemakaian = ($pemakaian['jumlah']!=null) ? $pemakaian['jumlah'] : 0;
            $resep = ($resep['jumlah']!=null) ? $resep['jumlah'] : 0;
            $retur = ($retur['jumlah']!=null) ? $retur['jumlah'] : 0;
            $obat_rusak = ($obat_rusak['jumlah']!=null) ? $obat_rusak['jumlah'] : 0;
            $persediaan = $pengadaan+$stok_awal;
            $total_pakai = (int)$pemakaian+$retur+$resep+$obat_rusak;
            $sisa = $persediaan-$total_pakai;

          }
          $data = array(
            'idobat' => $value->idobat,
            'nama' => $value->nama_obat,
            'harga' => "Rp.".number_format($value->harga_beli_satuan_kecil),
            'satuan_kecil' => $value->satuan_kecil,
            'stok_awal' => $stok_awal,
            'pengadaan' => $pengadaan,
            'persediaan' => $persediaan,
            'pemakaian' => $total_pakai,
            'retur' => $retur,
            'rusak' => $obat_rusak,
            'sisa' => $sisa,
          );
          array_push($response,$data);
        }
      }
      return $response;
    }


    public function get_lplpo($from,$till,$kelompok){
      if ($kelompok==NULL || $kelompok=='') {
        $obat = $this->db
        ->order_by("idobat")
        ->get('obat')->result();
      }else if($kelompok=="Lainnya"){
        $obat = $this->db
        ->order_by("idobat")
        ->get_where('obat')->result();
      }
      else{
        $obat = $this->db
        ->order_by('idobat')
        ->get_where('obat',array("kelompok_obat"=>$kelompok))->result();
      }
    }

    // public function get_stok_batch($from,$till){
    //   return $this->db->order_by('id')->get_where('list_batch',$)
    // }

    public function get_rajal_ranap($from,$till)
    {
      $data = array();
      $data['rajal'] = $this->db->select("COUNT(*) AS jml_rajal")
                        ->get_where("kunjungan_2",array("jenis_kunjungan !="=> 7,'jenis_kelamin !='=>"",'acc_ranap' => 0,"DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till ))
                        ->row_array()['jml_rajal'];
      $data['ranap'] = $this->db->select("COUNT(*) AS jml_ranap")
                        ->get_where("kunjungan_2",array("jenis_kunjungan !=" => 7,'jenis_kelamin !='=>"",'acc_ranap' => 1,"DATE(tgl_kunjungan) >="=>$from,"DATE(tgl_kunjungan) <="=>$till ))
                        ->row_array()['jml_ranap'];
      $data['jumlah'] = $data['rajal'] + $data['ranap'];
      return $data;
    }

    public function get_rekap_rujukan_internal($from,$till,$group = 0)
    {

                        if ($group == 1) {
                          $this->db->select("COUNT(rujukan_internal.tujuan_poli) as jml, rujukan_internal.tujuan_poli as tujuan_poli, rujukan_internal.poli as asal_poli");
                          $this->db->group_by("rujukan_internal.tujuan_poli, rujukan_internal.poli");
                        }else{
                          $this->db->select("rujukan_internal.poli as asal_poli, rujukan_internal.tujuan_poli as tujuan_poli,
                                            LEFT(rujukan_internal.tanggal_rujuk, 10) as tanggal,
                                            pasien.namapasien as nama, pasien.noRM as norm, kunjungan.no_antrian as no_antrian");
                        }
      $this->db->where(array("DATE(LEFT(rujukan_internal.tanggal_rujuk, 10)) >="=>$from,"DATE(LEFT(rujukan_internal.tanggal_rujuk, 10)) <="=>$till ));
      $this->db->join("kunjungan","kunjungan.no_urutkunjungan = rujukan_internal.kunjungan_no_urutkunjungan");
      $this->db->join("pasien","pasien.noRM = kunjungan.pasien_noRM");

      return $this->db->get("rujukan_internal");
    }

    public function get_rujukan_poli($from,$till)
    {
      // code...
    }

    public function get_kunjungan_dokter(){
      $data_poli = $this->db
      ->where("tgl",date("Y-m-d"))
      ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
      ->group_by("tupel_kode_tupel")
      ->get("kunjungan")->result();
      $response = array();
      foreach ($data_poli as $value) {
        $data_dokter = $this->db
        ->where("tgl",date("Y-m-d"))
        ->join("periksa","kunjungan.no_urutkunjungan=periksa.kunjungan_no_urutkunjungan")
        ->join("pegawai","pegawai.NIK=periksa.operator")
        ->group_by("periksa.operator")
        ->get("kunjungan")->result();
        // die(var_dump($data_dokter));
        $res = array(
          'poli' => $value->tujuan_pelayanan,
          'dokter' => array()
        );
        $no = 0;
        foreach ($data_dokter as $value2) {
          $data2 = $this->db->get("jenis_pasien")->result();
          array_push($res['dokter'],array(
            'nama_dokter' => $value2->nama,
            'pasien' => array()
          ));
          // die(var_dump());
          foreach ($data2 as $val) {
            $jumlah = $this->db
            ->select("count(*) as jumlah")
            ->join("periksa","kunjungan.no_urutkunjungan=periksa.kunjungan_no_urutkunjungan")
            ->join("pegawai","pegawai.NIK=periksa.operator")
            ->where("tgl",date("Y-m-d"))
            ->where("sumber_dana",$val->kode_jenis)
            ->where("periksa.operator",$value2->NIK)
            ->get("kunjungan")->row_array();
            array_push($res['dokter'][$no]['pasien'],array(
              'sumber_dana' => $val->jenis_pasien,
              'jumlah' => $jumlah['jumlah'],
            ));
          }
          // echo "<pre>";
          // print_r($res);
          // echo "</pre>";
          // die();
        }
        array_push($response,$res);
      }
      // echo "<pre>";
      // print_r($response);
      // echo "</pre>";
      // die();
      // die(var_dump($response));
      return $response;
    }
}
