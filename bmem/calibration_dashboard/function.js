$('#onMyModal').on('click', function(){
    localStorage.setItem('author_photo', '');
    clearForm();
    $('#exampleModalLong').modal('show');
}) 

$(".form-control").blur(function(){
    $('#orgFormAlert').css("display", "none");
    $formVallidStatus = validateForm();
}); 

function populateDataTable(){
    $('#example').dataTable().fnClearTable();
    $('#example').dataTable().fnDestroy();

    $('#example').DataTable({ 
        columnDefs: [{ width: 5, targets: 0 } ],
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'calibration_dashboard/function.php?fn=getTableData' },
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
        ],
        order: [[0, 'asc']],

    });
}//end fun

function populateDataTable_1(){
    $('#example_1').dataTable().fnClearTable();
    $('#example_1').dataTable().fnDestroy();

    $facility_id = $('#facility_id').val();
    $facility_code = $('#facility_code').val();
    $device_group = $('#device_group').val();
    $asset_class = $('#asset_class').val();

    $department_id = $('#department_id').val();
    $PMSStatus = $('#PMSStatus').val();
    $PMSRequired = $('#PMSRequired').val();

    $from_date = $('#from_date').val();
    $to_date = $('#to_date').val();

    $('#example_1').DataTable({ 
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'calibration_dashboard/function.php?fn=getTableData_1&facility_id='+$facility_id+'&facility_code='+$facility_code+'&device_group='+$device_group+'&asset_class='+$asset_class+'&department_id='+$department_id+'&PMSStatus='+$PMSStatus+'&PMSRequired='+$PMSRequired+'&from_date='+$from_date+'&to_date='+$to_date },
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
                $('#facility_id').html(''); 
                $html = "<option value=''>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].facility_id+"'>"+$rows[$i].facility_name+"</option>";                    
                }//end for
                
                $('#facility_id').html($html);  
            }//end if
        }        
    });//end ajax
}//end

$('#facility_id').on('change', function(){ 
    $facility_id = $('#facility_id').val();  
    $.ajax({
        method: "POST",
        url: "asset/function.php",
        data: { fn: "getAllDepartmentName", facility_id_dd: $facility_id }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res); 
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#department_id').html('');
                $html = "<option value=''>Select</option>";                             
                for($i = 0; $i < $rows.length; $i++){                                 
                    $html += "<option value='"+$rows[$i].department_id+"'>"+$rows[$i].department_name+"</option>";                    
                }//end for
                console.log($html);
                $('#department_id').html($html);
            }//end if
        }        
    });//end ajax  
})

//DeviceGroup
function configureDeviceGroupDropDown(){
    $.ajax({
        method: "POST",
        url: "asset/function.php",
        data: { fn: "getAllDeviceGroupName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res); 
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#device_group').html('');
                $html = "<option value=''>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].device_group_id+"'>"+$rows[$i].device_name+"</option>";                    
                }//end for
                //console.log($html)
                $('#device_group').html($html);
            }//end if
        }        
    });//end ajax
}//end

$('#generateLink').on('click', function(){ 
    $.ajax({
        method: "POST",
        url: "calibration_dashboard/function.php",
        data: { fn: "generateLink" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            window.open('calibration_dashboard/calib_link.php?calib_info_id='+$res1.calib_info_id, '_blank');
        }else{
            alert($res1.error_message);
        }  
    });//end ajax
});

$('#filterPMS').on('click', function(){
    populateDataTable_1();
    $('#searchResDiv').removeClass('d-none');
    $('#searchResDiv').addClass('d-block');
    $('#searchResDiv')[0].scrollIntoView(true); 
})

$('#clearSearchForm').on('click', function(){ 
    $('#pmsSerForm').trigger('reset');
    $('#searchResDiv').removeClass('d-block');
    $('#searchResDiv').addClass('d-none');
})

function initTicketCounter(){   
    $.ajax({
        method: "POST",
        url: "calibration_dashboard/function.php",
        data: { fn: "initTicketCounter"}
    })
    .done(function( res ) {
        $res1 = JSON.parse(res); 
        if($res1.status == true){ 
            $('#total_ticket').html($res1.total_ticket); 
            $('#pending_pms').html($res1.pms_due);
            $('#pending_pms1').html($res1.pms_dopms_scheduledne);
            $('#pms_done').html($res1.pms_done);  
        }        
    });//end ajax 
}


function updatePMSStatus($calib_id, $asset_id){
    $pms_status = $('#calib_id_'+$calib_id).val();
    console.log('calib_id: ' + $calib_id + ' pms_status: ' + $pms_status);

    if(confirm('Are you sure to change status?')){
        $.ajax({
            method: "POST",
            url: "calibration_dashboard/function.php",
            data: { fn: "updatePMSStatus", calib_id: $calib_id, pms_status: $pms_status, asset_id: $asset_id }
        })
        .done(function( res ) {
            //console.log(res);
            $res1 = JSON.parse(res);
            if($res1.status == true){
                alert('Status Updated Successfully');
                populateDataTable_1();
            }
        }); //end ajax
    }
}


function updateSpEnggStatus($calib_id){
    $assign_to_sp_engg_status = $('#assign_to_sp_engg_'+$calib_id).val();
    console.log('calib_id: ' + $calib_id + ' assign_to_sp_engg_status: ' + $assign_to_sp_engg_status);

    if(confirm('Are you sure to change status?')){
        $.ajax({
            method: "POST",
            url: "calibration_dashboard/function.php",
            data: { fn: "updateSpEnggStatus", calib_id: $calib_id, assign_to_sp_engg_status: $assign_to_sp_engg_status }
        })
        .done(function( res ) {
            //console.log(res);
            $res1 = JSON.parse(res);
            if($res1.status == true){
                alert('Status Updated Successfully');
                populateDataTable_1();
            }
        }); //end ajax
    }
}

$(document).ready(function () {
    initTicketCounter();
    configureDeviceGroupDropDown();
    configureFacilityDropDown();
    populateDataTable(); 
});