<?php 
if(!$_SESSION["user_id"] || !$_SESSION["user_type_code"]){header('location:?p=signin');}
include('common/head.php');  

if(isset($_POST["importSubmit"])){  
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain'); 

    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){      
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){ 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');          
            $data_saved = 0; 
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
              // Get row data
              $facility_name = $line[0]; 
              $department_name = $line[1]; //sql
              $equipment_name = $line[2];
              $asset_make = $line[3]; 
              $asset_model = $line[4];      
              $slerial_number = $line[5]; 
              $asset_specifiaction = $line[6];  
              $date_of_installation = date('Y-m-d', strtotime($line[7]));  
              // total_year_in_service
                $total_year_in_service = '';
                $today = date('Y-m-d');
                $datetime1 = date_create($date_of_installation);
                $datetime2 = date_create($today);

                // Calculates the difference between DateTime objects
                $interval = date_diff($datetime1, $datetime2);

                // Printing result in years & months format
                $total_year_in_service = $interval->format('%R%y years %m months');
                
              $asset_supplied_by = $line[8];  
              $value_of_the_asset = $line[9]; 
              $technology = 0;
              if($line[10] == 'Obsolute') {
                $technology = 1; 
              }
              if($line[10] == 'Running') {
                $technology = 2; 
              }
                

              $as_name = $line[11];   
              if($line[12] == 'Critical'){
                $asset_class = 1;   
              }
              if($line[12] == 'Non Critical'){
                $asset_class = 2;   
              }

              $device_name = $line[13];  
              $last_date_of_calibration = date('Y-m-d', strtotime($line[14]));  
              $frequency_of_calibrationY = $line[15];  
              $frequency_of_calibrationM = $line[16];  
              $frequency_of_calibrationD = $line[17];  
              $last_date_of_pms = date('Y-m-d', strtotime($line[18]));
              $frequency_of_pmsY = $line[19];   
              $frequency_of_pmsM = $line[20]; 
              $frequency_of_pmsD = $line[21];  

              $qa_due_date = date('Y-m-d', strtotime($line[22]));  
              $warranty_last_date = date('Y-m-d', strtotime($line[23]));  

              if($line[24] == 'Yes'){
                $amc_yes_no = 1;  
              }
              if($line[24] == 'NO'){
                $amc_yes_no = 2;  
              }
              $amc_last_date = date('Y-m-d', strtotime($line[25]));
              
              if($line[26] == 'Yes'){
                $cmc_yes_no = 1;  
              }
              if($line[26] == 'NO'){
                $cmc_yes_no = 2;  
              }
              $cmc_last_date = date('Y-m-d', strtotime($line[27]));  
              $sp_details = $line[28];       

              //Facility ID Name 
              $select_sql1 = "SELECT facility_id FROM facility_master WHERE facility_name = '" .$facility_name. "' ";
              $select_result1 = $mysqli->query($select_sql1); 
              if ($select_result1->num_rows > 0) {
                  $row_get1 = $select_result1->fetch_array();
                  $facility_id = $row_get1['facility_id']; 
              } 

              //Department
              $department_id = '';
              $all_dept = array();
              $dept_str = explode(",", $department_name);              

              foreach($dept_str AS $key => $val){
                $dept_name = $val;

                $select_sql = "SELECT department_id FROM department_list WHERE department_name = '" .$dept_name. "' ";
				$select_result = $mysqli->query($select_sql); 
                if ($select_result->num_rows > 0) {
                    $row_get = $select_result->fetch_array();
                    $department_id_temp = $row_get['department_id'];	
                    if($department_id_temp != ''){
                        array_push($all_dept, $department_id_temp);
                    }
                }
              }//end foreach
              $department_id = json_encode($all_dept); 

              //Asset Status
              $asset_status = 0;
              $sql_get1 = "SELECT * FROM asset_status_code WHERE as_name = '" .$as_name. "'";
              $sql_get_res1 = $mysqli->query($sql_get1); 
              if ($sql_get_res1->num_rows > 0) {
                $sql_get_row1 = $sql_get_res1->fetch_array();
                $asset_status = $sql_get_row1['id'];
              }

              //Device Group
              $device_group = 0;
              $sql_get2 = "SELECT * FROM device_group_list WHERE device_name = '" .$device_name. "'";
              $sql_get_res2 = $mysqli->query($sql_get2); 
              if ($sql_get_res2->num_rows > 0) {
                $sql_get_row2 = $sql_get_res2->fetch_array();
                $device_group = $sql_get_row2['device_group_id'];
              }

              //Frequency of calibration
              $frequency_of_calibration = $frequency_of_calibrationY.'|'.$frequency_of_calibrationM.'|'.$frequency_of_calibrationD;

              //Frequency of PMS
              $frequency_of_pms = $frequency_of_pmsY.'|'.$frequency_of_pmsM.'|'.$frequency_of_pmsD;

  
              //Call SP to save data into DB
              if($data_saved > 0){
                $duplicate_name = false;
                $sql_get4 = "SELECT asset_id FROM asset_details WHERE equipment_name = '" .$equipment_name. "'";
                $result_get4 = $mysqli->query($sql_get4);        
                if ($result_get4->num_rows > 0) { 
                    $duplicate_name = true;
                }

                if($duplicate_name == false){
                    $sql = "INSERT INTO asset_details (facility_id, department_id, equipment_name, asset_make, asset_model, slerial_number, asset_specifiaction, date_of_installation, asset_supplied_by, value_of_the_asset, total_year_in_service, technology, asset_status, asset_class, device_group, last_date_of_calibration, frequency_of_calibration, last_date_of_pms, frequency_of_pms, qa_due_date, warranty_last_date, amc_yes_no, amc_last_date, cmc_yes_no, cmc_last_date, sp_details) VALUES ('" .$facility_id. "', '" .$department_id. "', '" .$equipment_name. "', '" .$asset_make. "', '" .$asset_model. "', '" .$slerial_number. "', '" .$asset_specifiaction. "', '" .$date_of_installation. "', '" .$asset_supplied_by. "', '" .$value_of_the_asset. "', '" .$total_year_in_service. "', '" .$technology. "', '" .$asset_status. "', '" .$asset_class. "', '" .$device_group. "', '" .$last_date_of_calibration. "', '" .$frequency_of_calibration. "', '" .$last_date_of_pms. "', '" .$frequency_of_pms. "', '" .$qa_due_date. "', '" .$warranty_last_date. "', '" .$amc_yes_no. "', '" .$amc_last_date. "', '" .$cmc_yes_no. "', '" .$cmc_last_date. "', '" .$sp_details."')";
                    $result = $mysqli->query($sql);
                    $asset_id_temp = $mysqli->insert_id;
                    if($asset_id_temp > 0){ 
                        //Get facility Code
                        $sql_get3 = "SELECT facility_code FROM facility_master WHERE facility_id = '" .$facility_id. "'";
                        $result_get3 = $mysqli->query($sql_get3);
                
                        if ($result_get3->num_rows > 0) { 
                            $row_get3 = $result_get3->fetch_array();
                            $facility_code = $row_get3['facility_code'];	
                        }
                        $asset_code = $facility_code.''.str_pad($asset_id_temp, 5, '0', STR_PAD_LEFT);

                        $upd_sql = "UPDATE asset_details SET asset_code = '" .$asset_code. "' WHERE asset_id = '" .$asset_id_temp. "' ";
                        $result_upd = $mysqli->query($upd_sql);                     
                    }
                }//end duplicate checking if
              }
              $data_saved++;
            }//end while
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = 'success';
        }else{
            $qstring = 'error';
        }
    }else{
        $qstring = 'invalid_file';
    }
    
  }//end isset

   //exit();
?> 

<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->	
	<?php include('common/nav.php'); ?>
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<?php include('common/top_bar.php'); ?>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?=$title?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!"><?=$title?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-table ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Filter Assets</h5> 
                    </div>
                    <div class="card-body">                        

                        <form method="POST" action="#" id="searchForm">
                            <div class="form-row">                               
                                <div class="col-md-4 mb-3">
                                    <label for="author_name">Facility Name</label>
                                    <select class="form-control js-example-basic-single" name="facility_id_sr" id="facility_id_sr" required>
                                        <option value="">Select</option> 
                                    </select> 
                                </div>       

                                <div class="col-md-4 mb-3">
                                    <label for="warranty">Warranty</label>
                                    <select class="form-control" name="warranty_sr" id="warranty_sr" required>
                                        <option value="">Select</option> 
                                        <option value="1">Warranty</option> 
                                        <option value="2">Without Warranty</option> 
                                    </select> 
                                </div>  

                                <div class="col-md-4 mb-3">
                                    <label for="facility_code">Facility Code</label>
                                    <input type="text" class="form-control" id="facility_code" value="" > 
                                </div>   

                                <div class="col-md-4 mb-3">
                                    <label for="asset_code_sr">Asset code</label>
                                    <input type="text" class="form-control" id="asset_code_sr" value="" > 
                                </div>   

                                <div class="col-md-1 mt-4 mr-3">
                                    <button class="btn  btn-primary" type="button" id="submitFormSearch">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Search</span>
                                    </button>
                                </div>  
                                
                                <div class="col-md-2 mt-4 ">
                                    <button class="btn btn-dark" type="button" id="clearFormSearch">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="clearFilter">Clear Filter</span>
                                    </button>
                                </div>   
                                
                                <div class="col-md-2 mt-4 ">
                                    <button class="btn btn-dark" type="button" id="openCSVModal"> Upload CSV </button>
                                </div> 
                                
                                <div class="col-md-4 mt-4 ">
                                    <button class="btn btn-dark" type="button" id="generateBarcode">Generate Barcode</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ sample-table ] start -->
            <div class="col-sm-12 d-block" id="_partTwo">
                <div class="card">
                    <div class="card-header">
                        <h5>Filtered Table Data</h5>                        
                    </div>
                    <div class="card-body">                         
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th> 
                                        <th>Facility name</th>
                                        <th>Department</th>
                                        <th>Equipment name</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Slerial number</th>
                                        <th>Specifiaction</th>
                                        <th>Date of installation</th>
                                        <th>Supplied by</th>
                                        <th>Value of the asset</th>
                                        <th>Total year in service</th>
                                        <th>Warrenty last date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sl.No.</th> 
                                        <th>Facility name</th>
                                        <th>Department</th>
                                        <th>Equipment name</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Slerial number</th>
                                        <th>Specifiaction</th>
                                        <th>Date of installation</th>
                                        <th>Supplied by</th>
                                        <th>Value of the asset</th>
                                        <th>Total year in service</th>
                                        <th>Warrenty last date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>                       

                    </div>
                </div>
            </div>
            <!-- [ sample-table ] start -->
            <div class="col-sm-12" id="partThree">
                <div class="card">
                    <div class="card-header">
                        <h5>Add/Update Asset </h5> 
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert">
							<strong>Success!</strong> Your Data Deleted successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert1">
							<strong>Success!</strong> Your Data saved successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>                         

                        <form method="POST" action="#" id="myForm">  
                        <div class="form-row">                                  
                            <div class="col-md-4 mb-3">
                                <label for="facility_id_dd" class="text-danger">Facility name*</label>
                                <select class="form-control js-example-basic-single" name="facility_id_dd" id="facility_id_dd" required>
                                    <option value="">Select</option> 
                                </select> 
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="department_id" class="text-danger">Department*</label>
                                <select class="form-control js-example-basic-single" name="department_id" id="department_id" required multiple>
                                    <option value="">Select</option> 
                                </select> 
                                <input type="hidden" name="h_dept_edit_ids" id="h_dept_edit_ids" value="">
                            </div>
                                
                            <div class="col-md-4 mb-3">
                                <label for="equipment_name" class="text-danger">Equipment name*</label>
                                <input type="text" class="form-control" id="equipment_name" value="" required> 
                            </div>  
                                
                            <div class="col-md-4 mb-3">
                                <label for="asset_make">Make</label>
                                <input type="text" class="form-control" id="asset_make" value=""> 
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="asset_model">Model</label>
                                <input type="text" class="form-control" id="asset_model" value=""> 
                            </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="slerial_number">Slerial number</label>
                                    <input type="text" class="form-control" id="slerial_number" value=""> 
                                </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="asset_specifiaction">Specifiaction</label>
                                    <input type="text" class="form-control" id="asset_specifiaction" value=""> 
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="date_of_installation">Date of installation</label>
                                    <input type="date" class="form-control" id="date_of_installation" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <label for="ins_cert_attach">Installaion certificate attachment</label><br>
                                    <a href="javascript: void(0)" id="ins_cert_attach">Upload & View Certificate</a> 
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="asset_supplied_by">Supplied by</label>
                                    <input type="text" class="form-control" id="asset_supplied_by" value=""> 
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="value_of_the_asset">Value of the asset</label>
                                    <input type="text" class="form-control" id="value_of_the_asset" value=""> 
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="total_year_in_service">Total year in service</label>
                                    <input type="text" class="form-control" id="total_year_in_service" value="" readonly> 
                                </div> 
                                
                                <div class="col-md-4 mb-3">
                                    <label for="technology" class="text-danger">Technology*</label>
                                    <select class="form-control js-example-basic-single" name="technology" id="technology" required>
                                        <option value="">Select</option>
                                        <option value="1">Obsolute</option>
                                        <option value="2">Running</option>
                                    </select> 
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="asset_status" class="text-danger">Asset status*</label>
                                    <select class="form-control js-example-basic-single" name="asset_status" id="asset_status" required>
                                        <option value="">Select</option>
                                        <?php
                                        $sql_get = "SELECT * FROM asset_status_code";
                                        $sql_get_res = $mysqli->query($sql_get); 
                                        if ($sql_get_res->num_rows > 0) {
                                            while($sql_get_row = $sql_get_res->fetch_array()){
                                            $id = $sql_get_row['id'];
                                            $as_name = $sql_get_row['as_name'];
                                        ?>
                                        <option value="<?=$id?>"><?=$as_name?></option>
                                        <?php } } ?>
                                        <!-- <option value="1">Working</option>
                                        <option value="2">Not Working</option>
                                        <option value="3">Not in Use</option>
                                        <option value="4">Packed</option>
                                        <option value="5">RBER</option>
                                        <option value="6">Verified Assets</option>
                                        <option value="7">Non-Verified Assets</option> -->
                                    </select> 
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="asset_class" class="text-danger">Asset class*</label>
                                    <select class="form-control js-example-basic-single" name="asset_class" id="asset_class" required>
                                        <option value="">Select</option>
                                        <option value="1">Critical</option>
                                        <option value="2">Non Critical</option>
                                    </select> 
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="device_group">Device Group</label>
                                    <select class="form-control js-example-basic-single" name="device_group" id="device_group">
                                        <option value="">Select</option>  
                                    </select> 
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="last_date_of_calibration">Last date of calibration</label>
                                    <input type="date" class="form-control" id="last_date_of_calibration" value=""> 
                                </div>
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <label for="ins_cert_attach">calibration Certificate</label><br>
                                    <a href="javascript: void(0)" id="calib_cert_attach">Upload & View calibration Certificate</a> 
                                </div>      
                                
                                <div class="col-md-4 mb-3">
                                    <label for="frequency_of_calibration">Frequency of calibration</label>
                                    <input type="hidden" name="frequency_of_calibration" id="frequency_of_calibration" value="">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="y">Year(s)</label>
                                            <input type="number" class="form-control form-control-sm" name="frequency_of_calibration_y" id="frequency_of_calibration_y">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="m">Month(s)</label>
                                            <input type="number" class="form-control form-control-sm" name="frequency_of_calibration_m" id="frequency_of_calibration_m"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label for="d">Day(s)</label>
                                            <input type="number" class="form-control form-control-sm" name="frequency_of_calibration_d" id="frequency_of_calibration_d"> 
                                        </div>
                                    </div>
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="last_date_of_pms">Last date of Preventive Maintanence(PMS)</label>
                                    <input type="date" class="form-control" id="last_date_of_pms" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <label for="pms_cert_attach">PMS Certificate</label><br>
                                    <a href="javascript: void(0)" id="pms_cert_attach">Upload & View PMS Certificate</a> 
                                </div>     
                                
                                <div class="col-md-4 mb-3">
                                    <label for="frequency_of_pms">Frequency of Preventive Maintenence(PMS)</label>
                                    <input type="hidden" name="frequency_of_pms" id="frequency_of_pms" value="">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="y">Year(s)</label>
                                            <input type="number" class="form-control form-control-sm" name="frequency_of_pms_y" id="frequency_of_pms_y"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label for="m">Month(s)</label>
                                            <input type="number" class="form-control form-control-sm" name="frequency_of_pms_m" id="frequency_of_pms_m"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label for="d">Day(s)</label>
                                            <input type="number" class="form-control form-control-sm" name="frequency_of_pms_d" id="frequency_of_pms_d"> 
                                        </div>
                                    </div>
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="qa_due_date">(QA)Quality Certification due date</label>
                                    <input type="date" class="form-control" id="qa_due_date" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <label for="qa_cert_attach">QA Certificate</label><br>
                                    <a href="javascript: void(0)" id="qa_cert_attach">Upload & View QA Certificate</a> 
                                </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="warranty_last_date">Warranty last date</label>
                                    <input type="date" class="form-control" id="warranty_last_date" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-3">
                                    <label for="amc_yes_no" >AMC</label>
                                    <select class="form-control js-example-basic-single" name="amc_yes_no" id="amc_yes_no">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">NO</option>
                                    </select> 
                                </div>  
                                
                                <div class="col-md-4 mb-3 d-none" id="block_amc">
                                    <label for="amc_last_date">Last Date of AMC</label>
                                    <input type="date" class="form-control" id="amc_last_date" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-3">
                                    <label for="cmc_yes_no">CMC</label>
                                    <select class="form-control js-example-basic-single" name="cmc_yes_no" id="cmc_yes_no">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">NO</option>
                                    </select> 
                                </div>  
                                
                                <div class="col-md-4 mb-3 d-none" id="block_cmc">
                                    <label for="cmc_last_date">Last Date of CMC</label>
                                    <input type="date" class="form-control" id="cmc_last_date" value=""> 
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="asset_code">Asset Code</label>
                                    <input type="text" class="form-control" id="asset_code" value="" readonly> 
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label for="sp_details">Service Provider Details(Contact Number, Email Id) (in Warranty/AMC/CMC)</label> 
                                    <textarea class="form-control" id="sp_details" value="" ></textarea> 
                                </div>  
                            </div>

                            <div class="form-row"> 
                                <div class="col-md-1 mt-4">
                                    <input type="hidden" name="asset_id" id="asset_id" value="">
                                    <button class="btn  btn-primary" type="submit" id="submitForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Save</span>
                                    </button>
                                </div>                                  
                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-dark" type="button" id="clearForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Cancel</span>
                                    </button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Form --> 


            <!-- 1. Modal start -->
            <div id="exampleModalLong" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">File Attachment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="POST" id="myFormModal">
                                <div class="form-row">                                    
                                    <div class="col-md-3 mt-4 mr-2">
                                        <input type="file" id="multiupload" name="uploadFiledd[]" multiple accept=".jpg,.jpeg,.png" >
                                        <span id="uploadMessage"></span>
                                    </div> 

                                    <div class="col-md-1 mt-4"> 
                                        
                                        <input type="hidden" name="field_name" id="field_name" value="">
                                    </div> 
                                </div>
                                <hr>
                                <div class="form-row"> 
                                    <div class="col-md-12 mb-3">
                                        <div class="text-center" id="product_gallery"> 
                                            <h5>No Attachment Available</h5>
                                            <!-- <img src="products/add_product/photos/668a0b1f77bb7.png" width="75" class="img-fluid img-thumbnail" alt="..."><a href='javascript: void(0)'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteProdImage()'></i></a>  -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" id="user_id" value="0">                                
                                <button type="button" id="startUpload" class="btn btn-primary">Upload</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>                        
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal end --> 


            <!-- 2. Modal start -->
            <div id="exampleModalLong_1" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLong_1Title" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLong_1Title">Upload CSV</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" id="myFormModal_1" name="myFormModal_1" enctype="multipart/form-data">
                                <div class="form-row">                                    
                                    <div class="col-md-4 mt-4 mr-2">
                                        <input type="file" name="file" id="file" accept=".csv" required>
                                        <span id="uploadMessage_1"></span>
                                    </div>
                                    <div class="col-md-3 mt-4 mr-2">
                                        <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row"> 
                                    <div class="col-md-12 mb-3">
                                        <div class="text-center"> 
                                            <h5>You can download the sample file from Here</h5>
                                            <a href="./assets/csv/AssetCSV.csv" download>Download Link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" id="user_id" value="0">                                
                                <!-- <button type="button" id="startUpload1" class="btn btn-primary">Upload</button> -->
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>                        
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal end -->

            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
	<?php include('common/footer.php'); ?>
    
    <script src="asset/function.js?d=<?=date('Ymdhis')?>"></script>