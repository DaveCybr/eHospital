<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dapur extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelBilling");
    $this->load->model('ModelPasien');
    $this->load->model('ModelObat');
    $this->load->model("ModelResep");
    $this->load->model("ModelRanap");
    $this->load->model("ModelDapur");
  }

  function index()
  {
    $tgl = date('Y-m-d');
    $biaya = $this->ModelBilling->biaya()->row_array();
    $data = array(
      'body'      => "Dapur/index",
      'kunjungan' => $this->ModelRanap->get_data(null),
      // 'biaya_adm' => $biaya['biaya_adm'],
    );
    $this->load->view('index',$data);
  }

  function sajikan($nokun=''){
    $kunjungan = $this->ModelDapur->get_kunjungan($nokun);
    $data = array(
      'harga' => $kunjungan['biaya_makan'],
      'kunjungan_no_urutkunjungan' => $nokun,
      'timestamp' => date("Y-m-d h-i-s")
    );
    $this->db->insert('dapur',$data);
    $this->session->set_flashdata('notif',$this->Notif->berhasil('Berhasil'));
    redirect(base_url()."Dapur");
  }
  function hapus($id=''){
    $this->db->where('iddapur',$id)->delete('dapur');
    $this->session->set_flashdata('notif',$this->Notif->berhasil('Berhasil Hapus Data'));
    redirect(base_url()."Dapur");
  }

  function get_detail(){
      $nokun = $this->input->post('nokun');
      // $nokun = 26;
      $dapur = $this->ModelDapur->get_dapur($nokun)->result();
      $hari_ini = $this->ModelDapur->get_hari_ini($nokun,date("Y-m-d"));
      $total = $this->ModelDapur->get_dapur($nokun)->num_rows();
      $html = "";
      $no = 1;
      foreach ($dapur as $value) {
        $tgl = date("d-m-Y",strtotime($value->timestamp));
        $button = '';
        if ($tgl==date("d-m-Y")) {
          $tgl ="Hari Ini";
          $button = '<a href="'.base_url().'Dapur/hapus/'.$value->iddapur.'"><button class="btn btn-sm btn-danger" ><i class="fa fa-cut"></i></button></a>';
        }
        $html .=
        "<tr>
          <td>".$no++."</td>
          <td>".$tgl."</td>
          <td>".date("h:i:s",strtotime($value->timestamp))."</td>
          <td>".$button."</td>
        </tr>";
      }
      echo json_encode(array('sajian'=>$html,'hari_ini'=>$hari_ini,'total'=>$total));
  }




}
?>
