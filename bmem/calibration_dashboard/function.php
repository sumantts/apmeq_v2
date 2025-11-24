<?php
	include('../assets/php/sql_conn.php');
	$fn = '';
    
	if(isset($_GET["fn"])){
	    $fn = $_GET["fn"];
	}else if(isset($_POST["fn"])){
	    $fn = $_POST["fn"];
	}

	//update Generated Form data
	if($fn == 'updateGeneratedFormdata'){
		$return_result = array();
		$status = true;

		$calib_info_id = $_POST['calib_info_id'];
		$facility_id = $_POST['facility_id'];
		$facility_code = $_POST['facility_code'];
		$department_id = $_POST['department_id'];
		$device_group = $_POST['device_group'];
		$asset_class = $_POST['asset_class'];
		$equipment_name = $_POST['equipment_name'];
		$equipment_make = $_POST['equipment_make'];
		$equipment_model = $_POST['equipment_model'];
		$equipment_sl_no = $_POST['equipment_sl_no'];
		$pms_due_date = $_POST['pms_due_date'];
		$supplied_by = $_POST['supplied_by'];
		$service_provider_details = $_POST['service_provider_details'];
		$pms_planned_date = $_POST['pms_planned_date'];
		$pms_status = $_POST['pms_status'];
		$sp_details = $_POST['sp_details'];
		$asset_id = $_POST['asset_id'];
		
		try {
			if($calib_info_id > 0){
				$status = true;
				$pms_data_updated = date('Y-m-d H:i:s');
				$row_status = 2;
				$sql = "UPDATE calib_info SET sp_details = '" .$sp_details. "', service_provider_details = '" .$service_provider_details. "', pms_planned_date = '" .$pms_planned_date. "', pms_data_updated = '" .$pms_data_updated. "', row_status = '" .$row_status. "', pms_status = '" .$pms_status. "' WHERE calib_info_id = '" .$calib_info_id. "' ";
				$result = $mysqli->query($sql);  	

				if($pms_status == 1){
					$last_date_of_pms = date('Y-m-d');
					$sql_1 = "UPDATE asset_details SET last_date_of_calibration = '" .$last_date_of_pms. "' WHERE asset_id = '".$asset_id."'";
					$mysqli->query($sql_1);  
				}
			}	
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		
		echo json_encode($return_result);
	}//Save function end	


	//Save function start
	if($fn == 'saveFormData'){
		$return_result = array();
		$insert_id1 = 0;
		$password = '12345678';
		$status = true;

		$author_id = $_POST["author_id"];	
		$category_id = $_POST["category_id"];	
		$for_the_year = $_POST["for_the_year"];
		$author_name = $_POST["author_name"];
		$email = $_POST["email"];	
		$registration_number = $_POST["registration_number"];
		$author_photo = $_POST["author_photo"];	
		$author_status = $_POST["author_status"];
		
		try {
			if($author_id > 0){
				$status = true;
				$sql = "UPDATE author_details SET category_id = '" .$category_id. "', for_the_year = '" .$for_the_year. "', author_name = '" .$author_name. "', email = '" .$email. "', registration_number = '" .$registration_number. "', author_photo = '" .$author_photo. "', author_status = '" .$author_status. "' WHERE author_id = '" .$author_id. "' ";
				$result = $mysqli->query($sql);

				//Update login table
				$sql1 = "UPDATE login SET profile_name = '" .$author_name. "', username = '" .$email. "', password = '" .$password. "' WHERE author_id = '" .$author_id. "' ";
				$result1 = $mysqli->query($sql1);
			}else{
				$check_sql = "SELECT * FROM author_details WHERE email = '" .$email. "' ";
				$check_result = $mysqli->query($check_sql);

				if ($check_result->num_rows > 0) {
					$return_result['error_message'] = 'This email already exist';
					$status = false;
				}else{
					$sql = "INSERT INTO author_details (category_id, for_the_year, author_name, email, registration_number, author_photo) VALUES ('" .$category_id. "', '" .$for_the_year. "', '" .$author_name. "', '" .$email. "', '" .$registration_number. "', '" .$author_photo. "')";
					$result = $mysqli->query($sql);
					$insert_id = $mysqli->insert_id;
					if($insert_id > 0){
						$status = true;

						//Insert into login table
						$sql1 = "INSERT INTO login (author_id, profile_name, username, password) VALUES ('" .$insert_id. "', '" .$author_name. "', '" .$email. "', '" .$password. "')";
						$result1 = $mysqli->query($sql1);
						$insert_id1 = $mysqli->insert_id;
					}else{
						$return_result['error_message'] = 'Photo size is soo large';
						$status = false;
					}	
				}//end if	
			}	
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		$return_result['login_id'] = $insert_id1;
		//sleep(2);
		echo json_encode($return_result);
	}//Save function end	

	//function start
	if($fn == 'getTableData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$email1 = '';
		$user_id = $_SESSION["user_id"];
		$facility_id = $_SESSION["facility_id"];
		$user_type_code = $_SESSION["user_type_code"];

		//$sql = "SELECT * FROM facility_master  WHERE user_id = '" .$user_id. "' LIMIT 0, 50";
		if($user_type_code == 'super'){
			$sql = "SELECT * FROM facility_master  WHERE user_id = '" .$user_id. "' LIMIT 0, 50";
		}else{
			$sql = "SELECT * FROM facility_master  WHERE facility_id = '" .$facility_id. "'";
		}
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$facility_id = $row['facility_id'];	
				$facility_name = $row['facility_name'];	
				
				$pms_due = 0;
				$pms_done = 0;
				$pms_planned = 0;		
				$total_asset = 0;

				$sql_5 = "SELECT asset_id, last_date_of_pms, frequency_of_pms, last_date_of_calibration, frequency_of_calibration FROM asset_details WHERE facility_id = '" .$facility_id. "'";
				$result_5 = $mysqli->query($sql_5);
				if ($result_5->num_rows > 0) {			
					while($row_5 = $result_5->fetch_array()){
						$planned_due_done = 0;
						$asset_id = $row_5['asset_id'];
						$last_date_of_calibration = $row_5['last_date_of_calibration'];
						$frequency_of_calibration = $row_5['frequency_of_calibration'];
						
						$total_asset++;

						# Planned Count
						$sql_3 = "SELECT * FROM calib_info WHERE asset_id = '" .$asset_id. "' ORDER BY calib_id DESC LIMIT 0,1";
						$result_3 = $mysqli->query($sql_3);
						if ($result_3->num_rows > 0) {	
							$row_3 = $result_3->fetch_array();
							$pms_status = $row_3['pms_status'];

							if($pms_status == 0){
								$pms_planned++;	
								$planned_due_done = 1;
							}
						}else{
							//$pms_due++;
						}//end if


						# Due Count 
						if($planned_due_done == 0){
							$calib_frequency = '';
							$next_calib_date = ''; 
							# Calibration Frequency Calculation

							if($last_date_of_calibration != '0000-00-00' && $frequency_of_calibration != ''){
								$last_date_of_calibration1 = date('Y-m-d', strtotime($last_date_of_calibration));
								$next_calib_date = $last_date_of_calibration1;
								$date = new DateTime($last_date_of_calibration1);				
								
								$calib_freq_str = explode("|", $frequency_of_calibration);
								if($calib_freq_str[0] > 0){
									$y = $calib_freq_str[0];
									$calib_frequency .= 'Each '.$y.' Year(s)';
									$next_calib_date = date('d-F-Y', strtotime('+'.$y.' year', strtotime($next_calib_date)));
								}
								if($calib_freq_str[1] > 0){
									$m = $calib_freq_str[1];
									if($calib_frequency != ''){
										$calib_frequency .= ' '.$m.' Month(s)';
									}else{
										$calib_frequency .= 'Each '.$m.' Month(s)';
									}
									$next_calib_date = date('d-F-Y', strtotime('+'.$m.' month', strtotime($next_calib_date)));
								}
								if($calib_freq_str[2] > 0){
									$d = $calib_freq_str[2];
									if($calib_frequency != ''){
										$calib_frequency .= ' '.$d.' Day(s)';
									}else{
										$calib_frequency .= 'Each '.$d.' Day(s)';
									}
									$next_calib_date = date('d-F-Y', strtotime('+'.$d.' day', strtotime($next_calib_date)));
								}  
							}							

							if($next_calib_date != ''){					
								$fifteen_day_prev = date('Y-m-d H:i:s',(strtotime ( '-15 day' , strtotime($next_calib_date))));
								
								// Create two DateTime objects
								$today = date('Y-m-d');
								$date1 = new DateTime($today);
								$date2 = new DateTime($fifteen_day_prev);
								$date3 = new DateTime($next_calib_date);

								// Compare the dates
								if ($date1 > $date2 && $date1 < $date3) {
									//PMS within 15 days 
									$pms_due++;	
									$planned_due_done = 2;
								} elseif ($date1 > $date3) {
									//PMS Date over
									$pms_due++;	
									$planned_due_done = 2;
								} else {
									// cool PMS
									//$next_calib_date = '<span class="text-primary">'.$next_calib_date.'</span>';
								}
							}//end if
						}//end if 

						# Done Count
						if($planned_due_done == 0 && $last_date_of_calibration != '0000-00-00'){
							$pms_done++;	
							$planned_due_done = 3; 
						}//end if
					}//end while
				}//end if

				$data[0] = $slno; 
				$data[1] = $facility_name.' (Total Asset: '.$total_asset.')';
				$data[2] = $pms_due;
				$data[3] = $pms_planned;
				$data[4] = $pms_done;

				array_push($mainData, $data);
				$slno++;
			}//end while
		} else {
			$status = false;
		}

		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end		

	//function start
	if($fn == 'getTableData_1'){
		$return_array = array();
		$mainData = array();
		$status = true;
		$slno = 1;

		$facility_id = $_GET['facility_id'];
		$facility_code = $_GET['facility_code'];
		$device_group = $_GET['device_group'];
		$asset_class = $_GET['asset_class'];
		$user_id = $_SESSION["user_id"];
	
		$department_id = $_GET['department_id'];
		$PMSStatus = $_GET['PMSStatus'];
		$PMSRequired = $_GET['PMSRequired'];
	
		$from_date = $_GET['from_date'];
		$to_date = $_GET['to_date'];

		$row_status = 2;
		$where_condition = "WHERE calib_info.calib_id > '0' ";
		if($facility_id > 0){
			$where_condition .= " AND calib_info.facility_id = '" .$facility_id. "' ";
		}
		if($facility_code != ''){
			$where_condition .= " AND calib_info.facility_code = '" .$facility_code. "' ";
		}
		if($device_group > 0){
			$where_condition .= " AND calib_info.device_group = '" .$device_group. "' ";
		}
		if($asset_class > 0){
			$where_condition .= " AND calib_info.asset_class = '" .$asset_class. "' ";
		}
		if($department_id > 0){
			$where_condition .= " AND calib_info.department_id = '" .$department_id. "' ";
		}
		if($PMSStatus != ''){
			$where_condition .= " AND calib_info.pms_status = '" .$PMSStatus. "' ";
		}
		if($from_date != '' && $to_date != ''){
			$from_date1 = $from_date.' 00:01:01';
			$to_date1 = $to_date.' 23:58:00';
			$where_condition .= " AND calib_info.pms_data_updated > '" .$from_date1. "' AND calib_info.pms_data_updated < '" .$to_date1. "' ";
		}
		
		$sql = "SELECT calib_info.calib_id, calib_info.asset_id, calib_info.calib_info_id, calib_info.facility_id, calib_info.facility_code, calib_info.department_id, calib_info.device_group, calib_info.asset_class, calib_info.equipment_name, calib_info.equipment_make,calib_info.equipment_model, calib_info.equipment_sl_no, calib_info.pms_due_date, calib_info.supplied_by, calib_info.service_provider_details, calib_info.pms_planned_date, calib_info.pms_status, calib_info.assign_to_sp_engg, facility_master.facility_name, department_list.department_name, device_group_list.device_name FROM calib_info JOIN facility_master ON calib_info.facility_id = facility_master.facility_id JOIN department_list ON calib_info.department_id = department_list.department_id JOIN device_group_list ON calib_info.device_group = device_group_list.device_group_id $where_condition ORDER BY calib_info.calib_id DESC LIMIT 0, 50";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;

			while($row = $result->fetch_array()){
				$calib_id = $row['calib_id'];
				$calib_info_id = $row['calib_info_id'];
				$asset_id = $row['asset_id'];
				$facility_name = $row['facility_name'];	
				$facility_code = $row['facility_code'];	
				$department_name = $row['department_name'];	 	
				$device_name = $row['device_name'];	 	
				$asset_class = $row['asset_class']; 	
				$pms_status = $row['pms_status']; 			
				$assign_to_sp_engg = $row['assign_to_sp_engg'];

				# select fom asset_details
				$asset_code = '';
				$sp_details = '';
				$sql1 = "SELECT asset_code, sp_details FROM asset_details WHERE asset_id = '" .$asset_id. "' ";
				$result1 = $mysqli->query($sql1);
				if ($result1->num_rows > 0) {
					$row1 = $result1->fetch_array();		
					$asset_code = $row1['asset_code'];			
					$sp_details = $row1['sp_details'];	
				}
				
				$asset_class_text = '';
				if($asset_class == 1){
					$asset_class_text = 'Critical';
				}else if($asset_class == 2){
					$asset_class_text = 'Non Critical';
				}else{} 	
				$equipment_name = $row['equipment_name'];	
				$equipment_make = $row['equipment_make'];		
				$equipment_model = $row['equipment_model'];
				$equipment_sl_no = $row['equipment_sl_no'];	
				if($row['pms_due_date'] != '0000-00-00'){
					$pms_due_date = date('d-m-Y', strtotime($row['pms_due_date']));
				}else{
					$pms_due_date = '';
				}	
				$supplied_by = $row['supplied_by'];		
				$service_provider_details = $row['service_provider_details'];
				if($row['pms_planned_date'] != '0000-00-00'){
					$pms_planned_date = date('d-m-Y', strtotime($row['pms_planned_date']));
				}else{
					$pms_planned_date = '';
				}	
				$view_link = "";
				$view_link .= "<a href='calibration_dashboard/calib_link.php?calib_info_id=$calib_info_id', target='_blank'>View Link</a><br>";
				$view_link .= "<br><a href='calibration_dashboard/calib_link.php?calib_info_id=$calib_info_id&link=external', target='_blank'>Share Link</a>";

				# 0=WIP, 1=Resolved, 2=Closed
				$dynamic_id = 'calib_id_'.$calib_id;
				$updated_text = '';
				$disabled_text = '';
				if($pms_status == 1){
					$disabled_text = 'disabled';
				}

				$updated_text .= '<select name="'.$dynamic_id.'" id="'.$dynamic_id.'" onChange="updatePMSStatus('.$calib_id.','.$asset_id.')" class="form-control-sm" '.$disabled_text.'>';
				if($pms_status == 0){
					$updated_text .= '<option value="0" selected="selected">Planned</option>';
				}else{
					$updated_text .= '<option value="0">Planned</option>';
				}
				if($pms_status == 1){
					$updated_text .= '<option value="1" selected="selected">Done</option>';
				}else{
					$updated_text .= '<option value="1">Done</option>';
				}
				/*if($pms_status == 2){
					$updated_text .= '<option value="2" selected="selected">WIP</option>';
				}else{
					$updated_text .= '<option value="2">WIP</option>';
				}*/
				$updated_text .= '</select>'; 

				
				# Assign to SP or Engg				
				$dynamic_id1 = 'assign_to_sp_engg_'.$calib_id;
				$updated_text1 = '';
				$disabled_text = '';
				if($pms_status == 1 || $pms_status == 2){
					$disabled_text = 'disabled';
				}
				$updated_text1 .= '<select name="'.$dynamic_id1.'" id="'.$dynamic_id1.'" onChange="updateSpEnggStatus('.$calib_id.')" class="form-control-sm" '.$disabled_text.'>';
				if($assign_to_sp_engg == 0){
					$updated_text1 .= '<option value="0" selected="selected">Assign To</option>';
				}else{
					$updated_text1 .= '<option value="0">Assign To</option>';
				}
				if($assign_to_sp_engg == 1){
					$updated_text1 .= '<option value="1" selected="selected">Service Provider</option>';
				}else{
					$updated_text1 .= '<option value="1">Service Provider</option>';
				}
				if($assign_to_sp_engg == 2){
					$updated_text1 .= '<option value="2" selected="selected">Engineer</option>';
				}else{
					$updated_text1 .= '<option value="2">Engineer</option>';
				}
				$updated_text1 .= '</select>'; 

				$data[0] = $slno; 
				$data[1] = $calib_info_id;
				$data[2] = $facility_name;
				$data[3] = $facility_code;
				$data[4] = $department_name;
				$data[5] = $device_name; 
				$data[6] = $asset_class_text;
				$data[7] = $equipment_name;
				$data[8] = $asset_code;
				$data[9] = $equipment_make;
				$data[10] = $equipment_model;
				$data[11] = $equipment_sl_no;
				$data[12] = $pms_due_date; 
				$data[13] = $supplied_by;
				$data[14] = $sp_details;
				$data[15] = $pms_planned_date;
				$data[16] = $updated_text1;
				$data[17] = $view_link;
				$data[18] = $updated_text; 
				
				//$data[8] = "<a href='javascript: void(0)' data-center_id='1'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$author_id.")'></i></a><a href='javascript: void(0)' data-center_id='1'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$author_id.")'></i></a>";
				
				if($PMSStatus != ''){
					$sql_3 = "SELECT * FROM calib_info WHERE asset_id = '" .$asset_id. "' ORDER BY calib_id DESC LIMIT 0,1";
					$result_3 = $mysqli->query($sql_3);
					if ($result_3->num_rows > 0) {	
						$row_3 = $result_3->fetch_array();
						$pms_status = $row_3['pms_status'];

						if($pms_status == $PMSStatus){
							array_push($mainData, $data);
							$slno++;
						}
					}
				}else{
					array_push($mainData, $data);
					$slno++;
				}
			}
		} else {
			$status = false;
		}


		# Get Done Assets 
		if($facility_id > 0 && $PMSStatus == 1){
			$sql = "SELECT * FROM facility_master  WHERE user_id = '" .$user_id. "' AND facility_id = '" .$facility_id. "' LIMIT 0, 50";
			$result = $mysqli->query($sql);

			if ($result->num_rows > 0) {
				$status = true; 

				while($row = $result->fetch_array()){
					$facility_id = $row['facility_id'];	
					$facility_code = $row['facility_code'];	
					$facility_name = $row['facility_name'];	
					
					$pms_due = 0;
					$pms_done = 0;
					$pms_planned = 0;		
					$total_asset = 0;

					$sql_5 = "SELECT asset_details.asset_id, asset_details.facility_id, asset_details.department_id, asset_details.equipment_name, asset_details.asset_make, asset_details.asset_model, asset_details.slerial_number, asset_details.asset_specifiaction, asset_details.date_of_installation, asset_details.ins_certificate, asset_details.asset_supplied_by, asset_details.value_of_the_asset, asset_details.total_year_in_service, asset_details.technology, asset_details.asset_status, asset_details.asset_class, asset_details.device_group, asset_details.last_date_of_calibration, asset_details.calibration_attachment, asset_details.frequency_of_calibration, asset_details.last_date_of_pms, asset_details.pms_attachment, asset_details.frequency_of_pms, asset_details.frequency_of_qa, asset_details.qa_due_date, asset_details.qa_attachment, asset_details.warranty_last_date, asset_details.amc_yes_no, asset_details.amc_last_date, asset_details.cmc_yes_no, asset_details.cmc_last_date, asset_details.asset_code, asset_details.sp_details, asset_details.row_status, device_group_list.device_name FROM asset_details JOIN device_group_list ON asset_details.device_group = device_group_list.device_group_id WHERE asset_details.facility_id = '" .$facility_id. "'";
					$result_5 = $mysqli->query($sql_5);
					if ($result_5->num_rows > 0) {			
						while($row_5 = $result_5->fetch_array()){
							$planned_due_done = 0;
							$asset_id = $row_5['asset_id'];
							$last_date_of_calibration = $row_5['last_date_of_calibration'];
							$frequency_of_calibration = $row_5['frequency_of_calibration'];
							
							$equipment_name = $row_5['equipment_name'];
							$device_group = $row_5['device_group'];
							$asset_class = $row_5['asset_class'];
							$asset_code = $row_5['asset_code'];
							$asset_make = $row_5['asset_make'];
							$asset_model = $row_5['asset_model'];
							$slerial_number = $row_5['slerial_number'];
							$asset_supplied_by = $row_5['asset_supplied_by'];
							$sp_details = $row_5['sp_details'];  
							$department_id = $row_5['department_id']; 
							$device_name = $row_5['device_name']; 
							
							$total_asset++;

							# Planned Count
							$available_in_pms = false;
							$sql_3 = "SELECT * FROM calib_info WHERE asset_id = '" .$asset_id. "' ORDER BY calib_id DESC LIMIT 0,1";
							$result_3 = $mysqli->query($sql_3);
							if ($result_3->num_rows > 0) {	
								$row_3 = $result_3->fetch_array();
								$pms_status = $row_3['pms_status'];

								if($pms_status == 0){
									$pms_planned++;	
									$planned_due_done = 1;
								}
								
								if($pms_status == 1){ 
									$available_in_pms = true;
								}
							}else{
								//$pms_due++;
							}//end if

							$dept_names = '';	
							$ids = '';	 
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
							} 				
							$dept_names = rtrim($dept_names, ", ");


							# Due Count 
							if($planned_due_done == 0){
								$calib_frequency = '';
								$next_calib_date = ''; 
								# Calibration Frequency Calculation

								if($last_date_of_calibration != '0000-00-00' && $frequency_of_calibration != ''){
									$last_date_of_calibration1 = date('Y-m-d', strtotime($last_date_of_calibration));
									$next_calib_date = $last_date_of_calibration1;
									$date = new DateTime($last_date_of_calibration1);				
									
									$calib_freq_str = explode("|", $frequency_of_calibration);
									if($calib_freq_str[0] > 0){
										$y = $calib_freq_str[0];
										$calib_frequency .= 'Each '.$y.' Year(s)';
										$next_calib_date = date('d-F-Y', strtotime('+'.$y.' year', strtotime($next_calib_date)));
									}
									if($calib_freq_str[1] > 0){
										$m = $calib_freq_str[1];
										if($calib_frequency != ''){
											$calib_frequency .= ' '.$m.' Month(s)';
										}else{
											$calib_frequency .= 'Each '.$m.' Month(s)';
										}
										$next_calib_date = date('d-F-Y', strtotime('+'.$m.' month', strtotime($next_calib_date)));
									}
									if($calib_freq_str[2] > 0){
										$d = $calib_freq_str[2];
										if($calib_frequency != ''){
											$calib_frequency .= ' '.$d.' Day(s)';
										}else{
											$calib_frequency .= 'Each '.$d.' Day(s)';
										}
										$next_calib_date = date('d-F-Y', strtotime('+'.$d.' day', strtotime($next_calib_date)));
									}  
								}							

								if($next_calib_date != ''){					
									$fifteen_day_prev = date('Y-m-d H:i:s',(strtotime ( '-15 day' , strtotime($next_calib_date))));
									
									// Create two DateTime objects
									$today = date('Y-m-d');
									$date1 = new DateTime($today);
									$date2 = new DateTime($fifteen_day_prev);
									$date3 = new DateTime($next_calib_date);

									// Compare the dates
									if ($date1 > $date2 && $date1 < $date3) {
										//PMS within 15 days 
										$pms_due++;	
										$planned_due_done = 2;
									} elseif ($date1 > $date3) {
										//PMS Date over
										$pms_due++;	
										$planned_due_done = 2;
									} else {
										// cool PMS
										//$next_calib_date = '<span class="text-primary">'.$next_calib_date.'</span>';
									}

									if($planned_due_done == 2){
										if(sizeof($mainData) > 0){
											$temp_main_data = array();
											for($i = 0; $i < sizeof($mainData); $i++){
												if($mainData[$i][8] != $asset_code){
													array_push($temp_main_data, $mainData[$i]);
												}//end if
											}//end for
											$mainData = array();
											$mainData = $temp_main_data;
										}//end if
									}//end if
									
								}//end if
							}//end if 

							# Done Count
							if($planned_due_done == 0){
								$data[0] = $slno; 
								$data[1] = '-';//$calib_info_id;
								$data[2] = $facility_name;
								$data[3] = $facility_code;
								$data[4] = $dept_names;
								$data[5] = $device_name; 
								$data[6] = ($asset_class == 1)? 'Critical' : 'Non critical';
								$data[7] = $equipment_name;
								$data[8] = $asset_code;
								$data[9] = $asset_make;
								$data[10] = $asset_model;
								$data[11] = $slerial_number;
								$data[12] = date('d-F-Y', strtotime($last_date_of_calibration)); ///**** */
								$data[13] = $asset_supplied_by;
								$data[14] = $sp_details;
								$data[15] = '-';//$pms_planned_date;
								$data[16] = '-';//$updated_text1;
								$data[17] = '-';//$view_link;
								$data[18] = 'DONE';//$updated_text; 

								// check it exists in pms table ot not
								if($available_in_pms == false && $last_date_of_calibration != '0000-00-00'){
									$pms_done++;	
									$planned_due_done = 3; 

									array_push($mainData, $data);
								}//end if
								$slno++;
							}//end if
						}//end while
					}//end if 
				}//end while
			} else {
				$status = false;
			}
		}//end main if
		# Get Done Aset End
			

		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end	

	//function start
	if($fn == 'getFormEditData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$author_id = $_POST['author_id'];

		$sql = "SELECT * FROM author_details WHERE author_id = '" .$author_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			$author_id = $row['author_id'];		
			$category_id = $row['category_id'];		
			$for_the_year = $row['for_the_year'];			
			$author_name = $row['author_name'];		
			$email = $row['email'];				
			$registration_number = $row['registration_number'];			
			$author_status = $row['author_status'];	
			if($row['author_photo'] != ''){
				$author_photo = $row['author_photo'];	
			}else{
				$author_photo = '';
			}
		} else {
			$status = false;
		}
		//$mysqli->close();

		$return_array['author_name'] = $author_name;
		$return_array['category_id'] = $category_id;
		$return_array['for_the_year'] = $for_the_year;
		$return_array['email'] = $email;
		$return_array['registration_number'] = $registration_number;
		$return_array['author_photo'] = $author_photo;
		$return_array['author_status'] = $author_status;
		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//function start
	if($fn == 'loadFormdata'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$calib_info_id = $_POST['calib_info_id'];
		$facility_name = '';

		$sql = "SELECT * FROM calib_info WHERE calib_info_id = '" .$calib_info_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			
			$calib_id = $row['calib_id'];
			$facility_id = $row['facility_id'];
			$facility_code = $row['facility_code'];
			$department_id = $row['department_id'];
			$device_group = $row['device_group'];
			$asset_class = $row['asset_class'];
			$equipment_name = $row['equipment_name'];
			$equipment_make = $row['equipment_make'];
			$equipment_model = $row['equipment_model'];
			$equipment_sl_no = $row['equipment_sl_no'];
			$pms_due_date = $row['pms_due_date'];
			$supplied_by = $row['supplied_by'];
			$service_provider_details = $row['service_provider_details'];
			$pms_planned_date = $row['pms_planned_date'];
			$pms_status = $row['pms_status'];
			$sp_details = $row['sp_details'];
			$asset_code = $row['asset_code'];
			$asset_id = $row['asset_id'];
		} else {
			$status = false;
		}
		//$mysqli->close();

		if($facility_id > 0){
			$sql2 = "SELECT * FROM facility_master WHERE facility_id = '" .$facility_id. "'";
			$result2 = $mysqli->query($sql2);

			if ($result2->num_rows > 0) {
				$status = true;	
				$row2 = $result2->fetch_array();

				$facility_name = $row2['facility_name'];
			}
		}

		$return_array['calib_id'] = $calib_id;
		$return_array['facility_id'] = $facility_id;
		$return_array['facility_name'] = $facility_name;
		$return_array['facility_code'] = $facility_code;
		$return_array['department_id'] = $department_id;
		$return_array['device_group'] = $device_group;
		$return_array['asset_class'] = $asset_class;
		$return_array['equipment_name'] = $equipment_name;
		$return_array['equipment_make'] = $equipment_make;	
		$return_array['equipment_model'] = $equipment_model;	
		$return_array['equipment_sl_no'] = $equipment_sl_no;
		$return_array['pms_due_date'] = $pms_due_date;
		$return_array['supplied_by'] = $supplied_by;
		$return_array['service_provider_details'] = $service_provider_details;
		$return_array['pms_planned_date'] = $pms_planned_date; 
		$return_array['pms_status'] = $pms_status; 
		$return_array['sp_details'] = $sp_details; 
		$return_array['asset_code'] = $asset_code; 
		$return_array['asset_id'] = $asset_id; 

		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$author_id = $_POST["author_id"];
		$status = true;	

		$sql = "DELETE FROM author_details WHERE author_id = '".$author_id."'";
		$result = $mysqli->query($sql);

		//Delete from Login table
		$sql1 = "DELETE FROM login WHERE author_id = '".$author_id."'";
		$result1 = $mysqli->query($sql1);

		$return_result['status'] = $status;
		//sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

	//generate Link
	if($fn == 'generateLink'){
		$return_result = array(); 
		$status = true;	
		$error_message = '';
		$calib_id = 0;
		$link_generated_by = $_SESSION["user_id"];
		$link_generate_time = date('Y-m-d H:i:s');
		
		$sql = "INSERT INTO calib_info (link_generated_by, link_generate_time) VALUES ('" .$link_generated_by. "', '" .$link_generate_time. "')";
		$result = $mysqli->query($sql);
		$calib_id = $mysqli->insert_id;

		if($calib_id > 0){
			$status = true;  
			$calib_info_id = str_pad($calib_id, 4, '0', STR_PAD_LEFT);

			$upd_sql = "UPDATE calib_info SET calib_info_id = '" .$calib_info_id. "' WHERE calib_id = '" .$calib_id. "' ";
			$result_upd = $mysqli->query($upd_sql); 
		}else{
			$return_result['error_message'] = 'Data Insert Error';
			$status = false;
		}

		$return_result['error_message'] = $error_message; 
		$return_result['status'] = $status; 
		$return_result['calib_info_id'] = $calib_info_id; 
		echo json_encode($return_result);
	}//end function deleteItem 

	

	//Get Product Images
	if($fn == 'getAllProductImages'){
		$return_array = array();
		$status = true;
		$all_images = array();
		$calib_info_id = $_POST["calib_info_id"];

		$sql = "SELECT pms_report_attached FROM calib_info WHERE calib_info_id = '".$calib_info_id."'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$slno = 1;
			while($row = $result->fetch_array()){
				$all_images_en = $row['pms_report_attached']; 
				if($all_images_en != ''){
					$status = true;
					$all_images = json_decode($all_images_en);
				}
			}
		} else {
			$status = false;
		}
		//$mysqli->close();

		$return_array['status'] = $status;
		$return_array['all_images'] = $all_images;
    	echo json_encode($return_array);
	}//function end		

	//Delete Single Image
	if($fn == 'deleteProdImage'){
		$return_result = array();
		$all_images = array();
		$all_images_temp = array();
		$status = true;
		$calib_info_id = $_POST["calib_info_id"];
		$prod_iamge_name = $_POST["prod_iamge_name"];

		//Unlink product image
		$sql = "SELECT pms_report_attached FROM calib_info WHERE calib_info_id = '".$calib_info_id."'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$slno = 1;
			while($row = $result->fetch_array()){
				$all_images_en = $row['pms_report_attached']; 
				if($all_images_en != ''){
					$status = true;
					$all_images = json_decode($all_images_en);
					if(sizeof($all_images) > 0){
						for($i = 0; $i < sizeof($all_images); $i++){
							if($all_images[$i] == $prod_iamge_name){
								$file_path = ''.$all_images[$i];
								unlink('photos/'.$file_path);
							}
							if($all_images[$i] != $prod_iamge_name){
								array_push($all_images_temp, $all_images[$i]); 
							}
						}//end for
						$all_images_en = json_encode($all_images_temp);
					}//end if
				}//end if
			}//end while
		} //end if

		$sql = "UPDATE calib_info SET pms_report_attached = '" .$all_images_en. "' WHERE calib_info_id = '".$calib_info_id."'";
		$mysqli->query($sql);

		$return_result['status'] = $status;
		//sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

	//Get Ticket Counter
	if($fn == 'initTicketCounter'){
		$return_array = array();
		$status = true;
		$mainData = array(); 
		$total_ticket = 0; 
		$pending_pms = 0;
		$pms_done = 0;
		$pms_scheduled = 0;
		$pms_due = 0;


		//Total Assets
		$sql1 = "SELECT * FROM calib_info";
		$result1 = $mysqli->query($sql1);
		$total_ticket = $result1->num_rows; 

		$sql_2 = "SELECT * FROM calib_info WHERE row_status = '1' ";
		$result_2 = $mysqli->query($sql_2);
		$pending_pms = $result_2->num_rows;

		//$pms_done = $total_ticket - $pending_pms;		

		$sql_3 = "SELECT * FROM calib_info WHERE pms_status != '0' ";
		$result_3 = $mysqli->query($sql_3);
		$pms_done = $result_3->num_rows;	

		$sql_4 = "SELECT * FROM calib_info WHERE pms_status = '0' ";
		$result_4 = $mysqli->query($sql_4);
		$pms_dopms_scheduledne = $result_4->num_rows;

		
		$sql_5 = "SELECT last_date_of_pms, frequency_of_pms FROM asset_details";
		$result_5 = $mysqli->query($sql_5);

		if ($result_5->num_rows > 0) {			
			while($row_5 = $result_5->fetch_array()){
				$last_date_of_pms = $row_5['last_date_of_pms']; 
				$frequency_of_pms = $row_5['frequency_of_pms']; 

				# PMS Frequency Calculation
				$pms_frequency = '';
				$next_pms_date = '';

				if($last_date_of_pms != '0000-00-00'){
					$last_date_of_pms1 = date('Y-m-d', strtotime($last_date_of_pms));
					$date = new DateTime($last_date_of_pms1); 
						
					$pms_freq_str = explode("|", $frequency_of_pms);
					if($pms_freq_str[0] > 0){
						$y1 = $pms_freq_str[0];
						$pms_frequency = 'Each '.$y1.' Year(s)';
						$next_pms_date = date('d-F-Y', strtotime('+'.$y1.' year', strtotime($last_date_of_pms)));
					}else if($pms_freq_str[1] > 0){
						$m1 = $pms_freq_str[1];
						$pms_frequency = 'Each '.$m1.' Month(s)';
						$next_pms_date = date('d-F-Y', strtotime('+'.$m1.' month', strtotime($last_date_of_pms)));
					}else if($pms_freq_str[2] > 0){
						$d1 = $pms_freq_str[2];
						$pms_frequency = 'Each '.$d1.' Day(s)';
						$next_pms_date = date('d-F-Y', strtotime('+'.$d1.' day', strtotime($last_date_of_pms)));
					}else{
						$pms_frequency = '';
						$next_pms_date = '';
					} 
				}//ennd if

				if($next_pms_date != ''){					
					$fifteen_day_prev = date('Y-m-d H:i:s',(strtotime ( '-15 day' , strtotime($next_pms_date))));
					
					// Create two DateTime objects
					$today = date('Y-m-d');
					$date1 = new DateTime($today); 
					$date2 = new DateTime($next_pms_date);

					// Compare the dates
					if ($date1 > $date2) {
						//PMS Date over
						$pms_due++;
					}
				}//end if
				
			}
		}//end if

		$return_array['status'] = $status;
		$return_array['total_ticket'] = $total_ticket;
		$return_array['pending_pms'] = $pending_pms;
		$return_array['pms_done'] = $pms_done;
		$return_array['pms_dopms_scheduledne'] = $pms_dopms_scheduledne;
		$return_array['pms_due'] = $pms_due;
		
		echo json_encode($return_array);
	}//function end	

	//Update function
	if($fn == 'updatePMSStatus'){
		$return_result = array();
		$calib_id = $_POST["calib_id"];
		$pms_status = $_POST["pms_status"]; 
		$asset_id = $_POST["asset_id"]; 

		$status = true;	
		$last_date_of_pms = date('Y-m-d');

		$sql = "UPDATE calib_info SET pms_status = '" .$pms_status. "' WHERE calib_id = '".$calib_id."'";
		$mysqli->query($sql);  	

		if($pms_status == 1){
			$sql_1 = "UPDATE asset_details SET last_date_of_calibration = '" .$last_date_of_pms. "' WHERE asset_id = '".$asset_id."'";
			$mysqli->query($sql_1);  
		}

		$return_result['status'] = $status; 
		echo json_encode($return_result);
	}//end function deleteItem

	//Update function
	if($fn == 'updateSpEnggStatus'){
		$return_result = array();
		$calib_id = $_POST["calib_id"];
		$assign_to_sp_engg_status = $_POST["assign_to_sp_engg_status"];  

		$status = true;	 

		$sql = "UPDATE calib_info SET assign_to_sp_engg = '" .$assign_to_sp_engg_status. "' WHERE calib_id = '".$calib_id."'";
		$mysqli->query($sql);    

		$return_result['status'] = $status; 
		echo json_encode($return_result);
	}//end function deleteItem

?>