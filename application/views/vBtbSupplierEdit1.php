<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - BTB SUPPLIER</title>

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
</head>

<body>
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
                                    <li class="breadcrumb-item active" aria-current="page">BTB Supplier</li>
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
                                    <h4 class="card-title">Edit BTB Supplier</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
                                                <?php
                                                foreach ($a as $value) {
                                                    $warehouseId = $value->szWarehouseId;
                                                    $warehouseName = $value->namaGudang;
                                                    $tipeId = $value->szStockType;
                                                    $tipeName = $value->tipe;
                                                    $supplierId = $value->szSupplierId;
                                                    $supplierName = $value->supplier;
                                                    $jasaPengangkutId = $value->szCarrierId;
                                                    $jasaPengangkutName = $value->jasaPengangkut;
                                                    $kendaraanNopol = $value->szVehicle2;
                                                    $kendaraanDriver = $value->szDriver2;
                                                    $noDn = $value->szRefDocId;
                                                    $noDnTgl = $value->dtmDN;
                                                    $noRef1 = $value->szRef1;
                                                    $noRef2 = $value->szRef2;
                                                    $noRef3 = $value->szRef3;
                                                    $deskripsi = $value->szDescription;
                                                }
                                                ?>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. Document</label>
                                                        <input type="text" id="noDoc" class="form-control" name="noDoc" readonly value="<?= $newSupp; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">No. Adjustment</label>
                                                        <input type="text" id="noDocOld" class="form-control" name="noDocOld" readonly value="<?= $document; ?>">
                                                        <input type="hidden" id="noAdjustment" class="form-control" name="noAdjustment" value="<?= $adjustment; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Tanggal</label>
                                                        <input type="date" id="tgl" class="form-control" name="tgl" value="<?= date('Y-m-d'); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Gudang</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="gudang" id="gudang">
                                                            <!-- <option value="<?= $warehouseId; ?>" selected><?= $warehouseName; ?></option> -->
                                                            <option value="-" disabled>Pilih Gudang</option>
                                                            <?php
                                                            foreach ($gudang as $value) {
                                                                if ($warehouseId == $value->szId) {
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
                                                <div class="col-md-4 col-12">
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
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Supplier</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="supplier" id="supplier">
                                                            <option value="-" disabled>Pilih Supplier</option>
                                                            <?php
                                                            foreach ($supplier as $value) {
                                                                if ($supplierId == $value->szId) {
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
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Jasa Pengangkut</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="jasaPengangkut" id="jasaPengangkut">
                                                            <option value="-" disabled>Pilih Jasa Pengangkut</option>
                                                            <?php
                                                            foreach ($carrier as $value) {
                                                                if ($jasaPengangkutId == $value->szId) {
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
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Kendaraan</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="kendaraan" id="kendaraan">
                                                            <option value="-" disabled>Pilih Kendaraan</option>
                                                            <option value="<?= $kendaraanNopol; ?>" selected><?= $kendaraanNopol; ?></option>
                                                            <?php
                                                            foreach ($kendaraan as $value) {
                                                            ?>
                                                                <option value="<?= $value->szVehicleNo; ?>"><?= $value->szVehicleNo; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Pengemudi</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="pengemudi" id="pengemudi">
                                                            <option value="-" disabled>Pilih Pengemudi</option>
                                                            <option value="<?= $kendaraanDriver; ?>" selected><?= $kendaraanDriver; ?></option>
                                                            <?php
                                                            foreach ($pengemudi as $value) {
                                                            ?>
                                                                <option value="<?= $value->szDriverName; ?>"><?= $value->szDriverName; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">No. Surat Jalan</label>
                                                        <input type="text" id="noSuratJalan" class="form-control" name="noSuratJalan" value="<?= $noDn; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Tgl Surat Jalan</label>
                                                        <input type="date" id="tglSuratJalan" class="form-control" name="tglSuratJalan" value="<?= date(('Y-m-d'), strtotime($noDnTgl)); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">No. Ref 1</label>
                                                        <input type="text" id="noRef1" class="form-control" name="noRef1" value="<?= $noRef1; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">No. Ref 2</label>
                                                        <input type="text" id="noRef2" class="form-control" name="noRef2" value="<?= $noRef2; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">No. Ref 3</label>
                                                        <input type="text" id="noRef3" class="form-control" name="noRef3" value="<?= $noRef3; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">

                                                    <!-- <div class="view-this">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-xl-1 m-b-30">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <input type="hidden" name="counter" value="<?= $no; ?>">
                                                                        <label for="userName-2" class="block"> No </label>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <input class="form-control" type="text" name="no[]" id="no<?= $no; ?>" value="<?= $no + 1; ?>" readonly="true" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-xl-7 m-b-30">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <label for="userName-2" class="block"> Produk </label>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <select class="js-example-basic-single form-select" name="produk[]" id="produk<?= $no; ?>">
                                                                            <option value="-" disabled>Pilih Produk</option>
                                                                            <?php
                                                                            foreach ($produk as $value) {
                                                                                if ($prod->szProductId == $value->szId) { ?>
                                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szName; ?></option>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <option value="<?= $value->szId; ?>"><?= $value->szName; ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-xl-2 m-b-30">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <label for="userName-2" class="block"> Satuan </label>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <input class="form-control" type="text" name="satuan[]" id="satuan<?= $no; ?>" value="<?= $prod->szUomId; ?>" readonly="true" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-xl-1 m-b-30">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <label for="userName-2" class="block"> Qty </label>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <input id="userName-2a" name="qty[]" type="text" id="qty<?= $no; ?>" value="<?= $prod->decQty; ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-xl-1 m-b-30">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <label for="userName-2" class="block"> Aksi </label>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <a href="#fakelink" class="btn waves-effect waves-light btn-tumblr"><i class="feather icon-plus"></i></a> 
                                                                        <button type="button" class="btn btn-info me-1 mb-1" id="btn-tambah-form">-</button> 
                                                                        <a class="btn btn-info" onclick=javascript:removeElement(row<?= $no; ?>,<?= $no; ?>) style="color: white;">-</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <table class='table table-striped'>
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Produk</th>
                                                                <th>Satuan</th>
                                                                <th>Qty</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body">
                                                            <?php
                                                            $no = 0;
                                                            foreach ($a as $prod) { ?>
                                                                <tr id="baris<?= $no; ?>">
                                                                    <td><?= $no + 1; ?></td>
                                                                    <td>
                                                                        <select class="js-example-basic-single form-select" name="produk[<?= $no; ?>]" id="produk<?= $no; ?>">
                                                                            <option value="-" disabled>Pilih Produk</option>
                                                                            <?php
                                                                            foreach ($produk as $value) {
                                                                                if ($prod->szProductId == $value->szId) { ?>
                                                                                    <option value="<?= $value->szId; ?>" selected><?= $value->szName; ?></option>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <option value="<?= $value->szId; ?>"><?= $value->szName; ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input class="form-control" type="text" name="satuan[<?= $no; ?>]" id="satuan<?= $no; ?>" value="<?= $prod->szUomId; ?>" readonly="true" />
                                                                    </td>
                                                                    <td>
                                                                        <input id="userName-2a" name="qty[<?= $no; ?>]" type="text" id="qty<?= $no; ?>" value="<?= $prod->decQty; ?>" class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <button onclick="removed(<?= $no; ?>)" class="btn btn-danger">
                                                                            Delete
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

                                                <div class="col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-xl-9 m-b-30"></div>
                                                        <div class="col-sm-12 col-xl-4 m-b-30">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <!-- <a href="#fakelink" class="btn waves-effect waves-light btn-tumblr"><i class="feather icon-plus"></i></a> -->
                                                                    <button type="button" class="btn btn-info me-1 mb-1" onclick="addRow(<?= $no; ?>)" id="btn-tambah-form">Add Row (+)</button>
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
                                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
        function removed(e) {
            $("#baris" + e).remove();
        }

        function addRow(e) {
            var num = e + 1;
            markup = "<tr id='baris" + e + "'><td>" + num + "</td><td><select class='js-example-basic-single form-select' name='produk[" + e + "]' id='produk" + e + "'><option value='-'>Pilih Produk</option><?php foreach ($produk as $value) { ?> <option value='<?= $value->szId; ?>'><?= $value->szName; ?></option> <?php } ?> </select> </td> <td> <input class='form-control' type='text' name='satuan[" + e + "]' id='satuan" + e + "' value='' readonly='true' /> </td> <td> <input id='userName-2a' name='qty[" + e + "]' type='text' id='qty" + e + "' class='form-control'> </td> <td> <button onclick='removed(" + e + ")' class='btn btn-danger' > Delete </button> </td> </tr>";
            tableBody = $("table tbody");
            tableBody.append(markup);
            $(".js-example-basic-single").select2();
            e++;
        }
    </script>
    <!-- <script>
        var saveNumber = 0;

        function removeElement(elementId, maxID) {
            var element = document.getElementById(elementId);
            element.parentNode.removeChild(element);
            countingElement(maxID)
        }

        function countingElement(maxID) {
            text = true;
            while (text == false) {
                maxID++;
                text = document.getElementById("myElement" + maxID + "");
                console.log(maxID);
                console.log(text);
            };
        }
    </script> -->

    <!-- <script type="text/javascript">
		var counter = 1;

		function loadnew() {
            var newrow = $(".view-this");
            var cols = "";
            cols += '<div class="row">';
            cols += '<div class="col-sm-12 col-xl-4 m-b-30">';
            cols += '<div class="form-group row">';
            cols += '<div class="col-sm-12">';
            cols += '<input type="hidden" name="counter" value="' + counter + '">';
            cols += '<select class="form-control form-control-inverse fill col-sm-12" name="produk_asli['+counter+']" id="asli_produk'+counter+'" onchange="asli('+counter+')">';
            cols += '<option value=""> Pilih Produk </option>';
            cols += '<?php foreach ($product as $value) { ?>';
            cols += '<option value="<?= $value->szId; ?>" data-asli_satuan="<?= $value->szUomId; ?>"><?= $value->szName; ?></option>';
            cols += '<?php } ?>';
            cols += '</select>';
            cols += '<input class="form-control" type="hidden" name="satuan_asli['+counter+']" id="asli_satuan'+counter+'" readonly="true" />'
            cols += '</div>';
            cols += '</div>';
            cols += '</div>';
            cols += '<div class="col-sm-12 col-xl-1 m-b-30">';
            cols += '<div class="form-group row">';
            cols += '<div class="col-sm-12">';
            cols += '<input id="userName-2a" name="qty_asli['+counter+']" type="text" class="form-control">';
            cols += '</div>';
            cols += '</div>';
            cols += '</div>';
            cols += '<div class="col-sm-12 col-xl-1 m-b-30">';
            cols += '<div class="form-group row">';
            cols += '<div class="col-sm-12">';
            cols += '<label for="userName-2" class="block"> <center>To</center>  </label>';
            cols += '</div>';
            cols += '</div>';
            cols += '</div>';
            cols += '<div class="col-sm-12 col-xl-4 m-b-30">';
            cols += '<div class="form-group row">';
            cols += '<div class="col-sm-12">';
            cols += '<select class="form-control form-control-inverse fill col-sm-12" name="produk_jadi['+counter+']" id="jadi_produk'+counter+'" onchange="jadi('+counter+')">';
            cols += '<option value=""> Pilih Produk </option>';
            cols += '<?php foreach ($product as $value) { ?>';
            cols += '<option value="<?= $value->szId; ?>" data-jadi_satuan="<?= $value->szUomId; ?>"><?= $value->szName; ?></option>';
            cols += '<?php } ?>';
            cols += '</select>';
            cols += '<input class="form-control" type="hidden" name="satuan_jadi['+counter+']" id="jadi_satuan'+counter+'" readonly="true" />'
            cols += '</div>';
            cols += '</div>';
            cols += '</div>';
            cols += '<div class="col-sm-12 col-xl-1 m-b-30">';
            cols += '<div class="form-group row">';
            cols += '<div class="col-sm-12">';
            cols += '<input id="userName-2a" name="qty_jadi['+counter+']" type="text" class="form-control">';
            cols += '</div>';
            cols += '</div>';
            cols += '</div>';
            cols += '<div class="col-sm-12 col-xl-1 m-b-30">';
            cols += '<div class="form-group row">';
            cols += '<div class="col-sm-12">';
            cols += '<a class="btn waves-effect waves-light btn-tumblr" onclick=javascript:removeElement("row'+counter+'",'+ counter +'); style="color: white;">-</a>';
            cols += '</div>';
            cols += '</div>';
            cols += '</div>';
            newrow.append(cols);
            $("row").append(newrow);
            counter++;
            document.getElementById("counter").value = counter;
        }

        function asli(x) {
        	var asli_satuan = $('#asli_produk'+x).find(':selected').data('asli_satuan');
        	document.getElementById("asli_satuan"+x).value = asli_satuan;
      	}

      	function jadi(x) {
        	var jadi_satuan = $('#jadi_produk'+x).find(':selected').data('jadi_satuan');
        	document.getElementById("jadi_satuan"+x).value = jadi_satuan;
      	}

        var saveNumber = 0 ; 
      	function removeElement(elementId,maxID) {
        	var element = document.getElementById(elementId);
        	element.parentNode.removeChild(element);
        	countingElement(maxID)
      	}

      	function countingElement(maxID){
        	text = true;
        	while(text == false){
          		maxID++;
          		text = document.getElementById("myElement"+maxID+"");
          		console.log(maxID);
          		console.log(text);
        	};
      	}
	</script> -->

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