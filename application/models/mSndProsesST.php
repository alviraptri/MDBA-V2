<?php
class mSndProsesST extends CI_Model{

    function filterData($jenis, $tglAwal, $tglAkhir)
    {
        $depo = $this->session->userdata('user_branch');
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, a.`szRouteType`, a.`szEmployeeId`, b.`szName` FROM $base.`dms_sd_doccall` a
        LEFT JOIN $base.`dms_pi_employee` b ON a.`szEmployeeId` = b.`szId`
        WHERE a.`szRouteType` = '$jenis' AND a.`dtmDoc` BETWEEN '$tglAkhir' AND '$tglAkhir' 
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }
    
    function detail($doc)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, a.`dtmDoc`, a.`szRouteType`, a.`szEmployeeId`, a.`szVehicleId`, a.`szHelper1`, f.`szName` AS helpName1, a.`szHelper2`, g.`szName` AS helpName2, b.`szName` AS empName,
        c.`szDocCallIdRef`, c.`szDocDO`, c.`szDocInvoice`, c.`szDocSO`,
        d.`szProductId`, e.`szName` AS prodName, d.`decQty`, d.`szUomId`,
        c.`szCustomerId`, h.`szName` AS custName
        FROM $base.`dms_sd_doccall` a
        LEFT JOIN $base.`dms_pi_employee` b ON a.`szEmployeeId` = b.`szId`
        LEFT JOIN $base.`dms_sd_doccallitem` c ON a.`szDocId` = c.`szDocId`
        LEFT JOIN $base.`dms_sd_docsoitem` d ON c.`szDocSO` = d.`szDocId`
        LEFT JOIN $base.`dms_inv_product` e ON d.`szProductId` = e.`szId`
        LEFT JOIN $base.`dms_pi_employee` f ON a.`szHelper1` = f.`szId`
        LEFT JOIN $base.`dms_pi_employee` g ON a.`szHelper2` = g.`szId`
        LEFT JOIN $base.`dms_ar_customer` h ON c.`szCustomerId` = h.`szId`
        WHERE a.`szDocId` = '$doc' 
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }
}

?>