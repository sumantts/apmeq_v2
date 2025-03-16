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
		$equipment_make_model = $_POST['equipment_make_model'];
		$equipment_sl_no = $_POST['equipment_sl_no'];
		$pms_due_date = $_POST['pms_due_date'];
		$supplied_by = $_POST['supplied_by'];
		$service_provider_details = $_POST['service_provider_details'];
		$pms_planned_date = $_POST['pms_planned_date'];
		
		try {
			if($calib_info_id > 0){
				$status = true;
				$pms_data_updated = date('Y-m-d H:i:s');
				$row_status = 2;
				$sql = "UPDATE calib_info SET facility_id = '" .$facility_id. "', facility_code = '" .$facility_code. "', department_id = '" .$department_id. "', device_group = '" .$device_group. "', asset_class = '" .$asset_class. "', equipment_name = '" .$equipment_name. "', equipment_make_model = '" .$equipment_make_model. "', equipment_sl_no = '" .$equipment_sl_no. "', pms_due_date = '" .$pms_due_date. "', supplied_by = '" .$supplied_by. "', service_provider_details = '" .$service_provider_details. "', pms_planned_date = '" .$pms_planned_date. "', facility_code = '" .$facility_code. "', pms_data_updated = '" .$pms_data_updated. "', row_status = '" .$row_status. "' WHERE calib_info_id = '" .$calib_info_id. "' ";
				$result = $mysqli->query($sql);
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

		$sql = "SELECT * FROM facility_master LIMIT 0, 50";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$facility_id = $row['facility_id'];	
				$facility_name = $row['facility_name'];	

				$sql1 = "SELECT COUNT(row_status) AS count_row_status FROM calib_info WHERE facility_id = '" .$facility_id. "' GROUP BY facility_id";
				$result1 = $mysqli->query($sql1);		
				if ($result1->num_rows > 0) {
					while($row1 = $result1->fetch_array()){
						$pms_planed = 0;
						$pending_pms = 0;
						$pms_done = 0;
						$row_status = $row1['count_row_status'];						 

						$sql_2 = "SELECT * FROM calib_info WHERE row_status = '1' AND facility_id = '" .$facility_id. "'";
						$result_2 = $mysqli->query($sql_2);
						$pending_pms = $result_2->num_rows;						 

						$sql_3 = "SELECT * FROM calib_info WHERE row_status = '2' AND facility_id = '" .$facility_id. "'";
						$result_3 = $mysqli->query($sql_3);
						$pms_done = $result_3->num_rows;

						$data[0] = $slno; 
						$data[1] = $facility_name;
						$data[2] = $pending_pms;
						$data[3] = $pms_done;
						$data[4] = $pending_pms;
						//$data[5] = "<a href='javascript: void(0)' data-center_id='1'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$facility_id.")'></i></a><a href='javascript: void(0)' data-center_id='1'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$facility_id.")'></i></a>";
		
						array_push($mainData, $data);
						$slno++;
					}//end while
				}//end if
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

		$facility_id = $_GET['facility_id'];
		$facility_code = $_GET['facility_code'];
		$device_group = $_GET['device_group'];
		$asset_class = $_GET['asset_class'];
	
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
		if($device_group != ''){
			$where_condition .= " AND calib_info.device_group = '" .$device_group. "' ";
		}
		if($asset_class > 0){
			$where_condition .= " AND calib_info.asset_class = '" .$asset_class. "' ";
		}
		if($department_id > 0){
			$where_condition .= " AND calib_info.department_id = '" .$department_id. "' ";
		}
		if($from_date != '' && $to_date != ''){
			$from_date1 = $from_date.' 00:01:01';
			$to_date1 = $to_date.' 23:58:00';
			$where_condition .= " AND calib_info.pms_data_updated > '" .$from_date1. "' AND calib_info.pms_data_updated < '" .$to_date1. "' ";
		}
		
		$sql = "SELECT calib_info.calib_id, calib_info.calib_info_id, calib_info.asset_id, calib_info.facility_id, calib_info.facility_code, calib_info.department_id, calib_info.device_group, calib_info.asset_class, calib_info.equipment_name, calib_info.equipment_make_model, calib_info.equipment_sl_no, calib_info.pms_due_date, calib_info.supplied_by, calib_info.service_provider_details, calib_info.pms_planned_date, calib_info.calib_status, facility_master.facility_name, department_list.department_name, device_group_list.device_name FROM calib_info JOIN facility_master ON calib_info.facility_id = facility_master.facility_id JOIN department_list ON calib_info.department_id = department_list.department_id JOIN device_group_list ON calib_info.device_group = device_group_list.device_group_id $where_condition ORDER BY calib_info.calib_id DESC LIMIT 0, 50";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$calib_id = $row['calib_id'];
				$calib_info_id = $row['calib_info_id'];
				$asset_id = $row['asset_id'];
				$facility_name = $row['facility_name'];	
				$facility_code = $row['facility_code'];	
				$department_name = $row['department_name'];	 	
				$device_name = $row['device_name'];	 	
				$asset_class = $row['asset_class'];	  	
				$calib_status = $row['calib_status'];
				
				$asset_class_text = '';
				if($asset_class == 1){
					$asset_class_text = 'Critical';
				}else if($asset_class == 2){
					$asset_class_text = 'Non Critical';
				}else{} 	
				$equipment_name = $row['equipment_name'];	
				$equipment_make_model = $row['equipment_make_model'];	
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

				$view_link = "<a href='calibration_dashboard/calib_link.php?calib_info_id=$calib_info_id', target='_blank'>View Link</a>";

				# 0=WIP, 1=Resolved, 2=Closed
				$dynamic_id = 'calib_id_'.$calib_id;
				$updated_text = '';
				$disabled_text = '';
				if($calib_status == 1 || $calib_status == 2){
					$disabled_text = 'disabled';
				}

				$updated_text .= '<select name="'.$dynamic_id.'" id="'.$dynamic_id.'" onChange="updateCalibStatus('.$calib_id.','.$asset_id.')" class="form-control-sm" '.$disabled_text.'>';
				if($calib_status == 0){
					$updated_text .= '<option value="0" selected="selected">Worrk In Progress</option>';
				}else{
					$updated_text .= '<option value="0">Worrk In Progress</option>';
				}
				if($calib_status == 1){
					$updated_text .= '<option value="1" selected="selected">Resolved</option>';
				}else{
					$updated_text .= '<option value="1">Resolved</option>';
				}
				if($calib_status == 2){
					$updated_text .= '<option value="2" selected="selected">Closed</option>';
				}else{
					$updated_text .= '<option value="2">Closed</option>';
				}
				$updated_text .= '</select>';

				$data[0] = $slno; 
				$data[1] = $calib_info_id;
				$data[2] = $facility_name;
				$data[3] = $facility_code;
				$data[4] = $department_name;
				$data[5] = $device_name; 
				$data[6] = $asset_class_text;
				$data[7] = $equipment_name;
				$data[8] = $equipment_make_model;
				$data[9] = $equipment_sl_no;
				$data[10] = $pms_due_date;
				$data[11] = $supplied_by;
				$data[12] = $service_provider_details;
				$data[13] = $pms_planned_date;
				$data[14] = '-';
				$data[15] = $view_link;
				$data[16] = $updated_text; 
				
				//$data[8] = "<a href='javascript: void(0)' data-center_id='1'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$author_id.")'></i></a><a href='javascript: void(0)' data-center_id='1'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$author_id.")'></i></a>";
				

				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		}
			

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

		$sql = "SELECT * FROM calib_info WHERE calib_info_id = '" .$calib_info_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();

			$facility_id = $row['facility_id'];
			$facility_code = $row['facility_code'];
			$department_id = $row['department_id'];
			$device_group = $row['device_group'];
			$asset_class = $row['asset_class'];
			$equipment_name = $row['equipment_name'];
			$equipment_make_model = $row['equipment_make_model'];
			$equipment_sl_no = $row['equipment_sl_no'];
			$pms_due_date = $row['pms_due_date'];
			$supplied_by = $row['supplied_by'];
			$service_provider_details = $row['service_provider_details'];
			$pms_planned_date = $row['pms_planned_date'];
		} else {
			$status = false;
		}
		//$mysqli->close();

		$return_array['facility_id'] = $facility_id;
		$return_array['facility_code'] = $facility_code;
		$return_array['department_id'] = $department_id;
		$return_array['device_group'] = $device_group;
		$return_array['asset_class'] = $asset_class;
		$return_array['equipment_name'] = $equipment_name;
		$return_array['equipment_make_model'] = $equipment_make_model;		
		$return_array['equipment_sl_no'] = $equipment_sl_no;
		$return_array['pms_due_date'] = $pms_due_date;
		$return_array['supplied_by'] = $supplied_by;
		$return_array['service_provider_details'] = $service_provider_details;
		$return_array['pms_planned_date'] = $pms_planned_date; 

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
	
	//calib_id, calib_info_id, facility_id, facility_code, department_id, device_group, asset_class, equipment_name, equipment_make_model, equipment_sl_no, pms_due_date, supplied_by, service_provider_details, pms_planned_date, pms_report_attached, link_generated_by, link_generate_time

	

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


		//Total Assets
		$sql1 = "SELECT * FROM calib_info";
		$result1 = $mysqli->query($sql1);
		$total_ticket = $result1->num_rows; 

		$sql_2 = "SELECT * FROM calib_info WHERE row_status = '1' ";
		$result_2 = $mysqli->query($sql_2);
		$pending_pms = $result_2->num_rows;

		$pms_done = $total_ticket - $pending_pms;

		$return_array['status'] = $status;
		$return_array['total_ticket'] = $total_ticket;
		$return_array['pending_pms'] = $pending_pms;
		$return_array['pms_done'] = $pms_done;
		
		echo json_encode($return_array);
	}//function end	

	//Update function
	if($fn == 'updateCalibStatus'){
		$return_result = array();
		$calib_id = $_POST["calib_id"];
		$calib_status = $_POST["calib_status"]; 
		$asset_id = $_POST["asset_id"]; 

		$status = true;	
		$last_date_of_calibration = date('Y-m-d');

		$sql = "UPDATE calib_info SET calib_status = '" .$calib_status. "' WHERE calib_id = '".$calib_id."'";
		$mysqli->query($sql);  	

		$sql_1 = "UPDATE asset_details SET last_date_of_calibration = '" .$last_date_of_calibration. "' WHERE asset_id = '".$asset_id."'";
		$mysqli->query($sql_1);  

		$return_result['status'] = $status; 
		echo json_encode($return_result);
	}//end function deleteItem

?>