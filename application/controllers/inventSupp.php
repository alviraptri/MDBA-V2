<?php
class inventSupp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') == '') {
            redirect('login');
        }
        $this->load->model(array('mHome', 'mInventDepot', 'mMaster', 'mInventSupp', 'mSnDPB'));
        $this->load->model('mInventDist');
        $this->load->library('uuid');
        date_default_timezone_set('Asia/Jakarta');
    }

    function getProduk()
    {
        $produk = $this->input->post('produk');
        $stok = $this->input->post('stok');
        $gudang = $this->input->post('gudang');
        $data = $this->mInventDist->getProduk($produk, $stok, $gudang);
        echo json_encode($data);
    }

    function tambahBkb($bkb)
    {
        $depo = $this->session->userdata('user_branch');
        $data['data'] = $this->mInventSupp->getBkbWi($bkb);

        $id = 'BKBSUPP' . $depo . 'COU';
        $data['bkb'] = $this->mInventDist->getId($id);
        $data['product'] = $this->mInventDepot->getProduct();

        $varian = $this->mInventSupp->getBkbWi($bkb);
        foreach ($varian as $key) {
            $material = $key->material_nama;
        }

        if ($material == '5 GALLON AQUA LOCAL' || $material == '5 GALLON VIT LOCAL') {
            $this->load->view('vBkbSupplierTambah', $data);
        } else {
            $this->load->view('vBkbSupplierSpsTambah', $data);
        }
    }

    function tambahBtb($bkb)
    {
        $depo = $this->session->userdata('user_branch');

        $data['data'] = $this->mInventSupp->getBtbWi($bkb);
        // echo "SUMMARY : <pre>" . var_export($data, true) . "</pre>";

        $id = 'BTBSUPP' . $depo . 'COU';
        $data['btb'] = $this->mInventSupp->getId($id);

        $varian = $this->mInventSupp->getBtbWi($bkb);
        foreach ($varian as $key) {
            $material = $key->material_nama;
        }

        // print_r($material);

        if ($material == '5 GALLON AQUA LOCAL' || $material == '5 GALLON VIT LOCAL') {
            $cekTk = $this->mInventSupp->getBtbWi($bkb);
            foreach ($cekTk as $value) {
                $dnTk = $value->mk_dn_t;
            }

            if ($dnTk != '0') {
                print_r($dnTk);
                $idTk = 'BTBSUPP' . $depo . 'COU';
                $data['btbTk'] = $this->mInventSupp->getIdTk($idTk);
            }

            $data['product'] = $this->mInventDepot->getProduct();

            $this->load->view('vBtbSupplierTambah', $data);
        }
        else {
            $cekTk = $this->mInventSupp->getBtbWi($bkb);
            foreach ($cekTk as $value) {
                $dnTk = $value->mk_dn_t;
            }

            if ($dnTk != '0') {
                print_r($dnTk);
                $idTk = 'BTBSUPP' . $depo . 'COU';
                $data['btbTk'] = $this->mInventSupp->getIdTk($idTk);
            }

            $data['product'] = $this->mInventDepot->getProduct();

            $this->load->view('vBtbSupplierSpsTambah', $data);
        }
    }

    function simpanHistoryBkb()
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
        $barcode = $this->input->post('barcode');
        $kode = $this->input->post('kode');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');
        $baSummary = $this->input->post('baSummary');
        $row = $this->input->post('row');

        $depo = $this->session->userdata('user_branch');

        $id = 'BKBSUPP' . $depo . 'COU';
        $bkb = $this->mInventSupp->getId($id);
        //update counter
        $counter = $this->mInventSupp->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mInventSupp->updateData($whereCount, $updateCount, $base . '.dms_sm_counter');
        $counterUpdateDms = $this->mInventSupp->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        $mdbaCo = array(
            'coDocument' => $bkb,
            'coType' => 'DMSDocStockOutSupplier',
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
        $co = $this->mInventSupp->simpanData($mdbaCo, $base . '.mdbaCoAdmin');

        $mdbaDn = array(
            'dnDocument' => $bkb,
            'dnType' => 'DMSDocStockOutSupplier',
            'dnNo' => $noDn,
            'dnTanggal' => $tglDnAdm,
            'dnDepo' => $sendDnAdm,
            'dnPabrik' => $pabrikDnAdm,
            'dnNopol' => $nopolDnAdm,
            'dnDriver' => $driverDnAdm,
            'dnProduk' => $produkDnAdm,
            'dnQty' => $qtyDnAdm,
            'dnUserAdd' => $this->session->userdata('user_nik'),
            'dnUserUpdate' => $this->session->userdata('user_nik'),
            'dnTimeAdd' => date('Y-m-d H:i:s'),
            'dnTimeUpdate' => date('Y-m-d H:i:s')
        );
        $dn = $this->mInventSupp->simpanData($mdbaDn, $base . '.mdbaDnAdmin');

        $mdbaPo = array(
            'poDocument' => $bkb,
            'poType' => 'DMSDocStockOutSupplier',
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
        $po = $this->mInventSupp->simpanData($mdbaPo, $base . '.mdbaPoAdmin');

        $mdbaGr = array(
            'grDocument' => $bkb,
            'grType' => 'DMSDocStockOutSupplier',
            'grNo' => $noGr,
            'grDepo' => $sendAdm,
            'grProduk' => $produkGrAdm,
            'grQty' => $qtyGrAdm,
            'grUserAdd' => $this->session->userdata('user_nik'),
            'grUserUpdate' => $this->session->userdata('user_nik'),
            'grTimeAdd' => date('Y-m-d H:i:s'),
            'grTimeUpdate' => date('Y-m-d H:i:s')
        );
        $gr = $this->mInventSupp->simpanData($mdbaGr, $base . '.mdbaGrAdmin');

        // print_r($row);
        for ($i = 0; $i < $row; $i++) {
            if ($kode[$i] != '') {
                $mdbaSmr = array(
                    'sumBkb' => $bkb,
                    'sumKode' => $kode[$i],
                    'sumProduk' => $produk[$i],
                    'sumQty' => $qty[$i],
                    'sumSatuan' => $satuan[$i],
                    'sumUserAdd' => $this->session->userdata('user_nik'),
                    'sumUserUpdate' => $this->session->userdata('user_nik'),
                    'sumTimeAdd' => date('Y-m-d H:i:s'),
                    'sumTimeUpdate' => date('Y-m-d H:i:s')
                );
                // echo "SUMMARY : <pre>" . var_export($mdbaSmr, true) . "</pre>";
                $summary = $this->mInventSupp->simpanData($mdbaSmr, $base . '.mdbawisummaryadmin');
            }
        }

        // if ($baSummary != '') {
        $fileNamaPo =  $_FILES['baSummary']['name'];
        $tmpNamaPo = $_FILES['baSummary']['tmp_name'];
        $tgl = date("d-m-Y");
        $fileUpNamePo = $tgl . "-BASummary-" . $fileNamaPo;
        move_uploaded_file($tmpNamaPo, "assets/upload/" . $fileUpNamePo);

        $uploadBa = array(
            'noDoc' => $bkb,
            'uploadBa' => $fileUpNamePo,
            'noPo' => $noPo,
            'noDn' => $noDn,
            'noGr' => $noGr
        );
        $uploadTrue = $this->mInventSupp->simpanData($uploadBa, $base . '.mdbauploadba');
        // }

        if ($co == 'true' && $dn == 'true' && $po == 'true' && $gr == 'true' && $summary == 'true' && $counterUpdate == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('inventSupp/bkbTambah/' . $bkb));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventSupp/tambahBkb/' . $barcode));
            exit;
        }
    }

    function simpanHistoryBtb()
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
        $barcode = $this->input->post('barcode');
        $kode = $this->input->post('kode');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');
        $baSummary = $this->input->post('baSummary');
        $row = $this->input->post('row');

        //tolakan
        $noDnTk = $this->input->post('noDnTk');
        $produkDnAdmTk = $this->input->post('produkDnAdmTk');
        $qtyDnAdmTk = $this->input->post('qtyDnAdmTk');
        $kodeTk = $this->input->post('kodeTk');
        $produkTk = $this->input->post('produkTk');
        $qtyTk = $this->input->post('qtyTk');
        $satuanTk = $this->input->post('satuanTk');

        $depo = $this->session->userdata('user_branch');

        $id = 'BTBSUPP' . $depo . 'COU';
        $btb = $this->mInventSupp->getId($id);
        // echo $btb;
        //update counter
        $counter = $this->mInventSupp->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mInventSupp->updateData($whereCount, $updateCount, $base.'.dms_sm_counter');
        $counterUpdateDms = $this->mInventSupp->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        $mdbaCo = array(
            'coDocument' => $btb,
            'coType' => 'DMSDocStockInSupplier',
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
        $co = $this->mInventSupp->simpanData($mdbaCo, $base.'.mdbaCoAdmin');

        $mdbaDn = array(
            'dnDocument' => $btb,
            'dnType' => 'DMSDocStockInSupplier',
            'dnNo' => $noDn,
            'dnTanggal' => $tglDnAdm,
            'dnDepo' => $sendDnAdm,
            'dnPabrik' => $pabrikDnAdm,
            'dnNopol' => $nopolDnAdm,
            'dnDriver' => $driverDnAdm,
            'dnProduk' => $produkDnAdm,
            'dnQty' => $qtyDnAdm,
            'dnUserAdd' => $this->session->userdata('user_nik'),
            'dnUserUpdate' => $this->session->userdata('user_nik'),
            'dnTimeAdd' => date('Y-m-d H:i:s'),
            'dnTimeUpdate' => date('Y-m-d H:i:s')
        );
        $dn = $this->mInventSupp->simpanData($mdbaDn, $base.'.mdbaDnAdmin');

        $mdbaPo = array(
            'poDocument' => $btb,
            'poType' => 'DMSDocStockInSupplier',
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
        $po = $this->mInventSupp->simpanData($mdbaPo, $base.'.mdbaPoAdmin');

        $mdbaGr = array(
            'grDocument' => $btb,
            'grType' => 'DMSDocStockInSupplier',
            'grNo' => $noGr,
            'grDepo' => $sendAdm,
            'grProduk' => $produkGrAdm,
            'grQty' => $qtyGrAdm,
            'grUserAdd' => $this->session->userdata('user_nik'),
            'grUserUpdate' => $this->session->userdata('user_nik'),
            'grTimeAdd' => date('Y-m-d H:i:s'),
            'grTimeUpdate' => date('Y-m-d H:i:s')
        );
        $gr = $this->mInventSupp->simpanData($mdbaGr, $base.'.mdbaGrAdmin');

        // print_r($row);
        // print_r($kode);
        for ($i = 0; $i < $row; $i++) {
            if (isset($kode[$i])) {
                $mdbaSmr = array(
                    'sumBkb' => $btb,
                    'sumKode' => $kode[$i],
                    'sumProduk' => $produk[$i],
                    'sumQty' => $qty[$i],
                    'sumSatuan' => $satuan[$i],
                    'sumUserAdd' => $this->session->userdata('user_nik'),
                    'sumUserUpdate' => $this->session->userdata('user_nik'),
                    'sumTimeAdd' => date('Y-m-d H:i:s'),
                    'sumTimeUpdate' => date('Y-m-d H:i:s')
                );
                // echo "SUMMARY : <pre>" . var_export($mdbaSmr, true) . "</pre>";
                $summary = $this->mInventSupp->simpanData($mdbaSmr, $base.'.mdbawisummaryadmin');
            }
        }

        //tolakan
        if ($noDnTk != '0' || $noDnTk != '') {
            $idTk = 'BTBSUPP' . $depo . 'COU';
            $btbTk = $this->mInventSupp->getId($idTk);
            echo $btbTk;
            // update counter
            $counterTk = $this->mInventSupp->getCounter($idTk);
            $updateCountTk = array('intLastCounter' => $counterTk);
            $whereCountTk = array('szId' => $idTk);
            $counterUpdateTk = $this->mInventSupp->updateData($whereCountTk, $updateCountTk, $base.'.dms_sm_counter');
            $counterUpdateTkDms = $this->mInventSupp->updateDms($whereCountTk, $updateCountTk, 'dms.dms_sm_counter');

            $mdbaDnTk = array(
                'dnDocument' => $btbTk,
                'dnType' => 'DMSDocStockInSupplier',
                'dnNo' => $noDn,
                'dnNoTk' => $noDnTk,
                'dnTanggal' => $tglDnAdm,
                'dnDepo' => $sendDnAdm,
                'dnPabrik' => $pabrikDnAdm,
                'dnNopol' => $nopolDnAdm,
                'dnDriver' => $driverDnAdm,
                'dnProduk' => $produkDnAdmTk,
                'dnQty' => $qtyDnAdmTk,
                'dnUserAdd' => $this->session->userdata('user_nik'),
                'dnUserUpdate' => $this->session->userdata('user_nik'),
                'dnTimeAdd' => date('Y-m-d H:i:s'),
                'dnTimeUpdate' => date('Y-m-d H:i:s')
            );
            $dnTk = $this->mInventSupp->simpanData($mdbaDnTk, $base.'.mdbaTolakanAdmin');

            // print_r($kodeTk);

            for ($j = 0; $j < $row; $j++) {
                    if (isset($kodeTk[$j])) {
                        if ($kodeTk[$j] == '41001' || $kodeTk[$j] == '42001' || $kodeTk[$j] == '41013' || $kodeTk[$j] == '41012') {
                        $mdbaSmrTk = array(
                            'sumBkb' => $btbTk,
                            'sumKode' => $kodeTk[$j],
                            'sumProduk' => $produkTk[$j],
                            'sumQty' => $qtyTk[$j],
                            'sumSatuan' => $satuanTk[$j],
                            'sumUserAdd' => $this->session->userdata('user_nik'),
                            'sumUserUpdate' => $this->session->userdata('user_nik'),
                            'sumTimeAdd' => date('Y-m-d H:i:s'),
                            'sumTimeUpdate' => date('Y-m-d H:i:s')
                        );
                        // echo "SUMMARY : <pre>" . var_export($mdbaSmrTk, true) . "</pre>";
                        $summaryTk = $this->mInventSupp->simpanData($mdbaSmrTk, $base.'.mdbawisummaryadmin');
                    }
                }
            }
        }

        // if ($baSummary != '') {
        $fileNamaPo =  $_FILES['baSummary']['name'];
        $tmpNamaPo = $_FILES['baSummary']['tmp_name'];
        $tgl = date("d-m-Y");
        $fileUpNamePo = $tgl . "-BASummary-" . $fileNamaPo;
        move_uploaded_file($tmpNamaPo, "assets/upload/" . $fileUpNamePo);

        if ($fileNamaPo != '') {
            $uploadBa = array(
                'noDoc' => $btb,
                'uploadBa' => $fileUpNamePo,
                'noPo' => $noPo,
                'noDn' => $noDn,
                'noGr' => $noGr
            );
            // echo "upload ba : <pre>" . var_export($uploadBa, true) . "</pre>";
            $uploadTrue = $this->mInventSupp->simpanData($uploadBa, $base.'.mdbauploadba');
        }

        if ($co == 'true' && $dn == 'true' && $po == 'true' && $gr == 'true' && $summary == 'true' && $counterUpdate == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('inventSupp/btbTambah/' . $btb));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventSupp/tambahBtb/' . $barcode));
            exit;
        }
    }

    function simpanHistorySpsBtb()
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
        $barcode = $this->input->post('barcode');
        $kode = $this->input->post('kode');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');
        $baSummary = $this->input->post('baSummary');
        $row = $this->input->post('row');

        //tolakan
        $noDnTk = $this->input->post('noDnTk');
        $produkDnAdmTk = $this->input->post('produkDnAdmTk');
        $qtyDnAdmTk = $this->input->post('qtyDnAdmTk');
        $kodeTk = $this->input->post('kodeTk');
        $produkTk = $this->input->post('produkTk');
        $qtyTk = $this->input->post('qtyTk');
        $satuanTk = $this->input->post('satuanTk');

        $depo = $this->session->userdata('user_branch');

        $id = 'BTBSUPP' . $depo . 'COU';
        $btb = $this->mInventSupp->getId($id);
        //update counter
        $counter = $this->mInventSupp->getCounter($id);
        $updateCount = array('intLastCounter' => $counter);
        $whereCount = array('szId' => $id);
        $counterUpdate = $this->mInventSupp->updateData($whereCount, $updateCount, $base.'.dms_sm_counter');
        $counterUpdateDms = $this->mInventSupp->updateDms($whereCount, $updateCount, 'dms.dms_sm_counter');

        $mdbaCo = array(
            'coDocument' => $btb,
            'coType' => 'DMSDocStockInSupplier',
            'coNo' => $noCo,
            'coHari' => $hariAdm,
            'coTgl' => $tglWindowAdm,
            'coPabrik' => $pabrikWindowAdm,
            'coProduk' => $materialAdm,
            'coTujuanAwal' => $tujuanAwalAdm,
            'coTujuanFinal' => $tujuanFinalAdm,
            'coTujuan' => $tujuanCoAdm,
            'coUserAdd' => 'mdba-'.$this->session->userdata('user_nik'),
            'coUserUpdate' => 'mdba-'.$this->session->userdata('user_nik'),
            'coTimeAdd' => date('Y-m-d H:i:s'),
            'coTimeUpdate' => date('Y-m-d H:i:s')
        );
        $co = $this->mInventSupp->simpanData($mdbaCo, $base.'.mdbaCoAdmin');

        $mdbaDn = array(
            'dnDocument' => $btb,
            'dnType' => 'DMSDocStockInSupplier',
            'dnNo' => $noDn,
            'dnTanggal' => $tglDnAdm,
            'dnDepo' => $sendDnAdm,
            'dnPabrik' => $pabrikDnAdm,
            'dnNopol' => $nopolDnAdm,
            'dnDriver' => $driverDnAdm,
            'dnProduk' => $produkDnAdm,
            'dnQty' => $qtyDnAdm,
            'dnUserAdd' => 'mdba-'.$this->session->userdata('user_nik'),
            'dnUserUpdate' => 'mdba-'.$this->session->userdata('user_nik'),
            'dnTimeAdd' => date('Y-m-d H:i:s'),
            'dnTimeUpdate' => date('Y-m-d H:i:s')
        );
        $dn = $this->mInventSupp->simpanData($mdbaDn, $base.'.mdbaDnAdmin');

        $mdbaPo = array(
            'poDocument' => $btb,
            'poType' => 'DMSDocStockInSupplier',
            'poNo' => $noPo,
            'poReturnIsi' => $returnIsiAdm,
            'poJugrack' => $jugrackAdm,
            'poGlnKosong' => $glnKosongAdm,
            'poPalet' => $paletAdm,
            'poNopol' => $nopolAdm,
            'poSupir' => $driverAdm,
            'poSupirPengganti' => $driver2Adm,
            'poTransporter' => $transporterAdm,
            'poUserAdd' => 'mdba-'.$this->session->userdata('user_nik'),
            'poUserUpdate' => 'mdba-'.$this->session->userdata('user_nik'),
            'poTimeAdd' => date('Y-m-d H:i:s'),
            'poTimeUpdate' => date('Y-m-d H:i:s')
        );
        $po = $this->mInventSupp->simpanData($mdbaPo, $base.'.mdbaPoAdmin');

        $mdbaGr = array(
            'grDocument' => $btb,
            'grType' => 'DMSDocStockInSupplier',
            'grNo' => $noGr,
            'grDepo' => $sendAdm,
            'grProduk' => $produkGrAdm,
            'grQty' => $qtyGrAdm,
            'grUserAdd' => 'mdba-'.$this->session->userdata('user_nik'),
            'grUserUpdate' => 'mdba-'.$this->session->userdata('user_nik'),
            'grTimeAdd' => date('Y-m-d H:i:s'),
            'grTimeUpdate' => date('Y-m-d H:i:s')
        );
        $gr = $this->mInventSupp->simpanData($mdbaGr, $base.'.mdbaGrAdmin');

        // print_r($row);
        // print_r($kode);
        for ($i = 0; $i < $row; $i++) {
            if (isset($kode[$i])) {
                $mdbaSmr = array(
                    'sumBkb' => $btb,
                    'sumKode' => $kode[$i],
                    'sumProduk' => $produk[$i],
                    'sumQty' => $qty[$i],
                    'sumSatuan' => $satuan[$i],
                    'sumUserAdd' => 'mdba-'.$this->session->userdata('user_nik'),
                    'sumUserUpdate' => 'mdba-'.$this->session->userdata('user_nik'),
                    'sumTimeAdd' => date('Y-m-d H:i:s'),
                    'sumTimeUpdate' => date('Y-m-d H:i:s')
                );
                // echo "SUMMARY : <pre>" . var_export($mdbaSmr, true) . "</pre>";
                $summary = $this->mInventSupp->simpanData($mdbaSmr, $base.'.mdbawisummaryadmin');
            }

            // if ($kode[$i] == '') {
            //     $mdbaSmr = array(
            //         'sumBkb' => '',
            //         'sumKode' => '',
            //         'sumProduk' => '',
            //         'sumQty' => '',
            //         'sumSatuan' => '',
            //         'sumUserAdd' => '',
            //         'sumUserUpdate' => '',
            //         'sumTimeAdd' => '',
            //         'sumTimeUpdate' => ''
            //     );
            // echo "SUMMARY : <pre>" . var_export($mdbaSmr, true) . "</pre>";
            // $summary = $this->mInventSupp->simpanData($mdbaSmr, $base.'.mdbawisummaryadmin');
            // }
        }

        // if ($baSummary != '') {
        $fileNamaPo =  $_FILES['baSummary']['name'];
        $tmpNamaPo = $_FILES['baSummary']['tmp_name'];
        $tgl = date("d-m-Y");
        $fileUpNamePo = $tgl . "-BASummary-" . $fileNamaPo;
        move_uploaded_file($tmpNamaPo, "assets/upload/" . $fileUpNamePo);

        if ($fileNamaPo != '') {
            $uploadBa = array(
                'noDoc' => $btb,
                'uploadBa' => $fileUpNamePo,
                'noPo' => $noPo,
                'noDn' => $noDn,
                'noGr' => $noGr
            );
            // echo "upload ba : <pre>" . var_export($uploadBa, true) . "</pre>";
            $uploadTrue = $this->mInventSupp->simpanData($uploadBa, $base.'.mdbauploadba');
        }

        // }

        if ($co == 'true' && $dn == 'true' && $po == 'true' && $gr == 'true' && $summary == 'true' && $counterUpdate == 'true') {
            $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
            header('Location: ' . base_url('inventSupp/btbTambah/' . $btb));
            exit;
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            header('Location: ' . base_url('inventSupp/tambahBtb/' . $barcode));
            exit;
        }
    }

    function bkbTambah($bkb)
    {
        $depo = $this->session->userdata('user_branch');
        $data['data'] = $this->mInventSupp->getDataBkB($bkb);
        $data['supplier'] = $this->mInventSupp->getSupplier();
        $data['warehouse'] = $this->mInventSupp->getWarehouse($depo);
        $data['stock'] = $this->mInventSupp->getStockType();
        $data['carrier'] = $this->mInventSupp->getCarrier();
        $data['vehicle'] = $this->mInventSupp->getVehicle();
        $data['employee'] = $this->mInventSupp->getDriver();
        $data['product'] = $this->mSnDPB->getProduct();

        $this->load->view('vBkbSupplierCreate', $data);
    }

    function btbTambah($btb)
    {
        $depo = $this->session->userdata('user_branch');
        $data['data'] = $this->mInventSupp->getDataBtB($btb);
        $data['supplier'] = $this->mInventSupp->getSupplier();
        $data['warehouse'] = $this->mInventSupp->getWarehouse($depo);
        $data['stock'] = $this->mInventSupp->getStockType();
        $data['carrier'] = $this->mInventSupp->getCarrier();
        $data['vehicle'] = $this->mInventSupp->getVehicle();
        $data['employee'] = $this->mInventSupp->getDriver();
        $data['product'] = $this->mInventSupp->getProduct();

        $this->load->view('vBtbSupplierCreate', $data);
    }

    function btbTolakan($btb)
    {
        $depo = $this->session->userdata('user_branch');
        $data['data'] = $this->mInventSupp->getDataBtbTk($btb);
        $data['supplier'] = $this->mInventSupp->getSupplier();
        $data['warehouse'] = $this->mInventSupp->getWarehouse($depo);
        $data['stock'] = $this->mInventSupp->getStockType();
        $data['carrier'] = $this->mInventSupp->getCarrier();
        $data['vehicle'] = $this->mInventSupp->getVehicle();
        $data['employee'] = $this->mInventSupp->getDriver();
        $data['product'] = $this->mInventSupp->getProduct();

        $this->load->view('vBtbSupplierTolakan', $data);
    }

    function simpanBkb()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $bkb = $this->input->post('bkb');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang'); //validation
        $stok = $this->input->post('stok'); //validation
        $supplier = $this->input->post('supplier'); //validation
        $carrier = $this->input->post('carrier'); //validation
        $pengemudi = $this->input->post('pengemudi'); //validation
        $namaPengemudi = $this->input->post('namaPengemudi');
        $kendaraan = $this->input->post('kendaraan'); //validation
        $namaKendaraan = $this->input->post('namaKendaraan');
        $noSj = $this->input->post('noSj');
        $tglSj = $this->input->post('tglSj');
        $noRef1 = $this->input->post('noRef1');
        $noRef2 = $this->input->post('noRef2');
        $noRef3 = $this->input->post('noRef3');
        $shift = $this->input->post('shift');
        $kuli = $this->input->post('kuli');
        $keterangan = $this->input->post('keterangan');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        if ($gudang == '' || $stok == '' || $supplier == '' || $carrier == '' || $pengemudi == '' || $kendaraan == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventSupp/bkbTambah/' . $bkb));
            exit;
        } else {
            $array_new = array_count_values($this->input->post('produk'));
            $array2 = array();
            foreach ($array_new as $key => $val) {
                if ($val > 1) { //or do $val >2 based on your desire
                    $array2[] = $key;
                }
            }

            if (count($array2) != '0') {
                $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                header('Location: ' . base_url('inventSupp/bkbTambah/' . $bkb));
                exit;
            } else {
                $refDoc = array(
                    'refId' => $bkb,
                    'refOld' => $noSj,
                    'refTanggal' => $tgl,
                    'refDepo' => $this->session->userdata('user_branch'),
                    'refDocType' => 'DMSDocStockOutSupplier',
                    'refUserAdd' => 'mdba-'.$this->session->userdata('user_nik'),
                    'refUserUpdate' => 'mdba-'.$this->session->userdata('user_nik'),
                    'refDateAdd' => date('Y-m-d H:i:s'),
                    'refDateUpdate' => date('Y-m-d H:i:s')
                );
                $referensi = $this->mInventSupp->simpanData($refDoc, $base . '.mdbaRefDoc');
                // echo "<pre> Referensi: ".var_export($refDoc, true)."</pre>";

                $headerBkb = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $bkb,
                    'dtmDoc' => $tgl,
                    'szSupplierId' => $supplier,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'szRefDocId' => $noSj,
                    'dtmDn' => $tglSj,
                    'szCarrierId' => $carrier,
                    'szVehicle' => $kendaraan,
                    'szDriver' => $pengemudi,
                    'szVehicle2' => $namaKendaraan,
                    'szDriver2' => $namaPengemudi,
                    'szRef1' => $noRef1,
                    'szRef2' => $noRef2,
                    'szRef3' => $noRef3,
                    'intShift' => $shift,
                    'intHelperCount' => $kuli,
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:S'),
                    'szDescription' => $keterangan
                );
                $bkbHeader = $this->mInventSupp->simpanData($headerBkb, $base . '.dms_inv_docstockoutsupplier');
                $headerBkb = $this->mInventSupp->simpanDms($headerBkb, 'dms.dms_inv_docstockoutsupplier');
                // echo "<pre> Header: ".var_export($header, true)."</pre>";

                $prod = '';
                for ($i = 0; $i < count($produk); $i++) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $bkb,
                        'intItemNumber' => $i,
                        'szProductId' => $produk[$i],
                        'decQty' => $qty[$i],
                        'szUomId' => $satuan[$i]
                    );
                    $bkbDetail = $this->mInventSupp->simpanData($detail, $base . '.dms_inv_docstockoutsupplieritem');
                    $detailBkb = $this->mInventSupp->simpanDms($detail, 'dms.dms_inv_docstockoutsupplieritem');
                    // echo "<pre> Detail: ".var_export($detail, true)."</pre>";

                    $history = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $produk[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => -$qty[$i],
                        'szUomId' => $satuan[$i],
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockOutSupplier',
                        'szDocId' => $bkb,
                        'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $bkbHistory = $this->mInventSupp->simpanData($history, $base . '.dms_inv_stockHistory');
                    $historyBkb = $this->mInventSupp->simpanDms($history, 'dms.dms_inv_stockHistory');
                    // echo "<pre> History: ".var_export($history, true)."</pre>";

                    $prod .= "'" . $produk[$i] . "',";
                }
                $prodLen = strlen($prod);
                $fixProd = substr($prod, 0, $prodLen - 1);

                $sOnHand = $this->mInventDist->stockOnHand($fixProd, $gudang, $stok);
                if ($sOnHand != '0') {
                    foreach ($sOnHand as $key) {
                        for ($j = 0; $j < count($produk); $j++) {
                            if ($key->szProductId == $produk[$j]) {
                                $updOnHand = array(
                                    'decQtyOnHand' => (int)$key->decQtyOnHand - (int)$qty[$j],
                                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHand = array(
                                    'szProductId' => $produk[$j],
                                    'szStockTypeId' => $this->input->post('stok'),
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('gudang')
                                );
                            }
                        }
                        $bkbOnHand = $this->mInventSupp->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $onHandBkb = $this->mInventSupp->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');
                    }
                } else {
                    for ($k = 0; $k < count($produk); $k++) {
                        $onHand = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $produk[$k],
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => '0',
                            'szUomId' => $satuan[$k],
                            'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $insertOnHand = $this->mInventSupp->simpanData($onHand, $base . '.dms_inv_stockonhand');
                    }
                }

                if ($referensi == 'true' && $bkbHeader == 'true' && $bkbDetail == 'true' && $bkbHistory == 'true' && $bkbOnHand == 'true') {
                    $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                    header('Location: ' . base_url('home/bkbSupplier'));
                    exit;
                } else {
                    $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                    header('Location: ' . base_url('inventSupp/bkbTambah/' . $bkb));
                    exit;
                }
            }
        }
    }

    function simpanBtb()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $btb = $this->input->post('btb');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang'); //validation
        $stok = $this->input->post('stok'); //validation
        $supplier = $this->input->post('supplier'); //validation
        $carrier = $this->input->post('carrier'); //validation
        $pengemudi = $this->input->post('pengemudi'); //validation
        $namaPengemudi = $this->input->post('namaPengemudi');
        $kendaraan = $this->input->post('kendaraan'); //validation
        $namaKendaraan = $this->input->post('namaKendaraan');
        $noSj = $this->input->post('noSj');
        $tglSj = $this->input->post('tglSj');
        $noRef1 = $this->input->post('noRef1');
        $noRef2 = $this->input->post('noRef2');
        $noRef3 = $this->input->post('noRef3');
        $shift = $this->input->post('shift');
        $kuli = $this->input->post('kuli');
        $keterangan = $this->input->post('keterangan');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');

        $btbTk = $this->input->post('btbTk');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        if ($gudang == '' || $stok == '' || $supplier == '' || $carrier == '' || $pengemudi == '' || $kendaraan == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventSupp/btbTambah/' . $btb));
            exit;
        } else {
            $array_new = array_count_values($this->input->post('produk'));
            $array2 = array();
            foreach ($array_new as $key => $val) {
                if ($val > 1) { //or do $val >2 based on your desire
                    $array2[] = $key;
                }
            }

            if (count($array2) != '0') {
                $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                header('Location: ' . base_url('inventSupp/btbTambah/' . $btb));
                exit;
            } else {
                $refDoc = array(
                    'refId' => $btb,
                    'refOld' => $noSj,
                    'refTanggal' => $tgl,
                    'refDepo' => $this->session->userdata('user_branch'),
                    'refDocType' => 'DMSDocStockInSupplier',
                    'refUserAdd' => 'mdba-'.$this->session->userdata('user_nik'),
                    'refUserUpdate' => 'mdba-'.$this->session->userdata('user_nik'),
                    'refDateAdd' => date('Y-m-d H:i:s'),
                    'refDateUpdate' => date('Y-m-d H:i:s')
                );
                $referensi = $this->mInventSupp->simpanData($refDoc, $base.'.mdbaRefDoc');
                // echo "<pre> Referensi: ".var_export($refDoc, true)."</pre>";

                $headerBtb = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $btb,
                    'dtmDoc' => $tgl,
                    'szSupplierId' => $supplier,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'szRefDocId' => $noSj,
                    'dtmDn' => $tglSj,
                    'szCarrierId' => $carrier,
                    'szVehicle' => $kendaraan,
                    'szDriver' => $pengemudi,
                    'szVehicle2' => $namaKendaraan,
                    'szDriver2' => $namaPengemudi,
                    'szRef1' => $noRef1,
                    'szRef2' => $noRef2,
                    'szRef3' => $noRef3,
                    'intShift' => $shift,
                    'intHelperCount' => $kuli,
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:S'),
                    'szDescription' => $keterangan,
                    'bFromOTM' => '0'
                );
                $btbHeader = $this->mInventSupp->simpanData($headerBtb, $base.'.dms_inv_docstockinsupplier');
                $headerBkb = $this->mInventSupp->simpanDms($headerBtb, 'dms.dms_inv_docstockinsupplier');
                // echo "<pre> Header: ".var_export($header, true)."</pre>";

                $prod = '';
                for ($i = 0; $i < count($produk); $i++) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $btb,
                        'intItemNumber' => $i,
                        'szProductId' => $produk[$i],
                        'decQty' => $qty[$i],
                        'szUomId' => $satuan[$i]
                    );
                    $bkbDetail = $this->mInventSupp->simpanData($detail, $base.'.dms_inv_docstockinsupplieritem');
                    $detailBkb = $this->mInventSupp->simpanDms($detail, 'dms.dms_inv_docstockinsupplieritem');
                    // echo "<pre> Detail: ".var_export($detail, true)."</pre>";

                    $history = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $produk[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $qty[$i],
                        'szUomId' => $satuan[$i],
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInSupplier',
                        'szDocId' => $btb,
                        'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $bkbHistory = $this->mInventSupp->simpanData($history, $base.'.dms_inv_stockHistory');
                    $historyBkb = $this->mInventSupp->simpanDms($history, 'dms.dms_inv_stockHistory');
                    // echo "<pre> History: ".var_export($history, true)."</pre>";

                    $prod .= "'" . $produk[$i] . "',";
                }
                $prodLen = strlen($prod);
                $fixProd = substr($prod, 0, $prodLen - 1);

                $sOnHand = $this->mInventSupp->stockOnHand($fixProd, $gudang, $stok);
                if ($sOnHand != '0') {
                    foreach ($sOnHand as $key) {
                        for ($j = 0; $j < count($produk); $j++) {
                            if ($key->szProductId == $produk[$j]) {
                                $updOnHand = array(
                                    'decQtyOnHand' => $key->decQtyOnHand + (int)$qty[$j],
                                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHand = array(
                                    'szProductId' => $produk[$j],
                                    'szStockTypeId' => $this->input->post('stok'),
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('gudang')
                                );
                            }
                        }

                        $bkbOnHand = $this->mInventSupp->updateData($whereOnHand, $updOnHand, $base.'.dms_inv_stockonhand');
                        $onHandBkb = $this->mInventSupp->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');
                    }
                }
                // else {
                //     for ($k = 0; $k < count($produk); $k++) {
                //         $onHand = array(
                //             'iId' => $this->uuid->v4(),
                //             'szProductId' => $produk[$k],
                //             'szLocationType' => 'WAREHOUSE',
                //             'szLocationId' => $gudang,
                //             'szStockTypeId' => $stok,
                //             'szReportedAsId' => $this->session->userdata('user_branch'),
                //             'decQtyOnHand' => $qty[$k],
                //             'szUomId' => $satuan[$k],
                //             'szUserCreatedId' => $this->session->userdata('user_nik'),
                //             'szUserUpdatedId' => $this->session->userdata('user_nik'),
                //             'dtmCreated' => date('Y-m-d H:i:s'),
                //             'dtmLastUpdated' => date('Y-m-d H:i:s')
                //         );
                //         $insertOnHand = $this->mInventDist->simpanData($onHand, $base . '.dms_inv_stockonhand');
                //     }
                // }

                // echo $btbTk;
                if ($btbTk != '') {
                    if ($referensi == 'true' && $btbHeader == 'true' && $bkbDetail == 'true' && $bkbHistory == 'true') {
                        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                        header('Location: ' . base_url('inventSupp/btbTolakan/' . $btbTk));
                        exit;
                    } else {
                        $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                        header('Location: ' . base_url('inventSupp/btbTambah/' . $btb));
                        exit;
                    }
                } else {
                    if ($referensi == 'true' && $btbHeader == 'true' && $bkbDetail == 'true' && $bkbHistory == 'true') {
                        $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                        header('Location: ' . base_url('home/btbSupplier'));
                        exit;
                    } else {
                        $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                        header('Location: ' . base_url('inventSupp/btbTambah/' . $btb));
                        exit;
                    }
                }
            }
        }
    }

    function simpanBtbTolakan()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $btb = $this->input->post('btb');
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang'); //validation
        $stok = $this->input->post('stok'); //validation
        $supplier = $this->input->post('supplier'); //validation
        $carrier = $this->input->post('carrier'); //validation
        $pengemudi = $this->input->post('pengemudi'); //validation
        $namaPengemudi = $this->input->post('namaPengemudi');
        $kendaraan = $this->input->post('kendaraan'); //validation
        $namaKendaraan = $this->input->post('namaKendaraan');
        $noSj = $this->input->post('noSj');
        $tglSj = $this->input->post('tglSj');
        $noRef1 = $this->input->post('noRef1');
        $noRef2 = $this->input->post('noRef2');
        $noRef3 = $this->input->post('noRef3');
        $shift = $this->input->post('shift');
        $kuli = $this->input->post('kuli');
        $keterangan = $this->input->post('keterangan');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        if ($gudang == '' || $stok == '' || $supplier == '' || $carrier == '' || $pengemudi == '' || $kendaraan == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventSupp/btbTolakan/' . $btb));
            exit;
        } else {
            $array_new = array_count_values($this->input->post('produk'));
            $array2 = array();
            foreach ($array_new as $key => $val) {
                if ($val > 1) { //or do $val >2 based on your desire
                    $array2[] = $key;
                }
            }

            if (count($array2) != '0') {
                $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                header('Location: ' . base_url('inventSupp/btbTolakan/' . $btb));
                exit;
            } else {
                $refDoc = array(
                    'refId' => $btb,
                    'refOld' => $noSj,
                    'refTanggal' => $tgl,
                    'refDepo' => $this->session->userdata('user_branch'),
                    'refDocType' => 'DMSDocStockInSupplier',
                    'refUserAdd' => 'mdba-'.$this->session->userdata('user_nik'),
                    'refUserUpdate' => 'mdba-'.$this->session->userdata('user_nik'),
                    'refDateAdd' => date('Y-m-d H:i:s'),
                    'refDateUpdate' => date('Y-m-d H:i:s')
                );
                $referensi = $this->mInventSupp->simpanData($refDoc, $base.'.mdbaRefDoc');
                // echo "<pre> Referensi: ".var_export($refDoc, true)."</pre>";

                $headerBkb = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $btb,
                    'dtmDoc' => $tgl,
                    'szSupplierId' => $supplier,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'szRefDocId' => $noSj,
                    'dtmDn' => $tglSj,
                    'szCarrierId' => $carrier,
                    'szVehicle' => $kendaraan,
                    'szDriver' => $pengemudi,
                    'szVehicle2' => $namaKendaraan,
                    'szDriver2' => $namaPengemudi,
                    'szRef1' => $noRef1,
                    'szRef2' => $noRef2,
                    'szRef3' => $noRef3,
                    'intShift' => $shift,
                    'intHelperCount' => $kuli,
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:S'),
                    'szDescription' => $keterangan
                );
                $bkbHeader = $this->mInventSupp->simpanData($headerBkb, $base.'.dms_inv_docstockinsupplier');
                $headerBkb = $this->mInventSupp->simpanDms($headerBkb, 'dms.dms_inv_docstockinsupplier');
                // echo "<pre> Header: ".var_export($header, true)."</pre>";

                $prod = '';
                for ($i = 0; $i < count($produk); $i++) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $btb,
                        'intItemNumber' => $i,
                        'szProductId' => $produk[$i],
                        'decQty' => $qty[$i],
                        'szUomId' => $satuan[$i]
                    );
                    $bkbDetail = $this->mInventSupp->simpanData($detail, $base.'.dms_inv_docstockinsupplieritem');
                    $detailBkb = $this->mInventSupp->simpanDms($detail, 'dms.dms_inv_docstockinsupplieritem');
                    // echo "<pre> Detail: ".var_export($detail, true)."</pre>";

                    $history = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $produk[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $qty[$i],
                        'szUomId' => $satuan[$i],
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInSupplier',
                        'szDocId' => $btb,
                        'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $bkbHistory = $this->mInventSupp->simpanData($history, $base.'.dms_inv_stockHistory');
                    $historyBkb = $this->mInventSupp->simpanDms($history, 'dms.dms_inv_stockHistory');
                    // echo "<pre> History: ".var_export($history, true)."</pre>";

                    $prod .= "'" . $produk[$i] . "',";
                }
                $prodLen = strlen($prod);
                $fixProd = substr($prod, 0, $prodLen - 1);

                $sOnHand = $this->mInventSupp->stockOnHand($fixProd, $gudang, $stok);
                if ($sOnHand != '0') {
                    foreach ($sOnHand as $key) {
                        for ($j = 0; $j < count($produk); $j++) {
                            if ($key->szProductId == $produk[$j]) {
                                $updOnHand = array(
                                    'decQtyOnHand' => $key->decQtyOnHand + (int)$qty[$j],
                                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHand = array(
                                    'szProductId' => $produk[$j],
                                    'szStockTypeId' => $this->input->post('stok'),
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('gudang')
                                );
                            }
                        }
                        $bkbOnHand = $this->mInventSupp->updateData($whereOnHand, $updOnHand, $base.'.dms_inv_stockonhand');
                        $onHandBkb = $this->mInventSupp->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');
                    }
                }
                // else {
                //     for ($k = 0; $k < count($produk); $k++) {
                //         $onHand = array(
                //             'iId' => $this->uuid->v4(),
                //             'szProductId' => $produk[$k],
                //             'szLocationType' => 'WAREHOUSE',
                //             'szLocationId' => $gudang,
                //             'szStockTypeId' => $stok,
                //             'szReportedAsId' => $this->session->userdata('user_branch'),
                //             'decQtyOnHand' => '0',
                //             'szUomId' => $satuan[$k],
                //             'szUserCreatedId' => $this->session->userdata('user_nik'),
                //             'szUserUpdatedId' => $this->session->userdata('user_nik'),
                //             'dtmCreated' => date('Y-m-d H:i:s'),
                //             'dtmLastUpdated' => date('Y-m-d H:i:s')
                //         );
                //         $insertOnHand = $this->mInventDist->simpanData($onHand, $base . '.dms_inv_stockonhand');
                //     }
                // }

                if ($referensi == 'true' && $bkbHeader == 'true' && $bkbDetail == 'true' && $bkbHistory == 'true') {
                    $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                    header('Location: ' . base_url('home/btbSupplier'));
                    exit;
                } else {
                    $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                    header('Location: ' . base_url('inventSupp/btbTolakan/' . $btb));
                    exit;
                }
            }
        }
    }

    function manualBkb()
    {
        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');

        $data['supplier'] = $this->mInventSupp->getSupplier();
        $data['warehouse'] = $this->mInventSupp->getWarehouse($depo);
        $data['stock'] = $this->mInventSupp->getStockType();
        $data['carrier'] = $this->mInventSupp->getCarrier();
        $data['vehicle'] = $this->mInventSupp->getVehicle();
        $data['employee'] = $this->mInventSupp->getDriver();
        $data['product'] = $this->mInventSupp->getProduct();

        $data['status'] = 'Draft';
        $id = 'BKBSUPP' . $depo . 'COU';
        $data['id'] = $this->mInventSupp->getId($id);
        $this->load->view('vBkbSupplierManual', $data);
    }

    function manualBtb()
    {
        $depo = $this->session->userdata('user_branch');
        $tanggal = date('Y-m-d');

        $data['supplier'] = $this->mInventSupp->getSupplier();
        $data['warehouse'] = $this->mInventSupp->getWarehouse($depo);
        $data['stock'] = $this->mInventSupp->getStockType();
        $data['carrier'] = $this->mInventSupp->getCarrier();
        $data['vehicle'] = $this->mInventSupp->getVehicle();
        $data['employee'] = $this->mInventSupp->getDriver();
        $data['product'] = $this->mInventSupp->getProduct();

        $data['status'] = 'Draft';
        $id = 'BTBSUPP' . $depo . 'COU';
        $data['id'] = $this->mInventSupp->getId($id);
        $this->load->view('vBtbSupplierManual', $data);
    }

    function simpanBkbManual()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang'); //validation
        $stok = $this->input->post('stok'); //validation
        $supplier = $this->input->post('supplier'); //validation
        $carrier = $this->input->post('carrier'); //validation
        $pengemudi = $this->input->post('pengemudi'); //validation
        $namaPengemudi = $this->input->post('namaPengemudi');
        $kendaraan = $this->input->post('kendaraan'); //validation
        $namaKendaraan = $this->input->post('namaKendaraan');
        $noSj = $this->input->post('noSj');
        $tglSj = $this->input->post('tglSj');
        $noRef1 = $this->input->post('noRef1');
        $noRef2 = $this->input->post('noRef2');
        $noRef3 = $this->input->post('noRef3');
        $shift = $this->input->post('shift');
        $kuli = $this->input->post('kuli');
        $keterangan = $this->input->post('keterangan');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');
        $depo = $this->session->userdata('user_branch');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        if ($gudang == '' || $stok == '' || $supplier == '' || $carrier == '' || $pengemudi == '' || $kendaraan == '' || $produk[0] == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventSupp/manualBkb'));
            exit;
        } else {
            $array_new = array_count_values($produk);
            $array2 = array();
            foreach ($array_new as $key => $val) {
                if ($val > 1) { //or do $val >2 based on your desire
                    $array2[] = $key;
                }
            }

            if (count($array2) != '0') {
                $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                header('Location: ' . base_url('inventSupp/manualBkb'));
                exit;
            } else {
                $id = 'BKBSUPP' . $depo . 'COU';
                $bkb = $this->mInventSupp->getId($id);
                //update counter
                $countBkb = $this->mInventSupp->getCounter($id);
                $updCountBkb = array('intLastCounter' => $countBkb);
                $whereCountBkb = array('szId' => $id);
                $countUpdBkb = $this->mInventSupp->updateData($whereCountBkb, $updCountBkb, $base . '.dms_sm_counter');
                $countBkb = $this->mInventSupp->updateDms($whereCountBkb, $updCountBkb, 'dms.dms_sm_counter');

                $refDoc = array(
                    'refId' => $bkb,
                    'refOld' => $noSj,
                    'refTanggal' => $tgl,
                    'refDepo' => $this->session->userdata('user_branch'),
                    'refDocType' => 'DMSDocStockOutSupplier',
                    'refUserAdd' => 'mdba-'.$this->session->userdata('user_nik'),
                    'refUserUpdate' => 'mdba-'.$this->session->userdata('user_nik'),
                    'refDateAdd' => date('Y-m-d H:i:s'),
                    'refDateUpdate' => date('Y-m-d H:i:s')
                );
                $referensi = $this->mInventSupp->simpanData($refDoc, $base . '.mdbaRefDoc');
                // echo "<pre> Referensi: ".var_export($refDoc, true)."</pre>";

                $headerBkb = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $bkb,
                    'dtmDoc' => $tgl,
                    'szSupplierId' => $supplier,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'szRefDocId' => $noSj,
                    'dtmDn' => $tglSj,
                    'szCarrierId' => $carrier,
                    'szVehicle' => $kendaraan,
                    'szDriver' => $pengemudi,
                    'szVehicle2' => $namaKendaraan,
                    'szDriver2' => $namaPengemudi,
                    'szRef1' => $noRef1,
                    'szRef2' => $noRef2,
                    'szRef3' => $noRef3,
                    'intShift' => $shift,
                    'intHelperCount' => $kuli,
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:S'),
                    'szDescription' => $keterangan
                );
                $bkbHeader = $this->mInventSupp->simpanData($headerBkb, $base . '.dms_inv_docstockoutsupplier');
                $headerBkb = $this->mInventSupp->simpanDms($headerBkb, 'dms.dms_inv_docstockoutsupplier');
                // echo "<pre> Header: ".var_export($header, true)."</pre>";

                $prod = '';
                for ($i = 0; $i < count($produk); $i++) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $bkb,
                        'intItemNumber' => $i,
                        'szProductId' => $produk[$i],
                        'decQty' => $qty[$i],
                        'szUomId' => $satuan[$i]
                    );
                    $bkbDetail = $this->mInventSupp->simpanData($detail, $base . '.dms_inv_docstockoutsupplieritem');
                    $detailBkb = $this->mInventSupp->simpanDms($detail, 'dms.dms_inv_docstockoutsupplieritem');
                    // echo "<pre> Detail: ".var_export($detail, true)."</pre>";

                    $history = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $produk[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => -$qty[$i],
                        'szUomId' => $satuan[$i],
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockOutSupplier',
                        'szDocId' => $bkb,
                        'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $bkbHistory = $this->mInventSupp->simpanData($history, $base . '.dms_inv_stockHistory');
                    $historyBkb = $this->mInventSupp->simpanDms($history, 'dms.dms_inv_stockHistory');
                    // echo "<pre> History: ".var_export($history, true)."</pre>";

                    $prod .= "'" . $produk[$i] . "',";
                }
                $prodLen = strlen($prod);
                $fixProd = substr($prod, 0, $prodLen - 1);

                $sOnHand = $this->mInventSupp->stockOnHand($fixProd, $gudang, $stok);
                if ($sOnHand != '0') {
                    foreach ($sOnHand as $key) {
                        for ($j = 0; $j < count($produk); $j++) {
                            if ($key->szProductId == $produk[$j]) {
                                $updOnHand = array(
                                    'decQtyOnHand' => $key->decQtyOnHand - (int)$qty[$j],
                                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHand = array(
                                    'szProductId' => $produk[$j],
                                    'szStockTypeId' => $this->input->post('stok'),
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('gudang')
                                );
                            }
                        }
                        $bkbOnHand = $this->mInventSupp->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $onHandBkb = $this->mInventSupp->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');
                    }
                } else {
                    for ($k = 0; $k < count($produk); $k++) {
                        $onHand = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $produk[$k],
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => '0',
                            'szUomId' => $satuan[$k],
                            'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $insertOnHand = $this->mInventSupp->simpanData($onHand, $base . '.dms_inv_stockonhand');
                    }
                }

                if ($referensi == 'true' && $bkbHeader == 'true' && $bkbDetail == 'true' && $bkbHistory == 'true' && $bkbOnHand == 'true') {
                    $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                    header('Location: ' . base_url('inventSupp/historyBkb'));
                    exit;
                } else {
                    $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                    header('Location: ' . base_url('inventSupp/manualBkb'));
                    exit;
                }
            }
        }
    }

    function simpanBtbManual()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang'); //validation
        $stok = $this->input->post('stok'); //validation
        $supplier = $this->input->post('supplier'); //validation
        $carrier = $this->input->post('carrier'); //validation
        $pengemudi = $this->input->post('pengemudi'); //validation
        $namaPengemudi = $this->input->post('namaPengemudi');
        $kendaraan = $this->input->post('kendaraan'); //validation
        $namaKendaraan = $this->input->post('namaKendaraan');
        $noSj = $this->input->post('noSj');
        $tglSj = $this->input->post('tglSj');
        $noRef1 = $this->input->post('noRef1');
        $noRef2 = $this->input->post('noRef2');
        $noRef3 = $this->input->post('noRef3');
        $shift = $this->input->post('shift');
        $kuli = $this->input->post('kuli');
        $keterangan = $this->input->post('keterangan');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');
        $depo = $this->session->userdata('user_branch');

        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $dept = 'ASA';
        } else {
            $dept = 'TVIP';
        }

        if ($gudang == '' || $stok == '' || $supplier == '' || $carrier == '' || $pengemudi == '' || $kendaraan == '' || $produk[0] == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventSupp/manualBtb'));
            exit;
        } else {
            $array_new = array_count_values($produk);
            $array2 = array();
            foreach ($array_new as $key => $val) {
                if ($val > 1) { //or do $val >2 based on your desire
                    $array2[] = $key;
                }
            }

            if (count($array2) != '0') {
                $this->session->set_flashdata('info', 'Produk Tidak Boleh Sama');
                header('Location: ' . base_url('inventSupp/manualBtb'));
                exit;
            } else {
                $id = 'BTBSUPP' . $depo . 'COU';
                $bkb = $this->mInventSupp->getId($id);
                //update counter
                $countBkb = $this->mInventSupp->getCounter($id);
                $updCountBkb = array('intLastCounter' => $countBkb);
                $whereCountBkb = array('szId' => $id);
                $countUpdBkb = $this->mInventSupp->updateData($whereCountBkb, $updCountBkb, $base . '.dms_sm_counter');
                $countBkb = $this->mInventSupp->updateDms($whereCountBkb, $updCountBkb, 'dms.dms_sm_counter');

                $refDoc = array(
                    'refId' => $bkb,
                    'refOld' => $noSj,
                    'refTanggal' => $tgl,
                    'refDepo' => $this->session->userdata('user_branch'),
                    'refDocType' => 'DMSDocStockInSupplier',
                    'refUserAdd' => 'mdba-'.$this->session->userdata('user_nik'),
                    'refUserUpdate' => 'mdba-'.$this->session->userdata('user_nik'),
                    'refDateAdd' => date('Y-m-d H:i:s'),
                    'refDateUpdate' => date('Y-m-d H:i:s')
                );
                $referensi = $this->mInventSupp->simpanData($refDoc, $base . '.mdbaRefDoc');
                // echo "<pre> Referensi: ".var_export($refDoc, true)."</pre>";

                $headerBkb = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $bkb,
                    'dtmDoc' => $tgl,
                    'szSupplierId' => $supplier,
                    'szWarehouseId' => $gudang,
                    'szStockType' => $stok,
                    'szRefDocId' => $noSj,
                    'dtmDn' => $tglSj,
                    'szCarrierId' => $carrier,
                    'szVehicle' => $kendaraan,
                    'szDriver' => $pengemudi,
                    'szVehicle2' => $namaKendaraan,
                    'szDriver2' => $namaPengemudi,
                    'szRef1' => $noRef1,
                    'szRef2' => $noRef2,
                    'szRef3' => $noRef3,
                    'intShift' => $shift,
                    'intHelperCount' => $kuli,
                    'intPrintedCount' => '0',
                    'szBranchId' => $this->session->userdata('user_branch'),
                    'szCompanyId' => $dept,
                    'szDocStatus' => 'Applied',
                    'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:S'),
                    'szDescription' => $keterangan
                );
                $bkbHeader = $this->mInventSupp->simpanData($headerBkb, $base . '.dms_inv_docstockinsupplier');
                $headerBkb = $this->mInventSupp->simpanDms($headerBkb, 'dms.dms_inv_docstockinsupplier');
                // echo "<pre> Header: ".var_export($header, true)."</pre>";

                $prod = '';
                for ($i = 0; $i < count($produk); $i++) {
                    $detail = array(
                        'iId' => $this->uuid->v4(),
                        'szDocId' => $bkb,
                        'intItemNumber' => $i,
                        'szProductId' => $produk[$i],
                        'decQty' => $qty[$i],
                        'szUomId' => $satuan[$i]
                    );
                    $bkbDetail = $this->mInventSupp->simpanData($detail, $base . '.dms_inv_docstockinsupplieritem');
                    $detailBkb = $this->mInventSupp->simpanDms($detail, 'dms.dms_inv_docstockinsupplieritem');
                    // echo "<pre> Detail: ".var_export($detail, true)."</pre>";

                    $history = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $produk[$i],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $qty[$i],
                        'szUomId' => $satuan[$i],
                        'dtmTransaction' => $tgl,
                        'szTrnId' => 'DMSDocStockInSupplier',
                        'szDocId' => $bkb,
                        'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                        'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $bkbHistory = $this->mInventSupp->simpanData($history, $base . '.dms_inv_stockHistory');
                    $historyBkb = $this->mInventSupp->simpanDms($history, 'dms.dms_inv_stockHistory');
                    // echo "<pre> History: ".var_export($history, true)."</pre>";

                    $prod .= "'" . $produk[$i] . "',";
                }
                $prodLen = strlen($prod);
                $fixProd = substr($prod, 0, $prodLen - 1);

                $sOnHand = $this->mInventSupp->stockOnHand($fixProd, $gudang, $stok);
                if ($sOnHand != '0') {
                    foreach ($sOnHand as $key) {
                        for ($j = 0; $j < count($produk); $j++) {
                            if ($key->szProductId == $produk[$j]) {
                                $updOnHand = array(
                                    'decQtyOnHand' => $key->decQtyOnHand + (int)$qty[$j],
                                    'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                                );
                                $whereOnHand = array(
                                    'szProductId' => $produk[$j],
                                    'szStockTypeId' => $this->input->post('stok'),
                                    'szReportedAsId' => $this->session->userdata('user_branch'),
                                    'szLocationId' => $this->input->post('gudang')
                                );
                            }
                        }
                        $bkbOnHand = $this->mInventSupp->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                        $onHandBkb = $this->mInventSupp->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');
                    }
                } else {
                    for ($k = 0; $k < count($produk); $k++) {
                        $onHand = array(
                            'iId' => $this->uuid->v4(),
                            'szProductId' => $produk[$k],
                            'szLocationType' => 'WAREHOUSE',
                            'szLocationId' => $gudang,
                            'szStockTypeId' => $stok,
                            'szReportedAsId' => $this->session->userdata('user_branch'),
                            'decQtyOnHand' => '0',
                            'szUomId' => $satuan[$k],
                            'szUserCreatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                            'szUserUpdatedId' => 'mdba-'.$this->session->userdata('user_nik'),
                            'dtmCreated' => date('Y-m-d H:i:s'),
                            'dtmLastUpdated' => date('Y-m-d H:i:s')
                        );
                        $insertOnHand = $this->mInventSupp->simpanData($onHand, $base . '.dms_inv_stockonhand');
                    }
                }

                if ($referensi == 'true' && $bkbHeader == 'true' && $bkbDetail == 'true' && $bkbHistory == 'true' && $bkbOnHand == 'true') {
                    $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                    header('Location: ' . base_url('inventSupp/historyBtb'));
                    exit;
                } else {
                    $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                    header('Location: ' . base_url('inventSupp/manualBtb'));
                    exit;
                }
            }
        }
    }

    function historyBkb()
    {
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mInventSupp->getHistoryBkb($tanggal);
        $this->load->view('vBkbSupplierHistory', $data);
    }

    function historyBtb()
    {
        $tanggal = date('Y-m-d');
        $data['data'] = $this->mInventSupp->getHistoryBtb($tanggal);
        $this->load->view('vBtbSupplierHistory', $data);
    }

    function tglHistoryBkb()
    {
        $tanggal = $this->input->post('tanggal');
        $data['data'] = $this->mInventSupp->getHistoryBkb($tanggal);
        $this->load->view('vBkbSupplierHistory', $data);
    }

    function tglHistoryBtb()
    {
        $tanggal = $this->input->post('tanggal');
        $data['data'] = $this->mInventSupp->getHistoryBtb($tanggal);
        $this->load->view('vBtbSupplierHistory', $data);
    }

    function detailBkb()
    {
        $document = $this->input->post('id');
        $data = $this->mInventSupp->detailBkb($document);
        echo json_encode($data);
    }

    function detailBtb()
    {
        $document = $this->input->post('id');
        $data = $this->mInventSupp->detailBtb($document);
        echo json_encode($data);
    }

    function editBkb($document)
    {
        $depo = $this->session->userdata('user_branch');

        $bkb = 'BKBSUPP' . $depo . 'COU';
        $data['bkb'] = $this->mInventSupp->getId($bkb);
        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventSupp->getId($adjustment);

        $data['data'] = $this->mInventSupp->detailBkb($document);

        $data['supplier'] = $this->mInventSupp->getSupplier();
        $data['warehouse'] = $this->mInventSupp->getWarehouse($depo);
        $data['stock'] = $this->mInventSupp->getStockType();
        $data['carrier'] = $this->mInventSupp->getCarrier();
        $data['vehicle'] = $this->mInventSupp->getVehicle();
        $data['employee'] = $this->mInventSupp->getDriver();
        $data['product'] = $this->mInventSupp->getProduct();

        $this->load->view('vBkbSupplierEdit', $data);
    }

    function editBtb($document)
    {
        $depo = $this->session->userdata('user_branch');

        $btb = 'BTBSUPP' . $depo . 'COU';
        $data['btb'] = $this->mInventSupp->getId($btb);
        $adjustment = 'ADJ' . $depo . 'COU';
        $data['adjustment'] = $this->mInventSupp->getId($adjustment);

        $data['data'] = $this->mInventSupp->detailBtb($document);

        $data['supplier'] = $this->mInventSupp->getSupplier();
        $data['warehouse'] = $this->mInventSupp->getWarehouse($depo);
        $data['stock'] = $this->mInventSupp->getStockType();
        $data['carrier'] = $this->mInventSupp->getCarrier();
        $data['vehicle'] = $this->mInventSupp->getVehicle();
        $data['employee'] = $this->mInventSupp->getDriver();
        $data['product'] = $this->mInventSupp->getProduct();

        $this->load->view('vBtbSupplierEdit', $data);
    }

    function simpanEditBkb()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang'); //validation
        $stok = $this->input->post('stok'); //validation
        $supplier = $this->input->post('supplier'); //validation
        $carrier = $this->input->post('carrier'); //validation
        $pengemudi = $this->input->post('pengemudi'); //validation
        $namaPengemudi = $this->input->post('namaPengemudi');
        $kendaraan = $this->input->post('kendaraan'); //validation
        $namaKendaraan = $this->input->post('namaKendaraan');
        $noSj = $this->input->post('noSj');
        $tglSj = $this->input->post('tglSj');
        $noRef1 = $this->input->post('noRef1');
        $noRef2 = $this->input->post('noRef2');
        $noRef3 = $this->input->post('noRef3');
        $shift = $this->input->post('shift');
        $kuli = $this->input->post('kuli');
        $keterangan = $this->input->post('keterangan');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');
        $depo = $this->session->userdata('user_branch');
        $bkbOld = $this->input->post('bkbOld');

        if ($gudang == '' || $stok == '' || $supplier == '' || $carrier == '' || $pengemudi == '' || $kendaraan == '' || $produk[0] == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventSupp/editBkb/' . $bkbOld));
            exit;
        } else {
            $id = 'BKBSUPP' . $depo . 'COU';
            $bkb = $this->mInventSupp->getId($id);
            //update counter
            $countBkb = $this->mInventSupp->getCounter($id);
            $updCountBkb = array('intLastCounter' => $countBkb);
            $whereCountBkb = array('szId' => $id);
            $countUpdBkb = $this->mInventSupp->updateData($whereCountBkb, $updCountBkb, $base . '.dms_sm_counter');
            $countBkb = $this->mInventSupp->updateDms($whereCountBkb, $updCountBkb, 'dms.dms_sm_counter');

            $adj = 'ADJ' . $depo . 'COU';
            $adjustment = $this->mInventSupp->getId($adj);
            //update counter
            $countAdj = $this->mInventSupp->getCounter($adj);
            $updCountAdj = array('intLastCounter' => $countAdj);
            $whereCountAdj = array('szId' => $adj);
            $countUpdAdj = $this->mInventSupp->updateData($whereCountAdj, $updCountAdj, $base . '.dms_sm_counter');
            $countAdj = $this->mInventSupp->updateDms($whereCountAdj, $updCountAdj, 'dms.dms_sm_counter');

            $old = $this->mInventSupp->detailBkb($bkbOld);
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
                $historyBkbOldDms = $this->mInventDepot->updateDms($updHistoryOld, $whereHistoryOld, 'dms.dms_inv_stockHistory');

                $updDetOldBkb = array(
                    'decQty' => -$value->decQty,
                    'szDocId' => $bkb
                );

                $whereDetOldBkb = array(
                    'szDocId' => $bkbOld,
                    'szProductId' => $value->szProductId
                );
                $detOldUpd = $this->mInventDepot->updateData($whereDetOldBkb, $updDetOldBkb, $base . '.dms_inv_docstockoutsupplieritem');
                $oldUpdBkb = $this->mInventDepot->updateDms($whereDetOldBkb, $updDetOldBkb, 'dms.dms_inv_docstockoutsupplieritem');

                $updOldBkb = array(
                    'szDocId' => $bkb
                );

                $whereOldBkb = array(
                    'szDocId' => $bkbOld
                );
                $oldUpd = $this->mInventDepot->updateData($whereOldBkb, $updOldBkb, $base . '.dms_inv_docstockoutsupplier');
                $bkbOldUpd = $this->mInventDepot->updateDms($whereOldBkb, $updOldBkb, 'dms.dms_inv_docstockoutsupplier');

                $detAdjustment = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $adjustment,
                    'intItemNumber' => $intNum,
                    'szProductId' => $value->szProductId,
                    'decQty' => $value->decQty,
                    'szUomId' => $value->szUomId
                );
                $adjDet = $this->mInventDepot->simpanData($detAdjustment, $base . '.dms_inv_docstockadjustmentitem');
                $detAdj = $this->mInventDepot->simpanDms($detAdjustment, 'dms.dms_inv_docstockadjustmentitem');

                $intNum++;
            }
            $lenOld = strlen($prodOld);
            $prodOld2 = substr($prodOld, 0, $lenOld - 1);

            $sOnHandOld = $this->mInventSupp->stockOnHand($prodOld2, "'" . $gudangOld . "'", "'" . $stokOld . "'");
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
                    $onHandUpdateOld = $this->mInventSupp->updateData($whereOnHandOld, $updOnHandOld, $base . '.dms_inv_stockonhand');
                    $oldOnHandUpdate = $this->mInventSupp->updateDms($whereOnHandOld, $updOnHandOld, 'dms.dms_inv_stockonhand');
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

            if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
                $dept = 'ASA';
            } else {
                $dept = 'TVIP';
            }

            $headerBkb = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $bkbOld,
                'dtmDoc' => $tgl,
                'szSupplierId' => $supplier,
                'szWarehouseId' => $gudang,
                'szStockType' => $stok,
                'szRefDocId' => $noSj,
                'dtmDn' => $tglSj,
                'szCarrierId' => $carrier,
                'szVehicle' => $pengemudi,
                'szDriver' => $kendaraan,
                'szVehicle2' => $namaPengemudi,
                'szDriver2' => $namaKendaraan,
                'szRef1' => $noRef1,
                'szRef2' => $noRef2,
                'szRef3' => $noRef3,
                'intShift' => $shift,
                'intHelperCount' => $kuli,
                'intPrintedCount' => '0',
                'szBranchId' => $this->session->userdata('user_branch'),
                'szCompanyId' => $dept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:S'),
                'szDescription' => $keterangan
            );
            $bkbHeader = $this->mInventSupp->simpanData($headerBkb, $base . '.dms_inv_docstockoutsupplier');
            $headerBkb = $this->mInventSupp->simpanDms($headerBkb, 'dms.dms_inv_docstockoutsupplier');
            // echo "<pre> Header: ".var_export($header, true)."</pre>";

            $adjRefDoc = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjustment,
                'szRefDocId' => $bkbOld,
                'szRefDocTypeId' => 'DMSDocStockOutSupplier',
                'szAdjustmentId' => $bkb
            );
            $refDocAdj = $this->mInventDepot->simpanData($adjRefDoc, $base . '.dms_inv_stockadjustmentrefdoc');
            $adjRefDoc = $this->mInventDepot->simpanDms($adjRefDoc, 'dms.dms_inv_stockadjustmentrefdoc');

            $adjustmentHeader = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjustment,
                'dtmDoc' => $tgl,
                'szRefTypeDoc' => 'DMSDocStockOutSupplier',
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
            $headAdj = $this->mInventSupp->simpanData($adjustmentHeader, $base . '.dms_inv_docstockadjustment');
            $adjHead = $this->mInventSupp->simpanDms($adjustmentHeader, 'dms.dms_inv_docstockadjustment');

            $prod = '';
            for ($i = 0; $i < count($produk); $i++) {
                $detail = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $bkbOld,
                    'intItemNumber' => $i,
                    'szProductId' => $produk[$i],
                    'decQty' => $qty[$i],
                    'szUomId' => $satuan[$i]
                );
                $bkbDetail = $this->mInventSupp->simpanData($detail, $base . '.dms_inv_docstockoutsupplieritem');
                $detailBkb = $this->mInventSupp->simpanDms($detail, 'dms.dms_inv_docstockoutsupplieritem');
                // echo "<pre> Detail: ".var_export($detail, true)."</pre>";

                $history = array(
                    'iId' => $this->uuid->v4(),
                    'szProductId' => $produk[$i],
                    'szLocationType' => 'WAREHOUSE',
                    'szLocationId' => $gudang,
                    'szStockTypeId' => $stok,
                    'szReportedAsId' => $this->session->userdata('user_branch'),
                    'decQtyOnHand' => -$qty[$i],
                    'szUomId' => $satuan[$i],
                    'dtmTransaction' => $tgl,
                    'szTrnId' => 'DMSDocStockOutSupplier',
                    'szDocId' => $bkbOld,
                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );
                $bkbHistory = $this->mInventSupp->simpanData($history, $base . '.dms_inv_stockHistory');
                $historyBkb = $this->mInventSupp->simpanDms($history, 'dms.dms_inv_stockHistory');
                // echo "<pre> History: ".var_export($history, true)."</pre>";

                $prod .= "'" . $produk[$i] . "',";
            }
            $prodLen = strlen($prod);
            $fixProd = substr($prod, 0, $prodLen - 1);

            $sOnHand = $this->mInventSupp->stockOnHand($fixProd, "'" . $gudang . "'", "'" . $stok . "'");
            if ($sOnHand != '0') {
                foreach ($sOnHand as $key) {
                    for ($j = 0; $j < count($produk); $j++) {
                        if ($key->szProductId == $produk[$j]) {
                            $updOnHand = array(
                                'decQtyOnHand' => $key->decQtyOnHand - (int)$qty[$j],
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $whereOnHand = array(
                                'szProductId' => $produk[$j],
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'szLocationId' => $gudang
                            );
                        }
                    }
                    $bkbOnHand = $this->mInventSupp->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                    $onHandBkb = $this->mInventSupp->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');
                }
            } else {
                for ($k = 0; $k < count($produk); $k++) {
                    $onHand = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $produk[$k],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => '0',
                        'szUomId' => $satuan[$k],
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $insertOnHand = $this->mInventSupp->simpanData($onHand, $base . '.dms_inv_stockonhand');
                }
            }

            if ($bkbHeader == 'true' && $bkbDetail == 'true' && $bkbHistory == 'true' && $bkbOnHand == 'true') {
                $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('inventSupp/historyBkb'));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventSupp/editBkb/' . $bkbOld));
                exit;
            }
        }
    }

    function simpanEditBtb()
    {
        if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
            $base = 'mdbaasa';
        } else {
            $base = 'mdbatvip';
        }
        $tgl = $this->input->post('tgl');
        $gudang = $this->input->post('gudang'); //validation
        $stok = $this->input->post('stok'); //validation
        $supplier = $this->input->post('supplier'); //validation
        $carrier = $this->input->post('carrier'); //validation
        $pengemudi = $this->input->post('pengemudi'); //validation
        $namaPengemudi = $this->input->post('namaPengemudi');
        $kendaraan = $this->input->post('kendaraan'); //validation
        $namaKendaraan = $this->input->post('namaKendaraan');
        $noSj = $this->input->post('noSj');
        $tglSj = $this->input->post('tglSj');
        $noRef1 = $this->input->post('noRef1');
        $noRef2 = $this->input->post('noRef2');
        $noRef3 = $this->input->post('noRef3');
        $shift = $this->input->post('shift');
        $kuli = $this->input->post('kuli');
        $keterangan = $this->input->post('keterangan');
        $produk = $this->input->post('produk');
        $qty = $this->input->post('qty');
        $satuan = $this->input->post('satuan');
        $depo = $this->session->userdata('user_branch');
        $btbOld = $this->input->post('btbOld');

        if ($gudang == '' || $stok == '' || $supplier == '' || $carrier == '' || $pengemudi == '' || $kendaraan == '' || $produk[0] == '') {
            $this->session->set_flashdata('warning', 'Mohon Input Data Dengan Benar');
            header('Location: ' . base_url('inventSupp/editBtb/' . $btbOld));
            exit;
        } else {
            $id = 'BTBSUPP' . $depo . 'COU';
            $btb = $this->mInventSupp->getId($id);
            //update counter
            $countBtb = $this->mInventSupp->getCounter($id);
            $updCountBtb = array('intLastCounter' => $countBtb);
            $whereCountBtb = array('szId' => $id);
            $countUpdBtb = $this->mInventSupp->updateData($whereCountBtb, $updCountBtb, $base . '.dms_sm_counter');
            $countBtb = $this->mInventSupp->updateDms($whereCountBtb, $updCountBtb, 'dms.dms_sm_counter');

            $adj = 'ADJ' . $depo . 'COU';
            $adjustment = $this->mInventSupp->getId($adj);
            //update counter
            $countAdj = $this->mInventSupp->getCounter($adj);
            $updCountAdj = array('intLastCounter' => $countAdj);
            $whereCountAdj = array('szId' => $adj);
            $countUpdAdj = $this->mInventSupp->updateData($whereCountAdj, $updCountAdj, $base . '.dms_sm_counter');
            $countAdj = $this->mInventSupp->updateDms($whereCountAdj, $updCountAdj, 'dms.dms_sm_counter');

            $old = $this->mInventSupp->detailBtb($btbOld);
            $prodOld = '';
            $intNum = 0;
            foreach ($old as $value) {
                $prodOld .= "'" . $value->szProductId . "',";
                $stokOld = $value->szStockType;
                $gudangOld = $value->szWarehouseId;

                $updHistoryOld = array(
                    'decQtyOnHand' => -$value->decQty,
                    'szDocId' => $btb,
                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );

                $whereHistoryOld = array(
                    'szDocId' => $btbOld,
                    'szProductId' => $value->szProductId
                );

                $historyBtbOld = $this->mInventDepot->updateData($updHistoryOld, $whereHistoryOld, $base . '.dms_inv_stockhistory');
                $historyBtbOldDms = $this->mInventDepot->updateDms($updHistoryOld, $whereHistoryOld, 'dms.dms_inv_stockhistory');

                $updDetOldBtb = array(
                    'decQty' => -$value->decQty,
                    'szDocId' => $btb
                );

                $whereDetOldBtb = array(
                    'szDocId' => $btbOld,
                    'szProductId' => $value->szProductId
                );
                $detOldUpd = $this->mInventDepot->updateData($whereDetOldBtb, $updDetOldBtb, $base . '.dms_inv_docstockinsupplieritem');
                $oldUpdBtb = $this->mInventDepot->updateDms($whereDetOldBtb, $updDetOldBtb, 'dms.dms_inv_docstockinsupplieritem');

                $updOldBtb = array(
                    'szDocId' => $btb
                );

                $whereOldBtb = array(
                    'szDocId' => $btbOld
                );
                $oldUpd = $this->mInventDepot->updateData($whereOldBtb, $updOldBtb, $base . '.dms_inv_docstockinsupplier');
                $btbOldUpd = $this->mInventDepot->updateDms($whereOldBtb, $updOldBtb, 'dms.dms_inv_docstockinsupplier');

                $detAdjustment = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $adjustment,
                    'intItemNumber' => $intNum,
                    'szProductId' => $value->szProductId,
                    'decQty' => $value->decQty,
                    'szUomId' => $value->szUomId
                );
                $adjDet = $this->mInventDepot->simpanData($detAdjustment, $base . '.dms_inv_docstockadjustmentitem');
                $detAdj = $this->mInventDepot->simpanDms($detAdjustment, 'dms.dms_inv_docstockadjustmentitem');

                $intNum++;
            }
            $lenOld = strlen($prodOld);
            $prodOld2 = substr($prodOld, 0, $lenOld - 1);

            $sOnHandOld = $this->mInventSupp->stockOnHand($prodOld2, "'" . $gudangOld . "'", "'" . $stokOld . "'");
            if ($sOnHandOld != 0) {
                foreach ($sOnHandOld as $value) {
                    foreach ($old as $key) {
                        if ($key->szProductId == $value->szProductId) {
                            $updOnHandOld = array(
                                'decQtyOnHand' => $value->decQtyOnHand - $key->decQty,
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
                    $onHandUpdateOld = $this->mInventSupp->updateData($whereOnHandOld, $updOnHandOld, $base . '.dms_inv_stockonhand');
                    $oldOnHandUpdate = $this->mInventSupp->updateDms($whereOnHandOld, $updOnHandOld, 'dms.dms_inv_stockonhand');
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

            if ($this->session->userdata('user_branch') == '321' || $this->session->userdata('user_branch') == '336' || $this->session->userdata('user_branch') == '324') {
                $dept = 'ASA';
            } else {
                $dept = 'TVIP';
            }

            $headerBtb = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $btbOld,
                'dtmDoc' => $tgl,
                'szSupplierId' => $supplier,
                'szWarehouseId' => $gudang,
                'szStockType' => $stok,
                'szRefDocId' => $noSj,
                'dtmDn' => $tglSj,
                'szCarrierId' => $carrier,
                'szVehicle' => $pengemudi,
                'szDriver' => $kendaraan,
                'szVehicle2' => $namaPengemudi,
                'szDriver2' => $namaKendaraan,
                'szRef1' => $noRef1,
                'szRef2' => $noRef2,
                'szRef3' => $noRef3,
                'intShift' => $shift,
                'intHelperCount' => $kuli,
                'intPrintedCount' => '0',
                'szBranchId' => $this->session->userdata('user_branch'),
                'szCompanyId' => $dept,
                'szDocStatus' => 'Applied',
                'szUserCreatedId' => $this->session->userdata('user_nik'),
                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                'dtmCreated' => date('Y-m-d H:i:s'),
                'dtmLastUpdated' => date('Y-m-d H:i:S'),
                'szDescription' => $keterangan
            );
            $btbHeader = $this->mInventSupp->simpanData($headerBtb, $base . '.dms_inv_docstockinsupplier');
            $headerBtb = $this->mInventSupp->simpanDms($headerBtb, 'dms.dms_inv_docstockinsupplier');
            // echo "<pre> Header: ".var_export($header, true)."</pre>";

            $adjRefDoc = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjustment,
                'szRefDocId' => $btbOld,
                'szRefDocTypeId' => 'DMSDocStockOutSupplier',
                'szAdjustmentId' => $btb
            );
            $refDocAdj = $this->mInventDepot->simpanData($adjRefDoc, $base . '.dms_inv_stockadjustmentrefdoc');
            $adjRefDoc = $this->mInventDepot->simpanDms($adjRefDoc, 'dms.dms_inv_stockadjustmentrefdoc');

            $adjustmentHeader = array(
                'iId' => $this->uuid->v4(),
                'szDocId' => $adjustment,
                'dtmDoc' => $tgl,
                'szRefTypeDoc' => 'DMSDocStockOutSupplier',
                'szRefDocId' => $btbOld,
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
            $headAdj = $this->mInventSupp->simpanData($adjustmentHeader, $base . '.dms_inv_docstockadjustment');
            $adjHead = $this->mInventSupp->simpanDms($adjustmentHeader, 'dms.dms_inv_docstockadjustment');

            $prod = '';
            for ($i = 0; $i < count($produk); $i++) {
                $detail = array(
                    'iId' => $this->uuid->v4(),
                    'szDocId' => $btbOld,
                    'intItemNumber' => $i,
                    'szProductId' => $produk[$i],
                    'decQty' => $qty[$i],
                    'szUomId' => $satuan[$i]
                );
                $btbDetail = $this->mInventSupp->simpanData($detail, $base . '.dms_inv_docstockinsupplieritem');
                $detailBtb = $this->mInventSupp->simpanDms($detail, 'dms.dms_inv_docstockinsupplieritem');
                // echo "<pre> Detail: ".var_export($detail, true)."</pre>";

                $history = array(
                    'iId' => $this->uuid->v4(),
                    'szProductId' => $produk[$i],
                    'szLocationType' => 'WAREHOUSE',
                    'szLocationId' => $gudang,
                    'szStockTypeId' => $stok,
                    'szReportedAsId' => $this->session->userdata('user_branch'),
                    'decQtyOnHand' => $qty[$i],
                    'szUomId' => $satuan[$i],
                    'dtmTransaction' => $tgl,
                    'szTrnId' => 'DMSDocStockInSupplier',
                    'szDocId' => $btbOld,
                    'szUserCreatedId' => $this->session->userdata('user_nik'),
                    'szUserUpdatedId' => $this->session->userdata('user_nik'),
                    'dtmCreated' => date('Y-m-d H:i:s'),
                    'dtmLastUpdated' => date('Y-m-d H:i:s')
                );
                $btbHistory = $this->mInventSupp->simpanData($history, $base . '.dms_inv_stockHistory');
                $historyBtb = $this->mInventSupp->simpanDms($history, 'dms.dms_inv_stockHistory');
                // echo "<pre> History: ".var_export($history, true)."</pre>";

                $prod .= "'" . $produk[$i] . "',";
            }
            $prodLen = strlen($prod);
            $fixProd = substr($prod, 0, $prodLen - 1);

            $sOnHand = $this->mInventSupp->stockOnHand($fixProd, "'" . $gudang . "'", "'" . $stok . "'");
            if ($sOnHand != '0') {
                foreach ($sOnHand as $key) {
                    for ($j = 0; $j < count($produk); $j++) {
                        if ($key->szProductId == $produk[$j]) {
                            $updOnHand = array(
                                'decQtyOnHand' => $key->decQtyOnHand + (int)$qty[$j],
                                'szUserUpdatedId' => $this->session->userdata('user_nik'),
                                'dtmLastUpdated' => date('Y-m-d H:i:s')
                            );
                            $whereOnHand = array(
                                'szProductId' => $produk[$j],
                                'szStockTypeId' => $stok,
                                'szReportedAsId' => $this->session->userdata('user_branch'),
                                'szLocationId' => $gudang
                            );
                        }
                    }
                    $btbOnHand = $this->mInventSupp->updateData($whereOnHand, $updOnHand, $base . '.dms_inv_stockonhand');
                    $onHandBtb = $this->mInventSupp->updateDms($whereOnHand, $updOnHand, 'dms.dms_inv_stockonhand');
                }
            } else {
                for ($k = 0; $k < count($produk); $k++) {
                    $onHand = array(
                        'iId' => $this->uuid->v4(),
                        'szProductId' => $produk[$k],
                        'szLocationType' => 'WAREHOUSE',
                        'szLocationId' => $gudang,
                        'szStockTypeId' => $stok,
                        'szReportedAsId' => $this->session->userdata('user_branch'),
                        'decQtyOnHand' => $qty[$k],
                        'szUomId' => $satuan[$k],
                        'szUserCreatedId' => $this->session->userdata('user_nik'),
                        'szUserUpdatedId' => $this->session->userdata('user_nik'),
                        'dtmCreated' => date('Y-m-d H:i:s'),
                        'dtmLastUpdated' => date('Y-m-d H:i:s')
                    );
                    $insertOnHand = $this->mInventSupp->simpanData($onHand, $base . '.dms_inv_stockonhand');
                }
            }

            if ($btbHeader == 'true' && $btbDetail == 'true' && $btbHistory == 'true' && $btbOnHand == 'true') {
                $this->session->set_flashdata('success', 'Data Sudah Tersimpan');
                header('Location: ' . base_url('inventSupp/historyBtb'));
                exit;
            } else {
                $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
                header('Location: ' . base_url('inventSupp/editBtb/' . $btbOld));
                exit;
            }
        }
    }
}
