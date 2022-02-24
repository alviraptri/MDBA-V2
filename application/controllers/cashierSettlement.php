<?php
class cashierSettlement extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_logged') == '') {
			redirect('login');
		}
		$this->load->model(array('mInventori', 'mHome', 'mCashierSettlement', 'mCashierBtu'));
		$this->load->library('uuid');
		date_default_timezone_set('Asia/Jakarta');
	}

	function getData()
	{
		$branch = $this->input->post('branch');
		$dateStart = $this->input->post('dateStart');
		$dateFinish = $this->input->post('dateFinish');
		$data = $this->mCashierSettlement->getData($branch, $dateStart, $dateFinish);
		echo json_encode($data);
	}

	function simpan()
	{
		
		$tglStart = $this->input->post('tglStart');
		$tglFinish = $this->input->post('tglFinish');
		$depo = $this->input->post('depo');
		$user = $this->session->userdata('user_nik');
		$tanggal = date('Y-m-d H:i:s');

		if ($depo == '321' || $depo == '324' || $depo == '336') {
			$dept = 'ASA';
			$namedept = 'asa';
		} else {
			$dept = 'TVIP';
			$namedept = 'tvip';
		}

		$this->simpanVb($tglStart, $tglFinish, $depo, $user, $tanggal, $dept);
		$this->simpanVt($tglStart, $tglFinish, $depo, $user, $tanggal, $dept);

		$this->session->set_flashdata('success', 'Data Sudah Tersimpan');
		header('Location: ' . base_url('home'));
		exit;
	}

	function simpanVb($tglStart, $tglFinish, $depo, $user, $tanggal, $dept)
	{
		if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
		$dms_doccashout = [];
		$dms_doccashoutitem = [];
		$dms_cashbalanceheader = [];
		$dms_cashbalancedetail = [];
		$dms_cashbalanceSaldo = [];
		$noVoucherBayar = [];

		$getArray = $this->mCashierSettlement->getArrayHeader($tglStart, $tglFinish, $depo);
		foreach ($getArray as $v) {
			$szAccountId = $v->szAccountId;
			$szSubAccountId = $v->szSubAccountId;
			$getDocId = $this->mCashierSettlement->getDocId($szAccountId, $tglStart, $tglFinish, $depo);
			$getNomorVB = $this->mCashierSettlement->getNomorVB();
			$decAmount = $v->totalDec;

			$dms_doccashout = array(
				'iId' => $this->uuid->v4(),
				'szDocId' => $getNomorVB,
				'dtmDoc' => $tglFinish,
				'szEmployeeId' => $user,
				'szAccountId' => $szAccountId,
				'szSubAccountId' => $szSubAccountId,
				'decAmountControl' => '0',
				'intPrintedCount' => '0',
				'szBranchId' => $depo,
				'szCompanyId' =>  $dept,
				'szDocStatus' => 'Applied',
				'szUserCreatedId' => $user,
				'szUserUpdatedId' => $user,
				'dtmCreated' => $tanggal,
				'dtmLastUpdated' => $tanggal,
			);
			$this->mCashierBtu->simpanData($dms_doccashout, $base.'.dms_cas_doccashout');

			$getAmountHeader = $this->mCashierSettlement->getAmountHeader($getDocId);
			$dms_cashbalanceheader = array(
				'iId' => $this->uuid->v4(),
				'szObjectId' => 'DMSDocCashOut',
				'szDocId' => $getNomorVB,
				'dtmDoc' => $tglFinish,
				'szAccountId' => $szAccountId,
				'szSubAccountId' => $szSubAccountId,
				'decDebit' => '0',
				'decCredit' => $getAmountHeader,
				'decAmount' => 0 - floatval($getAmountHeader),
				'bVoucher' => '1',
				'szVoucherNo' => '',
				'szBranchId' => $depo,
				'szDescription' => '',
				'intItemNumber' => '-1',
				'szUserCreatedId' => $user,
				'szUserUpdatedId' => $user,
				'dtmCreated' => $tanggal,
				'dtmLastUpdated' => $tanggal,
			);
			$this->mCashierBtu->simpanData($dms_cashbalanceheader, $base.'.dms_cas_cashbalance');

			$getCashBalanceSaldoHeader = $this->db->query("SELECT * FROM $base.`dms_cas_cashbalancesaldo`
			WHERE szBranchId = '$depo' 
			AND szAccountId = '$szAccountId' AND szSubAccountId = '$szSubAccountId'");
			if ($getCashBalanceSaldoHeader->num_rows() > 0) {
				$getTempBalanceForSaldo = $this->mCashierSettlement->getTempBalanceForSaldo($szAccountId, $szSubAccountId, $depo);
				foreach ($getTempBalanceForSaldo as $data) {
					$credit = floatval($data->decCredit) + floatval($getAmountHeader);
					$amount = floatval($data->decDebit) - $credit;

					$this->db->query("UPDATE $base.dms_cas_cashbalancesaldo 
					SET decCredit = '$credit',
					decAmount = '$amount',
					szUserUpdatedId = '$user',
					dtmLastUpdated = '$tanggal'
					WHERE szAccountId = '$szAccountId' AND szSubAccountId = '$szSubAccountId'
					AND szBranchId = '$depo'");
				}
			} else if ($getCashBalanceSaldoHeader->num_rows() == 0) {
				$dms_cashbalanceSaldo = array(
					'iId' => $this->uuid->v4(),
					'szBranchId' => $depo,
					'szAccountId' => $szAccountId,
					'szSubAccountId' => $szSubAccountId,
					'decDebit' => '0',
					'decCredit' => floatval($getAmountHeader),
					'decAmount' => 0 - floatval($getAmountHeader),
					'szUserCreatedId' => $user,
					'szUserUpdatedId' => $user,
					'dtmCreated' => $tanggal,
					'dtmLastUpdated' => $tanggal
				);
				$this->mCashierBtu->simpanData($dms_cashbalanceSaldo, $base.'.dms_cas_cashbalancesaldo');
			}

			$getDetailItem = $this->mCashierSettlement->getItemDetail($getDocId);
			$i = 0;
			foreach ($getDetailItem as $data) {
				$szAccountDetail = $data->szAccountId;
				$szSubAccountDetail = $data->szSubAccountId;
				$jumlah = $data->jumlahDetail;
				$description = $data->szDescription;
				$dms_doccashoutitem = array(
					'iId' => $this->uuid->v4(),
					'szDocId' => $getNomorVB,
					'intItemNumber' => $i,
					'szAccountId' => $szAccountDetail,
					'szSubAccountId' => $szSubAccountDetail,
					'decAmount' => $jumlah,
					'szDescription' => $description
				);
				$this->mCashierBtu->simpanData($dms_doccashoutitem, $base.'.dms_cas_doccashoutitem');

				$dms_cashbalancedetail = array(
					'iId' => $this->uuid->v4(),
					'szObjectId' => 'DMSDocCashOut',
					'szDocId' => $getNomorVB,
					'dtmDoc' => $tglFinish,
					'szAccountId' => $szAccountDetail,
					'szSubAccountId' => $szSubAccountDetail,
					'decDebit' => $jumlah,
					'decCredit' => '',
					'decAmount' => $jumlah,
					'bVoucher' => '1',
					'szVoucherNo' => '',
					'szBranchId' => $depo,
					'szDescription' => $description,
					'intItemNumber' => $i,
					'szUserCreatedId' => $user,
					'szUserUpdatedId' => $user,
					'dtmCreated' => $tanggal,
					'dtmLastUpdated' => $tanggal,
				);
				$this->mCashierBtu->simpanData($dms_cashbalancedetail, $base.'.dms_cas_cashbalance');

				$getCashBalanceSaldoDetail = $this->db->query("SELECT * FROM $base.`dms_cas_cashbalancesaldo`
				WHERE szBranchId = '$depo' 
				AND szAccountId = '$szAccountDetail' AND szSubAccountId = '$szSubAccountDetail'");
				if ($getCashBalanceSaldoDetail->num_rows() > 0) {
					$getTempBalanceForSaldoDetail = $this->mCashierSettlement->getTempBalanceForSaldoDetail($szAccountDetail, $szSubAccountDetail, $depo);
					foreach ($getTempBalanceForSaldoDetail as $data) {
						$debit = floatval($data->decDebit) + floatval($jumlah);
						$amount = floatval($debit) - floatval($data->decCredit);

						$this->db->query("UPDATE $base.dms_cas_cashbalancesaldo 
						SET decDebit = '$debit',
						decAmount = '$amount',
						szUserUpdatedId = '$user',
						dtmLastUpdated = '$tanggal'
						WHERE szAccountId = '$szAccountDetail' AND szSubAccountId = '$szSubAccountDetail'
						AND szBranchId = '$depo'");
					}
				} else if ($getCashBalanceSaldoDetail->num_rows() == 0) {
					$dms_cashbalanceSaldo = array(
						'iId' => $this->uuid->v4(),
						'szBranchId' => $depo,
						'szAccountId' => $szAccountDetail,
						'szSubAccountId' => $szSubAccountDetail,
						'decDebit' => $jumlah,
						'decCredit' => 0,
						'decAmount' => $jumlah,
						'szUserCreatedId' => $user,
						'szUserUpdatedId' => $user,
						'dtmCreated' => $tanggal,
						'dtmLastUpdated' => $tanggal
					);
					$this->mCashierBtu->simpanData($dms_cashbalanceSaldo, $base.'.dms_cas_cashbalancesaldo');
				}
				$i++;
			}

			$this->db->query("UPDATE $base.dms_cas_cashtempbalance SET bVoucher = '1',szVoucherNo = '$getNomorVB'
			 WHERE szDocId IN ($getDocId) AND szObjectId = 'DMSDocCashTempOut'
			 AND dtmDoc BETWEEN '$tglStart' AND '$tglFinish'");

			array_push($noVoucherBayar, array(
				$getNomorVB
			));
			$updateLastCounter = $this->mCashierSettlement->getNomorVB_ori();
			$this->db->query("UPDATE $base.dms_sm_counter SET intLastCounter = '$updateLastCounter',
			szUserUpdatedId = '$user',
			dtmLastUpdated = '$tanggal'
			WHERE szId = 'VB" . $depo . "COU' ");
		}
	}

	function simpanVt($tglStart, $tglFinish, $depo, $user, $tanggal, $dept)
	{
		if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
		$dms_doccashin = [];
		$dms_doccashinitem = [];
		$dms_cashbalanceheader = [];
		$dms_cashbalancedetail = [];
		$dms_cashbalanceSaldo = [];
		$noVoucherBayar = [];

		$getArrayBTU = $this->mCashierSettlement->getArrayBTU($tglStart, $tglFinish, $depo);

		foreach ($getArrayBTU as $v) {
			$szAccountId = $v->szAccountId;
			$szSubAccountId = $v->szSubAccountId;
			$getDocId = $this->mCashierSettlement->getDocIdIn($szAccountId, $tglStart, $tglFinish, $depo);
			$getNomorVT = $this->mCashierSettlement->getNomorVT();

			$dms_doccashin = array(
				'iId' => $this->uuid->v4(),
				'szDocId' => $getNomorVT,
				'dtmDoc' => $tglFinish,
				'szEmployeeId' => $user,
				'szAccountId' => $szAccountId,
				'szSubAccountId' => $szSubAccountId,
				'decAmountControl' => '0',
				'intPrintedCount' => '0',
				'szBranchId' => $depo,
				'szCompanyId' =>  $dept,
				'szDocStatus' => 'Applied',
				'szUserCreatedId' => $user,
				'szUserUpdatedId' => $user,
				'dtmCreated' => $tanggal,
				'dtmLastUpdated' => $tanggal,
			);
			$this->mCashierBtu->simpanData($dms_doccashin, $base.'.dms_cas_doccashin');

			$getAmountHeaderIn = $this->mCashierSettlement->getAmountHeaderIn($getDocId);
			$dms_cashbalanceheader = array(
				'iId' => $this->uuid->v4(),
				'szObjectId' => 'DMSDocCashIn',
				'szDocId' => $getNomorVT,
				'dtmDoc' => $$tglFinish,
				'szAccountId' => $szAccountId,
				'szSubAccountId' => $szSubAccountId,
				'decDebit' => $getAmountHeaderIn,
				'decCredit' => '0',
				'decAmount' => floatval($getAmountHeaderIn),
				'bVoucher' => '1',
				'szVoucherNo' => '',
				'szBranchId' => $depo,
				'szDescription' => '',
				'intItemNumber' => '-1',
				'szUserCreatedId' => $user,
				'szUserUpdatedId' => $user,
				'dtmCreated' => $tanggal,
				'dtmLastUpdated' => $tanggal,
			);
			$this->mCashierBtu->simpanData($dms_cashbalanceheader, $base.'.dms_cas_cashbalance');

			$getCashBalanceSaldoHeader = $this->db->query("SELECT * FROM `dms_cas_cashbalancesaldo`
			WHERE szBranchId = '$depo' 
			AND szAccountId = '$szAccountId' AND szSubAccountId = '$szSubAccountId'");
			if ($getCashBalanceSaldoHeader->num_rows() > 0) {
				$getTempBalanceForSaldo = $this->mCashierSettlement->getTempBalanceForSaldo($szAccountId, $szSubAccountId, $depo);
				foreach ($getTempBalanceForSaldo as $data) {
					$debit = floatval($data->decDebit) + floatval($getAmountHeaderIn);
					$amount = floatval($debit) - floatval($data->decCredit);
					$this->db2 = $this->load->database('asa', TRUE);
					$this->db2->query("UPDATE $base.dms_cas_cashbalancesaldo 
					SET decdebit = '$debit',
					decAmount = '$amount',
					szUserUpdatedId = '$user',
					dtmLastUpdated = '$tanggal'
					WHERE szAccountId = '$szAccountId' AND szSubAccountId = '$szSubAccountId'
					AND szBranchId = '$depo'");
				}
			} else if ($getCashBalanceSaldoHeader->num_rows() == 0) {
				$dms_cashbalanceSaldo = array(
					'iId' => $this->uuid->v4(),
					'szBranchId' => $depo,
					'szAccountId' => $szAccountId,
					'szSubAccountId' => $szSubAccountId,
					'decDebit' => $getAmountHeaderIn,
					'decCredit' => '0',
					'decAmount' => floatval($$getAmountHeaderIn),
					'szUserCreatedId' => $user,
					'szUserUpdatedId' => $user,
					'dtmCreated' => $tanggal,
					'dtmLastUpdated' => $tanggal
				);
				$this->mCashierBtu->simpanData($dms_cashbalanceSaldo, $base.'.dms_cas_cashbalancesaldo');
			}

			$getItemDetailIn = $this->mCashierSettlement->getItemDetailIn($getDocId);
			$i = 0;

			foreach ($getItemDetailIn as $data) {
				$szAccountDetail = $data->szAccountId;
				$szSubAccountDetail = $data->szSubAccountId;
				$jumlah = $data->jumlahDetail;
				$description = $data->szDescription;

				$dms_doccashinitem = array(
					'iId' => $this->uuid->v4(),
					'szDocId' => $getNomorVT,
					'intItemNumber' => $i,
					'szAccountId' => $szAccountDetail,
					'szSubAccountId' => $szSubAccountDetail,
					'decAmount' => $jumlah,
					'szDescription' => $description
				);
				$this->mCashierBtu->simpanData($dms_doccashinitem, $base.'.dms_cas_doccashinitem');

				$dms_cashbalancedetail = array(
					'iId' => $this->uuid->v4(),
					'szObjectId' => 'DMSDocCashIn',
					'szDocId' => $getNomorVT,
					'dtmDoc' => $tglFinish,
					'szAccountId' => $szAccountDetail,
					'szSubAccountId' => $szSubAccountDetail,
					'decDebit' => '0',
					'decCredit' => $jumlah,
					'decAmount' => 0 - floatval($jumlah),
					'bVoucher' => '1',
					'szVoucherNo' => '',
					'szBranchId' => $depo,
					'szDescription' => $description,
					'intItemNumber' => $i,
					'szUserCreatedId' => $user,
					'szUserUpdatedId' => $user,
					'dtmCreated' => $tanggal,
					'dtmLastUpdated' => $tanggal,
				);
				$this->mCashierBtu->simpanData($dms_cashbalancedetail, $base.'.dms_cas_cashbalance');

				$getCashBalanceSaldoDetail = $this->db->query("SELECT * FROM $base.`dms_cas_cashbalancesaldo`
				WHERE szBranchId = '$depo' 
				AND szAccountId = '$szAccountDetail' AND szSubAccountId = '$szSubAccountDetail'");

				if ($getCashBalanceSaldoDetail->num_rows() > 0) {
					$getTempBalanceForSaldoDetail = $this->mCashierSettlement->getTempBalanceForSaldoDetail($szAccountDetail, $szSubAccountDetail, $depo);
					foreach ($getTempBalanceForSaldoDetail as $data) {
						$credit = floatval($data->decCredit) + floatval($jumlah);
						$amount = floatval($data->decDebit) - floatval($credit);
						$this->db->query("UPDATE $base.dms_cas_cashbalancesaldo 
						SET decCredit = '$credit',
						decAmount = '$amount',
						szUserUpdatedId = '$user',
						dtmLastUpdated = '$tanggal'
						WHERE szAccountId = '$szAccountDetail' AND szSubAccountId = '$szSubAccountDetail'
						AND szBranchId = '$depo'");
					}
				} else if ($getCashBalanceSaldoDetail->num_rows() == 0) {
					$dms_cashbalanceSaldo = array(
						'iId' => $this->uuid->v4(),
						'szBranchId' => $depo,
						'szAccountId' => $szAccountDetail,
						'szSubAccountId' => $szSubAccountDetail,
						'decDebit' => '0',
						'decCredit' => $jumlah,
						'decAmount' => 0 - floatval($jumlah),
						'szUserCreatedId' => $user,
						'szUserUpdatedId' => $user,
						'dtmCreated' => $tanggal,
						'dtmLastUpdated' => $tanggal
					);
					$this->mCashierBtu->simpanData($dms_cashbalanceSaldo, $base.'.dms_cas_cashbalancesaldo');
				}
				$i++;
			}

			$this->db->query("UPDATE $base.dms_cas_cashtempbalance SET bVoucher = '1',szVoucherNo = '$getNomorVT'
			 WHERE szDocId IN ($getDocId) AND szObjectId = 'DMSDocCashTempIn'
			 AND dtmDoc = '$tglFinish'");

			array_push($noVoucherBayar, array(
				$getNomorVT
			));
			$updateLastCounter = $this->mCashierSettlement->getNomorVT_ori();
			$this->db->query("UPDATE $base.dms_sm_counter SET intLastCounter = '$updateLastCounter',
			szUserUpdatedId = '$user',
			dtmLastUpdated = '$tanggal'
			WHERE szId = 'VT" . $depo . "COU'");
		}
	}
}
