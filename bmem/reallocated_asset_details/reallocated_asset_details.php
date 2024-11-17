<?php 
if(!$_SESSION["user_id"] || !$_SESSION["user_type_code"]){header('location:?p=signin');}
include('common/head.php');  
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
            <!-- [ sample-table ] start -->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h5>Reallocated Asset Details </h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option"> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert">
							<strong>Success!</strong> Your Data Deleted successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert1">
							<strong>Success!</strong> Your Data saved successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                        <!-- <button type="button" class="btn btn-primary mb-2 float-right" id="onMyModal">Add New</button>

                        <a href="?p=asset-dashboard&gr=setup"><i class="fa fa-arrow-left" ></i> Back</a>
                        <hr> -->
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Facility Name</th>
                                        <th>Facility Code</th>
                                        <th>Total Reallocation </th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Facility Name</th>
                                        <th>Facility Code</th>
                                        <th>Total Reallocation </th> 
                                    </tr>
                                </tfoot>
                            </table>
                        </div>                       

                    </div>
                </div>
            </div>
            
            <!-- [ sample-table ] Filter start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Filter Reallocated Asseta </h5> 
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert">
							<strong>Success!</strong> Your Data Deleted successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert1">
							<strong>Success!</strong> Your Data saved successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                         

                        <form class="needs-validation" method="POST" action="#" id="myFormS">
                            <div class="form-row">                               
                                <div class="col-md-3 mb-3">
                                    <label for="facility_idS">Facility Name</label>
                                    <select class="form-control" id="facility_idS">
                                        <option value="0">Select</option> 
                                    </select> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="facility_codeS">Facility code</label>
                                    <input type="text" class="form-control" id="facility_codeS"> 
                                </div>   

                                <div class="col-md-4 mt-4">
                                    <button class="btn  btn-primary" type="button" id="submitFormS">Search</button>
                                    <button class="btn btn-dark" type="button" id="clearForm">Clear</button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ sample-table ] start --> 
            <div class="col-sm-12 d-block" id="s_div">
                <div class="card">

                    <div class="card-header">
                        <h5 id="heading_1">Relocated Asset List</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option"> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <button type="button" class="btn btn-primary mb-2 float-right" id="generateLink">Generate Link <i class="fa fa-external-link" aria-hidden="true"></i></button>                         -->
                        <div class="table-responsive">
                            <table id="example_1" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Facility Name</th>
                                        <th>Facility Code</th>
                                        <th>Parent Department</th>
                                        <th>Reallocated Department</th>
                                        <th>All asset related details</th> 
                                        <th>Date</th>
                                        <th>Status<br>(i.e Shifted to parent depratment)</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Facility Name</th>
                                        <th>Facility Code</th>
                                        <th>Parent Department</th>
                                        <th>Reallocated Department</th>
                                        <th>All asset related details</th> 
                                        <th>Date</th>
                                        <th>Status<br>(i.e Shifted to parent depratment)</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>                       

                    </div>
                </div>
            </div>
            
            <!-- [ sample-table ] Filter start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Initiate Reallocation</h5> 
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert">
							<strong>Success!</strong> Your Data Deleted successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert1">
							<strong>Success!</strong> Your Data saved successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                         

                        <form class="needs-validation" method="POST" action="#" id="myForm">
                            <div class="form-row">                               
                                <div class="col-md-3 mb-3">
                                    <label for="facility_id" class="text-danger">Facility Name*</label>
                                    <select class="form-control js-example-basic-single" id="facility_id" required>
                                        <option value="">Select</option> 
                                    </select> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="facility_code">Facility code</label>
                                    <input type="text" class="form-control form-control-sm" id="facility_code"> 
                                </div>   

                                <div class="col-md-3 mb-3">
                                    <label for="from_dept_id" class="text-danger">Department*</label>
                                    <select class="form-control js-example-basic-single" id="from_dept_id" required>
                                        <option value="">Select</option> 
                                    </select> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="asset_id" class="text-danger">Asset Name*</label>
                                    <select class="form-control js-example-basic-single" id="asset_id" required>
                                        <option value="">Select</option> 
                                    </select> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="asset_code">Asset code</label>
                                    <input type="text" class="form-control form-control-sm" id="asset_code"> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="to_dept_id" class="text-danger">Reallocated to Department*</label>
                                    <select class="form-control js-example-basic-single" id="to_dept_id" required>
                                        <option value="">Select</option> 
                                    </select> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="relocate_date_time" class="text-danger">Relocate Date*</label>
                                    <input type="date" class="form-control form-control-sm" id="relocate_date_time" required> 
                                </div>
                            </div>  

                            <div class="form-row">
                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-primary" type="submit" id="submitForm"> Initiate </button>
                                </div> 
                            </div>
                        </form>
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
    
    <script src="reallocated_asset_details/function.js?d=<?=date('Ymdhis')?>"></script>