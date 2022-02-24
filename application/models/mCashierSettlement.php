<?php
class mCashierSettlement extends CI_Model
{
    function getData($branch, $dateStart, $dateFinish)
    {
        if ($branch == '321' || $branch == '336' || $branch == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }

        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT dms_cas_cashtempbalance.szAccountId AS akun,
        dms_fin_account.`szName` AS namaAkun,
        dms_cas_cashtempbalance.szSubAccountId AS subAkun,
        dms_fin_subaccount.`szName` AS namaSubAkun,
            IFNULL (dms_cas_cashbalance.`decAmount`,0) AS saldoAwal,
            IFNULL (SUM(dms_cas_cashtempbalance.decDebit),0) AS decDebit,
            SUM(dms_cas_cashtempbalance.decCredit) AS decCredit,
            IFNULL(dms_cas_cashbalance.`decAmount`,0) + SUM(dms_cas_cashtempbalance.decDebit) - SUM(dms_cas_cashtempbalance.decCredit) AS saldoAkhir
            FROM dms_cas_cashtempbalance 
            LEFT JOIN dms_cas_cashbalance ON dms_cas_cashbalance.`szAccountId` = dms_cas_cashtempbalance.`szAccountId`
            AND dms_cas_cashbalance.`szSubAccountId` = dms_cas_cashtempbalance.`szSubAccountId`
            LEFT JOIN `dms_fin_account` ON `dms_fin_account`.`szId` = dms_cas_cashtempbalance.szAccountId
            LEFT JOIN `dms_fin_subaccount` ON dms_fin_subaccount.`szId` = dms_cas_cashtempbalance.szSubAccountId
        WHERE dms_cas_cashtempbalance.dtmDoc  BETWEEN '$dateStart' AND '$dateFinish'
        AND dms_cas_cashtempbalance.bVoucher = '0'
        AND dms_cas_cashtempbalance.szBranchId = '$branch'
        GROUP BY dms_cas_cashtempbalance.szAccountId, dms_cas_cashtempbalance.szSubAccountId");
        return $query->result();
        $this->db2->close();
    }

    function getArrayHeader($tglStart, $tglFinish, $depo)
    {
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db->query("SELECT 
        $base.dms_cas_doccashtempout.* , SUM(decAmountControl) as totalDec
        FROM  `$base.dms_cas_doccashtempout` 
        INNER JOIN $base.dms_cas_cashtempbalance
        ON $base.dms_cas_doccashtempout.`szDocId` = $base.dms_cas_cashtempbalance.`szDocId` 
        INNER JOIN $base.dms_cas_doccashtempoutitem
        ON $base.dms_cas_doccashtempoutitem.`szDocId` = $base.dms_cas_doccashtempout.`szDocId`
        WHERE bVoucher = '0' AND szObjectId = 'DMSDocCashTempOut'
        AND $base.dms_cas_doccashtempout.`szBranchId` = '$depo'
        AND $base.dms_cas_doccashtempout.dtmDoc BETWEEN '$tglStart' AND '$tglFinish'
        GROUP BY $base.dms_cas_doccashtempout.`szAccountId`");
        return $query->result();
        $this->db2->close();
    }

    function getDocId($szAccountId, $tglStart, $tglFinish, $depo)
    {
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db->query("SELECT $base.dms_cas_doccashtempout.`szDocId`
        FROM  `$base.dms_cas_doccashtempout` 
        INNER JOIN $base.dms_cas_cashtempbalance
        ON $base.dms_cas_doccashtempout.`szDocId` = $base.dms_cas_cashtempbalance.`szDocId` 
        INNER JOIN $base.dms_cas_doccashtempoutitem
        ON $base.dms_cas_doccashtempoutitem.`szDocId` = $base.dms_cas_doccashtempout.`szDocId`
        WHERE $base.dms_cas_cashtempbalance.bVoucher = '0' 
        AND $base.dms_cas_cashtempbalance.szObjectId = 'DMSDocCashTempOut' 
        AND $base.dms_cas_doccashtempout.`szAccountId` = '$szAccountId'
        AND $base.dms_cas_doccashtempout.`szBranchId` = '$depo'
        AND $base.dms_cas_doccashtempout.dtmDoc BETWEEN '$tglStart' AND '$tglFinish'
        GROUP BY $base.dms_cas_doccashtempout.`szDocId`");
        foreach ($query->result() as $row) {
            $data[] = $row->szDocId;
        }
        $a = "'" . implode("','", $data) . "'";
        return $a;
        $this->db2->close();
    }

    function getAmountHeader($getDocId)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db->query("SELECT SUM(decAmountControl) AS jumlahDetail 
        FROM $base.dms_cas_doccashtempout 
        WHERE szDocId IN($getDocId)");
        foreach ($query->result() as $row) {
            $data = $row->jumlahDetail;
        }
        return $data;
        $this->db2->close();
    }

    public function getTempBalanceForSaldo($szAccountId, $szSubAccountId, $depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db->query("SELECT * FROM  `$base.dms_cas_cashbalancesaldo`
        WHERE szBranchId = '$depo' AND szAccountId = '$szAccountId' AND szSubAccountId = '$szSubAccountId'
        ");
        return $query->result();
        $this->db2->close();
    }

    public function getItemDetail($getDocId)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db->query("SELECT *, SUM(decAmount) AS jumlahDetail 
        FROM $base.dms_cas_doccashtempoutitem 
        WHERE szDocId IN($getDocId)
        GROUP BY szAccountId, szSubAccountId");
        return $query->result();
    }

    public function getTempBalanceForSaldoDetail($szAccountDetail, $szSubAccountDetail, $depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db->query("SELECT * FROM  `$base.dms_cas_cashbalancesaldo`
        WHERE szBranchId = '$depo' AND szAccountId = '$szAccountDetail' AND szSubAccountId = '$szSubAccountDetail'
        ");
        return $query->result();
    }

    public function getNomorVB()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }

        $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT intLastCounter from $base.dms_sm_counter WHERE szId = 'VB" . $depo . "COU'");
        foreach ($query->result() as $a) {
            $temp = ($a->intLastCounter + 1);
            $auto_num = sprintf("%07s", $temp);
        }
        return $_SESSION['szBranchId'] . '-' . $auto_num;
    }

    public function getNomorVB_ori()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT intLastCounter from $base.dms_sm_counter WHERE szId = 'VB" . $depo . "COU'");
        foreach ($query->result() as $a) {
            $temp = ($a->intLastCounter + 1);
        }
        return $temp;
    }

    public function getNomorVT()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $depo = $this->session->userdata('user_branch');
        $query = $this->db2->query("SELECT intLastCounter from $base.dms_sm_counter WHERE szId = 'VT" . $depo . "COU'");
        foreach ($query->result() as $a) {
            $temp = ($a->intLastCounter + 1);
            $auto_num = sprintf("%07s", $temp);
        }
        return $_SESSION['szBranchId'] . '-' . $auto_num;
    }

    public function getNomorVT_ori()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT intLastCounter from $base.dms_sm_counter WHERE szId = 'VT" . $depo . "COU'");
        foreach ($query->result() as $a) {
            $temp = ($a->intLastCounter + 1);
        }
        return $temp;
    }

    //BTU
    function getArrayBTU($tglStart, $tglFinish, $depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT 
      $base.dms_cas_doccashtempin.*
      FROM  `$base.dms_cas_doccashtempin` 
      INNER JOIN $base.dms_cas_cashtempbalance
      ON $base.dms_cas_doccashtempin.`szDocId` = $base.dms_cas_cashtempbalance.`szDocId` 
      INNER JOIN $base.dms_cas_doccashtempinitem
      ON $base.dms_cas_doccashtempinitem.`szDocId` = $base.dms_cas_doccashtempin.`szDocId`
      WHERE bVoucher = '0' AND szObjectId = 'DMSDocCashTempIn'
      AND $base.dms_cas_doccashtempin.`szBranchId` = '$depo'
      AND $base.dms_cas_doccashtempin.dtmDoc BETWEEN '$tglStart' AND '$tglFinish'
      GROUP BY $base.dms_cas_doccashtempin.`szAccountId` ");
        return $query->result();
    }

    function getDocIdIn($szAccountId, $tglStart, $tglFinish, $depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT $base.dms_cas_doccashtempin.`szDocId`
      FROM  `$base.dms_cas_doccashtempin` 
      INNER JOIN $base.dms_cas_cashtempbalance
      ON $base.dms_cas_doccashtempin.`szDocId` = $base.dms_cas_cashtempbalance.`szDocId` 
      INNER JOIN $base.dms_cas_doccashtempinitem
      ON $base.dms_cas_doccashtempinitem.`szDocId` = $base.dms_cas_doccashtempin.`szDocId`
      WHERE $base.dms_cas_cashtempbalance.bVoucher = '0' 
      AND $base.dms_cas_cashtempbalance.szObjectId = 'DMSDocCashTempIn' 
      AND $base.dms_cas_doccashtempin.`szAccountId` = '$szAccountId'
      AND $base.dms_cas_doccashtempin.`szBranchId` = '$depo'
      AND $base.dms_cas_doccashtempin.dtmDoc BETWEEN '$tglStart' AND '$tglFinish'
      GROUP BY $base.dms_cas_doccashtempin.`szDocId`");
        foreach ($query->result() as $row) {
            $data[] = $row->szDocId;
        }
        $a = "'" . implode("','", $data) . "'";
        return $a;
    }

    function getAmountHeaderIn($getDocId)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT SUM(decAmountControl) AS jumlahDetail 
      FROM $base.dms_cas_doccashtempin 
      WHERE szDocId IN($getDocId)");
        foreach ($query->result() as $row) {
            $data = $row->jumlahDetail;
        }
        return $data;
    }

    function getItemDetailIn($getDocId)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT *, SUM(decAmount) AS jumlahDetail 
      FROM $base.dms_cas_doccashtempinitem 
      WHERE szDocId IN($getDocId)
      GROUP BY szAccountId, szSubAccountId");
        return $query->result();
    }
}
