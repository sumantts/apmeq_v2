<?php
	include('../assets/php/sql_conn.php');
	$fn = '';
    
	if(isset($_GET["fn"])){
	    $fn = $_GET["fn"];
	}else if(isset($_POST["fn"])){
	    $fn = $_POST["fn"];
	}

	//Save function start
	if($fn == 'saveFormData'){
		$return_result = array();
		$status = true; 
		$insert_id = 0;

		$asset_id = $_POST['asset_id']; 
		$facility_id = $_POST['facility_id']; 
		$department_id = $_POST['department_id']; 
		$equipment_name = $_POST['equipment_name']; 
		$asset_make = $_POST['asset_make']; 
		$asset_model = $_POST['asset_model']; 
		$slerial_number = $_POST['slerial_number']; 
		$asset_specifiaction = $_POST['asset_specifiaction']; 
		$date_of_installation = $_POST['date_of_installation']; 
		$asset_supplied_by = $_POST['asset_supplied_by']; 
		$value_of_the_asset = $_POST['value_of_the_asset']; 
		$total_year_in_service = $_POST['total_year_in_service']; 
		$technology = $_POST['technology']; 
		$asset_status = $_POST['asset_status']; 
		$asset_class = $_POST['asset_class']; 
		$device_group = $_POST['device_group']; 
		$last_date_of_calibration = $_POST['last_date_of_calibration'];  
		$frequency_of_calibration = $_POST['frequency_of_calibration']; 
		$last_date_of_pms = $_POST['last_date_of_pms'];  
		$frequency_of_pms = $_POST['frequency_of_pms']; 
		$qa_due_date = $_POST['qa_due_date'];
		$warranty_last_date = $_POST['warranty_last_date']; 
		$amc_yes_no = $_POST['amc_yes_no']; 
		$amc_last_date = $_POST['amc_last_date']; 
		$cmc_yes_no = $_POST['cmc_yes_no']; 
		$cmc_last_date = $_POST['cmc_last_date'];  
		$asset_code = $_POST['asset_code'];
		$sp_details = $_POST['sp_details'];
		
		try {
			if($asset_id > 0){
				$status = true;
				$sql = "UPDATE asset_details SET facility_id = '" .$facility_id. "', department_id = '" .$department_id. "', equipment_name = '" .$equipment_name. "', asset_make = '" .$asset_make. "', asset_model = '" .$asset_model. "', slerial_number = '" .$slerial_number. "', asset_specifiaction = '" .$asset_specifiaction. "', date_of_installation = '" .$date_of_installation. "', asset_supplied_by = '" .$asset_supplied_by. "', value_of_the_asset = '" .$value_of_the_asset. "', technology = '" .$technology. "', asset_status = '" .$asset_status. "', asset_class = '" .$asset_class. "', device_group = '" .$device_group. "', last_date_of_calibration = '" .$last_date_of_calibration. "', frequency_of_calibration = '" .$frequency_of_calibration. "', last_date_of_pms = '" .$last_date_of_pms. "', frequency_of_pms = '" .$frequency_of_pms. "', qa_due_date = '" .$qa_due_date. "', warranty_last_date = '" .$warranty_last_date. "', amc_yes_no = '" .$amc_yes_no. "', amc_last_date = '" .$amc_last_date. "', cmc_yes_no = '" .$cmc_yes_no. "', cmc_last_date = '" .$cmc_last_date. "', sp_details = '" .$sp_details."' WHERE asset_id = '" .$asset_id. "' ";
				$result = $mysqli->query($sql); 
				$asset_id_temp = $asset_id;
			}else{ 
				$sql = "INSERT INTO asset_details (facility_id, department_id, equipment_name, asset_make, asset_model, slerial_number, asset_specifiaction, date_of_installation, asset_supplied_by, value_of_the_asset, technology, asset_status, asset_class, device_group, last_date_of_calibration, frequency_of_calibration, last_date_of_pms, frequency_of_pms, qa_due_date, warranty_last_date, amc_yes_no, amc_last_date, cmc_yes_no, cmc_last_date, sp_details) VALUES ('" .$facility_id. "', '" .$department_id. "', '" .$equipment_name. "', '" .$asset_make. "', '" .$asset_model. "', '" .$slerial_number. "', '" .$asset_specifiaction. "', '" .$date_of_installation. "', '" .$asset_supplied_by. "', '" .$value_of_the_asset. "', '" .$technology. "', '" .$asset_status. "', '" .$asset_class. "', '" .$device_group. "', '" .$last_date_of_calibration. "', '" .$frequency_of_calibration. "', '" .$last_date_of_pms. "', '" .$frequency_of_pms. "', '" .$qa_due_date. "', '" .$warranty_last_date. "', '" .$amc_yes_no. "', '" .$amc_last_date. "', '" .$cmc_yes_no. "', '" .$cmc_last_date. "', '" .$sp_details."')";
				$result = $mysqli->query($sql);
				$asset_id_temp = $mysqli->insert_id;
				if($asset_id_temp > 0){
					$status = true;  
					//Get facility Code
					$sql_get = "SELECT facility_code FROM facility_master WHERE facility_id = '" .$facility_id. "'";
					$result_get = $mysqli->query($sql_get);
			
					if ($result_get->num_rows > 0) {
						$status = true;	
						$row_get = $result_get->fetch_array();
						$facility_code = $row_get['facility_code'];	
					}
					$asset_code = $facility_code.''.str_pad($asset_id_temp, 5, '0', STR_PAD_LEFT);

					$upd_sql = "UPDATE asset_details SET asset_code = '" .$asset_code. "' WHERE asset_id = '" .$asset_id_temp. "' ";
					$result_upd = $mysqli->query($upd_sql); 
				}else{
					$return_result['error_message'] = 'Photo size is soo large';
					$status = false;
				}	 
			}	

			// total_year_in_service
			$total_year_in_service = '';
			$today = date('Y-m-d');
			$datetime1 = date_create($date_of_installation);
			$datetime2 = date_create($today);

			// Calculates the difference between DateTime objects
			$interval = date_diff($datetime1, $datetime2);

			// Printing result in years & months format
			$total_year_in_service = $interval->format('%R%y years %m months');
			$upd_sql1 = "UPDATE asset_details SET total_year_in_service = '" .$total_year_in_service. "' WHERE asset_id = '" .$asset_id_temp. "' ";
			$result_upd1 = $mysqli->query($upd_sql1); 

		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		$return_result['asset_code'] = $asset_code;
		$return_result['total_year_in_service'] = $total_year_in_service;
		$return_result['asset_id_temp'] = $asset_id_temp;
		//sleep(2);
		echo json_encode($return_result);
	}//Save function end	

	//function start
	if($fn == 'getTableData'){
		$return_array = array();
		$status = true;
		$mainData = array(); 

		$facility_id = $_GET['facility_id'];
		$facility_code = $_GET['facility_code'];
		$asset_code = $_GET['asset_code_sr'];
		$condition = "WHERE row_status = 1";

		if($facility_id > 0){
			$condition .= " AND asset_details.facility_id = '" .$facility_id. "' ";			
		}

		/*if($facility_code != ''){
			$condition .= " AND facility_code = '" .$facility_code. "' ";			
		}*/

		if($asset_code != ''){
			$condition .= " AND asset_details.asset_code = '" .$asset_code. "' ";			
		}


		$sql = "SELECT asset_details.asset_id, asset_details.facility_id, asset_details.department_id, asset_details.equipment_name, asset_details.asset_make, asset_details.asset_model, asset_details.slerial_number, asset_details.asset_specifiaction, asset_details.date_of_installation, asset_details.ins_certificate, asset_details.asset_supplied_by, asset_details.value_of_the_asset, asset_details.total_year_in_service, asset_details.technology, asset_details.asset_status, asset_details.asset_class, asset_details.device_group, asset_details.last_date_of_calibration, asset_details.calibration_attachment, asset_details.frequency_of_calibration, asset_details.last_date_of_pms, asset_details.pms_attachment, asset_details.frequency_of_pms, asset_details.qa_due_date, asset_details.qa_attachment, asset_details.warranty_last_date, asset_details.amc_yes_no, asset_details.amc_last_date, asset_details.cmc_yes_no, asset_details.cmc_last_date, asset_details.asset_code, asset_details.sp_details, asset_details.row_status, facility_master.facility_name FROM asset_details JOIN facility_master ON asset_details.facility_id = facility_master.facility_id $condition";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$asset_id = $row['asset_id'];		
				$facility_id = $row['facility_id'];				
				$facility_name = $row['facility_name'];
				$department_id = $row['department_id']; 	
				$department_name = '';//$row['department_name']; 
				$department_code = '';//$row['department_code']; 		
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

				//get all depertment name	
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

				$data[0] = $slno; 
				$data[1] = $facility_name;
				$data[2] = $dept_names;
				$data[3] = $equipment_name;
				$data[4] = $asset_make; 
				$data[5] = $asset_model;
				$data[6] = $slerial_number;
				$data[7] = $asset_specifiaction;
				if($date_of_installation != '0000-00-00'){
					$data[8] = date('d-F-Y', strtotime($date_of_installation));
				}else{
					$data[8] = '';
				}
				$data[9] = $asset_supplied_by;
				$data[10] = $value_of_the_asset;
				$data[11] = $total_year_in_service;
				$data[12] = "<a href='javascript: void(0)' data-center_id='1'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$asset_id.")'></i></a><a href='javascript: void(0)' data-center_id='1'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$asset_id.")'></i></a>";

				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		}
		//$mysqli->close();

		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end	

	//function start
	if($fn == 'getFormEditData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$asset_id = $_POST['asset_id'];

		$sql = "SELECT * FROM asset_details WHERE asset_id = '" .$asset_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();

			$asset_id = $row['asset_id']; 
			$facility_id = $row['facility_id']; 
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
			$frequency_of_calibration_y = $frequency_of_calibration_sp[0];
			$frequency_of_calibration_m = $frequency_of_calibration_sp[1];
			$frequency_of_calibration_d = $frequency_of_calibration_sp[2];
			$last_date_of_pms = $row['last_date_of_pms'];  
			$frequency_of_pms = $row['frequency_of_pms']; 
			$frequency_of_pms_st = explode('|', $frequency_of_pms);
			$frequency_of_pms_y = $frequency_of_pms_st[0];
			$frequency_of_pms_m = $frequency_of_pms_st[1];
			$frequency_of_pms_d = $frequency_of_pms_st[2];
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
		$return_array['last_date_of_calibration'] = $last_date_of_calibration;  
		$return_array['frequency_of_calibration'] = $frequency_of_calibration; 
		$return_array['frequency_of_calibration_y'] = $frequency_of_calibration_y; 
		$return_array['frequency_of_calibration_m'] = $frequency_of_calibration_m; 
		$return_array['frequency_of_calibration_d'] = $frequency_of_calibration_d; 
		$return_array['last_date_of_pms'] = $last_date_of_pms;  
		$return_array['frequency_of_pms'] = $frequency_of_pms; 
		$return_array['frequency_of_pms_y'] = $frequency_of_pms_y; 
		$return_array['frequency_of_pms_m'] = $frequency_of_pms_m; 
		$return_array['frequency_of_pms_d'] = $frequency_of_pms_d; 
		$return_array['qa_due_date'] = $qa_due_date;
		$return_array['warranty_last_date'] = $warranty_last_date; 
		$return_array['amc_yes_no'] = $amc_yes_no; 
		$return_array['amc_last_date'] = $amc_last_date; 
		$return_array['cmc_yes_no'] = $cmc_yes_no; 
		$return_array['cmc_last_date'] = $cmc_last_date;  
		$return_array['asset_code'] = $asset_code;
		$return_array['sp_details'] = $sp_details;
		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$asset_id = $_POST["asset_id"];
		$status = true;	

		//Unlink product image
		$sql = "SELECT * FROM asset_details WHERE asset_id = '".$asset_id."'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$slno = 1;
			$row = $result->fetch_array();
			$all_images_en = '';
				$all_images_en = $row['ins_certificate']; 
				if($all_images_en != ''){
					$status = true;
					$all_images = json_decode($all_images_en);
					if(sizeof($all_images) > 0){
						for($i = 0; $i < sizeof($all_images); $i++){ 
							$file_path = ''.$all_images[$i];
							unlink('photos/'.$file_path); 
						}//end for 
					}//end if
				}//end if

				$all_images_en = '';
				$all_images_en = $row['calibration_attachment']; 
				if($all_images_en != ''){
					$status = true;
					$all_images = json_decode($all_images_en);
					if(sizeof($all_images) > 0){
						for($i = 0; $i < sizeof($all_images); $i++){ 
							$file_path = ''.$all_images[$i];
							unlink('photos/'.$file_path); 
						}//end for 
					}//end if
				}//end if

				$all_images_en = '';
				$all_images_en = $row['pms_attachment']; 
				if($all_images_en != ''){
					$status = true;
					$all_images = json_decode($all_images_en);
					if(sizeof($all_images) > 0){
						for($i = 0; $i < sizeof($all_images); $i++){ 
							$file_path = ''.$all_images[$i];
							unlink('photos/'.$file_path); 
						}//end for 
					}//end if
				}//end if

				$all_images_en = '';
				$all_images_en = $row['qa_attachment']; 
				if($all_images_en != ''){
					$status = true;
					$all_images = json_decode($all_images_en);
					if(sizeof($all_images) > 0){
						for($i = 0; $i < sizeof($all_images); $i++){ 
							$file_path = ''.$all_images[$i];
							unlink('photos/'.$file_path); 
						}//end for 
					}//end if
				}//end if 
		} //end if

		$sql = "DELETE FROM asset_details WHERE asset_id = '".$asset_id."'";
		$result = $mysqli->query($sql);

		$return_result['status'] = $status;
		//sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

	

	//Get Category name
	if($fn == 'getAllCategoryName'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$parent_category_id = 0;

		$sql = "SELECT * FROM category_list WHERE activity_status = 'active' ORDER BY category_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$category_id = $row['category_id'];	
				$category_name = $row['category_name'];			
				$category_slug = $row['category_slug'];
				$data = new stdClass();

				$data->category_id = $category_id;
				$data->category_name = $category_name;
				$data->category_slug = $category_slug;
				
				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		} 

		$return_array['status'] = $status;
		$return_array['data'] = $mainData;
		echo json_encode($return_array);
	}//end if

	//Get Device Group Name
	if($fn == 'getAllDeviceGroupName'){
		$return_array = array();
		$status = true;
		$mainData = array(); 

		$sql = "SELECT * FROM device_group_list WHERE device_status = 1 ORDER BY device_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$device_group_id = $row['device_group_id'];	
				$device_name = $row['device_name'];	 
				$data = new stdClass();

				$data->device_group_id = $device_group_id;
				$data->device_name = $device_name; 
				
				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		} 

		$return_array['status'] = $status;
		$return_array['data'] = $mainData;
		echo json_encode($return_array);
	}//function end	 

	//Get Product Images
	if($fn == 'getAllProductImages'){
		$return_array = array();
		$status = true;
		$all_images = array();
		$asset_id = $_POST["asset_id"];
		$field_name = $_POST["field_name"];

		$sql = "SELECT $field_name FROM asset_details WHERE asset_id = '".$asset_id."'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$slno = 1;
			while($row = $result->fetch_array()){
				$all_images_en = $row[$field_name]; 
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
		$asset_id = $_POST["asset_id"];
		$field_name = $_POST["field_name"];
		$prod_iamge_name = $_POST["prod_iamge_name"];

		//Unlink product image
		$sql = "SELECT $field_name FROM asset_details WHERE asset_id = '".$asset_id."'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$slno = 1;
			while($row = $result->fetch_array()){
				$all_images_en = $row[$field_name]; 
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

		$sql = "UPDATE asset_details SET $field_name = '" .$all_images_en. "' WHERE asset_id = '".$asset_id."'";
		$mysqli->query($sql);

		$return_result['status'] = $status;
		//sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem 
	
	//Get Dept name
	if($fn == 'getAllDepartmentName'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$ids = '';
		$facility_id_dd = $_POST['facility_id_dd'];

		$sql1 = "SELECT department_id FROM facility_master WHERE facility_id = '" .$facility_id_dd. "' ";
		$result1 = $mysqli->query($sql1);
		$row1 = $result1->fetch_array();
		$department_ids = json_decode($row1['department_id']);
		foreach($department_ids AS $key => $val){
			$ids .= $val.',';
		}
		$ids = substr($ids, 0, -1);

		$sql = "SELECT * FROM department_list WHERE department_id IN ($ids) ORDER BY department_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$department_id = $row['department_id'];	
				$department_name = $row['department_name'];	
				$department_code = $row['department_code'];	
				$data = new stdClass();

				$data->department_id = $department_id;
				$data->department_name = $department_name;
				$data->department_code = $department_code;
				
				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		}
		//$mysqli->close();

		$return_array['status'] = $status;
		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end	

?>