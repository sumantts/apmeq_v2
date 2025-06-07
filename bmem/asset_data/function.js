


function populateDataTable(){
    $('#example').dataTable().fnClearTable();
    $('#example').dataTable().fnDestroy();
    $facility_id = $('#facility_id').val();
    $due_type = $('#due_type').val();

    $('#example').DataTable({ 
        columnDefs: [{ width: 5, targets: 0 }],
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'asset_data/function.php?fn=getTableData&facility_id='+$facility_id+'&due_type='+$due_type },
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

function generateQALink($asset_id){
    console.log('asset_id: ' + $asset_id);
     
    $.ajax({
        method: "POST",
        url: "asset_data/function.php",
        data: { fn: "generateLinkQA", asset_id: $asset_id }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            window.open('qa_dashboard/qa_link.php?qa_info_id='+$res1.qa_info_id, '_blank');
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

//Facility
function configureFacilityDropDown(){
    $.ajax({
        method: "POST",
        url: "user_facility/function.php",
        data: { fn: "getAllFacilityName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#facility_id_s').html(''); 
                $html = "<option value=''>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].facility_id+"'>"+$rows[$i].facility_name+"</option>";                    
                }//end for
                
                $('#facility_id_s').html($html); 
            }//end if
        }        
    });//end ajax
}//end



$('#facility_id_s').on('change', function(){
    setTimeout(function(){        
        $facility_id_s = $('#facility_id_s').val();  

        
        if($facility_id_s > 0){
            /****
            $.ajax({
                method: "POST",
                url: "asset/function.php",
                data: { fn: "getAllDepartmentName", facility_id_dd: $facility_id_s }
            })
            .done(function( res ) {
                $res1 = JSON.parse(res); 
                if($res1.status == true){
                    $rows = $res1.data;

                    if($rows.length > 0){
                        $('#from_dept_id').html('');
                        $('#to_dept_id').html('');
                        $html = "<option value=''>Select</option>";
                        for($i = 0; $i < $rows.length; $i++){ 
                            $html += "<option value='"+$rows[$i].department_id+"' >"+$rows[$i].department_name+"</option>";                    
                        }//end for
                        
                        $('#from_dept_id').html($html);
                        $('#to_dept_id').html($html);
                    }//end if
                }        
            });//end ajax 
            ****/
            //Get Facility ID            
            $.ajax({
                method: "POST",
                url: "reallocated_asset_details/function.php",
                data: { fn: "getFacilityID", facility_id_dd: $facility_id_s }
            })
            .done(function( res ) {
                $res1 = JSON.parse(res); 
                if($res1.status == true){
                    $('#facility_code').val($res1.facility_code);                    
                }        
            });//end ajax 
        }//end if
    },500);
})

$('#pmsSerForm').on('submit', function(){
    $due_type = $('#due_type').val();
    populateDataTable();
    console.log('due_type: ' + $due_type);
    return false;
})

$('#clearSearchForm').on('click', function(){
    $('#pmsSerForm').trigger("reset");
    populateDataTable();
})

$(document).ready(function () { 
    populateDataTable();
    configureFacilityDropDown();
});