$('#clearForm').on('click', function(){
    console.log('clear FormData');
    $('#myFormS').trigger('reset');
    $('#facility_id_s').val('0').trigger('change');
    $('#department_id').val('0').trigger('change');
    $('#call_log_status').val('0').trigger('change');
    $('#day_wise').val('0').trigger('change');
    $('#device_group').val('0').trigger('change');
    $('#ticket_class').val('-1').trigger('change'); 
    
    $('#filteredTicketDiv').removeClass('d-block');
    $('#filteredTicketDiv').addClass('d-none');
})

$("#partTwoSwitch").click(function(){
    $("#partTwoBoard").toggle('slow');
});

$('#myFormS').on('submit', function(){    
    $facility_id_s = $('#facility_id_s').val();
    $department_id = $('#department_id').val(); 
    $call_log_status = $('#call_log_status').val();
    $token_id = $('#token_id').val(); 
    $day_wise = $('#day_wise').val(); 
    $device_group = $('#device_group').val(); 
    $equipment_name = $('#equipment_name').val(); 
    $ticket_class = $('#ticket_class').val();  
    $from_dt = $('#from_dt').val();  
    $to_dt = $('#to_dt').val();  
    $warranty_sr = $('#warranty_sr').val(); 
    
    if($facility_id_s > 0 || $department_id > 0 || $call_log_status > 0 || $token_id != '' || $day_wise > 0 || $device_group > 0 || $equipment_name != '' || $ticket_class >= 0 || $from_dt != '' || $to_dt != '' || $warranty_sr != ''){
        populateDataTable_1();
        $('#filteredTicketDiv').removeClass('d-none');
        $('#filteredTicketDiv').addClass('d-block');
    }else{
        alert('Please choose search parameter');
    }
    return false;
})

$('#myFormM').on('submit', function(){    
    $assign_to = $('#assign_to').val();
    $eng_contact_no = $('#eng_contact_no').val(); 
    $call_log_statusM = $('#call_log_statusM').val();
    $resolved_date_time = $('#resolved_date_time').val(); 
    $call_log_id = $('#call_log_id').val(); 
    
    $.ajax({
        method: "POST",
        url: "ticket_dashboard/function.php",
        data: { fn: "updateTicketInfo", assign_to: $assign_to, eng_contact_no: $eng_contact_no, call_log_statusM: $call_log_statusM, resolved_date_time: $resolved_date_time, call_log_id: $call_log_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){
            alert('Data updated successfully');
        }
    });//end ajax
    
    return false;
})

function editTableData($call_log_id){
    $('#exampleModalLong').modal('show');
    $.ajax({
        method: "POST",
        url: "ticket_dashboard/function.php",
        data: { fn: "getFormEditData", call_log_id: $call_log_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $('#call_log_id').val($call_log_id);  
            $('#assign_to').val($res1.assign_to).trigger('change');
            $('#eng_contact_no').val($res1.eng_contact_no);
            $('#call_log_statusM').val($res1.call_log_status).trigger('change');
            $('#resolved_date_time').val($res1.resolved_date_time); 
            $html = '';
            $html += '<div><strong>Issue Description: </strong>'+$res1.issue_description+'</div>';
            $('#ticket_data').html($html);
        }
    });//end ajax
}//end functon

//Delete function	
function deleteTableData($call_log_id){
    if (confirm('Are you sure to delete the Data?')) {
        $.ajax({
            method: "POST",
            url: "ticket_dashboard/function.php",
            data: { fn: "deleteTableData", call_log_id: $call_log_id }
        })
        .done(function( res ) {
            //console.log(res);
            $res1 = JSON.parse(res);
            if($res1.status == true){
                $('#orgFormAlert').show();
                populateDataTable_1();
            }
        });//end ajax
    }		
}//end delete

function populateDataTable(){
    $('#example').dataTable().fnClearTable();
    $('#example').dataTable().fnDestroy();

    $('#example').DataTable({ 
        columnDefs: [{ width: 5, targets: 0 }],
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'ticket_dashboard/function.php?fn=getTableData' },
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

    $facility_id_s = $('#facility_id_s').val();
    $department_id = $('#department_id').val(); 
    $call_log_status = $('#call_log_status').val();
    $token_id = $('#token_id').val(); 
    $day_wise = $('#day_wise').val(); 
    $device_group = $('#device_group').val(); 
    $equipment_name = $('#equipment_name').val(); 
    $ticket_class = $('#ticket_class').val();  
    $from_dt = $('#from_dt').val();  
    $to_dt = $('#to_dt').val(); 
    $warranty_sr = $('#warranty_sr').val();     

    $('#example_1').DataTable({ 
        columnDefs: [{ width: 5, targets: 0 } ],
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'ticket_dashboard/function.php?fn=getTableData_1&facility_id_s='+$facility_id_s+'&department_id='+$department_id+'&call_log_status='+$call_log_status+'&token_id='+$token_id+'&day_wise='+$day_wise+'&device_group='+$device_group+'&equipment_name='+$equipment_name+'&ticket_class='+$ticket_class+'&from_dt='+$from_dt+'&to_dt='+$to_dt+'&warranty_sr='+$warranty_sr },
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
                $('#facility_id_s').html('');
                $html = "<option value='0'>Select</option>";

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
                        $('#department_id').html('');
                        $html = "<option value='0'>Select</option>";
                        for($i = 0; $i < $rows.length; $i++){ 
                            $html += "<option value='"+$rows[$i].department_id+"' >"+$rows[$i].department_name+"</option>";                    
                        }//end for
                        
                        $('#department_id').html($html);
                    }//end if
                }        
            });//end ajax 
        }//end if
    },500);
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
                $html = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].device_group_id+"'>"+$rows[$i].device_name+"</option>";                    
                }//end for
                
                $('#device_group').html($html);
            }//end if
        }        
    });//end ajax
}//end

function initTicketCounter(){   
    $.ajax({
        method: "POST",
        url: "ticket_dashboard/function.php",
        data: { fn: "initTicketCounter"}
    })
    .done(function( res ) {
        $res1 = JSON.parse(res); 
        if($res1.status == true){
            $total_ticket = $res1.total_ticket; 
            $('#total_ticket').html($total_ticket); 
            $('#total_ticket1').html($total_ticket);
            $('#resolved_ticket').html($res1.resolved_ticket);
            $('#open_ticket').html($res1.open_ticket);
        }        
    });//end ajax 
}

$(document).ready(function () {
    initTicketCounter();
    configureFacilityDropDown(); 
    configureDeviceGroupDropDown();
    populateDataTable();
    $("#partTwoBoard").hide();
    $('.js-example-basic-single').select2();
});