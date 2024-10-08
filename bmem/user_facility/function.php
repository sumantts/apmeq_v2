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
		$contact_person = $_POST['contact_person'];   
		$user_id = $_SESSION["user_id"];
		
		try {
			if($facility_id > 0){
				$status = true;
				$sql = "UPDATE facility_master SET contact_person = '" .$contact_person. "', department_id = '" .$department_id. "', facility_name = '" .$facility_name. "', facility_type = '" .$facility_type. "', facility_address = '" .$facility_address. "', nabh_accrediated = '" .$nabh_accrediated. "', nabl_accrediated = '" .$nabl_accrediated. "' WHERE facility_id = '" .$facility_id. "' ";
				$result = $mysqli->query($sql); 
			}else{
				$sql = "INSERT INTO facility_master (contact_person, department_id, facility_name, facility_type, facility_address, nabh_accrediated, nabl_accrediated, user_id) VALUES ('" .$contact_person. "', '" .$department_id. "', '" .$facility_name. "', '" .$facility_type. "', '" .$facility_address. "', '" .$nabh_accrediated. "', '" .$nabl_accrediated. "', '" .$user_id. "')";
				$result = $mysqli->query($sql);
				$facility_id = $mysqli->insert_id;
				if($facility_id > 0){
					$status = true;  
					$facility_code = str_pad($facility_id, 4, '0', STR_PAD_LEFT);

					$upd_sql = "UPDATE facility_master SET facility_code = '" .$facility_code. "' WHERE facility_id = '" .$facility_id. "' ";
					$result_upd = $mysqli->query($upd_sql); 

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
		$facility_id = $_POST['facility_id_dd'];

		$sql = "SELECT * FROM facility_master WHERE facility_id = '" .$facility_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			$contact_person = $row['contact_person'];		
			$department_id = json_decode($row['department_id']);		
			$facility_name = $row['facility_name'];			
			$facility_type = $row['facility_type'];		
			$facility_code = $row['facility_code'];				
			$facility_address = $row['facility_address'];			
			$nabh_accrediated = $row['nabh_accrediated'];		
			$nabl_accrediated = $row['nabl_accrediated']; 
			
		} else {
			$status = false;
		}
		//$mysqli->close();

		$return_array['contact_person'] = $contact_person;
		$return_array['department_id'] = $department_id;
		$return_array['facility_name'] = $facility_name;
		$return_array['facility_type'] = $facility_type;
		$return_array['facility_code'] = $facility_code;
		$return_array['facility_address'] = $facility_address;
		$return_array['nabh_accrediated'] = $nabh_accrediated;
		$return_array['nabl_accrediated'] = $nabl_accrediated;
		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end 
	
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
				$contact_person = $row['contact_person'];	
				$hospital_name = $row['hospital_name'];			
				$hospital_code = $row['hospital_code'];		
				$hospital_address = $row['hospital_address'];
				$data = new stdClass();

				$data->contact_person = $contact_person;
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