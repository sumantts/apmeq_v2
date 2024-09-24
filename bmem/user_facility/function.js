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
    $hospital_id = $('#hospital_id').val();    

    console.log('department_id:' + JSON.stringify($department_id));

    $.ajax({
        type: "POST",
        url: "user_facility/function.php",
        dataType: "json",
        data: { fn: "saveFormData", facility_id: $facility_id, facility_name: $facility_name, facility_type: $facility_type, facility_code: $facility_code, facility_address: $facility_address, nabh_accrediated: $nabh_accrediated, nabl_accrediated: $nabl_accrediated, department_id: JSON.stringify($department_id), hospital_id: $hospital_id }
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
                $('#hospital_id').val($res1.hospital_id).trigger('change');
            }
        });//end ajax
    }else{
        alert('Please select Facility');
    }
})
 

function editTableData($author_id){
    $('#exampleModalLong').modal('show');
    $.ajax({
        method: "POST",
        url: "user_facility/function.php",
        data: { fn: "getFormEditData", author_id: $author_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $('#category_id').val($res1.category_id).trigger('change');
            $('#for_the_year').val($res1.for_the_year).trigger('change');
            $('#author_name').val($res1.author_name);
            $('#email').val($res1.email);            
            $('#registration_number').val($res1.registration_number); 
            let img = document.getElementById('image');
            img.src = $res1.author_photo;
            localStorage.setItem("author_photo", $res1.author_photo);
            $('#author_status').val($res1.author_status).trigger('change');  
            $('#author_id').val($author_id);
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
                $html = "<option value=''>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].facility_id+"'>"+$rows[$i].facility_name+"</option>";                    
                }//end for
                
                $('#facility_id_dd').html($html);
            }//end if
        }        
    });//end ajax
}//end

$(document).ready(function () {
    configureDepartmentDropDown();
    configureHospitaDropDown();
    configureFacilityDropDown();    
    $('.js-example-basic-single').select2();
});