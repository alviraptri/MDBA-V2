

<?php 
// $this->load->library("guzzle");
require 'vendor/autoload.php';
use GuzzleHttp\Client;

?>
<link href="<?= base_url(); ?>assets/master/css/select.css" rel="stylesheet" />

<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Master Kendaraan</h3>
    </div>

    <div style="border-radius:10px;" class="card mt-5 p-5">
        <div class="row">
            <div class="row">
                <div class="col-3">

                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">

                        <a class="nav-link satu " id="v-pills-home-tab" data-bs-toggle="pill"
                            href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">Kendaraan</a>
                        <a class="nav-link dua" id="v-pills-profile-tab" data-bs-toggle="pill"
                            href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                            aria-selected="false">Tipe Kendaraan</a>
                        <a class="nav-link tiga" id="v-pills-messages-tab" data-bs-toggle="pill"
                            href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                            aria-selected="false">Ekspedisi</a>

                       
                    </div>
                </div>
                <div class="col-9">

                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane  show  satu-show" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
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

                                <div id="card" class="card-header">
                                <a href="<?= base_url();?>kendaraan/master_kendaraan">Master Data</a>  
                                </div>
                                <div id="card-body" class="card-body p-5">
                                <?php echo $this->session->flashdata('massage');?>
                                <input type="hidden" class="val1 kuis" value="2" name="">

                                    <form method="post" action="<?= base_url();?>kendaraan/insertKendaraan" >
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kode Kendaraan</label>
                                                    <input type="text" required onchange="valid_ajax(this.value)"  id="Kkendaraan" class="form-control" name="Kkendaraan">
                                                    <div id="notifkendaraan"></div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Cabang</label>
                                                    <!-- <input type="text" id="last-name-column" class="form-control" name="szBranchId"> -->
                                                    <select  class="form-control " name="szBranchId">    
                                                        <option value="<?= $_SESSION['user_branch'];?>" ><?= $_SESSION['user_lokasi'];?> </option>
                                            
                                                    </select>
                                             

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Jenis Kendaraan</label>
                                                    <!-- <input requred type="text" id="first-name-column" class="form-control" name="szVehicleTypeId"> -->
                                                    <select readonly name="szVehicleTypeId" class='form-control'> 
                                                                        <option value="">-- Pilih kendaraan --</option>
                                                                            <?php foreach ($kendaraan as $s){?> 
                                                                            <option><?= $s->szName;?></option>
                                                                            <?php }?>
                                                                        </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">No Polisi</label>
                                                    <input type="text" required  id="last-name-column" class="form-control" name="Nkendaraan">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">No Rangka</label>
                                                    <input type="text" required id="first-name-column" class="form-control" name="szChassisNo">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">No Mesin</label>
                                                    <input type="text" required id="last-name-column" class="form-control" name="szMachineNo">
                                                </div>
                                            </div>
                                    <div class="col">
                                        <label for="">Keterangan</label>
                                        <textarea required name="ketKendaraan" class="form-control" id="" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="col">
                                        <label for="">Tanggal Berakhir STNK</label>
                                        <!-- <textarea name="" class="form-control" id="" cols="30" rows="5"></textarea> -->
                                        <input required type="date" name="dtmVehicleLicense" id="" class="form-control">
                                    </div>
                                        <div class="row">
                                            <div class="col mt-3">
                                                <button id="btn-kendaraan" class="btn btn-primary btn-sm m-2" type="submit">Save</button>
                                                <button class="btn btn-outline-primary m-2 btn-sm" type="reset">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="tab-pane  dua-show" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">

                            <input type="hidden" class="val2 kuis" value="3" name="">

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
                                 <a href="<?= base_url();?>kendaraan/Tipekendaraan">Master Data</a> 
                                </div>
                                <div id="card-body" class="card-body p-5">
                                <form method="post" action="<?= base_url();?>kendaraan/insertTipekendaraan" >

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kode Tipe Kendaraan</label>
                                                    <input required type="text" id="Ktk" onchange="valid_tipe(this.value)" class="form-control" name="Ktk">
                                                    <div id="notiftipe"></div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Nama Tipe Kendaraan</label>
                                                    <input required type="text" id="last-name-column" class="form-control" name="Ntk">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Max Berat</label>
                                                    <input required type="number" id="first-name-column" class="form-control" name="max">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Volume</label>
                                                    <input required type="number" id="last-name-column" class="form-control" name="vol">
                                                </div>
                                            </div>
                                    <div class="col">
                                        <label for="">Keterangan</label>
                                        <textarea required name="ketKendaraan" class="form-control" id="" cols="30" rows="5"></textarea>
                                        <div class="row">
                                            <div class="col mt-3">
                                                <button id="btn-tipe"  class="btn btn-primary btn-sm m-2" type="submit">Save</button>
                                                <button class="btn btn-outline-primary m-2 btn-sm" type="reset">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                        <div class="tab-pane   tiga-show" id="v-pills-messages" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">
                            <div style="border-radius:10px,10px,10px; " class="card">
                            <input type="hidden" class="val3 kuis" value="4" name="">

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
                                 <a href="<?= base_url();?>kendaraan/ekpedisi">Master Data</a> 
                                </div>

                                <form action="<?= base_url();?>kendaraan/insertEkspedisi" method="post">


                                <div id="card-body" class="card-body p-5">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kode Ekspedisi</label>
                                                    <input required type="text" onchange="valid_ekpedisi(this.value)" id="Ke" class="form-control" name="Ke">
                                                    <div id="notifekpedisi"></div>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Nama Ekspedisi</label>
                                                    <input required type="text" id="last-name-column" class="form-control" name="Ne">
                                                </div>
                                            </div>

                                    <div class="col mt-2">

                                        <label for="">Keterangan</label>
                                        <textarea  required name="ketekpedisi" class="form-control" id="" cols="30" rows="5"></textarea>

                                        <!-- <a class="btn btn-outline-primary btn-sm mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Informasi Alamat
                                        </a> -->

                                    </div>


                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                   <br>
                                        <li class="nav-item" role="presentation">
                                            <br>
                                           <label for="">Informasi Alamat</label>
                                           <br>
                                                <!-- <input type="radio" value="1" onchange="alamat(this.value)"  name="test" id="kk"> Ada
                                                <input type="radio" value="0" onchange="alamat(this.value)" name="test" id="kk">TIdak -->
                                                <input class="form-check-input" type="checkbox" value="1" onchange="alamat(this.value)" id="idchek" >

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
                                            <select name="szProvince" id="Provinsi" onchange="getFormKota()"  class=" theSelect select2-data-array browser-default form-control" id="">

                                            <option value="">--  Pilih Provinsi -- </option>
                                                <?php foreach($provinsi as $p){?>
                                                <option value="<?= $p->szProvince;?>"><?= $p->szProvince;?></option>
                                                <?php }?>

                                            </select>

                                            </div>



                                            
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                               
                                                    <label> Kabupaten </label>
                                                    <br>

                                                <select onchange="getFormKecamatan()" name="szCity" class=" theSelect2 select2-data-array browser-default form-control" id="idkota" >
                                                    <option value="">-- Pilih kota -- </option>
                                                    <option value=""></option>

                                                </select>
                                        
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <!-- <input type="text" id="last-name-column" class="form-control" name="lname-column"> -->
                                             
                                                    <label> Kecamatan </label>
                                                    <br>
                                                    <select onchange="getFormKelurahan()" name="szDistrict" id="idkecamatan" class=" theSelect3 select2-data-array browser-default form-control" >
                                                    <option value="">-- Pilih kecamatan --</option>
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
                                                         <option value=""> -- Pilih Kelurahan -- </option>
                                                         <option value=""></option>
                                                        </select>
                                        
                                                </div>
                                            </div>


                                    <div class="col-sm-12">
                                        <label for="">Kode pos</label>
                                        <select name="szZipCode" class=" select2-data-array browser-default form-control" id="idkode">
                                            <option value="" ></option>
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
                                <div class="row">
                                            <div class="col mt-3">
                                                <button id="btn-ekpedisi"  class="btn btn-primary btn-sm m-2" type="submit">Save</button>
                                                <button class="btn btn-outline-primary m-2 btn-sm" type="reset">Reset</button>
                                            </div>
                                        </div>
                            </form>
                        </div>
                    </div>

                 
                    









                        </div>
            
        </div>
</div>
</div>
<script src="<?= base_url(); ?>assets/master/js/jquery-on.js"></script>
<script src="<?= base_url(); ?>assets/master/js/library.js"></script>
<script src="<?= base_url(); ?>assets/master/js/select.js"></script>
<script>

                    // $("kode_satuan").focus()
        function gudangIsi(x){

        var isi = $("#gudang").val();

// console.log(x);
        $("#gudangTarget").val(x);

        }
         

        

		$(".theSelect").select2();
		$(".theSelect2" ).select2();
		$(".theSelect3" ).select2();
		$(".theSelect4" ).select2();
                  


        function getFormKota()
        {
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

                        var test = '<option>-- Pilih kota -- </option>'
                        content.insertAdjacentHTML('beforeend', test);
                    for (var row of data) {
                        var element = template(row);
                        content.insertAdjacentHTML('beforeend', element);
                    }

                }
            })
        }

        function getFormKecamatan()
        {
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

                    var test = '<option>-- Pilih kecamatan -- </option>'
                        content.insertAdjacentHTML('beforeend', test);
                    for (var row of data) {
                        var element = template(row);
                        content.insertAdjacentHTML('beforeend', element);
                    }
                }
            })
        }


        function getFormKelurahan()
        {
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

                    var test = '<option>-- Pilih Kelurahan -- </option>'
                        content.insertAdjacentHTML('beforeend', test);

                    for (var row of data) {
                        var element = template(row);
                        content.insertAdjacentHTML('beforeend', element);
                    }
                }
            })
        }


        function getFormkode()
        {
            var statusKode = document.getElementById('idkecamatan').value;
            var statuskelurahan = document.getElementById('idkelurahan').value;
            // alert(status);
            $.ajax({
                url: "<?= base_url('kendaraan/get_kode') ?>",
                method: "POST",
                data: {
                    status_dua: statusKode,
                    status: statuskelurahan
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









        // $(document).ready(function(){  


        //     $(this).keydown(function(e) {
        //         if (e.keyCode == 13) {
        //             e.preventDefault();
        //             tampil_data_produk();
        //             tampil_nama_kit();
        //         }
        //     });

        // });








$('.showit').hide();

function alamat(x){

 var aa = $('#idchek').prop( 'checked' );


    if (aa == true){
        
        $('.showit').show();
                $('#Provinsi').prop('required',true); 
                $('#idkota').prop('required',true);  
                $('#idkecamatan').prop('required',true);    
                $('#idkelurahan').prop('required',true);      
  
        
        
    } else {
        
        $('.showit').hide();
                $('#Provinsi').prop('required',false); 
                $('#idkota').prop('required',false);  
                $('#idkecamatan').prop('required',false);    
                $('#idkelurahan').prop('required',false); 

    }

}

    document.onkeydown = function (event) {
    switch (event.keyCode) {
    
        case 40:

            let a = $(".kuis").val();
            if( a == 2 ){

                console.log("satu");
                
                $(".dua").click();

                $("#kode_tipe").focus();
        
                $(".val1").removeClass("kuis");
                $(".val2").addClass("kuis");
                $(".satu").removeClass("active");
                // $(".tiga").removeClass("active");
                // $(".enam").removeClass("active");
                // $(".lima").removeClass("active");

                $(".dua").addClass("active");
                $(".satu-show").removeClass("active");
                $(".dua-show").addClass("show active ");
                
                // $("#form-2").focus();

                
            }else if(a == 3){
                // console.log(a);

                console.log("dua");
                // $(".kode_tipe").focus();
                
                // $("#dua3").click();
                $(".tiga").click();
                $(".val2").removeClass("kuis");
                $(".val3").addClass("kuis");
                $(".dua").removeClass("active");
                $(".tiga").addClass("active");
                $(".dua-show").removeClass("active");
                $(".tiga-show").addClass("show active ");

                // $("#form-3").focus();

                
                
            }else if (a == 4 ){
                $(".satu").click();
                // console.log(a);
                console.log("tiga");
                
                $(".val3").removeClass("kuis");
                $(".val1").addClass("kuis");
                $(".tiga").removeClass("active");
                $(".satu").addClass("active");
                $(".tiga-show").removeClass("active");
                $(".satu-show").addClass("show active ");
                    
            }

            event.preventDefault();
            break;

    }
 }

 function valid_ajax(){

            var statusKendaraan = document.getElementById('Kkendaraan').value;
            // alert(status);
            $.ajax({
                url: "<?= base_url('kendaraan/get_kendaran_valid') ?>",
                method: "POST",
                data: {
                    kendaraan: statusKendaraan ,
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    console.log(data)

                    var content = document.getElementById("notifkendaraan");
                    element = "" ;
                    if (data != 0 ){
                        content.innerHTML = "<p class='text-danger' ><b>Kode Kendaraan Sudah ada</b></p>";

                        content.insertAdjacentHTML('beforeend', element);
                        $("#btn-kendaraan").prop("disabled", true);
                        
                    }else{
                        
                        content.innerHTML = "";
                        
                        content.insertAdjacentHTML('beforeend', element);
                        $("#btn-kendaraan").prop("disabled", false);
                        

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

 function valid_tipe(x){

            // var statustipeKendaraan = document.getElementById('ktk').value;
            // alert(status);
            $.ajax({
                url: "<?= base_url('kendaraan/get_tipeKendaraan_valid') ?>",
                method: "POST",
                data: {
                    kendaraan: x ,
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    console.log(data)

                    var contenttipe = document.getElementById("notiftipe");
                    element = "";
                    if (data != 0 ){

                        contenttipe.innerHTML = "<p class='text-danger' ><b>Kode Tipe Kendaraan Sudah ada</b></p>";

                        contenttipe.insertAdjacentHTML('beforeend', element);
                        $("#btn-tipe").prop("disabled",true);

                        
                    }else{
                        
                        contenttipe.innerHTML = "";

                        contenttipe.insertAdjacentHTML('beforeend', element);
                        $("#btn-tipe").prop("disabled",false);


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







 function valid_ekpedisi(x){

        // var statustipeKendaraan = document.getElementById('ktk').value;
        // alert(status);
        $.ajax({
            url: "<?= base_url('kendaraan/get_ekspedisi_valid') ?>",
            method: "POST",
            data: {
                kendaraan: x ,
            },
            async: true,
            dataType: "JSON",
            success: function(data) {
                console.log(data)

                var contenttipe = document.getElementById("notifekpedisi");
                element = "";
                if (data != 0 ){

                    contenttipe.innerHTML = "<p class='text-danger' ><b>Kode Ekspedisi Sudah ada</b></p>";

                    contenttipe.insertAdjacentHTML('beforeend', element);
                    $("#btn-ekpedisi").prop("disabled",true);
                    
                }else{
                    
                    contenttipe.innerHTML = "";
                    
                    contenttipe.insertAdjacentHTML('beforeend', element);
                    $("#btn-ekpedisi").prop("disabled",false);


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






<?php if ($segment == 1 ){?>


$('#v-pills-home-tab').addClass('active');
$('#v-pills-profile-tab').removeClass('active');

// $('#v-pills-profile').removeClass("active");
$('#v-pills-home').addClass('active');
// $('#v-pills-home').addClass('fade');


<?php }?>

<?php if ($segment == 2 ){?>

// $(this).removeClass('active');
$('#v-pills-home-tab').removeClass('active');
$('#v-pills-profile-tab').addClass('active');
// $('#v-pills-profile').addClass('active');
$('#v-pills-profile').addClass("active");
$('#v-pills-home').removeClass('active');
$('#v-pills-home').addClass('fade');

<?php }?>
<?php if ($segment == 3 ){?>

$(this).removeClass('active');
$('#v-pills-messages-tab').addClass('active');
$('#v-pills-home-tab').removeClass('active');

$('#v-pills-messages').addClass('active');
$('#v-pills-home').removeClass('active');


<?php }?>




// $("#tab nav a").click(function(){
    
//   const id = $(this).data('id');
//   if(!$(this).hasClass('active')){
//     $("#tab nav a").removeClass('active');
//     $(this).addClass('active');
    
//     $('.tab-content').hide();
//     $(`[data-content=${id}]`).fadeIn();
//   }
// });









</script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
 