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
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
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
				<div class="row">
					<div class="col-sm-12 col-md-6">						 
						<div class="card text-left">
							<div class="card-body">
								<h5 class="card-title">Total Asset</h5>
								<p class="card-text">This value gives an overview of the financial strength and capacity of the lab, which can be used for budgeting, investment decisions, or financial reporting.</p>
								<a href="?p=asset-facility-details&gr=setup" class="btn  btn-primary">Show Assets</a>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">						 
						<div class="card text-left">
							<div class="card-body">
								<h5 class="card-title">Total Asset Value</h5>
								<p class="card-text">To calculate the Total Assets of a hospital lab, you would add up the value of all these assets: Total Assets = Tangible Assets + Intangible Assets + Current Assets + Other Assets  </p>
								<a href="?p=asset-facility-details&gr=setup" class="btn  btn-primary">Show Assets</a>
							</div>
						</div>
					</div>
					
				</div>
			</div>
            <!-- //Facilities -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
	<?php include('common/footer.php'); ?>
    
    <script src="asset_dashboard/function.js?d=<?=date('Ymdhis')?>"></script>