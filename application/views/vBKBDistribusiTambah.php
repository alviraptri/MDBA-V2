<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BKB DISTRIBUSI</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/app.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->

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
                            <h3>BKB DISTRIBUSI</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">BKB Distribusi</li>
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
                                            

                                                <form role="form" id="formId" action="<?php echo base_url('inventDist/simpanBKB'); ?>" method="POST" class="login-box" enctype="multipart/form-data">
                                                    
                                                        <!-- detail btb -->
                                                            <?php
                                                            foreach ($data as $value) {
                                                                $pb = $value->szDocId;
                                                                $tgl = $value->dtmDoc;
                                                                $pengemudi = $value->szEmployeeId;
                                                                $pengemudiNama = $value->pengemudi;
                                                                $kendaraan = $value->szVehicleId;
                                                                $kendaraanNama = $value->kendaraan;
                                                                $gudang = $value->szWarehouseId;
                                                                $gudangNama = $value->gudang;
                                                                $stok = $value->szStockType;
                                                                $stokNama = $value->tipe;
                                                                $produk = $value->szProductId;
                                                                $produkNama = $value->produk;
                                                                $qty = $value->decQty;
                                                                $satuan = $value->szUomId;
                                                            }
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-4 col-12">
                                                                    <div class="form-group">
                                                                        <label for="first-name-column">No. Dokumen</label>
                                                                        <input type="text" id="idBKB" class="form-control" name="bkb" readonly value="<?= $id; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 col-12">
                                                                    <div class="form-group">
                                                                        <label for="first-name-column">No. PB</label>
                                                                        <input type="text" id="idPB" class="form-control" name="pb" readonly value="<?= $pb; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 col-12">
                                                                    <div class="form-group">
                                                                        <label for="last-name-column">Tanggal</label>
                                                                        <input type="date" id="idTgl" class="form-control" name="tgl" value="<?= date('Y-m-d'); ?>" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="city-column">Pengemudi</label>
                                                                        <div class="row">
                                                                            <div class="col-12" style="padding-right: 0">
                                                                                <select class="js-example-basic-single col-md-6 form-select" name="pengemudi" id="idPengemudi">
                                                                                    <option value="-" disabled>Pilih Pengemudi</option>
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach ($employee as $value) {
                                                                                        if ($pengemudi == $value->szId) { ?>
                                                                                            <option value="<?= $value->szId; ?>" selected><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                                                        <?php
                                                                                        } else {
                                                                                        ?>
                                                                                            <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                                                    <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                            <!-- <div class="col-8" style="padding-left: 0;">
                                                                                <input type="text" id="namaPengemudi" class="form-control" name="pengemudiNama" readonly value="<?= $pengemudiNama ?>">
                                                                            </div> -->
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="city-column">Kendaraan</label>
                                                                        <div class="row">
                                                                            <div class="col-12" style="padding-right: 0">
                                                                                <select class="js-example-basic-single col-md-6 form-select" name="kendaraan" id="idKendaraan">
                                                                                    <option value="-" disabled>Pilih Kendaraan</option>
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    foreach ($vehicle as $value) {
                                                                                        if ($kendaraan == $value->szPoliceNo) { ?>
                                                                                            <option value="<?= $value->szId; ?>" selected><?= $value->szId; ?> - <?= $value->szPoliceNo; ?></option>
                                                                                        <?php
                                                                                        } else {
                                                                                        ?>
                                                                                            <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szPoliceNo; ?></option>
                                                                                    <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                            <!-- <div class="col-8" style="padding-left: 0;">
                                                                                <input type="text" id="namaKendaraan" class="form-control" name="kendaraanNama" readonly value="<?= $kendaraanNama ?>">
                                                                            </div> -->
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="city-column">Gudang</label>
                                                                        <select class="js-example-basic-single col-md-6 form-select" name="gudang" id="idGudang">
                                                                            <option value="-" disabled>Pilih Gudang</option>
                                                                            <?php
                                                                            foreach ($warehouse as $value) { ?>
                                                                                <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="city-column">Tipe Stok</label>
                                                                        <select class="js-example-basic-single col-md-6 form-select" name="stok" id="idStok">
                                                                            <option value="-" disabled>Pilih Tipe Stok</option>
                                                                            <?php
                                                                            foreach ($type as $value) { ?>
                                                                                <option value="<?= $value->szId; ?>"><?= $value->szId . " - " . $value->szName; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12 col-12">
                                                                    <div class="form-group">
                                                                        <label for="city-column">Keterangan</label>
                                                                        <textarea name="keterangan" class="form-control" id="keteranganId" cols="20" rows="5"></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12 col-12">
                                                                    <table class='table table-striped'>
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No.</th>
                                                                                <!-- <th>Kode Produk</th> -->
                                                                                <th>Produk</th>
                                                                                <th>Qty</th>
                                                                                <th>Satuan</th>
                                                                                <!-- <th>Aksi</th> -->
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="table_body" class="view-this">
                                                                            <?php
                                                                            $no = 0;
                                                                            foreach ($data as $prod) { ?>
                                                                                <tr id="baris<?= $no; ?>">
                                                                                    <td><?= $no + 1; ?></td>
                                                                                    <td>
                                                                                        <select class="js-example-basic-single form-select" name="kode[]" id="idKode<?= $no; ?>" required onchange="getFormProduk(<?= $no; ?>)">
                                                                                            <option value="-" disabled>Pilih Produk</option>
                                                                                            <?php
                                                                                            foreach ($product as $value) {
                                                                                                if ($prod->szProductId == $value->szId) { ?>
                                                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szId; ?> - <?= $value->szName;?></option>
                                                                                                <?php
                                                                                                } else {
                                                                                                ?>
                                                                                                    <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName;?></option>
                                                                                            <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </td>
                                                                                    <!-- <td>
                                                                                        <input name="produk[<?= $no; ?>]" type="text" id="idProduk<?= $no; ?>" value="<?= $prod->produk; ?>" class="form-control" readonly>
                                                                                    </td> -->
                                                                                    <td>
                                                                                        <input name="qty[]" type="text" id="idQty<?= $no; ?>" value="<?= (int)$prod->decQty; ?>" class="form-control" onkeypress="return hanyaAngka(event)" required>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input name="satuan[]" type="text" id="idSatuan<?= $no; ?>" value="<?= $prod->szUomId; ?>" class="form-control" readonly>
                                                                                    </td>
                                                                                    <!-- <td>
                                                                                        <a class="btn btn-danger" onclick="deleteRow(<?= $no; ?>)" style="color: white;">-</a>
                                                                                    </td> -->
                                                                                </tr>
                                                                            <?php
                                                                                $no++;
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                                <!-- <div class="col-md-6 col-12" id="addRow">
                                                                    <button type="button" onclick="loadnew(<?= $no; ?>)" id="btn-tambah-form" class="btn btn-primary">+</button>
                                                                </div> -->
                                                            </div>


                                                        <!-- summary -->
                                                            <div class="row">
                                                                <div class="col-3"></div>
                                                                <div class="col-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-12 col-form-label" for="noPo" style="font-size: 22px; font-weight: bold; text-align: center;">Mohon untuk Input No. DO</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3"></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 col-12">
                                                                    <div class="form-group">
                                                                        <label for="first-name-column"></label>
                                                                        <div class="no-do">
                                                                            <div class="row" id="rowcol0">
                                                                                <div class="col-2" style="padding-left: 130px;">
                                                                                    <!-- <button type="button" onclick="delRow(0)" id="btn-tambah-form" class="btn btn-danger">-</button> -->
                                                                                </div>

                                                                                <div class="col-3">
                                                                                    <select class="js-example-basic-single form-select" name="do[]" id="idDO0" required onchange="getFormDO(0)">
                                                                                        <option value="-" disabled>Pilih DO</option>
                                                                                        <option value=""></option>
                                                                                        <?php
                                                                                        foreach ($do as $value) { ?>
                                                                                            <option value="<?= $value->szDocId; ?>"><?= $value->szDocId; ?></option>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="col-5">
                                                                                    <input type="text" id="namaDO0" class="form-control" name="doNama[]" readonly>
                                                                                </div>

                                                                                <div class="col-2">
                                                                                    <button type="button" onclick="addRow(0)" id="btn-tambah-form" class="btn btn-primary">+</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <div class="clearfix"></div>
                                                                                        
                                                        <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <a href="<?php echo base_url('home/bkbDist') ?>">
                                                        <button type="button" class="btn btn-white me-1 mb-1">Cancel</button>
                                                    </a>
                                                </div>

                                                </form>
                                            
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
        function getFormPengemudi() {
            var pengemudi = document.getElementById('idPengemudi').value;
            // alert(pengemudi);

            $.ajax({
                url: "<?= base_url('inventDist/getPengemudi') ?>",
                method: "POST",
                data: {
                    pengemudi: pengemudi
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('namaPengemudi').value = row.szName;
                    }
                }
            })
        }

        function getFormKendaraan() {
            var kendaraan = document.getElementById('idKendaraan').value;

            $.ajax({
                url: "<?= base_url('inventDist/getKendaraan') ?>",
                method: "POST",
                data: {
                    kendaraan: kendaraan
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('namaKendaraan').value = row.szPoliceNo;
                    }
                }
            })
        }

        function getFormProduk(x) {
            var produk = document.getElementById('idKode' + x).value;

            $.ajax({
                url: "<?= base_url('inventDist/getProduk') ?>",
                method: "POST",
                data: {
                    produk: produk
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        // document.getElementById('idProduk' + x).value = row.szName;
                        document.getElementById('idSatuan' + x).value = row.szUomId;
                    }
                }
            })
        }

        function getFormDO(x) {
            var nodo = document.getElementById('idDO' + x).value;

            $.ajax({
                url: "<?= base_url('inventDist/getNamaPelanggan') ?>",
                method: "POST",
                data: {
                    nodo: nodo
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('namaDO' + x).value = row.szName;
                    }
                }
            })
        }
    </script>

    <script type="text/javascript">
        var num = <?= $no; ?> + 1;
        var counter = 0;

        function loadnew(e) {
            var count = counter + e;
            var newrow = $(".view-this");
            var cols = "";
            cols += '<tr id="baris' + count + '">';
            cols += '<td>' + num + '<input type="hidden" id="counter" value="' + count + '"></td>';
            cols += '<td>';
            cols += '<select class="js-example-basic-single form-select" name="kode[' + count + ']" id="idKode' + count + '" required onchange="getFormProduk(' + count + ')">';
            cols += '<option value="-" disabled>Pilih Produk</option>';
            cols += '<option value=""></option>';
            cols += '<?php foreach ($product as $value) { ?>';
            cols += '<option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>';
            cols += '<?php } ?>';
            cols += '</select>';
            cols += '</td>';
            // cols += '<td>';
            // cols += '<input name="produk[' + count + ']" type="text" id="idProduk' + count + '" class="form-control" readonly>';
            // cols += '</td>';
            cols += '<td>';
            cols += '<input name="qty[' + count + ']" type="text" id="idQty' + count + '" class="form-control" onkeypress="return hanyaAngka(event)" required>';
            cols += '</td>';
            cols += '<td>';
            cols += '<input name="satuan[' + count + ']" type="text" id="idSatuan' + count + '" class="form-control" readonly>';
            cols += '</td>';
            cols += '<td>';
            cols += '<a class="btn btn-danger" onclick="deleteRow(' + count + ')" style="color: white;">-</a>';
            cols += '</td>';
            cols += '</tr>';
            newrow.append(cols);
            $("row").append(newrow);
            $(".js-example-basic-single").select2();
            num++;
            count++;
            document.getElementById("counter").value = count;
        }

        function deleteRow(row) {
            var a = document.getElementById("baris" + row);
            a.parentNode.removeChild(a);
        }
    </script>

    <script>
        var row = 1;

        function addRow(e) {
            var count = row + e;
            var newrow = $(".no-do");
            var cols = "";
            cols += '<div class="row" id="rowcol' + count + '" style="padding-top: 10px;">'
            cols += '<div class="col-2" style="padding-left: 130px;">';
            cols += '<button type="button" onclick="delRow(' + count + ')" id="btn-tambah-form" class="btn btn-danger">-</button>';
            cols += '</div>';
            cols += '<div class="col-3">';
            cols += '<select class="js-example-basic-single form-select" name="do[' + count + ']" id="idDO' + count + '" required onchange="getFormDO(' + count + ')">';
            cols += '<option value="-">Pilih DO</option>';
            cols += '<?php foreach ($do as $value) { ?>';
            cols += '<option value="<?= $value->szDocId; ?>"><?= $value->szDocId; ?></option>';
            cols += '<?php } ?>';
            cols += '</select>';
            cols += '</div>';
            cols += '<div class="col-5">';
            cols += '<input type="text" id="namaDO' + count + '" class="form-control" name="doNama[' + count + ']" readonly>';
            cols += '</div>';
            cols += '<div class="col-2">';
            cols += '<button type="button" onclick="addRow(' + count + ')" id="btn-tambah-form" class="btn btn-primary">+</button>';
            cols += '</div>';
            cols += '</div>';
            newrow.append(cols);
            $("row").append(newrow);
            $(".js-example-basic-single").select2();
            num++;
            count++;
            document.getElementById("counter").value = count;
        }

        function delRow(row) {
            var a = document.getElementById("rowcol" + row);
            a.parentNode.removeChild(a);
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

    <script src="<?php echo base_url(); ?>assets/index/js/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/app.js"></script>

    <script src="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/vendors.js"></script>

    <script src="<?php echo base_url(); ?>assets/index/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/wizard/js/jquery.steps.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/wizard/js/bd-wizard.js"></script> -->


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