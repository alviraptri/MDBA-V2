<?php
class inventDepot extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model(array('mHome', 'mInventDepot', 'mMaster', 'mInventDist'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    //master

    function getSoName()
    {
        $id = $this->input->post('id');
        $data = $this->mInventDepot->getSoName($id);
        echo json_encode($data);
    }

    function getVehicle()
    {
        $id = $this->input->post('id');
        $depo = $this->session->userdata('user_branch');
        $data = $this->mInventDepot->getVehicleIn($depo);
        echo json_encode($data);
    }

    function getEmployee()
    {
        $id = $this->input->post('id');
        $data = $this->mInventDepot->getEmployeeIn($id);
        echo json_encode($data);
    }

    function getProductDetail()
    {
        $id = $this->input->post('produk');
        $data = $this->mInventDepot->getProductDetail($id);
        echo json_encode($data);
    }

    function getTujuan()
    {
        $depo = $this->session->userdata('user_branch');
        $status = $this->input->post('status');
        if ($status == 'SA-SO') {
            $data = $this->mInventDepot->getCustomer($depo);
        } else {
            $data = $this->mInventDepot->getBranch($depo);
        }
        echo json_encode($data);
    }

    function getTujuanNama()
    {
        $depo = $this->session->userdata('user_branch');
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        if ($status == 'SA-SO') {
            $data = $this->mInventDepot->getSoName($id);
        } else {
            $data = $this->mInventDepot->getBranchName($id);
        }
        echo json_encode($data);
    }

    //transaksi
    function getBkbDetail()
    {
        $bkb = $this->input->post('nobkb');
        $data = $this->mInventDepot->getBkbDetail($bkb);
        echo json_encode($data);
    }

    function simpanManual()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');

        $noBkb = $this->input->post('noBkb');
        if ($noBkb == '-') {
            $bkb = 'None';
        } else {
            $bkb = $noBkb;
        }

        $tgl = $this->input->post('tgl');
        $depoAsal = $this->input->post('depoAsal');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $keterangan = $this->input->post('keterangan');
        $produk = $this->input->post('kodeProduk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');

        $id = 'BTBDEPO' . $depo . 'COU';
        $noBtb = $this->mInventDist->getId($id);
        $counter = $this->mInventDepot->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mInventDepot->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
        $counterUpdateDms = $this->mInventDepot->updateDms($whereCount, $updateCount, 'dmstesting.dms_sm_counter');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'ASA';
        } else {
            $namedept = 'TVIP';
        }

        $refDoc = array(
            'refId' => $noBtb,
            'refOld' => $bkb,
            'refTanggal' => $tgl,
            'refDepo' => $this->session->userdata('user_branch'),
            'refDocType' => 'DMSDocStockInBranch',
            'refUserAdd' => 'mdba-' . $this->session->userdata('user_nik'),
            'refUserUpdate' => 'mdba-' . $this->session->userdata('user_nik'),
            'refDateAdd' => date('Y-m-d H:i:s'),
            'refDateUpdate' => date('Y-m-d H:i:s')
        );
        $referensi = $this->mInventDepot->simpanData($refDoc, $base . '.mdbaRefDoc');

        $btbDepot = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $noBtb,
            'dtmDoc' => $tgl,
            'szPartyId' => $depoAsal,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'szEmployeeId' => $pengemudi,
            'szVehicleId' => $kendaraan,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $namedept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => $keterangan
        );
        $dataBtbDepot = $this->mInventDepot->simpanData($btbDepot, $base . '.dms_inv_docstockinbranch');
        $dataBtbDepotDms = $this->mInventDepot->simpanDms($btbDepot, 'dmstesting.dms_inv_docstockinbranch');

        $getProduk = '';
        for ($i = 0; $i < count($produk); $i++) {
            $detDepot = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $noBtb,
                'intItemNumber' => $i,
                'szProductId' => $produk[$i],
                'decQty' => $qty[$i],
                'szUomId' => $satuan[$i]
            );
            $depotDetail = $this->mInventDepot->simpanData($detDepot, $base . '.dms_inv_docstockinbranchitem');
            $depotDetailDms = $this->mInventDepot->simpanDms($detDepot, 'dmstesting.dms_inv_docstockinbranchitem');

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
                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $depotHistory = $this->mInventDepot->simpanData($historyDepot, $base . '.dms_inv_stockHistory');
            $depotHistoryDms = $this->mInventDepot->simpanDms($historyDepot, 'dmstesting.dms_inv_stockHistory');

            $getProduk .= "'" . $produk[$i] . "',";
        }

        $cekLen = strlen($getProduk);
        $product = substr($getProduk, 0, $cekLen - 1);

        $warehouse = "'" . $gudang . "'";
        $stock = "'" . $stok . "'";
        $sOnHand = $this->mInventDepot->stockOnHandDist($product, $warehouse, $stock);
        foreach ($sOnHand as $value) {
            for ($i = 0; $i < count($produk); $i++) {
                if ($value->szProductId == $produk[$i]) {
                    $updOnHand = array(
                        'decQtyOnHand' => (int)$value->decQtyOnHand + (int)$qty[$i],
                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $whereOnHand = array(
                        'szProductId' => $produk[$i],
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'szLocationId' => $gudang
                    );
                }
            }
            $onHandUpdate = $this->mInventDepot->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
            $onHandUpdateDms = $this->mInventDepot->updateDms($whereOnHand, $updOnHand, 'dmstesting.dms_inv_stockonhand');
        }

        if ($counterUpdate == 'true' && $referensi == 'true' && $dataBtbDepot == 'true' && $depotDetail == 'true' && $depotHistory == 'true' && $onHandUpdate == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('home/btbDepot'));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventori/manualBtbDepot'));
            exit;
        }
    }

    function getDetBkbDepot()
    {
        $pengajuan = $this->input->post('id');
        $tujuan = $this->mInventDepot->getTujuan($pengajuan);
        $data = $this->mInventDepot->getDetBkbDepot($pengajuan, $tujuan);
        echo json_encode($data);
    }

    function tambahBkb($ref)
    {
        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');
        $data['warehouse'] = $this->mInventDepot->getWarehouse($depo);
        $data['stock'] = $this->mInventDepot->getStockType();
        $data['product'] = $this->mInventDepot->getProduct();
        $data['employee'] = $this->mInventDepot->getEmployee($depo);
        $data['vehicle'] = $this->mInventDepot->getVehicle($depo);
        $data['customer'] = $this->mInventDepot->getCustomer($depo);
        $data['branch'] = $this->mInventDepot->getBranch($depo);

        $tujuan = $this->mInventDepot->getTujuanDet($ref);
        $data['data'] = $this->mInventDepot->getDataRefBkb($ref, $tujuan);
        $data['status'] = 'Draft';
        $id = 'BKBDEPO' . $depo . 'COU';
        $data['id'] = $this->mInventDist->getId($id);
        $this->load->view('vBkbDepotTambah', $data);
    }

    function simpanBkb()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $ref = $this->input->post('referensi');
        $tgl = $this->input->post('tgl');
        // $so = $this->input->post('so');
        $depo = $this->input->post('depo');
        $status = $this->input->post('status');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $keterangan = $this->input->post('keterangan');
        $kode = $this->input->post('kode');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');
        $tujuan = $this->input->post('tujuan');

        $branch = $this->session->userdata('user_branch');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $namedept = 'ASA';
        } else {
            $namedept = 'TVIP';
        }

        if ($gudang == '' || $stok == '' || $pengemudi == '' || $kendaraan == '' || $kode[0] == '') {
            if ($status != '-' && $ref != '-' && $ref != '0') {
                $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
                header('Location: ' . base_url('inventDepot/tambahBkb/' . $ref));
                exit;
            } else {
                $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
                header('Location: ' . base_url('inventDepot/manualBkb'));
                exit;
            }
        } else {
            $array_new = array_count_values($this->input->post('kode'));
            $array2 = array();
            foreach ($array_new as $key => $val) {
                if ($val > 1) { //or do $val >2 based on your desire
                    $array2[] = $key;
                }
            }

            if (count($array2) != '0') {
                if ($status != '-' && $ref != '-' && $ref != '0') {
                    $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                    header('Location: ' . base_url('inventDepot/tambahBkb/' . $ref));
                    exit;
                } else {
                    $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                    header('Location: ' . base_url('inventDepot/manualBkb'));
                    exit;
                }
            } else {
                $id = 'BKBDEPO' . $branch . 'COU';
                $bkb = $this->mInventDist->getId($id);
                //update counter
                $counter = $this->mInventDist->getCounter($id);
                $updateCount = array('intLastCounter' => $counter);
                $whereCount = array('szId' => $id);
                $counterUpdate = $this->mInventDist->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
                $counterDms = $this->mInventDist->updateDms($whereCount, $updateCount, 'dmstesting.dms_sm_counter');

                if ($status != '-' && $ref != '-') {
                    $refHistory = array(
                        'depotNoDoc' => $bkb,
                        'depotNoPengajuan' => $ref,
                        'depotPengemudi' => $pengemudi,
                        'depotKendaraan' => $kendaraan,
                        'depotPengaju' => $tujuan,
                        'depotStatus' => $status,
                        'depotKeterangan' => $keterangan
                    );
                    $historyRef = $this->mInventDepot->simpanData($refHistory, $base . '.mdbadepothistory');

                    $refDoc = array(
                        'refId' => $bkb,
                        'refOld' => $ref,
                        'refTanggal' => $tgl,
                        'refDepo' => $this->session->userdata('user_branch'),
                        'refDocType' => 'DMSDocStockOutBranch',
                        'refUserAdd' => 'mdba-' . $this->session->userdata('user_nik'),
                        'refUserUpdate' => 'mdba-' . $this->session->userdata('user_nik'),
                        'refDateAdd' => date('Y-m-d H:i:s'),
                        'refDateUpdate' => date('Y-m-d H:i:s')
                    );
                    $referensi = $this->mInventDepot->simpanData($refDoc, $base . '.mdbaRefDoc');

                    $bkbDepot = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $bkb,
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
                        'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s'),
                        'szDescription' => $keterangan
                    );
                    $dataBkbDepot = $this->mInventDepot->simpanData($bkbDepot, $base . '.dms_inv_docstockoutbranch');
                    $dataBkbDms = $this->mInventDepot->simpanDms($bkbDepot, 'dmstesting.dms_inv_docstockoutbranch');

                    $getProduk = '';
                    for ($i = 0; $i < count($kode); $i++) {
                        $detDepot = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $bkb,
                            'intItemNumber' => $i,
                            'szProductId' => $kode[$i],
                            'decQty' => $qty[$i],
                            'szUomId' => $satuan[$i]
                        );
                        $depotDetail = $this->mInventDepot->simpanData($detDepot, $base . '.dms_inv_docstockoutbranchitem');
                        $depotDetailDms = $this->mInventDepot->simpanDms($detDepot, 'dmstesting.dms_inv_docstockoutbranchitem');

                        $historyDepot = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $kode[$i],
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => -$qty[$i],
                            'szUomId' => $satuan[$i],
                            'dtmTransaction' => $tgl,
                            'szTrnId' => 'DMSDocStockOutBranch',
                            'szDocId' => $bkb,
                            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $depotHistory = $this->mInventDepot->simpanData($historyDepot, $base . '.dms_inv_stockHistory');
                        $depotHistoryDms = $this->mInventDepot->simpanDms($historyDepot, 'dmstesting.dms_inv_stockHistory');

                        $getProduk .= "'" . $kode[$i] . "',";
                    }
                }

                $cekLen = strlen($getProduk);
                $product = substr($getProduk, 0, $cekLen - 1);
                $warehouse = "'" . $gudang . "'";
                $stock = "'" . $stok . "'";
                $sOnHand = $this->mInventDist->stockOnHand($product, $gudang, $stok);

                if ($sOnHand != '0') {
                    foreach ($sOnHand as $value) {
                        for ($i = 0; $i < count($kode); $i++) {
                            if ($value->szProductId == $kode[$i]) {
                                $updOnHand = array(
                                    'decQtyOnHand' => $value->decQtyOnHand - (int)$qty[$i],
                                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHand = array(
                                    'szProductId' => $kode[$i],
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $gudang
                                );
                            }
                        }
                        // echo "<pre>".var_export($updOnHand, true)."</pre>";
                        $onHandUpdate = $this->mInventDepot->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $onHandUpdateDms = $this->mInventDepot->updateDms($whereOnHand, $updOnHand, 'dmstesting.dms_inv_stockonhand');
                        // print_r($depotHistory);
                    }
                } else {
                    foreach ($sOnHand as $key) {
                        $onHandOld = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $key->szProductId,
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $key->szWarehouseId,
                            'szStockTypeId' => $key->szStockTypeId,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => '0',
                            'szUomId' => $key->szUomId,
                            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $insertOnHandOld = $this->mInventSupp->simpanData($onHandOld, $base . '.dms_inv_stockonhand');
                    }
                }

                if ($status != '-' && $ref != '-' && $ref != '0') {
                    if ($counterUpdate == 'true' && $referensi == 'true' && $dataBkbDepot == 'true' && $depotDetail == 'true' && $depotHistory == 'true' && $onHandUpdate == 'true') {
                        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                        header('Location: ' . base_url('inventDepot/historyBkb'));
                        exit;
                    } else {
                        $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                        header('Location: ' . base_url('inventDepot/tambahBkb/' . $ref));
                        exit;
                    }
                } else {
                    if ($counterUpdate == 'true' && $referensi == 'true' && $dataBkbDepot == 'true' && $depotDetail == 'true' && $depotHistory == 'true' && $onHandUpdate == 'true') {
                        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                        header('Location: ' . base_url('inventDepot/historyBkb'));
                        exit;
                    } else {
                        $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                        header('Location: ' . base_url('inventDepot/manualBkb'));
                        exit;
                    }
                }
            }
        }
    }

    function manualBkb()
    {
        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');

        $data['warehouse'] = $this->mInventDepot->getWarehouse($depo);
        $data['stock'] = $this->mInventDepot->getStockType();
        $data['product'] = $this->mInventDepot->getProduct();
        $data['branch'] = $this->mInventDepot->getBranch($depo);
        $data['employee'] = $this->mInventDepot->getEmployee($depo);
        $data['vehicle'] = $this->mInventDepot->getVehicle($depo);

        $data['status'] = 'Draft';
        $id = 'BKBDEPO' . $depo . 'COU';
        $data['id'] = $this->mInventDepot->getId($id);
        $this->load->view('vBkbDepotManual', $data);
    }

    function historyBkb()
    {
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mInventDepot->getHistoryBkb($tanggal);
        $this->load->view('vBkbDepotHistory', $data);
    }

    function tglHistoryBkb()
    {
        $tanggal = $this->input->post('tanggal');
        $data['data'] = $this->mInventDepot->getHistoryBkb($tanggal);
        $this->load->view('vBkbDepotHistory', $data);
    }

    function detailBkb()
    {
        $document = $this->input->post('id');
        $data = $this->mInventDepot->editBkb($document);
        echo json_encode($data);
    }

    function cetakBkb($document)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['document'] = $document;
        $data['load'] = $this->mInventDepot->editBkb($document);

        // filename dari pdf ketika didownload
        $file_pdf = 'BKB Antardepo Depo ' . $this->session->userdata('user_lokasi') . ' - ' . $document;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('vBkbDepotCetak', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    function editBkb($document)
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');

        $bkb = 'BKBDEPO' . $depo . 'COU';
        $data['bkb'] = $this->mInventDepot->getId($bkb);
        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventDepot->getId($adjustment);

        $data['data'] = $this->mInventDepot->editBkb($document);

        $data['warehouse'] = $this->mInventDepot->getWarehouse($depo);
        $data['stock'] = $this->mInventDepot->getStockType();
        $data['product'] = $this->mInventDepot->getProduct();
        $data['branch'] = $this->mInventDepot->getBranch($depo);
        $data['employee'] = $this->mInventDepot->getEmployee($depo);
        $data['vehicle'] = $this->mInventDepot->getVehicle($depo);
        $data['customer'] = $this->mInventDepot->getCustomer($depo);

        $this->load->view('vBkbDepotEdit', $data);
    }

    function updateBkb()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');

        $noRef = $this->input->post('referensi');
        $bkbOld = $this->input->post('oldBkb');
        $tgl = $this->input->post('tgl');
        $depoTujuan = $this->input->post('depoTujuan');
        $soTujuan = $this->input->post('soTujuan');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $keterangan = $this->input->post('keterangan');
        $kode = $this->input->post('kode');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');

        if ($depoTujuan != '') {
            $tujuan = $depoTujuan;
        } else {
            $tujuan = $soTujuan;
        }

        if ($gudang == '' || $stok == '' || $pengemudi == '' || $kendaraan == '' || $kode[0] == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventDepot/editBkb/' . $bkbOld));
            exit;
        } else {
            $id = 'BKBDEPO' . $depo . 'COU';
            $bkb = $this->mInventDepot->getId($id);
            //update counter
            $countBkb = $this->mInventDepot->getCounter($id);
            $updCountBkb = array('intLastCounter' => $countBkb);
            $whereCountBkb = array('szId' => $id);
            $countUpdBkb = $this->mInventDepot->updateData($whereCountBkb, $updCountBkb, $base . '.dms_sm_counter');
            $countUpdBkbDms = $this->mInventDepot->updateDms($whereCountBkb, $updCountBkb, 'dmstesting.dms_sm_counter');

            $adj = 'ADJ' . $depo . 'COU';
            $adjustment = $this->mInventDepot->getId($adj);
            //update counter
            $countAdj = $this->mInventDepot->getCounter($adj);
            $updCountAdj = array('intLastCounter' => $countAdj);
            $whereCountAdj = array('szId' => $adj);
            $countUpdAdj = $this->mInventDepot->updateData($whereCountAdj, $updCountAdj, $base . '.dms_sm_counter');
            $countUpdAdjDms = $this->mInventDepot->updateDms($whereCountAdj, $updCountAdj, 'dmstesting.dms_sm_counter');

            $old = $this->mInventDepot->editBkb($bkbOld);
            $prodOld = '';
            $intNum = 0;

            foreach ($old as $value) {
                $prodOld .= "'" . $value->szProductId . "',";
                $stokOld = $value->szStockType;
                $gudangOld = $value->szWarehouseId;

                $updHistoryOld = array(
                    'decQtyOnHand' => $value->decQty,
                    'szDocId' => $bkb,
                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );

                $whereHistoryOld = array(
                    'szDocId' => $bkbOld,
                    'szProductId' => $value->szProductId
                );

                $historyBkbOld = $this->mInventDepot->updateData($updHistoryOld, $whereHistoryOld, $base . '.dms_inv_stockHistory');
                $historyBkbOldDms = $this->mInventDepot->updateDms($updHistoryOld, $whereHistoryOld, 'dmstesting.dms_inv_stockHistory');

                $updDetOldBkb = array(
                    'decQty' => -$value->decQty,
                    'szDocId' => $bkb
                );

                $whereDetOldBkb = array(
                    'szDocId' => $bkbOld,
                    'szProductId' => $value->szProductId
                );

                $detOldBkbUpd = $this->mInventDepot->updateData($whereDetOldBkb, $updDetOldBkb, $base . '.dms_inv_docstockoutbranchitem');
                $detOldBkbUpdDms = $this->mInventDepot->updateDms($whereDetOldBkb, $updDetOldBkb, 'dmstesting.dms_inv_docstockoutbranchitem');

                $updOldBkb = array(
                    'szDocId' => $bkb
                );

                $whereOldBkb = array(
                    'szDocId' => $bkbOld
                );
                $oldUpd = $this->mInventDepot->updateData($whereOldBkb, $updOldBkb, $base . '.dms_inv_docstockoutbranch');
                $bkbOldUpd = $this->mInventDepot->updateDms($whereOldBkb, $updOldBkb, 'dmstesting.dms_inv_docstockoutbranch');

                $detAdjustment = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $adjustment,
                    'intItemNumber' => $intNum,
                    'szProductId' => $value->szProductId,
                    'decQty' => $value->decQty,
                    'szUomId' => $value->szUomId
                );
                $adjDet = $this->mInventDepot->simpanData($detAdjustment, $base . '.dms_inv_docstockadjustmentitem');
                $adjDetDms = $this->mInventDepot->simpanDms($detAdjustment, 'dmstesting.dms_inv_docstockadjustmentitem');

                $intNum++;
            }
            $lenOld = strlen($prodOld);
            $prodOld2 = substr($prodOld, 0, $lenOld - 1);

            $sOnHandOld = $this->mInventDepot->stockOnHand($prodOld2, "'" . $gudangOld . "'", "'" . $stokOld . "'");
            if ($sOnHandOld != 0) {
                foreach ($sOnHandOld as $value) {
                    foreach ($old as $key) {
                        if ($key->szProductId == $value->szProductId) {
                            $updOnHandOld = array(
                                'decQtyOnHand' => $value->decQtyOnHand + $key->decQty,
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $whereOnHandOld = array(
                                'szProductId' => $value->szProductId,
                                'szStockTypeId' => $stokOld,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'szLocationId' => $gudangOld
                            );
                        }
                    }
                    $onHandUpdateOld = $this->mInventDepot->updateData($whereOnHandOld, $updOnHandOld, $base . '.dms_inv_stockonhand');
                    $onHandUpdateOldDms = $this->mInventDepot->updateDms($whereOnHandOld, $updOnHandOld, 'dmstesting.dms_inv_stockonhand');
                }
            } else {
                foreach ($old as $key) {
                    $onHandOld = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $key->szProductId,
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $key->szWarehouseId,
                        'szStockTypeId' => $key->szStockTypeId,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $key->decQty,
                        'szUomId' => $key->szUomId,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $insertOnHandOld = $this->mInventSupp->simpanData($onHandOld, $base . '.dms_inv_stockonhand');
                }
            }

            if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
                $dept = 'ASA';
            } else {
                $dept = 'TVIP';
            }

            $adjRefDoc = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjustment,
                'szRefDocId' => $bkbOld,
                'szRefDocTypeId' => 'DMSDocStockOutBranch',
                'szAdjustmentId' => $bkb
            );
            $refDocAdj = $this->mInventDepot->simpanData($adjRefDoc, $base . '.dms_inv_stockadjustmentrefdoc');
            $refDocAdjDms = $this->mInventDepot->simpanDms($adjRefDoc, 'dmstesting.dms_inv_stockadjustmentrefdoc');

            $adjustmentHeader = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjustment,
                'dtmDoc' => $tgl,
                'szRefTypeDoc' => 'DMSDocStockOutBranch',
                'szRefDocId' => $bkbOld,
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
            $headAdjDms = $this->mInventDepot->simpanDms($adjustmentHeader, 'dmstesting.dms_inv_docstockadjustment');

            $bkbDepot = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $bkbOld,
                'dtmDoc' => $tgl,
                'szPartyId' => $tujuan,
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
            $dataBkbDepot = $this->mInventDepot->simpanData($bkbDepot, $base . '.dms_inv_docstockoutbranch');
            $dataBkbDepotDms = $this->mInventDepot->simpanDms($bkbDepot, 'dmstesting.dms_inv_docstockoutbranch');

            $getProduk = '';
            for ($i = 0; $i < count($kode); $i++) {
                $detDepot = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $bkbOld,
                    'intItemNumber' => $i,
                    'szProductId' => $kode[$i],
                    'decQty' => $qty[$i],
                    'szUomId' => $satuan[$i]
                );
                $depotDetail = $this->mInventDepot->simpanData($detDepot, $base . '.dms_inv_docstockoutbranchitem');
                $depotDetailDms = $this->mInventDepot->simpanDms($detDepot, 'dmstesting.dms_inv_docstockoutbranchitem');

                $historyDepot = array(
                    'iId' => $this->uuid->v4(),
                    'szProductId' => $kode[$i],
                    'szLocationType' => 'WAREHOUSE',
                    'szLocationId' => $gudang,
                    'szStockTypeId' => $stok,
                    'szReportedAsId' => $this->session->userdata('user_branch'),
                    'decQtyOnHand' => -$qty[$i],
                    'szUomId' => $satuan[$i],
                    'dtmTransaction' => $tgl,
                    'szTrnId' => 'DMSDocStockOutBranch',
                    'szDocId' => $bkbOld,
                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );
                $depotHistory = $this->mInventDepot->simpanData($historyDepot, $base . '.dms_inv_stockHistory');
                $depotHistoryDms = $this->mInventDepot->simpanDms($historyDepot, 'dmstesting.dms_inv_stockHistory');

                $getProduk .= "'" . $kode[$i] . "',";
            }

            $cekLen = strlen($getProduk);
            $product = substr($getProduk, 0, $cekLen - 1);
            $warehouse = "'" . $gudang . "'";
            $stock = "'" . $stok . "'";
            $sOnHand = $this->mInventDepot->stockOnHand($product, $warehouse, $stock);
            if ($sOnHand != '0') {
                foreach ($sOnHand as $value) {
                    for ($i = 0; $i < count($kode); $i++) {
                        if ($value->szProductId == $kode[$i]) {
                            $updOnHand = array(
                                'decQtyOnHand' => $value->decQtyOnHand - (int)$qty[$i],
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $whereOnHand = array(
                                'szProductId' => $kode[$i],
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'szLocationId' => $gudang
                            );
                        }
                    }
                    $onHandUpdate = $this->mInventDepot->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                    $onHandUpdateDms = $this->mInventDepot->updateDms($whereOnHand, $updOnHand, 'dmstesting.dms_inv_stockonhand');
                }
            } else {
                foreach ($sOnHand as $key) {
                    $onHandOld = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $key->szProductId,
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $key->szWarehouseId,
                        'szStockTypeId' => $key->szStockTypeId,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => '0',
                        'szUomId' => $key->szUomId,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $insertOnHandOld = $this->mInventSupp->simpanData($onHandOld, $base . '.dms_inv_stockonhand');
                }
            }

            if ($countUpdBkb == 'true' && $countUpdAdj == 'true' && $onHandUpdateOld == 'true' && $refDocAdj == 'true' && $headAdj == 'true' && $headAdj == 'true' && $dataBkbDepot == 'true' && $depotDetail == 'true' && $depotHistory == 'true' && $onHandUpdate == 'true' && $detOldBkbUpd == 'true' && $adjDet == 'true') {
                $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('inventDepot/historyBkb'));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventDepot/editBkb/' . $bkbOld));
                exit;
            }
        }
        // echo "<pre>" . var_export($bkbOld, true) . "</pre>";
        // print_r($stokOld);
    }

    function tambahBtb($document)
    {
        $depo = $this->session->userdata('user_branch');

        $id = 'BTBDEPO' . $depo . 'COU';
        $data['id'] = $this->mInventDist->getId($id);

        $data['data'] = $this->mInventDepot->getBkb($document);

        $data['status'] = 'Draft';
        $this->load->view('vBtbDepotTambah', $data);
    }

    function manualBtb()
    {
        $depo = $this->session->userdata('user_branch');
        $data['warehouse'] = $this->mInventDepot->getWarehouse($depo);
        $data['stock'] = $this->mInventDepot->getStockType();
        $data['product'] = $this->mInventDepot->getProduct();
        $data['branch'] = $this->mInventDepot->getBranch($depo);
        $data['status'] = 'Draft';
        $id = 'BTBDEPO' . $depo . 'COU';
        $data['id'] = $this->mInventDist->getId($id);
        $this->load->view('vBtbDepotManual', $data);
    }

    function simpanBtb()
    {
        $bkb = $this->input->post('bkb');
        $tgl = $this->input->post('tgl');
        $asal = $this->input->post('asal');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $keterangan = $this->input->post('keterangan');
        $kode = $this->input->post('kode');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');

        $depo = $this->session->userdata('user_branch');
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'ASA';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'TVIP';
            $base = 'dummymdbatvip';
        }

        if ($gudang == '' || $stok == '' || $pengemudi == '' || $kendaraan == '') {
            if ($bkb != '-') {
                $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
                header('Location: ' . base_url('inventDepot/tambahBtb/' . $bkb));
                exit;
            } else {
                $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
                header('Location: ' . base_url('inventDepot/manualBtb'));
                exit;
            }
        } else {
            $array_new = array_count_values($this->input->post('kode'));
            $array2 = array();
            foreach ($array_new as $key => $val) {
                if ($val > 1) { //or do $val >2 based on your desire
                    $array2[] = $key;
                }
            }

            if (count($array2) != '0') {
                if ($bkb != '-') {
                    $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                    header('Location: ' . base_url('inventDepot/tambahBtb/' . $bkb));
                    exit;
                } else {
                    $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                    header('Location: ' . base_url('inventDepot/manualBtb'));
                    exit;
                }
            } else {
                $id = 'BTBDEPO' . $depo . 'COU';
                $btb = $this->mInventDist->getId($id);
                //update counter
                $counter = $this->mInventDist->getCounter($id);
                $updateCount = array('intLastCounter' => $counter);
                $whereCount = array('szId' => $id);
                $counterUpdate = $this->mInventDepot->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
                // $counterDms = $this->mInventDepot->updateDms($whereCount, $updateCount, 'dmstesting.dms_sm_counter');

                $refDoc = array(
                    'refId' => $btb,
                    'refOld' => $bkb,
                    'refTanggal' => $tgl,
                    'refDepo' => $depo,
                    'refDocType' => 'DMSDocStockInBranch',
                    'refUserAdd' => 'mdba-' . $this->session->userdata('user_nik'),
                    'refUserUpdate' => 'mdba-' . $this->session->userdata('user_nik'),
                    'refDateAdd' => date('Y-m-d H:i:s'),
                    'refDateUpdate' => date('Y-m-d H:i:s')
                );
                $referensiDoc = $this->mInventDepot->simpanData($refDoc, $base . '.mdbarefdoc');

                $headBtb = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $btb,
                    'dtmDoc' => $tgl,
                    'szPartyId' => $asal,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'szEmployeeId' => $pengemudi,
                    'szVehicleId' => $kendaraan,
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s'),
                    'szDescription' => $keterangan
                );
                $btbHeader = $this->mInventDepot->simpanData($headBtb, $base . '.dms_inv_docstockinbranch');
                // $btbHeaderDms = $this->mInventDepot->simpanDms($headBtb, 'dmstesting.dms_inv_docstockinbranch');

                $getProduk = '';
                for ($i = 0; $i < count($this->input->post('num')); $i++) {
                    foreach ($kode as $index => $row) {
                        if (isset($i)) {
                            $detBtb = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $btb,
                                'intItemNumber' => $i,
                                'szProductId' => $kode[$i],
                                'decQty' => $qty[$i],
                                'szUomId' => $satuan[$i]
                            );

                            $historyGdg = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $kode[$i],
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $depo,
                                'decQtyOnHand' => $qty[$i],
                                'szUomId' => $satuan[$i],
                                'dtmTransaction' => $tgl,
                                'szTrnId' => 'DMSDocStockInBranch',
                                'szDocId' => $btb,
                                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_branch'),
                                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_branch'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );

                            $getProduk .= "'" . $kode[$i] . "',";
                        }
                    }
                    // echo "<pre> Detail :".var_export($detBtb, true)."</pre>";
                    $bkbDetail = $this->mInventDepot->simpanData($detBtb, $base . '.dms_inv_docstockinbranchitem');
                    // $bkbDetailDms = $this->mInventDepot->simpanDms($detBtb, 'dmstesting.dms_inv_docstockinbranchitem');

                    $gdgHistory = $this->mInventDepot->simpanData($historyGdg, $base . '.dms_inv_stockhistory');
                    // $gdgHistoryDms = $this->mInventDepot->simpanDms($historyGdg, 'dmstesting.dms_inv_stockhistory');
                }
                $cekLen = strlen($getProduk);
                $product = substr($getProduk, 0, $cekLen - 1);

                $OnHandG = $this->mInventDepot->stockOnHand($product, $gudang, $stok);
                // echo "<pre> OnHandG :" . var_export($OnHandG, true) . "</pre>";
                if ($OnHandG != '0') {
                    foreach ($OnHandG as $value) {
                        for ($i = 0; $i < count($kode); $i++) {
                            if ($value->szProductId == $kode[$i]) {
                                $updOnHandG = array(
                                    'decQtyOnHand' => (int)$value->decQtyOnHand + (int)$qty[$i],
                                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHandG = array(
                                    'szProductId' => $kode[$i],
                                    'szStockTypeId' => $stok,
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $gudang
                                );
                            }
                        }
                        // echo "<pre> updOnHandG :".var_export($updOnHandG, true)."</pre>";
                        // echo "<pre> whereOnHandG :".var_export($whereOnHandG, true)."</pre>";
                        $onHandUpdateG = $this->mInventDist->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
                        // $onHandUpdateGDms = $this->mInventDepot->updateDms($whereOnHandG, $updOnHandG, 'dmstesting.dms_inv_stockonhand');
                    }
                } else {
                    foreach ($OnHandG as $key) {
                        for ($i = 0; $i < count($kode); $i++) {
                            $onHandOld = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $key->szProductId,
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $key->szWarehouseId,
                                'szStockTypeId' => $key->szStockTypeId,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $qty[$i],
                                'szUomId' => $key->szUomId,
                                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                        }
                        $insertOnHandOld = $this->mInventSupp->simpanData($onHandOld, $base . '.dms_inv_stockonhand');
                    }
                }

                if ($referensiDoc == 'true' && $btbHeader == 'true' && $bkbDetail == 'true' && $gdgHistory == 'true') {
                    $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                    header('Location: ' . base_url('home/btbDepot'));
                    exit;
                } else {
                    if ($bkb != '-') {
                        $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                        header('Location: ' . base_url('inventDepot/tambahBtb/' . $bkb));
                        exit;
                    } else {
                        $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                        header('Location: ' . base_url('inventDepot/manualBtb'));
                        exit;
                    }
                }
            }
        }
    }

    function updateBtb()
    {
        $depo = $this->session->userdata('user_branch');
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'ASA';
            $base = 'dummymdbaasa';
        } else {
            $dept = 'TVIP';
            $base = 'dummymdbatvip';
        }

        $btbOld = $this->input->post('btbOld');
        $keterangan = $this->input->post('keterangan');

        $btb = 'BTBDEPO' . $depo . 'COU';
        $btbCancel = $this->mInventDepot->getId($btb);

        $adjustment = 'ADJ' . $depo . 'COU';
        $adjNo = $this->mInventDepot->getId($adjustment);

        $result = $this->mInventDepot->editBtb($btbOld);

        // update counter
        $cBtbCancel = $this->mInventDepot->getCounter($btb);
        $cUpdBtbCancel = array(
            'intLastCounter' => $cBtbCancel,
            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'dtmLastUpdated' => date('Y-m-d H:i:s')
        );
        $cWhereBtbCancel = array('szId' => $btb);
        // $cBtbCancelUpd = $this->mInventDepot->updateData($cWhereBtbCancel, $cUpdBtbCancel, $base . '.dms_sm_counter');
        // $cBtbCancelUpd = $this->mInventDepot->updateDms($cWhereBtbCancel, $cUpdBtbCancel, 'dmstesting.dms_sm_counter');

        //insert header cancel btb qty -
        foreach ($result as $key) {
            $szPartyId = $key->szPartyId;
            $szWarehouseId = $key->szWarehouseId;
            $szStockType = $key->szStockType;
            $szEmployeeId = $key->szEmployeeId;
            $szVehicleId = $key->szVehicleId;
            $szDescription = $key->szDescription;
        }

        $inHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $btbCancel,
            'dtmDoc' => date('Y-m-d'),
            'szPartyId' => $szPartyId,
            'szWarehouseId' => $szWarehouseId,
            'szStockType' => $szStockType,
            'szEmployeeId' => $szEmployeeId,
            'szVehicleId' => $szVehicleId,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => 'No Ref BTB'. $btbOld . ', Keterangan: '. $szDescription . '<br>' . 'Adjustment Karena: ' . $keterangan,
        );
        // $dataHeadCancel = $this->mInventDepot->simpanData($inHeader, $base . '.dms_inv_docstockinbranch');
        // $dataHeadCancelDms = $this->mInventDepot->simpanDms($inHeader, 'dmstesting.dms_inv_docstockinbranch');

        $int = 0;
        $getProduk = '';
        foreach ($result as $key) {
            $inDetail = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $btbCancel,
                'intItemNumber' => $int,
                'szProductId' => $key->szProductId,
                'decQty' => -$key->decQty,
                'szUomId' => $key->szUomId
            );
            // $dataDetCancel = $this->mInventDepot->simpanData($inDetail, $base . '.dms_inv_docstockinbranchitem');
            // $dataDetCancelDms = $this->mInventDepot->simpanDms($inDetail, 'dmstesting.dms_inv_docstockinbranchitem');

            $inHistory = array(
                'iId' => $this->uuid->v4(),
                'szProductId' => $key->szProductId,
                'szLocationType' => 'WAREHOUSE',
                'szLocationId' => $key->szWarehouseId,
                'szStockTypeId' => $key->szStockType,
                'szReportedAsId' => $this->session->userdata('user_branch'),
                'decQtyOnHand' => -$key->decQty,
                'szUomId' => $key->szUomId,
                'dtmTransaction' => date('Y-m-d'),
                'szTrnId' => 'DMSDocStockInBranch',
                'szDocId' => $btbCancel,
                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            // $dataHistCancel = $this->mInventDepot->simpanData($inHistory, $base . '.dms_inv_stockhistory');
            // $dataHistCancelDms = $this->mInventDepot->simpanDms($inHistory, 'dmstesting.dms_inv_stockhistory');

            $int++;
            $getProduk .= "'" . $key->szProductId . "',";
        }
        $pdLen = strlen($getProduk);
        $prods = substr($getProduk, 0, $pdLen - 1);

        //update stock jadi minus
        $OnHandG = $this->mInventDepot->stockOnHand($prods, $szWarehouseId, $szStockType);
        if ($OnHandG != '0') {
            foreach ($OnHandG as $value) {
                foreach ($result as $key) {
                    if ($value->szProductId == $key->szProductId) {
                        $updOnHandG = array(
                            'decQtyOnHand' => (int)$value->decQtyOnHand - (int)$key->decQty,
                            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereOnHandG = array(
                            'szProductId' => $key->szProductId,
                            'szStockTypeId' => $key->szStockType,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'szLocationId' => $key->szWarehouseId
                        );
                    }
                }
                // echo "<pre> updOnHandG :".var_export($updOnHandG, true)."</pre>";
                // echo "<pre> whereOnHandG :".var_export($whereOnHandG, true)."</pre>";
                // $onHandUpdateG = $this->mInventDepot->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
                // $onHandUpdateGDms = $this->mInventDepot->updateDms($whereOnHandG, $updOnHandG, 'dmstesting.dms_inv_stockonhand');
            }
        } else {
            foreach ($OnHandG as $key) {
                foreach ($result as $key) {
                    $onHandOld = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $key->szProductId,
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $key->szWarehouseId,
                        'szStockTypeId' => $key->szStockTypeId,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => '0',
                        'szUomId' => $key->szUomId,
                        'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                }
                $insertOnHandOld = $this->mInventDepot->simpanData($onHandOld, $base . '.dms_inv_stockonhand');
            }
        }

        // update counter adjustment
        $aBtbCancel = $this->mInventDepot->getCounter($adjustment);
        $aUpdBtbCancel = array(
            'intLastCounter' => $aBtbCancel,
            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'dtmLastUpdated' => date('Y-m-d H:i:s')
        );
        $aWhereBtbCancel = array('szId' => $adjustment);
        // $aBtbCancelUpd = $this->mInventDepot->updateData($aWhereBtbCancel, $aUpdBtbCancel, $base . '.dms_sm_counter');
        // $aBtbCancelUpd = $this->mInventDepot->updateDms($aWhereBtbCancel, $aUpdBtbCancel, 'dmstesting.dms_sm_counter');

        //adjustment
        $adjustHeader = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $adjNo,
            'dtmDoc' => date('Y-m-d'),
            'szRefTypeDoc' => 'DMSDocStockInBranch',
            'szRefDocId' => $btbOld,
            'szRefDoc' => $keterangan,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Applied',
            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
        );
        // $dataHeadAdjust = $this->mInventDepot->simpanData($adjustHeader, $base . '.dms_inv_docstockadjustment');
        // $dataHeadAdjustDms = $this->mInventDepot->simpanDms($adjustHeader, 'dmstesting.dms_inv_docstockadjustment');

        $adjustRef = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $adjNo,
            'szRefDocId' => $btbOld,
            'szRefDocTypeId' => 'DMSDocStockInBranch',
            'szAdjustmentId' => $adjustment
        );
        // $dataRefAdjust = $this->mInventDepot->simpanData($adjustRef, $base . '.dms_inv_stockadjustmentrefdoc');
        // $dataRefAdjustDms = $this->mInventDepot->simpanDms($adjustRef, 'dmstesting.dms_inv_stockadjustmentrefdoc');

        $num = 0;
        foreach ($result as $key) {
            $adjustDetail = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjNo, 
                'intItemNumber' => $num,
                'szProductId' => $key->szProductId,
                'decQty' => $key->decQty,
                'szUomId' => $key->szUomId
            );
            // $dataDetAdjust = $this->mInventDepot->simpanData($adjustDetail, $base . '.dms_inv_docstockadjustmentitem');
            // $dataDetAdjustDms = $this->mInventDepot->simpanDms($adjustDetail, 'dmstesting.dms_inv_docstockadjustmentitem');

            $num++;
        }
    }

    function historyBtb()
    {
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mInventDepot->getHistoryBtb($tanggal);
        $this->load->view('vBtbDepotHistory', $data);
    }

    function tglHistoryBtb()
    {
        $tanggal = $this->input->post('tanggal');
        $data['data'] = $this->mInventDepot->getHistoryBtb($tanggal);
        $this->load->view('vBtbDepotHistory', $data);
    }

    function editBtb($document)
    {
        $depo = $this->session->userdata('user_branch');

        $btb = 'BTBDEPO' . $depo . 'COU';
        $data['btb'] = $this->mInventDepot->getId($btb);
        $data['btbAdj'] = $this->mInventDist->getIdAdj($btb);

        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventDepot->getId($adjustment);

        $data['data'] = $this->mInventDepot->editBtb($document);

        $data['warehouse'] = $this->mInventDepot->getWarehouse($depo);
        $data['stock'] = $this->mInventDepot->getStockType();
        $data['product'] = $this->mInventDepot->getProduct();
        $data['branch'] = $this->mInventDepot->getBranch($depo);
        $data['employee'] = $this->mInventDepot->getEmployee($depo);
        $data['vehicle'] = $this->mInventDepot->getVehicle($depo);

        $this->load->view('vBtbDepotEdit', $data);
    }

    function detailBtb()
    {
        $document = $this->input->post('id');
        $data = $this->mInventDepot->editBtb($document);
        echo json_encode($data);
    }

    function cetakBtb($document)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['document'] = $document;
        $data['load'] = $this->mInventDepot->editBtb($document);

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
}
