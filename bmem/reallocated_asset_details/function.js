$('#clearForm').on('click', function(){
    $('#myFormS').trigger('reset');
    populateDataTable_1();
    $('#heading_1').html('Relocated Asset List');

    //$('#s_div').removeClass('d-block');
    //$('#s_div').addClass('d-none');
})

$('#myForm').on('submit', function(){ 
    $facility_id = $('#facility_id').val();
    $facility_code = $('#facility_code').val(); 
    $from_dept_id = $('#from_dept_id').val();
    $asset_id = $('#asset_id').val(); 
    $asset_code = $('#asset_code').val(); 
    $to_dept_id = $('#to_dept_id').val(); 
    $relocate_date_time = $('#relocate_date_time').val();  

    $.ajax({
        method: "POST",
        url: "reallocated_asset_details/function.php",
        data: { fn: "saveFormData", facility_id: $facility_id, facility_code: $facility_code, from_dept_id: $from_dept_id, asset_id: $asset_id, asset_code: $asset_code, to_dept_id: $to_dept_id, relocate_date_time: $relocate_date_time }
    })
    .done(function( res ) { 
        $res1 = JSON.parse(res);
        if($res1.status == true){  
            populateDataTable_1();
            alert('Asset Relocation Initiated');
            $('#myForm').trigger('reset');
        }else{
            alert($res1.error_message);
        }
    });//end ajax 

    return false;
})

$('#submitFormS').on('click', function(){
    $facility_idS = $('#facility_idS').val();
    $facility_codeS = $('#facility_codeS').val();

    if($facility_idS == '' && $facility_codeS == ''){
        alert('Please selecte Facility Name or Enter Facility Code');
    }else{
        //$('#s_div').removeClass('d-none');
        //$('#s_div').addClass('d-block');
        $('#heading_1').html('Relocated Asset List (Filtered)');
        populateDataTable_1();
    }
})

function editTableData($author_id){
    $('#exampleModalLong').modal('show');
    $.ajax({
        method: "POST",
        url: "reallocated_asset_details/function.php",
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
function deleteTableData($reloc_id){
    if (confirm('Are you sure to delete the Data?')) {
        $.ajax({
            method: "POST",
            url: "reallocated_asset_details/function.php",
            data: { fn: "deleteTableData", reloc_id: $reloc_id }
        })
        .done(function( res ) {
            //console.log(res);
            $res1 = JSON.parse(res);
            if($res1.status == true){
                $('#orgFormAlert').show();
                populateDataTable_1();
            }
        }); //end ajax
    }		
}//end delete

//Image upload
function savePhoto(){
    const imgPath = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        // convert image file to base64 string and save to localStorage
        localStorage.setItem("author_photo", reader.result);
    }, false);

    if (imgPath) {
        reader.readAsDataURL(imgPath);
    }

    //To display image again
    setTimeout(function(){
    let img = document.getElementById('image');
    img.src = localStorage.getItem('author_photo');
    }, 250);
}


function populateDataTable(){
    $('#example').dataTable().fnClearTable();
    $('#example').dataTable().fnDestroy();

    $('#example').DataTable({ 
        columnDefs: [{ width: 5, targets: 0 } ],
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'reallocated_asset_details/function.php?fn=getTableData' },
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

function populateDataTable_1(){
    $('#example_1').dataTable().fnClearTable();
    $('#example_1').dataTable().fnDestroy();
    $facility_idS = $('#facility_idS').val();
    $facility_codeS = $('#facility_codeS').val();

    $('#example_1').DataTable({ 
        columnDefs: [{ width: 5, targets: 0 }],
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'reallocated_asset_details/function.php?fn=getTableData_1&facility_idS='+$facility_idS+'&facility_codeS='+$facility_codeS },
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

//Category
function configureCategoryDropDown(){
    $.ajax({
        method: "POST",
        url: "reallocated_asset_details/function.php",
        data: { fn: "getAllCategoryName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#category_id').html('');
                $option_category_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_category_id += "<option data-category_slug='"+$rows[$i].category_slug+"' value='"+$rows[$i].category_id+"'>"+$rows[$i].category_name+"</option>";                    
                }//end for
                
                $('#category_id').html($option_category_id);
            }//end if
        }        
    });//end ajax
}//end

//Course
function configureCourseDropDown(){
    $.ajax({
        method: "POST",
        url: "reallocated_asset_details/function.php",
        data: { fn: "getAllCourseName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#course_id').html('');
                $option_course_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_course_id += "<option data-course_fee='"+$rows[$i].course_fee+"' data-course_duration='"+$rows[$i].course_duration+"' value='"+$rows[$i].course_id+"'>"+$rows[$i].course_name+"</option>";                    
                }//end for
                
                $('#course_id').html($option_course_id);
            }//end if
        }        
    });//end ajax
}//end

$('#generateLink').on('click', function(){ 
    window.open('reallocated_asset_details/qa_link.html', '_blank');
});

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
                $('#facility_idS').html('');
                $html = "<option value=''>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].facility_id+"'>"+$rows[$i].facility_name+"</option>";                    
                }//end for
                
                $('#facility_id').html($html);
                $('#facility_idS').html($html);
            }//end if
        }        
    });//end ajax
}//end

//Asset
function configureAssetDropDown(facilityid){ 
    if(facilityid > 0){
        $.ajax({
            method: "POST",
            url: "reallocated_asset_details/function.php",
            data: { fn: "getAllAssetName", facility_id: facilityid }
        })
        .done(function( res ) {
            $res1 = JSON.parse(res);
            if($res1.status == true){
                $rows = $res1.data;

                if($rows.length > 0){
                    $('#asset_id').html('');
                    $html = "<option value=''>Select</option>";

                    for($i = 0; $i < $rows.length; $i++){
                        $html += "<option value='"+$rows[$i].asset_id+"'>"+$rows[$i].equipment_name+"("+$rows[$i].asset_code+")</option>";                    
                    }//end for
                    
                    $('#asset_id').html($html);
                }//end if
            }        
        });//end ajax
    }//end if
}//end

$('#facility_id').on('change', function(){
    setTimeout(function(){        
        $facility_id = $('#facility_id').val(); 
        configureAssetDropDown($facility_id);

        if($facility_id > 0){
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

            //Get Facility ID            
            $.ajax({
                method: "POST",
                url: "reallocated_asset_details/function.php",
                data: { fn: "getFacilityID", facility_id_dd: $facility_id }
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

//Get Asset Code
$('#asset_id').on('change', function(){
    $asset_id = $('#asset_id').val(); 
    $.ajax({
        method: "POST",
        url: "reallocated_asset_details/function.php",
        data: { fn: "getAssetCode", asset_id: $asset_id }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res); 
        if($res1.status == true){
            $('#asset_code').val($res1.asset_code);                    
        }        
    });//end ajax     
})


$('#from_dept_id, #to_dept_id').on('change', function(){  
    $from_dept_id = $('#from_dept_id').val();
    $to_dept_id = $('#to_dept_id').val();
    console.log('from_dept_id:'+$from_dept_id+' to_dept_id: ' + $to_dept_id);

    if(parseInt($from_dept_id) == parseInt($to_dept_id)){
        alert('Two Department can not be same');
        $('#from_dept_id').val('').trigger('change');
        $('#to_dept_id').val('').trigger('change');
    }
})

function updateShiftingStatus($reloc_id, $asset_id){
    $reloc_initiated = $('#shift_stat_'+$reloc_id).val();
    console.log('reloc_id: ' + $reloc_id + ' reloc_initiated: ' + $reloc_initiated);

    $.ajax({
        method: "POST",
        url: "reallocated_asset_details/function.php",
        data: { fn: "updateRelocStatus", reloc_id: $reloc_id, reloc_initiated: $reloc_initiated, asset_id: $asset_id }
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

$(document).ready(function () {
    configureFacilityDropDown();
    configureAssetDropDown();
    populateDataTable();
    populateDataTable_1();
    $('.js-example-basic-single').select2();
});