<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StokGudang extends CI_Controller{
  public $obat = array();
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url', 'language'));
    $this->load->model('ModelObat');

  }

  function index()
  {
    $data = array(
      'body' => 'StokGudang/list',
      'obat' => $this->ModelObat->get_data_gudang(),
      'form_dialog' => 'Obat/form_dialog',
    );
    $this->load->view('index', $data);
  }
}
?>
