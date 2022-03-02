<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDBA - RUTE</title>

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
    <?php } else if ($this->session->flashdata('info')) { ?>
        <script>
            Swal.fire({
                type: 'info',
                title: 'Produk Tidak Boleh Sama',
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
                                    <li class="breadcrumb-item active" aria-current="page">Permintaan Barang</li>
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
                                    <h4 class="card-title">Tambah Permintaan Barang</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="formId" action="<?php echo base_url('sndPB/simpanPB'); ?>" method="POST">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">No. Dokumen</label>
                                                        <input type="text" id="noDoc" class="form-control" name="noDoc" readonly value="<?= $id; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Tanggal</label>
                                                        <input type="date" id="idTgl" class="form-control" name="tgl" value="<?= date('Y-m-d'); ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Status</label>
                                                        <input type="text" id="idStatus" class="form-control" name="status" readonly value="<?= $status; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Gudang</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="gudang" id="idGudang">
                                                            <option value="-" disabled>Pilih Gudang</option>
                                                            <?php
                                                            foreach ($warehouse as $value) { ?>
                                                                <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Tipe Stok</label>
                                                        <select class="js-example-basic-single col-md-6 form-select" name="stok" id="idStok">
                                                            <option value="-" disabled>Pilih Tipe Stok</option>
                                                            <?php
                                                            foreach ($type as $value) { ?>
                                                                <option value="<?= $value->szId; ?>"><?= $value->szId . " - " . $value->szName; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Pengemudi</label>
                                                        <div class="row">
                                                            <div class="col-12" style="padding-right: 0">
                                                                <select class="js-example-basic-single col-md-6 form-select" name="pengemudi" id="idPengemudi" onchange="getVehicle()">
                                                                    <option value="-" disabled>Pilih Pengemudi</option>
                                                                    <option value=""></option>
                                                                    <?php
                                                                    foreach ($employee as $value) { ?>
                                                                        <option value="<?= $value->szId; ?>"><?= $value->szId; ?> - <?= $value->szName ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Kendaraan</label>
                                                        <div class="row">
                                                            <div class="col-12" style="padding-right: 0">
                                                                <select class="js-example-basic-single col-md-6 form-select" name="kendaraan" id="idKendaraan">
                                                                    <option value="-" disabled>Pilih Kendaraan</option>
                                                                    <option value=""></option>
                                                                    <?php
                                                                    foreach ($vehicle as $value) { ?>
                                                                        <option value="<?= $value->szPoliceNo; ?>"><?= $value->szId; ?> - <?= $value->szPoliceNo ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Kode KIT</label>
                                                        <input type="text" id="key_kode" class="form-control" name="key_kode">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Nama KIT</label>
                                                        <div id="show_nama">
                                                            <input type="text" class="form-control" name="" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Qty</label>
                                                        <input type="number" id="qty_kode" class="form-control" name="qty_kode" min="0">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <table class='table table-striped view-this'>
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Kode Produk</th>
                                                                <th>Qty</th>
                                                                <th>Satuan</th>
                                                                <th><button type="button" onclick="loadnew()" id="btn-tambah-form" class="btn btn-primary">+</button></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="show_data">

                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-md-6 col-12" id="addRow">

                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <a href="<?php echo base_url('home/permintaanBrg') ?>">
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
        function getInfo(x) {
            var qty = parseInt(document.getElementById('idQty' + x).value);
            var onHand = parseInt(document.getElementById('idOnHand' + x).value);

            if (onHand < qty) {
                alert('Stok Tidak Ada');
                $("#notif" + x).show();
            } else {
                $("#notif" + x).hide();
            }
        }

        function getVehicle() {
            var id = document.getElementById('idPengemudi').value;
            $.ajax({
                url: "<?= base_url('sndPB/vehicle') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    var html = '';
                    var i;
                    for (var j = 0; j < data.vehicle.length; j++) {
                        html = '<option value="' + data.vehicle[j].szPoliceNo + '" selected>' + data.vehicle[j].szVehicleId + ' - ' + data.vehicle[j].szPoliceNo + '</option>'

                    }
                    for (i = 0; i < data.kendaraan.length; i++) {
                        html += '<option value="' + data.kendaraan[i].szPoliceNo + '">' + data.kendaraan[i].szId + ' - ' + data.kendaraan[i].szPoliceNo + '</option>'
                    }
                    $('#idKendaraan').html(html);
                }
            })
        }

        function getFormProduk(x) {
            var produk = document.getElementById('idKode' + x).value;
            var stok = document.getElementById('idStok').value;
            var gudang = document.getElementById('idGudang').value;

            $.ajax({
                url: "<?= base_url('sndPB/getProduk') ?>",
                method: "POST",
                data: {
                    produk: produk,
                    stok: stok,
                    gudang: gudang
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    for (var row of data) {
                        document.getElementById('idSatuan' + x).value = row.szUomId;
                        document.getElementById('idOnHand' + x).value = row.decQtyOnHand;
                    }
                }
            })
        }
    </script>

    <script type="text/javascript">  
        var counter = 0;
        // var counter = 0;
        $("#notif" + counter).hide();
        var num = 1;
        var code = 0;
        function loadnew() {
            var count = this.code;
            var newrow = $(".view-this");
            var cols = "";
            cols += "<tr id='baris" + count + "'>";
            cols += "<td>" + this.num + "</td>";
            cols += "<td>";
            cols += "<select class='js-example-basic-single form-select' name='kode[]' id='idKode" + count + "' required onchange='getFormProduk(" + count + ")'>";
            cols += "<option value='-' disabled>Pilih Produk</option>";
            cols += "<option value=''></option>";
            cols += "<?php foreach ($product as $value) { ?>";
            cols += "<option value='<?= $value->szId; ?>'><?= $value->szId; ?> - <?= $value->szName; ?></option>";
            cols += "<?php } ?>";
            cols += "</select>";
            cols += "</td>";
            cols += "<td>";
            cols += "<input name='qty[]' type='text' id='idQty" + count + "' class='form-control' onkeypress='return hanyaAngka(event)' autocomplete='off' required  onchange='getInfo(" + count + ")'>";
            cols += "<input name='onHand[]' type='hidden' id='idOnHand" + count + "' class='form-control' onkeypress='return hanyaAngka(event)' autocomplete='off'>";
            cols += "<label id='notif" + count + "' style='color: red;'>*Qty Lebih Besar dari Stok</label>";
            cols += "</td>";
            cols += "<td>";
            cols += "<input name='satuan[]' type='text' id='idSatuan" + count + "' class='form-control' readonly>";
            cols += "</td>";
            cols += "<td>";
            cols += "<a class='btn btn-danger' onclick='deleteRow(" + count + ")' style='color: white;'>-</a>";
            cols += "</td>";
            cols += "</tr>";
            newrow.append(cols);
            $("row").append(newrow);
            $(".js-example-basic-single").select2();
            $("#notif" + count).hide();
            this.num++;
            this.code++;
            // this.counter++;
            // console.log(this.counter);
            // document.getElementById("counter").value = count;
        }

        function deleteRow(row) {
            // this.counter -= 1;
            this.num = this.num - 1;
            // this.code = this.code -1;
            var a = document.getElementById("baris" + row);
            a.parentNode.removeChild(a);
        }

        function tampil_data_produk(){
            var count = this.num;
            var icode = this.code;
            var key_kode=$('#key_kode').val();
            var qty_kode=$('#qty_kode').val();
            var gudang=$('#idGudang').val();
            var stok=$('#idStok').val();
            $.ajax({
                type  : 'GET',
                url   : '<?=base_url('sndPB/data_produk')?>',
                async : true,
                dataType : 'json',
                data : {key_kode:key_kode, qty_kode:qty_kode, gudang:gudang, stok:stok},
                success : function(data){
                    var html = '';
                    var i;
                    var itemNumber = 0;
                    for(i=0; i<data.length; i++){
                        
                        var no_item = itemNumber++;
                        if (data[i].decQtyOnHand < data[i].qty ) {
                            alert('Stok Tidak Ada');
                            html += '<tr id="row_produk_new'+data[i].iInternalId+'">'+
                            '<td>'+count+
                            '<input type="hidden" name="kode[]" class="form-control" value="'+data[i].szId+'">'+
                            '<input type="hidden" name="satuan[]" class="form-control" value="'+data[i].szUomId+'">'+
                            '</td>'+
                            '<td>'+data[i].szId+' - '+data[i].szName+'</td>'+
                            '<td>'+
                                '<input type="number" name="qty[]" class="form-control" min="0" value="'+data[i].qty+'" onchange="getInfo(' + i + ')">'+
                                '<input name="onHand[]" type="hidden" id="idOnHand' + i + '" value="'+data[i].decQtyOnHand+'" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off">'+
                                '<label id="notif' + i + '" style="color: red;">*Qty Lebih Besar dari Stok</label>'+
                            '</td>'+
                            '<td>'+data[i].szUomId+'</td>'+
                            '<td align="center">'+'<button type="button" name="remove" id="'+data[i].iInternalId+'" class="btn btn-danger btn_remove_produk_new" style="color: white;">-</button>'+'</td>'+
                        '</tr>';
                        }
                        else{
                        html += '<tr id="row_produk_new'+data[i].iInternalId+'">'+
                            '<td>'+count+
                            '<input type="hidden" name="kode[]" class="form-control" value="'+data[i].szId+'">'+
                            '<input type="hidden" name="satuan[]" class="form-control" value="'+data[i].szUomId+'">'+
                            '</td>'+
                            '<td>'+data[i].szId+' - '+data[i].szName+'</td>'+
                            '<td>'+
                                '<input type="number" name="qty[]" class="form-control" min="0" value="'+data[i].qty+'" onchange="getInfo(' + i + ')">'+
                                '<input name="onHand[]" type="hidden" id="idOnHand' + i + '" value="'+data[i].decQtyOnHand+'" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off">'+
                            '</td>'+
                            '<td>'+data[i].szUomId+'</td>'+
                            '<td align="center">'+'<button type="button" name="remove" id="'+data[i].iInternalId+'" class="btn btn-danger btn_remove_produk_new" style="color: white;">-</button>'+'</td>'+
                        '</tr>';
                        }
                        count++;
                        icode++;
                    }

                    num = count;
                    code = icode;
                    $('#show_data').append(html);

                    $(document).on('click', '.btn_remove_produk_new', function(){  
                       var button_new = $(this).attr("id");   
                       $('#row_produk_new'+button_new+'').remove();  
                    }); 

                }

            });
            
        }
    </script>

    <script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

        $('#formId').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){  
            $(this).keydown(function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    tampil_data_produk();
                    tampil_nama_kit();
                }
            });

        });  

        

        function tampil_nama_kit(){
            var key_kode=$('#key_kode').val();
            $.ajax({
                type  : 'GET',
                url   : '<?=base_url('sndPB/nama_kit')?>',
                async : true,
                dataType : 'json',
                data : {key_kode:key_kode},
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        // html += '<input type="text" name="" class="form-control" value="'+data[i].nama_kode+'" readonly>';
                        html += '<input type="text" id="show_nama" class="form-control" name="" value="'+data[i].szName+'" readonly>';
                        // html += data[i].nama_kode;
                    }
                    $('#show_nama').html(html);

                }

            });
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