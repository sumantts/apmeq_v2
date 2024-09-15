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
			$data[11] = "<a href='?p=asset-data&gr=setup'><i class='fa fa-filter fa-lg' aria-hidden='true'></i></a>";
			array_push($mainData, $data);

		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end 

?>