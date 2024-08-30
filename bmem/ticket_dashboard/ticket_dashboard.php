<?php 
if(!$_SESSION["user_id"] || !$_SESSION["user_type_code"]){header('location:?p=signin');}
include('common/head.php');  
?>
<script type="text/javascript">   

</script>
<style>
    /*table td {
        word-break: break-word;
        vertical-align: top;
        white-space: normal !important;
    }*/
</style>

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
                        <h2 class="m-0">350</h2>
                        <span class="text-c-blue">Support Requests</span>
                        <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                    </div>
                    <div id="support-chart"></div>
                    <div class="card-footer bg-primary text-white">
                        <div class="row text-center">
                            <div class="col">
                                <h4 class="m-0 text-white">10</h4>
                                <span>Total Ticket</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white">5</h4>
                                <span>Resolved</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white">3</h4>
                                <span>Open / Assign / WIP</span>
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
                        <h5><?=$title?></h5>
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
                                        <th>Total Tickets</th>
                                        <th>Critical Tickets</th>
                                        <th>Non Critical Tickets</th>
                                        <th>Closed/Resolved Tickets</th>
                                        <th>Open Tickets</th>
                                        <th>WIP Tickets</th>
                                        <th>< 3 Days</th>
                                        <th>3 > < 5 Days</th>
                                        <th>5 > < 7 Days</th> 
                                        <th>> 7 Days</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Facility name/code</th>
                                        <th>Total Tickets</th>
                                        <th>Critical Tickets</th>
                                        <th>Non Critical Tickets</th>
                                        <th>Closed/Resolved Tickets</th>
                                        <th>Open Tickets</th>
                                        <th>WIP Tickets</th>
                                        <th>< 3 Days</th>
                                        <th>3 > < 5 Days</th>
                                        <th>5 > < 7 Days</th> 
                                        <th>> 7 Days</th>
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
                        <h5>Filter wise</h5> 
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
                         

                        <form class="needs-validation" novalidate>
                            <div class="form-row">                               
                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Facility Name</label>
                                    <select class="form-control" id="author_name">
                                        <option value="0">Select</option>
                                        <option value="1">Facility 1</option>
                                        <option value="2">Facility 2</option>
                                    </select> 
                                </div>  

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Department</label>
                                    <select class="form-control" id="author_name">
                                        <option value="0">Select</option>
                                        <option value="1">Department 1</option>
                                        <option value="2">Department 2</option>
                                    </select> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Status</label>
                                    <select class="form-control" id="author_name">
                                        <option value="0">Select</option>
                                        <option value="1">Assigned</option>
                                        <option value="2">Open</option>
                                        <option value="3">Resolved</option>
                                        <option value="4">WIP</option>
                                        <option value="5">Incident report</option>
                                        <option value="6">Standby</option>
                                        <option value="7">RBER</option>
                                    </select> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Ticket Id</label>
                                    <input type="text" class="form-control" id="author_name"> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Day Wise</label>
                                    <select class="form-control" id="author_name">
                                        <option value="0">Select</option>
                                        <option value="1">< 3days</option>
                                        <option value="2">> 3days</option>
                                        <option value="3">< 7days</option>
                                        <option value="4">> 7days</option> 
                                    </select> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Enter Barcode</label>
                                    <input type="text" class="form-control" id="author_name"> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Device Group</label>
                                    <select class="form-control" id="author_name">
                                        <option value="0">Select</option>
                                        <option value="1">Scanner</option>
                                        <option value="2">In vitro Diagnostics</option>
                                        <option value="3">Readiology</option>
                                        <option value="4">Monitors</option>
                                        <option value="5">Crtitical care</option>
                                        <option value="6">Opthalmology</option>
                                        <option value="7">Surgical</option>
                                        <option value="8">Drug Delivery</option> 
                                    </select> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Device Name</label>
                                    <input type="text" class="form-control" id="author_name"> 
                                </div>  

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Class Wise</label>
                                    <select class="form-control" id="author_name">
                                        <option value="0">Select</option>
                                        <option value="1">critical</option>
                                        <option value="2">Non Critical</option>
                                    </select> 
                                </div> 

                                <div class="col-md-3 mt-4">
                                    <button class="btn  btn-primary" type="button" id="submitForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Search</span>
                                    </button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ sample-table ] start --> 
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h5>Filter Result</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option"> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table id="example_1" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Ticket no</th>
                                        <th>Complaint/issue</th>
                                        <th>Barcode</th>
                                        <th>Asset Name</th>
                                        <th>Facility code</th>
                                        <th>Facility Name</th>
                                        <th>Department</th>
                                        <th>Supplied by</th>
                                        <th>Service provider details<br> if it is in <br>Warranty/AMC/CMC</th>
                                        <th>Logged date</th> 
                                        <th>Resolved Date</th>
                                        <th>Contact details <br>of <br>ticket raiser</th>
                                        <th>Assign Service provider/<br>Junior enhgineer</th>
                                        <th>Engineer Contact No</th>
                                        <th>Report Upload</th>
                                        <th>Report view</th>
                                        <th>Status<br>(WIP/Resolved/closed)</th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Ticket no</th>
                                        <th>Complaint/issue</th>
                                        <th>Barcode</th>
                                        <th>Asset Name</th>
                                        <th>Facility code</th>
                                        <th>Facility Name</th>
                                        <th>Department</th>
                                        <th>Supplied by</th>
                                        <th>Service provider details<br> if it is in <br>Warranty/AMC/CMC</th>
                                        <th>Logged date</th> 
                                        <th>Resolved Date</th>
                                        <th>Contact details <br>of <br>ticket raiser</th>
                                        <th>Assign Service provider/<br>Junior enhgineer</th>
                                        <th>Engineer Contact No</th>
                                        <th>Report Upload</th>
                                        <th>Report view</th>
                                        <th>Status<br>(WIP/Resolved/closed)</th> 
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
    
    <script src="ticket_dashboard/function.js?d=<?=date('Ymdhis')?>"></script>