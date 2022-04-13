<div class="main-content container-fluid">
    <div class="page-title">

    <section class="section">
        <div class="card">

            <div class="card-header">
            <?php echo $this->session->flashdata('massage');?>

                <div class="row">
                    <div class="col">

                        <a href="<?= base_url()?>kendaraan?id=2">NEW FORM</a>  
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
                            <th>Kode Tipe Kendaraan</th>
                            <th>Nama Tipe Kendaraan</th>
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
                                                        <div class="container">
                                                        <div class="row">
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="first-name-column">Kode Tipe Kendaraan</label>
                                                                        <input readonly type="text" value="<?= $d->szId;?>" id="first-name-column" class="form-control" name="Ktk">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="last-name-column">Nama Tipe Kendaraan</label>
                                                                        <input readonly type="text" value="<?= $d->szName;?>" id="last-name-column" class="form-control" name="Ntk">
                                                                    </div>
                                                                </div>
                                                                <?php 

                                                                        $angka_format_edit = number_format($d->decWeight,0);
                                                                             $angka_vol_edit = number_format($d->decVolume,0);

                                                                ?>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="first-name-column">Max Berat</label>
                                                                        <input readonly type="text" value="<?= $angka_format_edit ;?>" id="first-name-column" class="form-control" name="max">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="last-name-column">Volume</label>
                                                                        <input readonly type="text" id="last-name-column" value="<?= $angka_vol_edit;?>" class="form-control" name="vol">
                                                                    </div>
                                                                </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                            <label for="">Keterangan</label>
                                                            <textarea readonly name="ketKendaraan" class="form-control" id="" cols="30" rows="3"><?= $d->szDescription;?></textarea>
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




            
                                    <div class="modal fade text-left" id="update<?= $d->szId;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
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
                                                        <form action="<?= base_url();?>kendaraan/updateTipekendaraan" method="post">
                                                            <input type="hidden" value="<?= $d->szId;?>" id="id_sz" name="id">
                                                        <div class="row">
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="first-name-column">Kode Tipe Kendaraan</label>
                                                                        <input disabled  type="text" value="<?= $d->szId;?>" id="first-name-column" class="form-control" name="Ktk">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="last-name-column">Nama Tipe Kendaraan</label>
                                                                        <input required type="text" value="<?= $d->szName;?>" id="last-name-column" class="form-control" name="Ntk">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="first-name-column">Max Berat</label>
                                                                        <input required type="text" onkeypress="return hanyaAngka(event)" value="" id="desc<?= $d->szId;?>" class="form-control" name="max">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="last-name-column">Volume</label>
                                                                        <input  required type="text" onkeypress="return hanyaAngka(event)" id="vol<?= $d->szId;?>" value="" class="form-control" name="vol">
                                                                    </div>
                                                                </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                            <label for="">Keterangan</label>
                                                            <textarea required name="ketKendaraan" class="form-control" id="" cols="30" rows="3"><?= $d->szDescription;?></textarea>
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
                                                              <form action="<?= base_url();?>kendaraan/hapusTipekendaraan" method="post">          
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


                    <!-- <script src="<?= base_url(); ?>assets/master/js/main.js"></script> -->
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                    <script src="<?= base_url(); ?>assets/master/js/tipe_kendaraan.js"></script>



<script type="text/javascript">
 <?php foreach ($tipe as $ti){?>
                           <?php 
                        $angka_format = number_format($ti->decWeight,0);
                        $angka_vol= number_format($ti->decVolume,0);
                        ?>
                        var beda<?=$ti->szId; ?> = '<?= $angka_format;?>';
                        var vol<?=$ti->szId; ?> = '<?= $angka_vol;?>';
                        var hasildesc<?=$ti->szId; ?> = beda<?= $ti->szId; ?>.replace(',','');
                        var hasilVol<?=$ti->szId; ?> = vol<?= $ti->szId; ?>.replace(',','');
                        $("#desc<?= $ti->szId;?>").val(hasildesc<?= $ti->szId; ?>);
                        $("#vol<?= $ti->szId;?>").val(hasilVol<?= $ti->szId; ?>);
                        <?php }?>
                        function hanyaAngka(event) {
                                    var angka = (event.which) ? event.which : event.keyCode
                                    if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                                        return false;
                                    return true;
                                }


    
</script>


         



