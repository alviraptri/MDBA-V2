<link rel="stylesheet" href="<?= base_url();?>assets/vendors/simple-datatables/style.css">

<div class="main-content container-fluid">
    <div class="page-title">

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">

                        <a href="<?= base_url()?>master?id=1">NEW FORM</a>  
                    </div>


                    <div class=" col-sm-3 text-right">
                        <select style="float:right;" name="status"  class="form-select" id="filterSatuan">
                          <option value="">Status Produk</option>
                          <option value="1">Aktif</option>
                          <option value="0">Tidak Aktif</option>
                      </select>

                    </div>

                </div>

            </div>
            <div class="card-body">
            <?php echo $this->session->flashdata('massage');?>

                <table class='table table-striped' id="satuan">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>ID Satuan</th>
                            <th>Nama</th>
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



                            <?php foreach ($tipe as $t){?>

                            <div class="modal fade text-left" id="large<?= $t->szId;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
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
                                                                            <label for="first-name-column">Kode Satuan</label>
                                                                            <input disabled type="text" id="szId" value="<?= $t->szId;?>" class="form-control" name="fname-column">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="last-name-column">Nama satuan</label>
                                                                            <input disabled type="text" id="szName" value="<?= $t->szName;?>" class="form-control" name="lname-column">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                        <label for="">Keterangan</label>    
                                                                        <textarea disabled name="ketsatuan" id="" class="form-control" cols="30" rows="3"><?= $t->szDescription;?></textarea>

                                                                        <!-- <textarea name="" class="form-control" id="szDescription" cols="30" rows="5"></textarea> -->
                                                                    
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




             <div class="modal fade text-left" id="update<?= $t->szId;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
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
                                                        <form action="<?= base_url();?>master/updateSatuan" method="post">
                                                            <input type="hidden" value="<?= $t->szId;?>" id="id_sz" name="id">
                                                        <div class="row">
                                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Kode Satuan</label>
                                                    <input disabled type="text" id="szId" value="<?= $t->szId;?>" class="form-control" name="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Nama satuan</label>
                                                    <input  type="text" required id="szName" value="<?= $t->szName;?>" class="form-control" name="Nsatuan">
                                                </div>
                                            </div>
                                    <div class="col">
                                        <div class="form-group">
                                        <label for="">Keterangan</label>    
                                        <div id="szDescription">
                                            <textarea required name="ketsatuan" id="" class="form-control" cols="30" rows="3"><?= $t->szDescription;?></textarea>
                                        </div>
                                    </div>
                                        <!-- <textarea name="" class="form-control" id="szDescription" cols="30" rows="5"></textarea> -->
                                      
                                    
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Status</label>
                                                                    <select name="status" id="" class="form-control">
                                                                        <?php if ($t->status == 1 ){?>
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
                            <?php }?>

                                        
                    <script src="<?= base_url();?>assets/js/jquery-on.js"></script>
                    <script src="<?= base_url();?>assets/js/data-table-on.js"></script>
                    <!-- <script src="<?= base_url();?>assets/vendors/simple-datatables/simple-datatables.js"></script>
                    <script src="<?= base_url();?>assets/js/vendors.js"></script> -->


                    <script src="<?= base_url();?>assets/js/main.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                    <script src="<?= base_url();?>assets/js/satuan.js"></script>




