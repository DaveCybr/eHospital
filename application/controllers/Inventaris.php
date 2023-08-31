<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelJabatan');
    $this->load->model('ModelUsers');
    $this->load->model('ModelInventaris');
    $this->load->model('ModelMbesar');
    $this->load->model('ModelRuangan');
  }

  function index()
  {
    $data = array(
      'body'      => "Inventaris/list",
      'inventaris'   => $this->ModelInventaris->get_data()->result()
    );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'body'      => "Inventaris/input",
      'form' => "Inventaris/form2",
      'noinven' => $this->ModelInventaris->generate_noinven(),
      'no_rek' => $this->ModelMbesar->get_data_mbesar(),
      'ruangan' => $this->ModelRuangan->get_data()
    );
    $this->load->view('index', $data);
  }

  function edit()
  {
    $id = $this->uri->segment(3);
    $inventaris = $this->ModelInventaris->get_data_edit($id);
    $rekakun = $this->ModelInventaris->get_akun($inventaris['rekakun']);
    $rekbiaya = $this->ModelInventaris->get_akun($inventaris['rekbiaya']);
    $data = array(
      'body'        => "Inventaris/edit",
      'form'        => "Inventaris/form_edit",
      'no_rek' => $this->ModelMbesar->get_data_mbesar(),
      'inventaris' => $inventaris,
      'rekakun' => $rekakun,
      'rekbiaya' => $rekbiaya,

      'ruangan' => $this->ModelRuangan->get_data()
    );
    $this->load->view('index', $data);
  }

  function insert()
  {
    $data = array(
      'noinven'     => $this->input->post('noinventaris'),
      'tglbeli'     => $this->input->post('tgl_catat'),
      'nama'        => $this->input->post('nama_inventaris'),
      'harga'       => $this->input->post('harga'),
      'jumlah'      => $this->input->post('jumlah'),
      'nilinven'    => $this->input->post('nilai_inventaris'),
      'residu'      => $this->input->post('nilai_residu'),
      'nilsusut' =>  $this->input->post('penyusutan'),
      'lamasusut'   => $this->input->post('waktu'),
      'susut'       => $this->input->post('jumlah_susut'),
      'nibuku'      => $this->input->post('nilai_buku'),
      'rekakun'     => $this->input->post('rek_akuntansi'),
      'rekbiaya'    => $this->input->post('rek_susut'),
      'transaksi'   => $this->input->post('cara_bayar'),
    );
    $no_trans = $this->ModelInventaris->generate_notrans();
    $data_Mbesar = array(
      'no_transaksi' => $no_trans,
      'tanggal' => date("Y-m-d"),
      'norek' => $data['rekakun'],
      'jam' => date('h:i:s'),
    );
    if ($data['transaksi']=='KAS') {
      $data_Mbesar['debet'] = $data['nilinven'];
    }else{
      $data_Mbesar['kredit'] = $data['nilinven'];
    }
    $data_susut = array(
      'tglsusut' => date('Y-m-d'),
      'noninven' => $data['noinven'],
      'nilsusut' => $data['nilsusut'],
      'nilbuku' => $data['nibuku'],
      'rekakun' => $data['rekakun'],
      'rekbiaya' => $data['rekbiaya'],
      'notran' => $no_trans
    );
    $this->db->insert('inventaris', $data);
    // $this->db->insert('Mbesar', $data_Mbesar);
    $this->db->insert('susut', $data_susut);
    // die($no_trans);
    redirect(base_url().'Inventaris');
  }

  function update()
  {
    $id = $this->input->post('noinventaris');
    $data = array(
      'tglbeli'     => $this->input->post('tgl_catat'),
      'nama'        => $this->input->post('nama_inventaris'),
      'harga'       => $this->input->post('harga'),
      'jumlah'      => $this->input->post('jumlah'),
      'nilinven'    => $this->input->post('nilai_inventaris'),
      'residu'      => $this->input->post('nilai_residu'),
      'lamasusut'   => $this->input->post('waktu'),
      'susut'       => $this->input->post('penyusutan'),
      'nibuku'      => $this->input->post('nilai_buku'),
      'rekakun'     => $this->input->post('rek_akuntansi'),
      'rekbiaya'    => $this->input->post('rek_susut'),
      'transaksi'   => $this->input->post('cara_bayar'),
      'ruangan_idruangan' => $this->input->post('idruangan'),
    );
    $this->db->where('noinven', $id);
    $this->db->update('inventaris', $data);
    redirect(base_url().'Inventaris');
  }

  function delete()
  {
    $id = $this->input->post('id');
    $this->db->where_in('noinven', $id);
    $delete = $this->db->delete('inventaris');
    if ($delete == true) {
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Inventaris'));
    }else{
        $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Pegawai, Data masih Terrelasi!!!'));
    };
    redirect('Inventaris');
  }

}
