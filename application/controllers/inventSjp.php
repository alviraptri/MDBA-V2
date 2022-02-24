<?php
class inventSjp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model(array('mInventori', 'mHome', 'mInventDepot', 'mMaster', 'mInventDist', 'mSnDPB', 'mInventSjp'));
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    function detail()
    {
        $id = $this->input->post('id');
        $data = $this->mInventSjp->getDetail($id);
        echo json_encode($data);
    }

    function manual()
    {
        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');

        $id = 'COU' . $depo . 'SJ';
        $data['id'] = $this->mInventSjp->getId($id);
        $data['warehouse'] = $this->mInventDist->getGudang($depo);
        $data['type'] = $this->mInventDist->getStockType();
        $data['product'] = $this->mInventDist->getProduct();

        $cust = $this->mInventSjp->getDataCust($depo, $tanggal);
        $customer = '';
        if ($cust != '0') {
            foreach ($cust as $key) {
                $customer .= "'" . $key->szDocDO . "',";
            }
            $lenCust = strlen($customer);
            $referensi = substr($customer, 0, $lenCust - 1);
        } else {
            $referensi = '';
        }
        $data['do'] = $this->mInventSjp->getDataDo($depo, $tanggal, $referensi);
        $this->load->view('vSJPTambah', $data);
    }

    function tglHistory()
    {
        $tanggal = $this->input->post('tanggal');
        $depo = $this->session->userdata('user_branch');
        $data['data'] = $this->mHome->getDataSjp($depo, $tanggal);
        $this->load->view('vSJPList', $data);
    }

    function getDataDo()
    {
        $nodo = $this->input->post('nodo');
        $data = $this->mInventSjp->getDetDo($nodo);
        echo json_encode($data);
    }

    function simpan()
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

        $id = 'COU' . $depo . 'SJ';
        $sjp = $this->mInventSjp->getId($id);
        //update counter
        $counter = $this->mInventSjp->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mInventSjp->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
        $counterUpdateDms = $this->mInventSjp->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        if ($this->input->post('gudang') == '' || $this->input->post('stok') == '' || $this->input->post('do') == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventSjp/manual'));
            exit;
        } else {
            $head = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $sjp,
                'dtmDoc' => $this->input->post('tgl'),
                'szPartyId' => $this->input->post('pelanggan'),
                'szWarehouseId' => $this->input->post('gudang'),
                'szStockType' => $this->input->post('stok'),
                'szDocDO' => $this->input->post('do'),
                'szCarrier' => $this->input->post('ekspedisi'),
                'szVehicle' => $this->input->post('kendaraan'),
                'szDriver' => $this->input->post('pengemudi'),
                'szDescription' => $this->input->post('keterangan'),
                'intPrintedCount' => '0',
                'szBranchId' => $depo,
                'szCompanyId' => $dept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:s')
            );
            $header = $this->mInventSjp->simpanData($head, $base . '.dms_inv_docstockoutcustomer');
            $headerDms = $this->mInventSjp->simpanDms($head, 'dms.dms_inv_docstockoutcustomer');

            $produk = '';
            for ($i = 0; $i < count($this->input->post('produk')); $i++) {
                if ($this->input->post('detStok')[$i] == 'RETUR' || $this->input->post('detStok')[$i] == 'TARIK JAMINAN') {
                    $det = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $sjp,
                        'intItemNumber' => $i,
                        'szProductId' => $this->input->post('produk')[$i],
                        'decQty' => -$this->input->post('qty')[$i],
                        'szUomId' => $this->input->post('satuan')[$i]
                    );
                    $detail = $this->mInventSjp->simpanData($det, $base . '.dms_inv_docstockoutcustomeritem');
                    $detailDms = $this->mInventSjp->simpanDms($det, 'dms.dms_inv_docstockoutcustomeritem');

                    $hist = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $this->input->post('produk')[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $this->input->post('gudang'),
                        'szStockTypeId' => $this->input->post('stok'),
                        'szReportedAsId' => $depo,
                        'decQtyOnHand' => $this->input->post('qty')[$i],
                        'szUomId' => $this->input->post('satuan')[$i],
                        'dtmTransaction' => $this->input->post('tgl'),
                        'szTrnId' => 'DMSDocStockOutCustomer',
                        'szDocId' => $sjp,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $history = $this->mInventSjp->simpanData($hist, $base . '.dms_inv_stockhistory');
                    $historyDms = $this->mInventSjp->simpanDms($hist, 'dms.dms_inv_stockhistory');
                } else {
                    $det = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $sjp,
                        'intItemNumber' => $i,
                        'szProductId' => $this->input->post('produk')[$i],
                        'decQty' => $this->input->post('qty')[$i],
                        'szUomId' => $this->input->post('satuan')[$i]
                    );
                    $detail = $this->mInventSjp->simpanData($det, $base . '.dms_inv_docstockoutcustomeritem');
                    $detailDms = $this->mInventSjp->simpanDms($det, 'dms.dms_inv_docstockoutcustomeritem');

                    $hist = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $this->input->post('produk')[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $this->input->post('gudang'),
                        'szStockTypeId' => $this->input->post('stok'),
                        'szReportedAsId' => $depo,
                        'decQtyOnHand' => -$this->input->post('qty')[$i],
                        'szUomId' => $this->input->post('satuan')[$i],
                        'dtmTransaction' => $this->input->post('tgl'),
                        'szTrnId' => 'DMSDocStockOutCustomer',
                        'szDocId' => $sjp,
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $history = $this->mInventSjp->simpanData($hist, $base . '.dms_inv_stockhistory');
                    $historyDms = $this->mInventSjp->simpanDms($hist, 'dms.dms_inv_stockhistory');
                }

                $produk .= "'" . $this->input->post('produk')[$i] . "',";
            }

            $cekLen = strlen($produk);
            $product = substr($produk, 0, $cekLen - 1);

            // if ($this->input->post('stokDo') == 'RETUR') {
            $OnHandG = $this->mInventDist->stockOnHand($product, $this->input->post('gudang'), $this->input->post('stok'));
            // echo "<pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
            if ($OnHandG != '0') {
                foreach ($OnHandG as $value) {
                    for ($i = 0; $i < count($this->input->post('produk')); $i++) {
                        if ($this->input->post('detStok')[$i] == 'RETUR' || $this->input->post('detStok')[$i] == 'TARIK JAMINAN') {
                            if ($value->szProductId == $this->input->post('produk')[$i]) {
                                $updOnHandG = array(
                                    'decQtyOnHand' => (int)$value->decQtyOnHand + (int)$this->input->post('qty')[$i],
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHandG = array(
                                    'szProductId' => $this->input->post('produk')[$i],
                                    'szStockTypeId' => $this->input->post('stok'),
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('gudang')
                                );
                            }
                        } else {
                            if ($value->szProductId == $this->input->post('produk')[$i]) {
                                $updOnHandG = array(
                                    'decQtyOnHand' => (int)$value->decQtyOnHand - (int)$this->input->post('qty')[$i],
                                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHandG = array(
                                    'szProductId' => $this->input->post('produk')[$i],
                                    'szStockTypeId' => $this->input->post('stok'),
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('gudang')
                                );
                            }
                        }
                    }
                    // echo "<pre> updOnHandG: ".var_export($updOnHandG, true)."</pre>";
                    // echo "<pre> whereOnHandG:".var_export($whereOnHandG, true)."</pre>";
                    $onHandUpdateG = $this->mInventSjp->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
                    $onHandUpdateGDms = $this->mInventSjp->updateDms($whereOnHandG, $updOnHandG, 'dms.dms_inv_stockonhand');
                }
            } else {
                for ($i = 0; $i < count($this->input->post('produk')); $i++) {
                    $onHandGInsert = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $this->input->post('produk')[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $this->input->post('gudang'),
                        'szStockTypeId' => $this->input->post('stok'),
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => '0',
                        'szUomId' => $this->input->post('satuan')[$i],
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $insertOnHandG = $this->mInventSjp->simpanData($onHandGInsert, $base . '.dms_inv_stockonhand');
                }
            }
            // } else {
            //     $OnHandG = $this->mInventDist->stockOnHand($product, $this->input->post('gudang'), $this->input->post('stok'));
            //     // echo "<pre> OnHandG: " . var_export($OnHandG, true) . "</pre>";
            //     if ($OnHandG != '0') {
            //         foreach ($OnHandG as $value) {
            //             for ($i = 0; $i < count($this->input->post('produk')); $i++) {
            //                 if ($value->szProductId == $this->input->post('produk')[$i]) {
            //                     $updOnHandG = array(
            //                         'decQtyOnHand' => (int)$value->decQtyOnHand - (int)$this->input->post('qty')[$i],
            //                         'szUserUpdatedId' => $this->session->userdata('user_nik'),
            //                         'dtmLastUpdated' => date('Y-m-d H:i:s')
            //                     );
            //                     $whereOnHandG = array(
            //                         'szProductId' => $this->input->post('produk')[$i],
            //                         'szStockTypeId' => $this->input->post('stok'),
            //                         'szReportedAsId' => $this->session->userdata('user_branch'),
            //                         'szLocationId' => $this->input->post('gudang')
            //                     );
            //                 }
            //             }
            //             // echo "<pre> updOnHandG: ".var_export($updOnHandG, true)."</pre>";
            //             // echo "<pre> whereOnHandG:".var_export($whereOnHandG, true)."</pre>";
            //             $onHandUpdateG = $this->mInventSjp->updateData($whereOnHandG, $updOnHandG, $base . '.dms_inv_stockonhand');
            //             $onHandUpdateGDms = $this->mInventSjp->updateDms($whereOnHandG, $updOnHandG, 'dms.dms_inv_stockonhand');
            //         }
            //     } else {
            //         for ($i = 0; $i < count($this->input->post('produk')); $i++) {
            //             $onHandGInsert = array(
            //                 'iId' => $this->uuid->v4(),
            //                 'szProductId' => $this->input->post('produk')[$i],
            //                 'szLocationType' => 'WAREHOUSE',
            //                 'szLocationId' => $this->input->post('gudang'),
            //                 'szStockTypeId' => $this->input->post('stok'),
            //                 'szReportedAsId' => $this->session->userdata('user_branch'),
            //                 'decQtyOnHand' => (int)$this->input->post('qty')[$i],
            //                 'szUomId' => $this->input->post('satuan')[$i],
            //                 'szUserCreatedId' => $this->session->userdata('user_nik'),
            //                 'szUserUpdatedId' => $this->session->userdata('user_nik'),
            //                 'dtmCreated' => date('Y-m-d H:i:s'),
            //                 'dtmLastUpdated' => date('Y-m-d H:i:s')
            //             );
            //             $insertOnHandG = $this->mInventSjp->simpanData($onHandGInsert, $base . '.dms_inv_stockonhand');
            //         }
            //     }
            // }

            if ($counterUpdate == 'true' && $header == 'true' && $detail == 'true' && $history == 'true') {
                $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('home/sjp'));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventSjp/manual'));
                exit;
            }
        }
    }
}
