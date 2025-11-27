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
                                    <label for="FacilityCode">Facility Code</label>
                                    <input type="text" class="form-control form-control-sm" id="facility_code_s" name="facility_code_s"> 
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="department_id">Department</label>
                                    <select class="form-control js-example-basic-single" id="department_id" name="department_id">
                                        <option value="0">Select</option> 
                                    </select> 
                                </div>      

                                <div class="col-md-3 mb-3">
                                    <label for="EquipmentName">Equipment name</label>
                                    <input type="text" class="form-control form-control-sm" id="equipment_name_s" name="equipment_name_s"> 
                                </div>       

                                <div class="col-md-3 mb-3">
                                    <label for="Assetcode">Asset code</label>
                                    <input type="text" class="form-control form-control-sm" id="asset_code_s" name="asset_code_s"> 
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="device_group_s">Device Group</label>
                                    <select class="form-control js-example-basic-single" id="device_group" name="device_group">
                                        <option value="0">Select</option> 
                                    </select> 
                                </div>  

                                <div class="col-md-3 mb-3">
                                    <label for="asset_class">Asset Class</label>
                                    <select class="form-control js-example-basic-single" id="asset_class" name="asset_class">
                                        <option value="0">Select</option>
                                        <option value="1">critical</option>
                                        <option value="2">Non Critical</option>
                                    </select> 
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
                                        <label for="condemned_date" class="text-danger">Dated*</label>
                                        <input type="date" class="form-control" id="condemned_date" value=""> 
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="call_log_statusM" class="text-danger">Call Log Status*</label>
                                        <select class="form-control" name="call_log_statusM" id="call_log_statusM" required> 
                                            <option value="-1">Select</option>
                                            <option value="1">Reject</option>
                                            <option value="5">Condemned</option> 
                                        </select> 
                                    </div>                                   
                                    <div class="col-md-4 mt-4">
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
    
    <script src="rber_condemned/function.js?d=<?=date('Ymdhis')?>"></script>
