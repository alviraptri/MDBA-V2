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

		if ($depo == '321' || $depo == '324' || $depo == '336') {
			$dept = 'ASA';
		} else {
			$dept = 'TVIP';
		}

		$this->simpanVb($tglStart, $tglFinish, $depo, $dept);
		$this->simpanVt($tglStart, $tglFinish, $depo, $dept);

		// $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
		// header('Location: ' . base_url('home'));
		// exit;
	}

	function simpanVb($tglStart, $tglFinish, $depo, $dept)
	{
		if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
			$base = 'mdbaasa';
		} else {
			$base = 'mdbatvip';
		}

		// NO ADJUSTMENT
		$vbId = 'VB' . $depo . 'COU';
		$vb = $this->mCashierSettlement->getId($vbId);

		$getVbHeader = $this->mCashierSettlement->getVbHeader($tglStart, $tglFinish, $depo);

		$no = 0;
		foreach ($getVbHeader as $key) {
			$headerOut = array(
				'iId' => $this->uuid->v4(),
				'szDocId' => $vb,
				'dtmDoc' => date('Y-m-d'),
				'szEmployeeId' => $this->session->userdata('user_nik'),
				'szAccountId' => $key->szAccountId,
				'szSubAccountId' => $key->szSubAccountId,
				'decAmountControl' => '0',
				'intPrintedCount' => '0',
				'szBranchId' => $depo,
				'szCompanyId' => $dept,
				'szDocStatus' => 'Applied',
				'szUserCreatedId' => $this->session->userdata('user_nik'),
				'szUserUpdatedId' => $this->session->userdata('user_nik'),
				'dtmCreated' => date('Y-m-d H:i:s'),
				'dtmLastUpdated' => date('Y-m-d H:i:s'),
			);
			// $this->mCashierSettlement->simpanData($headerOut, $base . '.dms_cas_doccashout');
			// $this->mCashierSettlement->simpanDms($headerOut, 'dmstesting.dms_cas_doccashout');
			// echo "<pre> VB HEADER : " . var_export($headerOut, true) . "</pre>";

			$headerBalance = array(
				'iId' => $this->uuid->v4(),
				'szObjectId' => 'DMSDocCashOut',
				'szDocId' => $vb,
				'dtmDoc' => date('Y-m-d'),
				'szAccountId' => $key->szAccountId,
				'szSubAccountId' => $key->szSubAccountId,
				'decDebit' => '0.0000',
				'decCredit' => $key->total,
				'decAmount' => 0 - $key->total,
				'bVoucher' => '1',
				'szVoucherNo' => '',
				'szBranchId' => $depo,
				'szDescription' => '',
				'intItemNumber' => '-1',
				'szUserCreatedId' => $this->session->userdata('user_nik'),
				'szUserUpdatedId' => $this->session->userdata('user_nik'),
				'dtmCreated' => date('Y-m-d H:i:s'),
				'dtmLastUpdated' => date('Y-m-d H:i:s'),
			);
			// $this->mCashierSettlement->simpanData($headerBalance, $base . '.dms_cas_cashbalance');
			// $this->mCashierSettlement->simpanDms($headerBalance, 'dmstesting.dms_cas_cashbalance');

			$headTempBalance = array(
				'bVoucher' => '1',
				'szVoucherNo' => $vb
			);
			$whereHeadTempBalance = array(
				'szDocId' => $key->szDocId,
				'szObjectId' => 'DMSDocCashTempOut'
			);
			// $this->mCashierSettlement->updateData($whereHeadTempBalance, $headTempBalance, $base . '.dms_cas_cashtempbalance');
			// $this->mCashierSettlement->updateDms($whereHeadTempBalance, $headTempBalance, 'dmstesting.dms_cas_cashtempbalance');

			$getVbDetail = $this->mCashierSettlement->getVbDetail($depo, $key->szAccountId, $key->szSubAccountId, $tglStart, $tglFinish);
			$num = 0;
			foreach ($getVbDetail as $row) {
				if ($row->headAccount == $key->szAccountId) {
					$detailOut = array(
						'iId' => $this->uuid->v4(),
						'szDocId' => $vb,
						'intItemNumber' => $num,
						'szAccountId' => $row->szAccountId,
						'szSubAccountId' => $row->szSubAccountId,
						'decAmount' => $row->jumlahDetail,
						'szDescription' => $row->szDescription,
					);
					// $this->mCashierSettlement->simpanData($detailOut, $base . '.dms_cas_doccashoutitem');
					// $this->mCashierSettlement->simpanDms($detailOut, 'dmstesting.dms_cas_doccashoutitem');

					$detailBalance = array(
						'iId' => $this->uuid->v4(),
						'szObjectId' => 'DMSDocCashOut',
						'szDocId' => $vb,
						'dtmDoc' => date('Y-m-d'),
						'szAccountId' => $row->szAccountId,
						'szSubAccountId' => $row->szSubAccountId,
						'decDebit' => $row->jumlahDetail,
						'decCredit' => '0.0000',
						'decAmount' => $row->jumlahDetail - 0,
						'bVoucher' => '1',
						'szVoucherNo' => '',
						'szBranchId' => $depo,
						'szDescription' => '',
						'intItemNumber' => '-1',
						'szUserCreatedId' => $this->session->userdata('user_nik'),
						'szUserUpdatedId' => $this->session->userdata('user_nik'),
						'dtmCreated' => date('Y-m-d H:i:s'),
						'dtmLastUpdated' => date('Y-m-d H:i:s'),
					);
					// $this->mCashierSettlement->simpanData($detailBalance, $base . '.dms_cas_cashbalance');
					// $this->mCashierSettlement->simpanDms($detailBalance, 'dmstesting.dms_cas_cashbalance');

					$detTempBalance = array(
						'bVoucher' => '1',
						'szVoucherNo' => $vb
					);
					$whereDetTempBalance = array(
						'szDocId' => $row->szDocId,
						'szObjectId' => 'DMSDocCashTempOut'
					);
					// $this->mCashierSettlement->updateData($whereDetTempBalance, $detTempBalance, $base . '.dms_cas_cashtempbalance');
					// $this->mCashierSettlement->updateDms($whereDetTempBalance, $detTempBalance, 'dmstesting.dms_cas_cashtempbalance');

					echo "<pre> VB DETAIL : " . var_export($detailOut, true) . "</pre>";
					echo "<pre> VB DET TEMP : " . var_export($detTempBalance, true) . "</pre>";
					echo "<pre> VB DET TEMP WHERE : " . var_export($whereDetTempBalance, true) . "</pre>";
				}

				$detailSaldo = $this->mCashierSettlement->getSaldo($depo, $row->szAccountId, $row->szSubAccountId);
				if (sizeof($detailSaldo) != '0') {
					foreach ($detailSaldo as $saldo) {
						if ($row->szAccountId == $saldo->szAccountId) {
							$saldoDetail = array(
								'decDebit' => $saldo->decDebit + $row->jumlahDetail,
								'decAmount' => ($saldo->decDebit - $row->jumlahDetail) - $saldo->decCredit,
								'szUserUpdatedId' => $this->session->userdata('user_nik'),
								'dtmLastUpdated' => date('Y-m-d H:i:s')
							);
							$saldoDetailWhere = array(
								'szBranchId' => $depo,
								'szAccountId' => $saldo->szAccountId,
								'szSubAccountId' => $saldo->szSubAccountId
							);
							// $this->mCashierSettlement->updateData($saldoDetailWhere, $saldoDetail, $base . '.dms_cas_cashbalancesaldo');
							// $this->mCashierSettlement->updateDms($saldoDetailWhere, $saldoDetail, 'dmstesting.dms_cas_cashbalancesaldo');
						}
					}
				} else {
					$detSaldo = array(
						'iId' => $this->uuid->v4(),
						'szBranchId' => $depo,
						'szAccountId' => $row->szAccountId,
						'szSubAccountId' => $row->szSubAccountId,
						'decDebit' => '0',
						'decCredit' => 0 - $row->total,
						'decAmount' => 0 - $row->total,
						'szUserCreatedId' => $this->session->userdata('user_nik'),
						'szUserUpdatedId' => $this->session->userdata('user_nik'),
						'dtmCreated' => date('Y-m-d H:i:s'),
						'dtmLastUpdated' => date('Y-m-d H:i:s'),
					);
					// $this->mCashierSettlement->simpanData($detSaldo, $base . '.dms_cas_cashbalancesaldo');
				}
				$num++;
			}

			$headerSaldo = $this->mCashierSettlement->getSaldo($depo, $key->szAccountId, $key->szSubAccountId);
			if (sizeof($headerSaldo) != '0') {
				foreach ($headerSaldo as $value) {
					if ($key->szAccountId == $value->szAccountId) {
						$saldoHeader = array(
							'decCredit' => $value->decCredit + $key->total,
							'decAmount' => $value->decDebit - ($value->decCredit - $key->total),
							'szUserUpdatedId' => $this->session->userdata('user_nik'),
							'dtmLastUpdated' => date('Y-m-d H:i:s')
						);
						$saldoHeaderWhere = array(
							'szBranchId' => $depo,
							'szAccountId' => $value->szAccountId,
							'szSubAccountId' => $value->szSubAccountId
						);
						// $this->mCashierSettlement->updateData($saldoHeaderWhere, $saldoHeader, $base . '.dms_cas_cashbalancesaldo');
						// $this->mCashierSettlement->updateDms($saldoHeaderWhere, $saldoHeader, 'dmstesting.dms_cas_cashbalancesaldo');
					}
				}
			} else {
				$headSaldo = array(
					'iId' => $this->uuid->v4(),
					'szBranchId' => $depo,
					'szAccountId' => $key->szAccountId,
					'szSubAccountId' => $key->szSubAccountId,
					'decDebit' => '0',
					'decCredit' => 0 - $key->total,
					'decAmount' => 0 - $key->total,
					'szUserCreatedId' => $this->session->userdata('user_nik'),
					'szUserUpdatedId' => $this->session->userdata('user_nik'),
					'dtmCreated' => date('Y-m-d H:i:s'),
					'dtmLastUpdated' => date('Y-m-d H:i:s'),
				);
				// $this->mCashierSettlement->simpanData($headSaldo, $base . '.dms_cas_cashbalancesaldo');
			}

			$vb++;
			$no++;
		}

		// update counter
		$vbCounter = $this->mCashierSettlement->getCounter($vbId);
		$updateCountVb = array(
			'intLastCounter' => $vbCounter + $no,
			'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
			'dtmLastUpdated' => date('Y-m-d H:i:s')
		);
		$whereCountVb = array('szId' => $vbId);
		// $this->mCashierSettlement->updateData($whereCountVb, $updateCountVb, $base . '.dms_sm_counter');
		// $this->mCashierSettlement->updateDms($whereCountVb, $updateCountVb, 'dmstesting.dms_sm_counter');
	}

	function simpanVt($tglStart, $tglFinish, $depo, $dept)
	{
		if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
			$base = 'mdbaasa';
		} else {
			$base = 'mdbatvip';
		}

		// NO ADJUSTMENT
		$vtId = 'VT' . $depo . 'COU';
		$vt = $this->mCashierSettlement->getId($vtId);

		$getVtHeader = $this->mCashierSettlement->getVtHeader($tglStart, $tglFinish, $depo);

		$no = 0;
		foreach ($getVtHeader as $key) {
			$headerOut = array(
				'iId' => $this->uuid->v4(),
				'szDocId' => $vt,
				'dtmDoc' => date('Y-m-d'),
				'szEmployeeId' => $this->session->userdata('user_nik'),
				'szAccountId' => $key->szAccountId,
				'szSubAccountId' => $key->szSubAccountId,
				'decAmountControl' => '0',
				'intPrintedCount' => '0',
				'szBranchId' => $depo,
				'szCompanyId' => $dept,
				'szDocStatus' => 'Applied',
				'szUserCreatedId' => $this->session->userdata('user_nik'),
				'szUserUpdatedId' => $this->session->userdata('user_nik'),
				'dtmCreated' => date('Y-m-d H:i:s'),
				'dtmLastUpdated' => date('Y-m-d H:i:s'),
			);
			// $this->mCashierSettlement->simpanData($headerOut, $base . '.dms_cas_doccashin');
			// $this->mCashierSettlement->simpanDms($headerOut, 'dmstesting.dms_cas_doccashin');
			// echo "<pre> VB HEADER : " . var_export($headerOut, true) . "</pre>";

			$headerBalance = array(
				'iId' => $this->uuid->v4(),
				'szObjectId' => 'DMSDocCashOut',
				'szDocId' => $vt,
				'dtmDoc' => date('Y-m-d'),
				'szAccountId' => $key->szAccountId,
				'szSubAccountId' => $key->szSubAccountId,
				'decDebit' => '0.0000',
				'decCredit' => $key->total,
				'decAmount' => 0 - $key->total,
				'bVoucher' => '1',
				'szVoucherNo' => '',
				'szBranchId' => $depo,
				'szDescription' => '',
				'intItemNumber' => '-1',
				'szUserCreatedId' => $this->session->userdata('user_nik'),
				'szUserUpdatedId' => $this->session->userdata('user_nik'),
				'dtmCreated' => date('Y-m-d H:i:s'),
				'dtmLastUpdated' => date('Y-m-d H:i:s'),
			);
			// $this->mCashierSettlement->simpanData($headerBalance, $base . '.dms_cas_cashbalance');
			// $this->mCashierSettlement->simpanDms($headerBalance, 'dmstesting.dms_cas_cashbalance');

			$headTempBalance = array(
				'bVoucher' => '1',
				'szVoucherNo' => $vt
			);
			$whereHeadTempBalance = array(
				'szDocId' => $key->szDocId,
				'szObjectId' => 'DMSDocCashTempIn'
			);
			// $this->mCashierSettlement->updateData($whereHeadTempBalance, $headTempBalance, $base . '.dms_cas_cashtempbalance');
			// $this->mCashierSettlement->updateDms($whereHeadTempBalance, $headTempBalance, 'dmstesting.dms_cas_cashtempbalance');

			$getVtDetail = $this->mCashierSettlement->getVtDetail($depo, $key->szAccountId, $key->szSubAccountId, $tglStart, $tglFinish);
			$num = 0;
			foreach ($getVtDetail as $row) {
				if ($row->headAccount == $key->szAccountId) {
					$detailOut = array(
						'iId' => $this->uuid->v4(),
						'szDocId' => $vt,
						'intItemNumber' => $num,
						'szAccountId' => $row->szAccountId,
						'szSubAccountId' => $row->szSubAccountId,
						'decAmount' => $row->jumlahDetail,
						'szDescription' => $row->szDescription,
					);
					// $this->mCashierSettlement->simpanData($detailOut, $base . '.dms_cas_doccashinitem');
					// $this->mCashierSettlement->simpanDms($detailOut, 'dmstesting.dms_cas_doccashinitem');

					$detailBalance = array(
						'iId' => $this->uuid->v4(),
						'szObjectId' => 'DMSDocCashOut',
						'szDocId' => $vt,
						'dtmDoc' => date('Y-m-d'),
						'szAccountId' => $row->szAccountId,
						'szSubAccountId' => $row->szSubAccountId,
						'decDebit' => $row->jumlahDetail,
						'decCredit' => '0.0000',
						'decAmount' => $row->jumlahDetail - 0,
						'bVoucher' => '1',
						'szVoucherNo' => '',
						'szBranchId' => $depo,
						'szDescription' => '',
						'intItemNumber' => '-1',
						'szUserCreatedId' => $this->session->userdata('user_nik'),
						'szUserUpdatedId' => $this->session->userdata('user_nik'),
						'dtmCreated' => date('Y-m-d H:i:s'),
						'dtmLastUpdated' => date('Y-m-d H:i:s'),
					);
					// $this->mCashierSettlement->simpanData($detailBalance, $base . '.dms_cas_cashbalance');
					// $this->mCashierSettlement->simpanDms($detailBalance, 'dmstesting.dms_cas_cashbalance');

					$detTempBalance = array(
						'bVoucher' => '1',
						'szVoucherNo' => $vt
					);
					$whereDetTempBalance = array(
						'szDocId' => $row->szDocId,
						'szObjectId' => 'DMSDocCashTempOut'
					);
					// $this->mCashierSettlement->updateData($whereDetTempBalance, $detTempBalance, $base . '.dms_cas_cashtempbalance');
					// $this->mCashierSettlement->updateDms($whereDetTempBalance, $detTempBalance, 'dmstesting.dms_cas_cashtempbalance');

					echo "<pre> VB DETAIL : " . var_export($detailOut, true) . "</pre>";
					echo "<pre> VB DET TEMP : " . var_export($detTempBalance, true) . "</pre>";
					echo "<pre> VB DET TEMP WHERE : " . var_export($whereDetTempBalance, true) . "</pre>";
				}

				$detailSaldo = $this->mCashierSettlement->getSaldo($depo, $row->szAccountId, $row->szSubAccountId);
				if (sizeof($detailSaldo) != '0') {
					foreach ($detailSaldo as $saldo) {
						if ($row->szAccountId == $saldo->szAccountId) {
							$saldoDetail = array(
								'decDebit' => $saldo->decDebit + $row->jumlahDetail,
								'decAmount' => ($saldo->decDebit - $row->jumlahDetail) - $saldo->decCredit,
								'szUserUpdatedId' => $this->session->userdata('user_nik'),
								'dtmLastUpdated' => date('Y-m-d H:i:s')
							);
							$saldoDetailWhere = array(
								'szBranchId' => $depo,
								'szAccountId' => $saldo->szAccountId,
								'szSubAccountId' => $saldo->szSubAccountId
							);
							// $this->mCashierSettlement->updateData($saldoDetailWhere, $saldoDetail, $base . '.dms_cas_cashbalancesaldo');
							// $this->mCashierSettlement->updateDms($saldoDetailWhere, $saldoDetail, 'dmstesting.dms_cas_cashbalancesaldo');
						}
					}
				} else {
					$detSaldo = array(
						'iId' => $this->uuid->v4(),
						'szBranchId' => $depo,
						'szAccountId' => $row->szAccountId,
						'szSubAccountId' => $row->szSubAccountId,
						'decDebit' => '0',
						'decCredit' => 0 - $row->total,
						'decAmount' => 0 - $row->total,
						'szUserCreatedId' => $this->session->userdata('user_nik'),
						'szUserUpdatedId' => $this->session->userdata('user_nik'),
						'dtmCreated' => date('Y-m-d H:i:s'),
						'dtmLastUpdated' => date('Y-m-d H:i:s'),
					);
					// $this->mCashierSettlement->simpanData($detSaldo, $base . '.dms_cas_cashbalancesaldo');
				}
				$num++;
			}

			$headerSaldo = $this->mCashierSettlement->getSaldo($depo, $key->szAccountId, $key->szSubAccountId);
			if (sizeof($headerSaldo) != '0') {
				foreach ($headerSaldo as $value) {
					if ($key->szAccountId == $value->szAccountId) {
						$saldoHeader = array(
							'decCredit' => $value->decCredit + $key->total,
							'decAmount' => $value->decDebit - ($value->decCredit - $key->total),
							'szUserUpdatedId' => $this->session->userdata('user_nik'),
							'dtmLastUpdated' => date('Y-m-d H:i:s')
						);
						$saldoHeaderWhere = array(
							'szBranchId' => $depo,
							'szAccountId' => $value->szAccountId,
							'szSubAccountId' => $value->szSubAccountId
						);
						// $this->mCashierSettlement->updateData($saldoHeaderWhere, $saldoHeader, $base . '.dms_cas_cashbalancesaldo');
						// $this->mCashierSettlement->updateDms($saldoHeaderWhere, $saldoHeader, 'dmstesting.dms_cas_cashbalancesaldo');
					}
				}
			} else {
				$headSaldo = array(
					'iId' => $this->uuid->v4(),
					'szBranchId' => $depo,
					'szAccountId' => $key->szAccountId,
					'szSubAccountId' => $key->szSubAccountId,
					'decDebit' => '0',
					'decCredit' => 0 - $key->total,
					'decAmount' => 0 - $key->total,
					'szUserCreatedId' => $this->session->userdata('user_nik'),
					'szUserUpdatedId' => $this->session->userdata('user_nik'),
					'dtmCreated' => date('Y-m-d H:i:s'),
					'dtmLastUpdated' => date('Y-m-d H:i:s'),
				);
				// $this->mCashierSettlement->simpanData($headSaldo, $base . '.dms_cas_cashbalancesaldo');
			}

			$vt++;
			$no++;
		}

		// update counter
		$vtCounter = $this->mCashierSettlement->getCounter($vtId);
		$updateCountVt = array(
			'intLastCounter' => $vtCounter + $no,
			'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
			'dtmLastUpdated' => date('Y-m-d H:i:s')
		);
		$whereCountVb = array('szId' => $vtId);
		// $this->mCashierSettlement->updateData($whereCountVb, $updateCountVb, $base . '.dms_sm_counter');
		// $this->mCashierSettlement->updateDms($whereCountVb, $updateCountVb, 'dmstesting.dms_sm_counter');
	}

	// function simpanVt($tglStart, $tglFinish, $depo, $user, $tanggal, $dept)
	// {
	// 	if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
	// 		$base = 'mdbaasa';
	// 	} else {
	// 		$base = 'mdbatvip';
	// 	}
	// 	$dms_doccashin = [];
	// 	$dms_doccashinitem = [];
	// 	$dms_cashbalanceheader = [];
	// 	$dms_cashbalancedetail = [];
	// 	$dms_cashbalanceSaldo = [];
	// 	$noVoucherBayar = [];

	// 	$getArrayBTU = $this->mCashierSettlement->getArrayBTU($tglStart, $tglFinish, $depo);

	// 	foreach ($getArrayBTU as $v) {
	// 		$szAccountId = $v->szAccountId;
	// 		$szSubAccountId = $v->szSubAccountId;
	// 		$getDocId = $this->mCashierSettlement->getDocIdIn($szAccountId, $tglStart, $tglFinish, $depo);
	// 		$getNomorVT = $this->mCashierSettlement->getNomorVT();

	// 		$dms_doccashin = array(
	// 			'iId' => $this->uuid->v4(),
	// 			'szDocId' => $getNomorVT,
	// 			'dtmDoc' => $tglFinish,
	// 			'szEmployeeId' => $user,
	// 			'szAccountId' => $szAccountId,
	// 			'szSubAccountId' => $szSubAccountId,
	// 			'decAmountControl' => '0',
	// 			'intPrintedCount' => '0',
	// 			'szBranchId' => $depo,
	// 			'szCompanyId' =>  $dept,
	// 			'szDocStatus' => 'Applied',
	// 			'szUserCreatedId' => $user,
	// 			'szUserUpdatedId' => $user,
	// 			'dtmCreated' => $tanggal,
	// 			'dtmLastUpdated' => $tanggal,
	// 		);
	// 		$this->mCashierBtu->simpanData($dms_doccashin, $base . '.dms_cas_doccashin');

	// 		$getAmountHeaderIn = $this->mCashierSettlement->getAmountHeaderIn($getDocId);
	// 		$dms_cashbalanceheader = array(
	// 			'iId' => $this->uuid->v4(),
	// 			'szObjectId' => 'DMSDocCashIn',
	// 			'szDocId' => $getNomorVT,
	// 			'dtmDoc' => $$tglFinish,
	// 			'szAccountId' => $szAccountId,
	// 			'szSubAccountId' => $szSubAccountId,
	// 			'decDebit' => $getAmountHeaderIn,
	// 			'decCredit' => '0',
	// 			'decAmount' => floatval($getAmountHeaderIn),
	// 			'bVoucher' => '1',
	// 			'szVoucherNo' => '',
	// 			'szBranchId' => $depo,
	// 			'szDescription' => '',
	// 			'intItemNumber' => '-1',
	// 			'szUserCreatedId' => $user,
	// 			'szUserUpdatedId' => $user,
	// 			'dtmCreated' => $tanggal,
	// 			'dtmLastUpdated' => $tanggal,
	// 		);
	// 		$this->mCashierBtu->simpanData($dms_cashbalanceheader, $base . '.dms_cas_cashbalance');

	// 		$getCashBalanceSaldoHeader = $this->db->query("SELECT * FROM `dms_cas_cashbalancesaldo`
	// 		WHERE szBranchId = '$depo' 
	// 		AND szAccountId = '$szAccountId' AND szSubAccountId = '$szSubAccountId'");
	// 		if ($getCashBalanceSaldoHeader->num_rows() > 0) {
	// 			$getTempBalanceForSaldo = $this->mCashierSettlement->getTempBalanceForSaldo($szAccountId, $szSubAccountId, $depo);
	// 			foreach ($getTempBalanceForSaldo as $data) {
	// 				$debit = floatval($data->decDebit) + floatval($getAmountHeaderIn);
	// 				$amount = floatval($debit) - floatval($data->decCredit);
	// 				$this->db2 = $this->load->database('asa', TRUE);
	// 				$this->db2->query("UPDATE $base.dms_cas_cashbalancesaldo 
	// 				SET decdebit = '$debit',
	// 				decAmount = '$amount',
	// 				szUserUpdatedId = '$user',
	// 				dtmLastUpdated = '$tanggal'
	// 				WHERE szAccountId = '$szAccountId' AND szSubAccountId = '$szSubAccountId'
	// 				AND szBranchId = '$depo'");
	// 			}
	// 		} else if ($getCashBalanceSaldoHeader->num_rows() == 0) {
	// 			$dms_cashbalanceSaldo = array(
	// 				'iId' => $this->uuid->v4(),
	// 				'szBranchId' => $depo,
	// 				'szAccountId' => $szAccountId,
	// 				'szSubAccountId' => $szSubAccountId,
	// 				'decDebit' => $getAmountHeaderIn,
	// 				'decCredit' => '0',
	// 				'decAmount' => floatval($$getAmountHeaderIn),
	// 				'szUserCreatedId' => $user,
	// 				'szUserUpdatedId' => $user,
	// 				'dtmCreated' => $tanggal,
	// 				'dtmLastUpdated' => $tanggal
	// 			);
	// 			$this->mCashierBtu->simpanData($dms_cashbalanceSaldo, $base . '.dms_cas_cashbalancesaldo');
	// 		}

	// 		$getItemDetailIn = $this->mCashierSettlement->getItemDetailIn($getDocId);
	// 		$i = 0;

	// 		foreach ($getItemDetailIn as $data) {
	// 			$szAccountDetail = $data->szAccountId;
	// 			$szSubAccountDetail = $data->szSubAccountId;
	// 			$jumlah = $data->jumlahDetail;
	// 			$description = $data->szDescription;

	// 			$dms_doccashinitem = array(
	// 				'iId' => $this->uuid->v4(),
	// 				'szDocId' => $getNomorVT,
	// 				'intItemNumber' => $i,
	// 				'szAccountId' => $szAccountDetail,
	// 				'szSubAccountId' => $szSubAccountDetail,
	// 				'decAmount' => $jumlah,
	// 				'szDescription' => $description
	// 			);
	// 			$this->mCashierBtu->simpanData($dms_doccashinitem, $base . '.dms_cas_doccashinitem');

	// 			$dms_cashbalancedetail = array(
	// 				'iId' => $this->uuid->v4(),
	// 				'szObjectId' => 'DMSDocCashIn',
	// 				'szDocId' => $getNomorVT,
	// 				'dtmDoc' => $tglFinish,
	// 				'szAccountId' => $szAccountDetail,
	// 				'szSubAccountId' => $szSubAccountDetail,
	// 				'decDebit' => '0',
	// 				'decCredit' => $jumlah,
	// 				'decAmount' => 0 - floatval($jumlah),
	// 				'bVoucher' => '1',
	// 				'szVoucherNo' => '',
	// 				'szBranchId' => $depo,
	// 				'szDescription' => $description,
	// 				'intItemNumber' => $i,
	// 				'szUserCreatedId' => $user,
	// 				'szUserUpdatedId' => $user,
	// 				'dtmCreated' => $tanggal,
	// 				'dtmLastUpdated' => $tanggal,
	// 			);
	// 			$this->mCashierBtu->simpanData($dms_cashbalancedetail, $base . '.dms_cas_cashbalance');

	// 			$getCashBalanceSaldoDetail = $this->db->query("SELECT * FROM $base.`dms_cas_cashbalancesaldo`
	// 			WHERE szBranchId = '$depo' 
	// 			AND szAccountId = '$szAccountDetail' AND szSubAccountId = '$szSubAccountDetail'");

	// 			if ($getCashBalanceSaldoDetail->num_rows() > 0) {
	// 				$getTempBalanceForSaldoDetail = $this->mCashierSettlement->getTempBalanceForSaldoDetail($szAccountDetail, $szSubAccountDetail, $depo);
	// 				foreach ($getTempBalanceForSaldoDetail as $data) {
	// 					$credit = floatval($data->decCredit) + floatval($jumlah);
	// 					$amount = floatval($data->decDebit) - floatval($credit);
	// 					$this->db->query("UPDATE $base.dms_cas_cashbalancesaldo 
	// 					SET decCredit = '$credit',
	// 					decAmount = '$amount',
	// 					szUserUpdatedId = '$user',
	// 					dtmLastUpdated = '$tanggal'
	// 					WHERE szAccountId = '$szAccountDetail' AND szSubAccountId = '$szSubAccountDetail'
	// 					AND szBranchId = '$depo'");
	// 				}
	// 			} else if ($getCashBalanceSaldoDetail->num_rows() == 0) {
	// 				$dms_cashbalanceSaldo = array(
	// 					'iId' => $this->uuid->v4(),
	// 					'szBranchId' => $depo,
	// 					'szAccountId' => $szAccountDetail,
	// 					'szSubAccountId' => $szSubAccountDetail,
	// 					'decDebit' => '0',
	// 					'decCredit' => $jumlah,
	// 					'decAmount' => 0 - floatval($jumlah),
	// 					'szUserCreatedId' => $user,
	// 					'szUserUpdatedId' => $user,
	// 					'dtmCreated' => $tanggal,
	// 					'dtmLastUpdated' => $tanggal
	// 				);
	// 				$this->mCashierBtu->simpanData($dms_cashbalanceSaldo, $base . '.dms_cas_cashbalancesaldo');
	// 			}
	// 			$i++;
	// 		}

	// 		$this->db->query("UPDATE $base.dms_cas_cashtempbalance SET bVoucher = '1',szVoucherNo = '$getNomorVT'
	// 		 WHERE szDocId IN ($getDocId) AND szObjectId = 'DMSDocCashTempIn'
	// 		 AND dtmDoc = '$tglFinish'");

	// 		array_push($noVoucherBayar, array(
	// 			$getNomorVT
	// 		));
	// 		$updateLastCounter = $this->mCashierSettlement->getNomorVT_ori();
	// 		$this->db->query("UPDATE $base.dms_sm_counter SET intLastCounter = '$updateLastCounter',
	// 		szUserUpdatedId = '$user',
	// 		dtmLastUpdated = '$tanggal'
	// 		WHERE szId = 'VT" . $depo . "COU'");
	// 	}
	// }
}
