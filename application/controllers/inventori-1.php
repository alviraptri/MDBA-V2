<?php
class inventori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model(array('mInventori', 'mHome', 'mInventDepot', 'mInventDist'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
        // $this->uuid->v4()
    }

    //SUPPLIER

    public function getDetBtbSupplier()
    {
        $id = $this->input->post('id');
        $btb = $this->mInventori->getDetBtbSupplier($id);
        $id = $this->mInventori->getId();
        $data = array(
            'id' => $id,
            'btb' => $btb,
        );
        echo json_encode($data);
    }

    public function filterStatusBtbSupp()
    {
        $filter = $this->input->post('filter');
        $data['waterin'] = $this->mInventori->filterStatusBtbSupp($filter);
        $this->load->view('vBtbSupplier', $data);
    }

    public function tambahBtbSupplier($dn)
    {
        $depo = $this->session->userdata('user_branch');

        $a = $this->mInventori->getDataTambahBtbSupplier($dn);
        if (count($a) != '0') {
            $data['data'] = $this->mInventori->getDataTambahBtbSupplier($dn);
            $id = 'BTBSUPP' . $depo . 'COU';
            $data['id'] = $this->mInventori->getId($id);
            $data['gudang'] = $this->mHome->getGudang();
            $this->load->view('vBtbSupplierTambah', $data);
        } else {
            $this->session->set_flashdata('warning', 'Data Tidak Ditemukan');
            header('Location: ' . base_url('home/btbSupplier'));
            exit;
        }
    }

    public function tambahBkbSupplier($dn)
    {
        $depo = $this->session->userdata('user_branch');

        $a = $this->mInventori->getDataTambahBkbSupplier($dn);
        if (count($a) != '0') {
            $data['data'] = $this->mInventori->getDataTambahBkbSupplier($dn);
            $id = 'BKBSUPP' . $depo . 'COU';
            $data['id'] = $this->mInventori->getId($id);
            $data['gudang'] = $this->mHome->getGudang();
            $this->load->view('vBkbSupplierTambah', $data);
        } else {
            $this->session->set_flashdata('warning', 'Data Tidak Ditemukan');
            header('Location: ' . base_url('home/btbSupplier'));
            exit;
        }
    }

    public function createBtbSupplierGln()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        //po
        $noPo = $this->input->post('noPo');
        $returnIsiAdm = $this->input->post('returnIsiAdm');
        $jugrackAdm = $this->input->post('jugrackAdm');
        $glnKosongAdm = $this->input->post('glnKosongAdm');
        $paletAdm = $this->input->post('paletAdm');
        $nopolAdm = $this->input->post('nopolAdm');
        $driverAdm = $this->input->post('driverAdm');
        $driver2Adm = $this->input->post('driver2Adm');
        $transporterAdm = $this->input->post('transporterAdm');
        $transporterAdmKode = $this->input->post('transporterAdmKode');

        //co
        $noCo = substr($this->input->post('noCo'), 1);
        $hariAdm = $this->input->post('hariAdm');
        $tglWindowAdm = $this->input->post('tglWindowAdm');
        $pabrikWindowAdm = $this->input->post('pabrikWindowAdm');
        $materialAdm = $this->input->post('materialAdm');
        $tujuanAwalAdm = $this->input->post('tujuanAwalAdm');
        $tujuanFinalAdm = $this->input->post('tujuanFinalAdm');
        $tujuanCoAdm = $this->input->post('tujuanCoAdm');

        //gr
        $noGr = $this->input->post('noGr');
        $sendAdm = $this->input->post('sendAdm');
        $produkGrAdm = $this->input->post('produkGrAdm');
        $qtyGrAdm = $this->input->post('qtyGrAdm');

        //dn
        $noDn = $this->input->post('noDn');
        $tglDnAdm = $this->input->post('tglDnAdm');
        $sendDnAdm = $this->input->post('sendDnAdm');
        $pabrikDnAdm = $this->input->post('pabrikDnAdm');
        $nopolDnAdm = $this->input->post('nopolDnAdm');
        $driverDnAdm = $this->input->post('driverDnAdm');
        $produkDnAdm = $this->input->post('produkDnAdm');
        $qtyDnAdm = $this->input->post('qtyDnAdm');
        $qtyDnAdmT = $this->input->post('qtyDnAdmT');

        //summary
        $tglBtb = $this->input->post('tglBtb');
        $docId = $this->input->post('docId');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $keterangan = $this->input->post('keterangan');
        $produkNama = $this->input->post('produkNama');
        $produkKode = $this->input->post('produkKode');
        $varianQty = $this->input->post('varianQty');
        $codeProduct = $this->input->post('codeProduct');
        $spsQty = $this->input->post('spsQty');

        //tolakan
        $noDnTk = $this->input->post('noDnTk');
        $produkDnAdmT = $this->input->post('produkDnAdmT');
        $qtyDnAdmT = $this->input->post('qtyDnAdmT');
        $glnKsgAqAdm = (int)$this->input->post('glnKsgAqAdm');
        $glnKsgVtAdm = (int)$this->input->post('glnKsgVtAdm');
        $glnIsiAqAdm = (int)$this->input->post('glnIsiAqAdm');
        $glnIsiVtAdm = (int)$this->input->post('glnIsiVtAdm');

        $mdbaCo = array(
            'coNo' => $noCo,
            'coHari' => $hariAdm,
            'coTgl' => $tglWindowAdm,
            'coPabrik' => $pabrikWindowAdm,
            'coProduk' => $materialAdm,
            'coTujuanAwal' => $tujuanAwalAdm,
            'coTujuanFinal' => $tujuanFinalAdm,
            'coTujuan' => $tujuanCoAdm,
            'coUserAdd' => $this->session->userdata('user_nik'),
            'coUserUpdate' => $this->session->userdata('user_nik'),
            'coTimeAdd' => date('Y-m-d H:i:s'),
            'coTimeUpdate' => date('Y-m-d H:i:s')
        );
        $co = $this->mInventori->simpanData($mdbaCo, $base . '.mdbaCoAdmin');

        $mdbaDn = array(
            'dnNo' => $noDn,
            'dnTanggal' => $tglDnAdm,
            'dnDepo' => $sendDnAdm,
            'dnPabrik' => $pabrikDnAdm,
            'dnNopol' => $nopolDnAdm,
            'dnProduk' => $produkDnAdm,
            'dnQty' => $qtyDnAdm,
            'dnUserAdd' => $this->session->userdata('user_nik'),
            'dnUserUpdate' => $this->session->userdata('user_nik'),
            'dnTimeAdd' => date('Y-m-d H:i:s'),
            'dnTimeUpdate' => date('Y-m-d H:i:s')
        );
        $dn = $this->mInventori->simpanData($mdbaDn, $base . '.mdbaDnAdmin');

        $mdbaPo = array(
            'poNo' => $noPo,
            'poReturnIsi' => $returnIsiAdm,
            'poJugrack' => $jugrackAdm,
            'poGlnKosong' => $glnKosongAdm,
            'poPalet' => $paletAdm,
            'poNopol' => $nopolAdm,
            'poSupir' => $driverAdm,
            'poSupirPengganti' => $driver2Adm,
            'poTransporter' => $transporterAdm,
            'poUserAdd' => $this->session->userdata('user_nik'),
            'poUserUpdate' => $this->session->userdata('user_nik'),
            'poTimeAdd' => date('Y-m-d H:i:s'),
            'poTimeUpdate' => date('Y-m-d H:i:s')
        );
        $po = $this->mInventori->simpanData($mdbaPo, $base . '.mdbaPoAdmin');

        $mdbaGr = array(
            'grNo' => $noGr,
            'grDepo' => $sendAdm,
            'grProduk' => $produkGrAdm,
            'grQty' => $qtyGrAdm,
            'grUserAdd' => $this->session->userdata('user_nik'),
            'grUserUpdate' => $this->session->userdata('user_nik'),
            'grTimeAdd' => date('Y-m-d H:i:s'),
            'grTimeUpdate' => date('Y-m-d H:i:s')
        );
        $gr = $this->mInventori->simpanData($mdbaGr, $base . '.mdbaGrAdmin');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $dmsPabrik = $this->mInventori->getDmsPabrik($pabrikWindowAdm);

        //counter update 
        $countId = 'BTBSUPP' . $this->session->userdata('user_branch') . 'COU';
        $counter = $this->mInventori->getCounter($countId);


        if ($noDnTk == '0' || $noDnTk == '') {
            if ($produkKode == '74559' || $produkKode == '45560') {
                $btbSummary = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $docId,
                    'dtmDoc' => $tglBtb,
                    'szSupplierId' => $dmsPabrik,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'szRefDocId' => $noDn,
                    'dtmDn' => $tglDnAdm,
                    'szCarrierId' => $transporterAdmKode,
                    'szVehicle' => 'MANUAL',
                    'szDriver' => 'MANUAL',
                    'szVehicle2' => $nopolAdm,
                    'szDriver2' => $driverAdm,
                    'szRef1' => $noCo,
                    'szRef2' => $noGr,
                    'szRef3' => $noPo,
                    'intShift' => '0',
                    'intHelperCount' => '0',
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:S'),
                    'szDescription' => $keterangan,
                    'bFromOTM' => '0'
                );

                // echo "<pre>".var_export($btbSummaryTk, true)."</pre>";
                $headerSmr = $this->mInventori->simpanData($btbSummary, $base . '.dms_inv_docstockinsupplier');

                if ($produkKode == '74559' && $produkKode == '45560') {
                    //reguler
                    if ($jugrackAdm > 0) {
                        $fixProd = "'74559', '74559G', '19310', '74560', '74560G', '29311', '33300'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            if ($value->szId == '33300') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $jugrackAdm,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $jugrackAdm,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBtb,
                                    'szTrnId' => 'DMSDocStockInSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand + $jugrackAdm;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } else {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $varianQty,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $varianQty,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBtb,
                                    'szTrnId' => 'DMSDocStockInSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand + $varianQty;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            }
                            // echo "<pre>".var_export($detSummary, true)."</pre>";
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $no++;
                        }
                    } else {
                        $fixProd = "'74559', '74559G', '19310', '74560', '74560G', '29311'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            $detSummary = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $docId,
                                'intItemNumber' => $no,
                                'szProductId' => $value->szId,
                                'decQty' => $varianQty,
                                'szUomId' => $value->szUomId
                            );
                            // echo "<pre>".var_export($detSummary, true)."</pre>";
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');

                            $stockHistory = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $value->szId,
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $varianQty,
                                'szUomId' => $value->szUomId,
                                'dtmTransaction' => $tglBtb,
                                'szTrnId' => 'DMSDocStockInSupplier',
                                'szDocId' => $docId,
                                'szUserCreatedId' => $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');

                            $total = $value->decQtyOnHand + $varianQty;
                            $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                            $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');

                            $no++;
                        }
                    }
                } elseif ($produkKode == '74559') {
                    //reguler
                    if ($jugrackAdm > 0) {
                        $fixProd = "'74559', '74559G', '19310', '33300'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            if ($value->szId == '33300') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $jugrackAdm,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $jugrackAdm,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBtb,
                                    'szTrnId' => 'DMSDocStockInSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand + $jugrackAdm;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } else {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $varianQty,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $varianQty,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBtb,
                                    'szTrnId' => 'DMSDocStockInSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand + $varianQty;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            }
                            // echo "<pre>".var_export($updOnHand, true)."</pre>";
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                            $no++;
                        }
                    } else {
                        $fixProd = "'74559', '74559G', '19310'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            $detSummary = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $docId,
                                'intItemNumber' => $no,
                                'szProductId' => $value->szId,
                                'decQty' => $varianQty,
                                'szUomId' => $value->szUomId
                            );

                            $stockHistory = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $value->szId,
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $varianQty,
                                'szUomId' => $value->szUomId,
                                'dtmTransaction' => $tglBtb,
                                'szTrnId' => 'DMSDocStockInSupplier',
                                'szDocId' => $docId,
                                'szUserCreatedId' => $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );

                            $total = $value->decQtyOnHand + $varianQty;
                            $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                            $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            // echo "<pre>".var_export($updOnHand, true)."</pre>";
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                            $no++;
                        }
                    }
                } elseif ($produkKode == '45560') {
                    //reguler
                    if ($jugrackAdm > 0) {
                        $fixProd = "'74560', '74560G', '29311', '33300'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            if ($value->szId == '33300') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $jugrackAdm,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $jugrackAdm,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBtb,
                                    'szTrnId' => 'DMSDocStockInSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand + $jugrackAdm;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } else {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $varianQty,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $varianQty,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBtb,
                                    'szTrnId' => 'DMSDocStockInSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand + $varianQty;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            }
                            // echo "<pre>".var_export($detSummary, true)."</pre>";
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                            $no++;
                        }
                    } else {
                        $fixProd = "'74560', '74560G', '29311'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            $detSummary = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $docId,
                                'intItemNumber' => $no,
                                'szProductId' => $value->szId,
                                'decQty' => $varianQty,
                                'szUomId' => $value->szUomId
                            );

                            $stockHistory = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $value->szId,
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $varianQty,
                                'szUomId' => $value->szUomId,
                                'dtmTransaction' => $tglBtb,
                                'szTrnId' => 'DMSDocStockInSupplier',
                                'szDocId' => $docId,
                                'szUserCreatedId' => $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );

                            $total = $value->decQtyOnHand + $varianQty;
                            $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                            $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));

                            // echo "<pre>".var_export($detSummary, true)."</pre>";
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                            $no++;
                        }
                    }
                }

                $fileNamaPo =  $_FILES['uploadPO']['name'];
                $tmpNamaPo = $_FILES['uploadPO']['tmp_name'];
                $tgl = date("dd-mm-yyy");
                $fileUpNamePo = $tgl . "-UploadPo-" . $fileNamaPo;
                move_uploaded_file($tmpNamaPo, "assets/upload/" . $fileUpNamePo);

                $fileNamaGR =  $_FILES['uploadGR']['name'];
                $tmpNamaGR = $_FILES['uploadGR']['tmp_name'];
                $tgl = date("dd-mm-yyy");
                $fileUpNameGR = $tgl . "-UploadGr-" . $fileNamaGR;
                move_uploaded_file($tmpNamaGR, "assets/upload/" . $fileUpNameGR);

                $uploadBa = array(
                    'noDoc' => $docId,
                    'uploadPo' => $fileUpNamePo,
                    'noPo' => $noPo,
                    'uploadGr' => $fileUpNameGR,
                    'noGr' => $noGr
                );
                $uploadTrue = $this->mInventori->simpanData($uploadBa, $base . '.mdbauploadba');

                $updateCount = array('intLastCounter' => $counter);
                $whereCount = array('szId' => $countId);
                $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');

                if ($co == 'true' && $gr == 'true' && $dn == 'true' && $po == 'true' && $headerSmr == 'true' && $detailSmr == 'true' && $historyStock == 'true' && $onHandUpdate == 'true' && $counterUpdate == 'true') {
                    $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                    header('Location: ' . base_url('home/btbSupplier/'));
                    exit;
                } else {
                    $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                    header('Location: ' . base_url('inventori/tambahBtbSupplier/' . $po));
                    exit;
                }
            } else {
                $btbSummary = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $docId,
                    'dtmDoc' => $tglBtb,
                    'szSupplierId' => $dmsPabrik,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'szRefDocId' => $noDn,
                    'dtmDn' => $tglDnAdm,
                    'szCarrierId' => $transporterAdmKode,
                    'szVehicle' => 'MANUAL',
                    'szDriver' => 'MANUAL',
                    'szVehicle2' => $nopolAdm,
                    'szDriver2' => $driverAdm,
                    'szRef1' => $noCo,
                    'szRef2' => $noGr,
                    'szRef3' => $noPo,
                    'intShift' => '0',
                    'intHelperCount' => '0',
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:S'),
                    'szDescription' => $keterangan,
                    'bFromOTM' => '0'
                );

                // echo "<pre>".var_export($btbSummaryTk, true)."</pre>";
                $headerSmr = $this->mInventori->simpanData($btbSummary, $base . '.dms_inv_docstockinsupplier');

                $prodNew = '';
                for ($i = 0; $i < count($codeProduct); $i++) {
                    $prodNew .= "'" . $codeProduct[$i] . "',";
                }
                $cekLen = strlen($prodNew);
                $prodNew2 = substr($prodNew, 0, $cekLen - 1);
                $produkDms = $this->mInventori->getKodeProduk($prodNew2, $stok, $this->session->userdata('user_branch'));
                $no = 1;

                if ($paletAdm != '0') {
                    $no = 0;
                    foreach ($produkDms as $key) {
                        for ($i = 0; $i < count($codeProduct); $i++) {
                            if ($codeProduct[$i] == $key->szId) {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $i,
                                    'szProductId' => $codeProduct[$i],
                                    'decQty' => $spsQty[$i],
                                    'szUomId' => $key->szUomId,
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $codeProduct[$i],
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $spsQty[$i],
                                    'szUomId' => $key->szUomId,
                                    'dtmTransaction' => $tglBtb,
                                    'szTrnId' => 'DMSDocStockInSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $updOnHand = array(
                                    'decQtyOnHand' => $key->decQtyOnHand + $spsQty[$i],
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHand = array(
                                    'szProductId' => $codeProduct[$i],
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch')
                                );

                                // echo "<pre>".var_export($detSummary, true)."</pre>";
                                $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                                $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                                $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            }
                        }
                        $no++;
                    }

                    $detSummaryPalet = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $docId,
                        'intItemNumber' => $no + 1,
                        'szProductId' => '10116',
                        'decQty' => $paletAdm,
                        'szUomId' => 'BUAH',
                    );

                    $stockHistoryPalet = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => '10116',
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $paletAdm,
                        'szUomId' => 'BUAH',
                        'dtmTransaction' => $tglBtb,
                        'szTrnId' => 'DMSDocStockInSupplier',
                        'szDocId' => $docId,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );

                    $paletDms = $this->mInventori->getKodeProduk('10116', $stok, $this->session->userdata('user_branch'));
                    foreach ($paletDms as $value) {
                        $stockPalet = $value->decQtyOnHand;
                    }

                    $updOnHandPalet = array(
                        'decQtyOnHand' => $stockPalet + $spsQty[$i],
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $whereOnHandPalet = array(
                        'szProductId' => '10116',
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch')
                    );

                    $onHandUpdatePalet = $this->mInventori->updateData($whereOnHandPalet, $updOnHandPalet, $base . '.dms_inv_stockonhand');
                    $detailSmrPalet = $this->mInventori->simpanData($detSummaryPalet, $base . '.dms_inv_docstockinsupplieritem');
                    $historyStockPalet = $this->mInventori->simpanData($stockHistoryPalet, $base . '.dms_inv_stockhistory');

                    $fileNamaPo =  $_FILES['uploadPO']['name'];
                    $tmpNamaPo = $_FILES['uploadPO']['tmp_name'];
                    $tgl = date("dd-mm-yyy");
                    $fileUpNamePo = $tgl . "-UploadPo-" . $fileNamaPo;
                    move_uploaded_file($tmpNamaPo, "assets/upload/" . $fileUpNamePo);

                    $fileNamaGR =  $_FILES['uploadGR']['name'];
                    $tmpNamaGR = $_FILES['uploadGR']['tmp_name'];
                    $tgl = date("dd-mm-yyy");
                    $fileUpNameGR = $tgl . "-UploadGr-" . $fileNamaGR;
                    move_uploaded_file($tmpNamaGR, "assets/upload/" . $fileUpNameGR);

                    $uploadBa = array(
                        'noDoc' => $docId,
                        'uploadPo' => $fileUpNamePo,
                        'noPo' => $noPo,
                        'uploadGr' => $fileUpNameGR,
                        'noGr' => $noGr
                    );
                    $uploadTrue = $this->mInventori->simpanData($uploadBa, $base . '.mdbauploadba');

                    $updateCount = array('intLastCounter' => $counter);
                    $whereCount = array('szId' => $countId);
                    $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');

                    if ($co == 'true' && $gr == 'true' && $dn == 'true' && $po == 'true' && $headerSmr == 'true' && $detailSmr == 'true' && $historyStock == 'true' && $onHandUpdate == 'true' && $counterUpdate == 'true' && $detailSmrPalet == 'true' && $historyStockPalet == 'true' && $onHandUpdatePalet == 'true') {
                        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                        header('Location: ' . base_url('home/btbSupplier/'));
                        exit;
                    } else {
                        $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                        header('Location: ' . base_url('inventori/tambahBtbSupplier/' . $po));
                        exit;
                    }
                } else {
                    foreach ($produkDms as $key) {
                        for ($i = 0; $i < count($codeProduct); $i++) {
                            if ($codeProduct[$i] == $key->szId) {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $i,
                                    'szProductId' => $codeProduct[$i],
                                    'decQty' => $spsQty[$i],
                                    'szUomId' => $key->szUomId,
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $codeProduct[$i],
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $spsQty[$i],
                                    'szUomId' => $key->szUomId,
                                    'dtmTransaction' => $tglBtb,
                                    'szTrnId' => 'DMSDocStockInSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $updOnHand = array(
                                    'decQtyOnHand' => $key->decQtyOnHand - $spsQty[$i],
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHand = array(
                                    'szProductId' => $codeProduct[$i],
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch')
                                );

                                // echo "<pre>".var_export($detSummary, true)."</pre>";
                                $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                                $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                                $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            }
                        }
                    }

                    $fileNamaPo =  $_FILES['uploadPO']['name'];
                    $tmpNamaPo = $_FILES['uploadPO']['tmp_name'];
                    $tgl = date("dd-mm-yyy");
                    $fileUpNamePo = $tgl . "-UploadPo-" . $fileNamaPo;
                    move_uploaded_file($tmpNamaPo, "assets/upload/" . $fileUpNamePo);

                    $fileNamaGR =  $_FILES['uploadGR']['name'];
                    $tmpNamaGR = $_FILES['uploadGR']['tmp_name'];
                    $tgl = date("dd-mm-yyy");
                    $fileUpNameGR = $tgl . "-UploadGr-" . $fileNamaGR;
                    move_uploaded_file($tmpNamaGR, "assets/upload/" . $fileUpNameGR);

                    $uploadBa = array(
                        'noDoc' => $docId,
                        'uploadPo' => $fileUpNamePo,
                        'noPo' => $noPo,
                        'uploadGr' => $fileUpNameGR,
                        'noGr' => $noGr
                    );
                    $uploadTrue = $this->mInventori->simpanData($uploadBa, $base . '.mdbauploadba');

                    $updateCount = array('intLastCounter' => $counter);
                    $whereCount = array('szId' => $countId);
                    $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');

                    if ($co == 'true' && $gr == 'true' && $dn == 'true' && $po == 'true' && $headerSmr == 'true' && $detailSmr == 'true' && $historyStock == 'true' && $onHandUpdate == 'true' && $counterUpdate == 'true') {
                        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                        header('Location: ' . base_url('home/btbSupplier/'));
                        exit;
                    } else {
                        $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                        header('Location: ' . base_url('inventori/tambahBtbSupplier/' . $po));
                        exit;
                    }
                }
            }
        } else {
            $mdbaTolakan = array(
                'tolakanDn' => $noDnTk,
                'tolakanProduk' => $produkDnAdm,
                'tolakanQty' => $qtyDnAdmT,
                'tolakanKsgAq' => $glnKsgAqAdm,
                'tolakanKsgVt' => $glnKsgVtAdm,
                'tolakanIsiAq' => $glnIsiAqAdm,
                'tolakanIsiVt' => $glnIsiVtAdm,
                'tolakanUserAdd' => $this->session->userdata('user_nik'),
                'tolakanUserUpdate' => $this->session->userdata('user_nik'),
                'tolakanDateAdd' => date('Y-m-d H:i:s'),
                'tolakanDateUpdate' => date('Y-m-d H:i:s')
            );
            $tolakan = $this->mInventori->simpanData($mdbaTolakan, $base . '.mdbaTolakan');
            print_r($mdbaTolakan);

            //doc id 2
            $count2 = sprintf("%07s", $counter + 1);
            $doc2 = $this->session->userdata('user_branch') . "-" . $count2;

            $btbSummary = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $docId,
                'dtmDoc' => $tglBtb,
                'szSupplierId' => $dmsPabrik,
                'szWarehouseId' => $gudang,
                'szStockType' => $stok,
                'szRefDocId' => $noDn,
                'dtmDn' => $tglDnAdm,
                'szCarrierId' => $transporterAdmKode,
                'szVehicle' => 'MANUAL',
                'szDriver' => 'MANUAL',
                'szVehicle2' => $nopolAdm,
                'szDriver2' => $driverAdm,
                'szRef1' => $noCo,
                'szRef2' => $noGr,
                'szRef3' => $noPo,
                'intShift' => '0',
                'intHelperCount' => '0',
                'intPrintedCount' => '0',
                'szBranchId' => $this->session->userdata('user_branch'),
                'szCompanyId' => $dept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:S'),
                'szDescription' => $keterangan,
                'bFromOTM' => '0'
            );

            $btbSummaryTk = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $doc2,
                'dtmDoc' => $tglBtb,
                'szSupplierId' => $dmsPabrik,
                'szWarehouseId' => $gudang,
                'szStockType' => $stok,
                'szRefDocId' => $noDnTk,
                'dtmDn' => $tglDnAdm,
                'szCarrierId' => $transporterAdmKode,
                'szVehicle' => 'MANUAL',
                'szDriver' => 'MANUAL',
                'szVehicle2' => $nopolAdm,
                'szDriver2' => $driverAdm,
                'szRef1' => $noCo,
                'szRef2' => $noGr,
                'szRef3' => $noPo,
                'intShift' => '0',
                'intHelperCount' => '0',
                'intPrintedCount' => '0',
                'szBranchId' => $this->session->userdata('user_branch'),
                'szCompanyId' => $dept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:S'),
                'szDescription' => $keterangan,
                'bFromOTM' => '0'
            );
            // echo "<pre>" . var_export($btbSummaryTk, true) . "</pre>";
            // echo "<pre>" . var_export($btbSummary, true) . "</pre>";
            $headerSmr = $this->mInventori->simpanData($btbSummary, $base . '.dms_inv_docstockinsupplier');
            $headerSmrTk = $this->mInventori->simpanData($btbSummaryTk, $base . '.dms_inv_docstockinsupplier');

            if ($produkKode == '74559' && $produkKode == '45560') {
                //reguler
                if ($jugrackAdm > 0) {
                    $fixProd = "'74559', '74559G', '19310', '74560', '74560G', '29311', '33300'";
                    $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                    $no = 1;
                    foreach ($produkReg as $value) {
                        if ($value->szId == '33300') {
                            $detSummary = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $docId,
                                'intItemNumber' => $no,
                                'szProductId' => $value->szId,
                                'decQty' => $jugrackAdm,
                                'szUomId' => $value->szUomId
                            );

                            $stockHistory = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $value->szId,
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $jugrackAdm,
                                'szUomId' => $value->szUomId,
                                'dtmTransaction' => $tglBtb,
                                'szTrnId' => 'DMSDocStockInSupplier',
                                'szDocId' => $docId,
                                'szUserCreatedId' => $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );

                            $total = $value->decQtyOnHand + $jugrackAdm;
                            $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                            $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                        } else {
                            $detSummary = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $docId,
                                'intItemNumber' => $no,
                                'szProductId' => $value->szId,
                                'decQty' => $varianQty,
                                'szUomId' => $value->szUomId
                            );

                            $stockHistory = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $value->szId,
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $varianQty,
                                'szUomId' => $value->szUomId,
                                'dtmTransaction' => $tglBtb,
                                'szTrnId' => 'DMSDocStockInSupplier',
                                'szDocId' => $docId,
                                'szUserCreatedId' => $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );

                            $total = $value->decQtyOnHand + $varianQty;
                            $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                            $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                        }
                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                        $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        // echo "<pre>".var_export($stockHistory, true)."</pre>";
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                        $no++;
                    }
                } else {
                    $fixProd = "'74559', '74559G', '19310', '74560', '74560G', '29311'";
                    $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                    $no = 1;
                    foreach ($produkReg as $value) {
                        $detSummary = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $docId,
                            'intItemNumber' => $no,
                            'szProductId' => $value->szId,
                            'decQty' => $varianQty,
                            'szUomId' => $value->szUomId
                        );
                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');

                        $stockHistory = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $varianQty,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $docId,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');

                        $total = $value->decQtyOnHand + $varianQty;
                        $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                        $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        // echo "<pre>".var_export($stockHistory, true)."</pre>";
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        // echo "<pre>".var_export($whereOnHand, true)."</pre>";

                        $no++;
                    }
                }

                //tolakan
                $fixProdTk = "'42001', '41012', '41001', '41013'";
                $produkTk = $this->mInventori->getKodeProduk($fixProdTk, $stok, $this->session->userdata('user_branch'));
                $num = 1;
                foreach ($produkTk as $value) {
                    if ($value->szId == '42001') {
                        $detSummaryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $doc2,
                            'intItemNumber' => $num,
                            'szProductId' => $value->szId,
                            'decQty' => $glnKsgAqAdm,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistoryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $glnKsgAqAdm,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $doc2,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $totalTk = $value->decQtyOnHand + $glnKsgAqAdm;
                        $updOnHandTk = array('decQtyOnHand' => $totalTk, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHandTk = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                    } elseif ($value->szId == '41001') {
                        $detSummaryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $doc2,
                            'intItemNumber' => $num,
                            'szProductId' => $value->szId,
                            'decQty' => $glnIsiAqAdm,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistoryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $glnIsiAqAdm,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $doc2,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $totalTk = $value->decQtyOnHand + $glnIsiAqAdm;
                        $updOnHandTk = array('decQtyOnHand' => $totalTk, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHandTk = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                    } elseif ($value->szId == '41012') {
                        $detSummaryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $doc2,
                            'intItemNumber' => $num,
                            'szProductId' => $value->szId,
                            'decQty' => $glnKsgVtAdm,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistoryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $glnKsgVtAdm,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $doc2,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $totalTk = $value->decQtyOnHand + $glnKsgVtAdm;
                        $updOnHandTk = array('decQtyOnHand' => $totalTk, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHandTk = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                    } elseif ($value->szId == '41013') {
                        $detSummaryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $doc2,
                            'intItemNumber' => $num,
                            'szProductId' => $value->szId,
                            'decQty' => $glnIsiVtAdm,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistoryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $glnIsiVtAdm,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $doc2,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $totalTk = $value->decQtyOnHand + $glnIsiVtAdm;
                        $updOnHandTk = array('decQtyOnHand' => $totalTk, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHandTk = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                    }
                    // echo "<pre>".var_export($detSummaryTk, true)."</pre>";
                    $historyStockTk = $this->mInventori->simpanData($stockHistoryTk, $base . '.dms_inv_stockhistory');
                    $onHandUpdateTk = $this->mInventori->updateData($whereOnHandTk, $updOnHandTk, $base . '.dms_inv_stockonhand');
                    $detailSmrTk = $this->mInventori->simpanData($detSummaryTk, $base . '.dms_inv_docstockinsupplieritem');
                    // echo "<pre>".var_export($detSummaryTk, true)."</pre>";
                    // echo "<pre>".var_export($stockHistoryTk, true)."</pre>";
                    // echo "<pre>".var_export($updOnHandTk, true)."</pre>";
                    // echo "<pre>".var_export($whereOnHandTk, true)."</pre>";
                    $num++;
                }
            } elseif ($produkKode == '74559') {
                //reguler
                if ($jugrackAdm > 0) {
                    $fixProd = "'74559', '74559G', '19310', '33300'";
                    $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                    $no = 1;
                    foreach ($produkReg as $value) {
                        if ($value->szId == '33300') {
                            $detSummary = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $docId,
                                'intItemNumber' => $no,
                                'szProductId' => $value->szId,
                                'decQty' => $jugrackAdm,
                                'szUomId' => $value->szUomId
                            );

                            $stockHistory = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $value->szId,
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $jugrackAdm,
                                'szUomId' => $value->szUomId,
                                'dtmTransaction' => $tglBtb,
                                'szTrnId' => 'DMSDocStockInSupplier',
                                'szDocId' => $docId,
                                'szUserCreatedId' => $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );

                            $total = $value->decQtyOnHand + $jugrackAdm;
                            $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                            $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                        } else {
                            $detSummary = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $docId,
                                'intItemNumber' => $no,
                                'szProductId' => $value->szId,
                                'decQty' => $varianQty,
                                'szUomId' => $value->szUomId
                            );

                            $stockHistory = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $value->szId,
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $varianQty,
                                'szUomId' => $value->szUomId,
                                'dtmTransaction' => $tglBtb,
                                'szTrnId' => 'DMSDocStockInSupplier',
                                'szDocId' => $docId,
                                'szUserCreatedId' => $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );

                            $total = $value->decQtyOnHand + $varianQty;
                            $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                            $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                        }
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                        $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        // echo "<pre>".var_export($stockHistory, true)."</pre>";
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                        $no++;
                    }
                } else {
                    $fixProd = "'74559', '74559G', '19310'";
                    $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                    $no = 1;
                    foreach ($produkReg as $value) {
                        $detSummary = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $docId,
                            'intItemNumber' => $no,
                            'szProductId' => $value->szId,
                            'decQty' => $varianQty,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistory = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $varianQty,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $docId,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $total = $value->decQtyOnHand + $varianQty;
                        $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                        $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        // echo "<pre>".var_export($stockHistory, true)."</pre>";
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                        $no++;
                    }
                }

                //tolakan
                $fixProdTk = "'42001', '41001'";
                $produkTk = $this->mInventori->getKodeProduk($fixProdTk, $stok, $this->session->userdata('user_branch'));
                $num = 1;
                foreach ($produkTk as $value) {
                    if ($value->szId == '42001') {
                        $detSummaryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $doc2,
                            'intItemNumber' => $num,
                            'szProductId' => $value->szId,
                            'decQty' => $glnKsgAqAdm,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistoryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $glnKsgAqAdm,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $doc2,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $totalTk = $value->decQtyOnHand + $glnKsgAqAdm;
                        $updOnHandTk = array('decQtyOnHand' => $totalTk, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHandTk = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                    } elseif ($value->szId == '41001') {
                        $detSummaryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $doc2,
                            'intItemNumber' => $num,
                            'szProductId' => $value->szId,
                            'decQty' => $glnIsiAqAdm,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistoryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $glnIsiAqAdm,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $doc2,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $totalTk = $value->decQtyOnHand + $glnIsiAqAdm;
                        $updOnHandTk = array('decQtyOnHand' => $totalTk, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHandTk = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                    }
                    // echo "<pre>".var_export($updOnHandTk, true)."</pre>";
                    $historyStockTk = $this->mInventori->simpanData($stockHistoryTk, $base . '.dms_inv_stockhistory');
                    $onHandUpdateTk = $this->mInventori->updateData($whereOnHandTk, $updOnHandTk, $base . '.dms_inv_stockonhand');
                    $detailSmrTk = $this->mInventori->simpanData($detSummaryTk, $base . '.dms_inv_docstockinsupplieritem');
                    // echo "<pre>".var_export($detSummaryTk, true)."</pre>";
                    // echo "<pre>".var_export($stockHistoryTk, true)."</pre>";
                    // echo "<pre>".var_export($updOnHandTk, true)."</pre>";
                    // echo "<pre>".var_export($whereOnHandTk, true)."</pre>";
                    $num++;
                }
            } elseif ($produkKode == '45560') {
                //reguler
                if ($jugrackAdm > 0) {
                    $fixProd = "'74560', '74560G', '29311', '33300'";
                    $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                    $no = 1;
                    foreach ($produkReg as $value) {
                        if ($value->szId == '33300') {
                            $detSummary = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $docId,
                                'intItemNumber' => $no,
                                'szProductId' => $value->szId,
                                'decQty' => $jugrackAdm,
                                'szUomId' => $value->szUomId
                            );

                            $stockHistory = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $value->szId,
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $jugrackAdm,
                                'szUomId' => $value->szUomId,
                                'dtmTransaction' => $tglBtb,
                                'szTrnId' => 'DMSDocStockInSupplier',
                                'szDocId' => $docId,
                                'szUserCreatedId' => $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );

                            $total = $value->decQtyOnHand + $jugrackAdm;
                            $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                            $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                        } else {
                            $detSummary = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $docId,
                                'intItemNumber' => $no,
                                'szProductId' => $value->szId,
                                'decQty' => $varianQty,
                                'szUomId' => $value->szUomId
                            );

                            $stockHistory = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $value->szId,
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $varianQty,
                                'szUomId' => $value->szUomId,
                                'dtmTransaction' => $tglBtb,
                                'szTrnId' => 'DMSDocStockInSupplier',
                                'szDocId' => $docId,
                                'szUserCreatedId' => $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );

                            $total = $value->decQtyOnHand + $varianQty;
                            $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                            $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                        }
                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                        $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');
                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        // echo "<pre>".var_export($stockHistory, true)."</pre>";
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                        $no++;
                    }
                } else {
                    $fixProd = "'74560', '74560G', '29311'";
                    $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                    $no = 1;
                    foreach ($produkReg as $value) {
                        $detSummary = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $docId,
                            'intItemNumber' => $no,
                            'szProductId' => $value->szId,
                            'decQty' => $varianQty,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistory = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $varianQty,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $docId,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $total = $value->decQtyOnHand + $varianQty;
                        $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));

                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        // echo "<pre>".var_export($stockHistory, true)."</pre>";
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                        $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                        $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');

                        $no++;
                    }
                }

                //tolakan
                $fixProdTk = "'41012', '41013'";
                $produkTk = $this->mInventori->getKodeProduk($fixProdTk, $stok, $this->session->userdata('user_branch'));
                $num = 1;
                foreach ($produkTk as $value) {
                    if ($value->szId == '41012') {
                        $detSummaryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $doc2,
                            'intItemNumber' => $num,
                            'szProductId' => $value->szId,
                            'decQty' => $glnKsgVtAdm,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistoryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $glnKsgVtAdm,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $doc2,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $totalTk = $value->decQtyOnHand + $glnKsgVtAdm;
                        $updOnHandTk = array('decQtyOnHand' => $totalTk, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHandTk = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                    } elseif ($value->szId == '41013') {
                        $detSummaryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $doc2,
                            'intItemNumber' => $num,
                            'szProductId' => $value->szId,
                            'decQty' => $glnIsiVtAdm,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistoryTk = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $glnIsiVtAdm,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBtb,
                            'szTrnId' => 'DMSDocStockInSupplier',
                            'szDocId' => $doc2,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $totalTk = $value->decQtyOnHand + $glnIsiVtAdm;
                        $updOnHandTk = array('decQtyOnHand' => $totalTk, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHandTk = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                    }
                    // echo "<pre>".var_export($detSummaryTk, true)."</pre>";
                    // echo "<pre>".var_export($stockHistoryTk, true)."</pre>";
                    // echo "<pre>".var_export($updOnHandTk, true)."</pre>";
                    // echo "<pre>".var_export($whereOnHandTk, true)."</pre>";
                    $historyStockTk = $this->mInventori->simpanData($stockHistoryTk, $base . '.dms_inv_stockhistory');
                    $onHandUpdateTk = $this->mInventori->updateData($whereOnHandTk, $updOnHandTk, $base . '.dms_inv_stockonhand');
                    $detailSmrTk = $this->mInventori->simpanData($detSummaryTk, $base . '.dms_inv_docstockinsupplieritem');
                    $num++;
                }
            }

            $fileNamaPo =  $_FILES['uploadPO']['name'];
            $tmpNamaPo = $_FILES['uploadPO']['tmp_name'];
            $tgl = date("dd-mm-yyy");
            $fileUpNamePo = $tgl . "-UploadPo-" . $fileNamaPo;
            move_uploaded_file($tmpNamaPo, "assets/upload/" . $fileUpNamePo);

            $fileNamaGR =  $_FILES['uploadGR']['name'];
            $tmpNamaGR = $_FILES['uploadGR']['tmp_name'];
            $tgl = date("dd-mm-yyy");
            $fileUpNameGR = $tgl . "-UploadGr-" . $fileNamaGR;
            move_uploaded_file($tmpNamaGR, "assets/upload/" . $fileUpNameGR);

            $fileNamaDnTk =  $_FILES['uploadDnTk']['name'];
            $tmpNamaDnTk = $_FILES['uploadDnTk']['tmp_name'];
            $tgl = date("dd-mm-yyy");
            $fileUpNameDnTk = $tgl . "-UploadDnTk-" . $fileNamaDnTk;
            move_uploaded_file($tmpNamaDnTk, "assets/upload/" . $fileUpNameDnTk);

            $uploadBa = array(
                'noDoc' => $docId,
                'uploadPo' => $fileUpNamePo,
                'noPo' => $noPo,
                'uploadGr' => $fileUpNameGR,
                'noGr' => $noGr,
                'noDocTk' => $doc2,
                'uploadDnTk' => $fileNamaDnTk,
                'noDnTk' => $noDnTk
            );
            $uploadTrue = $this->mInventori->simpanData($uploadBa, $base . '.mdbauploadba');

            $updateCount = array('intLastCounter' => $counter + 1);
            $whereCount = array('szId' => $countId);
            // echo "<pre>".var_export($updateCount, true)."</pre>";
            // echo "<pre>".var_export($whereCount, true)."</pre>";
            $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');

            // $document = "$docId/$doc2";

            if ($co == 'true' && $gr == 'true' && $dn == 'true' && $po == 'true' && $tolakan == 'true' && $headerSmr == 'true' && $detailSmr == 'true' && $historyStock == 'true' && $onHandUpdate == 'true' && $counterUpdate == 'true' && $headerSmrTk == 'true' && $historyStockTk == 'true' && $onHandUpdateTk == 'true' && $detailSmrTk == 'true' && $uploadTrue == 'true') {
                $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('home/btbSupplier/'));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventori/tambahBtbSupplier/' . $po));
                exit;
            }
        }
    }

    public function createBkbSupplierGln()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        //po
        $noPo = $this->input->post('noPo');
        $returnIsiAdm = $this->input->post('returnIsiAdm');
        $jugrackAdm = $this->input->post('jugrackAdm');
        $glnKosongAdm = $this->input->post('glnKosongAdm');
        $nopolAdm = $this->input->post('nopolAdm');
        $driverAdm = $this->input->post('driverAdm');
        $driver2Adm = $this->input->post('driver2Adm');
        $transporterAdm = $this->input->post('transporterAdm');
        $transporterAdmKode = $this->input->post('transporterAdmKode');
        $paletAdm = $this->input->post('paletAdm');

        //co
        $noCo = substr($this->input->post('noCo'), 1);
        $hariAdm = $this->input->post('hariAdm');
        $tglWindowAdm = $this->input->post('tglWindowAdm');
        $pabrikWindowAdm = $this->input->post('pabrikWindowAdm');
        $materialAdm = $this->input->post('materialAdm');
        $tujuanAwalAdm = $this->input->post('tujuanAwalAdm');
        $tujuanFinalAdm = $this->input->post('tujuanFinalAdm');
        $tujuanCoAdm = $this->input->post('tujuanCoAdm');

        //gr
        $noGr = $this->input->post('noGr');
        $sendAdm = $this->input->post('sendAdm');
        $produkGrAdm = $this->input->post('produkGrAdm');
        $qtyGrAdm = $this->input->post('qtyGrAdm');

        //dn
        $noDn = $this->input->post('noDn');
        $tglDnAdm = $this->input->post('tglDnAdm');
        $sendDnAdm = $this->input->post('sendDnAdm');
        $pabrikDnAdm = $this->input->post('pabrikDnAdm');
        $nopolDnAdm = $this->input->post('nopolDnAdm');
        $driverDnAdm = $this->input->post('driverDnAdm');
        $produkDnAdm = $this->input->post('produkDnAdm');
        $qtyDnAdm = $this->input->post('qtyDnAdm');

        //summary
        $tglBkb = $this->input->post('tglBkb');
        $docId = $this->input->post('docId');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $keterangan = $this->input->post('keterangan');
        $produkNama = $this->input->post('produkNama');
        $produkKode = $this->input->post('produkKode');
        $varianQty = $this->input->post('varianQty');
        $codeProduct = $this->input->post('codeProduct');
        $spsQty = $this->input->post('spsQty');

        $smrAdmReturn = $this->input->post('smrAdmReturn');
        $smrAdmJugrack = $this->input->post('smrAdmJugrack');
        $smrAdmGalKos = $this->input->post('smrAdmGalKos');
        $smrAdmGr = $this->input->post('smrAdmGr');
        // $smrAdmBs = $this->input->post('smrAdmBs');
        $smrAdmTotalDn = $this->input->post('smrAdmTotalDn');

        $mdbaCo = array(
            'coNo' => $noCo,
            'coHari' => $hariAdm,
            'coTgl' => $tglWindowAdm,
            'coPabrik' => $pabrikWindowAdm,
            'coProduk' => $materialAdm,
            'coTujuanAwal' => $tujuanAwalAdm,
            'coTujuanFinal' => $tujuanFinalAdm,
            'coTujuan' => $tujuanCoAdm,
            'coUserAdd' => $this->session->userdata('user_nik'),
            'coUserUpdate' => $this->session->userdata('user_nik'),
            'coTimeAdd' => date('Y-m-d H:i:s'),
            'coTimeUpdate' => date('Y-m-d H:i:s')
        );
        $co = $this->mInventori->simpanData($mdbaCo, $base . '.mdbaCoAdmin');

        $mdbaDn = array(
            'dnNo' => $noDn,
            'dnTanggal' => $tglDnAdm,
            'dnDepo' => $sendDnAdm,
            'dnPabrik' => $pabrikDnAdm,
            'dnNopol' => $nopolDnAdm,
            'dnProduk' => $produkDnAdm,
            'dnQty' => $qtyDnAdm,
            'dnUserAdd' => $this->session->userdata('user_nik'),
            'dnUserUpdate' => $this->session->userdata('user_nik'),
            'dnTimeAdd' => date('Y-m-d H:i:s'),
            'dnTimeUpdate' => date('Y-m-d H:i:s')
        );
        $dn = $this->mInventori->simpanData($mdbaDn, $base . '.mdbaDnAdmin');

        $mdbaPo = array(
            'poNo' => $noPo,
            'poReturnIsi' => $returnIsiAdm,
            'poJugrack' => $jugrackAdm,
            'poGlnKosong' => $glnKosongAdm,
            'poPalet' => $paletAdm,
            'poNopol' => $nopolAdm,
            'poSupir' => $driverAdm,
            'poSupirPengganti' => $driver2Adm,
            'poTransporter' => $transporterAdm,
            'poUserAdd' => $this->session->userdata('user_nik'),
            'poUserUpdate' => $this->session->userdata('user_nik'),
            'poTimeAdd' => date('Y-m-d H:i:s'),
            'poTimeUpdate' => date('Y-m-d H:i:s')
        );
        $po = $this->mInventori->simpanData($mdbaPo, $base . '.mdbaPoAdmin');

        $mdbaGr = array(
            'grNo' => $noGr,
            'grDepo' => $sendAdm,
            'grProduk' => $produkGrAdm,
            'grQty' => $qtyGrAdm,
            'grUserAdd' => $this->session->userdata('user_nik'),
            'grUserUpdate' => $this->session->userdata('user_nik'),
            'grTimeAdd' => date('Y-m-d H:i:s'),
            'grTimeUpdate' => date('Y-m-d H:i:s')
        );
        $gr = $this->mInventori->simpanData($mdbaGr, $base . '.mdbaGrAdmin');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $dmsPabrik = $this->mInventori->getDmsPabrik($pabrikWindowAdm);

        //counter update 
        $countId = 'BKBSUPP' . $this->session->userdata('user_branch') . 'COU';
        $counter = $this->mInventori->getCounter($countId);

        if ($produkKode == '74559' && $produkKode == '74560') {
            if ($jugrackAdm != '0' || $returnIsiAdm != '0') {
                $bkbSummary = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $docId,
                    'dtmDoc' => $tglBkb,
                    'szSupplierId' => $dmsPabrik,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'szRefDocId' => $noDn,
                    'dtmDn' => $tglDnAdm,
                    'szCarrierId' => $transporterAdmKode,
                    'szVehicle' => 'MANUAL',
                    'szDriver' => 'MANUAL',
                    'szVehicle2' => $nopolAdm,
                    'szDriver2' => $driverAdm,
                    'szRef1' => $noCo,
                    'szRef2' => $noGr,
                    'szRef3' => $noPo,
                    'intShift' => '0',
                    'intHelperCount' => '0',
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:S'),
                    'szDescription' => $keterangan,
                    'bFromOTM' => '0'
                );

                // echo "<pre>".var_export($bkbSummary, true)."</pre>";
                $headerSmr = $this->mInventori->simpanData($bkbSummary, $base . '.dms_inv_docstockoutsupplier');

                if ($jugrackAdm != '0' && $returnIsiAdm != '0') {
                    if ($produkKode == '74559') {
                        $fixProd = "'74559G', '33300', '42001', '41001'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            if ($value->szId == '33300') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $jugrackAdm,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $jugrackAdm,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $jugrackAdm;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } elseif ($value->szId == '74559G') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $smrAdmGalKos;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } else {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $smrAdmReturn,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $smrAdmReturn,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $smrAdmReturn;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            }
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockoutsupplieritem');
                            // echo "<pre>".var_export($detSummary, true)."</pre>";
                            // echo "<pre>".var_export($stockHistory, true)."</pre>";
                            // echo "<pre>".var_export($updOnHand, true)."</pre>";
                            // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                            $no++;
                        }
                    } elseif ($produkKode == '74560') {
                        $fixProd = "'74560G', '33300', '41012', '41013'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            if ($value->szId == '33300') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $jugrackAdm,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $jugrackAdm,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $jugrackAdm;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } elseif ($value->szId == '74560G') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $smrAdmGalKos;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } else {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $smrAdmReturn,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $smrAdmReturn,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $smrAdmReturn;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            }
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockoutsupplieritem');
                            // echo "<pre>".var_export($detSummary, true)."</pre>";
                            // echo "<pre>".var_export($stockHistory, true)."</pre>";
                            // echo "<pre>".var_export($updOnHand, true)."</pre>";
                            // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                            $no++;
                        }
                    }
                } elseif ($jugrackAdm == '0') {
                    if ($produkKode == '74559') {
                        $fixProd = "'74559G', '42001', '41001'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            if ($value->szId == '74559G') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $smrAdmGalKos;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } else {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $smrAdmReturn,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $smrAdmReturn,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $smrAdmReturn;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            }
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockoutsupplieritem');
                            // echo "<pre>".var_export($detSummary, true)."</pre>";
                            // echo "<pre>".var_export($stockHistory, true)."</pre>";
                            // echo "<pre>".var_export($updOnHand, true)."</pre>";
                            // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                            $no++;
                        }
                    } elseif ($produkKode == '74560') {
                        $fixProd = "'74560G', '41012', '41013'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            if ($value->szId == '74560G') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $smrAdmGalKos;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } else {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $smrAdmReturn,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $smrAdmReturn,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $smrAdmReturn;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            }
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockoutsupplieritem');
                            // echo "<pre>".var_export($detSummary, true)."</pre>";
                            // echo "<pre>".var_export($stockHistory, true)."</pre>";
                            // echo "<pre>".var_export($updOnHand, true)."</pre>";
                            // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                            $no++;
                        }
                    }
                } elseif ($returnIsiAdm == '0') {
                    if ($produkKode == '74559') {
                        $fixProd = "'74559G', '33300'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            if ($value->szId == '33300') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $jugrackAdm,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $jugrackAdm,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $jugrackAdm;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } elseif ($value->szId == '74559G') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $smrAdmGalKos;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            }
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockoutsupplieritem');
                            // echo "<pre>".var_export($detSummary, true)."</pre>";
                            // echo "<pre>".var_export($stockHistory, true)."</pre>";
                            // echo "<pre>".var_export($updOnHand, true)."</pre>";
                            // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                            $no++;
                        }
                    } elseif ($produkKode == '74560') {
                        $fixProd = "'74560G', '33300'";
                        $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                        $no = 1;
                        foreach ($produkReg as $value) {
                            if ($value->szId == '33300') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $jugrackAdm,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $jugrackAdm,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $jugrackAdm;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            } elseif ($value->szId == '74560G') {
                                $detSummary = array(
                                    'iId' => $this->uuid->v4(),
                                    'szDocId' => $docId,
                                    'intItemNumber' => $no,
                                    'szProductId' => $value->szId,
                                    'decQty' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId
                                );

                                $stockHistory = array(
                                    'iId' => $this->uuid->v4(),
                                    'szProductId' => $value->szId,
                                    'szLocationType' => 'WAREHOUSE',
                                    'szLocationId' => $gudang,
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'decQtyOnHand' => $smrAdmGalKos,
                                    'szUomId' => $value->szUomId,
                                    'dtmTransaction' => $tglBkb,
                                    'szTrnId' => 'DMSDocStockOutSupplier',
                                    'szDocId' => $docId,
                                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmCreated' => date('Y-m-d H:i:s'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );

                                $total = $value->decQtyOnHand - $smrAdmGalKos;
                                $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                                $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));
                            }
                            $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                            $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockoutsupplieritem');
                            // echo "<pre>".var_export($detSummary, true)."</pre>";
                            // echo "<pre>".var_export($stockHistory, true)."</pre>";
                            // echo "<pre>".var_export($updOnHand, true)."</pre>";
                            // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                            $no++;
                        }
                    }
                }
            } else {
                $bkbSummary = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $docId,
                    'dtmDoc' => $tglBkb,
                    'szSupplierId' => $dmsPabrik,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'szRefDocId' => $noDn,
                    'dtmDn' => $tglDnAdm,
                    'szCarrierId' => $transporterAdmKode,
                    'szVehicle' => 'MANUAL',
                    'szDriver' => 'MANUAL',
                    'szVehicle2' => $nopolAdm,
                    'szDriver2' => $driverAdm,
                    'szRef1' => $noCo,
                    'szRef2' => $noGr,
                    'szRef3' => $noPo,
                    'intShift' => '0',
                    'intHelperCount' => '0',
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:S'),
                    'szDescription' => $keterangan,
                    'bFromOTM' => '0'
                );

                // echo "<pre>".var_export($bkbSummary, true)."</pre>";
                $headerSmr = $this->mInventori->simpanData($bkbSummary, $base . '.dms_inv_docstockoutsupplier');

                if ($produkKode == '74559') {
                    $fixProd = "'74559G'";
                    $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                    $no = 1;
                    foreach ($produkReg as $value) {
                        $detSummary = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $docId,
                            'intItemNumber' => $no,
                            'szProductId' => $value->szId,
                            'decQty' => $smrAdmGalKos,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistory = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $smrAdmGalKos,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBkb,
                            'szTrnId' => 'DMSDocStockOutSupplier',
                            'szDocId' => $docId,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $total = $value->decQtyOnHand - $smrAdmGalKos;
                        $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));

                        $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                        $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockoutsupplieritem');
                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        // echo "<pre>".var_export($stockHistory, true)."</pre>";
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                        $no++;
                    }
                } elseif ($produkKode == '74560') {
                    $fixProd = "'74560G'";
                    $produkReg = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
                    $no = 1;
                    foreach ($produkReg as $value) {

                        $detSummary = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $docId,
                            'intItemNumber' => $no,
                            'szProductId' => $value->szId,
                            'decQty' => $smrAdmGalKos,
                            'szUomId' => $value->szUomId
                        );

                        $stockHistory = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $value->szId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $smrAdmGalKos,
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tglBkb,
                            'szTrnId' => 'DMSDocStockOutSupplier',
                            'szDocId' => $docId,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );

                        $total = $value->decQtyOnHand - $smrAdmGalKos;
                        $updOnHand = array('decQtyOnHand' => $total, 'szUserUpdatedId' => $this->session->userdata('user_nik'), 'dtmLastUpdated' => date('Y-m-d H:i:s'));
                        $whereOnHand = array('szProductId' => $value->szId, 'szStockTypeId' => $stok, 'szReportedAsId' => $this->session->userdata('user_branch'));

                        $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');
                        $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockoutsupplieritem');
                        // echo "<pre>".var_export($detSummary, true)."</pre>";
                        // echo "<pre>".var_export($stockHistory, true)."</pre>";
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        // echo "<pre>".var_export($whereOnHand, true)."</pre>";
                        $no++;
                    }
                }
            }

            $fileNamaPo =  $_FILES['uploadPO']['name'];
            $tmpNamaPo = $_FILES['uploadPO']['tmp_name'];
            $tgl = date("dd-mm-yyy");
            $fileUpNamePo = $tgl . "-UploadPo-" . $fileNamaPo;


            $fileNamaGR =  $_FILES['uploadGR']['name'];
            $tmpNamaGR = $_FILES['uploadGR']['tmp_name'];
            $tgl = date("dd-mm-yyy");
            $fileUpNameGR = $tgl . "-UploadGr-" . $fileNamaGR;

            if ($fileNamaPo != '' && $fileNamaGR != '') {
                move_uploaded_file($tmpNamaGR, "assets/upload/" . $fileUpNameGR);
                move_uploaded_file($tmpNamaPo, "assets/upload/" . $fileUpNamePo);
                $uploadBa = array(
                    'noDoc' => $docId,
                    'uploadPo' => $fileUpNamePo,
                    'noPo' => $noPo,
                    'uploadGr' => $fileUpNameGR,
                    'noGr' => $noGr
                );
                $uploadTrue = $this->mInventori->simpanData($uploadBa, $base . '.mdbauploadba');
            } elseif ($fileNamaPo != '') {
                move_uploaded_file($tmpNamaGR, "assets/upload/" . $fileUpNameGR);
                $uploadBa = array(
                    'noDoc' => $docId,
                    'uploadGr' => $fileUpNameGR,
                    'noGr' => $noGr
                );
                $uploadTrue = $this->mInventori->simpanData($uploadBa, $base . '.mdbauploadba');
            } elseif ($fileNamaGR != '') {
                move_uploaded_file($tmpNamaPo, "assets/upload/" . $fileUpNamePo);
                $uploadBa = array(
                    'noDoc' => $docId,
                    'uploadPo' => $fileUpNamePo,
                    'noPo' => $noPo
                );
                $uploadTrue = $this->mInventori->simpanData($uploadBa, $base . '.mdbauploadba');
            }

            $updateCount = array('intLastCounter' => $counter + 1);
            $whereCount = array('szId' => $countId);
            // echo "<pre>".var_export($updateCount, true)."</pre>";
            // echo "<pre>".var_export($whereCount, true)."</pre>";
            $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');

            // $document = "$docId/$doc2";

            if ($co == 'true' && $gr == 'true' && $dn == 'true' && $po == 'true' && $headerSmr == 'true' && $detailSmr == 'true' && $historyStock == 'true' && $onHandUpdate == 'true' && $counterUpdate == 'true' && $uploadTrue == 'true') {
                $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('home/bkbSupplier/'));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventori/tambahBkbSupplier/' . $po));
                exit;
            }
        }
    }

    public function btbSupplierHistory()
    {
        $tanggal = date('Y-m-d');
        $data['a'] = $this->mInventori->getListHistoryBtbSupp($tanggal);
        $this->load->view('vBtbSupplierHistory', $data);
    }

    public function cetakBtbSupplier($document)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['document'] = $document;
        $data['load'] = $this->mInventori->getDataCetakBtbSupp($document);

        // filename dari pdf ketika didownload
        $file_pdf = 'BTB Supplier Depo ' . $this->session->userdata('user_lokasi') . ' - ' . $document;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('vBtbSupplierCetak', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function tglHistoryBtbSupp()
    {
        $tanggal = $this->input->post('tanggal');
        $data['a'] = $this->mInventori->getListHistoryBtbSupp($tanggal);
        $this->load->view('vBtbSupplierHistory', $data);
    }

    public function editBtbSupplier($document)
    {
        $depo = $this->session->userdata('user_branch');

        $newSupp = 'BTBSUPP' . $depo . 'COU';
        $data['newSupp'] = $this->mInventori->getId($newSupp);
        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventori->getId($adjustment);
        $data['document'] = $document;
        $data['a'] = $this->mInventori->editBtbSupplier($document);
        $data['gudang'] = $this->mHome->getGudang();
        $data['stok'] = $this->mHome->getTipeStok();
        $data['carrier'] = $this->mHome->getCarrier();
        $data['produk'] = $this->mHome->getProduk();
        $data['supplier'] = $this->mHome->getSupplier();

        $getCarrier = $this->mInventori->editBtbSupplier($document);
        foreach ($getCarrier as $value) {
            $carrier = $value->szCarrierId;
        }
        $data['kendaraan'] = $this->mInventori->getKendaraan($carrier);
        $data['pengemudi'] = $this->mInventori->getPengemudi($carrier);

        $this->load->view('vBtbSupplierEdit', $data);
    }

    public function detailBtbSupplier()
    {
        $document = $this->input->post('id');
        $data = $this->mInventori->editBtbSupplier($document);
        echo json_encode($data);
    }

    public function updateBtbSupplierGln()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $noDoc = $this->input->post('noDoc');
        $noDocOld = $this->input->post('noDocOld');
        $noAdjustment = $this->input->post('noAdjustment');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $supplier = $this->input->post('supplier');
        $jasaPengangkut = $this->input->post('jasaPengangkut');
        $kendaraan = $this->input->post('kendaraan');
        $pengemudi = $this->input->post('pengemudi');
        $noSuratJalan = $this->input->post('noSuratJalan');
        $tglSuratJalan = $this->input->post('tglSuratJalan');
        $noRef1 = $this->input->post('noRef1');
        $noRef2 = $this->input->post('noRef2');
        $noRef3 = $this->input->post('noRef3');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $keterangan = $this->input->post('keterangan');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $forStockHistory = $this->mInventori->editBtbSupplier($noDocOld);
        $prodOld = '';
        foreach ($forStockHistory as $value) {
            $stockHistoryOld = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $value->szProductId,
                'szLocationType' => 'WAREHOUSE',
                'szLocationId' => $value->szWarehouseId,
                'szStockTypeId' => $value->szStockType,
                'decQtyOnHand' => -$value->decQty,
                'szUomId' => $value->szUomId,
                'dtmTransaction' => date('Y-m-d'),
                'szTrnId' => 'DMSDocStockInSupplier',
                'szDocId' => $noDocOld,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $historyStockOld = $this->mInventori->simpanData($stockHistoryOld, $base . '.dms_inv_stockhistory');

            $prodOld .= "'" . $value->szProductId . "',";
            $stokOld = $value->szStockType;

            $updDetailSupplier = array(
                'decQty' => -$value->decQty
            );

            $whereDetailSupplier = array(
                'szDocId' => $noDocOld,
                'szProductId' => $value->szProductId
            );

            $detailSupplierUpdateOld = $this->mInventori->updateData($whereDetailSupplier, $updDetailSupplier, $base . '.dms_inv_docstockinsupplieritem');
        }

        $cekLen = strlen($prodOld);
        $prodOld2 = substr($prodOld, 0, $cekLen - 1);
        $stockOnHandUpdate = $this->mInventori->getKodeProduk($prodOld2, $stokOld, $this->session->userdata('user_branch'));
        foreach ($stockOnHandUpdate as $value) {

            foreach ($forStockHistory as $key) {
                if ($key->szProductId == $value->szId) {
                    $updOnHandOld = array(
                        'decQtyOnHand' => $value->decQtyOnHand - $key->decQty,
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );

                    $whereOnHandOld = array(
                        'szProductId' => $value->szId,
                        'szStockTypeId' => $stokOld,
                        'szReportedAsId' => $this->session->userdata('user_branch')
                    );

                    $onHandUpdateOld = $this->mInventori->updateData($whereOnHandOld, $updOnHandOld, $base . '.dms_inv_stockonhand');

                    // echo "<pre>".var_export($updOnHandTk, true)."</pre>";
                }
            }
        }

        $btbSummary = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noDoc,
            'dtmDoc' => $tgl,
            'szSupplierId' => $supplier,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'szRefDocId' => $noSuratJalan,
            'dtmDn' => $tglSuratJalan,
            'szCarrierId' => $jasaPengangkut,
            'szVehicle' => 'MANUAL',
            'szDriver' => 'MANUAL',
            'szVehicle2' => $kendaraan,
            'szDriver2' => $pengemudi,
            'szRef1' => $noRef1,
            'szRef2' => $noRef2,
            'szRef3' => $noRef3,
            'intShift' => '0',
            'intHelperCount' => '0',
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:S'),
            'szDescription' => $keterangan,
            'bFromOTM' => '0'
        );
        $headerSmr = $this->mInventori->simpanData($btbSummary, $base . '.dms_inv_docstockinsupplier');

        $adjRefDoc = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noAdjustment,
            'szRefDocId' => $noDoc,
            'szRefDocTypeId' => 'DMSDocStockInSupplier',
            'szAdjustmentId' => $noDocOld
        );
        $refDocAdj = $this->mInventori->simpanData($adjRefDoc, $base . '.dms_inv_stockadjustmentrefdoc');

        $adjustmentHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noAdjustment,
            'dtmDoc' => $tgl,
            'szRefTypeDoc' => 'DMSDocStockInSupplier',
            'szRefDocId' => $noDoc,
            'szDescription' => $keterangan,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:S')
        );
        $headAdj = $this->mInventori->simpanData($adjustmentHeader, $base . '.dms_inv_docstockadjustment');

        $prodNew = '';
        for ($i = 0; $i <= count($produk); $i++) {
            $prodNew .= "'" . $produk[$i] . "',";
        }

        $cekLenNew = strlen($prodNew);
        $prodNew2 = substr($prodNew, 0, $cekLenNew - 1);
        $stockNew = $this->mInventori->getKodeProduk($prodNew2, $stok, $this->session->userdata('user_branch'));
        foreach ($stockNew as $value) {
            for ($i = 0; $i <= count($produk); $i++) {
                if ($value->szId == $produk[$i]) {
                    $detSummary = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noDoc,
                        'intItemNumber' => $i + 1,
                        'szProductId' => $value->szId,
                        'decQty' => $qty[$i],
                        'szUomId' => $value->szUomId
                    );
                    $detailSmr = $this->mInventori->simpanData($detSummary, $base . '.dms_inv_docstockinsupplieritem');

                    $detAdjustment = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noAdjustment,
                        'intItemNumber' => $i + 1,
                        'szProductId' => $value->szId,
                        'decQty' => $qty[$i],
                        'szUomId' => $value->szUomId
                    );
                    $detAdjustment = $this->mInventori->simpanData($detAdjustment, $base . '.dms_inv_docstockadjustmentitem');

                    $stockHistory = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $value->szId,
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $qty[$i],
                        'szUomId' => $value->szUomId,
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInSupplier',
                        'szDocId' => $noDoc,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $historyStock = $this->mInventori->simpanData($stockHistory, $base . '.dms_inv_stockhistory');

                    $updOnHand = array(
                        'decQtyOnHand' => $value->decQtyOnHand + $qty[$i],
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );

                    $whereOnHand = array(
                        'szProductId' => $value->szId,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch')
                    );

                    $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                    // echo "<pre>".var_export($updOnHand, true)."</pre>";
                }
            }
        }

        $countId = 'BTBSUPP' . $this->session->userdata('user_branch') . 'COU';
        $counterSupp = $this->mInventori->getCounter($countId);
        $adjustment = 'ADJ' . $this->session->userdata('user_branch') . 'COU';
        $counterAdj = $this->mInventori->getCounter($adjustment);
        $newCountSupp = $counterSupp + 1;
        $newCountAdj = $counterAdj + 1;

        $updateCount = array('intLastCounter' => $newCountSupp);
        $whereCount = array('szId' => $countId);
        $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');

        $updateCountAdj = array('intLastCounter' => $newCountAdj);
        $whereCountAdj = array('szId' => $adjustment);
        $counterUpdateAdj = $this->mInventori->updateData($whereCountAdj, $updateCountAdj, $base . '.dms_sm_counter');

        if ($historyStockOld == 'true' && $detailSupplierUpdateOld == 'true' && $onHandUpdateOld == 'true' && $headerSmr == 'true' && $refDocAdj == 'true' && $headAdj == 'true' && $detailSmr == 'true' && $detAdjustment == 'true' && $historyStock == 'true' && $onHandUpdate == 'true' && $counterUpdate == 'true' && $counterUpdateAdj == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('inventori/btbSupplierHistory/'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventori/editBtbSupplier/' . $noDocOld));
            exit;
        }
    }

    //DISTRIBUSI

    public function tambahBtbDistribusi($bkb)
    {

        $depo = $this->session->userdata('user_branch');

        $data['data'] = $this->mInventori->getDataTambahBkbDistribution($bkb);
        $bsAq = $this->mInventori->getBsAqua($bkb);
        if ($bsAq == 0) {
            $data['bsAq'] = '0';
        } else {
            $data['bsAq'] = $this->mInventori->getBsAqua($bkb);
        }

        $bsVt = $this->mInventori->getBsVit($bkb);
        if ($bsVt == 0) {
            $data['bsVt'] = '0';
        } else {
            $data['bsVt'] = $this->mInventori->getBsVit($bkb);
        }

        $id = 'BTBDIST' . $depo . 'COU';
        $data['id'] = $this->mInventori->getId($id);

        $data['gudang'] = $this->mHome->getGudang();
        $data['pengemudi'] = $this->mHome->getDriverDistribusi($depo);
        $data['kendaraan'] = $this->mHome->getVehicleDistribusi($depo);
        // echo "<pre>".var_export($this->mInventori->getDataTambahBkbDistribution($bkb), true)."</pre>";
        $this->load->view('vBtbDistribusiTambah', $data);
    }

    public function tambahBtbDistribusiSps($bkb)
    {
        $depo = $this->session->userdata('user_branch');

        $data['data'] = $this->mInventori->getDataTambahBkbDistributionSps($bkb);

        $id = 'BTBDIST' . $depo . 'COU';
        $data['id'] = $this->mInventori->getId($id);

        $data['gudang'] = $this->mHome->getGudang();
        $data['pengemudi'] = $this->mHome->getDriverDistribusi($depo);
        $data['kendaraan'] = $this->mHome->getVehicleDistribusi($depo);
        $data['produk'] = $this->mHome->getProduk();
        // echo "<pre>".var_export($this->mInventori->getDataTambahBkbDistribution($bkb), true)."</pre>";
        $this->load->view('vBtbDistribusiTambahSps', $data);
    }

    public function createBtbDistribusi()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $noBtb = $this->input->post('noBtb');
        $noBkb = $this->input->post('noBkb');
        $admAqKos = $this->input->post('admAqKos');
        $admVtKos = $this->input->post('admVtKos');
        $admAqSisa = $this->input->post('admAqSisa');
        $admVtSisa = $this->input->post('admVtSisa');
        $admAqJambot = $this->input->post('admAqJambot');
        $admVtJambot = $this->input->post('admVtJambot');
        $admAqBs = $this->input->post('admAqBs');
        $admVtBs = $this->input->post('admVtBs');

        $smrBkb = $this->input->post('smrBkb');
        $smrBtb = $this->input->post('smrBtb');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $produkKode = $this->input->post('produkKode');
        $produkQty = $this->input->post('produkQty');
        $produkSatuan = $this->input->post('produkSatuan');
        $keterangan = $this->input->post('keterangan');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $refDocBtb = array(
            'refId' => $noBtb,
            'refOld' => $noBkb,
            'refTanggal' => date('Y-m-d'),
            'refDepo' => $this->session->userdata('user_branch'),
            'refDocType' => 'DMSDocStockInDistribution',
            'refUserAdd' => $this->session->userdata('user_nik'),
            'refUserUpdate' => $this->session->userdata('user_nik'),
            'refDateAdd' => date('Y-m-d H:i:s'),
            'refDateUpdate' => date('Y-m-d H:i:s')
        );
        $btbRefDoc = $this->mInventori->simpanData($refDocBtb, $base . '.mdbaRefDoc');

        $inDistribution = array(
            'mdbaBtb' => $noBtb,
            'mdbaBkb' => $noBkb,
            'mdbaKosAq' => $admAqKos,
            'mdbaKosVt' => $admVtKos,
            'mdbaSisaAq' => $admAqSisa,
            'mdbaSisaVt' => $admVtSisa,
            'mdbaJambotAq' => $admAqJambot,
            'mdbaJambotVt' => $admVtJambot,
            'mdbaBsAq' => $admAqBs,
            'mdbaBsVt' => $admVtBs
        );
        $distributionIn = $this->mInventori->simpanData($inDistribution, $base . '.mdbaInDistribution');

        $mdbaHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noBtb,
            'szDocBkb' => $noBkb,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan,
            'szVehicleId' => $kendaraan
        );
        $headerMdba = $this->mInventori->simpanData($mdbaHeader, $base . '.mdbaHistoryDistributionIn');

        $dmsHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noBtb,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan,
            'szVehicleId' => $kendaraan
        );
        $headerDms = $this->mInventori->simpanData($dmsHeader, $base . '.dms_inv_docstockindistribution');
        $headerDmss = $this->mInventDist->simpanDms($dmsHeader, 'dms.dms_inv_docstockindistribution');

        $prod = '';
        for ($i = 0; $i < count($produkKode); $i++) {
            $detail = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $noBtb,
                'intItemNumber' => $i,
                'szProductId' => $produkKode[$i],
                'decQty' => $produkQty[$i],
                'szUomId' => $produkSatuan[$i]
            );
            // echo "<pre>" . var_export($detail, true) . "</pre>";
            $detailMdba = $this->mInventori->simpanData($detail, $base . '.mdbaHistoryDistributionInItem');
            $detailDms = $this->mInventori->simpanData($detail, $base . '.dms_inv_docstockindistributionItem');
            $detailDmss = $this->mInventDist->simpanDms($detail, 'dms.dms_inv_docstockindistributionItem');

            $stockHistoryDrv = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $produkKode[$i],
                'szLocationType' => 'EMPLOYEE',
                'szLocationId' => $pengemudi,
                'szStockTypeId' => 'IN TRANSIT',
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => -$produkQty[$i],
                'szUomId' => $produkSatuan[$i],
                'dtmTransaction' => $tgl,
                'szTrnId' => 'DMSDocStockInDistribution',
                'szDocId' => $noBtb,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $driverStockHistory = $this->mInventori->simpanData($stockHistoryDrv, $base . '.dms_inv_stockhistory');
            $driverStockHistoryDms = $this->mInventDist->simpanDms($stockHistoryDrv, 'dms.dms_inv_stockhistory');

            $stockHistoryGdg = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $produkKode[$i],
                'szLocationType' => 'WAREHOUSE',
                'szLocationId' => $gudang,
                'szStockTypeId' => $stok,
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => $produkQty[$i],
                'szUomId' => $produkSatuan[$i],
                'dtmTransaction' => $tgl,
                'szTrnId' => 'DMSDocStockInDistribution',
                'szDocId' => $noBtb,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $gudangStockHistory = $this->mInventori->simpanData($stockHistoryGdg, $base . '.dms_inv_stockhistory');
            $gudangStockHistoryDms = $this->mInventDist->simpanDms($stockHistoryGdg, 'dms.dms_inv_stockhistory');

            $stockTypeIdP = "'IN TRANSIT'";
            $lokasiIdP = "'$pengemudi'";
            $sOnHand = $this->mInventori->stockOnHandDist("'.$produkKode[$i].'", $lokasiIdP, $stockTypeIdP);
            if (count($sOnHand) != 0) {
                foreach ($sOnHand as $value) {
                    if ($produkKode[$i] == $value->szProductId) {
                        $updOnHand = array(
                            'decQtyOnHand' => $value->decQtyOnHand + $produkQty[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHand = array(
                            'szProductId' => $produkKode[$i],
                            'szStockTypeId' => 'EMPLOYEE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'IN TRANSIT'
                        );
                    }
                }
            }
            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
            $onHandUpdateDms = $this->mInventDist->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');

            $stockTypeIdG = "'JUAL'";
            $lokasiIdG = "'$gudang'";
            $sOnHandG = $this->mInventori->stockOnHandDist("'.$produkKode[$i].'", $lokasiIdG, $stockTypeIdG);
            if (count($sOnHand) != 0) {
                foreach ($sOnHandG as $value) {
                    if ($produkKode[$i] == $value->szProductId) {
                        $updOnHandG = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $produkQty[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandG = array(
                            'szProductId' => $produkKode[$i],
                            'szStockTypeId' => 'WAREHOUSE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'JUAL'
                        );
                    }
                }
                // echo "<pre>" . var_export($updOnHandG, true) . "</pre>";
                // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";
                $onHandUpdateG = $this->mInventori->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
                $onHandUpdateGDms = $this->mInventDms->updateDms($whereOnHandG, $updOnHandG, 'dms.dms_inv_stockonhand');
            }
        }

        //counter update 
        $countId = 'BTBDIST' . $this->session->userdata('user_branch') . 'COU';
        $counter = $this->mInventori->getCounter($countId);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $countId);
        $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
        $counterUpdateDms = $this->mInventDms->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        if ($btbRefDoc == 'true' && $distributionIn == 'true' && $headerMdba == 'true' && $headerDms == 'true' && $detailMdba == 'true' && $detailDms == 'true' && $driverStockHistory == 'true' && $gudangStockHistory == 'true' && $onHandUpdateG == 'true' && $counterUpdate == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/btbDistribusi/'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventori/tambahBtbDistribusi/' . $noBkb));
            exit;
        }
    }

    public function createBtbDistribusiSps()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $noBtb = $this->input->post('noBtb');
        $noBkb = $this->input->post('noBkb');
        $admSisa = $this->input->post('admSisa');
        $admBs = $this->input->post('admBs');

        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $produkKode = $this->input->post('produk');
        $produkQty = $this->input->post('produkQty');
        $produkSatuan = $this->input->post('produkSatuan');
        $keterangan = $this->input->post('keterangan');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $refDocBtb = array(
            'refId' => $noBtb,
            'refOld' => $noBkb,
            'refTanggal' => date('Y-m-d'),
            'refDepo' => $this->session->userdata('user_branch'),
            'refDocType' => 'DMSDocStockInDistribution',
            'refUserAdd' => $this->session->userdata('user_nik'),
            'refUserUpdate' => $this->session->userdata('user_nik'),
            'refDateAdd' => date('Y-m-d H:i:s'),
            'refDateUpdate' => date('Y-m-d H:i:s')
        );
        $btbRefDoc = $this->mInventori->simpanData($refDocBtb, $base . '.mdbaRefDoc');

        $inDistribution = array(
            'mdbaBtb' => $noBtb,
            'mdbaBkb' => $noBkb,
            'mdbaSisaBev' => $admSisa,
            'mdbaBsBev' => $admBs
        );
        $distributionIn = $this->mInventori->simpanData($inDistribution, $base . '.mdbaInDistribution');

        $mdbaHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noBtb,
            'szDocBkb' => $noBkb,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan,
            'szVehicleId' => $kendaraan
        );
        $headerMdba = $this->mInventori->simpanData($mdbaHeader, $base . '.mdbaHistoryDistributionIn');

        $dmsHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noBtb,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan,
            'szVehicleId' => $kendaraan
        );
        $headerDms = $this->mInventori->simpanData($dmsHeader, $base . '.dms_inv_docstockindistribution');

        $prod = '';
        // print_r(count($produkKode));
        // echo "<pre>" . var_export($produkKode, true) . "</pre>";

        $prodOld = '';
        for ($i = 0; $i < count($produkKode); $i++) {
            $prodOld .= "'" . $produkKode[$i] . "',";
        }
        $cekLen = strlen($prodOld);
        $prodOld2 = substr($prodOld, 0, $cekLen - 1);

        $prodSatuan = $this->mInventori->getKodeProduk($prodOld2, $stok, $this->session->userdata('user_branch'));
        foreach ($prodSatuan as $value) {
            for ($i = 0; $i < count($produkKode); $i++) {
                if ($produkKode[$i] == $value->szId) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noBtb,
                        'intItemNumber' => $i,
                        'szProductId' => $produkKode[$i],
                        'decQty' => $produkQty[$i],
                        'szUomId' => $value->szUomId
                    );
                    $detailMdba = $this->mInventori->simpanData($detail, $base . '.mdbaHistoryDistributionInItem');
                    $detailDms = $this->mInventori->simpanData($detail, $base . '.dms_inv_docstockindistributionItem');

                    $stockHistoryDrv = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $produkKode[$i],
                        'szLocationType' => 'EMPLOYEE',
                        'szLocationId' => $pengemudi,
                        'szStockTypeId' => 'IN TRANSIT',
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => -$produkQty[$i],
                        'szUomId' => $value->szUomId,
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInDistribution',
                        'szDocId' => $noBtb,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $driverStockHistory = $this->mInventori->simpanData($stockHistoryDrv, $base . '.dms_inv_stockhistory');

                    $stockHistoryGdg = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $produkKode[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $produkQty[$i],
                        'szUomId' => $value->szUomId,
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInDistribution',
                        'szDocId' => $noBtb,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $gudangStockHistory = $this->mInventori->simpanData($stockHistoryGdg, $base . '.dms_inv_stockhistory');
                }
            }
        }

        $stockTypeIdG = "'JUAL'";
        $lokasiIdG = "'$gudang'";
        $sOnHandG = $this->mInventori->stockOnHandDist($prodOld2, $lokasiIdG, $stockTypeIdG);
        if (count($sOnHandG) != 0) {
            foreach ($sOnHandG as $value) {
                for ($i = 0; $i < count($produkKode); $i++) {
                    if ($produkKode[$i] == $value->szProductId) {
                        $updOnHandG = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $produkQty[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandG = array(
                            'szProductId' => $produkKode[$i],
                            'szStockTypeId' => 'WAREHOUSE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'JUAL'
                        );
                    }
                }
            }
        }
        // echo "<pre>" . var_export($updOnHandG, true) . "</pre>";
        // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";
        $onHandUpdateG = $this->mInventori->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');

        $stockTypeIdP = "'IN TRANSIT'";
        $lokasiIdP = "'$pengemudi'";
        $sOnHand = $this->mInventori->stockOnHandDist($prodOld2, $lokasiIdP, $stockTypeIdP);
        if (count($sOnHand) != 0) {
            foreach ($sOnHand as $value) {
                for ($i = 0; $i < count($produkKode); $i++) {
                    if ($produkKode[$i] == $value->szProductId) {
                        $updOnHand = array(
                            'decQtyOnHand' => $value->decQtyOnHand + $produkQty[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHand = array(
                            'szProductId' => $produkKode[$i],
                            'szStockTypeId' => 'EMPLOYEE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'IN TRANSIT'
                        );
                    }
                }
            }
        }
        // echo "<pre>" . var_export($updOnHand, true) . "</pre>";
        // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";
        $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');

        //counter update 
        $countId = 'BTBDIST' . $this->session->userdata('user_branch') . 'COU';
        $counter = $this->mInventori->getCounter($countId);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $countId);
        $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');

        if ($btbRefDoc == 'true' && $distributionIn == 'true' && $headerMdba == 'true' && $headerDms == 'true' && $detailMdba == 'true' && $detailDms == 'true' && $driverStockHistory == 'true' && $gudangStockHistory == 'true' && $onHandUpdateG == 'true' && $counterUpdate == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/btbDistribusi/'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventori/tambahBtbDistribusiSps/' . $noBkb));
            exit;
        }
    }

    public function btbDistribusiHistory()
    {
        $tanggal = date('Y-m-d');
        $data['a'] = $this->mInventori->getListHistoryBtbDist($tanggal);
        $this->load->view('vBtbDistribusiHistory', $data);
    }

    public function btbDistribusiSpsHistory()
    {
        $tanggal = date('Y-m-d');
        $data['a'] = $this->mInventori->getListHistoryBtbDist($tanggal);
        $this->load->view('vBtbDistribusiSpsHistory', $data);
    }

    public function tglHistoryBtbDist()
    {
        $tanggal = $this->input->post('tanggal');
        $data['a'] = $this->mInventori->getListHistoryBtbDist($tanggal);
        $this->load->view('vBtbDistribusiHistory', $data);
    }

    public function editBtbDistribusi($document)
    {
        $depo = $this->session->userdata('user_branch');

        $id = 'BTBDIST' . $depo . 'COU';
        $data['newSupp'] = $this->mInventDepot->getId($id);

        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventDepot->getId($adjustment);

        $data['document'] = $document;
        $data['a'] = $this->mInventori->editBtbDistribusi($document);
        $data['gudang'] = $this->mHome->getGudang();
        $data['stok'] = $this->mHome->getTipeStok();
        $data['pengemudi'] = $this->mHome->getDriverDistribusi($depo);
        $data['kendaraan'] = $this->mHome->getVehicleDistribusi($depo);
        $data['produk'] = $this->mHome->getProduk();

        $this->load->view('vBtbDistribusiEdit', $data);
    }

    public function editBtbDistribusiSps($document)
    {
        $depo = $this->session->userdata('user_branch');

        $newSupp = 'BTBDIST' . $depo . 'COU';
        $data['newSupp'] = $this->mInventori->getId($newSupp);
        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventori->getId($adjustment);
        $data['document'] = $document;
        $data['a'] = $this->mInventori->editBtbDistribusi($document);
        $data['gudang'] = $this->mHome->getGudang();
        $data['stok'] = $this->mHome->getTipeStok();
        $data['pengemudi'] = $this->mHome->getDriverDistribusi($depo);
        $data['kendaraan'] = $this->mHome->getVehicleDistribusi($depo);
        $data['produk'] = $this->mHome->getProduk();

        $this->load->view('vBtbDistribusiSpsEdit', $data);
    }

    public function cetakBtbDistribusi($document)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['document'] = $document;
        $data['load'] = $this->mInventori->getDataCetakBtbDist($document);

        // filename dari pdf ketika didownload
        $file_pdf = 'BTB Distribusi Depo ' . $this->session->userdata('user_lokasi') . ' - ' . $document;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('vBtbDistribusiCetak', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function detailBtbDistribusi()
    {
        $document = $this->input->post('id');
        $data = $this->mInventori->editBtbDistribusi($document);
        echo json_encode($data);
    }

    public function updateBtbDistribusiGln()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $noDoc = $this->input->post('noDoc');
        $noDocOld = $this->input->post('noDocOld');
        $noAdjustment = $this->input->post('noAdjustment');
        $noBkb = $this->input->post('noBkb');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $kendaraan = $this->input->post('kendaraan');
        $pengemudi = $this->input->post('pengemudi');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $keterangan = $this->input->post('keterangan');

        $forStockHistory = $this->mInventori->editBtbDistribusi($noDocOld);
        $prodOld = '';
        foreach ($forStockHistory as $value) {
            $stockHistoryDrvOld = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $value->szProductId,
                'szLocationType' => 'EMPLOYEE',
                'szLocationId' => $value->szEmployeeId,
                'szStockTypeId' => 'IN TRANSIT',
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => -$value->decQty,
                'szUomId' => $value->szUomId,
                'dtmTransaction' => date('Y-m-d'),
                'szTrnId' => 'DMSDocStockInDistribution',
                'szDocId' => $noDocOld,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $driverStockHistoryOld = $this->mInventori->simpanData($stockHistoryDrvOld, $base . '.dms_inv_stockhistory');
            $driverStockHistoryOldDms = $this->mInventDist->simpanDms($stockHistoryDrvOld, 'dms.dms_inv_stockhistory');

            $stockHistoryGdgOld = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $value->szProductId,
                'szLocationType' => 'WAREHOUSE',
                'szLocationId' => $value->szWarehouseId,
                'szStockTypeId' => $value->idStok,
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => -$value->decQty,
                'szUomId' => $value->szUomId,
                'dtmTransaction' => date('Y-m-d'),
                'szTrnId' => 'DMSDocStockInDistribution',
                'szDocId' => $noDocOld,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $gudangStockHistoryOld = $this->mInventori->simpanData($stockHistoryGdgOld, $base . '.dms_inv_stockhistory');
            $gudangStockHistoryOldDms = $this->mInventDist->simpanDist($stockHistoryGdgOld, 'dms.dms_inv_stockhistory');

            $prodOld .= "'" . $value->szProductId . "',";
            $stokOld = $value->szStockType;

            $updDetailSupplier = array(
                'decQty' => -$value->decQty
            );

            $whereDetailSupplier = array(
                'szDocId' => $noDocOld,
                'szProductId' => $value->szProductId
            );

            $detailSupplierUpdateOld = $this->mInventori->updateData($whereDetailSupplier, $updDetailSupplier, $base . '.dms_inv_docstockindistributionitem');
            $detailSupplierUpdateOldDms = $this->mInventDist->updateDms($whereDetailSupplier, $updDetailSupplier, 'dms.dms_inv_docstockindistributionitem');
        }

        $cekLen = strlen($prodOld);
        $prodOld2 = substr($prodOld, 0, $cekLen - 1);

        $stockTypeIdPOld = "'IN TRANSIT'";
        $lokasiIdPOld = "'$pengemudi'";
        $sOnHandOld = $this->mInventori->stockOnHandDist($prodOld2, $lokasiIdPOld, $stockTypeIdPOld);
        if (count($sOnHandOld) != 0) {
            foreach ($sOnHandOld as $value) {
                foreach ($forStockHistory as $key) {
                    if ($key->szProductId == $value->szProductId) {
                        $updOnHandOld = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $key->decQty,
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandOld = array(
                            'szProductId' => $value->szProductId,
                            'szStockTypeId' => 'EMPLOYEE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'IN TRANSIT'
                        );
                    }
                }
                $onHandUpdateOld = $this->mInventori->updateData($whereOnHandOld, $updOnHandOld, $base . '.dms_inv_stockonhand');
                $onHandUpdateOldDms = $this->mInventDist->updateDms($whereOnHandOld, $updOnHandOld, 'dms.dms_inv_stockonhand');
            }
        }

        $stockTypeIdGOld = "'JUAL'";
        $lokasiIdGOld = "'$gudang'";
        $sOnHandGOld = $this->mInventori->stockOnHandDist($prodOld2, $lokasiIdGOld, $stockTypeIdGOld);
        if (count($sOnHandGOld) != 0) {
            foreach ($sOnHandGOld as $value) {
                foreach ($forStockHistory as $key) {
                    if ($key->szProductId == $value->szProductId) {
                        $updOnHandGOld = array(
                            'decQtyOnHand' => $value->decQtyOnHand + $key->decQty,
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandGOld = array(
                            'szProductId' => $value->szProductId,
                            'szStockTypeId' => 'WAREHOUSE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'JUAL'
                        );
                    }
                }
                $onHandUpdateGOld = $this->mInventori->updateData($whereOnHandGOld, $updOnHandGOld, $base . '.dms_inv_stockonhand');
                $onHandUpdateGOldDms = $this->mInventDist->updateDms($whereOnHandGOld, $updOnHandGOld, 'dms.dms_inv_stockonhand');
            }
        }
        // echo "<pre>" . var_export($updOnHandG, true) . "</pre>";
        // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";


        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $refDocBtb = array(
            'refId' => $noDoc,
            'refOld' => $noBkb,
            'refTanggal' => date('Y-m-d'),
            'refDepo' => $this->session->userdata('user_branch'),
            'refDocType' => 'DMSDocStockInDistribution',
            'refUserAdd' => $this->session->userdata('user_nik'),
            'refUserUpdate' => $this->session->userdata('user_nik'),
            'refDateAdd' => date('Y-m-d H:i:s'),
            'refDateUpdate' => date('Y-m-d H:i:s')
        );
        $btbRefDoc = $this->mInventori->simpanData($refDocBtb, $base . '.mdbaRefDoc');

        $mdbaHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noDoc,
            'szDocBkb' => $noBkb,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan,
            'szVehicleId' => $kendaraan
        );
        $headerMdba = $this->mInventori->simpanData($mdbaHeader, $base . '.mdbaHistoryDistributionIn');

        $dmsHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noDoc,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan,
            'szVehicleId' => $kendaraan
        );
        $headerDms = $this->mInventori->simpanData($dmsHeader, $base . '.dms_inv_docstockindistribution');
        $headerDmss = $this->mInventDist->simpanDms($dmsHeader, 'dms.dms_inv_docstockindistribution');

        $adjRefDoc = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noAdjustment,
            'szRefDocId' => $noDoc,
            'szRefDocTypeId' => 'DMSDocStockInDistribution',
            'szAdjustmentId' => $noDocOld
        );
        $refDocAdj = $this->mInventori->simpanData($adjRefDoc, $base . '.dms_inv_stockadjustmentrefdoc');
        $refDocAdjDms = $this->mInventDist->simpanDms($adjRefDoc, 'dms.dms_inv_stockadjustmentrefdoc');

        $adjustmentHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noAdjustment,
            'dtmDoc' => $tgl,
            'szRefTypeDoc' => 'DMSDocStockInDistribution',
            'szRefDocId' => $noDoc,
            'szDescription' => $keterangan,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:S')
        );
        $headAdj = $this->mInventori->simpanData($adjustmentHeader, $base . '.dms_inv_docstockadjustment');
        $headAdjDms = $this->mInventDist->simpanDms($adjustmentHeader, 'dms.dms_inv_docstockadjustment');

        $prodNew = '';
        for ($i = 0; $i <= count($produk); $i++) {
            $prodNew .= "'" . $produk[$i] . "',";
        }

        $cekLenNew = strlen($prodNew);
        $prodNew2 = substr($prodNew, 0, $cekLenNew - 1);
        $stockNew = $this->mInventori->getKodeProduk($prodNew2, $stok, $this->session->userdata('user_branch'));
        foreach ($stockNew as $value) {
            for ($i = 0; $i <= count($produk); $i++) {
                if ($value->szId == $produk[$i]) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noDoc,
                        'intItemNumber' => $i + 1,
                        'szProductId' => $value->szId,
                        'decQty' => $qty[$i],
                        'szUomId' => $value->szUomId
                    );
                    // echo "<pre>" . var_export($detail, true) . "</pre>";
                    $detailDms = $this->mInventori->simpanData($detail, $base . '.dms_inv_docstockindistributionItem');
                    $detailDmss = $this->mInventDist->simpanDms($detail, 'dms.dms_inv_docstockindistributionItem');

                    $detAdjustment = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noAdjustment,
                        'intItemNumber' => $i + 1,
                        'szProductId' => $value->szId,
                        'decQty' => $qty[$i],
                        'szUomId' => $value->szUomId
                    );
                    $detAdjustment = $this->mInventori->simpanData($detAdjustment, $base . '.dms_inv_docstockadjustmentitem');
                    $detAdjustmentDms = $this->mInventDist->simpanDms($detAdjustment, 'dms.dms_inv_docstockadjustmentitem');

                    $stockHistoryDrv = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $value->szId,
                        'szLocationType' => 'EMPLOYEE',
                        'szLocationId' => $pengemudi,
                        'szStockTypeId' => 'IN TRANSIT',
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => -$qty[$i],
                        'szUomId' => $value->szUomId,
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInDistribution',
                        'szDocId' => $noDoc,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $driverStockHistory = $this->mInventori->simpanData($stockHistoryDrv, $base . '.dms_inv_stockhistory');
                    $driverStockHistoryDms = $this->mInventDist->simpanDms($stockHistoryDrv, 'dms.dms_inv_stockhistory');

                    $stockHistoryGdg = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $value->szId,
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $qty[$i],
                        'szUomId' => $value->szUomId,
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInDistribution',
                        'szDocId' => $noDoc,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $gudangStockHistory = $this->mInventori->simpanData($stockHistoryGdg, $base . '.dms_inv_stockhistory');
                    $gudangStockHistoryDist = $this->mInventDist->simpanDms($stockHistoryGdg, 'dms.dms_inv_stockhistory');
                    // echo "<pre>".var_export($updOnHand, true)."</pre>";
                }
            }
        }

        $countId = 'BTBDIST' . $this->session->userdata('user_branch') . 'COU';
        $counter = $this->mInventori->getCounter($countId);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $countId);
        $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
        $counterUpdateDist = $this->mInventDist->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        $adjustment = 'ADJ' . $this->session->userdata('user_branch') . 'COU';
        $counterAdj = $this->mInventori->getCounter($adjustment);
        $newCountAdj = $counterAdj + 1;
        $updateCountAdj = array('intLastCounter' => $newCountAdj);
        $whereCountAdj = array('szId' => $adjustment);
        $counterUpdateAdj = $this->mInventori->updateData($whereCountAdj, $updateCountAdj, $base . '.dms_sm_counter');
        $counterUpdateAdjDms = $this->mInventDist->updateDms($whereCountAdj, $updateCountAdj, 'dms.dms_sm_counter');

        $stockTypeIdP = "'IN TRANSIT'";
        $lokasiIdP = "'$pengemudi'";
        $sOnHand = $this->mInventori->stockOnHandDist($prodNew2, $lokasiIdP, $stockTypeIdP);
        if (count($sOnHand) != 0) {
            foreach ($sOnHand as $value) {
                for ($i = 0; $i <= count($produk); $i++) {
                    if ($value->szProductId == $produk[$i]) {
                        $updOnHand = array(
                            'decQtyOnHand' => $value->decQtyOnHand + $qty[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHand = array(
                            'szProductId' => $produk[$i],
                            'szStockTypeId' => 'EMPLOYEE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'IN TRANSIT'
                        );
                    }
                }
                $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                $onHandUpdateDms = $this->mInventDist->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');
            }
        }

        $stockTypeIdG = "'JUAL'";
        $lokasiIdG = "'$gudang'";
        $sOnHandG = $this->mInventori->stockOnHandDist($prodNew2, $lokasiIdG, $stockTypeIdG);
        if (count($sOnHandG) != 0) {
            foreach ($sOnHandG as $value) {
                for ($i = 0; $i <= count($produk); $i++) {
                    if ($value->szProductId == $produk[$i]) {
                        $updOnHandG = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $produk[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandG = array(
                            'szProductId' => $produk[$i],
                            'szStockTypeId' => 'WAREHOUSE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'JUAL'
                        );
                    }
                }
                $onHandUpdateG = $this->mInventori->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
                $onHandUpdateGDms = $this->mInventDist->updateDms($whereOnHandG, $updOnHandG, 'dms.dms_inv_stockonhand');
            }
        }
        // echo "<pre>" . var_export($updOnHandG, true) . "</pre>";
        // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";



        if ($driverStockHistoryOld == 'true' && $gudangStockHistoryOld == 'true' && $onHandUpdateOld == 'true' && $onHandUpdateGOld == 'true' && $btbRefDoc == 'true' && $refDocAdj == 'true' && $headerMdba == 'true' && $headerDms == 'true' && $headAdj == 'true' && $detailDms == 'true' && $detAdjustment == 'true' && $driverStockHistory == 'true' && $gudangStockHistory == 'true' && $onHandUpdate == 'true' && $onHandUpdateG == 'true' && $counterUpdate == 'true' && $counterUpdateAdj == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/btbDistribusi/'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventori/editBtbDistribusi/' . $noDocOld));
            exit;
        }
    }

    public function updateBkbDistribusiGln()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $noDoc = $this->input->post('noDoc');
        $noDocOld = $this->input->post('noDocOld');
        $noAdjustment = $this->input->post('noAdjustment');
        $noBkb = $this->input->post('noBkb');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $kendaraan = $this->input->post('kendaraan');
        $pengemudi = $this->input->post('pengemudi');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $keterangan = $this->input->post('keterangan');

        $forStockHistory = $this->mInventDist->editBkb($noDocOld);
        $prodOld = '';
        foreach ($forStockHistory as $value) {
            $stockHistoryDrvOld = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $value->szProductId,
                'szLocationType' => 'EMPLOYEE',
                'szLocationId' => $value->szEmployeeId,
                'szStockTypeId' => 'IN TRANSIT',
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => -$value->decQty,
                'szUomId' => $value->szUomId,
                'dtmTransaction' => date('Y-m-d'),
                'szTrnId' => 'DMSDocStockOutDistribution',
                'szDocId' => $noDocOld,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $driverStockHistoryOld = $this->mInventDepot->simpanData($stockHistoryDrvOld, $base . '.dms_inv_stockhistory');
            $driverStockHistoryOldDms = $this->mInventDepot->simpanDms($stockHistoryDrvOld, 'dms.dms_inv_stockhistory');
            // 
            $stockHistoryGdgOld = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $value->szProductId,
                'szLocationType' => 'WAREHOUSE',
                'szLocationId' => $value->szWarehouseId,
                'szStockTypeId' => $value->idStok,
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => -$value->decQty,
                'szUomId' => $value->szUomId,
                'dtmTransaction' => date('Y-m-d'),
                'szTrnId' => 'DMSDocStockInDistribution',
                'szDocId' => $noDocOld,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $gudangStockHistoryOld = $this->mInventDepot->simpanData($stockHistoryGdgOld, $base . '.dms_inv_stockhistory');
            $gudangStockHistoryOldDms = $this->mInventDepot->simpanDms($stockHistoryGdgOld, 'dms.dms_inv_stockhistory');

            $prodOld .= "'" . $value->szProductId . "',";
            $stokOld = $value->szStockType;

            $updDetailSupplier = array(
                'decQty' => -$value->decQty
            );

            $whereDetailSupplier = array(
                'szDocId' => $noDocOld,
                'szProductId' => $value->szProductId
            );

            $detailSupplierUpdateOld = $this->mInventDepot->updateData($whereDetailSupplier, $updDetailSupplier, $base . '.dms_inv_docstockoutdistributionitem');
            $detailSupplierUpdateOldDms = $this->mInventDepot->updateDms($whereDetailSupplier, $updDetailSupplier, 'dms.dms_inv_docstockoutdistributionitem');
        }

        $cekLen = strlen($prodOld);
        $prodOld2 = substr($prodOld, 0, $cekLen - 1);

        $stockTypeIdPOld = "'IN TRANSIT'";
        $lokasiIdPOld = "'$pengemudi'";
        $sOnHandOld = $this->mInventori->stockOnHandDist($prodOld2, $lokasiIdPOld, $stockTypeIdPOld);
        if (count($sOnHandOld) != 0) {
            foreach ($sOnHandOld as $value) {
                foreach ($forStockHistory as $key) {
                    if ($key->szProductId == $value->szProductId) {
                        $updOnHandOld = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $key->decQty,
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandOld = array(
                            'szProductId' => $value->szProductId,
                            'szStockTypeId' => 'EMPLOYEE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'IN TRANSIT'
                        );
                    }
                }
                $onHandUpdateOld = $this->mInventDepot->updateData($whereOnHandOld, $updOnHandOld, $base . '.dms_inv_stockonhand');
                $onHandUpdateOldDms = $this->mInventDepot->updateDms($whereOnHandOld, $updOnHandOld, 'dms.dms_inv_stockonhand');
            }
        }

        $stockTypeIdGOld = "'JUAL'";
        $lokasiIdGOld = "'$gudang'";
        $sOnHandGOld = $this->mInventori->stockOnHandDist($prodOld2, $lokasiIdGOld, $stockTypeIdGOld);
        if (count($sOnHandGOld) != 0) {
            foreach ($sOnHandGOld as $value) {
                foreach ($forStockHistory as $key) {
                    if ($key->szProductId == $value->szProductId) {
                        $updOnHandGOld = array(
                            'decQtyOnHand' => $value->decQtyOnHand + $key->decQty,
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandGOld = array(
                            'szProductId' => $value->szProductId,
                            'szStockTypeId' => 'WAREHOUSE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'JUAL'
                        );
                    }
                }
                $onHandUpdateGOld = $this->mInventDepot->updateData($whereOnHandGOld, $updOnHandGOld, $base . '.dms_inv_stockonhand');
                $onHandUpdateGOldDms = $this->mInventDepot->updateDms($whereOnHandGOld, $updOnHandGOld, 'dms.dms_inv_stockonhand');
            }
        }
        // echo "<pre>" . var_export($updOnHandG, true) . "</pre>";
        // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";


        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $refDocBtb = array(
            'refId' => $noDoc,
            'refOld' => $noBkb,
            'refTanggal' => date('Y-m-d'),
            'refDepo' => $this->session->userdata('user_branch'),
            'refDocType' => 'DMSDocStockOutDistribution',
            'refUserAdd' => $this->session->userdata('user_nik'),
            'refUserUpdate' => $this->session->userdata('user_nik'),
            'refDateAdd' => date('Y-m-d H:i:s'),
            'refDateUpdate' => date('Y-m-d H:i:s')
        );
        $btbRefDoc = $this->mInventDepot->simpanData($refDocBtb, $base . '.mdbaRefDoc');
        // $btbRefDocDms = $this->mInventDepot->simpanDms($refDocBtb, 'dms.mdbaRefDoc');

        $mdbaHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noDoc,
            'szDocBkb' => $noBkb,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan,
            'szVehicleId' => $kendaraan
        );
        $headerMdba = $this->mInventDepot->simpanData($mdbaHeader, $base . '.mdbaHistoryDistributionIn');
        // $headerMdbaDms = $this->mInventDepot->simpanDms($mdbaHeader, 'dms.mdbaHistoryDistributionIn');

        $dmsHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noDoc,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan,
            'szVehicleId' => $kendaraan
        );
        $headerDms = $this->mInventDepot->simpanData($dmsHeader, $base . '.dms_inv_docstockoutdistribution');
        $headerDmss = $this->mInventDepot->simpanDms($dmsHeader, 'dms.dms_inv_docstockoutdistribution');

        $adjRefDoc = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noAdjustment,
            'szRefDocId' => $noDoc,
            'szRefDocTypeId' => 'DMSDocStockOutDistribution',
            'szAdjustmentId' => $noDocOld
        );
        $refDocAdj = $this->mInventDepot->simpanData($adjRefDoc, $base . '.dms_inv_stockadjustmentrefdoc');
        $refDocAdjDms = $this->mInventDepot->simpanDms($adjRefDoc, 'dms.dms_inv_stockadjustmentrefdoc');

        $adjustmentHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noAdjustment,
            'dtmDoc' => $tgl,
            'szRefTypeDoc' => 'DMSDocStockOutDistribution',
            'szRefDocId' => $noDoc,
            'szDescription' => $keterangan,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:S')
        );
        $headAdj = $this->mInventDepot->simpanData($adjustmentHeader, $base . '.dms_inv_docstockadjustment');
        $headAdjDms = $this->mInventDepot->simpanDms($adjustmentHeader, 'dms.dms_inv_docstockadjustment');

        $prodNew = '';
        for ($i = 0; $i <= count($produk); $i++) {
            $prodNew .= "'" . $produk[$i] . "',";
        }

        $cekLenNew = strlen($prodNew);
        $prodNew2 = substr($prodNew, 0, $cekLenNew - 1);
        $stockNew = $this->mInventori->getKodeProduk($prodNew2, $stok, $this->session->userdata('user_branch'));
        foreach ($stockNew as $value) {
            for ($i = 0; $i <= count($produk); $i++) {
                if ($value->szId == $produk[$i]) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noDoc,
                        'intItemNumber' => $i + 1,
                        'szProductId' => $value->szId,
                        'decQty' => $qty[$i],
                        'szUomId' => $value->szUomId
                    );
                    // echo "<pre>" . var_export($detail, true) . "</pre>";
                    $detailDms = $this->mInventDepot->simpanData($detail, $base . '.dms_inv_docstockoutdistributionItem');
                    $detailDmss = $this->mInventDepot->simpanDms($detail, 'dms.dms_inv_docstockoutdistributionItem');

                    $detAdjustment = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noAdjustment,
                        'intItemNumber' => $i + 1,
                        'szProductId' => $value->szId,
                        'decQty' => $qty[$i],
                        'szUomId' => $value->szUomId
                    );
                    $detAdjustment = $this->mInventDepot->simpanData($detAdjustment, $base . '.dms_inv_docstockadjustmentitem');
                    $detAdjustmentDms = $this->mInventDepot->simpanDms($detAdjustment, 'dms.dms_inv_docstockadjustmentitem');

                    $stockHistoryDrv = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $value->szId,
                        'szLocationType' => 'EMPLOYEE',
                        'szLocationId' => $pengemudi,
                        'szStockTypeId' => 'IN TRANSIT',
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => -$qty[$i],
                        'szUomId' => $value->szUomId,
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockOutDistribution',
                        'szDocId' => $noDoc,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $driverStockHistory = $this->mInventDepot->simpanData($stockHistoryDrv, $base . '.dms_inv_stockhistory');
                    $driverStockHistoryDms = $this->mInventDepot->simpanDms($stockHistoryDrv, 'dms.dms_inv_stockhistory');

                    $stockHistoryGdg = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $value->szId,
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $qty[$i],
                        'szUomId' => $value->szUomId,
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockOutDistribution',
                        'szDocId' => $noDoc,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $gudangStockHistory = $this->mInventDepot->simpanData($stockHistoryGdg, $base . '.dms_inv_stockhistory');
                    $gudangStockHistoryDms = $this->mInventDepot->simpanDms($stockHistoryGdg, 'dms.dms_inv_stockhistory');
                    // echo "<pre>".var_export($updOnHand, true)."</pre>";
                }
            }
        }

        $countId = 'BTBDIST' . $this->session->userdata('user_branch') . 'COU';
        $counter = $this->mInventori->getCounter($countId);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $countId);
        $counterUpdate = $this->mInventDepot->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
        $counterUpdateDms = $this->mInventDepot->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        $adjustment = 'ADJ' . $this->session->userdata('user_branch') . 'COU';
        $counterAdj = $this->mInventori->getCounter($adjustment);
        $newCountAdj = $counterAdj + 1;
        $updateCountAdj = array('intLastCounter' => $newCountAdj);
        $whereCountAdj = array('szId' => $adjustment);
        $counterUpdateAdj = $this->mInventDepot->updateData($whereCountAdj, $updateCountAdj, $base . '.dms_sm_counter');
        $counterUpdateAdjDms = $this->mInventDepot->updateDms($whereCountAdj, $updateCountAdj, 'dms.dms_sm_counter');

        $stockTypeIdP = "'IN TRANSIT'";
        $lokasiIdP = "'$pengemudi'";
        $sOnHand = $this->mInventori->stockOnHandDist($prodNew2, $lokasiIdP, $stockTypeIdP);
        if (count($sOnHand) != 0) {
            foreach ($sOnHand as $value) {
                for ($i = 0; $i <= count($produk); $i++) {
                    if ($value->szProductId == $produk[$i]) {
                        $updOnHand = array(
                            'decQtyOnHand' => $value->decQtyOnHand + $qty[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHand = array(
                            'szProductId' => $produk[$i],
                            'szStockTypeId' => 'EMPLOYEE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'IN TRANSIT'
                        );
                    }
                }
                $onHandUpdate = $this->mInventDepot->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                $onHandUpdateDms = $this->mInventDepot->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');
            }
        }

        $stockTypeIdG = "'JUAL'";
        $lokasiIdG = "'$gudang'";
        $sOnHandG = $this->mInventori->stockOnHandDist($prodNew2, $lokasiIdG, $stockTypeIdG);
        if (count($sOnHandG) != 0) {
            foreach ($sOnHandG as $value) {
                for ($i = 0; $i <= count($produk); $i++) {
                    if ($value->szProductId == $produk[$i]) {
                        $updOnHandG = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $produk[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandG = array(
                            'szProductId' => $produk[$i],
                            'szStockTypeId' => 'WAREHOUSE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'JUAL'
                        );
                    }
                }
                $onHandUpdateG = $this->mInventDepot->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
                $onHandUpdateGDms = $this->mInventDepot->updateDms($whereOnHandG, $updOnHandG, 'dms.dms_inv_stockonhand');
            }
        }
        // echo "<pre>" . var_export($updOnHandG, true) . "</pre>";
        // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";



        if ($driverStockHistoryOld == 'true' && $gudangStockHistoryOld == 'true' && $onHandUpdateOld == 'true' && $onHandUpdateGOld == 'true' && $btbRefDoc == 'true' && $refDocAdj == 'true' && $headerMdba == 'true' && $headerDms == 'true' && $headAdj == 'true' && $detailDms == 'true' && $detAdjustment == 'true' && $driverStockHistory == 'true' && $gudangStockHistory == 'true' && $onHandUpdate == 'true' && $onHandUpdateG == 'true' && $counterUpdate == 'true' && $counterUpdateAdj == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/bkbDistribusi/'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventDist/editBkb/' . $noDocOld));
            exit;
        }
    }

    public function updateBtbDistribusiSps()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $noDoc = $this->input->post('noDoc');
        $noDocOld = $this->input->post('noDocOld');
        $noAdjustment = $this->input->post('noAdjustment');
        $noBkb = $this->input->post('noBkb');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $kendaraan = $this->input->post('kendaraan');
        $pengemudi = $this->input->post('pengemudi');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $keterangan = $this->input->post('keterangan');

        // print_r($produk);

        $forStockHistory = $this->mInventori->editBtbDistribusi($noDocOld);
        $prodOld = '';
        foreach ($forStockHistory as $value) {
            $stockHistoryDrvOld = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $value->szProductId,
                'szLocationType' => 'EMPLOYEE',
                'szLocationId' => $value->szEmployeeId,
                'szStockTypeId' => 'IN TRANSIT',
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => -$value->decQty,
                'szUomId' => $value->szUomId,
                'dtmTransaction' => date('Y-m-d'),
                'szTrnId' => 'DMSDocStockInDistribution',
                'szDocId' => $noDocOld,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $driverStockHistoryOld = $this->mInventori->simpanData($stockHistoryDrvOld, $base . '.dms_inv_stockhistory');

            $stockHistoryGdgOld = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $value->szProductId,
                'szLocationType' => 'WAREHOUSE',
                'szLocationId' => $value->szWarehouseId,
                'szStockTypeId' => $value->idStok,
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => -$value->decQty,
                'szUomId' => $value->szUomId,
                'dtmTransaction' => date('Y-m-d'),
                'szTrnId' => 'DMSDocStockInDistribution',
                'szDocId' => $noDocOld,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $gudangStockHistoryOld = $this->mInventori->simpanData($stockHistoryGdgOld, $base . '.dms_inv_stockhistory');

            $prodOld .= "'" . $value->szProductId . "',";
            $stokOld = $value->szStockType;

            $updDetailSupplier = array(
                'decQty' => -$value->decQty
            );

            $whereDetailSupplier = array(
                'szDocId' => $noDocOld,
                'szProductId' => $value->szProductId
            );

            $detailSupplierUpdateOld = $this->mInventori->updateData($whereDetailSupplier, $updDetailSupplier, $base . '.dms_inv_docstockinsupplieritem');
        }

        $cekLen = strlen($prodOld);
        $prodOld2 = substr($prodOld, 0, $cekLen - 1);

        $stockTypeIdPOld = "'IN TRANSIT'";
        $lokasiIdPOld = "'$pengemudi'";
        $sOnHandOld = $this->mInventori->stockOnHandDist($prodOld2, $lokasiIdPOld, $stockTypeIdPOld);
        if (count($sOnHandOld) != 0) {
            foreach ($sOnHandOld as $value) {
                foreach ($forStockHistory as $key) {
                    if ($key->szProductId == $value->szProductId) {
                        $updOnHandOld = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $key->decQty,
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandOld = array(
                            'szProductId' => $value->szProductId,
                            'szStockTypeId' => 'EMPLOYEE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'IN TRANSIT'
                        );
                    }
                }
                $onHandUpdateOld = $this->mInventori->updateData($whereOnHandOld, $updOnHandOld, $base . '.dms_inv_stockonhand');
            }
        }

        $stockTypeIdGOld = "'JUAL'";
        $lokasiIdGOld = "'$gudang'";
        $sOnHandGOld = $this->mInventori->stockOnHandDist($prodOld2, $lokasiIdGOld, $stockTypeIdGOld);
        foreach ($sOnHandGOld as $value) {
            foreach ($forStockHistory as $key) {
                if ($key->szProductId == $value->szProductId) {
                    $updOnHandGOld = array(
                        'decQtyOnHand' => $value->decQtyOnHand + $key->decQty,
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $whereOnHandGOld = array(
                        'szProductId' => $value->szProductId,
                        'szStockTypeId' => 'WAREHOUSE',
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'szLocationType' => 'JUAL'
                    );
                }
            }
            $onHandUpdateGOld = $this->mInventori->updateData($whereOnHandGOld, $updOnHandGOld, $base . '.dms_inv_stockonhand');
        }
        // echo "<pre>" . var_export($updOnHandG, true) . "</pre>";
        // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";


        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $refDocBtb = array(
            'refId' => $noDoc,
            'refOld' => $noBkb,
            'refTanggal' => date('Y-m-d'),
            'refDepo' => $this->session->userdata('user_branch'),
            'refDocType' => 'DMSDocStockInDistribution',
            'refUserAdd' => $this->session->userdata('user_nik'),
            'refUserUpdate' => $this->session->userdata('user_nik'),
            'refDateAdd' => date('Y-m-d H:i:s'),
            'refDateUpdate' => date('Y-m-d H:i:s')
        );
        $btbRefDoc = $this->mInventori->simpanData($refDocBtb, $base . '.mdbaRefDoc');

        $mdbaHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noDoc,
            'szDocBkb' => $noBkb,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan,
            'szVehicleId' => $kendaraan
        );
        $headerMdba = $this->mInventori->simpanData($mdbaHeader, $base . '.mdbaHistoryDistributionIn');

        $dmsHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noDoc,
            'dtmDoc' => $tgl,
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan,
            'szVehicleId' => $kendaraan
        );
        $headerDms = $this->mInventori->simpanData($dmsHeader, $base . '.dms_inv_docstockindistribution');

        $adjRefDoc = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noAdjustment,
            'szRefDocId' => $noDoc,
            'szRefDocTypeId' => 'DMSDocStockInDistribution',
            'szAdjustmentId' => $noDocOld
        );
        $refDocAdj = $this->mInventori->simpanData($adjRefDoc, $base . '.dms_inv_stockadjustmentrefdoc');

        $adjustmentHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noAdjustment,
            'dtmDoc' => $tgl,
            'szRefTypeDoc' => 'DMSDocStockInDistribution',
            'szRefDocId' => $noDoc,
            'szDescription' => $keterangan,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:S')
        );
        $headAdj = $this->mInventori->simpanData($adjustmentHeader, $base . '.dms_inv_docstockadjustment');

        $prodNew = '';
        for ($i = 0; $i <= count($produk); $i++) {
            $prodNew .= "'" . $produk[$i] . "',";
        }

        $cekLenNew = strlen($prodNew);
        $prodNew2 = substr($prodNew, 0, $cekLenNew - 1);
        $stockNew = $this->mInventori->getKodeProduk($prodNew2, $stok, $this->session->userdata('user_branch'));
        foreach ($stockNew as $value) {
            for ($i = 0; $i <= count($produk); $i++) {
                if ($value->szId == $produk[$i]) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noDoc,
                        'intItemNumber' => $i + 1,
                        'szProductId' => $value->szId,
                        'decQty' => $qty[$i],
                        'szUomId' => $value->szUomId
                    );
                    // echo "<pre>" . var_export($detail, true) . "</pre>";
                    $detailMdba = $this->mInventori->simpanData($detail, $base . '.mdbaHistoryDistributionInItem');
                    $detailDms = $this->mInventori->simpanData($detail, $base . '.dms_inv_docstockindistributionItem');

                    $detAdjustment = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noAdjustment,
                        'intItemNumber' => $i + 1,
                        'szProductId' => $value->szId,
                        'decQty' => $qty[$i],
                        'szUomId' => $value->szUomId
                    );
                    $detAdjustment = $this->mInventori->simpanData($detAdjustment, $base . '.dms_inv_docstockadjustmentitem');

                    $stockHistoryDrv = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $value->szId,
                        'szLocationType' => 'EMPLOYEE',
                        'szLocationId' => $pengemudi,
                        'szStockTypeId' => 'IN TRANSIT',
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => -$qty[$i],
                        'szUomId' => $value->szUomId,
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInDistribution',
                        'szDocId' => $noDoc,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $driverStockHistory = $this->mInventori->simpanData($stockHistoryDrv, $base . '.dms_inv_stockhistory');

                    $stockHistoryGdg = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $value->szId,
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $qty[$i],
                        'szUomId' => $value->szUomId,
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInDistribution',
                        'szDocId' => $noDoc,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $gudangStockHistory = $this->mInventori->simpanData($stockHistoryGdg, $base . '.dms_inv_stockhistory');
                    // echo "<pre>".var_export($updOnHand, true)."</pre>";
                }
            }
        }

        $countId = 'BTBDIST' . $this->session->userdata('user_branch') . 'COU';
        $counter = $this->mInventori->getCounter($countId);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $countId);
        $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');

        $adjustment = 'ADJ' . $this->session->userdata('user_branch') . 'COU';
        $counterAdj = $this->mInventori->getCounter($adjustment);
        $newCountAdj = $counterAdj + 1;
        $updateCountAdj = array('intLastCounter' => $newCountAdj);
        $whereCountAdj = array('szId' => $adjustment);
        $counterUpdateAdj = $this->mInventori->updateData($whereCountAdj, $updateCountAdj, $base . '.dms_sm_counter');

        $stockTypeIdP = "'IN TRANSIT'";
        $lokasiIdP = "'$pengemudi'";
        $sOnHand = $this->mInventori->stockOnHandDist($prodNew2, $lokasiIdP, $stockTypeIdP);
        if (count($sOnHand) != 0) {
            foreach ($sOnHand as $value) {
                for ($i = 0; $i <= count($produk); $i++) {
                    if ($value->szProductId == $produk[$i]) {
                        $updOnHand = array(
                            'decQtyOnHand' => $value->decQtyOnHand + $qty[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHand = array(
                            'szProductId' => $produk[$i],
                            'szStockTypeId' => 'EMPLOYEE',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'IN TRANSIT'
                        );
                    }
                }
                $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
            }
        }

        $stockTypeIdG = "'JUAL'";
        $lokasiIdG = "'$gudang'";
        $sOnHandG = $this->mInventori->stockOnHandDist($prodNew2, $lokasiIdG, $stockTypeIdG);
        foreach ($sOnHandG as $value) {
            for ($i = 0; $i <= count($produk); $i++) {
                if ($value->szProductId == $produk[$i]) {
                    $updOnHandG = array(
                        'decQtyOnHand' => $value->decQtyOnHand - $produk[$i],
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $whereOnHandG = array(
                        'szProductId' => $produk[$i],
                        'szStockTypeId' => 'WAREHOUSE',
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'szLocationType' => 'JUAL'
                    );
                }
            }
            $onHandUpdateG = $this->mInventori->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
        }
        // echo "<pre>" . var_export($updOnHandG, true) . "</pre>";
        // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";



        if ($driverStockHistoryOld == 'true' && $gudangStockHistoryOld == 'true' && $onHandUpdateOld == 'true' && $onHandUpdateGOld == 'true' && $btbRefDoc == 'true' && $refDocAdj == 'true' && $headerMdba == 'true' && $headerDms == 'true' && $headAdj == 'true' && $detailDms == 'true' && $detAdjustment == 'true' && $driverStockHistory == 'true' && $gudangStockHistory == 'true' && $onHandUpdate == 'true' && $onHandUpdateG == 'true' && $counterUpdate == 'true' && $counterUpdateAdj == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/btbDistribusi/'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventori/editBtbDistribusi/' . $noDocOld));
            exit;
        }
    }

    //morphing
    function tambahMorphing($document)
    {
        $depo = $this->session->userdata('user_branch');
        $data['data'] = $this->mInventori->getDetMorphing($document);
        $data['gudang'] = $this->mHome->getGudang();
        $data['stok'] = $this->mHome->getTipeStok();
        $data['produk'] = $this->mHome->getProduk();
        $data['status'] = 'Draft';
        $id = 'SM' . $depo . 'COU';
        $data['id'] = $this->mInventori->getId($id);
        $this->load->view('vMorphingTambah', $data);
    }

    function simpanMorphing()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $noDoc = $this->input->post('noDoc');
        $noRef = $this->input->post('noRef');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $produkTo = $this->input->post('produkTo');
        $qtyTo = $this->input->post('qtyTo');
        $keterangan = $this->input->post('keterangan');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'ASA';
        } else {
            $namedept = 'TVIP';
        }

        $refDoc = array(
            'refId' => $noDoc,
            'refOld' => $noRef,
            'refTanggal' => $tgl,
            'refDepo' => $this->session->userdata('user_branch'),
            'refDocType' => 'DMSDocStockMorph',
            'refUserAdd' => $this->session->userdata('user_nik'),
            'refUserUpdate' => $this->session->userdata('user_nik'),
            'refDateAdd' => date('Y-m-d H:i:s'),
            'refDateUpdate' => date('Y-m-d H:i:s')
        );
        $referensi = $this->mInventori->simpanData($refDoc, $base . '.mdbaRefDoc');

        $morphing = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noDoc,
            'dtmDoc' => $tgl,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $namedept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan
        );
        $dataMorphing = $this->mInventori->simpanData($morphing, $base . '.dms_inv_docstockmorph');
        $dataMorphingDms = $this->mInventDepot->simpanDms($morphing, 'dms.dms_inv_docstockmorph');

        $morphProd = '';
        for ($i = 0; $i < count($produk); $i++) {
            $morphProd .= "'" . $produk[$i] . "',";
        }
        $cekLen = strlen($morphProd);
        $prodMorph = substr($morphProd, 0, $cekLen - 1);

        $morphProdTo = '';
        for ($i = 0; $i < count($produkTo); $i++) {
            $morphProdTo .= "'" . $produkTo[$i] . "',";
        }
        $cekLenTo = strlen($morphProdTo);
        $prodMorphTo = substr($morphProdTo, 0, $cekLenTo - 1);

        $fixProd = $prodMorph . ',' . $prodMorphTo;
        $onHand = $this->mInventori->getKodeProduk($fixProd, $stok, $this->session->userdata('user_branch'));
        // echo "<pre>" . var_export($onHand, true) . "</pre>";
        if (count($onHand) != 0) {
            foreach ($onHand as $value) {
                for ($i = 0; $i < count($produk); $i++) {
                    if ($value->szId == $produk[$i]) {
                        $history = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $produk[$i],
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => -$qty[$i],
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tgl,
                            'szTrnId' => 'DMSDocStockMorph',
                            'szDocId' => $noDoc,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        // echo "<pre>" . var_export($history, true) . "</pre>";
                        $realHistory = $this->mInventori->simpanData($history, $base . '.dms_inv_stockhistory');
                        $realHistoryDms = $this->mInventDepot->simpanDms($history, 'dms.dms_inv_stockhistory');

                        $updOnHand = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $qty[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHand = array(
                            'szProductId' => $produk[$i],
                            'szStockTypeId' => 'JUAL',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'WAREHOUSE'
                        );
                        $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $onHandUpdateDms = $this->mInventDepot->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');

                        $detail = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $noDoc,
                            'intItemNumber' => $i,
                            'szProductId' => $produk[$i],
                            'decQty' => $qty[$i],
                            'szUomId' => $value->szUomId,
                            'szProductIdTo' => $produkTo[$i],
                            'decQtyTo' => $qtyTo[$i],
                            'szUomIdTo' => $value->szUomId
                        );
                        // echo "<pre>" . var_export($detail, true) . "</pre>";
                        $detMorphing = $this->mInventori->simpanData($detail, $base . '.dms_inv_docstockmorphitem');
                        $detMorphingDms = $this->mInventDepot->simpanDms($detail, 'dms.dms_inv_docstockmorphitem');
                    }
                }
            }
        }

        if (count($onHand) != 0) {
            foreach ($onHand as $key => $value) {
                for ($i = 0; $i < count($produkTo); $i++) {
                    if ($value->szId == $produkTo[$i]) {
                        $historyTo = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $produkTo[$i],
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $qtyTo[$i],
                            'szUomId' => $value->szUomId,
                            'dtmTransaction' => $tgl,
                            'szTrnId' => 'DMSDocStockMorph',
                            'szDocId' => $noDoc,
                            'szUserCreatedId' => $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        // echo "<pre>" . var_export($historyTo, true) . "</pre>";
                        $toHistory = $this->mInventori->simpanData($historyTo, $base . '.dms_inv_stockhistory');
                        $toHistoryDms = $this->mInventDepot->simpanDms($historyTo, 'dms.dms_inv_stockhistory');

                        $updOnHandTo = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $qtyTo[$i],
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandTo = array(
                            'szProductId' => $produkTo[$i],
                            'szStockTypeId' => 'JUAL',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'WAREHOUSE'
                        );
                        $onHandUpdateTo = $this->mInventori->updateData($whereOnHandTo, $updOnHandTo, $base . '.dms_inv_stockonhand');
                        $onHandUpdateToDms = $this->mInventDepot->updateDms($whereOnHandTo, $updOnHandTo, 'dms.dms_inv_stockonhand');
                    }
                }
            }
        }

        //counter update 
        if ($this->session->userdata('user_branch') == '302') {
            $countId = 'MORPH' . $this->session->userdata('user_branch') . 'COU';
        } else {
            $countId = 'SM' . $this->session->userdata('user_branch') . 'COU';
        }

        $counter = $this->mInventori->getCounter($countId);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $countId);
        $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
        $counterUpdateDms = $this->mInventDepot->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        if ($noRef != '-') {
            if ($referensi == 'true' && $dataMorphing == 'true' && $realHistory == 'true' && $onHandUpdate == 'true' && $detMorphing == 'true' && $toHistory == 'true' && $onHandUpdateTo == 'true' && $counterUpdate == 'true') {
                $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('home/stokMorphing'));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventori/tambahMorphing/' . $noRef));
                exit;
            }
        } else {
            if ($referensi == 'true' && $dataMorphing == 'true' && $realHistory == 'true' && $onHandUpdate == 'true' && $detMorphing == 'true' && $toHistory == 'true' && $onHandUpdateTo == 'true' && $counterUpdate == 'true') {
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

    function historyMorphing()
    {
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mInventori->getHistoryMorphing($tanggal);
        $this->load->view('vMorphingHistory', $data);
    }

    function tglHistoryMorphing()
    {
        $tanggal = $this->input->post('tanggal');
        $data['data'] = $this->mInventori->getHistoryMorphing($tanggal);
        $this->load->view('vMorphingHistory', $data);
    }

    function detailMorphing()
    {
        $document = $this->input->post('id');
        $data = $this->mInventori->editMorphing($document);
        echo json_encode($data);
    }

    function editMorphing($document)
    {
        $depo = $this->session->userdata('user_branch');

        $newSupp = 'BTBDIST' . $depo . 'COU';
        $data['newSupp'] = $this->mInventori->getId($newSupp);
        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventori->getId($adjustment);
        $data['document'] = $document;
        $data['a'] = $this->mInventori->editBtbDistribusi($document);
        $data['gudang'] = $this->mHome->getGudang();
        $data['stok'] = $this->mHome->getTipeStok();
        // $data['pengemudi'] = $this->mHome->getDriverDistribusi($depo);
        // $data['kendaraan'] = $this->mHome->getVehicleDistribusi($depo);
        $data['produk'] = $this->mHome->getProduk();

        $this->load->view('vBtbDistribusiEdit', $data);
    }

    function cetakMorphing($document)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['document'] = $document;
        $data['load'] = $this->mInventori->editMorphing($document);

        // filename dari pdf ketika didownload
        $file_pdf = 'Stok Morphing Depo ' . $this->session->userdata('user_lokasi') . ' - ' . $document;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('vMorphingCetak', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    //depot (antardepo)
    function tambahBtbDepot($document)
    {
        $depo = $this->session->userdata('user_branch');
        $data['data'] = $this->mInventori->getBtbDepot($document);
        $data['gudang'] = $this->mHome->getGudang();
        $data['stok'] = $this->mHome->getTipeStok();
        $data['produk'] = $this->mHome->getProduk();
        $data['pengemudi'] = $this->mHome->getDriverDistribusi($depo);
        $data['kendaraan'] = $this->mHome->getVehicleDistribusi($depo);
        $data['depoAsal'] = $this->mHome->getDepo($depo);
        $data['status'] = 'Draft';
        $id = 'BTBDEPO' . $depo . 'COU';
        $data['id'] = $this->mInventori->getId($id);
        $this->load->view('vBtbDepotTambah', $data);
    }

    function manualBtbDepot()
    {

        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');
        $data['gudang'] = $this->mHome->getGudang();
        $data['stok'] = $this->mHome->getTipeStok();
        $data['produk'] = $this->mHome->getProduk();
        $data['depoAsal'] = $this->mHome->getDepo($depo);
        $cek = $this->mInventDepot->refDocDepot($tanggal, $depo);
        if ($cek != 0) {
            $doc = '';
            foreach ($cek as $value) {
                $doc .= "'" . $value->refOld . "',";
            }
            $cekLen = strlen($doc);
            $referensi = substr($doc, 0, $cekLen - 1);

            $data['bkb'] = $this->mInventDepot->getBkbDepot($tanggal, $depo, $referensi);
        } else {
            $referensi = $cek;

            $data['bkb'] = $this->mInventDepot->getBkbDepot($tanggal, $depo, $referensi);
        }
        $data['status'] = 'Draft';
        $id = 'BTBDEPO' . $depo . 'COU';
        $data['id'] = $this->mInventori->getId($id);
        $this->load->view('vBtbDepotManual', $data);
    }

    function manualBkbDepot()
    {
        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');

        $data['gudang'] = $this->mHome->getGudang();
        $data['stok'] = $this->mHome->getTipeStok();
        $data['produk'] = $this->mHome->getProduk();
        $data['depoAsal'] = $this->mHome->getDepo($depo);

        $data['status'] = 'Draft';
        $id = 'BKBDEPO' . $depo . 'COU';
        $data['id'] = $this->mInventori->getId($id);
        $this->load->view('vBkbDepotManual', $data);
    }

    function simpanBtbDepot()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $noBkb = $this->input->post('noBkb');
        $noBtb = $this->input->post('noBtb');
        $tgl = $this->input->post('tgl');
        $depo = $this->input->post('depo');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $produk = $this->input->post('idProduk');
        $qty = $this->input->post('qty');
        $onHandQty = $this->input->post('onHandQty');
        $satuan = $this->input->post('satuan');
        $keterangan = $this->input->post('keterangan');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'ASA';
        } else {
            $namedept = 'TVIP';
        }

        $refDoc = array(
            'refId' => $noBtb,
            'refOld' => $noBkb,
            'refTanggal' => $tgl,
            'refDepo' => $this->session->userdata('user_branch'),
            'refDocType' => 'DMSDocStockInBranch',
            'refUserAdd' => $this->session->userdata('user_nik'),
            'refUserUpdate' => $this->session->userdata('user_nik'),
            'refDateAdd' => date('Y-m-d H:i:s'),
            'refDateUpdate' => date('Y-m-d H:i:s')
        );
        $referensi = $this->mInventori->simpanData($refDoc, $base . '.mdbaRefDoc');

        $btbDepot = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noBtb,
            'dtmDoc' => $tgl,
            'szPartyId' => $depo,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'szEmployeeId' => $pengemudi,
            'szVehicleId' => $kendaraan,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $namedept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan
        );
        $dataBtbDepot = $this->mInventori->simpanData($btbDepot, $base . '.dms_inv_docstockinbranch');

        for ($i = 0; $i < count($produk); $i++) {
            $detDepot = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $noBtb,
                'intItemNumber' => $i,
                'szProductId' => $produk[$i],
                'decQty' => $qty[$i],
                'szUomId' => $satuan[$i]
            );
            $depotDetail = $this->mInventori->simpanData($detDepot, $base . '.dms_inv_docstockinbranchitem');

            $historyDepot = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $produk[$i],
                'szLocationType' => 'WAREHOUSE',
                'szLocationId' => $gudang,
                'szStockTypeId' => $stok,
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => $qty[$i],
                'szUomId' => $satuan[$i],
                'dtmTransaction' => $tgl,
                'szTrnId' => 'DMSDocStockInBranch',
                'szDocId' => $noBtb,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $depotHistory = $this->mInventori->simpanData($historyDepot, $base . '.dms_inv_stockHistory');

            $updOnHand = array(
                'decQtyOnHand' => $onHandQty[$i] - $qty[$i],
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $whereOnHand = array(
                'szProductId' => $produk[$i],
                'szStockTypeId' => 'WAREHOUSE',
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'szLocationType' => 'JUAL'
            );
            $onHandUpdate = $this->mInventori->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
        }

        //counter update 
        $countId = 'BTBDEPO' . $this->session->userdata('user_branch') . 'COU';
        $counter = $this->mInventori->getCounter($countId);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $countId);
        $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');

        if ($referensi == 'true' && $dataBtbDepot == 'true' && $depotDetail == 'true' && $depotHistory == 'true' && $onHandUpdate == 'true' && $counterUpdate == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/btbDepot'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventori/tambahBtbDepot/' . $noBkb));
            exit;
        }
    }

    function historyBtbDepot()
    {
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mInventori->getHistoryBtbDepot($tanggal);
        $this->load->view('vBtbDepotHistory', $data);
    }

    function historyBkbDepot()
    {
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mInventori->getHistoryBkbDepot($tanggal);
        $this->load->view('vBKbDepotHistory', $data);
    }

    function editBtbDepot($document)
    {
        $depo = $this->session->userdata('user_branch');

        $newSupp = 'BTBDEPO' . $depo . 'COU';
        $data['newSupp'] = $this->mInventori->getId($newSupp);
        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventori->getId($adjustment);
        $data['document'] = $document;
        $data['data'] = $this->mInventori->editBtbDepot($document);
        $data['gudang'] = $this->mHome->getGudang();
        $data['stok'] = $this->mHome->getTipeStok();
        $data['pengemudi'] = $this->mHome->getDriverDistribusi($depo);
        $data['kendaraan'] = $this->mHome->getVehicleDistribusi($depo);
        $data['produk'] = $this->mHome->getProduk();

        $this->load->view('vBtbDepotEdit', $data);
    }

    function cetakBtbDepot($document)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['document'] = $document;
        $data['load'] = $this->mInventori->editBtbDepot($document);

        // filename dari pdf ketika didownload
        $file_pdf = 'BTB Antardepo Depo ' . $this->session->userdata('user_lokasi') . ' - ' . $document;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('vBtbDepotCetak', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    function detailBtbDepot()
    {
        $document = $this->input->post('id');
        $data = $this->mInventori->editBtbDepot($document);
        echo json_encode($data);
    }

    function tglHistoryBtbDepot()
    {
        $tanggal = $this->input->post('tanggal');
        $data['data'] = $this->mInventori->getHistoryBtbDepot($tanggal);
        $this->load->view('vBtbDepotHistory', $data);
    }

    public function updateBtbDepot()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $noDoc = $this->input->post('noDoc');
        $noDocOld = $this->input->post('noDocOld');
        $noAdjustment = $this->input->post('noAdjustment');
        $noBkb = $this->input->post('noBkb');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $kendaraan = $this->input->post('kendaraan');
        $pengemudi = $this->input->post('pengemudi');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $keterangan = $this->input->post('keterangan');
        $depoAsal = $this->input->post('depoAsal');

        // print_r($produk);

        $forStockHistory = $this->mInventori->editBtbDepot($noDocOld);
        $prodOld = '';
        foreach ($forStockHistory as $value) {
            $historyDepot = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $value->szProductId,
                'szLocationType' => 'WAREHOUSE',
                'szLocationId' => $value->szEmployeeId,
                'szStockTypeId' => $value->stok,
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => $value->decQty,
                'szUomId' => $value->szUomId,
                'dtmTransaction' => $value->dtmDoc,
                'szTrnId' => 'DMSDocStockInBranch',
                'szDocId' => $noDocOld,
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $depotHistory = $this->mInventori->simpanData($historyDepot, $base . '.dms_inv_stockHistory');

            $prodOld .= "'" . $value->szProductId . "',";
            $stokOld = $value->szStockType;

            $updDetailSupplier = array(
                'decQty' => -$value->decQty
            );

            $whereDetailSupplier = array(
                'szDocId' => $noDocOld,
                'szProductId' => $value->szProductId
            );

            $detailSupplierUpdateOld = $this->mInventori->updateData($whereDetailSupplier, $updDetailSupplier, $base . '.dms_inv_docstockinbranchitem');
        }

        $cekLen = strlen($prodOld);
        $prodOld2 = substr($prodOld, 0, $cekLen - 1);

        $stockTypeIdPOld = "'JUAL'";
        $lokasiIdPOld = "'$gudang'";
        $sOnHandOld = $this->mInventori->stockOnHandDist($prodOld2, $lokasiIdPOld, $stockTypeIdPOld);
        if (count($sOnHandOld) != 0) {
            foreach ($sOnHandOld as $value) {
                foreach ($forStockHistory as $key) {
                    if ($key->szProductId == $value->szProductId) {
                        $updOnHandOld = array(
                            'decQtyOnHand' => $value->decQtyOnHand - $key->decQty,
                            'szUserUpdatedId' => $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandOld = array(
                            'szProductId' => $value->szProductId,
                            'szStockTypeId' => 'JUAL',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationType' => 'WAREHOUSE'
                        );
                    }
                }
                $onHandUpdateOld = $this->mInventori->updateData($whereOnHandOld, $updOnHandOld, $base . '.dms_inv_stockonhand');
            }
        }

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $refDocBtb = array(
            'refId' => $noDoc,
            'refOld' => $noBkb,
            'refTanggal' => date('Y-m-d'),
            'refDepo' => $this->session->userdata('user_branch'),
            'refDocType' => 'DMSDocStockInDistribution',
            'refUserAdd' => $this->session->userdata('user_nik'),
            'refUserUpdate' => $this->session->userdata('user_nik'),
            'refDateAdd' => date('Y-m-d H:i:s'),
            'refDateUpdate' => date('Y-m-d H:i:s')
        );
        $btbRefDoc = $this->mInventori->simpanData($refDocBtb, $base . '.mdbaRefDoc');

        $dmsHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noDoc,
            'dtmDoc' => $tgl,
            'szPartyId' => $depoAsal,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'szEmployeeId' => $pengemudi,
            'szVehicleId' => $kendaraan,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan
        );
        $headerDms = $this->mInventori->simpanData($dmsHeader, $base . '.dms_inv_docstockinbranch');

        $adjRefDoc = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noAdjustment,
            'szRefDocId' => $noDoc,
            'szRefDocTypeId' => 'DMSDocStockInBranch',
            'szAdjustmentId' => $noDocOld
        );
        $refDocAdj = $this->mInventori->simpanData($adjRefDoc, $base . '.dms_inv_stockadjustmentrefdoc');

        $adjustmentHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noAdjustment,
            'dtmDoc' => $tgl,
            'szRefTypeDoc' => 'DMSDocStockInBranch',
            'szRefDocId' => $noDoc,
            'szDescription' => $keterangan,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:S')
        );
        $headAdj = $this->mInventori->simpanData($adjustmentHeader, $base . '.dms_inv_docstockadjustment');

        $prodNew = '';
        for ($i = 0; $i <= count($produk); $i++) {
            $prodNew .= "'" . $produk[$i] . "',";
        }

        $cekLenNew = strlen($prodNew);
        $prodNew2 = substr($prodNew, 0, $cekLenNew - 1);
        // print_r($prodNew2);
        $stockNew = $this->mInventori->getKodeProduk($prodNew2, $stok, $this->session->userdata('user_branch'));
        foreach ($stockNew as $value) {
            for ($i = 0; $i <= count($produk); $i++) {
                if ($value->szId == $produk[$i]) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noDoc,
                        'intItemNumber' => $i + 1,
                        'szProductId' => $value->szId,
                        'decQty' => $qty[$i],
                        'szUomId' => $value->szUomId
                    );
                    // echo "<pre>" . var_export($detail, true) . "</pre>";
                    $detailDms = $this->mInventori->simpanData($detail, $base . '.dms_inv_docstockinbranchItem');

                    $detAdjustment = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $noAdjustment,
                        'intItemNumber' => $i + 1,
                        'szProductId' => $value->szId,
                        'decQty' => $qty[$i],
                        'szUomId' => $value->szUomId
                    );
                    $detAdjustment = $this->mInventori->simpanData($detAdjustment, $base . '.dms_inv_docstockadjustmentitem');

                    $stockHistoryDrv = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $value->szId,
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $qty[$i],
                        'szUomId' => $value->szUomId,
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInBranch',
                        'szDocId' => $noDoc,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $driverStockHistory = $this->mInventori->simpanData($stockHistoryDrv, $base . '.dms_inv_stockhistory');
                    // echo "<pre>".var_export($updOnHand, true)."</pre>";
                }
            }
        }

        //counter update 
        $countId = 'BTBDEPO' . $this->session->userdata('user_branch') . 'COU';
        $counter = $this->mInventori->getCounter($countId);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $countId);
        $counterUpdate = $this->mInventori->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');

        $adjustment = 'ADJ' . $this->session->userdata('user_branch') . 'COU';
        $counterAdj = $this->mInventori->getCounter($adjustment);
        $newCountAdj = $counterAdj + 1;
        $updateCountAdj = array('intLastCounter' => $newCountAdj);
        $whereCountAdj = array('szId' => $adjustment);
        $counterUpdateAdj = $this->mInventori->updateData($whereCountAdj, $updateCountAdj, $base . '.dms_sm_counter');

        $stockTypeIdG = "'JUAL'";
        $lokasiIdG = "'$gudang'";
        $sOnHandG = $this->mInventori->stockOnHandDist($prodNew2, $lokasiIdG, $stockTypeIdG);
        foreach ($sOnHandG as $value) {
            for ($i = 0; $i <= count($produk); $i++) {
                if ($value->szProductId == $produk[$i]) {
                    $updOnHandG = array(
                        'decQtyOnHand' => $value->decQtyOnHand - $produk[$i],
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $whereOnHandG = array(
                        'szProductId' => $produk[$i],
                        'szStockTypeId' => 'WAREHOUSE',
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'szLocationType' => 'JUAL'
                    );
                }
            }
            $onHandUpdateG = $this->mInventori->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
        }
        // echo "<pre>" . var_export($updOnHandG, true) . "</pre>";
        // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";



        if ($onHandUpdateOld == 'true' && $btbRefDoc == 'true' && $refDocAdj == 'true' && $headerDms == 'true' && $headAdj == 'true' && $detailDms == 'true' && $detAdjustment == 'true' && $driverStockHistory == 'true' && $onHandUpdateG == 'true' && $counterUpdate == 'true' && $counterUpdateAdj == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/btbDepot'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventori/editBtbDepot/' . $noDocOld));
            exit;
        }
    }

    function manualMorphing()
    {
        $depo = $this->session->userdata('user_branch');
        $data['gudang'] = $this->mHome->getGudang();
        $data['stok'] = $this->mHome->getTipeStok();
        $data['produk'] = $this->mHome->getProduk();
        $data['status'] = 'Draft';
        if ($this->session->userdata('user_branch') == '302') {
            $id = 'MORPH' . $depo . 'COU';
        }
        else{
            $id = 'SM' . $depo . 'COU';
        }
        
        $data['id'] = $this->mInventori->getId($id);
        $this->load->view('vMorphingManual', $data);
    }
}
