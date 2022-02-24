<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - AUTO TRANSFER BTU</title>

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
                title: 'Maaf, Data Gagal Disimpan',
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
                            <h3>AUTO TRANSFER BTU</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('home/cashierAuto'); ?>">Auto Transfer BTU</a></li>
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
                                    <a href="http://192.168.4.95/wo_cashier/">
                                        <button type="submit" class="btn btn-white">Transferred</button>
                                    </a>
                                    <a href="http://192.168.4.95/wo_cashier/">
                                        <button type="submit" class="btn btn-white">Settlement</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo base_url('cashierAuto/autoSimpanManual'); ?>">
                                <button type="submit" class="btn btn-primary" style="float: right !important;">Simpan All</button>
                                <table class='table table-striped'>
                                    <thead>
                                        <tr>
                                            <th>Check</th>
                                            <th>No. BTU</th>
                                            <th>Tx Id</th>
                                            <th>NIK | Pengemudi | Kode</th>
                                            <th>Nopol</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if ($btu != 0) {
                                            $btuId = $btu;
                                        } else {
                                            $btuId = '';
                                        }
                                        if ($data != '0') {
                                            foreach ($data as $value) { ?>
                                                <tr>
                                                    <td><input type="checkbox" id="checkId" class="form-check-input" name="check[]" value="<?= $value->staggingTx; ?>"></td>
                                                    <td><?= $btuId; ?> <input type="hidden" value="<?= $btuId; ?>" name="btu"></td>
                                                    <td><?= $value->staggingTx; ?> <input type="hidden" value="<?= $value->staggingTx; ?>" name="tx[]"></td>
                                                    <td><?= $value->driverNik; ?> | <?= $value->driverMesinId; ?> | <?= $value->kode_driver; ?><input type="hidden" value="<?= $value->driverMesinId; ?>" name="operator[]"></td>
                                                    <td><?= $value->nopol; ?> <input type="hidden" value="<?= $value->nopol; ?>" name="kendaraan"></td>
                                                    <td>Rp <?= number_format(substr($value->staggingAmount, 0, -2), 0, '', '.') ?> <input type="hidden" value="<?= $value->staggingAmount; ?>" name="nominal"></td>
                                                    <td>
                                                        <a href="<?php echo base_url('cashierAuto/autoSimpan/'.$value->staggingTx.'-'.$value->driverMesinId); ?>">
                                                            <button type="button" class="btn icon btn-info">
                                                                Simpan
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $no++;
                                                $btuId++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </form>
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