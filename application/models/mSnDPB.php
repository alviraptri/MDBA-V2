<?php
class mSnDPB extends CI_Model
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

    //counter
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
    //end counter

    //master
    function vehicle($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
        } else {
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
    //end master

    function getDetPB($id)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, d.`szDocId` AS noBkb, DATE(a.`dtmDoc`) as dtmDoc, a.`szEmployeeId`, b.`szName` AS pengemudi, a.`szVehicleId`, c.`szName` AS kendaraan, a.`szWarehouseId`, e.`szName` AS gudang,
        a.`szStockType`, f.`szName` AS tipe, g.`szProductId`, h.`szName` AS produk, g.`decQty`, g.`szUomId`, i.Status
        FROM $base.`dms_sd_docproductrequest` a
        LEFT JOIN $base.`dms_pi_employee` b ON a.`szEmployeeId` = b.`szId`
        LEFT JOIN $base.`dms_inv_vehicle` c ON a.`szVehicleId` = c.`szId`
        LEFT JOIN $base.`dms_inv_docstockoutdistributionpr` d ON a.`szDocId` = d.`szDocProductRequestId`
        LEFT JOIN $base.`dms_inv_warehouse` e ON a.`szWarehouseId` = e.`szId` 
        LEFT JOIN $base.`dms_inv_stocktype` f ON a.`szStockType` = f.`szId`
        LEFT JOIN $base.`dms_sd_docproductrequestitem` g ON a.`szDocId` = g.`szDocId`
        LEFT JOIN $base.`dms_inv_product` h ON g.`szProductId` = h.`szId`
        LEFT JOIN $base.`mdbapbstatus` i ON a.`szDocId` = i.`pbDoc`
        WHERE a.`szDocId` = '$id'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getGudang($depo)
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
            $base = 'mdbaasa';
            $namedept = 'dms111asa';
        } else {
            $base = 'mdbatvip';
            $namedept = 'dms111tvip';
        }

        // $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT * FROM $namedept.`dms_pi_employee` a
        WHERE a.`szBranchId` = '$depo' AND a.`szId` LIKE '$depo-%'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        // $this->db2->close();
    }

    function getVehicle($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
            $namedept = 'dms111asa';
        } else {
            $dept = 'tvip';
            $namedept = 'dms111tvip';
        }

        $this->db2 = $this->load->database($dept, true);
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
        $this->db2->close();
    }

    function getProduct()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
            $namedept = 'dms111asa';
        } else {
            $base = 'tvip';
            $namedept = 'dms111tvip';
        }
        $this->db2 = $this->load->database($base, true);
        $query = $this->db->query("SELECT * FROM $namedept.`dms_inv_product` a WHERE a.`szDescription` = 'ecommerce'
        ");

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
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
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
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`dms_inv_vehicle` a
        WHERE a.`szId` = '$kendaraan'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getProduk($produk, $stok, $gudang)
    {
        $depo = $this->session->userdata('user_branch');
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        } else {
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

    function select_row_data($select, $table, $where='', $order='') {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);

        $this->db2->select($select);
        if(!empty($where)) {
            $this->db2->where($where);
        }
        if(!empty($order)) {
            $this->db2->order_by($order[0], $order[1]);
        }
        $get = $this->db2->get($table);

        return $get;
    }

    function select_row_data_all($where='', $order='', $qty_kode=null, $gudang='', $stok='') {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'asa';
        } else {
            $dept = 'tvip';
        }

        $this->db2 = $this->load->database($dept, true);

        $this->db2->select('a.`iInternalId`
            , b.`iId`
            , b.`szId`
            , b.`szName`
            , b.`szUomId`
            , '.$qty_kode.' AS qty
            , c.`decQtyOnHand`');
        $this->db2->from('`dms_inv_productkitinfo` a');
        $this->db2->join('`dms_inv_product` b', 'a.`szProductId` = b.`szId`', 'inner');
        $this->db2->join('`dms_inv_stockonhand` c', 'b.`szId` = c.`szProductId` AND c.`szLocationId` = "'.$gudang.'" AND c.`szStockTypeId` = "'.$stok.'" ', 'inner');
        $this->db2->order_by('b.`szId` ASC');
        if(!empty($where)) {
            $this->db2->where_in("a.`szId`", $where);
        }
        if(!empty($order)) {
            $this->db2->order_by($order[0], $order[1]);
        }
        $get = $this->db2->get();

        return $get;
    }
    
}
