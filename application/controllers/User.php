<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

  public $data_user = array();

  public function __construct()
  {
    parent::__construct();
    $this->data_user = array(
      'Nama'    => $this->input->post('username'),
      'Jabatan' => $this->input->post('jabatan'),
      'Password'=> password_hash($this->input->post('password'),PASSWORD_DEFAULT,array("cost"=>10)),
      'pegawai_NIK'=> $this->input->post('nik'));

      $this->load->model('ModelUsers');
      $this->load->model('ModelPegawai');
      $this->load->model('ModelJabatan');
      // $this->load->model('ModelLogin');

  }

  function index()
  {
    $data = array(
      'body' => 'User/list',
      'user'=> $this->ModelUsers->get_data()
     );
    $this->load->view('index', $data);
  }

  function input()
  {

    $data = array(
      'form'    => 'User/form',
      'body'    => 'User/input',
      'pegawai' => $this->ModelPegawai->get_data(),
      'group'   => $this->ModelUsers->get_group()->result(),
      'jabatan' => $this->ModelJabatan->get_data()->result(),
     );
    $this->load->view('index', $data);
  }

  function insert()
  {
    $pass = $this->input->post('password');
    $repass = $this->input->post('repassword');
    $hitung = $this->ModelUsers->total_rows($this->input->post('username'));
    if ($hitung >= 10) {
      $this->session->set_flashdata('error', $this->Core->alert_danger('Username Telah digunakan'));
      redirect('User/input');
    } else {
      if ($pass == $repass) {
          if ($this->db->insert('user', array(
                'Nama'    => $this->input->post('username'),
                'Jabatan' => $this->input->post('jabatan'),
                'Password'=> password_hash($this->input->post('password'),PASSWORD_DEFAULT,array("cost"=>10)),
                'pegawai_NIK'=> $this->input->post('nik'),
                'create_on' => date('Y-m-d H:i:s'),
                'roles'   => implode(", ", $this->input->post('roles')))
              ))
          {
            // $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
            redirect('User');
          } else {
            // $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
            redirect('User/input');
          }
      }else {
        $this->session->set_flashdata('error', $this->Core->alert_danger('password tidak cocok'));
        // $this->session->set_flashdata($data_user);
        redirect('User/input');
      }
    }
  }

  function edit()
  {
    $id = $this->uri->segment(3);
    $data = array(
      'form'    => 'User/form',
      'body'    => 'User/edit',
      'pegawai' => $this->ModelPegawai->get_data(),
      'user'    => $this->ModelUsers->get_data_user($id),
      'group'   => $this->ModelUsers->get_group()->result(),
      'jabatan' => $this->ModelJabatan->get_data()->result(),
     );
    $this->load->view('index', $data);
  }

  function update()
  {
    $id = $this->input->post('id');
    $user_name = $this->ModelUsers->get_data_user($id);
    $pass = $this->input->post('password');
    $repass = $this->input->post('repassword');
    $hitung = $this->ModelUsers->total_rows($this->input->post('username'));
    // if (($hitung == 1 && $this->input->post('username') == $user_name['Nama']) || $hitung == 0) {
      if ($pass == $repass) {
              $this->db->where('id_user',$id);
          if ($this->db->update('user', array(
                'Nama'    => $this->input->post('username'),
                'Jabatan' => $this->input->post('jabatan'),
                'Password'=> password_hash($this->input->post('password'),PASSWORD_DEFAULT,array("cost"=>10)),
                'pegawai_NIK'=> $this->input->post('nik'),
                'update_on' => date('Y-m-d H:i:s'),
                'roles'   => implode(", ", $this->input->post('roles')))
              ))
          {
            // $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
            redirect('User');
          } else {
            // $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
            redirect('User/edit/'.$id);
          }
      }else {
        $this->session->set_flashdata('error', $this->Core->alert_danger('password tidak cocok'));
        redirect('User/edit/'.$id);
      }
    // } else {
    //   $this->session->set_flashdata('error', $this->Core->alert_danger('Username Telah digunakan'));
    //   redirect('User/edit/'.$id);
    //
    // }
  }
public function update_pass()
{
  // code...
  $data = $this->db->get("user")->result();
  // die(var_dump($data));
  foreach ($data as $value) {
    $pass = "asd";
    // code...
    $this->db->where('id_user',$value->id_user);
    $this->db->update('user', array(
          // 'Nama'    => $this->input->post('username'),
          // 'Jabatan' => $this->input->post('jabatan'),
          'Password'=> password_hash($pass,PASSWORD_DEFAULT,array("cost"=>10)),
          // 'pegawai_NIK'=> $this->input->post('nik'),
          // 'update_on' => date('Y-m-d H:i:s'),
          // 'roles'   => implode(", ", $this->input->post('roles')))
      ));

  }
  echo "Selesai";
}

  function delete()
	{
		$id = $this->input->post('id');
    $cek = $this->db->where_in('user_id_user', $id)->get('riwayat_login')->num_rows();
    if ($cek>0) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data User, Data masih Aktif!!!'));
      redirect('User');
    }else{
  		$this->db->where_in('id_user', $id);
      $delete = $this->db->delete('user');
  		if ($delete == true) {
  				$this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Pegawai'));
  		}else{
  				$this->session->set_flashdata('alert', $this->Core->alert_succcess('Gagal Hapus Data Pegawai, Data masih Terrelasi!!!'));
  		};
  		redirect('User');
    }

	}

}
