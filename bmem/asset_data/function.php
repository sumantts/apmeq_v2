<?php
	include('../assets/php/sql_conn.php');
	$fn = '';
    
	if(isset($_GET["fn"])){
	    $fn = $_GET["fn"];
	}else if(isset($_POST["fn"])){
	    $fn = $_POST["fn"];
	} 

	//function start
	if($fn == 'getTableData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$email1 = '';
		$facility_id = $_GET['facility_id'];
		
		$sql = "SELECT asset_details.asset_id, asset_details.facility_id, asset_details.department_id, asset_details.equipment_name, asset_details.asset_make, asset_details.asset_model, asset_details.slerial_number, asset_details.asset_specifiaction, asset_details.date_of_installation, asset_details.ins_certificate, asset_details.asset_supplied_by, asset_details.value_of_the_asset, asset_details.total_year_in_service, asset_details.technology, asset_details.asset_status, asset_details.asset_class, asset_details.device_group, asset_details.last_date_of_calibration, asset_details.calibration_attachment, asset_details.frequency_of_calibration, asset_details.last_date_of_pms, asset_details.pms_attachment, asset_details.frequency_of_pms, asset_details.qa_due_date, asset_details.qa_attachment, asset_details.warranty_last_date, asset_details.amc_yes_no, asset_details.amc_last_date, asset_details.cmc_yes_no, asset_details.cmc_last_date, asset_details.asset_code, asset_details.sp_details, asset_details.asset_code, asset_details.row_status, facility_master.facility_name, facility_master.facility_code FROM asset_details JOIN facility_master ON asset_details.facility_id = facility_master.facility_id WHERE asset_details.row_status = 1 AND asset_details.facility_id = '" .$facility_id. "' ORDER BY asset_details.asset_id DESC LIMIT 0, 50";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$asset_id = $row['asset_id'];		
				$facility_id = $row['facility_id'];				
				$facility_name = $row['facility_name'];				
				$facility_code = $row['facility_code'];
				//$department_id = $row['department_id']; 	
				//$department_name = $row['department_name']; 
				//$department_code = $row['department_code']; 		
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
				$asset_code = $row['asset_code']; 
				$asset_class = $row['asset_class']; 
				$warranty_last_date = $row['warranty_last_date']; 
				$amc_yes_no = $row['amc_yes_no']; 
				$amc_last_date = $row['amc_last_date']; 
				$cmc_yes_no = $row['cmc_yes_no']; 
				$cmc_last_date = $row['cmc_last_date']; 
				$frequency_of_calibration = $row['frequency_of_calibration']; 
				$qa_due_date = $row['qa_due_date']; 
				$frequency_of_pms = $row['frequency_of_pms']; 
				$last_date_of_calibration = $row['last_date_of_calibration']; 
				$last_date_of_pms = $row['last_date_of_pms']; 

				$asset_status_text = '-';
				if($asset_status == 5){
					$asset_status_text = 'RBER/Condemned';
				} 

				$maintanence_type = '';
				if($warranty_last_date != '0000-00-00'){
					$maintanence_type .= 'Warranty Date: '.date('d-F-Y', strtotime($warranty_last_date));
				}
				if($amc_yes_no == 1){
					$maintanence_type .= '<br>AMC Last Date: '.date('d-F-Y', strtotime($amc_last_date));					
				}
				if($cmc_yes_no == 1){
					$maintanence_type .= '<br>CMC Last Date: '.date('d-F-Y', strtotime($cmc_last_date));					
				}
				if($technology == 1){
					$technology_text = 'Obsolute';					
				}
				if($technology == 2){
					$technology_text = 'Running';					
				}

				
				$asset_status_arr = ["Select", "Working", "Not Working", "Not in Use", "Packed", "RBER", "Verified Assets", "Non-Verified Assets"];

				$asset_status_text1 = '';
				if($asset_status >= 1 && $asset_status <= 5){
					$asset_status_text1 = $asset_status_arr[$asset_status];
				}

				$asset_status_text2 = '';
				if($asset_status >= 6 && $asset_status <= 7){
					$asset_status_text2 = $asset_status_arr[$asset_status];
				}

				$asset_class_text = '';
				if($asset_class == 1){
					$asset_class_text = 'Critical';
				}
				if($asset_class == 2){
					$asset_class_text = 'Non Critical';
				}

				# Calibration Frequency Calculation
				$calib_frequency = '';
				$next_calib_date = '';

				if($last_date_of_calibration != '0000-00-00'){
					$last_date_of_calibration1 = date('Y-m-d', strtotime($last_date_of_calibration));
					$date = new DateTime($last_date_of_calibration1);				
					
					$calib_freq_str = explode("|", $frequency_of_calibration);
					if($calib_freq_str[0] > 0){
						$y = $calib_freq_str[0];
						$calib_frequency = 'Each '.$y.' Year(s)';
						$next_calib_date = date('d-F-Y', strtotime('+'.$y.' year', strtotime($last_date_of_calibration)));
					}else if($calib_freq_str[1] > 0){
						$m = $calib_freq_str[0];
						$calib_frequency = 'Each '.$m.' Month(s)';
						$next_calib_date = date('d-F-Y', strtotime('+'.$m.' month', strtotime($last_date_of_calibration)));
					}else if($calib_freq_str[2] > 0){
						$d = $calib_freq_str[2];
						$calib_frequency = 'Each '.$d.' Day(s)';
						$next_calib_date = date('d-F-Y', strtotime('+'.$d.' day', strtotime($last_date_of_calibration)));
					}else{
						$calib_frequency = '';
						$next_calib_date = '';
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
						$next_calib_date = '<span class="text-warning blink">'.$next_calib_date.'</span>';
					} elseif ($date1 > $date3) {
						//PMS Date over
						$next_calib_date = '<span class="text-danger blink">'.$next_calib_date.'</span>';
					} else {
						// cool PMS
						$next_calib_date = '<span class="text-primary">'.$next_calib_date.'</span>';
					}
				}//end if

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
					$date2 = new DateTime($fifteen_day_prev);
					$date3 = new DateTime($next_pms_date);


					// Compare the dates
					if ($date1 > $date2 && $date1 < $date3) {
						//PMS within 15 days
						$next_pms_date = '<span class="text-warning blink">'.$next_pms_date.'</span><br><a href="javascript: void(0)" onclick="generatePMSLink('.$asset_id.')">Generate Link</a>';
					} elseif ($date1 > $date3) {
						//PMS Date over
						$next_pms_date = '<span class="text-danger blink">'.$next_pms_date.'</span><br><a href="javascript: void(0)" onclick="generatePMSLink('.$asset_id.')">Generate Link</a>';
					} else {
						// cool PMS
						$next_pms_date = '<span class="text-primary">'.$next_pms_date.'</span>';
					}
				}//end if

				$data[0] = $slno; 
				$data[1] = $facility_name;
				$data[2] = $facility_code;
				$data[3] = $asset_status_text;
				$data[4] = $equipment_name; 
				$data[5] = $asset_code;
				$data[6] = $maintanence_type;
				$data[7] = $calib_frequency;
				$data[8] = $next_calib_date;
				$data[9] = $pms_frequency;
				$data[10] = $next_pms_date;
				$data[11] = $technology_text;
				$data[12] = $asset_status_text1;
				$data[13] = $asset_status_text2;
				$data[14] = $asset_class_text;  

				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		}

			

		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end	 

	

	//generate Link
	if($fn == 'generateLink'){
		$return_result = array(); 
		$status = true;	
		$error_message = '';
		$pms_id = 0;
		$asset_id = $_POST['asset_id'];
		$link_generated_by = $_SESSION["user_id"];
		$link_generate_time = date('Y-m-d H:i:s');
		
		$sql = "INSERT INTO pms_info (asset_id, link_generated_by, link_generate_time) VALUES ('" .$asset_id. "', '" .$link_generated_by. "', '" .$link_generate_time. "')";
		$result = $mysqli->query($sql);
		$pms_id = $mysqli->insert_id;

		if($pms_id > 0){
			$status = true;  
			$pms_info_id = str_pad($pms_id, 4, '0', STR_PAD_LEFT);

			$upd_sql = "UPDATE pms_info SET pms_info_id = '" .$pms_info_id. "' WHERE pms_id = '" .$pms_id. "' ";
			$result_upd = $mysqli->query($upd_sql); 

			$sql_2 = "SELECT asset_details.facility_id, asset_details.department_id, asset_details.device_group, asset_details.asset_class, asset_details.equipment_name, asset_details.last_date_of_pms, asset_details.asset_supplied_by, facility_master.facility_code FROM asset_details JOIN facility_master ON asset_details.facility_id = facility_master.facility_id";
			$result_2 = $mysqli->query($sql_2);
	
			if($result_2->num_rows > 0) {	
				$row_2 = $result_2->fetch_array();
				$facility_id = $row_2['facility_id'];
				$department_id_str = $row_2['department_id'];
				$department_ids = json_decode($department_id_str);
				$department_id = $department_ids[0];
				$facility_code = $row_2['facility_code'];
				$device_group = $row_2['device_group'];
				$asset_class = $row_2['asset_class'];
				$equipment_name = $row_2['equipment_name'];
				$pms_due_date = $row_2['last_date_of_pms'];
				$supplied_by = $row_2['asset_supplied_by'];
				$pms_planned_date = date('Y-m-d');
			} 
			
			try {
				if($pms_info_id > 0){
					$status = true;
					$pms_data_updated = date('Y-m-d H:i:s');
					$row_status = 2;
					$sql = "UPDATE pms_info SET facility_id = '" .$facility_id. "', facility_code = '" .$facility_code. "', department_id = '" .$department_id. "', device_group = '" .$device_group. "', asset_class = '" .$asset_class. "', equipment_name = '" .$equipment_name. "', pms_due_date = '" .$pms_due_date. "', supplied_by = '" .$supplied_by. "', pms_planned_date = '" .$pms_planned_date. "', pms_data_updated = '" .$pms_data_updated. "', row_status = '" .$row_status. "' WHERE pms_info_id = '" .$pms_info_id. "' ";
					$result = $mysqli->query($sql);
				}	
			} catch (PDOException $e) {
				die("Error occurred:" . $e->getMessage());
			}
			
		}else{
			$return_result['error_message'] = 'Data Insert Error';
			$status = false;
		}

		$return_result['error_message'] = $error_message; 
		$return_result['status'] = $status; 
		$return_result['pms_info_id'] = $pms_info_id; 
		echo json_encode($return_result);
	}//end function deleteItem

?>