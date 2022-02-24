<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BTB SUPPLIER</title>

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
                title: 'Produk Tidak Boleh Sama',
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
                            <h3>BTB SUPPLIER</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="<?php echo base_url('home/btbSupplier'); ?>">BTB Supplier</a>
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
                                    <h4 class="card-title">Tambah BTB Supplier</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="formId" action="<?php echo base_url('inventSupp/simpanBtbManual'); ?>" method="POST">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. BTB</label>
                                                        <input type="text" id="idBtb" class="form-control" name="btb" readonly value="<?= $id; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Tanggal</label>
                                                        <input type="date" id="idTgl" class="form-control" name="tgl" value="<?= date('Y-m-d'); ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Gudang</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="gudang" id="idGudang">
                                                            <option value="-" disabled>Pilih Gudang</option>
                                                            <?php
                                                            foreach ($warehouse as $value) {
                                                            ?>
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
                                                            foreach ($stock as $value) {
                                                                if ($value->szId == 'JUAL') {
                                                            ?>
                                                                <option value="<?= $value->szId; ?>" selected><?= $value->szId . " (" . $value->szName . ")"; ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Supplier</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="supplier" id="idSupplier">
                                                            <option value="-" disabled>Pilih Supplier</option>
                                                            <option value=""></option>
                                                            <?php
                                                            foreach ($supplier as $value) {
                                                            ?>
                                                                    <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                            <?php 
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Jasa Pengangkut</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="carrier" id="idCarrier">
                                                            <option value="-" disabled>Pilih Jasa Pengangkut</option>
                                                            <option value=""></option>
                                                            <?php
                                                            foreach ($carrier as $value) {
                                                            ?>
                                                                <option value="<?= $value->szId; ?>"><?= $value->szId . " - " . $value->szName; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Pengemudi</label>
                                                        <div class="row">
                                                            <div class="col-4" style="padding-right: 0">
                                                                <select class="js-example-basic-single col-md-6 form-select" name="pengemudi" id="idPengemudi" onchange="getFormPengemudi()">
                                                                    <option value="-" disabled>Pilih Pengemudi</option>
                                                                    <option value=""></option>
                                                                    <?php
                                                                    foreach ($employee as $value) { ?>
                                                                            <option value="<?= $value->szDriverName; ?>"><?= $value->szDriverName; ?></option>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                    <option value="MANUAL">MANUAL</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-8" style="padding-left: 0;" id="pengemudiId">
                                                                <input type="text" id="pengemudiNama" class="form-control" name="namaPengemudi" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Kendaraan</label>
                                                        <div class="row">
                                                            <div class="col-4" style="padding-right: 0">
                                                                <select class="js-example-basic-single col-md-6 form-select" name="kendaraan" id="idKendaraan" onchange="getFormKendaraan()">
                                                                    <option value="-" disabled>Pilih Kendaraan</option>
                                                                    <option value=""></option>
                                                                    <?php
                                                                    foreach ($vehicle as $value) { ?>
                                                                            <option value="<?= $value->szVehicleNo; ?>"><?= $value->szVehicleNo; ?></option>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                    <option value="MANUAL">MANUAL</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-8" style="padding-left: 0;" id="kendaraanId">
                                                                <input type="text" id="kendaraanNama" class="form-control" name="namaKendaraan" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. Surat Jalan</label>
                                                        <input type="text" id="idNoSj" class="form-control" name="noSj" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Tgl Surat Jalan</label>
                                                        <input type="date" id="idTglSj" class="form-control" name="tglSj" value="<?= date('Y-m-d')?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. Ref. 1</label>
                                                        <input type="text" id="idNoRef1" class="form-control" name="noRef1" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">No. Ref. 2</label>
                                                        <input type="text" id="idNoRef2" class="form-control" name="noRef2" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">No. Ref. 3</label>
                                                        <input type="text" id="idNoRef3" class="form-control" name="noRef3" value="" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Shift</label>
                                                        <input type="text" id="idShift" class="form-control" name="shift" value="0" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Jml. Kuli</label>
                                                        <input type="text" id="idKuli" class="form-control" name="kuli" value="0" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Keterangan</label>
                                                        <textarea name="keterangan" class="form-control" id="keterangan" cols="20" rows="5"></textarea>
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
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body" class="view-this">
                                                            <tr id="baris0">
                                                                <td>1 <input type="hidden" id="counter" value="0"></td>
                                                                <td>
                                                                    <select class="js-example-basic-single form-select" name="produk[]" id="idProduk0" onchange="getFormProduk(0)">
                                                                        <option value="-" disabled>Pilih Produk</option>
                                                                        <option value=""></option>
                                                                        <?php
                                                                        foreach ($product as $value) { ?>
                                                                            <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input name="qty[]" type="text" id="idQty0" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off" required>
                                                                    
                                                                </td>
                                                                <td>
                                                                    <input name="satuan[]" type="text" id="idSatuan0" class="form-control" readonly>
                                                                </td>
                                                                <td>
                                                                    <button type="button" onclick="loadnew(1)" id="btn-tambah-form" class="btn btn-primary">+</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <a href="<?php echo base_url('home/btbSupplier') ?>">
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

        function getFormPengemudi() {
            var pengemudi = document.getElementById('idPengemudi').value;

            $.ajax({
                url: "<?= base_url('inventDepot/getEmployeeName') ?>",
                method: "POST",
                data: {
                    pengemudi: pengemudi
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    if (pengemudi != 'MANUAL') {
                        var html = '<input type="text" id="pengemudiNama" class="form-control" name="namaPengemudi" readonly>';
                        $('#pengemudiId').html(html);
                    }
                    else{
                        var html = '<input type="text" id="pengemudiNama" class="form-control" name="namaPengemudi" required>';
                        $('#pengemudiId').html(html);
                    }
                }
            })
        }

        function getFormKendaraan() {
            var kendaraan = document.getElementById('idKendaraan').value;

            $.ajax({
                url: "<?= base_url('inventDepot/getVehicleName') ?>",
                method: "POST",
                data: {
                    kendaraan: kendaraan
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    if (kendaraan != 'MANUAL') {
                        var html = '<input type="text" id="kendaraanNama" class="form-control" name="namaKendaraan" readonly>';
                        $('#kendaraanId').html(html);
                    }
                    else{
                        var html = '<input type="text" id="kendaraanNama" class="form-control" name="namaKendaraan" required>';
                        $('#kendaraanId').html(html);
                    }
                }
            })
        }

        function getFormProduk(x) {
            var produk = document.getElementById('idProduk' + x).value;
            var stok = document.getElementById('idStok').value;
            var gudang = document.getElementById('idGudang').value;

            $.ajax({
                url: "<?= base_url('inventSupp/getProduk') ?>",
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
            cols += "<tr id='baris" + count + "'>";
            cols += "<td>" + (count + 1) + "</td>";
            cols += "<td>";
            cols += "<select class='js-example-basic-single form-select' name='produk[" + count + "]' id='idProduk" + count + "' required onchange='getFormProduk(" + count + ")'>";
            cols += "<option value='-' disabled>Pilih Produk</option>";
            cols += "<option value=''></option>";
            cols += "<?php foreach ($product as $value) { ?>";
            cols += "<option value='<?= $value->szId; ?>'><?= $value->szId; ?> - <?= $value->szName; ?></option>";
            cols += "<?php } ?>";
            cols += "</select>";
            cols += "</td>";
            cols += "<td>";
            cols += "<input name='qty[" + count + "]' type='text' id='idQty" + count + "' class='form-control' onkeypress='return hanyaAngka(event)' autocomplete='off' required onchange='getInfo(" + count + ")'>";
            cols += "</td>";
            cols += "<td>";
            cols += "<input name='satuan[" + count + "]' type='text' id='idSatuan" + count + "' class='form-control' readonly>";
            cols += "</td>";
            cols += "<td>";
            cols += "<a class='btn btn-danger' onclick='deleteRow(" + count + ")' style='color: white;'>-</a>";
            cols += "</td>";
            cols += "</tr>";
            newrow.append(cols);
            $("row").append(newrow);
            $(".js-example-basic-single").select2();
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
        });
    </script>
</body>

</html>