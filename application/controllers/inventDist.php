<?php
class inventDist extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model(array('mInventori', 'mHome', 'mInventDepot', 'mMaster', 'mInventDist', 'mSnDPB'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    //master
    function vehicle()
    {
        $id = $this->input->post('id');
        $depo = $this->session->userdata('user_branch');
        $vehicle = $this->mInventDist->vehicle($id);
        $kendaraan = $this->mInventDist->getVehicle($depo);
        $data = array(
            'vehicle' => $vehicle,
            'kendaraan' => $kendaraan
        );
        echo json_encode($data);
    }
    //end master

    function tambahBKB($dokumen)
    {
        $depo = $this->session->userdata('user_branch');
        $data['warehouse'] = $this->mInventDist->getGudang($depo);
        $data['type'] = $this->mInventDist->getStockType();
        $data['employee'] = $this->mInventDist->getEmployee($depo);
        $data['vehicle'] = $this->mInventDist->getVehicle($depo);
        $data['product'] = $this->mInventDist->getProduct();
        $data['data'] = $this->mInventDist->getDetPB($dokumen);

        $cek = $this->mInventDist->getBKBDO($depo);
        if ($cek != '0') {
            $do = '';
            foreach ($cek as $value) {
                $do .= "'" . $value->bkbDO . "',";
            }
            $lenDO = strlen($do);
            $referensi = substr($do, 0, $lenDO - 1);
        } else {
            $referensi = 0;
        }
        $data['do'] = $this->mInventDist->getNoDo($depo, $referensi);

        $id = 'BKBDIST' . $depo . 'COU';
        $data['id'] = $this->mInventDist->getId($id);
        $data['status'] = 'Draft';
        $this->load->view('vBKBDistribusiTambah', $data);
    }

    function manualBkb()
    {
        $depo = $this->session->userdata('user_branch');

        $cekDo = $this->mInventDist->getBKBDO($depo);
        if ($cekDo != '0') {
            $do = '';
            foreach ($cekDo as $value) {
                $do .= "'" . $value->bkbDO . "',";
            }
            $lenDO = strlen($do);
            $referensi = substr($do, 0, $lenDO - 1);
        } else {
            $referensi = 0;
        }
        $data['do'] = $this->mInventDist->getNoDo($depo, $referensi);

        $data['pb'] = $this->mHome->getBkbDist();
        $id = 'BKBDIST' . $depo . 'COU';
        $data['id'] = $this->mInventori->getId($id);
        $data['status'] = 'Draft';
        $this->load->view('vBKBDistribusiManual', $data);
    }

    function getPengemudi()
    {
        $pengemudi = $this->input->post('pengemudi');
        $data = $this->mInventDist->getPengemudi($pengemudi);
        echo json_encode($data);
    }

    function getKendaraan()
    {
        $kendaraan = $this->input->post('kendaraan');
        $data = $this->mInventDist->getKendaraan($kendaraan);
        echo json_encode($data);
    }

    function getProduk()
    {
        $produk = $this->input->post('produk');
        $stok = $this->input->post('stok');
        $gudang = $this->input->post('gudang');
        $data = $this->mInventDist->getProduk($produk, $stok, $gudang);
        echo json_encode($data);
    }

    function getNamaPelanggan()
    {
        $nodo = $this->input->post('nodo');
        $data = $this->mInventDist->getNamaPelanggan($nodo);
        echo json_encode($data);
    }

    function simpanBKB()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $pb = $this->input->post('pb');
        $tgl = $this->input->post('tgl');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $keterangan = $this->input->post('keterangan');
        $kode = $this->input->post('kode');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');
        $do = $this->input->post('do');

        $depo = $this->session->userdata('user_branch');
        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        if ($gudang == '' || $stok == '' || $kendaraan == '' || $pengemudi == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventDist/tambahBkb/' . $pb));
            exit;
        } else {
            $countPb = $this->mInventDist->getCountPb($pb);
            if ($countPb == '0') {
                $array_new = array_count_values($kode);
                $array2 = array();
                foreach ($array_new as $key => $val) {
                    if ($val > 1) { //or do $val >2 based on your desire
                        $array2[] = $key;
                    }
                }

                if (count($array2) != '0') {
                    $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                    header('Location: ' . base_url('sndPb/manualPb'));
                    exit;
                } else {
                    $id = 'BKBDIST' . $depo . 'COU';
                    $bkb = $this->mInventDist->getId($id);
                    // update counter
                    $counter = $this->mInventDist->getCounter($id);
                    $updateCount = array('intLastCounter' => $counter);
                    $whereCount = array('szId' => $id);
                    $counterUpdate = $this->mInventDist->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
                    // $counterUpdateDms = $this->mInventDist->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

                    $updPBStatus = array('pbBkb' => $bkb);
                    $wherePBStatus = array('pbDoc' => $pb);
                    $statusPBUpdate = $this->mInventDist->updateData($wherePBStatus, $updPBStatus, $base . '.mdbapbstatus');

                    if (count($do) != '0') {
                        for ($i = 0; $i < count($do); $i++) {
                            $refBkbDo = array(
                                'bkbDoc' => $bkb,
                                'bkbDO' => $do[$i],
                                'bkbDepo' => $depo,
                                'bkbTanggal' => date('Y-m-d H:i:s')
                            );
                            $referensiBkbDo = $this->mInventDist->simpanData($refBkbDo, $base . '.mdbarefbkbdo');
                        }
                    }

                    $refDoc = array(
                        'refId' => $bkb,
                        'refOld' => $pb,
                        'refTanggal' => $tgl,
                        'refDepo' => $depo,
                        'refDocType' => 'DMSDocStockOutDistribution',
                        'refUserAdd' => $this->session->userdata('user_nik'),
                        'refUserUpdate' => $this->session->userdata('user_nik'),
                        'refDateAdd' => date('Y-m-d H:i:s'),
                        'refDateUpdate' => date('Y-m-d H:i:s')
                    );
                    $referensiDoc = $this->mInventDist->simpanData($refDoc, $base . '.mdbarefdoc');

                    $headerBKB = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $bkb,
                        'dtmDoc' => $tgl,
                        'szEmployeeId' => $pengemudi,
                        'szWarehouseId' => $gudang,
                        'szStockType' => $stok,
                        'szDocPRId' => $pb,
                        'intPrintedCount' => '1',
                        'szBranchId' => $depo,
                        'szCompanyId' => $dept,
                        'szDocStatus' => 'Applied',
                        'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s'),
                        'szDescription' => $keterangan,
                        'szVehicleId' => $kendaraan
                    );
                    $bkbHeader = $this->mInventDist->simpanData($headerBKB, $base . '.dms_inv_docstockoutdistribution');
                    $bkbHeaderDms = $this->mInventDist->simpanDms($headerBKB, 'dms.dms_inv_docstockoutdistribution');

                    $headerPB = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $bkb,
                        'szDocProductRequestId' => $pb
                    );
                    $pbHeader = $this->mInventDist->simpanData($headerPB, $base . '.dms_inv_docstockoutdistributionpr');
                    $pbHeaderDms = $this->mInventDist->simpanDms($headerPB, 'dms.dms_inv_docstockoutdistributionpr');

                    $getProduk = '';
                    // print_r($kode);
                    // echo count($kode);
                    for ($j = 0; $j < count($kode); $j++) {
                        $detBKB = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $bkb,
                            'intItemNumber' => $j,
                            'szProductId' => $kode[$j],
                            'decQty' => $qty[$j],
                            'szUomId' => $satuan[$j]
                        );
                        $bkbDetail = $this->mInventDist->simpanData($detBKB, $base . '.dms_inv_docstockoutdistributionitem');
                        $bkbDetailDms = $this->mInventDist->simpanDms($detBKB, 'dms.dms_inv_docstockoutdistributionitem');

                        $detPB = array(
                            'iId' => $this->uuid->v4(),
                            'szDocId' => $bkb,
                            'szDocProductRequestId' => $pb,
                            'szProductId' => $kode[$j],
                            'decQty' => $qty[$j],
                            'szUomId' => $satuan[$j]
                        );
                        $pbDetail = $this->mInventDist->simpanData($detPB, $base . '.dms_inv_docstockoutdistributionpritem');
                        $pbDetailDms = $this->mInventDist->simpanDms($detPB, 'dms.dms_inv_docstockoutdistributionpritem');

                        $historyGdg = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $kode[$j],
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $depo,
                            'decQtyOnHand' => -$qty[$j],
                            'szUomId' => $satuan[$j],
                            'dtmTransaction' => $tgl,
                            'szTrnId' => 'DMSDocStockOutDistribution',
                            'szDocId' => $bkb,
                            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $gdgHistory = $this->mInventDist->simpanData($historyGdg, $base . '.dms_inv_stockhistory');
                        $gdgHistoryDms = $this->mInventDist->simpanDms($historyGdg, 'dms.dms_inv_stockhistory');

                        $historyDrv = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $kode[$j],
                            'szLocationType' => 'EMPLOYEE',
                            'szLocationId' => $pengemudi,
                            'szStockTypeId' => 'IN TRANSIT',
                            'szReportedAsId' => $depo,
                            'decQtyOnHand' => $qty[$j],
                            'szUomId' => $satuan[$j],
                            'dtmTransaction' => $tgl,
                            'szTrnId' => 'DMSDocStockOutDistribution',
                            'szDocId' => $bkb,
                            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $drvHistory = $this->mInventDist->simpanData($historyDrv, $base . '.dms_inv_stockhistory');
                        $drvHistoryDms = $this->mInventDist->simpanDms($historyDrv, 'dms.dms_inv_stockhistory');

                        $getProduk .= "'" . $kode[$j] . "',";
                        echo $kode[$j];
                    }

                    $cekLen = strlen($getProduk);
                    $product = substr($getProduk, 0, $cekLen - 1);

                    // print_r($product);

                    $OnHandG = $this->mInventDist->stockOnHand($product, $gudang, $stok);
                    // echo "<pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
                    if ($OnHandG != '0') {
                        foreach ($OnHandG as $value) {
                            for ($i = 0; $i < count($kode); $i++) {
                                if ($value->szProductId == $kode[$i]) {
                                    $updOnHandG = array(
                                        'decQtyOnHand' => (int)$value->decQtyOnHand - (int)$qty[$i],
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
                            // echo "<pre> updOnHandG: ".var_export($updOnHandG, true)."</pre>";
                            // echo "<pre> whereOnHandG:".var_export($whereOnHandG, true)."</pre>";
                            $onHandUpdateG = $this->mInventDist->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
                            $onHandUpdateGDms = $this->mInventDist->updateDms($whereOnHandG, $updOnHandG, 'dms.dms_inv_stockonhand');
                        }
                    } else {
                        for ($i = 0; $i < count($kode); $i++) {
                            $onHandGInsert = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $kode[$i],
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $gudang,
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => '0',
                                'szUomId' => $satuan[$i],
                                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $insertOnHandG = $this->mInventDist->simpanData($onHandGInsert, $base . '.dms_inv_stockonhand');
                        }
                    }

                    $OnHandE = $this->mInventDist->stockOnHand($product, $pengemudi, 'IN TRANSIT');
                    // echo "<pre> OnHandE: ".var_export($OnHandE, true)."</pre>";
                    if ($OnHandE != '0') {
                        foreach ($OnHandE as $value) {
                            for ($i = 0; $i < count($kode); $i++) {
                                if ($value->szProductId == $kode[$i]) {
                                    $updOnHandE = array(
                                        'decQtyOnHand' => (int)$value->decQtyOnHand + (int)$qty[$i],
                                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                                    );
                                    $whereOnHandE = array(
                                        'szProductId' => $kode[$i],
                                        'szStockTypeId' => 'IN TRANSIT',
                                        'szReportedAsId' => $this->session->userdata('user_branch'),
                                        'szLocationId' => $pengemudi
                                    );
                                }
                            }
                            // echo "<pre> updOnHandE: ".var_export($updOnHandE, true)."</pre>";
                            // echo "<pre> whereOnHandE:".var_export($whereOnHandE, true)."</pre>";

                            $onHandUpdateE = $this->mInventDist->updateData($whereOnHandE, $updOnHandE, $base . '.dms_inv_stockonhand');
                            $onHandUpdateEDms = $this->mInventDist->updateDms($whereOnHandE, $updOnHandE, 'dms.dms_inv_stockonhand');
                        }
                    } else {
                        for ($i = 0; $i < count($kode); $i++) {
                            $onHandEInsert = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $kode[$i],
                                'szLocationType' => 'EMPLOYEE',
                                'szLocationId' => $pengemudi,
                                'szStockTypeId' => 'IN TRANSIT',
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $qty[$i],
                                'szUomId' => $satuan[$i],
                                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $insertOnHandE = $this->mInventDist->simpanData($onHandEInsert, $base . '.dms_inv_stockonhand');
                        }
                    }

                    if ($counterUpdate == 'true' && $statusPBUpdate == 'true' && $referensiBkbDo == 'true' && $referensiDoc == 'true' && $bkbHeader == 'true' && $pbHeader == 'true' && $bkbDetail == 'true' && $pbDetail == 'true' && $gdgHistory == 'true' && $drvHistory == 'true') {
                        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                        header('Location: ' . base_url('inventDist/historyBkb'));
                        exit;
                    } else {
                        $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                        header('Location: ' . base_url('inventDist/tambahBKB/' . $pb));
                        exit;
                    }
                }
            } else {
                $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
                header('Location: ' . base_url('inventDist/tambahBkb/' . $pb));
                exit;
            }
        }
    }

    function historyBkb()
    {
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mInventDist->getHistoryBkb($tanggal);
        $this->load->view('vBkbDistribusiHistory', $data);
    }

    function tglHistoryBkb()
    {
        $tanggal = $this->input->post('tanggal');
        $data['data'] = $this->mInventDist->getHistoryBkb($tanggal);
        $this->load->view('vBkbDistribusiHistory', $data);
    }

    function editBkb($document)
    {
        $depo = $this->session->userdata('user_branch');
        $id = 'BKBDIST' . $depo . 'COU';
        $data['bkb'] = $this->mInventDist->getId($id);
        $data['bkbAdj'] = $this->mInventDist->getIdAdj($id);

        $data['data'] = $this->mInventDist->editBkb($document);

        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventDist->getId($adjustment);

        $data['gudang'] = $this->mInventDist->getGudang($depo);
        $data['stok'] = $this->mInventDist->getStockType();
        $data['pengemudi'] = $this->mInventDist->getEmployee($depo);
        $data['kendaraan'] = $this->mInventDist->getVehicle($depo);
        $data['produk'] = $this->mInventDist->getProduct();
        $this->load->view('vBkbDistribusiEdit', $data);
    }

    function editBtb($document)
    {
        $depo = $this->session->userdata('user_branch');
        $id = 'BTBDIST' . $depo . 'COU';
        $data['btb'] = $this->mInventDist->getId($id);
        $data['btbAdj'] = $this->mInventDist->getIdAdj($id);

        $data['data'] = $this->mInventDist->editBtb($document);

        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventDist->getId($adjustment);

        $data['gudang'] = $this->mInventDist->getGudang($depo);
        $data['stok'] = $this->mInventDist->getStockType();
        $data['pengemudi'] = $this->mInventDist->getEmployee($depo);
        $data['kendaraan'] = $this->mInventDist->getVehicle($depo);
        $data['produk'] = $this->mInventDist->getProduct();
        $this->load->view('vBtbDistribusiEdit', $data);
    }

    function detailBkb()
    {
        $document = $this->input->post('id');
        $data = $this->mInventDist->editBkb($document);
        echo json_encode($data);
    }

    function cetakBkb($document)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['document'] = $document;
        $data['load'] = $this->mInventDist->editBkb($document);

        // filename dari pdf ketika didownload
        $file_pdf = 'BKB Distribusi ' . $this->session->userdata('user_lokasi') . ' - ' . $document;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('vBkbDistribusiCetak-1', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    function tambahBtb($bkb)
    {
        $depo = $this->session->userdata('user_branch');

        $id = 'BTBDIST' . $depo . 'COU';
        $data['id'] = $this->mInventDist->getId($id);

        $data['warehouse'] = $this->mInventDepot->getWarehouse($depo);
        $data['stock'] = $this->mInventDepot->getStockType();
        $data['product'] = $this->mInventDepot->getProduct();
        $data['employee'] = $this->mInventDepot->getEmployee($depo);
        $data['vehicle'] = $this->mInventDepot->getVehicle($depo);

        $gln = $this->mInventDist->cekBkb($bkb);
        if ($gln == 1) {
            // echo "Gallon";
            $data['data'] = $this->mInventDist->getDataGln($bkb);
            $data['kosongan'] = $this->mInventDist->getDataKsg($bkb);
            $data['bs'] = $this->mInventDist->getDataBs($bkb);
            // echo "<pre>".var_export($data, true)."</pre>";
            $this->load->view('vBtbDistribusiTambah', $data);
        } else {
            echo "Sps";
            $data['data'] = $this->mInventDist->getDataSps($bkb);
            $data['bs'] = $this->mInventDist->getDataBs($bkb);
            $this->load->view('vBtbDistribusiSpsTambah', $data);
            // echo "<pre>".var_export($data, true)."</pre>";
        }
    }

    public function detailBtbDistribusi()
    {
        $document = $this->input->post('id');
        $data = $this->mInventDist->editBtbDistribusi($document);
        echo json_encode($data);
    }

    public function tglHistoryBtbDist()
    {
        $tanggal = $this->input->post('tanggal');
        $data['a'] = $this->mInventDist->getListHistoryBtbDist($tanggal);
        $this->load->view('vBtbDistribusiHistory', $data);
    }

    function simpanHistory()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');

        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $bkb = $this->input->post('bkb');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');
        $cek = $this->input->post('cek');

        $tisuAq = $this->input->post('tisuAq');
        $satuanTisuAq = $this->input->post('satuanTisuAq');
        $qtyTisuAq = $this->input->post('qtyTisuAq');
        $tisuVt = $this->input->post('tisuVt');
        $satuanTisuVt = $this->input->post('satuanTisuVt');
        $qtyTisuVt = $this->input->post('qtyTisuVt');

        $isiAq = $this->input->post('isiAq');
        $satuanIsiAq = $this->input->post('satuanIsiAq');
        $qtyIsiAq = $this->input->post('qtyIsiAq');
        $isiVt = $this->input->post('isiVt');
        $satuanIsiVt = $this->input->post('satuanIsiVt');
        $qtyIsiVt = $this->input->post('qtyIsiVt');

        $ksgAq = $this->input->post('ksgAq');
        $satuanKsgAq = $this->input->post('satuanKsgAq');
        $qtyKsgAq = $this->input->post('qtyKsgAq');
        $ksgVt = $this->input->post('ksgVt');
        $satuanKsgVt = $this->input->post('satuanKsgVt');
        $qtyKsgVt = $this->input->post('qtyKsgVt');

        $id = 'BTBDIST' . $depo . 'COU';
        $btb = $this->mInventDist->getId($id);
        //update counter
        $counter = $this->mInventDist->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mInventDist->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
        // $counterUpdateDms = $this->mInventDist->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        $histDist = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $btb,
            'szDocBkb' => $bkb,
            'dtmDoc' => date('Y-m-d'),
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Draft',
            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => '',
            'szVehicleId' => $kendaraan
        );
        $distHistory = $this->mInventDist->simpanData($histDist, $base . '.mdbahistorydistributionin');

        $histSumTisuAq = array(
            'sumProduk' => $tisuAq,
            'sumQty' => $qtyTisuAq,
            'sumSatuan' => $satuanTisuAq,
            'sumBkb' => $bkb,
            'sumBtb' => $btb
        );
        $aqTisu = $this->mInventDist->simpanData($histSumTisuAq, $base . '.mdbahistorysummary');
        $histSumTisuVt = array(
            'sumProduk' => $tisuVt,
            'sumQty' => $qtyTisuVt,
            'sumSatuan' => $satuanTisuVt,
            'sumBkb' => $bkb,
            'sumBtb' => $btb
        );
        $vtTisu = $this->mInventDepot->simpanData($histSumTisuVt, $base . '.mdbahistorysummary');

        $histSumIsiAq = array(
            'sumProduk' => $isiAq,
            'sumQty' => $qtyIsiAq,
            'sumSatuan' => $satuanIsiAq,
            'sumBkb' => $bkb,
            'sumBtb' => $btb
        );
        $aqIsi = $this->mInventDepot->simpanData($histSumIsiAq, $base . '.mdbahistorysummary');
        $histSumIsiVt = array(
            'sumProduk' => $isiVt,
            'sumQty' => $qtyIsiVt,
            'sumSatuan' => $satuanIsiVt,
            'sumBkb' => $bkb,
            'sumBtb' => $btb
        );
        $vtIsi = $this->mInventDepot->simpanData($histSumIsiVt, $base . '.mdbahistorysummary');

        $histSumKsgAq = array(
            'sumProduk' => $ksgAq,
            'sumQty' => $qtyKsgAq,
            'sumSatuan' => $satuanKsgAq,
            'sumBkb' => $bkb,
            'sumBtb' => $btb
        );
        $aqKsg = $this->mInventDepot->simpanData($histSumKsgAq, $base . '.mdbahistorysummary');
        $histSumKsgVt = array(
            'sumProduk' => $ksgVt,
            'sumQty' => $qtyKsgVt,
            'sumSatuan' => $satuanKsgVt,
            'sumBkb' => $bkb,
            'sumBtb' => $btb
        );
        $vtKsg = $this->mInventDepot->simpanData($histSumKsgVt, $base . '.mdbahistorysummary');

        if ($cek == 1) {
            if (count($this->input->post('ckrBsKode')) != '0') {
                for ($i = 0; $i < count($this->input->post('ckrBsKode')); $i++) {
                    $histBs = array(
                        'mdbaBtb' => $btb,
                        'mdbaBkb' => $bkb,
                        'mdbaProdCkr' => $this->input->post('ckrBsKode')[$i],
                        'mdbaQtyCkr' => $this->input->post('ckrBsQty')[$i],
                        'mdbaProdAdm' => $this->input->post('admBsKode')[$i],
                        'mdbaQtyAdm' => $this->input->post('admBsQty')[$i]
                    );
                    $bsHistory = $this->mInventDepot->simpanData($histBs, $base . '.mdbahistorybs');
                }
            }

            if ($this->input->post('ckrAqSisa') != '0' && $this->input->post('admAqSisa') != '0') {
                $histSisaG = array(
                    'mdbaBtb' => $btb,
                    'mdbaBkb' => $bkb,
                    'mdbaProdCkr' => '74559G',
                    'mdbaQtyCkr' => $this->input->post('ckrAqSisa'),
                    'mdbaProdAdm' => '74559G',
                    'mdbaQtyAdm' => $this->input->post('admAqSisa')
                );
                $sisaHistoryG = $this->mInventDepot->simpanData($histSisaG, $base . '.mdbahistorysisa');

                $histSisa = array(
                    'mdbaBtb' => $btb,
                    'mdbaBkb' => $bkb,
                    'mdbaProdCkr' => '74559',
                    'mdbaQtyCkr' => $this->input->post('ckrAqSisa'),
                    'mdbaProdAdm' => '74559',
                    'mdbaQtyAdm' => $this->input->post('admAqSisa')
                );
                $sisaHistory = $this->mInventDepot->simpanData($histSisa, $base . '.mdbahistorysisa');
            }

            if ($this->input->post('ckrVtSisa') != '0' && $this->input->post('admVtSisa') != '0') {
                $histSisaG = array(
                    'mdbaBtb' => $btb,
                    'mdbaBkb' => $bkb,
                    'mdbaProdCkr' => '74560G',
                    'mdbaQtyCkr' => $this->input->post('ckrVtSisa'),
                    'mdbaProdAdm' => '74560G',
                    'mdbaQtyAdm' => $this->input->post('admVtSisa')
                );
                $sisaHistoryG = $this->mInventDepot->simpanData($histSisaG, $base . '.mdbahistorysisa');

                $histSisa = array(
                    'mdbaBtb' => $btb,
                    'mdbaBkb' => $bkb,
                    'mdbaProdCkr' => '74560',
                    'mdbaQtyCkr' => $this->input->post('ckrVtSisa'),
                    'mdbaProdAdm' => '74560',
                    'mdbaQtyAdm' => $this->input->post('admVtSisa')
                );
                $sisaHistory = $this->mInventDepot->simpanData($histSisa, $base . '.mdbahistorysisa');
            }

            if ($this->input->post('ckrAqJambot') != '0' && $this->input->post('admAqJambot') != '0') {
                $histJambot = array(
                    'mdbaBtb' => $btb,
                    'mdbaBkb' => $bkb,
                    'mdbaProdCkr' => '74559G',
                    'mdbaQtyCkr' => $this->input->post('ckrAqJambot'),
                    'mdbaProdAdm' => '74559G',
                    'mdbaQtyAdm' => $this->input->post('admAqJambot')
                );
                $jambotHistory = $this->mInventDepot->simpanData($histJambot, $base . '.mdbahistoryjambot');
            }

            if ($this->input->post('ckrVtJambot') != '0' && $this->input->post('admVtJambot') != '0') {
                $histJambot = array(
                    'mdbaBtb' => $btb,
                    'mdbaBkb' => $bkb,
                    'mdbaProdCkr' => '74560G',
                    'mdbaQtyCkr' => $this->input->post('ckrVtJambot'),
                    'mdbaProdAdm' => '74560G',
                    'mdbaQtyAdm' => $this->input->post('admVtJambot')
                );
                $jambotHistory = $this->mInventDepot->simpanData($histJambot, $base . '.mdbahistoryjambot');
            }

            if (count($this->input->post('ckrKosKode')) != '0') {
                for ($i = 0; $i < count($this->input->post('ckrKosKode')); $i++) {
                    $histKos = array(
                        'mdbaBtb' => $btb,
                        'mdbaBkb' => $bkb,
                        'mdbaProdCkr' => $this->input->post('ckrKosKode')[$i],
                        'mdbaQtyCkr' => $this->input->post('ckrKosQty')[$i],
                        'mdbaProdAdm' => $this->input->post('admKosKode')[$i],
                        'mdbaQtyAdm' => $this->input->post('admKosQty')[$i]
                    );
                    $kosHistory = $this->mInventDepot->simpanData($histKos, $base . '.mdbahistorykosongan');
                }
            }
        } else {
            if (count($this->input->post('ckrBsKode')) != '0') {
                for ($i = 0; $i < count($this->input->post('ckrBsKode')); $i++) {
                    $histBs = array(
                        'mdbaBtb' => $btb,
                        'mdbaBkb' => $bkb,
                        'mdbaProdCkr' => $this->input->post('ckrBsKode')[$i],
                        'mdbaQtyCkr' => $this->input->post('ckrBsQty')[$i],
                        'mdbaProdAdm' => $this->input->post('admBsKode')[$i],
                        'mdbaQtyAdm' => $this->input->post('admBsQty')[$i]
                    );
                    $bsHistory = $this->mInventDepot->simpanData($histBs, $base . '.mdbahistorybs');
                }
            }

            if (count($this->input->post('ckrSisaKode')) != '0') {
                for ($i = 0; $i < count($this->input->post('ckrSisaKode')); $i++) {
                    $histSisa = array(
                        'mdbaBtb' => $btb,
                        'mdbaBkb' => $bkb,
                        'mdbaProdCkr' => $this->input->post('ckrSisaKode')[$i],
                        'mdbaQtyCkr' => $this->input->post('ckrSisaQty')[$i],
                        'mdbaProdAdm' => $this->input->post('admSisaKode')[$i],
                        'mdbaQtyAdm' => $this->input->post('admSisaQty')[$i]
                    );
                    $sisaHistory = $this->mInventDepot->simpanData($histSisa, $base . '.mdbahistorysisa');
                }
            }
        }

        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
        header('Location: ' . base_url('inventDist/tambahDocBtb/' . $btb));
        exit;
    }

    function simpanHistorySps()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');

        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        $bkb = $this->input->post('bkb');
        $pengemudi = $this->input->post('pengemudi');
        $kendaraan = $this->input->post('kendaraan');
        $gudang = $this->input->post('gudang');
        $stok = $this->input->post('stok');

        $id = 'BTBDIST' . $depo . 'COU';
        $btb = $this->mInventDist->getId($id);
        //update counter
        $counter = $this->mInventDist->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mInventDist->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
        // $counterUpdateDms = $this->mInventDist->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        $histDist = array(
            'iId' => $this->uuid->v4(),
            'szDocId' => $btb,
            'szDocBkb' => $bkb,
            'dtmDoc' => date('Y-m-d'),
            'szEmployeeId' => $pengemudi,
            'szWarehouseId' => $gudang,
            'szStockType' => $stok,
            'intPrintedCount' => '0',
            'szBranchId' => $this->session->userdata('user_branch'),
            'szCompanyId' => $dept,
            'szDocStatus' => 'Draft',
            'szUserCreatedId' => $this->session->userdata('user_nik'),
            'szUserUpdatedId' => $this->session->userdata('user_nik'),
            'dtmCreated' => date('Y-m-d H:i:s'),
            'dtmLastUpdated' => date('Y-m-d H:i:s'),
            'szDescription' => '',
            'szVehicleId' => $kendaraan
        );
        $distHistory = $this->mInventDist->simpanData($histDist, $base . '.mdbahistorydistributionin');

        if ($this->input->post('sisa') != '0') {
            for ($z = 0; $z < $this->input->post('sisa'); $z++) {
                $sum = array(
                    'sumProduk' => $this->input->post('admSisaKode')[$z],
                    'sumQty' => $this->input->post('admSisaQty')[$z],
                    'sumSatuan' => $this->input->post('admSisaSatuan')[$z],
                    'sumBkb' => $bkb,
                    'sumBtb' => $btb
                );
                $summary = $this->mInventDist->simpanData($sum, $base . '.mdbahistorysummary');
                // echo "<pre> summary:" . var_export($sum, true) . "</pre>";

                $sisa = array(
                    'mdbaBtb' => $btb,
                    'mdbaBkb' => $bkb,
                    'mdbaProdCkr' => $this->input->post('ckrSisaKode')[$z],
                    'mdbaQtyCkr' => $this->input->post('ckrSisaQty')[$z],
                    'mdbaProdAdm' => $this->input->post('admSisaKode')[$z],
                    'mdbaQtyAdm' => $this->input->post('admSisaQty')[$z]
                );
                $sisaan = $this->mInventDepot->simpanData($sisa, $base . '.mdbahistorysisa');
                // echo "<pre> sisa:" . var_export($sisa, true) . "</pre>";
            }
        }

        if ($this->input->post('bs') != '0') {
            for ($y = 0; $y < count($this->input->post('admBsKode')); $y++) {
                $bs = array(
                    'mdbaBtb' => $btb,
                    'mdbaBkb' => $bkb,
                    'mdbaProdCkr' => $this->input->post('ckrBsKode')[$y],
                    'mdbaQtyCkr' => $this->input->post('ckrBsQty')[$y],
                    'mdbaProdAdm' => $this->input->post('admBsKode')[$y],
                    'mdbaQtyAdm' => $this->input->post('admBsQty')[$y]
                );
                $bad = $this->mInventDepot->simpanData($bs, $base . '.mdbahistorybs');
                // echo "<pre> bs:" . var_export($bs, true) . "</pre>";
            }
        }

        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
        header('Location: ' . base_url('inventDist/tambahDocBtb/' . $btb));
        exit;
    }

    function tambahDocBtb($btb)
    {
        $depo = $this->session->userdata('user_branch');

        $data['header'] = $this->mInventDist->getDataHeader($btb);
        $data['detail'] = $this->mInventDist->getDataDetail($btb);

        $data['warehouse'] = $this->mInventDepot->getWarehouse($depo);
        $data['stock'] = $this->mInventDepot->getStockType();
        $data['product'] = $this->mInventDepot->getProduct();
        $data['employee'] = $this->mInventDepot->getEmployee($depo);
        $data['vehicle'] = $this->mInventDepot->getVehicle($depo);

        $this->load->view('vBtbDistribusiTambahDoc', $data);
    }

    function manualBtb()
    {
        $depo = $this->session->userdata('user_branch');

        $data['warehouse'] = $this->mInventDist->getGudang($depo);
        $data['stock'] = $this->mInventDist->getStockType();
        $data['employee'] = $this->mInventDist->getEmployee($depo);
        $data['vehicle'] = $this->mInventDist->getVehicle($depo);
        $data['product'] = $this->mInventDist->getProduct();

        $id = 'BTBDIST' . $depo . 'COU';
        $data['btb'] = $this->mInventDist->getId($id);

        $this->load->view('vBtbDistribusiManual', $data);
    }

    function simpanBtbDoc()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'dummymdbaasa';
        } else {
            $base = 'dummymdbatvip';
        }
        $depo = $this->session->userdata('user_branch');

        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        if ($this->input->post('gudang') == '' || $this->input->post('stok') == '' || $this->input->post('kendaraan') == '' || $this->input->post('kendaraan') == '-' || $this->input->post('pengemudi') == '' || $this->input->post('pengemudi') == '-') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventDist/tambahDocBtb/' . $this->input->post('btb')));
            exit;
        } else {
            $array_new = array_count_values($this->input->post('kode'));
            $array2 = array();
            foreach ($array_new as $key => $val) {
                if ($val > 1) { //or do $val >2 based on your desire
                    $array2[] = $key;
                }
            }

            if (count($array2) != '0') {
                $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                header('Location: ' . base_url('inventDist/tambahDocBtb/' . $this->input->post('btb')));
                exit;
            } else {
                $refDocBtb = array(
                    'refId' => $this->input->post('btb'),
                    'refOld' => $this->input->post('bkb'),
                    'refTanggal' => date('Y-m-d'),
                    'refDepo' => $this->session->userdata('user_branch'),
                    'refDocType' => 'DMSDocStockInDistribution',
                    'refUserAdd' => 'mdba-' . $this->session->userdata('user_nik'),
                    'refUserUpdate' => 'mdba-' . $this->session->userdata('user_nik'),
                    'refDateAdd' => date('Y-m-d H:i:s'),
                    'refDateUpdate' => date('Y-m-d H:i:s')
                );
                $btbRefDoc = $this->mInventDist->simpanData($refDocBtb, $base . '.mdbaRefDoc');

                $dmsHeader = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $this->input->post('btb'),
                    'dtmDoc' => $this->input->post('tgl'),
                    'szEmployeeId' => $this->input->post('pengemudi'),
                    'szWarehouseId' => $this->input->post('gudang'),
                    'szStockType' => $this->input->post('stok'),
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s'),
                    'szDescription' => $this->input->post('keterangan'),
                    'szVehicleId' => $this->input->post('kendaraan')
                );
                $headerDms = $this->mInventDist->simpanData($dmsHeader, $base . '.dms_inv_docstockindistribution');
                // $headerDmss = $this->mInventDepot->simpanDms($dmsHeader, 'dms.dms_inv_docstockindistribution');

                $getProduk = '';
                $prodNum = $this->input->post('kode');
                for ($i = 0; $i < count($this->input->post('num')); $i++) {
                    foreach ($prodNum as $index => $row) {
                        if (isset($i)) {
                            $detail = array(
                                'iId' => $this->uuid->v4(),
                                'szDocId' => $this->input->post('btb'),
                                'intItemNumber' => $i,
                                'szProductId' => $this->input->post('kode')[$i],
                                'decQty' => $this->input->post('qty')[$i],
                                'szUomId' => $this->input->post('satuan')[$i]
                            );

                            $stockHistoryDrv = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $this->input->post('kode')[$i],
                                'szLocationType' => 'EMPLOYEE',
                                'szLocationId' => $this->input->post('pengemudi'),
                                'szStockTypeId' => 'IN TRANSIT',
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => -$this->input->post('qty')[$i],
                                'szUomId' => $this->input->post('satuan')[$i],
                                'dtmTransaction' => $this->input->post('tgl'),
                                'szTrnId' => 'DMSDocStockInDistribution',
                                'szDocId' => $this->input->post('btb'),
                                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );

                            $stockHistoryGdg = array(
                                'iId' => $this->uuid->v4(),
                                'szProductId' => $this->input->post('kode')[$i],
                                'szLocationType' => 'WAREHOUSE',
                                'szLocationId' => $this->input->post('gudang'),
                                'szStockTypeId' => $this->input->post('stok'),
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'decQtyOnHand' => $this->input->post('qty')[$i],
                                'szUomId' => $this->input->post('satuan')[$i],
                                'dtmTransaction' => $this->input->post('tgl'),
                                'szTrnId' => 'DMSDocStockInDistribution',
                                'szDocId' => $this->input->post('btb'),
                                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'dtmCreated' => date('Y-m-d H:i:s'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                        }
                    }
                    // echo "<pre>" . var_export($detail, true) . "</pre>";
                    $detailDms = $this->mInventDist->simpanData($detail, $base . '.dms_inv_docstockindistributionItem');
                    // $detailDmss = $this->mInventDist->simpanDms($detail, 'dms.dms_inv_docstockindistributionItem');

                    $driverStockHistory = $this->mInventDist->simpanData($stockHistoryDrv, $base . '.dms_inv_stockhistory');
                    // $driverStockHistoryDms = $this->mInventDepot->simpanDms($stockHistoryDrv, 'dms.dms_inv_stockhistory');

                    $gudangStockHistory = $this->mInventDist->simpanData($stockHistoryGdg, $base . '.dms_inv_stockhistory');
                    // $gudangStockHistoryDms = $this->mInventDepot->simpanDms($stockHistoryGdg, 'dms.dms_inv_stockhistory');

                    $getProduk .= "'" . $this->input->post('kode')[$i] . "',";
                }
                // print_r($getProduk);
                $cekLen = strlen($getProduk);
                $product = substr($getProduk, 0, $cekLen - 1);

                $warehouseG = "'" . $this->input->post('gudang') . "'";
                $stockG = "'" . $this->input->post('stok') . "'";
                $OnHandG = $this->mInventDist->stockOnHand($product, $this->input->post('gudang'), $this->input->post('stok'));
                // echo "<pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
                if ($OnHandG != '0') {
                    foreach ($OnHandG as $value) {
                        for ($i = 0; $i < count($this->input->post('kode')); $i++) {
                            if ($value->szProductId == $this->input->post('kode')[$i]) {
                                $updOnHandG = array(
                                    'decQtyOnHand' => (int)$value->decQtyOnHand + (int)$this->input->post('qty')[$i],
                                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHandG = array(
                                    'szProductId' => $this->input->post('kode')[$i],
                                    'szStockTypeId' => $this->input->post('stok'),
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('gudang')
                                );
                            }
                        }
                        // echo "<pre> updOnHandG: ".var_export($updOnHandG, true)."</pre>";
                        // echo "<pre> whereOnHandG:".var_export($whereOnHandG, true)."</pre>";
                        $onHandUpdateG = $this->mInventDist->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
                        // $onHandUpdateGDms = $this->mInventDist->updateDms($whereOnHandG, $updOnHandG, 'dms.dms_inv_stockonhand');
                    }
                } else {
                    for ($i = 0; $i < count($this->input->post('kode')); $i++) {
                        $onHandGInsert = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $this->input->post('kode')[$i],
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $this->input->post('gudang'),
                            'szStockTypeId' => $this->input->post('stok'),
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $this->input->post('qty')[$i],
                            'szUomId' => $this->input->post('satuan')[$i],
                            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $insertOnHandG = $this->mInventDist->simpanData($onHandGInsert, $base . '.dms_inv_stockonhand');
                    }
                }

                $warehouseE = "'" . $this->input->post('pengemudi') . "'";
                $stockE = "'IN TRANSIT'";
                $OnHandE = $this->mInventDist->stockOnHand($product, $this->input->post('pengemudi'), 'IN TRANSIT');
                // echo "<pre> OnHandE: ".var_export($OnHandE, true)."</pre>";
                if ($OnHandE != '0') {
                    foreach ($OnHandE as $value) {
                        for ($i = 0; $i < count($this->input->post('kode')); $i++) {
                            if ($value->szProductId == $this->input->post('kode')[$i]) {
                                $updOnHandE = array(
                                    'decQtyOnHand' => (int)$value->decQtyOnHand - (int)$this->input->post('qty')[$i],
                                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHandE = array(
                                    'szProductId' => $this->input->post('kode')[$i],
                                    'szStockTypeId' => 'IN TRANSIT',
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('pengemudi'),
                                );
                            }
                        }
                        // echo "<pre> updOnHandE: ".var_export($updOnHandE, true)."</pre>";
                        // echo "<pre> whereOnHandE:".var_export($whereOnHandE, true)."</pre>";

                        $onHandUpdateE = $this->mInventDist->updateData($whereOnHandE, $updOnHandE, $base . '.dms_inv_stockonhand');
                        // $onHandUpdateEDms = $this->mInventDist->updateDms($whereOnHandE, $updOnHandE, 'dms.dms_inv_stockonhand');
                    }
                } else {
                    for ($i = 0; $i < count($this->input->post('kode')); $i++) {
                        $onHandEInsert = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $this->input->post('kode')[$i],
                            'szLocationType' => 'EMPLOYEE',
                            'szLocationId' => $this->input->post('pengemudi'),
                            'szStockTypeId' => 'IN TRANSIT',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => '0',
                            'szUomId' => $this->input->post('satuan')[$i],
                            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $insertOnHandE = $this->mInventDist->simpanData($onHandEInsert, $base . '.dms_inv_stockonhand');
                    }
                }

                if ($btbRefDoc == 'true' || $headerDms == 'true' || $detailDms == 'true' || $driverStockHistory == 'true' || $gudangStockHistory == 'true' || $onHandUpdateG == 'true' || $onHandUpdateE == 'true') {
                    $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                    header('Location: ' . base_url('inventDist/btbDistribusiHistory'));
                    exit;
                }
                else{
                    $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                    header('Location: ' . base_url('home/btbDistribusi'));
                    exit;
                }
            }
        }
    }

    function simpanManual()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $depo = $this->session->userdata('user_branch');

        if ($depo == '321' || $depo == '336' || $depo == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        if ($this->input->post('gudang') == '' || $this->input->post('stok') == '' || $this->input->post('pengemudi') == '' || $this->input->post('pengemudi') == '-' || $this->input->post('kendaraan') == '' || $this->input->post('kendaraan') == '-' || $this->input->post('kode')[0] == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventDist/manualBtb'));
            exit;
        } else {
            $array_new = array_count_values($this->input->post('kode'));
            $array2 = array();
            foreach ($array_new as $key => $val) {
                if ($val > 1) { //or do $val >2 based on your desire
                    $array2[] = $key;
                }
            }

            if (count($array2) != '0') {
                $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                header('Location: ' . base_url('inventDist/manualBtb'));
                exit;
            } else {
                $id = 'BTBDIST' . $depo . 'COU';
                $btb = $this->mInventDist->getId($id);
                //update counter
                $counter = $this->mInventDist->getCounter($id);
                $updateCount = array('intLastCounter' => $counter);
                $whereCount = array('szId' => $id);
                $counterUpdate = $this->mInventDist->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
                $counterUpdateDms = $this->mInventDist->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

                $refDocBtb = array(
                    'refId' => $this->input->post('btb'),
                    'refOld' => $this->input->post('bkb'),
                    'refTanggal' => date('Y-m-d'),
                    'refDepo' => $this->session->userdata('user_branch'),
                    'refDocType' => 'DMSDocStockInDistribution',
                    'refUserAdd' => 'mdba-' . $this->session->userdata('user_nik'),
                    'refUserUpdate' => 'mdba-' . $this->session->userdata('user_nik'),
                    'refDateAdd' => date('Y-m-d H:i:s'),
                    'refDateUpdate' => date('Y-m-d H:i:s')
                );
                $btbRefDoc = $this->mInventDist->simpanData($refDocBtb, $base . '.mdbaRefDoc');

                $dmsHeader = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $this->input->post('btb'),
                    'dtmDoc' => $this->input->post('tgl'),
                    'szEmployeeId' => $this->input->post('pengemudi'),
                    'szWarehouseId' => $this->input->post('gudang'),
                    'szStockType' => $this->input->post('stok'),
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s'),
                    'szDescription' => $this->input->post('keterangan'),
                    'szVehicleId' => $this->input->post('kendaraan')
                );
                $headerDms = $this->mInventDist->simpanData($dmsHeader, $base . '.dms_inv_docstockindistribution');
                $headerDmss = $this->mInventDist->simpanDms($dmsHeader, 'dms.dms_inv_docstockindistribution');

                $getProduk = '';
                for ($i = 0; $i < count($this->input->post('kode')); $i++) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $this->input->post('btb'),
                        'intItemNumber' => $i,
                        'szProductId' => $this->input->post('kode')[$i],
                        'decQty' => $this->input->post('qty')[$i],
                        'szUomId' => $this->input->post('satuan')[$i]
                    );
                    // echo "<pre>" . var_export($detail, true) . "</pre>";
                    $detailDms = $this->mInventDist->simpanData($detail, $base . '.dms_inv_docstockindistributionItem');
                    $detailDmss = $this->mInventDist->simpanDms($detail, 'dms.dms_inv_docstockindistributionItem');

                    $stockHistoryDrv = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $this->input->post('kode')[$i],
                        'szLocationType' => 'EMPLOYEE',
                        'szLocationId' => $this->input->post('pengemudi'),
                        'szStockTypeId' => 'IN TRANSIT',
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => -$this->input->post('qty')[$i],
                        'szUomId' => $this->input->post('satuan')[$i],
                        'dtmTransaction' => $this->input->post('tgl'),
                        'szTrnId' => 'DMSDocStockInDistribution',
                        'szDocId' => $this->input->post('btb'),
                        'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $driverStockHistory = $this->mInventDist->simpanData($stockHistoryDrv, $base . '.dms_inv_stockhistory');
                    $driverStockHistoryDMs = $this->mInventDist->simpanDms($stockHistoryDrv, 'dms.dms_inv_stockhistory');

                    $stockHistoryGdg = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $this->input->post('kode')[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $this->input->post('gudang'),
                        'szStockTypeId' => $this->input->post('stok'),
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $this->input->post('qty')[$i],
                        'szUomId' => $this->input->post('satuan')[$i],
                        'dtmTransaction' => $this->input->post('tgl'),
                        'szTrnId' => 'DMSDocStockInDistribution',
                        'szDocId' => $this->input->post('btb'),
                        'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $gudangStockHistory = $this->mInventDist->simpanData($stockHistoryGdg, $base . '.dms_inv_stockhistory');
                    $gudangStockHistoryDms = $this->mInventDist->simpanDms($stockHistoryGdg, 'dms.dms_inv_stockhistory');



                    // echo "<pre>" . var_export($updOnHandG, true) . "</pre>";
                    // echo "<pre>" . var_export($whereOnHandG, true) . "</pre>";
                    $getProduk .= "'" . $this->input->post('kode')[$i] . "',";
                    // echo $kode[$j];
                }

                $cekLen = strlen($getProduk);
                $product = substr($getProduk, 0, $cekLen - 1);

                $OnHandG = $this->mInventDist->stockOnHand($product, $this->input->post('gudang'), $this->input->post('stok'));
                // echo "<pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
                if ($OnHandG != '0') {
                    foreach ($OnHandG as $value) {
                        for ($i = 0; $i < count($this->input->post('kode')); $i++) {
                            if ($value->szProductId == $this->input->post('kode')[$i]) {
                                $updOnHandG = array(
                                    'decQtyOnHand' => (int)$value->decQtyOnHand + (int)$this->input->post('qty')[$i],
                                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHandG = array(
                                    'szProductId' => $this->input->post('kode')[$i],
                                    'szStockTypeId' => $this->input->post('stok'),
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('gudang')
                                );
                            }
                        }
                        // echo "<pre> updOnHandG: ".var_export($updOnHandG, true)."</pre>";
                        // echo "<pre> whereOnHandG:".var_export($whereOnHandG, true)."</pre>";
                        $onHandUpdateG = $this->mInventDist->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
                        $onHandUpdateGDms = $this->mInventDist->updateDms($whereOnHandG, $updOnHandG, 'dms.dms_inv_stockonhand');
                    }
                } else {
                    for ($i = 0; $i < count($this->input->post('kode')); $i++) {
                        $onHandGInsert = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $this->input->post('kode')[$i],
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $this->input->post('gudang'),
                            'szStockTypeId' => $this->input->post('stok'),
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => $this->input->post('qty')[$i],
                            'szUomId' => $this->input->post('satuan')[$i],
                            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $insertOnHandG = $this->mInventDist->simpanData($onHandGInsert, $base . '.dms_inv_stockonhand');
                    }
                }

                $OnHandE = $this->mInventDist->stockOnHand($product, $this->input->post('pengemudi'), 'IN TRANSIT');
                // echo "<pre> OnHandE: ".var_export($OnHandE, true)."</pre>";
                if ($OnHandE != '0') {
                    foreach ($OnHandE as $value) {
                        for ($i = 0; $i < count($this->input->post('kode')); $i++) {
                            if ($value->szProductId == $this->input->post('kode')[$i]) {
                                $updOnHandE = array(
                                    'decQtyOnHand' => (int)$value->decQtyOnHand - (int)$this->input->post('qty')[$i],
                                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHandE = array(
                                    'szProductId' => $this->input->post('kode')[$i],
                                    'szStockTypeId' => 'IN TRANSIT',
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('pengemudi'),
                                );
                            }
                        }
                        // echo "<pre> updOnHandE: ".var_export($updOnHandE, true)."</pre>";
                        // echo "<pre> whereOnHandE:".var_export($whereOnHandE, true)."</pre>";

                        $onHandUpdateE = $this->mInventDist->updateData($whereOnHandE, $updOnHandE, $base . '.dms_inv_stockonhand');
                        $onHandUpdateEDms = $this->mInventDist->updateDms($whereOnHandE, $updOnHandE, 'dms.dms_inv_stockonhand');
                    }
                } else {
                    for ($i = 0; $i < count($this->input->post('kode')); $i++) {
                        $onHandEInsert = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $this->input->post('kode')[$i],
                            'szLocationType' => 'EMPLOYEE',
                            'szLocationId' => $this->input->post('pengemudi'),
                            'szStockTypeId' => 'IN TRANSIT',
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => '0',
                            'szUomId' => $this->input->post('satuan')[$i],
                            'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $insertOnHandE = $this->mInventDist->simpanData($onHandEInsert, $base . '.dms_inv_stockonhand');
                    }
                }

                if ($counterUpdate == 'true' && $btbRefDoc == 'true' && $headerDms == 'true' && $detailDms == 'true') {
                    $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                    header('Location: ' . base_url('inventori/btbDistribusiHistory'));
                    exit;
                } else {
                    $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                    header('Location: ' . base_url('inventDist/manualBtb'));
                    exit;
                }
            }
        }
    }

    function btbDistribusiHistory()
    {
        $tanggal = date('Y-m-d');
        $data['a'] = $this->mInventDist->getListHistoryBtbDist($tanggal);
        $this->load->view('vBtbDistribusiHistory', $data);
    }

    // BATAS SUCI //
    function updateBkb()
    {
        if ($this->input->post('keterangan') == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventDist/editBkb/' . $this->input->post('bkbOld')));
            exit;
        } else {
            $depo = $this->session->userdata('user_branch');
            if ($depo == '321' || $depo == '336' || $depo == '324') {
                $dept = 'ASA';
                $base = 'dummymdbaasa';
            } else {
                $dept = 'TVIP';
                $base = 'dummymdbatvip';
            }

            // BKB ADJUSTMENT MINUS (LAWAN YANG BENER)
            $id = 'BKBDIST' . $depo . 'COU';
            $bkbCancel = $this->mInventDist->getId($id);
            // update counter
            $counter = $this->mInventDist->getCounter($id);
            $updateCount = array(
                'intLastCounter' => $counter,
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $whereCount = array('szId' => $id);
            $counterUpdate = $this->mInventDist->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
            // $counterUpdateDms = $this->mInventDist->updateDms($whereCount, $updateCount, 'dmstesting.dms_sm_counter');

            $refDocBkb = array(
                'refId' => $bkbCancel,
                'refOld' => $this->input->post('pbOld'),
                'refTanggal' => date('Y-m-d'),
                'refDepo' => $this->session->userdata('user_branch'),
                'refDocType' => 'DMSDocStockOutDistribution',
                'refUserAdd' => $this->session->userdata('user_nik'),
                'refUserUpdate' => $this->session->userdata('user_nik'),
                'refDateAdd' => date('Y-m-d H:i:s'),
                'refDateUpdate' => date('Y-m-d H:i:s')
            );
            // echo "<pre> REFERENSI CANCEL: " . var_export($refDocBkb, true) . "</pre>";
            $bkbRefDoc = $this->mInventDist->simpanData($refDocBkb, $base . '.mdbaRefDoc');

            $headerCancel = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $bkbCancel,
                'dtmDoc' => $this->input->post('tgl'),
                'szEmployeeId' => $this->input->post('adjPengemudi'),
                'szWarehouseId' => $this->input->post('adjGdg'),
                'szStockType' => $this->input->post('adjStok'),
                'szDocPRId' => $this->input->post('pbOld'),
                'intPrintedCount' => 0,
                'szBranchId' => $depo,
                'szCompanyId' => $dept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s'),
                'szDescription' => $this->input->post('keterangan'),
                'szVehicleId' => $this->input->post('adjKendaraan')
            );
            // echo "<pre> HEADER CANCEL: " . var_export($headerCancel, true) . "</pre>";
            $cancelHeader = $this->mInventDist->simpanData($headerCancel, $base . '.dms_inv_docstockoutdistribution');
            // $cancelHeaderDms = $this->mInventDist->simpanDms($headerCancel, 'dmstesting.dms_inv_docstockoutdistribution');

            $prodCancel = '';
            print_r(count($this->input->post('num')));
            for ($i = 0; $i < count($this->input->post('num')); $i++) {
                $detailCancel = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $bkbCancel,
                    'intItemNumber' => $i,
                    'szProductId' => $this->input->post('adjProduk')[$i],
                    'decQty' => -(int)$this->input->post('qty')[$i],
                    'szUomId' => $this->input->post('satuan')[$i],
                );
                // echo "<pre> DETAIL CANCEL : " . var_export($detailCancel, true) . "</pre>";
                $cancelDetail = $this->mInventDist->simpanData($detailCancel, $base . '.dms_inv_docstockoutdistributionitem');
                // $cancelDetailDms = $this->mInventDist->simpanDms($detailCancel, 'dmstesting.dms_inv_docstockoutdistributionitem');

                $historyCancelGdg = array(
                    'iId' => $this->uuid->v4(),
                    'szProductId' => $this->input->post('adjProduk')[$i],
                    'szLocationType' => 'WAREHOUSE',
                    'szLocationId' => $this->input->post('adjGdg'),
                    'szStockTypeId' => $this->input->post('adjStok'),
                    'szReportedAsId' => $this->session->userdata('user_branch'),
                    'decQtyOnHand' => (int)$this->input->post('qty')[$i],
                    'szUomId' => $this->input->post('satuan')[$i],
                    'dtmTransaction' => $this->input->post('tgl'),
                    'szTrnId' => 'DMSDocStockOutDistribution',
                    'szDocId' => $bkbCancel,
                    'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );
                // echo "<pre> HISTORY GUDANG CANCEL: " . var_export($historyCancelGdg, true) . "</pre>";
                $cancelHistoryGdg = $this->mInventDist->simpanData($historyCancelGdg, $base . '.dms_inv_stockhistory');
                // $cancelHistoryGdgDms = $this->mInventDist->simpanDms($historyCancelGdg, 'dmstesting.dms_inv_stockhistory');

                $historyCancelEmp = array(
                    'iId' => $this->uuid->v4(),
                    'szProductId' => $this->input->post('adjProduk')[$i],
                    'szLocationType' => 'EMPLOYEE',
                    'szLocationId' => $this->input->post('adjPengemudi'),
                    'szStockTypeId' => 'IN TRANSIT',
                    'szReportedAsId' => $this->session->userdata('user_branch'),
                    'decQtyOnHand' => -(int)$this->input->post('qty')[$i],
                    'szUomId' => $this->input->post('satuan')[$i],
                    'dtmTransaction' => $this->input->post('tgl'),
                    'szTrnId' => 'DMSDocStockOutDistribution',
                    'szDocId' => $bkbCancel,
                    'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );
                // echo "<pre> HISTORY EMPLOYEE CANCEL: " . var_export($historyCancelEmp, true) . "</pre>";
                $cancelHistoryEmp = $this->mInventDist->simpanData($historyCancelEmp, $base . '.dms_inv_stockhistory');
                // $cancelHistoryEmpDms = $this->mInventDist->simpanDms($historyCancelEmp, 'dmstesting.dms_inv_stockhistory');

                $prodCancel .= "'" . $this->input->post('adjProduk')[$i] . "',";
            }
            $cekProdCancel = strlen($prodCancel);
            $cancelProd = substr($prodCancel, 0, $cekProdCancel - 1);

            $cancelOnHandG = $this->mInventDist->stockOnHand($cancelProd, $this->input->post('adjGdg'), $this->input->post('adjStok'));
            // echo "<pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
            if ($cancelOnHandG != '0') {
                foreach ($cancelOnHandG as $value) {
                    for ($i = 0; $i < count($this->input->post('num')); $i++) {
                        if ($value->szProductId == $this->input->post('adjProduk')[$i]) {
                            $cancelUpdOnHandG = array(
                                'decQtyOnHand' => (int)$value->decQtyOnHand + (int)$this->input->post('qty')[$i],
                                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $cancelWhereOnHandG = array(
                                'szProductId' => $this->input->post('adjProduk')[$i],
                                'szStockTypeId' => $this->input->post('adjStok'),
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'szLocationId' => $this->input->post('adjGdg')
                            );
                        }
                    }
                    // echo "<pre> updOnHandG: ".var_export($cancelUpdOnHandG, true)."</pre>";
                    // echo "<pre> whereOnHandG:".var_export($cancelWhereOnHandG, true)."</pre>";
                    $cancelOnHandUpdateG = $this->mInventDist->updateData($cancelWhereOnHandG, $cancelUpdOnHandG, $base . '.dms_inv_stockonhand');
                    // $cancelOnHandUpdateGDms = $this->mInventDist->updateDms($cancelWhereOnHandG, $cancelUpdOnHandG, 'dmstesting.dms_inv_stockonhand');
                }
            } else {
                for ($i = 0; $i < count($this->input->post('num')); $i++) {
                    $cancelOnHandGInsert = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $this->input->post('adjProduk')[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $this->input->post('adjGdg'),
                        'szStockTypeId' => $this->input->post('adjStok'),
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $this->input->post('qty')[$i],
                        'szUomId' => $this->input->post('satuan')[$i],
                        'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $cancelInsertOnHandG = $this->mInventDist->simpanData($cancelOnHandGInsert, $base . '.dms_inv_stockonhand');
                }
            }

            $cancelOnHandE = $this->mInventDist->stockOnHand($cancelProd, $this->input->post('adjPengemudi'), 'IN TRANSIT');
            // echo "<pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
            if ($cancelOnHandE != '0') {
                foreach ($cancelOnHandE as $value) {
                    for ($i = 0; $i < count($this->input->post('num')); $i++) {
                        if ($value->szProductId == $this->input->post('adjProduk')[$i]) {
                            $cancelUpdOnHandE = array(
                                'decQtyOnHand' => (int)$value->decQtyOnHand - (int)$this->input->post('qty')[$i],
                                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $cancelWhereOnHandE = array(
                                'szProductId' => $this->input->post('adjProduk')[$i],
                                'szStockTypeId' => 'IN TRANSIT',
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'szLocationId' => $this->input->post('adjPengemudi')
                            );
                        }
                    }
                    // echo "<pre> updOnHandG: ".var_export($updOnHandG, true)."</pre>";
                    // echo "<pre> whereOnHandG:".var_export($whereOnHandG, true)."</pre>";
                    $cancelOnHandUpdateE = $this->mInventDist->updateData($cancelWhereOnHandE, $cancelUpdOnHandE, $base . '.dms_inv_stockonhand');
                    // $cancelOnHandUpdateEDms = $this->mInventDist->updateDms($cancelWhereOnHandE, $cancelUpdOnHandE, 'dmstesting.dms_inv_stockonhand');
                }
            } else {
                for ($i = 0; $i < count($this->input->post('num')); $i++) {
                    $cancelOnHandEInsert = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $this->input->post('adjProduk')[$i],
                        'szLocationType' => 'EMPLOYEE',
                        'szLocationId' => $this->input->post('adjPengemudi'),
                        'szStockTypeId' => 'IN TRANSIT',
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => '0',
                        'szUomId' => $this->input->post('satuan')[$i],
                        'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $cancelInsertOnHandE = $this->mInventDist->simpanData($cancelOnHandGInsert, $base . '.dms_inv_stockonhand');
                }
            }

            // ADJUSTMENT
            $idAdj = 'ADJ' . $depo . 'COU';
            $adjNo = $this->mInventDist->getId($idAdj);
            // update counter
            $counterAdj = $this->mInventDist->getCounter($idAdj);
            $updateCountAdj = array(
                'intLastCounter' => $counterAdj,
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $whereCountAdj = array('szId' => $idAdj);
            $counterAdjUpdate = $this->mInventDist->updateData($whereCountAdj, $updateCountAdj, $base . '.dms_sm_counter');
            // $counterAdjUpdateDms = $this->mInventDist->updateDms($whereCountAdj, $updateCountAdj, 'dmstesting.dms_sm_counter');

            $refDocAdj = array(
                'refId' => $adjNo,
                'refOld' => $this->input->post('bkbOld'),
                'refTanggal' => date('Y-m-d'),
                'refDepo' => $this->session->userdata('user_branch'),
                'refDocType' => 'DMSDocStockAdjustment',
                'refUserAdd' => $this->session->userdata('user_nik'),
                'refUserUpdate' => $this->session->userdata('user_nik'),
                'refDateAdd' => date('Y-m-d H:i:s'),
                'refDateUpdate' => date('Y-m-d H:i:s')
            );
            // echo "<pre> REFERENSI ADJUST: " . var_export($refDocAdj, true) . "</pre>";
            $adjRefDoc = $this->mInventDist->simpanData($refDocAdj, $base . '.mdbaRefDoc');

            $adjustmentRefDocument = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjNo,
                'szRefDocId' => $this->input->post('bkbOld'),
                'szRefDocTypeId' => 'DMSDocStockOutDistribution',
                'szAdjustmentId' => $bkbCancel
            );
            // echo "<pre> OnHandG: " . var_export($adjRefDoc, true) . "</pre>";
            $adjustmentRefDoc = $this->mInventDist->simpanData($adjustmentRefDocument, $base.'.dms_inv_stockadjustmentrefdoc');
            // $adjustmentRefDocDms = $this->mInventDist->simpanDms($adjRefDoc, 'dmstesting.dms_inv_stockadjustmentrefdoc');

            $adjustHeader = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjNo,
                'dtmDoc' => $this->input->post('tgl'),
                'szRefTypeDoc' => 'DMSDocStockOutDistribution',
                'szRefDocId' => $this->input->post('bkbOld'),
                'szDescription' => $this->input->post('keterangan'),
                'intPrintedCount' => '0',
                'szBranchId' => $depo,
                'szCompanyId' => $dept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            // echo "<pre> ADJUST HEADER: " . var_export($adjustHeader, true) . "</pre>";
            $headerAdj = $this->mInventDist->simpanData($adjustHeader, $base . '.dms_inv_docstockadjustment');
            // $headerAdjDms = $this->mInventDist->simpanDms($adjustHeader, 'dmstesting.dms_inv_docstockadjustment');

            for ($i = 0; $i < count($this->input->post('num')); $i++) {
                $adjustDetail = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $adjNo,
                    'intItemNumber' => $i,
                    'szProductId' => $this->input->post('adjProduk')[$i],
                    'decQty' => $this->input->post('qty')[$i],
                    'szUomId' => $this->input->post('satuan')[$i],
                );
                // echo "<pre> ADJUST DETAIL: " . var_export($adjustDetail, true) . "</pre>";
                $detailAdj = $this->mInventDist->simpanData($adjustDetail, $base . '.dms_inv_docstockadjustmentitem');
                // $detailAdjDms = $this->mInventDist->simpanDms($adjustDetail, 'dmstesting.dms_inv_docstockadjustmentitem');  
            }

            if ($cancelHeader == 'true' && $cancelDetail == 'true' && $cancelHistoryGdg == 'true' && $cancelHistoryEmp == 'true' && $adjRefDoc == 'true' && $headerAdj == 'true' && $detailAdj == 'true' && $bkbRefDoc == 'true') {
                $this->session->set_flashdata('info', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('inventDist/editBkb/' . $this->input->post('bkbOld')));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventDist/editBkb/' . $this->input->post('bkbOld')));
                exit;
            }
        }
    }

    function updateBtb()
    {
        if ($this->input->post('keterangan') == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventDist/editBtb/' . $this->input->post('btbOld')));
            exit;
        } else {
            $depo = $this->session->userdata('user_branch');
            if ($depo == '321' || $depo == '336' || $depo == '324') {
                $dept = 'ASA';
                $base = 'dummymdbaasa';
            } else {
                $dept = 'TVIP';
                $base = 'dummymdbatvip';
            }

            // BKB ADJUSTMENT MINUS (LAWAN YANG BENER)
            $id = 'BTBDIST' . $depo . 'COU';
            $btbCancel = $this->mInventDist->getId($id);
            // update counter
            $counter = $this->mInventDist->getCounter($id);
            $updateCount = array(
                'intLastCounter' => $counter,
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $whereCount = array('szId' => $id);
            $counterUpdate = $this->mInventDist->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
            // $counterUpdateDms = $this->mInventDist->updateDms($whereCount, $updateCount, 'dmstesting.dms_sm_counter');

            $refDocBkb = array(
                'refId' => $btbCancel,
                'refOld' => $this->input->post('bkbOld'),
                'refTanggal' => date('Y-m-d'),
                'refDepo' => $this->session->userdata('user_branch'),
                'refDocType' => 'DMSDocStockInDistribution',
                'refUserAdd' => $this->session->userdata('user_nik'),
                'refUserUpdate' => $this->session->userdata('user_nik'),
                'refDateAdd' => date('Y-m-d H:i:s'),
                'refDateUpdate' => date('Y-m-d H:i:s')
            );
            // echo "<pre> REFERENSI CANCEL: " . var_export($refDocBkb, true) . "</pre>";
            $bkbRefDoc = $this->mInventDist->simpanData($refDocBkb, $base . '.mdbaRefDoc');

            $headerCancel = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $btbCancel,
                'dtmDoc' => $this->input->post('tgl'),
                'szEmployeeId' => $this->input->post('adjPengemudi'),
                'szWarehouseId' => $this->input->post('adjGdg'),
                'szStockType' => $this->input->post('adjStok'),
                'intPrintedCount' => '0',
                'szBranchId' => $depo,
                'szCompanyId' => $dept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s'),
                'szDescription' => $this->input->post('keterangan'),
                'szVehicleId' => $this->input->post('adjKendaraan')
            );
            $cancelHeader = $this->mInventDist->simpanData($headerCancel, $base . '.dms_inv_docstockindistribution');
            // $cancelHeaderDms = $this->mInventDepot->simpanDms($dmsHeader, 'dmstesting.dms_inv_docstockindistribution');

            $prodCancel = '';
            print_r(count($this->input->post('num')));
            for ($i = 0; $i < count($this->input->post('num')); $i++) {
                $detailCancel = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $btbCancel,
                    'intItemNumber' => $i,
                    'szProductId' => $this->input->post('adjProduk')[$i],
                    'decQty' => -(int)$this->input->post('qty')[$i],
                    'szUomId' => $this->input->post('satuan')[$i],
                );
                // echo "<pre> DETAIL CANCEL : " . var_export($detailCancel, true) . "</pre>";
                $cancelDetail = $this->mInventDist->simpanData($detailCancel, $base . '.dms_inv_docstockindistributionitem');
                // $cancelDetailDms = $this->mInventDist->simpanDms($detailCancel, 'dmstesting.dms_inv_docstockoutdistributionitem');

                $historyCancelGdg = array(
                    'iId' => $this->uuid->v4(),
                    'szProductId' => $this->input->post('adjProduk')[$i],
                    'szLocationType' => 'WAREHOUSE',
                    'szLocationId' => $this->input->post('adjGdg'),
                    'szStockTypeId' => $this->input->post('adjStok'),
                    'szReportedAsId' => $this->session->userdata('user_branch'),
                    'decQtyOnHand' => -(int)$this->input->post('qty')[$i],
                    'szUomId' => $this->input->post('satuan')[$i],
                    'dtmTransaction' => $this->input->post('tgl'),
                    'szTrnId' => 'DMSDocStockInDistribution',
                    'szDocId' => $btbCancel,
                    'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );
                // echo "<pre> HISTORY GUDANG CANCEL: " . var_export($historyCancelGdg, true) . "</pre>";
                $cancelHistoryGdg = $this->mInventDist->simpanData($historyCancelGdg, $base . '.dms_inv_stockhistory');
                // $cancelHistoryGdgDms = $this->mInventDist->simpanDms($historyCancelGdg, 'dmstesting.dms_inv_stockhistory');

                $historyCancelEmp = array(
                    'iId' => $this->uuid->v4(),
                    'szProductId' => $this->input->post('adjProduk')[$i],
                    'szLocationType' => 'EMPLOYEE',
                    'szLocationId' => $this->input->post('adjPengemudi'),
                    'szStockTypeId' => 'IN TRANSIT',
                    'szReportedAsId' => $this->session->userdata('user_branch'),
                    'decQtyOnHand' => (int)$this->input->post('qty')[$i],
                    'szUomId' => $this->input->post('satuan')[$i],
                    'dtmTransaction' => $this->input->post('tgl'),
                    'szTrnId' => 'DMSDocStockInDistribution',
                    'szDocId' => $btbCancel,
                    'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );
                // echo "<pre> HISTORY EMPLOYEE CANCEL: " . var_export($historyCancelEmp, true) . "</pre>";
                $cancelHistoryEmp = $this->mInventDist->simpanData($historyCancelEmp, $base . '.dms_inv_stockhistory');
                // $cancelHistoryEmpDms = $this->mInventDist->simpanDms($historyCancelEmp, 'dmstesting.dms_inv_stockhistory');

                $prodCancel .= "'" . $this->input->post('adjProduk')[$i] . "',";
            }
            $cekProdCancel = strlen($prodCancel);
            $cancelProd = substr($prodCancel, 0, $cekProdCancel - 1);

            $cancelOnHandG = $this->mInventDist->stockOnHand($cancelProd, $this->input->post('adjGdg'), $this->input->post('adjStok'));
            // echo "<pre> cancelOnHandG: " . var_export($cancelOnHandG, true) . "</pre>";
            if ($cancelOnHandG != '0') {
                foreach ($cancelOnHandG as $value) {
                    for ($i = 0; $i < count($this->input->post('num')); $i++) {
                        if ($value->szProductId == $this->input->post('adjProduk')[$i]) {
                            $cancelUpdOnHandG = array(
                                'decQtyOnHand' => (int)$value->decQtyOnHand - (int)$this->input->post('qty')[$i],
                                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $cancelWhereOnHandG = array(
                                'szProductId' => $this->input->post('adjProduk')[$i],
                                'szStockTypeId' => $this->input->post('adjStok'),
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'szLocationId' => $this->input->post('adjGdg')
                            );
                        }
                    
                    }
                    // echo "<pre> updOnHandG: ".var_export($cancelUpdOnHandG, true)."</pre>";
                    // echo "<pre> whereOnHandG:".var_export($cancelWhereOnHandG, true)."</pre>";
                    $cancelOnHandUpdateG = $this->mInventDist->updateData($cancelWhereOnHandG, $cancelUpdOnHandG, $base . '.dms_inv_stockonhand');
                    // $cancelOnHandUpdateGDms = $this->mInventDist->updateDms($cancelWhereOnHandG, $cancelUpdOnHandG, 'dmstesting.dms_inv_stockonhand');
                }
            } else {
                for ($i = 0; $i < count($this->input->post('num')); $i++) {
                    $cancelOnHandGInsert = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $this->input->post('adjProduk')[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $this->input->post('adjGdg'),
                        'szStockTypeId' => $this->input->post('adjStok'),
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => '0',
                        'szUomId' => $this->input->post('satuan')[$i],
                        'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $cancelInsertOnHandG = $this->mInventDist->simpanData($cancelOnHandGInsert, $base . '.dms_inv_stockonhand');
                }
            }

            $cancelOnHandE = $this->mInventDist->stockOnHand($cancelProd, $this->input->post('adjPengemudi'), 'IN TRANSIT');
            // echo "<pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
            if ($cancelOnHandE != '0') {
                foreach ($cancelOnHandE as $value) {
                    for ($i = 0; $i < count($this->input->post('num')); $i++) {
                        if ($value->szProductId == $this->input->post('adjProduk')[$i]) {
                            $cancelUpdOnHandE = array(
                                'decQtyOnHand' => (int)$value->decQtyOnHand + (int)$this->input->post('qty')[$i],
                                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $cancelWhereOnHandE = array(
                                'szProductId' => $this->input->post('adjProduk')[$i],
                                'szStockTypeId' => 'IN TRANSIT',
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'szLocationId' => $this->input->post('adjPengemudi')
                            );
                        }
                    }
                    // echo "<pre> updOnHandG: ".var_export($updOnHandG, true)."</pre>";
                    // echo "<pre> whereOnHandG:".var_export($whereOnHandG, true)."</pre>";
                    $cancelOnHandUpdateE = $this->mInventDist->updateData($cancelWhereOnHandE, $cancelUpdOnHandE, $base . '.dms_inv_stockonhand');
                    // $cancelOnHandUpdateEDms = $this->mInventDist->updateDms($cancelWhereOnHandE, $cancelUpdOnHandE, 'dmstesting.dms_inv_stockonhand');
                }
            } else {
                for ($i = 0; $i < count($this->input->post('num')); $i++) {
                    $cancelOnHandEInsert = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $this->input->post('adjProduk')[$i],
                        'szLocationType' => 'EMPLOYEE',
                        'szLocationId' => $this->input->post('adjPengemudi'),
                        'szStockTypeId' => 'IN TRANSIT',
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $this->input->post('qty')[$i],
                        'szUomId' => $this->input->post('satuan')[$i],
                        'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $cancelInsertOnHandE = $this->mInventDist->simpanData($cancelOnHandGInsert, $base . '.dms_inv_stockonhand');
                }
            }

            // ADJUSTMENT
            $idAdj = 'ADJ' . $depo . 'COU';
            $adjNo = $this->mInventDist->getId($idAdj);
            // update counter
            $counterAdj = $this->mInventDist->getCounter($idAdj);
            $updateCountAdj = array(
                'intLastCounter' => $counterAdj,
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $whereCountAdj = array('szId' => $idAdj);
            $counterAdjUpdate = $this->mInventDist->updateData($whereCountAdj, $updateCountAdj, $base . '.dms_sm_counter');
            // $counterAdjUpdateDms = $this->mInventDist->updateDms($whereCountAdj, $updateCountAdj, 'dmstesting.dms_sm_counter');

            $refDocAdj = array(
                'refId' => $adjNo,
                'refOld' => $this->input->post('btbOld'),
                'refTanggal' => date('Y-m-d'),
                'refDepo' => $this->session->userdata('user_branch'),
                'refDocType' => 'DMSDocStockAdjustment',
                'refUserAdd' => $this->session->userdata('user_nik'),
                'refUserUpdate' => $this->session->userdata('user_nik'),
                'refDateAdd' => date('Y-m-d H:i:s'),
                'refDateUpdate' => date('Y-m-d H:i:s')
            );
            // echo "<pre> REFERENSI ADJUST: " . var_export($refDocAdj, true) . "</pre>";
            $adjRefDoc = $this->mInventDist->simpanData($refDocAdj, $base . '.mdbaRefDoc');

            $adjustmentRefDocument = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjNo,
                'szRefDocId' => $this->input->post('btbOld'),
                'szRefDocTypeId' => 'DMSDocStockInDistribution',
                'szAdjustmentId' => $btbCancel
            );
            // echo "<pre> OnHandG: " . var_export($adjRefDoc, true) . "</pre>";
            $adjustmentRefDoc = $this->mInventDist->simpanData($adjustmentRefDocument, $base.'.dms_inv_stockadjustmentrefdoc');
            // $adjustmentRefDocDms = $this->mInventDist->simpanDms($adjRefDoc, 'dmstesting.dms_inv_stockadjustmentrefdoc');

            $adjustHeader = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjNo,
                'dtmDoc' => $this->input->post('tgl'),
                'szRefTypeDoc' => 'DMSDocStockInDistribution',
                'szRefDocId' => $this->input->post('bkbOld'),
                'szDescription' => $this->input->post('keterangan'),
                'intPrintedCount' => '0',
                'szBranchId' => $depo,
                'szCompanyId' => $dept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'szUserUpdatedId' => 'mdba-' . $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            // echo "<pre> ADJUST HEADER: " . var_export($adjustHeader, true) . "</pre>";
            $headerAdj = $this->mInventDist->simpanData($adjustHeader, $base . '.dms_inv_docstockadjustment');
            // $headerAdjDms = $this->mInventDist->simpanDms($adjustHeader, 'dmstesting.dms_inv_docstockadjustment');

            for ($i = 0; $i < count($this->input->post('num')); $i++) {
                $adjustDetail = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $adjNo,
                    'intItemNumber' => $i,
                    'szProductId' => $this->input->post('adjProduk')[$i],
                    'decQty' => $this->input->post('qty')[$i],
                    'szUomId' => $this->input->post('satuan')[$i],
                );
                // echo "<pre> ADJUST DETAIL: " . var_export($adjustDetail, true) . "</pre>";
                $detailAdj = $this->mInventDist->simpanData($adjustDetail, $base . '.dms_inv_docstockadjustmentitem');
                // $detailAdjDms = $this->mInventDist->simpanDms($adjustDetail, 'dmstesting.dms_inv_docstockadjustmentitem');  
            }

            if ($cancelHeader == 'true' && $cancelDetail == 'true' && $cancelHistoryGdg == 'true' && $cancelHistoryEmp == 'true' && $adjRefDoc == 'true' && $headerAdj == 'true' && $detailAdj == 'true' && $bkbRefDoc == 'true') {
                $this->session->set_flashdata('info', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('inventDist/editBtb/' . $this->input->post('btbOld')));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventDist/editBtb/' . $this->input->post('btbOld')));
                exit;
            }
        }
    }

    function historyAdjBkb()
    {
        $tanggal = date('Y-m-d');
        $data['a'] = $this->mInventDist->getHistoryAdjBkb($tanggal);
        $this->load->view('vAdjBkbDistHistory', $data);
    }

    function tglHistAdjBkb()
    {
        $tanggal = $this->input->post('tanggal');
        $data['a'] = $this->mInventDist->getHistoryAdjBkb($tanggal);
        $this->load->view('vAdjBkbDistHistory', $data);
    }

    function detailBkbAdj()
    {
        $id = $this->input->post('id');
        $data = $this->mInventDist->detailAdj($id);
        echo json_encode($data);
    }

    function historyAdjBtb()
    {
        $tanggal = date('Y-m-d');
        $data['a'] = $this->mInventDist->getHistoryAdjBtb($tanggal);
        $this->load->view('vAdjBtbDistHistory', $data);
    }

    function tglHistAdjBtb()
    {
        $tanggal = $this->input->post('tanggal');
        $data['a'] = $this->mInventDist->getHistoryAdjBtb($tanggal);
        $this->load->view('vAdjBtbDistHistory', $data);
    }

    function detailBtbAdj()
    {
        $id = $this->input->post('id');
        $data = $this->mInventDist->detailAdj($id);
        echo json_encode($data);
    }
}
