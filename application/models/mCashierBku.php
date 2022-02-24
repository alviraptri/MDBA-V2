<?php
class mCashierBku extends CI_Model
{
    //transaksi
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
    
    //counter
    function getId($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT intLastCounter FROM $base.dms_sm_counter WHERE szId = '$id'");
        foreach ($query->result() as $a) {
            $tmp = ($a->intLastCounter + 1);
            $auto_num = sprintf("%07s", $tmp);
        }
        return $this->session->userdata('user_branch') . "-" . $auto_num;
    }

    function getCounter($countId)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT intLastCounter FROM $base.dms_sm_counter WHERE szId = '$countId'");
        foreach ($query->result() as $value) {
            $id = $value->intLastCounter + 1;
        }
        return $id;
    }

    //master
    function getEmployee($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`dms_pi_employee` a
        WHERE a.`szBranchId` = '$depo' AND a.`szId` LIKE '$depo-%'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getAccount()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`dms_fin_account` a");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getSub()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`dms_fin_subaccount` a");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getAccountName($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.szName FROM $base.`dms_fin_account` a WHERE a.szId = '$id'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getSubAccName($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.szName FROM $base.`dms_fin_subaccount` a WHERE a.szId = '$id'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    //transaction
    function getDetailBku($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, c.`szVoucherNo`, a.`dtmDoc`, a.`szAccountId`, d.`szName` AS namaAkun, a.`szSubAccountId`, e.`szName` AS namaSubAkun, a.`szEmployeeId`, b.`szName` AS employee, 
        FORMAT(FLOOR(a.`decAmountControl`),0) AS decAmountControl, f.`szDescription`,
        f.`szAccountId` AS akunDet, g.`szName` AS namaAkunDet, f.`szSubAccountId` AS subAkunDet, h.`szName` AS namaSubAkunDet, FORMAT(FLOOR(f.`decAmount`),0) AS decAmount
        FROM $base.`dms_cas_doccashtempout` a
        LEFT JOIN $base.`dms_pi_employee` b ON a.`szEmployeeId` = b.`szId`
        LEFT JOIN $base.`dms_cas_cashtempbalance` c ON a.`szDocId` = c.`szDocId` AND C.`intItemNumber` = '-1' AND c.`szObjectId` = 'DMSDocCashTempOut'
        LEFT JOIN $base.`dms_fin_account` d ON a.`szAccountId` = d.`szId`
        LEFT JOIN $base.`dms_fin_subaccount` e ON a.`szSubAccountId` = e.`szId`
        LEFT JOIN $base.`dms_cas_doccashtempoutitem` f ON a.`szDocId` = f.`szDocId`
        LEFT JOIN $base.`dms_fin_account` g ON f.`szAccountId` = g.`szId`
        LEFT JOIN $base.`dms_fin_subaccount` h ON f.`szSubAccountId` = h.`szId`
        WHERE a.`szDocId` = '$id'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getSaldo($acc, $sub, $depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }

        $query = $this->db->query("SELECT a.`szAccountId`, a.`szSubAccountId`, a.`decCredit`, a.`decDebit` FROM $base.`dms_cas_cashtempbalancesaldo` a
        WHERE a.`szAccountId` IN ($acc) AND a.`szSubAccountId` IN ($sub) AND a.`szBranchId` = '$depo'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }
}

?>