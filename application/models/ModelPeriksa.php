<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPeriksa extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  // function get_tindakan($idperiksa){
  //   return $this->db
  //   ->get_where("tindakan",array("periksa_idperiksa"=>$idperiksa))->result();
  // }
  // function get_diagnosa($idperiksa){
  //   return $this->db
  //   ->join("penyakit","penyakit.kodeicdx=diagnosa.kodesakit")
  //   ->get_where("diagnosa",array("periksa_idperiksa"=>$idperiksa))->result();
  // }
  function get_data_edit($idperiksa){
    return $this->db->get_where('periksa',array('idperiksa'=>$idperiksa))->row_array();
  }
  function get_periksa_pasien($periksa)
  {
    $this->db->where(array('kunjungan_no_urutkunjungan' => $periksa,"unit_layanan"=>$_SESSION['poli'] ));
    return $this->db->get('periksa')->row_array();
  }
  function get_periksa_pasien_mandiri($periksa)
  {
    $this->db->where(array('kunjungan_no_urutkunjungan' => $periksa));
    return $this->db->get('periksa')->row_array();
  }

  function get_diagnosa($periksa)
  {
    $this->db->join('penyakit', 'penyakit.kodeicdx = diagnosa.kodesakit');
    $this->db->where(array('periksa_idperiksa' => $periksa, ));
    return $this->db->get('diagnosa');
    // return null;
  }

  function get_tindakan($periksa)
  {
    $this->db->where(array('periksa_idperiksa' => $periksa, ));
    return $this->db->get('tindakan');
  }

  function get_lab($periksa)
  {
    $this->db->where('periksa_idperiksa', $periksa);
    $lab = $this->db->get('labkunjungan')->row_array();
    return $this->db->get_where('detaillab', array('nourutlab' => $lab['nokunjlab']));
  }

  function get_riwayat_lab($idperiksa)
  {
    // $kunjungan = $this->db->get_where("kunjungan",array("pasien_noRM"=>$norm))->result();
    // $nokun = array();
    // foreach ($kunjungan as $value) {
    //   array_push($nokun,$value->no_urutkunjungan);
    // }
    // if (empty($periksa)) {
    //     return null;
    // }else{
    //     $idperiksa = array();
    //     foreach ($periksa as $value) {
    //       array_push($idperiksa,$value->idperiksa);
    //     }

        $kunjungan_lab = $this->db->where_in("periksa_idperiksa",$idperiksa)->get("labkunjungan")->result();
        if (empty($kunjungan_lab)) {
          return null;
        }else{
          $nolab = array();
          foreach ($kunjungan_lab as $value) {
            array_push($nolab,$value->nokunjlab);
          }
          // die(var_dump($kunjungan_lab));
          // $this->db->where('periksa_idperiksa', $periksa);
          // $lab = $this->db->get('labkunjungan')->row_array();
          return $this->db->where_in('nourutlab',$nolab)->get('detaillab')->result();
        }
    // }
  }
  function get_bhp($periksa)
  {
    $this->db->join("obat","obat.idobat=pemakaian_obat.id_obat");
    $this->db->where_in('id_periksa', $periksa);
    return $this->db->get('pemakaian_obat');
  }
  public function get_resep($periksa){
    $resep = $this->db->get_where('resep',array('periksa_idperiksa'=>$periksa))->row_array();
    $this->db->join('resep','resep.no_resep=detail_resep.resep_no_resep');
    $this->db->join('obat','obat.idobat=detail_resep.obat_idobat');
    return $this->db->get_where('detail_resep',array('resep_no_resep'=>$resep['no_resep']));
  }
  public function get_jmlresep($periksa){

    return $this->db->get_where('resep',array('periksa_idperiksa'=>$periksa));
  }

  function get_riwayat_obgyn($pasien)
  {
    $this->db->where('pasien_noRM', $pasien);
    return $this->db->get('riwayat_obgyn');
  }

  function get_riwayat_penyakit($no_rm){
    // $this->db->cache_on();
    $this->db->where('pasien_noRM',$no_rm);
    $this->db->limit(100);
    $diagnosa = $this->db->get('diagnosa')->result();
    $temp_penyakit = array();
    $data_diagnosa = [];
    foreach ($diagnosa as $value) {
      $this->db->where("kodeicdx", $value->kodesakit);
      $penyakit = $this->db->get("penyakit")->row();
      array_push($data_diagnosa, (object)[
        'iddiagnosa' => $value->iddiagnosa,
        'kodesakit' => $value->kodesakit,
        'operator' => $value->operator,
        'jam' => $value->jam,
        'status_sakit' => $value->status_sakit,
        'periksa_idperiksa' => $value->periksa_idperiksa,
        'pasien_noRM' => $value->pasien_noRM,
        'idpenyakit' => $penyakit->idpenyakit,
        'kodeicdx' => $penyakit->kodeicdx,
        'nama_penyakit' => $penyakit->nama_penyakit,
        'wabah' => $penyakit->wabah,
        'nular' => $penyakit->nular,
        'bpjs' => $penyakit->bpjs,
        'non_spesialis' => $penyakit->non_spesialis,
        'indonesia' => $penyakit->indonesia,
      ]);
    }
    return $data_diagnosa;
  }

  function get_riwayat_kunjungan($no_rm){
    $this->db
    // ->limit(5,0)
    ->order_by("no_urutkunjungan","DESC")
    ->join('tujuan_pelayanan','kunjungan.tupel_kode_tupel=tujuan_pelayanan.kode_tupel')
    ->join("periksa","periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan")
    ->group_by("no_urutkunjungan");
    return $this->db->get_where('kunjungan',array('pasien_noRM'=>$no_rm))->result();
  }

  public function get_riwayat_kunjungan2($no_rm)
  {
    $this->db
    // ->limit(5,0)
    ->order_by("kunjungan.tgl","DESC")
    ->join('tujuan_pelayanan','kunjungan.tupel_kode_tupel=tujuan_pelayanan.kode_tupel')
    ->join("periksa","periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan")
    ->group_by("no_urutkunjungan");
    return $this->db->get_where('kunjungan',array('pasien_noRM'=>$no_rm))->result();
    // $this->db->select('*');
    // $this->db->from('kunjungan');
    // $this->db->join('tujuan_pelayanan','tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel','left');
    // $this->db->join('periksa','periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan','left');
    // $this->db->where('kunjungan.pasien_noRM',$no_rm);
    // $this->db->group_by('kunjungan.no_urutkunjungan');
    // $this->db->order_by('kunjungan.tgl','DESC');
    // return $this->db->get()->result();
    // // return $this->db->get('kunjungan')->result();
  }



  function get_bhp_batch($idobat){
    return $this->db
    ->get_where("list_batch",array("idobat"=>$idobat,"stok >"=>0))->result();
  }
}
