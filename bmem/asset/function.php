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
		$calibration_attachment = $_POST['calibration_attachment']; 
		$frequency_of_calibration = $_POST['frequency_of_calibration']; 
		$last_date_of_pms = $_POST['last_date_of_pms']; 
		$pms_attachment = $_POST['pms_attachment']; 
		$frequency_of_pms = $_POST['frequency_of_pms']; 
		$qa_due_date = $_POST['qa_due_date']; 
		$qa_attachment = $_POST['qa_attachment']; 
		$warranty_last_date = $_POST['warranty_last_date']; 
		$amc_yes_no = $_POST['amc_yes_no']; 
		$amc_last_date = $_POST['amc_last_date']; 
		$cmc_yes_no = $_POST['cmc_yes_no']; 
		$cmc_last_date = $_POST['cmc_last_date']; 
		$sp_details = $_POST['sp_details'];
		
		try {
			if($asset_id > 0){
				$status = true;
				$sql = "UPDATE asset_details SET facility_id = '" .$facility_id. "', department_id = '" .$department_id. "', equipment_name = '" .$equipment_name. "', asset_make = '" .$asset_make. "', asset_model = '" .$asset_model. "', slerial_number = '" .$slerial_number. "', asset_specifiaction = '" .$asset_specifiaction. "', date_of_installation = '" .$date_of_installation. "', asset_supplied_by = '" .$asset_supplied_by. "', value_of_the_asset = '" .$value_of_the_asset. "', total_year_in_service = '" .$total_year_in_service. "', technology = '" .$technology. "', asset_status = '" .$asset_status. "', asset_class = '" .$asset_class. "', device_group = '" .$device_group. "', last_date_of_calibration = '" .$last_date_of_calibration. "', frequency_of_calibration = '" .$frequency_of_calibration. "', last_date_of_pms = '" .$last_date_of_pms. "', pms_attachment = '" .$pms_attachment. "', frequency_of_pms = '" .$frequency_of_pms. "', qa_due_date = '" .$qa_due_date. "', warranty_last_date = '" .$warranty_last_date. "', amc_yes_no = '" .$amc_yes_no. "', amc_last_date = '" .$amc_last_date. "', cmc_yes_no = '" .$cmc_yes_no. "', cmc_last_date = '" .$cmc_last_date. "', sp_details = '" .$sp_details."' WHERE asset_id = '" .$asset_id. "' ";
				$result = $mysqli->query($sql); 
				$asset_id_temp = $asset_id;
			}else{ 
				$sql = "INSERT INTO asset_details (facility_id, department_id, equipment_name, asset_make, asset_model, slerial_number, asset_specifiaction, date_of_installation, asset_supplied_by, value_of_the_asset, total_year_in_service, technology, asset_status, asset_class, device_group, last_date_of_calibration, calibration_attachment, frequency_of_calibration, last_date_of_pms, pms_attachment, frequency_of_pms, qa_due_date, qa_attachment, warranty_last_date, amc_yes_no, amc_last_date, cmc_yes_no, cmc_last_date, sp_details) VALUES ('" .$facility_id. "', '" .$department_id. "', '" .$equipment_name. "', '" .$asset_make. "', '" .$asset_model. "', '" .$slerial_number. "', '" .$asset_specifiaction. "', '" .$date_of_installation. "', '" .$asset_supplied_by. "', '" .$value_of_the_asset. "', '" .$total_year_in_service. "', '" .$technology. "', '" .$asset_status. "', '" .$asset_class. "', '" .$device_group. "', '" .$last_date_of_calibration. "', '" .$calibration_attachment. "', '" .$frequency_of_calibration. "', '" .$last_date_of_pms. "', '" .$pms_attachment. "', '" .$frequency_of_pms. "', '" .$qa_due_date. "', '" .$qa_attachment. "', '" .$warranty_last_date. "', '" .$amc_yes_no. "', '" .$amc_last_date. "', '" .$cmc_yes_no. "', '" .$cmc_last_date. "', '" .$sp_details."')";
				$result = $mysqli->query($sql);
				$asset_id_temp = $mysqli->insert_id;
				if($asset_id_temp > 0){
					$status = true; 
				}else{
					$return_result['error_message'] = 'Photo size is soo large';
					$status = false;
				}	 
			}	
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		$return_result['asset_id_temp'] = $asset_id_temp;
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

				if($row['author_photo'] != ''){
					$author_photo = $row['author_photo'];
				}else{
					$author_photo = '';
				}	
				$author_status = ucfirst($row['author_status']);

				$profile_link = "../?p=my-bio&id=".base64_encode($author_id);

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

	//Get Product Images
	if($fn == 'getAllProductImages'){
		$return_array = array();
		$status = true;
		$all_images = array();
		$asset_id = $_POST["asset_id"];

		$sql = "SELECT ins_certificate FROM asset_details WHERE asset_id = '".$asset_id."'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$slno = 1;
			while($row = $result->fetch_array()){
				$all_images_en = $row['ins_certificate']; 
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
		$prod_iamge_name = $_POST["prod_iamge_name"];

		//Unlink product image
		$sql = "SELECT ins_certificate FROM asset_details WHERE asset_id = '".$asset_id."'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$slno = 1;
			while($row = $result->fetch_array()){
				$all_images_en = $row['ins_certificate']; 
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

		$sql = "UPDATE asset_details SET ins_certificate = '" .$all_images_en. "' WHERE asset_id = '".$asset_id."'";
		$mysqli->query($sql);

		$return_result['status'] = $status;
		//sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

?>