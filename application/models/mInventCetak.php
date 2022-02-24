<?php
class mInventCetak extends CI_Model
{
    function getDataBkbDist($bkb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
            $dept = 'dms111asa';
        }
        else{
            $base = 'mdbatvip';
            $dept = 'dms111tvip';
        }
        $query = $this->db->query("SELECT c.`szName` AS warehouse, a.`szEmployeeId`, e.`szName` AS employee, a.`szVehicleId`, f.`szPoliceNo` AS vehicle, a.`szDescription`, a.`szDocId`,
        a.`dtmDoc`, a.`szDocPRId`, b.`szProductId`, d.`szName` AS product, b.`decQty`, b.`szUomId`,
        g.`szName` AS company
        FROM $base.`dms_inv_docstockoutdistribution` a
        LEFT JOIN $base.`dms_inv_docstockoutdistributionitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $dept.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $dept.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN $dept.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
        LEFT JOIN $dept.`dms_inv_vehicle` f ON a.`szVehicleId` = f.`szId`
        LEFT JOIN $dept.`dms_sm_company` g ON a.`szCompanyId` = g.`szId`
        WHERE a.`szDocId` = '$bkb'
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataBkbDepot($bkb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT c.`szName` AS warehouse, a.`szDescription`, a.`szDocId`,
        a.`dtmDoc`, b.`szProductId`, d.`szName` AS product, b.`decQty`, b.`szUomId`,
        g.`szName` AS company, f.szName AS depoTujuan, h.szName AS depoKirim, a.szPartyId
        FROM $base.`dms_inv_docstockoutbranch` a
        LEFT JOIN $base.`dms_inv_docstockoutbranchitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN $base.`dms_sm_branch` f ON a.`szPartyId` = f.`szId`
        LEFT JOIN $base.`dms_sm_branch` h ON a.`szBranchId` = h.`szId`
        LEFT JOIN $base.`dms_sm_company` g ON a.`szCompanyId` = g.`szId`
        WHERE a.`szDocId` = '$bkb'
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataBtbDepot($bkb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT c.`szName` AS warehouse, a.`szDescription`, a.`szDocId`,
        a.`dtmDoc`, b.`szProductId`, d.`szName` AS product, b.`decQty`, b.`szUomId`,
        g.`szName` AS company, f.szName AS depoKirim, h.szName AS depoTerima, a.szPartyId
        FROM $base.`dms_inv_docstockinbranch` a
        LEFT JOIN $base.`dms_inv_docstockinbranchitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN $base.`dms_sm_branch` f ON a.`szPartyId` = f.`szId`
        LEFT JOIN $base.`dms_sm_branch` h ON a.`szBranchId` = h.`szId`
        LEFT JOIN $base.`dms_sm_company` g ON a.`szCompanyId` = g.`szId`
        WHERE a.`szDocId` = '$bkb'
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataBtbDist($btb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
            $namedept = 'dms111asa';
        }
        else{
            $base = 'mdbatvip';
            $namedept = 'dms111tvip';
        }
        $query = $this->db->query("SELECT g.`szName` AS company, h.`szName` AS branch, c.`szName` AS warehouse, a.`szDocId`,
        a.`szEmployeeId`, e.`szName` AS employee, a.`dtmDoc`, a.`szVehicleId`, f.`szPoliceNo` AS vehicle,
        a.`szStockType`, a.`szDescription`, b.`szProductId`, d.`szName` AS product, b.`decQty`, b.`szUomId`
                FROM $base.`dms_inv_docstockindistribution` a
                LEFT JOIN $base.`dms_inv_docstockindistributionitem` b ON a.`szDocId` = b.`szDocId`
                LEFT JOIN $namedept.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
                LEFT JOIN $namedept.`dms_inv_product` d ON b.`szProductId` = d.`szId`
                LEFT JOIN $namedept.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
                LEFT JOIN $namedept.`dms_inv_vehicle` f ON a.`szVehicleId` = f.`szId`
                LEFT JOIN $namedept.`dms_sm_company` g ON a.`szCompanyId` = g.`szId`
                LEFT JOIN $namedept.`dms_sm_branch` h ON a.`szBranchId` = h.`szId`
                WHERE a.`szDocId` = '$btb'
                ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataBkbSupp($bkb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`szBranchId`, c.`szName` AS branchName, a.`szVehicle2`, a.`szVehicle`,
        a.`szDriver2`, a.`szDriver`, a.`szRefDocId`, a.`szDescription`, a.`szDocId`, a.`dtmDoc`, a.`szStockType`,
        a.`szRef1`, b.`szProductId`, d.`szName` AS product, b.`decQty`, b.`szUomId`, a.szWarehouseId
        FROM $base.`dms_inv_docstockoutsupplier` a
        LEFT JOIN $base.`dms_inv_docstockoutsupplieritem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`dms_sm_branch` c ON a.`szBranchId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        WHERE a.`szDocId` = '$bkb'
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataBtbSupp($bkb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`szBranchId`, c.`szName` AS branchName, a.`szVehicle2`, a.`szVehicle`,
        a.`szDriver2`, a.`szDriver`, a.`szRefDocId`, a.`szDescription`, a.`szDocId`, a.`dtmDoc`, a.`szStockType`,
        a.`szRef1`, b.`szProductId`, d.`szName` AS product, b.`decQty`, b.`szUomId`, a.szWarehouseId
        FROM $base.`dms_inv_docstockinsupplier` a
        LEFT JOIN $base.`dms_inv_docstockinsupplieritem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`dms_sm_branch` c ON a.`szBranchId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        WHERE a.`szDocId` = '$bkb'
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }
}
