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
                                                                            <input type="text" name="btb" id="idBtb" style="font-size: 22px; font-weight: bold;" class="form-control" readonly value="<?= $id; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                foreach ($data as $value) {
                                                                    $nobkb = $value->szDocId;
                                                                }
                                                                ?>
                                                                <div class="col-6">
                                                                    <div class="form-group row">
                                                                        <label for="noBkb" style="font-size: 22px; font-weight: bold;">No. BKB</label>
                                                                        <div class="col-10">
                                                                            <input type="text" name="bkb" id="idBkb" style="font-size: 22px; font-weight: bold;" class="form-control" readonly value="<?= $nobkb; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br><br>

                                                            <!-- ifnya dimulai disini -->
                                                            <?php
                                                            if ($cek == 1) { ?>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <h4 style="font-weight: bolder;">Checker</h4>
                                                                            <label style="font-style: italic; font-weight: bold;">Kosongan</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <h4 style="font-weight: bolder;">Admin</h4>
                                                                            <label style="font-style: italic; font-weight: bold;">Kosongan</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- detail kosongan -->
                                                                    <?php
                                                                    $kosNo = 0;
                                                                    $ttlKos = 0;
                                                                    foreach ($kosongan as $value) { ?>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div class="col-3">
                                                                                    <input type="text" name="ckrKosKode[]" id="idCkrKosKode" class="form-control" readonly value="<?= $value->mKode; ?>">

                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <input type="text" name="ckrKosPd" id="idCkrKosPd" class="form-control" readonly value="<?= $value->prod_kos; ?>">

                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <input type="text" name="ckrKosQty[]" id="idCkrKosQty" class="form-control" readonly value="<?= $value->qty; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div class="col-3">
                                                                                    <select class="js-example-basic-single form-select" name="admKosKode[]" id="idAdmKosKode<?= $kosNo; ?>" onchange="getFormProdKos(<?= $kosNo; ?>)">
                                                                                        <option>Pilih Produk</option>
                                                                                        <?php
                                                                                        foreach ($product as $prod) {
                                                                                            if ($prod->szId == $value->mKode) { ?>
                                                                                                <option value="<?= $prod->szId; ?>" selected><?= $prod->szId; ?></option>
                                                                                            <?php } else { ?>
                                                                                                <option value="<?= $prod->szId; ?>"><?= $prod->szId; ?></option>
                                                                                        <?php }
                                                                                        } ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <input type="text" name="admKosPd" id="idAdmKosPd<?= $kosNo; ?>" class="form-control" readonly value="<?= $value->prod_kos; ?>">

                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <input type="text" name="admKosQty[]" id="idAdmKosQty<?= $kosNo; ?>" class="form-control" onkeypress="return hanyaAngka(event)" onchange="totalGlnKos()" value="<?= $value->qty; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                        $ttlKos += (int)$value->qty;
                                                                        $kosNo++;
                                                                    }
                                                                    ?>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="ckrAqKos">Total Kosongan</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="ckrTtlAqKos" id="idCkrTtlAqKos" class="form-control" readonly value="<?= $ttlKos; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="admAqKos">Total Kosongan</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="admTtlAqKos" id="idAdmTtlAqKos" class="form-control" readonly value="<?= $ttlKos; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end detail kosongan -->
                                                                    <br>

                                                                    <?php
                                                                    foreach ($data as $value) {
                                                                        $sisaAq = $value->sisa_aqua;
                                                                        $sisaVt = $value->sisa_vit;
                                                                        $jambotAq = $value->jambot_aqua;
                                                                        $jambotVt = $value->jambot_vit;
                                                                    }
                                                                    ?>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label style="font-style: italic; font-weight: bold;">Sisa</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label style="font-style: italic; font-weight: bold;">Sisa</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- detail sisa -->
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="ckrAqSisa">Aqua</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="ckrAqSisa" id="idCkrAqSisa" class="form-control" readonly value="<?= (int)$sisaAq; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="admAqSisa">Aqua</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="admAqSisa" id="idAdmAqSisa" class="form-control" onkeypress="return hanyaAngka(event)" onchange="totalSisa()" value="<?= (int)$sisaAq; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="ckrVtSisa">Vit</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="ckrVtSisa" id="idCkrVtSisa" class="form-control" readonly value="<?= (int)$sisaVt; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="admVtSisa">Vit</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="admVtSisa" id="idAdmVtSisa" class="form-control" onkeypress="return hanyaAngka(event)" onchange="totalSisa()" value="<?= (int)$sisaVt; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="ckrAqKos">Total Sisa</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="ckrTtlAqKos" id="idCkrTtlSisa" class="form-control" readonly value="<?= (int)$sisaVt + (int)$sisaAq; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="admAqKos">Total Sisa</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="admTtlAqKos" id="idAdmTtlSisa" class="form-control" readonly value="<?= (int)$sisaVt + (int)$sisaAq; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end detail sisa -->
                                                                    <br><br>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label style="font-style: italic; font-weight: bold;">Jambot</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label style="font-style: italic; font-weight: bold;">Jambot</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- detail jambot -->
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="scrAqJambot">Aqua</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="ckrAqJambot" id="idCkrAqJambot" class="form-control" readonly value="<?= (int)$jambotAq; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="admAqJambot">Aqua</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="admAqJambot" id="idAdmAqJambot" class="form-control" onkeypress="return hanyaAngka(event)" onchange="totalJambot()" value="<?= (int)$jambotAq; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="ckrVtJambot">Vit</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="ckrVtJambot" id="idCkrVtJambot" class="form-control" readonly value="<?= (int)$jambotVt; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="admVtJambot">Vit</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="admVtJambot" id="idAdmVtJambot" class="form-control" onkeypress="return hanyaAngka(event)" onchange="totalJambot()" value="<?= (int)$jambotVt; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="ckrAqKos">Total Jambot</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="ckrTtlJambot" id="idCkrTtlJambot" class="form-control" readonly value="<?= (int)$jambotVt + (int)$jambotAq; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="admAqKos">Total Jambot</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="admTtlJambot" id="idAdmTtlJambot" class="form-control" readonly value="<?= (int)$jambotVt + (int)$jambotAq; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end detail jambot -->

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label style="font-style: italic; font-weight: bold;">BS</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label style="font-style: italic; font-weight: bold;">BS</label>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    if ($bs != 0) {
                                                                        $bsNo = 0;
                                                                        $ttlBs = 0;
                                                                        foreach ($bs as $value) { ?>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group row">
                                                                                    <div class="col-3">
                                                                                        <input type="text" name="ckrAqBsPd[]" id="idCkrAqKosPd" class="form-control" readonly value="<?= $value->mKode; ?>">
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <input type="text" name="ckrAqBsPd" id="idCkrAqBsPd<?= $bsNo; ?>" class="form-control" readonly value="<?= $value->produk; ?>">

                                                                                    </div>
                                                                                    <div class="col-3">
                                                                                        <input type="text" name="ckrAqBs[]" id="idCkrAqBs<?= $bsNo; ?>" class="form-control" readonly value="<?= $value->qty; ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group row">
                                                                                    <div class="col-3">
                                                                                        <select class="js-example-basic-single form-select" name="admBsKode[]" id="idAdmBsKode<?= $bsNo; ?>" onchange="getFormProdBs(<?= $bsNo; ?>)">
                                                                                            <option>Pilih Produk</option>
                                                                                            <?php
                                                                                            foreach ($product as $prod) {
                                                                                                if ($prod->szId == $value->mKode) { ?>
                                                                                                    <option value="<?= $prod->szId; ?>" selected><?= $prod->szId; ?></option>
                                                                                                <?php } else { ?>
                                                                                                    <option value="<?= $prod->szId; ?>"><?= $prod->szId; ?></option>
                                                                                            <?php }
                                                                                            } ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <input type="text" name="admBsPd" id="idAdmBsPd" class="form-control" readonly value="<?= $value->produk; ?>">

                                                                                    </div>
                                                                                    <div class="col-3">
                                                                                        <input type="text" name="admBsQty[]" id="idAdmBsQty<?= $bsNo; ?>" class="form-control" value="<?= $value->qty; ?>" onkeypress="return hanyaAngka(event)" onchange="totalBs()">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                            $bsNo++;
                                                                            $ttlBs += (int)$value->qty;
                                                                        }
                                                                    } else {
                                                                        $ttlBs = 0; ?>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div class="col-3">
                                                                                    <input type="text" name="ckrAqKosPd" id="idCkrAqKosPd" class="form-control" readonly value="-">

                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <input type="text" name="ckrAqKosPd" id="idCkrAqKosPd" class="form-control" readonly value="-">

                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <input type="text" name="ckrAqKos" id="idCkrAqKos" class="form-control" value="0">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div class="col-3">
                                                                                    <input type="text" name="ckrAqKosPd" id="idCkrAqKosPd" class="form-control" readonly value="-">

                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <input type="text" name="ckrAqKosPd" id="idCkrAqKosPd" class="form-control" readonly value="-">

                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <input type="text" name="ckrAqKos" id="idCkrAqKos" class="form-control" value="0">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php }
                                                                    ?>

                                                                    <!-- detail bs -->
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="ckrAqKos">Total BS</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="ckrTtlBs" id="idCkrTtlBs" class="form-control" readonly value="<?= $ttlBs; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-2 col-form-label" for="admAqKos">Total BS</label>
                                                                            <div class="col-10">
                                                                                <input type="text" name="admTtlBs" id="idAdmTtlBs" class="form-control" readonly value="<?= $ttlBs; ?>">
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
                                                            <?php
                                                            }
                                                            ?>

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
                                                                    <input type="text" name="smrBkb" id="idSmrBkb" class="form-control" readonly value="<?= $nobkb; ?>">
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
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="emailAddress">Tipe Stok</label>
                                                                    <div class="col-12">
                                                                        <select class="js-example-basic-single form-select" name="gudang" id="gudang">
                                                                            <option>Pilih Gudang</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="phoneNumber">Pengemudi*</label>
                                                                    <div class="row">
                                                                        <div class="col-4" style="padding-right: 0">
                                                                            <select class="js-example-basic-single col-md-6 form-select" name="pengemudi" id="idPengemudi" onchange="getFormPengemudi()">
                                                                                <option value="-" disabled>Pilih Pengemudi</option>
                                                                                <option value=""></option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-8" style="padding-left: 0;">
                                                                            <input type="text" id="pengemudiNama" class="form-control" name="namaPengemudi" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="phoneNumber">Kendaraan*</label>
                                                                    <div class="row">
                                                                        <div class="col-4" style="padding-right: 0">
                                                                            <select class="js-example-basic-single col-md-6 form-select" name="kendaraan" id="idKendaraan" onchange="getFormKendaraan()">
                                                                                <option value="-" disabled>Pilih Kendaraan</option>
                                                                                <option value=""></option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-8" style="padding-left: 0;">
                                                                            <input type="text" id="kendaraanNama" class="form-control" name="namaKendaraan" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <table class='table table-striped'>
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No.</th>
                                                                                <th>Kode</th>
                                                                                <th>Produk</th>
                                                                                <th>Satuan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="table_body">
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
        function totalSisa() {
            var sisa = parseInt(document.getElementById('idAdmAqSisa').value) + parseInt(document.getElementById('idAdmVtSisa').value);

            document.getElementById('idAdmTtlSisa').value = sisa;
        }

        function totalJambot() {
            var jambot = parseInt(document.getElementById('idAdmAqJambot').value) + parseInt(document.getElementById('idAdmVtJambot').value);

            document.getElementById('idAdmTtlJambot').value = jambot;
        }
    </script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js ?>"></script>

    <script>
        function getFormProdKos(x) {
            var produk = document.getElementById('idAdmKosKode' + x).value;

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
                        document.getElementById('idAdmKosPd' + x).value = row.szName;
                    }
                }
            })
        }

        function getFormProdBs(x) {
            var produk = document.getElementById('idAdmBsKode' + x).value;

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
                        document.getElementById('idAdmBsPd' + x).value = row.szName;
                    }
                }
            })
        }
    </script>

    <script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
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
                placeholder: "Pilih"
            });
        });
    </script>

</body>

</html>