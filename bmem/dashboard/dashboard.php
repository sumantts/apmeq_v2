<?php 
if(!$_SESSION["user_id"] || !$_SESSION["user_type_code"]){header('location:?p=signin');}
include('common/head.php'); 

$master_datas = array();
$user_id = $_SESSION["user_id"];			
$session_facility_id = $_SESSION["facility_id"]; 
$user_type_id = $_SESSION["user_type_id"];	

if($user_type_id == 1){
	$sql = "SELECT * FROM facility_master WHERE user_id = '" .$user_id. "' ";
}else{
	$sql = "SELECT * FROM facility_master WHERE facility_id = '" .$session_facility_id. "' ";
}

//$sql = "SELECT * FROM facility_master WHERE user_id = '" .$user_id. "' ";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	$status = true;
	$slno = 1;

	while($row = $result->fetch_array()){
		$facility_id = $row['facility_id'];		
		$facility_name = $row['facility_name'];	
		$facility_code = $row['facility_code'];
		
		$master_data = new stdClass();
		$master_data->facility_id = $facility_id;
		$master_data->facility_name = $facility_name;
		$master_data->facility_code = $facility_code;

		array_push($master_datas, $master_data);
	}//end while
}//end if

				
$st_calib_due = 0;
$st_pms_due = 0;
$st_qa_due = 0;	
$st_warrenty_exp = 0;	
$st_amc_exp = 0;	
$st_cmc_exp = 0;

for($i = 0; $i < sizeof($master_datas); $i++){
	$facility_id = $master_datas[$i]->facility_id;
	$master_datas[$i]->asset_ids = array();
	$asset_ids = array();
	$due_type = 0;
	$due_type_now = 0;	
				
	$calib_due = 0;
	$pms_due = 0;
	$qa_due = 0;	
	$warrenty_exp = 0;	
	$amc_exp = 0;	
	$cmc_exp = 0;
	
	$sql = "SELECT asset_details.asset_id, asset_details.facility_id, asset_details.department_id, asset_details.equipment_name, asset_details.asset_make, asset_details.asset_model, asset_details.slerial_number, asset_details.asset_specifiaction, asset_details.date_of_installation, asset_details.ins_certificate, asset_details.asset_supplied_by, asset_details.value_of_the_asset, asset_details.total_year_in_service, asset_details.technology, asset_details.asset_status, asset_details.asset_class, asset_details.device_group, asset_details.last_date_of_calibration, asset_details.calibration_attachment, asset_details.frequency_of_calibration, asset_details.last_date_of_pms, asset_details.qa_due_date, asset_details.pms_attachment, asset_details.frequency_of_pms, asset_details.frequency_of_qa, asset_details.qa_due_date, asset_details.qa_attachment, asset_details.warranty_last_date, asset_details.amc_yes_no, asset_details.amc_last_date, asset_details.cmc_yes_no, asset_details.cmc_last_date, asset_details.asset_code, asset_details.sp_details, asset_details.asset_code, asset_details.row_status, facility_master.facility_name, facility_master.facility_code FROM asset_details JOIN facility_master ON asset_details.facility_id = facility_master.facility_id WHERE asset_details.row_status = 1 AND asset_details.facility_id = '" .$facility_id. "' ORDER BY asset_details.asset_id DESC LIMIT 0, 50";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
		$status = true;
		$slno = 1;

		while($row = $result->fetch_array()){
			$asset_id = $row['asset_id'];		
			array_push($asset_ids, $asset_id);
				
			$facility_id = $row['facility_id'];				
			$facility_name = $row['facility_name'];				
			$facility_code = $row['facility_code']; 	
			$equipment_name = $row['equipment_name'];		
			$asset_make = $row['asset_make'];			
			$asset_model = $row['asset_model'];	
			$slerial_number = $row['slerial_number'];	  
			$asset_specifiaction = $row['asset_specifiaction'];	
			$date_of_installation = $row['date_of_installation'];	
			$asset_supplied_by = $row['asset_supplied_by'];	
			$value_of_the_asset = $row['value_of_the_asset'];	
			$total_year_in_service = $row['total_year_in_service'];
			$technology = $row['technology'];
			$asset_status = $row['asset_status'];
			$asset_code = $row['asset_code']; 
			$asset_class = $row['asset_class']; 
			$warranty_last_date = $row['warranty_last_date']; 
			$amc_yes_no = $row['amc_yes_no']; 
			$amc_last_date = $row['amc_last_date']; 
			$cmc_yes_no = $row['cmc_yes_no']; 
			$cmc_last_date = $row['cmc_last_date']; 
			$frequency_of_calibration = $row['frequency_of_calibration']; 
			$qa_due_date = $row['qa_due_date']; 
			$frequency_of_pms = $row['frequency_of_pms']; 
			$frequency_of_qa = $row['frequency_of_qa'];
			$last_date_of_calibration = $row['last_date_of_calibration']; 
			$last_date_of_pms = $row['last_date_of_pms']; 
			$last_date_of_qa = $row['qa_due_date']; 

			
			# Calibration Frequency Calculation
			$calib_frequency = '';
			$next_calib_date = ''; 
			if($last_date_of_calibration != '0000-00-00' && $frequency_of_calibration != ''){
				$last_date_of_calibration1 = date('Y-m-d', strtotime($last_date_of_calibration));
				$next_calib_date = $last_date_of_calibration1;
				$date = new DateTime($last_date_of_calibration1);				
				
				$calib_freq_str = explode("|", $frequency_of_calibration);
				if($calib_freq_str[0] > 0){
					$y = $calib_freq_str[0];
					$calib_frequency .= 'Each '.$y.' Year(s)';
					$next_calib_date = date('d-F-Y', strtotime('+'.$y.' year', strtotime($next_calib_date)));
				}
				if($calib_freq_str[1] > 0){
					$m = $calib_freq_str[1];
					if($calib_frequency != ''){
						$calib_frequency .= ' '.$m.' Month(s)';
					}else{
						$calib_frequency .= 'Each '.$m.' Month(s)';
					}
					$next_calib_date = date('d-F-Y', strtotime('+'.$m.' month', strtotime($next_calib_date)));
				}
				if($calib_freq_str[2] > 0){
					$d = $calib_freq_str[2];
					if($calib_frequency != ''){
						$calib_frequency .= ' '.$d.' Day(s)';
					}else{
						$calib_frequency .= 'Each '.$d.' Day(s)';
					}
					$next_calib_date = date('d-F-Y', strtotime('+'.$d.' day', strtotime($next_calib_date)));
				}  
			}
			

			if($next_calib_date != ''){					
				$fifteen_day_prev = date('Y-m-d H:i:s',(strtotime ( '-15 day' , strtotime($next_calib_date))));
				
				// Create two DateTime objects
				$today = date('Y-m-d');
				$date1 = new DateTime($today);
				$date2 = new DateTime($fifteen_day_prev);
				$date3 = new DateTime($next_calib_date);

				// Compare the dates
				if ($date1 > $date2 && $date1 < $date3) {
					//count calib due ++
					$calib_due++;
				} elseif ($date1 > $date3) {
					//count calib due ++
					$calib_due++;
				} else {
				}
			}//end if

			
			# PMS Frequency Calculation
			$pms_frequency = '';
			$next_pms_date = '';
			if($last_date_of_pms != '0000-00-00' && $frequency_of_pms != ''){
				$last_date_of_pms1 = date('Y-m-d', strtotime($last_date_of_pms));
				$next_pms_date = $last_date_of_pms1;
				$date = new DateTime($last_date_of_pms1); 
					
				$pms_freq_str = explode("|", $frequency_of_pms);
				if($pms_freq_str[0] > 0){
					$y1 = $pms_freq_str[0];
					$pms_frequency .= 'Each '.$y1.' Year(s)';
					$next_pms_date = date('d-F-Y', strtotime('+'.$y1.' year', strtotime($next_pms_date)));
				}
				if($pms_freq_str[1] > 0){
					$m1 = $pms_freq_str[1];
					if($pms_frequency != ''){
						$pms_frequency .= ' '.$m1.' Month(s)';
					}else{
						$pms_frequency .= 'Each '.$m1.' Month(s)';
					}
					$next_pms_date = date('d-F-Y', strtotime('+'.$m1.' month', strtotime($next_pms_date)));
				}
				if($pms_freq_str[2] > 0){
					$d1 = $pms_freq_str[2];
					if($pms_frequency != ''){
						$pms_frequency .= ' '.$d1.' Day(s)';
					}else{
						$pms_frequency .= 'Each '.$d1.' Day(s)';
					}
					$next_pms_date = date('d-F-Y', strtotime('+'.$d1.' day', strtotime($next_pms_date)));
				} 
			}//ennd if

			if($next_pms_date != ''){					
				$fifteen_day_prev = date('Y-m-d H:i:s',(strtotime ( '-15 day' , strtotime($next_pms_date))));
				
				// Create two DateTime objects
				$today = date('Y-m-d');
				$date1 = strtotime($today);
				$date2 = strtotime($fifteen_day_prev);
				$date3 = strtotime($next_pms_date);

				//echo 'date1: '.$date1.' date2: '.$date2.' date3: '.$date3;
				// Compare the dates
				if ($date1 > $date2) {
					//pms due count ++
					$pms_due++;
				} elseif ($date1 > $date3) {
					//pms due count ++
					$pms_due++;
				} else {
				}
			}//end if 

			 
			# QA Frequency Calculation
			$qa_frequency = '';
			$next_qa_date = '';
			if($last_date_of_qa != '0000-00-00' && $frequency_of_qa != ''){
				$last_date_of_qa1 = date('Y-m-d', strtotime($last_date_of_qa));
				$next_qa_date = $last_date_of_qa1;
				$date = new DateTime($last_date_of_qa1); 
					
				$qa_freq_str = explode("|", $frequency_of_qa);
				if($qa_freq_str[0] > 0){
					$y1 = $qa_freq_str[0];
					$qa_frequency .= 'Each '.$y1.' Year(s)';
					$next_qa_date = date('d-F-Y', strtotime('+'.$y1.' year', strtotime($next_qa_date)));
				}
				if($qa_freq_str[1] > 0){
					$m1 = $qa_freq_str[1];
					if($qa_frequency != ''){
						$qa_frequency .= ' '.$m1.' Month(s)';
					}else{
						$qa_frequency .= 'Each '.$m1.' Month(s)';
					}
					$next_qa_date = date('d-F-Y', strtotime('+'.$m1.' month', strtotime($next_qa_date)));
				}
				if($qa_freq_str[2] > 0){
					$d1 = $qa_freq_str[2];
					if($qa_frequency != ''){
						$qa_frequency .= ' '.$d1.' Day(s)';
					}else{
						$qa_frequency .= 'Each '.$d1.' Day(s)';
					}
					$next_qa_date = date('d-F-Y', strtotime('+'.$d1.' day', strtotime($next_qa_date)));
				}
			}//ennd if

			if($next_qa_date != ''){					
				$fifteen_day_prev = date('Y-m-d H:i:s',(strtotime ( '-15 day' , strtotime($next_qa_date))));
				
				// Create two DateTime objects
				$today = date('Y-m-d');
				$date1 = new DateTime($today);
				$date2 = new DateTime($fifteen_day_prev);
				$date3 = new DateTime($next_qa_date);

				// Compare the dates
				if ($date1 > $date2 && $date1 < $date3) {
					//QA due count ++
					$qa_due++;
				} elseif ($date1 > $date3) {
					//QA due count ++
					$qa_due++;
				} else { 
				}
			}//end if  

					
			if($warranty_last_date != '0000-00-00'){										
				$fifteen_day_prev = date('Y-m-d H:i:s',(strtotime ( '-15 day' , strtotime($warranty_last_date))));
				
				// Create two DateTime objects
				$today = date('Y-m-d');
				$date1 = new DateTime($today);
				$date2 = new DateTime($fifteen_day_prev);
				$date3 = new DateTime($warranty_last_date);

				// Compare the dates
				if ($date1 > $date2 && $date1 < $date3) {
					$warrenty_exp++;
				} elseif ($date1 > $date3) {
					$warrenty_exp++;
				} else {
				}
			}//end if

			//amc count					
			if($amc_yes_no == 1 && $amc_last_date != '0000-00-00'){										
				$fifteen_day_prev = date('Y-m-d H:i:s',(strtotime ( '-15 day' , strtotime($amc_last_date))));
				
				// Create two DateTime objects
				$today = date('Y-m-d');
				$date1 = new DateTime($today);
				$date2 = new DateTime($fifteen_day_prev);
				$date3 = new DateTime($amc_last_date);

				// Compare the dates
				if ($date1 > $date2 && $date1 < $date3) {
					$amc_exp++;
				} elseif ($date1 > $date3) {
					$amc_exp++;
				} else {
				}
			}//end if

			//cmc count					
			if($cmc_yes_no == 1 && $cmc_last_date != '0000-00-00'){										
				$fifteen_day_prev = date('Y-m-d H:i:s',(strtotime ( '-15 day' , strtotime($cmc_last_date))));
				
				// Create two DateTime objects
				$today = date('Y-m-d');
				$date1 = new DateTime($today);
				$date2 = new DateTime($fifteen_day_prev);
				$date3 = new DateTime($cmc_last_date);

				// Compare the dates
				if ($date1 > $date2 && $date1 < $date3) {
					$cmc_exp++;
				} elseif ($date1 > $date3) {
					$cmc_exp++;
				} else {
				}
			}//end if
			

		}//end while
	}//end if 

	$master_datas[$i]->asset_ids = $asset_ids;
	$master_datas[$i]->calib_due = $calib_due;
	$master_datas[$i]->pms_due = $pms_due;
	$master_datas[$i]->qa_due = $qa_due;
	$master_datas[$i]->warrenty_exp = $warrenty_exp;
	$master_datas[$i]->amc_exp = $amc_exp;
	$master_datas[$i]->cmc_exp = $cmc_exp;
	
	$all_due = $calib_due + $pms_due + $qa_due + $warrenty_exp + $amc_exp + $cmc_exp;
	$master_datas[$i]->all_due = $all_due;

	$st_calib_due = $st_calib_due + $calib_due;
	$st_pms_due = $st_pms_due + $pms_due;
	$st_qa_due = $st_qa_due + $qa_due;	
	$st_warrenty_exp = $st_warrenty_exp + $warrenty_exp;	
	$st_amc_exp = $st_amc_exp + $amc_exp;	
	$st_cmc_exp = $st_cmc_exp + $cmc_exp;

}//end for

if(sizeof($master_datas) > 0){
	for($m = 0; $m < sizeof($master_datas); $m++) {
		for($n = $m+1; $n < sizeof($master_datas); $n++){
			if($master_datas[$n]->all_due > $master_datas[$m]->all_due){
				$temp_var = $master_datas[$m];
				$master_datas[$m] = $master_datas[$n];
				$master_datas[$n] = $temp_var;
			}//end if
		}//end for
	}//end for
}//end if

if(sizeof($master_datas) > 0){
	$temp_master = array();
	for($i = 0; $i < sizeof($master_datas); $i++){
		if($master_datas[$i]->all_due > 0){
			array_push($temp_master, $master_datas[$i]);
		}//end if
	}//end for
	$master_datas = array();
	$master_datas = $temp_master;
}//end if

$first_index = 0;
$middle_index = 0;

if(sizeof($master_datas) == 3){
	$middle_index = 1;
}else if(sizeof($master_datas) > 3){
	$s = sizeof($master_datas);
	$middle_index = floor($s / 2);	
}else{}

$last_index = sizeof($master_datas) - 1;

// echo json_encode($master_datas); 

//echo 'first_index: ' . $first_index.' middle_index: '.$middle_index.' last_index: '.$last_index;

?>

<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->	
	<?php include('common/nav.php'); ?>
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<?php include('common/top_bar.php'); ?>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?=$title?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!"><?=$title?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- Facilities -->
			<div class="col-xl-12">
				<h5 class="mt-4">Facilities</h5>
				<hr>
				<div class="row">
					<?php if(sizeof($master_datas) > 0){?>
					<div class="col-sm-4">
						<div class="card text-white bg-danger ">
							<div class="card-header"><?=$master_datas[$first_index]->facility_name?></div>
							<div class="card-body">
								<h5 class="card-title text-white">Due Calibration: <?=$master_datas[$first_index]->calib_due?></h5>
                                <h5 class="card-title text-white">Due PMS: <?=$master_datas[$first_index]->pms_due?></h5>
                                <h5 class="card-title text-white">Due Service: 0</h5>
                                <h5 class="card-title text-white">Due QA: <?=$master_datas[$first_index]->qa_due?></h5>
                                <h5 class="card-title text-white">Warranty expired: <?=$master_datas[$first_index]->warrenty_exp?></h5>
                                <h5 class="card-title text-white">AMC expired: <?=$master_datas[$first_index]->amc_exp?></h5>
                                <h5 class="card-title text-white">CMC exipred: <?=$master_datas[$first_index]->cmc_exp?></h5> 
							</div>
						</div>
					</div>
					<?php } ?>

					<?php if($middle_index > 0){?>
					<div class="col-sm-4">
						<div class="card text-white bg-warning ">
							<div class="card-header"><?=$master_datas[$middle_index]->facility_name?></div>
							<div class="card-body">
								<h5 class="card-title text-white">Due Calibration: <?=$master_datas[$middle_index]->calib_due?></h5>
                                <h5 class="card-title text-white">Due PMS: <?=$master_datas[$middle_index]->pms_due?></h5>
                                <h5 class="card-title text-white">Due Service: 0</h5>
                                <h5 class="card-title text-white">Due QA: <?=$master_datas[$middle_index]->qa_due?></h5>
                                <h5 class="card-title text-white">Warranty expired: <?=$master_datas[$middle_index]->warrenty_exp?></h5>
                                <h5 class="card-title text-white">AMC expired: <?=$master_datas[$middle_index]->amc_exp?></h5>
                                <h5 class="card-title text-white">CMC exipred: <?=$master_datas[$middle_index]->cmc_exp?></h5> 
							</div>
						</div>
					</div>
					<?php } ?>

					<?php if(sizeof($master_datas) > 1){?>
					<div class="col-sm-4">
						<div class="card text-white bg-primary ">
							<div class="card-header"><?=$master_datas[$last_index]->facility_name?></div>
							<div class="card-body">
								<h5 class="card-title text-white">Due Calibration: <?=$master_datas[$last_index]->calib_due?></h5>
                                <h5 class="card-title text-white">Due PMS: <?=$master_datas[$last_index]->pms_due?></h5>
                                <h5 class="card-title text-white">Due Service: 0</h5>
                                <h5 class="card-title text-white">Due QA: <?=$master_datas[$last_index]->qa_due?></h5>
                                <h5 class="card-title text-white">Warranty expired: <?=$master_datas[$last_index]->warrenty_exp?></h5>
                                <h5 class="card-title text-white">AMC expired: <?=$master_datas[$last_index]->amc_exp?></h5>
                                <h5 class="card-title text-white">CMC exipred <?=$master_datas[$last_index]->cmc_exp?></h5> 
							</div>
						</div>
					</div>
					<?php } ?>
					
				</div>
			</div>
            <!-- //Facilities -->
             
            <!-- Total -->
			<div class="col-xl-12">
				<h5 class="mt-4">Total</h5>
				<hr>
				<div class="row">
					<div class="col-sm-4">
						<div class="card text-white bg-danger">
							<div class="card-header">Facility 1</div>
							<div class="card-body">
								<h5 class="card-title text-white">Due Calibration: <?=$st_calib_due?></h5>
                                <h5 class="card-title text-white">Due PMS: <?=$st_pms_due?></h5>
                                <h5 class="card-title text-white">Due Service: 0</h5>
                                <h5 class="card-title text-white">Due QA: <?=$st_qa_due?></h5>
                                <h5 class="card-title text-white">Warranty expired: <?=$st_warrenty_exp?></h5>
                                <h5 class="card-title text-white">AMC expired: <?=$st_amc_exp?></h5>
                                <h5 class="card-title text-white">CMC exipred: <?=$st_cmc_exp?></h5> 
							</div>
						</div>
					</div> 
				</div>
			</div>
            <!-- //Total -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
	<?php include('common/footer.php'); ?>