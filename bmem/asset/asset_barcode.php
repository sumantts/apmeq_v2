<?php
if(!$_SESSION["user_id"] || !$_SESSION["user_type_code"]){header('location:?p=signin');}
    include('common/head.php'); 
    $facility_id = $_GET['facility_id'];

    #php-barcode-generator
    #https://github.com/picqer/php-barcode-generator

    require 'barcode_generator/vendor/autoload.php';
    $file_path = 'barcode_generator/barcode_images/'.$facility_id.'/';
    function folder_exist($folder){
        // Get canonicalized absolute pathname
        $path = realpath($folder);
        // If it exist, check if it's a directory
        return ($path !== false AND is_dir($path)) ? true : false;
    }

    $is_exist = folder_exist($file_path);
    //echo 'is_exist:'.$is_exist;
    if($is_exist == false){
        //echo 'create a new directory';
        mkdir("barcode_generator/barcode_images/" . $facility_id, 0777);
        //$file_path = 'barcode_generator/barcode_images/'.$facility_id;
    }
    //exit();
    $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
    
    $serial_no_detail = array();
    $sql = "SELECT * FROM asset_details WHERE facility_id = '" .$facility_id. "' ";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_array()){
            $asset_code = $row['asset_code']; 
            $stored_data_str = $facility_id.'|'.$asset_code; //Supported 
            file_put_contents($file_path.''.$asset_code.'.jpg', $generator->getBarcode($stored_data_str, $generator::TYPE_CODE_128));
        }
    }//end if 
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
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!"><?=$title?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h5>Barcode List</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                                <button type="button" class="btn btn-primary mb-2 float-right" id="printBarcode">Print Barcode</button>
                            </div>
                        </div>
                    </div>


                    <div class="card-body" id="barcodeList">
                        <div class="row">
                        <?php 
                            $sql1 = "SELECT * FROM asset_details WHERE facility_id = '" .$facility_id. "' ";
                            $result1 = $mysqli->query($sql1);
                            if ($result1->num_rows > 0) {
                                while($row1 = $result1->fetch_array()){
                                    $asset_code1 = $row1['asset_code']; 
                                    $equipment_name = $row1['equipment_name']; 
                            ?>
                            <div class="col-md-2">
                            <img src="<?=$file_path.''.$asset_code1.'.jpg'?>" class="card-img-top" alt="<?=$asset_code1?>" width="302" height="50"> 
                            <div class="text-center"><?=$asset_code1?></div> 
                            <div class="text-center"><?=$equipment_name?></div>
                            </div>
                        <?php } } ?>
                        </div>
                    
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
	<?php include('common/footer.php'); ?>
    
    <script src="asset/function.js?d=<?=date('Ymdhis')?>"></script>