


function populateDataTable(){
    $('#example').dataTable().fnClearTable();
    $('#example').dataTable().fnDestroy();
    $facility_id = $('#facility_id').val();

    $('#example').DataTable({ 
        columnDefs: [{ width: 5, targets: 0 }],
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'asset_data/function.php?fn=getTableData&facility_id='+$facility_id },
        dom: 'Bfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print'
            },
        ] 

    });
}//end fun 

function generatePMSLink($asset_id){
    console.log('asset_id: ' + $asset_id);
     
    $.ajax({
        method: "POST",
        url: "asset_data/function.php",
        data: { fn: "generateLink", asset_id: $asset_id }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            window.open('pms_dashboard/pms_link.php?pms_info_id='+$res1.pms_info_id, '_blank');
        }else{
            alert($res1.error_message);
        }  
    });//end ajax
}//end fun 

function generateCalibLink($asset_id){
    console.log('asset_id: ' + $asset_id);
     
    $.ajax({
        method: "POST",
        url: "asset_data/function.php",
        data: { fn: "generateCalibLink", asset_id: $asset_id }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            window.open('calibration_dashboard/calib_link.php?calib_info_id='+$res1.calib_info_id, '_blank');
        }else{
            alert($res1.error_message);
        }  
    });//end ajax
}//end fun

$(document).ready(function () { 
    populateDataTable();
});