<div class="main-content container-fluid">
    <div class="page-title">

    <section class="section">
        <div class="card">

            <div class="card-header">
            <?php echo $this->session->flashdata('massage');?>

                <div class="row">
                    <div class="col">

                        <a href="<?= base_url()?>master?id=2">NEW FORM</a>  
                    </div>
                    <div class=" col-sm-3 text-right">
                        <select style="float:right;" name="statusTipe" class="form-select  " id="filterTipe">
                          <option value="">Status Produk</option>
                          <option value="1">Aktif</option>
                          <option value="0">Tidak Aktif</option>
                      </select>

                    </div>

                </div>

            </div>
            <div class="card-body">
                <table class='table table-striped' id="tableDua">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>ID Tipe Stock</th>
                            <th>Nama Tipe Stock</th>
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




                                        <?php foreach ($tipe as $d){?>

                                        <div class="modal fade text-left" id="large<?=$d->iInternalId;?>" tabindex="-1" role="dialog"
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
                                                                            <label for="first-name-column">Kode Satuan</label>
                                                                            <input disabled type="text" id="szIdTipe" value="<?=$d->szId;?>" class="form-control" name="fname-column">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="last-name-column">Nama satuan</label>
                                                                            <input disabled type="text" id="szNameTipe" value="<?=$d->szName;?>" class="form-control" name="lname-column">
                                                                        </div>
                                                                    </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                <label for="">Keterangan</label>    
                                                                <div id="szDescriptionTipe">
                                                                <textarea disabled class="form-control"  name="ketTipe" id="" cols="30" rows="3"><?= $d->szDescription;?></textarea>

                                                                </div>
                                                                </div>
                                                                <!-- <textarea name="" class="form-control" id="szDescription" cols="30" rows="5"></textarea> -->
                                                            
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




            
             <div class="modal fade text-left" id="update<?= $d->iInternalId;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
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
                                                        <form action="<?= base_url();?>master/updateTipeStok" method="post">
                                                            <input type="hidden" value="<?= $d->szId;?>" id="id_sz" name="id">
                                                            <div class="row">
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="first-name-column">Kode Tipe Stok</label>
                                                                            <input disabled type="text" id="szIdTipe" value="<?=$d->szId;?>" class="form-control" name="Ktipe">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="last-name-column">Nama Tipe Stok</label>
                                                                            <input  required type="text" id="szNameTipe" value="<?=$d->szName;?>" class="form-control" name="Ntipe">
                                                                        </div>
                                                                    </div>
                                                            <div class="col">
                                                                <div class="form-group">                                                               <label for="">Keterangan</label>    
                                                                <div id="szDescriptionTipe">
                                                                    <textarea required class="form-control"  name="ketTipe" id="" cols="30" rows="3"><?= $d->szDescription;?></textarea>
                                                                </div>
                                                            </div>
                                                                <!-- <textarea name="" class="form-control" id="szDescription" cols="30" rows="5"></textarea> -->
                                                            
                                                            </div>
                                                        <div class="row">
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


                                        <div class="modal fade text-left" id="hapus<?= $d->iInternalId;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
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
                                                              <form action="<?= base_url();?>master/hapusTipe" method="post">          
                                                                <input type="hidden" value="<?= $d->szId;?>" id="id_hapus_tipe" name="id_szId_tipe">
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
                                                            <button type="submit" class="btn btn-primary"
                                                            >
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
                    <script src="<?= base_url();?>assets/js/tipestok.js"></script>








