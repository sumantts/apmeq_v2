<?php
	include('../assets/php/sql_conn.php');
    
    $return_data = array();
    $status = true;
    $message = '';
    $all_images_en = '';

    $rber_info_id = $_POST['rber_info_id'];
    $filename = $_FILES["upload_image"]["name"];
    $u_id = uniqid(); 
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $new_file_name = $u_id.'.'.$ext;

    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
        $status = true;
        move_uploaded_file($_FILES["upload_image"]["tmp_name"], 'photos/'.$new_file_name);

        $all_images = array();
        

		$sql = "SELECT * FROM rber_info WHERE rber_info_id = '" .$rber_info_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) { 
			$row = $result->fetch_array(); 
			$all_images_en = $row['pms_report_attached'];	
            if($all_images_en != ''){
                $all_images_de = json_decode($all_images_en);
                $all_images = $all_images_de;
            } //end if
        }//end if
        array_push($all_images, $new_file_name);
        $all_images_en = json_encode($all_images);
        
        $upd_sql = "UPDATE rber_info SET pms_report_attached = '" .$all_images_en. "' WHERE rber_info_id = '" .$rber_info_id. "' ";
        $mysqli->query($upd_sql);

    }else{
        $message = 'File Extention not supported';
    }

    $return_data['status'] = $status;
    $return_data['ext'] = $ext; 
    $return_data['rber_info_id'] = $rber_info_id;
    $return_data['new_file_name'] = $new_file_name;
    $return_data['message'] = $message;
    echo json_encode($return_data);
 
?>