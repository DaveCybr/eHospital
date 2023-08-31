<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class ModelKunjunganLab extends CI_Model{

    public function __construct()
    {
      parent::__construct();
      //Codeigniter : Write Less Do More

    }

    public function get_kunj($id){
      return $this->db
      ->join("periksa","periksa.idperiksa=labkunjungan.periksa_idperiksa")
      ->join("kunjungan","kunjungan.no_urutkunjungan=periksa.kunjungan_no_urutkunjungan")
      ->get_where("labkunjungan",array("nokunjlab"=>$id))->row_array();
    }

    function list_permintaan($tgl)
    {
      $this->db->join('periksa', 'periksa.idperiksa = labkunjungan.periksa_idperiksa');
      $this->db->join('kunjungan', 'kunjungan.no_urutkunjungan = periksa.kunjungan_no_urutkunjungan');
      $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
      $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
      $this->db->where(array('labkunjungan.tanggal'=>$tgl ));
      return $this->db->get('labkunjungan');
    }

    function data_kunjungan_lab($id)
    {
      // $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
      // $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
      // $this->db->where(array('sudah' => 3, 'no_urutkunjungan' => $id ));
      // return $this->db->get('kunjungan');
      $this->db->select('pegawai.nama as nama_analis,labkunjungan.*, pasien.*, jenis_pasien.*, kunjungan.*, periksa.*, labkunjungan.perawat1 AS perawat1_kun, labkunjungan.perawat2 AS perawat2_kun');
      $this->db->join('pegawai', 'pegawai.NIK = labkunjungan.analis','LEFT');
      $this->db->join('periksa', 'periksa.idperiksa = labkunjungan.periksa_idperiksa');
      $this->db->join('kunjungan', 'kunjungan.no_urutkunjungan = periksa.kunjungan_no_urutkunjungan');
      $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
      $this->db->join('jenis_pasien', 'jenis_pasien.kode_jenis = pasien.jenis_pasien_kode_jenis');
      $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
      $this->db->where(array('nokunjlab'=>$id ));
      return $this->db->get('labkunjungan');

    }
    function data_kunjungan_lab_2($id)
    {
      // $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
      // $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
      // $this->db->where(array('sudah' => 3, 'no_urutkunjungan' => $id ));
      // return $this->db->get('kunjungan');
      $this->db->select('sip,pegawai.nama as nama_dokter,labkunjungan.*, pasien.*, jenis_pasien.*, kunjungan.*, periksa.*, labkunjungan.perawat1 AS perawat1_kun, labkunjungan.perawat2 AS perawat2_kun');
      $this->db->join('pegawai', 'pegawai.NIK = labkunjungan.kodedok','LEFT');
      $this->db->join('periksa', 'periksa.idperiksa = labkunjungan.periksa_idperiksa');
      $this->db->join('kunjungan', 'kunjungan.no_urutkunjungan = periksa.kunjungan_no_urutkunjungan');
      $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
      $this->db->join('jenis_pasien', 'jenis_pasien.kode_jenis = pasien.jenis_pasien_kode_jenis');
      $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
      $this->db->where(array('nokunjlab'=>$id ));
      return $this->db->get('labkunjungan');

    }

    function periksa_lab($nokunlab)
    {
      $this->db->order_by("kode_lab","ASC");
      $this->db->join("laborat","laborat.kode_lab=detaillab.kodelab","left");
      $this->db->join('labkunjungan', 'labkunjungan.nokunjlab = detaillab.nourutlab');
      $this->db->where('nokunjlab', $nokunlab);
      return $this->db->get('detaillab');
    }

    function detail_kunjungan_lab($nokunlab)
    {
      $this->db->join('laborat', 'laborat.kode_lab = detaillab.kodelab');
      $this->db->where('detaillab.nourutlab', $nokunlab);
      $this->db->where('laborat.pcare !=""'); // mencari nilai pada kolom pcare yang tidak kosong didalam tabel laborat.
      return $this->db->get('detaillab');
    }

  }
 ?>
