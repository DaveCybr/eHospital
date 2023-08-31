<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller{
  public $poli = array('Poli Umum','Poli Gigi','Poli Internis','Poli Obsgyn','UGD/IGD','Poli Ozon');
  public $kode_poli = array('UMU','GIG','INT','OBG','IGD','OZO');
  public $hari = array('Mon'=>'Senin','Tue'=>'Selasa','Wed'=>'Rabu','Thu'=>'Kamis','Fri'=>"jum'at",'Sat'=>'Sabtu','Sun'=>'Minggu');
  public $bulan = array('Bulan','Jan','Feb','Mar','Apr','Mei','Jun','Juli','Aug','Sep','Okt','Nov','Des');
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelHome');

  }
  function kamar_kosong()
  {
    $data['kamar'] = $this->ModelHome->kamar_kosong();
    $this->load->view('Home/kamar_kosong2',$data);
  }
  function kamar_kosong3()
  {
    $data['kamar'] = $this->ModelHome->kamar_kosong();
    $this->load->view('Home/kamar_kosong3',$data);
  }

}
?>
