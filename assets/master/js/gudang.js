





var gudangDataTable = $('#gudang').DataTable({ 
    responsive: true, 
    oLanguage: {
    sSearch: 'Search:'
        },
    processing : true,
    serverSide: true,
    serverMethod: 'POST',
    ajax : {

        dataType: 'json',
        url: 'get_ajax_gudang',
        data: function(data){

            // console.log(data);
            // console.log($('[name=date]').val());
            // console.log($('[name=date2]').val());
            data.statusGudang = $('[name=statusGudang]').val();
            // data.filterTgl2 = $('[name=date2]').val();
            // data.filterSingkatan = $('#singkatan').val();
  
        }
    },
    columns: [ 
        // { data: 'no'},
        { data: 'iInternalId'},
        { data: 'iId'}, 
        { data: 'Szname'}, 
        { data: 'depo'}, 
        { data: 'Szid'},
        { data: 'action' , orderable : false }
    ],

    order: [[ 0, "ASC" ]]
});


$("#filterGudang").on("change", () => {
    gudangDataTable.draw();

})




$(document).on('click', '.editgudang', function () {
    
    var szId = $(this).attr("szId");
    $('#szId').val(szId)


    var szName = $(this).attr("szName");
    $("#szName").val(szName)

    var depo = $(this).attr("depo");
    $("#depo_gudang").val(depo)
    
    var aktif = $(this).attr("aktif");

    if (aktif == 1 ){

        $("#aktif").val('aktif')
        
    }else{
        
        $("#aktif").val('Tidak Aktif')
        
    }
    
    var szDescription = $(this).attr("deskripsi");
    $("#szDescription").text(szDescription)
    // console.log(szDescription);

})


$(document).on('click', '.updateGudang', function () {
 
    
    var id_gudang = $(this).attr("szIdgudang");
    console.log(id_gudang);
    $('#id_szgudang').val(id_gudang)

})


$(document).on('click', '.hapusSatuan', function () {
             
    var id_szid_tipe = $(this).attr("szId_hapus");
    // console.log(id_szid);
    $('#id_hapus_tipe').val(id_szid_tipe)

})








