<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="PMS Soft Link">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/images/favicon-16x16.png" type="image/x-icon">

    <title>Calibration Info</title> 
    <style>
        body{
            margin-top:20px;
            background:#eee;
        }
        .gradient-brand-color {
            background-image: -webkit-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
            background-image: -ms-linear-gradient(0deg, #376be6 0%, #6470ef 100%);
            color: #fff;
        }
        .contact-info__wrapper {
            overflow: hidden;
            border-radius: .625rem .625rem 0 0
        }

        @media (min-width: 1024px) {
            .contact-info__wrapper {
                border-radius: 0 .625rem .625rem 0;
                padding: 5rem !important
            }
        }
        .contact-info__list span.position-absolute {
            left: 0
        }
        .z-index-101 {
            z-index: 101;
        }
        .list-style--none {
            list-style: none;
        }
        .contact__wrapper {
            background-color: #fff;
            border-radius: 0 0 .625rem .625rem
        }

        @media (min-width: 1024px) {
            .contact__wrapper {
                border-radius: .625rem 0 .625rem .625rem
            }
        }
        @media (min-width: 1024px) {
            .contact-form__wrapper {
                padding: 5rem !important
            }
        }
        .shadow-lg, .shadow-lg--on-hover:hover {
            box-shadow: 0 1rem 3rem rgba(132,138,163,0.1) !important;
        }

    </style>    
  </head>
  <?php include('../assets/php/sql_conn.php'); ?>
  
  <body>
    <div class="container">
        <div class="contact__wrapper shadow-lg mt-n9">
            <div class="row no-gutters">
                <div class="col-lg-4 contact-info__wrapper gradient-brand-color p-4 order-lg-2">
                    <h3 class="color--white mb-5 text-center">APMEQ</h3>
        
                    <ul class="contact-info__list list-style--none position-relative z-index-101">
                        <li class="mb-4 pl-4">
                            <span class="position-absolute"><i class="fas fa-envelope"></i></span> souvick.biswas90@gmail.com
                        </li>
                        <li class="mb-4 pl-4">
                            <span class="position-absolute"><i class="fas fa-phone"></i></span> +91 94329 53523
                        </li>
                        <li class="mb-4 pl-4">
                            <span class="position-absolute"><i class="fas fa-map-marker-alt"></i></span> Vill+Po : East Burikhali, 
                            <br> Near Bauria Girls' High School,
                            <br>  West Bengal, India 711310
        
                            <!-- <div class="mt-3">
                                <a href="https://www.google.com/maps" target="_blank" class="text-link link--right-icon text-white">Get directions <i class="link__icon fa fa-directions"></i></a>
                            </div> -->
                        </li>
                    </ul>
        
                    <figure class="figure position-absolute m-0 opacity-06 z-index-100" style="bottom:0; right: 10px">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="444px" height="626px">
                            <defs>
                                <linearGradient id="PSgrad_1" x1="0%" x2="81.915%" y1="57.358%" y2="0%">
                                    <stop offset="0%" stop-color="rgb(255,255,255)" stop-opacity="1"></stop>
                                    <stop offset="100%" stop-color="rgb(0,54,207)" stop-opacity="0"></stop>
                                </linearGradient>
        
                            </defs>
                            <path fill-rule="evenodd" opacity="0.302" fill="rgb(72, 155, 248)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                            <path fill="url(#PSgrad_1)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                        </svg>
                    </figure>
                </div>
        
                <div class="col-lg-8 contact-form__wrapper p-5 order-lg-1">
                    <h4 class="text-center">Calibration Info #<?=$_GET['calib_info_id']?></h4>
                    <form action="#" method="POST" class="contact-form form-validate" id="myForm">
                        <div class="row">
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label class="required-field" for="facility_id">Facility name</label>
                                    <select class="form-control" name="facility_id" id="facility_id" required >
                                        <option value="">Select</option> 
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="facility_code">Facility Code</label>
                                    <input type="text" class="form-control" id="facility_code" name="facility_code" value="" required >
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label class="required-field" for="department_id">Department</label>
                                    <select class="form-control" name="department_id" id="department_id" required >
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="device_group">Device group</label>
                                    <select class="form-control" name="device_group" id="device_group" required >
                                        <option value="">Select</option> 
                                        <?php
                                        echo $sql = "SELECT * FROM device_group_list WHERE device_status = 1 ORDER BY device_name ASC";
                                        $result = $mysqli->query($sql);
                                
                                        if ($result->num_rows > 0) {
                                            $status = true;
                                            $slno = 1;
                                            while($row = $result->fetch_array()){
                                                $device_group_id = $row['device_group_id'];	
                                                $device_name = $row['device_name'];	
                                                ?>
                                                <option value="<?=$device_group_id?>" ><?=$device_name?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="asset_class">Asset class</label>
                                    <select class="form-control" name="asset_class" id="asset_class" required >
                                        <option value="">Select</option>
                                        <option value="1">Critical</option>
                                        <option value="2">Non Critical</option> 
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="equipment_name">Equpment Name</label>
                                    <input type="text" class="form-control" id="equipment_name" name="equipment_name" required >
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="equipment_make_model">Equipment Make/Model</label>
                                    <input type="text" class="form-control" id="equipment_make_model" name="equipment_make_model">
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="equipment_sl_no">Equipment sl no</label>
                                    <input type="text" class="form-control" id="equipment_sl_no" name="equipment_sl_no">
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="pms_due_date">Calibration due date</label>
                                    <input type="date" class="form-control" id="pms_due_date" name="pms_due_date"  >
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="supplied_by">Supplied by</label>
                                    <input type="text" class="form-control" id="supplied_by" name="supplied_by"  >
                                </div>
                            </div> 
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="pms_planned_date">Planned date for Calibration</label>
                                    <input type="date" class="form-control" id="pms_planned_date" name="pms_planned_date">
                                </div>
                            </div>

                            <div class="col-sm-12 mb-1">
                                <div class="form-group">
                                    <label class="required-field" for="service_provider_details">Service Provider Details</label>
                                    <textarea class="form-control" id="service_provider_details" name="service_provider_details" rows="4" placeholder="Name, Email, Phone Number"> </textarea>
                                </div>
                            </div>
                            <!-- 
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="pms_planned_date">PMS planned date</label>
                                    <input type="date" class="form-control" id="pms_planned_date" name="pms_planned_date" >
                                </div>
                            </div>  -->
                            <div class="col-md-6 mt-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="file" id="multiupload" name="uploadFiledd[]" multiple accept=".jpg,.jpeg,.png" >
                                        <span id="uploadMessage"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" id="startUpload" class="btn btn-primary btn-sm">Upload</button>
                                    </div>
                                </div>
                            </div> 

                            <div class="form-row mb-2"> 
                                <div class="col-md-12 mb-3">
                                    <div class="text-center" id="product_gallery"> </div>
                                </div>
                            </div>
        
                            <div class="col-sm-12 mt-2 mb-1">
                                <input type="hidden" name="calib_info_id" id="calib_info_id" value="<?=$_GET['calib_info_id']?>">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
        
                        </div>
                    </form>
                </div>
                <!-- End Contact Form Wrapper -->
        
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        $('#myForm').on('submit', function(){
            console.log('click click..');
            $calib_info_id = $('#calib_info_id').val();
            $facility_id = $('#facility_id').val();
            $facility_code = $('#facility_code').val();
            $department_id = $('#department_id').val();
            $device_group = $('#device_group').val();
            $asset_class = $('#asset_class').val();
            $equipment_name = $('#equipment_name').val();
            $equipment_make_model = $('#equipment_make_model').val();
            $equipment_sl_no = $('#equipment_sl_no').val();
            $pms_due_date = $('#pms_due_date').val();
            $supplied_by = $('#supplied_by').val();
            $service_provider_details = $('#service_provider_details').val();
            $pms_planned_date = $('#pms_planned_date').val();

            $.ajax({
                method: "POST",
                url: "../calibration_dashboard/function.php",
                data: { fn: "updateGeneratedFormdata", calib_info_id: $calib_info_id, facility_id: $facility_id, facility_code: $facility_code, department_id: $department_id, device_group: $device_group, asset_class: $asset_class, equipment_name: $equipment_name, equipment_make_model: $equipment_make_model, equipment_sl_no: $equipment_sl_no, pms_due_date: $pms_due_date, supplied_by: $supplied_by, service_provider_details: $service_provider_details, pms_planned_date: $pms_planned_date }
            })
            .done(function( res ) {
                $res1 = JSON.parse(res); 
                if($res1.status == true){
                    alert('Data Updated successfully');
                }        
            });//end ajax
            return false;
        })

        //Facility
        function configureFacilityDropDown(){
            $.ajax({
                method: "POST",
                url: "../user_facility/function.php",
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
            console.log('function calling.........');
            if($facility_id > 0){
                $.ajax({
                    method: "POST",
                    url: "../asset/function.php",
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
            }
        })

        function loadDepartment(facilityid, departmentid){ 
            console.log('loadDepartment.........')
            if(facilityid > 0){
                $.ajax({
                    method: "POST",
                    url: "../asset/function.php",
                    data: { fn: "getAllDepartmentName", facility_id_dd: facilityid }
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
                            $('#department_id').val(departmentid).trigger('change');
                        }//end if
                    }        
                });//end ajax  
            }
            console.log('departmentid: ' + departmentid);
        }

        //DeviceGroup
        function configureDeviceGroupDropDown(){
            $.ajax({
                method: "POST",
                url: "../asset/function.php",
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

        

    function loadFormdata(){
        $calib_info_id = $('#calib_info_id').val();
        $.ajax({
            method: "POST",
            url: "../calibration_dashboard/function.php",
            data: { fn: "loadFormdata", calib_info_id: $calib_info_id }
        })
        .done(function( res ) {
            //console.log(res);
            $res1 = JSON.parse(res);
            if($res1.status == true){
                $('#facility_id').val($res1.facility_id).trigger('change');
                loadDepartment($res1.facility_id, $res1.department_id);
                getAllProductImages($calib_info_id);
                $('#facility_code').val($res1.facility_code); 
                $('#department_id').val($res1.department_id).trigger('change');   
                $('#device_group').val($res1.device_group).trigger('change');            
                $('#asset_class').val($res1.asset_class).trigger('change');
                $('#equipment_name').val($res1.equipment_name);  
                $('#equipment_make_model').val($res1.equipment_make_model);
                $('#equipment_sl_no').val($res1.equipment_sl_no);  
                $('#pms_due_date').val($res1.pms_due_date);  
                $('#supplied_by').val($res1.supplied_by);  
                $('#service_provider_details').val($res1.service_provider_details);  
                $('#pms_planned_date').val($res1.pms_planned_date);  
            }
        });//end ajax
    }




    //Multiple Photo Upload
    function uploadajax(ttl,cl){
        $calib_info_id = $('#calib_info_id').val();
        var fileList = $('#multiupload').prop("files"); 
        var form_data =  "";
        form_data = new FormData();
        form_data.append("upload_image", fileList[cl]);
        form_data.append("calib_info_id", $calib_info_id);

        var request = $.ajax({
            url: "../calibration_dashboard/upload.php",
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
                        getAllProductImages($calib_info_id);
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
        $calib_info_id = $('#calib_info_id').val();
        $upload_count = 0;
        if($calib_info_id > 0){
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

    function getAllProductImages(pmsinfoid){
        $('#product_gallery').html('');
        $.ajax({
            method: "POST",
            url: "../calibration_dashboard/function.php",
            data: { fn: "getAllProductImages", calib_info_id: pmsinfoid }
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
                        $html += '<img src="./photos/'+$all_images[$i]+'" width="75" class="img-fluid img-thumbnail" alt="..."><a href="javascript: void(0)"> <i class="fa fa-trash" aria-hidden="true" onclick="deleteProdImage(\''+$all_images[$i]+'\')"></i></a>'; 
                    }//end for
                    
                    $('#product_gallery').html($html);
                }//end if
            } //end if       
        });//end ajax

    }//end if

    function deleteProdImage($prod_iamge_name){
        console.log('prod_iamge_name: ' + $prod_iamge_name);
        if (confirm('Are you sure to delete the Image?')) {
            $calib_info_id = $('#calib_info_id').val();
            $.ajax({
                method: "POST",
                url: "../calibration_dashboard/function.php",
                data: { fn: "deleteProdImage", calib_info_id: $calib_info_id, prod_iamge_name: $prod_iamge_name }
            })
            .done(function( res ) {
                //console.log(res);
                $res1 = JSON.parse(res);
                if($res1.status == true){
                    getAllProductImages($calib_info_id);
                }
            });//end ajax
        }		
    }//end fun
    //End multiple pgoto upload

    $(document).ready(function () {
        configureFacilityDropDown(); 
        //configureDeviceGroupDropDown();
        loadFormdata();

        $user_id = window.localStorage.getItem('user_id');
        console.log('user_id: ' + $user_id);
        if($user_id == null){
            //$("input").prop('disabled', true);
            $('#facility_id').prop('disabled', true); 
            $('#facility_code').prop('readonly', true);
            $('#department_id').prop('disabled', true);   
            $('#device_group').prop('disabled', true);             
            $('#asset_class').prop('disabled', true); 
            $('#equipment_name').prop('readonly', true);  
            $('#equipment_make_model').prop('readonly', true);
            $('#equipment_sl_no').prop('readonly', true);  
            $('#pms_due_date').prop('readonly', true);   
            $('#supplied_by').prop('readonly', true);    
            $('#pms_planned_date').prop('readonly', true);  
        }
        
    });
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  </body>
</html>