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
                        <h5>Search your Facility</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right"> 
                                </ul>
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
                         

                        <form class="needs-validation" novalidate>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="facility_id_dd" class="text-danger">Facilities*</label>
                                    <select class="form-control" name="facility_id_dd" id="facility_id_dd" >
                                        <option value="">Select</option>  
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please select Department.
                                    </div>
                                </div>

                                <div class="col-md-4 mt-4">
                                    <button class="btn  btn-primary" type="button" id="getFacility">
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
                        <h5>Add User/facility</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right"> 
                                </ul>
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
                         

                        <form name="myForm" id="myForm" method="POST" action="#" >  
                        <div class="form-row">                                
                            <div class="col-md-4 mb-3">
                                <label for="facility_name" class="text-danger">Facility name*</label>
                                <input type="text" class="form-control" id="facility_name" value="" required >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide Facility name.
                                </div>
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="facility_type" class="text-danger">Facility Type*</label>
                                <select class="form-control js-example-basic-single" name="facility_type" id="facility_type" required>
                                    <option value="">Select</option>
                                    <option value="1">Hospital</option>
                                    <option value="2">Lab</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please select Facility Type.
                                </div>
                            </div> 
                            
                                
                            <div class="col-md-4 mb-3">
                                <label for="contact_person" class="text-danger">Contact Person(Phone)*</label>
                                <input type="text" class="form-control" name="contact_person" id="contact_person" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please Select Hospital.
                                </div>
                            </div>   
                                
                            <div class="col-md-12 mb-3">
                                <label for="facility_address" class="text-danger">Facility Address*</label>
                                <!-- <input type="text" class="form-control" id="registration_number" value=""> -->
                                <textarea class="form-control" id="facility_address" value="" required></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide Facility address.
                                </div>
                            </div>
                                
                            <div class="col-md-4 mb-3">
                                <label for="nabh_accrediated" class="text-danger">NABH Accredited*</label>
                                <select class="form-control js-example-basic-single" name="nabh_accrediated" id="nabh_accrediated" required>
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please Select NABH Accredited.
                                </div>
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="nabl_accrediated" class="text-danger">NABL Accredited*</label>
                                <select class="form-control js-example-basic-single" name="nabl_accrediated" id="nabl_accrediated" required>
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please Select NABL Accredited.
                                </div>
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="department_id" class="text-danger">Department*</label>
                                <select class="form-control js-example-basic-single" name="department_id" id="department_id" required multiple>
                                    <option value="">Select</option> 
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please Select Department.
                                </div>
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="facility_code">Facility code</label>
                                <input type="text" class="form-control" id="facility_code" value="" readonly> 
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide Facility code.
                                </div>
                            </div>

                            </div>

                            <div class="form-row">                               
                                <div class="col-md-2 mt-4">
                                    <input type="hidden" name="facility_id" id="facility_id">
                                    <!-- <input type="submit" class="btn  btn-primary" name="submitForm" id="submitForm" value="Save Changes"> -->

                                    <button class="btn  btn-primary" type="submit" id="submitForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Save Changes</span>
                                    </button>
                                </div>                                 
                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-dark" type="button" id="cancelForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Cancel</span>
                                    </button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Form --> 

            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
	<?php include('common/footer.php'); ?>
    
    <script src="user_facility/function.js?d=<?=date('Ymdhis')?>"></script>