<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BTB DEPOT (ANTARDEPO)</title>

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
                            <h3>BTB DEPOT (ANTARDEPO)</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <a href="<?php echo base_url('home/btbDepot'); ?>">BTB Depot</a>
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
                                    <h4 class="card-title">Tambah BTB Depot</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="formId" action="<?php echo base_url('inventDepot/simpanBtb'); ?>" method="POST">
                                            <?php
                                            foreach ($data as $value) {
                                                $bkb = $value->szDocId;
                                                $tanggal = $value->dtmDoc;
                                                $pengemudi = $value->szEmployeeId;
                                                $pengemudiNama = $value->pengemudi;
                                                $kendaraan = $value->szVehicleId;
                                                $kendaraanNama = $value->kendaraan;
                                                $gudang = $value->szWarehouseId;
                                                $gudangNama = $value->gudang;
                                                $stok = $value->szStockType;
                                                $stokNama = $value->stok;
                                                $keterangan = $value->szDescription;
                                                $asal = $value->szBranchId;
                                                if ($value->depo != '') {
                                                    $asalNama = $value->depo;
                                                } else {
                                                    $asalNama = $value->so;
                                                }
                                            }
                                            ?>
                                            <div class="row">

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. Dokumen (BTB)</label>
                                                        <input type="text" id="idBtb" class="form-control" name="btb" readonly value="<?= $id; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">No. BKB</label>
                                                        <input type="text" id="idBkb" class="form-control" name="bkb" readonly value="<?= $bkb; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Status</label>
                                                        <input type="text" id="idStatus" class="form-control" name="status" readonly value="<?= $status; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Tanggal</label>
                                                        <input type="date" id="idTgl" class="form-control" name="tgl" value="<?= date('Y-m-d'); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Depo Asal</label>
                                                        <div class="row">
                                                            <div class="col-4" style="padding-right: 0">
                                                                <input type="text" id="idAsal" class="form-control" name="asal" value="<?= $asal; ?>" readonly>
                                                            </div>
                                                            <div class="col-8" style="padding-left: 0;">
                                                                <input type="text" id="namaAsal" class="form-control" name="namaAsal" readonly value="<?= $asalNama; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Ke Gudang</label>
                                                        <input type="text" id="idGdg" class="form-control" name="gdg" value="<?= $gudang; ?> - <?= $gudangNama; ?>" readonly>
                                                        <input type="hidden" class="form-control" id="idGudang" name="gudang" value="<?= $gudang; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Tipe Stok</label>
                                                        <input type="text" id="idStk" class="form-control" name="stk" value="<?= $stok; ?> - <?= $stokNama; ?>" readonly>
                                                        <input type="hidden" class="form-control" id="idStok" name="stok" value="<?= $stok; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Pengemudi</label>
                                                        <div class="row">
                                                            <div class="col-4" style="padding-right: 0">
                                                                <input type="text" id="idPengemudi" class="form-control" name="pengemudi" value="<?= $pengemudi; ?>" readonly>
                                                            </div>
                                                            <div class="col-8" style="padding-left: 0;">
                                                                <input type="text" class="form-control" id="pengemudiNama" name="namaPengemudi" readonly value="<?= $pengemudi; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Kendaraan</label>
                                                        <div class="row">
                                                            <div class="col-4" style="padding-right: 0">
                                                                <input type="text" id="idKendaraan" class="form-control" name="kendaraan" value="<?= $kendaraan; ?>" readonly>
                                                            </div>
                                                            <div class="col-8" style="padding-left: 0;">
                                                                <input type="text" id="kendaraanNama" class="form-control" name="namaKendaraan" readonly value="<?= $kendaraanNama; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Keterangan</label>
                                                        <textarea name="keterangan" class="form-control" id="keterangan" cols="20" rows="3" required><?= $keterangan; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped'>
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Id Produk</th>
                                                                <th>Produk</th>
                                                                <th>Qty</th>
                                                                <th>Satuan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body" class="view-this">
                                                            <?php
                                                            $no = 0;
                                                            foreach ($data as $prod) { ?>
                                                                <tr id="baris<?= $no; ?>">
                                                                    <td><?= $no + 1; ?><input type="hidden" id="counter" value="<?= $no; ?>"></td>
                                                                    <td>
                                                                        <input type="text" id="idKode" class="form-control" name="kode[<?= $no; ?>]" readonly value="<?= $prod->szProductId; ?>">
                                                                    </td>
                                                                    <td>

                                                                        <input type="text" id="idProduk" class="form-control" name="produk[<?= $no; ?>]" readonly value="<?= $prod->product; ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input name="qty[<?= $no; ?>]" type="text" id="idQty<?= $no; ?>" value="<?= $prod->decQty; ?>" readonly class="form-control" required>
                                                                    </td>
                                                                    <td>
                                                                        <input name="satuan[<?= $no; ?>]" type="text" id="idSatuan<?= $no; ?>" value="<?= $prod->szUomId; ?>" readonly class="form-control">
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                                $no++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <a href="<?php echo base_url('home/btbDepot') ?>">
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
        $('#formId').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
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