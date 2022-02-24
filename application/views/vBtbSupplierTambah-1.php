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

    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--===============================================================================================-->

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
    <?php if ($this->session->flashdata('error')) { ?>
        <script>
            Swal.fire({
                type: 'error',
                title: 'Data Tidak Berhasil Tersimpan',
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

                                                <form role="form" action="<?php echo base_url('inventori/createBtbSupplierGln'); ?>" method="POST" class="login-box" enctype="multipart/form-data">
                                                    <div class="tab-content" id="main_form">
                                                        <?php
                                                        foreach ($data as $value) { ?>
                                                            <!-- po -->
                                                            <div class="tab-pane active" role="tabpanel" id="step1">
                                                                <div class="row">
                                                                    <div class="col-3"></div>
                                                                    <div class="col-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="noPo" style="font-size: 22px; font-weight: bold;">No. PO</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="noPo" id="noPo" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $value->po_po_old ?>">
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
                                                                            <input type="text" name="returnIsiDepo" id="returnIsiDepo" class="form-control" readonly value="<?= $value->po_return_isi ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <h4>Admin Depo</h4>
                                                                            <label>Return Isi</label>
                                                                            <input type="number" name="returnIsiAdm" id="returnIsiAdm" class="form-control" value="<?= $value->po_return_isi ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Jugrack</label>
                                                                            <input type="text" name="jugrackDepo" id="jugrackDepo" class="form-control" readonly value="<?= $value->po_jugrack ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Jugrack</label>
                                                                            <input type="number" name="jugrackAdm" id="jugrackAdm" class="form-control" value="<?= $value->po_jugrack ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Galon Kosong</label>
                                                                            <input type="text" name="glnKosongDepo" id="glnKosongDepo" class="form-control" readonly value="<?= $value->po_gal_kos ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Galon Kosong</label>
                                                                            <input type="number" name="glnKosongAdm" id="glnKosongAdm" class="form-control" value="<?= $value->po_gal_kos ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Palet</label>
                                                                        <input type="text" name="paletDepo" id="paletDepo" class="form-control" readonly value="<?= $value->po_palet ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Palet</label>
                                                                        <input type="number" name="paletAdm" id="paletAdm" class="form-control" value="<?= $value->po_palet ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Nopol</label>
                                                                        <input type="text" name="nopolDepo" id="nopolDepo" class="form-control" readonly value="<?= $value->po_nopol ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Nopol</label>
                                                                        <input type="text" name="nopolAdm" id="nopolAdm" class="form-control" value="<?= $value->po_nopol ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Supir</label>
                                                                        <input type="text" name="driverDepo" id="driverDepo" class="form-control" readonly value="<?= $value->po_driver ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label>Supir</label>
                                                                        <input type="text" name="driverAdm" id="driverAdm" class="form-control" value="<?= $value->po_driver ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Supir Pengganti</label>
                                                                        <input type="text" name="driver2Depo" id="driver2Depo" class="form-control" readonly value="<?= $value->po_driver_pengganti ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Supir Pengganti</label>
                                                                        <input type="text" name="driver2Adm" id="driver2Adm" class="form-control" value="<?= $value->po_driver_pengganti ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Transporter</label>
                                                                        <input type="text" name="transporterDepo" id="transporterDepo" class="form-control" readonly value="<?= $value->transporter_nama_npwp ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Transporter</label>
                                                                        <input type="text" name="transporterAdm" id="transporterAdm" class="form-control" value="<?= $value->transporter_nama_npwp ?>">
                                                                        <input type="hidden" name="transporterAdmKode" id="transporterAdmKode" class="form-control" value="<?= $value->po_transporter_kode ?>">
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group col-md-6"></div>
                                                                    <div class="form-group col-md-6" id="uploadId">
                                                                        <label for="emailAddress" style="color: red;">Harap Upload Foto Berita Acara Karena Terdapat Perbedaan Data</label>
                                                                        <br>
                                                                        <label for="emailAddress">Upload File BA</label>
                                                                        <div class="form-file">
                                                                            <input type="file" name="uploadPO" class="form-file-input" id="customFile">
                                                                            <label class="form-file-label" for="customFile">
                                                                                <span class="form-file-text">Choose file...</span>
                                                                                <span class="form-file-button">Browse</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
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
                                                                                <input type="text" name="noCo" id="noCo" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $value->po_co ?>">
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
                                                                        <input type="text" name="hariDepo" id="hariDepo" class="form-control" readonly value="<?= $value->js_day ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <h4>Admin Depo</h4>
                                                                        <label for="firstName">Hari</label>
                                                                        <input type="text" name="hariAdm" id="hariAdm" class="form-control" value="<?= $value->js_day ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Tanggal Window</label>
                                                                        <input type="text" name="tglWindowPool" id="tglWindowPool" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Tanggal Window</label>
                                                                        <input type="text" name="tglWindowDepo" id="tglWindowDepo" class="form-control" readonly value="<?= $value->js_date ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Tanggal Window</label>
                                                                        <input type="text" name="tglWindowAdm" id="tglWindowAdm" class="form-control" value="<?= $value->js_date ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Pabrik Window</label>
                                                                        <input type="text" name="pabrikWindowPool" id="pabrikWindowPool" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Pabrik Window</label>
                                                                        <input type="text" name="pabrikWindowDepo" id="pabrikWindowDepo" class="form-control" readonly value="<?= $value->pabrik_nama ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Pabrik Window</label>
                                                                        <input type="text" name="pabrikWindowAdm" id="pabrikWindowAdm" class="form-control" value="<?= $value->pabrik_nama ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Material</label>
                                                                        <input type="text" name="materialPool" id="materialPool" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Material</label>
                                                                        <input type="text" name="materialDepo" id="materialDepo" class="form-control" readonly value="<?= $value->material_nama ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Material</label>
                                                                        <input type="text" name="materialAdm" id="materialAdm" class="form-control" value="<?= $value->material_nama ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Tujuan Awal</label>
                                                                        <input type="text" name="tujuanAwalPool" id="tujuanAwalPool" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Tujuan Awal</label>
                                                                        <input type="text" name="tujuanAwalDepo" id="tujuanAwalDepo" class="form-control" readonly value="<?= $value->js_tujuan_co ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Tujuan Awal</label>
                                                                        <input type="text" name="tujuanAwalAdm" id="tujuanAwalAdm" class="form-control" value="<?= $value->js_tujuan_co ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Tujuan Final Depo</label>
                                                                        <input type="text" name="tujuanFinalPool" id="tujuanFinalPool" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Tujuan Final Depo</label>
                                                                        <input type="text" name="tujuanFinalDepo" id="tujuanFinalDepo" class="form-control" readonly value="<?= $value->mk_masuk_tujuan ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Tujuan Final Depo</label>
                                                                        <input type="text" name="tujuanFinalAdm" id="tujuanFinalAdm" class="form-control" value="<?= $value->mk_masuk_tujuan ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="phoneNumber" >Tujuan Final CO</label>
                                                                        <input type="text" name="tujuanCoPool" id="TujuanCoPool" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Tujuan Final CO</label>
                                                                        <input type="text" name="tujuanCoDepo" id="TujuanCoDepo" class="form-control" readonly value="<?= $value->mk_depo_tujuan ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Tujuan Final CO</label>
                                                                        <input type="text" name="tujuanCoAdm" id="TujuanCoAdm" class="form-control" value="<?= $value->mk_depo_tujuan ?>">
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
                                                                                <input type="text" name="noGr" id="noGr" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $value->mk_gr ?>">
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
                                                                        <input type="text" name="sendDepo" id="sendDepo" class="form-control" readonly value="<?= $value->js_tujuan_co ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <h4>Admin Depo</h4>
                                                                        <label for="firstName">Dikirim Ke</label>
                                                                        <input type="text" name="sendAdm" id="sendAdm" class="form-control" value="<?= $value->js_tujuan_co ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="firstName" >Produk</label>
                                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-4">
                                                                        <label for="firstName">Produk</label>
                                                                        <input type="text" name="produkGrDepo" id="produkGrDepo" class="form-control" readonly value="<?= $value->material_nama ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="firstName">Qty</label>
                                                                        <input type="text" name="qtyGrDepo" id="qtyGrDepo" class="form-control" readonly value="<?= $value->mk_gr_qty ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="firstName">Produk</label>
                                                                        <input type="text" name="produkGrAdm" id="produkGrAdm" class="form-control" value="<?= $value->material_nama ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="firstName">Qty</label>
                                                                        <input type="number" name="qtyGrAdm" id="qtyGrAdm" class="form-control" value="<?= $value->mk_gr_qty ?>">
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group col-md-6"></div>
                                                                    <div class="form-group col-md-6" id="baGr">
                                                                        <label for="emailAddress" style="color: red;">Harap Upload Foto Berita Acara Karena Terdapat Perbedaan Data</label>
                                                                        <br>
                                                                        <label for="emailAddress">Upload File BA</label>
                                                                        <div class="form-file">
                                                                            <input type="file" class="form-file-input" name="uploadGR" id="customFile">
                                                                            <label class="form-file-label" for="customFile">
                                                                                <span class="form-file-text">Choose file...</span>
                                                                                <span class="form-file-button">Browse</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
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
                                                                                <input type="text" name="noDn" id="noDn" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $value->mk_dn_m ?>">
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
                                                                        <input type="text" name="tglDnDepo" id="tglDnDepo" class="form-control" readonly value="<?= $value->mk_dn_date ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <h4>Admin Depo</h4>
                                                                        <label for="firstName">Tanggal DN</label>
                                                                        <input type="text" name="tglDnAdm" id="tglDnAdm" class="form-control" value="<?= $value->mk_dn_date ?>">
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
                                                                        <input type="text" name="sendDnDepo" id="sendDnDepo" class="form-control" readonly value="<?= $value->js_tujuan_co ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="firstName">Dikirim Ke</label>
                                                                        <input type="text" name="sendDnAdm" id="sendDnAdm" class="form-control" value="<?= $value->js_tujuan_co ?>">
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
                                                                        <input type="text" name="pabrikDnDepo" id="pabrikDnDepo" class="form-control" readonly value="<?= $value->pabrik_nama ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="firstName">Pabrik</label>
                                                                        <input type="text" name="pabrikDnAdm" id="pabrikDnAdm" class="form-control" value="<?= $value->pabrik_nama ?>">
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
                                                                        <input type="text" name="nopolDnDepo" id="nopolDnDepo" class="form-control" readonly value="<?= $value->mk_dn_van ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="firstName">Nopol</label>
                                                                        <input type="text" name="nopolDnAdm" id="nopolDnAdm" class="form-control" value="<?= $value->mk_dn_van ?>">
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
                                                                        <input type="text" name="driverDnDepo" id="driverDnDepo" class="form-control" readonly value="<?= $value->po_driver ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="firstName">Driver</label>
                                                                        <input type="text" name="driverDnAdm" id="driverDnAdm" class="form-control" value="<?= $value->po_driver ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="firstName" >Produk</label>
                                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-4">
                                                                        <label for="firstName">Produk</label>
                                                                        <input type="text" name="produkGrDepo" id="produkDnDepo" class="form-control" readonly value="<?= $value->material_nama ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="firstName">Qty</label>
                                                                        <input type="text" name="qtyGrDepo" id="qtyDnDepo" class="form-control" readonly value="<?= $value->mk_dn_m_qty ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="firstName">Produk</label>
                                                                        <input type="text" name="produkGrAdm" id="produkDnAdm" class="form-control" value="<?= $value->material_nama ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="firstName">Qty</label>
                                                                        <input type="number" name="qtyDnAdm" id="qtyDnAdm" class="form-control" value="<?= $value->mk_dn_m_qty ?>">
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group col-md-6"></div>
                                                                    <div class="form-group col-md-6" id="baDn">
                                                                        <label for="emailAddress" style="color: red;">Harap Upload Foto Berita Acara Karena Terdapat Perbedaan Data</label>
                                                                        <br>
                                                                        <label for="emailAddress">Upload File BA</label>
                                                                        <div class="form-file">
                                                                            <input type="file" class="form-file-input" id="customFile">
                                                                            <label class="form-file-label" for="customFile">
                                                                                <span class="form-file-text">Choose file...</span>
                                                                                <span class="form-file-button">Browse</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-3"></div>
                                                                    <div class="col-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-4 col-form-label" for="noDnTk" style="font-size: 22px; font-weight: bold;">No. DN Tolakan</label>
                                                                            <div class="col-8">
                                                                                <input type="text" name="noDnTk" id="noDnTk" style="font-size: 22px; font-weight: bold;" class="col-6 form-control" readonly value="<?= $value->mk_dn_t ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3"></div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="firstName" >Produk</label>
                                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-4">
                                                                        <label for="firstName">Produk</label>
                                                                        <input type="text" name="produkGrDepo" id="produkDnDepoTk" class="form-control" readonly value="<?= $value->material_nama ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="firstName">Qty</label>
                                                                        <input type="text" name="qtyGrDepo" id="qtyDnDepoTk" class="form-control" readonly value="<?= $value->mk_dn_t_qty ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="firstName">Produk</label>
                                                                        <input type="text" name="produkGrAdm" id="produkDnAdmT" class="form-control" value="<?= $value->material_nama ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="firstName">Qty</label>
                                                                        <input type="number" name="qtyDnAdmT" id="qtyDnAdmT" class="form-control" value="<?= $value->mk_dn_t_qty ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-3"></div>
                                                                    <div class="col-6">
                                                                        <div class="form-group row">
                                                                            <h5 class="col-12" style="text-align: center;">Detail Tolakan</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3"></div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="firstName" >Produk</label>
                                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-3">
                                                                        <label for="firstName">Gallon Kosong Aqua</label>
                                                                        <input type="text" name="glnKsgAqDepo" id="glnKsgAqDepo" class="form-control" readonly value="<?= (int)$value->mk_tk_gal_kos_aqua ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="firstName">Gallon Isi Aqua</label>
                                                                        <input type="text" name="glnIsiAqDepo" id="glnIsiAqDepo" class="form-control" readonly value="<?= (int)$value->mk_tk_gal_isi_aqua ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="firstName">Gallon Kosong Aqua</label>
                                                                        <input type="number" name="glnKsgAqAdm" id="glnKsgAqAdm" class="form-control" onchange="totalGln()" value="<?= (int)$value->mk_tk_gal_kos_aqua ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="firstName">Gallon Isi Aqua</label>
                                                                        <input type="number" name="glnIsiAqAdm" id="glnIsiAqAdm" class="form-control" onchange="totalGln()" value="<?= (int)$value->mk_tk_gal_isi_aqua ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="firstName" >Produk</label>
                                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-3">
                                                                        <label for="firstName">Gallon Kosong Vit</label>
                                                                        <input type="text" name="glnKsgVtDepo" id="glnKsgVtDepo" class="form-control" readonly value="<?= (int)$value->mk_tk_gal_kos_vit ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="firstName">Gallon Isi Vit</label>
                                                                        <input type="text" name="glnIsiVtDepo" id="glnIsiVtDepo" class="form-control" readonly value="<?= (int)$value->mk_tk_gal_isi_vit ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="firstName">Gallon Kosong Vit</label>
                                                                        <input type="number" name="glnKsgVtAdm" id="glnKsgVtAdm" class="form-control" onchange="totalGln()" value="<?= (int)$value->mk_tk_gal_kos_vit ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="firstName">Gallon Isi Vit</label>
                                                                        <input type="number" name="glnIsiVtAdm" id="glnIsiVtAdm" class="form-control" onchange="totalGln()" value="<?= (int)$value->mk_tk_gal_isi_vit ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="firstName" >Produk</label>
                                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="firstName">Total Gallon Kosong Depo</label>
                                                                        <input type="text" name="totalGlnKsgDepo" id="totalGlnKsgDepo" class="form-control" readonly value="<?= (int)$value->mk_tk_gal_kos_vit + (int)$value->mk_tk_gal_kos_aqua + (int)$value->mk_tk_gal_isi_aqua + (int)$value->mk_tk_gal_isi_vit ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="firstName">Total Gallon Kosong Admin</label>
                                                                        <input type="text" name="totalGlnKsgAdm" id="totalGlnKsgAdm" class="form-control" readonly value="<?= (int)$value->mk_tk_gal_kos_vit + (int)$value->mk_tk_gal_kos_aqua + (int)$value->mk_tk_gal_isi_aqua + (int)$value->mk_tk_gal_isi_vit ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- <div class="form-group col-md-4">
                                                                        <label for="firstName" >Produk</label>
                                                                        <input type="text" name="produkGrPool" id="produkGr" class="form-control" readonly>
                                                                    </div> -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="firstName">Total Gallon Isi Depo</label>
                                                                        <input type="text" name="totalGlnIsiDepo" id="totalGlnIsiDepo" class="form-control" readonly value="<?= (int)$value->mk_tk_gal_isi_vit + (int)$value->mk_tk_gal_isi_aqua ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="firstName">Total Gallon Isi Admin</label>
                                                                        <input type="text" name="totalGlnIsiAdm" id="totalGlnIsiAdm" class="form-control" readonly value="<?= (int)$value->mk_tk_gal_isi_vit + (int)$value->mk_tk_gal_isi_aqua ?>">
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group col-md-6"></div>
                                                                    <div class="form-group col-md-6" id="baDnTk">
                                                                        <label for="emailAddress" style="color: red;">Harap Upload Foto Berita Acara Karena Terdapat Perbedaan Data</label>
                                                                        <br>
                                                                        <label for="emailAddress">Upload File BA</label>
                                                                        <div class="form-file">
                                                                            <input type="file" class="form-file-input" name="uploadDnTk" id="customFile">
                                                                            <label class="form-file-label" for="customFile">
                                                                                <span class="form-file-text">Choose file...</span>
                                                                                <span class="form-file-button">Browse</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <ul class="list-inline pull-right">
                                                                    <li><button type="button" class="default-btn prev-step">Back</button></li>
                                                                    <li><button type="button" class="default-btn next-step">Next</button></li>
                                                                </ul>
                                                            </div>
                                                        <?php }
                                                        ?>

                                                        <!-- summary -->
                                                        <div class="tab-pane" role="tabpanel" id="step5">
                                                            <h4 class="text-center">Status: Draft</h4>
                                                            <div class="all-info-container">
                                                                <div class="row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="phoneNumber">Tanggal*</label>
                                                                        <input type="date" name="tglBtb" id="tglBtb" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group col-md-8">
                                                                        <label for="emailAddress">No. Dokumen</label>
                                                                        <input type="text" name="docId" id="docId" class="form-control" readonly value="<?= $id ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="phoneNumber">Gudang*</label>
                                                                        <select class="form-control" id="idGudang" name="gudang" style="background-color: #ffff;" required>
                                                                            <option>Pilih Gudang</option>
                                                                            <?php
                                                                            foreach ($gudang as $value) { ?>
                                                                                <option value="<?= $value->szId; ?>" selected><?= $value->szId; ?> | <?= $value->szName; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="emailAddress">Tipe Stok</label>
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
                                                                            <label for="phoneNumber">Tanggal Surat Jalan</label>
                                                                            <input type="text" name="dnTgl" id="dnTgl" class="form-control" value="<?= $key->mk_dn_date ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group col-md-8">
                                                                            <label for="emailAddress">No. Surat Jalan</label>
                                                                            <input type="text" name="dnNo" id="dnNo" class="form-control" value="<?= $key->mk_dn_m ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-4">
                                                                            <label for="phoneNumber">No. Ref 1</label>
                                                                            <input type="text" name="coNo" id="coNo" class="form-control" value="<?= $key->po_co ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="emailAddress">No. Ref 2</label>
                                                                            <input type="text" name="grNo" id="grNo" class="form-control" value="<?= $key->mk_gr ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="emailAddress">No. Ref 3</label>
                                                                            <input type="text" name="poNo" id="poNo" class="form-control" value="<?= $key->po_po_old ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="phoneNumber">Jasa Pengangkut</label>
                                                                            <input type="text" name="transporter" id="transporter" class="form-control" value="<?= $key->po_transporter_kode ?> - <?= $key->transporter_nama_npwp ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="emailAddress">Supplier</label>
                                                                            <input type="text" name="supplier" id="supplier" class="form-control" value="<?= $key->pabrik_nama ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="phoneNumber">Kendaraan</label>
                                                                            <input type="text" name="kendaraan" id="kendaraan" class="form-control" value="<?= $key->mk_armada_nopol ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="emailAddress">Pengemudi</label>
                                                                            <input type="text" name="pengemudi" id="pengemudi" class="form-control" value="<?= $key->mk_armada_driver ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
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
                                                                                        <td>
                                                                                            <input type="text" name="produkNama" id="produkNama" class="form-control" value="<?= $value->material_nama ?>" readonly>
                                                                                            <input type="hidden" name="produkKode" id="produkKode" class="form-control" value="<?= $value->material_kode ?>" readonly>
                                                                                            <input type="hidden" name="codeProduct[]" id="idCodeProduct" class="form-control" value="<?= $value->product_code ?>" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="varianQty" id="varianQty" class="form-control" value="<?= $value->mk_muatan_masuk ?>">
                                                                                            <input type="number" name="spsQty[]" id="spsQty" class="form-control" value="<?= $value->mk_muatan_masuk ?>" hidden>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php
                                                                                    $no++;
                                                                                } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
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
                                                                                    <tr>
                                                                                        <td>Tolakan Gallon Kosong Aqua</td>
                                                                                        <td><input type="text" name="smrCkrKsgAq" id="smrCkrKsgAq" class="form-control" value="<?= (int)$value->mk_tk_gal_kos_aqua ?>" readonly></td>
                                                                                        <td><input type="text" name="smrAdmKsgAq" id="smrAdmKsgAq" class="form-control" value="<?= (int)$value->mk_tk_gal_kos_aqua ?>" readonly></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Tolakan Gallon Isi Aqua</td>
                                                                                        <td><input type="text" name="smrCkrIsiAq" id="smrCkrIsiAq" class="form-control" value="<?= (int)$value->mk_tk_gal_isi_aqua ?>" readonly></td>
                                                                                        <td><input type="text" name="smrAdmIsiAq" id="smrAdmIsiAq" class="form-control" value="<?= (int)$value->mk_tk_gal_isi_aqua ?>" readonly></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Tolakan Gallon Kosong Vit</td>
                                                                                        <td><input type="text" name="smrCkrKsgVt" id="smrCkrKsgVt" class="form-control" value="<?= (int)$value->mk_tk_gal_kos_vit ?>" readonly></td>
                                                                                        <td><input type="text" name="smrAdmKsgVt" id="smrAdmKsgVt" class="form-control" value="<?= (int)$value->mk_tk_gal_kos_vit ?>" readonly></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Tolakan Gallon Isi Vit</td>
                                                                                        <td><input type="text" name="smrCkrIsiVt" id="smrCkrIsiVt" class="form-control" value="<?= (int)$value->mk_tk_gal_isi_vit ?>" readonly></td>
                                                                                        <td><input type="text" name="smrAdmIsiVt" id="smrAdmIsiVt" class="form-control" value="<?= (int)$value->mk_tk_gal_isi_vit ?>" readonly></td>
                                                                                    </tr>
                                                                                <?php
                                                                                } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="phoneNumber">Keterangan</label>
                                                                        <textarea name="keterangan" id="keterangan" rows="8" class="form-control"></textarea>
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

    <script>
        function totalGln() {
            var glnKsg = parseInt(document.getElementById('glnKsgAqAdm').value) + parseInt(document.getElementById('glnKsgVtAdm').value) + parseInt(document.getElementById('glnIsiAqAdm').value) + parseInt(document.getElementById('glnIsiVtAdm').value);
            var glnIsi = parseInt(document.getElementById('glnIsiAqAdm').value) + parseInt(document.getElementById('glnIsiVtAdm').value);

            document.getElementById('totalGlnKsgAdm').value = glnKsg;
            document.getElementById('totalGlnIsiAdm').value = glnIsi;
        }
    </script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js ?>"></script>

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

    <script>
        $('#tglDnAdmin').on('change', function(e) {
            // $('#enteredFirstName').text(e.target.value || 'Cha');
            $('input[name=dnTgl]').val(e.target.value);
        });

        $('#noDn').on('change', function(e) {
            // $('#enteredLastName').text(e.target.value || 'Ji-Hun C');
            $('input[name=dnNo]').val(e.target.value);
        });

        $('#noCo').on('change', function(e) {
            // $('#enteredPhoneNumber').text(e.target.value || '+230-582-6609');
            $('input[name=coNo]').val(e.target.value);
        });

        $('#noGr').on('change', function(e) {
            // $('#enteredEmailAddress').text(e.target.value || 'willms_abby@gmail.com');
            $('input[name=grNo]').val(e.target.value);
        });

        $('#noPo').on('change', function(e) {
            // $('#enteredDesignation').text(e.target.value || 'Junior Developer');
            $('input[name=poNo]').val(e.target.value);
        });

        $('#transporterAdm').on('change', function(e) {
            // $('#enteredDepartment').text(e.target.value || 'UI Development');
            $('input[name=transporter]').val(e.target.value);
        });

        $('#pabrikWindowAdm').on('change', function(e) {
            // $('#enteredEmployeeNumber').text(e.target.value || 'JDUI36849');
            $('input[name=supplier]').val(e.target.value);
        });

        $('#nopolAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=kendaraan]').val(e.target.value);
        });

        $('#driverAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=pengemudi]').val(e.target.value);
        });

        $('#returnIsiAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=smrAdmReturn]').val(e.target.value);
        });

        $('#jugrackAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=smrAdmJugrack]').val(e.target.value);
        });

        $('#glnKosongAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=smrAdmGalKos]').val(e.target.value);
        });

        $('#paletAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=smrAdmPalet]').val(e.target.value);
        });

        $("#baGr").hide();
        $('#qtyGrAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=smrAdmGr]').val(e.target.value);

            var admGr = e.target.value;
            var chkGr = document.getElementById('qtyGrDepo').value;

            if (admGr != chkGr) {
                $("#baGr").show();
            } else {
                $("#baGr").hide();
            }
        });

        $("#baDn").hide();
        $('#qtyDnAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            // $('input[name=smrAdmGr]').val(e.target.value);

            var admDn = e.target.value;
            var chkDn = document.getElementById('qtyDnDepo').value;

            if (admDn != chkDn) {
                $("#baDn").show();
            } else {
                $("#baDn").hide();
            }
        });

        $("#baDnTk").hide();
        $('#qtyDnAdmT').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            // $('input[name=smrAdmGr]').val(e.target.value);

            var admDn = e.target.value;
            var chkDn = document.getElementById('qtyDnDepoT').value;

            if (admDn != chkDn) {
                $("#baDnTk").show();
            } else {
                $("#baDnTk").hide();
            }
        });

        $("#baDnTk").hide();
        $('#glnKsgAqAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=smrAdmKsgAq]').val(e.target.value);

            var admDnTkKsg = document.getElementById('totalGlnKsgAdm').value;
            var admDnTkIsi = document.getElementById('totalGlnIsiAdm').value;
            var depoDnTkKsg = document.getElementById('totalGlnKsgDepo').value;
            var depoDnTkIsi = document.getElementById('totalGlnIsiDepo').value;

            if (admDnTkKsg != depoDnTkKsg || admDnTkIsi != depoDnTkIsi) {
                $("#baDnTk").show();
            } else {
                $("#baDnTk").hide();
            }
        });

        $("#baDnTk").hide();
        $('#glnIsiAqAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=smrAdmIsiAq]').val(e.target.value);

            var admDnTkKsg = document.getElementById('totalGlnKsgAdm').value;
            var admDnTkIsi = document.getElementById('totalGlnIsiAdm').value;
            var depoDnTkKsg = document.getElementById('totalGlnKsgDepo').value;
            var depoDnTkIsi = document.getElementById('totalGlnIsiDepo').value;

            if (admDnTkKsg != depoDnTkKsg || admDnTkIsi != depoDnTkIsi) {
                $("#baDnTk").show();
            } else {
                $("#baDnTk").hide();
            }
        });

        $("#baDnTk").hide();
        $('#glnKsgVtAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=smrAdmKsgVt]').val(e.target.value);

            var admDnTkKsg = document.getElementById('totalGlnKsgAdm').value;
            var admDnTkIsi = document.getElementById('totalGlnIsiAdm').value;
            var depoDnTkKsg = document.getElementById('totalGlnKsgDepo').value;
            var depoDnTkIsi = document.getElementById('totalGlnIsiDepo').value;

            if (admDnTkKsg != depoDnTkKsg || admDnTkIsi != depoDnTkIsi) {
                $("#baDnTk").show();
            } else {
                $("#baDnTk").hide();
            }
        });

        $("#baDnTk").hide();
        $('#glnIsiVtAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            $('input[name=smrAdmIsiVt]').val(e.target.value);

            var admDnTkKsg = document.getElementById('totalGlnKsgAdm').value;
            var admDnTkIsi = document.getElementById('totalGlnIsiAdm').value;
            var depoDnTkKsg = document.getElementById('totalGlnKsgDepo').value;
            var depoDnTkIsi = document.getElementById('totalGlnIsiDepo').value;

            if (admDnTkKsg != depoDnTkKsg || admDnTkIsi != depoDnTkIsi) {
                $("#baDnTk").show();
            } else {
                $("#baDnTk").hide();
            }
        });

        $("#uploadId").hide();
        $('#nopolAdm').on('change', function(e) {
            // $('#enteredWorkEmailAddress').text(e.target.value || 'willms_abby@company.com');
            var admValue = e.target.value;
            var chkValue = document.getElementById('nopolDepo').value;

            if (admValue != chkValue) {
                $("#uploadId").show();
            } else {
                $("#uploadId").hide();
            }
        });
    </script>

</body>

</html>