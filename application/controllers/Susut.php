<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Susut extends CI_Controller{
    public function __construct()
    {
      parent::__construct();
      // $this->load->library(array('ion_auth', 'form_validation'));
      $this->load->helper(array('url', 'language'));
      $this->load->model('ModelSusut');
    }

    function index()
    {
      $data = array(
        'body' => 'Susut/list',
        'susut' => $this->ModelSusut->get_data(),
      );
      $this->load->view('index', $data);
    }
    function susutkan(){
      $data = $this->ModelSusut->get_data();
      $tanggal = $this->input->post('tanggal');
      $jam = date("h:i:s");
      foreach ($data as $value) {
        $nilaibuku = $value->nilbuku-$value->nilsusut;
        $update = array(
          'tglsusut' => $tanggal,
          'nilbuku' => $nilaibuku
        );
        $jurnal = array(
          'no_transaksi' => $value->notran,
          'tanggal' => $tanggal,
          'norek' => $value->rekakun,
          'kredit' => $value->nilsusut,
          'jam' => $jam
        );

        $jurnal1 = array(
          'no_transaksi' => $value->notran,
          'tanggal' => $tanggal,
          'norek' => $value->rekbiaya,
          'debet' => $value->nilsusut,
          'jam' => $jam
        );
        $this->db->where('noninven',$value->noninven)->update('susut',$update);
        $this->db->insert('jurnal',$jurnal);
        $this->db->insert('jurnal',$jurnal1);
      }
      redirect(base_url()."Susut");
    }
  }
?>
