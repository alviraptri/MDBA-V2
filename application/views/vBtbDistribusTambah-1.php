<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BTB DISTRIBUSI</title>

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

        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
            width: -webkit-fill-available !important;
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
            margin: 20px -50vh 20px 33vh !important;
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
                            <h3>BTB Distribusi</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="<?php echo base_url('home/btbDistribusi'); ?>">BTB Distribusi</a>
                                    </li>
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
                                                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Detail BTB</i></a>
                                                        </li>
                                                        <li role="presentation" class="disabled">
                                                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Summary</i></a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <form role="form" action="<?php echo base_url('inventDist/simpanBtb'); ?>" method="POST" class="login-box" enctype="multipart/form-data">
                                                    <div class="tab-content" id="main_form">
                                                        <!-- detail btb -->
                                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group row">
                                                                        <label for="noBtb" style="font-size: 22px; font-weight: bold;">No. Dokumen (BTB)</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="noBtb" id="idNoBtb" style="font-size: 22px; font-weight: bold;" class="form-control" readonly value="<?= $id; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                if ($cek == 1) {
                                                                    foreach ($data as $value) {
                                                                        $nobkb = $value->szDocId;
                                                                    }
                                                                }
                                                                ?>
                                                                <div class="col-6">
                                                                    <div class="form-group row">
                                                                        <label for="noBkb" style="font-size: 22px; font-weight: bold;">No. BKB</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="noBkb" id="idNoBkb" style="font-size: 22px; font-weight: bold;" class="form-control" readonly value="<?= $nobkb; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h4>Checker</h4>
                                                                        <label>Kosongan</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <h4>Admin</h4>
                                                                        <label>Kosongan</label>
                                                                    </div>
                                                                </div>
                                                                <!-- detail kosongan -->
                                                                <?php
                                                                foreach ($kosongan as $value) { ?>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                        <div class="col-3">
                                                                            <input type="text" name="ckrAqKosPd" id="idCkrAqKosPd" class="form-control" readonly value="<?= $value->mKode; ?>">
                                                                            
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <input type="text" name="ckrAqKosPd" id="idCkrAqKosPd" class="form-control" readonly value="<?= $value->prod_kos; ?>">
                                                                            
                                                                        </div>
                                                                        <div class="col-3">
                                                                                <input type="text" name="ckrAqKos" id="idCkrAqKos" class="form-control" readonly value="<?= $value->qty; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <div class="col-3">
                                                                            <input type="text" name="ckrAqKosPd" id="idCkrAqKosPd" class="form-control" readonly value="<?= $value->mKode; ?>">
                                                                            
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <input type="text" name="ckrAqKosPd" id="idCkrAqKosPd" class="form-control" readonly value="<?= $value->prod_kos; ?>">
                                                                            
                                                                        </div>
                                                                        <div class="col-3">
                                                                                <input type="text" name="ckrAqKos" id="idCkrAqKos" class="form-control" value="<?= $value->qty; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="ckrAqKos">Total Kosongan</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="ckrAqKos" id="idCkrAqKos" class="form-control" readonly value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="admAqKos">Total Kosongan</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="admAqKos" id="idAdmAqKos" class="form-control" readonly onchange="totalGln()" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end detail kosongan -->

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Sisa</label>
                                                                        <input type="text" name="scrSisa" id="idScrSisa" class="form-control" readonly value="<?= $scrSisa; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Sisa</label>
                                                                        <input type="text" name="ckrSisa" id="idCkrSisa" class="form-control" readonly value="<?= $ckrSisa; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Sisa</label>
                                                                        <input type="text" name="admSisa" id="idAdmSisa" class="form-control" readonly value="<?= $ckrSisa; ?>">
                                                                    </div>
                                                                </div>
                                                                <!-- detail sisa -->
                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="ckrAqSisa">Aqua</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="ckrAqSisa" id="idCkrAqSisa" class="form-control" readonly value="<?= $ckrSisaAqua; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="admAqSisa">Aqua</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="admAqSisa" id="idAdmAqSisa" class="form-control" onchange="totalGln()" value="<?= $ckrSisaAqua; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="ckrVtSisa">Vit</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="ckrVtSisa" id="idCkrVtSisa" class="form-control" readonly value="<?= $ckrSisaVit; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="admVtSisa">Vit</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="admVtSisa" id="idAdmVtSisa" class="form-control" onchange="totalGln()" value="<?= $ckrSisaVit; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end detail sisa -->

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Jambot</label>
                                                                        <input type="text" name="scrJambot" id="idScrJambot" class="form-control" readonly value="<?= $scrJambot; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Jambot</label>
                                                                        <input type="text" name="ckrJambot" id="idCkrJambot" class="form-control" readonly value="<?= $ckrJambot; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Jambot</label>
                                                                        <input type="text" name="admJambot" id="idAdmJambot" class="form-control" readonly value="<?= $ckrJambot; ?>">
                                                                    </div>
                                                                </div>
                                                                <!-- detail jambot -->
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="scrAqJambot">Aqua</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="scrAqJambot" id="idScrAqJambot" class="form-control" readonly value="<?= $scrJambotAqua; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="ckrAqJambot">Aqua</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="ckrAqJambot" id="idCkrAqJambot" class="form-control" readonly value="<?= $ckrJambotAqua; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="admAqJambot">Aqua</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="admAqJambot" id="idAdmAqJambot" class="form-control" onchange="totalGln()" value="<?= $ckrJambotAqua; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="scrVtJambot">Vit</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="scrVtJambot" id="idScrVtJambot" class="form-control" readonly value="<?= $scrJambotVit; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="ckrVtJambot">Vit</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="ckrVtJambot" id="idCkrVtJambot" class="form-control" readonly value="<?= $ckrJambotVit; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="admVtJambot">Vit</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="admVtJambot" id="idAdmVtJambot" class="form-control" onchange="totalGln()" value="<?= $ckrJambotVit; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end detail jambot -->

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>BS</label>
                                                                        <input type="text" name="scrBs" id="idScrBs" class="form-control" readonly value="<?= $scrBs; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>BS</label>
                                                                        <input type="text" name="ckrBs" id="idCkrBs" class="form-control" readonly value="<?= $ckrBs; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>BS</label>
                                                                        <input type="text" name="admBs" id="idAdmBs" class="form-control" readonly value="<?= $ckrBs; ?>">
                                                                    </div>
                                                                </div>
                                                                <!-- detail bs -->
                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="ckrAqBs">Aqua</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="ckrAqBs" id="idCkrAqBs" class="form-control" readonly value="<?= $ckrBsAqua; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="admAqBs">Aqua</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="admAqBs" id="idAdmAqBs" class="form-control" onchange="totalGln()" value="<?= $ckrBsAqua; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="ckrVtBs">Vit</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="ckrVtBs" id="idCkrVtBs" class="form-control" readonly value="<?= $ckrBsVit; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-2 col-form-label" for="admVtBs">Vit</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="admVtBs" id="idAdmVtBs" class="form-control" onchange="totalGln()" value="<?= $ckrBsVit; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end detail bs -->
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

                                                        <!-- summary -->
                                                        <div class="tab-pane" role="tabpanel" id="step2">
                                                            <h4 class="text-center">Status: Draft</h4>
                                                            <div class="row">
                                                                <div class="form-group col-md-5">
                                                                    <label for="phoneNumber">No. Dokumen (BTB)</label>
                                                                    <input type="text" name="smrBtb" id="idSmrBtb" class="form-control" readonly value="<?= $id; ?>">
                                                                </div>
                                                                <div class="form-group col-md-5">
                                                                    <label for="phoneNumber">No. BKB</label>
                                                                    <input type="text" name="smrBkb" id="idSmrBkb" class="form-control" readonly value="<?= $noBkb; ?>">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label for="emailAddress">Tanggal</label>
                                                                    <input type="date" name="tgl" id="idTgl" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="phoneNumber">Gudang*</label>
                                                                    <select class="js-example-basic-single form-select" name="gudang" id="gudang">
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
                                                                    <label for="emailAddress">Tipe Stok</label>
                                                                    <div class="col-12">
                                                                        <select class="js-example-basic-single form-select" name="stok" id="stok">
                                                                            <option value=""> Pilih Tipe Stok </option>
                                                                            <option value="DLP">DLP - Stock dalam Perjualan</option>
                                                                            <option value="JAMBOT">JAMBOT - Stock botol di pelanggan</option>
                                                                            <option value="JUAL" selected>JUAL - Stock untuk penjualan</option>
                                                                            <option value="SEWA">SEWA - Produk sewa di pelanggan</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="phoneNumber">Pengemudi*</label>
                                                                    <select class="js-example-basic-single form-select" name="pengemudi" id="pengemudi">
                                                                        <option>Pilih Pengemudi</option>
                                                                        <?php
                                                                        foreach ($pengemudi as $key) {
                                                                            if ($driver == $key->szName) { ?>
                                                                                <option value="<?= $key->szId; ?>" selected><?= $key->szId; ?> - <?= $key->szName; ?></option>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <option value="<?= $key->szId; ?>"><?= $key->szId; ?> - <?= $key->szName; ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="phoneNumber">Kendaraan*</label>
                                                                    <select class="js-example-basic-single form-select" name="kendaraan" id="kendaraan">
                                                                        <option>Pilih Kendaraan</option>
                                                                        <?php
                                                                        foreach ($kendaraan as $key) {
                                                                            if ($vehicle == $key->szPoliceNo) { ?>
                                                                                <option value="<?= $key->szPoliceNo; ?>" selected><?= $key->szPoliceNo; ?></option>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <option value="<?= $key->szPoliceNo; ?>"><?= $key->szPoliceNo; ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <table class='table table-striped'>
                                                                        <thead>
                                                                            <tr>
                                                                                <!-- <th>No.</th> -->
                                                                                <th>Nama Produk</th>
                                                                                <th>Qty</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="table_body">
                                                                            <?php
                                                                            if ($prodKosAq == 'AQ.5GALLON BTL' || $prodKosVt == 'VT.5GALON BTL') {
                                                                                if ($prodKosAq == 'AQ.5GALLON BTL' || $prodKosVt == 'VT.5GALON BTL') {
                                                                            ?>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            AQ.5GALLON BTL
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="74559G" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idKosAq" class="form-control" value="<?= $aqBtl; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="BOTOL">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            VT.5GALON BTL
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="74560G" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idKosVt" class="form-control" value="<?= $vtBtl; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="BOTOL">
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php
                                                                                } elseif ($prodKosAq == 'AQ.5GALLON BTL') {
                                                                                ?>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            AQ.5GALLON BTL
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="74559G" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idKosAq" class="form-control" value="<?= $aqBtl; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="BOTOL">
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php
                                                                                } elseif ($prodKosVt == 'VT.5GALON BTL') { ?>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            VT.5GALON BTL
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="74560G" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idKosVt" class="form-control" value="<?= $vtBtl; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="BOTOL">
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php
                                                                                }
                                                                                ?>

                                                                                <?php

                                                                                if ($ckrSisaAqua != '0' && $ckrSisaVit != '0') {
                                                                                ?>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            AQ.5GALLON ISI
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="74559" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idSisaAq" class="form-control" value="<?= $aqIsi; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="BOTOL">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            AQ.TISSUE
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="19310" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idSisaAqTisu" class="form-control" value="<?= $ckrSisaAqua; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="LEMBAR">
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            VT.5GLN ISI
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="74560" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idSisaVt" class="form-control" value="<?= $vtIsi; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="BOTOL">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            VT.TISSUE
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="29310" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idSisaVtTisu" class="form-control" value="<?= $ckrSisaVit; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="LEMBAR">
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php
                                                                                } elseif ($ckrSisaAqua != '0') {
                                                                                ?>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            AQ.5GALLON ISI
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="74559" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idSisaAq" class="form-control" value="<?= $aqIsi; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="BOTOL">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            AQ.TISSUE
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="19310" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idSisaAqTisu" class="form-control" value="<?= $ckrSisaAqua; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="LEMBAR">
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php
                                                                                } elseif ($ckrSisaVit != '0') {
                                                                                ?>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            VT.5GLN ISI
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="74560" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idSisaVt" class="form-control" value="<?= $vtIsi; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="BOTOL">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <!-- <td>1</td> -->
                                                                                        <td>
                                                                                            VT.TISSUE
                                                                                            <input type="hidden" name="produkKode[]" id="produkKode" class="form-control" value="29310" readonly>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" name="produkQty[]" id="idSisaVtTisu" class="form-control" value="<?= $ckrSisaVit; ?>">
                                                                                            <input type="hidden" name="produkSatuan[]" id="idKosAq" class="form-control" value="LEMBAR">
                                                                                        </td>
                                                                                    </tr>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
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
            var btlAq = (parseInt(document.getElementById('idAdmAqKos').value) + parseInt(document.getElementById('idAdmAqSisa').value)) - parseInt(document.getElementById('idAdmAqJambot').value);
            var btlVt = (parseInt(document.getElementById('idAdmVtKos').value) + parseInt(document.getElementById('idAdmVtSisa').value)) - parseInt(document.getElementById('idAdmVtJambot').value);
            var kosTotal = parseInt(document.getElementById('idAdmAqKos').value) + parseInt(document.getElementById('idAdmVtKos').value);
            var sisaTotal = parseInt(document.getElementById('idAdmVtSisa').value) + parseInt(document.getElementById('idAdmAqSisa').value);
            var jambotTotal = parseInt(document.getElementById('idAdmVtJambot').value) + parseInt(document.getElementById('idAdmAqJambot').value);
            var bsTotal = parseInt(document.getElementById('idAdmVtBs').value) + parseInt(document.getElementById('idAdmAqBs').value);

            document.getElementById('idAdmKosongan').value = kosTotal;
            document.getElementById('idAdmSisa').value = sisaTotal;
            document.getElementById('idAdmJambot').value = jambotTotal;
            document.getElementById('idAdmBs').value = bsTotal;
            document.getElementById('idKosAq').value = btlAq;
            document.getElementById('idKosVt').value = btlVt;
            document.getElementById('idSisaAq').value = document.getElementById('idAdmAqSisa').value;
            document.getElementById('idSisaAqTisu').value = document.getElementById('idAdmAqSisa').value;
            document.getElementById('idSisaVt').value = document.getElementById('idAdmVtSisa').value;
            document.getElementById('idSisaVtTisu').value = document.getElementById('idAdmVtSisa').value;
            document.getElementById('idBsVitIsi').value = document.getElementById('idAdmVtBs').value;
            document.getElementById('idBsVitBtl').value = document.getElementById('idAdmVtBs').value;
            document.getElementById('idBsAquaIsi').value = document.getElementById('idAdmAqBs').value;
            document.getElementById('idBsAquaBtl').value = document.getElementById('idAdmAqBs').value;
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
        $('#idAdmAqSisa').on('change', function(e) {
            $('#idSisaAq').text(e.target.value);
            $('#idSisaAqTisu').text(e.target.value);
            // $('input[name=dnTgl]').val(e.target.value);
        });

        $('#idAdmVtSisa').on('change', function(e) {
            $('#idSisaVt').text(e.target.value);
            $('#idSisaVtTisu').text(e.target.value);
        });

        $('#idAdmAqBs').on('change', function(e) {
            $('#idBsAqIsi').text(e.target.value);
            $('#idBsAqBtl').text(e.target.value);
        });

        $('#idAdmVtBs').on('change', function(e) {
            $('#idBsVtIsi').text(e.target.value);
            $('#idBsVtBtl').text(e.target.value);
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

    <!-- SELECT2 -->
    <script src="<?php echo base_url(); ?>assets/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Pilih Produk"
            });
        });
    </script>

</body>

</html>