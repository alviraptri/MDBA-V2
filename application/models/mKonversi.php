<?php
class mKonversi extends CI_Model
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

    function getDataDoPPN($tgl, $ppn)
    {
        $depo = $this->session->userdata('user_branch');
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }

        if ($ppn == '11%') {
            $query = $this->db->query("SELECT a.*, b.*, (b.decAmount/1.10) AS dpp, ((b.decAmount/1.10)*0.10) AS tax, 
            a.`szDocSoId`, (c.`decAmount`/1.11) AS dppSO, ((c.decAmount/1.11)*0.11) AS taxSO,
            c.`iId` AS soIid, c.`szDocId` AS soSzDocId, c.`intItemNumber` AS soIntItemNumber, c.`intItemDetailNumber` AS soIntItemDetailNumber, 
            c.`szPriceId` AS soSzPriceId, c.`decPrice` AS soDecPrice, c.`decDiscount` AS soDecDiscount, c.`bTaxable` AS soBTaxable, 
            c.`decAmount` AS soDecAmount, c.`decTax` AS soDecTax, c.`decDpp` AS soDecDpp, c.`szTaxId` AS soSzTaxId, 
            c.`decTaxRate` AS soDecTaxRate, c.`decDiscPrinciple` AS soDecDiscPrinciple, c.`decDiscDistributor` AS soDecDiscDistributor, 
            c.`decDiscInternal` AS soDecDiscInternal
            FROM $base.`dms_sd_docdo` a
            LEFT JOIN $base.`dms_sd_docdoitemprice` b ON a.`szDocId` = b.`szDocId`
            LEFT JOIN $base.`dms_sd_docsoitemprice` c ON a.`szDocSoId` = c.`szDocId`
            WHERE b.`bTaxable` = '1' AND a.`dtmDoc` = '$tgl' AND b.`decTaxRate` = '11.0000' AND a.`szBranchId` = '$depo' AND b.`decAmount` <> '0'");
        } else {
            $query = $this->db->query("SELECT b.*, (b.decAmount/1.11) AS dpp, ((b.decAmount/1.11)*0.11) AS tax,
            a.`szDocSoId`, (c.`decAmount`/1.11) AS dppSO, ((c.decAmount/1.11)*0.11) AS taxSO,
            c.`iId` AS soIid, c.`szDocId` AS soSzDocId, c.`intItemNumber` AS soIntItemNumber, c.`intItemDetailNumber` AS soIntItemDetailNumber, 
            c.`szPriceId` AS soSzPriceId, c.`decPrice` AS soDecPrice, c.`decDiscount` AS soDecDiscount, c.`bTaxable` AS soBTaxable, 
            c.`decAmount` AS soDecAmount, c.`decTax` AS soDecTax, c.`decDpp` AS soDecDpp, c.`szTaxId` AS soSzTaxId, 
            c.`decTaxRate` AS soDecTaxRate, c.`decDiscPrinciple` AS soDecDiscPrinciple, c.`decDiscDistributor` AS soDecDiscDistributor, 
            c.`decDiscInternal` AS soDecDiscInternal
            FROM $base.`dms_sd_docdo` a
            LEFT JOIN $base.`dms_sd_docdoitemprice` b ON a.`szDocId` = b.`szDocId`
            LEFT JOIN $base.`dms_sd_docsoitemprice` c ON a.`szDocSoId` = c.`szDocId`    
            WHERE b.`bTaxable` = '1' AND a.`dtmDoc` = '$tgl' AND b.`decTaxRate` = '10.0000' AND a.`szBranchId` = '$depo' AND b.`decAmount` <> '0'");
        }

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }

    function getDataInvoicePPN($tgl, $ppn)
    {
        $depo = $this->session->userdata('user_branch');
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }

        if ($ppn == '11%') {
            $query = $this->db->query("SELECT c.*, (c.decAmount/1.11) AS dpp, ((c.decAmount/1.11)*0.11) AS tax, a.szDocId AS nodo
            FROM $base.`dms_sd_docdo` a
            LEFT JOIN $base.`dms_sd_docdoinvoice` b ON a.`szDocId` = b.`szDocId`
            LEFT JOIN $base.`dms_sd_docinvoiceitemprice` c ON c.`szDocId` = b.`szDocInvoiceId`
            WHERE c.`bTaxable` = '1' AND a.`dtmDoc` = '$tgl' AND c.`decTaxRate` = '10.0000' AND a.`bCash` = '1' AND a.`szBranchId` = '$depo'");
        } else {
            $query = $this->db->query("SELECT c.*, (c.decAmount/1.1) AS dpp, ((c.decAmount/1.1)*0.10) AS tax, a.szDocId AS nodo
            FROM $base.`dms_sd_docdo` a
            LEFT JOIN $base.`dms_sd_docdoinvoice` b ON a.`szDocId` = b.`szDocId`
            LEFT JOIN $base.`dms_sd_docinvoiceitemprice` c ON c.`szDocId` = b.`szDocInvoiceId`
            WHERE c.`bTaxable` = '1' AND a.`dtmDoc` = '$tgl' AND c.`decTaxRate` = '10.0000' AND a.`bCash` = '1' AND a.`szBranchId` = '$depo'");
        }

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }

    function getDataInvPPN($invoiceTo, $invoiceFr)
    {
        $depo = $this->session->userdata('user_branch');
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'dms111asa';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'dms111tvip';
            $base = 'dummymdbatvip';
        }

        $query = $this->db->query("SELECT a.*, b.*,
        CASE WHEN b.decTaxRate = '10.0000' THEN (b.decAmount/1.11)
        ELSE (b.decAmount/1.1)
        END AS dpp,
        CASE WHEN b.decTaxRate = '10.0000' THEN ((b.decAmount/1.11)*0.11)
        ELSE ((b.decAmount/1.1)*0.10)
        END AS ppn 
        FROM dummymdbaasa.`dms_sd_docinvoice` a
        LEFT JOIN dummymdbaasa.`dms_sd_docinvoiceitemprice` b ON a.`szDocId` = b.`szDocId`
        WHERE a.`szDocId` BETWEEN '$invoiceFr' AND '$invoiceTo' AND a.`bCash` = '0' AND b.`bTaxable` = '1'");

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }
}
