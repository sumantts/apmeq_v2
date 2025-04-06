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
            
            <!-- Widget primary-success card start -->
            <div class="col-md-12 col-xl-12">
                <div class="card support-bar overflow-hidden">
                    <div class="card-body pb-0 text-center">
                        <h2 class="m-0" id="total_ticket">000</h2>
                        <span class="text-c-blue">Support Requests</span>
                        <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                    </div>
                    <div id="support-chart"></div>
                    <div class="card-footer bg-primary text-white">
                        <div class="row text-center">
                            <div class="col">
                                <h4 class="m-0 text-white" id="total_ticket1">000</h4>
                                <span>Total Ticket</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white" id="resolved_ticket">000</h4>
                                <span>Resolved</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white" id="open_ticket">000</h4>
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
                                        <th>Closed</th>
                                        <th>Resolved Tickets</th>
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
                                        <th>Closed</th>
                                        <th>Resolved Tickets</th>
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
                         

                        <form class="needs-validation" id="myFormS" action="#" method="POST">
                            <div class="form-row">                               
                                <div class="col-md-3 mb-3">
                                    <label for="facility_id_s">Facility Name</label>
                                    <select class="form-control js-example-basic-single" id="facility_id_s" name="facility_id_s">
                                        <option value="0">Select</option>
                                    </select> 
                                </div>  

                                <div class="col-md-3 mb-3">
                                    <label for="department_id">Department</label>
                                    <select class="form-control js-example-basic-single" id="department_id" name="department_id">
                                        <option value="0">Select</option> 
                                    </select> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="status_by_engg">Ticket Status</label>
                                    <select class="form-control js-example-basic-single" id="status_by_engg" name="status_by_engg"> 
                                        <option value="-1">Select</option> 
                                        <option value="0">Work In Progress</option> 
                                        <option value="1">Closed </option>
                                        <option value="2">RBER</option>
                                    </select> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="token_id">Ticket/Token Id</label>
                                    <input type="text" class="form-control form-control-sm" id="token_id" name="token_id"> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="day_wise">Day Wise</label>
                                    <select class="form-control js-example-basic-single" id="day_wise" name="day_wise">
                                        <option value="0">Select</option>
                                        <option value="1">< 3days</option>
                                        <option value="2">> 3days</option>
                                        <option value="3">< 7days</option>
                                        <option value="4">> 7days</option> 
                                    </select> 
                                </div>    

                                <!-- <div class="col-md-3 mb-3">
                                    <label for="author_name">Enter Barcode</label>
                                    <input type="text" class="form-control" id="author_name"> 
                                </div>      -->

                                <div class="col-md-3 mb-3">
                                    <label for="device_group">Device Group</label>
                                    <select class="form-control js-example-basic-single" id="device_group" name="device_group">
                                        <option value="0">Select</option> 
                                    </select> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="equipment_name">Device Name</label>
                                    <input type="text" class="form-control form-control-sm" id="equipment_name" name="equipment_name"> 
                                </div>  

                                <div class="col-md-3 mb-3">
                                    <label for="ticket_class">Asset Class</label>
                                    <select class="form-control js-example-basic-single" id="ticket_class" name="ticket_class">
                                        <option value="0">Select</option>
                                        <option value="1">critical</option>
                                        <option value="2">Non Critical</option>
                                    </select> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="warranty">Warranty</label>
                                    <select class="form-control form-control-sm" name="warranty_sr" id="warranty_sr">
                                        <option value="">Select</option> 
                                        <option value="1">Warranty</option> 
                                        <option value="2">Without Warranty</option> 
                                    </select> 
                                </div>       
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Date Wise (From date to To date)</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" class="form-control form-control-sm" name="from_dt" id="from_dt"> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control form-control-sm" name="to_dt" id="to_dt"> 
                                        </div>
                                    </div>
                                </div> 

                                <div class="col-md-4 mt-4">
                                    <button class="btn btn-sm  btn-primary" type="submit" id="submitForm"> Search </button>
                                    
                                    <button class="btn btn-sm btn-dark" type="button" id="clearForm"> Clear </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ sample-table ] start --> 
            <div class="col-sm-12 d-none" id="filteredTicketDiv">
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
                                        <th>Asset Code</th>
                                        <th>Facility Name</th>
                                        <th>Facility code</th>
                                        <th>Department</th>
                                        <th>Supplied by</th>
                                        <th>Logged date</th> 
                                        <th>Resolved Date</th>
                                        <th>Contact details <br>of <br>ticket raiser</th>
                                        <th>Assign Service provider/<br>Junior enhgineer</th>
                                        <th>Engineer Contact No</th>
                                        <th>Call Log Status </th> 
                                        <th>Warrenty last date</th>
                                        <th>AMC(Y/N)<br>Date</th>
                                        <th>CMC(Y/N)<br>Date</th>
                                        <th>Service provider<br> details</th>
                                        <th>Soft Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Ticket no</th>
                                        <th>Complaint/issue</th>
                                        <th>Barcode</th>
                                        <th>Asset Name</th>
                                        <th>Asset Code</th>
                                        <th>Facility Name</th>
                                        <th>Facility code</th>
                                        <th>Department</th>
                                        <th>Supplied by</th>
                                        <th>Logged date</th> 
                                        <th>Resolved Date</th>
                                        <th>Contact details <br>of <br>ticket raiser</th>
                                        <th>Assign Service provider/<br>Junior enhgineer</th>
                                        <th>Engineer Contact No</th>
                                        <th>Call Log Status </th> 
                                        <th>Warrenty last date</th>
                                        <th>AMC(Y/N)<br>Date</th>
                                        <th>CMC(Y/N)<br>Date</th>
                                        <th>Service provider<br> details</th>
                                        <th>Soft Link</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>                       

                    </div>
                </div>
            </div>

            <!-- Modal start -->
            <div id="exampleModalLong" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><?=$title?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" method="POST" id="myFormM" action="#">
                                <a href="javascript: void(0);" id="partTwoSwitch" class="float-right">Show Ticket Description</a>
                                <br>
                                <hr>
                                <div class="form-row" id="partTwoBoard"> 
                                    <div class="col-md-12 mb-3" id="ticket_data">
                                        
                                    </div>  
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="assign_to" class="text-danger">Assign To*</label>
                                        <select class="form-control" name="assign_to" id="assign_to" required>
                                            <option value="0">Select</option> 
                                            <option value="1">Engineer</option> 
                                            <option value="2">Service Provider</option> 
                                        </select> 
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="eng_contact_no" class="text-danger">Engineer Contact Number</label>
                                        <input type="tel" class="form-control" id="eng_contact_no" value="" > 
                                    </div> 

                                    <div class="col-md-4 mb-3">
                                        <label for="status_by_enggM" class="text-danger">Call Log Status*</label>
                                        <select class="form-control" name="status_by_enggM" id="status_by_enggM" required> 
                                            <option value="-1">Select</option> 
                                            <option value="0">Work In Progress</option> 
                                            <option value="1">Closed </option>
                                            <option value="2">RBER</option>
                                            <option value="3">Condemed</option> 
                                        </select> 
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="resolved_date_time" >Resolved Date Time</label>
                                        <input type="date" class="form-control" id="resolved_date_time" value="" > 
                                    </div>
                                    
                                    <div class="col-md-6 mt-4">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="file" id="multiupload" name="uploadFiledd[]" multiple accept=".jpg,.jpeg,.png" >
                                                <span id="uploadMessage"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" id="startUpload" class="btn btn-primary btn-sm">Upload</button>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div> 

                                <div class="form-row"> 
                                    <div class="col-md-12 mb-3">
                                        <div class="text-center" id="product_gallery"> </div>
                                    </div>
                                </div>

                                <div class="form-row"> 
                                    <div class="col-md-12 mb-3">
                                        <textarea class="form-control" name="engineer_coment" id="engineer_coment"></textarea>
                                    </div>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="call_log_id" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            
                            <button class="btn btn-primary" type="submit" id="submitFormM"> Save Changes </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal end -->
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
	<?php include('common/footer.php'); ?>
    
    <script src="ticket_dashboard/function.js?d=<?=date('Ymdhis')?>"></script>
