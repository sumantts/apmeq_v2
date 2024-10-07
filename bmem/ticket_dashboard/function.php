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
		$mainData = array();
		$email1 = '';
		
		/*$sql = "SELECT author_details.author_id, author_details.for_the_year, author_details.category_id, author_details.author_name, author_details.email, author_details.registration_number, author_details.author_photo, author_details.author_status, category_list.category_name, login.user_level FROM author_details JOIN category_list ON author_details.category_id = category_list.category_id JOIN login ON author_details.author_id = login.author_id WHERE category_list.activity_status = 'active'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$author_id = $row['author_id'];		
				$category_name = $row['category_name'];		
				$for_the_year = $row['for_the_year'];
				$course_id = 0;//$row['course_id'];		
				$course_name = '';//$row['course_name'];			
				$author_name = $row['author_name'];		
				$email = $row['email'];			
				$registration_number = $row['registration_number'];	
				$user_level = $row['user_level']; 

				$data[0] = $slno; 
				$data[1] = $author_name;
				$data[2] = $email;
				$data[3] = $registration_number;
				$data[4] = "<img src='".$author_photo."' id='saved_image' width='75' style='border-radius: 15px'>"; 
				$data[5] = $category_name;
				$data[6] = $forTheYearsArr[$for_the_year]->text;
				$data[7] = $author_status;
				if($user_level == 1){
					$data[8] = "Restricted";
				}else{
					$data[8] = "<a href='javascript: void(0)' data-center_id='1'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$author_id.")'></i></a><a href='javascript: void(0)' data-center_id='1'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$author_id.")'></i></a>";
				}

				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		}*/
		//$mysqli->close();
			$slno = 1; 

			$data[0] = $slno; 
			$data[1] = 'Facility 1';
			$data[2] = '-';
			$data[3] = '-';
			$data[4] = '-'; 
			$data[5] = '-';
			$data[6] = '-';
			$data[7] = '-';
			$data[8] = '-';
			$data[9] = '-';
			$data[10] = '-';
			$data[11] = '-';
			$data[12] = '-';
			$data[13] = '-';
			$data[14] = '-';
			$data[15] = '-';
			$data[16] = '-';
			$data[17] = '-';
			array_push($mainData, $data);

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

	//Get Course name
	if($fn == 'getAllCourseName'){
		$return_array = array();
		$status = true;
		$mainData = array(); 

		$sql = "SELECT * FROM course_fee_detail ORDER BY course_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$course_id = $row['course_id'];	
				$course_name = $row['course_name'];			
				$course_fee = $row['course_fee'];		
				$course_duration = $row['course_duration'];
				$data = new stdClass();

				$data->course_id = $course_id;
				$data->course_name = $course_name;
				$data->course_fee = $course_fee;
				$data->course_duration = $course_duration;
				
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

?>