<?php
class mInventDepot extends CI_Model
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
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');

        $query = $this->db->query("SELECT * FROM $base.`dms_inv_stockonhand` b 
            WHERE b.`szProductId` IN ($product) 
            AND b.`szStockTypeId` = '$stockTypeId' AND b.`szReportedAsId` = '$depo' 
            AND B.`szLocationId` = '$lokasiId' ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    //counter
    function getId($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        // $this->db2 = $this->load->database($base, true);
        $query = $this->db->query("SELECT intLastCounter FROM $base.dms_sm_counter WHERE szId = '$id'");
        foreach ($query->result() as $a) {
            $tmp = ($a->intLastCounter + 1);
            $auto_num = sprintf("%07s", $tmp);
        }
        return $this->session->userdata('user_branch') . "-" . $auto_num;
        // $this->db2->close();
    }

    function getCounter($countId)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT intLastCounter FROM $base.dms_sm_counter WHERE szId = '$countId'");
        foreach ($query->result() as $value) {
            $id = $value->intLastCounter + 1;
        }
        return $id;
    }

    //master
    function getWarehouse($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
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
        } else {
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
            $base = 'dummymdbaasa';
            $namedept = 'dms111asa';
        } else {
            $base = 'dummymdbatvip';
            $namedept = 'dms111tvip';
        }
        $query = $this->db->query("SELECT * FROM $namedept.`dms_pi_employee` a
        WHERE a.`szBranchId` = '$depo' AND a.`szId` LIKE '$depo-%'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getEmployeeIn($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $branch = $this->session->userdata('user_branch');
        $where = "'$id', '$branch'";
        $query = $this->db->query("SELECT * FROM $base.`dms_pi_employee` a
        WHERE a.`szBranchId` IN ($where)");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getVehicle($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $namedept = 'dms111asa';
        } else {
            $base = 'dummymdbatvip';
            $namedept = 'dms111tvip';
        }
        $query = $this->db->query("SELECT * FROM $namedept.`dms_inv_vehicle` a
        WHERE a.`szBranchId` = '$depo'
        UNION 
        SELECT * FROM $namedept.`dms_inv_vehicle` b
        WHERE b.`szId` IN ('INTERN', 'PRESELLER', 'SPV')");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getVehicleIn($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $namedept = 'dms111asa';
        } else {
            $base = 'dummymdbatvip';
            $namedept = 'dms111tvip';
        }
        $branch = $this->session->userdata('user_branch');
        $where = "'$id', '$branch'";
        $query = $this->db->query("SELECT * FROM $namedept.`dms_inv_vehicle` a
        WHERE a.`szBranchId` IN ($where)
        UNION 
        SELECT * FROM $namedept.`dms_inv_vehicle` b
        WHERE b.szId = 'INTERN'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getProduct()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`dms_inv_product` a WHERE a.`szDescription` = 'ecommerce'
        ");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getProductDetail($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`szName`, a.`szUomId` FROM $base.`dms_inv_product` a
        WHERE a.`szId` = '$id'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getBranch($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szId`, a.`szName` FROM $base.`dms_sm_branch` a
        WHERE a.`szId` NOT IN ('$depo')
                GROUP BY a.`szId`
        ");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getCustomer($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`szId` FROM $base.`dms_ar_customerstructure` a
        WHERE a.`szSoldToBranchId` = '$depo'   
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getSoName($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`szName` FROM $base.`dms_ar_customer` a
        WHERE a.`szId` = '$id'  
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    //data
    function refDocDepot($tanggal, $depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`refOld` FROM $base.`mdbarefdoc` a
        WHERE a.`refDocType` = 'DMSDocStockInBranch' AND a.`refTanggal` = '$tanggal' AND a.`refDepo` = '$depo'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        } else {
            return 0;
        }
    }

    function getBkbDepot($tanggal, $depo, $referensi)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);

        if ($referensi != '0') {
            $query = $this->db2->query("SELECT a.`szDocId` FROM dmstesting.`dms_inv_docstockoutbranch` a
            WHERE a.`szPartyId` = '$depo' AND a.`szDocId` NOT IN ($referensi) -- AND a.`dtmDoc` = '$tanggal' ");
        } else {
            $query = $this->db2->query("SELECT a.`szDocId` FROM dmstesting.`dms_inv_docstockoutbranch` a
            WHERE a.`szPartyId` = '$depo' -- AND a.`dtmDoc` = '$tanggal'");
        }

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        } else {
            return 0;
        }
        $this->db2->close();
    }

    function getBkbDetail($bkb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);

        $query = $this->db2->query("SELECT a.`dtmDoc`, a.`szBranchId`, c.`szName` AS depo, a.`szWarehouseId`, d.`szName` AS gudang, a.`szStockType`, e.`szName` AS tipe, a.`szEmployeeId`, f.`szName` AS driver,
        a.`szVehicleId`, g.`szPoliceNo` AS nopol, b.`szProductId`, h.`szName` AS produk, b.`szUomId`, b.`decQty`, a.`szDescription`
        FROM dmstesting.`dms_inv_docstockoutbranch` a
        LEFT JOIN dmstesting.`dms_inv_docstockoutbranchitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN dmstesting.`dms_sm_branch` c ON a.`szBranchId` = c.`szId`
        LEFT JOIN dmstesting.`dms_inv_warehouse` d ON a.`szWarehouseId` = d.`szId`
        LEFT JOIN dmstesting.`dms_inv_stocktype` e ON a.`szStockType` = e.`szId`
        LEFT JOIN dmstesting.`dms_pi_employee` f ON a.`szEmployeeId` = f.`szId`
        LEFT JOIN dmstesting.`dms_inv_vehicle` g ON a.`szVehicleId` = g.`szId`
        LEFT JOIN dmstesting.`dms_inv_product` h ON b.`szProductId` = h.`szId`
        WHERE a.`szDocId` = '$bkb'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];

        $this->db2->close();
    }

    function getTujuan($pengajuan)
    {
        $this->db2 = $this->load->database('waterout', true);

        $query = $this->db2->query("SELECT a.`depo_tujuan`
                FROM wo_admin.`tbl_sa_pengajuan` a
                WHERE a.`no_pengajuan` = '$pengajuan'");

        foreach ($query->result() as $a) {
            $tujuan = $a->depo_tujuan;
        }
        return $tujuan;

        $this->db2->close();
    }

    function getTujuanDet($ref)
    {
        $this->db2 = $this->load->database('waterout', true);

        $query = $this->db2->query("SELECT a.`depo_tujuan`
                FROM wo_admin.`tbl_sa_pengajuan` a
                WHERE a.`no_pengajuan` LIKE '$ref%'");

        foreach ($query->result() as $a) {
            $tujuan = $a->depo_tujuan;
        }
        return $tujuan;

        $this->db2->close();
    }

    function getDetBkbDepot($pengajuan, $tujuan)
    {
        if ($tujuan == '321' || $tujuan == '336') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database('waterout', true);

        $query = $this->db2->query("SELECT a.`no_pengajuan`, b.`tanggal_kebutuhan`, a.`depo_tujuan`, c.`nama_depo`,b.`driver`, b.`nopol`, b.`keterangan`, d.`produk`, d.`quantity`,
        e.`szId`, e.`szUomId`
                FROM wo_admin.`tbl_sa_pengajuan` a
                LEFT JOIN wo_admin.`tbl_sa_pengajuan_detail` b ON a.`no_pengajuan` = b.`no_pengajuan`
                LEFT JOIN bs.`tbl_depo` c ON a.`depo_tujuan` = c.`kode_depo`
                LEFT JOIN wo_admin.`tbl_sa_pengajuan_produk`d ON a.`no_pengajuan` = d.`no_pengajuan` 
                LEFT JOIN dms111$namedept.`dms_inv_product` e ON d.`produk` = e.`szName` AND e.`szDescription` = 'ecommerce'
                WHERE a.`no_pengajuan` = '$pengajuan'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];

        $this->db2->close();
    }

    function getDataRefBkb($ref, $tujuan)
    {
        if ($tujuan == '321' || $tujuan == '336' ) {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database('waterout', true);

        $query = $this->db2->query("SELECT a.`no_pengajuan`, b.`tanggal_kebutuhan`, a.`depo_tujuan`, d.`szName` AS depo, a.`status_sa`, b.`driver`, b.`nopol`,
        b.`keterangan`, g.`produk`, h.`szId` AS idProduk, h.`szUomId`, h.`szName` AS pdNama, g.`quantity`
        FROM wo_admin.`tbl_sa_pengajuan` a
        LEFT JOIN wo_admin.`tbl_sa_pengajuan_detail` b ON a.`no_pengajuan` = b.`no_pengajuan`
        LEFT JOIN dms111$namedept.`dms_sm_branch` d ON a.`depo_tujuan` = d.`szId`
        LEFT JOIN wo_admin.`tbl_sa_pengajuan_produk` g ON a.`no_pengajuan` = g.`no_pengajuan`
        LEFT JOIN dms111$namedept.`dms_inv_product` h ON g.`produk` = h.`szName`
        WHERE a.`no_pengajuan` LIKE '$ref%'
        ");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];

        $this->db2->close();
    }

    function editBkb($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
            $dept = 'dms111asa';
        } else {
            $base = 'dummymdbatvip';
            $dept = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, a.`dtmDoc`, h.`refOld`, e.`szName` AS pengemudi, a.`szEmployeeId`, a.`szVehicleId`, c.`szName` AS gudang, a.`szWarehouseId`, g.`szName` AS stok, a.`szStockType`, g.`szId` AS idStok, a.`szDescription`,
        d.`szName` AS product, b.`decQty`, b.`szUomId`, b.`szProductId`, a.`szPartyId`, f.`szName` AS depo, j.`szName` AS so, k.`szName` AS kendaraan
        FROM $base.`dms_inv_docstockoutbranch` a
        LEFT JOIN $base.`dms_inv_docstockoutbranchitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`mdbarefdoc` h ON a.`szDocId` = h.`refId` 
        LEFT JOIN $dept.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $dept.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN $dept.`dms_inv_stockonhand` i ON b.`szProductId` = i.`szProductId` AND i.`szLocationType` = 'WAREHOUSE' AND i.`szStockTypeId` = a.`szStockType` AND i.`szReportedAsId` = a.`szPartyId`
        LEFT JOIN $dept.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
        LEFT JOIN $dept.`dms_inv_stocktype` g ON a.`szStockType` = g.`szId`
        LEFT JOIN $dept.`dms_sm_branch` f ON a.`szPartyId` = f.`szId`
        LEFT JOIN $dept.`dms_ar_customer` j ON a.`szPartyId` = j.`szId`
        LEFT JOIN $dept.`dms_inv_vehicle` k ON a.`szVehicleId` = k.`szId`
        WHERE a.`szDocId` = '$document'
        GROUP BY b.`szProductId`");
        return $query->result();
    }

    function getBkb($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT a.`szDocId`, a.`dtmDoc`, e.`szName` AS pengemudi, a.`szEmployeeId`, a.`szVehicleId`, c.`szName` AS gudang, a.`szWarehouseId`, g.`szName` AS stok, a.`szStockType`, g.`szId` AS idStok, a.`szDescription`,
        d.`szName` AS product, b.`decQty`, b.`szUomId`, b.`szProductId`, a.`szBranchId`, f.`szName` AS depo, j.`szName` AS so, k.`szName` AS kendaraan
        FROM dmstesting.`dms_inv_docstockoutbranch` a
        LEFT JOIN dmstesting.`dms_inv_docstockoutbranchitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN dmstesting.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN dmstesting.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN dmstesting.`dms_inv_stockonhand` i ON b.`szProductId` = i.`szProductId` AND i.`szLocationType` = 'WAREHOUSE' AND i.`szStockTypeId` = a.`szStockType` AND i.`szReportedAsId` = a.`szPartyId`
        LEFT JOIN dmstesting.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
        LEFT JOIN dmstesting.`dms_inv_stocktype` g ON a.`szStockType` = g.`szId`
        LEFT JOIN dmstesting.`dms_sm_branch` f ON a.`szBranchId` = f.`szId`
        LEFT JOIN dmstesting.`dms_ar_customer` j ON a.`szBranchId` = j.`szId`
        LEFT JOIN dmstesting.`dms_inv_vehicle` k ON a.`szVehicleId` = k.`szId`
        WHERE a.`szDocId` = '$document'");
        return $query->result();
        $this->db2->close();
    }

    function getHistoryBtb($tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, c.`refOld`, a.`dtmDoc` FROM $base.`dms_inv_docstockinbranch` a
        LEFT JOIN $base.`dms_inv_stockadjustmentrefdoc` b ON a.`szDocId` = b.`szAdjustmentId` AND b.`szRefDocTypeId` = 'DMSDocStockInBranch'
        LEFT JOIN $base.`mdbarefdoc` c ON c.`refId` = a.`szDocId`
        WHERE a.`dtmDoc` = '$tanggal' AND a.`szBranchId` = '" . $this->session->userdata('user_branch') . "' AND b.`szRefDocId` IS NULL ORDER BY a.szDocId DESC");
        return $query->result();
    }

    function editBtb($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, a.`dtmDoc`, h.`refOld`, e.`szName` AS pengemudi, a.`szEmployeeId`, a.`szVehicleId`, c.`szName` AS gudang, a.`szWarehouseId`, g.`szName` AS stok, a.`szStockType`, g.`szId` AS idStok, a.`szDescription`,
        d.`szName` AS product, b.`decQty`, b.`szUomId`, b.`szProductId`, a.`szPartyId`, f.`szName` AS depo, j.`szName` AS so, k.`szName` AS kendaraan
        FROM $base.`dms_inv_docstockinbranch` a
        LEFT JOIN $base.`dms_inv_docstockinbranchitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`mdbarefdoc` h ON a.`szDocId` = h.`refId` 
        LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN $base.`dms_inv_stockonhand` i ON b.`szProductId` = i.`szProductId` AND i.`szLocationType` = 'WAREHOUSE' AND i.`szStockTypeId` = a.`szStockType` AND i.`szReportedAsId` = a.`szPartyId`
        LEFT JOIN $base.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
        LEFT JOIN $base.`dms_inv_stocktype` g ON a.`szStockType` = g.`szId`
        LEFT JOIN $base.`dms_sm_branch` f ON a.`szPartyId` = f.`szId`
        LEFT JOIN $base.`dms_ar_customer` j ON a.`szPartyId` = j.`szId`
        LEFT JOIN $base.`dms_inv_vehicle` k ON a.`szVehicleId` = k.`szId`
        WHERE a.`szDocId` = '$document'
        GROUP BY b.`szProductId`");
        return $query->result();
    }

    function getHistoryBkb($tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, c.`refOld`, a.`dtmDoc` FROM $base.`dms_inv_docstockoutbranch` a
        LEFT JOIN $base.`dms_inv_stockadjustmentrefdoc` b ON a.`szDocId` = b.`szAdjustmentId` AND b.`szRefDocTypeId` = 'DMSDocStockOutBranch'
        LEFT JOIN $base.`mdbarefdoc` c ON c.`refId` = a.`szDocId`
        WHERE a.`dtmDoc` = '$tanggal' AND a.`szBranchId` = '" . $this->session->userdata('user_branch') . "' AND b.`szRefDocId` IS NULL ORDER BY a.szDocId DESC");
        return $query->result();
    }
}
