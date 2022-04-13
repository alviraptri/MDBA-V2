<?php
class mSndProsesST extends CI_Model{

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
            $id = $value->intLastCounter + 1;
        }
        return $id;
        $this->db2->close();
    }

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
        c.`szCustomerId`, h.`szName` AS custName, c.`bOutOfRoute`
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

    function getEmployee($jenis)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szId`, a.`szName`, a.`szRouteType`
        FROM $base.`dms_sd_route` a
        LEFT JOIN $base.`dms_sd_routeitem` b ON a.`szId` = b.`szId`
        WHERE a.`szRouteType` = '$jenis'
        AND CASE WHEN DAYNAME(CURDATE()) = 'Monday' THEN b.`intDay1` = '1' 
                WHEN DAYNAME(CURDATE()) = 'Tuesday' THEN b.`intDay2` = '1'
                WHEN DAYNAME(CURDATE()) = 'Wednesday' THEN b.`intDay3` = '1'  
                WHEN DAYNAME(CURDATE()) = 'Thursday' THEN b.`intDay4` = '1'
                WHEN DAYNAME(CURDATE()) = 'Friday' THEN b.`intDay5` = '1'
                WHEN DAYNAME(CURDATE()) = 'Saturday' THEN b.`intDay6` = '1'
                WHEN DAYNAME(CURDATE()) = 'Sunday' THEN b.`intDay7` = '1'
                ELSE FALSE
            END 
        AND CASE WHEN FLOOR((DAYOFMONTH(CURDATE())-1)/7)+1 = '1' THEN b.`intWeek1` = '1' 
                WHEN FLOOR((DAYOFMONTH(CURDATE())-1)/7)+1 = '2' THEN b.`intWeek2` = '1'
                WHEN FLOOR((DAYOFMONTH(CURDATE())-1)/7)+1 = '3' THEN b.`intWeek3` = '1'  
                WHEN FLOOR((DAYOFMONTH(CURDATE())-1)/7)+1 = '4' THEN b.`intWeek4` = '1'
                ELSE FALSE
            END 
            AND a.`szId` <> ''
            GROUP BY a.`szId` 
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }

    function getSTCustomer($tanggal, $jenis, $employee) 
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szId`, a.`szName`, a.`szRouteType`, b.`szCustomerId`
        FROM $base.`dms_sd_route` a
        LEFT JOIN $base.`dms_sd_routeitem` b ON a.`szId` = b.`szId`
        WHERE a.`szRouteType` = '$jenis' AND a.`szEmployeeId` = '$employee'
        AND CASE WHEN DAYNAME('$tanggal') = 'Monday' THEN b.`intDay1` = '1' 
                WHEN DAYNAME('$tanggal') = 'Tuesday' THEN b.`intDay2` = '1'
                WHEN DAYNAME('$tanggal') = 'Wednesday' THEN b.`intDay3` = '1'  
                WHEN DAYNAME('$tanggal') = 'Thursday' THEN b.`intDay4` = '1'
                WHEN DAYNAME('$tanggal') = 'Friday' THEN b.`intDay5` = '1'
                WHEN DAYNAME('$tanggal') = 'Saturday' THEN b.`intDay6` = '1'
                WHEN DAYNAME('$tanggal') = 'Sunday' THEN b.`intDay7` = '1'
                ELSE FALSE
            END 
        AND CASE WHEN FLOOR((DAYOFMONTH('$tanggal')-1)/7)+1 = '1' THEN b.`intWeek1` = '1' 
                WHEN FLOOR((DAYOFMONTH('$tanggal')-1)/7)+1 = '2' THEN b.`intWeek2` = '1'
                WHEN FLOOR((DAYOFMONTH('$tanggal')-1)/7)+1 = '3' THEN b.`intWeek3` = '1'  
                WHEN FLOOR((DAYOFMONTH('$tanggal')-1)/7)+1 = '4' THEN b.`intWeek4` = '1'
                ELSE FALSE
            END 
            AND a.`szId` <> ''
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }
}
