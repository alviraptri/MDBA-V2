<?php
class cashierClosing extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_logged') == '') {
			redirect('login');
		}
		$this->load->model(array('mInventori', 'mHome', 'mCashierSettlement', 'mCashierBtu', 'mCashierClosing'));
		$this->load->library('uuid');
		date_default_timezone_set('Asia/Jakarta');
	}

	function simpan()
	{
		$user = $this->session->userdata('user_nik');
		$depo = $this->session->userdata('user_branch');
		if ($depo == '321' || $depo == '324' || $depo == '336') {
			$dept = 'ASA';
			$base = 'dummymdbaasa';
		} else {
			$dept = 'TVIP';
			$base = 'dummymdbatvip';
		}

		$tanggal = $this->input->post('tgl');
		$tanggaltotime = strtotime($tanggal);
		$date = date('Y-m-d H:i:s');
		$getClosing = $this->mCashierClosing->getLastClosing($depo);
		$getLastClosing = date("Y-m-d", strtotime($getClosing));
		$tanggalNol = date('Y-m-d 00:00:00', $tanggaltotime);

		if ($tanggal <= $getLastClosing) {
			$this->session->set_flashdata('error', 'Data Gagal Tersimpan');
			header('Location: ' . base_url('home'));
			exit;
		}
		if ($tanggal >= $getLastClosing) {
			// COUNTER
			$closingId = 'CLOSING' . $depo . 'COU';
			$closing = $this->mCashierSettlement->getId($closingId);

			// $getNomorClosingOri = $this->mCashierClosing->getNomorClosingOri();
			// $getNomorClosing = $this->mCashierClosing->getNomorClosing();

			$dms_sd_docsettlement = [];

			$dataCashOut = $this->mCashierClosing->getDataCashOutForClosing($tanggalNol, $depo);
			//$dataCashOutItem = $this->mCashierClosing->getDataCashOutItemForClosing();
			$dataCashIn = $this->mCashierClosing->getDataCashInForClosing($tanggalNol, $depo);
			$voucherOut = [];
			$voucherIn = [];
			//$dataCashInItem = $this->mCashierClosing->getDataCashInItemForClosing();

			if (($dataCashOut != null) || ($dataCashIn != null)) {
				if ($dataCashOut != NULL) {
					foreach ($dataCashOut as $data) {
						$Voucher_Code    = 	$data->Voucher_Code;
						$Id_VB 			 = 	$data->Id_VB;
						$ID_Depo 		 = 	$data->ID_Depo;
						$Id_Tipe_Saldo   = 	$data->Id_Tipe_Saldo;
						$TGL_VB 		 =  $data->TGL_VB;
						$UNTUK			 =	$data->UNTUK;
						$KEBUTUHAN		 =	$data->KEBUTUHAN;
						$TOTAL			 =	$data->TOTAL;
						$ID_VB_Item		 =	$data->ID_VB_Item;
						$Tipe_Transaksi	 =	$data->Tipe_Transaksi;
						$Nilai			 =	$data->Nilai;
						$Notes			 =	$data->Notes;

						$voucherOut = array(
							'Voucher_Code' 	=> $this->uuid->v4(),
							'Id_VB' 		=> $Id_VB,
							'ID_Depo' 		=> $ID_Depo,
							'Id_Tipe_Saldo' => $Id_Tipe_Saldo,
							'TGL_VB' 		=> $TGL_VB,
							'UNTUK' 		=> $UNTUK,
							'KEBUTUHAN' 	=> $KEBUTUHAN,
							'TOTAL' 		=> $TOTAL,
							'ID_VB_Item' 	=> $ID_VB_Item,
							'Tipe_Transaksi' => $Tipe_Transaksi,
							'Nilai' 		=> $Nilai,
							'Notes' 		=> $Notes,
							'status'		=> '0',
							'update_at'		=> $date
						);
						$this->db5 = $this->load->database('gl', TRUE);
						$this->db5->insert("voucher_bayar", $voucherOut);
					}
				}

				if ($dataCashIn != NULL) {
					foreach ($dataCashIn as $data) {
						$Voucher_Code    = 	$data->Voucher_Code;
						$Id_VT 			 = 	$data->Id_VT;
						$ID_Depo 		 = 	$data->ID_Depo;
						$Id_Tipe_Saldo   = 	$data->Id_Tipe_Saldo;
						$TGL_VT 		 =  $data->TGL_VT;
						$DARI			 =	$data->DARI;
						$KEBUTUHAN		 =	$data->KEBUTUHAN;
						$TOTAL_VT		 =	$data->TOTAL_VT;
						$ID_VT_Item		 =	$data->ID_VT_Item;
						$Tipe_Transaksi	 =	$data->Tipe_Transaksi;
						$Nilai_VT		 =	$data->Nilai_VT;
						$Notes			 =	$data->Notes;

						$voucherIn = array(
							'Voucher_Code' 	=> $this->uuid->v4(),
							'Id_VT' 		=> $Id_VT,
							'ID_Depo' 		=> $ID_Depo,
							'Id_Tipe_Saldo' => $Id_Tipe_Saldo,
							'TGL_VT' 		=> $TGL_VT,
							'DARI' 			=> $DARI,
							'KEBUTUHAN' 	=> $KEBUTUHAN,
							'TOTAL_VT' 		=> $TOTAL_VT,
							'ID_VT_Item' 	=> $ID_VT_Item,
							'Tipe_Transaksi' => $Tipe_Transaksi,
							'Nilai_VT' 		=> $Nilai_VT,
							'Notes' 		=> $Notes,
							'status'		=> '0',
							'update_at'		=> $date
						);
						$this->db5 = $this->load->database('gl', TRUE);
						$this->db5->insert("voucher_Terima", $voucherIn);
					}
				}
				// update counter
				$closingCounter = $this->mCashierSettlement->getCounter($closingId);
				$updateCountVt = array(
					'intLastCounter' => $closingCounter + 1,
					'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
					'dtmLastUpdated' => date('Y-m-d H:i:s')
				);
				$whereCountVb = array('szId' => $closingId);
				// $this->mCashierSettlement->updateData($whereCountVb, $updateCountVb, $base . '.dms_sm_counter');
				// $this->mCashierSettlement->updateDms($whereCountVb, $updateCountVb, 'dmstesting.dms_sm_counter');


				$dms_sd_docsettlement = array(
					'iId' => $this->uuid->v4(),
					'szDocId' => $closing,
					'dtmDoc' => $tanggalNol,
					'dtmFrom' => $tanggal,
					'dtmTo' => $tanggal,
					'szSettBranchId' => $depo,
					'bCashClosing' =>  '1',
					'bDistributionClosing' => '1',
					'bInventoryClosing' => '1',
					'bDalilyClosing' => '1',
					'intPrintedCount' => '0',
					'szBranchId' => $depo,
					'szCompanyId' => $dept,
					'szDocStatus' => 'Applied',
					'szUserCreatedId' => $user,
					'szUserUpdatedId' => $user,
					'dtmCreated' => $date,
					'dtmLastUpdated' => $date,
				);
				$this->db->insert("$base.dms_sd_docsettlement", $dms_sd_docsettlement);
			} else {
				echo 'data voucher tidak ada pada tanggal tersebut';
			}
			$this->session->set_flashdata('success', "BERHASIL CLOSING");
			redirect("home");
		}
	}
}
