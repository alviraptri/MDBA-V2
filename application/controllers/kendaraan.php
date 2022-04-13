<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kendaraan extends CI_Controller {



	public function __construct(){
		parent::__construct();
	

		$this->load->model('m_inventory');
		$this->load->library('uuid');
	
	
	}

	public function index()
	{
		if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
        } else {
            $dept = 'dms111tvip';
        }
		$data['segment'] = $this->input->get('id');
		$data['provinsi'] = $this->db->query(" SELECT * FROM $dept.dms_gen_geotree  GROUP BY szProvince ")->result();
		$data ['kendaraan'] = $this->m_inventory->get_jenis_kendaraan();

		$data['depo'] = $this->db->query("SELECT * FROM bs.tbl_depo")->result();
		$this->load->view('template/header');
		$this->load->view('kendaraan/Kendaraan',$data);
		$this->load->view('template/footer');
	}

	public function master_kendaraan()
	{

		$data['tipe'] = $this->m_inventory->get_kendaraan_edit();
		$data ['kendaraan'] = $this->m_inventory->get_jenis_kendaraan();

		$this->load->view('template/header');
		$this->load->view('kendaraan/master_kendaraan', $data);
		$this->load->view('template/footer');
	}

	public function Tipekendaraan()
	{
		if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $name = 'asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $name = 'tvip';
            $base = 'dummymdbatvip';
        }

		$data['tipe'] = $this->db->query("SELECT a.*, b.*
										 FROM $dept.dms_inv_vehicletype AS a 
										 LEFT JOIN $base.dms_status_tipekendaraan AS b ON a.szId=b.`szId`
										 WHERE b.status != 2 
										 ")->result();

		$this->load->view('template/header');
		$this->load->view('kendaraan/master_tipe',$data);
		$this->load->view('template/footer');


	}

	public function ekpedisi()
	{
		if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $name = 'asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $name = 'tvip';
            $base = 'dummymdbatvip';
        }
		$data['tipe'] = $this->db->query("SELECT a.*, b.*, c.*
										 FROM $dept.dms_inv_carrier AS a 
										 LEFT JOIN $base.dms_status_ekspedisi AS b ON a.szId=b.`szId`
										 LEFT JOIN $dept.dms_sm_addressinfo AS c ON a.szId=c.`szId`
										 WHERE b.status != 2 
										 ")->result();
		$data['provinsi'] = $this->db->query(" SELECT * FROM $dept.dms_gen_geotree  GROUP BY szProvince ")->result();


		// var_dump($data);
		// die;

		$this->load->view('template/header');
		$this->load->view('kendaraan/ekspedisi',$data);
		$this->load->view('template/footer');


	}


	public function insertKendaraan()
	{
		if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $dept = 'dms111asa';
            $name = 'asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $name = 'tvip';
            $base = 'dummymdbatvip';
        }
		
		$id = 	$this->input->post("Kkendaraan");
		$valid = $this->db->query("SELECT * FROM $dept.dms_inv_vehicle WHERE szId = '$id' ")->result();

		if($valid != null ){	
			$this->session->set_flashdata('massage','<div class="alert alert-danger">Kode Kendaraan sudah ada.</div>');
			redirect("kendaraan");
		}

		$date = date("Y-m-d H:i:s");
		$data = array(	
			'szId' => $this->input->post("Kkendaraan"),
			'szName' => $this->input->post("Nkendaraan"),
			'szDescription' => $this->input->post("ketKendaraan"),
			'iId' => $this->uuid->v4(),
			'szBranchId' => $this->input->post("szBranchId"),
			'szPoliceNo' => $this->input->post("Nkendaraan"),
			'szChassisNo' => $this->input->post("szChassisNo"),
			'szMachineNo' => $this->input->post("szMachineNo"),
			'szVehicleTypeId' => $this->input->post("szVehicleTypeId"),
			'dtmVehicleLicense' => $this->input->post("dtmVehicleLicense"),
			'DtmCreated' => $date, 
			'dtmLastUpdated' => $date	
		);

		$data_status = array(
			'szId' => $this->input->post("Kkendaraan"),
			'status' => 1	
		);

		$this->db2 = $this->load->database($name, true);
		$this->db2->insert("dmstesting.dms_inv_vehicle" , $data);
		$this->db2->close();

		$this->db->insert($base.".dms_status_kendaraan" , $data_status);
		$this->session->set_flashdata('massage','<div class="alert alert-success">Data berhasil ditambahkan.</div>');
		redirect("kendaraan/master_kendaraan");
	}



		public function get_ajax_kendaraan(){

	
				$postData = $this->input->post();  
				$data=$this->m_inventory->get_data_kendaraan($postData);
				echo json_encode($data);


		} 



		public function updateKendaraan(){

			$data = array(
	
				'status' => $this->input->post("status"),
				'szId' => $this->input->post("id"),
			
	
			);
	
			$date = date("Y-m-d H:i:s");
			$data_kend = array(
			
				// 'szId' => $this->input->post("Kkendaraan"),
				'szName' => $this->input->post("Nkendaraan"),
				'szDescription' => $this->input->post("ketKendaraan"),
				'iId' => $this->uuid->v4(),
				'szBranchId' => $this->input->post("szBranchId"),
				'szPoliceNo' => $this->input->post("Nkendaraan"),
				'szChassisNo' => $this->input->post("szChassisNo"),
				'szMachineNo' => $this->input->post("szMachineNo"),
				'szVehicleTypeId' => $this->input->post("szVehicleTypeId"),
				'dtmVehicleLicense' => $this->input->post("dtmVehicleLicense"),
				'DtmCreated' => $date, 
				'dtmLastUpdated' => $date
				
			);
	







			$id = $this->input->post("id");
			// echo $id;
			// die;
			$this->db->where("szId", $this->input->post("id"));
			$this->db->update("dms_status_kendaraan" , $data);

			$this->db->where("szId", $this->input->post("id"));
			$this->db->update("dms_inv_vehicle" , $data_kend);
			$this->session->set_flashdata('massage','<div class="alert alert-success">Data berhasil di update.</div>');
			redirect("kendaraan/master_kendaraan");
	
	
	
		}
	


		public function hapusKendaraan(){

			$id = $this->input->post("id_hapus");
			// echo $id;
			// die;
			$data = array(
	
				'status' => 2,
				
	
			);
	
	
			$this->db->where("szId",$id);
			$this->db->update("dms_status_kendaraan" ,$data);
			$this->session->set_flashdata('massage','<div class="alert alert-danger">Data berhasil di Hapus.</div>');
			redirect("kendaraan/master_kendaraan");
	
		}



		public function insertTipekendaraan()
		{
			if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
				$dept = 'dms111asa';
				$name = 'asa';
				$base = 'dummymdbaasa';
			} else {
				$dept = 'dms111tvip';
				$name = 'tvip';
				$base = 'dummymdbatvip';
			}
			$id = $this->input->post("Ktk");
			$valid = $this->db->query("SELECT * FROM $dept.dms_inv_vehicleType WHERE szId LIKE '%$id%' ")->result();

			if($valid != null ){
				
			$this->session->set_flashdata('massage','<div class="alert alert-danger">Kode TIpe kendaraan sudah ada.</div>');
			redirect("kendaraan");


			}

			$date = date("Y-m-d H:i:s");

			$data = array(
			
				'szId' => $this->input->post("Ktk"),
				'szName' => $this->input->post("Ntk"),
				'szDescription' => $this->input->post("ketKendaraan"),
				'iId' => $this->uuid->v4(),
				'decWeight' => $this->input->post("max"),
				'decVolume' => $this->input->post("vol"),
				'DtmCreated' => $date, 
				'dtmLastUpdated' => $date
			);
	
	
			$data_status = array(
			
				'szId' => $this->input->post("Ktk"),
				'status' => 1
			
			);

			$this->db2 = $this->load->database($name, true);
			$this->db2->insert("dmstesting.dms_inv_vehicleType" , $data);
			$this->db2->close();
			$this->db->insert($base.".dms_status_Tipekendaraan" , $data_status);
			$this->session->set_flashdata('massage','<div class="alert alert-success">Data berhasil ditambahkan.</div>');
			redirect("kendaraan/Tipekendaraan");
	
			
	
	
		}
	
	
	
			public function get_ajax_Tipekendaraan(){
	
		
					$postData = $this->input->post();  
					$data=$this->m_inventory->get_data_Tipekendaraan($postData);
					echo json_encode($data);
	
	
			} 
	
	
	
			public function updateTipeKendaraan(){
	
				$data = array(
		
					'status' => $this->input->post("status"),
					'szId' => $this->input->post("id"),
					
		
				);
				$date = date("Y-m-d H:i:s");

				$data_tipe = array(
		
					// 'szId' => $this->input->post("Ktk"),
					'szName' => $this->input->post("Ntk"),
					'szDescription' => $this->input->post("ketKendaraan"),
					'iId' => $this->uuid->v4(),
					'decWeight' => $this->input->post("max"),
					'decVolume' => $this->input->post("vol"),
					'DtmCreated' => $date, 
					'dtmLastUpdated' => $date
					
				);

				$id = $this->input->post("id");
				// var_dump($data_tipe);
				// die;
				$this->db->where("szId", $this->input->post("id"));
				$this->db->update("dms_status_Tipekendaraan" , $data);

				$this->db->where("szId", $this->input->post("id"));
				$this->db->update("dms_inv_vehicleType" , $data_tipe);
				$this->session->set_flashdata('massage','<div class="alert alert-success">Data berhasil di update.</div>');
				redirect("kendaraan/Tipekendaraan");
		
		
		
			}
		
	
	
			public function hapusTipekendaraan(){
	
				$id = $this->input->post("id_hapus");
				// echo $id;
				// die;
				$data = array(
		
					'status' => 2,
					
		
				);
		
		
				$this->db->where("szId",$id);
				$this->db->update("dms_status_Tipekendaraan" ,$data);
				$this->session->set_flashdata('massage','<div class="alert alert-danger">Data berhasil di Hapus.</div>');
				redirect("kendaraan/Tipekendaraan");
		
			}
	
	


			public function insertEkspedisi()
			{
				if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
					$dept = 'dms111asa';
					$name = 'asa';
					$base = 'dummymdbaasa';
				} else {
					$dept = 'dms111tvip';
					$name = 'tvip';
					$base = 'dummymdbatvip';
				}

				$id = $this->input->post("Ke");

				$valid = $this->db->query("SELECT * FROM $dept.dms_inv_carrier WHERE szId LIKE '%$id%' ")->result();
	
			// var_dump($valid);
			// die;
				if($valid != null ){
					
				$this->session->set_flashdata('massage','<div class="alert alert-danger">Kode  Ekspedisi sudah ada.</div>');
				redirect("kendaraan");
	
	
				}

				$date = date("Y-m-d H:i:s");
				$data = array(
				
					'szId' => $this->input->post("Ke"),
					'szName' => $this->input->post("Ne"),
					'iId' => $this->uuid->v4(),
					'DtmCreated' => $date, 
					'dtmLastUpdated' => $date,
					'szDescription' => $this->input->post("ketekpedisi"),

				);
		


				$data_info = array(
		
					'szObjectId' =>"DMSCarrier",
					'szId' => $this->input->post("Ke"),
					'szaddress' => $this->input->post("szaddress"),
					'iId' => $this->uuid->v4(),
					'szProvince' => $this->input->post("szProvince"),
					'szCity' => $this->input->post("szCity") ,
					'szDistrict' => $this->input->post("szDistrict") ,
					'szSubDistrict' => $this->input->post("szSubDistrict") ,
					'szZipcode' => $this->input->post("szZipCode") ,
					'szPhone1' => $this->input->post("szPhone1") ,
					'szPhone2' => $this->input->post("szPhone2") ,
					'szPhone3' => $this->input->post("szPhone3") ,
					'szFaximile' => $this->input->post("szFaxmile") ,
					'szContactPerson1' => $this->input->post("szContactPerson1") ,
					'szContactPerson2' => $this->input->post("szContactPerson2") ,
					'szEmail' => $this->input->post("email") ,
					'DtmCreated' => $date, 
					'dtmLastUpdated' => $date
					
				);
		
		
				// $data_status = array(
				
				// 	'szId' => $this->input->post("Ksatuan"),
				// 	'status' => 1
		
					
				// );
		
				$this->db2 = $this->load->database($name, true);
				$this->db2->insert("dmstesting.dms_sm_addressInfo" , $data_info);
				$this->db2->close();
				// $this->db->insert("dms_status_satuan" , $data_status);
			
		


		
				$data_status = array(
				
					'szId' => $this->input->post("Ke"),
					'status' => 1
				
				);

				$this->db2 = $this->load->database($name, true);
				$this->db2->insert("dmstesting.dms_inv_carrier" , $data);
				$this->db2->close();
				$this->db->insert($base.".dms_status_ekspedisi" , $data_status);
				$this->session->set_flashdata('massage','<div class="alert alert-success">Data berhasil ditambahkan.</div>');
				redirect("kendaraan/ekpedisi");
		
				
		
		
			}
		
		
		
				public function get_ajax_ekspedisi(){
		
			
						$postData = $this->input->post();  
						$data=$this->m_inventory->get_data_ekspedisi($postData);
						echo json_encode($data);
		
		
				} 
		
		
		
				public function updateEkspedisi(){
		
					$data = array(
			
						'status' => $this->input->post("status"),
						// 'szId' => $this->input->post("Kekspedisi"),

			
					);
			
					$date = date("Y-m-d H:i:s");
					$data_new = array(
					
						// 'szId' => $this->input->post("Kekspedisi"),
						'szName' => $this->input->post("Nekspedisi"),
						'szDescription' => $this->input->post("ketekpedisi"),
						'iId' => $this->uuid->v4(),
						'DtmCreated' => $date, 
						'dtmLastUpdated' => $date
						
					);
			
	
	
					$data_info = array(
			
						'szObjectId' =>"DMSCarrier",
						// 'szId' => $this->input->post("Kekspedisi"),
						'szaddress' => $this->input->post("szaddress"),
						'iId' => $this->uuid->v4(),
						'szProvince' => $this->input->post("szProvince"),
						'szCity' => $this->input->post("szCity") ,
						'szDistrict' => $this->input->post("szDistrict") ,
						'szSubDistrict' => $this->input->post("szSubDistrict") ,
						'szZipcode' => $this->input->post("szZipCode") ,
						'szPhone1' => $this->input->post("szPhone1") ,
						'szPhone2' => $this->input->post("szPhone2") ,
						'szPhone3' => $this->input->post("szPhone3") ,
						'szFaximile' => $this->input->post("szFaxmile") ,
						'szContactPerson1' => $this->input->post("szContactPerson1") ,
						'szContactPerson2' => $this->input->post("szContactPerson2") ,
						'szEmail' => $this->input->post("email") ,
						'DtmCreated' => $date, 
						'dtmLastUpdated' => $date
						
					);
			
	
					$id = $this->input->post("id");
					// echo $id;
					// die;
					$this->db->where("szId", $this->input->post("id"));
					$this->db->update("dms_status_ekspedisi" , $data);

					$this->db->where("szId", $this->input->post("id"));
					$this->db->update("dms_inv_carrier" , $data_new);

					$this->db->where("szId", $this->input->post("id"));
					$this->db->update("dms_sm_addressInfo" , $data_info);
					
					$this->session->set_flashdata('massage','<div class="alert alert-success">Data berhasil di update.</div>');
					redirect("kendaraan/ekpedisi");
			
			
			
				}
			
		
		
				public function hapusEkspedisi(){
		
					$id = $this->input->post("id_hapus");
					// echo $id;
					// die;
					$data = array(
			
						'status' => 2,
						
			
					);
			
			
					$this->db->where("szId",$id);
					$this->db->update("dms_status_ekspedisi" ,$data);
					$this->session->set_flashdata('massage','<div class="alert alert-danger">Data berhasil di Hapus.</div>');
					redirect("kendaraan/ekpedisi");
			
				}
		
				public function get_kota_edit(){

				$postData = $this->input->post();  
			
				$data=$this->m_inventory->get_kota_edit($postData);
				echo json_encode($data);

			
				}
				public function get_kota(){

				$postData = $this->input->post();  
			
				$data=$this->m_inventory->get_kota($postData);
				echo json_encode($data);

			
				}
				public function get_provinsi(){

				$postData = $this->input->post();  
			
				$data=$this->m_inventory->Province($postData);
				echo json_encode($data);

			
				}

				public function get_kecamatan(){

				$postData = $this->input->post();  
				$data=$this->m_inventory->get_kecamatan($postData);
				echo json_encode($data);

			
				}

				public function get_kelurahan(){

				$postData = $this->input->post();  
			
				$data=$this->m_inventory->get_kelurahan($postData);
				// var_dump($data);
				echo json_encode($data);

			
				}

				public function get_kelurahan_edit(){

				$postData = $this->input->post();  
			
				$data=$this->m_inventory->get_kelurahan_edit($postData);
				// var_dump($data);
				echo json_encode($data);

			
				}


				public function get_kode(){

				$postData = $this->input->post();
				// var_dump($postData);  
				// die;
				$data=$this->m_inventory->get_kode($postData);
				echo json_encode($data);

				}

				public function get_kendaran_valid(){

					$postData = $this->input->post();

					$data = $this->m_inventory->get_kendaraan_valid($postData);
					echo json_encode($data);


				}

				public function get_tipeKendaraan_valid(){

					$postData = $this->input->post();

					$data = $this->m_inventory->get_tipekendaraan_valid($postData);
					echo json_encode($data);


				}
				public function get_ekspedisi_valid(){

					$postData = $this->input->post();

					$data = $this->m_inventory->get_ekspedisi_valid($postData);
					echo json_encode($data);


				}


		




}
