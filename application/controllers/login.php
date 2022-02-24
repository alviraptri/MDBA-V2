<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('mLogin');
	}

	public function index()
	{
		$this->load->view('vLogin');
	}

	public function validasi()
	{
		date_default_timezone_set('Asia/Jakarta');
		$tipe = $this->input->post('type');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$url = "http://hrd.tvip.co.id/rest_server/api/login/?";

		$username = urlencode($username);
		$url .= "nik_baru=" . $username;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_USERPWD, "admin:Databa53");
		$output = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($output);
		echo "<script>console.log($password)</script>";

		//hash password input
		$pass = md5($password);
		// echo $_POST['nik'];
		// var_dump($output);
		// exit;

		$getUser = $this->mLogin->getUser($username, $password);
			print_r($getUser);
		// echo "<script>console.log(' . $result .')</script>";

		if ($getUser != '0') {
			// print_r($username);
				foreach ($getUser as $value) {
					$session_data = array(
						"user_nik" => $value->userNik,
						"user_nama" => $value->userLokasi,
						"user_kode_jabatan" => $value->userKodeJabatan,
						"user_lokasi" => $value->userLokasi,
						"user_branch" => $value->userBranch,
						"user_logged" => true
					);
					$this->session->set_userdata($session_data);
					echo "<script>console.log('masuk')</script>";
				}

				if ($getUser[0]->userBranch == '321' || $getUser[0]->userBranch == '336' || $getUser[0]->userBranch == '324') {
					$base = 'mdbaasa';
				}
				else{
					$base = 'mdbatvip';
				}

				$insert = array(
					'userNIK' => $getUser[0]->userNik,
					'userLogin' => date('Y-m-d H:i:s'),
				);
				$a = $this->mLogin->simpanData($insert, $base . '.mdbaUserLog');

				if ($a == 'true') {
					$this->session->set_flashdata('success', 'Anda Berhasil Login');
					header('Location: ' . base_url('home'));
					exit;
				} else {
					$this->session->set_flashdata('error', 'Gagal Login');
					header('Location: ' . base_url('login'));
					exit;
				}
			
		} else {
			// echo "api";
			if ($username == ($result->data[0]->nik_baru) && $pass == ($result->data[0]->password)) {
				if ($tipe == 'ICT' || $tipe == $result->data[0]->jabatan_struktur) {

					$branch = $this->mLogin->getBranch($result->data[0]->lokasi_struktur);
					foreach ($branch as $value) {
						$user_branch = $value->szId;
					}

					$session_data = array(
						"user_nik" => $result->data[0]->nik_baru,
						"user_nama" => $result->data[0]->nama_karyawan_struktur,
						"user_kode_jabatan" => $result->data[0]->jabatan_struktur,
						"user_lokasi" => $result->data[0]->lokasi_struktur,
						"user_branch" => $user_branch,
						"user_logged" => true
					);
					$this->session->set_userdata($session_data);
					echo "<script>console.log('masuk')</script>";

					print_r($user_branch);
					if ($user_branch == '321' || $user_branch == '336' || $user_branch == '324') {
						$base = 'mdbaasa';
					}
					else{
						$base = 'mdbatvip';
					}

					$insert = array(
						'userNIK' => $result->data[0]->nik_baru,
						'userLogin' => date('Y-m-d H:i:s'),
					);
					$a = $this->mLogin->simpanData($insert, $base . '.mdbaUserLog');

					if ($a == 'true') {
						$this->session->set_flashdata('success', 'Anda Berhasil Login');
						header('Location: ' . base_url('home'));
						exit;
					} else {
						$this->session->set_flashdata('error', 'Gagal Login');
						header('Location: ' . base_url('login'));
						exit;
					}
				} else {
					$this->session->set_flashdata('warning', 'Tipe Jabatan Salah');
					header('Location: ' . base_url('login'));
					exit;
				}
			} else {
				$this->session->set_flashdata('error', 'NIK dan Password Salah');
				header('Location: ' . base_url('login'));
				exit;
			}
		}
	}

	public function logout()
	{
		if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
			$base = 'mdbaasa';
		} else {
			$base = 'mdbatvip';
		}
		date_default_timezone_set('Asia/Jakarta');
		$a = $this->mLogin->userLog($this->session->userdata('user_nik'));
		foreach ($a as $value) {
			$num = $value->userNo;
		}
		$update = array('userLogout' => date('Y-m-d H:i:s'));
		$where = array('userNo' => $num);
		$this->mLogin->updateData($where, $update, $base . '.mdbaUserLog');

		$this->session->sess_destroy();
		$this->session->set_flashdata('success', 'Anda Berhasil Logout');
		redirect('login');
	}
}
