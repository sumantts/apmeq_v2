<?php
	if($_SERVER['HTTP_HOST'] == 'localhost'){
		$host = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'apmeq_v2';
	}else{
		$host = 'localhost';
		$username = 'apmeqcom_apmeq';
		$password = 'apmeq123!@#';
		$dbname = 'apmeqcom_apmeq';
	}
	$mysqli = new mysqli($host, $username, $password, $dbname);

	// Check connection
	if ($mysqli -> connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
		exit();
	}else{
		//echo "Connected Successfully";
	}

	$con = mysqli_connect($host, $username, $password, $dbname);
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	session_start();
	
	/*echo "connected...";
	
	try {
		$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		$sql = "CALL usp_validateuser('admin','bagnan')";
		$q = $pdo->query($sql);
		$q->setFetchMode(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		die("Error occurred:" . $e->getMessage());
	}
		
	while ($r = $q->fetch()): 
		echo $r['SocietyNm'];
	endwhile;*/

	$title = 'APMEQ';
	$logo_text = 'APMEQ';

    $p_name = 'APMEQ';
	$logo = 'apmeq_logo.png';
	$ico = 'apmeq_logo.png';
	

	//Social Media
	$socials = [
		"twitter" => '',
		"facebook" => '',
		"instagram" => '',
		"google_plus" => '',
		"linkedin" => '',
	];

	$forTheYearsArr1 = '[
		{
			"value": "0",
			"text": "Select"
		}, 
		{
			"value": "1", 
			"text": "1st Year"
		} , 
		{
			"value": "2", 
			"text": "2nd Year"
		}, 
		{
			"value": "3", 
			"text": "3rd Year"
		}, 
		{
			"value": "4", 
			"text": "4th Year Onwards"
		}
	]';
	$forTheYearsArr = json_decode($forTheYearsArr1);

	$week_days1 = '[
		{
			"value": "",
			"text": "Day"
		}, 
		{
			"value": "1", 
			"text": "Monday"
		} , 
		{
			"value": "2", 
			"text": "Tuesday"
		}, 
		{
			"value": "3", 
			"text": "Wednesday"
		}, 
		{
			"value": "4", 
			"text": "Thursday"
		}, 
		{
			"value": "5", 
			"text": "Friday"
		}, 
		{
			"value": "6", 
			"text": "Saturday"
		}, 
		{
			"value": "7", 
			"text": "Sunday"
		}
	]';
	$week_days = json_decode($week_days1);

	$month_name1 = '[
		{
			"value": "",
			"text": "Month"
		}, 
		{
			"value": "1", 
			"text": "January"
		} , 
		{
			"value": "2", 
			"text": "February"
		}, 
		{
			"value": "3", 
			"text": "March"
		}, 
		{
			"value": "4", 
			"text": "April"
		}, 
		{
			"value": "5", 
			"text": "May"
		}, 
		{
			"value": "6", 
			"text": "June"
		}, 
		{
			"value": "7", 
			"text": "July"
		}, 
		{
			"value": "8", 
			"text": "August"
		}, 
		{
			"value": "9", 
			"text": "September"
		}, 
		{
			"value": "10", 
			"text": "October"
		}, 
		{
			"value": "11", 
			"text": "November"
		}, 
		{
			"value": "12", 
			"text": "December"
		}
	]';
	$month_name = json_decode($month_name1);

	date_default_timezone_set('Asia/Kolkata');

	$activity_status = ["Inactive", "Active"];

		 
?>
