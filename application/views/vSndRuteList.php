<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - RUTE</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/css/bootstrap.css">

    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/style.css"> -->

    <link rel="stylesheet" href="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/datatables.bootstrap5.min.css">

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
    <?php } ?>

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
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-warning" onClick="refresh(this)">Refresh</button>
                                    <!-- <a href="#">
                                        <button type="submit" class="btn btn-secondary">History</button>
                                    </a> -->
                                    <a href="<?php echo base_url('sndRute/uploadRute'); ?>">
                                        <button type="submit" class="btn btn-white">Upload Data</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class='table table-striped' id="table1" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Rute</th>
                                        <th>Nama Rute</th>
                                        <th>Jenis Rute</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $value) { ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $value->szId; ?></td>
                                            <td><?= $value->szName; ?></td>
                                            <td><?= $value->szRouteType; ?></td>
                                            <td>
                                                <input type="hidden" name="karyawan" id="emp<?= $no; ?>" value="<?= $value->szId; ?>">
                                                <input type="hidden" name="karyawanNama" id="empNama<?= $no; ?>" value="<?= $value->szName; ?>">
                                                <input type="hidden" name="rute" id="rute<?= $no; ?>" value="<?= $value->szRouteType; ?>">
                                                <button type="button" class="btn btn-primary" onclick="detail(<?= $no; ?>)">
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
                    <h4 class="modal-title" id="myModalLabel20">Detail Rute</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Kode Rute</label>
                                    <input type="text" id="idEmp" class="form-control" name="Emp" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Nama Rute</label>
                                    <input type="text" id="idEmpNama" class="form-control" name="EmpNama" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="company-column">Jenis Rute</label>
                                    <input type="text" id="idRute" class="form-control" name="Rute" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email-id-column">Keterangan</label>
                                    <input type="text" id="idKeterangan" class="form-control" name="Keterangan" readonly>
                                </div>
                            </div>
                        </div>

                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Pel</th>
                                    <th>Nama Pel</th>
                                    <th>Sen</th>
                                    <th>Sel</th>
                                    <th>Rab</th>
                                    <th>Kam</th>
                                    <th>Jum</th>
                                    <th>Sab</th>
                                    <th>Min</th>
                                </tr>
                            </thead>
                            <tbody id="table_modal">
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

</body>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js ?>"></script>
<script src="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/jquery.datatables.min.js"></script>
<script src="<?= base_url() ?>assets/index/vendors/datatables-bootstrap5/datatables.bootstrap5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/index/js/feather-icons/feather.min.js"></script>
<script src="<?php echo base_url(); ?>assets/index/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/index/js/app.js"></script>


<!-- <script src="<?php echo base_url(); ?>assets/index/vendors/simple-datatables/simple-datatables.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/index/js/vendors.js"></script> -->

<script src="<?php echo base_url(); ?>assets/index/js/main.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').DataTable({
            "responsive": true,
            "scrollCollapse": true,
            "scrollX": true
        })
    });

    function detail(x) {
        var employee = document.getElementById('emp' + x).value;
        var route = document.getElementById('rute' + x).value;
        var name = document.getElementById('empNama' + x).value;
        var id = x;
        // alert(id);
        function data() {
            $.ajax({
                url: "<?= base_url('sndRute/detailRute') ?>",
                method: "POST",
                data: {
                    'employee': employee,
                    'route': route
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    document.getElementById("idEmp").value = employee;
                    document.getElementById("idEmpNama").value = name;
                    document.getElementById("idRute").value = route;

                    for (var row of data) {
                        document.getElementById("idKeterangan").value = row.szDescription;
                    }

                    var number = 1;
                    var html = '';
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + number + '</td>' +
                            '<td>' + data[i].szCustomerId + '</td>' +
                            '<td>' + data[i].szName + '</td>' +
                            '<td><input class="form-check-input" type="checkbox" value="" id="myCheckMon"' + (data[i].intDay1 == '1' ? "checked" : "") + ' disabled></td>' +
                            '<td><input class="form-check-input" type="checkbox" value="" id="myCheckTue"' + (data[i].intDay2 == '1' ? "checked" : "") + ' disabled></td>' +
                            '<td><input class="form-check-input" type="checkbox" value="" id="myCheckWed"' + (data[i].intDay3 == '1' ? "checked" : "") + ' disabled></td>' +
                            '<td><input class="form-check-input" type="checkbox" value="" id="myCheckThu"' + (data[i].intDay4 == '1' ? "checked" : "") + ' disabled></td>' +
                            '<td><input class="form-check-input" type="checkbox" value="" id="myCheckFri"' + (data[i].intDay5 == '1' ? "checked" : "") + ' disabled></td>' +
                            '<td><input class="form-check-input" type="checkbox" value="" id="myCheckSat"' + (data[i].intDay6 == '1' ? "checked" : "") + ' disabled></td>' +
                            '<td><input class="form-check-input" type="checkbox" value="" id="myCheckSun"' + (data[i].intDay7 == '1' ? "checked" : "") + ' disabled></td>' +
                            '<tr>';
                        number++;
                    }
                    $('#table_modal').html(html);
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


</html>