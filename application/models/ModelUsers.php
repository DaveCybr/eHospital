<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelUsers extends CI_Model{

  function get_data()
  {
    $this->db->join('pegawai',"pegawai.NIK = user.pegawai_NIK");
    return $this->db->get('user')->result();
  }

  function get_account($nik)
  {
    $this->db->where('pegawai_NIK',$nik);
    return $this->db->get('user');
  }

  function get_data_user($id)
  {
    return $this->db->get_where('user', array('id_user' => $id, ))->row_array();
  }

  function get_data_edit($id){
      return $this->db->get_where('user', array('karyawan_id'=>$id));
  }

  function cek_username($username){
      return $this->db->get_where("user",array('nama'=>$username));
  }
  function cek_username2($username,$poli){
      return $this->db->get_where("user",array('nama'=>$username,'Jabatan'=>$poli));
  }

   function total_rows($username) {
       return $this->db->get_where('user', array('Nama'=>$username))->num_rows();
  }

  function get_data_login($id){
      $this->db->join('pegawai',"pegawai.NIK = user.pegawai_NIK");
      return $this->db->get_where("user",array("id_user"=>$id));
  }

  function get_group()
  {
      return $this->db->get('group_roles');
  }

  function get_group_edit($id)
  {
      $this->db->where('idgroup_roles', $id);
      return $this->db->get('group_roles');
  }

  function get_roles($group)
  {
      return $this->db->get_where('roles', array('group_roles_idgroup_roles' => $group));
  }

  function roles()
  {
      $this->db->join('group_roles', 'group_roles.idgroup_roles = roles.group_roles_idgroup_roles');
      return $this->db->get('roles');
  }

}
