<?php
class konversi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model('mKonversi');
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    function getDataDoPPN()
    {
        $tgl = $this->input->post('tgl');
        $ppn = $this->input->post('ppn');

        $result = $this->mKonversi->getDataDoPPN($tgl, $ppn);

        echo json_encode($result);
    }

    function updateDO()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $base = 'dummymdbaasa';
            $name = 'asa';
        } else {
            $base = 'dummymdbatvip';
            $name = 'tvip';
        }

        $tgl = $this->input->post('tanggal');
        $ppn = $this->input->post('ppn');

        if ($ppn == '10%') {
            $taxPpn = '10.0000';
        } else {
            $taxPpn = '11.0000';
        }

        if ($ppn == '') {
            $this->session->set_flashdata('info', 'Mohon Input Data Kembali');
            header('Location: ' . base_url('home/konversiPpnDo'));
            exit;
        } else {
            $result = $this->mKonversi->getDataDoPPN($tgl, $ppn);
            if (sizeof($result) == '0') {
                $this->session->set_flashdata('warning', 'Data Tidak Dapat Ditemukan');
                header('Location: ' . base_url('home/konversiPpnDo'));
                exit;
            } else {
                foreach ($result as $key) {
                    $ppnReal = $key->decTaxRate;
                }

                if ($taxPpn == $ppnReal) {
                    $this->session->set_flashdata('warningg', 'Data Sudah Diubah');
                    header('Location: ' . base_url('home/konversiPpnDo'));
                    exit;
                } else {
                    foreach ($result as $row) {
                        $history = array(
                            'iId' => $row->iId,
                            'szDocId' => $row->szDocId,
                            'intItemNumber' => $row->intItemNumber,
                            'intItemDetailNumber' => $row->intItemDetailNumber,
                            'szPriceId' => $row->szPriceId,
                            'decPrice' => $row->decPrice,
                            'decDiscount' => $row->decDiscount,
                            'bTaxable' => $row->bTaxable,
                            'decAmount' => $row->decAmount,
                            'decTax' => $row->decTax,
                            'decDpp' => $row->decDpp,
                            'szTaxId' => $row->szTaxId,
                            'decTaxRate' => $row->decTaxRate,
                            'decDiscPrinciple' => $row->decDiscPrinciple,
                            'decDiscDistributor' => $row->decDiscDistributor,
                            'decDiscInternal' => $row->decDiscInternal,
                            'userInsert' => 'mdba-' . $this->session->userdata('user_nik'),
                            'userUpdate' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dateInsert' => date('Y-m-d H:i:s'),
                            'dateUpdate' => date('Y-m-d H:i:s')
                        );
                        $saveHistory = $this->mKonversi->simpanData($history, $base . ".mdbahistorykonversidoppn");

                        $updPrice = array(
                            'decTax' => round($row->tax, 4),
                            'decDpp' => round($row->dpp, 4),
                            'decTaxRate' => $taxPpn,
                        );
                        $wherePrice = array(
                            'szDocId' => $row->szDocId,
                            'intItemNumber' => $row->intItemNumber
                        );
                        $priceUpd = $this->mKonversi->updateData($wherePrice, $updPrice, $base . '.dms_sd_docdoitemprice');
                        // $priceDmsUpd = $this->mKonversi->updateDms($wherePrice, $updPrice, 'dmstesting.dms_sd_docdoitemprice');

                        $updData = array(
                            'szUserUpdatedId' => "mdba-" . $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereData = array(
                            'szDocId' => $row->szDocId
                        );
                        $dataUpd = $this->mKonversi->updateData($whereData, $updData, $base . '.dms_sd_docdo');
                        // $dataDmsUpd = $this->mKonversi->updateDms($whereData, $updData, 'dmstesting.dms_sd_docdo');
                        // echo "<pre> UPDATE : " . var_export($updData, true) . "</pre>";
                        // echo "<pre> WHERE : " . var_export($whereData, true) . "</pre>";

                        if ($row->szDocSoId != '') {
                            $historySO = array(
                                'iId' => $row->soIid,
                                'szDocId' => $row->soSzDocId,
                                'szDocDo' => $row->szDocId,
                                'intItemNumber' => $row->soIntItemNumber,
                                'intItemDetailNumber' => $row->soIntItemDetailNumber,
                                'szPriceId' => $row->soSzPriceId,
                                'decPrice' => $row->soDecPrice,
                                'decDiscount' => $row->soDecDiscount,
                                'bTaxable' => $row->soBTaxable,
                                'decAmount' => $row->soDecAmount,
                                'decTax' => $row->soDecTax,
                                'decDpp' => $row->soDecDpp,
                                'szTaxId' => $row->soSzTaxId,
                                'decTaxRate' => $row->soDecTaxRate,
                                'decDiscPrinciple' => $row->soDecDiscPrinciple,
                                'decDiscDistributor' => $row->soDecDiscDistributor,
                                'decDiscInternal' => $row->soDecDiscInternal, 
                            );
                            $saveHistorySo = $this->mKonversi->simpanData($historySO, $base . ".mdbahistorykonversidosoppn");

                            $updPriceSo = array(
                                'decTax' => round($row->taxSO, 4),
                                'decDpp' => round($row->dppSO, 4),
                                'decTaxRate' => $taxPpn,
                            );
                            $wherePriceSo = array(
                                'szDocId' => $row->soSzDocId,
                                'intItemNumber' => $row->soIntItemNumber
                            );
                            $priceSoUpd = $this->mKonversi->updateData($wherePriceSo, $updPriceSo, $base . '.dms_sd_docsoitemprice');
                            // $priceSoDmsUpd = $this->mKonversi->updateDms($wherePriceSo, $updPriceSo, 'dmstesting.dms_sd_docsoitemprice');
    
                            $updDataSo = array(
                                'szUserUpdatedId' => "mdba-" . $this->session->userdata('user_nik'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $whereDataSo = array(
                                'szDocId' => $row->szDocId
                            );
                            $dataSoUpd = $this->mKonversi->updateData($whereDataSo, $updDataSo, $base . '.dms_sd_docso');
                            // $dataSoDmsUpd = $this->mKonversi->updateDms($whereDataSo, $updDataSo, 'dmstesting.dms_sd_docso');
                        }
                    }

                    $invoice = $this->mKonversi->getDataInvoicePPN($tgl, $ppn);
                    // echo "<pre> INVOICE : " . var_export($invoice, true) . "</pre>";
                    foreach ($invoice as $row) {
                        $historyInv = array(
                            'iId' => $row->iId,
                            'szDocId' => $row->szDocId,
                            'szDocDo' => $row->nodo,
                            'intItemNumber' => $row->intItemNumber,
                            'intItemDetailNumber' => $row->intItemDetailNumber,
                            'szPriceId' => $row->szPriceId,
                            'decPrice' => $row->decPrice,
                            'decDiscount' => $row->decDiscount,
                            'bTaxable' => $row->bTaxable,
                            'decAmount' => $row->decAmount,
                            'decTax' => $row->decTax,
                            'decDpp' => $row->decDpp,
                            'szTaxId' => $row->szTaxId,
                            'decTaxRate' => $row->decTaxRate,
                            'decDiscPrinciple' => $row->decDiscPrinciple,
                            'decDiscDistributor' => $row->decDiscDistributor,
                            'decDiscInternal' => $row->decDiscInternal,
                            'userInsert' => 'mdba-' . $this->session->userdata('user_nik'),
                            'userUpdate' => 'mdba-' . $this->session->userdata('user_nik'),
                            'dateInsert' => date('Y-m-d H:i:s'),
                            'dateUpdate' => date('Y-m-d H:i:s')
                        );
                        $saveHistoryInv = $this->mKonversi->simpanData($historyInv, $base . ".mdbahistorykonversidoinvppn");

                        $updPriceInv = array(
                            'decTax' => round($row->tax, 4),
                            'decDpp' => round($row->dpp, 4),
                            'decTaxRate' => $taxPpn,
                        );
                        $wherePriceInv = array(
                            'szDocId' => $row->szDocId,
                            'intItemNumber' => $row->intItemNumber
                        );
                        $priceInvUpd = $this->mKonversi->updateData($wherePriceInv, $updPriceInv, $base . '.dms_sd_docinvoiceitemprice');
                        // $priceInvDmsUpd = $this->mKonversi->updateDms($wherePriceInv, $updPriceInv, 'dmstesting.dms_sd_docinvoiceitemprice');

                        $updDataInv = array(
                            'szUserUpdatedId' => "mdba-" . $this->session->userdata('user_nik'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $whereDataInv = array(
                            'szDocId' => $row->szDocId
                        );
                        $dataInvUpd = $this->mKonversi->updateData($whereDataInv, $updDataInv, $base . '.dms_sd_docinvoice');
                        // $dataInvDmsUpd = $this->mKonversi->updateDms($whereDataInv, $updDataInv, 'dmstesting.dms_sd_docinvoice');
                        // echo "<pre> UPDATE : " . var_export($updData, true) . "</pre>";
                        // echo "<pre> WHERE : " . var_export($whereData, true) . "</pre>";
                    }
                    $this->session->set_flashdata('success', 'Data Berhasil Tersimpan');
                    header('Location: ' . base_url('home/konversiPpnDo'));
                    exit;
                }
            }
        }
    }

    function getDataInvPPN()
    {
        $invoiceTo = $this->input->post('invoiceTo');
        $invoiceFr = $this->input->post('invoiceFr');

        $result = $this->mKonversi->getDataInvPPN($invoiceTo, $invoiceFr);

        echo json_encode($result);
    }

    function updateInvoice()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '324' || $this->session->userdata('user_branch') == '336') {
            $base = 'dummymdbaasa';
            $name = 'asa';
        } else {
            $base = 'dummymdbatvip';
            $name = 'tvip';
        }

        $invoiceFr = $this->input->post('invoiceFr');
        $invoiceTo = $this->input->post('invoiceTo');

        if ($invoiceFr == '' || $invoiceTo == '') {
            $this->session->set_flashdata('info', 'Mohon Input Data Kembali');
            header('Location: ' . base_url('home/konversiInvoice'));
            exit;
        } else {
            $result = $this->mKonversi->getDataInvPPN($invoiceTo, $invoiceFr);

            if (sizeof($result) == '0') {
                $this->session->set_flashdata('warning', 'Data Tidak Dapat Ditemukan');
                header('Location: ' . base_url('home/konversiInvoice'));
                exit;
            } else {
                foreach ($result as $row) {
                    if ($row->decTaxRate == '10.0000') {
                        $rateTax = '11.0000';
                    } else {
                        $rateTax = '10.0000';
                    }

                    $invoice = array(
                        'iId' => $row->iId,
                        'szDocId' => $row->szDocId,
                        'intItemNumber' => $row->intItemNumber,
                        'intItemDetailNumber' => $row->intItemDetailNumber,
                        'szPriceId' => $row->szPriceId,
                        'decPrice' => $row->decPrice,
                        'decDiscount' => $row->decDiscount,
                        'bTaxable' => $row->bTaxable,
                        'decAmount' => $row->decAmount,
                        'decTax' => $row->decTax,
                        'decDpp' => $row->decDpp,
                        'szTaxId' => $row->szTaxId,
                        'decTaxRate' => $row->decTaxRate,
                        'decDiscPrinciple' => $row->decDiscPrinciple,
                        'decDiscDistributor' => $row->decDiscDistributor,
                        'decDiscInternal' => $row->decDiscInternal,
                        'userInsert' => 'mdba-' . $this->session->userdata('user_nik'),
                        'userUpdate' => 'mdba-' . $this->session->userdata('user_nik'),
                        'dateInsert' => date('Y-m-d H:i:s'),
                        'dateUpdate' => date('Y-m-d H:i:s')
                    );
                    $saveInvoice = $this->mKonversi->simpanData($invoice, $base . ".mdbahistorykonversiinvppn");

                    $updPrice = array(
                        'decTax' => round($row->ppn, 4),
                        'decDpp' => round($row->dpp, 4),
                        'decTaxRate' => $rateTax,
                    );
                    $wherePrice = array(
                        'szDocId' => $row->szDocId,
                        'intItemNumber' => $row->intItemNumber
                    );
                    $priceUpd = $this->mKonversi->updateData($wherePrice, $updPrice, $base . '.dms_sd_docinvoiceitemprice');
                    // $priceDmsUpd = $this->mKonversi->updateDms($wherePrice, $updPrice, 'dmstesting.dms_sd_docinvoiceitemprice');

                    $updData = array(
                        'szUserUpdatedId' => "mdba-" . $this->session->userdata('user_nik'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $whereData = array(
                        'szDocId' => $row->szDocId
                    );
                    $dataUpd = $this->mKonversi->updateData($whereData, $updData, $base . '.dms_sd_docinvoice');
                    // $dataDmsUpd = $this->mKonversi->updateDms($whereData, $updData, 'dmstesting.dms_sd_docinvoice');
                }
                $this->session->set_flashdata('success', 'Data Berhasil Tersimpan');
                header('Location: ' . base_url('home/konversiInvoice'));
                exit;
            }
        }
    }
}
