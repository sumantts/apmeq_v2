<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="Call Log Soft Link">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/images/favicon-16x16.png" type="image/x-icon">

    <title>Call Log Soft Link</title> 
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
  <?php
	include('../assets/php/sql_conn.php');

    $token_id = '';

    if(isset($_GET['call_log_id'])){
        $call_log_id = $_GET['call_log_id'];

        if($call_log_id > 0){
            $sql = "SELECT call_log_register.call_log_id, call_log_register.token_id, call_log_register.asset_code, call_log_register.issue_description, call_log_register.call_log_date_time, call_log_register.resolved_date_time, call_log_register.ticket_raiser_contact, call_log_register.assign_to, call_log_register.call_log_status, call_log_register.eng_contact_no, call_log_register.engineer_coment, call_log_register.amc_yes_no, call_log_register.amc_last_date, call_log_register.cmc_yes_no, call_log_register.cmc_last_date, call_log_register.call_log_comment, call_log_register.status_by_engg, asset_details.equipment_name, asset_details.asset_make, asset_details.asset_model, asset_details.slerial_number, asset_details.department_id, asset_details.asset_supplied_by, asset_details.sp_details, asset_details.warranty_last_date, asset_details.device_group, facility_master.facility_code, facility_master.facility_name, device_group_list.device_name FROM call_log_register JOIN asset_details ON call_log_register.asset_code = asset_details.asset_code JOIN facility_master ON call_log_register.facility_id = facility_master.facility_id JOIN device_group_list ON asset_details.device_group = device_group_list.device_group_id WHERE call_log_register.call_log_id = '" .$call_log_id. "' ";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                $status = true;
                $slno = 1;

                $row = $result->fetch_array();
                $call_log_id = $row['call_log_id'];	
                $token_id = $row['token_id'];	
                $issue_description = $row['issue_description'];			
                $equipment_name = $row['equipment_name'];				
                $facility_code = $row['facility_code'];					
                $facility_name = $row['facility_name'];					
                $department_id = $row['department_id'];					
                $asset_supplied_by = $row['asset_supplied_by'];						
                $engineer_coment = $row['engineer_coment'];				
                $sp_details = $row['sp_details'];					
                $asset_code = $row['asset_code'];						
                $device_name = $row['device_name'];							
                $asset_make = $row['asset_make'];						
                $asset_model = $row['asset_model'];						
                $slerial_number = $row['slerial_number'];					
                $call_log_comment = $row['call_log_comment'];					
                $status_by_engg = $row['status_by_engg'];
                                
                $call_log_date_time = date('d-F-Y h:i A', strtotime($row['call_log_date_time']));	
                $resolved_date_time = '';
                if($row['resolved_date_time'] != '0000-00-00 00:00:00'){			
                    $resolved_date_time = date('d-F-Y h:i A', strtotime($row['resolved_date_time']));
                }				
                $ticket_raiser_contact = $row['ticket_raiser_contact'];						
                $eng_contact_no = $row['eng_contact_no'];	
                            
                $assign_to = $row['assign_to'];	
                $assign_to_text = '';
                if($assign_to == 1){
                    $assign_to_text = 'Engineer';					
                }else if($assign_to == 2){
                    $assign_to_text = 'ServiceProvider';
                }else{
                    $assign_to_text = '';
                }	

                $call_log_status = $row['call_log_status'];	
                $call_log_status_text = '';
                if($call_log_status == 0){
                    $call_log_status_text = 'Raised';					
                }else if($call_log_status == 1){
                    $call_log_status_text = 'WIP';
                }else if($call_log_status == 2){
                    $call_log_status_text = 'Resolved';
                }else if($call_log_status == 3){
                    $call_log_status_text = 'Closed';
                }else if($call_log_status == 4){
                    $call_log_status_text = 'Rejected';
                }else{
                    $call_log_status_text = 'Raised';
                }
                
                $dept_names = '';	
                $ids = '';
                /****
                //get all depertment name
                if($department_id_s > 0){
                    $dept_match = false;
                }	 
                ***/
                $ids_str = json_decode($department_id);
                foreach($ids_str as $key => $val){
                    $ids .= $val.','; 
                } 				
                $ids = rtrim($ids, ",");
                $sql_get = "SELECT * FROM department_list WHERE department_id IN ($ids)";
                $result_get = $mysqli->query($sql_get);
        
                if ($result_get->num_rows > 0) {
                    $status = true;	
                    while($row_get = $result_get->fetch_array()){
                        $dept_names .= $row_get['department_name'].', ';	
                    }				
                    $dept_names = rtrim($dept_names, ", ");
                } 
                $warranty_last_date = $row['warranty_last_date'];
                $amc_yes_no = $row['amc_yes_no'];
                $amc_last_date = $row['amc_last_date'];
                $cmc_yes_no = $row['cmc_yes_no'];
                $cmc_last_date = $row['cmc_last_date'];

                $amc_info1 = ($amc_yes_no == 0)? 'No':'Yes';
                $cmc_info1 = ($cmc_yes_no == 0)? 'No':'Yes'; 

                $amc_info = $amc_info1 ."<br>". date('d-F-Y', strtotime($amc_last_date));
                $cmc_info = $cmc_info1 ."<br>". date('d-F-Y', strtotime($cmc_last_date));
                    
            }//end if
        }//end if
    }//end if
    ?>
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
                    <h4 class="text-center">Call Log ID #<?=$token_id?></h4>
                    <form action="#" method="POST" class="contact-form form-validate" id="myForm">
                        <div class="row">
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label class="required-field" for="facility_name">Facility name</label>
                                    <input type="text" class="form-control" id="facility_name" name="facility_name" value="<?=$facility_name?>" readonly >
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="facility_code">Facility Code</label>
                                    <input type="text" class="form-control" id="facility_code" name="facility_code" value="<?=$facility_code?>" readonly >
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label class="required-field" for="dept_names">Department</label>
                                    <input type="text" class="form-control" id="dept_names" name="dept_names" value="<?=$dept_names?>" readonly >
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="device_name">Device group</label> 
                                    <input type="text" class="form-control" id="device_name" name="device_name" value="<?=$device_name?>" readonly >
                                </div>
                            </div> 
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="equipment_name">Equpment Name</label>
                                    <input type="text" class="form-control" id="equipment_name" name="equipment_name" value="<?=$equipment_name?>" readonly >
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="asset_code">Asset Code</label>
                                    <input type="text" class="form-control" id="asset_code" name="asset_code" value="<?=$asset_code?>" readonly>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="equipment_make">Equipment Make</label>
                                    <input type="text" class="form-control" id="equipment_make" name="equipment_make" value="<?=$asset_make?>" readonly>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="equipment_model">Equipment Model</label>
                                    <input type="text" class="form-control" id="equipment_model" name="equipment_model" value="<?=$asset_model?>" readonly>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="equipment_sl_no">Equipment sl no</label>
                                    <input type="text" class="form-control" id="equipment_sl_no" name="equipment_sl_no" value="<?=$slerial_number?>" readonly>
                                </div>
                            </div> 
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="supplied_by">Supplied by</label>
                                    <input type="text" class="form-control" id="supplied_by" name="supplied_by" value="<?=$asset_supplied_by?>" readonly >
                                </div>
                            </div>  
        
                            <div class="col-sm-12 mb-1">
                                <div class="form-group">
                                    <label class="required-field" for="sp_details">Service Provider Details</label>
                                    <textarea class="form-control" id="sp_details" name="sp_details" rows="4" readonly><?=$sp_details?></textarea>
                                </div>
                            </div>
        
                            <div class="col-sm-12 mb-1">
                                <div class="form-group">
                                    <label class="required-field" for="call_log_comment">Comments</label>
                                    <textarea class="form-control" id="call_log_comment" name="call_log_comment" rows="4" ><?=$call_log_comment?></textarea>
                                </div>
                            </div>
                            
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

                            <div class="form-row mt-4"> 
                                <div class="col-md-12 mb-3">
                                    <div class="text-center" id="product_gallery"> </div>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-1">
                                <div class="form-group">
                                    <label for="status_by_engg">Status</label>
                                    <select class="form-control" name="status_by_engg" id="status_by_engg" > 
                                        <option value="0" <?php if($status_by_engg == 0){?> selected="selected" <?php }?>>Work in progress</option>
                                        <option value="1" <?php if($status_by_engg == 1){?> selected="selected" <?php }?>>Closed</option> 
                                        <option value="2" <?php if($status_by_engg == 2){?> selected="selected" <?php }?>>RBER</option>  
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-sm-12 mb-1">
                                <input type="hidden" name="call_log_id" id="call_log_id" value="<?=$_GET['call_log_id']?>">
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
            $call_log_id = $('#call_log_id').val(); 
            $call_log_comment = $('#call_log_comment').val();
            $status_by_engg = $('#status_by_engg').val();

            $.ajax({
                method: "POST",
                url: "../ticket_dashboard/function.php",
                data: { fn: "updateGeneratedFormdata", call_log_id: $call_log_id, call_log_comment: $call_log_comment, status_by_engg: $status_by_engg}
            })
            .done(function( res ) {
                $res1 = JSON.parse(res); 
                if($res1.status == true){
                    alert('Data Updated successfully');
                }        
            });//end ajax
            return false;
        })
        



    //Multiple Photo Upload
    function uploadajax(ttl,cl){
        $call_log_id = $('#call_log_id').val();
        var fileList = $('#multiupload').prop("files"); 
        var form_data =  "";
        form_data = new FormData();
        form_data.append("upload_image", fileList[cl]);
        form_data.append("call_log_id", $call_log_id);

        var request = $.ajax({
            url: "../ticket_dashboard/upload_soft.php",
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
                        getAllProductImages($call_log_id);
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
        $call_log_id = $('#call_log_id').val();
        $upload_count = 0;
        if($call_log_id > 0){
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
            url: "../ticket_dashboard/function.php",
            data: { fn: "getAllProductImagesCL", call_log_id: pmsinfoid }
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
                        $html += '<a href="./photos/'+$all_images[$i]+'" target="_blank"><img src="./photos/'+$all_images[$i]+'" width="75" class="img-fluid img-thumbnail" alt="..."></a><a href="javascript: void(0)"> <i class="fa fa-trash" aria-hidden="true" onclick="deleteProdImage(\''+$all_images[$i]+'\')"></i></a>'; 
                    }//end for
                    
                    $('#product_gallery').html($html);
                }//end if
            } //end if       
        });//end ajax

    }//end if

    function deleteProdImage($prod_iamge_name){
        console.log('prod_iamge_name: ' + $prod_iamge_name);
        if (confirm('Are you sure to delete the Image?')) {
            $call_log_id = $('#call_log_id').val();
            $.ajax({
                method: "POST",
                url: "../ticket_dashboard/function.php",
                data: { fn: "deleteProdImageCL", call_log_id: $call_log_id, prod_iamge_name: $prod_iamge_name }
            })
            .done(function( res ) {
                //console.log(res);
                $res1 = JSON.parse(res);
                if($res1.status == true){
                    getAllProductImages($call_log_id);
                }
            });//end ajax
        }		
    }//end fun
    //End multiple pgoto upload
    

    $(document).ready(function () {
        $call_log_id = $('#call_log_id').val();
        getAllProductImages($call_log_id)
    })

    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  </body>
</html>