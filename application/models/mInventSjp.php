<?php
class mInventSjp extends CI_Model
{
    //transaksi//
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
    //end transaksi//

    //counter//
    function getId($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
            $dept = 'asa';
        } else {
            $base = 'mdbatvip';
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db2->query("SELECT intLastCounter FROM dms.dms_sm_counter WHERE szId = '$id'");
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
            $base = 'mdbaasa';
            $dept = 'asa';
        } else {
            $base = 'mdbatvip';
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db2->query("SELECT intLastCounter FROM dms.dms_sm_counter WHERE szId = '$countId'");
        foreach ($query->result() as $value) {
            $id = $value->intLastCounter + 1;
        }
        return $id;
        $this->db2->close();
    }
    //end counter//

    //get data//
    function getDetail($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
            $dept = 'asa';
        } else {
            $base = 'mdbatvip';
            $dept = 'tvip';
        }

        $query = $this->db->query("SELECT a.`szDocId`, a.`szDocDO`, a.`dtmDoc`, a.`szPartyId`, a.`szWarehouseId`, c.`szName` AS gudang, 
        a.`szStockType`, d.`szName` AS tipe, a.`szCarrier`, a.`szDriver`, a.`szVehicle`, a.`szDescription`,
        b.`szProductId`, e.`szName` AS produk, b.`decQty`, b.`szUomId`
        FROM $base.`dms_inv_docstockoutcustomer` a
        LEFT JOIN $base.`dms_inv_docstockoutcustomeritem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_stocktype` d ON a.`szStockType` = d.`szId`
        LEFT JOIN $base.`dms_inv_product` e ON b.`szProductId` = e.`szId`
        WHERE a.`szDocId` = '$id'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataDo($depo, $tanggal, $referensi)
    {
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $namedept = 'dms111asa';
        } else {
            $namedept = 'dms111tvip';
        }

        if ($referensi != '') {
            $query = $this->db->query("SELECT * FROM $namedept.`dms_sd_docdo` a
            WHERE a.`dtmDoc` = '$tanggal' AND a.`szCarrier` <> '' AND a.`szBranchId` = '$depo' AND a.`szDocId` NOT IN ($referensi)
            AND a.`szDocStatus` = 'Applied'
            ");
        } else {
            $query = $this->db->query("SELECT * FROM $namedept.`dms_sd_docdo` a
            WHERE a.`dtmDoc` = '$tanggal' AND a.`szCarrier` <> '' AND a.`szBranchId` = '$depo'
            AND a.`szDocStatus` = 'Applied'
            ");
        }

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataCust($depo, $tanggal)
    {
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $namedept = 'mdbaasa';
        } else {
            $namedept = 'mdbatvip';
        }

        $query = $this->db->query("SELECT * FROM $namedept.`dms_inv_docstockoutcustomer` a
        WHERE a.`szBranchId` = '$depo' AND a.`dtmDoc` = '$tanggal' ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDetDo($nodo)
    {
        $depo = $this->session->userdata('user_branch');
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $namedept = 'dms111asa';
        } else {
            $namedept = 'dms111tvip';
        }

        $query = $this->db->query("SELECT a.`szCustomerId`, a.`szCarrier`, a.`szVehicle3`, a.`szDriver3`, d.`szName` AS custName, 
        b.`szProductId`, c.`szName` AS prodName, b.`decQty`, b.`szUomId`, 
        a.`szSalesId`, a.`szVehicleId`, e.`szName` AS driver, f.`szPoliceNo` AS vehicle, a.szStockTypeId, b.szOrderItemTypeId
        FROM $namedept.`dms_sd_docdo` a
        LEFT JOIN $namedept.`dms_sd_docdoitem` b ON a.`szDocId` = b.`szDocId` 
        LEFT JOIN $namedept.`dms_inv_product` c ON b.`szProductId` = c.`szId`
        LEFT JOIN $namedept.`dms_ar_customer` d ON a.`szCustomerId` = d.`szId`
        LEFT JOIN $namedept.`dms_pi_employee` e ON a.`szSalesId` = e.`szId`
        LEFT JOIN $namedept.`dms_inv_vehicle` f ON a.`szVehicleId` = f.`szId`
        WHERE a.`szDocId` = '$nodo'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }
    //end get data//
}
