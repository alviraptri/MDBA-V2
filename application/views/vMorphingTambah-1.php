<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - STOK MORPHING</title>

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
                title: 'Maaf, Terjadi Gagal Input',
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
                            <h3>STOK MORPHING</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Stok Morphing</li>
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
                                    <h4 class="card-title">Tambah Stok Morphing</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="<?php echo base_url('inventori/simpanMorphing'); ?>" method="POST">
                                            <div class="row">
                                                <?php
                                                foreach ($data as $value) {
                                                    $noRef = $value->doc_id;
                                                    $gudangId = $value->warehouse_id;
                                                    $tipeId = $value->stock_type;
                                                    $tanggal = $value->date;
                                                    $deskripsi = $value->description;
                                                }
                                                ?>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. Dokumen</label>
                                                        <input type="text" id="noDoc" class="form-control" name="noDoc" readonly value="<?= $id; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">No. Referensi</label>
                                                        <input type="text" id="noRef" class="form-control" name="noRef" readonly value="<?= $noRef; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Tanggal</label>
                                                        <input type="date" id="tgl" class="form-control" name="tgl" value="<?= $tanggal; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Gudang</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="gudang" id="gudang">
                                                            <!-- <option value="<?= $warehouseId; ?>" selected><?= $warehouseName; ?></option> -->
                                                            <option value="-" disabled>Pilih Gudang</option>
                                                            <?php
                                                            foreach ($gudang as $value) {
                                                                if ($gudangId == $value->szId) {
                                                            ?>
                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szName; ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value="<?= $value->szId; ?>"><?= $value->szName; ?></option>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Tipe Stok</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="stok" id="stok">
                                                            <option value="-" disabled>Pilih Tipe Stok</option>
                                                            <?php
                                                            foreach ($stok as $value) {
                                                                if ($tipeId == $value->szId) {
                                                            ?>
                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szId . " (" . $value->szName . ")"; ?></option>
                                                                <?php
                                                                } else { ?>
                                                                    <option value="<?= $value->szId; ?>"><?= $value->szId . " (" . $value->szName . ")"; ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped'>
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Produk</th>
                                                                <th>Qty</th>
                                                                <th>></th>
                                                                <th>Produk Jadi</th>
                                                                <th>Qty Jadi</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body" class="view-this">
                                                            <?php
                                                            $no = 0;
                                                            foreach ($data as $prod) { ?>
                                                                <tr id="baris<?= $no; ?>">
                                                                    <td><?= $no + 1; ?><input type="hidden" id="counter" value="<?= $no; ?>"></td>
                                                                    <td>
                                                                        <select class="js-example-basic-single form-select" name="produk[]" id="produk<?= $no; ?>">
                                                                            <option value="-" disabled>Pilih Produk</option>
                                                                            <?php
                                                                            foreach ($produk as $value) {
                                                                                if ($prod->product_id == $value->szId) { ?>
                                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input id="userName-2a" name="qty[]" type="text" id="qty<?= $no; ?>" value="<?= $prod->qty; ?>" class="form-control" onkeypress="return hanyaAngka(event)">
                                                                    </td>
                                                                    <td>></td>
                                                                    <td>
                                                                        <select class="js-example-basic-single form-select" name="produkTo[]" id="idProdukTo<?= $no; ?>">
                                                                            <option value="-" disabled>Pilih Produk</option>
                                                                            <?php
                                                                            foreach ($produk as $value) {
                                                                                if ($prod->product_to == $value->szId) { ?>
                                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input id="userName-2a" name="qtyTo[]" type="text" id="qty<?= $no; ?>" value="<?= $prod->qty_to; ?>" class="form-control" onkeypress="return hanyaAngka(event)">
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        if ($no == '0') {
                                                                        ?>
                                                                            <button onclick="deleteRow(<?= $no; ?>)" class="btn btn-danger" disabled>
                                                                                Delete
                                                                            </button>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <button onclick="deleteRow(<?= $no; ?>)" class="btn btn-danger">
                                                                                Delete
                                                                            </button>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                                $no++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-xl-9 m-b-30"></div>
                                                        <div class="col-sm-12 col-xl-4 m-b-30">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <button type="button" class="btn btn-info me-1 mb-1" onclick="loadnew()" id="btn-tambah-form">Add Row (+)</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Keterangan</label>
                                                        <textarea name="keterangan" class="form-control" id="keterangan" cols="20" rows="5"><?= $deskripsi; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <a href="<?php echo base_url('home/stokMorphing') ?>">
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
        var loadnew;
        var no = <?= $no; ?>;
        var counter = 1;
        var num = counter + no;
        $(document).ready(function() {
            loadnew = function() {
                var newrow = $(".view-this");
                var cols = "";
                cols += '<tr id="baris' + counter + '">';
                cols += '<td>' + num + '<input type="hidden" id="counter" value="' + counter + '"></td>';
                cols += '<td>';
                cols += '<select class="js-example-basic-single form-select" name="produk[' + counter + ']" id="produk' + counter + '">';
                cols += '<option value="-" disabled>Pilih Produk</option>';
                cols += '<?php foreach ($produk as $value) { ?>';
                cols += '<option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>';
                cols += '<?php } ?>';
                cols += '</select>';
                cols += '</td>';
                cols += '<td>';
                cols += '<input id="userName-2a" name="qty[' + counter + ']" type="text" id="qty' + counter + '" class="form-control">';
                cols += '</td>';
                cols += '<td>></td>';
                cols += '<td>';
                cols += '<select class="js-example-basic-single form-select" name="produkTo[' + counter + ']" id="idProdukTo' + counter + '">';
                cols += '<option value="-" disabled>Pilih Produk</option>';
                cols += '<?php foreach ($produk as $value) { ?>';
                cols += '<option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>';
                cols += '<?php } ?>';
                cols += '</select>';
                cols += '</td>';
                cols += '<td>';
                cols += '<input id="userName-2a" name="qtyTo[' + counter + ']" type="text" id="qtyTo' + counter + '" class="form-control">';
                cols += '</td>';
                cols += '<td>';
                cols += '<button onclick="deleteRow(' + counter + ')" class="btn btn-danger">Delete</button>';
                cols += '</td>';
                cols += '</tr>';

                newrow.append(cols);
                $("row").append(newrow);
                $(".js-example-basic-single").select2();
                counter++;
                num++;
                document.getElementById("counter").value = counter;
            }
        })
    </script>
    <!-- <script type="text/javascript">
        var no = <?= $no; ?>;
        var counter = 1;
        var num = counter + no;

        function loadnew() {

            var newrow = $(".view-this");
            var cols = "";
            cols += '<tr id="baris' + counter + '">';
            cols += '<td>' + num + '<input type="hidden" id="counter" value="' + counter + '"></td>';
            cols += '<td>';
            cols += '<select class="js-example-basic-single form-select" name="produk[' + counter + ']" id="produk' + counter + '">';
            cols += '<option value="-" disabled>Pilih Produk</option>';
            cols += '<?php foreach ($produk as $value) { ?>';
            cols += '<option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>';
            cols += '<?php } ?>';
            cols += '</select>';
            cols += '</td>';
            cols += '<td>';
            cols += '<input id="userName-2a" name="qty[' + counter + ']" type="text" id="qty' + counter + '" class="form-control">';
            cols += '</td>';
            cols += '<td>></td>';
            cols += '<td>';
            cols += '<select class="js-example-basic-single form-select" name="produkTo[' + counter + ']" id="idProdukTo' + counter + '">';
            cols += '<option value="-" disabled>Pilih Produk</option>';
            cols += '<?php foreach ($produk as $value) { ?>';
            cols += '<option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>';
            cols += '<?php } ?>';
            cols += '</select>';
            cols += '</td>';
            cols += '<td>';
            cols += '<input id="userName-2a" name="qtyTo[' + counter + ']" type="text" id="qtyTo' + counter + '" class="form-control">';
            cols += '</td>';
            cols += '<td>';
            cols += '<button onclick="deleteRow(' + counter + ')" class="btn btn-danger">Delete</button>';
            cols += '</td>';
            cols += '</tr>';

            newrow.append(cols);
            $("row").append(newrow);
            $(".js-example-basic-single").select2();
            counter++;
            num++;
            document.getElementById("counter").value = counter;
        }

        function deleteRow(row) {
            var a = document.getElementById("baris" + row);
            a.parentNode.removeChild(a);
            // var element = document.getElementById(jovan);
            // var i = row.parentNode.parentNode.rowIndex;
            // element.parentNode.removeChild(element);
            // document.getElementById('jovan').deleteRow(i);
        }
    </script> -->

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
                placeholder: "Pilih Produk"
            });
        });
    </script>
</body>

</html>