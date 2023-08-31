<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GroupRole extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ModelJabatan');
    $this->load->model('ModelUsers');
  }

  function index()
  {
    $data = array(
      'body'      => "User/Group/list",
      'group'     => $this->ModelUsers->get_group()->result()
    );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      'body'      => "User/Group/input",
    );
    $this->load->view('index', $data);
  }

  function insert()
  {
    $data = array(
      'idgroup_roles' => $this->input->post('id'),
      'nama_group'    => $this->input->post('group'),
    );
    $this->db->insert('group_roles', $data);
    redirect('GroupRole');
  }

  function hapus()
  {
    $id = $this->uri->segment(3);
    $this->db->where('idgroup_roles', $id);
    $this->db->delete('group_roles');
    redirect('GroupRole');
  }

}
