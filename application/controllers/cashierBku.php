<?php
class cashierBku extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_logged')=='')
		{
			redirect('login');
		}
        $this->load->model(array('mHome', 'mInventDepot', 'mInventDist', 'mcashierBku', 'mCashierBku'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    //master
    function getAccountName()
    {
        $id = $this->input->post('id');
        $data = $this->mCashierBku->getAccountName($id);
        echo json_encode($data);
    }

    function getSubAccName()
    {
        $id = $this->input->post('id');
        $data = $this->mCashierBku->getSubAccName($id);
        echo json_encode($data);
    }

    //transaction
    function detailBku()
    {
        $id = $this->input->post('id');
        $data = $this->mCashierBku->getDetailBku($id);
        echo json_encode($data);
    }

    function manualBku()
    {
        $depo = $this->session->userdata('user_branch');

        $bku = 'BKU' . $depo . 'COU';
        $data['bku'] = $this->mCashierBku->getId($bku);

        $data['employee'] = $this->mCashierBku->getEmployee($depo);
        $data['account'] = $this->mCashierBku->getAccount();
        $data['subAcc'] = $this->mCashierBku->getSub();

        $this->load->view('vBkuManual', $data);
    }

    function simpanBku()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $depo = $this->session->userdata('user_branch');

        $tgl = $this->input->post('tgl');
        $pengemudi = $this->input->post('pengemudi');
        $akunHead = $this->input->post('akunHead');
        $subHead = $this->input->post('subHead');
        $kontrolJumlah = str_replace(',', '', $this->input->post('kontrolJumlah'));
        $num = $this->input->post('counter');
        $akunDet = $this->input->post('akunDet');
        $subDet = $this->input->post('subDet');
        $nominal = str_replace(',', '', $this->input->post('nominal'));
        $keterangan = $this->input->post('keterangan');

        echo "Keterangan : <pre>".var_export($keterangan, true)."</pre><br>";

        echo $keterangan[0];

        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $namedept = 'ASA';
        } else {
            $namedept = 'TVIP';
        }

        $id = 'BKU' . $depo . 'COU';
        $bku = $this->mCashierBku->getId($id);
        //counter
        $counter = $this->mCashierBku->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mCashierBku->updateData($whereCount, $updateCount, $base.'.dms_sm_counter');
        $counterUpdateDms = $this->mInventDepot->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        $bkuHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $bku,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szAccountId' => $akunHead,
            'szSubAccountId' => $subHead,
            'decAmountControl' => $kontrolJumlah,
            'intPrintedCount' => '0',
            'szBranchId' => $depo,
            'szCompanyId' => $namedept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s')
        );
        $headerBku = $this->mCashierBku->simpanData($bkuHeader, $base.'.dms_cas_doccashtempout');
        $headerBkuDms = $this->mInventDepot->simpanDms($bkuHeader, 'dms.dms_cas_doccashtempout');

        $balanceHeader = array(
            'iId' => $this->uuid->v4(),
            'szObjectId' => 'DMSDocCashTempOut',
            'szDocId' => $bku,
            'dtmDoc' => $tgl,
            'szAccountId' => $akunHead,
            'szSubAccountId' => $subHead,
            'decDebit' => '0',
            'decCredit' => $kontrolJumlah,
            'decAmount' => -$kontrolJumlah,
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
        $headerBalance = $this->mCashierBku->simpanData($balanceHeader, $base.'.dms_cas_cashtempbalance');
        $headerBalanceDms = $this->mInventDepot->simpanDms($balanceHeader, 'dms.dms_cas_cashtempbalance');

        $headerSaldoAcc = "'".$akunHead."'";
        $headerSaldoSub = "'".$subHead."'";
        $getSaldoHead = $this->mcashierBku->getSaldo($headerSaldoAcc, $headerSaldoSub, $depo);
        foreach ($getSaldoHead as $value) {
            $saldoHead = array(
                'decCredit' => $value->decCredit + $kontrolJumlah,
                'decAmount' => $value->decDebit - ($kontrolJumlah + $value->decCredit),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );

            $whereSaldoHead = array(
                'szBranchId' => $depo, 
                'szAccountId' => $akunHead,
                'szSubAccountId' => $subHead
            );
            $updSaldoHead = $this->mcashierBku->updateData($whereSaldoHead, $saldoHead, $base.'.dms_cas_cashtempbalancesaldo');
            $updSaldoHeadDms = $this->minventDepot->updateDms($whereSaldoHead, $saldoHead, 'dms.dms_cas_cashtempbalancesaldo');
        }

        $sumAkun = '';
        $sumSub = '';
        for ($i=0 ; $i < count($akunDet) ; $i++) { 
            $bkuDetail = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $bku,
                'intItemNumber' => $i,
                'szAccountId' => $akunDet[$i],
                'szSubAccountId' => $subDet[$i],
                'decAmount' => $nominal[$i],
                'szDescription' => $keterangan[$i]
            );
            $detailBku = $this->mcashierBku->simpanData($bkuDetail, $base.'.dms_cas_doccashtempoutitem');
            $detailBkuDms = $this->mInventDepot->simpanDms($bkuDetail, 'dms.dms_cas_doccashtempoutitem');

            $balanceDetail = array(
                'iId' => $this->uuid->v4(),
                'szObjectId' => 'DMSDocCashTempOut',
                'szDocId' => $bku,
                'dtmDoc' => $tgl,
                'szAccountId' => $akunDet[$i],
                'szSubAccountId' => $subDet[$i],
                'decDebit' => $nominal[$i],
                'decCredit' => '0',
                'decAmount' => $nominal[$i],
                'bVoucher' => '0',
                'szVoucherNo' => '',
                'szBranchId' => $depo,
                'szDescription' => $keterangan[$i],
                'intItemNumber' => $i,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $detailBalance = $this->mcashierBku->simpanData($balanceDetail, $base.'.dms_cas_cashtempbalance');
            $detailBalanceDms = $this->mInventDepot->simpanDms($balanceDetail, 'dms.dms_cas_cashtempbalance');

            $sumAkun .= "'" . $akunDet[$i] . "',";
            $sumSub .= "'" . $subDet[$i] . "',";
        }
        $lenAkun = strlen($sumAkun);
        $akunSum = substr($sumAkun, 0, $lenAkun - 1);

        $lenSub = strlen($sumSub);
        $subSum = substr($sumSub, 0, $lenSub - 1);

        $getSaldoDet = $this->mcashierBku->getSaldo($akunSum, $subSum, $depo);
        foreach ($getSaldoDet as $value) {
            for ($j=0 ; $j < count($akunDet); $j++) { 
                if ($value->szAccountId == $akunDet[$j]) {
                    $saldoDet = array(
                        'decDebit' => $value->decDebit + $nominal[$j],
                        'decAmount' => ($value->decDebit + $nominal[$i]) - $value->decCredit,
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
        
                    $whereSaldoDet = array(
                        'szBranchId' => $depo, 
                        'szAccountId' => $akunDet[$j],
                        'szSubAccountId' => $subHead[$j]
                    );
                }
            }
            $updSaldoDet = $this->mcashierBku->updateData($whereSaldoDet, $saldoDet, $base.'.dms_cas_cashtempbalancesaldo');
            $updSaldoDetDms = $this->mInventDepot->updateDms($whereSaldoDet, $saldoDet, 'dms.dms_cas_cashtempbalancesaldo');
        }
        
        if ($counterUpdate == 'true' && $headerBku == 'true' && $headerBalance == 'true' && $updSaldoHead == 'true' && $detailBku == 'true' && $detailBalance == 'true' && $updSaldoDet == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/cashierBKU'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('cashierBku/manualBku'));
            exit;
        }
    }
}

?>