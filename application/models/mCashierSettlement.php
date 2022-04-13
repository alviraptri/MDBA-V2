<?php
class mCashierSettlement extends CI_Model
{
    //action
    function updateData($where, $data, $tabel)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well

        $this->db->where($where);
        $this->db->update($tabel, $data);

        $this->db->trans_complete(); # Completing transaction

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function updateDms($where, $data, $tabel)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);

        $this->db2->trans_start(); # Starting Transaction
        $this->db2->trans_strict(FALSE); # See Note 01. If you wish can remove as well

        $this->db2->where($where);
        $this->db2->update($tabel, $data);

        $this->db2->trans_complete(); # Completing transaction

        if ($this->db2->trans_status() === FALSE) {
            # Something went wrong.
            $this->db2->trans_rollback();
            return FALSE;
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db2->trans_commit();
            return TRUE;
        }
        $this->db2->close();
    }

    function simpanData($data, $tabel)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        $this->db->insert($tabel, $data);

        $this->db->trans_complete(); # Completing transaction

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function simpanDms($data, $tabel)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $this->db2->trans_start(); # Starting Transaction
        $this->db2->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        $this->db2->insert($tabel, $data);

        $this->db2->trans_complete(); # Completing transaction

        if ($this->db2->trans_status() === FALSE) {
            # Something went wrong.
            $this->db2->trans_rollback();
            return FALSE;
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db2->trans_commit();
            return TRUE;
        }
        $this->db2->close();
    }
    //end action

    //counter
    function getId($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $dept = 'asa';
        }
        else{
            $base = 'dummymdbatvip';
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db->query("SELECT intLastCounter FROM $base.dms_sm_counter WHERE szId = '$id'");
        foreach ($query->result() as $a) {
            $tmp = ($a->intLastCounter + 1);
            $auto_num = sprintf("%07s", $tmp);
        }
        return $this->session->userdata('user_branch') . "-" . $auto_num;
        $this->db2->close();
    }

    function getCounter($countId)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $dept = 'asa';
        }
        else{
            $base = 'dummymdbatvip';
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db->query("SELECT intLastCounter FROM $base.dms_sm_counter WHERE szId = '$countId'");
        foreach ($query->result() as $value) {
            $id = $value->intLastCounter;
        }
        return $id;
        $this->db2->close();
    }
    //end counter

    //transaksi
    function getVbHeader($tglStart, $tglFinish, $depo)
    {
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $query = $this->db->query("SELECT a.*, SUM(a.`decAmountControl`) AS total
        FROM  $base.`dms_cas_doccashtempout` a
        INNER JOIN $base.dms_cas_cashtempbalance b ON a.`szDocId` = b.`szDocId` 
        WHERE b.`bVoucher` = '0' AND b.szObjectId = 'DMSDocCashTempOut' AND a.`szBranchId` = '$depo' 
        AND a.dtmDoc BETWEEN '$tglStart' AND '$tglFinish'
        GROUP BY a.`szAccountId`");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }

    function getVtHeader($tglStart, $tglFinish, $depo)
    {
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $query = $this->db->query("SELECT a.*, SUM(a.`decAmountControl`) AS total
        FROM  $base.`dms_cas_doccashtempin` a
        INNER JOIN $base.dms_cas_cashtempbalance b ON a.`szDocId` = b.`szDocId` 
        WHERE b.`bVoucher` = '0' AND b.szObjectId = 'DMSDocCashTempIn' AND a.`szBranchId` = '$depo' 
        AND a.dtmDoc BETWEEN '$tglStart' AND '$tglFinish'
        GROUP BY a.`szAccountId`");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }

    function getSaldo($depo, $szAccountId, $szSubAccountId)
    {
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $query = $this->db->query("SELECT * FROM dummymdbatvip.`dms_cas_cashbalancesaldo` a
        WHERE a.`szAccountId` = '$szAccountId' AND a.`szSubAccountId` = '$szSubAccountId' AND a.`szBranchId` = '$depo'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }

    function getVbDetail($depo, $szAccountId, $szSubAccountId, $tglStart, $tglFinish)
    {
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $query = $this->db->query("SELECT a.szAccountId as headAccount, c.*, SUM(c.`decAmount`) AS jumlahDetail
        FROM  $base.`dms_cas_doccashtempout` a
        INNER JOIN $base.dms_cas_cashtempbalance b
        ON a.`szDocId` = b.`szDocId` 
        INNER JOIN $base.dms_cas_doccashtempoutitem c
        ON c.`szDocId` = a.`szDocId`
        WHERE b.bVoucher = '0' 
        AND b.szObjectId = 'DMSDocCashTempOut' 
        AND a.`szAccountId` = '$szAccountId'
        AND a.`szSubAccountId` = '$szSubAccountId'
        AND a.`szBranchId` = '$depo'
        AND a.dtmDoc BETWEEN '$tglStart' AND '$tglFinish'
        GROUP BY c.`szAccountId`, c.`szSubAccountId`");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }

    function getVtDetail($depo, $szAccountId, $szSubAccountId, $tglStart, $tglFinish)
    {
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $query = $this->db->query("SELECT a.szAccountId as headAccount, c.*, SUM(c.`decAmount`) AS jumlahDetail
        FROM  $base.`dms_cas_doccashtempin` a
        INNER JOIN $base.dms_cas_cashtempbalance b
        ON a.`szDocId` = b.`szDocId` 
        INNER JOIN $base.dms_cas_doccashtempinitem c
        ON c.`szDocId` = a.`szDocId`
        WHERE b.bVoucher = '0' 
        AND b.szObjectId = 'DMSDocCashTempIn' 
        AND a.`szAccountId` = '$szAccountId'
        AND a.`szSubAccountId` = '$szSubAccountId'
        AND a.`szBranchId` = '$depo'
        AND a.dtmDoc BETWEEN '$tglStart' AND '$tglFinish'
        GROUP BY c.`szAccountId`, c.`szSubAccountId`");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }
    //end transaksi

    function getData($branch, $dateStart, $dateFinish)
    {
        if ($branch == '321' || $branch == '336' || $branch == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.szAccountId AS akun,
        c.`szName` AS namaAkun,
        a.szSubAccountId AS subAkun,
        d.`szName` AS namaSubAkun,
            IFNULL (b.`decAmount`,0) AS saldoAwal,
            IFNULL (SUM(a.decDebit),0) AS decDebit,
            SUM(a.decCredit) AS decCredit,
            IFNULL(b.`decAmount`,0) + SUM(a.decDebit) - SUM(a.decCredit) AS saldoAkhir
            FROM $base.dms_cas_cashtempbalance a
            LEFT JOIN $base.dms_cas_cashbalance b ON b.`szAccountId` = a.`szAccountId`
            AND b.`szSubAccountId` = a.`szSubAccountId`
            LEFT JOIN $base.`dms_fin_account` c ON c.`szId` = a.szAccountId
            LEFT JOIN $base.`dms_fin_subaccount` d ON d.`szId` = a.szSubAccountId
        WHERE a.dtmDoc  BETWEEN '$dateStart' AND '$dateFinish'
        AND a.bVoucher = '0'
        AND a.szBranchId = '$branch'
        GROUP BY a.szAccountId, a.szSubAccountId");
        return $query->result();
    }

    function getArrayHeader($tglStart, $tglFinish, $depo)
    {
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $query = $this->db->query("SELECT 
        a.* , SUM(decAmountControl) AS totalDec
        FROM  $base.`dms_cas_doccashtempout` a
        INNER JOIN $base.dms_cas_cashtempbalance b
        ON a.`szDocId` = b.`szDocId` 
        INNER JOIN $base.dms_cas_doccashtempoutitem c
        ON c.`szDocId` = a.`szDocId`
        WHERE bVoucher = '0' AND szObjectId = 'DMSDocCashTempOut'
        AND a.`szBranchId` = '320'
        AND a.dtmDoc BETWEEN '2022-04-04' AND '2022-04-04'
        GROUP BY a.`szAccountId`");
        return $query->result();
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
        $query = $this->db->query("SELECT a.`szDocId`
        FROM  $base.`dms_cas_doccashtempout` a
        INNER JOIN $base.dms_cas_cashtempbalance b
        ON a.`szDocId` = b.`szDocId` 
        INNER JOIN $base.dms_cas_doccashtempoutitem c
        ON c.`szDocId` = a.`szDocId`
        WHERE b.bVoucher = '0' 
        AND b.szObjectId = 'DMSDocCashTempOut' 
        AND a.`szAccountId` = '$szAccountId'
        AND a.`szBranchId` = '$depo'
        AND a.dtmDoc BETWEEN '$tglStart' AND '$tglFinish'
        GROUP BY a.`szDocId`");
        $data = [];
        foreach ($query->result() as $row) {
            $data = $row->szDocId;
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
