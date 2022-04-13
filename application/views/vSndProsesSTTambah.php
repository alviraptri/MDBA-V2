<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - PROSES SURAT TUGAS</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/style.css"> -->

    <link rel="stylesheet" href="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/datatables.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/dataTables.checkboxes.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/awesome-bootstrap-checkbox.css" <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.css">
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

        table.dataTable tr th.select-checkbox.selected::after {
            content: "✔";
            margin-top: -11px;
            margin-left: -4px;
            text-align: center;
            text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
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
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo base_url('sndProsesST/simpanProses'); ?>">
                                <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Proses</button>
                                </div>
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal</label>
                                            <!-- <input type="text" name="daterange" class="form-control" id="dateRangeId" placeholder="03/10/2022 - 03/13/2022" /> -->
                                            <input type="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Jenis Rute</label>
                                            <select class="js-example-basic-single col-md-6 form-select" name="jenisRute" id="jenisRuteId" onchange="getEmployee()">
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

                                </div>

                                <br>

                                <!-- <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Cari:</label>
                                        <input type="text" id="search" class="form-control" id="search" placeholder="Cari">
                                    </div>
                                </div> -->

                                <table class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px;"><input type="checkbox" class="form-check-input" id="checkAll" name="checkAll"><label></label></th>
                                            <th>Karyawan</th>
                                            <th>Jenis Rute</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabel_body">
                                    </tbody>
                                </table>

                                <br>
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="<?php echo base_url('home/prosesSuratTugas') ?>">
                                        <button type="button" class="btn btn-white me-1 mb-1">Cancel</button>
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
<script src="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/dataTables.checkboxes.min.js"></script>
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

    let example = $('#table1').DataTable({
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        order: [
            [1, 'asc']
        ],
    });
    example.on("click", "th.select-checkbox", function() {
        if ($("th.select-checkbox").hasClass("selected")) {
            example.rows().deselect();
            $("th.select-checkbox").removeClass("selected");
        } else {
            example.rows().select();
            $("th.select-checkbox").addClass("selected");
        }
    }).on("select deselect", function() {
        ("Some selection or deselection going on")
        if (example.rows({
                selected: true
            }).count() !== example.rows().count()) {
            $("th.select-checkbox").removeClass("selected");
        } else {
            $("th.select-checkbox").addClass("selected");
        }
    });

    // $(document).ready(function() {
    //     $('#table1').DataTable({
    //         "responsive": true,
    //         "scrollCollapse": true,
    //         "scrollX": true
    //     })
    // });

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

    function getEmployee() {
        var jenis = document.getElementById('jenisRuteId').value;
        alert(jenis);
        // console.log(jenis);

        $.ajax({
            url: "<?= base_url('sndProsesST/getEmployee') ?>",
            method: "POST",
            data: {
                'jenis': jenis
            },
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                var number = 1;
                var html = '';
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td><input type="checkbox" class="form-check-input" name="checkData[]" value="'+data[i].szId+'"><label></label></td>' +
                        '<td>' + data[i].szId + ' - ' + data[i].szName + '</td>' +
                        '<td>' + data[i].szRouteType + '</td>' +
                        '<tr>';
                    number++;
                }
                $('#tabel_body').html(html);
            }
        });
    }

    $("#checkAll").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $("#search").on("keyup", function() {
        var value = $(this).val();

        $("table tr").each(function(index) {
            if (index !== 0) {

                $row = $(this);

                var id = $row.find("td:first").text();

                if (id.indexOf(value) !== 0) {
                    $row.hide();
                } else {
                    $row.show();
                }
            }
        });
    });

    function refresh() {
        window.location.reload("Refresh")
    }
</script>

</html>

<!-- https://www.gyrocode.com/projects/jquery-datatables-checkboxes/examples/styling/awesome-bootstrap-checkbox/ -->