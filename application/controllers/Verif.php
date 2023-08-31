<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verif extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Android/ModelDaftar");
    $this->load->model("ModelPasien");
    $this->load->model("ModelKunjungan");

    $this->load->model("ModelAkuntansi");
    $this->load->library('upload');
    $this->load->library('ciqrcode');
  }

  public function index(){

    $data = array(
      'body'      => "Verif/index",
      'booking' => $this->ModelDaftar->get_booking(),
      // 'biaya_adm' => $biaya['biaya_adm'],
    );
    $this->load->view('index',$data);
  }

  public function verifikasi(){
    $idbook = $this->uri->segment(3);
    $book = $this->db->get_where("booking",array("idbooking"=>$idbook))->row_array();
    if (strlen($book['noRM']) > 8)  {
      $cek = $this->db->get_where("pasien",array("pasien_sementara_noRM"=>$book['noRM']))->num_rows();
      if ($cek==0) {
        $pasien = $this->db->get_where("pasien_sementara",array("noRM"=>$book['noRM']))->row_array();
        $data_pasien = array(
          'noRM' => $this->ModelPasien->generete_noRM(),
          'namapasien' => strtoupper($pasien['namapasien']),
          'tgl_lahir' => $pasien['tgl_lahir'],
          'alamat' => strtoupper($pasien['alamat']),
          'telepon' => $pasien['telepon'],
          'tgl_daftar' => date("Y-m-d"),
          'kunjungan_terakhir' => date("Y-m-d"),
          'jenis_pasien_kode_jenis' => 1,
        );
        $this->db->insert("pasien",$data_pasien);
        $norm = $data_pasien['noRM'];
      }else{
        $pasien = $this->db->get_where("pasien",array("pasien_sementara_noRM"=>$book['noRM']))->row_array();
        $norm = $pasien['noRM'];
      }
    }else{
      $norm = $book['noRM'];
    }

    $data_kunjungan = array(
      'tgl' => $book['tanggal'],
      'tupel_kode_tupel' => $book['tupel_kode_tupel'],
      'jenis_kunjungan' => 1,
      'sumber_dana' => 1,
      'bb' => $book['berat'],
      'tb' => $book['tinggi'],
      'keluhan' => $book['keluhan'],
      'sudah' => '0',
      'pasien_noRM' => $norm,
      'administrasi' => 0
    );

    $tupel = $book['tupel_kode_tupel'];
    $no_antrian = null;
    if ($this->ModelKunjungan->total($tupel) > 0 ) {
      foreach ($this->ModelKunjungan->max_no($tupel)->result() as $value) {
        $no_antrian = $value->no_antrian + 1;
      }
    } else {
      $no_antrian = 1;
    }
    $data_kunjungan['NIK'] = $_SESSION['nik'];
    $data_kunjungan['jam_daftar'] = date('H:i:s');
    $data_kunjungan['no_antrian'] = $no_antrian;
    $pasien = $this->ModelPasien->get_data_edit($data_kunjungan['pasien_noRM'])->row_array();
    if ($pasien['tgl_daftar']!=date("Y-m-d")) {
      $data_kunjungan['administrasi'] =1;
    }
    if ($this->db->insert('kunjungan', $data_kunjungan)) {
      $nokun = $this->db->insert_id();
      $data_kunjungan['no_urutkunjungan'] = $nokun;
      $this->db->reset_query();
      $hari_ini = date("Y-m-d");
      $this->db->where('noRM',$data_kunjungan['pasien_noRM']);
      $this->db->update('pasien',array('kunjungan_terakhir'=>$hari_ini));

      $jumlah = $book['nominal'];
      $kode = $this->ModelAkuntansi->generete_notrans();
      $data = array(
        'kunjungan_no_urutkunjungan' => $nokun,
        'jumlah_deposit' => $jumlah,
        'operator' => $_SESSION['nik']
      );
      $this->db->insert("deposit",$data);
      $this->db->where("no_urutkunjungan",$nokun)->update('kunjungan',array("status_deposit"=>1));
      $jurnal1 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi no kunjungan '.$nokun,
        'norek' => '111.001',
        'debet' => $jumlah,
        'kredit' => 0,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $nokun,
        'pasien_noRM' => $noRM
      );
      $jurnal2 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi no kunjungan '.$nokun,
        'norek' => '213.001',
        'debet' => 0,
        'kredit' => $jumlah,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        'no_urut' => $nokun,
        'pasien_noRM' => $noRM
      );
      $this->db->insert('jurnal',$jurnal1);
      $this->db->insert('jurnal',$jurnal2);
      $config['cacheable']    = true; //boolean, the default is true
      $config['cachedir']     = './foto/qrcode_pembayaran'; //string, the default is application/cache/
      $config['errorlog']     = './foto/qrcode_pembayaran'; //string, the default is application/logs/
      $config['imagedir']     = './foto/qrcode_pembayaran/'; //direktori penyimpanan qr code
      $config['quality']      = true; //boolean, the default is true
      $config['size']         = '1024'; //interger, the default is 1024
      $config['black']        = array(224,255,255); // array, default is array(255,255,255)
      $config['white']        = array(70,130,180); // array, default is array(0,0,0)
      $this->ciqrcode->initialize($config);
      $image_name=$idbook.'.png'; //buat name dari qr code sesuai dengan nim
      $params['data'] = $data_kunjungan; //data yang akan di jadikan QR CODE
      $params['level'] = 'H'; //H=High
      $params['size'] = 10;
      $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
      $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
      $this->db->where("idbooking",$idbook)->update("booking",array('status_booking'=>2));
      $this->session->set_flashdata('notif',$this->Notif->berhasil("Transaksi Berhasil"));
      redirect(base_url()."Verif");
    }




  }

}
