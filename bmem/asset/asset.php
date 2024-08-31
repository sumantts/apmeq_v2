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
                         

                        <form class="needs-validation" novalidate>  
                        <div class="form-row">  
                                
                            <div class="col-md-4 mb-3">
                                <label for="author_status" class="text-danger">Facility name*</label>
                                <select class="form-control" name="author_status" id="author_status">
                                    <option value="0">Select</option>
                                    <option value="1">Facility 1</option>
                                    <option value="2">Facility 2</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide Biography.
                                </div>
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="author_status" class="text-danger">Department*</label>
                                <select class="form-control" name="author_status" id="author_status">
                                    <option value="0">Select</option>
                                    <option value="1">Department 1</option>
                                    <option value="2">Department 2</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please Select Department.
                                </div>
                            </div>
                                
                            <div class="col-md-4 mb-3">
                                <label for="email" class="text-danger">Equipment name*</label>
                                <input type="text" class="form-control" id="email" value=""> 
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide Equipment name.
                                </div>
                            </div>  
                                
                            <div class="col-md-4 mb-3">
                                <label for="registration_number">Make</label>
                                <input type="text" class="form-control" id="registration_number" value="">
                                <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide .
                                </div>
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="registration_number">Model</label>
                                <input type="text" class="form-control" id="registration_number" value="">
                                <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide .
                                </div>
                            </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Slerial number</label>
                                    <input type="text" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Specifiaction</label>
                                    <input type="text" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Date of installation</label>
                                    <input type="date" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <input type="file" accept="image/*" class="custom-file-input" id="author_photo" aria-describedby="author_photo"  onchange="savePhoto()">
                                    <label class="custom-file-label" for="validatedCustomFile">Installaion certificate attachment...</label>
                                    <small id="author_photoError" class="form-text text-danger"> </small>
                                    <img src="" id="image" width="100">
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Supplied by</label>
                                    <input type="text" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Value of the asset</label>
                                    <input type="text" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Total year in service</label>
                                    <input type="text" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div> 
                                
                                <div class="col-md-4 mb-3">
                                    <label for="author_status">Technology</label>
                                    <select class="form-control" name="author_status" id="author_status">
                                        <option value="0">Select</option>
                                        <option value="1">Obsolute</option>
                                        <option value="2">Running</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please Select Technology.
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="author_status">Asset status</label>
                                    <select class="form-control" name="author_status" id="author_status">
                                        <option value="0">Select</option>
                                        <option value="1">Working</option>
                                        <option value="2">Not Working</option>
                                        <option value="3">Not in Use</option>
                                        <option value="4">Packed</option>
                                        <option value="5">RBER</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please Select Technology.
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="author_status">Asset class</label>
                                    <select class="form-control" name="author_status" id="author_status">
                                        <option value="0">Select</option>
                                        <option value="1">Critical</option>
                                        <option value="2">Non Critical</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please Select Asset class.
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="author_status">Device group</label>
                                    <select class="form-control" name="author_status" id="author_status">
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
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please Select Technology.
                                    </div>
                                </div>    
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Last date of calibration</label>
                                    <input type="date" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <input type="file" accept="image/*" class="custom-file-input" id="author_photo" aria-describedby="author_photo"  onchange="savePhoto()">
                                    <label class="custom-file-label" for="validatedCustomFile">Attachment...</label>
                                    <small id="author_photoError" class="form-text text-danger"> </small>
                                    <img src="" id="image" width="100">
                                </div>      
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Frequency of calibration</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control" name="author_status" id="author_status">
                                                <option value="0">Month</option>
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="author_status" id="author_status">
                                                <option value="0">Day</option>
                                                <option value="1">Sunday</option>
                                                <option value="2">Monday</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Last date of Preventive Maintanence(PMS)</label>
                                    <input type="date" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <input type="file" accept="image/*" class="custom-file-input" id="author_photo" aria-describedby="author_photo"  onchange="savePhoto()">
                                    <label class="custom-file-label" for="validatedCustomFile">Attachment...</label>
                                    <small id="author_photoError" class="form-text text-danger"> </small>
                                    <img src="" id="image" width="100">
                                </div>     
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Frequency of Preventive Maintenence(PMS)</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control" name="author_status" id="author_status">
                                                <option value="0">Month</option>
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="author_status" id="author_status">
                                                <option value="0">Day</option>
                                                <option value="1">Sunday</option>
                                                <option value="2">Monday</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">(QA)Quality Certification due date</label>
                                    <input type="date" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div> 
                                
                                <div class="col-md-4 mb-2 mt-4">
                                    <input type="file" accept="image/*" class="custom-file-input" id="author_photo" aria-describedby="author_photo"  onchange="savePhoto()">
                                    <label class="custom-file-label" for="validatedCustomFile">Attachment...</label>
                                    <small id="author_photoError" class="form-text text-danger"> </small>
                                    <img src="" id="image" width="100">
                                </div>   
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Warranty last date</label>
                                    <input type="date" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div> 
                                
                                <div class="col-md-4 mb-3">
                                    <label for="author_status" >AMC</label>
                                    <select class="form-control" name="author_status" id="author_status">
                                        <option value="0">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">NO</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please Select Department.
                                    </div>
                                </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Last Date of AMC</label>
                                    <input type="date" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div> 
                                
                                <div class="col-md-4 mb-3">
                                    <label for="author_status">CMC</label>
                                    <select class="form-control" name="author_status" id="author_status">
                                        <option value="0">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">NO</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please Select Department.
                                    </div>
                                </div>  
                                
                                <div class="col-md-4 mb-3">
                                    <label for="registration_number">Last Date of CMC</label>
                                    <input type="date" class="form-control" id="registration_number" value="">
                                    <!-- <textarea class="form-control" id="author_bio" value="" ></textarea> -->
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div>  
                                
                                <div class="col-md-12 mb-3">
                                    <label for="registration_number">Service Provider Details(Contact Number, Email Id) (in Warranty/AMC/CMC)</label>
                                    <!-- <input type="date" class="form-control" id="registration_number" value=""> -->
                                    <textarea class="form-control" id="author_bio" value="" ></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide .
                                    </div>
                                </div> 
                            </div>

                            <div class="form-row">                                 
                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-dark" type="button" id="submitForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Cancel</span>
                                    </button>
                                </div>     

                                <div class="col-md-4 mt-4">
                                    <button class="btn  btn-primary" type="button" id="submitForm">
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

            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
	<?php include('common/footer.php'); ?>
    
    <script src="asset/function.js?d=<?=date('Ymdhis')?>"></script>