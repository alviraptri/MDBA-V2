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
                            <h3>BKB DISTRIBUSI</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('home/bkbDist'); ?>">BKB Distribusi</a></li>
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
                                    <a href="<?php echo base_url('inventDist/historyBkb') ?>">
                                        <button type="submit" class="btn btn-secondary">History</button>
                                    </a>
                                    <a href="<?php echo base_url('sndPb/manualPB') ?>">
                                        <button type="submit" class="btn btn-white">Permintaan Barang</button>
                                    </a>
                                </div>

                                <!-- <div class="col-md-6" float="left;">
                                    <a href="<?php echo base_url('sndPb/manualPB') ?>">
                                        <button type="submit" class="btn btn-primary"><b>Permintaan Barang</b></button>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Permintaan Barang</th>
                                        <th>Tanggal</th>
                                        <th>Pengendara</th>
                                        <th>Kendaraan</th>
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
                                            <td><?= $value->dtmDoc; ?></td>
                                            <td><?= $value->employee; ?></td>
                                            <td><?= $value->vehicle; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('inventDist/tambahBKB/' . $value->szDocId); ?>">
                                                    <button type="button" class="btn btn-info">
                                                        Tambah
                                                    </button>
                                                </a>
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
                    <h4 class="modal-title" id="myModalLabel20">Detail BKB DISTRIBUSI</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">No. Pengajuan</label>
                                    <input type="text" id="idPengajuan" class="form-control" name="noPengajuan" readonly>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Tanggal</label>
                                    <input type="date" id="idTanggal" class="form-control" name="tanggal" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city-column">Pengajuan Dari</label>
                                    <div class="row">
                                        <div class="col-4" style="padding-right: 0">
                                            <input type="text" id="idDepo" class="form-control" name="pengajuanDepo" readonly>
                                        </div>
                                        <div class="col-8" style="padding-left: 0;">
                                            <input type="text" id="namaPengajuan" class="form-control" name="pengajuanNama" readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city-column">Pengemudi</label>
                                    <input type="text" id="idPengemudi" class="form-control" name="pengemudi" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city-column">Kendaraan</label>
                                    <input type="text" id="idKendaraan" class="form-control" name="kendaraan" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="city-column">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" id="idKeterangan" cols="20" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <div id="idTambah">



                    </div>
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js ?>"></script>

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