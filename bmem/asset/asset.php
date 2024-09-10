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
            <!-- [ sample-table ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Filter Assets</h5> 
                    </div>
                    <div class="card-body">                        

                        <form class="needs-validation" novalidate>
                            <div class="form-row">                               
                                <div class="col-md-4 mb-3">
                                    <label for="author_name">Facility Name</label>
                                    <input type="text" class="form-control" id="author_name" value="" required >
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide Facility Name.
                                    </div>
                                </div>  

                                <div class="col-md-4 mb-3">
                                    <label for="author_name">Facility Code</label>
                                    <input type="text" class="form-control" id="author_name" value="" required >
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide Facility Code.
                                    </div>
                                </div>   

                                <div class="col-md-4 mb-3">
                                    <label for="author_name">Asset code</label>
                                    <input type="text" class="form-control" id="author_name" value="" required >
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide Asset code.
                                    </div>
                                </div> 

                                <div class="col-md-4 mt-4">
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
                        <h5>Add/update Asset </h5> 
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

                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert">
							<strong>Success!</strong> Your Data Deleted successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert1">
							<strong>Success!</strong> Your Data saved successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                         

                        <form method="POST" action="#" id="myForm">  
                        <div class="form-row">                                  
                            <div class="col-md-4 mb-3">
                                <label for="facility_id_dd" class="text-danger">Facility name*</label>
                                <select class="form-control js-example-basic-single" name="facility_id_dd" id="facility_id_dd" required>
                                    <option value="">Select</option> 
                                </select> 
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="department_id" class="text-danger">Department*</label>
                                <select class="form-control js-example-basic-single" name="department_id" id="department_id" required>
                                    <option value="">Select</option> 
                                </select> 
                            </div>
                                
                            <div class="col-md-4 mb-3">
                                <label for="equipment_name" class="text-danger">Equipment name*</label>
                                <input type="text" class="form-control" id="equipment_name" value="" required> 
                            </div>  
                                
                            <div class="col-md-4 mb-3">
                                <label for="asset_make">Make</label>
                                <input type="text" class="form-control" id="asset_make" value=""> 
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="asset_model">Model</label>
                                <input type="text" class="form-control" id="asset_model" value=""> 
                            </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="slerial_number">Slerial number</label>
                                    <input type="text" class="form-control" id="slerial_number" value=""> 
                                </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="asset_specifiaction">Specifiaction</label>
                                    <input type="text" class="form-control" id="asset_specifiaction" value=""> 
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="date_of_installation">Date of installation</label>
                                    <input type="date" class="form-control" id="date_of_installation" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <label for="date_of_installation">Installaion certificate attachment</label>
                                    <a href="javascript: void(0)" id="ins_cert_attach">Upload & View Certificate</a>
                                    <!-- <input type="file" accept="image/*" class="custom-file-input" id="ins_certificate" aria-describedby="ins_certificate" >
                                    <label class="custom-file-label" for="ins_certificate">Installaion certificate attachment...</label>  -->
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="asset_supplied_by">Supplied by</label>
                                    <input type="text" class="form-control" id="asset_supplied_by" value=""> 
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="value_of_the_asset">Value of the asset</label>
                                    <input type="text" class="form-control" id="value_of_the_asset" value=""> 
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="total_year_in_service">Total year in service</label>
                                    <input type="text" class="form-control" id="total_year_in_service" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-3">
                                    <label for="technology" class="text-danger">Technology*</label>
                                    <select class="form-control js-example-basic-single" name="technology" id="technology" required>
                                        <option value="">Select</option>
                                        <option value="1">Obsolute</option>
                                        <option value="2">Running</option>
                                    </select> 
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="asset_status" class="text-danger">Asset status*</label>
                                    <select class="form-control js-example-basic-single" name="asset_status" id="asset_status" required>
                                        <option value="">Select</option>
                                        <option value="1">Working</option>
                                        <option value="2">Not Working</option>
                                        <option value="3">Not in Use</option>
                                        <option value="4">Packed</option>
                                        <option value="5">RBER</option>
                                    </select> 
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="asset_class" class="text-danger">Asset class*</label>
                                    <select class="form-control js-example-basic-single" name="asset_class" id="asset_class" required>
                                        <option value="">Select</option>
                                        <option value="1">Critical</option>
                                        <option value="2">Non Critical</option>
                                    </select> 
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="device_group" class="text-danger">Device group*</label>
                                    <select class="form-control js-example-basic-single" name="device_group" id="device_group" required>
                                        <option value="">Select</option>
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
                                
                                <div class="col-md-4 mb-3">
                                    <label for="last_date_of_calibration">Last date of calibration</label>
                                    <input type="date" class="form-control" id="last_date_of_calibration" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <input type="file" accept="image/*" class="custom-file-input" id="calibration_attachment" aria-describedby="calibration_attachment">
                                    <label class="custom-file-label" for="calibration_attachment">Attachment...</label> 
                                </div>      
                                
                                <div class="col-md-4 mb-3">
                                    <label for="frequency_of_calibration">Frequency of calibration</label>
                                    <input type="hidden" name="frequency_of_calibration" id="frequency_of_calibration" value="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control js-example-basic-single" name="frequency_of_calibration_m" id="frequency_of_calibration_m">
                                                <?php if(sizeof($month_name) > 0){
                                                    for($m = 0; $m < sizeof($month_name); $m++){ ?>
                                                <option value="<?=$month_name[$m]->value?>"><?=$month_name[$m]->text?></option>
                                                <?php } }?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control js-example-basic-single" name="frequency_of_calibration_d" id="frequency_of_calibration_d">
                                                <?php if(sizeof($week_days) > 0){
                                                    for($w1 = 0; $w1 < sizeof($week_days); $w1++){ ?>
                                                <option value="<?=$week_days[$w1]->value?>"><?=$week_days[$w1]->text?></option>
                                                <?php } }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="last_date_of_pms">Last date of Preventive Maintanence(PMS)</label>
                                    <input type="date" class="form-control" id="last_date_of_pms" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <input type="file" accept="image/*" class="custom-file-input" id="pms_attachment" aria-describedby="pms_attachment" >
                                    <label class="custom-file-label" for="pms_attachment">Attachment...</label> 
                                </div>     
                                
                                <div class="col-md-4 mb-3">
                                    <label for="frequency_of_pms">Frequency of Preventive Maintenence(PMS)</label>
                                    <input type="hidden" name="frequency_of_pms" id="frequency_of_pms" value="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control js-example-basic-single" name="frequency_of_pms_m" id="frequency_of_pms_m">
                                                <?php if(sizeof($month_name) > 0){
                                                    for($m1 = 0; $m1 < sizeof($month_name); $m1++){ ?>
                                                <option value="<?=$month_name[$m1]->value?>"><?=$month_name[$m1]->text?></option>
                                                <?php } }?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control js-example-basic-single" name="frequency_of_pms_d" id="frequency_of_pms_d">
                                                <?php if(sizeof($week_days) > 0){
                                                    for($w = 0; $w < sizeof($week_days); $w++){ ?>
                                                <option value="<?=$week_days[$w]->value?>"><?=$week_days[$w]->text?></option>
                                                <?php } }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="qa_due_date">(QA)Quality Certification due date</label>
                                    <input type="date" class="form-control" id="qa_due_date" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <input type="file" accept="image/*" class="custom-file-input" id="qa_attachment" aria-describedby="qa_attachment" >
                                    <label class="custom-file-label" for="qa_attachment">Attachment...</label> 
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="warranty_last_date">Warranty last date</label>
                                    <input type="date" class="form-control" id="warranty_last_date" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-3">
                                    <label for="amc_yes_no" >AMC</label>
                                    <select class="form-control js-example-basic-single" name="amc_yes_no" id="amc_yes_no">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">NO</option>
                                    </select> 
                                </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="amc_last_date">Last Date of AMC</label>
                                    <input type="date" class="form-control" id="amc_last_date" value=""> 
                                </div> 
                                
                                <div class="col-md-4 mb-3">
                                    <label for="cmc_yes_no">CMC</label>
                                    <select class="form-control js-example-basic-single" name="cmc_yes_no" id="cmc_yes_no">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">NO</option>
                                    </select> 
                                </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="cmc_last_date">Last Date of CMC</label>
                                    <input type="date" class="form-control" id="cmc_last_date" value=""> 
                                </div>  
                                
                                <div class="col-md-12 mb-3">
                                    <label for="sp_details">Service Provider Details(Contact Number, Email Id) (in Warranty/AMC/CMC)</label> 
                                    <textarea class="form-control" id="sp_details" value="" ></textarea> 
                                </div> 
                            </div>

                            <div class="form-row">                                 
                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-dark" type="button" id="clearForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Cancel</span>
                                    </button>
                                </div>     

                                <div class="col-md-4 mt-4">
                                    <input type="hidden" name="asset_id" id="asset_id" value="">
                                    <button class="btn  btn-primary" type="submit" id="submitForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Save</span>
                                    </button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Form --> 


            <!-- Modal start -->
            <div id="exampleModalLong" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><?=$title?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="POST" id="myFormModal">
                                <div class="form-row">                                    
                                    <div class="col-md-3 mt-4">
                                        <input type="file" id="multiupload" name="uploadFiledd[]" multiple accept=".jpg,.jpeg,.png" >
                                        <span id="uploadMessage"></span>
                                    </div> 

                                    <div class="col-md-1 mt-4"> 
                                        <button type="button" id="startUpload" class="btn btn-primary btn-sm">Upload</button>
                                    </div> 
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" id="user_id" value="0">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                                <!-- <button class="btn  btn-primary" type="submit" id="submitForm">
                                    <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                    <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                    <span class="btn-text" id="submitForm_text">Save</span>
                                </button> -->
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
    
    <script src="asset/function.js?d=<?=date('Ymdhis')?>"></script>