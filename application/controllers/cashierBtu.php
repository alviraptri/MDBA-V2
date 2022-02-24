<?php
class cashierBtu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_logged')=='')
		{
			redirect('login');
		}
        $this->load->model(array('mInventori', 'mHome', 'mInventDepot', 'mMaster', 'mInventDist', 'mSnDPB', 'mCashierBtu'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    //master
    function getAccountName()
    {
        $id = $this->input->post('id');
        $data = $this->mCashierBtu->getAccountName($id);
        echo json_encode($data);
    }

    function getSubAccName()
    {
        $id = $this->input->post('id');
        $data = $this->mCashierBtu->getSubAccName($id);
        echo json_encode($data);
    }

    //transaction
    function detailBtu()
    {
        $id = $this->input->post('id');
        $data = $this->mCashierBtu->getDetailBtu($id);
        echo json_encode($data);
    }

    function manualBtu()
    {
        $depo = $this->session->userdata('user_branch');

        $btu = 'BTU' . $depo . 'COU';
        $data['btu'] = $this->mCashierBtu->getId($btu);

        $data['employee'] = $this->mCashierBtu->getEmployee($depo);
        $data['account'] = $this->mCashierBtu->getAccount();
        $data['subAcc'] = $this->mCashierBtu->getSub();

        $this->load->view('vBtuManual', $data);
    }

    function simpanBtu()
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

        $id = 'BTU' . $depo . 'COU';
        $btu = $this->mCashierBtu->getId($id);
        //counter
        $counter = $this->mCashierBtu->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mCashierBtu->updateData($whereCount, $updateCount, $base.'.dms_sm_counter');
        $counterUpdateDms = $this->mInventDepot->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        $btuHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $btu,
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
        $headerBtu = $this->mCashierBtu->simpanData($btuHeader, $base.'.dms_cas_doccashtempin');
        $headerBtuDms = $this->mInventDepot->simpanDms($btuHeader, 'dms.dms_cas_doccashtempin');

        $balanceHeader = array(
            'iId' => $this->uuid->v4(),
            'szObjectId' => 'DMSDocCashTempIn',
            'szDocId' => $btu,
            'dtmDoc' => $tgl,
            'szAccountId' => $akunHead,
            'szSubAccountId' => $subHead,
            'decDebit' => $kontrolJumlah,
            'decCredit' => '0',
            'decAmount' => $kontrolJumlah,
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
        $headerBalanceDms = $this->mInventDepot->simpanDms($balanceHeader, 'dms.dms_cas_cashtempbalance');

        $headerSaldoAcc = "'".$akunHead."'";
        $headerSaldoSub = "'".$subHead."'";
        $getSaldoHead = $this->mCashierBtu->getSaldo($headerSaldoAcc, $headerSaldoSub, $depo);
        foreach ($getSaldoHead as $value) {
            $saldoHead = array(
                'decDebit' => $value->decDebit + $kontrolJumlah,
                'decAmount' => ($value->decDebit + $kontrolJumlah) - $value->decCredit,
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );

            $whereSaldoHead = array(
                'szBranchId' => $depo, 
                'szAccountId' => $akunHead,
                'szSubAccountId' => $subHead
            );
            $updSaldoHead = $this->mCashierBtu->updateData($whereSaldoHead, $saldoHead, $base.'.dms_cas_cashtempbalancesaldo');
            $updSaldoHeadDms = $this->mInventDepot->updateDms($whereSaldoHead, $saldoHead, 'dms.dms_cas_cashtempbalancesaldo');
        }

        $sumAkun = '';
        $sumSub = '';
        for ($i=0 ; $i < count($akunDet) ; $i++) { 
            $btuDetail = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $btu,
                'intItemNumber' => $i,
                'szAccountId' => $akunDet[$i],
                'szSubAccountId' => $subDet[$i],
                'decAmount' => $nominal[$i],
                'szDescription' => $keterangan[$i]
            );
            $detailBtu = $this->mCashierBtu->simpanData($btuDetail, $base.'.dms_cas_doccashtempinitem');
            $detailBtuDms = $this->mInventDepot->simpanDms($btuDetail, 'dms.dms_cas_doccashtempinitem');

            $balanceDetail = array(
                'iId' => $this->uuid->v4(),
                'szObjectId' => 'DMSDocCashTempIn',
                'szDocId' => $btu,
                'dtmDoc' => $tgl,
                'szAccountId' => $akunDet[$i],
                'szSubAccountId' => $subDet[$i],
                'decDebit' => '0',
                'decCredit' => $nominal[$i],
                'decAmount' => -$nominal[$i],
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
            $detailBalance = $this->mCashierBtu->simpanData($balanceDetail, $base.'.dms_cas_cashtempbalance');
            $detailBalanceDms = $this->mInventDepot->simpanDms($balanceDetail, 'dms.dms_cas_cashtempbalance');

            $sumAkun .= "'" . $akunDet[$i] . "',";
            $sumSub .= "'" . $subDet[$i] . "',";
        }
        $lenAkun = strlen($sumAkun);
        $akunSum = substr($sumAkun, 0, $lenAkun - 1);

        $lenSub = strlen($sumSub);
        $subSum = substr($sumSub, 0, $lenSub - 1);

        $getSaldoDet = $this->mCashierBtu->getSaldo($akunSum, $subSum, $depo);
        foreach ($getSaldoDet as $value) {
            for ($j=0 ; $j < count($akunDet); $j++) { 
                if ($value->szAccountId == $akunDet[$j]) {
                    $saldoDet = array(
                        'decCredit' => $value->decCredit + $nominal[$j],
                        'decAmount' => $value->decDebit - ($value->decCredit + $nominal[$j]),
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
            $updSaldoDet = $this->mCashierBtu->updateData($whereSaldoDet, $saldoDet, $base.'.dms_cas_cashtempbalancesaldo');
            $updSaldoDetDms = $this->mInventDepot->updateDms($whereSaldoDet, $saldoDet, 'dms.dms_cas_cashtempbalancesaldo');
        }
        
        if ($counterUpdate == 'true' && $headerBtu == 'true' && $headerBalance == 'true' && $updSaldoHead == 'true' && $detailBtu == 'true' && $detailBalance == 'true' && $updSaldoDet == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/cashierBTU'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('cashierBtu/manualBtu'));
            exit;
        }
    }
}
