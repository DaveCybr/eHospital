<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function BridgingPendaftaran($id){
  $ci =& get_instance();
  $data = $ci->db
  ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
  ->where("no_urutkunjungan",$id)->get("kunjungan")
  ->row_array();
  $dokter = $ci->db->get_where("pegawai",array("NIK"=>$data["NIK"]))->row_array();
  $periksa = $ci->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id))->row_array();
  $diagnosa = $ci->db->get_where("diagnosa",array("periksa_idperiksa"=>$periksa["idperiksa"]))->row_array();
  $tujuan_pelayanan = $ci->ModelTujuanPelayanan->get_data_edit($data['tupel_kode_tupel'])->row_array();
  $data['noBPJS'] = strlen($data['noBPJS'])>13?trim($data['noBPJS']):str_pad($data['noBPJS'],13,"0",STR_PAD_LEFT);
  if (strlen($data['noBPJS'])> 13) {
    $ci->db->where("noRM",$data['noRM'])->update("pasien",array('noBPJS'=>$data['noBPJS']));
  }
  if (strlen($data['noBPJS'])< 13) {
    $ci->db->where("noRM",$data['noRM'])->update("pasien",array('noBPJS'=>$data['noBPJS']));
  }
  $no = $data['noBPJS'];
  // $no = "0001541606308";
  $url = "peserta/".$no;
  $response = json_decode(Pcare($url));
  $provider = $ci->Core->get_pcare();
  // die(var_dump($response));
  if ($response->metaData->code==200) {
    $pro = $response->response->kdProviderPst->kdProvider;
  }else{
    $pro = $provider['kdppk'];
  }
  $data_pcare = array(
    "kdProviderPeserta" => $pro,
    "tglDaftar"         => date("d-m-Y",strtotime($data['tgl'])),
    "noKartu"           => $data['noBPJS'],
    "kdPoli"            => $tujuan_pelayanan['kdpcare'],
    "keluhan"           => $data['keluhan'],
    "kunjSakit"         => $data['kunjungansakit']==1?true:false,
    "sistole"           => 0,
    "diastole"          => 0,
    "beratBadan"        => $data['bb'],
    "tinggiBadan"       => $data['tb'],
    "respRate"          => 0,
    "heartRate"         => 0,
    "rujukBalik"        => 0,
    "kdTkp"             => 10
  );
  $bridge = PCare("pendaftaran","POST",json_encode($data_pcare));
  // die(var_dump($bridge));
  $bridge = json_decode($bridge);
  return $bridge;
}

function BridgingPendaftaranRanap($id){
  $ci =& get_instance();
  $tgl_rujuk = $ci->db->get_where("rujukan_internal",array("kunjungan_no_urutkunjungan"=>$id,"tujuan_poli"=>"RANAP"))->row();
  $data = $ci->db
  ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
  ->where("no_urutkunjungan",$id)->get("kunjungan")
  ->row_array();
  $dokter = $ci->db->get_where("pegawai",array("NIK"=>$data["NIK"]))->row_array();
  $periksa = $ci->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id))->row_array();
  $diagnosa = $ci->db->get_where("diagnosa",array("periksa_idperiksa"=>$periksa["idperiksa"]))->row_array();
  $tujuan_pelayanan = $ci->db->get_where("tujuan_pelayanan",array("kode_tupel"=>"IGD"))->row_array();
  $data['noBPJS'] = strlen($data['noBPJS'])>13?trim($data['noBPJS']):str_pad($data['noBPJS'],13,"0",STR_PAD_LEFT);
  if (strlen($data['noBPJS'])> 13) {
    $ci->db->where("noRM",$data['noRM'])->update("pasien",array('noBPJS'=>$data['noBPJS']));
  }
  if (strlen($data['noBPJS'])< 13) {
    $ci->db->where("noRM",$data['noRM'])->update("pasien",array('noBPJS'=>$data['noBPJS']));
  }
  $no = $data['noBPJS'];
  // $no = "0001541606308";
  $url = "peserta/".$no;
  $response = json_decode(Pcare($url));
  $provider = $ci->Core->get_pcare();
  // die(var_dump($response));
  if ($response->metaData->code==200) {
    $pro = $response->response->kdProviderPst->kdProvider;
  }else{
    $pro = $provider['kdppk'];
  }

  $bbtb = $ci->db
  ->order_by("no_urutkunjungan","DESC")
  ->get_where("kunjungan",array("pasien_noRM"=>$data['pasien_noRM'],"bb !="=>0,"tb !="=>0))->row();
  if (empty($bbtb)) {
    $bbtb = $ci->db
    ->order_by("idperiksa","DESC")
    ->get_where("periksa",array("no_rm"=>$data['pasien_noRM'],"bb !="=>0,"tb !="=>0))->row();
    if (empty($bbtb)) {
      $bb = 0;
      $tb = 0;
    }else{
      $bb=$bbtb->obb;
      $tb=$bbtb->otb;
    }
  }else{
    $bb=$bbtb->bb;
    $tb=$bbtb->tb;
  }
  $data_pcare = array(
    "kdProviderPeserta" => $pro,
    "tglDaftar"         => date("d-m-Y",strtotime($tgl_rujuk->tanggal_rujuk)),
    "noKartu"           => $data['noBPJS'],
    "kdPoli"            => $tujuan_pelayanan['kdpcare'],
    "keluhan"           => $data['keluhan'],
    "kunjSakit"         => $data['kunjungansakit']==1?true:false,
    "sistole"           => 0,
    "diastole"          => 0,
    "beratBadan"        => $data['bb'],
    "tinggiBadan"       => $data['tb'],
    "respRate"          => 0,
    "heartRate"         => 0,
    "rujukBalik"        => 0,
    "kdTkp"             => 20
  );
  $bridge = PCare("pendaftaran","POST",json_encode($data_pcare));
  // die(var_dump($data_pcare));
  $bridge = json_decode($bridge);
  return $bridge;
}
function ambil_peserta_prolanis($nokartu){
  $ci =& get_instance();
  $url = "peserta/".$nokartu;
  $bridge = json_decode(Pcare($url));
  // echo "<pre>";
  // print_r($bridge);
  // echo "<pre>";
  // die();
  if (!empty($bridge)) {
    if ($bridge->metaData->code==200) {
      $ci->db->where("noBPJS",$nokartu)
      ->update("pasien",array('sudah_update'=> 1,"pstprol"=>$bridge->response->pstProl,'pstprb'=>$bridge->response->pstPrb));
    }
  }
}
function BridgingPemeriksaanRajal($id){
  $ci =& get_instance();
  $data_kunjungan = $ci->db
  ->join("pasien","pasien_noRM=noRM")
  ->get_where("kunjungan",array("no_urutkunjungan"=>$id))->row_array();
  $tujuan_pelayanan = $ci->ModelTujuanPelayanan->get_data_edit($data_kunjungan['tupel_kode_tupel'])->row_array();
  $data_periksa = $ci->db->get_where("periksa",array("kunjungan_no_urutkunjungan"=>$id))->row_array();
  $dokter = $ci->db->get_where("pegawai",array("NIK"=>$data_periksa["operator"]))->row_array();
  $diagnosa = $ci->db
  ->join("periksa","periksa_idperiksa=idperiksa")
  ->join("kunjungan","kunjungan_no_urutkunjungan=no_urutkunjungan")
  ->group_by("kodesakit")
  ->get_where("diagnosa",array("no_urutkunjungan"=>$id))->result();
  $icd = [null,null,null];
  $no = 0;
  foreach ($diagnosa as $value) {
    $icd[$no] = $value->kodesakit;
    $no++;
  }

  $data_kunjungan['noBPJS'] = strlen($data_kunjungan['noBPJS'])>13?trim($data_kunjungan['noBPJS']):str_pad($data_kunjungan['noBPJS'],13,"0",STR_PAD_LEFT);
  if (strlen($data_kunjungan['noBPJS'])> 13) {
    $ci->db->where("noRM",$data_kunjungan['noRM'])->update("pasien",array('noBPJS'=>$data_kunjungan['noBPJS']));
  }
  if (strlen($data_kunjungan['noBPJS'])< 13) {
    $ci->db->where("noRM",$data_kunjungan['noRM'])->update("pasien",array('noBPJS'=>$data_kunjungan['noBPJS']));
  }
  $kesadaran = array(
    'KOMPOMENTIS' => "01",
    'SAMNOLENSE' => "02",
    'STUPOR' => "03",
    'KOMA' => "04"

  );
  $pulang = 3;
  if ($data_kunjungan['rujuk_poli']==1) {
    $r = 005;
  }else{
    $r = 003;
  }
  $data_periksa['osadar'] = $data_periksa['osadar']==NULL?"KOMPOMENTIS":$data_periksa['osadar'];
  $data_pcare = array(
    "noKunjungan" => null,
    "noKartu"     => $data_kunjungan['noBPJS'],
    "tglDaftar"   => date("d-m-Y",strtotime($data_kunjungan['tgl'])),
    "kdPoli"      => $tujuan_pelayanan['kdpcare'],
    "keluhan"     => $data_kunjungan['keluhan'],
    "kdSadar"     => $kesadaran[$data_periksa['osadar']],
    "sistole"     => $data_periksa["osiastole"]==NULL?120:$data_periksa["osiastole"],
    "diastole"    => $data_periksa["odiastole"]==NULL?75:$data_periksa["odiastole"],
    "beratBadan"  => $data_periksa["obb"]==NULL?$data_kunjungan['bb']:$data_periksa["obb"],
    "tinggiBadan" => $data_periksa["otb"]==NULL?$data_kunjungan['tb']:$data_periksa["otb"],
    "respRate"    => $data_periksa["orr"]==NULL?18:$data_periksa["orr"],
    "heartRate"   => $data_periksa["onadi"]==NULL?80:$data_periksa["onadi"],
    "terapi"      => $data_periksa["oterapi"]==NULL?0:$data_periksa["oterapi"],
    "kdStatusPulang" => $pulang,
    "tglPulang"   => date("d-m-Y"),
    "kdDokter"    => $dokter['kode_bpjs'],
    // "kdDokter"    => '256044  ',
    "kdDiag1"     => $icd[0],
    "kdDiag2"     => $icd[1],
    "kdDiag3"     => $icd[2],
    "kdPoliRujukInternal" => $r,
    "rujukLanjut" => null,
    "kdTacc"      => 0,
    "alasanTacc"  => null
  );

  $bridge = PCare("kunjungan","POST",json_encode($data_pcare));
  // die(var_dump($bridge));
  $bridge = json_decode($bridge);
  $bridge = json_decode($data_pcare);
  $bridge = PcareV4("kunjungan","POST","text/plain",json_encode($data_pcare));
  if ($bridge->metaData->code==201) {
    $nokun =  $bridge->reseponse->message;
    $kode_tindakan = array();
    $tindakan = $ci->db
    ->join("periksa","periksa_idperiksa=idperiksa")
    ->join("kunjungan","kunjungan_no_urutkunjungan=no_urutkunjungan")
    ->get_where("tindakan",array("no_urutkunjungan"=>$id))->result();
    foreach ($tindakan as $value) {
      array_push($kode_tindakan,$value->kode_jasa);
    }
    for ($i=0; $i < count($kode_tindakan) ; $i++) {
      $data = array(
          "kdTindakanSK"=> 0,
          "noKunjungan"=> $nokun,
          "kdTindakan"=> $kode_tindakan[$i],
          "biaya"=> 0,
          "keterangan"=> null,
          "hasil"=> 0
      );
      PCare("tindakan","POST",json_encode($data));
    }
    if ($data_periksa["gl_sewaktu"]!=0 || $data_periksa["gl_puasa"]!=0 || $data_periksa["gl_post_prandial"]!=0 || $data_periksa["gl_hba"]!=0) {
      $data_lab = array(
        "kdMCU" => 0,
        "noKunjungan" => $nokun,
        "kdProvider"=> "0189B016",
        "tglPelayanan"=> date("d-m-Y"),
        "tekananDarahSistole"=> $data_periksa["osiastole"]==NULL?120:$data_periksa["osiastole"],
        "tekananDarahDiastole"=> $data_periksa["odiastole"]==NULL?75:$data_periksa["odiastole"],
        "radiologiFoto" => null,
        "darahRutinHemo"=> 0,
        "darahRutinLeu"=> 0,
        "darahRutinErit"=> 0,
        "darahRutinLaju"=> 0,
        "darahRutinHema"=> 0,
        "darahRutinTrom"=> 0,
        "lemakDarahHDL"=> 0,
        "lemakDarahLDL"=> 0,
        "lemakDarahChol"=> 0,
        "lemakDarahTrigli"=> 0,
        "gulaDarahSewaktu"=>$data_periksa["gl_sewaktu"],
        "gulaDarahPuasa"=> $data_periksa["gl_puasa"],
        "gulaDarahPostPrandial"=> $data_periksa["gl_post_prandial"],
        "gulaDarahHbA1c"=> $data_periksa["gl_hba"],
        "fungsiHatiSGOT"=> 0,
        "fungsiHatiSGPT"=> 0,
        "fungsiHatiGamma"=> 0,
        "fungsiHatiProtKual"=> 0,
        "fungsiHatiAlbumin"=> 0,
        "fungsiGinjalCrea"=> 0,
        "fungsiGinjalUreum"=> 0,
        "fungsiGinjalAsam"=> 0,
        "fungsiJantungABI"=> 0,
        "fungsiJantungEKG"=> null,
        "fungsiJantungEcho"=> null,
        "funduskopi"=> null,
        "pemeriksaanLain"=> null,
        "keterangan"=> null
      );
      PCare("mcu","POST",json_encode($data_lab));
    }

  }
  return $bridge;
}


function PCareLama($u="",$m="GET",$p=""){
    $ci =& get_instance();
    // $sess = $ci->session->userdata('telah_masuk');
    // $gedung = $sess['idgedung'];
    // $ci->db->where('id_gedung',$gedung);
    $d = $ci->db->get('pcare')->result();
    date_default_timezone_set('UTC');
    $TimeStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
    $c = curl_init();
    $data = trim(@$d[0]->consid);
    $secretKey = trim(@$d[0]->conssecret);
    $username = trim(@$d[0]->userpcare);
    $password = trim(@$d[0]->passpcare);
    $url = "http://api.bpjs-kesehatan.go.id/pcare-rest-v3.0/".$u;

    $curl = curl_init();
    curl_setopt_array($curl, array(
      //CURLOPT_URL => "http://dvlp.bpjs-kesehatan.go.id:9080/pcare-rest-dev/".$u,
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => $m,
      CURLOPT_POSTFIELDS => $p,
      CURLOPT_TIMEOUT => 15,
      CURLOPT_HTTPHEADER => array(
        "x-authorization: Basic ".base64_encode($username.":".$password.":095"),
        "authorization: Basic Og==",
        "content-type: application/json",
        "x-cons-id: ".$data,
        "x-signature: ".base64_encode(hash_hmac('sha256', $data."&".$TimeStamp, $secretKey, true))."\r",
        "x-timestamp: ".$TimeStamp."\r"
      ),
    ));
    return curl_exec($curl);
    // return $url;
    curl_close($curl);
}

function PCare($u="",$m="GET",$p="")
{
  // set_time_limit(30);

  $ci =& get_instance();
//   $sess = $ci->session->userdata('telah_masuk');
//   $gedung = $sess['idgedung'];
// //  $gedung = 46;
//   $ci->db->where('id_gedung',$gedung);
  $d = $ci->db->get('pcare')->result();
  date_default_timezone_set('UTC');
  $TimeStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
  $c = curl_init();


  // $data = "20563";
  // $secretKey ="1cQB4BD0FC";
  // $username = "tamangading";
  // $password = "Dokterku@09";

  $data = '20563'; //trim(@$d[0]->consid)
  $secretKey = '1cQB4BD0FC';  //trim(@$d[0]->conssecret)
  $username = 'tamangading'; //trim(@$d[0]->userpcare)
  $password = 'Dokterku@13'; //trim(@$d[0]->passpcare)
  $var1 = $data."&".$TimeStamp;
  // die(var_dump($password));
  // Computes the signature by hashing the salt with the secret key as the key
  $signature = hash_hmac('sha256', $var1, $secretKey, true);
  // base64 encode…
  $encodedSignature = base64_encode($signature);
//	die(var_dump($secretKey));

  $kodeaplikasi = "095";
  $XAuthorization	= base64_encode($username.":".$password.":".$kodeaplikasi);
  // echo $TimeStamp."<br>";
  // echo $encodedSignature;
  //
  // die();
  // echo "X-cons-id :". $data ."<br />" . "X-TimeStamp: ". $TimeStamp ." <br />" ."X-Signature : ". $encodedSignature ." <br />"."X-Authorization : Basic " . $XAuthorization ."<br />"."Content-type:application/json".
  // "<br />"."Authorization:Basic Og==";

  $curl = curl_init();
   // CURLOPT_URL => "http://dvlp.bpjs-kesehatan.go.id:9080/pcare-rest-dev/v1/peserta/0001101521158",
  //  CURLOPT_URL => "http://dvlp.bpjs-kesehatan.go.id:9080/pcare-rest-dev/v2/peserta/0000029247423",
  //  CURLOPT_URL => "http://dvlp.bpjs-kesehatan.go.id:9080/pcare-rest-dev/v2/peserta/0001101521158",

  curl_setopt_array($curl, array(
    //CURLOPT_PORT => "9080",
//    CURLOPT_URL => "http://api.bpjs-kesehatan.go.id/pcare-rest-v3.0/provider/0/3",
    CURLOPT_URL => "https://new-api.bpjs-kesehatan.go.id/pcare-rest-v3.0/".$u,
    // CURLOPT_URL => "http://shopertan.com/",

//     CURLOPT_URL => "https://dvlp.bpjs-kesehatan.go.id:9081/pcare-rest-v3.0/".$u,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_POSTFIELDS => $p,
    CURLOPT_CONNECTTIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $m,
    CURLOPT_HTTPHEADER => array(
      "authorization: Basic Og==",
      "cache-control: no-cache",
      "content-type: application/json",
  	//"postman-token: d32ffc71-e790-89ad-c9f9-d2acd1c89532",
      "x-authorization: Basic ".$XAuthorization,
  	//"x-authorization: Basic dGFtYW5nYWRpbmc6UmFoYXNpYURva3Rlcmt1KjE6MDk1",
      "x-cons-id: ".$data,
      "x-signature: ".$encodedSignature,
      "x-timestamp: ".$TimeStamp
    ),
  ));

  $response = curl_exec($curl);
  // $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  // var_dump($code);
  $err = curl_error($curl);
  // var_dump($err);
  curl_close($curl);

  // if ($err) {
  //   return "cURL Error #:" . $err;
  // } else {
    return $response;
  // }
}

function Pemeriksaan($rm,$tindakan=true,$laborat=true,$obat=false){
  $ci =& get_instance();
  $err = array();
  $msg = array();
  $e = "";
  $nokunj="";

  $ci->db->select("p.nobpjs,rrm.*");
  $ci->db->join('rekam_medik rm','rm.ID_PASIEN=p.ID_PASIEN');
  $ci->db->join('riwayat_rm rrm','rrm.ID_REKAMMEDIK=rm.ID_REKAMMEDIK');
  $ci->db->where('rrm.ID_RIWAYAT_RM',$rm);
  $d = $ci->db->get('pasien p')->result();

  $ci->db->select('icd.*,dp.DESKRIPSI_DP');
  $ci->db->join('icd_table icd','icd.ID_ICD=dp.ID_ICD');
  $ci->db->where('dp.ID_RIWAYAT_RM ='.$rm);
  $icd = $ci->db->get('diagnosa_pasien dp')->result();
  $post = '{
    "noKunjungan": null,
    "noKartu": "'.$d[0]->nobpjs.'",
    "tglDaftar": "'.date('d-m-Y',strtotime($d[0]->TANGGAL_RIWAYAT_RM)).'",
    "keluhan": "'.@$icd[0]->DESKRIPSI_DP.' ",
    "kdSadar": "'.(empty($d[0]->sadar)?'01':$d[0]->sadar).'",
    "sistole": '.intval($d[0]->SISTOL_PASIEN).',
    "diastole": '.intval($d[0]->DIASTOL_PASIEN).',
    "beratBadan": '.intval($d[0]->BERATBADAN_PASIEN).',
    "tinggiBadan": '.intval($d[0]->TINGGIBADAN_PASIEN).',
    "respRate": '.intval($d[0]->DETAK_JANTUNG).',
    "heartRate": '.intval($d[0]->NAPAS_PER_MENIT).',
    "terapi": " ",
    "kdProviderRujukLanjut": "'.(!empty($d[0]->kdrujukan)?$d[0]->kdrujukan:' ').'",
    "kdStatusPulang": "'.(empty($d[0]->kdrujukan)?'3':'4').'",
    "tglPulang": "'.date('d-m-Y').'",
    "kdDokter": "'.(empty($d[0]->kddokter)?' ':$d[0]->kddokter).'",
    "kdDiag1": '.(empty($icd[0])?'"A00.1"':'"'.$icd[0]->CATEGORY.(empty($icd[0]->SUBCATEGORY)?'':'.'.$icd[0]->SUBCATEGORY).'"').',
    "kdDiag2": '.(empty($icd[1])?'null':'"'.$icd[1]->CATEGORY.(empty($icd[1]->SUBCATEGORY)?'':'.'.$icd[1]->SUBCATEGORY).'"').',
    "kdDiag3": '.(empty($icd[2])?'null':'"'.$icd[2]->CATEGORY.(empty($icd[2]->SUBCATEGORY)?'':'.'.$icd[2]->SUBCATEGORY).'"').',
    "kdPoliRujukInternal": null,
    "kdPoliRujukLanjut": "'.(empty($d[0]->kdpolirujuk)?' ':$d[0]->kdpolirujuk).'",
    "kdTacc": '.(!empty($d[0]->kdtacc)?'null':'"'.$d[0]->kdtacc.'"').',
    "alasanTacc": '.(empty($d[0]->alasantacc)?'null':'"'.$d[0]->alasantacc.'"').'
  }';
  // echo $post."<hr>";
  // $res = PCare("kunjungan","POST",$post);
  // echo $res;
  // $jd = json_decode($res);
  // if(is_object($jd)){
  //   flasDataPCare($jd);
  //     if($jd->metaData->code=='201'){
  //       $nokunj = trim($jd->response->message);
  //       try {
  //         $ci->db->where('ID_RIWAYAT_RM',$rm);
  //         $ci->db->update('riwayat_rm',array('kdkunjungan'=>$nokunj));
  //       } catch (Exception $e) {
  //         $e = "?code=500&err=Pemeriksaan&msg=".$e->message;
  //       }
  //     }else{
  //       $e = "?code=".$jd->metaData->code."&err=Pemeriksaan&msg=".@$jd->response->field."&fld=".@$jd->response->message;
  //     }
  // }else{
  //       $e = "?code=500&err=Pemeriksaan";
  // }
  $msg2=array(); $fld = array();
  if($nokunj!=""){
    $i=0;
    if($tindakan) {
      $x = Tindakan($rm,$nokunj);
      // echo "Tindakan : ".$x;
      if($x!="") {$err[]=$x; $msg[]="Tindakan";}
    }
    if($obat) {
      // echo "Obat : ".$x;
      $x = Obat($rm,$nokunj);
      if($x!="") {$err[]=$x; $msg[]="Resep Obat";}
    }
    if($laborat) {
      $x = Laboratorium($rm,$nokunj);
      // echo "Laboratorium : ".$x;
      if($x!="") {$err[]=$x; $msg[]="Laboratorium";}
    }
  }

  if(count($err)>0){
    $e = "?".http_build_query(array('code'=>$err,'err'=>$msg));
  }
  return $e;
}
function NotifPCare(){
  $code = @$_GET['code'];
  if(!empty($code)){
    if(is_array($code)){
      foreach ($code as $key => $v) {
        echo '<div class="col-md-12">
              <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                  <i class="fa fa-times"></i>
                </button>
                <strong>Bridging Gagal !!! </strong> '.ErrorPCare($v).' <br>('.@$_GET["err"][$key].')
              </div>
            </div>';
      }
    }else{
      echo '<div class="col-md-12">
            <div class="alert alert-block alert-danger fade in">
              <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
              </button>
              <strong>Bridging Gagal !!! </strong> '.ErrorPCare($code).' <br>('.@$_GET["err"].')
            </div>
          </div>';
    }
  }
}
function Obat($rm,$kdkunjungan,$kode_resep){
  $ci =& get_instance();

  $e = "";
  if(empty($kdkunjungan)){
    $e="200";
  }else{
    $ci->db->select('op.*,o.*');
    $ci->db->join('obat o','op.ID_OBAT=o.ID_OBAT');
    $ci->db->where(array('op.ID_RIWAYAT_RM'=>$rm, 'KODE_RESEP'=>$kode_resep));
    $d = $ci->db->get('obat_pasien op')->result();
    $obatpasiean = array();
    foreach ($d as $n => $v) {
      $signa = explode('dd',$v->SIGNA);
      $res = PCare('obat/kunjungan','POST',
          '{
            "kdObatSK": 0,
            "noKunjungan": "'.$kdkunjungan.'",
            "racikan": false,
            "kdRacikan": null,
            "obatDPHO": false,
            "kdObat": " ",
            "signa1": '.intval(@$signa[0]).',
            "signa2": 1,
            "jmlObat": '.$v->JUMLAH.',
            "jmlPermintaan": 0,
            "nmObatNonDPHO": "'.$v->NAMA_OBAT.'"
          }'
      );
      echo '{
            "kdObatSK": 0,
            "noKunjungan": "'.$kdkunjungan.'",
            "racikan": false,
            "kdRacikan": null,
            "obatDPHO": false,
            "kdObat": " ",
            "signa1": '.intval(@$signa[0]).',
            "signa2": 1,
            "jmlObat": '.$v->JUMLAH.',
            "jmlPermintaan": 0,
            "nmObatNonDPHO": "'.$v->NAMA_OBAT.'"
          }';
      echo "<hr>".$res."<hr>";
      $jd = json_decode($res);
      if(is_object($jd)){
        if($jd->metaData->code != 201){
          $e = $jd->metaData->code;
          flasDataPCare($jd);
          $obatpasiean[] = $v->ID_OBATPASIEN;
        }
      }else $e = "500";
    }
  }
  if(!empty($obatpasiean)) $ci->db->where_in('ID_OBATPASIEN',$obatpasiean)->update('obat_pasien',array('sts'=>1));
    // $ci->db->query('update obat_pasien set sts=1 where '.implode(' OR ', $obatpasiean));
  return $e;
}

function Laboratorium($rm,$nokunjungan){
  $ci =& get_instance();
  $e="";
  if(empty($nokunjungan)){
    $e="?200";
  }else{
    $sess = $ci->session->userdata('telah_masuk');
    $gedung = $sess['idgedung'];
    $ci->db->where('id_gedung',$gedung);
    $p = $ci->db->get('pcare')->result();
    $ppk = @$p[0]->kodeppk;

    $ci->db->select('rm.SISTOL_PASIEN,rm.DIASTOL_PASIEN,pl.*,cl.HASIL_TES_LAB as hasil,cl.TANGGAL_TES_LAB as tanggal, rm.SISTOL_PASIEN,rm.DIASTOL_PASIEN');
    $ci->db->join('pemeriksaan_laborat pl','cl.ID_PEM_LABORAT=pl.ID_PEM_LABORAT');
    $ci->db->join('riwayat_rm rm','rm.ID_RIWAYAT_RM=cl.ID_RIWAYAT_RM');
    $ci->db->where(array('cl.ID_RIWAYAT_RM'=>$rm));
    $d = $ci->db->get('cek_laborat cl')->result();
    // echo $ci->db->last_query()."<hr><br>";
    if(!empty($d)){
      $lab = array();

      foreach ($d as $key => $v) {
        if(!empty($v->pfield)){
          $lab[$v->pfield] = intval($v->hasil);
        }
      }

      $resp = PCare('mcu','POST','{
        "kdMCU": 0,
        "noKunjungan": "'.$nokunjungan.'",
        "kdProvider": "'.$ppk.'",
        "tglPelayanan": "'.date('d-m-Y',strtotime(@$d[0]->tanggal)).'",
        "tekananDarahSistole": '.intval(@$d[0]->SISTOL_PASIEN).',
        "tekananDarahDiastole": '.intval(@$d[0]->DIASTOL_PASIEN).',
        "radiologiFoto": null,
        "darahRutinHemo": '.intval(@$lab['darahRutinHemo']).',
        "darahRutinLeu": '.intval(@$lab['darahRutinLeu']).',
        "darahRutinErit": '.intval(@$lab['darahRutinErit']).',
        "darahRutinLaju": '.intval(@$lab['darahRutinLaju']).',
        "darahRutinHema": '.intval(@$lab['darahRutinHema']).',
        "darahRutinTrom": '.intval(@$lab['darahRutinTrom']).',
        "lemakDarahHDL": '.intval(@$lab['lemakDarahHDL']).',
        "lemakDarahLDL": '.intval(@$lab['lemakDarahLDL']).',
        "lemakDarahChol": '.intval(@$lab['lemakDarahChol']).',
        "lemakDarahTrigli": '.intval(@$lab['lemakDarahTrigli']).',
        "gulaDarahSewaktu": '.intval(@$lab['gulaDarahSewaktu']).',
        "gulaDarahPuasa": '.intval(@$lab['gulaDarahPuasa']).',
        "gulaDarahPostPrandial": '.intval(@$lab['gulaDarahPostPrandial']).',
        "gulaDarahHbA1c": '.intval(@$lab['gulaDarahHbA1c']).',
        "fungsiHatiSGOT": '.intval(@$lab['fungsiHatiSGOT']).',
        "fungsiHatiSGPT": '.intval(@$lab['fungsiHatiSGPT']).',
        "fungsiHatiGamma": '.intval(@$lab['fungsiHatiGamma']).',
        "fungsiHatiProtKual": '.intval(@$lab['fungsiHatiProtKual']).',
        "fungsiHatiAlbumin": '.intval(@$lab['fungsiHatiAlbumin']).',
        "fungsiGinjalCrea": '.intval(@$lab['fungsiGinjalCrea']).',
        "fungsiGinjalUreum": '.intval(@$lab['fungsiGinjalUreum']).',
        "fungsiGinjalAsam": '.intval(@$lab['fungsiGinjalAsam']).',
        "fungsiJantungABI": '.intval(@$lab['fungsiJantungABI']).',
        "fungsiJantungEKG": null,
        "fungsiJantungEcho": null,
        "funduskopi": null,
        "pemeriksaanLain": null,
        "keterangan": null
      }');
      echo $resp;
      $jd = json_decode($resp);
      if(is_object($jd)){
        flasDataPCare($jd);
        if($jd->metaData->code == 201){
          $e = "";
          $ci->db->where(array('ID_RIWAYAT_RM'=>$rm));
          $ci->db->update('cek_laborat',array('sts'=>1));
        }else $e=$jd->metaData->code;
      }else $e='500';
    }
  }
  return $e;
}

function Tindakan($rm,$nokunjungan){
  $ci =& get_instance();

  $e = "";
  if(empty($nokunjungan)){
    $e="200";
  }else{
    $ci->db->select("l.*");
    $ci->db->where('ID_RIWAYAT_RM = '.$rm);
    $ci->db->join('layanan_kesehatan l','l.ID_LAYANAN_KES=t.ID_LAYANAN_KES');
    $d =  $ci->db->get('tindakan_pasien t')->result();
    $tindakanpasiean = array();
    foreach ($d as $n => $v) {
      if(!empty($v->kdtindakan)){
        $jd = json_decode(PCARE('tindakan','POST',
          '{
             "kdTindakanSK": 0,
             "noKunjungan": "'.$nokunjungan.'",
             "kdTindakan": "'.$v->kdtindakan.'",
             "biaya": 0,
             "keterangan": null,
             "hasil": 1
           }'
        ));
        if(is_object($jd)){
          if($jd->metaData->code!=201) {
              flasDataPCare($jd);
              $e = $jd->metaData->code;
              $tindakanpasiean[] = $v->ID_TINDAKAN_PASIEN;
          }
        }else $e="500";
      }
    }
  }
  if(!empty($tindakanpasiean)) $ci->db->where_in('ID_TINDAKAN_PASIEN',$tindakanpasiean)->update('tindakan_pasien',array('sts'=>1));
    // $ci->db->query('update tindakan_pasien set sts=1 where '.implode(' OR ',$tindakanpasiean));
  return $e;
}

function ErrorPCare($code){
  $ci =& get_instance();
  $msg = "";
  switch ($code) {
    case 100: $msg = "No BPJS Kosong";break;
    case 200: $msg = "Pasien Belum di daftarkan";break;
    case 204: $msg = "Data Tidak ditemukan";break;
    case 412: $msg = "Precondition Failed / Field ada yang Kosong";break;
    case 424: $msg = "Dependency Failed";break;
    case 404: $msg = "Time Out";break;
    case 401: $msg = "Username / Password Salah";break;
    case 304: $msg = "Pasien Sudah Di daftarkan";break;
    case 500: $msg = "INTERNAL_SERVER_ERROR, cause : I/O Error: Connection reset by peer: socket write error";break;
    default : $msg = "Terjadi Kesalahan pada system"; break;
  }
  return $msg." ".@$_GET['msg']." ".@$_GET['fld']."<br>".implode('<br>',empty($ci->session->userdata('PCARE'))?array():$ci->session->userdata('PCARE'));
}
function Kesadaran(){
  return array('01'=>'Compos mentis','02'=>'Somnolence','03'=>'Sopor','04'=>'Coma');
}
function StsPulang(){
  return array('Sembuh','Meninggal','Pulang Paksa','Berobat Jalan','Rujuk Lanjut','Rujuk Internal',9 => 'Lain-Lain');
}

function getPPK($kd){
  $d = json_decode(PCare('peserta/'.$kd));
  if(is_object($d)){
    return $d->response->kdProviderPst->kdProvider;
  }else{
    return '';
  }
}
function flasDataPCare($dt){
  // print_r($dt);
  // exit();
  $msg=array(' ');
  switch ($dt->metaData->code) {
    case 412:
        $msg = array();
        foreach ($dt->response as $v) {
          $msg[]=$v->field." ".$v->message;
        }
      break;
    case 304:
        $msg = array($dt->response);
      break;
    default : $msg = array($dt->metaData->message); break;
  }
  $ci =& get_instance();
  $ci->session->set_userdata('PCARE',$msg);
  // $d['responsePCare'] = " ".implode(' ',$dt);
  // $ci->session->set_userdata('telah_masuk',$d);
}
function getDokterPCare(){
  // $dt = array();
  // foreach (range(1,9) as $v) {
  //   $dt[] = '{"kdDokter":"00'.$v.'","nmDokter":"Dokter '.$v.'"}';
  // }
  // $res = '{"response":{"count":19,"list":['.implode(',',$dt).']},"metaData":{"message":"OK","code":200}}';
  $res = PCare('dokter/0/1000');
  // echo $res;
  // exit();
  $res = json_decode($res);
  $dt = array();
  if(is_object($res)){
    if($res->metaData->code==200){
      $kd = array(); $dkt = array();
      foreach ($res->response->list as $key => $v) {
        $dt[$v->kdDokter] = $v->nmDokter;
      }
    }
    return $dt;
  }else return array();
}
function getPoliPCare(){
  $dt = array('020'=>'Home-Visit','021'=>'Konseling','023'=>'Imunisasi (BCG)','024'=>'Imunisasi (DPT)','025'=>'Imunisasi (Polio)','026'=>'Imunisasi (Campak)','027'=>'Imunisasi (Hep. B)');
  $dtp = array();
  $r = json_decode(PCare('poli/fktp/0/100'));
  // $r = PCare('poli/fktp/0/100');
  // die(var_dump($r));
  if(is_object($r)){
    if($r->metaData->code==200){
      foreach ($r->response->list as $key => $v) {
        if(!$v->poliSakit){
          $dtp[$v->kdPoli] = $v->nmPoli.' (PCARE)';
        }
      }
    }
  }
  return empty($dtp)?$dt:$dtp;
}
function getSemuaPoliPCare(){
  //$dt = array('020'=>'Home-Visit','021'=>'Konseling','023'=>'Imunisasi (BCG)','024'=>'Imunisasi (DPT)','025'=>'Imunisasi (Polio)','026'=>'Imunisasi (Campak)','027'=>'Imunisasi (Hep. B)');
  $dt = array();
  $dtp = array();
  $r = json_decode(PCare('poli/fktp/0/100'));
  // $r = PCare('poli/fktp/0/100');
  // die(var_dump($r));
  if(is_object($r)){
    if($r->metaData->code==200){
      foreach ($r->response->list as $key => $v) {
        // if(!$v->poliSakit){
        array_push($dtp,array(
          "kdpoli" =>$v->kdPoli,
          "poli" => $v->nmPoli,
          "poliSakit" => $v->poliSakit==1?$v->poliSakit:0,
        ));
        // }
      }
    }
  }
  return empty($dtp)?$dt:$dtp;
}

function get_fktl(){
  $d = '{"response":{"count":91,"list":[{"kdPoli":"","nmPoli":"","poliSakit":true},{"kdPoli":"AKP","nmPoli":"Akupuntur","poliSakit":true},{"kdPoli":"ALG","nmPoli":"Alergi","poliSakit":true},{"kdPoli":"ANU","nmPoli":"Anuscopy","poliSakit":true},{"kdPoli":"APT","nmPoli":"APOTIK","poliSakit":true},{"kdPoli":"ASM","nmPoli":"ASM","poliSakit":true},{"kdPoli":"BDS","nmPoli":"BDS","poliSakit":true},{"kdPoli":"BSY","nmPoli":"Bedah Syaraf","poliSakit":true},{"kdPoli":"R12","nmPoli":"Boneseah","poliSakit":true},{"kdPoli":"CAN","nmPoli":"CAN","poliSakit":true},{"kdPoli":"CTS","nmPoli":"CT Scan","poliSakit":true},{"kdPoli":"DRH","nmPoli":"Darah","poliSakit":true},{"kdPoli":"DBM","nmPoli":"Diabetes Melitus","poliSakit":true},{"kdPoli":"ECO","nmPoli":"Echo","poliSakit":true},{"kdPoli":"ELK","nmPoli":"ELK","poliSakit":true},{"kdPoli":"END","nmPoli":"Endokrin","poliSakit":true},{"kdPoli":"ESW","nmPoli":"ESWL","poliSakit":true},{"kdPoli":"FIS","nmPoli":"Fisioterapi","poliSakit":true},{"kdPoli":"GAS","nmPoli":"Gastro","poliSakit":true},{"kdPoli":"GER","nmPoli":"Geriatri","poliSakit":true},{"kdPoli":"GP1","nmPoli":"Gigi","poliSakit":true},{"kdPoli":"GTS","nmPoli":"GILA ","poliSakit":true},{"kdPoli":"GIN","nmPoli":"Ginjal","poliSakit":true},{"kdPoli":"GIZ","nmPoli":"Gizi","poliSakit":true},{"kdPoli":"HAM","nmPoli":"HAM","poliSakit":true},{"kdPoli":"HEM","nmPoli":"Hematologi","poliSakit":true},{"kdPoli":"HDL","nmPoli":"Hemodialisa","poliSakit":true},{"kdPoli":"HEP","nmPoli":"Hepatologi","poliSakit":true},{"kdPoli":"HCU","nmPoli":"High Care Unit","poliSakit":true},{"kdPoli":"IKA","nmPoli":"Ilmu Kesehatan Anak","poliSakit":true},{"kdPoli":"IPD","nmPoli":"Ilmu Penyakit Dalam","poliSakit":true},{"kdPoli":"INF","nmPoli":"INSTALASI FARMASI","poliSakit":true},{"kdPoli":"IGD","nmPoli":"Instalasi Gawat Darurat","poliSakit":true},{"kdPoli":"IRM","nmPoli":"Installasi Rehabilitasi Medik","poliSakit":true},{"kdPoli":"ICU","nmPoli":"Intensive Care Unit","poliSakit":true},{"kdPoli":"IVP","nmPoli":"Intravena Pydografi","poliSakit":true},{"kdPoli":"JWA","nmPoli":"Jiwa Anak","poliSakit":true},{"kdPoli":"JWD","nmPoli":"Jiwa Dewasa","poliSakit":true},{"kdPoli":"KOL","nmPoli":"KOL","poliSakit":true},{"kdPoli":"LAB","nmPoli":"Laboratorium","poliSakit":true},{"kdPoli":"LAI","nmPoli":"Lain-Lain","poliSakit":true},{"kdPoli":"MRI","nmPoli":"MRI","poliSakit":true},{"kdPoli":"OKM","nmPoli":"OKM","poliSakit":true},{"kdPoli":"OPT","nmPoli":"OPTIK","poliSakit":true},{"kdPoli":"ORT","nmPoli":"ORT","poliSakit":true},{"kdPoli":"OTL","nmPoli":"OTL","poliSakit":true},{"kdPoli":"PAT","nmPoli":"PAT","poliSakit":true},{"kdPoli":"PMI","nmPoli":"PMI","poliSakit":true},{"kdPoli":"ANA","nmPoli":"Poli Anak","poliSakit":true},{"kdPoli":"BED","nmPoli":"Poli Bedah","poliSakit":true},{"kdPoli":"GIG","nmPoli":"Poli Gigi","poliSakit":true},{"kdPoli":"JAN","nmPoli":"Poli Jantung","poliSakit":true},{"kdPoli":"KLT","nmPoli":"Poli Kulit","poliSakit":true},{"kdPoli":"OBG","nmPoli":"Poli Obstetri/Gyn.","poliSakit":true},{"kdPoli":"PAR","nmPoli":"Poli Paru-paru","poliSakit":true},{"kdPoli":"INT","nmPoli":"Poli Penyakit Dalam","poliSakit":true},{"kdPoli":"JIW","nmPoli":"Poli Penyakit Jiwa","poliSakit":true},{"kdPoli":"MAT","nmPoli":"Poli Penyakit Mata","poliSakit":true},{"kdPoli":"SAR","nmPoli":"Poli Penyakit Saraf","poliSakit":true},{"kdPoli":"THT","nmPoli":"Poli Telinga/Hidung/Tenggorok","poliSakit":true},{"kdPoli":"BDA","nmPoli":"Poliklinik Bedah Anak","poliSakit":true},{"kdPoli":"BDD","nmPoli":"Poliklinik Bedah Digestif","poliSakit":true},{"kdPoli":"BDM","nmPoli":"Poliklinik Bedah Mulut","poliSakit":true},{"kdPoli":"BDO","nmPoli":"Poliklinik Bedah Onkologi","poliSakit":true},{"kdPoli":"BDP","nmPoli":"Poliklinik Bedah Plastik","poliSakit":true},{"kdPoli":"KON","nmPoli":"Poliklinik Gigi Konservatif","poliSakit":true},{"kdPoli":"PTD","nmPoli":"Poliklinik Prostodonti","poliSakit":true},{"kdPoli":"PPK","nmPoli":"PPK","poliSakit":true},{"kdPoli":"PSI","nmPoli":"PSI","poliSakit":true},{"kdPoli":"PSK","nmPoli":"PSK","poliSakit":true},{"kdPoli":"PUL","nmPoli":"Pulmonologi","poliSakit":true},{"kdPoli":"PKM","nmPoli":"PUSKESMAS","poliSakit":true},{"kdPoli":"RAD","nmPoli":"Radiologi","poliSakit":true},{"kdPoli":"RAA","nmPoli":"Radiologi Anak","poliSakit":true},{"kdPoli":"RAT","nmPoli":"Radioterapi","poliSakit":true},{"kdPoli":"NUK","nmPoli":"Radioterapi/Nuklir","poliSakit":true},{"kdPoli":"EKG","nmPoli":"Rekam Jantung","poliSakit":true},{"kdPoli":"REM","nmPoli":"REM","poliSakit":true},{"kdPoli":"RHM","nmPoli":"Rheumatologi","poliSakit":true},{"kdPoli":"RO2","nmPoli":"RO2","poliSakit":true},{"kdPoli":"SPC","nmPoli":"SPC","poliSakit":true},{"kdPoli":"TAK","nmPoli":"TAK","poliSakit":true},{"kdPoli":"TON","nmPoli":"TON","poliSakit":true},{"kdPoli":"TRD","nmPoli":"Treadmil Test","poliSakit":true},{"kdPoli":"TUM","nmPoli":"TUM","poliSakit":true},{"kdPoli":"UGD","nmPoli":"Unit Gawat Darurat","poliSakit":true},{"kdPoli":"CAP","nmPoli":"Unit Pelayanan CAPD","poliSakit":true},{"kdPoli":"URE","nmPoli":"URE","poliSakit":true},{"kdPoli":"URF","nmPoli":"URF","poliSakit":true},{"kdPoli":"URO","nmPoli":"URO","poliSakit":true},{"kdPoli":"USG","nmPoli":"USG","poliSakit":true}]},"metaData":{"message":"OK","code":200}}';
  $d = json_decode($d);
  $r = json_decode(PCare('poli/fktl/0/1000'));
  if(is_object($r)){
    $d = $r;
  }
  return $d->response->list;
}
function get_providers(){
  $d = '{"response":{"count":11,"list":[{"kdProvider":"0189R008","nmProvider":"CITRA HUSADA RS"},{"kdProvider":"0189R010","nmProvider":"RS PERKEBUNAN PTPN X"},{"kdProvider":"0189R012","nmProvider":"RSIA SRIKANDI IBI"},{"kdProvider":"0189R013","nmProvider":"RSU KALIWATES"},{"kdProvider":"1322R005","nmProvider":"RS SUMBERGLAGAH"},{"kdProvider":"1329R001","nmProvider":"DR SOEBANDI JEMBER, RSD"},{"kdProvider":"1329R002","nmProvider":"BALUNG RSD"},{"kdProvider":"1329R004","nmProvider":"KALISAT RSD"},{"kdProvider":"1329R005","nmProvider":"PARU RS"},{"kdProvider":"1329R006","nmProvider":"RS DKT/Baladhika Husada Jember"},{"kdProvider":"1329R007","nmProvider":"BINA SEHAT RS"}]},"metaData":{"message":"OK","code":200}}';
  $d = json_decode($d);
  $r = json_decode(PCare('provider/0/1000'));
  if(is_object($r)){
    $d = $r;
  }
  return $d->response->list;
}

// --------------- pcare v3 ---------------

function testingPcare($value='')
{
  echo $value;
  return Pcare($value);
}

function Bridge_BerobatJalan($data, $kdpoli){
    $this->db->select("p.nobpjs");
    $this->db->join('rekam_medik rm','rm.ID_PASIEN=p.ID_PASIEN');
    $this->db->join('riwayat_rm rrm','rrm.ID_REKAMMEDIK=rm.ID_REKAMMEDIK');
    $this->db->where('rrm.ID_RIWAYAT_RM',$data['id_rrm']);
    $d = $this->db->get('pasien p')->result();
    echo $data['id_rrm']."<br>";
    echo $d[0]->nobpjs;
    $icd = array();
    foreach ($data['idicd'] as $key => $value) {
        $this->db->where('ID_ICD',$value);
        $dic =  $this->db->get('icd_table')->result();
        if ($dic[0]->SUBCATEGORY == "") {
          $icd[] = $dic[0]->CATEGORY;
        }else {
          $icd[] = $dic[0]->CATEGORY.".".$dic[0]->SUBCATEGORY;
        }
     }
     $TACC='0';
     foreach ($data['spc'] as $key => $value) {
         if($value=='1') $TACC = '1';
     }
    $tacc = array();
    if($TACC=='1'){
        $tacc['kd'] = $data['kdtacc'];
        $tacc['alasan'] = $data['alasantacc'];
    }
    $rujukan = " ";
    if($data['rawat']=='2'){
        $rujukan = $data['srujuk'];
    }
    if(!empty($d[0]->nobpjs)){
        $post= '{
          "noKunjungan": null,
          "noKartu": "'.$d[0]->nobpjs.'",
          "tglDaftar": "'.date('d-m-Y').'",
          "kdPoli": "'.$kdpoli.'",
          "keluhan": "'.$data['keluhan'].' ",
          "kdSadar": "'.$data['sadar'].'",
          "sistole": '.(empty($data['sistol'])?0:$data['sistol']).',
          "diastole": '.(empty($data['diastol'])?0:$data['diastol']).',
          "beratBadan": '.(empty($data['berat'])?0:$data['berat']).',
          "tinggiBadan": '.(empty($data['tinggi'])?0:$data['tinggi']).',
          "respRate": '.(empty($data['jantung'])?0:$data['jantung']).',
          "heartRate": '.(empty($data['napas'])?0:$data['napas']).',
          "terapi": "null",
          "kdStatusPulang": "'.$data['pulang'].'",
          "tglPulang": "'.date('d-m-Y').'",
          "kdDokter": "81648",
          "kdDiag1": '.(empty($icd[0])?'null':'"'.$icd[0].'"').',
          "kdDiag2": '.(empty($icd[1])?'null':'"'.$icd[1].'"').',
          "kdDiag3": '.(empty($icd[2])?'null':'"'.$icd[2].'"').',
          "kdPoliRujukInternal": null,
          "rujukLanjut": null,
          "kdTacc": '.(empty($tacc['kd'])?'null':'"'.$tacc['kd'].'"').',
          "alasanTacc": '.(empty($tacc['alasan'])?'null':'"'.$tacc['alasan'].'"').'
        }';
        $d = PCare("kunjungan","POST",$post);
        $jd = json_decode($d);
        $erl = "";
        if(is_object($jd)){
            if($jd->metaData->code==201){
                $this->db->where('ID_RIWAYAT_RM',$data['id_rrm']);
                $this->db->update('riwayat_rm',array('kdkunjungan'=>$jd->response->message));
                $this->kdkunjungan = $jd->response->message;
            }else $erl = '?code='.$jd->metaData->code."&message=".$jd->metaData->message."&err=".@$jd->response[0]->field." ".@$jd->response[0]->message;
        }else $erl = '?code=500&message=INTERNAL_SERVER_ERROR';
    }else $erl = "?code=100&message=Number Bpjs is Null";
    $this->erl = $erl;
    echo $erl;
}
