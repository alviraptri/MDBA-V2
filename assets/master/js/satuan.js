
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
                    url: 'get_ajax_satuan',
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







            $(document).on('click', '.editSatuan', function () {
    
                var szId = $(this).attr("szId");
                $('#szId').val(szId)
            
            
                var szName = $(this).attr("szName");
                $("#szName").val(szName)
                
                var aktif = $(this).attr("aktif");
            
                if (aktif == 1 ){
            
                    $("#aktif").val('aktif')
                    
                }else{
                    
                    $("#aktif").val('Tidak Aktif')
                    
                }
                
                var szDescription = $(this).attr("deskripsi");
                $("#szDescription").text(szDescription)
                console.log(szDescription);
            
            })
            
            
            $(document).on('click', '.updateSatuan', function () {
             
                
                var id = $(this).attr("szId");
                $('#id_sz').val(id)
            
            })
            

            
            $(document).on('click', '.hapusSatuan', function () {
             
                var id_szid = $(this).attr("szId_hapus");
                // console.log(id_szid);
                $('#id_hapus_satuan').val(id_szid)
            
            })
            


















