var TipekendaraanDataTable = $('#kendaraan').DataTable({ 
    responsive: true, 
    oLanguage: {
    sSearch: 'Search:'
        },
    processing : true,
    serverSide: true,
    serverMethod: 'POST',
    ajax : {

        dataType: 'json',
        url: 'get_ajax_ekspedisi',
        data: function(data){

            // console.log(data);
            // console.log($('[name=date]').val());
            // console.log($('[name=date2]').val());
            data.status = $('[name=statusKendaraan]').val();
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


$("#filterKendaraan").on("change", () => {
    TipekendaraanDataTable.draw();

})

