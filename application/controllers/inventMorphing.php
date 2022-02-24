<?php
class inventMorphing extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model(array('mHome', 'mInventDist', 'mInventSupp', 'mInventDepot'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    function simpan()
    {
        $referensi = $this->input->post('referensi');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $keterangan = $this->input->post('keterangan');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');
        $produkTo = $this->input->post('produkTo');
        $qtyTo = $this->input->post('qtyTo');
        $satuanTo = $this->input->post('satuanTo');

        $depo = $this->session->userdata('user_branch');

        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $base = 'mdbaasa';
            $namedept = 'ASA';
        } else {
            $base = 'mdbatvip';
            $namedept = 'TVIP';
        }

        if($this->session->userdata('user_branch') == '302')
        {
            $id = 'MORP' . $depo . 'COU';
        }
        else{
            $id = 'SM' . $depo . 'COU';
        }
        
        $morphing = $this->mInventSupp->getId($id);
        //update counter
        $counter = $this->mInventSupp->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mInventDist->updateData($whereCount, $updateCount, $base.'.dms_sm_counter');
        $counterUpdateDms = $this->mInventDist->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        $refDoc = array(
            'refId' => $morphing,
            'refOld' => $referensi,
            'refTanggal' => $tgl,
            'refDepo' => $this->session->userdata('user_branch'),
            'refDocType' => 'DMSDocStockMorph',
            'refUserAdd' => $this->session->userdata('user_nik'),
            'refUserUpdate' => $this->session->userdata('user_nik'),
            'refDateAdd' => date('Y-m-d H:i:s'),
            'refDateUpdate' => date('Y-m-d H:i:s')
        );
        $reference = $this->mInventDist->simpanData($refDoc, $base.'.mdbaRefDoc');
        // echo "<pre> REF DOC : " . var_export($refDoc, true) . "</pre>";

        $morph = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $morphing,
            'dtmDoc' => $tgl,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $namedept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
            'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan
        );
        $dataMorphing = $this->mInventDist->simpanData($morph, $base.'.dms_inv_docstockmorph');
        $dataMorphingDms = $this->mInventDist->simpanDms($morph, 'dms.dms_inv_docstockmorph');
        // echo "<pre> MORPHING : " . var_export($morph, true) . "</pre>";

        $prodAs = '';
        $prodIs = '';
        for ($i = 0; $i < count($produk); $i++) {
            $detail = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $morphing,
                'intItemNumber' => $i,
                'szProductId' => $produk[$i],
                'decQty' => $qty[$i],
                'szUomId' => $satuan[$i],
                'szProductIdTo' => $produkTo[$i],
                'decQtyTo' => $qtyTo[$i],
                'szUomIdTo' => $satuanTo[$i]
            );
            // echo "<pre> DETAIL : " . var_export($detail, true) . "</pre>";
            $detMorphing = $this->mInventDist->simpanData($detail, $base.'.dms_inv_docstockmorphitem');
            $detMorphingDms = $this->mInventDist->simpanDms($detail, 'dms.dms_inv_docstockmorphitem');

            $histAs = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $produk[$i],
                'szLocationType' => 'WAREHOUSE',
                'szLocationId' => $gudang,
                'szStockTypeId' => $stok,
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => -$qty[$i],
                'szUomId' => $satuan[$i],
                'dtmTransaction' => $tgl,
                'szTrnId' => 'DMSDocStockMorph',
                'szDocId' => $morphing,
                'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $historyAs = $this->mInventDist->simpanData($histAs, $base.'.dms_inv_stockhistory');
            $asHistory = $this->mInventDist->simpanDms($histAs, 'dms.dms_inv_stockhistory');
            // echo "<pre> HISTORY AS : " . var_export($histAs, true) . "</pre>";

            $histIs = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $produkTo[$i],
                'szLocationType' => 'WAREHOUSE',
                'szLocationId' => $gudang,
                'szStockTypeId' => $stok,
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => $qtyTo[$i],
                'szUomId' => $satuanTo[$i],
                'dtmTransaction' => $tgl,
                'szTrnId' => 'DMSDocStockMorph',
                'szDocId' => $morphing,
                'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $historyIs = $this->mInventDist->simpanData($histIs, $base.'.dms_inv_stockhistory');
            $isHistory = $this->mInventDist->simpanDms($histIs, 'dms.dms_inv_stockhistory');
            // echo "<pre> HISTORY IS : " . var_export($histIs, true) . "</pre>";

            $prodAs .= "'" . $produk[$i] . "',";
            $prodIs .= "'" . $produkTo[$i] . "',";
        }
        $asLen = strlen($prodAs);
        $productAs = substr($prodAs, 0, $asLen - 1);

        $isLen = strlen($prodIs);
        $productIs = substr($prodIs, 0, $isLen - 1);

        // $gudangAs = "'" . $gudang . "'";
        // $stockAs = "'" . $stok . "'";
        $OnHandAs = $this->mInventSupp->stockOnHand($productAs, $gudang, $stok);
        // echo "<pre> OnHandAs: " . var_export($OnHandAs, true) . "</pre>";
        if ($OnHandAs != '0') {
            foreach ($OnHandAs as $value) {
                for ($i = 0; $i < count($produk); $i++) {
                    if ($value->szProductId == $produk[$i]) {
                        $updOnHandAs = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $qty[$i],
                            'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandAs = array(
                            'szProductId' => $produk[$i],
                            'szStockTypeId' => 'JUAL',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationId' => $gudang
                        );
                    }
                }
                echo "<pre> updOnHandAs: ".var_export($updOnHandAs, true)."</pre>";
                // echo "<pre> whereOnHandAs:".var_export($whereOnHandAs, true)."</pre>";
                $onHandUpdateAs = $this->mInventDist->updateData($whereOnHandAs, $updOnHandAs, $base.'.dms_inv_stockonhand');
                $onHandUpdateAsDms = $this->mInventDist->updateDms($whereOnHandAs, $updOnHandAs, 'dms.dms_inv_stockonhand');
            }
        } 
        // else {
        //     for ($i = 0; $i < count($produk); $i++) {
        //         $onHandAsInsert = array(
        //             'iId' => $this->uuid->v4(),
        //             'szProductId' => $produk[$i],
        //             'szLocationType' => 'WAREHOUSE',
        //             'szLocationId' => $gudang,
        //             'szStockTypeId' => $stok,
        //             'szReportedAsId' => $this->session->userdata('user_branch'),
        //             'decQtyOnHand' => '0',
        //             'szUomId' => $satuan[$i],
        //             'szUserCreatedId' => $this->session->userdata('user_nik'),
        //             'szUserUpdatedId' => $this->session->userdata('user_nik'),
        //             'dtmCreated' => date('Y-m-d H:i:s'),
        //             'dtmLastUpdated' => date('Y-m-d H:i:s')
        //         );
        //         $insertOnHandAs = $this->mInventDist->simpanData($onHandAsInsert, $base . '.dms_inv_stockonhand');
        //     }
        // }

        $gudangIs = "'" . $gudang . "'";
        $stockIs = "'" . $stok . "'";
        $OnHandIs = $this->mInventSupp->stockOnHand($productIs, $gudang, $stok);
        // echo "<pre> OnHandIs: " . var_export($OnHandIs, true) . "</pre>";
        if ($OnHandIs != '0') {
            foreach ($OnHandIs as $value) {
                for ($i = 0; $i < count($produkTo); $i++) {
                    if ($value->szProductId == $produkTo[$i]) {
                        $updOnHandIs = array(
                            'decQtyOnHand' => $value->decQtyOnHand + $qtyTo[$i],
                            'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandIs = array(
                            'szProductId' => $produkTo[$i],
                            'szStockTypeId' => 'JUAL',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationId' => $gudang
                        );
                    }   
                }
                echo "<pre> updOnHandIs: ".var_export($updOnHandIs, true)."</pre>";
                // echo "<pre> whereOnHandIs:".var_export($whereOnHandIs, true)."</pre>";
                $onHandUpdateIs = $this->mInventDist->updateData($whereOnHandIs, $updOnHandIs, $base.'.dms_inv_stockonhand');
                $onHandUpdateIsDms = $this->mInventDist->updateDms($whereOnHandIs, $updOnHandIs, 'dms.dms_inv_stockonhand');
            }
        } 
        // else {
        //     for ($i = 0; $i < count($produkTo); $i++) {
        //         $onHandIsInsert = array(
        //             'iId' => $this->uuid->v4(),
        //             'szProductId' => $produkTo[$i],
        //             'szLocationType' => 'WAREHOUSE',
        //             'szLocationId' => $gudang,
        //             'szStockTypeId' => $stok,
        //             'szReportedAsId' => $this->session->userdata('user_branch'),
        //             'decQtyOnHand' => $qtyTo[$i],
        //             'szUomId' => $satuan[$i],
        //             'szUserCreatedId' => $this->session->userdata('user_nik'),
        //             'szUserUpdatedId' => $this->session->userdata('user_nik'),
        //             'dtmCreated' => date('Y-m-d H:i:s'),
        //             'dtmLastUpdated' => date('Y-m-d H:i:s')
        //         );
        //         $insertOnHandIs = $this->mInventDist->simpanData($onHandIsInsert, $base . '.dms_inv_stockonhand');
        //     }
        // }

        if ($referensi != '-') {
            if ($reference == 'true' && $dataMorphing == 'true' && $detMorphing == 'true' && $historyAs == 'true' && $historyIs == 'true' && $onHandUpdateIsDms == 'true' && $onHandUpdateAsDms == 'true') {
                $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('home/stokMorphing'));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventori/tambahMorphing/' . $referensi));
                exit;
            }
        } else {
            if ($reference == 'true' && $dataMorphing == 'true' && $detMorphing == 'true' && $historyAs == 'true' && $historyIs == 'true' && $onHandUpdateIsDms == 'true' && $onHandUpdateAsDms == 'true') {
                $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('home/stokMorphing'));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventori/manualMorphing'));
                exit;
            }
        }
    }
}
