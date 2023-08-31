<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller{

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
      'body' => 'Jadwal/list',
      'jadwal'=> $this->ModelPegawai->get_jadwal()
     );
    $this->load->view('index', $data);
  }

  function input()
  {

    $data = array(
      'form'    => 'Jadwal/form',
      'body'    => 'Jadwal/input',
      'pegawai' => $this->ModelPegawai->get_data_dokter(),
    );
    $this->load->view('index', $data);
  }

  function insert()
  {
    $data = array(
          'hari'   => implode(", ", $this->input->post('hari')),
          'pegawai_NIK'=> $this->input->post("nik_dokter"),
          'jam_mulai' => $this->input->post("jam_mulai"),
          'jam_akhir'=> $this->input->post('jam_akhir'),
        );
    $this->db->insert("jadwal",$data);
    $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil Membuat Jadwal"));
    redirect(base_url()."Jadwal");
  }

  function edit()
  {
    $hari = array('Mon' => 'Senin','Tue'=>'Selasa','Wed'=>'Rabu','Thu'=>'Kamis','Fri'=>'Jumat','Sat'=>'Sabtu');
    $jadwal = $this->db
    ->join("pegawai","pegawai.NIK=jadwal.pegawai_NIK")
    ->get_where('jadwal',array('idjadwal'=>$this->uri->segment(3)))->row_array();
    $data = array(
      'form'    => 'Jadwal/form_edit',
      'body'    => 'Jadwal/edit',
      'jadwal' => $jadwal,
      'pegawai' => $this->ModelPegawai->get_data_dokter(),
      'jadwal_dokter' => explode(', ',$jadwal['hari']),
      'hari' => $hari
    );
    // die(var_dump($data['jadwal_dokter']));
    $this->load->view('index', $data);
  }

  function update($id=null)
  {
    $data = array(
          'hari'   => implode(", ", $this->input->post('hari')),
          'pegawai_NIK'=> $this->input->post("nik_dokter"),
          'jam_mulai' => $this->input->post("jam_mulai"),
          'jam_akhir'=> $this->input->post('jam_akhir'),
        );
    $this->db->where('idjadwal',$id);
    $this->db->update("jadwal",$data);
    $this->session->set_flashdata("notif",$this->Notif->berhasil("Berhasil Edit Jadwal"));
    redirect(base_url()."Jadwal");

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
