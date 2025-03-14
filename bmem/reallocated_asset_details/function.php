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
		$insert_id = 0; 
		$status = true;
		$error_message = '';

		$facility_id = $_POST['facility_id'];
		$facility_code = $_POST['facility_code']; 
		$from_dept_id = $_POST['from_dept_id'];
		$asset_id = $_POST['asset_id']; 
		$asset_code = $_POST['asset_code']; 
		$to_dept_id = $_POST['to_dept_id']; 
		$relocate_date_time = $_POST['relocate_date_time'].' '.date('H:i:s'); 
		$relocated_by = $_SESSION["user_id"];

		try {			
			$sql = "INSERT INTO reloc_asset_detail (facility_id, from_dept_id, to_dept_id, asset_id, relocate_date_time, relocated_by) VALUES ('" .$facility_id. "', '" .$from_dept_id. "', '" .$to_dept_id. "', '" .$asset_id. "', '" .$relocate_date_time. "', '" .$relocated_by. "')";
			$result = $mysqli->query($sql);
			$insert_id = $mysqli->insert_id;	
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}

		if($insert_id > 0){
			$status = true;			
		}else{
			$status = false;
			$error_message = 'Data Insert Error';
		}

		$return_result['status'] = $status;
		$return_result['reloc_id'] = $insert_id;
		$return_result['error_message'] = $error_message;
		
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

				$sql1 = "SELECT COUNT(reloc_id) AS count_reloc_id FROM reloc_asset_detail WHERE facility_id = '" .$facility_id. "' GROUP BY facility_id";
				$result1 = $mysqli->query($sql1);		
				if ($result1->num_rows > 0) {
					while($row1 = $result1->fetch_array()){
						$pms_planed = 0;
						$pending_pms = 0;
						$pms_done = 0;
						$count_reloc_id = $row1['count_reloc_id'];	 

						$data[0] = $slno; 
						$data[1] = $facility_name;
						$data[2] = $facility_code;
						$data[3] = $count_reloc_id; 
		
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
		$status = true;
		$mainData = array();
		$email1 = '';
		$facility_idS = $_GET['facility_idS'];
		$facility_codeS = $_GET['facility_codeS'];

		$where_condition = "WHERE reloc_asset_detail.reloc_id > 0";
		if($facility_idS > 0){
			$where_condition .= " AND reloc_asset_detail.facility_id = '" .$facility_idS. "' ";
		}
		if($facility_codeS != ''){
			$where_condition .= " AND facility_master.facility_code = '" .$facility_codeS. "' ";
		}
		
		
		$sql = "SELECT reloc_asset_detail.reloc_id, reloc_asset_detail.facility_id, reloc_asset_detail.from_dept_id, reloc_asset_detail.to_dept_id, reloc_asset_detail.asset_id, reloc_asset_detail.relocate_date_time, reloc_asset_detail.relocated_by, facility_master.facility_name, facility_master.facility_code, department_list.department_name FROM reloc_asset_detail JOIN facility_master ON reloc_asset_detail.facility_id = facility_master.facility_id JOIN department_list ON reloc_asset_detail.from_dept_id = department_list.department_id $where_condition ORDER BY reloc_asset_detail.reloc_id DESC LIMIT 0, 50";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$reloc_id = $row['reloc_id'];	
				$facility_id = $row['facility_id'];	
				$asset_id = $row['asset_id'];		
				$to_dept_id = $row['to_dept_id'];	
				$facility_name = $row['facility_name'];	 		
				$facility_code = $row['facility_code']; 		
				$department_name = $row['department_name'];		
				$relocate_date_time = date('d-m-Y h:i A', strtotime($row['relocate_date_time']));

				$sql1 = "SELECT department_name FROM department_list WHERE department_id = '" .$to_dept_id. "' ";
				$result1 = $mysqli->query($sql1);
				$row1 = $result1->fetch_array();
				$to_department_name = $row1['department_name'];	

				$equipment_name = '';
				$sql2 = "SELECT equipment_name FROM asset_details WHERE asset_id = '" .$asset_id. "' AND facility_id = '" .$facility_id. "' ";
				$result2 = $mysqli->query($sql2);
				if ($result2->num_rows > 0) {
					$row2 = $result2->fetch_array();
					$equipment_name = $row2['equipment_name'];	
				}

				$data[0] = $slno; 
				$data[1] = $facility_name;
				$data[2] = $facility_code;
				$data[3] = $department_name;
				$data[4] = $to_department_name; 
				$data[5] = $equipment_name;
				$data[6] = $relocate_date_time;
				$data[7] = 'Yes'; 
				$data[8] = "<a href='javascript: void(0)' data-center_id='1'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$reloc_id.")'></i></a>";
				

				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		}
			
			/*$slno = 1; 

			$data[0] = $slno; 
			$data[1] = 'Facility 1';
			$data[2] = '-';
			$data[3] = '-';
			$data[4] = '-'; 
			$data[5] = '-';
			$data[6] = '-';
			$data[7] = '-'; 
			array_push($mainData, $data);*/

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
		$reloc_id = $_POST["reloc_id"];
		$status = true;	

		$sql = "DELETE FROM reloc_asset_detail WHERE reloc_id = '".$reloc_id."'";
		$result = $mysqli->query($sql); 

		$return_result['status'] = $status; 
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
	

	//Get Asset name
	if($fn == 'getAllAssetName'){
		$return_array = array();
		$status = true;
		$mainData = array(); 
		$facility_id = $_POST['facility_id'];

		$sql = "SELECT * FROM asset_details WHERE facility_id = '" .$facility_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$asset_id = $row['asset_id'];	
				$asset_code = $row['asset_code'];	
				$equipment_name = $row['equipment_name']; 
				$data = new stdClass();

				$data->asset_id = $asset_id;
				$data->equipment_name = $equipment_name; 
				$data->asset_code = $asset_code; 
				
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
	
	// Get Facility ID
	if($fn == 'getFacilityID'){
		$return_array = array();
		$status = true;
		$mainData = array(); 
		$facility_id = $_POST['facility_id_dd'];
		$facility_code = '';

		$sql = "SELECT * FROM facility_master WHERE facility_id = '" .$facility_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$row = $result->fetch_array();
			$facility_code = $row['facility_code']; 			
		} else {
			$status = false;
		} 

		$return_array['status'] = $status;
		$return_array['facility_code'] = $facility_code;
		echo json_encode($return_array);
	}//function end
	
	//Get Asset Code
	if($fn == 'getAssetCode'){
		$return_array = array();
		$status = true;
		$asset_id = $_POST['asset_id'];
		$asset_code = '';

		$sql = "SELECT * FROM asset_details WHERE asset_id = '" .$asset_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$row = $result->fetch_array();
			$asset_code = $row['asset_code']; 			
		} else {
			$status = false;
		} 

		$return_array['status'] = $status;
		$return_array['asset_code'] = $asset_code;
		echo json_encode($return_array);
	}//function end

?>