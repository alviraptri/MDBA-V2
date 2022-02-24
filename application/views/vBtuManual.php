<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BUKTI TERIMA UANG (BTU)</title>

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

        .is-invalid .select2-container--default .select2-selection--single {
            border-color: #dc3545;
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
                            <h3>BUKTI TERIMA UANG (BTU)</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url('home'); ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="<?php echo base_url('home/cashierBTU'); ?>">Bukti Terima Uang (BTU)</a>
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
                                    <h4 class="card-title">Tambah Bukti Terima Uang (BTU)</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="<?php echo base_url('cashierBtu/simpanBtu'); ?>" method="POST">
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. BTU</label>
                                                        <input type="text" id="idBtu" class="form-control" name="btu" readonly value="<?= $btu; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Tanggal</label>
                                                        <input type="date" id="idTgl" class="form-control" name="tgl" value="<?= date('Y-m-d'); ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Pengemudi</label>
                                                        <div class="row">
                                                            <div class="col-4" style="padding-right: 0">
                                                                <select class="js-example-basic-single col-md-6 form-select" name="pengemudi" id="idPengemudi" onchange="getFormPengemudi()">
                                                                    <option value="-" disabled>Pilih Pengemudi</option>
                                                                    <option value=""></option>
                                                                    <?php
                                                                    foreach ($employee as $value) { ?>
                                                                        <option value="<?= $value->szId; ?>"><?= $value->szId; ?></option>
                                                                    <?php }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-8" style="padding-left: 0;">
                                                                <input type="text" id="pengemudiNama" class="form-control" name="namaPengemudi" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">No. Akun</label>
                                                        <div class="row">
                                                            <div class="col-4" style="padding-right: 0">
                                                                <select class="js-example-basic-single col-md-6 form-select" name="akunHead" id="idAkunHead" onchange="getFormAkunHead()">
                                                                    <option value="-" disabled>Pilih No. Akun</option>
                                                                    <option value=""></option>
                                                                    <?php
                                                                    foreach ($account as $value) { ?>
                                                                        <option value="<?= $value->szId; ?>"><?= $value->szId; ?></option>
                                                                    <?php }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-8" style="padding-left: 0;">
                                                                <input type="text" id="namaAkunHead" class="form-control" name="akunHeadNama" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">No. Sub Akun</label>
                                                        <div class="row">
                                                            <div class="col-4" style="padding-right: 0">
                                                                <select class="js-example-basic-single col-md-6 form-select" name="subHead" id="idSubHead" onchange="getFormSubAkunHead()">
                                                                    <option value="-" disabled>Pilih No. Sub Akun</option>
                                                                    <option value=""></option>
                                                                    <?php
                                                                    foreach ($subAcc as $value) { ?>
                                                                        <option value="<?= $value->szId; ?>"><?= $value->szId; ?></option>
                                                                    <?php }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-8" style="padding-left: 0;">
                                                                <input type="text" id="namaSubAkunHead" class="form-control" name="subAkunHeadNama" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Kontrol Jumlah</label>
                                                        <input type="text" id="idKontrolJumlah" class="form-control" name="kontrolJumlah" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped'>
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>No. Akun</th>
                                                                <th>Nama Akun</th>
                                                                <th>Sub Akun</th>
                                                                <th>Nama Sub Akun</th>
                                                                <th>Nilai</th>
                                                                <th>Keterangan</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body" class="view-this">
                                                            <tr id="baris0">
                                                                <td>1 <input type="hidden" id="counter0" name="counter[]" value="0"></td>
                                                                <td>
                                                                    <select class="js-example-basic-single col-md-6 form-select" name="akunDet[0]" id="idAkunDet0" onchange="getFormAkunDet(0)">
                                                                        <option value="-" disabled>Pilih No. Akun</option>
                                                                        <option value=""></option>
                                                                        <?php
                                                                        foreach ($account as $value) { ?>
                                                                            <option value="<?= $value->szId; ?>"><?= $value->szId; ?></option>
                                                                        <?php }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input name="akunDetNama[0]" type="text" id="namaAkunDet0" class="form-control" readonly>
                                                                </td>
                                                                <td>
                                                                    <select class="js-example-basic-single col-md-6 form-select" name="subDet[0]" id="idSubDet0" onchange="getFormSubAkunDet(0)">
                                                                        <option value="-" disabled>Pilih No. Sub Akun</option>
                                                                        <option value=""></option>
                                                                        <?php
                                                                        foreach ($subAcc as $value) { ?>
                                                                            <option value="<?= $value->szId; ?>"><?= $value->szId; ?></option>
                                                                        <?php }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input name="akunSubDetNama[0]" type="text" id="namaSubAkunDet0" class="form-control" readonly>
                                                                </td>
                                                                <td>
                                                                    <input name="nominal[0]" type="text" id="idNominal0" class="form-control currency" onkeyup="numberFormat()" onchange="totalNominal(0)">
                                                                </td>
                                                                <td>
                                                                    <input name="keterangan[0]" type="text" id="idKeterangan0" class="form-control">
                                                                </td>
                                                                <td>
                                                                    <button type="button" onclick="loadnew(1)" id="btn-tambah-form" class="btn btn-primary">+</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <a href="<?php echo base_url('home/cashierBTU') ?>">
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
    <script type="text/javascript">
        function numberFormat() {
            $(".currency").on("keyup", function(e) {
                var selection = window.getSelection().toString();
                if (selection !== '') {
                    return;
                }

                // When the arrow keys are pressed, abort.
                if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
                    return;
                }

                var $this = $(this);

                // Get the value.
                var input = $this.val();

                var input = input.replace(/[\D\s\._\-]+/g, "");
                input = input ? parseInt(input, 10) : 0;

                $this.val(function() {
                    return (input === 0) ? "" : input.toLocaleString("en-US");
                });
            });
        }

        function getFormAkunHead() {
            var id = document.getElementById('idAkunHead').value;

            $.ajax({
                url: "<?= base_url('cashierBtu/getAccountName') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('namaAkunHead').value = row.szName;
                    }
                }
            })
        }

        function getFormAkunDet(x) {
            var id = document.getElementById('idAkunDet' + x).value;

            $.ajax({
                url: "<?= base_url('cashierBtu/getAccountName') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('namaAkunDet' + x).value = row.szName;
                    }
                }
            })
        }

        function getFormSubAkunDet(x) {
            var id = document.getElementById('idSubDet' + x).value;

            $.ajax({
                url: "<?= base_url('cashierBtu/getSubAccName') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('namaSubAkunDet' + x).value = row.szName;
                    }
                }
            })
        }

        function getFormSubAkunHead() {
            var id = document.getElementById('idSubHead').value;

            $.ajax({
                url: "<?= base_url('cashierBtu/getSubAccName') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('namaSubAkunHead').value = row.szName;
                    }
                }
            })
        }

        function getFormPengemudi() {
            var pengemudi = document.getElementById('idPengemudi').value;

            $.ajax({
                url: "<?= base_url('inventDepot/getEmployeeName') ?>",
                method: "POST",
                data: {
                    pengemudi: pengemudi
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('pengemudiNama').value = row.szName;
                    }
                }
            })
        }

        var sumNom = 0;
        function totalNominal(x)
        {
            // sumNom = 0;
            var nominal =  document.getElementById('idNominal'+x).value;
            var nomFormat = nominal.toString().replaceAll(',','');
            console.log(nomFormat)
            sumNom += parseInt(nomFormat);
            let result = sumNom.toLocaleString("en-US");
            document.getElementById('idKontrolJumlah').value = result;
        }
    </script>

    <script type="text/javascript">
        var counter = 0;
        var num = 2;
        var count = 0;

        function loadnew(e) {
            count = counter + e;
            console.log(counter);
            var newrow = $(".view-this");
            var cols = "";
            cols += '<tr id="baris' + count + '">';
            cols += '<td>' + (count + 1) + ' <input type="hidden" id="counter' + count + '" name="counter[' + count + ']" value="' + count + '"></td>';
            cols += '<td>';
            cols += '<select class="js-example-basic-single col-md-6 form-select" name="akunDet[' + count + ']" id="idAkunDet' + count + '" onchange="getFormAkunDet(' + count + ')">';
            cols += '<option value="-" disabled>Pilih No. Akun</option>';
            cols += '<option value=""></option>';
            cols += '<?php foreach ($account as $value) { ?>';
            cols += '<option value="<?= $value->szId; ?>"><?= $value->szId; ?></option>';
            cols += '<?php } ?>';
            cols += '</select>';
            cols += '</td>';
            cols += '<td>';
            cols += '<input name="akunDetNama[' + count + ']" type="text" id="namaAkunDet' + count + '" class="form-control" readonly>';
            cols += '</td>';
            cols += '<td>';
            cols += '<select class="js-example-basic-single col-md-6 form-select" name="subDet[' + count + ']" id="idSubDet' + count + '" onchange="getFormSubAkunDet(' + count + ')">';
            cols += '<option value="-" disabled>Pilih No. Sub Akun</option>';
            cols += '<option value=""></option>';
            cols += '<?php foreach ($subAcc as $value) { ?>';
            cols += '<option value="<?= $value->szId; ?>"><?= $value->szId; ?></option>';
            cols += '<?php } ?>';
            cols += '</select>';
            cols += '</td>';
            cols += '<td>';
            cols += '<input name="akunSubDetNama[' + count + ']" type="text" id="namaSubAkunDet' + count + '" class="form-control" readonly>';
            cols += '</td>';
            cols += '<td>';
            cols += '<input name="nominal[' + count + ']" type="text" id="idNominal' + count + '" class="form-control currency" onkeyup="numberFormat()" onchange="totalNominal(' + count + ')">';
            cols += '</td>'
            cols += '<td>';
            cols += '<input name="keterangan[' + count + ']" type="text" id="idKeterangan' + count + '" class="form-control">'; 
            cols += '</td>';
            cols += '<td>';
            cols += '<a class="btn btn-danger" onclick="deleteRow(' + count + ')" style="color: white;">-</a>';
            cols += '</td>';
            cols += '</tr>';
            newrow.append(cols);
            $("row").append(newrow);
            $(".js-example-basic-single").select2();
            num++;
            counter++;
            document.getElementById("counter").value = count;
        }

        function deleteRow(row) {
            counter -= 1;
            var a = document.getElementById("baris" + row);
            a.parentNode.removeChild(a);
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