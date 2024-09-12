<?php
	include('../assets/php/sql_conn.php');
	$fn = '';
    
	if(isset($_GET["fn"])){
	    $fn = $_GET["fn"];
	}else if(isset($_POST["fn"])){
	    $fn = $_POST["fn"];
	}
	

	//Get Course name
	if($fn == 'calculateAssetValue'){
		$return_array = array();
		$status = true;
		$mainData = array(); 
		$total_asset_count = 0;
		$sub_total_value_of_the_asset = 0;

		$sql = "SELECT * FROM asset_details";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$total_asset_count = $result->num_rows;
			while($row = $result->fetch_array()){
				$value_of_the_asset = $row['value_of_the_asset'];	
				$sub_total_value_of_the_asset = $sub_total_value_of_the_asset + $value_of_the_asset;
			}
		} else {
			$status = false;
		} 

		$return_array['status'] = $status;
		$return_array['total_asset_count'] = $total_asset_count;
		$return_array['sub_total_value_of_the_asset'] = number_format($sub_total_value_of_the_asset, 2);

		echo json_encode($return_array);
	}//function end	

?>