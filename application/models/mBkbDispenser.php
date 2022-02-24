<?php
class mBkbDispenser extends CI_Model
{
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
        $query = $this->db2->query("SELECT intLastCounter FROM dmstesting.dms_sm_counter WHERE szId = '$id'");
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
        $query = $this->db2->query("SELECT intLastCounter FROM dmstesting.dms_sm_counter WHERE szId = '$id'");
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
        $query = $this->db2->query("SELECT intLastCounter FROM dmstesting.dms_sm_counter WHERE szId = '$countId'");
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

    function getProduct()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'asa';
        }
        else{
            $base = 'tvip';
        }
        $this->db2 = $this->load->database($base, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_inv_product` a
        WHERE a.`szId` IN (SELECT b.`szProductId` FROM dms.`dms_inv_sninfo` b
        GROUP BY b.`szProductId`)
        ");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
        $this->db2->close();
    }

    function getBranch($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        }
        else{
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szId`, a.`szName` FROM $base.`dms_sm_branch` a
        WHERE a.`szId` <> '$depo' AND a.`szId` NOT IN ('991S', '993S', '317', '991', '992') ORDER BY a.szId");

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

    function getSerialNumber($produk)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        }
        else{
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szSNId` FROM $base.`dms_inv_sninfo` a
        WHERE a.`szProductId` = '$produk'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDetProduk($produk)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        }
        else{
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT * FROM $base.`dms_inv_product` a
        WHERE a.`szId` = '$produk'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }
}

?>