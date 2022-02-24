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
                            <h3>BTB DEPOT</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('home'); ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="<?php echo base_url('home/btbDepot'); ?>">BTB Depot</a>
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
                                    <h4 class="card-title">Tambah BTB Depot</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="formId" action="<?php echo base_url('inventDepot/simpanBtb'); ?>" method="POST">
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. BTB</label>
                                                        <input type="text" id="idBtb" class="form-control" name="btb" readonly value="<?= $id; ?>">
                                                        <input type="hidden" id="idBkb" class="form-control" name="bkb" readonly value="-">
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Status</label>
                                                        <input type="text" id="idStatus" class="form-control" name="status" readonly value="<?= $status; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Tanggal</label>
                                                        <input type="date" id="idTgl" class="form-control" name="tgl" value="<?= date('Y-m-d'); ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Depo Asal</label>
                                                        <div class="row">
                                                            <div class="col-3" style="padding-right: 0">
                                                                <select class="js-example-basic-single col-md-2 form-select" name="asal" id="idAsal" onchange="getFormDepoAsal()">
                                                                    <option value="-" disabled>Pilih Depo</option>
                                                                    <option value=""></option>
                                                                    <?php
                                                                    foreach ($branch as $value) { ?>
                                                                        <option value="<?= $value->szId; ?>"><?= $value->szId; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-9" style="padding-left: 0;">
                                                                <input type="text" id="namaAsal" class="form-control" name="namaAsal" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Gudang</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" id="idGudang" name="gudang">
                                                            <option value="-" disabled>Pilih Gudang</option>
                                                            <?php
                                                            foreach ($warehouse as $value) { ?>
                                                                <option value="<?= $value->szId; ?>" selected><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Tipe Stok</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" id="idStok" name="stok">
                                                            <option value="-" disabled>Pilih Tipe Stok</option>
                                                            <?php
                                                            foreach ($stock as $value) {
                                                                if ($value->szId == 'JUAL') { ?>
                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szId . " - " . $value->szName; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $value->szId; ?>"><?= $value->szId . " - " . $value->szName; ?></option>

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
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Kendaraan</label>
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
                                                                    <select class="js-example-basic-single form-select" name="kode[]" id="idKode0" required onchange="getFormProduk(0)">
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
                                                    <a href="<?php echo base_url('home/btbDepot') ?>">
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
    <script type="text/javascript">
        function getFormDepoAsal() {
            var id = document.getElementById('idAsal').value;

            $.ajax({
                url: "<?= base_url('inventDepot/getBranchName') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('namaAsal').value = row.szName;
                    }
                }
            })

            $.ajax({
                url: "<?= base_url('inventDepot/getVehicle') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    console.log(data)
                    var content = document.getElementById("idKendaraan");
                    content.innerHTML = "";

                    var template = (row) => `  
                        <option value=""><option>
                        <option value="${row.szId}">${row.szPoliceNo}</option>
                    `

                    for (var row of data) {
                        var element = template(row);
                        content.insertAdjacentHTML('beforeend', element);
                    }
                }
            });

            $.ajax({
                url: "<?= base_url('inventDepot/getEmployee') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    console.log(data)
                    var content = document.getElementById("idPengemudi");
                    content.innerHTML = "";

                    var template = (row) => ` 
                        <option value=""><option> 
                        <option value="${row.szId}">${row.szId}</option>
                    `

                    for (var row of data) {
                        var element = template(row);
                        content.insertAdjacentHTML('beforeend', element);
                    }
                }
            });
        }

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
                    for (var row of data) {
                        document.getElementById('pengemudiNama').value = row.szName;
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
                    for (var row of data) {
                        document.getElementById('kendaraanNama').value = row.szPoliceNo;
                    }
                }
            })
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
            count = counter + e;
            console.log(counter);
            var newrow = $(".view-this");
            var cols = "";
            cols += "<tr id='baris" + count + "'>";
            cols += "<td>" + (count + 1) + "</td>";
            cols += "<td>";
            cols += "<select class='js-example-basic-single form-select' name='kode[" + count + "]' id='idKode" + count + "' required onchange='getFormProduk(" + count + ")'>";
            cols += "<option value='-' disabled>Pilih Produk</option>";
            cols += "<option value=''></option>";
            cols += "<?php foreach ($product as $value) { ?>";
            cols += "<option value='<?= $value->szId; ?>'><?= $value->szId; ?> - <?= $value->szName; ?></option>";
            cols += "<?php } ?>";
            cols += "</select>";
            cols += "</td>";
            cols += "<td>";
            cols += "<input name='qty[" + count + "]' type='text' id='idQty" + count + "' class='form-control' onkeypress='return hanyaAngka(event)' autocomplete='off' required>";
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