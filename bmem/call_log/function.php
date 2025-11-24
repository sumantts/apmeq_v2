<?php
	include('../assets/php/sql_conn.php');
	$fn = '';
    
	if(isset($_GET["fn"])){
	    $fn = $_GET["fn"];
	}else if(isset($_POST["fn"])){
	    $fn = $_POST["fn"];
	}	

	//Get Asset Details
	if($fn == 'getAssetDetails'){
		$return_array = array();
		$mainData = array();
		$asset_code = $_POST['asset_code'];
		$facility_id = $_SESSION["facility_id"];
		$user_type_code = $_SESSION["user_type_code"];
		
		$asset_id = ''; 
		$facility_id = '';
		$facility_name = ''; 
		$department_id = ''; 
		$equipment_name = ''; 
		$asset_make = ''; 
		$asset_model = ''; 
		$slerial_number = ''; 
		$asset_specifiaction = ''; 
		$date_of_installation = ''; 
		$asset_supplied_by = ''; 
		$value_of_the_asset = ''; 
		$total_year_in_service = ''; 
		$technology = ''; 
		$asset_status = ''; 
		$asset_class = ''; 
		$device_group = ''; 
		$last_date_of_calibration = '';  
		$frequency_of_calibration = ''; 
		$frequency_of_calibration_y = ''; 
		$frequency_of_calibration_m = ''; 
		$frequency_of_calibration_d = ''; 
		$last_date_of_pms = '';  
		$frequency_of_pms = ''; 
		$frequency_of_pms_y = ''; 
		$frequency_of_pms_m = ''; 
		$frequency_of_pms_d = ''; 
		$qa_due_date = '';
		$warranty_last_date = ''; 
		$amc_yes_no = ''; 
		$amc_last_date = ''; 
		$cmc_yes_no = ''; 
		$cmc_last_date = '';   
		$sp_details = '';
		$status = true;

		if($user_type_code == 'super'){
			$sql = "SELECT asset_details.*, facility_master.facility_name FROM asset_details JOIN facility_master ON asset_details.facility_id = facility_master.facility_id WHERE asset_details.asset_code = '" .$asset_code. "'";
		}else{
			$sql = "SELECT asset_details.*, facility_master.facility_name FROM asset_details JOIN facility_master ON asset_details.facility_id = facility_master.facility_id WHERE asset_details.asset_code = '" .$asset_code. "' AND facility_master.facility_id = '" .$facility_id. "'";
		}

		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			$frequency_of_pms_y = 0;
			$frequency_of_pms_m = 0;
			$frequency_of_pms_d = 0;

			$frequency_of_calibration_y = 0;
			$frequency_of_calibration_m = 0;
			$frequency_of_calibration_d = 0;

			$asset_id = $row['asset_id']; 
			$facility_id = $row['facility_id']; 
			$facility_name = $row['facility_name'];
			$department_id = json_decode($row['department_id']); 
			$equipment_name = $row['equipment_name']; 
			$asset_make = $row['asset_make']; 
			$asset_model = $row['asset_model']; 
			$slerial_number = $row['slerial_number']; 
			$asset_specifiaction = $row['asset_specifiaction']; 
			$date_of_installation = $row['date_of_installation']; 
			$asset_supplied_by = $row['asset_supplied_by']; 
			$value_of_the_asset = $row['value_of_the_asset']; 
			$total_year_in_service = $row['total_year_in_service']; 
			$technology = $row['technology']; 
			$asset_status = $row['asset_status']; 
			$asset_class = $row['asset_class']; 
			$device_group = $row['device_group']; 
			$last_date_of_calibration = $row['last_date_of_calibration'];  
			$frequency_of_calibration = $row['frequency_of_calibration']; 
			$frequency_of_calibration_sp = explode('|', $frequency_of_calibration);
			if(sizeof($frequency_of_calibration_sp) > 0){
				$frequency_of_calibration_y = $frequency_of_calibration_sp[0];
			}
			if(sizeof($frequency_of_calibration_sp) > 1){
				$frequency_of_calibration_m = $frequency_of_calibration_sp[1];
			}
			if(sizeof($frequency_of_calibration_sp) > 2){
				$frequency_of_calibration_d = $frequency_of_calibration_sp[2];
			}
			$last_date_of_pms = $row['last_date_of_pms'];  
			$frequency_of_pms = $row['frequency_of_pms']; 
			$frequency_of_pms_st = explode('|', $frequency_of_pms);
			if(sizeof($frequency_of_pms_st) > 0){
				$frequency_of_pms_y = $frequency_of_pms_st[0];
			}
			if(sizeof($frequency_of_pms_st) > 1){
				$frequency_of_pms_m = $frequency_of_pms_st[1];
			}			
			if(sizeof($frequency_of_pms_st) > 2){
				$frequency_of_pms_d = $frequency_of_pms_st[2];
			}
			$qa_due_date = $row['qa_due_date'];
			$warranty_last_date = $row['warranty_last_date']; 
			$amc_yes_no = $row['amc_yes_no']; 
			$amc_last_date = $row['amc_last_date']; 
			$cmc_yes_no = $row['cmc_yes_no']; 
			$cmc_last_date = $row['cmc_last_date']; 
			$asset_code = $row['asset_code'];		
			$sp_details = $row['sp_details'];		
			
		} else {
			$status = false;
		}
		
		$return_array['asset_id'] = $asset_id; 
		$return_array['facility_id'] = $facility_id; 
		$return_array['facility_name'] = $facility_name; 
		$return_array['department_id'] = $department_id; 
		$return_array['equipment_name'] = $equipment_name; 
		$return_array['asset_make'] = $asset_make; 
		$return_array['asset_model'] = $asset_model; 
		$return_array['slerial_number'] = $slerial_number; 
		$return_array['asset_specifiaction'] = $asset_specifiaction; 
		$return_array['date_of_installation'] = $date_of_installation; 
		$return_array['asset_supplied_by'] = $asset_supplied_by; 
		$return_array['value_of_the_asset'] = $value_of_the_asset; 
		$return_array['total_year_in_service'] = $total_year_in_service; 
		$return_array['technology'] = $technology; 
		$return_array['asset_status'] = $asset_status; 
		$return_array['asset_class'] = $asset_class; 
		$return_array['device_group'] = $device_group; 
		$return_array['last_date_of_calibration'] = date('d-m-Y', strtotime($last_date_of_calibration));  
		$return_array['frequency_of_calibration'] = $frequency_of_calibration; 
		$return_array['frequency_of_calibration_y'] = $frequency_of_calibration_y; 
		$return_array['frequency_of_calibration_m'] = $frequency_of_calibration_m; 
		$return_array['frequency_of_calibration_d'] = $frequency_of_calibration_d; 
		$return_array['last_date_of_pms'] = date('d-m-Y', strtotime($last_date_of_pms));  
		$return_array['frequency_of_pms'] = $frequency_of_pms; 
		$return_array['frequency_of_pms_y'] = $frequency_of_pms_y; 
		$return_array['frequency_of_pms_m'] = $frequency_of_pms_m; 
		$return_array['frequency_of_pms_d'] = $frequency_of_pms_d; 
		$return_array['qa_due_date'] = date('d-m-Y', strtotime($qa_due_date));
		$return_array['warranty_last_date'] = date('d-m-Y', strtotime($warranty_last_date)); 
		$return_array['amc_yes_no'] = $amc_yes_no; 
		$return_array['amc_last_date'] = $amc_last_date; 
		$return_array['cmc_yes_no'] = $cmc_yes_no; 
		$return_array['cmc_last_date'] = $cmc_last_date;  
		$return_array['asset_code'] = $asset_code;
		$return_array['sp_details'] = $sp_details;
		$return_array['status'] = $status;

    	echo json_encode($return_array);
	}//function end

	//Save function start
	if($fn == 'saveFormData'){
		$return_result = array();
		$insert_id = 0;
		$token_id = '';
		$status = true;

		$facility_id = $_POST['facility_id'];
		$asset_code = $_POST['asset_code'];
		$user_id = $_POST['user_id'];
		$ticket_raiser_name = $_POST['ticket_raiser_name']; 
		$ticket_raiser_contact = $_POST['ticket_raiser_contact'];
		$issue_description = $_POST['issue_description']; 
		$call_log_date_time = date('Y-m-d H:i:s');
    
		$amc_yes_no = $_POST['amc_yes_no']; 
		$amc_last_date = $_POST['amc_last_date']; 
		$cmc_yes_no = $_POST['cmc_yes_no']; 
		$cmc_last_date = $_POST['cmc_last_date']; 
		
		try {
			if($issue_description == ''){
				$return_result['error_message'] = 'Please write the issue description';
				$status = false;
			}else{
				$call_log_status = 2;
				$sql_1 = "SELECT * FROM call_log_register WHERE asset_code = '" .$asset_code. "' AND call_log_status != '" .$call_log_status. "' ";
				$result_1 = $mysqli->query($sql_1);

				if ($result_1->num_rows > 0) {
					$status = false;	
					$row_1 = $result_1->fetch_array();
					$token_id = $row_1['token_id'];
					$return_result['error_message'] = 'Call Log already registered, Ticket ID #'.$token_id;
				}else{
					//Insert into table
					$sql1 = "INSERT INTO call_log_register (facility_id, asset_code, user_id, ticket_raiser_name, ticket_raiser_contact, issue_description, call_log_date_time, amc_yes_no, amc_last_date, cmc_yes_no, cmc_last_date) VALUES ('" .$facility_id. "', '" .$asset_code. "', '" .$user_id. "', '" .$ticket_raiser_name. "', '" .$ticket_raiser_contact. "', '" .$issue_description. "', '" .$call_log_date_time. "', '" .$amc_yes_no. "', '" .$amc_last_date. "', '" .$cmc_yes_no. "', '" .$cmc_last_date. "')";
					$result1 = $mysqli->query($sql1);
					$insert_id = $mysqli->insert_id;	

					if($insert_id > 0){
						$status = true;  
						//$token_id = str_pad($insert_id, 4, '0', STR_PAD_LEFT);
						$token_id = date('dmY-Hms');

						$upd_sql = "UPDATE call_log_register SET token_id = '" .$token_id. "' WHERE call_log_id = '" .$insert_id. "' ";
						$result_upd = $mysqli->query($upd_sql); 
					}else{
						$return_result['error_message'] = 'Data Insert Error';
						$status = false;
					}
				}//end if
			}
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		$return_result['insert_id'] = $insert_id;
		$return_result['token_id'] = $token_id;
		//sleep(2);
		echo json_encode($return_result);
	}//Save function end 
	

?>