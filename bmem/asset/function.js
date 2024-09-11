$('#onMyModal').on('click', function(){
    localStorage.setItem('author_photo', '');
    clearForm();
    $('#exampleModalLong').modal('show');
})

$('#clearForm').on('click', function(){
    $('#myForm').trigger('reset');
    $('#facility_id_dd').val('').trigger('change');
    $('#department_id').val('').trigger('change'); 
    $('#technology').val('').trigger('change');
    $('#asset_class').val('').trigger('change'); 
    $('#device_group').val('').trigger('change'); 
    $('#frequency_of_calibration_m').val('').trigger('change'); 
    $('#frequency_of_calibration_d').val('').trigger('change');
    $('#frequency_of_pms_m').val('').trigger('change');
    $('#frequency_of_pms_d').val('').trigger('change');
    $('#cmc_yes_no').val('').trigger('change');
    $('#asset_id').val('0'); 
})

$('#myForm').on('submit', function(){
    $asset_id = $('#asset_id').val(); 
    $facility_id = $('#facility_id_dd').val(); 
    $department_id = $('#department_id').val(); 
    $equipment_name = $('#equipment_name').val(); 
    $asset_make = $('#asset_make').val(); 
    $asset_model = $('#asset_model').val(); 
    $slerial_number = $('#slerial_number').val(); 
    $asset_specifiaction = $('#asset_specifiaction').val(); 
    $date_of_installation = $('#date_of_installation').val();  
    $asset_supplied_by = $('#asset_supplied_by').val(); 
    $value_of_the_asset = $('#value_of_the_asset').val(); 
    $total_year_in_service = $('#total_year_in_service').val(); 
    $technology = $('#technology').val(); 
    $asset_status = $('#asset_status').val(); 
    $asset_class = $('#asset_class').val(); 
    $device_group = $('#device_group').val(); 
    $last_date_of_calibration = $('#last_date_of_calibration').val(); 
    $frequency_of_calibration = $('#frequency_of_calibration').val(); 
    $last_date_of_pms = $('#last_date_of_pms').val();  
    $frequency_of_pms = $('#frequency_of_pms').val(); 
    $qa_due_date = $('#qa_due_date').val(); 
    $warranty_last_date = $('#warranty_last_date').val(); 
    $amc_yes_no = $('#amc_yes_no').val(); 
    $amc_last_date = $('#amc_last_date').val(); 
    $cmc_yes_no = $('#cmc_yes_no').val(); 
    $cmc_last_date = $('#cmc_last_date').val(); 
    $sp_details = $('#sp_details').val();

    $.ajax({
        type: "POST",
        url: "asset/function.php",
        dataType: "json",
        data: { fn: "saveFormData", asset_id: $asset_id, facility_id: $facility_id, department_id: $department_id, equipment_name: $equipment_name, asset_make: $asset_make, asset_model: $asset_model, slerial_number: $slerial_number, asset_specifiaction: $asset_specifiaction, date_of_installation: $date_of_installation, asset_supplied_by: $asset_supplied_by, value_of_the_asset: $value_of_the_asset, total_year_in_service: $total_year_in_service, technology: $technology, asset_status: $asset_status, asset_class: $asset_class, device_group: $device_group, last_date_of_calibration: $last_date_of_calibration, frequency_of_calibration: $frequency_of_calibration, last_date_of_pms: $last_date_of_pms, frequency_of_pms: $frequency_of_pms, qa_due_date: $qa_due_date, warranty_last_date: $warranty_last_date, amc_yes_no: $amc_yes_no, amc_last_date: $amc_last_date, cmc_yes_no: $cmc_yes_no, cmc_last_date: $cmc_last_date, sp_details: $sp_details }
    })
    .done(function( res ) {
        if(res.status == true){
            $('#orgFormAlert1').css("display", "block");
            $('#asset_id').val(res.asset_id_temp); 
        }else{
            alert($res1.error_message);
        }
    });//end ajax 

    return false;
})

function editTableData($author_id){
    $('#exampleModalLong').modal('show');
    $.ajax({
        method: "POST",
        url: "asset/function.php",
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

//Delete function	
function deleteTableData($author_id){
    if (confirm('Are you sure to delete the Data?')) {
        $.ajax({
            method: "POST",
            url: "asset/function.php",
            data: { fn: "deleteTableData", author_id: $author_id }
        })
        .done(function( res ) {
            //console.log(res);
            $res1 = JSON.parse(res);
            if($res1.status == true){
                $('#orgFormAlert').show();
                populateDataTable();
            }
        });//end ajax
    }		
}//end delete 


function populateDataTable(){
    $('#example').dataTable().fnClearTable();
    $('#example').dataTable().fnDestroy();

    $('#example').DataTable({ 
        columnDefs: [{ width: 5, targets: 0 }, { width: 5, targets: 1 }, { width: 150, targets: 2 }, { width: 200, targets: 3 }, { width: 10, targets: 4 }, { width: 10, targets: 5 }],
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'asset/function.php?fn=getTableData' },
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
        order: [[0, 'desc']],

    });
}//end fun 

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

$('#frequency_of_calibration_m, #frequency_of_calibration_d').on('change', function(){
    $frequency_of_calibration_m = $('#frequency_of_calibration_m').val();
    $frequency_of_calibration_d = $('#frequency_of_calibration_d').val();
    $frequency_of_calibration = $frequency_of_calibration_m+'|'+$frequency_of_calibration_d;
    $('#frequency_of_calibration').val($frequency_of_calibration); 
})

$('#frequency_of_pms_m, #frequency_of_pms_d').on('change', function(){
    $frequency_of_pms_m = $('#frequency_of_pms_m').val();
    $frequency_of_pms_d = $('#frequency_of_pms_d').val();
    $frequency_of_pms = $frequency_of_pms_m+'|'+$frequency_of_pms_d;
    $('#frequency_of_pms').val($frequency_of_pms); 
})

$('#ins_cert_attach').on('click', function(){
    $asset_id = $('#asset_id').val();
    if($asset_id > 0){
        $('#exampleModalLong').modal('show');
        $('#product_gallery').html('');
        $('#myFormModal').trigger('reset');
        $('#field_name').val('ins_certificate');
        $('#uploadMessage').html('');
    }else{
        alert('Please add an Asset first');
    }
})

$('#calib_cert_attach').on('click', function(){
    $asset_id = $('#asset_id').val();
    if($asset_id > 0){
        $('#exampleModalLong').modal('show');
        $('#product_gallery').html('');
        $('#myFormModal').trigger('reset');
        $('#field_name').val('calibration_attachment');
        $('#uploadMessage').html('');
    }else{
        alert('Please add an Asset first');
    }
})

$('#pms_cert_attach').on('click', function(){
    $asset_id = $('#asset_id').val();
    if($asset_id > 0){
        $('#exampleModalLong').modal('show');
        $('#product_gallery').html('');
        $('#myFormModal').trigger('reset');
        $('#field_name').val('pms_attachment');
        $('#uploadMessage').html('');
    }else{
        alert('Please add an Asset first');
    }
})

$('#qa_cert_attach').on('click', function(){
    $asset_id = $('#asset_id').val();
    if($asset_id > 0){
        $('#exampleModalLong').modal('show');
        $('#product_gallery').html('');
        $('#myFormModal').trigger('reset');
        $('#field_name').val('qa_attachment');
        $('#uploadMessage').html('');
    }else{
        alert('Please add an Asset first');
    }
})



//Multiple Photo Upload
function uploadajax(ttl,cl){
    $asset_id = $('#asset_id').val();
    $field_name = $('#field_name').val();

    var fileList = $('#multiupload').prop("files"); 
    var form_data =  "";
    form_data = new FormData();
    form_data.append("upload_image", fileList[cl]);
    form_data.append("asset_id", $asset_id);
    form_data.append("field_name", $field_name);

    var request = $.ajax({
        url: "asset/upload.php",
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        data: form_data,
        type: 'POST', 
        success: function (res, status) {
            console.log('return data: '+res + ' status: ' + status);
            $res1 = JSON.parse(res);
            if ($res1.status == true) {
                $upload_count++;
                percent = 0; 
                if (cl < ttl) {
                    uploadajax(ttl, cl + 1);
                } else {
                    console.log('Done');
                    $('#uploadMessage').html($upload_count + ' Files Uploaded');
                    getAllProductImages($asset_id, $field_name);
                }
            }
        },
        fail: function (res) {
            console.log('Failed');
        }    
    })
}

$('#startUpload').on('click', function(){
    console.log('upload start...');    
    $asset_id = $('#asset_id').val();
    $upload_count = 0;
    if($asset_id > 0){
        $('#uploadMessage').html('');
        var fileList = $('#multiupload').prop("files"); 
        var i;
        for ( i = 0; i < fileList.length; i++) { 
            if(i == fileList.length-1){
                uploadajax(fileList.length-1,0);
            }
        }
    }else{
        alert('Please enter procust name first');
    }//end if
}); 

function getAllProductImages($asset_id, $field_name){
    $('#product_gallery').html('');
    $.ajax({
        method: "POST",
        url: "asset/function.php",
        data: { fn: "getAllProductImages", asset_id: $asset_id, field_name: $field_name }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $all_images = $res1.all_images;

            if($all_images.length > 0){ 
                $html = "";
                console.log('all_images length: '+$all_images.length);
                for($i in $all_images ){
                    $html += '<img src="asset/photos/'+$all_images[$i]+'" width="75" class="img-fluid img-thumbnail" alt="..."><a href="javascript: void(0)"> <i class="fa fa-trash" aria-hidden="true" onclick="deleteProdImage(\''+$all_images[$i]+'\')"></i></a>'; 
                }//end for
                
                $('#product_gallery').html($html);
            }//end if
        } //end if       
    });//end ajax

}//end if

function deleteProdImage($prod_iamge_name){
    console.log('prod_iamge_name: ' + $prod_iamge_name);
    if (confirm('Are you sure to delete the Image?')) {
        $asset_id = $('#asset_id').val();
        $field_name = $('#field_name').val();
        $.ajax({
            method: "POST",
            url: "asset/function.php",
            data: { fn: "deleteProdImage", asset_id: $asset_id, prod_iamge_name: $prod_iamge_name, field_name: $field_name }
        })
        .done(function( res ) {
            //console.log(res);
            $res1 = JSON.parse(res);
            if($res1.status == true){
                getAllProductImages($asset_id, $field_name);
            }
        });//end ajax
    }		
}//end fun
//End multiple pgoto upload

$(document).ready(function () {
    configureFacilityDropDown();
    configureDepartmentDropDown();
    $('.js-example-basic-single').select2();
    //configureCategoryDropDown(); 
    //configureCourseDropDown(); 
    //populateDataTable();
});