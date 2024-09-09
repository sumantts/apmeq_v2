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

		$facility_id = $_POST['facility_id']; 
		$facility_name = $_POST['facility_name'];
		$facility_type = $_POST['facility_type']; 
		$facility_code = $_POST['facility_code'];
		$facility_address = $_POST['facility_address'];
		$nabh_accrediated = $_POST['nabh_accrediated'];
		$nabl_accrediated = $_POST['nabl_accrediated'];
		$department_id = $_POST['department_id'];
		$hospital_id = $_POST['hospital_id'];   
		$user_id = $_SESSION["user_id"];
		
		try {
			if($facility_id > 0){
				$status = true;
				$sql = "UPDATE facility_master SET hospital_id = '" .$hospital_id. "', department_id = '" .$department_id. "', facility_name = '" .$facility_name. "', facility_type = '" .$facility_type. "', facility_code = '" .$facility_code. "', facility_address = '" .$facility_address. "', nabh_accrediated = '" .$nabh_accrediated. "', nabl_accrediated = '" .$nabl_accrediated. "' WHERE facility_id = '" .$facility_id. "' ";
				$result = $mysqli->query($sql); 
			}else{
				$sql = "INSERT INTO facility_master (hospital_id, department_id, facility_name, facility_type, facility_code, facility_address, nabh_accrediated, nabl_accrediated, user_id) VALUES ('" .$hospital_id. "', '" .$department_id. "', '" .$facility_name. "', '" .$facility_type. "', '" .$facility_code. "', '" .$facility_address. "', '" .$nabh_accrediated. "', '" .$nabl_accrediated. "', '" .$user_id. "')";
				$result = $mysqli->query($sql);
				$facility_id = $mysqli->insert_id;
				if($facility_id > 0){
					$status = true; 
				}else{
					$return_result['error_message'] = 'Data Insert Error';
					$status = false;
				}
					
			}	
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		$return_result['facility_id'] = $facility_id;
		
		echo json_encode($return_result);
	}//Save function end 

	//function start
	if($fn == 'getFormEditData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$author_id = $_POST['author_id'];

		$sql = "SELECT * FROM facility_master WHERE author_id = '" .$author_id. "'";
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

	
/*****************
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
************/

	//Get Dept name
	if($fn == 'getAllDepartmentName'){
		$return_array = array();
		$status = true;
		$mainData = array();

		$sql = "SELECT * FROM department_list WHERE department_status = 1 ORDER BY department_name ASC";
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
	

	//Get Course name
	if($fn == 'getAllHospitaName'){
		$return_array = array();
		$status = true;
		$mainData = array(); 

		$sql = "SELECT * FROM hospital_list WHERE hospital_status = 1 ORDER BY hospital_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$hospital_id = $row['hospital_id'];	
				$hospital_name = $row['hospital_name'];			
				$hospital_code = $row['hospital_code'];		
				$hospital_address = $row['hospital_address'];
				$data = new stdClass();

				$data->hospital_id = $hospital_id;
				$data->hospital_name = $hospital_name;
				$data->hospital_code = $hospital_code;
				$data->hospital_address = $hospital_address;
				
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
	

	//Get Facility name
	if($fn == 'getAllFacilityName'){
		$return_array = array();
		$status = true;
		$mainData = array(); 

		$sql = "SELECT * FROM facility_master ORDER BY facility_id DESC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$facility_id = $row['facility_id'];	
				$facility_name = $row['facility_name']; 
				$data = new stdClass();

				$data->facility_id = $facility_id;
				$data->facility_name = $facility_name; 
				
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