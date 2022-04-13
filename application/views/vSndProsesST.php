<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - PROSES SURAT TUGAS</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/style.css"> -->

    <link rel="stylesheet" href="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/datatables.bootstrap5.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/app.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon/favicon.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datepicker/daterangepicker.css">

    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--===============================================================================================-->

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

</head>

<body>
    <!-- <script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/jquery/bootstrap.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/jquery/sweetalert2.min.js"></script> -->
    <?php if ($this->session->flashdata('success')) { ?>
        <script>
            Swal.fire({
                type: 'success',
                title: 'Data Berhasil Tersimpan',
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
                            <h3>PROSES SURAT TUGAS</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="<?php echo base_url('home/prosesSuratTugas'); ?>">Proses Surat Tugas</a>
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
                                    <button type="submit" class="btn btn-warning" onClick="refresh(this)">Refresh</button>
                                    <!-- <a href="#">
                                        <button type="submit" class="btn btn-secondary">History</button>
                                    </a> -->
                                    <a href="<?php echo base_url('sndProsesST/proses'); ?>">
                                        <button type="submit" class="btn btn-white">Proses</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal</label>
                                            <input type="text" name="daterange" class="form-control" id="dateRangeId" placeholder="03/10/2022 - 03/13/2022" />
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Jenis Rute</label>
                                            <select class="js-example-basic-single col-md-6 form-select" name="jenisRute" id="jenisRuteId">
                                                <option value="-" disabled>Pilih Rute</option>
                                                <option></option>
                                                <option value="TKO">TKO - PRESELLER</option>
                                                <option value="CAN">CAN - KANVAS</option>
                                                <option value="COL">COL - KOLEKTOR</option>
                                                <option value="CRL">CRL - CRL</option>
                                                <option value="DEL">DEL - PENGIRIMAN</option>
                                                <option value="MER">MER - MERCHANDISE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="form-group" style="padding-top: 1.4em;">
                                            <button type="button" onclick="filter()" class="btn btn-info me-1 mb-1">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <br>

                            <table class='table table-striped' id="table1" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Surat Tugas</th>
                                        <th>Jenis Rute</th>
                                        <th>Karyawan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tabel_body">
                                    <?php
                                    $no = 1;
                                    foreach ($data as $value) { ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $value->szDocId; ?></td>
                                            <td><?= $value->szRouteType; ?></td>
                                            <td><?= $value->szName . " - " . $value->szName; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('sndProsesST/detail/' . $value->szDocId); ?>" target="_blank">
                                                    <button type="button" class="btn btn-primary">
                                                        Detail
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

</body>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js"></script>
<script src="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/jquery.datatables.min.js"></script>
<script src="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/datatables.bootstrap5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/index/js/feather-icons/feather.min.js"></script>
<script src="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/index/js/app.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datepicker/daterangepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/index/js/main.js"></script>
<!-- SELECT2 -->
<script src="<?php echo base_url(); ?>assets/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: "Pilih"
        });
    });

    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

    $(document).ready(function() {
        $('#table1').DataTable({
            "responsive": true,
            "scrollCollapse": true,
            "scrollX": true
        })
    });

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }

    function filter() {
        var jenis = document.getElementById('jenisRuteId').value;
        var tgl = document.getElementById('dateRangeId').value;
        var splitTgl = tgl.split('-');
        var tglAwal = formatDate(splitTgl[0].toString().trim());
        var tglAkhir = formatDate(splitTgl[1].toString().trim());
        // console.log(tgl);
        // console.log(tglAwal);
        // console.log(tglAkhir);
        // console.log(jenis);

        $.ajax({
            url: "<?= base_url('sndProsesST/filter') ?>",
            method: "POST",
            data: {
                'jenis': jenis,
                'tglAwal': tglAwal,
                'tglAkhir': tglAkhir
            },
            dataType: "JSON",
            success: function(data) {
                // console.log(data);
                var number = 1;
                var html = '';
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td>' + number + '</td>' +
                        '<td>' + data[i].szDocId + '</td>' +
                        '<td>' + data[i].szRouteType + '</td>' +
                        '<td>' + data[i].szEmployeeId + ' - ' + data[i].szName + '</td>' +
                        '<td><input type="hidden" name="docId" id="idDoc' + i + '" value="' + data[i].szDocId + '"><button type="button" class="btn btn-primary" onclick="detail(' + i + ')">Detail</button></td>' +
                        '<tr>';
                    number++;
                }
                $('#tabel_body').html(html);
            }
        });
    }

    function refresh() {
        window.location.reload("Refresh")
    }
</script>

</html>