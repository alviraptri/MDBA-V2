<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - PROSES SURAT TUGAS</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/style.css"> -->

    <link rel="stylesheet" href="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/datatables.bootstrap5.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/app.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/favicon.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datepicker/daterangepicker.css">

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

</head>

<body>
    <!-- <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/sweetalert2.min.js"></script> -->

    <div id="app">
        <?php include('sideBar.php'); ?>
        <div id="main">
            <?php include('navBar.php'); ?>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>PROSES SURAT TUGAS</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('home/prosesSuratTugas'); ?>">Proses Surat Tugas</a></li>
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
                                    <h4 class="card-title">Detail Proses Surat Tugas</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <?php
                                        foreach ($result as $key) {
                                            $szRouteType = $key->szRouteType;
                                            $szDocId = $key->szDocId;
                                            $szEmployeeId = $key->szEmployeeId;
                                            $empName = $key->empName;
                                            $szVehicleId = $key->szVehicleId;
                                            $szHelper1 = $key->szHelper1;
                                            $helpName1 = $key->helpName1;
                                            $szHelper2 = $key->szHelper2;
                                            $helpName2 = $key->helpName2;
                                            $szDocCallIdRef = $key->szDocCallIdRef;
                                            $dtmDoc = $key->dtmDoc;
                                        }

                                        if ($szRouteType == 'CAN') { ?>
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <label for="dokumen">No. Dokumen</label>
                                                    <input type="text" name="dokumen" id="dokumen" class="form-control" disabled value="<?= $szDocId; ?>">
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="text" name="tanggal" id="dokumen" class="form-control" disabled value="<?= $dtmDoc; ?>">
                                                </div>
                                                <div class="col-md-6 col-12" style="padding-top: 0.8em;">
                                                    <h2 style="font-weight: bold;">Informasi Kendaraan</h2>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label for="kunjungan">Jenis Kunjungan</label>
                                                    <input type="text" name="kunjungan" id="kunjungan" class="form-control" disabled value="<?= $szRouteType; ?>">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="kendaraan">Kendaraan</label>
                                                    <input type="text" name="kendaraan" id="kendaraan" class="form-control" disabled value="<?= $szRouteType; ?>">
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label for="salesman">Salesman</label>
                                                    <input type="text" name="salesman" id="salesman" class="form-control" disabled value="<?= $szEmployeeId; ?> - <?= $empName; ?>">
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <label for="Helper1">Helper 1</label>
                                                    <input type="text" name="helper1" id="helper1" class="form-control" disabled value="<?= $szHelper1; ?> - <?= $helpName1; ?>">
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <label for="Helper2">Helper 2</label>
                                                    <input type="text" name="helper2" id="helper2" class="form-control" disabled value="<?= $szHelper2; ?> - <?= $helpName2; ?>">
                                                </div>
                                            </div>
                                        <?php
                                        } elseif ($szRouteType == 'DEL') { ?>
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <label for="dokumen">No. Dokumen</label>
                                                    <input type="text" name="dokumen" id="dokumen" class="form-control" disabled value="<?= $szDocId; ?>">
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="text" name="tanggal" id="dokumen" class="form-control" disabled value="<?= $dtmDoc; ?>">
                                                </div>
                                                <div class="col-md-6 col-12" style="padding-top: 0.8em;">
                                                    <h2 style="font-weight: bold;">Informasi Kendaraan</h2>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <label for="kunjungan">Jenis Kunjungan</label>
                                                    <input type="text" name="kunjungan" id="kunjungan" class="form-control" disabled value="<?= $szRouteType; ?>">
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <label for="kunjungan">No. Surat Tugas</label>
                                                    <input type="text" name="suratTugas" id="suratTugas" class="form-control" disabled value="<?= $szDocCallIdRef; ?>">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="kendaraan">Kendaraan</label>
                                                    <input type="text" name="kendaraan" id="kendaraan" class="form-control" disabled value="<?= $szRouteType; ?>">
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label for="salesman">Salesman</label>
                                                    <input type="text" name="salesman" id="salesman" class="form-control" disabled value="<?= $szEmployeeId; ?> - <?= $empName; ?>">
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <label for="Helper1">Helper 1</label>
                                                    <input type="text" name="helper1" id="helper1" class="form-control" disabled value="<?= $szHelper1; ?> - <?= $helpName1; ?>">
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <label for="Helper2">Helper 2</label>
                                                    <input type="text" name="helper2" id="helper2" class="form-control" disabled value="<?= $szHelper2; ?> - <?= $helpName2; ?>">
                                                </div>
                                            </div>
                                        <?php
                                        } else { ?>
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <label for="dokumen">No. Dokumen</label>
                                                    <input type="text" name="dokumen" id="dokumen" class="form-control" disabled value="<?= $szDocId; ?>">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="text" name="tanggal" id="dokumen" class="form-control" disabled value="<?= $dtmDoc; ?>">
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label for="kunjungan">Jenis Kunjungan</label>
                                                    <input type="text" name="kunjungan" id="kunjungan" class="form-control" disabled value="<?= $szRouteType; ?>">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label for="salesman">Salesman</label>
                                                    <input type="text" name="salesman" id="salesman" class="form-control" disabled value="<?= $szEmployeeId; ?> - <?= $empName; ?>">
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        
                                        <br><br>

                                        <div class="row">
                                            <?php
                                            if ($szRouteType == 'DEL') { ?>
                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped' id="table1" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>No. SO</th>
                                                                <th>No. DO</th>
                                                                <th>Pelanggan</th>
                                                                <th>Detail SO</th>
                                                                <th>Qty</th>
                                                                <th>Luar Rute</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body" class="view-this">
                                                            <?php
                                                            $no = 1;
                                                            foreach ($result as $value) { ?>
                                                                <tr>
                                                                    <td><?= $no; ?></td>
                                                                    <td><?= $value->szDocSO; ?></td>
                                                                    <td><?= $value->szDocDO; ?></td>
                                                                    <td><?= $value->szCustomerId; ?> - <?= $value->custName; ?></td>
                                                                    <td><?= $value->szProductId; ?> - <?= $value->prodName; ?></td>
                                                                    <td><?= $value->decQty; ?></td>
                                                                    <td><input class="form-check-input" type="checkbox" value="" id="checkList" <?= ($value->bOutOfRoute == '1') ? "checked" : ""; ?> disabled ></td>
                                                                </tr>
                                                            <?php
                                                                $no++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php
                                            } elseif ($szRouteType == 'COL') { ?>
                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped' id="table2" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>No. Invoice</th>
                                                                <th>Pelanggan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body" class="view-this">
                                                            <?php
                                                            $no = 1;
                                                            foreach ($result as $value) { ?>
                                                                <tr>
                                                                    <td><?= $no; ?></td>
                                                                    <td><?= $value->szDocInvoice; ?></td>
                                                                    <td><?= $value->szCustomerId; ?> - <?= $value->custName; ?></td>
                                                                </tr>
                                                            <?php
                                                                $no++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php
                                            } elseif ($szRouteType == 'CAN') { ?>
                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped' id="table3" width="100%">
                                                        <!-- <table class='table table-striped'> -->
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>No. DO</th>
                                                                    <th>Pelanggan</th>
                                                                    <th>Luar Rute</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="table_body" class="view-this">
                                                                <?php
                                                                $no = 1;
                                                                foreach ($result as $value) { ?>
                                                                    <tr>
                                                                        <td><?= $no; ?></td>
                                                                        <td><?= $value->szDocDO; ?></td>
                                                                        <td><?= $value->szCustomerId; ?> - <?= $value->custName; ?></td>
                                                                        <td><input class="form-check-input" type="checkbox" value="" id="checkList" <?= ($value->bOutOfRoute == '1') ? "checked" : ""; ?> disabled ></td>
                                                                    </tr>
                                                                <?php
                                                                    $no++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                </div>
                                            <?php
                                            } else { ?>
                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped' id="table4" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>No. SO</th>
                                                                <th>Pelanggan</th>
                                                                <th>Luar Rute</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body" class="view-this">
                                                            <?php
                                                            $no = 1;
                                                            foreach ($result as $value) { ?>
                                                                <tr>
                                                                    <td><?= $no; ?></td>
                                                                    <td><?= $value->szDocSO; ?></td>
                                                                    <td><?= $value->szCustomerId; ?> - <?= $value->custName; ?></td>
                                                                    <td><input class="form-check-input" type="checkbox" value="" id="checkList" <?= ($value->bOutOfRoute == '1') ? "checked" : ""; ?> disabled ></td>
                                                                </tr>
                                                            <?php
                                                                $no++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="col-12 d-flex justify-content-end">
                                                <a href="<?php echo base_url('home/prosesSuratTugas') ?>">
                                                    <button type="button" class="btn btn-white me-1 mb-1">Back</button>
                                                </a>
                                            </div>
                                        </div>
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

</body>


    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js"></script>
    <script src="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/jquery.datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/datatables.bootstrap5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/app.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/datepicker/daterangepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/main.js"></script>
    <!-- SELECT2 -->
    <script src="<?php echo base_url(); ?>assets/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "responsive": true,
                "scrollCollapse": true,
                "scrollX": true
            })
        });

        // $(document).ready(function() {
        //     $('#table2').DataTable({
        //         "responsive": true,
        //         "scrollCollapse": true,
        //         "scrollX": true
        //     })
        // });

        // $(document).ready(function() {
        //     $('#table3').DataTable({
        //         "responsive": true,
        //         "scrollCollapse": true,
        //         "scrollX": true
        //     })
        // });

        // $(document).ready(function() {
        //     $('#table4').DataTable({
        //         "responsive": true,
        //         "scrollCollapse": true,
        //         "scrollX": true
        //     })
        // });
    </script>

</html>