<?php
class cashierAuto extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_logged')=='')
		{
			redirect('login');
		}
        $this->load->model(array('mHome', 'mcashierBku', 'mCashierBtu', 'mCashierAuto'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    function autoSimpan($id)
    {
        $data = explode("-",$id);
        $txId = $data[0];
        $operator = $data[1];

        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');

        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $namedept = 'ASA';
        } else {
            $namedept = 'TVIP';
        }

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }

        $id = 'BTU' . $depo . 'COU';
        $btu = $this->mCashierBtu->getId($id);
        //counter
        $counter = $this->mCashierBtu->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mCashierBtu->updateData($whereCount, $updateCount, $base.'.dms_sm_counter');

        $transfer = $this->mCashierAuto->getDataTransfer($txId, $operator, $depo, $tanggal);
        foreach ($transfer as $value) {
            $statusAuto = array('staggingStatus' => '1');
            $whereAuto = array(
                'driverNik' => $value->driverNik,
                'driverMesinId' => $value->driverMesinId,
                'staggingLoc' => $value->staggingLoc,
                'staggingTx' => $value->staggingTx
            );
            $statusUpdate = $this->mCashierBtu->updateData($whereAuto, $statusAuto, $base.'.mdbaautostagging');

            $btuHeader = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $btu,
                'dtmDoc' => $tanggal,
                'szEmployeeId' => $value->kode_driver,
                'szAccountId' => $value->bankAcc,
                'szSubAccountId' => '99999999',
                'decAmountControl' => substr($value->staggingAmount,0,-2),
                'intPrintedCount' => '0',
                'szBranchId' => $depo,
                'szCompanyId' => $namedept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $headerBtu = $this->mCashierBtu->simpanData($btuHeader, $base.'.dms_cas_doccashtempin');

            $balanceHeader = array(
                'iId' => $this->uuid->v4(),
                'szObjectId' => 'DMSDocCashTempIn',
                'szDocId' => $btu,
                'dtmDoc' => $tanggal,
                'szAccountId' => $value->bankAcc,
                'szSubAccountId' => '99999999',
                'decDebit' => substr($value->staggingAmount,0,-2),
                'decCredit' => '0',
                'decAmount' => substr($value->staggingAmount,0,-2),
                'bVoucher' => '0',
                'szVoucherNo' => '',
                'szBranchId' => $depo,
                'szDescription' => '',
                'intItemNumber' => '-1',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $headerBalance = $this->mCashierBtu->simpanData($balanceHeader, $base.'.dms_cas_cashtempbalance');

            $btuDetail = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $btu,
                'intItemNumber' => '0',
                'szAccountId' => '100401',
                'szSubAccountId' => '99999999',
                'decAmount' => substr($value->staggingAmount,0,-2),
                'szDescription' => $value->nopol.', RIT'.$value->rit_driver.', TXID = '.$value->txId
            );
            $detailBtu = $this->mCashierBtu->simpanData($btuDetail, $base.'.dms_cas_doccashtempinitem');

            $balanceDetail = array(
                'iId' => $this->uuid->v4(),
                'szObjectId' => 'DMSDocCashTempIn',
                'szDocId' => $btu,
                'dtmDoc' => $tanggal,
                'szAccountId' => '100401',
                'szSubAccountId' => '99999999',
                'decDebit' => '0',
                'decCredit' => substr($value->staggingAmount,0,-2),
                'decAmount' => -substr($value->staggingAmount,0,-2),
                'bVoucher' => '0',
                'szVoucherNo' => '',
                'szBranchId' => $depo,
                'szDescription' => $value->nopol.', RIT'.$value->rit_driver.', TXID = '.$value->txId,
                'intItemNumber' => '0',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $detailBalance = $this->mCashierBtu->simpanData($balanceDetail, $base.'.dms_cas_cashtempbalance');

            $akunBank = $value->bankAcc;
            $jmlhUang = substr($value->staggingAmount,0,-2);
        }

        $headerSaldoAcc = "'".$akunBank."'";
        $headerSaldoSub = "'99999999'";
        $getSaldoHead = $this->mCashierBtu->getSaldo($headerSaldoAcc, $headerSaldoSub, $depo);
        foreach ($getSaldoHead as $value) {
            $saldoHead = array(
                'decDebit' => $value->decDebit + $jmlhUang,
                'decAmount' => ($value->decDebit + $jmlhUang) - $value->decCredit,
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );

            $whereSaldoHead = array(
                'szBranchId' => $depo, 
                'szAccountId' => $akunBank,
                'szSubAccountId' => '99999999'
            );
            $updSaldoHead = $this->mCashierBtu->updateData($whereSaldoHead, $saldoHead, $base.'.dms_cas_cashtempbalancesaldo');
        }

        $akunSum = "'100401'";
        $subSum = "'99999999'";

        $getSaldoDet = $this->mCashierBtu->getSaldo($akunSum, $subSum, $depo);
        foreach ($getSaldoDet as $value) {
            $saldoDet = array(
                'decCredit' => $value->decCredit + $jmlhUang,
                'decAmount' => $value->decDebit - ($value->decCredit + $jmlhUang),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );

            $whereSaldoDet = array(
                'szBranchId' => $depo, 
                'szAccountId' => '100401',
                'szSubAccountId' => '99999999'
            );
            echo "<pre>".var_export($saldoDet, true)."</pre>";
            $updSaldoDet = $this->mCashierBtu->updateData($whereSaldoDet, $saldoDet, $base.'.dms_cas_cashtempbalancesaldo');
        }

        if ($counterUpdate == 'true' && $headerBtu == 'true' && $headerBalance == 'true' && $updSaldoHead == 'true' && $detailBtu == 'true' && $detailBalance == 'true' && $updSaldoDet == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/cashierAuto'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('home/cashierAuto'));
            exit;
        }
    }

    function autoSimpanManual()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $check = $this->input->post('check');
        $mesinId = $this->input->post('operator');

        $idTx = '';
        $idMesin = '';
        for ($i=0; $i < count($check); $i++) { 
            $idTx .= "'" . $check[$i] . "',";
            $idMesin .= "'" . $mesinId[$i] . "',";
        }
        $lenTx = strlen($idTx);
        $txId = substr($idTx, 0, $lenTx - 1);

        $lenMsn = strlen($idMesin);
        $operator = substr($idMesin, 0, $lenMsn - 1);

        $depo = $this->session->userdata('user_branch');
        $tanggal = '2021-12-25'; //date('Y-m-d');

        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $namedept = 'ASA';
        } else {
            $namedept = 'TVIP';
        }

        $id = 'BTU' . $depo . 'COU';
        $btu = $this->mCashierBtu->getId($id);
        //counter
        $counter = $this->mCashierBtu->getCounter($id);
        $count = $counter + (count($check)-1);
        $updateCount = array('intLastCounter' => $count);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mCashierBtu->updateData($whereCount, $updateCount, $base.'.dms_sm_counter');

        $transfer = $this->mCashierAuto->getDataManual($txId, $operator, $depo, $tanggal);
        $jmlhUang = 0;
        foreach ($transfer as $value) {
            $statusAuto = array('staggingStatus' => '1');
            $whereAuto = array(
                'driverNik' => $value->driverNik,
                'driverMesinId' => $value->driverMesinId,
                'staggingLoc' => $value->staggingLoc,
                'staggingTx' => $value->staggingTx
            );
            $statusUpdate = $this->mCashierBtu->updateData($whereAuto, $statusAuto, $base.'.mdbaautostagging');

            $btuHeader = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $btu,
                'dtmDoc' => $tanggal,
                'szEmployeeId' => $value->kode_driver,
                'szAccountId' => $value->bankAcc,
                'szSubAccountId' => '99999999',
                'decAmountControl' => substr($value->staggingAmount,0,-2),
                'intPrintedCount' => '0',
                'szBranchId' => $depo,
                'szCompanyId' => $namedept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $headerBtu = $this->mCashierBtu->simpanData($btuHeader, $base.'.dms_cas_doccashtempin');

            $balanceHeader = array(
                'iId' => $this->uuid->v4(),
                'szObjectId' => 'DMSDocCashTempIn',
                'szDocId' => $btu,
                'dtmDoc' => $tanggal,
                'szAccountId' => $value->bankAcc,
                'szSubAccountId' => '99999999',
                'decDebit' => substr($value->staggingAmount,0,-2),
                'decCredit' => '0',
                'decAmount' => substr($value->staggingAmount,0,-2),
                'bVoucher' => '0',
                'szVoucherNo' => '',
                'szBranchId' => $depo,
                'szDescription' => '',
                'intItemNumber' => '-1',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $headerBalance = $this->mCashierBtu->simpanData($balanceHeader, $base.'.dms_cas_cashtempbalance');

            $btuDetail = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $btu,
                'intItemNumber' => '0',
                'szAccountId' => '100401',
                'szSubAccountId' => '99999999',
                'decAmount' => substr($value->staggingAmount,0,-2),
                'szDescription' => $value->nopol.', RIT'.$value->rit_driver.', TXID = '.$value->txId
            );
            $detailBtu = $this->mCashierBtu->simpanData($btuDetail, $base.'.dms_cas_doccashtempinitem');

            $balanceDetail = array(
                'iId' => $this->uuid->v4(),
                'szObjectId' => 'DMSDocCashTempIn',
                'szDocId' => $btu,
                'dtmDoc' => $tanggal,
                'szAccountId' => '100401',
                'szSubAccountId' => '99999999',
                'decDebit' => '0',
                'decCredit' => substr($value->staggingAmount,0,-2),
                'decAmount' => -substr($value->staggingAmount,0,-2),
                'bVoucher' => '0',
                'szVoucherNo' => '',
                'szBranchId' => $depo,
                'szDescription' => $value->nopol.', RIT'.$value->rit_driver.', TXID = '.$value->txId,
                'intItemNumber' => '0',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $detailBalance = $this->mCashierBtu->simpanData($balanceDetail, $base.'.dms_cas_cashtempbalance');

            $akunBank = $value->bankAcc;
            $jmlhUang += substr($value->staggingAmount,0,-2);
            $btu++;
        }

        $headerSaldoAcc = "'".$akunBank."'";
        $headerSaldoSub = "'99999999'";
        $getSaldoHead = $this->mCashierBtu->getSaldo($headerSaldoAcc, $headerSaldoSub, $depo);
        foreach ($getSaldoHead as $value) {
            $saldoHead = array(
                'decDebit' => $value->decDebit + $jmlhUang,
                'decAmount' => ($value->decDebit + $jmlhUang) - $value->decCredit,
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );

            $whereSaldoHead = array(
                'szBranchId' => $depo, 
                'szAccountId' => $akunBank,
                'szSubAccountId' => '99999999'
            );
            $updSaldoHead = $this->mCashierBtu->updateData($whereSaldoHead, $saldoHead, $base.'.dms_cas_cashtempbalancesaldo');
        }

        $akunSum = "'100401'";
        $subSum = "'99999999'";

        $getSaldoDet = $this->mCashierBtu->getSaldo($akunSum, $subSum, $depo);
        foreach ($getSaldoDet as $value) {
            $saldoDet = array(
                'decCredit' => $value->decCredit + $jmlhUang,
                'decAmount' => $value->decDebit - ($value->decCredit + $jmlhUang),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );

            $whereSaldoDet = array(
                'szBranchId' => $depo, 
                'szAccountId' => '100401',
                'szSubAccountId' => '99999999'
            );
            echo "<pre>".var_export($saldoDet, true)."</pre>";
            $updSaldoDet = $this->mCashierBtu->updateData($whereSaldoDet, $saldoDet, $base.'.dms_cas_cashtempbalancesaldo');
        }

        if ($counterUpdate == 'true' && $headerBtu == 'true' && $headerBalance == 'true' && $updSaldoHead == 'true' && $detailBtu == 'true' && $detailBalance == 'true' && $updSaldoDet == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/cashierAuto'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('home/cashierAuto'));
            exit;
        }
    }
}

?>