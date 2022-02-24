<?php
class mInventDist extends CI_Model
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

    //stok on hand
    function stockOnHand($product, $lokasiId, $stockTypeId)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $dept = 'asa';
        }
        else{
            $base = 'dummymdbatvip';
            $dept = 'tvip';
        }
        $depo = $this->session->userdata('user_branch');

        $this->db2 = $this->load->database($dept, true);
            $query = $this->db->query("SELECT * FROM $base.`dms_inv_stockonhand` b 
            WHERE b.`szProductId` IN ($product) 
            AND b.`szStockTypeId` = '$stockTypeId' AND b.`szReportedAsId` = '$depo' 
            AND B.`szLocationId` = '$lokasiId'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

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

    function getIdAdj($id)
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
            $tmp = ($a->intLastCounter + 2);
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
            $id = $value->intLastCounter + 1;
        }
        return $id;
        $this->db2->close();
    }
    //end counter

    //master
    function getGudang($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        }
        else{
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`dms_inv_warehouse` a
        WHERE a.`szBranchId` = '$depo' AND a.`szId` NOT LIKE '%ECOM%'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getStockType()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        }
        else{
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`dms_inv_stocktype` a");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getEmployee($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        }
        else{
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`dms_pi_employee` a
        WHERE a.`szBranchId` = '$depo' AND a.`szId` LIKE '$depo-%'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getVehicle($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
            $dept = 'asa';
        }
        else{
            $base = 'dms111tvip';
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db->query("SELECT * FROM $base.`dms_inv_vehicle` a
        WHERE a.`szBranchId` = '$depo'
        UNION 
        SELECT * FROM $base.`dms_inv_vehicle` b
        WHERE b.`szId` IN ('INTERN', 'PRESELLER', 'SPV', 'COUNTER')");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function vehicle($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
        }
        else{
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db2->query("SELECT a.`szVehicleId`, b.`szPoliceNo` FROM dms.`dms_pi_employeedistribution` a
        LEFT JOIN dms.`dms_inv_vehicle` b ON a.`szVehicleId` = b.`szId` 
        WHERE a.`szId` = '$id'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getProduct()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }
        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_inv_product` a WHERE a.`szDescription` = 'ecommerce'
        ");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }
    //end master

    function getDetPB($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $namedept = 'dms111asa';
        }
        else{
            $base = 'dummymdbatvip';
            $namedept = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, d.`szDocId` AS noBkb, DATE(a.`dtmDoc`) AS dtmDoc, a.`szEmployeeId`, b.`szName` AS pengemudi, a.`szVehicleId`, c.`szName` AS kendaraan, a.`szWarehouseId`, e.`szName` AS gudang,
        a.`szStockType`, f.`szName` AS tipe, g.`szProductId`, h.`szName` AS produk, g.`decQty`, g.`szUomId`, i.Status,
        j.`decQtyOnHand`, j.`szProductId`
        FROM $base.`dms_sd_docproductrequest` a
        LEFT JOIN $namedept.`dms_pi_employee` b ON a.`szEmployeeId` = b.`szId`
        LEFT JOIN $namedept.`dms_inv_vehicle` c ON a.`szVehicleId` = c.`szId`
        LEFT JOIN $namedept.`dms_inv_docstockoutdistributionpr` d ON a.`szDocId` = d.`szDocProductRequestId`
        LEFT JOIN $namedept.`dms_inv_warehouse` e ON a.`szWarehouseId` = e.`szId` 
        LEFT JOIN $namedept.`dms_inv_stocktype` f ON a.`szStockType` = f.`szId`
        LEFT JOIN $base.`dms_sd_docproductrequestitem` g ON a.`szDocId` = g.`szDocId`
        LEFT JOIN $namedept.`dms_inv_product` h ON g.`szProductId` = h.`szId`
        LEFT JOIN $base.`mdbapbstatus` i ON a.`szDocId` = i.`pbDoc`
        LEFT JOIN $namedept.`dms_inv_stockonhand` j ON g.`szProductId` = j.`szProductId` AND j.`szLocationId` = a.`szWarehouseId` AND j.`szStockTypeId` = a.`szStockType` AND j.`szReportedAsId` = a.`szBranchId`
        WHERE a.`szDocId` = '$id'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getBKBDO($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        }
        else{
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`mdbarefbkbdo` a
        WHERE a.`bkbDepo` = '$depo' AND a.`bkbTanggal` >= CURDATE() - INTERVAL 3 DAY AND a.`bkbTanggal` <= CURDATE() + INTERVAL 1 DAY");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getNoDo($depo, $referensi)
    {
        $tanggal = date('Y-m-d');
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'dms111asa';
            $base = 'dummymdbaasa';
        }
        else{
            $namedept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }

        $this->db2 = $this->load->database($base, true);
        if ($referensi != '0') {
            $query = $this->db2->query("SELECT a.`szDocId` FROM $namedept.`dms_sd_docdo` a
            WHERE a.`szBranchId` = '$depo' AND a.dtmDoc = '$tanggal' AND a.`szDocId` NOT IN ($referensi)");
        }
        else{
            $query = $this->db2->query("SELECT a.`szDocId` FROM $namedept.`dms_sd_docdo` a
            WHERE a.`szBranchId` = '$depo' AND a.dtmDoc = '$tanggal'");
        }
            
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getPengemudi($pengemudi)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        }
        else{
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`dms_pi_employee` a
        WHERE a.`szId` = '$pengemudi'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getKendaraan($kendaraan)
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
        $query = $this->db->query("SELECT * FROM dms.`dms_inv_vehicle` a
        WHERE a.`szId` = '$kendaraan'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getProduk($produk, $stok, $gudang)
    {
        $depo = $this->session->userdata('user_branch');
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }

        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT a.`szId`, a.`szName`, b.`decQtyOnHand`, a.`szUomId` FROM dms.`dms_inv_product` a 
        LEFT JOIN dms.`dms_inv_stockonhand` b ON a.`szId` = b.`szProductId` AND b.`szStockTypeId` = '$stok' 
        AND b.`szLocationId` = '$gudang' AND b.`szReportedAsId` = '$depo'
        WHERE a.`szId` = '$produk' AND a.`szDescription` = 'ecommerce'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getNamaPelanggan($nodo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT b.`szName` FROM dms.`dms_sd_docdo` a
        LEFT JOIN dms.`dms_ar_customer` b ON a.`szCustomerId` = b.`szId`
        WHERE a.`szDocId` = '$nodo'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getHistoryBkb($tanggal)
    {
        $depo = $this->session->userdata('user_branch');
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $dept = 'asa';
        }
        else{
            $base = 'dummymdbatvip';
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db->query("SELECT a.`szDocId`, a.`dtmDoc`, a.szDocPRId, c.`refOld`
        FROM $base.`dms_inv_docstockoutdistribution` a
        LEFT JOIN $base.`mdbarefdoc` c ON c.`refId` = a.`szDocId`
        WHERE a.`dtmDoc` = '$tanggal' AND a.`szBranchId` = '$depo' 
        AND a.`szDocId` NOT IN (
        SELECT z.`szRefDocId` FROM $base.`dms_inv_stockadjustmentrefdoc` z
        LEFT JOIN $base.`dms_inv_docstockadjustment` w ON z.`szDocId` = w.`szDocId`
        WHERE w.`dtmDoc` = a.`dtmDoc` AND z.`szRefDocTypeId` = 'DMSDocStockOutDistribution'
        UNION 
        SELECT m.`szAdjustmentId` FROM $base.`dms_inv_stockadjustmentrefdoc` m
        LEFT JOIN $base.`dms_inv_docstockadjustment` n ON n.`szDocId` = m.`szDocId`
        WHERE n.`dtmDoc` = a.`dtmDoc` AND m.`szRefDocTypeId` = 'DMSDocStockOutDistribution'
        )
        ORDER BY a.szDocId DESC");
        return $query->result();
        $this->db2->close();
    }

    function editBkb($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $dept = 'dms111asa';
        }
        else{
            $base = 'dummymdbatvip';
            $dept = 'dms111tvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szDocId`, DATE(a.`dtmDoc`) as dtmDoc, a.`szEmployeeId`, e.`szName` AS employeeName, a.`szWarehouseId`, c.`szName` AS warehouseName, a.szDocPRId,
        a.`szStockType`, g.`szName` AS stockTypeName, a.`szDocPRId`, a.`szEmployeeId`, e.`szName` AS employeeName, a.`szVehicleId`, 
        k.`szName` AS vehicleName, b.`szProductId`, d.`szName` AS productName, b.`decQty`, b.`szUomId`, a.szDescription, h.`refOld`, 
        i.`decQtyOnHand`
                FROM $base.`dms_inv_docstockoutdistribution` a
                LEFT JOIN $base.`dms_inv_docstockoutdistributionitem` b ON a.`szDocId` = b.`szDocId`
                LEFT JOIN $base.`mdbarefdoc` h ON a.`szDocId` = h.`refId` 
                LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
                LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
                LEFT JOIN $base.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
                LEFT JOIN $base.`dms_inv_stocktype` g ON a.`szStockType` = g.`szId`
                LEFT JOIN $base.`dms_inv_vehicle` k ON a.`szVehicleId` = k.`szId`
                LEFT JOIN $base.`dms_inv_stockonhand` i ON b.`szProductId` = i.`szProductId` AND a.`szWarehouseId` = i.`szLocationId` AND a.`szStockType` = i.`szStockTypeId` AND a.`szBranchId` = i.`szReportedAsId`
                WHERE a.`szDocId` = '$document'
                ORDER BY b.`szProductId` ASC
                ");
        return $query->result();
        $this->db2->close();
    }

    function editBtb($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $dept = 'dms111asa';
        }
        else{
            $base = 'dummymdbatvip';
            $dept = 'dms111tvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szDocId`, DATE(a.`dtmDoc`) as dtmDoc, a.`szEmployeeId`, e.`szName` AS employeeName, a.`szWarehouseId`, c.`szName` AS warehouseName,
        a.`szStockType`, g.`szName` AS stockTypeName, a.`szEmployeeId`, e.`szName` AS employeeName, a.`szVehicleId`, 
        k.`szName` AS vehicleName, b.`szProductId`, d.`szName` AS productName, b.`decQty`, b.`szUomId`, a.szDescription, h.`refOld`, 
        i.`decQtyOnHand`, h.`refOld`
                FROM $base.`dms_inv_docstockindistribution` a
                LEFT JOIN $base.`dms_inv_docstockindistributionitem` b ON a.`szDocId` = b.`szDocId`
                LEFT JOIN $base.`mdbarefdoc` h ON a.`szDocId` = h.`refId` 
                LEFT JOIN $dept.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
                LEFT JOIN $dept.`dms_inv_product` d ON b.`szProductId` = d.`szId`
                LEFT JOIN $dept.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
                LEFT JOIN $dept.`dms_inv_stocktype` g ON a.`szStockType` = g.`szId`
                LEFT JOIN $dept.`dms_inv_vehicle` k ON a.`szVehicleId` = k.`szId`
                LEFT JOIN $dept.`dms_inv_stockonhand` i ON b.`szProductId` = i.`szProductId` AND a.`szWarehouseId` = i.`szLocationId` AND a.`szStockType` = i.`szStockTypeId` AND a.`szBranchId` = i.`szReportedAsId`
                WHERE a.`szDocId` = '$document'
                ORDER BY b.`szProductId` ASC
                ");
        return $query->result();
        $this->db2->close();
    }

    function cekBkb($bkb)
    {
        $this->db2 = $this->load->database('waterout', true);
        $query = $this->db2->query("SELECT * FROM bs.`tbl_head_bkb` a
        WHERE a.`no_bkb` = '$bkb' GROUP BY a.`no_bkb`");
        if ($query->num_rows() > 0) {
            $res = $query->num_rows();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getDataGln($bkb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database('waterout', true);
        $query = $this->db2->query("SELECT b.`szDocId`, b.`szEmployeeId`, b.`szVehicleId`, b.`szWarehouseId`, b.`szStockType`,
        a.`jambot_aqua`, a.`jambot_vit`, a.`sisa_aqua`, a.`sisa_vit`
        FROM bs.`tbl_head_bkb` a
        LEFT JOIN dms111$namedept.`dms_inv_docstockoutdistribution` b ON a.`no_bkb` = b.`szDocId`
        WHERE a.`no_bkb` = '$bkb'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getDataSps($bkb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database('waterout', true);
        $query = $this->db2->query("SELECT b.`szDocId`, b.`szEmployeeId`, b.`szVehicleId`, b.`szWarehouseId`, b.`szStockType`,
        d.`szProductId`, c.`qty_sisa`, e.`szName`, e.`szUomId`
        FROM bs.`tbl_head_sps` a
        LEFT JOIN bs.`tbl_det_bkbsps` c ON a.`no_bkb` = c.`no_bkb`
        LEFT JOIN dms111$namedept.`dms_inv_product` e ON c.`pd_bkb` = e.`szName`
        LEFT JOIN dms111$namedept.`dms_inv_docstockoutdistribution` b ON a.`no_bkb` = b.`szDocId`
        LEFT JOIN dms111$namedept.`dms_inv_docstockoutdistributionitem` d ON a.`no_bkb` = d.`szDocId` AND e.`szId` = d.`szProductId`
        WHERE a.`no_bkb` = '$bkb' AND c.`qty_sisa` <> '' AND d.`szProductId` IS NOT NULL");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getDataKsg($bkb)
    {
        $this->db2 = $this->load->database('waterout', true);
        $query = $this->db2->query("SELECT c.`mKode`, a.`prod_kos`, a.`qty` FROM bs.`tbl_kos_aqua` a
        LEFT JOIN bs.`m_prod_bs` c ON a.`prod_kos` = c.`mProduk` AND c.`mKode` NOT IN ('42001')
        WHERE a.`no_bkb` = '$bkb' AND c.`mKode` IS NOT NULL
        UNION 
        SELECT d.`mKode`, b.`prod_kos`, b.`qty` FROM bs.`tbl_kos_vit` b
        LEFT JOIN bs.`m_prod_bs` d ON b.`prod_kos` = d.`mProduk` AND d.`mKode` NOT IN ('42001')
        WHERE b.no_bkb = '$bkb' AND d.`mKode` IS NOT NULL");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getDataBs($bkb)
    {
        $this->db2 = $this->load->database('waterout', true);
        $query = $this->db2->query("SELECT c.`mKode`, a.`produkbs_aqua` AS produk, a.`qtybs_aqua` AS qty FROM bs.`tbl_bs_aqua` a
        LEFT JOIN bs.`m_prod_bs` c ON a.`produkbs_aqua` = c.`mProduk` AND c.`mKode` NOT IN ('74559G')
        WHERE a.`no_bkb` = '$bkb'
        UNION 
        SELECT d.mKode, b.produkbs_vit AS produk, b.qtybs_vit AS qty FROM bs.`tbl_bs_vit` b
        LEFT JOIN bs.`m_prod_bs` d ON b.`produkbs_vit` = d.`mProduk` AND d.`mKode` NOT IN ('74560G')
        WHERE b.`no_bkb` = '$bkb'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getDataHeader($btb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        }
        else{
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocBkb`, a.`szDocId`, a.`szEmployeeId`, b.`szName` AS employee, a.`szWarehouseId`, c.`szName` AS gudang, 
        a.`szStockType`, d.`szName`AS stock, a.`szVehicleId`, e.`szName` AS vehicle
        FROM $base.`mdbahistorydistributionin` a
        LEFT JOIN $base.`dms_pi_employee` b ON a.`szEmployeeId` = b.`szId`
        LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_stocktype` d ON a.`szStockType` = d.`szId`
        LEFT JOIN $base.`dms_inv_vehicle` e ON a.`szVehicleId` = e.`szId`
        WHERE a.`szDocId` = '$btb'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataDetail($btb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        }
        else{
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`mdbahistorysummary` a
        WHERE a.`sumBtb` = '$btb' AND a.`sumQty` <> '0'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getCountPb($pb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT COUNT(*) AS rowPb FROM $base.`dms_inv_docstockoutdistribution` a
        WHERE a.`szDocPRId` = '$pb'");
        return $query->result();
    }

    function getHistoryAdjBkb($tanggal)
    {
        $depo = $this->session->userdata('user_branch');
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.* FROM $base.`dms_inv_stockadjustmentrefdoc` a
        LEFT JOIN $base.`dms_inv_docstockadjustment` b ON a.`szDocId` = b.`szDocId`
        WHERE b.`szBranchId` = '$depo' AND b.`dtmDoc` = '$tanggal' AND a.`szRefDocTypeId` = 'DMSDocStockOutDistribution'");
        return $query->result();
    }

    function getHistoryAdjBtb($tanggal)
    {
        $depo = $this->session->userdata('user_branch');
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.* FROM $base.`dms_inv_stockadjustmentrefdoc` a
        LEFT JOIN $base.`dms_inv_docstockadjustment` b ON a.`szDocId` = b.`szDocId`
        WHERE b.`szBranchId` = '$depo' AND b.`dtmDoc` = '$tanggal' AND a.`szRefDocTypeId` = 'DMSDocStockInDistribution'");
        return $query->result();
    }

    function detailAdj($id)
    {
        $depo = $this->session->userdata('user_branch');
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT * FROM dummymdbaasa.`dms_inv_stockadjustmentrefdoc` a
        LEFT JOIN dummymdbaasa.`dms_inv_docstockadjustment` b ON a.`szDocId` = b.`szDocId` 
        LEFT JOIN dummymdbaasa.`dms_inv_docstockadjustmentitem` c ON a.`szDocId` = c.`szDocId`
        LEFT JOIN dummymdbaasa.`dms_inv_product` d ON c.`szProductId` = d.`szId`
        WHERE a.`szDocId` = '$id'");
        return $query->result();
    }

    function getListHistoryBtbDist($tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $namedept = 'dms111asa';
        }
        else{
            $base = 'dummymdbatvip';
            $namedept = 'dms111tvip';
        }
        $depo = $this->session->userdata('user_branch');

        // $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szDocId`, b.`szName`, a.`szVehicleId` FROM $base.`dms_inv_docstockindistribution` a
        LEFT JOIN $namedept.`dms_pi_employee` b ON a.`szEmployeeId` = b.`szId`
        WHERE a.`dtmDoc` = '$tanggal' AND a.`szBranchId` = '$depo' 
        AND a.`szDocId` NOT IN (
        SELECT z.`szRefDocId` FROM $base.`dms_inv_stockadjustmentrefdoc` z
        LEFT JOIN $base.`dms_inv_docstockadjustment` w ON z.`szDocId` = w.`szDocId`
        WHERE w.`dtmDoc` = a.`dtmDoc` AND z.`szRefDocTypeId` = 'DMSDocStockInDistribution'
        UNION 
        SELECT m.`szAdjustmentId` FROM $base.`dms_inv_stockadjustmentrefdoc` m
        LEFT JOIN $base.`dms_inv_docstockadjustment` n ON n.`szDocId` = m.`szDocId`
        WHERE n.`dtmDoc` = a.`dtmDoc` AND m.`szRefDocTypeId` = 'DMSDocStockInDistribution'
        )
        ORDER BY a.szDocId DESC");
        return $query->result();
        // $this->db2->close();
    }

    function editBtbDistribusi($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $namedept = 'dms111asa';
        }
        else{
            $base = 'dummymdbatvip';
            $namedept = 'dms111tvip';
        }

        // $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szDocId`, a.`dtmDoc`, h.`refOld`, e.`szName` AS pengemudi, a.`szEmployeeId`, a.`szVehicleId`, c.`szName` AS gudang, a.`szWarehouseId`, g.`szName` AS stok, a.`szStockType`, g.`szId` AS idStok, a.`szDescription`,
        d.`szName` AS produk, b.`decQty`, b.`szUomId`, b.`szProductId`, i.`szPoliceNo` AS kendaraan
        FROM $base.`dms_inv_docstockindistribution` a
        LEFT JOIN $base.`dms_inv_docstockindistributionitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`mdbarefdoc` h ON a.`szDocId` = h.`refId` 
        LEFT JOIN $namedept.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $namedept.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN $namedept.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
        LEFT JOIN $namedept.`dms_inv_stocktype` g ON a.`szStockType` = g.`szId`
        LEFT JOIN $namedept.`dms_inv_vehicle` i ON a.`szVehicleId` = i.`szId`
        WHERE a.`szDocId` = '$document'
        GROUP BY b.`szProductId`");
        return $query->result();
        // $this->db2->close();
    }
}
