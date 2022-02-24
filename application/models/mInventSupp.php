<?php
class mInventSupp extends CI_Model
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
            $base = 'mdbaasa';
            $dept = 'asa';
        }
        else{
            $base = 'mdbatvip';
            $dept = 'tvip';
        }
        $depo = $this->session->userdata('user_branch');

        $this->db2 = $this->load->database($dept, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_inv_stockonhand` b 
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
    //end stock on hand

    //counter
    function getId($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }
        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT intLastCounter FROM dms.dms_sm_counter WHERE szId = '$id'");
        foreach ($query->result() as $a) {
            $tmp = ($a->intLastCounter + 1);
            $auto_num = sprintf("%07s", $tmp);
        }
        return $this->session->userdata('user_branch') . "-" . $auto_num;
        $this->db2->close();
    }

    function getIdTk($idTk)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }
        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT intLastCounter FROM dms.dms_sm_counter WHERE szId = '$idTk'");
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
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }
        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT intLastCounter FROM dms.dms_sm_counter WHERE szId = '$countId'");
        foreach ($query->result() as $value) {
            $id = $value->intLastCounter + 1;
        }
        return $id;
        $this->db2->close();
    }

    function getCounterTk($idTk)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }

        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT intLastCounter FROM dms.dms_sm_counter WHERE szId = '$idTk'");
        foreach ($query->result() as $value) {
            $id = $value->intLastCounter + 2;
        }
        return $id;
        $this->db2->close();
    }
    //end counter

    //master
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

    function getSupplier()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }

        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_ap_supplier` a ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getWarehouse($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }
        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_inv_warehouse` a
        WHERE a.`szBranchId` = '$depo' AND a.`szId` NOT LIKE '%ECOM%'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
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

    function getCarrier()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }

        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_inv_carrier` a");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getVehicle()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }
        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_inv_carriervehicle` a");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getDriver()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }
        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_inv_carrierdriver` a");

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

    //get data and transaction
    function getBkbWi($barcode)
    {
        $this->db2 = $this->load->database('waterin', true);
        $query = $this->db2->query("SELECT *
        FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
        LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
        LEFT JOIN mdba_db_sc_modust.`tbl_sc_jadwal_supply` c ON a.`mk_co_real` = c.`js_co`
        LEFT JOIN mdba_db_sc_modust.`tbl_sc_po_depo` d ON a.`mk_co_real` = d.`po_co`
        LEFT JOIN mdba.`mdbawimasterproduk` e ON c.`material_nama` = e.`masterNamaWi`
        WHERE a.`mk_barcode` = '$barcode' 
        GROUP BY e.`masterKode`
        ");
        return $query->result();
        $this->db2->close();
    }

    function getBtbWi($barcode)
    {
        $this->db2 = $this->load->database('waterin', true);
        $query = $this->db2->query("SELECT *
        FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
        LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
        LEFT JOIN mdba_db_sc_modust.`tbl_sc_jadwal_supply` c ON a.`mk_co_real` = c.`js_co`
        LEFT JOIN mdba_db_sc_modust.`tbl_sc_po_depo` d ON a.`mk_co_real` = d.`po_co`
        LEFT JOIN mdba_db_sc_modust.`tbl_hp3_depo` f ON a.`mk_barcode` = f.`mk_barcode`
        LEFT JOIN mdba.`mdbawimasterproduk` e ON a.`material_nama` = e.`masterNamaWi`
        WHERE a.`mk_barcode` = '$barcode'
        GROUP BY e.`masterKode`
        ");
        return $query->result();
        $this->db2->close();
    }

    function getDataBkB($bkb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`sumBkb`, a.`sumKode`, a.`sumProduk`, a.`sumQty`, a.`sumSatuan`, b.`coPabrik`, b.`coNo`,
        c.`dnNo`, c.`dnTanggal`, d.`poNopol`, d.`poSupir`, d.`poSupirPengganti`, d.`poNo`, d.`poTransporter`, e.`grNo`
        FROM $base.`mdbawisummaryadmin` a
        LEFT JOIN $base.`mdbacoadmin` b ON a.`sumBkb` = b.`coDocument` AND b.`coType` = 'DMSDocStockOutSupplier'
        LEFT JOIN $base.`mdbadnadmin` c ON a.`sumBkb` = c.`dnDocument` AND c.`dnType` = 'DMSDocStockOutSupplier'
        LEFT JOIN $base.`mdbapoadmin` d ON a.`sumBkb` = d.`poDocument` AND d.`poType` = 'DMSDocStockOutSupplier'
        LEFT JOIN $base.`mdbagradmin` e ON a.`sumBkb` = e.`grDocument` AND e.`grType` = 'DMSDocStockOutSupplier'
        WHERE a.`sumBkb` = '$bkb' AND a.`sumQty` <> '0'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataBtB($btb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`sumBkb`, a.`sumKode`, a.`sumProduk`, a.`sumQty`, a.`sumSatuan`, b.`coPabrik`, b.`coNo`, f.`dnNoTk`, f.`dnDocument` AS dnDocumentTk,
        c.`dnNo`, c.`dnTanggal`, d.`poNopol`, d.`poSupir`, d.`poSupirPengganti`, d.`poNo`, d.`poTransporter`, e.`grNo`
        FROM $base.`mdbawisummaryadmin` a
        LEFT JOIN $base.`mdbacoadmin` b ON a.`sumBkb` = b.`coDocument` AND b.`coType` = 'DMSDocStockInSupplier'
        LEFT JOIN $base.`mdbadnadmin` c ON a.`sumBkb` = c.`dnDocument` AND c.`dnType` = 'DMSDocStockInSupplier'
        LEFT JOIN $base.`mdbapoadmin` d ON a.`sumBkb` = d.`poDocument` AND d.`poType` = 'DMSDocStockInSupplier'
        LEFT JOIN $base.`mdbagradmin` e ON a.`sumBkb` = e.`grDocument` AND e.`grType` = 'DMSDocStockInSupplier'
        LEFT JOIN $base.`mdbatolakanadmin` f ON c.`dnNo` = f.`dnNo`
        WHERE a.`sumBkb` = '$btb' AND a.`sumQty` <> '0'
        GROUP BY a.`sumKode`");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataBtbTk($btb)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`sumBkb`, a.`sumKode`, a.`sumProduk`, a.`sumQty`, a.`sumSatuan`, b.`coPabrik`, b.`coNo`, f.`dnNoTk`, f.`dnDocument` AS btb,
        c.`dnTanggal`, d.`poNopol`, d.`poSupir`, d.`poSupirPengganti`, d.`poNo`, d.`poTransporter`, e.`grNo`
        FROM $base.`mdbawisummaryadmin` a
        LEFT JOIN $base.`mdbatolakanadmin` f ON a.`sumBkb` = f.`dnDocument`
        LEFT JOIN $base.`mdbadnadmin` c ON f.`dnNo` = c.`dnNo` AND c.`dnType` = 'DMSDocStockInSupplier'
        LEFT JOIN $base.`mdbacoadmin` b ON c.`dnDocument` = b.`coDocument` AND b.`coType` = 'DMSDocStockInSupplier'
        LEFT JOIN $base.`mdbapoadmin` d ON c.`dnDocument` = d.`poDocument` AND d.`poType` = 'DMSDocStockInSupplier'
        LEFT JOIN $base.`mdbagradmin` e ON c.`dnDocument` = e.`grDocument` AND e.`grType` = 'DMSDocStockInSupplier'
        WHERE a.`sumBkb` = '$btb'
        GROUP BY a.`sumKode`");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getHistoryBkb($tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
            $dept = 'dms111asa';
        }
        else{
            $base = 'mdbatvip';
            $dept = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, c.`szName` AS szCarrierId, b.`szName` AS szSupplierId, DATE(a.`dtmDoc`) AS dtmDoc, DATE(a.`dtmLastUpdated`) AS dtmLastUpdated FROM $base.`dms_inv_docstockoutsupplier` a
        LEFT JOIN $dept.`dms_ap_supplier` b ON b.`szId` = a.`szSupplierId`
        LEFT JOIN $dept.`dms_inv_carrier` c ON c.`szId` = a.`szCarrierId`
        WHERE a.`szBranchId` = '".$this->session->userdata('user_branch')."' AND a.`dtmDoc` = '$tanggal' 
        ORDER BY a.`szDocId` DESC");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getHistoryBtb($tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, c.`szName` AS szCarrierId, b.`szName` AS szSupplierId, DATE(a.`dtmDoc`) AS dtmDoc, 
        DATE(a.`dtmLastUpdated`) AS dtmLastUpdated 
        FROM $base.`dms_inv_docstockinsupplier` a
        LEFT JOIN $base.`dms_ap_supplier` b ON b.`szId` = a.`szSupplierId`
        LEFT JOIN $base.`dms_inv_carrier` c ON c.`szId` = a.`szCarrierId`
        WHERE a.`szBranchId` = '".$this->session->userdata('user_branch')."' AND a.`dtmDoc` = '$tanggal' ORDER BY a.`szDocId` DESC");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function detailBkb($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, DATE(a.`dtmDoc`) AS dtmDoc, a.`szSupplierId`, c.`szName` AS supplierName, 
        a.`szWarehouseId`, d.`szName` AS warehouseName, a.`szStockType`, e.`szName` AS stockTypeName,
        a.`szRefDocId`, DATE(a.`dtmDN`) AS dtmDn, a.`szCarrierId`, f.`szName` AS carrierName, a.`szVehicle`, a.`szVehicle2`,
        a.`szDriver`, a.`szDriver2`, a.`szRef1`, a.`szRef2`, a.`szRef3`, a.`intShift`, a.`intHelperCount`, 
        a.`szDescription`, b.`szProductId`, g.`szName` AS productName, b.`decQty`, b.`szUomId`
        FROM $base.`dms_inv_docstockoutsupplier` a
        LEFT JOIN $base.`dms_inv_docstockoutsupplieritem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`dms_ap_supplier` c ON a.`szSupplierId` = c.`szId`
        LEFT JOIN $base.`dms_inv_warehouse` d ON a.`szWarehouseId` = d.`szId`
        LEFT JOIN $base.`dms_inv_stocktype` e ON a.`szStockType` = e.`szId`
        LEFT JOIN $base.`dms_inv_carrier` f ON a.`szCarrierId` = f.`szId`
        LEFT JOIN $base.`dms_inv_product` g ON b.`szProductId` = g.`szId`
        WHERE a.`szDocId` = '$document'
        ORDER BY a.szDocId ASC");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function detailBtb($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, DATE(a.`dtmDoc`) AS dtmDoc, a.`szSupplierId`, c.`szName` AS supplierName, 
        a.`szWarehouseId`, d.`szName` AS warehouseName, a.`szStockType`, e.`szName` AS stockTypeName,
        a.`szRefDocId`, DATE(a.`dtmDN`) AS dtmDn, a.`szCarrierId`, f.`szName` AS carrierName, a.`szVehicle`, a.`szVehicle2`,
        a.`szDriver`, a.`szDriver2`, a.`szRef1`, a.`szRef2`, a.`szRef3`, a.`intShift`, a.`intHelperCount`, 
        a.`szDescription`, b.`szProductId`, g.`szName` AS productName, b.`decQty`, b.`szUomId`
        FROM $base.`dms_inv_docstockinsupplier` a
        LEFT JOIN $base.`dms_inv_docstockinsupplieritem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`dms_ap_supplier` c ON a.`szSupplierId` = c.`szId`
        LEFT JOIN $base.`dms_inv_warehouse` d ON a.`szWarehouseId` = d.`szId`
        LEFT JOIN $base.`dms_inv_stocktype` e ON a.`szStockType` = e.`szId`
        LEFT JOIN $base.`dms_inv_carrier` f ON a.`szCarrierId` = f.`szId`
        LEFT JOIN $base.`dms_inv_product` g ON b.`szProductId` = g.`szId`
        WHERE a.`szDocId` = '$document'
        ORDER BY a.szDocId ASC");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }
}
