<?php  
if(!$_SESSION["user_id"] || !$_SESSION["user_type_code"]){header('location:?p=signin');}
include('common/head.php');  
?>
<script>
    window.localStorage.setItem('user_id', '1');
</script>
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
            
            <!-- Widget primary-success card start -->
            <div class="col-md-12 col-xl-12">
                <div class="card support-bar overflow-hidden">
                    <div class="card-body pb-0 text-center">
                        <h2 class="m-0" id="total_ticket">000</h2>
                        <span class="text-c-blue">PMS Ticket Status</span>
                        <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                    </div>
                    <div id="support-chart"></div>
                    <div class="card-footer bg-primary text-white">
                        <div class="row text-center">
                            <div class="col">
                                <h4 class="m-0 text-white" id="pending_pms">000</h4>
                                <span>Total Number of PMS due</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white" id="pms_done">000</h4>
                                <span>Total Number of PMS done</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white" id="pending_pms1">000</h4>
                                <span>Total Schedule / planned</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widget primary-success card end -->

            <!-- [ sample-table ] start -->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h5>Facility wise PMS Tickets</h5>
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
                                        <th>Facility name/code</th>
                                        <th>PMS due</th>
                                        <th>PMS done</th>
                                        <th>PMS planned</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>  
                                        <th>Facility name/code</th>
                                        <th>PMS due</th>
                                        <th>PMS done</th>
                                        <th>PMS planned</th> 
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
                        <h5>Filter PMS </h5> 
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
                         

                        <form class="needs-validation" id="pmsSerForm">
                            <div class="form-row">                               
                                <div class="col-md-3 mb-3">
                                    <label for="facility_id">Facility Name</label>
                                    <select class="form-control" id="facility_id">
                                        <option value="0">Select</option> 
                                    </select> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="facility_code">Facility code</label>
                                    <input type="text" class="form-control" id="facility_code"> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="device_group">Device Group</label>
                                    <select class="form-control" id="device_group">
                                        <option value="0">Select</option> 
                                    </select> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="asset_class">Asset Class</label>
                                    <select class="form-control" id="asset_class">
                                        <option value="0">Select</option>
                                        <option value="1">critical</option>
                                        <option value="2">Non Critical</option>
                                    </select> 
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="department_id">Department</label>
                                    <select class="form-control" id="department_id">
                                        <option value="0">Select</option> 
                                    </select> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="PMSStatus">PMS Status</label>
                                    <select class="form-control" id="PMSStatus">
                                        <option value="0">Select</option>
                                        <option value="1">DONE</option>
                                        <option value="2">DUE</option> 
                                    </select> 
                                </div>      

                                <div class="col-md-3 mb-3">
                                    <label for="PMSRequired">PMS Required</label>
                                    <select class="form-control" id="PMSRequired">
                                        <option value="0">Select</option>
                                        <option value="1">> 1 Week</option>
                                        <option value="2">> 2 Weeks</option> 
                                    </select> 
                                </div>        
                                
                                <div class="col-md-4 mb-3">
                                    <label for="date_from_to">Date from - Date to</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" id="from_date">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" id="to_date">
                                        </div>
                                    </div>
                                </div>     

                                <div class="col-md-4 mt-4">
                                    <button class="btn  btn-primary" type="button" id="filterPMS">
                                        <span class="btn-text" id="submitForm_text">Search</span>
                                    </button>
                                    
                                    <button class="btn btn-dark" type="button" id="clearSearchForm">
                                        <span class="btn-text" id="submitForm_text1">Clear</span>
                                    </button>
                                </div> 

                                <div class="col-md-4 mt-4">
                                    <button type="button" class="btn btn-primary mb-2 float-right" id="generateLink">Generate Link <i class="fa fa-external-link" aria-hidden="true"></i></button>
                                </div> 

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ sample-table ] start --> 
            <div class="col-sm-12 d-none" id="searchResDiv">
                <div class="card">
                    <div class="card-header">
                        <h5>Filter Result</h5>
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
                                        <th>PMS ID</th>
                                        <th>Facility Name</th>
                                        <th>Facility Code</th>
                                        <th>Department</th>
                                        <th>Device Group</th>
                                        <th>Asset Class</th> 
                                        <th>Equpment Name</th>
                                        <th>Equipment Make/Model</th>
                                        <th>Equipment sl no</th>
                                        <th>Last PMS Done</th>  
                                        <th>Supplied by</th>
                                        <th>Service provider details<br> if it is in Warranty/AMC/CMC</th>
                                        <th>PMS planned date</th>
                                        <th>Assign Service provider/<br>Junior enhgineer <br>(by soft link <br>email/mobile no/whatsapp)</th>
                                         
                                        <th>View report</th>
                                        <th>Updated status<br>(WIP/Resolved/closed)</th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>PMS ID</th>
                                        <th>Facility Name</th>
                                        <th>Facility Code</th>
                                        <th>Department</th>
                                        <th>Device Group</th>
                                        <th>Asset Class</th> 
                                        <th>Equpment Name</th>
                                        <th>Equipment Make/Model</th>
                                        <th>Equipment sl no</th>
                                        <th>Last PMS Done</th>  
                                        <th>Supplied by</th>
                                        <th>Service provider details<br> if it is in Warranty/AMC/CMC</th>
                                        <th>PMS planned date</th>
                                        <th>Assign Service provider/<br>Junior enhgineer <br>(by soft link <br>email/mobile no/whatsapp)</th>
                                         
                                        <th>View report</th>
                                        <th>Updated status<br>(WIP/Resolved/closed)</th> 
                                    </tr>
                                </tfoot>
                            </table>
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
    
    <script src="pms_dashboard/function.js?d=<?=date('Ymdhis')?>"></script>