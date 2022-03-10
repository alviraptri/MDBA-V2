<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - RUTE</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/datatables.bootstrap5.min.css">
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
    <!-- <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
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
    <?php } ?> -->
    <div id="app">
        <?php include('sideBar.php'); ?>
        <div id="main">
            <?php include('navBar.php'); ?>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>RUTE</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="<?php echo base_url('home/rute'); ?>">Rute</a>
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
                                    <h4 class="card-title">Upload Rute</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="formId" action="<?php echo base_url('sndRute/uploadExcel'); ?>" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-8 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Upload Excel</label>
                                                        <!-- <input type="file" class="form-control" id="pssRute" name="rutePss" accept=".xls" onchange="uploadFile()" multiple> -->
                                                        <input type="file" class="form-control" id="file" name="file" accept=".xls">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12" style="padding-top: 1.5em;">
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary me-1 mb-1" name="Preview" value="Preview">
                                                    </div>
                                                </div>
                                        </form>

                                        <?php
                                        if (isset($_POST['Preview'])) {
                                            if (isset($upload_error)) {
                                        ?>
                                                <script>
                                                    Swal.fire({
                                                        type: 'error',
                                                        title: 'Maaf Upload Error',
                                                    })
                                                </script>
                                            <?php
                                            } else {
                                            ?>
                                                <form class="import" id="importId" action="<?php echo base_url('sndRute/importExcel'); ?>" method="POST">
                                                    <div class="col-md-12 col-12">
                                                        <table class='table table-striped view-this nowrap' id="tableRuteUpload">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID Rute</th>
                                                                    <th>Nama PSS</th>
                                                                    <th>Jenis Rute</th>
                                                                    <th>ID Salesman</th>
                                                                    <th>Ket</th>
                                                                    <th>Kode Pel</th>
                                                                    <th>Nama Pel</th>
                                                                    <th>Sen</th>
                                                                    <th>Sel</th>
                                                                    <th>Rab</th>
                                                                    <th>Kam</th>
                                                                    <th>Jum</th>
                                                                    <th>Sab</th>
                                                                    <th>Min</th>
                                                                    <th>W1</th>
                                                                    <th>W2</th>
                                                                    <th>W3</th>
                                                                    <th>W4</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="show_data">
                                                                <?php
                                                                $size = sizeof($sheet);
                                                                for ($index = 1; $index <= sizeof($sheet); $index++) {
                                                                    if ($index == 1) {
                                                                        continue;
                                                                    } else {
                                                                ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?= $sheet[$index]['A'] ?>
                                                                                <input type="hidden" name="size" value="<?= $size; ?>">
                                                                                <input type="hidden" name="route" id="idRoute" value="<?= $sheet[$index]['A'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <?= $sheet[$index]['B'] ?>
                                                                                <input type="hidden" name="routeName" id="idRouteName" value="<?= $sheet[$index]['B'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <?= $sheet[$index]['C'] ?>
                                                                                <input type="hidden" name="routeType" id="idRouteType" value="<?= $sheet[$index]['C'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <?= $sheet[$index]['D'] ?>
                                                                                <input type="hidden" name="salesman[]" id="idSalesman" value="<?= $sheet[$index]['D'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <?= $sheet[$index]['E'] ?>
                                                                                <input type="hidden" name="description" id="idDescription" value="<?= $sheet[$index]['E'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <?= $sheet[$index]['F'] ?>
                                                                                <input type="hidden" name="customer[]" id="idCustomer" value="<?= $sheet[$index]['F'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <?= $sheet[$index]['G'] ?>
                                                                                <input type="hidden" name="customerName[]" id="idCustomerName" value="<?= $sheet[$index]['G'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckMon" <?= ($sheet[$index]['H'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="dayOne[]" id="idDayOne" value="<?= $sheet[$index]['H'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckTue" <?= ($sheet[$index]['I'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="dayTwo[]" id="idDayTwo" value="<?= $sheet[$index]['I'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckWed" <?= ($sheet[$index]['J'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="dayThree[]" id="idDayThree" value="<?= $sheet[$index]['J'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckThru" <?= ($sheet[$index]['K'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="dayFour[]" id="idDayFour" value="<?= $sheet[$index]['K'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckFri" <?= ($sheet[$index]['L'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="dayFive[]" id="idDayFive" value="<?= $sheet[$index]['L'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckSat" <?= ($sheet[$index]['M'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="daySix[]" id="idDaySix" value="<?= $sheet[$index]['M'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckFri" <?= ($sheet[$index]['L'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="daySeven[]" id="idDaySeven" value="<?= $sheet[$index]['N'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckW1" <?= ($sheet[$index]['O'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="weekOne[]" id="idWeekOne" value="<?= $sheet[$index]['O'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckW2" <?= ($sheet[$index]['P'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="weekTwo[]" id="idWeekTwo" value="<?= $sheet[$index]['P'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckW3" <?= ($sheet[$index]['Q'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="weekThree[]" id="idWeekThree" value="<?= $sheet[$index]['Q'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-check-input" type="checkbox" value="" id="myCheckW4" <?= ($sheet[$index]['R'] == '1') ? "checked" : ""; ?> disabled >
                                                                                <input type="hidden" name="weekFour[]" id="idWeekFour" value="<?= $sheet[$index]['R'] ?>">
                                                                            </td>
                                                                        </tr>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <br>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                        <a href="<?php echo base_url('home/rute') ?>">
                                                            <button type="button" class="btn btn-white me-1 mb-1">Cancel</button>
                                                        </a>
                                                    </div>
                                                </form>
                                        <?php
                                            }
                                        }
                                        ?>

                                        <!-- <div class="col-md-12 col-12" style="overflow-x:auto;">
                                            <table class='table table-striped view-this'>
                                                <thead>
                                                    <tr>
                                                        <th>ID Rute</th>
                                                        <th>Nama PSS</th>
                                                        <th>Jenis Rute</th>
                                                        <th>ID Salesman</th>
                                                        <th>Ket</th>
                                                        <th>Kode Pel</th>
                                                        <th>Nama Pel</th>
                                                        <th>Sen</th>
                                                        <th>Sel</th>
                                                        <th>Rab</th>
                                                        <th>Kam</th>
                                                        <th>Jum</th>
                                                        <th>Sab</th>
                                                        <th>Min</th>
                                                        <th>W1</th>
                                                        <th>W2</th>
                                                        <th>W3</th>
                                                        <th>W4</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="show_data">

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-6 col-12" id="addRow">

                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <a href="<?php echo base_url('home/rute') ?>">
                                                <button type="button" class="btn btn-white me-1 mb-1">Cancel</button>
                                            </a>
                                        </div> -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
            <!-- // Basic multiple Column Form section end -->
        </div>

        <?php
        if (isset($_POST['Preview'])) {
            # code...
        }
        ?>

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
</body>

<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-3.3.1.js"></script>
<?php include 'js.php' ?>
<script>
    $(document).ready(function() {
        $('#tableRuteUpload').DataTable({
            responsive: true,
            scrollX: true,
            scrollCollapse: true
        })
    });
    
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }

    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: "Pilih"
        });
    });
</script>
</body>

</html>