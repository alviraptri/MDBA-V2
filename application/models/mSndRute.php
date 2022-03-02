<?php
class mSndRute extends CI_Model
{
    function detailRute($employee, $route)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szId`, b.`szName`, a.`bMon`, a.`bTue`, a.`bWed`, a.`bThu`, a.`bFri`, a.`bSat`, a.`bSun` 
        FROM $base.`dms_ar_customerrouteinfo` a
        LEFT JOIN $base.`dms_ar_customer` b ON a.`szId` = b.`szId`
        WHERE a.`szEmployeeId` = '$employee' AND a.`szRouteType` = '$route'
        AND CASE WHEN DAYNAME(CURDATE()) = 'Monday' THEN a.`bMon` = '1' 
                        WHEN DAYNAME(CURDATE()) = 'Tuesday' THEN a.`bTue` = '1'
                        WHEN DAYNAME(CURDATE()) = 'Wednesday' THEN a.`bWed` = '1'  
                        WHEN DAYNAME(CURDATE()) = 'Thrusday' THEN a.`bThu` = '1'
                        WHEN DAYNAME(CURDATE()) = 'Friday' THEN a.`bFri` = '1'
                        WHEN DAYNAME(CURDATE()) = 'Saturday' THEN a.`bSat` = '1'
                        WHEN DAYNAME(CURDATE()) = 'Sunday' THEN a.`bSun` = '1'
                        ELSE FALSE
                    END 
                AND CASE WHEN FLOOR((DAYOFMONTH(CURDATE())-1)/7)+1 = '1' THEN a.`bWeek1` = '1' 
                        WHEN FLOOR((DAYOFMONTH(CURDATE())-1)/7)+1 = '2' THEN a.`bWeek2` = '1'
                        WHEN FLOOR((DAYOFMONTH(CURDATE())-1)/7)+1 = '3' THEN a.`bWeek3` = '1'  
                        WHEN FLOOR((DAYOFMONTH(CURDATE())-1)/7)+1 = '4' THEN a.`bWeek4` = '1'
                        ELSE FALSE
                    END
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }
}

?>