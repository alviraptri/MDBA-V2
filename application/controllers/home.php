<?php
class home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model('mHome');
        $this->load->model('mCashierBtu');
    }

    public function index()
    {
        $this->load->view('vHome');
    }

    public function btbSupplier()
    {
        if ($this->session->userdata('user_lokasi') == 'Manis 3') {
            $depo = 'Balaraja';
        } else {
            $depo = $this->session->userdata('user_lokasi');
        }
        $tanggal = date('Y-m-d');
        $noBkb = $this->mHome->getNoBtb($depo, $tanggal);
        // print_r(count($noBkb));
        if (count($noBkb) != 0) {
            $bkb = '';
            foreach ($noBkb as $value) {
                $bkb .= "'" . $value->szRefDocId . "',";
            }
            $cekLen = strlen($bkb);
            $ref = substr($bkb, 0, $cekLen - 1);

            // print_r($ref);

            $data['data'] = $this->mHome->getWiBtb($ref, $depo);
        } else {
            $ref = 0;
            $data['data'] = $this->mHome->getWiBtb($ref, $depo);
        }
        $this->load->view('vBtbSupplierList', $data);
    }

    public function bkbSupplier()
    {
        if ($this->session->userdata('user_lokasi') == 'Manis 3') {
            $depo = 'Balaraja';
        } else {
            $depo = $this->session->userdata('user_lokasi');
        }
        $tanggal = date('Y-m-d');
        $noBkb = $this->mHome->getNoBkb($depo, $tanggal);
        // print_r($noBkb);
        if (count($noBkb) != 0) {
            $bkb = '';
            foreach ($noBkb as $value) {
                $bkb .= "'" . $value->szRefDocId . "',";
            }
            $cekLen = strlen($bkb);
            $ref = substr($bkb, 0, $cekLen - 1);

            $data['data'] = $this->mHome->getWiBkb($ref, $depo);
        } else {
            $ref = 0;
            $data['data'] = $this->mHome->getWiBkb($ref, $depo);
        }
        $this->load->view('vBkbSupplierList', $data);
    }

    function btbSuppList()
    {
        $varian = $this->input->post('varian');
        $transaksi = $this->input->post('transaksi');

        if ($varian == '') {
            $this->session->set_flashdata('error', 'Varian Belum di Pilih');
            header('Location: ' . base_url('home/btbSupplier'));
            exit;
        } else {
            $noBtb = $this->mHome->getNoBtb();
            if (count($noBtb) > 0) {
                $btb = '';
                foreach ($noBtb as $value) {
                    $btb .= "'" . $value->szRef3 . "',";
                }
                $cekLen = strlen($btb);
                $btbNo = substr($btb, 0, $cekLen - 1);

                $data['waterin'] = $this->mHome->getWaterin($btbNo, $varian, $transaksi);
            } else {
                $btbNo = 0;
                $data['waterin'] = $this->mHome->getWaterin($btbNo, $varian, $transaksi);
            }
            $data['gudang'] = $this->mHome->getGudang();
            $data['status'] = 'Draft';
            $this->load->view('vBtbSupplier', $data);
        }
    }

    public function bkbSuppList()
    {
        $varian = $this->input->post('varian');
        $transaksi = $this->input->post('transaksi');

        if ($varian == '') {
            $this->session->set_flashdata('error', 'Varian Belum di Pilih');
            header('Location: ' . base_url('home/bkbSupplier'));
            exit;
        } else {
            $noBkb = $this->mHome->getNoBkb();
            if (count($noBkb) > 0) {
                $bkb = '';
                foreach ($noBkb as $value) {
                    $bkb .= "'" . $value->szRef3 . "',";
                }
                $cekLen = strlen($bkb);
                $bkbNo = substr($bkb, 0, $cekLen - 1);

                $data['waterin'] = $this->mHome->getWaterinBkb($bkbNo, $varian, $transaksi);
            } else {
                $bkbNo = 0;
                $data['waterin'] = $this->mHome->getWaterinBkb($bkbNo, $varian, $transaksi);
            }
            $data['gudang'] = $this->mHome->getGudang();
            $data['status'] = 'Draft';
            $this->load->view('vBkbSupplier', $data);
        }
    }

    function btbDistribusi()
    {
        $cek = $this->mHome->cekDataBtbDist();
        if ($cek != '0') {
            $doc = '';
            foreach ($cek as $value) {
                $doc .= "'" . $value->szDocBkb . "',";
            }
            $cekLenTo = strlen($doc);
            $referensi = substr($doc, 0, $cekLenTo - 1);
        } else {
            $referensi = '0';
        }
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mHome->getBtbDist($referensi, $tanggal);
        $this->load->view('vBtbDistribusiList', $data);
    }

    function btbDistList()
    {
        $varian = $this->input->post('varian');
        if ($varian == '') {
            $this->session->set_flashdata('error', 'Varian Belum di Pilih');
            header('Location: ' . base_url('home/btbDistribusi'));
            exit;
        } else {
            $depo = $this->session->userdata('user_branch');
            $lokasi = $this->session->userdata('user_lokasi');
            $stockTipeId = 'DMSDocStockInDistribution';
            $noBtb = $this->mHome->getRefBtb($depo, $stockTipeId);
            if (count($noBtb) == 0) {
                $btbNo = 0;
                $data['waterout'] = $this->mHome->getWaterout($btbNo, $lokasi, $varian);
            } else {
                $btb = '';
                foreach ($noBtb as $value) {
                    $btb .= "'" . $value->refOld . "',";
                }
                $cekLen = strlen($btb);
                $btbNo = substr($btb, 0, $cekLen - 1);

                $data['waterout'] = $this->mHome->getWaterout($btbNo, $lokasi, $varian);
            }
            $data['gudang'] = $this->mHome->getGudang();
            $data['status'] = 'Draft';
            if ($varian == 'GLN') {
                $this->load->view('vBtbDistribusi', $data);
            } else {
                $this->load->view('vBtbDistribusiSps', $data);
            }
        }
    }

    function stokMorphing()
    {
        $cek = $this->mHome->getCekData();
        if (count($cek) != '0') {
            $doc = '';
            foreach ($cek as $value) {
                $doc .= "'" . $value->refOld . "',";
            }
            $cekLenTo = strlen($doc);
            $referensi = substr($doc, 0, $cekLenTo - 1);
        } else {
            $referensi = '0';
        }
        $data['data'] = $this->mHome->getMorphing($referensi);
        $this->load->view('vMorphingList', $data);
    }

    function btbDepot()
    {
        $cek = $this->mHome->cekDataBtbDepot();
        if ($cek != '0') {
            $doc = '';
            foreach ($cek as $value) {
                $doc .= "'" . $value->refOld . "',";
            }
            $cekLenTo = strlen($doc);
            $referensi = substr($doc, 0, $cekLenTo - 1);
        } else {
            $referensi = '0';
        }
        $data['data'] = $this->mHome->getBtbDepot($referensi);
        $this->load->view('vBtbDepotList', $data);
    }

    function bkbDepot()
    {
        $cek = $this->mHome->cekDataBkbDepot();
        if ($cek != '0') {
            $doc = '';
            foreach ($cek as $value) {
                $doc .= "'" . $value->refOld . "',";
            }
            $cekLenTo = strlen($doc);
            $referensi = substr($doc, 0, $cekLenTo - 1);
        } else {
            $referensi = '0';
        }
        $data['data'] = $this->mHome->getBkbDepot($referensi);
        $this->load->view('vBkbDepotList', $data);
    }

    function permintaanBrg()
    {
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mHome->getPB($tanggal);
        $this->load->view('vPBList', $data);
    }

    function bkbDist()
    {
        $pb = $this->mHome->getNomorPb();
        if (count($pb) != '0') {
            $doc = '';
            foreach ($pb as $value) {
                $doc .= "'" . $value->szDocPRId . "',";
            }
            $cekLenTo = strlen($doc);
            $referensi = substr($doc, 0, $cekLenTo - 1);
        } else {
            $referensi = '0';
        }
        $data['data'] = $this->mHome->getBkbDist($referensi);
        $this->load->view('vBkbDistribusiList', $data);
    }

    function cashierBTU()
    {
        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mHome->getBtuTrans($depo, $tanggal);
        $this->load->view('vBtuList', $data);
    }

    function cashierBKU()
    {
        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mHome->getBkuTrans($depo, $tanggal);
        $this->load->view('vBkuList', $data);
    }

    function cashierAuto()
    {
        $depo = $this->session->userdata('user_branch');
        $data['data'] = $this->mHome->cashierAuto($depo);
        $btu = 'BTU' . $depo . 'COU';
        $data['btu'] = $this->mCashierBtu->getId($btu);
        $this->load->view('vCashierAuto', $data);
    }

    function cashierSettlement()
    {
        $depo = $this->session->userdata('user_branch');
        $data['company'] = $this->mHome->cashierSettlement($depo);
        $this->load->view('vCashierSettlement', $data);
    }

    function sjp()
    {
        $tanggal = date('Y-m-d');
        $depo = $this->session->userdata('user_branch');
        $data['data'] = $this->mHome->getDataSjp($depo, $tanggal);
        $this->load->view('vSJPList', $data);
    }

    function cashierClosing()
    {
        $depo = $this->session->userdata('user_branch');
        $data['company'] = $this->mHome->cashierSettlement($depo);
        $this->load->view('vCashierClosing', $data);
    }

    function inventTbg()
    {
        $tanggal = date('Y-m-d');
        $depo = $this->session->userdata('user_branch');
        $data['data'] = $this->mHome->getDataTBG($depo, $tanggal);
        $this->load->view('vTbgList', $data);
    }

    function bkbDispenser()
    {
        $this->load->view('vDispenserBkbList');
    }

    function btbDispenser()
    {
        $this->load->view('vDispenserBtbList');
    }
}
