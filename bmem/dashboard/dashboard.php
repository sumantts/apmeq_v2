<?php 
if(!$_SESSION["user_id"] || !$_SESSION["user_type_code"]){header('location:?p=signin');}
include('common/head.php'); ?>

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
					<div class="col-sm-4">
						<div class="card text-white bg-primary ">
							<div class="card-header">Facility 1</div>
							<div class="card-body">
								<h5 class="card-title text-white">Due Calibration</h5>
                                <h5 class="card-title text-white">Due PMS</h5>
                                <h5 class="card-title text-white">Due Service</h5>
                                <h5 class="card-title text-white">Due QA</h5>
                                <h5 class="card-title text-white">Warranty expired</h5>
                                <h5 class="card-title text-white">AMC expired</h5>
                                <h5 class="card-title text-white">CMC exipred</h5> 
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card text-white bg-secondary ">
							<div class="card-header">Facility 2</div>
							<div class="card-body">
								<h5 class="card-title text-white">Due Calibration</h5>
                                <h5 class="card-title text-white">Due PMS</h5>
                                <h5 class="card-title text-white">Due Service</h5>
                                <h5 class="card-title text-white">Due QA</h5>
                                <h5 class="card-title text-white">Warranty expired</h5>
                                <h5 class="card-title text-white">AMC expired</h5>
                                <h5 class="card-title text-white">CMC exipred</h5> 
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card text-white bg-success ">
							<div class="card-header">Facility 3</div>
							<div class="card-body">
								<h5 class="card-title text-white">Due Calibration</h5>
                                <h5 class="card-title text-white">Due PMS</h5>
                                <h5 class="card-title text-white">Due Service</h5>
                                <h5 class="card-title text-white">Due QA</h5>
                                <h5 class="card-title text-white">Warranty expired</h5>
                                <h5 class="card-title text-white">AMC expired</h5>
                                <h5 class="card-title text-white">CMC exipred</h5> 
							</div>
						</div>
					</div> 
				</div>
			</div>
            <!-- //Facilities -->
             
            <!-- Total -->
			<div class="col-xl-12">
				<h5 class="mt-4">Total</h5>
				<hr>
				<div class="row">
					<div class="col-sm-4">
						<div class="card text-white bg-warning">
							<div class="card-header">Facility 1</div>
							<div class="card-body">
								<h5 class="card-title text-white">Due Calibration</h5>
                                <h5 class="card-title text-white">Due PMS</h5>
                                <h5 class="card-title text-white">Due Service</h5>
                                <h5 class="card-title text-white">Due QA</h5>
                                <h5 class="card-title text-white">Warranty expired</h5>
                                <h5 class="card-title text-white">AMC expired</h5>
                                <h5 class="card-title text-white">CMC exipred</h5> 
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