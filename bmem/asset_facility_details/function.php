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
		$user_id = $_SESSION["user_id"];
		
		$sql = "SELECT * FROM facility_master WHERE user_id = '" .$user_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$total_assets = 0;
				$verified_assets = 0;
				$non_verified_assets = 0;
				$total_rber = 0;
				$working_assets = 0;
				$non_working_assets = 0;
				$critical_assets = 0;
				$non_critical_assets = 0;
				$facility_id = $row['facility_id'];		
				$facility_name = $row['facility_name'];	
				$facility_code = $row['facility_code'];	
				

				//Total Assets
				$sql1 = "SELECT * FROM asset_details WHERE facility_id = '" .$facility_id. "' ";
				$result1 = $mysqli->query($sql1);
				$total_assets = $result1->num_rows;

				if($total_assets > 0){
					while($row1 = $result1->fetch_array()){
						$asset_status = $row1['asset_status'];
						$asset_class = $row1['asset_class'];

						//working_assets
						if($asset_status == 1){
							$working_assets++;
						}//end if		

						//not working_assets
						if($asset_status == 2){
							$non_working_assets++;
						}//end if

						//total_rber
						if($asset_status == 5){
							$total_rber++;
						}//end if	

						//verified_assets
						if($asset_status == 6){
							$verified_assets++;
						}//end if

						//non_verified_assets
						if($asset_status == 7){
							$non_verified_assets++;
						}//end if

						//critical_assets
						if($asset_class == 1){
							$critical_assets++;
						}//end if	

						//not critical_assets
						if($asset_class == 2){
							$non_critical_assets++;
						}//end if
					}//end while


					$data[0] = $slno; 
					$data[1] = $facility_name;
					$data[2] = $facility_code;
					$data[3] = $total_assets;
					$data[4] = $verified_assets; 
					$data[5] = $non_verified_assets;
					$data[6] = $total_rber;
					$data[7] = $working_assets;
					$data[8] = $non_working_assets;
					$data[9] = $critical_assets;
					$data[10] = $non_critical_assets;
					$data[11] = "<a href='?p=asset-data&gr=setup&facility_id=$facility_id'><i class='fa fa-filter fa-lg' aria-hidden='true'></i></a>";				

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

?>