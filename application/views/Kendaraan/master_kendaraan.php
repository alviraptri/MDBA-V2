<div class="main-content container-fluid">
    <div class="page-title">

    <section class="section">
        <div class="card">

            <div class="card-header">
            <?php echo $this->session->flashdata('massage');?>

                <div class="row">
                    <div class="col">

                        <a href="<?= base_url()?>kendaraan?id=1">NEW FORM</a>  
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
                            <th>Kode kendaran</th>
                            <th>No rangka</th>
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
                                                                    <label for="first-name-column">Kode Kendaraan</label>
                                                                    <input readonly type="text" value="<?= $d->szId;?>" id="first-name-column" class="form-control" name="Kkendaraan">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="last-name-column">Cabang</label>
                                                                    <input readonly type="text" value="<?= $d->depo_nama;?>" id="last-name-column" class="form-control" name="szBranchId">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Jenis Kendaraan</label>
                                                                    <input readonly type="text" id="first-name-column" value="<?= $d->szVehicleTypeId;?>" class="form-control" name="szVehicleTypeId">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="last-name-column">No Polisi</label>
                                                                    <input readonly type="text" id="last-name-column" value="<?= $d->szName;?>" class="form-control" name="Nkendaraan">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">No Rangka</label>
                                                                    <input readonly type="text" id="first-name-column" value="<?= $d->szChassisNo;?>" class="form-control" name="szChassisNo">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="last-name-column">No Mesin</label>
                                                                    <input readonly type="text" value="<?= $d->szMachineNo;?>" id="last-name-column" class="form-control" name="szMachineNo">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Tanggal Berakhir STNK</label>
                                                                <!-- <textarea name="" class="form-control" id="" cols="30" rows="5"></textarea> -->
                                                                <input type="date" readonly value="<?= $d->tgl;?>" name="dtmVehicleLicense" id="" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                    <div class="form-group">
                                                        <div class="form-group">                                                      
                                                          <label for="">Keterangan</label>
                                                        <textarea readonly name="ketKendaraan" class="form-control" id="" cols="30" rows="3"><?= $d->szDescription;?></textarea>
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
                                                        <form action="<?= base_url();?>kendaraan/updateKendaraan" method="post">
                                                            <input type="hidden" value="<?= $d->szId;?>" id="id_sz" name="id">

                                                            <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Kode Kendaraan</label>
                                                                    <input disabled  type="text" value="<?= $d->szId;?>" id="first-name-column" class="form-control" name="Kkendaraan">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="last-name-column">Cabang</label>
                                                                    <select class="form-control " name="szBranchId"> 
                                                                    <option value="<?= $d->szBranchId;?>" ><?= $d->depo_nama;?> </option>   
                                                               
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Jenis Kendaraan</label>
                                                                    <!-- <input required type="text" id="first-name-column" value="<?= $d->szVehicleTypeId;?>" class="form-control" name="szVehicleTypeId"> -->
                                                                      
                                                                    <select name="szVehicleTypeId" class='form-control'> 
                                                                            <option value="<?= $d->szVehicleTypeId;?>"><?= $d->szVehicleTypeId;?></option>
                                                                            <?php foreach ($kendaraan as $s){?> 
                                                                            <option value="<?= $s->szName;?>"><?= $s->szName;?></option>
                                                                            <?php }?>
                                                                        </select>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="last-name-column">No Polisi</label>
                                                                    <input required type="text" id="last-name-column" value="<?= $d->szName;?>" class="form-control" name="Nkendaraan">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">No Rangka</label>
                                                                    <input  required type="text" id="first-name-column" value="<?= $d->szChassisNo;?>" class="form-control" name="szChassisNo">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label for="last-name-column">No Mesin</label>
                                                                    <input  required type="text" value="<?= $d->szMachineNo;?>" id="last-name-column" class="form-control" name="szMachineNo">
                                                                </div>
                                                            </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                    <label for="">Tanggal Berakhir STNK</label>
                                                                    <!-- <textarea name="" class="form-control" id="" cols="30" rows="5"></textarea> -->
                                                                    <input required type="date"  value="<?= $d->tgl;?>" name="dtmVehicleLicense"  class="form-control">
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

                                                    <div class="col">
                                                        <div class="form-group">                                                      
                                                          <label for="">Keterangan</label>
                                                        <textarea required  name="ketKendaraan" class="form-control" id="" cols="30" rows="3"><?= $d->szDescription;?></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                   
                                          
                                                        </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>

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
                                                              <form action="<?= base_url();?>kendaraan/hapusKendaraan" method="post">          
                                                                <input type="hidden" value="<?= $d->szId;?>" id="id_hapus" name="id_hapus">
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



                    <script src="<?= base_url(); ?>assets/master/js/jquery-on.js"></script>
                    <script src="<?= base_url(); ?>assets/master/js/data-table-on.js"></script>


                    <!-- <script src="<?= base_url();?>assets/js/main.js"></script> -->
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                    <script src="<?= base_url(); ?>assets/master/js/kendaraan.js"></script>








