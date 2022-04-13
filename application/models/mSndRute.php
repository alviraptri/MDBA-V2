<?php
class mSndRute extends CI_Model
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

    function detailRute($employee, $route)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT b.`szCustomerId`, c.`szName`, a.`szDescription`, b.`intDay1`, b.`intDay2`, b.`intDay3`, b.`intDay4`, b.`intDay5`, b.`intDay6`, b.`intDay7`
        FROM $base.`dms_sd_route` a
        LEFT JOIN $base.`dms_sd_routeitem` b ON a.`szId` = b.`szId`
        LEFT JOIN $base.`dms_ar_customer` c ON b.`szCustomerId` = c.`szId`
        WHERE a.`szId` = '$employee' AND a.`szRouteType` = '$route'
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
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }

    function checkRoute($fileName, $type)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $query = $this->db->query("SELECT * FROM $base.`dms_sd_route` a
        WHERE a.`szEmployeeId` = '$fileName' AND a.`szRouteType` = '$type'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }

    function checkCust($fileName, $refCust)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $query = $this->db->query("SELECT * FROM $base.`dms_sd_routeitem` a
        WHERE a.`szId` = '$fileName' AND a.`szCustomerId` IN ($refCust)");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }

    function intCust($route)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $query = $this->db->query("SELECT * FROM $base.`dms_sd_routeitem` a
        WHERE a.`szId` = '$route'
        ORDER BY a.`intItemNumber` DESC LIMIT 1");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }
}

?>