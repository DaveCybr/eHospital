<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelAdmisi');
    $this->load->model('ModelDeposit');
    $this->load->model('ModelAkuntansi');
    $this->load->model("ModelBilling");
  }

  public function index(){
    $data = array(
      'body'        => 'Deposit/list',
      'kunjungan'   =>  $this->ModelDeposit->get_kunjungan()

    );
		$this->load->view('index',$data);
  }

  public function bayar(){
    $nokun = $this->input->post("nokun");
    $norm = $this->input->post('no_rm');
    $jumlah = $this->Core->combine_harga($this->input->post("jumlah_bayar"));
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
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Transaksi Berhasil"));
    redirect(base_url()."Deposit");


  }
  public function bayar_ranap(){
    $nokun = $this->input->post("nokun");
    $norm = $this->input->post('no_rm');
    $jumlah = $this->Core->combine_harga($this->input->post("jumlah_bayar"));
    $kode = $this->ModelAkuntansi->generete_notrans();
    $data = array(
      'kunjungan_no_urutkunjungan' => $nokun,
      'jumlah_deposit' => $jumlah,
      'operator' => $_SESSION['nik']
    );
    $this->db->insert("deposit",$data);
    $this->db->where("no_urutkunjungan",$nokun)->update('kunjungan',array("depo_ranap"=>1));
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
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Transaksi Berhasil"));
    redirect(base_url()."Admisi");


  }

  public function print(){
    $nokun = $this->uri->segment(3);
    $data_depo = $this->db
    ->join("kunjungan","kunjungan.no_urutkunjungan=deposit.kunjungan_no_urutkunjungan")
    ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
    ->join("pegawai","pegawai.NIK=deposit.operator")
    ->get_where("deposit",array("no_urutkunjungan"=>$nokun))->row_array();
    if ($data_depo['jumlah_deposit']==0) {
      $terbilang = "nol";
    }else{
      $terbilang = $this->ModelBilling->terbilang($data_depo['jumlah_deposit']);
    }
    $no_depo = "KW/DP/".date('m',strtotime($data_depo['tgl']))."/".date('Y',strtotime($data_depo['tgl']))."/".str_pad($data_depo['iddeposit'],8,"0",STR_PAD_LEFT);
    $data = array(
      'body'        => 'Deposit/print',
      'nominal' => $data_depo['jumlah_deposit'],
      'operator' => $data_depo['nama'],
      'pasien' => $data_depo['namapasien'],
      'terbilang' => $terbilang." rupiah",
      'no' => $no_depo,
      'data' => $data_depo
    );
    $this->load->view('index',$data);
  }

  function filter()
  {
    $tgl = $this->uri->segment(3);
    $no = 0;
    // echo "
    //           <tbody >";
    foreach ($this->ModelDeposit->get_data($tgl) as $value) {
      $no++;
      $id_check = $value->no_urutkunjungan;
      $k = $value->kode_tupel;
      $warna = "badge-primary";
      $type = "IN";
      if ($k == "UMU"){$warna = "badge-success";$type = "U";}elseif ($k == "IGD") {$warna = "badge-danger";$type="IG";}elseif($k == "OBG"){$warna = "badge-info";$type = "O";}elseif ($k == "GIG") {$warna = "badge-warning";$type = "G";}
      if ($value->jenis_kunjungan == 1) {
        $jenis = "Lama";
      } else {
        $jenis = "Baru";
      }
      if ($value->status_deposit==0) {
        $depo = '<button type="button" namapasien="'.$value->namapasien.'" nokun="'.$value->no_urutkunjungan.'" no_rm= "'.$value->pasien_noRM.'" class="btn btn-warning btn-sm bayar_deposit" id="'.$value->no_urutkunjungan.'" data-toggle="modal" data-target="#detail_sajian"
            style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-bill"></i> Bayar Deposit</button>';
      }else{
        $depo = '<span class="badge badge-pill badge-success">  Sudah Bayar </span>
        <a  target="_blank" href="'.base_url()."Deposit/print/".$value->no_urutkunjungan.'">
          <button type="button" class="btn btn-danger btn-sm"
          style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-print"></i> Cetak Bukti Deposit</button>
        </a>';
      }

      echo "
      <tr>
          <td>$no</td>
          <td>$value->namapasien</td>
          <td>$value->pasien_noRM</td>
          <td><h4>$value->tujuan_pelayanan</h4></td>
          <td>".date("d-m-Y",strtotime($value->tgl))."</td>
          <td>$value->jam_daftar</td>
          <td>$depo</td>
      </tr>";
    }
    // echo "</tbody>
    //   </table>";
  }



}
