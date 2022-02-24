<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BTB DISTRIBUSI </title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/app.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    <?php } else if ($this->session->flashdata('info')) { ?>
        <script>
            Swal.fire({
                type: 'info',
                title: 'Data Berhasil Tersimpan',
                text: 'Apakah ingin menambahkan BTB?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.value == true) {
                    $.ajax({
                        success: function() {
                            location.href = "<?= base_url('inventDist/manualBtb'); ?>"
                        }
                    });
                } else {
                    $.ajax({
                        success: function() {
                            location.href = "<?= base_url('inventDist/btbDistribusiHistory'); ?>"
                        }
                    });
                }
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
                            <h3>BTB DISTRIBUTOR</h3>
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

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit BTB Distribusi</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <?php
                                        foreach ($data as $value) {
                                            $warehouseId = $value->szWarehouseId;
                                            $warehouseName = $value->warehouseName;
                                            $tipeId = $value->szStockType;
                                            $tipeName = $value->stockTypeName;
                                            $kendaraanNopol = $value->szVehicleId;
                                            $kendaraanDriver = $value->szEmployeeId;
                                            $deskripsi = $value->szDescription;
                                            $btbOld = $value->szDocId;
                                            $tanggal = $value->dtmDoc;
                                            $bkbOld = $value->refOld;
                                        }
                                        ?>
                                        <form class="form" id="formId" action="<?php echo base_url('inventDist/updateBtb'); ?>" method="POST">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">No. BTB Lama</label>
                                                        <input type="text" id="noDoc" class="form-control" name="btbOld" readonly value="<?= $btbOld; ?>">
                                                        <input type="hidden" id="noDoc" class="form-control" name="bkbOld" readonly value="<?= $bkbOld; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">No. BTB Pembatal</label>
                                                        <input type="text" id="noDoc" class="form-control" name="btbCancel" readonly value="<?= $btb; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">No. Adjustment</label>
                                                        <input type="text" id="noAdjustment" class="form-control" name="adjNo" readonly value="<?= $adjustment; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Tanggal</label>
                                                        <input type="text" id="idTgl" class="form-control" name="tgl" value="<?= $tanggal; ?>" required readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Gudang</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="gudang" id="idGudang">
                                                            <!-- <option value="<?= $warehouseId; ?>" selected><?= $warehouseName; ?></option> -->
                                                            <option value="-" disabled>Pilih Gudang</option>
                                                            <?php
                                                            foreach ($gudang as $value) {
                                                                if ($warehouseId == $value->szId) {
                                                            ?>
                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" id="idGdgAdj" class="form-control" name="adjGdg" readonly value="<?= $warehouseId; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Tipe Stok</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="stok" id="idStok">
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
                                                        <input type="hidden" id="idStokAdj" class="form-control" name="adjStok" readonly value="<?= $tipeId; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Pengemudi</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="pengemudi" id="pengemudi">
                                                            <option value="-" disabled>Pilih Pengemudi</option>
                                                            <?php
                                                            foreach ($pengemudi as $value) {
                                                                if ($kendaraanDriver == $value->szId) {
                                                            ?>
                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" id="idPengemudiAdj" class="form-control" name="adjPengemudi" readonly value="<?= $kendaraanDriver; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Kendaraan</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="kendaraan" id="kendaraan">
                                                            <option value="-" disabled>Pilih Kendaraan</option>
                                                            <?php
                                                            foreach ($kendaraan as $value) {
                                                                if ($kendaraanNopol == $value->szId) {
                                                            ?>
                                                                    <option value="<?= $value->szPoliceNo; ?>" selected><?= $value->szId; ?> - <?= $value->szPoliceNo; ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value="<?= $value->szPoliceNo; ?>"><?= $value->szId; ?> - <?= $value->szPoliceNo; ?></option>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" id="idKendaraanAdj" class="form-control" name="adjKendaraan" readonly value="<?= $kendaraanNopol; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Keterangan</label>
                                                        <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $deskripsi; ?>" required autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped'>
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Produk</th>
                                                                <th>Qty</th>
                                                                <th>Satuan</th>
                                                                <!-- <th>Aksi</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body" class="view-this">
                                                            <?php
                                                            $no = 0;
                                                            $row = count($data);
                                                            $num = 1;
                                                            foreach ($data as $prod) {
                                                            ?>
                                                                <tr id="baris<?= $no; ?>">
                                                                    <td><?= $num; ?><input type="hidden" id="counter" value="<?= $no; ?>"><input name="num[]" type="hidden" value="<?= $no; ?>"></td>
                                                                    <td style="width: 30em;">
                                                                        <select class="js-example-basic-single form-select" style="width: 100%" name="produk[]" id="idProduk<?= $no; ?>" required onchange="getFormProduk(<?= $no; ?>)">
                                                                            <option value="-" disabled>Pilih Produk</option>
                                                                            <option value=""></option>
                                                                            <?php
                                                                            foreach ($produk as $value) {
                                                                                if ($prod->szProductId == $value->szId) { ?>
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
                                                                        <input type="hidden" id="idProdukAdj" class="form-control" name="adjProduk[]" readonly value="<?= $prod->szProductId; ?>" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input name="qty[]" type="text" id="idQty<?= $no; ?>" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off" required onchange="getInfo(<?= $no; ?>)" value="<?= (int)$prod->decQty; ?>" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input name="satuan[]" type="text" id="idSatuan<?= $no; ?>" class="form-control" readonly required value="<?= $prod->szUomId; ?>">
                                                                    </td>
                                                                    <!-- <td>
                                                                        <?php
                                                                        if ($no == '0') {
                                                                        ?>
                                                                            <a class="btn btn-danger" style="color: white;" disabled>-</a>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <a class="btn btn-danger" onclick="deleteRow(<?= $no; ?>)" style="color: white;">-</a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td> -->
                                                                </tr>
                                                            <?php
                                                                $no++;
                                                                $num++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- <div class="col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-xl-9 m-b-30"></div>
                                                        <div class="col-sm-12 col-xl-4 m-b-30">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <button type="button" class="btn btn-info me-1 mb-1" onclick="loadnew(<?= $no; ?>)" id="btn-tambah-form">Add Row (+)</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <a href="<?php echo base_url('inventDist/historyBkb') ?>">
                                                        <button type="button" class="btn btn-white me-1 mb-1">Cancel</button>
                                                    </a>
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
        for (i = 0; i < <?= $no; ?>; i++) {
            $("#notif" + i).hide();
        }

        function getInfo(x) {
            var qty = parseInt(document.getElementById('idQty' + x).value);
            var onHand = parseInt(document.getElementById('idOnHand' + x).value);

            if (onHand < qty) {
                alert('Stok Tidak Ada');
                $("#notif" + x).show();
            } else {
                $("#notif" + x).hide();
            }
        }

        function getFormProduk(x) {
            var produk = document.getElementById('idProduk' + x).value;
            var stok = document.getElementById('idStok').value;
            var gudang = document.getElementById('idGudang').value;

            $.ajax({
                url: "<?= base_url('inventDist/getProduk') ?>",
                method: "POST",
                data: {
                    produk: produk,
                    stok: stok,
                    gudang: gudang
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('idSatuan' + x).value = row.szUomId;
                        document.getElementById('idOnHand' + x).value = row.decQtyOnHand;
                    }
                }
            })
        }
    </script>

    <script type="text/javascript">
        var counter = 0;
        var num = 2;
        var count = 0;

        function loadnew(e) {
            var count = counter + e;
            var newrow = $(".view-this");
            var cols = "";
            cols += '<tr id="baris' + count + '">';
            cols += '<td>' + (count + 1) + '<input name="num[' + count + ']" type="hidden" value="' + count + '"></td>';
            cols += '<td>';
            cols += '<select class="js-example-basic-single form-select" name="produk[]" id="idProduk' + count + '" required onchange="getFormProduk(' + count + ')">';
            cols += '<option value="-" disabled>Pilih Produk</option>';
            cols += '<option value="-"></option>';
            cols += '<?php foreach ($produk as $value) { ?>';
            cols += '<option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>';
            cols += '<?php } ?>';
            cols += '</select>';
            cols += '</td>';
            cols += '<td>';
            cols += '<input name="qty[]" type="text" id="idQty' + count + '" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off" required onchange="getInfo(' + count + ')">';
            cols += '<input name="onHand[' + count + ']" type="hidden" id="idOnHand' + count + '" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off">';
            cols += '<label id="notif' + count + '" style="color: red;">*Qty Lebih Besar dari Stok</label>';
            cols += '</td>';
            cols += '<td>';
            cols += '<input name="satuan[]" type="text" id="idSatuan' + count + '" class="form-control" readonly>';
            cols += '</td>';
            cols += '<td>';
            cols += '<a class="btn btn-danger" onclick="deleteRow(' + count + ')" style="color: white;">-</a>';
            cols += '</td>';
            cols += '</tr>';
            newrow.append(cols);
            $("row").append(newrow);
            $(".js-example-basic-single").select2();
            $("#notif" + count).hide();
            num++;
            counter++;
            document.getElementById("counter").value = count;
        }

        function deleteRow(row) {
            counter -= 1;
            var a = document.getElementById("baris" + row);
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
    <script src="<?php echo base_url(); ?>assets/index/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/sweetalert2.min.js"></script>

    <!-- SELECT2 -->
    <script src="<?php echo base_url(); ?>assets/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Pilih"
            });

            $(".js-example-basic-single").prop("disabled", true);
        });
    </script>

    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            var $dp1 = $("#idTgl");
            $dp1.datepicker({
                changeYear: true,
                changeMonth: true,
                minDate: 0,
                maxDate: 0,
                dateFormat: "yy-mm-dd",
                yearRange: "-100:+20",
            });
        });
    </script>
</body>

</html>