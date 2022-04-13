<link rel="stylesheet" href="<?= base_url();?>assets/vendors/simple-datatables/style.css">
<div class="main-content container-fluid">
    <div class="page-title">

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">

                        <a href="<?= base_url()?>master?id=5">NEW FORM</a>  
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




<?php foreach($tipe as $d ){?>

    <div class="modal fade text-left" id="large<?= $d->szId;?>" tabindex="-1" role="dialog"
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
                                                                            <input disabled type="text" id="szId" value="<?= $d->szId;?>" class="form-control" name="fname-column">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="last-name-column">Nama satuan</label>
                                                                            <input disabled type="text" id="szName" value="<?= $d->szName;?>" class="form-control" name="lname-column">
                                                                        </div>
                                                                    </div>
                                                            <div class="col">
                                                                <div class="form-group">                                                                <label for="">Keterangan</label>    
                                                                <div id="szDescription"></div>
                                                                <textarea name="" disabled class="form-control" id="szDescription" cols="30" rows="3"><?= $d->szDescription;?></textarea>
                                                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">                                                                <label for="">Digunakan Untuk perhitungan harga</label>   
                                                                <br>
                                                                <?php if($d->bUseForPriceCalc == 1 ){?>
                                                                <input type="checkbox" name="TKcategori" id="" checked disabled class="">
                                                                <?php }else{?>
                                                                    <input type="checkbox" name="TKcategori" id="" disabled  class="">

                                                                <?php }?>
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
                                                        <form action="<?= base_url();?>master/updateTipekategori" method="post">
                                                            <input type="hidden" value="<?= $d->szId;?>" id="id_sz" name="id">
                                                            <div class="row">
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="">Kategori Produk</label>
                                                                        <input required  disabled type="text" value="<?= $d->szId;?>" id="kode_tipe" class="form-control kode_tipe" name="TKkategori">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="last-name-column">Tipe Kategori Produk</label>
                                                                        <input required value="<?= $d->szName;?>" type="text" id="last-name-column" class="form-control" name="TKnkategori">
                                                                    </div>
                                                                </div>
                                                        <div class="col">
                                                        <div class="form-group">
                                                            <label for="">Keterangan</label>
                                                            <textarea required value="" name="TKdescription" class="form-control" id="" cols="30" rows="3"><?= $d->szDescription;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        <div class="col mt-2">
                                                        <div class="form-group">

                                                            <label for="">Digunakan Untuk perhitungan harga</label>
                                                            <br>
                                                            <?php if ($d->bUseForPriceCalc == 1 ){?>
                                                            <input type="checkbox" value="1" checked name="TKcategori" id="" class="">
                                                            <?php }else{?>
                                                                <input type="checkbox" value="1" name="TKcategori" id="" class="">
                                                            
                                                            <?php }?>
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
                                                   
                                                            </form>
                                                        </div>                          
                                                    </div>
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
<?php }?>

                    <script src="<?= base_url();?>assets/js/jquery-on.js"></script>
                    <script src="<?= base_url();?>assets/js/data-table-on.js"></script>
                    <!-- <script src="<?= base_url();?>assets/vendors/simple-datatables/simple-datatables.js"></script>
                    <script src="<?= base_url();?>assets/js/vendors.js"></script> -->


                    <script src="<?= base_url();?>assets/js/main.js"></script>
                    <script src="<?= base_url();?>assets/js/chosen.js"></script>
                    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
                    <!-- <script src="<?= base_url();?>assets/js/satuan.js"></script> -->


<script>
    
var satuanDataTable = $('#satuan').DataTable({ 
                responsive: true, 
                oLanguage: {
                sSearch: 'Search:'
                    },
                processing : true,
                serverSide: true,
                serverMethod: 'POST',
                ajax : {

                    dataType: 'json',
                    url: 'get_ajax_TipeKategoriProduk',
                    data: function(data){

                        // console.log(data);
                        console.log($('[name=status]').val());
                        // console.log($('[name=date2]').val());
                        data.status = $('[name=status]').val();
                        // data.filterTgl2 = $('[name=date2]').val();
                        // data.filterSingkatan = $('#singkatan').val();
              
                    }
                },
                columns: [ 
                    // { data: 'no'},
                    { data: 'iInternalId'},
                    { data: 'iId'}, 
                    { data: 'Szname'}, 
                    { data: 'Szid'},
                    { data: 'action' , orderable : false }
                ],

                order: [[ 0, "ASC" ]]
            });


       
            $("#filterSatuan").on("change", () => {
                satuanDataTable.draw();

            });

            // $(document).on('click', '.cari', function () {
             
          
            //     satuanDataTable.draw();
        
            
            // })


















</script>


