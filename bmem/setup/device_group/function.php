<?php
	include('../../assets/php/sql_conn.php');
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

		$device_group_id = $_POST["device_group_id"];		
		$device_name = $_POST["device_name"]; 		
		$device_status = $_POST["device_status"];
		
		try {
			if($device_group_id > 0){
				$status = true;
				$sql = "UPDATE device_group_list SET device_name = '" .$device_name. "', device_status = '" .$device_status. "' WHERE device_group_id = '" .$device_group_id. "' ";
				$result = $mysqli->query($sql);
			}else{
				$status = true;
				$sql = "INSERT INTO device_group_list (device_name, device_status) VALUES ('".$device_name."','".$device_status."')";
				$result = $mysqli->query($sql);
			}
				
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		//sleep(2);
		echo json_encode($return_result);
	}//Save function end	

	//function start
	if($fn == 'getTableData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$author_bio1 = '';
		$sql = "SELECT * FROM device_group_list ORDER BY device_name";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$device_group_id = $row['device_group_id'];		
				$device_name = $row['device_name']; 	
				$device_status = $row['device_status'];	
				$view_params = $device_group_id.', 1';
				$edit_params = $device_group_id.', 2';

				$data[0] = $slno;
				$data[1] = $device_name; 
				$data[2] =  $activity_status[$device_status];
				$data[3] = "<a href='javascript: void(0)' data-device_group_id='.$device_group_id.'><i class='fa fa-eye' aria-hidden='true' onclick='editTableData(".$view_params.")'></i></a> <a href='javascript: void(0)' data-device_group_id='.$device_group_id.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$edit_params.")'></i></a> <a href='javascript: void(0)' data-device_group_id='.$device_group_id.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$device_group_id.")'></i></a>";

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
		$device_group_id = $_POST['device_group_id'];

		$sql = "SELECT * FROM device_group_list WHERE device_group_id = '" .$device_group_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			
			$device_group_id = $row['device_group_id'];		
			$device_name = $row['device_name'];	 	
			$device_status = $row['device_status'];	
		} else {
			$status = false;
		}
		//$mysqli->close();
			
		$return_array['device_group_id'] = $device_group_id;
		$return_array['device_name'] = $device_name; 
		$return_array['device_status'] = $device_status;

		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$device_group_id = $_POST["device_group_id"];
		$status = true;	

		$sql = "DELETE FROM device_group_list WHERE device_group_id = '".$device_group_id."'";
		$result = $mysqli->query($sql);
		$return_result['status'] = $status;
		//sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

?>