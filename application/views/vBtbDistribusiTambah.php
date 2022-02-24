<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BTB DISTRIBUSI</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/app.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/favicon.ico" type="image/x-icon">
    <!-- SELECT2 -->
    <link href="<?php echo base_url(); ?>assets/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 2.5em !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.5em !important;
        }

        .is-invalid .select2-container--default .select2-selection--single {
            border-color: #dc3545;
        }
    </style>

    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--===============================================================================================-->
</head>

<body>
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
                            <h3>BTB DISTRIBUSI</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('home'); ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="<?php echo base_url('home/btbDistribusi'); ?>">BTB Distribusi</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tambah BTB Distribusi</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="formId" action="<?php echo base_url('inventDist/simpanHistory'); ?>" method="POST">
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
                                                    $pengemudi = $value->szEmployeeId;
                                                    $kendaraan = $value->szVehicleId;
                                                    $gudang = $value->szWarehouseId;
                                                    $stok = $value->szStockType;
                                                }
                                                ?>
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <label for="noBkb" style="font-size: 22px; font-weight: bold;">No. BKB</label>
                                                        <div class="col-10">
                                                            <input type="text" name="bkb" id="idBkb" style="font-size: 22px; font-weight: bold;" class="form-control" readonly value="<?= $nobkb; ?>">
                                                            <input type="hidden" name="pengemudi" value="<?= $pengemudi; ?>">
                                                            <input type="hidden" name="kendaraan" value="<?= $kendaraan; ?>">
                                                            <input type="hidden" name="gudang" value="<?= $gudang; ?>">
                                                            <input type="hidden" name="stok" value="<?= $stok; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>

                                            <!-- ifnya dimulai disini -->

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
                                                if ($kosongan != '0') {
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
                                                                    <input type="text" name="admKosKode[]" id="idAdmKosKode" class="form-control" readonly value="<?= $value->mKode; ?>">
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="text" name="admKosPd" id="idAdmKosPd<?= $kosNo; ?>" class="form-control" readonly value="<?= $value->prod_kos; ?>">

                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="text" name="admKosQty[]" id="idAdmKosQty<?= $kosNo; ?>" readonly class="form-control" onkeypress="return hanyaAngka(event)" value="<?= $value->qty; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                        $ttlKos += (int)$value->qty;
                                                        $kosNo++;
                                                    }
                                                }
                                                ?>
                                                <br><br><br>

                                                <?php
                                                if ($data != '0') {
                                                    foreach ($data as $value) {
                                                        $sisaAq = $value->sisa_aqua;
                                                        $sisaVt = $value->sisa_vit;
                                                        $jambotAq = $value->jambot_aqua;
                                                        $jambotVt = $value->jambot_vit;
                                                    }
                                                ?>
                                                    <div class="row">
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
                                                                <input type="text" name="admAqSisa" id="idAdmAqSisa" class="form-control" readonly onkeypress="return hanyaAngka(event)" onchange="totalSisa()" value="<?= (int)$sisaAq; ?>">
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
                                                                <input type="text" name="admVtSisa" id="idAdmVtSisa" class="form-control" readonly onkeypress="return hanyaAngka(event)" onchange="totalSisa()" value="<?= (int)$sisaVt; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br><br><br>

                                                    <div class="row">
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
                                                                <input type="text" name="admAqJambot" id="idAdmAqJambot" class="form-control" readonly onkeypress="return hanyaAngka(event)" onchange="totalJambot()" value="<?= (int)$jambotAq; ?>">
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
                                                                <input type="text" name="admVtJambot" id="idAdmVtJambot" class="form-control" readonly onkeypress="return hanyaAngka(event)" onchange="totalJambot()" value="<?= (int)$jambotVt; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br><br><br>

                                                <?php } ?>

                                                <div class="row">
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
                                                </div>

                                                <?php
                                                if ($bs != 0) {
                                                    $bsNo = 0;
                                                    $ttlBs = 0;
                                                    foreach ($bs as $value) { ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <div class="col-3">
                                                                    <input type="text" name="ckrBsKode[]" id="idCkrAqKosPd" class="form-control" readonly value="<?= $value->mKode; ?>">
                                                                    <!-- <input type="hidden" name="bs" id="idCkrAqKosPd" class="form-control" readonly value="<?= $bs; ?>"> -->
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="text" name="ckrBsPd" id="idCkrAqBsPd<?= $bsNo; ?>" class="form-control" readonly value="<?= $value->produk; ?>">

                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="text" name="ckrBsQty[]" id="idCkrAqBs<?= $bsNo; ?>" class="form-control" readonly value="<?= $value->qty; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <div class="col-3">
                                                                    <input type="text" name="admBsKode[]" id="idAdmAqKosPd" class="form-control" readonly value="<?= $value->mKode; ?>">
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="text" name="admBsPd" id="idAdmBsPd" class="form-control" readonly value="<?= $value->produk; ?>">

                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="text" name="admBsQty[]" id="idAdmBsQty<?= $bsNo; ?>" readonly class="form-control" value="<?= $value->qty; ?>" onkeypress="return hanyaAngka(event)" onchange="totalBs()">
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
                                                                <input type="text" name="ckrBsKode" id="idCkrAqKosPd" class="form-control" readonly value="-">
                                                                <input type="hidden" name="bs" id="idCkrAqKosPd" class="form-control" readonly value="<?= $bs; ?>">

                                                            </div>
                                                            <div class="col-6">
                                                                <input type="text" name="ckrBsPd" id="idCkrAqKosPd" class="form-control" readonly value="-">

                                                            </div>
                                                            <div class="col-3">
                                                                <input type="text" name="ckrBsQty" id="idCkrAqKos" class="form-control" readonly value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <div class="col-3">
                                                                <input type="text" name="admBsKode" id="idCkrAqKosPd" class="form-control" readonly value="-">

                                                            </div>
                                                            <div class="col-6">
                                                                <input type="text" name="admBsKodePd" id="idCkrAqKosPd" class="form-control" readonly value="-">

                                                            </div>
                                                            <div class="col-3">
                                                                <input type="text" name="admBsKodeQty" id="idCkrAqKos" class="form-control" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }
                                                ?>
                                                <br><br><br>
                                                <div class="form-group col-md-6"></div>
                                                <div class="form-group col-md-6" id="uploadGln">
                                                    <label for="emailAddress" style="color: red;">Harap Upload Foto Berita Acara Karena Terdapat Perbedaan Data</label>
                                                    <br>
                                                    <label for="emailAddress">Upload File BA</label>
                                                    <div class="form-file">
                                                        <input type="file" name="uploadBaGln" class="form-file-input" id="customFile">
                                                        <label class="form-file-label" for="customFile">
                                                            <span class="form-file-text">Choose file...</span>
                                                            <span class="form-file-button">Browse</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <label for="noBtb" style="font-size: 22px; font-weight: bold;">Summary</label>
                                                        <div class="col-10"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                </div>
                                            </div>

                                            <?php
                                            $bsIsiAq = 0;
                                            $bsIsiVt = 0;
                                            $bsKsgVt = 0;
                                            $bsKsgAq = 0;
                                            if ($bs != '0') {
                                                foreach ($bs as $value) {
                                                    if ($value->mKode == '41001') {
                                                        $bsIsiAq = $value->qty;
                                                        $bsKsgAq = $value->qty;
                                                    } else if ($value->mKode == '42001') {
                                                        $bsKsgAq = $value->qty;
                                                    } else if ($value->mKode == '41013') {
                                                        $bsIsiVt = $value->qty;
                                                        $bsKsgVt = $value->qty;
                                                    } else if ($value->mKode == '41012') {
                                                        $bsKsgVt = $value->qty;
                                                    }
                                                }
                                            }

                                            $sisaBtlAq = 0;
                                            $sisaIsiAq = 0;
                                            $sisaTisuAq = 0;
                                            $sisaBtlVt = 0;
                                            $sisaIsiVt = 0;
                                            $sisaTisuVt = 0;
                                            if ($data != '0') {
                                                foreach ($data as $value) {
                                                    if ($value->sisa_aqua != '') {
                                                        $sisaBtlAq = $value->sisa_aqua;
                                                        $sisaIsiAq = $value->sisa_aqua;
                                                        $sisaTisuAq = $value->sisa_aqua;
                                                    }
                                                    if ($value->sisa_vit != '') {
                                                        $sisaBtlVt = $value->sisa_vit;
                                                        $sisaIsiVt = $value->sisa_vit;
                                                        $sisaTisuVt = $value->sisa_vit;
                                                    }
                                                }
                                            }

                                            $ksgAq = 0;
                                            $ksgVt = 0;
                                            if ($kosongan != '0') {
                                                foreach ($kosongan as $value) {
                                                    if ($value->mKode == '74559G') {
                                                        $ksgAq = $value->qty;
                                                    }

                                                    if ($value->mKode == '74560G') {
                                                        $ksgVt = $value->qty;
                                                    }
                                                }
                                            }

                                            $tisuAq = (int)$sisaTisuAq + (int)$bsKsgAq;
                                            $tisuVt = (int)$sisaTisuVt + (int)$bsKsgVt;

                                            $kosongAq = (int)$ksgAq + (int)$sisaBtlAq + (int)$bsKsgAq;
                                            $kosongVt = (int)$ksgVt + (int)$sisaBtlVt + (int)$bsKsgVt;

                                            $isiAq = (int)$bsIsiAq + (int)$sisaIsiAq;
                                            $isiVt = (int)$bsIsiVt + (int)$sisaIsiVt;
                                            ?>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-style: italic; font-weight: bold;">Aqua</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-style: italic; font-weight: bold;">Vit</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-3">
                                                            <input type="text" name="tisuAq" id="idTisuAq" class="form-control" readonly value="19310">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" name="namaTisuAq" id="idNamaTisuAq" class="form-control" readonly value="AQ.TISSUE">
                                                            <input type="hidden" name="satuanTisuAq" id="idSatuanTisuAq" class="form-control" readonly value="LEMBAR">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" name="qtyTisuAq" id="idQtyTisuAq" class="form-control" value="<?= $tisuAq ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-3">
                                                            <input type="text" name="tisuVt" id="idTisuVt" class="form-control" readonly value="29310">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" name="namaTisuVt" id="idNamaTisuVt" class="form-control" readonly value="VT.TISSUE">
                                                            <input type="hidden" name="satuanTisuVt" id="idSatuanTisuVt" class="form-control" readonly value="LEMBAR">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" name="qtyTisuVt" id="idQtyTisuVt" class="form-control" value="<?= $tisuVt ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-3">
                                                            <input type="text" name="isiAq" id="idIsiAq" class="form-control" readonly value="74559">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" name="namaIsiAq" id="idNamaIsiAq" class="form-control" readonly value="AQ.5GALLON ISI">
                                                            <input type="hidden" name="satuanIsiAq" id="idSatuanIsiAq" class="form-control" readonly value="BOTOL">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" name="qtyIsiAq" id="idQtyIsiAq" class="form-control" value="<?= $isiAq ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-3">
                                                            <input type="text" name="isiVt" id="idIsiVt" class="form-control" readonly value="74560">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" name="namaIsiVt" id="idNamaIsiVt" class="form-control" readonly value="VT.5GLN ISI">
                                                            <input type="hidden" name="satuanIsiVt" id="idSatuanIsiVt" class="form-control" readonly value="BOTOL">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" name="qtyIsiVt" id="idQtyIsiVt" class="form-control" value="<?= $isiVt ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-3">
                                                            <input type="text" name="ksgAq" id="idKsgAq" class="form-control" readonly value="74559G">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" name="namaKsgAq" id="idNamaKsgAq" class="form-control" readonly value="AQ.5GALLON BTL">
                                                            <input type="hidden" name="satuanKsgAq" id="idSatuanKsgAq" class="form-control" readonly value="BOTOL">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" name="qtyKsgAq" id="idQtyKsgAq" class="form-control" value="<?= $kosongAq ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-3">
                                                            <input type="text" name="ksgVt" id="idKsgVt" class="form-control" readonly value="74560G">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" name="namaKsgVt" id="idNamaKsgVt" class="form-control" readonly value="VT.5GALON BTL">
                                                            <input type="hidden" name="satuanKsgVt" id="idSatuanKsgVt" class="form-control" readonly value="BOTOL">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" name="qtyKsgVt" id="idQtyKsgVt" class="form-control" value="<?= $kosongVt ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <a href="<?php echo base_url('home/btbDistribusi') ?>">
                                                    <button type="button" class="btn btn-white me-1 mb-1">Cancel</button>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
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

    <script type="text/javascript" src="<?php echo base_url('assets/jquery-3.3.1.js'); ?>"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/app.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/main.js"></script>

    <!-- SELECT2 -->
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Pilih"
            });
        });

        $(document).ready(function() {
            // Init all select2 elements
            $('.js-example-basic-single').select2();

            $('form').on('submit', function(e) {
                var $select2 = $('.js-example-basic-single', $(this));

                // Reset
                $select2.parents('.form-group').removeClass('is-invalid');

                if ($select2.val() === '') {

                    // Add is-invalid class when select2 element is required
                    $select2.parents('.form-group').addClass('is-invalid');

                    // Stop submiting
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
    <script>
        var result = 0;

        function totalGlnKos(x) {
            var kosongan = document.getElementById('idAdmKosQty' + x).value;

            result += parseInt(kosongan);
            console.log(result);
        }
    </script>
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

        function getFormProdSisa(x) {
            var produk = document.getElementById('idAdmSisaKode' + x).value;

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
                        document.getElementById('idAdmSisaPd' + x).value = row.szName;
                    }
                }
            })
        }
    </script>

    <script>
        $("#uploadGln").hide();
        $('#idAdmKosQty0').on('change', function(e) {
            $('input[name=smrAdmGr]').val(e.target.value);

            var admGr = e.target.value;
            var chkGr = document.getElementById('qtyGrDepo').value;

            if (admGr != chkGr) {
                $("#baGr").show();
            } else {
                $("#baGr").hide();
            }
        });

        $("#uploadSps").hide();
        $('#idAdmKosQty0').on('change', function(e) {
            $('input[name=smrAdmGr]').val(e.target.value);

            var admGr = e.target.value;
            var chkGr = document.getElementById('qtyGrDepo').value;

            if (admGr != chkGr) {
                $("#baGr").show();
            } else {
                $("#baGr").hide();
            }
        });
    </script>

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

    <script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

        $('#formId').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>


</body>

</html>