<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - TUTUP BUKU GUDANG</title>

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
                title: 'Mohon Periksa Kembali Inputan Anda',
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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="<?php echo base_url('home/inventTbg'); ?>">Tutup Buku Gudang</a>
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
                                    <h4 class="card-title">Tutup Buku Gudang</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="<?php echo base_url('inventTbg/simpan'); ?>" method="POST">
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. TBG</label>
                                                        <input type="text" id="idTbg" class="form-control" name="tbg" readonly value="<?= $tbg;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Tanggal</label>
                                                        <input type="text" id="idTgl" class="form-control" name="tgl" readonly value="<?= date('Y-m-d');?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Gudang</label>
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
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group" style="padding-top: 20px;">
                                                        <button type="button" class="btn btn-info me-1 mb-1" onclick="detail()">Cari</button>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped'>
                                                        <thead>
                                                            <tr>
                                                                <th>Nomor Akun</th>
                                                                <th>Nama Akun</th>
                                                                <th>Sub Akun</th>
                                                                <th>Nama Sub Akun</th>
                                                                <th>Saldo Perkiraan</th>
                                                                <th>Debit</th>
                                                                <th>Kredit</th>
                                                                <th>Saldo Akhir</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body" class="view-this">
                                                        </tbody>
                                                    </table>

                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <a href="<?php echo base_url('home') ?>">
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
        function detail() {
            var branch = document.getElementById('idDepo').value;
            var company = document.getElementById('idPerusahaan').value;
            var dateStart = document.getElementById('idTglStart').value;
            var dateFinish = document.getElementById('idTglFinish').value;
            // alert(company);
            function data() {
                $.ajax({
                    url: "<?= base_url('cashierSettlement/getData') ?>",
                    method: "POST",
                    data: {
                        'branch': branch,
                        'company': company,
                        'dateStart': dateStart,
                        'dateFinish': dateFinish
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        var number = 1;
                        var html = '';
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + data[i].akun + '</td>' +
                                '<td>' + data[i].namaAkun + '</td>' +
                                '<td>' + data[i].subAkun + '</td>' +
                                '<td>' + data[i].namaSubAkun + '</td>' +
                                '<td>' + Intl.NumberFormat({ maximumSignificantDigits: 3 }).format(data[i].saldoAwal) + '</td>' +
                                '<td>' + Intl.NumberFormat({ maximumSignificantDigits: 3 }).format(data[i].decDebit) + '</td>' +
                                '<td>' + Intl.NumberFormat({ maximumSignificantDigits: 3 }).format(data[i].decCredit) + '</td>' +
                                '<td>' + Intl.NumberFormat({ maximumSignificantDigits: 3 }).format(data[i].saldoAkhir) + '</td>' +
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
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }
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