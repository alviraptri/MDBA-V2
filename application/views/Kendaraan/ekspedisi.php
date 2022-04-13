<?php

$a = count($tipe);
// echo $a;
// die;

?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/master/css/select.css">

<style>

    .select2-container{
        
        z-index:1000000;
        
    }
    .select2-container .select2-selection--single {
        height: 2.5em !important;
        
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 2.5em !important;
        }


    </style>

<link href="<?=base_url();?>assets/css/select.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/master/css/chosen.css">




<div class="main-content container-fluid">
    <div class="page-title">

    <section class="section">
        <div class="card">

            <div class="card-header">
            <?php echo $this->session->flashdata('massage');?>
  

                                               
                <div class="row">
                    <div class="col">

                        <a href="<?= base_url()?>kendaraan?id=3">NEW FORM</a>  
                    </div>
                    <div class=" col-sm-3 text-right">
                        <select style="float:right;" name="statusKendaraan" class="form-select  " id="filterKendaraan">
                          <option value="">Status Produk</option>
                          <option value="1">Aktif</option>
                          <option value="0">Tidak Aktif</option>
                      </select>

                    </div>

                </div>

            </div>
            <div class="card-body">
                <table class='table table-striped' id="kendaraan">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Kode Ekpedisi</th>
                            <th>Nama Ekpedisi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </section>
</div>


</div>
</div>




                                <?php
                                $i = 0;
                                 foreach ($tipe as $d){?>
                                    
                                        <div class="modal fade text-left" id="large<?=$d->szId;?>" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel17">Detail</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                        <div class="container">
                                                        <div class="row">

                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Kode Ekspedisi</label>
                                                                    <input type="text" readonly id="first-name-column" value="<?= $d->szId;?>" class="form-control" name="Kekspedisi">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="last-name-column">Nama Ekspedisi</label>
                                                                    <input readonly type="text" id="last-name-column" value="<?= $d->szName;?>" class="form-control" name="Nekspedisi">
                                                                </div>
                                                            </div>


                                         
                                                    <div class="col mt-2">

                                                        <label for="">Keterangan</label>
                                                        <textarea readonly name="ketekpedisi" class="form-control" id="" cols="30" rows="5"><?= $d->szDescription;?></textarea>

                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <input type="hidden" id="gudangTarget" value="" name="szId">

                                                                    <label for="first-name-column">Alamat</label>
                                                                    <textarea disabled type="text" id="first-name-column" class="form-control" name="szaddress"><?= $d->szAddress;?></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                <label for="">Provinsi</label>
                                                                <br>
                                        
                                                                    <!-- <input type="text" id="last-name-column" class="form-control" name="lname-column"> -->
                                                                    <input disabled type="text" id="szIdTipe" value="<?=$d->szProvince;?>" class="form-control" name="fname-column">
                                                             </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                            
                                                                    <label> Kabupaten </label>
                                                                    <br>

                                                                <input disabled type="text" id="szIdTipe" value="<?=$d->szCity;?>" class="form-control" name="fname-column">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <!-- <input type="text" id="last-name-column" class="form-control" name="lname-column"> -->
                                                            
                                                                    <label> Kecamatan </label>
                                                                    <input disabled type="text" id="szIdTipe" value="<?=$d->szDistrict;?>" class="form-control" name="fname-column">
                                                                    <br>
                                                                    
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <!-- <input type="text" id="last-name-column" class="form-control" name="lname-column"> -->
                                                                    
                                                                    
                                                                        <label> Kelurahan </label>
                                                                        <br>
                                                                    <input disabled type="text" id="szIdTipe" value="<?=$d->szSubDistrict;?>" class="form-control" name="fname-column">
                                                                            
                                                        
                                                                </div>
                                                            </div>


                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <label for="">Kode pos</label>
                                                    <input type="text" disabled value="<?= $d->szZipCode;?>" name="szZipCode" id="" class="form-control">
                                                    </div>  
                                                    </div>  
                                            </div>

                                                    <div class="row">
                                                        <div class="col-sm">
                                                        <div class="form-group">

                                                        <label for="">No telp 1</label>
                                                        <input type="text" disabled value="<?= $d->szPhone1;?>" name="szZipCode" id="" class="form-control">
                                                        
                                                        </div>
                                                        </div>
                                                        <div class="col-sm">
                                                        <div class="form-group">
                                                        <label for="">No telp 2</label>

                                                        <input type="text" disabled value="<?= $d->szPhone2;?>" name="szZipCode" id="" class="form-control">
                                                        
                                                    </div>
                                                    </div>

                                                    <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="">No telp 3</label>
                                                        <input type="text" disabled value="<?= $d->szPhone3;?>" name="szZipCode" id="" class="form-control">
                                                    </div>
                                                 </div>
                                                </div>          
                                                <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                                <label for="">No FAX</label>
                                                            <input type="text" disabled value="<?= $d->szFaximile;?>" name="szZipCode" id="" class="form-control">
                                                        </div> 
                                                     </div> 
                                                        <div class=" col-md-6 sm-12">
                                                            <div class="form-group">
                                                            <label for="">Kontak person 1</label>
                                                            <input type="text" disabled value="<?= $d->szContactPerson1;?>" name="szZipCode" id="" class="form-control">
                                                        </div> 
                                                    </div> 
                                                        <div class="col-md-6  sm-12">
                                                            <div class="form-group">
                                                            <label for="">Kontak person 2</label>
                                                            <input type="text" disabled value="<?= $d->szContactPerson2;?>" name="szZipCode" id="" class="form-control">
                                                        </div> 
                                                    </div> 
                                                </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">                                                        <label for="">Email</label>
                                                            <input type="text" disabled value="<?= $d->szEmail;?>" name="szZipCode" id="" class="form-control">
                                                            </div> 
                                                        </div>
                                                     </div>
                                                </div>
                                         
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




            
                                    <div class="modal fade text-left" id="update<?= $d->szId;?>"  role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel17">Update</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form action="<?= base_url();?>kendaraan/updateEkspedisi" method="post">
                                                            <input type="hidden" value="<?= $d->szId;?>" id="id_sz" name="id">
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">

                                                                    <div class="form-group">
                                                                        <label for="first-name-column">Kode Ekspedisi</label>
                                                                        <input disabled type="text" disabled  id="first-name-column" required  value="<?= $d->szId;?>" class="form-control" name="Kekspedisi">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="last-name-column">Nama Ekspedisi</label>
                                                                        <input required type="text" id="last-name-column" value="<?= $d->szName;?>" class="form-control" name="Nekspedisi">
                                                                    </div>
                                                                </div>


                                            

                                                        <div class="col mt-2">

                                                            <label for="">Keterangan</label>
                                                            <textarea  required name="ketekpedisi" class="form-control" id="" cols="30" rows="3"><?= $d->szDescription;?></textarea>

                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="gudangTarget" value="" name="szId">

                                                                    </div>
                                                    
                                  

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="gudangTarget" value="" name="szId">

                                                                        <label for="first-name-column">Alamat</label>
                                                                        <textarea  type="text" id="first-name-column"  cols="30" rows="3" class="form-control" name="szaddress"><?= $d->szAddress;?></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 col-12">
                                                                    <br>
                                                                    <div class="form-group">
                                                                        <label for="">Provinsi</label>

                                                                        
                                                                    <br>
                                                                    <select name="szProvince" id="Provinsi<?= $d->szId;?>" onchange="getFormKota<?= $d->szId;?>()"  class="   col-md-6 form-select" >
                                                                        <option value="<?=$d->szProvince;?>"><?=$d->szProvince;?></option>
                                                                        <?php foreach($provinsi as $p){?>
                                                                        <option value="<?= $p->szProvince;?>"><?= $p->szProvince;?></option>
                                                                        <?php }?>   
                                                                     </select>

                                                                </div>
                                                            </div>


                                                                
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                
                                                                        <br>

                                                                    <!-- <input  type="text" id="szIdTipe" value="<?=$d->szCity;?>" class="form-control" name="szCity"> -->
                                                            
                                                                    <label> Kabupaten </label>
                                                                        <br>

                                                                    <select onchange="getFormKecamatan<?= $d->szId;?>()" name="szCity" class="  form-control  select2-data-array browser-default  " id="idkota<?= $d->szId;?>" >
                                                                        <option value="<?=$d->szCity;?>"><?=$d->szCity;?></option>

                                                                    </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <!-- <input type="text" id="last-name-column" class="form-control" name="lname-column"> -->
                                                                
                                                                        <!-- <label> Kecamatan </label> -->
                                                                        <!-- <input  type="text" id="szIdTipe" value="<?=$d->szDistrict;?>" class="form-control" name="szDistrict"> -->
                                                                        <br>
                                                                        
                                                                        <label> Kecamatan </label>
                                                                        <br>
                                                                        <select onchange="getFormKelurahan<?= $d->szId;?>()" name="szDistrict" id="idkecamatan<?= $d->szId;?>" class="form-control  select2-data-array browser-default " >
                                                                        <option value="<?=$d->szDistrict;?>"><?=$d->szDistrict;?></option>


                                                                        </select>
                                                                        <br>
                                                                        
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <!-- <input type="text" id="last-name-column" class="form-control" name="lname-column"> -->
                                                                        
                                                                        
                                                                            <br>
                                                                        <!-- <input  type="text" id="szIdTipe" value="<?=$d->szSubDistrict;?>" class="form-control" name="szSubDistrict"> -->
                                                                            
                                                                        <label> Kelurahan </label>
                                                                            <br>
                                                                            <select onchange="getFormkode<?= $d->szId;?>()" name="szSubDistrict" class="  form-control" id="idkelurahan<?=$d->szId;?>">
                                                                            <option value="<?=$d->szSubDistrict;?>"><?=$d->szSubDistrict;?></option>
                                                                            </select>    
                                                            
                                                                    </div>
                                                                </div>


                                                    <div class="col-sm-12">
                                                        <div class="form-group">

                                                        <!-- <input type="text"  value="<?= $d->szZipCode;?>" name="szZipCode" id="" class="form-control"> -->
                                                        <label for="">Kode pos</label>
                                                            <select name="szZipCode" class=" select2-data-array browser-default form-control" id="idkode<?= $d->szId;?>">
                                                                <option value="<?= $d->szZipCode;?>"><?= $d->szZipCode;?></option>
                                                            </select>
                                                        </div>  
                                                    </div>  
                                                </div>  

                                    <div class="row">
                                        <div class="col-sm">
                                        <div class="form-group">
                                        <label for="">No telp 1</label>
                                        <?php if($d->szPhone1 != null ){?>
                                        <input type="number" required value="<?= $d->szPhone1;?>" name="szPhone1" id="" class="form-control">
                                        <?php }else{?>
                                        <input type="number"  value="<?= $d->szPhone1;?>" name="szPhone1" id="" class="form-control">
                                        <?php }?>
                                        </div>
                                    </div>
                                        <div class="col-sm">
                                        <div class="form-group">
                                        <label for="">No telp 2</label>
                                        <?php if($d->szPhone2 != null ){?>
                                        <input type="number" required  value="<?= $d->szPhone2;?>" name="szPhone2" id="" class="form-control">
                                        <?php }else{?>
                                        <input type="number"  value="<?= $d->szPhone2;?>" name="szPhone2" id="" class="form-control">
                                        <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                    <div class="form-group">
                                        <label for="">No telp 3</label>
                                        <?php if($d->szPhone3 != null ){?>
                                        <input type="number"  required value="<?= $d->szPhone3;?>" name="szPhone3" id="" class="form-control">
                                        <?php }else{?>
                                        <input type="number"  value="<?= $d->szPhone3;?>" name="szPhone3" id="" class="form-control">
                                        <?php }?>
                                    </div>
                                    </div>
                                </div>          
                                <div class="row">

                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <label for="">No FAX</label>
                                            <?php if($d->szFaximile != null ){?>
                                            <input type="number" required  value="<?= $d->szFaximile;?>" name="szFaxmile" id="" class="form-control">
                                            <?php }else{?>
                                                <input type="number"   value="<?= $d->szFaximile;?>" name="szFaxmile" id="" class="form-control">
                                            <?php } ?>
                                            </div> 
                                        </div> 
                                        <div class=" col-md-6 sm-12">
                                            <div class="form-group">
                                            <label for="">Kontak person 1</label>
                                            <?php if($d->szContactPerson1 != null ){?>
                                            <input type="text" required  value="<?= $d->szContactPerson1;?>" name="szContactPerson1" id="" class="form-control">
                                            <?php }else{?>
                                            <input type="text"  value="<?= $d->szContactPerson1;?>" name="szContactPerson1" id="" class="form-control">
                                            <?php }?>

                                         </div> 
                                        
                                        </div> 
                                        <div class="col-md-6  sm-12">
                                            <div class="form-group">
                                            <label for="">Kontak person 2</label>
                                            <?php if($d->szContactPerson2 != null ){?>
                                            <input type="text" required  value="<?= $d->szContactPerson2;?>" name="szContactPerson2" id="" class="form-control">
                                            <?php }else{?>
                                            <input type="text"   value="<?= $d->szContactPerson2;?>" name="szContactPerson2" id="" class="form-control">
                                            <?php }?>

                                        </div> 
                                        </div> 
                                    </div>
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                            <?php if($d->szEmail != null ){?>
                                            <input type="email" required   value="<?= $d->szEmail;?>" name="email" id="" class="form-control">
                                        <?php }else{?>
                                        <input type="email"    value="<?= $d->szEmail;?>" name="email" id="" class="form-control">
                                        <?php }?>
                                            </div> 
                                    </div> 
                        
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Status</label>
                                                                    <select name="status" id="" class="form-control">
                                                                    <?php if ($d->status == 1 ){?>
                                                                            <option value="1">Aktif</option>
                                                                            <?php }else{?>
                                                                                <option value="0">Tidak Aktif</option>
                                                                            <?php }?>
                                                                            <option value="1">Aktif</option>
                                                                            <option value="0">Tidak Aktif</option>

                                                                    </select>
                                                                    <!-- <input type="text" id="first-name-column" class="form-control" name="fname-column"> -->
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            <!-- <button type="submit" class="btn btn-primary ml-1"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Accept</span>
                                                            </button> -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        

                                        <?php }?>

                                      

                                        <script src="<?= base_url(); ?>assets/master/js/jquery-on.js"></script>
                                        <script src="<?= base_url(); ?>assets/master/js/select.js"></script>
                                        <script src="<?= base_url(); ?>assets/master/js/data-table-on.js"></script>
                                        <script src="<?= base_url(); ?>assets/master/js/ekspedisi.js"></script>
                                        <script src="<?= base_url(); ?>assets/master/js/chosen.js"></script>



                                        

<input type="text" name="" value="<?= $a;?>" class="count">
<script>


    
	
    
    
    <?php foreach($tipe as $ti){?>
        

        
		


        var status_inv = document.getElementById('<?= "Provinsi" . $ti->szId;?>').value;



        $.ajax({
            url: "<?= base_url('kendaraan/get_kota') ?>",
            method: "POST",
            data: {
                status: status_inv
            },
            
            async: true,
            dataType: "JSON",
            success: function(data) {
                // console.log(data)
                var content = document.getElementById("<?= "idkota" . $ti->szId;?>");
                content.innerHTML = "";

                var template = (row) => `  
                    <option value="${row.szCity}">${row.szCity}</option>
                `
                var test = '<option><?= $ti->szCity;?> </option>'
                        content.insertAdjacentHTML('beforeend', test);


                for (var row of data) {
                    var element = template(row);
                    content.insertAdjacentHTML('beforeend', element);
                }
            }
        })

        // get kecamatan

        var status_kota = document.getElementById('<?= "idkota" . $ti->szId;?>').value;
        // var status_kota = $(".idkota").val();

        $.ajax({
            url: "<?= base_url('kendaraan/get_kecamatan')?>",
            method: "POST",
            data: {
                status: status_kota
            },
            async: true,
            dataType: "JSON",
            success: function(data) {
                // console.log(data)
                var content = document.getElementById("<?= "idkecamatan" . $ti->szId;?>");
                content.innerHTML = "";

                var template = (row) => `  
                    <option value="${row.szDistrict}">${row.szDistrict}</option>
                `
                var test = '<option><?= $ti->szDistrict;?></option>'
                        content.insertAdjacentHTML('beforeend', test);


                for (var row of data) {
                    var element = template(row);
                    content.insertAdjacentHTML('beforeend', element);
                }
            }
        })


        // get kelurahan

        var status_kelurahan = document.getElementById('<?= "idkecamatan" . $ti->szId;?>').value;
// alert(status_kelurahan);
        $.ajax({
            url: "<?= base_url('kendaraan/get_kelurahan') ?>",
            method: "POST",
            data: {
                status: status_kelurahan
            },
            async: true,
            dataType: "JSON",
            success: function(data) {
                console.log(data)
                var content = document.getElementById('<?= "idkelurahan" . $ti->szId;?>');
                content.innerHTML = "";

                var template = (row) => `  
                    <option value="${row.szSubDistrict}">${row.szSubDistrict}</option>
                `
                var test = '<option><?= $ti->szSubDistrict;?></option>'
                        content.insertAdjacentHTML('beforeend', test);

                for (var row of data) {
                    var element = template(row);
                    content.insertAdjacentHTML('beforeend', element);
                }
            }
        })

function getFormKota<?= $ti->szId;?>()
{


var status = document.getElementById('<?= "Provinsi" . $ti->szId;?>').value;
// var status = $("#idkota").val();


$.ajax({
    url: "<?= base_url('kendaraan/get_kota_edit') ?>",
    method: "POST",
    data: {
        status: status
    },
    async: true,
    dataType: "JSON",
    success: function(data) {
        // console.log(data)
        var content = document.getElementById("<?= "idkota" . $ti->szId;?>");
        content.innerHTML = "";

        var template = (row) => `  
            <option value="${row.szCity}">${row.szCity}</option>
        `
        var test = '<option>-- Pilih Kota -- </option>'
                        content.insertAdjacentHTML('beforeend', test);

        for (var row of data) {
            var element = template(row);
            content.insertAdjacentHTML('beforeend', element);
        }
    }
})
}

function getFormKecamatan<?= $ti->szId;?>()
{
    var status = document.getElementById('<?= "idkota" . $ti->szId;?>').value;
        // var status_kota = $(".idkota").val();

        $.ajax({
            url: "<?= base_url('kendaraan/get_kecamatan')?>",
            method: "POST",
            data: {
                status: status
            },
            async: true,
            dataType: "JSON",
            success: function(data) {
                // console.log(data)
                var content = document.getElementById("<?= "idkecamatan" . $ti->szId;?>");
                content.innerHTML = "";

                var template = (row) => `  
                    <option value="${row.szDistrict}">${row.szDistrict}</option>
                `
                var test = '<option>-- Pilih Kecamatan -- </option>'
                        content.insertAdjacentHTML('beforeend', test);

                for (var row of data) {
                    var element = template(row);
                    content.insertAdjacentHTML('beforeend', element);
                }
            }
        })
}


function getFormKelurahan<?= $ti->szId;?>()
{

    var statusKecamatannew = document.getElementById('<?= "idkecamatan" . $ti->szId;?>').value;
// alert(statusKecamatannew);
$.ajax({
    url: "<?= base_url('kendaraan/get_kelurahan') ?>",
    method: "POST",
    data: {
        status: statusKecamatannew
    },
    async: true,
    dataType: "JSON",
    success: function(data) {
        console.log(data)
        var content = document.getElementById('<?= "idkelurahan" . $ti->szId;?>');
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


function getFormkode<?= $ti->szId;?>()
{
var statusKode = document.getElementById('<?= "idkelurahan" . $ti->szId;?>').value;
var statuskecamatan = document.getElementById('<?= "idkecamatan" . $ti->szId?>').value;
// alert(statuskecamatan);
$.ajax({
    url: "<?= base_url('kendaraan/get_kode') ?>",
    method: "POST",
    data: {
        status: statusKode,
        status_dua:statuskecamatan
    },
    async: true,
    dataType: "JSON",
    success: function(data) {
            console.log(data)
            var content = document.getElementById("<?= 'idkode' . $ti->szId?>");
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


    $('#Provinsi<?= $ti->szId;?>').select2({
                placeholder: "Pilih"
            });

    $('#idkelurahan<?= $ti->szId;?>').select2({
                placeholder: "Pilih"
            });

    $('#idkecamatan<?= $ti->szId;?>').select2({
                placeholder: "Pilih"
            });

    $('#idkota<?= $ti->szId;?>').select2({
                placeholder: "Pilih"
            });

// $("#vdn_number").select2({
//     placeholder: "00000",
//     minimumInputLength: 2,
//   \
// });




<?php }?>


</script>




