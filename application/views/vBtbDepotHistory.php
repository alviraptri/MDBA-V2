<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BTB DEPOT HISTORY</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/app.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/favicon.ico" type="image/x-icon">

    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--===============================================================================================-->

</head>

<body>
    <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/jquery/bootstrap.min.js"></script> -->
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
                            <h3>BTB Depot History</h3>
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
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="<?php echo base_url('home/btbDepot') ?>">
                                        <button type="submit" class="btn btn-success">Back</button>
                                    </a>
                                    <button type="submit" class="btn btn-warning" onClick="refresh(this)">Refresh</button>
                                </div>
                                <div class="col-md-6" style="float: right;">
                                    <form action="<?php echo base_url('inventDepot/tglHistoryBtb') ?>" method="post">
                                        <div class="input-group">
                                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Dokumen</th>
                                        <th>No. Referensi</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $value) { ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $value->szDocId; ?></td>
                                            <td><?= $value->refOld; ?></td>
                                            <td><?= date('Y-m-d', strtotime($value->dtmDoc)); ?></td>
                                            <td>
                                                <input type="hidden" name="b" id="b<?= $no; ?>" value="<?= $value->szDocId; ?>">
                                                <button type="button" class="btn btn-adjust" onclick="adjustment(document.getElementById('<?= $no; ?>').value)">
                                                    Ajust
                                                </button>
                                                <a href="<?php echo base_url('inventCetak/btbDepot/' . $value->szDocId); ?>" target="_blank">
                                                    <button type="button" class="btn icon btn-success">
                                                        Print
                                                    </button>
                                                </a>
                                                <input type="hidden" name="a" id="<?= $no; ?>" value="<?= $value->szDocId; ?>">
                                                <button type="button" class="btn btn-primary" onclick="detail(document.getElementById('<?= $no; ?>').value)">
                                                    Detail
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

    <!-- full size modal-->
    <div class="modal fade text-left w-100" id="full-scrn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel20">Detail BTB Depot</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">No. Dokumen (BTB)</label>
                                <input type="text" id="idBtb" class="form-control" name="noBkb" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="last-name-column">No. Bkb</label>
                                <input type="text" id="idBkb" class="form-control" name="noRef" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="last-name-column">Tanggal</label>
                                <input type="text" id="idTanggal" class="form-control" name="tanggal" readonly>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label for="last-name-column">Depo Asal</label>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 0">
                                        <input type="text" id="idAsal" class="form-control" name="asal" readonly>
                                    </div>
                                    <div class="col-8" style="padding-left: 0;">
                                        <input type="text" id="namaAsal" class="form-control" name="asalNama" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="company-column">Gudang</label>
                                <input type="text" id="idGudang" class="form-control" name="gudang" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email-id-column">Tipe Stok</label>
                                <input type="text" id="idStok" class="form-control" name="tipeStok" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="city-column">Pengemudi</label>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 0">
                                        <input type="text" id="idPengemudi" class="form-control" name="pengemudi" readonly>
                                    </div>
                                    <div class="col-8" style="padding-left: 0;">
                                        <input type="text" id="namaPengemudi" class="form-control" name="namaPengemudi" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="city-column">Kendaraan</label>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 0">
                                        <input type="text" id="idKendaraan" class="form-control" name="kendaraan" readonly>
                                    </div>
                                    <div class="col-8" style="padding-left: 0;">
                                        <input type="text" id="namaKendaraan" class="form-control" name="namaKendaraan" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="city-column">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="idKeterangan" cols="20" rows="3" readonly></textarea>
                            </div>
                        </div>
                    </div>


                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Produk</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- adjustment-->
    <div class="modal fade text-left w-100" id="full-scrn-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel20">Adjustment BTB Depot</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="first-name-column">No. BTB Lama</label>
                                <input type="text" id="idBtbOld" class="form-control" name="btbOld" readonly>
                                <input type="text" id="idBkbOld" class="form-control" name="bkbOld" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="last-name-column">No. BTB Pembatal</label>
                                <input type="text" id="idBtbCancel" class="form-control" name="btbCancel" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="last-name-column">No. Adjustment</label>
                                <input type="text" id="idAdjustment" class="form-control" name="adjNo" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="last-name-column">Tanggal</label>
                                <input type="text" id="idAdjTgl" class="form-control" name="adjTgl" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="last-name-column">Gudang</label>
                                <input type="text" id="idGdgAdj" class="form-control" name="adjGdg" readonly>
                                <input type="text" id="idAdjGdg" class="form-control" name="adjGudang" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="company-column">Tipe Stok</label>
                                <input type="text" id="idTipe" class="form-control" name="adjTipe" readonly>
                                <input type="text" id="idStok" class="form-control" name="adjStok" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email-id-column">Tipe Stok</label>
                                <input type="text" id="idStok" class="form-control" name="tipeStok" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="city-column">Pengemudi</label>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 0">
                                        <input type="text" id="idPengemudi" class="form-control" name="pengemudi" readonly>
                                    </div>
                                    <div class="col-8" style="padding-left: 0;">
                                        <input type="text" id="namaPengemudi" class="form-control" name="namaPengemudi" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="city-column">Kendaraan</label>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 0">
                                        <input type="text" id="idKendaraan" class="form-control" name="kendaraan" readonly>
                                    </div>
                                    <div class="col-8" style="padding-left: 0;">
                                        <input type="text" id="namaKendaraan" class="form-control" name="namaKendaraan" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="city-column">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="idKeterangan" cols="20" rows="3" readonly></textarea>
                            </div>
                        </div>
                    </div>


                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Produk</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js ?>"></script>
    <script>
        function detail(x) {
            var id = x;
            // alert(id);
            function data() {
                $.ajax({
                    url: "<?= base_url('inventDepot/detailBtb') ?>",
                    method: "POST",
                    data: {
                        'id': id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        for (var row of data) {
                            document.getElementById("idBtb").value = row.szDocId;
                            document.getElementById("idBkb").value = row.refOld;
                            document.getElementById("idTanggal").value = row.dtmDoc;
                            document.getElementById("idGudang").value = row.szWarehouseId + " - " + row.gudang;
                            document.getElementById("idStok").value = row.szStockType + " - " + row.stok;
                            document.getElementById("idKendaraan").value = row.szVehicleId;
                            document.getElementById("namaKendaraan").value = row.kendaraan;
                            document.getElementById("idPengemudi").value = row.szEmployeeId;
                            document.getElementById("namaPengemudi").value = row.pengemudi;
                            document.getElementById("idKeterangan").value = row.szDescription;
                            document.getElementById("idAsal").value = row.szPartyId;
                            if (row.depo != '') {
                                document.getElementById("namaAsal").value = row.depo;
                            } else {
                                document.getElementById("namaAsal").value = row.so;
                            }

                        }

                        var number = 1;
                        var html = '';
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + number + '</td>' +
                                '<td>' + data[i].szProductId + '</td>' +
                                '<td>' + data[i].product + '</td>' +
                                '<td>' + data[i].decQty + '</td>' +
                                '<td>' + data[i].szUomId + '</td>' +
                                '<tr>';
                            number++;
                        }
                        $('#table_body').html(html);
                    },
                });
            }
            data();
            // setInterval(function() {
            //     data();
            // }, 5000);
            $('#full-scrn').modal('show');
        }

        function adjustment(x) {
            var id = x;
            alert(id);
            function data() {
                $.ajax({
                    url: "<?= base_url('inventDepot/detailBtb') ?>",
                    method: "POST",
                    data: {
                        'id': id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        for (var row of data) {
                            document.getElementById("idBtb").value = row.szDocId;
                            document.getElementById("idBkb").value = row.refOld;
                            document.getElementById("idTanggal").value = row.dtmDoc;
                            document.getElementById("idGudang").value = row.szWarehouseId + " - " + row.gudang;
                            document.getElementById("idStok").value = row.szStockType + " - " + row.stok;
                            document.getElementById("idKendaraan").value = row.szVehicleId;
                            document.getElementById("namaKendaraan").value = row.kendaraan;
                            document.getElementById("idPengemudi").value = row.szEmployeeId;
                            document.getElementById("namaPengemudi").value = row.pengemudi;
                            document.getElementById("idKeterangan").value = row.szDescription;
                            document.getElementById("idAsal").value = row.szPartyId;
                            if (row.depo != '') {
                                document.getElementById("namaAsal").value = row.depo;
                            } else {
                                document.getElementById("namaAsal").value = row.so;
                            }

                        }

                        var number = 1;
                        var html = '';
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + number + '</td>' +
                                '<td>' + data[i].szProductId + '</td>' +
                                '<td>' + data[i].product + '</td>' +
                                '<td>' + data[i].decQty + '</td>' +
                                '<td>' + data[i].szUomId + '</td>' +
                                '<tr>';
                            number++;
                        }
                        $('#table_body').html(html);
                    },
                });
            }
            data();
            // setInterval(function() {
            //     data();
            // }, 5000);
            $('#full-scrn-1').modal('show');
        }
    </script>

    <script>
        function refresh() {
            window.location.reload("Refresh")
        }
    </script>
    <script src="<?php echo base_url(); ?>assets/index/js/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/app.js"></script>

    <script src="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/vendors.js"></script>

    <script src="<?php echo base_url(); ?>assets/index/js/main.js"></script>

</body>

</html>