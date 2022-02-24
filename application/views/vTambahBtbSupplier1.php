<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BTB SUPPLIER</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/app.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/wizard/css/bd-wizard.css">

</head>

<body>
    <div id="app">
        <?php include('sideBar.php'); ?>
        <div id="main">
            <?php include('navBar.php'); ?>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>BTB Supplier</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">BTB Supplier</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <main class="my-5">
                                <div class="container">
                                    <div id="wizard">
                                        <!-- <form method="post" action="<?php echo base_url('inventori/createBtbSupplier'); ?>"> -->
                                        <h3>
                                            <div class="media">
                                                <!-- <div class="bd-wizard-step-icon"><i class="mdi mdi-account-outline"></i></div> -->
                                                <div class="media-body">
                                                    <div class="bd-wizard-step-title">Purchase Order</div>
                                                    <div class="bd-wizard-step-subtitle">Step 1</div>
                                                </div>
                                            </div>
                                        </h3>

                                        <section>
                                            <div class="content-wrapper">
                                                <!-- <h4>Enter your Personal details </h4> -->
                                                <?php
                                                foreach ($data as $value) { ?>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="firstName" class="sr-only">No. PO</label>
                                                            <input type="text" name="noPo" id="noPo" class="form-control" readonly value="<?= $value->po_po_old ?>">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <!-- <div class="form-group col-md-4">
                                                            <h4>Checker Pool</h4>
                                                            <label for="firstName" class="sr-only">Return Isi</label>
                                                            <input type="text" name="returnIsiPool" id="returnIsiPool" class="form-control" readonly>
                                                        </div> -->
                                                        <div class="form-group col-md-6">
                                                            <h4>Checker Depo</h4>
                                                            <label for="firstName" class="sr-only">Return Isi</label>
                                                            <input type="text" name="returnIsiDepo" id="returnIsiDepo" class="form-control" readonly value="<?= $value->po_return_isi ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <h4>Admin Depo</h4>
                                                            <label for="firstName" class="sr-only">Return Isi</label>
                                                            <input type="text" name="returnIsiAdm" id="returnIsiAdm" class="form-control" value="<?= $value->po_return_isi ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="form-group col-md-4">
                                                            <label for="phoneNumber" class="sr-only">Jugrack</label>
                                                            <input type="text" name="jugrackPool" id="jugrackPool" class="form-control" readonly>
                                                        </div> -->
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Jugrack</label>
                                                            <input type="text" name="jugrackDepo" id="jugrackDepo" class="form-control" readonly value="<?= $value->po_jugrack ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Jugrack</label>
                                                            <input type="text" name="jugrackAdm" id="jugrackAdm" class="form-control" value="<?= $value->po_jugrack ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="form-group col-md-4">
                                                            <label for="phoneNumber" class="sr-only">Galon Kosong</label>
                                                            <input type="text" name="glnKosongPool" id="glnKosongPool" class="form-control" readonly>
                                                        </div> -->
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Galon Kosong</label>
                                                            <input type="text" name="glnKosongDepo" id="glnKosongDepo" class="form-control" readonly value="<?= $value->po_gal_kos ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Galon Kosong</label>
                                                            <input type="text" name="glnKosongAdm" id="glnKosongAdm" class="form-control" value="<?= $value->po_gal_kos ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="form-group col-md-4">
                                                            <label for="phoneNumber" class="sr-only">Palet</label>
                                                            <input type="text" name="paletPool" id="paletPool" class="form-control" readonly>
                                                        </div> -->
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Palet</label>
                                                            <input type="text" name="paletDepo" id="paletDepo" class="form-control" readonly value="<?= $value->po_palet ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Palet</label>
                                                            <input type="text" name="paletAdm" id="paletAdm" class="form-control" value="<?= $value->po_palet ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="form-group col-md-4">
                                                            <label for="phoneNumber" class="sr-only">Nopol</label>
                                                            <input type="text" name="nopolPool" id="nopolPool" class="form-control" readonly>
                                                        </div> -->
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Nopol</label>
                                                            <input type="text" name="nopolDepo" id="nopolDepo" class="form-control" readonly value="<?= $value->po_nopol ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Nopol</label>
                                                            <input type="text" name="nopolAdm" id="nopolAdm" class="form-control" value="<?= $value->po_nopol ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="form-group col-md-4">
                                                            <label for="phoneNumber" class="sr-only">Supir</label>
                                                            <input type="text" name="driverPool" id="driverPool" class="form-control" readonly>
                                                        </div> -->
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Supir</label>
                                                            <input type="text" name="driverDepo" id="driverDepo" class="form-control" readonly value="<?= $value->po_driver ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Supir</label>
                                                            <input type="text" name="driverAdm" id="driverAdm" class="form-control" value="<?= $value->po_driver ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="form-group col-md-4">
                                                            <label for="phoneNumber" class="sr-only">Supir Pengganti</label>
                                                            <input type="text" name="driver2Pool" id="driver2Pool" class="form-control" readonly>
                                                        </div> -->
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Supir Pengganti</label>
                                                            <input type="text" name="driver2Depo" id="driver2Depo" class="form-control" readonly value="<?= $value->po_driver_pengganti ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Supir Pengganti</label>
                                                            <input type="text" name="driver2Adm" id="driver2Adm" class="form-control" value="<?= $value->po_driver_pengganti ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="form-group col-md-4">
                                                            <label for="phoneNumber" class="sr-only">Transporter</label>
                                                            <input type="text" name="transporterPool" id="transporterPool" class="form-control" readonly>
                                                        </div> -->
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Transporter</label>
                                                            <input type="text" name="transporterDepo" id="transporterDepo" class="form-control" readonly value="<?= $value->transporter_nama_npwp ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Transporter</label>
                                                            <input type="text" name="transporterAdm" id="transporterAdm" class="form-control" value="<?= $value->transporter_nama_npwp ?>">
                                                        </div>
                                                    </div>
                                            </div>
                                        </section>
                                        <h3>
                                            <div class="media">
                                                <!-- <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div> -->
                                                <div class="media-body">
                                                    <div class="bd-wizard-step-title">Collection Order</div>
                                                    <div class="bd-wizard-step-subtitle">Step 2</div>
                                                </div>
                                            </div>
                                        </h3>
                                        <section>
                                            <div class="content-wrapper">
                                                <!-- <h4 class="section-heading">Enter your Employment details </h4> -->
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="firstName" class="sr-only">No. CO</label>
                                                        <input type="text" name="noCo" id="noCo" class="form-control" readonly value="<?= $value->po_co ?>">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <h4>Checker Pool</h4>
                                                        <label for="firstName" class="sr-only">Hari</label>
                                                        <input type="text" name="hariPool" id="hariPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <h4>Checker Depo</h4>
                                                        <label for="firstName" class="sr-only">Hari</label>
                                                        <input type="text" name="hariDepo" id="hariDepo" class="form-control" readonly value="<?= $value->js_day ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h4>Admin Depo</h4>
                                                        <label for="firstName" class="sr-only">Hari</label>
                                                        <input type="text" name="hariAdm" id="hariAdm" class="form-control" value="<?= $value->js_day ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <label for="phoneNumber" class="sr-only">Tanggal Window</label>
                                                        <input type="text" name="tglWindowPool" id="tglWindowPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Tanggal Window</label>
                                                        <input type="text" name="tglWindowDepo" id="tglWindowDepo" class="form-control" readonly value="<?= $value->js_date ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Tanggal Window</label>
                                                        <input type="text" name="tglWindowAdm" id="tglWindowAdm" class="form-control" value="<?= $value->js_date ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <label for="phoneNumber" class="sr-only">Pabrik Window</label>
                                                        <input type="text" name="pabrikWindowPool" id="pabrikWindowPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Pabrik Window</label>
                                                        <input type="text" name="pabrikWindowDepo" id="pabrikWindowDepo" class="form-control" readonly value="<?= $value->pabrik_nama ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Pabrik Window</label>
                                                        <input type="text" name="pabrikWindowAdm" id="pabrikWindowAdm" class="form-control" value="<?= $value->pabrik_nama ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <label for="phoneNumber" class="sr-only">Material</label>
                                                        <input type="text" name="materialPool" id="materialPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Material</label>
                                                        <input type="text" name="materialDepo" id="materialDepo" class="form-control" readonly value="<?= $value->material_nama ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Material</label>
                                                        <input type="text" name="materialAdm" id="materialAdm" class="form-control" value="<?= $value->material_nama ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <label for="phoneNumber" class="sr-only">Tujuan Awal</label>
                                                        <input type="text" name="tujuanAwalPool" id="tujuanAwalPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Tujuan Awal</label>
                                                        <input type="text" name="tujuanAwalDepo" id="tujuanAwalDepo" class="form-control" readonly value="<?= $value->js_tujuan_co ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Tujuan Awal</label>
                                                        <input type="text" name="tujuanAwalAdm" id="tujuanAwalAdm" class="form-control" value="<?= $value->js_tujuan_co ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <label for="phoneNumber" class="sr-only">Tujuan Final Depo</label>
                                                        <input type="text" name="tujuanFinalPool" id="tujuanFinalPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Tujuan Final Depo</label>
                                                        <input type="text" name="tujuanFinalDepo" id="tujuanFinalDepo" class="form-control" readonly value="<?= $value->mk_masuk_tujuan ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Tujuan Final Depo</label>
                                                        <input type="text" name="tujuanFinalAdm" id="tujuanFinalAdm" class="form-control" value="<?= $value->mk_masuk_tujuan ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <label for="phoneNumber" class="sr-only">Tujuan Final CO</label>
                                                        <input type="text" name="tujuanCoPool" id="TujuanCoPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Tujuan Final CO</label>
                                                        <input type="text" name="tujuanCoDepo" id="TujuanCoDepo" class="form-control" readonly value="<?= $value->mk_depo_tujuan ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Tujuan Final CO</label>
                                                        <input type="text" name="tujuanCoAdm" id="TujuanCoAdm" class="form-control" value="<?= $value->mk_depo_tujuan ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>
                                            <div class="media">
                                                <!-- <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div> -->
                                                <div class="media-body">
                                                    <div class="bd-wizard-step-title">Good Return</div>
                                                    <div class="bd-wizard-step-subtitle">Step 3</div>
                                                </div>
                                            </div>
                                        </h3>
                                        <section>
                                            <div class="content-wrapper">
                                                <!-- <h4 class="section-heading">Enter your Employment details </h4> -->
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="firstName" class="sr-only">No. GR</label>
                                                        <input type="text" name="noGr" id="noGr" class="form-control" readonly value="<?= $value->mk_gr ?>">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <h4>Checker Pool</h4>
                                                        <label for="firstName" class="sr-only">Dikirim Ke</label>
                                                        <input type="text" name="sendPool" id="sendPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <h4>Checker Depo</h4>
                                                        <label for="firstName" class="sr-only">Dikirim Ke</label>
                                                        <input type="text" name="sendDepo" id="sendDepo" class="form-control" readonly value="<?= $value->js_tujuan_co ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h4>Admin Depo</h4>
                                                        <label for="firstName" class="sr-only">Dikirim Ke</label>
                                                        <input type="text" name="sendAdm" id="sendAdm" class="form-control" value="<?= $value->js_tujuan_co ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <label for="firstName" class="sr-only">Produk</label>
                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-4">
                                                        <label for="firstName" class="sr-only">Produk</label>
                                                        <input type="text" name="produkGrDepo" id="produkGrDepo" class="form-control" readonly value="<?= $value->material_nama ?>">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="firstName" class="sr-only">Qty</label>
                                                        <input type="text" name="qtyGrDepo" id="qtyGrDepo" class="form-control" readonly value="<?= $value->mk_gr_qty ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="firstName" class="sr-only">Produk</label>
                                                        <input type="text" name="produkGrAdm" id="produkGrAdm" class="form-control" value="<?= $value->material_nama ?>">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="firstName" class="sr-only">Qty</label>
                                                        <input type="text" name="qtyGrAdm" id="qtyGrAdm" class="form-control" value="<?= $value->mk_gr_qty ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <h3>
                                            <div class="media">
                                                <!-- <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div> -->
                                                <div class="media-body">
                                                    <div class="bd-wizard-step-title">Delivery Note</div>
                                                    <div class="bd-wizard-step-subtitle">Step 4</div>
                                                </div>
                                            </div>
                                        </h3>
                                        <section>
                                            <div class="content-wrapper">
                                                <!-- <h4 class="section-heading">Enter your Employment details </h4> -->
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="firstName" class="sr-only">No. DN</label>
                                                        <input type="text" name="noDn" id="noDn" class="form-control" readonly value="<?= $value->mk_dn_t ?>">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <h4>Checker Pool</h4>
                                                        <label for="firstName" class="sr-only">Tanggal DN</label>
                                                        <input type="text" name="tglDnPool" id="tglDnPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <h4>Checker Depo</h4>
                                                        <label for="firstName" class="sr-only">Tanggal DN</label>
                                                        <input type="text" name="tglDnDepo" id="tglDnDepo" class="form-control" readonly value="<?= $value->mk_dn_date ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <h4>Admin Depo</h4>
                                                        <label for="firstName" class="sr-only">Tanggal DN</label>
                                                        <input type="text" name="tglDnAdm" id="tglDnAdm" class="form-control" value="<?= $value->mk_dn_date ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <h4>Checker Pool</h4>
                                                        <label for="firstName" class="sr-only">Dikirim Ke</label>
                                                        <input type="text" name="sendDnPool" id="sendDnPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="firstName" class="sr-only">Dikirim Ke</label>
                                                        <input type="text" name="sendDnDepo" id="sendDnDepo" class="form-control" readonly value="<?= $value->js_tujuan_co ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="firstName" class="sr-only">Dikirim Ke</label>
                                                        <input type="text" name="sendDnAdm" id="sendDnAdm" class="form-control" value="<?= $value->js_tujuan_co ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <h4>Checker Pool</h4>
                                                        <label for="firstName" class="sr-only">Pabrik</label>
                                                        <input type="text" name="pabrikDnPool" id="pabrikDnPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="firstName" class="sr-only">Pabrik</label>
                                                        <input type="text" name="pabrikDnDepo" id="pabrikDnDepo" class="form-control" readonly value="<?= $value->pabrik_nama ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="firstName" class="sr-only">Pabrik</label>
                                                        <input type="text" name="pabrikDnAdm" id="pabrikDnAdm" class="form-control" value="<?= $value->pabrik_nama ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <h4>Checker Pool</h4>
                                                        <label for="firstName" class="sr-only">Nopol</label>
                                                        <input type="text" name="nopolDnPool" id="nopolDnPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="firstName" class="sr-only">Nopol</label>
                                                        <input type="text" name="nopolDnDepo" id="nopolDnDepo" class="form-control" readonly value="<?= $value->mk_dn_van ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="firstName" class="sr-only">Nopol</label>
                                                        <input type="text" name="nopolDnAdm" id="nopolDnAdm" class="form-control" value="<?= $value->mk_dn_van ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <h4>Checker Pool</h4>
                                                        <label for="firstName" class="sr-only">Driver</label>
                                                        <input type="text" name="driverDnPool" id="driverDnPool" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="firstName" class="sr-only">Driver</label>
                                                        <input type="text" name="driverDnDepo" id="driverDnDepo" class="form-control" readonly value="<?= $value->po_driver ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="firstName" class="sr-only">Driver</label>
                                                        <input type="text" name="driverDnAdm" id="driverDnAdm" class="form-control" value="<?= $value->po_driver ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <label for="firstName" class="sr-only">Produk</label>
                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                    </div> -->
                                                    <div class="form-group col-md-4">
                                                        <label for="firstName" class="sr-only">Produk</label>
                                                        <input type="text" name="produkGrDepo" id="produkDnDepo" class="form-control" readonly value="<?= $value->material_nama ?>">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="firstName" class="sr-only">Qty</label>
                                                        <input type="text" name="qtyGrDepo" id="qtyDnDepo" class="form-control" readonly value="<?= $value->mk_varian_muatan ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="firstName" class="sr-only">Produk</label>
                                                        <input type="text" name="produkGrAdm" id="produkDnAdm" class="form-control" value="<?= $value->material_nama ?>">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="firstName" class="sr-only">Qty</label>
                                                        <input type="text" name="qtyGrAdm" id="qtyDnAdm" class="form-control" value="<?= $value->mk_varian_muatan ?>">
                                                    </div>
                                                </div>
                                            <?php }
                                            ?>
                                            </div>
                                        </section>

                                        <h3>
                                            <div class="media">
                                                <!-- <div class="bd-wizard-step-icon"><i class="mdi mdi-emoticon-outline"></i></div> -->
                                                <div class="media-body">
                                                    <div class="bd-wizard-step-title">Summary</div>
                                                    <div class="bd-wizard-step-subtitle">Step 5</div>
                                                </div>
                                            </div>
                                        </h3>
                                        <section>
                                            <div class="content-wrapper">
                                                <h4 class="section-heading">Status: Draft</h4>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="phoneNumber" class="sr-only">Tanggal</label>
                                                        <input type="date" name="tglBtb" id="tglBtb" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-8">
                                                        <label for="emailAddress" class="sr-only">No. Dokumen</label>
                                                        <input type="text" name="docId" id="docId" class="form-control" readonly value="<?= $id ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="phoneNumber" class="sr-only">Gudang</label>
                                                        <select class="form-control" id="idGudang" name="gudang" style="background-color: #ffff;">
                                                            <option>Pilih Gudang</option>
                                                            <?php
                                                            foreach ($gudang as $value) { ?>
                                                                <option value="<?= $value->szId; ?>"><?= $value->szId; ?> | <?= $value->szName; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="emailAddress" class="sr-only">Tipe Stok</label>
                                                        <select name="stok" id="stok" class="form-control" style="background-color: #ffff;">
                                                            <option value=""> Pilih Tipe Stok </option>
                                                            <option value="DLP">DLP - Stock dalam Perjualan</option>
                                                            <option value="JAMBOT">JAMBOT - Stock botol di pelanggan</option>
                                                            <option value="JUAL" selected>JUAL - Stock untuk penjualan</option>
                                                            <option value="JUAL">SEWA - Produk sewa di pelanggan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php
                                                foreach ($data as $key) { ?>

                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="phoneNumber" class="sr-only">Tanggal Surat Jalan</label>
                                                            <input type="text" name="dnTgl" id="dnTgl" class="form-control" value="<?= $key->mk_dn_date ?>" readonly>
                                                        </div>
                                                        <div class="form-group col-md-8">
                                                            <label for="emailAddress" class="sr-only">No. Surat Jalan</label>
                                                            <input type="text" name="dnNo" id="dnNo" class="form-control" value="<?= $key->mk_dn_t ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="phoneNumber" class="sr-only">No. Ref 1</label>
                                                            <input type="text" name="coNo" id="coNo" class="form-control" value="<?= $key->po_co ?>" readonly>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="emailAddress" class="sr-only">No. Ref 2</label>
                                                            <input type="text" name="grNo" id="grNo" class="form-control" value="<?= $key->mk_gr ?>" readonly>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="emailAddress" class="sr-only">No. Ref 3</label>
                                                            <input type="text" name="poNo" id="poNo" class="form-control" value="<?= $key->po_po_old ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="phoneNumber" class="sr-only">Jasa Pengangkut</label>
                                                            <input type="text" name="transporter" id="transporter" class="form-control" value="<?= $key->po_transporter_kode ?> - <?= $key->transporter_nama_npwp ?>" readonly>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Supplier</label>
                                                            <input type="text" name="supplier" id="supplier" class="form-control" value="<?= $key->pabrik_nama ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="phoneNumber" class="sr-only">Kendaraan</label>
                                                            <input type="text" name="kendaraan" id="kendaraan" class="form-control" value="<?= $key->mk_armada_nopol ?>" readonly>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="emailAddress" class="sr-only">Pengemudi</label>
                                                            <input type="text" name="pengemudi" id="pengemudi" class="form-control" value="<?= $key->mk_armada_driver ?>" readonly>
                                                        </div>
                                                    </div>
                                                <?php }
                                                ?>
                                                <br>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h4>Produk</h4>
                                                        <table class='table table-striped'>
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Nama Produk</th>
                                                                    <th>Qty</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="table_body">
                                                                <?php
                                                                $no = 1;
                                                                foreach ($data as $value) { ?>
                                                                    <tr>
                                                                        <td><?= $no ?></td>
                                                                        <td><input type="text" name="produkNama" id="produkNama" class="form-control" value="<?= $value->material_nama ?>" readonly></td>
                                                                        <td><input type="text" name="varianQty" id="varianQty" class="form-control" value="<?= $value->mk_varian_muatan ?>"></td>
                                                                    </tr>
                                                                <?php
                                                                    $no++;
                                                                } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h4>Adjustment</h4>
                                                        <table class='table table-striped'>
                                                            <thead>
                                                                <tr>
                                                                    <th>Ket</th>
                                                                    <th>Checker Depo</th>
                                                                    <th>Admin Depo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="table_body">
                                                                <?php
                                                                foreach ($data as $value) { ?>
                                                                    <tr>
                                                                        <td>Return Isi</td>
                                                                        <td><input type="text" name="smrCkrReturn" id="smrCkrReturn" class="form-control" value="<?= $value->po_return_isi ?>" readonly></td>
                                                                        <td><input type="text" name="smrAdmReturn" id="smrAdmReturn" class="form-control" value="<?= $value->po_return_isi ?>" readonly></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Jugrack</td>
                                                                        <td><input type="text" name="smrCkrJugrack" id="smrCkrJugrack" class="form-control" value="<?= $value->po_jugrack ?>" readonly></td>
                                                                        <td><input type="text" name="smrAdmJugrack" id="smrAdmJugrack" class="form-control" value="<?= $value->po_jugrack ?>" readonly></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Galon Kosong</td>
                                                                        <td><input type="text" name="smrCkrGalKos" id="smrCkrGalKos" class="form-control" value="<?= $value->po_gal_kos ?>" readonly></td>
                                                                        <td><input type="text" name="smrAdmGalKos" id="smrAdmGalKos" class="form-control" value="<?= $value->po_gal_kos ?>" readonly></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Palet</td>
                                                                        <td><input type="text" name="smrCkrPalet" id="smrCkrPalet" class="form-control" value="<?= $value->po_palet ?>" readonly></td>
                                                                        <td><input type="text" name="smrAdmPalet" id="smrAdmPalet" class="form-control" value="<?= $value->po_palet ?>" readonly></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Good Return (GR)</td>
                                                                        <td><input type="text" name="smrCkrGr" id="smrCkrGr" class="form-control" value="<?= $value->mk_gr_qty ?>" readonly></td>
                                                                        <td><input type="text" name="smrAdmGr" id="smrAdmGr" class="form-control" value="<?= $value->mk_gr_qty ?>" readonly></td>
                                                                    </tr>
                                                                <?php
                                                                } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </main>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>

                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>MDBA &copy; 2021</p>
                    </div>
                    <div class="float-end">
                        <p>ICT Department, TVIP | ASA</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js ?>"></script>

    <script>
        function num(value) {
            alert("Number " + value);
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#finish').on('click', function() {
                alert("test");
                // var status_id = $('#status_id').val();
                // var sa_id = $('#sa_id').val();
                // var sa_status_id = $('#sa_status_id').val();
                // var revisi = $('#revisi_id').val();
                // var doc_id = $("#doc_id").val();
                // var nopeng_id = $("#nopeng_id").val();

                // $.ajax({
                //     url: "<?php echo base_url("home/simpan_wo_sa"); ?>",
                //     type: "POST",
                //     data: {
                //         type: 1,
                //         status_id: status_id,
                //         sa_id: sa_id,
                //         sa_status_id: sa_status_id,
                //         revisi: revisi,
                //         doc_id: doc_id,
                //         nopeng_id: nopeng_id
                //     },
                //     cache: false,
                //     success: function(dataResult) {
                //         var dataResult = JSON.parse(dataResult);
                //         if (dataResult.statusCode == 200) {
                //             // $("#butsave").removeAttr("disabled");
                //             // $('#depo_id').prop('selectedIndex', 0);
                //             // $('#btu_id').prop('selectedIndex', 0);
                //             // $('#master_id').prop('selectedIndex', 0);
                //             Swal.fire({
                //                 type: 'success',
                //                 title: 'Data Berhasil Tersimpan',
                //                 // willClose: () => {
                //                 //     $('.form-counter').trigger("reset");
                //                 // }
                //             });

                //         } else if (dataResult.statusCode == 201) {
                //             Swal.fire({
                //                 type: 'warning',
                //                 title: 'Data Gagal Disimpan',
                //                 // willClose: () => {
                //                 //     $('.form-counter').trigger("reset");
                //                 // }
                //             })
                //         }

                //     }
                // });
            });
        });
    </script>

    <script src="<?php echo base_url(); ?>assets/index/js/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/app.js"></script>

    <script src="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/vendors.js"></script>

    <script src="<?php echo base_url(); ?>assets/index/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/wizard/js/jquery.steps.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/wizard/js/bd-wizard.js"></script>

</body>

</html>