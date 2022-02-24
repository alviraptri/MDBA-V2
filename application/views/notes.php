<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BTB DEPOT</title>

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
    </style>

    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--===============================================================================================-->
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
                title: 'Varian Belum di Pilih',
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
                            <h3>BTB Depot</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">BTB Depot</li>
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
                                    <h4 class="card-title">Edit BTB Depot</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="<?php echo base_url('inventori/updateBtbDepot'); ?>" method="POST">
                                            <div class="row">
                                                <?php
                                                foreach ($a as $value) {
                                                    $warehouseId = $value->szWarehouseId;
                                                    $warehouseName = $value->gudang;
                                                    $tipeId = $value->idStok;
                                                    $tipeName = $value->stok;
                                                    $kendaraanNopol = $value->szVehicleId;
                                                    $kendaraanDriver = $value->szEmployeeId;
                                                    $deskripsi = $value->szDescription;
                                                    $bkb = $value->refOld;
                                                }
                                                ?>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. BTB</label>
                                                        <input type="text" id="noDoc" class="form-control" name="noDoc" readonly value="<?= $newSupp; ?>">
                                                        <input type="hidden" id="noBkb" class="form-control" name="noBkb" readonly value="<?= $bkb; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">No. Adjustment</label>
                                                        <input type="text" id="noDocOld" class="form-control" name="noDocOld" readonly value="<?= $document; ?>">
                                                        <input type="hidden" id="noAdjustment" class="form-control" name="noAdjustment" value="<?= $adjustment; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Tanggal</label>
                                                        <input type="date" id="tgl" class="form-control" name="tgl" value="<?= date('Y-m-d'); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Gudang</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="gudang" id="gudang">
                                                            <!-- <option value="<?= $warehouseId; ?>" selected><?= $warehouseName; ?></option> -->
                                                            <option value="-" disabled>Pilih Gudang</option>
                                                            <?php
                                                            foreach ($gudang as $value) {
                                                                if ($warehouseId == $value->szId) {
                                                            ?>
                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szName; ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value="<?= $value->szId; ?>"><?= $value->szName; ?></option>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Tipe Stok</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="stok" id="stok">
                                                            <option value="-" disabled>Pilih Tipe Stok</option>
                                                            <?php
                                                            foreach ($stok as $value) {
                                                                if ($tipeId == $value->szId) {
                                                            ?>
                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szId . " (" . $value->szName . ")"; ?></option>
                                                                <?php
                                                                } else { ?>
                                                                    <option value="<?= $value->szId; ?>"><?= $value->szId . " (" . $value->szName . ")"; ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Pengemudi</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="pengemudi" id="pengemudi">
                                                            <option value="-" disabled>Pilih Pengemudi</option>
                                                            <?php
                                                            foreach ($pengemudi as $value) {
                                                                if ($kendaraanDriver == $value->szId) {
                                                            ?>
                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szName; ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value="<?= $value->szId; ?>"><?= $value->szName; ?></option>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Kendaraan</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="kendaraan" id="kendaraan">
                                                            <option value="-" disabled>Pilih Kendaraan</option>
                                                            <?php
                                                            foreach ($kendaraan as $value) {
                                                                if ($kendaraanNopol == $value->szId) {
                                                            ?>
                                                                    <option value="<?= $value->szPoliceNo; ?>" selected><?= $value->szPoliceNo; ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value="<?= $value->szPoliceNo; ?>"><?= $value->szPoliceNo; ?></option>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped'>
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Produk</th>
                                                                <th>Qty</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body">
                                                            <?php
                                                            $no = 0;
                                                            foreach ($a as $prod) { ?>
                                                                <tr id="baris<?= $no; ?>">
                                                                    <td><?= $no + 1; ?></td>
                                                                    <td>
                                                                        <select class="js-example-basic-single form-select" name="produk[<?= $no; ?>]" id="produk<?= $no; ?>">
                                                                            <option value="-" disabled>Pilih Produk</option>
                                                                            <?php
                                                                            foreach ($produk as $value) {
                                                                                if ($prod->szProductId == $value->szId) { ?>
                                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szName; ?></option>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <option value="<?= $value->szId; ?>"><?= $value->szName; ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input id="userName-2a" name="qty[<?= $no; ?>]" type="text" id="qty<?= $no; ?>" value="<?= $prod->decQty; ?>" class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <button onclick="deleteRow(<?= $no; ?>)" class="btn btn-danger" disabled>
                                                                            Delete
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                                $no++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-xl-9 m-b-30"></div>
                                                        <div class="col-sm-12 col-xl-4 m-b-30">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <button type="button" class="btn btn-info me-1 mb-1" onclick="loadnew()" id="btn-tambah-form">Add Row (+)</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Keterangan</label>
                                                        <textarea name="keterangan" class="form-control" id="keterangan" cols="20" rows="5"><?= $deskripsi; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
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

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js"></script>
    <script>
        function removed(e) {
            $("#baris" + e).remove();
        }

        function addRow(e) {
            let f = e + 1;
            markup = "<tr id='baris" + f + "'><td>" + f + "</td><td><select class='js-example-basic-single form-select' name='produk[" + e + "]' id='produk" + e + "'><option value='-'>Pilih Produk</option><?php foreach ($produk as $value) { ?> <option value='<?= $value->szId; ?>'><?= $value->szName; ?></option> <?php } ?> </select> </td> <td> <input id='userName-2a' name='qty[" + e + "]' type='text' id='qty" + e + "' class='form-control'> </td> <td> <button onclick='removed(" + e + ")' class='btn btn-danger' > Delete </button> </td> </tr>";
            tableBody = $("#table_body");
            tableBody.append(markup);
            f++;
            $(".js-example-basic-single").select2();
        }
    </script>

    <script src="<?php echo base_url(); ?>assets/index/js/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/app.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/sweetalert2.min.js"></script>

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