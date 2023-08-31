<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catatan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $catatan = $this->db->get("catatan_covid")->result();
    $data = array(
        'body' => 'Catatan/index',
        'catatan' => $catatan
    );
    $this->load->view('index', $data);
  }

  function edit($id)
  {

    $catatan = $this->db->where("id",$id)->get("catatan_covid")->row();
    $data = array(
        'form' => 'Catatan/form',
        'body' => 'Catatan/input',
        'catatan' => $catatan
    );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'form' => 'Satuan/form',
      'body' => 'Satuan/input',
     );
    $this->load->view('index', $data);
  }

  public function insert($id)
  {
    // $id = $this->input->post("id");
    $this->db->where("id",$id);
    if ($this->db->update('catatan_covid', array('catatan'  => $this->input->post('catatan'),"saran"=>$this->input->post('saran')))) {
      $this->session->set_flashdata('Notif', $this->Notif->berhasil('Berhasil Tersimpan'));
      redirect('Catatan');
    } else {
      echo "salah";
    }

  }




  public function delete()
  {
    $id = $this->input->post('id');
    $this->db->where_in('idsatuan', $id);
    $delete = $this->db->delete('satuan');
    if ($delete == true) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Satuan'));
    }else{
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Satuan'));
    };
    redirect('Satuan');
  }


  public function dokter()
  {
    // die(var_dump(getDokterPCare()));
    $no = "0002468339403";
    $url = "peserta/".$no;
    $response = json_decode(Catatan($url));
    echo "<pre>";
    print_r($response);
    echo "<pre>";
    die();
  }


}
?>
