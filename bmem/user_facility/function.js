$('#onMyModal').on('click', function(){ 
    $('#myForm').trigger('reset');
    $('#exampleModalLong').modal('show');
})

$('#cancelForm').on('click', function(){
    $('#myForm').trigger('reset');
    $('#facility_id').val('');
})

$('#myForm').on("submit", function(){  
    
    $facility_id = $('#facility_id').val(); 
    $facility_name = $('#facility_name').val();
    $facility_type = $('#facility_type').val(); 
    $facility_code = $('#facility_code').val(); 
    $facility_address = $('#facility_address').val();
    $nabh_accrediated = $('#nabh_accrediated').val();
    $nabl_accrediated = $('#nabl_accrediated').val();
    $department_id = $('#department_id').val();
    $contact_person = $('#contact_person').val();    

    console.log('department_id:' + JSON.stringify($department_id));

    $.ajax({
        type: "POST",
        url: "user_facility/function.php",
        dataType: "json",
        data: { fn: "saveFormData", facility_id: $facility_id, facility_name: $facility_name, facility_type: $facility_type, facility_code: $facility_code, facility_address: $facility_address, nabh_accrediated: $nabh_accrediated, nabl_accrediated: $nabl_accrediated, department_id: JSON.stringify($department_id), contact_person: $contact_person }
    })
    .done(function( res ) {
        //$res1 = JSON.parse(res);
        if(res.status == true){   
            $('#orgFormAlert1').css("display", "block");  
            $('#myForm').trigger('reset');
            $('#facility_id').val('');
            $('#facility_type').val('').trigger('change');
            $('#department_id').val('').trigger('change');
            configureFacilityDropDown(); 
        }else{
            alert(res.error_message);
        }
    });//end ajax
    
    return false;
});//end fun
 
$('#getFacility').on('click', function(){
    $facility_id_dd = $('#facility_id_dd').val();

    if($facility_id_dd > 0){
        $.ajax({
            method: "POST",
            url: "user_facility/function.php",
            data: { fn: "getFormEditData", facility_id_dd: $facility_id_dd }
        })
        .done(function( res ) {
            //console.log(res);
            $res1 = JSON.parse(res);
            if($res1.status == true){
                $('#facility_id').val($facility_id_dd);
                $('#facility_name').val($res1.facility_name);
                $('#facility_type').val($res1.facility_type).trigger('change');
                $('#facility_code').val($res1.facility_code);   
                $('#facility_address').val($res1.facility_address);          
                $('#nabh_accrediated').val($res1.nabh_accrediated).trigger('change');
                $('#nabl_accrediated').val($res1.nabl_accrediated).trigger('change');
                $('#department_id').val($res1.department_id).trigger('change');
                $('#contact_person').val($res1.contact_person);
            }
        });//end ajax
    }else{
        alert('Please select Facility');
    }
})
 

function editTableData(facility_id){
    $('#exampleModalLong').modal('show');
    $.ajax({
        method: "POST",
        url: "user_facility/function.php",
        data: { fn: "getFormEditData", facility_id_dd: facility_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $('#facility_id').val(facility_id);
            $('#facility_name').val($res1.facility_name);
            $('#facility_type').val($res1.facility_type).trigger('change');
            $('#facility_code').val($res1.facility_code);   
            $('#facility_address').val($res1.facility_address);          
            $('#nabh_accrediated').val($res1.nabh_accrediated).trigger('change');
            $('#nabl_accrediated').val($res1.nabl_accrediated).trigger('change');
            $('#department_id').val($res1.department_id).trigger('change');
            $('#contact_person').val($res1.contact_person);
        }
    });//end ajax
} 

//Department
function configureDepartmentDropDown(){
    $.ajax({
        method: "POST",
        url: "user_facility/function.php",
        data: { fn: "getAllDepartmentName" }
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
                
                $('#department_id').html($html);
            }//end if
        }        
    });//end ajax
}//end

//Course
function configureHospitaDropDown(){
    $.ajax({
        method: "POST",
        url: "user_facility/function.php",
        data: { fn: "getAllHospitaName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#hospital_id').html('');
                $html = "<option value=''>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].hospital_id+"'>"+$rows[$i].hospital_name+"</option>";                    
                }//end for
                
                $('#hospital_id').html($html);
            }//end if
        }        
    });//end ajax
}//end

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
                $('#facility_id_dd').html('');
                $html = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].facility_id+"'>"+$rows[$i].facility_name+"</option>";                    
                }//end for
                
                $('#facility_id_dd').html($html);
            }//end if
        }        
    });//end ajax
}//end


function populateDataTable(){
    $('#example').dataTable().fnClearTable();
    $('#example').dataTable().fnDestroy();

    $('#example').DataTable({ 
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'user_facility/function.php?fn=getTableData' },
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

$(document).ready(function () {
    populateDataTable();
    configureDepartmentDropDown();
    configureFacilityDropDown();    
    $('.js-example-basic-single').select2();
});