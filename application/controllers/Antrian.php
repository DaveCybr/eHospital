<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelAdmisi');
    $this->load->model('CoreUploadFoto');
  }

  public function index(){
    $v = $this->db->where('status',1)->get("video_antrian")->row_array();
    $video = $this->db->where('status',1)->get("video_antrian")->result();
    $data = array(
      'body'            => 'Admisi/list',

      'kunjungan'       => $this->ModelAdmisi->get_data(null),
      'kunjungan_sudah' => $this->ModelAdmisi->get_data_sudah(null),
      'antrian' => $this->db->get_where("antrian",array('tanggal'=>date("Y-m-d")))->row_array(),
      'video_awal' => $v,
      'video' => $video,
      'pengumuman' => $this->ModelAdmisi->get_pengumuman()
    );
		$this->load->view('antrian_baru',$data);
  }

  public function cobavideo()
  {
    $this->load->view("cobavideo");
  }

  public function proses($id=null){
    $data_pasien = $this->ModelAdmisi->get_detail($id);
    $data = array(
      'body' => 'Admisi/proses',
      'data' => $data_pasien,
      'kamar' => $this->ModelAdmisi->get_kamar(),
      'pasien' => $this->ModelAdmisi->get_pasien($id)
    );
		$this->load->view('index',$data);
  }

  public function reset(){
    $date = date("Y-m-d");
      $this->db->where(array('tanggal'=>$date))->update('antrian',array('status'=>0));
      echo "berhasil";
  }

  public function setuju(){
    $nokun = $this->uri->segment(3);
    $nama_wali = $this->input->post("namawali");
    $ktp = $this->input->post("ktp");
    $alamat = $this->input->post("alamat");
    $telp  = $this->input->post("telp");
    $kamar = $this->input->post("kamar");
    $data = array(
      'wali_ranap' => $nama_wali,
      'ktp_wali' => $ktp,
      'acc_ranap' => 1,
      'alamat_wali'=>$alamat,
      'tlp_wali' => $telp,
      'ttd_wali' => $this->input->post('signature'),
      'tempat_tidur_no_tt' => $kamar,
      'sts_wali' => $this->input->post('setuju'),
    );
    $this->db->where('no_urutkunjungan',$nokun);
    $this->db->update('kunjungan',$data);
    $this->db->where('no_tt',$kamar);
    $this->db->update('tempat_tidur',array('status_terisi'=>1));
    $this->session->set_flashdata('notif',$this->Notif->berhasil("Proses admisi berhasil dilakukan"));
    redirect(base_url()."Admisi");
  }

  public function signature(){
    $data = array(
      'kunjungan' => $this->ModelAdmisi->get_data(null)
    );
    // die(var_dump($data['kunjungan']));
    $this->load->view("Admisi/signature",$data);
  }
  public function panggil(){
    $antrian = $this->input->post('antrian');
    // $antrian = "OBG-87-YM";
    // $signature = $this->input->post('ttd');
    // // echo $signature;
    // $hit = $this->db->get_where('kunjungan',array('no_urutkunjungan'=>$nokun))->num_rows();
    // if ($hit == 0) {
    //   $this->session->set_flashdata('pesan',"0");
    //   redirect(base_url()."Admisi/signature");
    // }else{
    $baru = explode("-",$antrian);
    $date = date("Y-m-d");
    $cek = $this->db->get_where("antrian",array('tanggal'=>$date))->num_rows();

    $no = $baru[1];
    if ($baru[0]=='UMU') {
      $data = array(
        'UMU' => $no,
        'unit_terakhir' => "POLI UMUM 1",
        'antrian_terakhir' => $no,
        'nama_pasien'   => $baru[3],
        'nama_terakhir'   => $baru[3],
      );
    }
    if ($baru[0]=='UMU2') {
      $data = array(
        'UMU2' => $no,
        'unit_terakhir' => "POLI UMUM 2",
        'antrian_terakhir' => $no,
        'nama_pasien_umu2'   => $baru[3],
        'nama_terakhir'   => $baru[3],
      );
    }
    if ($baru[0]=='OBG') {
      $data = array(
        'OBG' => $no,
        'unit_terakhir' => $baru[0],
        'antrian_terakhir' => $no,
        'nama_pasien'   => $baru[3],
        'nama_terakhir'   => $baru[3],
      );
    }
    if ($baru[0]=='INT') {
      $data = array(
        'INTERNIS' => $no,
        'unit_terakhir' => $baru[0],
        'antrian_terakhir' => $no,
        'nama_pasien'   => $baru[3],
        'nama_terakhir'   => $baru[3],
      );
    }
    if ($baru[0]=='GIG') {
      $data = array(
        'GIG' => $no,
        'unit_terakhir' => "POLI GIGI",
        'antrian_terakhir' => $no,
        'nama_pasien_gig'   => $baru[3],
        'nama_terakhir'   => $baru[3],
      );
    }
    if ($baru[0]=='OZO') {
      $data = array(
        'OZO' => $no,
        'unit_terakhir' => $baru[0],
        'antrian_terakhir' => $no,
        'nama_pasien'   => $baru[3],
        'nama_terakhir'   => $baru[3],
      );
    }
    if ($baru[0]=='LOKET1') {
      $data = array(
        'LOKET1' => $no,
        'unit_terakhir' => "LOKET1",
        'antrian_terakhir' => $no,
        'nama_pasien'   => $baru[3],
        'nama_terakhir'   => $baru[3],
      );
    }
    if ($baru[0]=='LOKET2') {
      $data = array(
        'LOKET2' => $no,
        'unit_terakhir' => "LOKET2",
        'antrian_terakhir' => $no,
        'nama_pasien'   => $baru[3],
        'nama_terakhir'   => $baru[3],
      );
    }

    if ($cek > 0) {
      $this->db->where("tanggal",$date);
      $this->db->update("antrian",$data);
    }else{
      $data['tanggal'] = $date;
      $this->db->insert('antrian',$data);
    }


    $dataku = $this->db->get_where("antrian",array('tanggal'=>$date))->row_array();
      if ($dataku['status']==0) {
        // code...
        $this->load->view("vendor/autoload.php");
        $options = array(
          'cluster' => 'ap1',
          'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
          '7d98f72380966ec579c6',
          'f97621cbbb10f0774c00',
          '965064',
          $options
        );
        $data = array(
          'no_antrian'  => $antrian,
          'nokun'       => $baru[2],
          'poli'        => $baru[0],
          'nama'        => $baru[3],
        );
        $pusher->trigger('ci_pusher3', 'my-event3',$data);
        $this->db->where(array('tanggal'=>$date))->update('antrian',array('status'=>1));
        $this->db->where("no_urutkunjungan", $baru[2]);
        $this->db->update("kunjungan",array('poli_panggil' => $baru[0], ));
        if ($baru[0]=='LOKET1' || $baru[0]=="LOKET2") {
          $id=$this->input->post("id");
          $this->db->where('idantrian_loket',$id)->update('antrian_loket',array('panggilan'=>1));
        }
        echo "Panggilan dilakukan";
      }else{
        echo "Masih ada panggilan lain, mohon coba sesaat lagi";
      }
    //
    //   $this->session->set_flashdata('pesan',"1");
    //   redirect(base_url()."Admisi/signature");
    // }
  }
  public function print($id=null){
    $data_pasien = $this->ModelAdmisi->get_detail($id);
    $data = array(
      'data' => $data_pasien,
      'pasien' => $this->ModelAdmisi->get_pasien($id),
      'rujuk' => $this->db->get_where('rujukan_internal',array('kunjungan_no_urutkunjungan'=>$id,'tujuan_poli'=>"RANAP"))->row_array()
    );
    $this->load->view('Admisi/print2',$data);
  }

   public function video(){
    $data = array(
      'body' => 'Video/list',
      'video'=> $this->ModelAdmisi->get_video()
     );
    $this->load->view('index', $data);
  }

  public function pengumuman(){
   $data = array(
     'body' => 'Video/pengumuman',
     'pengumuman'=> $this->ModelAdmisi->get_pengumuman()
    );
   $this->load->view('index', $data);
 }

 public function input_pengumuman(){
   $data = array(
     'form' => 'Video/form_pengumuman',
     'body' => 'Video/input_pengumuman',
     //'tempat_tidur' => $this->ModelTempatTidur->get_data(),
    );
   $this->load->view('index', $data);
}

  public function input_video(){
    $data = array(
      'form' => 'Video/form',
      'body' => 'Video/input',
      //'tempat_tidur' => $this->ModelTempatTidur->get_data(),
     );
    $this->load->view('index', $data);
  }

  public function insert_video(){
    $path = "./desain/video/";
    if ($this->CoreUploadFoto->upload_video($path)) {
      $max = $this->db->select_max("urutan")->get("video_antrian")->row_array();
      $data = array(
        'nama_video' => $this->input->post("nama"),
        'url' => $this->CoreUploadFoto->get_nama_video(),
        'status' => 1,
        'urutan' => $max['urutan']==NULL?1:$max['urutan']+1,
      );
      $this->db->insert("video_antrian",$data);
      $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil input video"));
      redirect(base_url()."Antrian/video");
    }else{
      $this->session->set_flashdata("notif",$this->Notif->gagal("Gagalinput video"));
      redirect(base_url()."Antrian/video");
    }
  }

  public function nonaktifkan_video(){
    $id = $this->uri->segment(3);
    $this->db->where("id",$id)->update("video_antrian",array('status'=>0));
    $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil nonaktifkan"));
    redirect(base_url()."Antrian/video");
  }

    public function aktifkan_video(){
      $id = $this->uri->segment(3);
      $this->db->where("id",$id)->update("video_antrian",array('status'=>1));
      $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil aktifkan"));
      redirect(base_url()."Antrian/video");
    }

    public function delete_video(){
      $id = $this->input->post("id");
      $this->db->where_in("id",$id)->delete("video_antrian");
      $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil hapus video"));
      redirect(base_url()."Antrian/video");
    }

    public function delete_pengumuman(){
      $id = $this->input->post("id");
      $this->db->where_in("id",$id)->delete("pengumuman");
      $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil"));
      redirect(base_url()."Antrian/pengumuman");
    }

    public function insert_pengumuman(){
      $tanggal = $this->input->post("tanggal");
      $pengumuman = $this->input->post("pengumuman");
      $this->db->insert("pengumuman",array(
        'tanggal' => $tanggal,
        'pengumuman'=>$pengumuman
      ));
      $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil"));
      redirect(base_url()."Antrian/pengumuman");
    }





}
