<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - TUTUP BUKU GUDANG</title>

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
                            <h3>TUTUP BUKU GUDANG</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tutup Buku Gudang</li>
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
                                    <button type="submit" class="btn btn-warning" onClick="refresh(this)">Refresh</button>
                                    <a href="<?php echo base_url('inventTbg/manual') ?>">
                                        <button type="submit" class="btn btn-white">Input</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Document</th>
                                        <th>Tanggal</th>
                                        <th>Gudang</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($data != '0') {
                                        foreach ($data as $value) { ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $value->szDocId; ?></td>
                                                <td><?= date('Y-m-d', strtotime($value->dtmDoc)); ?></td>
                                                <td><?= $value->szName; ?></td>
                                                <td><?= $value->szDocStatus; ?></td>
                                                <td>
                                                <input type="hidden" name="a" id="<?= $no; ?>" value="<?= $value->szDocId; ?>">
                                                    <button type="button" class="btn btn-primary" onclick="detail(document.getElementById('<?= $no; ?>').value)">
                                                        Detail
                                                    </button>
                                                    <?php
                                                    if ($value->szDocStatus == 'Applied') { ?>
                                                        <a href="<?php echo base_url('inventTbg/unapplied/' . $value->szDocId); ?>">
                                                        <button type="button" class="btn icon btn-info">
                                                            Un-Applied
                                                        </button>
                                                    </a>
                                                    <?php
                                                    }
                                                    else{ ?>
                                                    <a href="<?php echo base_url('inventTbg/refresh/' . $value->szDocId); ?>" target="_blank">
                                                        <button type="button" class="btn icon btn-success">
                                                            Print
                                                        </button>
                                                    </a>
                                                    <?php 
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                            $no++;
                                        }
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
                    <h4 class="modal-title" id="myModalLabel20">Detail Surat Jalan Pelanggan</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">No. Dokumen (BKB)</label>
                                    <input type="text" id="idBkb" class="form-control" name="bkb" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Tanggal</label>
                                    <input type="text" id="idTanggal" class="form-control" name="tanggal" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">No. DO</label>
                                    <input type="text" id="idDo" class="form-control" name="do" readonly>
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
                                    <input type="text" id="idTipeStok" class="form-control" name="tipeStok" readonly>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Pelanggan</label>
                                    <input type="text" id="idPelanggan" class="form-control" name="pelanggan" readonly>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Ekspedisi</label>
                                    <input type="text" id="idEkspedisi" class="form-control" name="ekspedisi" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Kendaraan</label>
                                    <input type="text" id="idKendaraan" class="form-control" name="kendaraan" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="company-column">Pengemudi</label>
                                    <input type="text" id="idPengemudi" class="form-control" name="pengemudi" readonly>
                                </div>
                            </div>
                        </div>

                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                            </tbody>
                        </table>
                    </form>
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
                    url: "<?= base_url('inventSjp/detail') ?>",
                    method: "POST",
                    data: {
                        'id': id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        for (var row of data) {
                            document.getElementById("idNoBkb").value = id;
                            document.getElementById("idNoRef").value = row.refOld;
                            document.getElementById("idTanggal").value = row.dtmDoc;
                            document.getElementById("idGudang").value = row.gudang;
                            document.getElementById("idTipeStok").value = row.stok + " - " + row.szStockType;
                            document.getElementById("idKendaraan").value = row.szVehicleId;
                            document.getElementById("idPengemudi").value = row.pengemudi;
                        }

                        var number = 1;
                        var html = '';
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + number + '</td>' +
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