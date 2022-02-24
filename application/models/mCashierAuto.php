<?php
class mCashierAuto extends CI_Model
{
    function getDataTransfer($txId, $operator, $depo, $tanggal)
    {
        $query = $this->db->query("SELECT SUM(a.`staggingAmount`) AS staggingAmount, c.rit_driver, a.`driverNik`, a.`driverMesinId`, a.`staggingDate`, a.`staggingTx`, a.`staggingLoc`, a.`staggingLoc`,
        a.`staggingStatus`, b.`szName`, c.`nopol`, c.`kode_driver`, b.`szBranchId`,GROUP_CONCAT(a.`staggingTx` SEPARATOR ',') AS txId, e.`bankAcc`
        FROM mdba.`mdbaautostagging` a
        LEFT JOIN mdba.`dms_pi_employee_nik` b ON a.`driverMesinId` = b.`szIDMachine`
        LEFT JOIN bs.`tbl_driver_rit` c ON c.`kode_driver` = b.`szId`
        LEFT JOIN mdba.`mdbaautouser` d ON a.`staggingLoc` = d.`staggingLocation`
        LEFT JOIN mdba.`mdbaautobankacc` e ON d.`staggingBranch` = e.`bankDepo`
        WHERE DATE(a.`staggingDate`) = '$tanggal' AND d.`staggingBranch` = '$depo' 
        AND a.`staggingTx` = '$txId' AND a.`driverMesinId` = '$operator'
        GROUP BY a.`driverMesinId` 
        ORDER BY `a`.`staggingTx` ASC");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataManual($txId, $operator, $depo, $tanggal)
    {
        $query = $this->db->query("SELECT SUM(a.`staggingAmount`) AS staggingAmount, c.rit_driver, a.`driverNik`, a.`driverMesinId`, a.`staggingDate`, a.`staggingTx`, a.`staggingLoc`, a.`staggingLoc`,
        a.`staggingStatus`, b.`szName`, c.`nopol`, c.`kode_driver`, b.`szBranchId`,GROUP_CONCAT(a.`staggingTx` SEPARATOR ',') AS txId, e.`bankAcc`
        FROM mdba.`mdbaautostagging` a
        LEFT JOIN mdba.`dms_pi_employee_nik` b ON a.`driverMesinId` = b.`szIDMachine`
        LEFT JOIN bs.`tbl_driver_rit` c ON c.`kode_driver` = b.`szId`
        LEFT JOIN mdba.`mdbaautouser` d ON a.`staggingLoc` = d.`staggingLocation`
        LEFT JOIN mdba.`mdbaautobankacc` e ON d.`staggingBranch` = e.`bankDepo`
        WHERE DATE(a.`staggingDate`) = '$tanggal' AND d.`staggingBranch` = '$depo' 
        AND a.`staggingTx` IN ($txId) AND a.`driverMesinId` IN ($operator) AND a.`staggingStatus` = '0'
        GROUP BY a.`driverMesinId` 
        ORDER BY `a`.`staggingTx` ASC");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }
}

?>