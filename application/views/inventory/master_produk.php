
<div class="main-content container-fluid">
    <div class="page-title">

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">

                        <a href="<?= base_url()?>master?id=6">NEW FORM</a>  
                    </div>


                    <div class=" col-sm-3 text-right">
                        <select style="float:right;" name="status"  class="form-select" id="filterProduk">
                          <option value="">Status Produk</option>
                          <option value="1">Aktif</option>
                          <option value="0">Tidak Aktif</option>
                      </select>

                    </div>

                </div>

            </div>
            <div class="card-body">
            <?php echo $this->session->flashdata('massage');?>

                <table class='table table-striped' id="produk">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Kode produk</th>
                            <th>Nama produk</th>
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


<!-- <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>

    <script src="assets/js/main.js"></script> -->





    <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
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
                                                         <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kode  Produk</label>
                                                    <input type="text" disabled value="" id="szId" class="form-control" name="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Nama  Produk</label>
                                                    <input type="text" disabled value="" id="szName" class="form-control" name="Nproduk">
                                                </div>
                                            </div>


                                    <div class="col-md-6 col-12">
                                        <label for="">Jenis Traking</label>
                                        <input type="text" name="" disabled class="form-control" value="" id="jtProduk">
                                        <!-- <select name="jtProduk" id="jtProduk" class="form-control">
                                        <option value="">-- Pilih -- </option>
                                            <option value="NON">NON - Tidak menggunakan Traking </option>
                                            <option value="LOT">LOT - Bach / Lot Number</option>
                                            <option value="SER">SER - Nomor Seri </option>                                       
                                        </select> -->
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="">Jenis Produk</label>
                                        <input type="text" disabled class="form-control" value="" name="" id="TipeProduk">
                                    </div>

                                    <div class=" col-sm-12">
                                        <label for="">Nick name</label>
                                    <input readonly type="text" name="nick" class="form-control" id="nick">
                                    </div>
                                    <div class=" col-sm-12">


                                        <label for="">Masa Berlaku</label>
                                  
                                    </div>



                                    <div class="col-md-6 col-12">
                                    <label for="">Start date</label>

                                    <input readonly class="form-control" type="text" name="" id="start">                                   
                                </div>
                                     <div class="col-md-6 col-12">
                                     <label for="">End date</label>

                                    <input readonly type="text" name="end" id="end" class="form-control">
                                    
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="">Keterangan</label>
                                        <!-- <textarea name="ketproduk" class="form-control" id="" cols="30" rows="5"></textarea> -->

                                        <!-- <a class="btn btn-outline-primary btn-sm mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Informasi Alamat
                                        </a> -->

                                            <!-- <div class="collapse" id="collapseExample">
                                                
                                            </div> -->

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





             <div class="modal fade text-left" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel17">Update</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form action="<?= base_url();?>master/updateProduk" method="post">
                                                            <input type="hidden" value="" id="id_sz" name="id">




                                                            
                                                        <div class="row">

                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Status</label>
                                                                    <select name="status" id="" class="form-control">
                                                                            <option value="">-- Pilih Status --</option>
                                                                            <option value="1">Aktif</option>
                                                                            <option value="0">Tidak Aktif</option>

                                                                    </select>
                                                                    <!-- <input type="text" id="first-name-column" class="form-control" name="fname-column"> -->
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                          
                                                        </div>
                                                        </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                        
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="modal fade text-left" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel17">Hapus</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">

                                                                <form method="post" action="<?= base_url();?>master/hapusSatuan">


                                                                <input type="hidden" value="" id="id_hapus_satuan" name="id_szId_satuan">
                                                                    <h6>Apakah anda yakin ingi menghapus data ini?                                                     
                                                                    <!-- <input type="text" id="first-name-column" class="form-control" name="fname-column"> -->
                                                                </div>
                                          
                                                        </div>
                                                        </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>

                                                            </button>

                                                            <button class="btn btn-primary" type="submit">Hapus</button>

                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                            <?php
                                            
                                            
                                            
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
                                                         <div class="row">
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="first-name-column">Kode  Produk</label>
                                                                            <input type="text" disabled value="<?= $d->szId;?>" id="szId" class="form-control" name="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="last-name-column">Nama  Produk</label>
                                                                            <input type="text" disabled value="<?= $d->szName;?>" id="szName" class="form-control" name="Nproduk">
                                                                        </div>
                                                                    </div>


                                                       <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="">Jenis Traking</label>
                                                                <input type="text" name="" disabled class="form-control" value="<?= $d->szTrackingType;?>" id="jtProduk">
                                                                <!-- <select name="jtProduk" id="jtProduk" class="form-control">
                                                                <option value="">-- Pilih -- </option>
                                                                    <option value="NON">NON - Tidak menggunakan Traking </option>
                                                                    <option value="LOT">LOT - Bach / Lot Number</option>
                                                                    <option value="SER">SER - Nomor Seri </option>                                       
                                                                </select> -->
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                              <div class="form-group">
                                                                <label for="">Jenis Produk</label>
                                                                <input type="text" disabled class="form-control" value="<?= $d->szProductType;?>" name="" id="TipeProduk">
                                                            </div>
                                                        </div>

                                                        <div class=" col-sm-12">
                                                            <div class="form-group">
                                                                <label for="">Nick name</label>
                                                                <input readonly type="text" value="<?= $d->szNickName;?>" name="nick" class="form-control" id="nick">
                                                            </div>
                                                        </div>

                                                            <div class=" col-sm-12">
                                                                <div class="form-group">
                                                                <label for="">Masa Berlaku</label>
                                                              </div>
                                                            </div>



                                                            <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                            <label for="">Start date</label>

                                                            <input readonly class="form-control" value="<?= $d->tgl_awal;?>" type="date" name="" id="start">                                   
                                                          </div>
                                                        </div>
                                                            <div class="col-md-6 col-12">
                                                             <div class="form-group">

                                                            <label for="">End date</label>

                                                            <input readonly type="date" value="<?= $d->tgl_akhir;?>" name="end" id="end" class="form-control">
                                                            
                                                            </div>
                                                         </div>

                                                            <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="">Keterangan</label>
                                                                <textarea disabled name="" id="" cols="30" rows="3" class="form-control"><?= $d->szDescription;?></textarea>
                                                                <!-- <textarea name="ketproduk" class="form-control" id="" cols="30" rows="5"></textarea> -->

                                                                <!-- <a class="btn btn-outline-primary btn-sm mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                    Informasi Alamat
                                                                </a> -->

                                                                    <!-- <div class="collapse" id="collapseExample">
                                                                        
                                                                    </div> -->

                                                            </div>
                                                        </div>

                                                            <div class="col-sm-12 mt-5 mb-4">
                                                            <h5 class="card-title">Optional</h5>

                                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <a class="nav-link active" id="home-tab<?= $d->iId;?>" data-bs-toggle="tab" href="#home<?= $d->iId;?>"
                                                                        role="tab" aria-controls="home" aria-selected="true">Satuan</a>
                                                                </li>

                                                                <li class="nav-item" role="presentation">
                                                                    <a class="nav-link" id="profile-tab<?= $d->iId;?>" data-bs-toggle="tab" href="#profile<?= $d->iId;?>"
                                                                        role="tab" aria-controls="profile" aria-selected="false">Informasi Penjualan</a>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <a class="nav-link" id="contact-tab<?= $d->iId;?>" data-bs-toggle="tab" href="#contact<?= $d->iId;?>"
                                                                        role="tab" aria-controls="contact" aria-selected="false">Kategori Produk</a>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <a class="nav-link" id="kit-tab<?= $d->iId;?>" data-bs-toggle="tab" href="#kit<?= $d->iId;?>"
                                                                        role="tab" aria-controls="contact" aria-selected="false">Informasi Kit</a>
                                                                </li>
                                                            </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="home<?= $d->iId;?>" role="tabpanel"
                                                        aria-labelledby="home-tab<?= $d->iId;?>">
                                    
                                                        <div class="form-group">
                                                        <label class="mt-3" for="">Satuan Terkecil</label>
                                                        <input type="text" class="form-control" readonly value="<?= $d->szUomId;?>">
                                                       </div>

                                                    <?php if ($d->bUseComposite == 1 ){?>
                                                    <div class="form-check form-check-inline mt-3 form-group">
                                                        <input disabled checked class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUseComposite" value="1">
                                                        <label class="form-check-label" for="inlineCheckbox1">Menggunakan satuan komposit</label>
                                                    </div>
                                                    <?php }else{?>
                                                        
                                                        <div class="form-check form-check-inline mt-3 form-group">
                                                            <input disabled  class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUseComposite" value="1">
                                                            <label class="form-check-label" for="inlineCheckbox1">Menggunakan satuan komposit</label>
                                                        </div>

                                                    <?php }?>
            <br>
                                                   <div class="form-group">
                                                    <label for="">Format kuantity</label>
                                                    <input type="text" readonly value="<?= $d->szQtyFormat;?>" class="form-control mt-2" name="szQTYFormat" id="">

                                                   </div>
                                            </div>
                                                    <div class="tab-pane fade" id="profile<?= $d->iId;?>" role="tabpanel"
                                                        aria-labelledby="profile-tab<?= $d->iId;?>">

                                                        <div class="row">
                                                        <div class="col-md-6 col-12 ">
                                                            <br>
                                                            <?php 

                                                                 $angka = number_format($d->decPrice,0);

                                                            ?>
                                                                        <label class=""  > Harga Satuan</label>
                                                                        <input disabled value="<?= $angka;?>"   type="text" id="last-name-column" class="form-control " name="decPrice">
                                                                    </div>
                                                            
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group ">
                                                                    <br>
                                                                    <label class="" for="">Satuan Terkecil</label>
                                                                    <br>
                                                                        <select disabled  name="stproduk" id="" class="form-control">
                                                                            
                                                                        <option><?= $d->tipe_sales?></option>
                                                                        <?php foreach($satuan as $s ){?>
                                                                        <option><?= $s->szId ?></option>
                                                                        <?php }?>
                                                                        </select>
                                                                                    <br>



                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                            <div class="form-group">

                                                            <label class="mt-3" for="">Tipe item penjualan</label>
                                                            <input  disabled value="<?= $d->szOrderItemtypeId;?>" type="text" id="last-name-column" class="form-control" name="szOrderItemtypeId">
                                                            </div>
                                                            </div>

                                                            <div class="col">
                                                            <div class="form-group">
                                                            <label class="mt-3" for="">Default satuan Penjualan</label>
                                                            <input  type="text" disabled value="<?= $d->szDefaultUomId;?>" id="last-name-column" class="form-control" name="szDefaultUomId">
                                                            </div>
                                                            </div>

                                                            <div class="col">
                                                            <div class="form-group">
                                                            <label class="mt-3" for="">Pajak peualan</label>
                                                            <input  type="text" disabled value="<?= $d->szTaxId;?>" id="last-name-column" class="form-control" name="szTaxId">
                                                            </div> 
                                                            </div> 
                                                            
                                                            <?php if ($d->bUsePriceWTax == 1 ){?>
                                                    <div class="form-check form-check-inline mt-3">
                                                        <input disabled checked class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUseComposite" value="1">
                                                        <label class="form-check-label" for="inlineCheckbox1">Menggunakan satuan komposit</label>
                                                    </div>
                                                    <?php }else{?>
                                                        
                                                        <div class="form-check form-check-inline mt-3">
                                                            <input disabled  class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUseComposite" value="1">
                                                            <label class="form-check-label" for="inlineCheckbox1">Menggunakan satuan komposit</label>
                                                        </div>

                                                    <?php }?>
                                                    </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="contact<?= $d->iId;?>" role="tabpanel"
                                                        aria-labelledby="contact-tab<?= $d->iId;?>">
                                                     
                                                 <div class="col">
                                                 <div class="form-group">
                                                        <label class="mt-3" for="">Tipe Kategori</label>
                                                        <br>
                                                        <select class="form-control"  name="szCategoyValue" id="">
                                                            <option value="">SEGMENTASI</option>
                                                    
                                                        </select>
                                                </div>
                                                </div>
                                                            
                                                        <div class="col">
                                                        <div class="form-group">

                                                            <label class="mt-3" for="">Kategori</label>
                                                            <br>
                                                            <select class="form-control"  name="szCategoyValue" id="">
                                                                <option value=""><?= $d->szCategoryValue;?></option>
                                                        
                                                            </select>
                                                </div>
                                                </div>
                                            </div>

                                                            <div class="tab-pane fade" id="kit<?= $d->iId;?>" role="tabpanel"
                                                                aria-labelledby="kit-tab<?= $d->iId;?>">
                                                            <div class="row mt-5">
                                                                <div class="col">
                                                                <table id="dynamic_field_sub" class="table table-striped" border='1px solid' >
                                                                <thead>
                                                                <tr>
                                                                    <th>Id Produk</th>
                                                                    <th>Nama Produk</th>
                                                                    <th>Kuantiti</th>
                                                                    <th>Satuan</th>
                                                                </tr>
                                                                <thead>
                                                                <tbody id="table_body<?= $d->szId;?>">
                                                                </tbody>
                                                            </table> 
                                                                </div>
                                                            </div>
                                                      

                                                            </div>      
                                                        </div>
                                                        <br>
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
                                            </div>
                                            </div>





                                            <div class="modal fade text-left" id="update<?= $d->szId;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel17">Update</h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                            <form action="<?= base_url();?>master/updateProduk" method="post">

                                                                <input type="hidden" value="<?= $d->szId;?>" id="id_sz" name="id">

                                                            <div class="row">
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="first-name-column">Kode  Produk</label>
                                                                            <input type="text" disabled  value="<?= $d->szId;?>" id="szId" class="form-control" name="">
                                                                            <input required type="hidden"   value="<?= $d->szId;?>" id="szId" class="form-control" name="Kproduk">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="last-name-column">Nama  Produk</label>
                                                                            <input required type="text"  value="<?= $d->szName;?>" id="szName" class="form-control" name="Nproduk">
                                                                        </div>
                                                                    </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                    <label for="">Jenis Traking</label>
                                                                    <select required name="jtProduk" id="jtProduk" class="form-control">
                                                                    <option><?= $d->szTrackingType;?> </option>
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
                                                                        <option value="<?= $d->szProductType;?>"><?= $d->szProductType;?></option>
                                                                            <option value="SALES">SALES - Produk jual</option>
                                                                            <option value="LOT">LOT - Bach / Lot Number</option>
                                                                            <option value="SER">SER - Nomor Seri </option>                                       
                                                                        </select>
                                                              </div>
                                                            </div>

                                                            <div class=" col-sm-12">
                                                              <div class="form-group">
                                                                <label for="">Nick name</label>
                                                                <input required type="text" value="<?= $d->szNickName;?>" name="nick" class="form-control" id="nick">
                                                              </div>
                                                            </div>
                                                            <div class=" col-sm-12">

                                                              <div class="form-group">
                                                                <label for="">Masa Berlaku</label>
                                                              </div>
                                                            </div>



                                                            <div class="col-md-6 col-12">
                                                             <div class="form-group">

                                                            <label for="">Start date</label>

                                                            <input required class="form-control" value="<?= $d->tgl_awal;?>" type="date" name="start" id="start">                                   
                                                          </div>
                                                        </div>
                                                            <div class="col-md-6 col-12">
                                                                 <div class="form-group">
                                                                    <label for="">End date</label>
                                                                    <input required  type="date" value="<?= $d->tgl_akhir;?>" name="end" id="end" class="form-control">
                                                                 </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <label for="">Keterangan</label>
                                                                <textarea name="keterangan"  class="form-control" row="3" col="5"  ><?= $d->szDescription;?>  </textarea>
                                                                <!-- <textarea name="ketproduk" class="form-control" id="" cols="30" rows="5"></textarea> -->

                                                                <!-- <a class="btn btn-outline-primary btn-sm mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                    Informasi Alamat
                                                                </a> -->

                                                                    <!-- <div class="collapse" id="collapseExample">
                                                                        
                                                                    </div> -->

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

                                                            <div class="col-sm-12 mt-5 mb-4">
                                                                <h5 class="card-title">Optional</h5>
                                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                    <li class="nav-item" role="presentation">
                                                                        <a class="nav-link active" id="home-tab<?= $d->szId;?>" data-bs-toggle="tab" href="#home<?= $d->szId;?>"
                                                                            role="tab" aria-controls="home" aria-selected="true">Satuan</a>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                        <a class="nav-link" id="profile-tab<?= $d->szId;?>" data-bs-toggle="tab" href="#profile<?= $d->szId;?>"
                                                                            role="tab" aria-controls="profile" aria-selected="false">Informasi Penjualan</a>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                        <a class="nav-link" id="contact-tab<?= $d->szId;?>" data-bs-toggle="tab" href="#contact<?= $d->szId;?>"
                                                                            role="tab" aria-controls="contact" aria-selected="false">Kategori Produk</a>
                                                                    </li>
                                                                    <li class="nav-item" role="presentation">
                                                                        <a class="nav-link" id="kit-tab<?= $d->szId;?>" data-bs-toggle="tab" href="#kit<?= $d->szId;?>"
                                                                            role="tab" aria-controls="contact" aria-selected="false">Informasi Kit</a>
                                                                    </li>
                                                                </ul>
                                                                    <div class="tab-content" id="myTabContent">
                                                                        <div class="tab-pane fade show active" id="home<?= $d->szId;?>" role="tabpanel"
                                                                            aria-labelledby="home-tab<?= $d->szId;?>">
                                                        
                                                                
                                                                            <label class="mt-3" for="">Satuan Terkecil</label>
                                                                            <?php if ($d->szUomId != null ){?>

                                                                            <select required name="szUomId" id="" class="form-control">
                                                                    
                                                                            <option value="<?= $d->szUomId?>"><?= $d->satuan_produk?></option>
                                                                                <?php foreach($satuan as $s ){?>
                                                                                <option><?= $s->szId ?></option>
                                                                                <?php }?>
                                                                            </select>

                                                                            <?php }else {?>
                                                                            <select  name="szUomId" id="" class="form-control">
                                                                    
                                                                            <option><?= $d->szUomId?></option>
                                                                                <?php foreach($satuan as $s ){?>
                                                                                <option><?= $s->szId ?></option>
                                                                                <?php }?>
                                                                            </select>

                                                                            <?php }?>

                                                                        <?php if ($d->bUseComposite == 1 ){?>
                                                                        <div class="form-check form-check-inline mt-3">
                                                                            <input  checked class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUseComposite" value="1">
                                                                            <label class="form-check-label" for="inlineCheckbox1">Menggunakan satuan komposit</label>
                                                                        </div>
                                                                        <?php }else{?>
                                                                            
                                                                            <div class="form-check form-check-inline mt-3">
                                                                                <input   class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUseComposite" value="0">
                                                                                <label class="form-check-label" for="inlineCheckbox1">Menggunakan satuan komposit</label>
                                                                            </div>

                                                                        <?php }?>
                                <br>
                                                                        <label for="">Format kuantity</label>
                                                                        <?php if ($d->szQtyFormat != null ){?>
                                                                        <input type="text" required  value="<?= $d->szQtyFormat;?>" class="form-control mt-2" name="szQTYFormat" id="">
                                                                        <?php }else{?>
                                                                            <input type="text"  value="<?= $d->szQtyFormat;?>" class="form-control mt-2" name="szQTYFormat" id="">
                                                                        <?php }?>
                                                                </div>

                                                                <div class="tab-pane fade" id="profile<?= $d->szId;?>" role="tabpanel"
                                                                aria-labelledby="profile-tab<?= $d->szId;?>">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-12 ">
                                                                

                                                                        <?php 

                                                                            $angka_format = number_format($d->decPrice,0);

                                                                        ?>

                                                                        <label class=""  > Harga Satuan</label>
                                                                    <?php if($d->decPrice != 0.0000 ){?>

                                                                        <?php 
                                                                            

                                                                        ?>

                                                                        <input onkeypress='return hanyaAngka(event)' required value=""   type="text" id="desc<?= $d->szId;?>" class="form-control mt-3" name="hargasatuan">
                                                                    </div>
                                                                    <?php }else{?>
                                                                        <input value="" type="number" id="last-name-column" class="form-control mt-3" name="decPrice">
                                                                    </div>   
                                                                    <?php }?>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group ">
                                                                    <br>
                                                                    <label class="p" for="">Satuan Terkecil</label>
                                                                        <select  name="stproduk" id="" class="form-control">
                                                                            
                                                                        <option value="<?= $d->tipe_sales?>" ><?= $d->nama_satuan?></option>
                                                                        <?php foreach($satuan as $s ){?>
                                                                        <option value="<?= $s->szId;?>"><?= $s->szName ?></option>
                                                                        <?php }?>
                                                                        </select>




                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                            <label class="mt-3" for="">Tipe item penjualan</label>
                                                         
                                                            <select name="szOrderItemtypeId" class="form-control"   >  
                                                                <option><?= $d->szOrderItemtypeId;?></option>
                                                            <?php foreach($order as $k ){?>
                                                            <option value="<?= $k->szId;?>"><?= $k->szId;?> - <?= $k->szName;?></option>
                                                            <?php }?>

                                                              </select>
                                                        



                                                            </div>

                                                            <div class="col">
                                                            <label class="mt-3" for="">Default satuan Penjualan</label>
                                                    <!--         <input  type="text"  value="<?= $d->szDefaultUomId;?>" id="last-name-column" class="form-control" name="szDefaultUomId"> -->
                                                            <select name="szDefaultUomId" class="form-control" > 

                                                            <option value="<?= $d->szDefaultUomId;?>"> <?= $d->nama_satuan;?>  </option>   
                                                             <?php foreach($satuan as $s){?>

                                                            <option value="<?= $s->szId;?>"><?= $s->szName;?></option>

                                                            <?php }?>

                                                            </select>
                                               
                                                            </div>

                                                            <div class="col">
                                                            <label class="mt-3" for="">Pajak penjualan</label>

                                                                <select class='form-control' name="szTaxId" id="">
                                                                    <option value="<?= $d->szTaxId;?>"><?= $d->szTaxId;?></option>
                                                                <?php foreach($tax as $k ){?>
                                                                    <option value="<?= $k->szId;?>"><?= $k->szId;?> - <?= $k->szName;?></option>
                                                                <?php }?>
                                                                </select>

                                                            </div>
                                                            
                                                            <?php if ($d->bUsePriceWTax == 1 ){?>
                                                    <div class="form-check form-check-inline mt-3">
                                                        <input  checked class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUsePriceWTax" value="1">
                                                        <label class="form-check-label" for="inlineCheckbox1">Harga Termasik Pajak</label>
                                                    </div>
                                                    <?php }else{?>
                                                        
                                                        <div class="form-check form-check-inline mt-3">
                                                            <input   class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUsePriceWTax" value="1">
                                                            <label class="form-check-label" for="inlineCheckbox1">Harga Termasik Pajak</label>
                                                        </div>

                                                    <?php }?>
                                                    </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="profile<?= $d->szId;?>" role="tabpanel"
                                                        aria-labelledby="profile-tab<?= $d->szId;?>">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                            <label class="mt-3" for="">Satuan Terkecil</label>
                                                                <select  name="szIdProduk" id="" class="form-control">
                                                                <option value=""><?= $d->szId?></option>
                                                         

                                                                </select>

                                                            </div>
                                                            
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group mt-3">
                                                                    <br>
                                                                    <input value="<?= $d->decPrice;?>"   type="text" id="last-name-column" class="form-control" name="decPrice">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                            <label class="mt-3" for="">Tipe item penjualan</label>
                                                            <input   value="<?= $d->szOrderItemtypeId;?>" type="text" id="last-name-column" class="form-control" name="szOrderItemtypeId">
                                                            </div>

                                                            <div class="col">
                                                            <label class="mt-3" for="">Default satuan Penjualan</label>
                                                            <input  type="text"  value="<?= $d->szDefaultUomId;?>" id="last-name-column" class="form-control" name="szDefaultUomId">

                                                            </div>

                                                            <div class="col">
                                                            <label class="mt-3" for="">Pajak peualan</label>
                                                            <input  type="text"  value="<?= $d->szTaxId;?>" id="last-name-column" class="form-control" name="szTaxId">
                                                            </div>
                                                            
                                                            <?php if ($d->bUseComposite == 1 ){?>
                                                    <div class="form-check form-check-inline mt-3">
                                                        <input  checked class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUseComposite" value="1">
                                                        <label class="form-check-label" for="inlineCheckbox1">Menggunakan satuan komposit</label>
                                                    </div>
                                                    <?php }else{?>
                                                        
                                                        <div class="form-check form-check-inline mt-3">
                                                            <input   class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bUseComposite" value="1">
                                                            <label class="form-check-label" for="inlineCheckbox1">Menggunakan satuan komposit</label>
                                                        </div>

                                                    <?php }?>
                                                    </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="contact<?= $d->szId;?>" role="tabpanel"
                                                        aria-labelledby="contact-tab<?= $d->szId;?>">
                                                     
                                                        <div class="col">
                                                                <label class="mt-3" for="">Tipe Kategori</label>
                                                                <br>
                                                                <select class="form-control"  name="szCategoyValue" id="">
                                                                    <option value="">SEGMENTASI</option>
                                                            
                                                                </select>
                                                        </div>
                                                            
                                                        <div class="col">
                                                            <label class="mt-3" for="">Kategori</label>
                                                            <br>
                                                            <select class="form-control"  name="kategorisz" id="">
                                                                <option value="<?= $d->szCategoryValue;?>"><?= $d->nama_kategori;?></option>
                                                                <?php foreach($tipeKategori as $tp ){?>
                                                                        <option value="<?= $tp->szId;?>" ><?= $tp->szId;?> - <?= $tp->szName;?></option>
                                                                <?php }?>
                                                            </select>
                                                   </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="kit<?= $d->szId;?>" role="tabpanel"
                                                        aria-labelledby="kit-tab<?= $d->szId;?>">
                                                     
                                                        <table id="dynamic_field_sub" class="table table-striped view-this<?= $d->szId;?>" border='1px solid' >
                                                                <thead>
                                                                <tr>
                                                                    <th>Nama Produk</th>
                                                                    <th>Kuantiti</th>
                                                                    <th>Satuan</th>
                                                                    <th><button type="button" onclick="loadnew<?= $d->szId;?>()" id="btn-tambah-form" class="btn btn-primary">+</button></th>
                                                                </tr>
                                                                <thead>
                                                                <tbody id="table_update<?= $d->szId;?>">
                                                                </tbody>
                                                                
                                                            </table> 
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
                                                                <button type="submit" class="btn btn-primary">Save</button>

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


                                            <div class="modal fade text-left" id="hapus<?= $d->szId;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel17">Hapus</h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                <form action="<?= base_url();?>master/hapusProduk" method="post">          
                                                                    <input type="hidden" value="<?= $d->szId;?>" id="id_hapus_tipe" name="id_szId_gudang">
                                                                        <h6>Apakah anda yakin ingi menghapus data ini?                                                     
                                                                        <!-- <input type="text" id="first-name-column" class="form-control" name="fname-column"> -->
                                                                    </div>
                                            
                                                            </div>
                                                            </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-primary" >
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Hapus</span>
                                                                </button>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>






                    <script src="<?= base_url();?>assets/js/jquery-on.js"></script>
                    <script src="<?= base_url();?>assets/js/data-table-on.js"></script>


                    <!-- <script src="<?= base_url();?>assets/js/main.js"></script> -->
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                    <script src="<?= base_url();?>assets/js/produk.js"></script>


            
                    <script>
                    <?php foreach ($tipe as $ti ){?>
                        function <?= "detail" . $ti->szId;?>(x) {
                            var id = x;
                            // alert(id);
                            function data() {
                                $.ajax({
                                    url: "<?= base_url('master/get_kit') ?>",
                                    method: "POST",
                                    data: {
                                        'id': id
                                    },
                                    dataType: "JSON",
                                    success: function(data) {
                                        console.log(data);
                                

                                        var number = 1;
                                        var html = '';
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                '<td>' + data[i].szProductId + ' </td>' +
                                                '<td>' + data[i].szName + '</td>' +
                                                '<td>' + data[i].decQty + '</td>' +
                                                '<td>' + data[i].szUomId + '</td>' +
                                                '<tr>';
                                            number++;
                                        }
                                        $('<?= "#table_body" . $ti->szId;?>').html(html);
                                    },
                                });
                            }
                            data();
                    
                            // $('#full-scrn').modal('show');
                        }

                 

                        function <?= "edit" . $ti->szId;?>(y) {
                            var id = y;
                            // alert(id);
                            function data() {
                                $.ajax({
                                    url: "<?= base_url('master/get_kit') ?>",
                                    method: "POST",
                                    data: {
                                        'id': id
                                    },
                                    dataType: "JSON",
                                    success: function(data) {
                                        console.log(data);
                                

                                        var number = 1;
                                        var html = '';
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                '<td> ' +
                                                '<input type="hidden" name="szIdold[]"  value="'+ data[i].iInternalId + '">' +
                                                '<input class=" form-control" disabled value="'+ data[i].szName+ '"  name="idKit[]"> '+ 
                                                '</td>' +
                                                '<td><input onkeypress="return hanyaAngka(event)" required type="nummber" name="kuantitiKit[]" value="' + data[i].decQty + '" class="form-control" ></td>' +
                                                '<td><input disabled id="" name="SatuanKit[]" type="text" value="' + data[i].szUomId + '" class="form-control" ></td>' +
                                                '<td><a href="<?= base_url();?>master/hapusProduk/'+ data[i].iInternalId + '">Hapus</a></td>' +
                                            number++;
                                        }
                                        $('<?= "#table_update" . $ti->szId;?>').html(html);
                                    },
                                });
                            }
                            data();
                    
                            // $('#full-scrn').modal('show');
                        }

                  
                        var counter = 0;
                        // var counter = 0;
                        // $("#notif" + counter).hide();
                        var num = 1;
                        var code = 0;
                        function loadnew<?= $ti->szId;?>() {
                            var count = this.code;
                            var newrow = $(".view-this<?= $ti->szId;?>");
                            var cols = "";
                            cols += "<tr id='baris<?= $ti->szId;?>" + count + "'>";
                            cols += "<td>";
                            cols += "<select class='js-example-basic-single form-select form-control' name='idKitNew[]' id='idKode<?= $ti->szId;?>" + count + "' required onchange='kitProduk<?= $ti->szId;?>("+ count +")' '>";
                            cols += "<option value='-'>Pilih Produk</option>";
                            cols += "<?php foreach ($produk as $value) { ?>";
                            cols += "<option value='<?= $value->szId; ?>'><?= $value->szId; ?> - <?= $value->szName; ?></option>";
                            cols += "<?php } ?>";
                            cols += "</select>";
                            cols += "</td>";
                            cols += "<td>";
                            cols += "<input required name='kuantitiKitNew[]' type='number' id='idQty" + count + "' class='form-control'  autocomplete='off' required  onchange='getInfo(" + count + ")'>";
                            cols += "</td>";
                            cols += "<td>";
                            cols += "<input name='SatuanKitNew[]' type='text' id='satuankit<?= $ti->szId;?>"+ count +"' class='form-control' readonly>";
                            cols += "</td>";
                            cols += "<td>";
                            cols += "<a class='btn btn-danger' onclick='deleteRow<?= $ti->szId;?>(" + count + ")' style='color: white;'>-</a>";
                            cols += "</td>";
                            cols += "</tr>";
                            newrow.append(cols);
                            $("row").append(newrow);
                            // $(".js-example-basic-single").select2();
                            // $("#notif" + count).hide();
                            this.num++;
                            this.code++;
                            // this.counter++;
                            // console.log(this.counter);
                            // document.getElementById("counter").value = count;
                        }





                        $(document).on('click', '.btn_remove', function () {
                            var button_id = $(this).attr("id");
                            $('#row' + button_id).remove();
                            console.log(button_id);
                        });


                        function deleteRow<?= $ti->szId;?>(row) {
                            // this.counter -= 1;
                            var c  = this.num - 1;

                            // alert(c);

                            // this.code = this.code -1;
                            var a = document.getElementById("<?= 'baris' . $ti->szId;?>" + row);
                            a.parentNode.removeChild(a);
                        }


                        
                        function kitProduk<?= $ti->szId;?>(x){
                            // var szIdkit = $('#idKode' + x).value;
                            var szIdkit = document.getElementById('idKode<?= $ti->szId;?>' + x).value;

                            console.log(szIdkit);
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
                                        // console.log(row.data.szUomId);
                                        for (var row of data) {
                                            document.getElementById("<?= 'satuankit'. $ti->szId;?>" + x).value = row.szUomId;
                                        
                                        }



                                    },
                                });
                            }
                            data();



                        }

                        <?php 
                        $angka_format = number_format($ti->decPrice,0);
                        ?>
                        var beda<?=$ti->szId; ?> = '<?= $angka_format;?>';
                        var hasildesc<?=$ti->szId; ?> = beda<?= $ti->szId; ?>.replace(',','');
                        $("#desc<?= $ti->szId;?>").val(hasildesc<?= $ti->szId; ?>);
                        console.log(hasildesc<?=$ti->szId; ?>);
                        <?php } ?>



    function hanyaAngka(event) {
                var angka = (event.which) ? event.which : event.keyCode
                if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                    return false;
                return true;
            }









                    </script>

