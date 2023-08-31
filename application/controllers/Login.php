<?php
class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelUsers');
	}

	function index()
	{
		$this->session->set_flashdata('item', 'value');
		$this->load->view('Login/Login');
	}

	function redirect($username)
	{
		$data_login = $this->ModelUsers->cek_username($username)->row_array();
		$poli = $this->input->post("login_poli");
		if ($poli == 'RANAP' || $poli == 'PRANAP' || $poli == 'keuangan' || $poli == 'kasir') {
			$data_login = $this->ModelUsers->cek_username2($username, $poli)->row_array();
		}
		$id_login = $data_login['id_user'];
		$nik = $data_login['pegawai_NIK'];
		$get_data_karyawan = $this->ModelUsers->get_data_login($id_login)->row_array();

		// die(var_dump($poli));
		$data_session = array(
			'id_login' => $id_login,
			'nik'      => $nik,
			'username' => $data_login['Nama'],
			'karyawan' => $get_data_karyawan['nama'],
			'jabatan'  => $get_data_karyawan['Jabatan'],
			'poli'		 => $poli
		);
		$this->session->set_userdata($data_session);
		$data_riwayat = array(
			'NIK' 					=> $nik,
			'user_id_user'	=> $id_login,
			'last_login'		=> date('Y-m-d H:i:s'),
			'ip'						=> $this->input->ip_address()
		);
		$this->db->insert('riwayat_login', $data_riwayat);
		$this->db->reset_query();
		$this->db->where($data_riwayat);
		$data_riwayat_login = $this->db->get('riwayat_login')->row_array();
		$this->session->set_userdata(array('no_login' => $data_riwayat_login['no_login']));
		redirect(base_url());
	}

	function akses($username)
	{
		$data_login = $this->ModelUsers->cek_username($username)->result();
		$data = array(
			'user' => $data_login,
			'username' => $username
		);
		$this->load->view("Login/akses", $data);
	}
	function set($username)
	{
		// $data_login = $this->ModelUsers->cek_username($username)->row_array();
	}

	function aksi_login($user = null, $pass = null)
	{
		if ($user == null && $pass == null) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
		} else {
			$username = $user;
			$password = $pass;
		}
		$cek = $this->ModelUsers->cek_username($username)->num_rows();
		if ($cek > 0) {
			$data_login = $this->ModelUsers->cek_username($username)->row_array();
			if ($data_login['id_user'] == null) {
				$this->session->set_flashdata("message", "Username Tidak Terdaftar");
				// redirect('Login');
				echo "u";
			} else {
				$pw_valid = $data_login['Password'];
				if (password_verify($password, $pw_valid)) {
					if ($cek > 1) {
						echo base_url() . "Login/akses/" . $username;
					} else {
						$login_poli = $this->input->post('login_poli');
						$id_login = $data_login['id_user'];
						$nik = $data_login['pegawai_NIK'];
						$get_data_karyawan = $this->ModelUsers->get_data_login($id_login)->row_array();

						$jabatan = $get_data_karyawan['Jabatan'];
						if ($jabatan == "dobg" || $jabatan == "pobg" || $jabatan == "bidan") {
							$poli = "OBG";
						} elseif ($jabatan == "dint" || $jabatan == "pint") {
							$poli = "INT";
						} elseif ($jabatan == "dgig" || $jabatan == "pgig") {
							$poli = "GIG";
						} elseif ($jabatan == "dugd" || $jabatan == "pugd") {
							$poli = "IGD";
						} elseif ($jabatan == "dozo" || $jabatan == "pozo") {
							$poli = "OZO";
						} elseif ($jabatan == "RANAP") {
							$poli = "RANAP";
						} elseif ($jabatan == "resepsionis") {
							$poli = NULL;
						} else {
							$poli = "UMU";
						}

						$data_session = array(
							'id_login' => $id_login,
							'nik'      => $nik,
							'username' => $data_login['Nama'],
							'karyawan' => $get_data_karyawan['nama'],
							'jabatan'  => $get_data_karyawan['Jabatan'],
							'poli'		 => $poli
						);
						$this->session->set_userdata($data_session);
						$data_riwayat = array(
							'NIK' 					=> $nik,
							'user_id_user'	=> $id_login,
							'last_login'		=> date('Y-m-d H:i:s'),
							'ip'						=> $this->input->ip_address()
						);
						$this->db->insert('riwayat_login', $data_riwayat);
						$this->db->reset_query();
						$this->db->where($data_riwayat);
						$data_riwayat_login = $this->db->get('riwayat_login')->row_array();
						$this->session->set_userdata(array('no_login' => @$data_riwayat_login['no_login']));
						echo base_url();
					}
				} else {
					$this->session->set_flashdata("message", "Password salah");
					// redirect('Login');
					echo "p";
					// die("password salah");
				}
			}
		} else {
			$this->session->set_flashdata("message", "Username tidak terdaftar");
			// redirect('Login');
			echo "up";
			// die("username tidak ditemukan");
		}
		//echo "Username dan password salah !";
		//}
	}

	function logout()
	{
		$no_login = $_SESSION['no_login'];
		$this->db->where('no_login', $no_login);
		$this->db->update('riwayat_login', array('logout' => date('Y-m-d H:i:s')));
		$this->session->sess_destroy();
		redirect("login");
	}

	function resep()
	{
		$this->db->select("MID(no_resep,4,99) as no, LENGTH(MID(no_resep,4,99)) as jml, no_resep");
		$this->db->where("LENGTH(MID(no_resep,4,99))", "8");
		$resep = $this->db->get("resep")->result();
		foreach ($resep as $value) {
			$isiU = array(
				'no_resep' => "RES0" . $value->no,
			);
			$this->db->where("no_resep", $value->no_resep);
			$this->db->update("resep", $isiU);
		}
		// echo $resep = $this->db->get("resep")->num_rows();

		// echo $resep["no"].$resep["jml"].$resep["no_resep"];
		// echo "RES0".$resep["no"];
	}
}
