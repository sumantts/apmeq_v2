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
				$facility_code = $row['facility_code'];					

				$total_ticket = 0;
				//Total Assets
				$sql1 = "SELECT COUNT(call_log_id) AS total_ticket_count FROM call_log_register WHERE facility_id = '" .$facility_id. "' GROUP BY facility_id";
				$result1 = $mysqli->query($sql1);
				$total_ticket = $result1->num_rows;

				if($total_ticket > 0){
					while($row1 = $result1->fetch_array()){
						$total_ticket_count = $row1['total_ticket_count'];
						$resolved_ticket = 0;
						$closed_ticket = 0;
						$open_ticket = 0;
						$wip_ticket = 0;
						$critical_ticket = 0;
						$non_critical_ticket = 0;
						$below_three_days = 0;
						$below_five_days = 0;
						$below_seven_days = 0;
						$above_seven_days = 0;
						$today = date('Y-m-d H:i:s');
						$three_day_prev = date('Y-m-d H:i:s',(strtotime ( '-3 day' , strtotime($today))));
						$five_day_prev = date('Y-m-d H:i:s',(strtotime ( '-5 day' , strtotime($today))));
						$seven_day_prev = date('Y-m-d H:i:s',(strtotime ( '-7 day' , strtotime($today))));

						$sql_0 = "SELECT * FROM call_log_register WHERE call_log_status = '0' AND facility_id = '" .$facility_id. "'";
						$result_0 = $mysqli->query($sql_0);
						$open_ticket = $result_0->num_rows;

						$sql_1 = "SELECT * FROM call_log_register WHERE call_log_status = '1' AND facility_id = '" .$facility_id. "'";
						$result_1 = $mysqli->query($sql_1);
						$wip_ticket = $result_1->num_rows;

						$sql_2 = "SELECT * FROM call_log_register WHERE call_log_status = '2' AND facility_id = '" .$facility_id. "'";
						$result_2 = $mysqli->query($sql_2);
						$resolved_ticket = $result_2->num_rows;

						$sql_3 = "SELECT * FROM call_log_register WHERE call_log_status = '3' AND facility_id = '" .$facility_id. "'";
						$result_3 = $mysqli->query($sql_3);
						$closed_ticket = $result_3->num_rows;

						$sql_c = "SELECT * FROM call_log_register WHERE ticket_class = '1' AND facility_id = '" .$facility_id. "'";
						$result_c = $mysqli->query($sql_c);
						$critical_ticket = $result_c->num_rows;

						$sql_nc = "SELECT * FROM call_log_register WHERE ticket_class = '2' AND facility_id = '" .$facility_id. "'";
						$result_nc = $mysqli->query($sql_nc);
						$non_critical_ticket = $result_nc->num_rows;

						//Less than 3
						$sql_3d = "SELECT * FROM call_log_register WHERE call_log_date_time > '" .$three_day_prev. "' AND call_log_date_time < '" .$today. "' AND facility_id = '" .$facility_id. "'";
						$result_3d = $mysqli->query($sql_3d);
						$below_three_days = $result_3d->num_rows;

						//within 3 to 5 days
						$sql_5d = "SELECT * FROM call_log_register WHERE call_log_date_time > '" .$five_day_prev. "' AND call_log_date_time < '" .$three_day_prev. "' AND facility_id = '" .$facility_id. "'";
						$result_5d = $mysqli->query($sql_5d);
						$below_five_days = $result_5d->num_rows;

						//within 5 to 7 days
						$sql_7d = "SELECT * FROM call_log_register WHERE call_log_date_time > '" .$seven_day_prev. "' AND call_log_date_time < '" .$five_day_prev. "' AND facility_id = '" .$facility_id. "'";
						$result_7d = $mysqli->query($sql_7d);
						$below_seven_days = $result_7d->num_rows;

						//above 7 days
						$sql_7d_a = "SELECT * FROM call_log_register WHERE call_log_date_time < '" .$five_day_prev. "' AND facility_id = '" .$facility_id. "'";
						$result_7d_a = $mysqli->query($sql_7d_a);
						$above_seven_days = $result_7d_a->num_rows;
						
						$data[0] = $slno; 
						$data[1] = $facility_name.'/'.$facility_code;
						$data[2] = $total_ticket_count;
						$data[3] = $critical_ticket;
						$data[4] = $non_critical_ticket; 
						$data[5] = $closed_ticket;
						$data[6] = $resolved_ticket;
						$data[7] = $open_ticket;
						$data[8] = $wip_ticket;
						$data[9] = $below_three_days;
						$data[10] = $below_five_days;
						$data[11] = $below_seven_days;
						$data[12] = $above_seven_days;
						array_push($mainData, $data);
					}//end inner while
				}//end if
			}//end outer while
		}//end if
		
		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end		

	//function start
	if($fn == 'getTableData_1'){
		$return_array = array();
		$status = true;
		$dept_match = true;
		$mainData = array();    

		$facility_id_s = $_GET['facility_id_s'];
		$department_id_s = $_GET['department_id']; 
		$call_log_status = $_GET['call_log_status'];
		$token_id = $_GET['token_id']; 
		$day_wise = $_GET['day_wise']; 
		$device_group = $_GET['device_group']; 
		$equipment_name = $_GET['equipment_name']; 
		$ticket_class = $_GET['ticket_class'];  
		$from_dt = $_GET['from_dt'];  
		$to_dt = $_GET['to_dt'];  
		$warranty_sr = $_GET['warranty_sr']; 

		$where_condition = "WHERE call_log_register.call_log_id > 0";

		if($facility_id_s > 0){
			$where_condition .= " AND call_log_register.facility_id = '" .$facility_id_s. "' ";
		}
		if($call_log_status > 0){
			$where_condition .= " AND call_log_register.call_log_status = '" .$call_log_status. "' ";
		}
		if($token_id != ''){
			$where_condition .= " AND call_log_register.token_id = '" .$token_id. "' ";
		}
		if($device_group > 0){
			$where_condition .= " AND asset_details.device_group = '" .$device_group. "' ";
		}
		if($equipment_name != ''){
			$where_condition .= " AND asset_details.equipment_name = '" .$equipment_name. "' ";
		}
		if($from_dt != '' && $to_dt != ''){
			$from_dt1 = $from_dt.' 00:01:01';
			$to_dt1 = $to_dt.' 23:58:00';
			$where_condition .= " AND call_log_register.call_log_date_time > '" .$from_dt1. "' AND call_log_register.call_log_date_time < '" .$to_dt1. "' ";			
		}	

		if($warranty_sr != ''){
			$today = date('Y-m-d'); 
			if($warranty_sr == 1){
				$where_condition .= " AND asset_details.warranty_last_date > '" .$today. "' ";
			}else{
				$where_condition .= " AND asset_details.warranty_last_date < '" .$today. "' ";
			}			
		}	
		
		$sql = "SELECT call_log_register.call_log_id, call_log_register.token_id, call_log_register.issue_description, call_log_register.call_log_date_time, call_log_register.resolved_date_time, call_log_register.ticket_raiser_contact, call_log_register.assign_to, call_log_register.call_log_status, call_log_register.eng_contact_no, asset_details.equipment_name, asset_details.department_id, asset_details.asset_supplied_by, asset_details.sp_details, asset_details.warranty_last_date, facility_master.facility_code, facility_master.facility_name FROM call_log_register JOIN asset_details ON call_log_register.asset_code = asset_details.asset_code JOIN facility_master ON call_log_register.facility_id = facility_master.facility_id $where_condition ORDER BY call_log_register.call_log_id DESC LIMIT 0, 50";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$call_log_id = $row['call_log_id'];	
				$token_id = $row['token_id'];	
				$issue_description = $row['issue_description'];			
				$equipment_name = $row['equipment_name'];				
				$facility_code = $row['facility_code'];					
				$facility_name = $row['facility_name'];					
				$department_id = $row['department_id'];					
				$asset_supplied_by = $row['asset_supplied_by'];				
				$sp_details = $row['sp_details'];					
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
				
				//get all depertment name
				if($department_id_s > 0){
					$dept_match = false;
				}
				$dept_names = '';	
				$ids = '';	 
				$ids_str = json_decode($department_id);
				foreach($ids_str as $key => $val){
					$ids .= $val.',';

					if($department_id_s > 0){
						if($department_id_s == $val){
							$dept_match = true;
						}	
					}//end if
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

				if($dept_match == true){
					$data[0] = $slno; 
					$data[1] = $token_id;
					$data[2] = $issue_description;
					$data[3] = '-';
					$data[4] = $equipment_name; 
					$data[5] = $facility_code;
					$data[6] = $facility_name;
					$data[7] = $dept_names;
					$data[8] = $asset_supplied_by;
					$data[9] = $sp_details;
					$data[10] = $call_log_date_time;
					$data[11] = $resolved_date_time;
					$data[12] = $ticket_raiser_contact;
					$data[13] = $assign_to_text;
					$data[14] = $eng_contact_no;
					$data[15] = $call_log_status_text;			
					if($warranty_last_date != '0000-00-00'){										
						$fifteen_day_prev = date('Y-m-d H:i:s',(strtotime ( '-15 day' , strtotime($warranty_last_date))));
						
						// Create two DateTime objects
						$today = date('Y-m-d');
						$date1 = new DateTime($today);
						$date2 = new DateTime($fifteen_day_prev);
						$date3 = new DateTime($warranty_last_date);


						// Compare the dates
						if ($date1 > $date2 && $date1 < $date3) {
							//PMS within 15 days
							$warranty_last_date = '<span class="text-warning blink">'.date('d-F-Y', strtotime($warranty_last_date)).'</span>';
						} elseif ($date1 > $date3) {
							//PMS Date over
							$warranty_last_date = '<span class="text-danger blink">'.date('d-F-Y', strtotime($warranty_last_date)).'</span>';
						} else {
							// cool PMS
							$warranty_last_date = '<span class="text-primary">'.date('d-F-Y', strtotime($warranty_last_date)).'</span>';
						}
						$data[16] = $warranty_last_date;//date('d-F-Y', strtotime($warranty_last_date));
					}else{
						$data[16] = '';
					}
					$data[17] = "<a href='javascript: void(0)' data-center_id='1'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$call_log_id.")'></i></a><a href='javascript: void(0)' data-center_id='1'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$call_log_id.")'></i></a>";						

					array_push($mainData, $data);
					$slno++;
				}//end if
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
		$call_log_id = $_POST['call_log_id'];

		$where_condition = "WHERE call_log_register.call_log_id = '" .$call_log_id. "' ";
		
		$sql = "SELECT call_log_register.call_log_id, call_log_register.token_id, call_log_register.issue_description, call_log_register.call_log_date_time, call_log_register.resolved_date_time, call_log_register.ticket_raiser_contact, call_log_register.assign_to, call_log_register.call_log_status, call_log_register.eng_contact_no, asset_details.equipment_name, asset_details.department_id, asset_details.asset_supplied_by, asset_details.sp_details, facility_master.facility_code, facility_master.facility_name FROM call_log_register JOIN asset_details ON call_log_register.asset_code = asset_details.asset_code JOIN facility_master ON call_log_register.facility_id = facility_master.facility_id $where_condition";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$token_id = $row['token_id'];	
				$issue_description = $row['issue_description'];			
				$equipment_name = $row['equipment_name'];				
				$facility_code = $row['facility_code'];					
				$facility_name = $row['facility_name'];					
				$department_id = $row['department_id'];					
				$asset_supplied_by = $row['asset_supplied_by'];				
				$sp_details = $row['sp_details'];					
				$call_log_date_time = date('d-F-Y h:i A', strtotime($row['call_log_date_time']));	
				$resolved_date_time = '';
				if($row['resolved_date_time'] != '0000-00-00 00:00:00'){			
					$resolved_date_time = date('Y-m-d', strtotime($row['resolved_date_time']));
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
					$dept_names = rtrim($dept_names, ", ");
				} 
				
				$return_array['token_id'] = $token_id;
				$return_array['issue_description'] = $issue_description; 
				$return_array['equipment_name'] = $equipment_name; 
				$return_array['facility_code'] = $facility_code;
				$return_array['facility_name'] = $facility_name;
				$return_array['dept_names'] = $dept_names;
				$return_array['asset_supplied_by'] = $asset_supplied_by;
				$return_array['sp_details'] = $sp_details;
				$return_array['call_log_date_time'] = $call_log_date_time;
				$return_array['resolved_date_time'] = $resolved_date_time;
				$return_array['ticket_raiser_contact'] = $ticket_raiser_contact;
				$return_array['assign_to'] = $assign_to;  
				$return_array['assign_to_text'] = $assign_to_text;  
				$return_array['call_log_status'] = $call_log_status;
				$return_array['call_log_status_text'] = $call_log_status_text;	
				$return_array['eng_contact_no'] = $eng_contact_no;				
			}
		} else {
			$status = false;
		}
		
		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$call_log_id = $_POST["call_log_id"];
		$status = true;	 

		//Delete from table
		$sql1 = "DELETE FROM call_log_register WHERE call_log_id = '".$call_log_id."'";
		$result1 = $mysqli->query($sql1);

		$return_result['status'] = $status; 
		echo json_encode($return_result);
	}//end function deleteItem	

	//Get Course name
	if($fn == 'updateTicketInfo'){
		$return_array = array();
		$status = true;
		   
		$assign_to = $_POST['assign_to'];
		$eng_contact_no = $_POST['eng_contact_no']; 
		$call_log_statusM = $_POST['call_log_statusM'];
		$resolved_date_time = $_POST['resolved_date_time'].' '.date('H:i:s'); 
		$call_log_id = $_POST['call_log_id']; 

		$sql = "UPDATE call_log_register SET assign_to = '" .$assign_to. "', eng_contact_no = '" .$eng_contact_no. "', call_log_status = '" .$call_log_statusM. "', resolved_date_time = '" .$resolved_date_time. "' WHERE call_log_id = '" .$call_log_id. "' ";
		$result = $mysqli->query($sql);

		$return_array['status'] = $status;
		
		echo json_encode($return_array);
	}//function end	

	//Get Ticket Counter
	if($fn == 'initTicketCounter'){
		$return_array = array();
		$status = true;
		$mainData = array(); 
		$total_ticket = 0; 
		$resolved_ticket = 0;
		$open_ticket = 0;


		//Total Assets
		$sql1 = "SELECT * FROM call_log_register";
		$result1 = $mysqli->query($sql1);
		$total_ticket = $result1->num_rows; 

		$sql_2 = "SELECT * FROM call_log_register WHERE call_log_status = '2' ";
		$result_2 = $mysqli->query($sql_2);
		$resolved_ticket = $result_2->num_rows;

		$open_ticket = $total_ticket - $resolved_ticket;

		$return_array['status'] = $status;
		$return_array['total_ticket'] = $total_ticket;
		$return_array['resolved_ticket'] = $resolved_ticket;
		$return_array['open_ticket'] = $open_ticket;
		
		echo json_encode($return_array);
	}//function end	

?>