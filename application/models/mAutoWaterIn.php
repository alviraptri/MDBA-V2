<?php
class mAutoWaterIn extends CI_Model
{
    //BKB
    function getArmadaWaktu()
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        $tglFinish = date('Y-m-d');
        $query = $this->db->query("SELECT b.`mk_barcode` FROM mdba.`mdbawiarmadaoutwaktu` b 
        WHERE b.`mk_bongkar_tgl` BETWEEN '$tglStart' AND '$tglFinish' 
        ");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return 0;
        }
    }

    function getArmadaBarcodeWaktu($barcodeId)
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        $tglFinish = date('Y-m-d');
        $this->db2 = $this->load->database('dashboard', true);
        if ($barcodeId == '0') {
            $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b 
            WHERE b.`mk_bongkar_tgl` BETWEEN '$tglStart' AND '$tglFinish'");
        }
        else{
            $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b 
            WHERE b.`mk_bongkar_tgl` BETWEEN '$tglStart' AND '$tglFinish' AND b.`mk_barcode` NOT IN ($barcodeId)");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return 0;
        }
        $this->db2->close();
    }

    function getArmadaBarcode($waktuId)
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        $tglFinish = date('Y-m-d');
        $this->db2 = $this->load->database('dashboard', true);
        if ($waktuId == '0') {
            $query = $this->db2->query("SELECT a.* FROM mdb_db_sc_modust.`tbl_sc_armada_barcode` a
            LEFT JOIN mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` 
            WHERE b.`mk_bongkar_tgl` BETWEEN '$tglStart' AND '$tglFinish'");
        }
        else{
            $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_armada_barcode` a
            WHERE a.`mk_barcode` IN ($waktuId)");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return 0;
        }
        $this->db2->close();
    }

    function getArmadaPo($poId)
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        $tglFinish = date('Y-m-d');
        $this->db2 = $this->load->database('dashboard', true);
        if ($poId == '0') {
            $query = $this->db2->query("SELECT c.* FROM mdb_db_sc_modust.`tbl_sc_armada_barcode` a
            LEFT JOIN mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
            LEFT JOIN mdb_db_sc_modust.`tbl_sc_po_depo` c ON a.`mk_po` = c.`po_po_new`
            WHERE b.`mk_bongkar_tgl` BETWEEN '$tglStart' AND '$tglFinish'");
        }
        else{
            $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_po_depo` a
            WHERE a.`po_po_new` IN ($poId)");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return 0;
        }
        $this->db2->close();
    }

    function getArmadaCo($coId)
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        $tglFinish = date('Y-m-d');
        $this->db2 = $this->load->database('dashboard', true);
        if ($coId == '0') {
            $query = $this->db2->query("SELECT c.* FROM mdb_db_sc_modust.`tbl_sc_armada_barcode` a
            LEFT JOIN mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
            LEFT JOIN mdb_db_sc_modust.`tbl_sc_jadwal_supply` c ON a.`mk_co_real` = c.`js_co`
            WHERE b.`mk_bongkar_tgl` BETWEEN '$tglStart' AND '$tglFinish'");
        }
        else{
            $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_jadwal_supply` a
            WHERE a.`js_co` IN ($coId)");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return 0;
        }
        $this->db2->close();
    }

    //BTB
    function getArmadaWaktuIn()
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        $tglFinish = date('Y-m-d');
        $query = $this->db->query("SELECT b.`mk_barcode` FROM mdba.`mdbawiarmadainwaktu` b 
        WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish' 
        ");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return 0;
        }
    }

    function getArmadaBarcodeWaktuIn($barcodeId)
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        $tglFinish = date('Y-m-d');
        $this->db2 = $this->load->database('dashboard', true);
        if ($barcodeId == '0') {
            $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b 
            WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish'");
        }
        else{
            $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b 
            WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish' AND b.`mk_barcode` NOT IN ($barcodeId)");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return 0;
        }
        $this->db2->close();
    }

    function getArmadaBarcodeIn($waktuId)
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        $tglFinish = date('Y-m-d');
        $this->db2 = $this->load->database('dashboard', true);
        if ($waktuId == '0') {
            $query = $this->db2->query("SELECT a.* FROM mdb_db_sc_modust.`tbl_sc_armada_barcode` a
            LEFT JOIN mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` 
            WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish'");
        }
        else{
            $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_armada_barcode` a
            WHERE a.`mk_barcode` IN ($waktuId)");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return 0;
        }
        $this->db2->close();
    }

    function getArmadaPoIn($poId)
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        $tglFinish = date('Y-m-d');
        $this->db2 = $this->load->database('dashboard', true);
        if ($poId == '0') {
            $query = $this->db2->query("SELECT c.* FROM mdb_db_sc_modust.`tbl_sc_armada_barcode` a
            LEFT JOIN mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
            LEFT JOIN mdb_db_sc_modust.`tbl_sc_po_depo` c ON a.`mk_po` = c.`po_po_new`
            WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish'");
        }
        else{
            $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_po_depo` a
            WHERE a.`po_po_new` IN ($poId)");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return 0;
        }
        $this->db2->close();
    }

    function getArmadaCoIn($coId)
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        $tglFinish = date('Y-m-d');
        $this->db2 = $this->load->database('dashboard', true);
        if ($coId == '0') {
            $query = $this->db2->query("SELECT c.* FROM mdb_db_sc_modust.`tbl_sc_armada_barcode` a
            LEFT JOIN mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
            LEFT JOIN mdb_db_sc_modust.`tbl_sc_jadwal_supply` c ON a.`mk_co_real` = c.`js_co`
            WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish'");
        }
        else{
            $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_jadwal_supply` a
            WHERE a.`js_co` IN ($coId)");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else{
            return 0;
        }
        $this->db2->close();
    }

    
    //old
    // function getDataArmadaBarcodeIn()
    // {
    //     $tglStart = date('Y-m-d', strtotime('-1 days'));
    //     $tglFinish = date('Y-m-d');
    //     $query = $this->db->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_co_real` FROM mdba.`mdbawiarmadain` a
    //     LEFT JOIN mdba.`mdbawiarmadainwaktu` b ON a.`mk_barcode` = b.`mk_barcode`
    //     LEFT JOIN mdba.`mdbawiarmadainjadwal` c ON a.`mk_co_real` = c.`js_co`
    //     WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish' AND c.`js_tujuan_depo` IS NOT NULL 
    //     ");
    //     if ($query->num_rows() > 0) {
    //         return $query->result();
    //     }
    //     else{
    //         return 0;
    //     }
    // }

    // function getArmadaBarcodeIn($barcodeId)
    // {
    //     $tglStart = date('Y-m-d', strtotime('-1 days'));
    //     $tglFinish = date('Y-m-d');
    //     $this->db2 = $this->load->database('dashboard', true);
    //     if ($barcodeId == '0') {
    //         $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_armada_barcode` a
    //         LEFT JOIN mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
    //         LEFT JOIN mdb_db_sc_modust.`tbl_sc_jadwal_supply` c ON a.`mk_co_real` = c.`js_co`
    //         LEFT JOIN mdb_db_sc_modust.`tbl_sc_po_depo` d ON a.`mk_po` = d.`po_po_new`
    //         WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish' AND c.`js_tujuan_depo` IS NOT NULL");
    //     }
    //     if ($barcodeId != '0'){
    //         $query = $this->db2->query("SELECT * FROM mdb_db_sc_modust.`tbl_sc_armada_barcode` a
    //         LEFT JOIN mdb_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
    //         LEFT JOIN mdb_db_sc_modust.`tbl_sc_jadwal_supply` c ON a.`mk_co_real` = c.`js_co`
    //         LEFT JOIN mdb_db_sc_modust.`tbl_sc_po_depo` d ON a.`mk_po` = d.`po_po_new`
    //         WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish' AND c.`js_tujuan_depo` IS NOT NULL AND a.`mk_barcode` NOT IN ($barcodeId) ");
    //     }

    //     if ($query->num_rows() > 0) {
    //         return $query->result();
    //     }
    //     else{
    //         return 0;
    //     }
    //     $this->db2->close();
    // }
}

?>