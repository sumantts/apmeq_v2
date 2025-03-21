<?php
	include('assets/php/sql_conn.php');	
	
	if(isset($_GET["p"])){
		$p = $_GET["p"];
	}else{
		$p = '';
	}
	
	if(isset($_GET["gr"])){
		$gr = $_GET["gr"];
	}else{
		$gr = '';
	}

	switch($p){
		case 'signin':
        $title = "Signin";
		include('signin/signin.php');
		break; 
		
		case 'dashboard':
		$title = "Dashboard";
		include('dashboard/dashboard.php');		
		break;

		//SETUP		
		case 'department':
			$title = "Department";
			include('setup/department/department.php');		
		break; 	

		case 'device-group':
			$title = "Device Group";
			include('setup/device_group/device_group.php');		
		break; 	

		case 'hospital-details':
			$title = "Hospital Details";
			include('setup/hospital_details/hospital_details.php');		
		break; 	

		case 'user-type':
			$title = "User Type";
			include('setup/user_type/user_type.php');		
		break; 	

		case 'students':
			$title = "students";
			include('setup/students/students.php');		
		break; 
					
		case 'asset-type':
			$title = "Asset Type";
			include('setup/asset_type/asset_type.php');		
		break;  
					
		case 'department':
			$title = "Department";
			include('setup/department/department.php');		
		break; 
						
		//DETAILS	 	
		case 'user-details':
			$title = "User Details";
			include('details/user_details/user_details.php');		
		break; 	

		case 'asset-details':
			$title = "Asset Details";
			include('details/asset_details/asset_details.php');		
		break; 

		case 'supplier':
			$title = "Supplier";
			include('details/supplier/supplier.php');		
		break;

		case 'manufacturer':
			$title = "Manufacturer";
			include('details/manufacturer/manufacturer.php');		
		break;

		case 'service-providers':
			$title = "Service Providers";
			include('details/service_providers/service_providers.php');		
		break;
						
		//ACTIONS	 	
		case 'asset-reallocate':
			$title = "Asset Reallocate";
			include('actions/asset_reallocate/asset_reallocate.php');		
		break; 	

		/******** V2 ****************/	 	
		case 'facility':
			$title = "Facility";
			include('user_facility/user_facility.php');		
		break; 		 	
		case 'asset':
			$title = "Asset";
			include('asset/asset.php');		
		break;  		 	
		case 'asset-dashboard':
			$title = "Asset Dashboard";
			include('asset_dashboard/asset_dashboard.php');		
		break; 	 		 	
		case 'asset-facility-details':
			$title = "Facility Wise Asset Dashboard";
			include('asset_facility_details/asset_facility_details.php');		
		break;  	 		 	
		case 'asset-data':
			$title = "Asset Data";
			include('asset_data/asset_data.php');		
		break; 	 		 	
		case 'asset-barcode':
			$title = "Asset QR Code";
			include('asset/asset_barcode.php');		
		break; 	 		 	
		case 'ticket-dashboard':
			$title = "Ticket Dashboard";
			include('ticket_dashboard/ticket_dashboard.php');		
		break;  	 	 		 	
		case 'pms-dashboard':
			$title = "PMS Dashboard";
			include('pms_dashboard/pms_dashboard.php');		
		break;  	 	 		 	
		case 'calibration-dashboard':
			$title = "Calibration Dashboard";
			include('calibration_dashboard/calibration_dashboard.php');		
		break;  	 	 		 	
		case 'qa-dashboard':
			$title = "QA Dashboard";
			include('qa_dashboard/qa_dashboard.php');		
		break;  	 	 		 	
		case 'rber-condemned':
			$title = "Recomended for Beyond Economic Repair / Condemned";
			include('rber_condemned/rber_condemned.php');		
		break;  	 	 		 	
		case 'reallocated-asset-details':
			$title = "Reallocated Asset Details";
			include('reallocated_asset_details/reallocated_asset_details.php');		
		break;   	 	 		 	
		case 'call-log':
			$title = "Call Log";
			include('call_log/call_log.php');		
		break;

		default:
		include('signin/signin.php');
	}
    

?>