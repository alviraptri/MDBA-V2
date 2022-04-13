var TipeDataTable = $('#tableDua').DataTable({ 
    responsive: true, 
    oLanguage: {
    sSearch: 'Search:'
        },
    processing : true,
    serverSide: true,
    serverMethod: 'POST',
    ajax : {

        dataType: 'json',
        url: 'get_ajax_tipeStok',
        data: function(data){

            // console.log(data);
            // console.log($('[name=date]').val());
            // console.log($('[name=date2]').val());
            data.statusTipe = $('[name=statusTipe]').val();
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


$("#statusTipe").on("change", () => {
    TipeDataTable.draw();

})



// $(document).on('click', '.edittipe', function () {
    
//     var szId = $(this).attr("szId");
//     $('#szIdTipe').val(szId)


//     var szName = $(this).attr("szName");
//     $("#szNameTipe").val(szName)
    
//     var aktif = $(this).attr("aktif");

//     if (aktif == 1 ){

//         $("#aktifTipe").val('aktif')
        
//     }else{
        
//         $("#aktifTipe").val('Tidak Aktif')
        
//     }
    
//     var szDescription = $(this).attr("deskripsi");
//     $("#szDescriptionTipe").text(szDescription)
//     console.log(szDescription);

// })


$(document).on('click', '.updatetipe', function () {
 
    
    var id = $(this).attr("szId");
    $('#id_sz_tipe').val(id)

})


$(document).on('click', '.hapusSatuan', function () {
             
    var id_szid_tipe = $(this).attr("szId_hapus");
    // console.log(id_szid);
    $('#id_hapus_tipe').val(id_szid_tipe)

})



$("#filterTipe").on("change", () => {
    TipeDataTable.draw();

})

// $(document).on('click', '.hapusSatuan', function () {
 
//     var id_szid = $(this).attr("szId_hapus");
//     console.log(id_szid);
//     $('#id_hapus_satuan').val(id_szid)

// })











