<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BTB SUPPLIER</title>

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
    <?php if ($this->session->flashdata('error')) { ?>
        <script>
            Swal.fire({
                type: 'error',
                title: 'Data Tidak Ditemukan',
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
                            <h3>BTB Supplier</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url('home/btbSupplier'); ?>">BTB Supplier</a></li>
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
                                    <a href="<?php echo base_url('home/btbSupplier') ?>">
                                        <button type="submit" class="btn btn-success">Back</button>
                                    </a>
                                    <button type="submit" class="btn btn-warning" onClick="refresh(this)">Refresh</button>
                                    <a href="<?php echo base_url('inventori/btbSupplierHistory') ?>">
                                        <button type="submit" class="btn btn-secondary">History</button>
                                    </a>
                                    <!-- <a href="<?php echo base_url('inventSupp/manualBtb') ?>"> -->
                                    <button type="submit" class="btn btn-white">Input</button>
                                    <!-- </a> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Ref 3 (PO)</th>
                                        <th>No. Ref 2 (GR)</th>
                                        <th>No. Ref 1 (CO)</th>
                                        <th>No. Surat Jalan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($waterin as $value) { ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $value->mk_po_old; ?></td>
                                            <td><?= $value->mk_gr; ?></td>
                                            <td><?= $value->mk_co_real; ?></td>
                                            <td><?= $value->mk_dn_m; ?></td>
                                            <td>
                                                <!-- <input type="hidden" name="a" id="<?= $no; ?>" value="<?= $value->mk_barcode; ?>">
                                                <button type="button" class="btn btn-info" onclick="detail(document.getElementById('<?= $no; ?>').value)">
                                                    Detail
                                                </button> -->
                                                <a href="<?php echo base_url('inventori/tambahBtbSupplier/' . $value->mk_dn_m); ?>">
                                                    <button type="button" class="btn btn-info">
                                                        Tambah
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

    <!-- full size modal-->
    <div class="modal fade text-left w-100" id="full-scrn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel20">Detail BTB Supplier</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">No. Dokumen</label>
                                    <input type="text" id="idNoDoc" class="form-control" name="noDoc" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Tanggal</label>
                                    <input type="date" id="idTanggal" class="form-control" name="tanggal">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city-column">Supplier</label>
                                    <input type="text" id="idSupplier" class="form-control" placeholder="City" name="supplier" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Jasa Pengangkut</label>
                                    <input type="text" id="idJasaPengangkut" class="form-control" name="jasaPengangkut" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="company-column">Gudang</label>
                                    <select class="form-select" id="idGudang" name="gudang">
                                        <option>Pilih Gudang</option>
                                        <?php
                                        foreach ($gudang as $value) { ?>
                                            <option value="<?= $value->szId; ?>"><?= $value->szId; ?> | <?= $value->szName; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email-id-column">Tipe Stok</label>
                                    <select class="form-select" id="idTipeStok" name="tipeStok">
                                        <option value=""> Pilih Tipe Stok </option>
                                        <option value="DLP">DLP - Stock dalam Perjualan</option>
                                        <option value="JAMBOT">JAMBOT - Stock botol di pelanggan</option>
                                        <option value="JUAL">JUAL - Stock untuk penjualan</option>
                                        <option value="JUAL">SEWA - Produk sewa di pelanggan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">No. Surat Jalan</label>
                                    <input type="text" id="idNoSJ" class="form-control" name="noSuratJalan" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="company-column">Tgl Surat Jalan</label>
                                    <input type="text" id="idTglSj" class="form-control" name="tglSj" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="country-floating">Kendaraan</label>
                                    <input type="text" id="idKendaraan" class="form-control" name="kendaraan" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="company-column">Pengemudi</label>
                                    <input type="text" id="idPengemudi" class="form-control" name="pengemudi" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="company-column">No. Ref 1 (PO)</label>
                                        <input type="text" id="idRefSatu" class="form-control" name="refSatu" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="company-column">No. Ref 2 (GR)</label>
                                        <input type="text" id="idRefDua" class="form-control" name="refDua" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="company-column">No. Ref 3 (CO)</label>
                                        <input type="text" id="idRefTiga" class="form-control" name="refTiga" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Apply</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.3.1.js ?>"></script>
    <script>
        function detail(x) {
            var id = x;
            // alert(id);
            function data() {
                $.ajax({
                    url: "<?= base_url('inventori/getDetBtbSupplier') ?>",
                    method: "POST",
                    data: {
                        'id': id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data.btb);
                        $.each(data, function() {
                            document.getElementById("idNoDoc").value = data.id;
                        });

                        var number = 1;
                        var html = '';
                        for (i = 0; i < data.btb.length; i++) {
                            document.getElementById("idSupplier").value = data.btb[i].pabrik_nama;
                            document.getElementById("idJasaPengangkut").value = data.btb[i].transporter_kode;
                            document.getElementById("idNoSJ").value = data.btb[i].mk_dn_t;
                            document.getElementById("idTglSj").value = data.btb[i].mk_dn_date;
                            document.getElementById("idKendaraan").value = data.btb[i].mk_armada_nopol;
                            document.getElementById("idPengemudi").value = data.btb[i].mk_armada_driver;
                            document.getElementById("idRefSatu").value = data.btb[i].mk_po_old;
                            document.getElementById("idRefDua").value = data.btb[i].mk_gr;
                            document.getElementById("idRefTiga").value = data.btb[i].mk_co_real;

                            html += '<tr>' +
                                '<td>' + number + '</td>' +
                                '<td>' + data.btb[i].material_nama + '</td>' +
                                '<td>' + data.btb[i].mk_varian_muatan + '</td>' +
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