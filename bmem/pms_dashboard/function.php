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

		$pms_info_id = $_POST['pms_info_id'];
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
			if($pms_info_id > 0){
				$status = true;
				$pms_data_updated = date('Y-m-d H:i:s');
				$row_status = 2;
				$sql = "UPDATE pms_info SET facility_id = '" .$facility_id. "', facility_code = '" .$facility_code. "', department_id = '" .$department_id. "', device_group = '" .$device_group. "', asset_class = '" .$asset_class. "', equipment_name = '" .$equipment_name. "', equipment_make_model = '" .$equipment_make_model. "', equipment_sl_no = '" .$equipment_sl_no. "', pms_due_date = '" .$pms_due_date. "', supplied_by = '" .$supplied_by. "', service_provider_details = '" .$service_provider_details. "', pms_planned_date = '" .$pms_planned_date. "', facility_code = '" .$facility_code. "', pms_data_updated = '" .$pms_data_updated. "', row_status = '" .$row_status. "' WHERE pms_info_id = '" .$pms_info_id. "' ";
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
			array_push($mainData, $data);

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

	//function start
	if($fn == 'loadFormdata'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$pms_info_id = $_POST['pms_info_id'];

		$sql = "SELECT * FROM pms_info WHERE pms_info_id = '" .$pms_info_id. "'";
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
		$pms_id = 0;
		$link_generated_by = $_SESSION["user_id"];
		$link_generate_time = date('Y-m-d H:i:s');
		
		$sql = "INSERT INTO pms_info (link_generated_by, link_generate_time) VALUES ('" .$link_generated_by. "', '" .$link_generate_time. "')";
		$result = $mysqli->query($sql);
		$pms_id = $mysqli->insert_id;

		if($pms_id > 0){
			$status = true;  
			$pms_info_id = str_pad($pms_id, 4, '0', STR_PAD_LEFT);

			$upd_sql = "UPDATE pms_info SET pms_info_id = '" .$pms_info_id. "' WHERE pms_id = '" .$pms_id. "' ";
			$result_upd = $mysqli->query($upd_sql); 

		}else{
			$return_result['error_message'] = 'Data Insert Error';
			$status = false;
		}

		$return_result['error_message'] = $error_message; 
		$return_result['status'] = $status; 
		$return_result['pms_info_id'] = $pms_info_id; 
		echo json_encode($return_result);
	}//end function deleteItem
	
	//pms_id, pms_info_id, facility_id, facility_code, department_id, device_group, asset_class, equipment_name, equipment_make_model, equipment_sl_no, pms_due_date, supplied_by, service_provider_details, pms_planned_date, pms_report_attached, link_generated_by, link_generate_time

	

	//Get Product Images
	if($fn == 'getAllProductImages'){
		$return_array = array();
		$status = true;
		$all_images = array();
		$pms_info_id = $_POST["pms_info_id"];

		$sql = "SELECT pms_report_attached FROM pms_info WHERE pms_info_id = '".$pms_info_id."'";
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
		$pms_info_id = $_POST["pms_info_id"];
		$prod_iamge_name = $_POST["prod_iamge_name"];

		//Unlink product image
		$sql = "SELECT pms_report_attached FROM pms_info WHERE pms_info_id = '".$pms_info_id."'";
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

		$sql = "UPDATE pms_info SET pms_report_attached = '" .$all_images_en. "' WHERE pms_info_id = '".$pms_info_id."'";
		$mysqli->query($sql);

		$return_result['status'] = $status;
		//sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

?>