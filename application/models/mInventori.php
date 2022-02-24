<?php
class mInventori extends CI_Model
{
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
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return TRUE;
        }
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
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function getDetBtbSupplier($id)
    {
        $this->db2 = $this->load->database("waterin", true);
        $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po_old`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_t`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`
        FROM db_sc_modust.`tbl_sc_armada_barcode` a
        LEFT JOIN db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
        WHERE a.`mk_barcode` = '$id'
        ");
        return $query->result();
        $this->db2->close();
    }

    function getId($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db3 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT intLastCounter FROM $base.dms_sm_counter WHERE szId = '$id'");
        foreach ($query->result() as $a) {
            $tmp = ($a->intLastCounter + 1);
            $auto_num = sprintf("%07s", $tmp);
        }
        return $this->session->userdata('user_branch') . "-" . $auto_num;
        $this->db3->close();
    }

    function getCounter($countId)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }
        $this->db3 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT intLastCounter FROM $base.dms_sm_counter WHERE szId = '$countId'");
        foreach ($query->result() as $value) {
            $id = $value->intLastCounter + 1;
        }
        return $id;
        $this->db3->close();
    }

    function getDmsPabrik($pabrikWindowAdm)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db3 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szId` FROM $base.`dms_ap_supplier` a
        WHERE a.`szName` LIKE '%".$pabrikWindowAdm."%'");
        foreach ($query->result() as $value) {
            $suppId = $value->szId;
        }
        return $suppId;
        $this->db3->close();
    }

    function getKodeProduk($produk, $stok, $depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db3 = $this->load->database($namedept, true);
            $query = $this->db->query("SELECT a.`szId`, a.`szName`, a.`szUomId`, b.`decQtyOnHand` FROM $base.`dms_inv_product` a
            LEFT JOIN $base.`dms_inv_stockonhand` b ON a.`szId` = b.`szProductId`
                    WHERE a.`szId` IN ($produk) AND b.`szStockTypeId` = '$stok' AND b.`szReportedAsId` = '$depo'");
        return $query->result();
        $this->db3->close();
    }

    function filterStatusBtbSupp($filter)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($filter == 'Applied' || $filter == 'Void') {
            if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
                $namedept = 'asa';
            } else {
                $namedept = 'tvip';
            }
            $this->db2 = $this->load->database($namedept, true);
            $query = $this->db->query("SELECT a.`szDocId` AS mk_barcode, a.`szRef3` AS mk_po_old, a.`szRef1` AS mk_co_real, a.`szRef2` AS mk_gr, a.`szRefDocId` AS mk_dn_t, a.`dtmDN` AS mk_dn_date,
            a.`szCarrierId` AS mk_pool, a.`szDriver2` AS mk_armada_driver, a.`szVehicle2` AS mk_armada_nopol, a.`szWarehouseId` AS pabrik_nama, b.`szProductId` AS material_nama, b.`decQty` AS mk_varian_muatan, a.szDocStatus
            FROM $base.`dms_inv_docstockinsupplier` a
            LEFT JOIN $base.`dms_inv_docstockinsupplieritem` b ON a.`szDocId` = b.`szDocId`
            WHERE a.`szDocStatus` = '$filter' AND a.`dtmDoc` = CURDATE() AND a.`szBranchId` = '" . $this->session->userdata('user_branch') . "'");
            return $query->result();
            $this->db2->close();
        } else {
            if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336') {
                $namedept = 'asa';
            } else {
                $namedept = 'tvip';
            }
            $this->db2 = $this->load->database($namedept, true);
            $query = $this->db->query("SELECT a.`szDocId`, a.`szRef3` FROM $base.`dms_inv_docstockinsupplier` a
            WHERE a.`szBranchId` = '" . $this->session->userdata('user_branch') . "' AND a.`dtmDoc` = CURDATE()");
            return $query->result();
            $this->db2->close();
        }
    }

    function getDataTambahBtbSupplier($dn)
    {
        $this->db2 = $this->load->database('waterin', true);
        // $query = $this->db2->query("SELECT a.`po_return_isi`, a.`po_jugrack`, a.`po_gal_kos`, a.`po_palet`, a.`po_nopol`, a.`po_driver`, a.`po_driver_pengganti`, a.`po_transporter_kode`, a.`po_po_old`, b.`transporter_nama_npwp`,
        // c.`js_day`, c.`js_date`, c.`pabrik_nama`, c.`material_nama`, c.`js_tujuan_co`, d.`mk_depo_tujuan`, e.`mk_masuk_tujuan`, a.`po_co`,
        // d.`mk_dn_m`, d.`mk_dn_date`, d.`mk_dn_van`, d.`mk_armada_driver`, d.`material_nama`, d.`mk_muatan_masuk`,
        // d.`mk_gr`, d.`mk_gr_qty`, d.`material_nama`, d.`mk_armada_nopol`, f.`material_kode`, d.mk_dn_m_qty, d.mk_dn_t, d.mk_dn_t_qty, 
        // d.mk_tm_gal_kos, d.mk_tm_gal_isi, d.mk_tk_gal_kos_aqua, d.mk_tk_gal_kos_vit, d.mk_tk_gal_isi_aqua, d.mk_tk_gal_isi_vit
        // FROM db_sc_modust.`tbl_sc_po_depo` a
        // LEFT JOIN db_sc_modust.`tbl_sc_transporter` b ON a.`po_transporter_kode` = b.`transporter_kode`
        // LEFT JOIN db_sc_modust.`tbl_sc_jadwal_supply` c ON c.`js_co` = a.`po_co`
        // LEFT JOIN db_sc_modust.`tbl_sc_armada_barcode` d ON a.`po_po_old` = d.`mk_po_old`
        // LEFT JOIN db_sc_modust.`tbl_sc_armada_barcode_waktu` e ON d.`mk_barcode` = e.`mk_barcode`
        // LEFT JOIN db_sc_modust.`tbl_sc_material` f ON d.`material_nama` = f.`material_nama`
        // WHERE a.`po_po_old` = '$dn'");
        $query = $this->db2->query("SELECT g.`product_name`, g.`product_code`, a.`po_return_isi`, a.`po_jugrack`, a.`po_gal_kos`, a.`po_palet`, a.`po_nopol`, a.`po_driver`, a.`po_driver_pengganti`, a.`po_transporter_kode`, a.`po_po_old`, b.`transporter_nama_npwp`,
        c.`js_day`, c.`js_date`, c.`pabrik_nama`, c.`material_nama`, c.`js_tujuan_co`, d.`mk_depo_tujuan`, e.`mk_masuk_tujuan`, a.`po_co`,
        d.`mk_dn_m`, d.`mk_dn_date`, d.`mk_dn_van`, d.`mk_armada_driver`, d.`material_nama`, d.`mk_muatan_masuk`,
        d.`mk_gr`, d.`mk_gr_qty`, d.`material_nama`, d.`mk_armada_nopol`, f.`material_kode`, d.mk_dn_m_qty, d.mk_dn_t, d.mk_dn_t_qty, 
        d.mk_tm_gal_kos, d.mk_tm_gal_isi, d.mk_tk_gal_kos_aqua, d.mk_tk_gal_kos_vit, d.mk_tk_gal_isi_aqua, d.mk_tk_gal_isi_vit
        FROM db_sc_modust.`tbl_sc_armada_barcode` d
        LEFT JOIN db_sc_modust.`tbl_sc_armada_barcode_waktu` e ON d.`mk_barcode` = e.`mk_barcode`
        LEFT JOIN db_sc_modust.`tbl_sc_po_depo` a ON d.`mk_po_old` = a.`po_po_old`
        LEFT JOIN db_sc_modust.`tbl_sc_transporter` b ON a.`po_transporter_kode` = b.`transporter_kode`
        LEFT JOIN db_sc_modust.`tbl_sc_jadwal_supply` c ON c.`js_co` = a.`po_co`
        LEFT JOIN db_sc_modust.`tbl_sc_material` f ON d.`material_nama` = f.`material_nama`
        LEFT JOIN tbg_depo.`tbg_master_product` g ON d.`material_nama` = g.`product_name`
        WHERE d.`mk_dn_m` = '$dn'");
        return $query->result();
    }

    function getDataTambahBkbSupplier($dn)
    {
        $this->db2 = $this->load->database('waterin', true);
        $query = $this->db2->query("SELECT g.`product_name`, g.`product_code`, a.`po_return_isi`, a.`po_jugrack`, a.`po_gal_kos`, a.`po_palet`, a.`po_nopol`, a.`po_driver`, a.`po_driver_pengganti`, a.`po_transporter_kode`, d.`mk_po`, b.`transporter_nama_npwp`,
        c.`js_day`, c.`js_date`, c.`pabrik_nama`, c.`material_nama`, c.`js_tujuan_co`, d.`mk_depo_tujuan`, e.`mk_masuk_tujuan`, a.`po_co`,
        d.`mk_dn_m`, d.`mk_dn_date`, d.`mk_dn_van`, d.`mk_armada_driver`, d.`material_nama`, d.`mk_muatan_masuk`,
        d.`mk_gr`, d.`mk_gr_qty`, d.`material_nama`, d.`mk_armada_nopol`, f.`material_kode`, d.mk_dn_m_qty, d.mk_dn_t, d.mk_dn_t_qty, 
        d.mk_tm_gal_kos, d.mk_tm_gal_isi, d.mk_tk_gal_kos_aqua, d.mk_tk_gal_kos_vit, d.mk_tk_gal_isi_aqua, d.mk_tk_gal_isi_vit, d.`mk_bs_depo`
        FROM db_sc_modust.`tbl_sc_armada_barcode` d
        LEFT JOIN db_sc_modust.`tbl_sc_armada_barcode_waktu` e ON d.`mk_barcode` = e.`mk_barcode`
        LEFT JOIN db_sc_modust.`tbl_sc_po_depo` a ON d.`mk_po_old` = a.`po_po_old`
        LEFT JOIN db_sc_modust.`tbl_sc_transporter` b ON a.`po_transporter_kode` = b.`transporter_kode`
        LEFT JOIN db_sc_modust.`tbl_sc_jadwal_supply` c ON c.`js_co` = a.`po_co`
        LEFT JOIN db_sc_modust.`tbl_sc_material` f ON d.`material_nama` = f.`material_nama`
        LEFT JOIN tbg_depo.`tbg_master_product` g ON d.`material_nama` = g.`product_name`
        WHERE d.`mk_dn_m` = '$dn'");
        return $query->result();
    }

    function getListHistoryBtbSupp($tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szDocId`, a.`szRefDocId`, a.`dtmDN` FROM $base.`dms_inv_docstockinsupplier` a
        LEFT JOIN $base.`dms_inv_stockadjustmentrefdoc` b ON a.`szDocId` = b.`szAdjustmentId` AND b.`szRefDocTypeId` = 'DMSDocStockInSupplier'
        WHERE a.`dtmDoc` = '$tanggal' AND a.`szBranchId` = '".$this->session->userdata('user_branch')."' AND b.`szRefDocId` IS NULL ORDER BY a.szDocId DESC");
        return $query->result();
        $this->db2->close();
    }

    function getDataCetakBtbSupp($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT c.`szName`, a.`szDriver`, a.`szDriver2`, a.`szVehicle2`, a.`szVehicle`, a.`szDocId`, a.`dtmDoc`, a.`szStockType`, a.`szDescription`,
        b.`szProductId`, d.`szName`, b.`szUomId`, b.`decQty`
        FROM $base.`dms_inv_docstockinsupplier` a
        LEFT JOIN $base.`dms_inv_docstockinsupplieritem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        WHERE a.`szDocId` = '$document'");
        return $query->result();
        $this->db2->close();
    }

    function editBtbSupplier($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szWarehouseId`, c.`szName` AS namaGudang, a.`szRefDocId`, a.`dtmDN`, a.`szDriver2`, a.`szVehicle2`, a.`szVehicle`, a.`szDocId`, a.`dtmDoc`, a.`szStockType`, g.`szName` AS tipe, a.`szDescription`,
        a.`szSupplierId`, e.`szName` AS supplier, a.`szRefDocId`, a.`dtmDN`, a.`szCarrierId`, f.`szName` AS jasaPengangkut, a.`szRef1`, a.`szRef2`, a.`szRef3`,
        b.`szProductId`, d.`szName` AS produk, b.`szUomId`, b.`decQty`
        FROM $base.`dms_inv_docstockinsupplier` a
        LEFT JOIN $base.`dms_inv_docstockinsupplieritem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN $base.`dms_ap_supplier` e ON a.`szSupplierId` = e.`szId`
        LEFT JOIN $base.`dms_inv_carrier` f ON f.`szId` = a.`szCarrierId`
        LEFT JOIN $base.`dms_inv_stocktype` g ON a.`szStockType` = g.`szId`
        WHERE a.`szDocId` = '$document'");
        return $query->result();
        $this->db2->close();
    }

    function getKendaraan($carrier)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.szVehicleNo, a.`szDriverName` FROM $base.`dms_inv_carriervehicle` a
        WHERE a.`szId` = '$carrier'");
        return $query->result();
        $this->db2->close();
    }

    function getPengemudi($carrier)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szDriverName` FROM $base.`dms_inv_carrierdriver` a
        WHERE a.`szId` = '$carrier'");
        return $query->result();
        $this->db2->close();
    }

    function getDataTambahBkbDistribution($bkb)
    {
        $this->db2 = $this->load->database('waterout', true);
        $query = $this->db2->query("SELECT a.`tanggal`, a.`no_bkb`, a.`nopol`, a.`driver`, a.`sisa_aqua`, a.`sisa_vit`, a.`jambot_aqua`, a.`jambot_vit`
        ,d.`jml_fisik` AS scrKos, d.`jml_bs` AS scrBs, d.`jml_sisa` AS scrSisa, d.`jambot_aqua` AS scrJambotAq, d.`jambot_vit` AS scrJambotVt
        , b.`prod_kos` AS kosonganAq, b.`qty` AS qtyAq, c.`prod_kos` AS kosonganvt, c.`qty` AS qtyVt
        FROM bs.`tbl_head_bkb` a
        LEFT JOIN bs.`tbl_head_bkb2` d ON a.`no_bkb` = d.`no_bkb`
        LEFT JOIN bs.`tbl_kos_aqua` b ON a.`no_bkb` = b.`no_bkb`
        LEFT JOIN bs.`tbl_kos_vit` c ON a.`no_bkb` = c.`no_bkb`
        WHERE a.`no_bkb` = '$bkb'");
        return $query->result();
        $this->db2->close();
    }

    function getDataTambahBkbDistributionSps($bkb)
    {
        $this->db2 = $this->load->database('waterout', true);
        $query = $this->db2->query("SELECT a.no_bkb, d.`szEmployeeId`, a.`driver`, a.`nopol`, b.`pd_bkb`, b.`qty_sisa` AS sisaCkr, c.`qty_bs` AS bsScr, c.`qty_sisa` AS sisaScr, h.`szId`, h.`szName`, h.`szUomId`
        FROM bs.`tbl_head_sps` a
        LEFT JOIN bs.`tbl_det_bkbsps` b ON a.`no_bkb` = b.`no_bkb`
        LEFT JOIN bs.`tbl_detsps_scrin` c ON a.`no_bkb` = c.`no_bkb` AND b.`pd_bkb` = c.`pd_bkb`
        LEFT JOIN dms111asa.`dms_inv_product` h ON b.`pd_bkb` = h.`szName` 
        LEFT JOIN dms111asa.`dms_inv_docstockoutdistribution` d ON a.`no_bkb` = d.`szDocId`
        WHERE a.`no_bkb` = '".$bkb."'  AND b.`qty_sisa` <> '0'
        GROUP BY b.`pd_bkb`");
        return $query->result();
        $this->db2->close();
    }

    function getBsAqua($bkb)
    {
        $this->db2 = $this->load->database('waterout', true);
        $query = $this->db2->query("SELECT * FROM bs.`tbl_bs_aqua` bb
        WHERE bb.no_bkb = '$bkb'");
        return $query->result();
        $this->db2->close();
    }

    function getBsVit($bkb)
    {
        $this->db2 = $this->load->database('waterout', true);
        $query = $this->db2->query("SELECT * FROM bs.`tbl_bs_vit` bb
        WHERE bb.no_bkb = '$bkb'");
        return $query->result();
        $this->db2->close();
    }

    function stockOnHandDist($product, $lokasiId, $stockTypeId)
    {
        $depo = $this->session->userdata('user_branch');
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db3 = $this->load->database($namedept, true);
            $query = $this->db3->query("SELECT * FROM `dms_inv_stockonhand` b 
            WHERE b.`szProductId` IN ($product) 
            AND b.`szStockTypeId` IN ($stockTypeId) AND b.`szReportedAsId` = '$depo' 
            AND B.`szLocationId` IN ($lokasiId)");
        return $query->result();
        $this->db3->close();
    }

    function getDataCetakBtbDist($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szDocId`, a.dtmDoc, a.`szEmployeeId`, e.`szName` AS driver, c.`szName` AS gudang, a.`szVehicleId`
        , d.`szName` AS produk, b.`decQty`, a.`szDescription`, a.`szStockType`, b.`szProductId`, b.`szUomId`
        FROM $base.`dms_inv_docstockindistribution` a
        LEFT JOIN $base.`dms_inv_docstockindistributionitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN $base.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
        WHERE a.`szDocId` = '$document'");
        return $query->result();
        $this->db2->close();
    }

    function getDetMorphing($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $depo = $this->session->userdata('user_branch');

        $this->db2 = $this->load->database('waterout', true);
        $query = $this->db2->query("SELECT a.*, b.*, c.*, d.`szUomId` AS satuan, e.`szUomId` AS satuanTo FROM wo_admin.`tbl_ckr_morphing` a
        LEFT JOIN dms111$namedept.`dms_inv_warehouse` b ON a.`warehouse_id` = b.`szId`
        LEFT JOIN wo_admin.`tbl_ckr_morphing_detail` c ON a.`doc_id` = c.`doc_id`
        LEFT JOIN dms111$namedept.`dms_inv_product` d ON c.`product_id` = d.`szId`
        LEFT JOIN dms111$namedept.`dms_inv_product` e ON c.`product_to` = e.`szId`
        WHERE a.`doc_id` LIKE '$document%' AND a.`branch_id` = '$depo'
        -- GROUP BY a.`doc_id`
        ");
        return $query->result();
        $this->db2->close();
    }

    function getHistoryMorphing($tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`mdbaRefDoc` a
        LEFT JOIN $base.`dms_inv_docstockmorph` b ON a.`refId` = b.`szDocId`
        WHERE a.`refDocType` = 'DMSDocStockMorph' AND a.`refDepo` = '".$this->session->userdata('user_branch')."' 
        AND DATE(a.`refDateAdd`) = '$tanggal'
        ORDER BY b.szDocId ASC");
        return $query->result();
    }

    function editMorphing($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT b.`szDocId`, a.`refOld`, a.`refTanggal`, c.`szName` AS gudang, g.`szId` AS idStok, g.`szName` AS stok, b.`szDescription` AS keterangan,
        d.`szId`, d.`szName` AS produk, e.`decQty`, f.`szId` AS kodeKe, f.`szName` AS produkKe, e.`decQtyTo`, d.`szUomId` AS satuan, f.`szUomId` AS satuanKe
        FROM $base.`mdbaRefDoc` a
        LEFT JOIN $base.`dms_inv_docstockmorph` b ON a.`refId` = b.`szDocId`
        LEFT JOIN $base.`dms_inv_docstockmorphitem` e ON a.`refId` = e.`szDocId`
        LEFT JOIN $base.`dms_inv_warehouse` c ON b.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON e.`szProductId` = d.`szId`
        LEFT JOIN $base.`dms_inv_product` f ON e.`szProductIdTo`= f.`szId`
        LEFT JOIN $base.`dms_inv_stocktype` g ON b.`szStockType` = g.`szId`
        WHERE a.`refId` = '$document'");
        return $query->result();
        $this->db2->close();
    }

    function getBtbDepot($doc)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT a.`szDocId`, a.`dtmDoc`, a.`szBranchId`, c.`szName` AS namaDepo, a.`szVehicleId`, a.`szEmployeeId`, a.`szStockType`, b.`szProductId`, g.`szName` AS produk, b.`decQty`, b.`szUomId`, h.`decQtyOnHand`, a.`szDescription`
        FROM dms.`dms_inv_docstockoutbranch` a
        LEFT JOIN dms.`dms_inv_docstockoutbranchitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN dms.`dms_sm_branch` c ON a.`szBranchId` = c.`szId`
        LEFT JOIN dms.`dms_inv_product` g ON b.`szProductId` = g.`szId`
        LEFT JOIN dms.`dms_inv_stockonhand` h ON b.`szProductId` = h.`szProductId` AND h.`szLocationType` = 'WAREHOUSE' AND h.`szStockTypeId` = a.`szStockType` AND h.`szReportedAsId` = a.`szPartyId`
        WHERE a.`szDocId` = '$doc'");
        return $query->result();
        $this->db2->close();
    }

    function getHistoryBtbDepot($tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, c.`refOld`, a.`dtmDoc` FROM $base.`dms_inv_docstockinbranch` a
        LEFT JOIN $base.`dms_inv_stockadjustmentrefdoc` b ON a.`szDocId` = b.`szAdjustmentId` AND b.`szRefDocTypeId` = 'DMSDocStockInBranch'
        LEFT JOIN $base.`mdbarefdoc` c ON c.`refId` = a.`szDocId`
        WHERE a.`dtmDoc` = '$tanggal' AND a.`szBranchId` = '".$this->session->userdata('user_branch')."' AND b.`szRefDocId` IS NULL ORDER BY a.szDocId DESC");
        return $query->result();
    }

    function getHistoryBkbDepot($tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, c.`refOld`, a.`dtmDoc` FROM $base.`dms_inv_docstockoutbranch` a
        LEFT JOIN $base.`dms_inv_stockadjustmentrefdoc` b ON a.`szDocId` = b.`szAdjustmentId` AND b.`szRefDocTypeId` = 'DMSDocStockOutBranch'
        LEFT JOIN $base.`mdbarefdoc` c ON c.`refId` = a.`szDocId`
        WHERE a.`dtmDoc` = '$tanggal' AND a.`szBranchId` = '".$this->session->userdata('user_branch')."' AND b.`szRefDocId` IS NULL ORDER BY a.szDocId DESC");
        return $query->result();
    }

    function editBtbDepot($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szDocId`, a.`dtmDoc`, h.`refOld`, e.`szName` AS pengemudi, a.`szEmployeeId`, a.`szVehicleId`, c.`szName` AS gudang, a.`szWarehouseId`, g.`szName` AS stok, a.`szStockType`, g.`szId` AS idStok, a.`szDescription`,
        d.`szName` AS produk, b.`decQty`, b.`szUomId`, b.`szProductId`, a.`szPartyId`
        FROM $base.`dms_inv_docstockinbranch` a
        LEFT JOIN $base.`dms_inv_docstockinbranchitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`mdbarefdoc` h ON a.`szDocId` = h.`refId` 
        LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN $base.`dms_inv_stockonhand` i ON b.`szProductId` = i.`szProductId` AND i.`szLocationType` = 'WAREHOUSE' AND i.`szStockTypeId` = a.`szStockType` AND i.`szReportedAsId` = a.`szPartyId`
        LEFT JOIN $base.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
        LEFT JOIN $base.`dms_inv_stocktype` g ON a.`szStockType` = g.`szId`
        WHERE a.`szDocId` = '$document'");
        return $query->result();
        $this->db2->close();
    }

    function editBkbDepot($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        }
        else{
            $base = 'mdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        }
        else{
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szDocId`, a.`dtmDoc`, h.`refOld`, e.`szName` AS pengemudi, a.`szEmployeeId`, a.`szVehicleId`, c.`szName` AS gudang, a.`szWarehouseId`, g.`szName` AS stok, a.`szStockType`, g.`szId` AS idStok, a.`szDescription`,
        d.`szName` AS product, b.`decQty`, b.`szUomId`, b.`szProductId`, a.`szPartyId`, f.`szName` AS depo, j.`szName` AS so, k.`szName` AS kendaraan
        FROM $base.`dms_inv_docstockoutbranch` a
        LEFT JOIN $base.`dms_inv_docstockoutbranchitem` b ON a.`szDocId` = b.`szDocId`
        LEFT JOIN $base.`mdbarefdoc` h ON a.`szDocId` = h.`refId` 
        LEFT JOIN $base.`dms_inv_warehouse` c ON a.`szWarehouseId` = c.`szId`
        LEFT JOIN $base.`dms_inv_product` d ON b.`szProductId` = d.`szId`
        LEFT JOIN $base.`dms_inv_stockonhand` i ON b.`szProductId` = i.`szProductId` AND i.`szLocationType` = 'WAREHOUSE' AND i.`szStockTypeId` = a.`szStockType` AND i.`szReportedAsId` = a.`szPartyId`
        LEFT JOIN $base.`dms_pi_employee` e ON a.`szEmployeeId` = e.`szId`
        LEFT JOIN $base.`dms_inv_stocktype` g ON a.`szStockType` = g.`szId`
        LEFT JOIN $base.`dms_sm_branch` f ON a.`szPartyId` = f.`szId`
        LEFT JOIN $base.`dms_ar_customer` j ON a.`szPartyId` = j.`szId`
        LEFT JOIN $base.`dms_inv_vehicle` k ON a.`szVehicleId` = k.`szId`
        WHERE a.`szDocId` = '$document'");
        return $query->result();
        $this->db2->close();
    }
}
