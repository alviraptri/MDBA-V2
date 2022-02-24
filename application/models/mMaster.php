<?php
class mMaster extends CI_Model
{
    function getNamaDepo($asalDepo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT a.`szId`, a.`szName` FROM dms.`dms_sm_branch` a
            WHERE a.`szId` = '$asalDepo'   
        ");
        return $query->result();
        $this->db2->close();
    }

    function getNamaSo($so)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT b.`szName` FROM dms.`dms_ar_customerstructure` a 
        LEFT JOIN dms.`dms_ar_customer` b ON a.`szId` = b.szId
        WHERE a.szId = '$so'
        ");
        return $query->result();
        $this->db2->close();
    }

    function getPengemudi($pengemudi)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_pi_employee` a
            WHERE a.`szId` = '$pengemudi'   
        ");
        return $query->result();
        $this->db2->close();
    }

    function getKendaraan($kendaraan)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_inv_vehicle` a
        WHERE a.`szId` = '$kendaraan'   
        ");
        return $query->result();
        $this->db2->close();
    }

    function getProduk($produk)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT * FROM dms.`dms_inv_product` a
        WHERE a.`szId` = '$produk'   
        ");
        return $query->result();
        $this->db2->close();
    }

    function getCustomer($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT a.`szId` FROM dms.`dms_ar_customerstructure` a
        WHERE a.`szSoldToBranchId` = '$depo'   
        ");
        return $query->result();
        $this->db2->close();
    }
}

?>