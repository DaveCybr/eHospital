<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumentasi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelPekerjaan');
    $this->load->model('ModelPasien');
    $this->load->model('ModelKunjungan');
    $this->load->model('ModelDemografi');
    $this->load->model('ModelTujuanPelayanan');
    $this->load->model('ModelJenisPasien');
    $this->load->model('ModelPeriksa');
    $this->load->model('ModelLaborat');
    $this->load->library('upload');

  }

  function index()
  {
    $kunjungan = $this->ModelKunjungan->get_data_edit($this->uri->segment(3));
    $pasien = $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array();
    $data = array(
      'idkunjungan' => $this->uri->segment(3),
      'kunjungan'   => $kunjungan,
      'body'        => 'Dokumentasi/input',
      'pasien'      => $this->ModelPasien->get_data_edit($kunjungan['pasien_noRM'])->row_array(),
      'jenispasien' => $this->ModelJenisPasien->get_data_edit($pasien['jenis_pasien_kode_jenis'])->row_array(),
      'lab'         => $this->ModelLaborat->get_data(),
      'periksa'     => $this->ModelPeriksa->get_periksa_pasien($this->uri->segment(3))
    );

    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'body'      => "Pekerjaan/input",
      'form'  => "Pekerjaan/form",
    );
    $this->load->view('index', $data);
  }

  function edit()
  {
    $id = $this->uri->segment(3);
    $pekerjaan = $this->ModelPekerjaan->get_data_edit($id);
    $data = array(
      'body'        => "Pekerjaan/edit",
      'form'  => "Pekerjaan/form",
      'pekerjaan' => $pekerjaan
    );
    $this->load->view('index', $data);
  }

  function insert()
  {
    $nokun = $this->input->post("nokun");
    $norm = $this->input->post("no_rm");
    $config = array();
     $config['upload_path'] = './foto/dokumentasi/';
     $config['allowed_types'] = 'gif|jpg|png';
     $config['max_size']      = '0';
     $config['overwrite']     = TRUE;
     $files = $_FILES;
     $urutan = 1;
     for($i=0; $i<= count($_FILES['userfile']['name']); $i++)
     {
        $config['file_name'] = $nokun."_".$norm."_".$urutan;
         $_FILES['userfile']['name']= $files['userfile']['name'][$i];
         $_FILES['userfile']['type']= $files['userfile']['type'][$i];
         $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
         $_FILES['userfile']['error']= $files['userfile']['error'][$i];
         $_FILES['userfile']['size']= $files['userfile']['size'][$i];
         $this->upload->initialize($config);
         $this->upload->do_upload();
         $gbr = $this->upload->data();
         $nama = $gbr['file_name'];
           $data = array(
             'nama_gambar' => $nama,
             'tanggal' => date("Y-m-d"),
             'kunjungan_no_urutkunjungan' => $nokun,
             'poli' => $_SESSION['poli']
           );
           $this->db->insert('foto_pemeriksaan',$data);

         $urutan++;
     }
    redirect(base_url().'Periksa/index/'.$nokun);
  }

  function update()
  {
    $id = $this->input->post('kode');
    $data = array(
      'pekerjaan'   => $this->input->post('pekerjaan'),
    );
    $this->db->where('idpekerjaan', $id);
    $this->db->update('pekerjaan', $data);
    redirect(base_url().'Pekerjaan');
  }

  function delete()
  {
    $id = $this->input->post("id");
    $this->db->where_in('idpekerjaan', $id);
    $this->db->delete('pekerjaan');
    redirect(base_url().'Pekerjaan');
  }
function validasi_provinsi(){
  $prov = $this->input->post("prov");
  $hitung = $this->db->get_where("provinsi",array("provinsi"=>$prov))->num_rows();
  if ($hitung > 0) {
    $data_prov = $this->db->get_where("provinsi",array("provinsi"=>$prov))->row_array();
    $data = array(
      'id'=> $data_prov['idprovinsi'],
      'provinsi' => $data_prov['provinsi'],
      'status' => 1,
    );
  }else{
    $data = array(
      'id'=>NULL,
      'provinsi' => NULL,
      'status' => 0,
    );
  }
  echo json_encode($data);
}
function validasi_kota(){
$kota = $this->input->post("kota");
$hitung = $this->db->get_where("kota",array("nama_kota"=>$kota))->num_rows();
if ($hitung > 0) {
  $data_kota = $this->db->get_where("kota",array("nama_kota"=>$kota))->row_array();
  $data = array(
    'id'=> $data_kota['idkota'],
    'kota' => $data_kota['nama_kota'],
    'status' => 1,
  );
}else{
  $data = array(
    'id'=>NULL,
    'kota' => NULL,
    'status' => 0,
  );
}
echo json_encode($data);
}
function cek_provkota(){
  $id_kota = $this->input->post("id_kota");
  $id_prov = $this->input->post("id_prov");
  $hitung = $this->db->get_where("kota",array("provinsi_idprovinsi"=>$id_prov,"id_kota"=>$id_kota))->num_rows();
  if ($hitung>0) {
    $data = array(
      'status' => 1
    );
  }else{
    $data = array(
      'status' => 0
    );
  }
  echo json_encode($data);
}
  function get_data(){
  $data = $this->ModelPekerjaan->get_data();
  $response = array();
  foreach ($data as $value) {
    $data = array(
      'name' => $value->pekerjaan,
      'email' => $value->pekerjaan
    );
    array_push($response,$data);
  }
  echo json_encode($response);
}

function get_provinsi(){
$data = $this->ModelPekerjaan->get_provinsi();
$response = array();
foreach ($data as $value) {
  $data = array(
    'name' => $value->provinsi,
    'email' => $value->provinsi
  );
  array_push($response,$data);
}
echo json_encode($response);
}
function get_kota(){
$provinsi = $this->uri->segment(3);
$data = $this->ModelPekerjaan->get_kota($provinsi);
$response = array();
foreach ($data as $value) {
  $data = array(
    'name' => $value->nama_kota,
    'email' => $value->nama_kota
  );
  array_push($response,$data);
}
echo json_encode($response);
}


}
