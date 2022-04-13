<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - KONVERSI PPN DO</title>

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
                title: 'Mohon Input Data Kembali',
            })
        </script>
    <?php } else if ($this->session->flashdata('warningg')) { ?>
        <script>
            Swal.fire({
                type: 'warning',
                title: 'Data Sudah Pernah Diubah',
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
                            <h3>KONVERSI PPN DO</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="<?php echo base_url('home/konversiPpnDo'); ?>">Konversi PPN DO</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="<?php echo base_url('konversi/updateDO'); ?>">
                                <div class="row">
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal</label>
                                            <!-- <input type="text" name="daterange" class="form-control" id="dateRangeId" placeholder="03/10/2022 - 03/13/2022" /> -->
                                            <input type="date" name="tanggal" id="idTanggal" class="form-control" onchange="getPpn(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">PPN</label>
                                            <input type="text" name="ppn" id="idPpn" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="form-group" style="padding-top: 1.4em;">
                                            <button type="button" onclick="filter()" class="btn btn-info me-1 mb-1">Cari</button>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <table class='table table-striped' width="100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="text-align: center; width: 17%;">No. DO</th>
                                            <th rowspan="2" style="text-align: center;">Dec Amount</th>
                                            <th colspan="2" style="text-align: center; background-color: #FF6B6B; color: white;">PPN 10%</th>
                                            <th colspan="2" style="text-align: center; background-color: #97DBAE; color: white;">PPN 11%</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center; background-color: #FF6B6B; color: white;">Dec Tax</th>
                                            <th style="text-align: center; background-color: #FF6B6B; color: white;">Dec DPP</th>
                                            <th style="text-align: center; background-color: #97DBAE; color: white;">Dec Tax</th>
                                            <th style="text-align: center; background-color: #97DBAE; color: white;">Dec DPP</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabel_body">
                                    </tbody>
                                </table>

                                <br>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                    <a href="<?php echo base_url('home/konversiPpnDo') ?>">
                                        <button type="button" class="btn btn-white me-1 mb-1">Batal</button>
                                    </a>
                                </div>

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
    function getPpn(e) {
        // alert(e.target.value);
        if (e.target.value < '2022-04-01') {
            document.getElementById("idPpn").value = '10%';
        } else {
            document.getElementById("idPpn").value = '11%';
        }
    }

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
        var ppn = document.getElementById('idPpn').value;
        var tgl = document.getElementById('idTanggal').value;
        // console.log(tgl);
        // console.log(tglAwal);
        // console.log(tglAkhir);
        // console.log(jenis);
        // alert(ppn);

        $.ajax({
            url: "<?= base_url('konversi/getDataDoPPN') ?>",
            method: "POST",
            data: {
                'ppn': ppn,
                'tgl': tgl
            },
            dataType: "JSON",
            success: function(data) {
                // console.log(data);
                var html = '';
                for (i = 0; i < data.length; i++) {
                    // console.log('amount: '+data[i].decAmount);
                    let tax = parseFloat(data[i].tax);
                    let dpp = parseFloat(data[i].dpp);
                    html += '<tr>' +
                        '<td style="width: 17%;">' + data[i].szDocId + '</td>' +
                        '<td style="text-align: center;">' + data[i].decAmount + '</td>' +
                        '<td style="text-align: center; background-color: #FF6B6B; color: white;">' + data[i].decTax + '</td>' +
                        '<td style="text-align: center; background-color: #FF6B6B; color: white;">' + data[i].decDpp + '</td>' +
                        '<td style="text-align: center; background-color: #97DBAE; color: white;">' + tax.toFixed(4) + '</td>' +
                        '<td style="text-align: center; background-color: #97DBAE; color: white;">' + dpp.toFixed(4) + '</td>' +
                        '<tr>';
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