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
		
		$sql = "SELECT asset_details.asset_id, asset_details.facility_id, asset_details.department_id, asset_details.equipment_name, asset_details.asset_make, asset_details.asset_model, asset_details.slerial_number, asset_details.asset_specifiaction, asset_details.date_of_installation, asset_details.ins_certificate, asset_details.asset_supplied_by, asset_details.value_of_the_asset, asset_details.total_year_in_service, asset_details.technology, asset_details.asset_status, asset_details.asset_class, asset_details.device_group, asset_details.last_date_of_calibration, asset_details.calibration_attachment, asset_details.frequency_of_calibration, asset_details.last_date_of_pms, asset_details.pms_attachment, asset_details.frequency_of_pms, asset_details.qa_due_date, asset_details.qa_attachment, asset_details.warranty_last_date, asset_details.amc_yes_no, asset_details.amc_last_date, asset_details.cmc_yes_no, asset_details.cmc_last_date, asset_details.asset_code, asset_details.sp_details, asset_details.asset_code, asset_details.row_status, facility_master.facility_name, facility_master.facility_code, department_list.department_name, department_list.department_code FROM asset_details JOIN facility_master ON asset_details.facility_id = facility_master.facility_id JOIN department_list ON asset_details.department_id = department_list.department_id WHERE row_status = 1 AND asset_details.facility_id = '" .$facility_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$asset_id = $row['asset_id'];		
				$facility_id = $row['facility_id'];				
				$facility_name = $row['facility_name'];				
				$facility_code = $row['facility_code'];
				$department_id = $row['department_id']; 	
				$department_name = $row['department_name']; 
				$department_code = $row['department_code']; 		
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

				$data[0] = $slno; 
				$data[1] = $facility_name;
				$data[2] = $facility_code;
				$data[3] = $asset_status_text;
				$data[4] = $equipment_name; 
				$data[5] = $asset_code;
				$data[6] = $maintanence_type;
				$data[7] = $technology_text;
				$data[8] = $asset_status_text1;
				$data[9] = $asset_status_text2;
				$data[10] = $asset_class_text;  

				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		}

			

		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end	 

?>