<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Penyakit extends CI_Controller{

    public $penyakit = array();

    public function __construct()
    {
      parent::__construct();
      $this->load->model("ModelPenyakit");

      $this->penyakit = array(

        //'idpenyakit'          => $this->input->post('idpenyakit'),
        'kodeicdx'            => $this->input->post('kodeicdx'),
        'nama_penyakit'       => $this->input->post('nama_penyakit'),
        'wabah'               => $this->input->post('wabah'),
        'nular'               => $this->input->post('nular'),
        'bpjs'                => $this->input->post('bpjs'),
        'non_spesialis'       => $this->input->post('non_spesialis'),

        );


    }

    function index()
    {
      $data = array(
        'body' => 'Penyakit/list',
        'penyakit'=> $this->ModelPenyakit->get_data(),
       );
      $this->load->view('index', $data);
    }

    function input()
    {
      $data = array(
        'form' => 'Penyakit/form',
        'body' => 'Penyakit/input',

       );
      $this->load->view('index', $data);
    }

    public function insert()
    {
      if ($this->db->insert('penyakit', $this->penyakit)) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect('Penyakit');
      } else {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      }

    }

    public function edit()
    {
      $id = $this->uri->segment(3);
      $data = array(
        'form' => 'Penyakit/form',
        'body' => 'Penyakit/edit',
        'penyakit' => $this->ModelPenyakit->get_data_edit($id),

       );
      $this->load->view('index', $data);
    }

    public function update()
    {

      $this->db->where('idpenyakit', $this->input->post('idpenyakit'));
      if ($this->db->update('penyakit', $this->penyakit)) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
        redirect('Penyakit');
      } else {
        $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      }

    }

    function delete($id)
    {
      // $id = $this->input->post('id');
      $this->db->where_in('idpenyakit', $id);
      $delete = $this->db->delete('penyakit');
      if ($delete == true) {
          $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Penyakit'));
      }else{
          $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Penyakit'));
      };
      redirect('Penyakit');
    }

function no_penyakit($kodeicdx)
{
  // code...
}

    function get_data_penyakit()
{
    $list = $this->ModelPenyakit->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {
        $no++;
        $row = array();
        // $row[] = $this->ModelPenyakit->no_penyakit($field->kodeicdx, $no);
        $row[] = $field->kodeicdx;
        $row[] = $field->nama_penyakit;
        $row[] = $this->ModelPenyakit->yatidak($field->wabah);
        $row[] = $this->ModelPenyakit->yatidak($field->nular);
        $row[] = $this->ModelPenyakit->yatidak($field->bpjs);
        $row[] = $this->ModelPenyakit->yatidak($field->non_spesialis);
        $row[] = $this->ModelPenyakit->edit($field->idpenyakit);

        $data[] = $row;
    }

    $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => $this->ModelPenyakit->count_all(),
        "recordsFiltered" => $this->ModelPenyakit->count_filtered(),
        "data" => $data,
    );
    //output dalam format JSON
    echo json_encode($output);
}

  }
?>
