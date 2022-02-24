<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BKB SUPPLIER</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/app.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/wizard/css/bd-wizard.css">

    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--===============================================================================================-->

    <!-- SELECT2 -->
    <link href="<?php echo base_url(); ?>assets/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 2.5em !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.5em !important;
        }
    </style>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto');

        body {
            font-family: 'Roboto', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
        }

        i {
            margin-right: 10px;
        }

        /*------------------------*/
        input:focus,
        button:focus,
        .form-control:focus {
            outline: none;
            box-shadow: none;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #fff;
        }

        /*----------step-wizard------------*/
        .d-flex {
            display: flex;
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }

        /*---------signup-step-------------*/
        .bg-color {
            background-color: #333;
        }

        .signup-step-container {
            padding: 80px 0px;
            padding-bottom: 60px;
        }

        .wizard .nav-tabs {
            position: relative;
            margin-bottom: 0;
            border-bottom-color: transparent;
        }

        .wizard>div.wizard-inner {
            position: relative;
            margin-bottom: 50px;
            text-align: center;
        }

        .connecting-line {
            height: 2px;
            background: #e0e0e0;
            position: absolute;
            width: 100%;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 20px;
            z-index: 1;
        }

        .wizard .nav-tabs>li.active>a,
        .wizard .nav-tabs>li.active>a:hover,
        .wizard .nav-tabs>li.active>a:focus {
            color: #555555;
            cursor: default;
            border: 0;
            border-bottom-color: transparent;
        }

        span.round-tab {
            width: 50px;
            height: 50px;
            line-height: 30px;
            display: inline-block;
            border-radius: 50%;
            background: #fff;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 24px;
            color: #0e214b;
            font-weight: 500;
            border: 1px solid #ddd;
            padding-top: 0.3em;
        }

        span.round-tab i {
            color: #555555;
        }

        .wizard li.active span.round-tab {
            background: #0f4c81;
            color: #fff;
            border-color: #0f4c81;
        }

        .wizard li.active span.round-tab i {
            color: #5bc0de;
        }

        .wizard .nav-tabs>li.active>a i {
            color: #0f4c81;
        }

        .wizard .nav-tabs>li {
            width: 19%;
        }

        .wizard li:after {
            content: " ";
            position: absolute;
            left: 46%;
            opacity: 0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: red;
            transition: 0.1s ease-in-out;
        }

        .wizard .nav-tabs>li a {
            width: 30px;
            height: 30px;
            margin: 20px auto;
            border-radius: 100%;
            padding: 0;
            background-color: transparent;
            position: relative;
            top: 0;
        }

        .wizard .nav-tabs>li a i {
            position: absolute;
            top: -20px;
            font-style: normal;
            font-weight: 400;
            white-space: nowrap;
            left: 1.5em;
            transform: translate(-50%, -50%);
            font-size: 20px;
            font-weight: 700;
            color: #000;
        }

        .wizard .nav-tabs>li a:hover {
            background: transparent;
        }

        .wizard .tab-pane {
            position: relative;
            padding-top: 20px;
        }


        .wizard h3 {
            margin-top: 0;
        }

        .prev-step,
        .next-step {
            font-size: 13px;
            padding: 8px 24px;
            border: none;
            border-radius: 4px;
            margin-top: 30px;
        }

        .next-step {
            background-color: #0f4c81;
            color: white;
        }

        .skip-btn {
            background-color: #cec12d;
        }

        .step-head {
            font-size: 20px;
            text-align: center;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .term-check {
            font-size: 14px;
            font-weight: 400;
        }

        .custom-file {
            position: relative;
            display: inline-block;
            width: 100%;
            height: 40px;
            margin-bottom: 0;
        }

        .custom-file-input {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 40px;
            margin: 0;
            opacity: 0;
        }

        .custom-file-label {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1;
            height: 40px;
            padding: .375rem .75rem;
            font-weight: 400;
            line-height: 2;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }

        .custom-file-label::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 3;
            display: block;
            height: 38px;
            padding: .375rem .75rem;
            line-height: 2;
            color: #495057;
            content: "Browse";
            background-color: #e9ecef;
            border-left: inherit;
            border-radius: 0 .25rem .25rem 0;
        }

        .footer-link {
            margin-top: 30px;
        }

        /* .all-info-container {} */

        .list-content {
            margin-bottom: 10px;
        }

        .list-content a {
            padding: 10px 15px;
            width: 100%;
            display: inline-block;
            background-color: #f5f5f5;
            position: relative;
            color: #565656;
            font-weight: 400;
            border-radius: 4px;
        }

        .list-content a[aria-expanded="true"] i {
            transform: rotate(180deg);
        }

        .list-content a i {
            text-align: right;
            position: absolute;
            top: 15px;
            right: 10px;
            transition: 0.5s;
        }

        .form-control[disabled],
        .form-control[readonly],
        fieldset[disabled] .form-control {
            background-color: #ecf1f7;
        }

        .list-box {
            padding: 10px;
        }

        .signup-logo-header .logo_area {
            width: 200px;
        }

        .signup-logo-header .nav>li {
            padding: 0;
        }

        .signup-logo-header .header-flex {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .list-inline li {
            display: inline-block;
        }

        .pull-right {
            float: right;
        }

        /*-----------custom-checkbox-----------*/
        /*----------Custom-Checkbox---------*/
        input[type="checkbox"] {
            position: relative;
            display: inline-block;
            margin-right: 5px;
        }

        input[type="checkbox"]::before,
        input[type="checkbox"]::after {
            position: absolute;
            content: "";
            display: inline-block;
        }

        input[type="checkbox"]::before {
            height: 16px;
            width: 16px;
            border: 1px solid #999;
            left: 0px;
            top: 0px;
            background-color: #fff;
            border-radius: 2px;
        }

        input[type="checkbox"]::after {
            height: 5px;
            width: 9px;
            left: 4px;
            top: 4px;
        }

        input[type="checkbox"]:checked::after {
            content: "";
            border-left: 1px solid #fff;
            border-bottom: 1px solid #fff;
            transform: rotate(-45deg);
        }

        input[type="checkbox"]:checked::before {
            background-color: #18ba60;
            border-color: #18ba60;
        }

        @media (max-width: 767px) {
            .sign-content h3 {
                font-size: 40px;
            }

            .wizard .nav-tabs>li a i {
                display: none;
            }

            .signup-logo-header .navbar-toggle {
                margin: 0;
                margin-top: 8px;
            }

            .signup-logo-header .logo_area {
                margin-top: 0;
            }

            .signup-logo-header .header-flex {
                display: block;
            }
        }
    </style>

</head>

<body>
    <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/sweetalert2.min.js"></script>
    <?php if ($this->session->flashdata('success')) { ?>
        <script>
            Swal.fire({
                type: 'success',
                title: 'Data Berhasil Tersimpan',
            })
        </script>
    <?php } else if ($this->session->flashdata('error')) { ?>
        <script>
            Swal.fire({
                type: 'error',
                title: 'Maaf Data Gagal Disimpan',
            })
        </script>
    <?php } else if ($this->session->flashdata('warning')) { ?>
        <script>
            Swal.fire({
                type: 'warning',
                title: 'Mohon Input Data Dengan Benar',
            })
        </script>
    <?php } ?>
    <div id="app">
        <?php include('sideBar.php'); ?>
        <div id="main">
            <?php include('navBar.php'); ?>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>BKB Supplier</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">BKB Supplier</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <section class="signup-step-container">
                                <div class="container">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12">
                                            <div class="wizard">
                                                <div class="wizard-inner">
                                                    <div class="connecting-line"></div>
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="active">
                                                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Purchase Order</i></a>
                                                        </li>
                                                        <li role="presentation" class="disabled">
                                                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Collection Order</i></a>
                                                        </li>
                                                        <li role="presentation" class="disabled">
                                                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Good Return</i></a>
                                                        </li>
                                                        <li role="presentation" class="disabled">
                                                            <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Delivery Note</i></a>
                                                        </li>
                                                        <li role="presentation" class="disabled">
                                                            <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab"><span class="round-tab">5</span> <i>Summary</i></a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <form role="form" action="<?php echo base_url('inventSupp/simpanHistoryBkb'); ?>" method="POST" class="login-box" enctype="multipart/form-data">
                                                    <div class="tab-content" id="main_form">
                                                        <?php
                                                        $row = count($data);
                                                        foreach ($data as $value) {
                                                            $mk_po = $value->po_po_new;
                                                            $po_return_isi = $value->po_return_isi;
                                                            $po_jugrack = (int)$value->po_jugrack;
                                                            $po_palet = $value->po_palet;
                                                            $po_gal_kos = $value->po_gal_kos;
                                                            $po_nopol = $value->po_nopol;
                                                            $po_driver = $value->po_driver;
                                                            $po_driver_pengganti = $value->po_driver_pengganti;
                                                            $po_transporter_kode = $value->po_transporter_kode;

                                                            $mk_co_real = $value->mk_co_real;
                                                            $js_day = $value->js_day;
                                                            $js_date = $value->js_date;
                                                            $pabrik_nama = $value->pabrik_nama;
                                                            $material_nama = $value->material_nama;
                                                            $js_tujuan_co = $value->js_tujuan_co;
                                                            $mk_masuk_tujuan = $value->mk_masuk_tujuan;
                                                            $mk_depo_tujuan = $value->mk_depo_tujuan;

                                                            $mk_gr = $value->mk_gr;
                                                            $mk_gr_qty = $value->mk_gr_qty;

                                                            $mk_dn_m = $value->mk_dn_m;
                                                            $mk_dn_date = $value->mk_dn_date;
                                                            $js_tujuan_co = $value->js_tujuan_co;
                                                            $pabrik_nama = $value->pabrik_nama;
                                                            $mk_dn_van = $value->mk_dn_van;
                                                            $po_driver = $value->po_driver;
                                                            $mk_dn_m_qty = $value->mk_dn_m_qty;

                                                            $mk_barcode = $value->mk_barcode;
                                                        }
                                                        ?>
                                                        <!-- po -->
                                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                                            <div class="row">
                                                                <div class="col-3"></div>
                                                                <div class="col-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="noPo" style="font-size: 22px; font-weight: bold;">No. PO</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="noPo" id="noPo" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $mk_po ?>">
                                                                            <input type="hidden" name="row" id="idRow" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $row ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h4>Checker Depo</h4>
                                                                        <label>Return Isi</label>
                                                                        <input type="text" name="returnIsiDepo" id="returnIsiDepo" class="form-control" readonly value="<?= $po_return_isi ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h4>Admin Depo</h4>
                                                                        <label>Return Isi</label>
                                                                        <input type="number" name="returnIsiAdm" id="returnIsiAdm" class="form-control" value="<?= $po_return_isi ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Jugrack</label>
                                                                        <input type="text" name="jugrackDepo" id="jugrackDepo" class="form-control" readonly value="<?= $po_jugrack ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Jugrack</label>
                                                                        <input type="number" name="jugrackAdm" id="jugrackAdm" class="form-control" value="<?= $po_jugrack ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Palet</label>
                                                                    <input type="text" name="paletDepo" id="paletDepo" class="form-control" readonly value="<?= $po_palet ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Palet</label>
                                                                    <input type="number" name="paletAdm" id="paletAdm" class="form-control" value="<?= $po_palet ?>" readonly>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Galon Kosong</label>
                                                                        <input type="text" name="glnKosongDepo" id="glnKosongDepo" class="form-control" readonly value="<?= $po_gal_kos ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Galon Kosong</label>
                                                                        <input type="number" name="glnKosongAdm" id="glnKosongAdm" class="form-control" value="<?= $po_gal_kos ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Nopol</label>
                                                                    <input type="text" name="nopolDepo" id="nopolDepo" class="form-control" readonly value="<?= $po_nopol ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Nopol</label>
                                                                    <input type="text" name="nopolAdm" id="nopolAdm" class="form-control" value="<?= $po_nopol ?>" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Supir</label>
                                                                    <input type="text" name="driverDepo" id="driverDepo" class="form-control" readonly value="<?= $po_driver ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Supir</label>
                                                                    <input type="text" name="driverAdm" id="driverAdm" class="form-control" value="<?= $po_driver ?>" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Supir Pengganti</label>
                                                                    <input type="text" name="driver2Depo" id="driver2Depo" class="form-control" readonly value="<?= $po_driver_pengganti ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Supir Pengganti</label>
                                                                    <input type="text" name="driver2Adm" id="driver2Adm" class="form-control" value="<?= $po_driver_pengganti ?>" readonly>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Transporter</label>
                                                                    <input type="text" name="transporterDepo" id="transporterDepo" class="form-control" readonly value="<?= $po_transporter_kode ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Transporter</label>
                                                                    <input type="text" name="transporterAdm" id="transporterAdm" class="form-control" value="<?= $po_transporter_kode ?>" readonly>
                                                                </div>
                                                                <br>
                                                            </div>
                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button" class="default-btn next-step">Next</button></li>
                                                            </ul>
                                                        </div>

                                                        <!-- co -->
                                                        <div class="tab-pane" role="tabpanel" id="step2">
                                                            <div class="row">
                                                                <div class="col-3"></div>
                                                                <div class="col-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="noCo" style="font-size: 22px; font-weight: bold;">No. CO</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="noCo" id="noCo" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $mk_co_real ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"></div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <h4>Checker Pool</h4>
                                                                        <label for="firstName" >Hari</label>
                                                                        <input type="text" name="hariPool" id="hariPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <h4>Checker Depo</h4>
                                                                    <label for="firstName">Hari</label>
                                                                    <input type="text" name="hariDepo" id="hariDepo" class="form-control" readonly value="<?= $js_day ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <h4>Admin Depo</h4>
                                                                    <label for="firstName">Hari</label>
                                                                    <input type="text" name="hariAdm" id="hariAdm" class="form-control" value="<?= $js_day ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Tanggal Window</label>
                                                                        <input type="text" name="tglWindowPool" id="tglWindowPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Tanggal Window</label>
                                                                    <input type="text" name="tglWindowDepo" id="tglWindowDepo" class="form-control" readonly value="<?= $js_date ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Tanggal Window</label>
                                                                    <input type="text" name="tglWindowAdm" id="tglWindowAdm" class="form-control" value="<?= $js_date ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Pabrik Window</label>
                                                                        <input type="text" name="pabrikWindowPool" id="pabrikWindowPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Pabrik Window</label>
                                                                    <input type="text" name="pabrikWindowDepo" id="pabrikWindowDepo" class="form-control" readonly value="<?= $pabrik_nama ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Pabrik Window</label>
                                                                    <input type="text" name="pabrikWindowAdm" id="pabrikWindowAdm" class="form-control" value="<?= $pabrik_nama ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Material</label>
                                                                        <input type="text" name="materialPool" id="materialPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Material</label>
                                                                    <input type="text" name="materialDepo" id="materialDepo" class="form-control" readonly value="<?= $material_nama ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Material</label>
                                                                    <input type="text" name="materialAdm" id="materialAdm" class="form-control" value="<?= $material_nama ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Tujuan Awal</label>
                                                                        <input type="text" name="tujuanAwalPool" id="tujuanAwalPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Tujuan Awal</label>
                                                                    <input type="text" name="tujuanAwalDepo" id="tujuanAwalDepo" class="form-control" readonly value="<?= $js_tujuan_co ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Tujuan Awal</label>
                                                                    <input type="text" name="tujuanAwalAdm" id="tujuanAwalAdm" class="form-control" value="<?= $js_tujuan_co ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Tujuan Final Depo</label>
                                                                        <input type="text" name="tujuanFinalPool" id="tujuanFinalPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Tujuan Final Depo</label>
                                                                    <input type="text" name="tujuanFinalDepo" id="tujuanFinalDepo" class="form-control" readonly value="<?= $mk_masuk_tujuan ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Tujuan Final Depo</label>
                                                                    <input type="text" name="tujuanFinalAdm" id="tujuanFinalAdm" class="form-control" value="<?= $mk_masuk_tujuan ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Tujuan Final CO</label>
                                                                        <input type="text" name="tujuanCoPool" id="TujuanCoPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Tujuan Final CO</label>
                                                                    <input type="text" name="tujuanCoDepo" id="TujuanCoDepo" class="form-control" readonly value="<?= $mk_depo_tujuan ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Tujuan Final CO</label>
                                                                    <input type="text" name="tujuanCoAdm" id="TujuanCoAdm" class="form-control" value="<?= $mk_depo_tujuan ?>" readonly>
                                                                </div>
                                                            </div>


                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button" class="default-btn prev-step">Back</button></li>
                                                                <!-- <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li> -->
                                                                <li><button type="button" class="default-btn next-step">Next</button></li>
                                                            </ul>
                                                        </div>

                                                        <!-- gr -->
                                                        <div class="tab-pane" role="tabpanel" id="step3">
                                                            <div class="row">
                                                                <div class="col-3"></div>
                                                                <div class="col-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="noGr" style="font-size: 22px; font-weight: bold;">No. Gr</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="noGr" id="noGr" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $mk_gr ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"></div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <h4>Checker Pool</h4>
                                                                        <label for="firstName" >Dikirim Ke</label>
                                                                        <input type="text" name="sendPool" id="sendPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <h4>Checker Depo</h4>
                                                                    <label for="firstName">Dikirim Ke</label>
                                                                    <input type="text" name="sendDepo" id="sendDepo" class="form-control" readonly value="<?= $js_tujuan_co ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <h4>Admin Depo</h4>
                                                                    <label for="firstName">Dikirim Ke</label>
                                                                    <input type="text" name="sendAdm" id="sendAdm" class="form-control" value="<?= $js_tujuan_co ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <label for="firstName" >Produk</label>
                                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-4">
                                                                    <label for="firstName">Produk</label>
                                                                    <input type="text" name="produkGrDepo" id="produkGrDepo" class="form-control" readonly value="<?= $material_nama ?>">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label for="firstName">Qty</label>
                                                                    <input type="text" name="qtyGrDepo" id="qtyGrDepo" class="form-control" readonly value="<?= $mk_gr_qty ?>">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="firstName">Produk</label>
                                                                    <input type="text" name="produkGrAdm" id="produkGrAdm" class="form-control" value="<?= $material_nama ?>" readonly>
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label for="firstName">Qty</label>
                                                                    <input type="number" name="qtyGrAdm" id="qtyGrAdm" class="form-control" value="<?= $mk_gr_qty ?>" readonly>
                                                                </div>
                                                                <br>
                                                            </div>
                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button" class="default-btn prev-step">Back</button></li>
                                                                <!-- <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li> -->
                                                                <li><button type="button" class="default-btn next-step">Next</button></li>
                                                            </ul>
                                                        </div>

                                                        <!-- dn -->
                                                        <div class="tab-pane" role="tabpanel" id="step4">
                                                            <div class="row">
                                                                <div class="col-3"></div>
                                                                <div class="col-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="noDn" style="font-size: 22px; font-weight: bold;">No. DN</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="noDn" id="noDn" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $mk_dn_m ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"></div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <h4>Checker Pool</h4>
                                                                        <label for="firstName" >Tanggal DN</label>
                                                                        <input type="text" name="tglDnPool" id="tglDnPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <h4>Checker Depo</h4>
                                                                    <label for="firstName">Tanggal DN</label>
                                                                    <input type="text" name="tglDnDepo" id="tglDnDepo" class="form-control" readonly value="<?= $mk_dn_date ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <h4>Admin Depo</h4>
                                                                    <label for="firstName">Tanggal DN</label>
                                                                    <input type="text" name="tglDnAdm" id="tglDnAdm" class="form-control" value="<?= $mk_dn_date ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <h4>Checker Pool</h4>
                                                                        <label for="firstName" >Dikirim Ke</label>
                                                                        <input type="text" name="sendDnPool" id="sendDnPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <label for="firstName">Dikirim Ke</label>
                                                                    <input type="text" name="sendDnDepo" id="sendDnDepo" class="form-control" readonly value="<?= $js_tujuan_co ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="firstName">Dikirim Ke</label>
                                                                    <input type="text" name="sendDnAdm" id="sendDnAdm" class="form-control" value="<?= $js_tujuan_co ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <h4>Checker Pool</h4>
                                                                        <label for="firstName" >Pabrik</label>
                                                                        <input type="text" name="pabrikDnPool" id="pabrikDnPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <label for="firstName">Pabrik</label>
                                                                    <input type="text" name="pabrikDnDepo" id="pabrikDnDepo" class="form-control" readonly value="<?= $pabrik_nama ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="firstName">Pabrik</label>
                                                                    <input type="text" name="pabrikDnAdm" id="pabrikDnAdm" class="form-control" readonly value="<?= $pabrik_nama ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <h4>Checker Pool</h4>
                                                                        <label for="firstName" >Nopol</label>
                                                                        <input type="text" name="nopolDnPool" id="nopolDnPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <label for="firstName">Nopol</label>
                                                                    <input type="text" name="nopolDnDepo" id="nopolDnDepo" class="form-control" readonly value="<?= $mk_dn_van ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="firstName">Nopol</label>
                                                                    <input type="text" name="nopolDnAdm" id="nopolDnAdm" class="form-control" readonly value="<?= $mk_dn_van ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <h4>Checker Pool</h4>
                                                                        <label for="firstName" >Driver</label>
                                                                        <input type="text" name="driverDnPool" id="driverDnPool" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-6">
                                                                    <label for="firstName">Driver</label>
                                                                    <input type="text" name="driverDnDepo" id="driverDnDepo" class="form-control" readonly value="<?= $po_driver ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="firstName">Driver</label>
                                                                    <input type="text" name="driverDnAdm" id="driverDnAdm" class="form-control" readonly value="<?= $po_driver ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- <div class="form-group col-md-4">
                                                                        <label for="firstName" >Produk</label>
                                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                                    </div> -->
                                                                <div class="form-group col-md-4">
                                                                    <label for="firstName">Produk</label>
                                                                    <input type="text" name="produkDnDepo" id="produkDnDepo" class="form-control" readonly value="<?= $material_nama ?>">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label for="firstName">Qty</label>
                                                                    <input type="text" name="qtyDnDepo" id="qtyDnDepo" class="form-control" readonly value="<?= $mk_dn_m_qty ?>">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="firstName">Produk</label>
                                                                    <input type="text" name="produkDnAdm" id="produkDnAdm" class="form-control" readonly value="<?= $material_nama ?>">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label for="firstName">Qty</label>
                                                                    <input type="number" name="qtyDnAdm" id="qtyDnAdm" class="form-control" readonly value="<?= $mk_dn_m_qty ?>">
                                                                </div>
                                                                <br>
                                                            </div>

                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button" class="default-btn prev-step">Back</button></li>
                                                                <li><button type="button" class="default-btn next-step">Next</button></li>
                                                            </ul>
                                                        </div>


                                                        <!-- summary -->
                                                        <div class="tab-pane" role="tabpanel" id="step5">
                                                            <div class="all-info-container">
                                                                <div class="row">
                                                                    <div class="col-2"></div>
                                                                    <div class="col-8">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="bkb" style="font-size: 22px; font-weight: bold;">BKB</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="bkb" id="idBkb" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $bkb; ?>">
                                                                                <input type="hidden" name="barcode" id="idBarcode" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $mk_barcode; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2"></div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <table class='table table-striped'>
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Kode</th>
                                                                                    <th>Produk</th>
                                                                                    <th>Qty</th>
                                                                                    <th>Satuan</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="table_body">
                                                                                <?php
                                                                                $no = 0;
                                                                                foreach ($data as $key) {
                                                                                    if ($key->masterKode == '10116') { ?>
                                                                                        <tr>
                                                                                        <td>
                                                                                            <select class="js-example-basic-single form-select" name="kode[<?= $no; ?>]" id="idKode<?= $no; ?>" required onchange="getFormProduk(<?= $no; ?>)">
                                                                                                <option value="-" disabled>Pilih Produk</option>
                                                                                                <?php
                                                                                                foreach ($product as $prod) {
                                                                                                    if ($prod->szId == $key->masterKode) { ?>
                                                                                                        <option value="<?= $prod->szId; ?>" selected><?= $prod->szId; ?></option>
                                                                                                    <?php
                                                                                                    } else {
                                                                                                    ?>
                                                                                                        <option value="<?= $prod->szId; ?>"><?= $prod->szId; ?></option>
                                                                                                <?php
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php
                                                                                            foreach ($product as $prod) {
                                                                                                if ($prod->szId == $key->masterKode) { ?>
                                                                                                    <input name="produk[<?= $no; ?>]" type="text" id="idProduk<?= $no; ?>" class="form-control" readonly value="<?= $prod->szName; ?>">
                                                                                            <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input name="qty[<?= $no; ?>]" type="text" id="idQty<?= $no; ?>" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off" value="<?= $key->po_palet; ?>" onchange="getBa(<?= $no; ?>)" required>
                                                                                            <input name="qtyOld[<?= $no; ?>]" type="hidden" id="idQtyOld<?= $no; ?>" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off" value="<?= $key->po_palet; ?>">
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php
                                                                                            foreach ($product as $prod) {
                                                                                                if ($prod->szId == $key->masterKode) { ?>
                                                                                                    <input name="satuan[<?= $no; ?>]" type="text" id="idSatuan<?= $no; ?>" class="form-control" readonly value="<?= $prod->szUomId ?>">
                                                                                            <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    
                                                                                <?php } 
                                                                                    $no++;
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-6"></div>
                                                                    <div class="form-group col-md-6" id="baSummary">
                                                                        <label for="emailAddress" style="color: red;">Harap Upload Foto Berita Acara Karena Terdapat Perbedaan Data</label>
                                                                        <br>
                                                                        <label for="emailAddress">Upload File BA</label>
                                                                        <div class="form-file">
                                                                            <input type="file" name="baSummary" class="form-file-input" id="customFile">
                                                                            <label class="form-file-label" for="customFile">
                                                                                <span class="form-file-text">Choose file...</span>
                                                                                <span class="form-file-button">Browse</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button" class="default-btn prev-step">Back</button></li>
                                                                <li><button type="submit" class="default-btn" style="font-size: 13px; padding: 8px 24px; border:none; border-radius: 4px; margin-top: 30px; background-color: #0f4c81; color: white;">Finish</button></li>
                                                            </ul>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
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
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

        function getFormProduk(x) {
            var produk = document.getElementById('idKode' + x).value;

            $.ajax({
                url: "<?= base_url('inventDepot/getProductDetail') ?>",
                method: "POST",
                data: {
                    produk: produk
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('idProduk' + x).value = row.szName;
                        document.getElementById('idSatuan' + x).value = row.szUomId;
                    }
                }
            })
        }

        $("#baSummary").hide();

        function getBa(x) {
            var qty = document.getElementById('idQty' + x).value;
            var qtyOld = document.getElementById('idQtyOld' + x).value;

            if (qty != qtyOld) {
                $("#baSummary").show();
            } else {
                $("#baSummary").hide();
            }
        }
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

    <script>
        // ------------step-wizard-------------
        $(document).ready(function() {
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

                var target = $(e.target);

                if (target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function(e) {

                var active = $('.wizard .nav-tabs li.active');
                active.next().removeClass('disabled');
                nextTab(active);

            });
            $(".prev-step").click(function(e) {

                var active = $('.wizard .nav-tabs li.active');
                prevTab(active);

            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }

        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }


        $('.nav-tabs').on('click', 'li', function() {
            $('.nav-tabs li.active').removeClass('active');
            $(this).addClass('active');
        });
    </script>

    <!-- SELECT2 -->
    <script src="<?php echo base_url(); ?>assets/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Pilih"
            });
        });
    </script>

</body>

</html>