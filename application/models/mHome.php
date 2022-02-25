<?php
class mHome extends CI_Model
{
    public function getNoBtb($depo, $tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }

        $branch = $this->session->userdata('user_branch');
        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db->query("SELECT a.`szDocId`, a.`szRefDocId` FROM $base.`dms_inv_docstockinsupplier` a
        WHERE a.`szBranchId` = '$branch' AND a.`dtmDoc` >= CURDATE() - INTERVAL 2 DAY AND a.`dtmDoc` <= CURDATE() + INTERVAL 1 DAY
        AND a.`szRef3` <> '0'
        GROUP BY a.`szRef3`");
        return $query->result();
        $this->db2->close();
    }

    public function getNoBkb($depo, $tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $branch = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT a.`szDocId`, a.`szRefDocId` FROM $base.`dms_inv_docstockoutsupplier` a
        WHERE a.`szBranchId` = '$branch' AND a.`dtmDoc` >= CURDATE() - INTERVAL 2 DAY AND a.`dtmDoc` <= CURDATE() + INTERVAL 1 DAY
        AND a.`szRef3` <> '0'
        GROUP BY a.`szRef3`
        ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

    public function getWaterin($btbNo, $varian, $transaksi)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_lokasi');
        //curdate() diganti tanggal 13 sept 2021
        $this->db2 = $this->load->database("waterin", true);
        if ($transaksi == 'REGULER') {
            if ($varian == 'GLN') {
                if ($btbNo != '0') {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po_old`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`
                    FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                    LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                    WHERE b.`mk_masuk_tujuan` = '$depo' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`mk_po_old` NOT IN ($btbNo) AND a.`material_nama` IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                } else {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po_old`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`
                FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                WHERE b.`mk_masuk_tujuan` = '$depo' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`material_nama` IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                }
            } else {
                if ($btbNo != '0') {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po_old`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`
                    FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                    LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                    WHERE b.`mk_masuk_tujuan` = '$depo' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`mk_po_old` NOT IN ($btbNo) AND a.`material_nama` NOT IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                } else {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po_old`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`
                FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                WHERE b.`mk_masuk_tujuan` = '$depo' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`material_nama` NOT IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                }
            }
        } else {
            if ($varian == 'GLN') {
                if ($btbNo != '0') {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po_old`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`, a.`mk_so_tujuan`
                    FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                    LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                    WHERE a.`mk_so_tujuan` <> '' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`mk_po_old` NOT IN ($btbNo) AND a.`material_nama` IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                } else {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po_old`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`, a.`mk_so_tujuan`
                FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                WHERE a.`mk_so_tujuan` <> '' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`material_nama` IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                }
            } else {
                if ($btbNo != '0') {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po_old`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`, a.`mk_so_tujuan`
                    FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                    LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                    WHERE a.`mk_so_tujuan` <> '' AND  b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`mk_po_old` NOT IN ($btbNo) AND a.`material_nama` NOT IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                } else {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po_old`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`, a.`mk_so_tujuan`
                FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                WHERE a.`mk_so_tujuan` <> '' AND  b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`material_nama` NOT IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                }
            }
        }
        return $query->result();
        $this->db2->close();
    }

    function getWiBkb($ref, $depo)
    {
        $tglStart = date('Y-m-d', strtotime('-2 days'));
        $tglFinish = date('Y-m-d');

        $this->db2 = $this->load->database('waterin', true);
        if ($ref != 0) {
            $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_gr`, a.`mk_co_real`, a.`mk_dn_m`, a.`mk_dn_date` 
                FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
                WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish' AND b.`mk_masuk_tujuan` = '$depo'");
        } else {
            $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_gr`, a.`mk_co_real`, a.`mk_dn_m`, a.`mk_dn_date` 
                FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
                WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish' AND b.`mk_masuk_tujuan` = '$depo' AND a.`mk_dn_m` NOT IN ($ref)");
        }
        $this->db2->close();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

    function getWiBtb($ref, $depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $tglStart = date('Y-m-d', strtotime('-2 days'));
        $tglFinish = date('Y-m-d');

        $this->db2 = $this->load->database('waterin', true);
        if ($ref != 0) {
            $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_gr`, a.`mk_co_real`, a.`mk_dn_m` FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
            LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
            WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish' AND b.`mk_masuk_tujuan` = '$depo'");
        } else {
            $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_gr`, a.`mk_co_real`, a.`mk_dn_m` FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
            LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode`
            WHERE b.`mk_masuk_tujuan_tgl` BETWEEN '$tglStart' AND '$tglFinish' AND b.`mk_masuk_tujuan` = '$depo' AND a.`mk_dn_m` NOT IN ($ref)");
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

    public function getWaterinBkb($btbNo, $varian, $transaksi)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_lokasi');
        //curdate() diganti tanggal 13 sept 2021
        $this->db2 = $this->load->database("waterin", true);
        if ($transaksi == 'REGULER') {
            if ($varian == 'GLN') {
                if ($btbNo != '0') {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`
                    FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                    LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                    WHERE b.`mk_masuk_tujuan` = '$depo' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`mk_po` NOT IN ($btbNo) AND a.`material_nama` IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                } else {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`
                FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                WHERE b.`mk_masuk_tujuan` = '$depo' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`material_nama` IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                }
            } else {
                if ($btbNo != '0') {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`
                    FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                    LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                    WHERE b.`mk_masuk_tujuan` = '$depo' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`mk_po` NOT IN ($btbNo) AND a.`material_nama` NOT IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                } else {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`
                FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                WHERE b.`mk_masuk_tujuan` = '$depo' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`material_nama` NOT IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                }
            }
        } else {
            if ($varian == 'GLN') {
                if ($btbNo != '0') {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`, a.`mk_so_tujuan`
                    FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                    LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                    WHERE a.`mk_so_tujuan` <> '' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`mk_po` NOT IN ($btbNo) AND a.`material_nama` IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                } else {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`, a.`mk_so_tujuan`
                FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                WHERE a.`mk_so_tujuan` <> '' AND b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`material_nama` IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                }
            } else {
                if ($btbNo != '0') {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`, a.`mk_so_tujuan`
                    FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                    LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                    WHERE a.`mk_so_tujuan` <> '' AND  b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`mk_po` NOT IN ($btbNo) AND a.`material_nama` NOT IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                } else {
                    $query = $this->db2->query("SELECT a.`mk_barcode`, a.`mk_po`, a.`mk_co_real`, a.`mk_gr`, a.`mk_dn_m`, a.`mk_dn_date`, a.`mk_pool`, a.`mk_armada_driver`, a.`mk_armada_nopol`, a.`transporter_kode`, a.`pabrik_nama`, a.`material_nama`, a.`mk_varian_muatan`, a.`mk_so_tujuan`
                FROM mdba_db_sc_modust.`tbl_sc_armada_barcode` a
                LEFT JOIN mdba_db_sc_modust.`tbl_sc_armada_barcode_waktu` b ON a.`mk_barcode` = b.`mk_barcode` AND a.`mk_depo_tujuan` = b.`mk_masuk_tujuan`
                WHERE a.`mk_so_tujuan` <> '' AND  b.`mk_ke_tujuan_tgl` >= CURDATE() - INTERVAL 2 DAY AND b.`mk_ke_tujuan_tgl` <= CURDATE() + INTERVAL 1 DAY AND a.`mk_dn_date` <> '' AND a.`material_nama` NOT IN ('5 GALLON AQUA LOCAL', '5 GALLON VIT LOCAL')
                ");
                }
            }
        }
        return $query->result();
        $this->db2->close();
    }

    public function getGudang()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }
        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT * FROM dmstesting.`dms_inv_warehouse` c WHERE c.szBranchId = '" . $this->session->userdata('user_branch') . "'");
        return $query->result();
        $this->db2->close();
    }

    public function getTipeStok()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }
        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT a.szId, a.szName FROM dmstesting.`dms_inv_stocktype` a");
        return $query->result();
        $this->db2->close();
    }

    public function getCarrier()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }
        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT a.`szId`, a.`szName` FROM dmstesting.`dms_inv_carrier` a");
        return $query->result();
        $this->db2->close();
    }

    public function getProduk()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }
        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT a.`szId`, a.`szName` FROM dmstesting.`dms_inv_product` a
        ORDER BY a.`szName`");
        return $query->result();
        $this->db2->close();
    }

    public function getSupplier()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }
        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT a.`szId`, a.`szName` FROM dmstesting.`dms_ap_supplier` a
        WHERE a.`szId` NOT IN ('123', 'test', 'testinggg123')");
        return $query->result();
        $this->db2->close();
    }

    public function getRefBtb($depo, $stockTipeId)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`refOld` FROM $base.`mdbarefdoc` a
        WHERE a.`refDepo` = '$depo' AND a.`refDocType` = '$stockTipeId'");
        return $query->result();
    }

    function getWaterout($btbNo, $lokasi, $varian)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $this->db2 = $this->load->database('waterout', true);
        if ($varian == 'GLN') {
            if ($btbNo != '0') {
                $query = $this->db2->query("SELECT a.`no_bkb`, DATE(a.`tanggal`) AS tanggal, a.`nopol`, a.`driver` 
                FROM bs.`tbl_head_bkb` a
                LEFT JOIN bs.`tbl_det_bkb` b ON a.`no_bkb` = b.`no_bkb`
                WHERE a.`depo` = '$lokasi' AND a.`tanggal` >= CURDATE() - INTERVAL 2 DAY AND a.`tanggal` <= CURDATE() + INTERVAL 1 DAY AND a.`no_bkb` NOT IN ($btbNo)
                AND b.`pd_bkb` IN ('AQ.5GALLON BTL', 'VT 5GALLON BTL', 'VT.5GALON BTL')
                GROUP BY a.`no_bkb` ORDER BY a.`no_bkb` ASC
                ");
            } else {
                $query = $this->db2->query("SELECT a.`no_bkb`, DATE(a.`tanggal`) AS tanggal, a.`nopol`, a.`driver` 
                FROM bs.`tbl_head_bkb` a
                LEFT JOIN bs.`tbl_det_bkb` b ON a.`no_bkb` = b.`no_bkb`
                WHERE a.`depo` = '$lokasi' AND a.`tanggal` >= CURDATE() - INTERVAL 2 DAY AND a.`tanggal` <= CURDATE() + INTERVAL 1 DAY 
                AND b.`pd_bkb` IN ('AQ.5GALLON BTL', 'VT 5GALLON BTL', 'VT.5GALON BTL')
                GROUP BY a.`no_bkb` ORDER BY a.`no_bkb` ASC
                ");
            }
        } else {
            if ($btbNo != '0') {
                $query = $this->db2->query("SELECT a.`no_bkb`, DATE(a.`tanggal`) AS tanggal, a.`nopol`, a.`driver` , SUM(b.`qty_sisa`) AS jumlahSisa 
                FROM bs.`tbl_head_sps` a
                LEFT JOIN bs.`tbl_det_bkbsps` b ON a.`no_bkb` = b.`no_bkb`
                WHERE a.`depo` = '$lokasi' AND a.`tanggal` >= CURDATE() - INTERVAL 2 DAY AND a.`tanggal` <= CURDATE() + INTERVAL 1 DAY AND a.`no_bkb` NOT IN ($btbNo)
                AND b.`pd_bkb` NOT IN ('AQ.5GALLON BTL', 'VT 5GALLON BTL', 'VT.5GALON BTL') AND b.`qty_sisa` <> 0 
                GROUP BY a.`no_bkb` ORDER BY a.`no_bkb` ASC
                ");
            } else {
                $query = $this->db2->query("SELECT a.`no_bkb`, DATE(a.`tanggal`) AS tanggal, a.`nopol`, a.`driver` , SUM(b.`qty_sisa`) AS jumlahSisa 
                FROM bs.`tbl_head_sps` a
                LEFT JOIN bs.`tbl_det_bkbsps` b ON a.`no_bkb` = b.`no_bkb`
                WHERE a.`depo` = '$lokasi' AND a.`tanggal` >= CURDATE() - INTERVAL 2 DAY AND a.`tanggal` <= CURDATE() + INTERVAL 1 DAY 
                AND b.`pd_bkb` NOT IN ('AQ.5GALLON BTL', 'VT 5GALLON BTL', 'VT.5GALON BTL') AND b.`qty_sisa` <> 0 
                GROUP BY a.`no_bkb` ORDER BY a.`no_bkb` ASC
                ");
            }
        }
        return $query->result();
        $this->db2->close();
    }

    function getDriverDistribusi($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }
        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT * FROM dmstesting.`dms_pi_employee` a
        WHERE a.`szBranchId` IN ($depo) -- AND a.`szId` LIKE '$depo-%'
        GROUP BY a.`szId`");
        return $query->result();
        $this->db2->close();
    }

    function getVehicleDistribusi($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }
        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT a.`szId`, a.`szPoliceNo` FROM dmstesting.`dms_inv_vehicle` a
        WHERE a.`szBranchId` IN ($depo)");
        return $query->result();
        $this->db2->close();
    }

    function getCekData()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`refOld` FROM $base.`mdbaRefDoc` a
        WHERE a.`refDocType` = 'DMSDocStockMorph' AND a.`refDepo` = '" . $this->session->userdata('user_branch') . "' AND a.`refTanggal` >= CURDATE() - INTERVAL 3 DAY AND a.`refTanggal` <= CURDATE() + INTERVAL 1 DAY");
        return $query->result();
    }

    function getMorphing($referensi)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database('waterout', true);
        if ($referensi == '0') {
            $query = $this->db2->query("SELECT * FROM wo_admin.`tbl_ckr_morphing` a
            LEFT JOIN dms111$namedept.`dms_inv_warehouse` b ON a.`warehouse_id` = b.`szId`
            WHERE a.`branch_id` = '" . $this->session->userdata('user_branch') . "' AND a.`date` >= CURDATE() - INTERVAL 3 DAY AND a.`date` <= CURDATE() + INTERVAL 1 DAY
            GROUP BY a.`doc_id`");
        } else {
            $query = $this->db2->query("SELECT * FROM wo_admin.`tbl_ckr_morphing` a
            LEFT JOIN dms111$namedept.`dms_inv_warehouse` b ON a.`warehouse_id` = b.`szId`
            WHERE a.`branch_id` = '" . $this->session->userdata('user_branch') . "' AND a.`date` >= CURDATE() - INTERVAL 3 DAY AND a.`date` <= CURDATE() + INTERVAL 1 DAY AND a.`doc_id` NOT IN ($referensi)
            GROUP BY a.`doc_id`");
        }

        return $query->result();
        $this->db2->close();
    }

    function cekDataBtbDepot()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`refOld` FROM $base.`mdbaRefDoc` a
        WHERE a.`refDocType` = 'DMSDocStockInBranch' AND a.`refDepo` = '" . $this->session->userdata('user_branch') . "' AND a.`refTanggal` >= CURDATE() - INTERVAL 3 DAY AND a.`refTanggal` <= CURDATE() + INTERVAL 1 DAY");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function cekDataBtbDist()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT a.`szDocBkb` FROM $base.`mdbahistorydistributionin` a
        WHERE a.`szBranchId` = '$depo' AND a.`dtmDoc` >= CURDATE() - INTERVAL 2 DAY AND a.`dtmDoc` <= CURDATE() + INTERVAL 1 DAY");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function cekDataBkbDepot()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT * FROM $base.`mdbarefdoc` a
        WHERE a.`refDocType` = 'DMSDocStockOutBranch' AND a.refDepo = '$depo' AND a.`refDateAdd` >= CURDATE() - INTERVAL 3 DAY AND a.`refDateAdd` <= CURDATE() + INTERVAL 1 DAY");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getBtbDepot($ref)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $depo = $this->session->userdata('user_branch');

        $this->db2 = $this->load->database('waterout', true);
        if ($ref != '0') {
            $query = $this->db2->query("SELECT a.`no_bkb`, a.`submit_date`, a.`no_ref_in_ad`, a.`asal_gudang` FROM bs.`tbl_in_antardepo_gallon_chk` a
            LEFT JOIN dms111$namedept.`dms_inv_docstockoutbranch` c ON a.`no_bkb` = c.szDocId
            WHERE c.szPartyId = '$depo' AND a.no_bkb NOT IN ($ref) AND a.`submit_date` >= CURDATE() - INTERVAL 1 DAY AND a.`submit_date` <= CURDATE() + INTERVAL 1 DAY
            UNION
            SELECT b.`no_bkb`, b.`submit_date`, b.`no_ref_in_ad`, b.`asal_gudang` FROM bs.`tbl_in_antardepo_chk` b
            LEFT JOIN dms111$namedept.`dms_inv_docstockoutbranch` d ON b.`no_bkb` = d.szDocId
            WHERE d.szPartyId = '$depo' AND b.no_bkb NOT IN ($ref) AND b.`submit_date` >= CURDATE() - INTERVAL 1 DAY AND b.`submit_date` <= CURDATE() + INTERVAL 1 DAY
            ");
        } else {
            $query = $this->db2->query("SELECT a.`no_bkb`, a.`submit_date`, a.`no_ref_in_ad`, a.`asal_gudang` FROM bs.`tbl_in_antardepo_gallon_chk` a
            LEFT JOIN dms111$namedept.`dms_inv_docstockoutbranch` c ON a.`no_bkb` = c.szDocId AND a.`submit_date` >= CURDATE() - INTERVAL 1 DAY AND a.`submit_date` <= CURDATE() + INTERVAL 1 DAY
            WHERE c.szPartyId = '$depo' 
            UNION
            SELECT b.`no_bkb`, b.`submit_date`, b.`no_ref_in_ad`, b.`asal_gudang` FROM bs.`tbl_in_antardepo_chk` b
            LEFT JOIN dms111$namedept.`dms_inv_docstockoutbranch` d ON b.`no_bkb` = d.szDocId AND b.`submit_date` >= CURDATE() - INTERVAL 1 DAY AND b.`submit_date` <= CURDATE() + INTERVAL 1 DAY
            WHERE d.szPartyId = '$depo'
            ");
        }

        return $query->result();
        $this->db2->close();
    }

    function getBtbDist($ref, $tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $depo = $this->session->userdata('user_branch');

        $this->db2 = $this->load->database('waterout', true);
        if ($ref != '0') {
            $query = $this->db2->query("SELECT a.`no_bkb`, a.`driver`, a.`nopol` FROM bs.`tbl_head_bkb` a
            LEFT JOIN dms111$namedept.`dms_inv_docstockoutdistribution` b ON a.`no_bkb` = b.`szDocId`
            WHERE b.`szBranchId` = '$depo' AND a.`tanggal` >= CURDATE() - INTERVAL 2 DAY 
            AND a.`tanggal` <= CURDATE() + INTERVAL 1 DAY AND a.`no_bkb` NOT IN ($ref)
            UNION
            SELECT c.`no_bkb`, c.`driver`, c.`nopol` FROM bs.`tbl_head_sps` c
            LEFT JOIN dms111$namedept.`dms_inv_docstockoutdistribution` d ON c.`no_bkb` = d.`szDocId`
            WHERE d.`szBranchId` = '$depo' AND c.`tanggal` >= CURDATE() - INTERVAL 2 DAY 
            AND c.`tanggal` <= CURDATE() + INTERVAL 1 DAY AND c.`no_bkb` NOT IN ($ref)
            ");
        } else {
            $query = $this->db2->query("SELECT a.`no_bkb`, a.`driver`, a.`nopol` FROM bs.`tbl_head_bkb` a
            LEFT JOIN dms111$namedept.`dms_inv_docstockoutdistribution` b ON a.`no_bkb` = b.`szDocId`
            WHERE b.`szBranchId` = '$depo' AND a.`tanggal` >= CURDATE() - INTERVAL 2 DAY 
            AND a.`tanggal` <= CURDATE() + INTERVAL 1 DAY
            -- UNION
            -- SELECT c.`no_bkb`, c.`driver`, c.`nopol` FROM bs.`tbl_head_sps` c
            -- LEFT JOIN dms111$namedept.`dms_inv_docstockoutdistribution` d ON c.`no_bkb` = d.`szDocId`
            -- WHERE d.`szBranchId` = '$depo' AND c.`tanggal` >= CURDATE() - INTERVAL 2 DAY 
            -- AND c.`tanggal` <= CURDATE() + INTERVAL 1 DAY
            ");
        }

        return $query->result();
        $this->db2->close();
    }

    function getBkbDepot($ref)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $depo = $this->session->userdata('user_branch');

        $this->db2 = $this->load->database('waterout', true);
        if ($ref != '0') {
            $query = $this->db2->query("SELECT * FROM wo_admin.`tbl_sa_pengajuan` a
            LEFT JOIN wo_admin.`tbl_sa_pengajuan_detail` b ON a.`no_pengajuan` = b.`no_pengajuan`
            WHERE b.`depo_asal` = '$depo' AND a.`status` = 'Approval' 
            AND a.`status_sa` IN ('SA-ANTARDEPO', 'SA-ADMINISTRASI')
            AND a.`submit_date` >= CURDATE() - INTERVAL 3 DAY AND a.`submit_date` <= CURDATE() + INTERVAL 1 DAY
            AND a.`no_pengajuan` NOT IN ($ref) 
            ");
        } else {
            $query = $this->db2->query("SELECT * FROM wo_admin.`tbl_sa_pengajuan` a
            LEFT JOIN wo_admin.`tbl_sa_pengajuan_detail` b ON a.`no_pengajuan` = b.`no_pengajuan`
            WHERE b.`depo_asal` = '$depo' AND a.`status` = 'Approval' 
            AND a.`status_sa` IN ('SA-ANTARDEPO', 'SA-ADMINISTRASI')
            AND a.`submit_date` >= CURDATE() - INTERVAL 3 DAY AND a.`submit_date` <= CURDATE() + INTERVAL 1 DAY
            ");
        }

        return $query->result();
        $this->db2->close();
    }

    function getDepo()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $this->db2 = $this->load->database($namedept, true);
        $query = $this->db2->query("SELECT a.`szId`, a.`szName` FROM dmstesting.`dms_sm_branch` a
            GROUP BY a.`szId`    
        ");
        return $query->result();
        $this->db2->close();
    }

    function getPB($tanggal)
    {
        $tglStart = date('Y-m-d', strtotime('-1 days'));
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT a.`szDocId`, d.`szDocId` AS noBkb, b.`szName` AS pengemudi, c.`szName` AS kendaraan, e.`Status` FROM $base.`dms_sd_docproductrequest` a
        LEFT JOIN $base.`dms_inv_docstockoutdistributionpr` d ON a.`szDocId` = d.`szDocProductRequestId`
        LEFT JOIN $base.`dms_pi_employee` b ON a.`szEmployeeId` = b.`szId`
        LEFT JOIN $base.`dms_inv_vehicle` c ON a.`szVehicleId` = c.`szId`
        LEFT JOIN $base.`mdbapbstatus` e ON a.`szDocId` = e.`pbDoc`
        WHERE a.`szBranchId` = '$depo' AND a.`dtmDoc` BETWEEN '$tglStart' AND '$tanggal' 
        ORDER BY a.szDocId ASC 
        ");
        return $query->result();
    }

    function cekDataBkbDist()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');
        $query = $this->db->query("SELECT * FROM $base.`mdbarefdoc` a
        WHERE a.`refDocType` = 'DMSDocStockOutDistribution' AND a.refDepo = '$depo' AND a.`refDateAdd` >= CURDATE() - INTERVAL 3 DAY AND a.`refDateAdd` <= CURDATE() + INTERVAL 1 DAY");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getBkbDist($referensi)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'asa';
        } else {
            $namedept = 'tvip';
        }

        $depo = $this->session->userdata('user_branch');

        $this->db2 = $this->load->database('waterout', true);

        if ($referensi == '0') {
            $query = $this->db->query("SELECT a.`szDocId`, a.`dtmDoc`, c.`szName` AS employee, d.`szPoliceNo` AS vehicle 
            FROM $base.`dms_sd_docproductrequest` a 
            LEFT JOIN $base.`mdbapbstatus` b ON a.`szDocId` = b.`pbDoc` 
            LEFT JOIN $base.`dms_inv_vehicle` d ON a.`szVehicleId` = d.`szId`
            LEFT JOIN $base.`dms_pi_employee` c ON a.`szEmployeeId` = c.`szId`
            WHERE a.`szBranchId` AND a.`dtmDoc` >= CURDATE() - INTERVAL 3 DAY 
            AND a.`dtmDoc` <= CURDATE() + INTERVAL 1 DAY AND b.`pbBkb` IS NULL 
            AND b.`Status` = '1' AND a.szBranchId = '$depo'");
        }
        else{
            $query = $this->db->query("SELECT a.`szDocId`, a.`dtmDoc`, c.`szName` AS employee, d.`szPoliceNo` AS vehicle 
            FROM $base.`dms_sd_docproductrequest` a 
            LEFT JOIN $base.`mdbapbstatus` b ON a.`szDocId` = b.`pbDoc` 
            LEFT JOIN $base.`dms_inv_vehicle` d ON a.`szVehicleId` = d.`szId`
            LEFT JOIN $base.`dms_pi_employee` c ON a.`szEmployeeId` = c.`szId`
            WHERE a.`szBranchId` AND a.`dtmDoc` >= CURDATE() - INTERVAL 3 DAY 
            AND a.`dtmDoc` <= CURDATE() + INTERVAL 1 DAY AND b.`pbBkb` IS NULL 
            AND b.`Status` = '1' AND a.szBranchId = '$depo' AND a.`szDocId` NOT IN ($referensi)");
        }

        return $query->result();
        $this->db2->close();
    }

    function getBtuTrans($depo, $tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`dtmDoc`, a.`szDocId`, a.`szEmployeeId`, b.`szName` AS employee, FORMAT(FLOOR(a.`decAmountControl`),0) AS decAmountControl
        FROM $base.`dms_cas_doccashtempin` a
        LEFT JOIN $base.`dms_pi_employee` b ON a.`szEmployeeId` = b.`szId`
        WHERE a.`dtmDoc` = '$tanggal' AND a.`szBranchId` = '$depo'
        GROUP BY a.`szDocId`");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getBkuTrans($depo, $tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`dtmDoc`, a.`szDocId`, a.`szEmployeeId`, b.`szName` AS employee, FORMAT(FLOOR(a.`decAmountControl`),0) AS decAmountControl
        FROM $base.`dms_cas_doccashtempout` a
        LEFT JOIN $base.`dms_pi_employee` b ON a.`szEmployeeId` = b.`szId`
        WHERE a.`dtmDoc` = '$tanggal' AND a.`szBranchId` = '$depo'
        GROUP BY a.`szDocId`");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function cashierAuto($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT SUM(a.`staggingAmount`) AS staggingAmount, c.rit_driver, a.`driverNik`, a.`driverMesinId`, a.`staggingDate`, a.`staggingTx`, a.`staggingLoc`, a.`staggingLoc`,
        a.`staggingStatus`, b.`szName`, c.`nopol`, c.`kode_driver`, b.`szBranchId`,GROUP_CONCAT(a.`staggingTx` SEPARATOR ',') AS txId 
        FROM $base.`mdbaautostagging` a
        LEFT JOIN $base.`dms_pi_employee_nik` b ON a.`driverMesinId` = b.`szIDMachine`
        LEFT JOIN bs.`tbl_driver_rit` c ON c.`kode_driver` = b.`szId`
        LEFT JOIN $base.`mdbaautouser` d ON a.`staggingLoc` = d.`staggingLocation`
        WHERE a.`staggingDate` >= CURDATE() - INTERVAL 1 DAY AND a.`staggingDate` < CURDATE() + INTERVAL 1 DAY AND d.`staggingBranch` = '$depo' AND a.`staggingStatus` = '0'  
        AND b.`szId` IN 
        (SELECT DISTINCT(c.`kode_driver`) 
        FROM $base.`mdbaautostagging` a 
        LEFT JOIN $base.`dms_pi_employee_nik` b ON a.`driverMesinId` = b.`szIDMachine` 
        LEFT JOIN bs.`tbl_driver_rit` c ON b.`szId` = c.`kode_driver`
        LEFT JOIN $base.`mdbaautouser` d ON a.`staggingLoc` = d.`staggingLocation`
        WHERE a.`staggingDate` >= CURDATE() - INTERVAL 1 DAY AND a.`staggingDate` < CURDATE() + INTERVAL 1 DAY AND d.`staggingBranch` = '$depo' AND a.`staggingStatus` = '0' 
        ORDER BY c.`last_update_date` DESC)
        GROUP BY a.`driverMesinId` 
        ORDER BY `a`.`staggingTx` ASC");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function cashierSettlement($depo)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`szId` AS branch, a.`szName` AS branchName, b.`szId` AS company, b.`szName` AS companyName FROM $base.`dms_sm_branch` a
        LEFT JOIN $base.`dms_sm_company` b ON a.`szCompanyId` = b.`szId`
        WHERE a.`szId` = '$depo'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataSjp($depo, $tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, a.`szDocDO`, b.`szName`, a.`szCarrier` FROM $base.`dms_inv_docstockoutcustomer` a
        LEFT JOIN $base.`dms_ar_customer` b ON a.`szPartyId` = b.`szId`
        WHERE a.`szBranchId` = '$depo' AND a.`dtmDoc` = '$tanggal'");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getDataTBG($depo, $tanggal)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $query = $this->db->query("SELECT a.`szDocId`, a.`dtmDoc`, a.`szWarehouseId`, b.`szName`, a.`szDocStatus` FROM $base.`dms_inv_docwarehouseclosing` a
        LEFT JOIN $base.`dms_inv_warehouse` b ON a.`szWarehouseId` = b.`szId`
        WHERE a.`dtmDoc` = '$tanggal' AND a.`szBranchId` = '$depo'
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return 0;
    }

    function getNomorPb()
    {
        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dms111asa';
        } else {
            $base = 'dms111tvip';
        }
        $query = $this->db->query("SELECT a.`szDocPRId` FROM $base.`dms_inv_docstockoutdistribution` a
        WHERE a.`szBranchId` = '$depo' AND a.`dtmDoc` = '$tanggal' 
        ");
        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res;
        }
        return [];
    }
}
