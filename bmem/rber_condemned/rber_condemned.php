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
            <div class="col-sm-12 d-block" id="filteredTicketDiv">
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
                                    
                                    <!-- <div class="col-md-6 mt-4">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="file" id="multiupload" name="uploadFiledd[]" multiple accept=".jpg,.jpeg,.png" >
                                                <span id="uploadMessage"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" id="startUpload" class="btn btn-primary btn-sm">Upload</button>
                                            </div>
                                        </div>
                                    </div>                                     -->
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
    
    <script src="rber_condemned/function.js?d=<?=date('Ymdhis')?>"></script>
