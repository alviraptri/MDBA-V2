<style>
    .select2-container .select2-selection--single {
        height: 2.5em !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 2.5em !important;
    }
</style>


<?php
// $this->load->library("guzzle");
require 'vendor/autoload.php';

use GuzzleHttp\Client;
?>

<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<link href="<?= base_url(); ?>assets/master/css/select.css" rel="stylesheet" />

<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Master Inventory</h3>
    </div>

    <div style="border-radius:10px;" class="card mt-5 p-5">
        <div class="row">
            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link satu  " id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Satuan</a>
                        <a class="nav-link dua" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Tipe Stok</a>
                        <a class="nav-link tiga" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Gudang</a>
                        <a class="nav-link empat" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"> Kategori Produk</a>
                        <a class="nav-link lima" id="v-pills-delapan-tab" data-bs-toggle="pill" href="#v-pills-delapan" role="tab" aria-controls="v-pills-delapan" aria-selected="false"> Tipe Kategori Produk</a>
                        <a class="nav-link enam" id="v-pills-stok-tab" data-bs-toggle="pill" href="#v-pills-stok" role="tab" aria-controls="v-pills-stok" aria-selected="false">Produk</a>
                        <a class="nav-link tujuh" id="v-pills-cari-tab" data-bs-toggle="pill" href="#v-pills-cari" role="tab" aria-controls="v-pills-cari" aria-selected="false">Cari Serial Number</a>
                    </div>
                </div>

                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane  show  satu-show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <!-- <button class="dua2" ></button> -->
                            <div style="border-radius:10px,10px,10px; " class="card">
                                <style>
                                    #card {
                                        background-color: #c7c3c3;
                                    }

                                    #card-body {
                                        background-color: #f0eded;
                                    }

                                    button {
                                        float: right;
                                    }
                                </style>

                                <input type="hidden" class="val1 kuis" value="2" name="">

                                <div id="card" class="card-header">
                                    <?php echo $this->session->flashdata('massage'); ?>
                                    <a href="<?= base_url(); ?>master/satuan">Master Data</a>
                                </div>

                                <div id="card-body" class="card-body p-5">
                                    <form class="form" action="<?= base_url(); ?>master/insertSatuan" method="post">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kode Satuan</label>
                                                    <input required type="text" onchange="valid_satuan(this.value)" id="kode_satuan" class="form-control " name="Ksatuan">
                                                    <div id="notifsatuan"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Nama satuan</label>
                                                    <input required type="text" id="last-name-column" class="form-control" name="Nsatuan">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    <textarea required name="ketsatuan" class="form-control" id="" cols="30" rows="5"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col mt-3">
                                                        <button id="btn-satuan" class="btn btn-primary btn-sm m-2" type="submit">Save</button>
                                                        <button class="btn btn-outline-primary m-2 btn-sm" type="reset">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane dua-show " id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <input type="hidden" class="val2" value="3" name="">

                            <div style="border-radius:10px,10px,10px; " class="card">
                                <style>
                                    #card {
                                        background-color: #c7c3c3;
                                    }

                                    #card-body {
                                        background-color: #f0eded;
                                    }

                                    button {
                                        float: right;
                                    }
                                </style>

                                <div id="card" class="card-header">
                                    <a href="<?= base_url(); ?>master/tipeStock">Master Data</a>
                                </div>

                                <div id="card-body" class="card-body p-5">
                                    <form class="form" action="<?= base_url(); ?>master/inserttipeStok" method="post">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kode Tipe Stok</label>
                                                    <input required type="text" onchange="valid_tipestok(this.value)" id="kode_tipe" class="form-control kode_tipe" name="Ktipe">
                                                    <div id="notiftipestok"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Nama Tipe Stok</label>
                                                    <input required type="text" id="last-name-column" class="form-control" name="Ntipe">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    <textarea required name="ketTipe" class="form-control" id="" cols="30" rows="5"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col mt-3">
                                                        <button type="submit" id="btn-tipestok" class="btn btn-primary btn-sm m-2" type="submit">Save</button>
                                                        <button class="btn btn-outline-primary m-2 btn-sm" type="reset">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane  tiga-show" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <input type="hidden" class="val3 " value="4" name="">

                            <div style="border-radius:10px,10px,10px; " class="card">
                                <style>
                                    #card {
                                        background-color: #c7c3c3;
                                    }

                                    #card-body {
                                        background-color: #f0eded;
                                    }

                                    button {
                                        float: right;
                                    }
                                </style>

                                <div id="card" class="card-header">
                                    <a href="<?= base_url(); ?>master/Gudang">Master Data</a>
                                </div>

                                <div id="card-body" class="card-body p-5">
                                    <form class="form" action="<?= base_url(); ?>master/insertGudang" method="post">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kode Gudang</label>
                                                    <input required type="text" onchange="valid_gudang(this.value)" id="gudang" class="form-control" name="Kgudang">
                                                    <div id="notifgudang"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Nama Gudang</label>
                                                    <input required type="text" id="last-name-column" class="form-control" name="Ngudang">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Depo</label>
                                                    <select required name="depo_gudang" id="" class="form-control">
                                                        <option value="">-- Pilih Depo -- </option>
                                                        <?php foreach ($depo as $d) { ?>
                                                            <option value="<?= $d->kode_dms ?>"><?= $d->depo_nama; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col mt-2">
                                                <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    <textarea required name="Ketgudang" class="form-control" id="" cols="30" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    Informasi Alamat
                                                    <br>
                                                    <input class="form-check-input" type="checkbox" value="1" onchange="alamat(this.value)" id="idchek">
                                                </li>
                                            </ul>
                                            <div class="showit">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <input type="hidden" id="gudangTarget" value="" name="szId">
                                                            <label for="first-name-column">Alamat</label>
                                                            <textarea type="text" id="first-name-column" class="form-control" name="szaddress"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <label for="">Provinsi</label>
                                                        <br>
                                                        <!-- <input type="text" id="last-name-column" class="form-control" name="lname-column"> -->
                                                        <select name="szProvince" id="Provinsi" onchange="getFormKota()" class=" theSelect select2-data-array browser-default form-control" id="">

                                                            <option value="">-- Pilih Provinsi -- </option>
                                                            <?php foreach ($provinsi as $p) { ?>
                                                                <option value="<?= $p->szProvince; ?>"><?= $p->szProvince; ?></option>
                                                            <?php } ?>

                                                        </select>

                                                    </div>




                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">

                                                            <label> kota / Kabupaten </label>
                                                            <br>

                                                            <select onchange="getFormKecamatan()" name="szCity" class=" theSelect2 select2-data-array browser-default form-control" id="idkota">
                                                                <option value="">Pilih Kota</option>
                                                                <option value=""></option>

                                                            </select>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <!-- <input type="text" id="last-name-column" class="form-control" name="lname-column"> -->

                                                            <label> Kecamatan </label>
                                                            <br>
                                                            <select onchange="getFormKelurahan()" name="szDistrict" id="idkecamatan" class=" theSelect3 select2-data-array browser-default form-control">
                                                                <option value="">Pilih Kecamatan</option>
                                                                <option value=""></option>


                                                            </select>
                                                            <br>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <!-- <input type="text" id="last-name-column" class="form-control" name="lname-column"> -->


                                                            <label> Kelurahan </label>
                                                            <br>
                                                            <select onchange="getFormkode()" name="szSubDistrict" class=" theSelect4 select2-data-array browser-default form-control" id="idkelurahan">
                                                                <option value="">Pilih Kelurahan</option>
                                                                <option value=""></option>
                                                            </select>

                                                        </div>
                                                    </div>


                                                    <div class="col-sm-12">
                                                        <label for="">Kode pos</label>
                                                        <select name="szZipCode" class=" select2-data-array browser-default form-control" id="idkode">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm">

                                                        <label for="">No telp 1</label>
                                                        <input type="number" name="szPhone1" id="" class="form-control">

                                                    </div>
                                                    <div class="col-sm">
                                                        <label for="">No telp 2</label>
                                                        <input type="number" name="szPhone2" id="" class="form-control">
                                                    </div>
                                                    <div class="col-sm">
                                                        <label for="">No telp 3</label>
                                                        <input type="number" name="szPhone3" id="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <label for="">No FAX</label>
                                                        <input type="number" name="szFaxmile" id="" class="form-control">
                                                    </div>
                                                    <div class=" col-md-6 sm-12">
                                                        <label for="">Kontak person 1</label>
                                                        <input type="text" name="szContactPerson1" id="" class="form-control">
                                                    </div>
                                                    <div class="col-md-6  sm-12">
                                                        <label for="">Kontak person 2</label>
                                                        <input type="text" name="szContactPerson2" id="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="">Email</label>
                                                    <input type="email" name="email" id="" class="form-control">
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col mt-3">
                                                <button id="btn-gudang" class="btn btn-primary btn-sm m-2" type="submit">Save</button>
                                                <button class="btn btn-outline-primary m-2 btn-sm" type="reset">Reset</button>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                        </form>

                        <div class="tab-pane  empat-show" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                            <input type="hidden" class="val4" value="5" name="">

                            <div style="border-radius:10px,10px,10px; " class="card">
                                <style>
                                    #card {

                                        background-color: #c7c3c3;

                                    }

                                    #card-body {

                                        background-color: #f0eded;

                                    }

                                    button {
                                        float: right;
                                    }
                                </style>

                                <div id="card" class="card-header">
                                    <a href="<?= base_url(); ?>master/kategoriProduk">Master Data</a>
                                </div>
                                <div id="card-body" class="card-body p-5">
                                    <form method="post" action="<?= base_url(); ?>master/insertKategori">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kode Kategori Produk</label>
                                                    <input required type="text" onchange="valid_kategori(this.value)" id="kode_kat" class="form-control" name="Kkategori">
                                                    <div id="notifkategori"></div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Nama Kategori Produk</label>
                                                    <input required type="text" id="last-name-column" class="form-control" name="Nkategori">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Tipe Kategori</label>

                                                    <select required name="szCategorytipeId" id="" class="form-control">
                                                        <option value="">-- Pilih Kategori -- </option>
                                                        <?php

                                                        foreach ($kat as $k) { ?>
                                                            <option value="<?= $k->szId; ?>"><?= $k->szId; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col mt-2">
                                                <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    <textarea name="szDescription" class="form-control" id="" cols="30" rows="5" required></textarea>

                                                    <!-- <a class="btn btn-outline-primary btn-sm mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Informasi Alamat
                                        </a> -->

                                                    <div class="collapse" id="collapseExample">

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col mt-3">
                                                        <button id="btn-kategori" class="btn btn-primary btn-sm m-2" type="submit">Save</button>
                                                        <button class="btn btn-outline-primary m-2 btn-sm" type="reset">Reset</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane  lima-show " id="v-pills-delapan" role="tabpanel" aria-labelledby="v-pills-delapan-tab">
                            <input type="hidden" class="val5" value="6" name="">

                            <div style="border-radius:10px,10px,10px; " class="card">
                                <style>
                                    #card {

                                        background-color: #c7c3c3;

                                    }

                                    #card-body {

                                        background-color: #f0eded;

                                    }

                                    button {
                                        float: right;
                                    }
                                </style>

                                <div id="card" class="card-header">
                                    <a href="<?= base_url(); ?>master/TipeKategoriProduk">Master Data</a>
                                </div>
                                <div id="card-body" class="card-body p-5">
                                    <form class="form" action="<?= base_url(); ?>master/insertTipeKategori" method="post">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kategori Produk</label>
                                                    <input required type="text" onchange="valid_tipekategori(this.value)" id="kode_tipe" class="form-control kode_tipe" name="TKkategori">
                                                    <div id="notiftipekategori"></div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Tipe Kategori Produk</label>
                                                    <input required type="text" id="last-name-column" class="form-control" name="TKnkategori">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    <textarea required name="TKdescription" class="form-control" id="" cols="30" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mt-2">
                                                <div class="form-group">
                                                    <label for="">Digunakan Untuk perhitungan harga</label>
                                                    <br>
                                                    <input type="checkbox" value="1" name="TKcategori" id="" class="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mt-3">
                                                <button type="submit" id="btn-tipekategori" class="btn btn-primary btn-sm m-2" type="submit">Save</button>
                                                <button class="btn btn-outline-primary m-2 btn-sm" type="reset">Reset</button>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>



                        <div class="tab-pane  enam-show" id="v-pills-stok" role="tabpanel" aria-labelledby="v-pills-stok-tab">

                            <input type="hidden" class="val6" value="7" name="">

                            <div style="border-radius:10px,10px,10px; " class="card">
                                <style>
                                    #card {

                                        background-color: #c7c3c3;

                                    }

                                    #card-body {

                                        background-color: #f0eded;

                                    }

                                    button {
                                        float: right;
                                    }
                                </style>

                                <div id="card" class="card-header">
                                    <a href="<?= base_url(); ?>master/produk">Master Data</a>
                                </div>
                                <div id="card-body" class="card-body p-5">
                                    <form method="post" action="<?= base_url(); ?>master/insertProduk" enctype="multipart/form-data" class="form">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kode Produk</label>
                                                    <input onchange="valid_produk(this.value)" required type="text" id="kode_produk" class="form-control" name="Kproduk">
                                                    <div id="notifproduk"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Nama Produk</label>
                                                    <input required type="text" id="last-name-column" class="form-control" name="Nproduk">
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="">Jenis Traking</label>
                                                    <select required name="jtProduk" id="" class="form-control">
                                                        <option value="">-- Pilih -- </option>
                                                        <option value="NON">NON - Tidak menggunakan Traking </option>
                                                        <option value="LOT">LOT - Bach / Lot Number</option>
                                                        <option value="SER">SER - Nomor Seri </option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="">Jenis Produk</label>
                                                    <select required name="jpProduk" id="" class="form-control">
                                                        <option value="">-- Pilih -- </option>
                                                        <option value="SALES">SALES - Produk jual</option>
                                                        <option value="LOT">LOT - Bach / Lot Number</option>
                                                        <option value="SER">SER - Nomor Seri </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class=" col-sm-12">
                                                <div class="from-group">
                                                    <label for="">Nick name</label>
                                                    <input required type="text" name="nick" class="form-control" id="">
                                                </div>
                                            </div>
                                            <div class=" mt-2 mb-2 text-center col-sm-12">


                                                <label for="">Masa Berlaku</label>

                                            </div>



                                            <div class="col-md-6 col-12">
                                                <div class="from-group">

                                                    <label for="">Start date</label>

                                                    <input required type="date" name="start" id="" class="form-control">

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="from-group">

                                                    <label for="">End date</label>

                                                    <input required type="date" name="end" id="" class="form-control">

                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Keterangan</label>
                                                    <textarea required name="ketproduk" class="form-control" id="" cols="30" rows="5"></textarea>

                                                    <!-- <a class="btn btn-outline-primary btn-sm mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Informasi Alamat
                                        </a> -->

                                                    <!-- <div class="collapse" id="collapseExample">
                                                
                                            </div> -->

                                                    <div class="form-check form-check-inline mt-3">
                                                        <input class="form-check-input" onchange="kitT(this.value)" type="checkbox" id="idkit" name="bKit" value="1">
                                                        <label class="form-check-label" for="teees">Produk Kit</label>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-sm-12 mt-5 mb-4">
                                                <h5 class="card-title">Optional</h5>
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Satuan</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Informasi Penjualan</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Kategori Produk</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="contact2-tab" data-bs-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false">Informasi Kit</a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                                        <div class="from-group">
                                                            <label class="mt-3" for="">Satuan Terkecil</label>
                                                            <select name="szUomId" id="" class="form-control">
                                                                <option value="">-- pilih --</option>
                                                                <?php foreach ($satuan as $s) { ?>

                                                                    <option value="<?= $s->szId; ?>"><?= $s->szName; ?></option>

                                                                <?php } ?>

                                                            </select>
                                                        </div>
                                                        <div class="from-group">
                                                            <div class="form-check form-check-inline mt-3">
                                                                <input class="form-check-input" type="checkbox" id="ddd" name="bUseComposite" value="1">
                                                                <label class="form-check-label" for="ddd">Menggunakan satuan komposit</label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="from-group">
                                                            <label for="">Format kuantit</label>
                                                            <!-- <input type="desimal" class="form-control mt-2" name="szQTYFormat" id=""> -->
                                                            <input type="text" class="form-control mt-2" name="szQTYFormat" min="0" value="#,0" step="0.01">
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                        <div class="row">
                                                            <div class="col-md-6 col-12 mt-3">
                                                                <div class="from-group">
                                                                    <label class="mt-3" for="">Harga Satuan </label>

                                                                    <input type="number" id="last-name-column" class="form-control" name="  decPrice">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group mt-3">
                                                                    <label class="mt-3" for="">Satuan Terkecil </label>

                                                                    <br>
                                                                    <select name="szIdProduk" id="" class="form-control">
                                                                        <option value="">-- pilih --</option>
                                                                        <?php foreach ($satuan as $s) { ?>

                                                                            <option value="<?= $s->szId; ?>"><?= $s->szName; ?></option>

                                                                        <?php } ?>

                                                                    </select>



                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="from-group">
                                                                    <label class="mt-3" for="">Tipe item penjualan</label>
                                                                    <select name="szOrderItemtypeId" id="" class="form-control">
                                                                        <option value="">-- Pilih --</option>
                                                                        <?php foreach ($order as $k) { ?>
                                                                            <option value="<?= $k->szId; ?>"><?= $k->szId; ?> - <?= $k->szName; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col">
                                                                <div class="from-group">
                                                                    <label class="mt-3" for="">Default satuan Penjualan</label>
                                                                    <select name="szDefaultUomId" id="" class="form-control">
                                                                        <option value="">-- pilih --</option>
                                                                        <?php foreach ($satuan as $s) { ?>

                                                                            <option value="<?= $s->szId; ?>"><?= $s->szName; ?></option>

                                                                        <?php } ?>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col">
                                                                <div class="from-group">
                                                                    <label class="mt-3" for="">Pajak penjualan</label>
                                                                    <select name="szTaxId" id="" class="form-control">
                                                                        <option value="">-- Pilih --</option>
                                                                        <?php foreach ($tax as $k) { ?>
                                                                            <option value="<?= $k->szId; ?>"><?= $k->szId; ?> - <?= $k->szName; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-check form-check-inline mt-3">
                                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUsePriceWTax" value="1">
                                                                <label class="form-check-label" for="inlineCheckbox1">Harga Termasik Pajak</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                        <div class="col">
                                                            <label class="mt-3" for="">Tipe Kategori</label>
                                                            <input type="text" disabled value="SEGMENTASI HARGA" id="last-name-column" class="form-control" name="TkategoriProduk">
                                                        </div>

                                                        <div class="col">
                                                            <label class="mt-3" for="">Kategori</label>
                                                            <br>
                                                            <select class="form-control" name="szCategoyValue" id="">
                                                                <option value="">-- Pilih --</option>
                                                                <?php foreach ($kat as $k) { ?>
                                                                    <option value="<?= $k->szId; ?>"><?= $k->szId; ?> - <?= $k->szName; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2-tab">
                                                        <div id="kit" class="mt-2">
                                                            <table class='table table-striped view-this'>
                                                                <thead>
                                                                    <tr>
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
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mt-3">
                                                    <button id="btn-produk" class="btn btn-primary btn-sm m-2" type="submit">Save</button>
                                                    <button class="btn btn-outline-primary m-2 btn-sm" type="reset">Reset</button>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                </form>
                            </div>




                        </div>
                        <div class="tab-pane fade tujuh-show" id="v-pills-cari" role="tabpanel" aria-labelledby="v-pills-cari-tab">
                            <input type="hidden" class="val7" value="8" name="">


                            <div style="border-radius:10px,10px,10px; " class="card">
                                <style>
                                    #card {

                                        background-color: #c7c3c3;

                                    }

                                    #card-body {

                                        background-color: #f0eded;

                                    }

                                    button {
                                        float: right;
                                    }
                                </style>

                                <div id="card" class="card-header">
                                    <a href="<?= base_url(); ?>master/tipeStock">Master Data</a>
                                </div>
                                <div id="card-body" class="card-body p-5">
                                    <form class="form">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Start Date</label>
                                                    <input required type="Date" id="first-name-column" class="form-control" name="fname-column">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">End Date</label>
                                                    <input required type="date" id="last-name-column" class="form-control" name="lname-column">
                                                </div>
                                            </div>


                                            <div class="col-sm-12">
                                                <label for="">Produk</label>
                                                <input type="search" required name="" id="" class="form-control">
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="">Tipe Lokasi</label>
                                                <select required name="" id="" class="form-control">
                                                    <option value="">-- Pilih Depo -- </option>

                                                </select>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="">Id lokasi</label>
                                                <input required type="search" name="" id="" class="form-control">
                                            </div>


                                            <div class="col-md-6 col-12">
                                                <label for="">Tipe Stok</label>
                                                <select required name="" id="" class="form-control">
                                                    <option value="">-- Pilih Depo -- </option>

                                                </select>
                                            </div>


                                            <div class="col-md-6 col-12">
                                                <label for="">Depo</label>
                                                <select required name="" id="" class="form-control">
                                                    <option value="">-- Pilih Depo -- </option>

                                                </select>
                                            </div>


                                            <div class="col mt-2">
                                                <label for="">Id SN</label>
                                                <input required type="search" name="" id="" class="form-control">
                                                <!-- <a class="btn btn-outline-primary btn-sm mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Informasi Alamat
                                        </a> -->

                                                <div class="collapse" id="collapseExample">

                                                </div>

                                                <div class="row">
                                                    <div class="col mt-3">
                                                        <button class="btn btn-primary btn-sm m-2" type="submit">Simpan</button>
                                                        <button class="btn btn-outline-primary m-2 btn-sm" type="reset">Reset</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>




                            <div style="border-radius:10px,10px,10px; " class="card">
                                <table class='table table-striped' id="table1">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>ID Satuan</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>BAG</td>
                                            <td>BAG</td>
                                            <td>Aktif</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary btn-sm">Delete</button>

                                                <button type="button" class="btn btn-outline-primary btn-sm">Update</button>

                                                <button type="button" class="btn btn-primary btn-sm">Detail</button>



                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>












                        </div>

                    </div>
                </div>
            </div>
            <script src="<?= base_url(); ?>assets/master/js/jquery-on.js"></script>
            <!-- <script src="<?= base_url(); ?>assets/js/library.js"></script> -->
            <script src="<?= base_url(); ?>assets/master/js/select.js"></script>
            <script>
                // $("#kode_satuan").focus();
                $("#kode_tipe").focus();
                // $("#kode_satuan").focus();







                // $("#kode_satuan").focus();

                // $("kode_satuan").focus();

                document.onkeydown = function(event) {
                    // alert(event.keyCode);
                    switch (event.keyCode) {

                        case 40:

                            // $(".kode_tipe").focus();

                            let a = $(".kuis").val();

                            if (a == 2) {

                                console.log("satu");

                                $(".dua").click();

                                // $("#kode_satuan").focus();

                                $(".val1").removeClass("kuis");
                                $(".val2").addClass("kuis");
                                $(".satu").removeClass("active");
                                $(".tiga").removeClass("active");
                                $(".enam").removeClass("active");
                                $(".lima").removeClass("active");

                                $(".dua").addClass("active");
                                $(".satu-show").removeClass("active");
                                $(".dua-show").addClass("show active ");

                                // $("#form-2").focus();


                            } else if (a == 3) {
                                // console.log(a);

                                console.log("dua");
                                $(".kode_tipe").focus();

                                // $("#dua3").click();
                                $(".tiga").click();
                                $(".val2").removeClass("kuis");
                                $(".val3").addClass("kuis");
                                $(".dua").removeClass("active");
                                $(".tiga").addClass("active");
                                $(".dua-show").removeClass("active");
                                $(".tiga-show").addClass("show active ");

                                // $("#form-3").focus();



                            } else if (a == 4) {
                                $(".empat").click();
                                // console.log(a);
                                console.log("tiga");

                                // $("#dua4").click();
                                $(".val3").removeClass("kuis");
                                $(".val4").addClass("kuis");
                                $(".tiga").removeClass("active");
                                $(".empat").addClass("active");
                                $(".tiga-show").removeClass("active");
                                $(".empat-show").addClass("show active ");
                                // $(".btn-selesai-5").removeClass("selesai");
                                // $("#form-4").focus();


                            } else if (a == 5) {

                                $(".lima").click();
                                // console.log(a);/

                                console.log("empat");

                                // $("#dua5").click();
                                $(".val4").removeClass("kuis");
                                $(".val5").addClass("kuis");
                                $(".empat").removeClass("active");
                                $(".lima").addClass("active");
                                $(".empat-show").removeClass("active");
                                $(".lima-show").addClass("show active ");
                                // $("#form-5").focus();

                            } else if (a == 6) {
                                $(".enam").click();


                                // console.log(a);
                                console.log("lima");

                                // $("#dua1").click();
                                $(".val5").removeClass("kuis");
                                $(".val6").addClass("kuis");
                                $(".lima").removeClass("active");
                                $(".enam").addClass("active");
                                $(".lima-show").removeClass("active");
                                $(".enam-show").addClass("show active ");
                                // $("#form-1").focus();


                            } else if (a == 7) {
                                // console.log("lima");

                                $(".tujuh").click();
                                console.log(a);
                                $(".val6").removeClass("kuis");
                                $(".val7").addClass("kuis");
                                $(".enam").removeClass("active");
                                $(".tujuh").addClass("active");
                                $(".enam-show").removeClass("active");
                                $(".tujuh-show").addClass("show active ");
                                $(".lima").removeClass("active");


                            } else if (a == 8) {
                                console.log("lima");

                                $(".satu").click();
                                // console.log(a);
                                $(".val7").removeClass("kuis");
                                $(".val1").addClass("kuis");
                                $(".tujuh").removeClass("active");
                                $(".satu").addClass("active");
                                $(".tujuh-show").removeClass("active");
                                $(".satu-show").addClass("show active ");
                                $(".lima").removeClass("active");


                            }

                            event.preventDefault();
                            break;





                    }
                }


                // event.preventDefault();
                // teziger.preventDefault();









                // $("kode_satuan").focus()
                function gudangIsi(x) {

                    var isi = $("#gudang").val();

                    // console.log(x);
                    $("#gudangTarget").val(x);

                }




                $(".theSelect").select2();
                $(".theSelect2").select2();
                $(".theSelect3").select2();
                $(".theSelect4").select2();


                function getFormKota() {
                    var status = document.getElementById('Provinsi').value;
                    // alert(status);
                    $.ajax({
                        url: "<?= base_url('kendaraan/get_kota') ?>",
                        method: "POST",
                        data: {
                            status: status
                        },
                        async: true,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data)
                            var content = document.getElementById("idkota");
                            content.innerHTML = "";

                            var template = (row) => `  
                        <option value="${row.szCity}">${row.szCity}</option>
                    `

                            var test = '<option>Pilih Kota</option>'
                            content.insertAdjacentHTML('beforeend', test);

                            for (var row of data) {
                                var element = template(row);
                                content.insertAdjacentHTML('beforeend', element);
                            }
                        }
                    })
                }

                function getFormKecamatan() {
                    var statusKecamatan = document.getElementById('idkota').value;
                    // alert(status);
                    $.ajax({
                        url: "<?= base_url('kendaraan/get_kecamatan') ?>",
                        method: "POST",
                        data: {
                            status: statusKecamatan
                        },
                        async: true,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data)
                            var content = document.getElementById("idkecamatan");
                            content.innerHTML = "";

                            var template = (row) => `  
                        <option value="${row.szDistrict}">${row.szDistrict}</option>
                    `


                            var test = '<option>Pilih Kecamatan</option>'
                            content.insertAdjacentHTML('beforeend', test);


                            for (var row of data) {
                                var element = template(row);
                                content.insertAdjacentHTML('beforeend', element);
                            }
                        }
                    })
                }


                function getFormKelurahan() {
                    var statusKelurahan = document.getElementById('idkecamatan').value;
                    // alert(status);
                    $.ajax({
                        url: "<?= base_url('kendaraan/get_kelurahan') ?>",
                        method: "POST",
                        data: {
                            status: statusKelurahan
                        },
                        async: true,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data)
                            var content = document.getElementById("idkelurahan");
                            content.innerHTML = "";

                            var template = (row) => `  
                        <option value="${row.szSubDistrict}">${row.szSubDistrict}</option>
                    `


                            var test = '<option>Pilih Kelurahan</option>'
                            content.insertAdjacentHTML('beforeend', test);


                            for (var row of data) {
                                var element = template(row);
                                content.insertAdjacentHTML('beforeend', element);
                            }
                        }
                    })
                }


                function getFormkode() {
                    var statusKode = document.getElementById('idkelurahan').value;
                    var statuskecamatan = document.getElementById('idkecamatan').value;
                    // alert(status);
                    $.ajax({
                        url: "<?= base_url('kendaraan/get_kode') ?>",
                        method: "POST",
                        data: {
                            status: statusKode,
                            status_dua: statuskecamatan
                        },
                        async: true,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data)
                            var content = document.getElementById("idkode");
                            content.innerHTML = "";

                            var template = (row) => `  
                    <option value="${row.szZipCode}">${row.szZipCode}</option>

                    `



                            // $('#idkode').val(data.szZipCode);

                            for (var row of data) {
                                var element = template(row);
                                content.insertAdjacentHTML('beforeend', element);
                            }

                        }
                    })
                }







                $('.showit').hide();
                $('#kit').hide();

                function alamat(x) {

                    var aa = $('#idchek').prop('checked');


                    if (aa == true) {

                        $('.showit').show();
                        $('#Provinsi').prop('required', true);
                        $('#idkota').prop('required', true);
                        $('#idkecamatan').prop('required', true);
                        $('#idkelurahan').prop('required', true);




                    } else {

                        $('.showit').hide();
                        $('#Provinsi').prop('required', false);
                        $('#idkota').prop('required', false);
                        $('#idkecamatan').prop('required', false);
                        $('#idkelurahan').prop('required', false);


                    }

                }


                function kitT(x) {

                    var bb = $('#idkit').prop('checked');


                    if (bb == true) {

                        $('#kit').show();


                    } else {

                        $('#kit').hide();

                    }

                }


                $('#add_sub').click(function() {
                    var i = 1;
                    i++;

                    // $('#dynamic_field_sub').append('<tr id="row' + i + '" class="dynamic-added_pelatihan">   <td><input type="text" name="" id="" class="form-control"></td> <td><input type="text" name="" id="" class="form-control"></td> <td><input type="text" name="" id="" class="form-control"></td><td><input type="text" name="" id="" class="form-control"></td> <td><button type="button" id="' + i + '" class="btn btn-danger btn_remove">-</button></td></tr>');

                    $('#dynamic_field_sub').append('<tr id="row' + i + '" class="dynamic-added_pelatihan">    <td><input type="text" name="produkKit[]" id="" class="form-control"></td><td><input type="text" name="kuantitiKit[]" id="" class="form-control"></td><td><input type="text" name="SatuanKit[]" id="" class="form-control"></td><td><button type="button" id="' + i + '" class="btn btn-danger btn_remove">-</button></td></tr>');


                });

                $(document).on('click', '.btn_remove', function() {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id).remove();
                    console.log(button_id);
                });



                function kitProduk(x) {
                    // var szIdkit = $('#idKode' + x).value;
                    var szIdkit = document.getElementById('idKode' + x).value;

                    // console.log(szIdkit);
                    function data() {

                        $.ajax({
                            url: "<?= base_url('master/get_produk_satuan') ?>",
                            method: "POST",
                            data: {
                                'id': szIdkit
                            },
                            dataType: "JSON",
                            success: function(data) {

                                console.log(data);


                                var number = 1;
                                var html = '';
                                var loop = 0;

                                for (var row of data) {
                                    document.getElementById("satuankit" + x).value = row.szUomId;

                                }



                            },
                        });
                    }
                    data();



                }



                var counter = 0;
                // var counter = 0;
                // $("#notif" + counter).hide();
                var num = 1;
                var code = 0;

                function loadnew() {
                    var count = this.code;
                    var newrow = $(".view-this");
                    var cols = "";
                    cols += "<tr id='baris" + count + "'>";
                    cols += "<td>";
                    cols += "<select class='js-example-basic-single form-select form-control' name='idKit[]' id='idKode" + count + "' required onchange='kitProduk(" + count + ")' '>";
                    cols += "<option value='-'>Pilih Produk</option>";
                    cols += "<option value=''></option>";
                    cols += "<?php foreach ($produk as $value) { ?>";
                    cols += "<option value='<?= $value->szId; ?>'><?= $value->szId; ?> - <?= $value->szName; ?></option>";
                    cols += "<?php } ?>";
                    cols += "</select>";
                    cols += "</td>";
                    cols += "<td>";
                    cols += "<input name='kuantitiKit[]' type='text' id='idQty" + count + "' class='form-control' onkeypress='return hanyaAngka(event)' autocomplete='off' required  onchange='getInfo(" + count + ")'>";
                    cols += "</td>";
                    cols += "<td>";
                    cols += "<input name='SatuanKit[]' type='text' id='satuankit" + count + "' class='form-control' readonly>";
                    cols += "</td>";
                    cols += "<td>";
                    cols += "<a class='btn btn-danger' onclick='deleteRow(" + count + ")' style='color: white;'>-</a>";
                    cols += "</td>";
                    cols += "</tr>";
                    newrow.append(cols);
                    $("row").append(newrow);
                    $(".js-example-basic-single").select2();
                    // $("#notif" + count).hide();
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

                function hanyaAngka(event) {
                    var angka = (event.which) ? event.which : event.keyCode
                    if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                        return false;
                    return true;
                }





                function valid_satuan(x) {

                    // var statustipeKendaraan = document.getElementById('ktk').value;
                    // alert(status);
                    $.ajax({
                        url: "<?= base_url('master/get_satuan_valid') ?>",
                        method: "POST",
                        data: {
                            inv: x,
                        },
                        async: true,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data)

                            var contenttipe = document.getElementById("notifsatuan");

                            element = "";
                            if (data != 0) {
                                contenttipe.innerHTML = "<p class='text-danger' ><b>Kode Satuan Sudah ada</b></p>";

                                contenttipe.insertAdjacentHTML('beforeend', element);
                                var xa = document.getElementById("btn-satuan");
                                xa.disabled = true;

                                // $('#btn-satuan').attr('disabled');


                            } else {

                                contenttipe.innerHTML = "";

                                contenttipe.insertAdjacentHTML('beforeend', element);
                                $('#btn-satuan').prop('disabled', false);


                            }

                            // var template = (row) => `  
                            // <option value="${row.szZipCode}">${row.szZipCode}</option>

                            // `

                            // $('#idkode').val(data.szZipCode);

                            // for (var row of data) {
                            //     var element = template(row);
                            //     content.insertAdjacentHTML('beforeend', element);
                            // }

                        }
                    })


                }




                function valid_tipestok(x) {

                    // var statustipeKendaraan = document.getElementById('ktk').value;
                    // alert(status);
                    $.ajax({
                        url: "<?= base_url('master/get_tipestok_valid') ?>",
                        method: "POST",
                        data: {
                            inv: x,
                        },
                        async: true,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data)

                            var contenttipe = document.getElementById("notiftipestok");
                            element = "";

                            if (data != 0) {

                                contenttipe.innerHTML = "<p class='text-danger' ><b>Kode Tipe stok Sudah ada</b></p>";

                                contenttipe.insertAdjacentHTML('beforeend', element);
                                $('#btn-tipestok').prop('disabled', true);


                            } else {

                                contenttipe.innerHTML = "";

                                contenttipe.insertAdjacentHTML('beforeend', element);
                                $('#btn-tipestok').prop('disabled', false);


                            }

                            // var template = (row) => `  
                            // <option value="${row.szZipCode}">${row.szZipCode}</option>

                            // `

                            // $('#idkode').val(data.szZipCode);

                            // for (var row of data) {
                            //     var element = template(row);
                            //     content.insertAdjacentHTML('beforeend', element);
                            // }

                        }
                    })


                }


                function valid_gudang(x) {

                    // var x = document.getElementById('gudang').value;
                    // alert(status);
                    $.ajax({
                        url: "<?= base_url('master/get_gudang_valid') ?>",
                        method: "POST",
                        data: {
                            inv: x,
                        },
                        async: true,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data)

                            var gudangnotif = document.getElementById("notifgudang");
                            element = "";

                            if (data != 0) {

                                gudangnotif.innerHTML = "<p class='text-danger' ><b>Kode Gudang Sudah ada</b></p>";

                                gudangnotif.insertAdjacentHTML('beforeend', element);
                                $('#btn-gudang').prop('disabled', true);



                            } else {

                                gudangnotif.innerHTML = "";

                                gudangnotif.insertAdjacentHTML('beforeend', element);

                                $('#btn-gudang').prop('disabled', false);


                            }

                            // var template = (row) => `  
                            // <option value="${row.szZipCode}">${row.szZipCode}</option>

                            // `

                            // $('#idkode').val(data.szZipCode);

                            // for (var row of data) {
                            //     var element = template(row);
                            //     content.insertAdjacentHTML('beforeend', element);
                            // }

                        }
                    })


                }


                function valid_kategori(x) {

                    // var x = document.getElementById('gudang').value;
                    // alert(status);

                    $.ajax({
                        url: "<?= base_url('master/get_kategori_valid') ?>",
                        method: "POST",
                        data: {
                            inv: x,
                        },
                        async: true,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data)

                            var gudangnotif = document.getElementById("notifkategori");
                            element = "";

                            if (data != 0) {

                                gudangnotif.innerHTML = "<p class='text-danger' ><b>Kode Kategori Sudah ada</b></p>";

                                gudangnotif.insertAdjacentHTML('beforeend', element);
                                $('#btn-kategori').prop('disabled', true);


                            } else {

                                gudangnotif.innerHTML = "";

                                gudangnotif.insertAdjacentHTML('beforeend', element);


                            }

                            // var template = (row) => `  
                            // <option value="${row.szZipCode}">${row.szZipCode}</option>

                            // `

                            // $('#idkode').val(data.szZipCode);

                            // for (var row of data) {
                            //     var element = template(row);
                            //     content.insertAdjacentHTML('beforeend', element);
                            // }

                        }
                    })


                }




                function valid_tipekategori(x) {

                    // var x = document.getElementById('gudang').value;
                    // alert(status);

                    $.ajax({
                        url: "<?= base_url('master/get_tipekategori_valid') ?>",
                        method: "POST",
                        data: {
                            inv: x,
                        },
                        async: true,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data)

                            var gudangnotif = document.getElementById("notiftipekategori");
                            element = "";

                            if (data != 0) {

                                gudangnotif.innerHTML = "<p class='text-danger' ><b>Kode tipe Kategori Sudah ada</b></p>";

                                gudangnotif.insertAdjacentHTML('beforeend', element);
                                $("#btn-tipekategori").prop("disabled", true);

                            } else {

                                gudangnotif.innerHTML = "";

                                gudangnotif.insertAdjacentHTML('beforeend', element);
                                $("#btn-tipekategori").prop("disabled", false);


                            }

                            // var template = (row) => `  
                            // <option value="${row.szZipCode}">${row.szZipCode}</option>

                            // `

                            // $('#idkode').val(data.szZipCode);

                            // for (var row of data) {
                            //     var element = template(row);
                            //     content.insertAdjacentHTML('beforeend', element);
                            // }

                        }
                    })


                }


                function valid_produk(x) {

                    // var x = document.getElementById('gudang').value;
                    // alert(status);

                    $.ajax({
                        url: "<?= base_url('master/get_produk_valid') ?>",
                        method: "POST",
                        data: {
                            inv: x,
                        },
                        async: true,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data)

                            var gudangnotif = document.getElementById("notifproduk");
                            element = "";

                            if (data != 0) {

                                gudangnotif.innerHTML = "<p class='text-danger' ><b>Kode Produk Sudah ada</b></p>";

                                gudangnotif.insertAdjacentHTML('beforeend', element);
                                $("#btn-produk").prop("disabled", true);



                            } else {

                                gudangnotif.innerHTML = "";

                                gudangnotif.insertAdjacentHTML('beforeend', element);
                                $("#btn-produk").prop("disabled", false);



                            }

                            // var template = (row) => `  
                            // <option value="${row.szZipCode}">${row.szZipCode}</option>

                            // `

                            // $('#idkode').val(data.szZipCode);

                            // for (var row of data) {
                            //     var element = template(row);
                            //     content.insertAdjacentHTML('beforeend', element);
                            // }

                        }
                    })


                }









                <?php if ($segment == 1) { ?>


                    $('#v-pills-home-tab').addClass('active');
                    $('#v-pills-profile-tab').removeClass('active');

                    // $('#v-pills-profile').removeClass("active");
                    $('#v-pills-home').addClass('active');
                    // $('#v-pills-home').addClass('fade');


                <?php } ?>

                <?php if ($segment == 2) { ?>

                    // $(this).removeClass('active');
                    $('#v-pills-home-tab').removeClass('active');
                    $('#v-pills-profile-tab').addClass('active');
                    // $('#v-pills-profile').addClass('active');
                    $('#v-pills-profile').addClass("active");
                    $('#v-pills-home').removeClass('active');
                    $('#v-pills-home').addClass('fade');

                <?php } ?>
                <?php if ($segment == 3) { ?>

                    $(this).removeClass('active');
                    $('#v-pills-messages-tab').addClass('active');
                    $('#v-pills-home-tab').removeClass('active');

                    $('#v-pills-messages').addClass('active');
                    $('#v-pills-home').removeClass('active');


                <?php } ?>
                <?php if ($segment == 4) { ?>

                    $(this).removeClass('active');
                    $('#v-pills-settings-tab').addClass('active');
                    $('#v-pills-home-tab').removeClass('active');

                    $('#v-pills-settings').addClass('active');
                    $('#v-pills-home').removeClass('active');


                <?php } ?>
                <?php if ($segment == 5) { ?>

                    $(this).removeClass('active');
                    $('#v-pills-delapan-tab').addClass('active');
                    $('#v-pills-home-tab').removeClass('active');

                    $('#v-pills-delapan').addClass('active');
                    $('#v-pills-home').removeClass('active');


                <?php } ?>
                <?php if ($segment == 6) { ?>

                    $(this).removeClass('active');
                    $('#v-pills-stok-tab').addClass('active');
                    $('#v-pills-home-tab').removeClass('active');

                    $('#v-pills-stok').addClass('active');
                    $('#v-pills-home').removeClass('active');


                <?php } ?>






                $("#tab nav a").click(function() {

                    const id = $(this).data('id');
                    if (!$(this).hasClass('active')) {
                        $("#tab nav a").removeClass('active');
                        $(this).addClass('active');

                        $('.tab-content').hide();
                        $(`[data-content=${id}]`).fadeIn();
                    }
                });
            </script>
            <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->