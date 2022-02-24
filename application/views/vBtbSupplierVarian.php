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
    <?php } 
    else if ($this->session->flashdata('error')) { ?>
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
                        <div class="col-12 col-md-6">
                            <h3>BTB Supplier</h3>
                        </div>
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb" class='breadcrumb-header text-right'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">BTB Supplier</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
                <section class="section">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="card" style="height: 50vh;">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo base_url('home/btbSuppList'); ?>" method="POST">
                                        <div class="row" style="padding-top: 30px;">
                                            <div class="col-md-3"></div>
                                            <div class="form-group col-md-4">
                                                <h5>VARIAN*</h5>
                                                <select name="varian" id="varian" class="form-control" style="background-color: #ffff;">
                                                    <option value=""> PILIH VARIAN </option>
                                                    <option value="GLN">GALLON</option>
                                                    <option value="SPS">SPS</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="row" style="padding-top: 30px;">
                                            <div class="col-md-3"></div>
                                            <div class="form-group col-md-4">
                                                <h5>JENIS TRANSAKSI*</h5>
                                                <select name="transaksi" id="transaksi" class="form-control" style="background-color: #ffff;">
                                                    <option value="REGULER"> REGULER </option>
                                                    <option value="SO">SO</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="row" style="padding-top: 30px;">
                                            <div class="col-md-3"></div>
                                            <div class="form-group col-md-4" style="margin-block-start: auto;">
                                                <button type="submit" class="btn btn-info">CARI</button>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
    <script src="<?php echo base_url(); ?>assets/index/js/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/index/js/app.js"></script>

    <script src="<?php echo base_url(); ?>assets/index/js/main.js"></script>
</body>

</html>