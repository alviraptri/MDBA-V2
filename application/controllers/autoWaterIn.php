<?php
class autoWaterIn extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mAutoWaterIn');
        $this->load->model('mAuto');
    }

    public function autoWaterinOut()
    {
        $cek = $this->mAutoWaterIn->getArmadaWaktu();
        $id = '';
        $barcode = '';
        $po = '';
        $co = '';

        if ($cek != 0) {
            foreach ($cek as $value) {
                $id .= "'" . $value->mk_barcode . "',";
            }
            $lenId = strlen($id);
            $barcodeId = substr($id, 0, $lenId - 1);
        } else {
            $barcodeId = '0';
        }

        $waktuArmada = $this->mAutoWaterIn->getArmadaBarcodeWaktu($barcodeId);
        if ($waktuArmada != 0) {
            $armadaWaktu = $this->armadaWaktu($waktuArmada);
            if (!$waktuArmada) {
                echo "ARMADA Waktu : <pre>" . var_export($armadaWaktu, true) . "</pre>";
            } else {
                echo "armada Waktu sukses";
            }

            foreach ($waktuArmada as $value) {
                $barcode .= "'" . $value->mk_barcode . "',";
            }
            $lenBarcode = strlen($barcode);
            $waktuId = substr($barcode, 0, $lenBarcode - 1);
        } else {
            $waktuId = 0;
            echo "TBL WATERIN WAKTU SUDAH TERSIMPAN";
        }

        $barcodeArmada = $this->mAutoWaterIn->getArmadaBarcode($waktuId);
        if ($barcodeArmada != 0) {
            $armadaOut = $this->armadaOut($barcodeArmada);
            if (!$armadaOut) {
                echo "ARMADA OUT : <pre>" . var_export($armadaOut, true) . "</pre>";
            } else {
                echo "armada OUT sukses";
            }

            foreach ($barcodeArmada as $value) {
                $po .= "'" . $value->mk_po . "',";
                $co .= "'" . $value->mk_co_real . "',";
            }
            $lenPo = strlen($po);
            $poId = substr($po, 0, $lenPo - 1);

            $lenCo = strlen($co);
            $coId = substr($co, 0, $lenCo - 1);
        } else {
            $po = '0';
            $co = '0';
            echo "TBL WATERIN WAKTU SUDAH TERSIMPAN";
        }

        $coArmada = $this->mAutoWaterIn->getArmadaCo($coId);
        if ($coArmada != 0) {
            $armadaCO = $this->armadaCO($coArmada);
            if (!$armadaCO) {
                echo "ARMADA CO : <pre>" . var_export($armadaCO, true) . "</pre>";
            } else {
                echo "armada CO sukses";
            }
        } else {
            echo "TBL WATERIN CO SUDAH TERSIMPAN";
        }

        $poArmada = $this->mAutoWaterIn->getArmadaPo($poId);
        if ($poArmada != 0) {
            $armadaPO = $this->armadaPO($poArmada);
            if (!$armadaPO) {
                echo "ARMADA PO : <pre>" . var_export($armadaPO, true) . "</pre>";
            } else {
                echo "armada PO sukses";
            }
        } else {
            echo "TBL WATERIN PO SUDAH TERSIMPAN";
        }
    }

    public function armadaWaktu($armadaWaktu)
    {
        foreach ($armadaWaktu as $value) {
            // echo "<br> Armada Barcode : <pre>".var_export($value, true)."</pre><br>";

            $resWaktu = array(
                'mk_id' => $value->mk_id,
                'mk_barcode' => $value->mk_barcode,
                'mk_input' => $value->mk_input,
                'mk_masuk_pool' => $value->mk_masuk_pool,
                'mk_masuk_pool_tgl' => $value->mk_masuk_pool_tgl,
                'mk_masuk_pool_jam' => $value->mk_masuk_pool_jam,
                'mk_ke_pabrik_tgl' => $value->mk_ke_pabrik_tgl,
                'mk_ke_pabrik_jam' => $value->mk_ke_pabrik_jam,
                'mk_dari_pabrik_tgl' => $value->mk_dari_pabrik_tgl,
                'mk_dari_pabrik_jam' => $value->mk_dari_pabrik_jam,
                'mk_depo' => $value->mk_depo,
                'mk_so' => $value->mk_so,
                'mk_ke_tujuan_tgl' => $value->mk_ke_tujuan_tgl,
                'mk_ke_tujuan_jam' => $value->mk_ke_tujuan_jam,
                'mk_masuk_tujuan' => $value->mk_masuk_tujuan,
                'mk_masuk_tujuan_tgl' => $value->mk_masuk_tujuan_tgl,
                'mk_masuk_tujuan_jam' => $value->mk_masuk_tujuan_jam,
                'mk_masuk_tujuan1_tgl' => $value->mk_masuk_tujuan1_tgl,
                'mk_masuk_tujuan1_jam' => $value->mk_masuk_tujuan1_jam,
                'mk_keluar_tujuan_tgl' => $value->mk_keluar_tujuan_tgl,
                'mk_keluar_tujuan_jam' => $value->mk_keluar_tujuan_jam,
                'mk_bongkar_tgl' => $value->mk_bongkar_tgl,
                'mk_bongkar_jam' => $value->mk_bongkar_jam,
                'mk_muat_tgl' => $value->mk_muat_tgl,
                'mk_muat_jam' => $value->mk_muat_jam,
                'mk_kembali_pool' => $value->mk_kembali_pool,
                'mk_kembali_pool_tgl' => $value->mk_kembali_pool_tgl,
                'mk_kembali_pool_jam' => $value->mk_kembali_pool_jam,
                'mk_masuk_pabrik_jam' => $value->mk_masuk_pabrik_jam,
                'mk_masuk_pabrik_tgl' => $value->mk_masuk_pabrik_tgl,
                'mk_keluar_pabrik_jam' => $value->mk_keluar_pabrik_jam,
                'mk_keluar_pabrik_tgl' => $value->mk_keluar_pabrik_tgl,
                'mk_status_antri' => $value->mk_status_antri,
                'mk_bypass_status' => $value->mk_bypass_status,
                'mk_bypass_reason' => $value->mk_bypass_reason
            );
            // echo "<br> Armada Barcode Waktu: <pre>".var_export($resWaktu, true)."</pre><br>";
            
            $this->mAuto->simpanData($resWaktu, 'mdba.mdbawiarmadaoutwaktu');
                        
        }
    }

    public function armadaOut($barcodeArmada)
    {
        foreach($barcodeArmada as $value){
            $resArmada = array(
                'mk_barcode' => $value->mk_barcode, 
                'mk_pool' => $value->mk_pool,
                'mk_armada_nopol' => $value->mk_armada_nopol,
                'mk_armada_driver' => $value->mk_armada_driver,
                'mk_armada_driver_pengganti' => $value->mk_armada_driver_pengganti,
                'mk_varian_label' => $value->mk_varian_label,
                'mk_varian_muatan' => $value->mk_varian_muatan,
                'transporter_kode' => '0',
                'mk_transporter_kode_per' => $value->mk_transporter_kode_per,
                'mk_po' => $value->mk_po,
                'mk_po_old' => $value->mk_po_old,
                'mk_po_return_isi' => $value->mk_po_return_isi,
                'mk_po_gal_kos' => $value->mk_po_gal_kos,
                'mk_po_jugrack' => $value->mk_po_jugrack,
                'mk_po_palet' => $value->mk_po_palet,
                'mk_depo_asal' => $value->mk_depo_asal,
                'mk_so_asal' => $value->mk_so_asal,
                'mk_depo_tujuan' => $value->mk_depo_tujuan,
                'mk_so_tujuan' => $value->mk_so_tujuan,
                'mk_divert_plan_depo' => $value->mk_divert_plan_depo,
                'mk_divert_plan_so' => $value->mk_divert_plan_so,
                'pabrik_nama' => $value->pabrik_nama,
                'material_nama' => $value->material_nama,
                'mk_co_plan' => $value->mk_co_plan,
                'mk_co_real' => $value->mk_co_real,
                'mk_co_uro' => $value->mk_co_uro,
                'mk_dn_m' => $value->mk_dn_m,
                'mk_dn_m_qty' => $value->mk_dn_m_qty,
                'mk_dn_t' => $value->mk_dn_t,
                'mk_dn_t_qty' => $value->mk_dn_t_qty,
                'mk_dn_van' => $value->mk_dn_van,
                'mk_dn_date' => $value->mk_dn_date,
                'mk_gr' => $value->mk_gr,
                'mk_gr_qty' => $value->mk_gr_qty,
                'mk_tm_gal_isi' => $value->mk_tm_gal_isi,
                'mk_tm_gal_kos' => $value->mk_tm_gal_kos,
                'mk_tm_hp3' => $value->mk_tm_hp3,
                'mk_tk_gal_isi_aqua' => $value->mk_tk_gal_isi_aqua,
                'mk_tk_gal_isi_vit' => $value->mk_tk_gal_isi_vit,
                'mk_tk_gal_kos_aqua' => $value->mk_tk_gal_kos_aqua,
                'mk_tk_gal_kos_vit' => $value->mk_tk_gal_kos_vit,
                'mk_tmd_gal_isi_aqua' => $value->mk_tmd_gal_isi_aqua,
                'mk_tmd_gal_isi_vit' => $value->mk_tmd_gal_isi_vit,
                'mk_tmd_gal_kosong_aqua' => $value->mk_tmd_gal_kosong_aqua,
                'mk_tmd_gal_kosong_vit' => $value->mk_tmd_gal_kosong_vit,
                'mk_keterangan' => $value->mk_keterangan,
                'mk_bs_depo' => $value->mk_bs_depo,
                'mk_forklift' => $value->mk_forklift,
                'mk_jugrack' => $value->mk_jugrack,
                'mk_palet' => $value->mk_palet,
                'mk_wo' => $value->mk_wo,
                'mk_note' => $value->mk_note,
                'mk_reason' => $value->mk_reason,
                'mk_bs_bongkar' => $value->mk_bs_bongkar,
                'mk_bs_rusak' => $value->mk_bs_rusak,
                'mk_bs_sps' => $value->mk_bs_sps,
                'mk_bs_handling' => $value->mk_bs_handling,
                'mk_muatan_keluar' => $value->mk_muatan_keluar,
                'mk_muatan_masuk' => $value->mk_muatan_masuk,
                'mk_status_rekap' => $value->mk_status_rekap,
                'mk_status_pool_isi' => $value->mk_status_pool_isi,
                'mk_status_unpost_aco' => $value->mk_status_unpost_aco,
                'mk_status_unpost_checker' => $value->mk_status_unpost_checker,
                'mk_tolakan_turun' => $value->mk_tolakan_turun,
                'mk_pengajuan_unpost' => $value->mk_pengajuan_unpost
            );
            // echo "<br> Armada Barcode : <pre>".var_export($resArmada, true)."</pre><br>";
            $this->mAuto->simpanData($resArmada, 'mdba.mdbawiarmadaout');   
        }
    }

    public function armadaPO($poArmada)
    {
        foreach ($poArmada as $value) {
            // echo "<br> Armada Barcode : <pre>".var_export($value, true)."</pre><br>";

            $resPo = array(
                'po_id' => $value->po_id,
                'po_nopol' => $value->po_nopol,
                'po_driver' => $value->po_driver,
                'po_driver_pengganti' => $value->po_driver_pengganti,
                'po_varian_label' => $value->po_varian_label,
                'po_varian_muatan' => $value->po_varian_muatan,
                'po_transporter_kode' => $value->po_transporter_kode,
                'po_transporter_kode_per' => $value->po_transporter_kode_per,
                'po_po_new' => $value->po_po_new,
                'po_po_old' => $value->po_po_old,
                'po_return_isi' => $value->po_return_isi,
                'po_gal_kos' => $value->po_gal_kos,
                'po_jugrack' => $value->po_jugrack,
                'po_palet' => $value->po_palet,
                'po_depo' => $value->po_depo,
                'po_pool' => $value->po_pool,
                'po_tgl' => $value->po_tgl,
                'po_jam' => $value->po_jam,
                'po_status' => $value->po_status,
                'po_pabrik' => $value->po_pabrik,
                'po_sku' => $value->po_sku,
                'po_bs_isi' => $value->po_bs_isi,
                'po_bs_ksg' => $value->po_bs_ksg,
                'po_pabrik1' => $value->po_pabrik1,
                'po_bs_isi1' => $value->po_bs_isi1,
                'po_bs_ksg1' => $value->po_bs_ksg1,
                'po_kat_palet' => $value->po_kat_palet,
                'po_tissue' => $value->po_tissue,
                'po_co' => $value->po_co
            );
            // echo "<br> Armada Barcode Waktu: <pre>".var_export($resPo, true)."</pre><br>";
            $this->mAuto->simpanData($resPo, 'mdba.mdbawiarmadaoutpo');               
        }
    }

    public function armadaCO($coArmada)
    {
        foreach ($coArmada as $value) {
            // echo "<br> Armada Barcode : <pre>".var_export($value, true)."</pre><br>";

            $resPo = array(
                'js_id' => $value->js_id,
                'js_week' => $value->js_week,
                'js_day' => $value->js_day,
                'js_date_p' => $value->js_date_p,
                'js_date' => $value->js_date,
                'depo_pt' => $value->depo_pt,
                'sku_nama' => $value->sku_nama,
                'k_produk_nama' => $value->k_produk_nama,
                'material_nama' => $value->material_nama,
                'js_co' => $value->js_co,
                'js_window' => $value->js_window,
                'varian_label' => $value->varian_label,
                'varian_muatan' => $value->varian_muatan,
                'transporter_kode' => $value->transporter_kode,
                'transporter_kode1' => $value->transporter_kode1,
                'pabrik_nama' => $value->pabrik_nama,
                'js_tujuan_co' => $value->js_tujuan_co,
                'js_tujuan_depo' => $value->js_tujuan_depo,
                'js_tujuan_so' => $value->js_tujuan_so,
                'js_tujuan_divert' => $value->js_tujuan_divert,
                'js_tgl' => $value->js_tgl,
                'js_jam' => $value->js_jam,
                'js_nopol_trans' => $value->js_nopol_trans,
                'js_nopol_pool' => $value->js_nopol_pool,
                'js_type' => $value->js_type,
                'js_kendala' => $value->js_kendala,
                'js_kendala_detail' => $value->js_kendala_detail,
                'keterangan' => $value->keterangan
            );
            // echo "<br> Armada Barcode Waktu: <pre>".var_export($resPo, true)."</pre><br>";
            $this->mAuto->simpanData($resPo, 'mdba.mdbawiarmadaoutjadwal');               
        }
    }

    //BTB
    public function autoWaterinIn()
    {
        $cek = $this->mAutoWaterIn->getArmadaWaktuIn();
        $id = '';
        $barcode = '';
        $po = '';
        $co = '';

        if ($cek != 0) {
            foreach ($cek as $value) {
                $id .= "'" . $value->mk_barcode . "',";
            }
            $lenId = strlen($id);
            $barcodeId = substr($id, 0, $lenId - 1);
        } else {
            $barcodeId = '0';
        }

        $waktuArmada = $this->mAutoWaterIn->getArmadaBarcodeWaktuIn($barcodeId);
        if ($waktuArmada != 0) {
            $armadaWaktu = $this->armadaWaktuIn($waktuArmada);
            if (!$waktuArmada) {
                echo "ARMADA Waktu : <pre>" . var_export($armadaWaktu, true) . "</pre>";
            } else {
                echo "armada Waktu sukses";
            }

            foreach ($waktuArmada as $value) {
                $barcode .= "'" . $value->mk_barcode . "',";
            }
            $lenBarcode = strlen($barcode);
            $waktuId = substr($barcode, 0, $lenBarcode - 1);
        } else {
            $waktuId = 0;
            echo "TBL WATERIN WAKTU SUDAH TERSIMPAN";
        }

        $barcodeArmada = $this->mAutoWaterIn->getArmadaBarcodeIn($waktuId);
        if ($barcodeArmada != 0) {
            $armadaOut = $this->armadaIn($barcodeArmada);
            if (!$armadaOut) {
                echo "ARMADA OUT : <pre>" . var_export($armadaOut, true) . "</pre>";
            } else {
                echo "armada OUT sukses";
            }

            foreach ($barcodeArmada as $value) {
                $po .= "'" . $value->mk_po . "',";
                $co .= "'" . $value->mk_co_real . "',";
            }
            $lenPo = strlen($po);
            $poId = substr($po, 0, $lenPo - 1);

            $lenCo = strlen($co);
            $coId = substr($co, 0, $lenCo - 1);
        } else {
            $coId = 0;
            $poId = 0;
            echo "TBL WATERIN WAKTU SUDAH TERSIMPAN";
        }

        $coArmada = $this->mAutoWaterIn->getArmadaCoIn($coId);
        if ($coArmada != 0) {
            $armadaCO = $this->armadaCOIn($coArmada);
            if (!$armadaCO) {
                echo "ARMADA CO : <pre>" . var_export($armadaCO, true) . "</pre>";
            } else {
                echo "armada CO sukses";
            }
        } else {
            echo "TBL WATERIN CO SUDAH TERSIMPAN";
        }

        $poArmada = $this->mAutoWaterIn->getArmadaPoIn($poId);
        if ($poArmada != 0) {
            $armadaPO = $this->armadaPOIn($poArmada);
            if (!$armadaPO) {
                echo "ARMADA PO : <pre>" . var_export($armadaPO, true) . "</pre>";
            } else {
                echo "armada PO sukses";
            }
        } else {
            echo "TBL WATERIN PO SUDAH TERSIMPAN";
        }
    }

    public function armadaWaktuIn($armadaWaktu)
    {
        foreach ($armadaWaktu as $value) {
            // echo "<br> Armada Barcode : <pre>".var_export($value, true)."</pre><br>";

            $resWaktu = array(
                'mk_id' => $value->mk_id,
                'mk_barcode' => $value->mk_barcode,
                'mk_input' => $value->mk_input,
                'mk_masuk_pool' => $value->mk_masuk_pool,
                'mk_masuk_pool_tgl' => $value->mk_masuk_pool_tgl,
                'mk_masuk_pool_jam' => $value->mk_masuk_pool_jam,
                'mk_ke_pabrik_tgl' => $value->mk_ke_pabrik_tgl,
                'mk_ke_pabrik_jam' => $value->mk_ke_pabrik_jam,
                'mk_dari_pabrik_tgl' => $value->mk_dari_pabrik_tgl,
                'mk_dari_pabrik_jam' => $value->mk_dari_pabrik_jam,
                'mk_depo' => $value->mk_depo,
                'mk_so' => $value->mk_so,
                'mk_ke_tujuan_tgl' => $value->mk_ke_tujuan_tgl,
                'mk_ke_tujuan_jam' => $value->mk_ke_tujuan_jam,
                'mk_masuk_tujuan' => $value->mk_masuk_tujuan,
                'mk_masuk_tujuan_tgl' => $value->mk_masuk_tujuan_tgl,
                'mk_masuk_tujuan_jam' => $value->mk_masuk_tujuan_jam,
                'mk_masuk_tujuan1_tgl' => $value->mk_masuk_tujuan1_tgl,
                'mk_masuk_tujuan1_jam' => $value->mk_masuk_tujuan1_jam,
                'mk_keluar_tujuan_tgl' => $value->mk_keluar_tujuan_tgl,
                'mk_keluar_tujuan_jam' => $value->mk_keluar_tujuan_jam,
                'mk_bongkar_tgl' => $value->mk_bongkar_tgl,
                'mk_bongkar_jam' => $value->mk_bongkar_jam,
                'mk_muat_tgl' => $value->mk_muat_tgl,
                'mk_muat_jam' => $value->mk_muat_jam,
                'mk_kembali_pool' => $value->mk_kembali_pool,
                'mk_kembali_pool_tgl' => $value->mk_kembali_pool_tgl,
                'mk_kembali_pool_jam' => $value->mk_kembali_pool_jam,
                'mk_masuk_pabrik_jam' => $value->mk_masuk_pabrik_jam,
                'mk_masuk_pabrik_tgl' => $value->mk_masuk_pabrik_tgl,
                'mk_keluar_pabrik_jam' => $value->mk_keluar_pabrik_jam,
                'mk_keluar_pabrik_tgl' => $value->mk_keluar_pabrik_tgl,
                'mk_status_antri' => $value->mk_status_antri,
                'mk_bypass_status' => $value->mk_bypass_status,
                'mk_bypass_reason' => $value->mk_bypass_reason
            );
            // echo "<br> Armada Barcode Waktu: <pre>".var_export($resWaktu, true)."</pre><br>";
            $this->mAuto->simpanData($resWaktu, 'mdba.mdbawiarmadainwaktu');              
        }
    }

    public function armadaIn($barcodeArmada)
    {
        foreach($barcodeArmada as $value){
            $resArmada = array(
                'mk_barcode' => $value->mk_barcode, 
                'mk_pool' => $value->mk_pool,
                'mk_armada_nopol' => $value->mk_armada_nopol,
                'mk_armada_driver' => $value->mk_armada_driver,
                'mk_armada_driver_pengganti' => $value->mk_armada_driver_pengganti,
                'mk_varian_label' => $value->mk_varian_label,
                'mk_varian_muatan' => $value->mk_varian_muatan,
                'transporter_kode' => '0',
                'mk_transporter_kode_per' => $value->mk_transporter_kode_per,
                'mk_po' => $value->mk_po,
                'mk_po_old' => $value->mk_po_old,
                'mk_po_return_isi' => $value->mk_po_return_isi,
                'mk_po_gal_kos' => $value->mk_po_gal_kos,
                'mk_po_jugrack' => $value->mk_po_jugrack,
                'mk_po_palet' => $value->mk_po_palet,
                'mk_depo_asal' => $value->mk_depo_asal,
                'mk_so_asal' => $value->mk_so_asal,
                'mk_depo_tujuan' => $value->mk_depo_tujuan,
                'mk_so_tujuan' => $value->mk_so_tujuan,
                'mk_divert_plan_depo' => $value->mk_divert_plan_depo,
                'mk_divert_plan_so' => $value->mk_divert_plan_so,
                'pabrik_nama' => $value->pabrik_nama,
                'material_nama' => $value->material_nama,
                'mk_co_plan' => $value->mk_co_plan,
                'mk_co_real' => $value->mk_co_real,
                'mk_co_uro' => $value->mk_co_uro,
                'mk_dn_m' => $value->mk_dn_m,
                'mk_dn_m_qty' => $value->mk_dn_m_qty,
                'mk_dn_t' => $value->mk_dn_t,
                'mk_dn_t_qty' => $value->mk_dn_t_qty,
                'mk_dn_van' => $value->mk_dn_van,
                'mk_dn_date' => $value->mk_dn_date,
                'mk_gr' => $value->mk_gr,
                'mk_gr_qty' => $value->mk_gr_qty,
                'mk_tm_gal_isi' => $value->mk_tm_gal_isi,
                'mk_tm_gal_kos' => $value->mk_tm_gal_kos,
                'mk_tm_hp3' => $value->mk_tm_hp3,
                'mk_tk_gal_isi_aqua' => $value->mk_tk_gal_isi_aqua,
                'mk_tk_gal_isi_vit' => $value->mk_tk_gal_isi_vit,
                'mk_tk_gal_kos_aqua' => $value->mk_tk_gal_kos_aqua,
                'mk_tk_gal_kos_vit' => $value->mk_tk_gal_kos_vit,
                'mk_tmd_gal_isi_aqua' => $value->mk_tmd_gal_isi_aqua,
                'mk_tmd_gal_isi_vit' => $value->mk_tmd_gal_isi_vit,
                'mk_tmd_gal_kosong_aqua' => $value->mk_tmd_gal_kosong_aqua,
                'mk_tmd_gal_kosong_vit' => $value->mk_tmd_gal_kosong_vit,
                'mk_keterangan' => $value->mk_keterangan,
                'mk_bs_depo' => $value->mk_bs_depo,
                'mk_forklift' => $value->mk_forklift,
                'mk_jugrack' => $value->mk_jugrack,
                'mk_palet' => $value->mk_palet,
                'mk_wo' => $value->mk_wo,
                'mk_note' => $value->mk_note,
                'mk_reason' => $value->mk_reason,
                'mk_bs_bongkar' => $value->mk_bs_bongkar,
                'mk_bs_rusak' => $value->mk_bs_rusak,
                'mk_bs_sps' => $value->mk_bs_sps,
                'mk_bs_handling' => $value->mk_bs_handling,
                'mk_muatan_keluar' => $value->mk_muatan_keluar,
                'mk_muatan_masuk' => $value->mk_muatan_masuk,
                'mk_status_rekap' => $value->mk_status_rekap,
                'mk_status_pool_isi' => $value->mk_status_pool_isi,
                'mk_status_unpost_aco' => $value->mk_status_unpost_aco,
                'mk_status_unpost_checker' => $value->mk_status_unpost_checker,
                'mk_tolakan_turun' => $value->mk_tolakan_turun,
                'mk_pengajuan_unpost' => $value->mk_pengajuan_unpost
            );
            // echo "<br> Armada Barcode : <pre>".var_export($resArmada, true)."</pre><br>";
            $this->mAuto->simpanData($resArmada, 'mdba.mdbawiarmadain');  
        }
    }

    public function armadaPOIn($poArmada)
    {
        foreach ($poArmada as $value) {
            // echo "<br> Armada Barcode : <pre>".var_export($value, true)."</pre><br>";

            $resPo = array(
                'po_id' => $value->po_id,
                'po_nopol' => $value->po_nopol,
                'po_driver' => $value->po_driver,
                'po_driver_pengganti' => $value->po_driver_pengganti,
                'po_varian_label' => $value->po_varian_label,
                'po_varian_muatan' => $value->po_varian_muatan,
                'po_transporter_kode' => $value->po_transporter_kode,
                'po_transporter_kode_per' => $value->po_transporter_kode_per,
                'po_po_new' => $value->po_po_new,
                'po_po_old' => $value->po_po_old,
                'po_return_isi' => $value->po_return_isi,
                'po_gal_kos' => $value->po_gal_kos,
                'po_jugrack' => $value->po_jugrack,
                'po_palet' => $value->po_palet,
                'po_depo' => $value->po_depo,
                'po_pool' => $value->po_pool,
                'po_tgl' => $value->po_tgl,
                'po_jam' => $value->po_jam,
                'po_status' => $value->po_status,
                'po_pabrik' => $value->po_pabrik,
                'po_sku' => $value->po_sku,
                'po_bs_isi' => $value->po_bs_isi,
                'po_bs_ksg' => $value->po_bs_ksg,
                'po_pabrik1' => $value->po_pabrik1,
                'po_bs_isi1' => $value->po_bs_isi1,
                'po_bs_ksg1' => $value->po_bs_ksg1,
                'po_kat_palet' => $value->po_kat_palet,
                'po_tissue' => $value->po_tissue,
                'po_co' => $value->po_co
            );
            // echo "<br> Armada Barcode Waktu: <pre>".var_export($resPo, true)."</pre><br>";
            $this->mAuto->simpanData($resPo, 'mdba.mdbawiarmadainpo');               
        }
    }

    public function armadaCOIn($coArmada)
    {
        foreach ($coArmada as $value) {
            // echo "<br> Armada Barcode : <pre>".var_export($value, true)."</pre><br>";

            $resPo = array(
                'js_id' => $value->js_id,
                'js_week' => $value->js_week,
                'js_day' => $value->js_day,
                'js_date_p' => $value->js_date_p,
                'js_date' => $value->js_date,
                'depo_pt' => $value->depo_pt,
                'sku_nama' => $value->sku_nama,
                'k_produk_nama' => $value->k_produk_nama,
                'material_nama' => $value->material_nama,
                'js_co' => $value->js_co,
                'js_window' => $value->js_window,
                'varian_label' => $value->varian_label,
                'varian_muatan' => $value->varian_muatan,
                'transporter_kode' => $value->transporter_kode,
                'transporter_kode1' => $value->transporter_kode1,
                'pabrik_nama' => $value->pabrik_nama,
                'js_tujuan_co' => $value->js_tujuan_co,
                'js_tujuan_depo' => $value->js_tujuan_depo,
                'js_tujuan_so' => $value->js_tujuan_so,
                'js_tujuan_divert' => $value->js_tujuan_divert,
                'js_tgl' => $value->js_tgl,
                'js_jam' => $value->js_jam,
                'js_nopol_trans' => $value->js_nopol_trans,
                'js_nopol_pool' => $value->js_nopol_pool,
                'js_type' => $value->js_type,
                'js_kendala' => $value->js_kendala,
                'js_kendala_detail' => $value->js_kendala_detail,
                'keterangan' => $value->keterangan
            );
            // echo "<br> Armada Barcode Waktu: <pre>".var_export($resPo, true)."</pre><br>";
            $this->mAuto->simpanData($resPo, 'mdba.mdbawiarmadainjadwal');               
        }
    }
}

?>