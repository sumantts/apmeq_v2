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
                                    <label for="category_id" class="text-danger">Facilities*</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="0">Select</option> 
                                        <option value="0">Facility 1</option> 
                                        <option value="0">Facility 2</option> 
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please select Department.
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
                         

                        <form class="needs-validation" novalidate>  
                        <div class="form-row">                                
                            <div class="col-md-4 mb-3">
                                <label for="author_name" class="text-danger">Facility name*</label>
                                <input type="text" class="form-control" id="author_name" value="" required >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide Facility name.
                                </div>
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="author_status" class="text-danger">Facility Type*</label>
                                <select class="form-control" name="author_status" id="author_status">
                                    <option value="0">Select</option>
                                    <option value="1">Hospital</option>
                                    <option value="2">Lab</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide Biography.
                                </div>
                            </div> 
                                
                            <div class="col-md-4 mb-3">
                                <label for="email" class="text-danger">Facility code*</label>
                                <input type="text" class="form-control" id="email" value=""> 
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide Facility code.
                                </div>
                            </div>  
                                
                            <div class="col-md-12 mb-3">
                                <label for="registration_number" class="text-danger">Facility Address*</label>
                                <!-- <input type="text" class="form-control" id="registration_number" value=""> -->
                                <textarea class="form-control" id="author_bio" value="" ></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please provide Facility address.
                                </div>
                            </div>
                                
                            <div class="col-md-4 mb-3">
                                <label for="author_status" class="text-danger">NABH Accredited*</label>
                                <select class="form-control" name="author_status" id="author_status">
                                    <option value="0">Select</option>
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
                                <label for="author_status" class="text-danger">NABL Accredited*</label>
                                <select class="form-control" name="author_status" id="author_status">
                                    <option value="0">Select</option>
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
                                <label for="author_status" class="text-danger">Hospital*</label>
                                <select class="form-control" name="author_status" id="author_status">
                                    <option value="0">Select</option>
                                    <option value="1">Hospital 1</option>
                                    <option value="2">Hospital 2</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>                                    
                                <div class="invalid-feedback">
                                    Please Select Hospital.
                                </div>
                            </div>
                                
                                <!-- <div class="col-md-4 mb-2 mt-4">
                                    <input type="file" accept="image/*" class="custom-file-input" id="author_photo" aria-describedby="author_photo"  onchange="savePhoto()">
                                    <label class="custom-file-label" for="validatedCustomFile">Choose image...</label>
                                    <small id="author_photoError" class="form-text text-danger"> </small>
                                    <img src="" id="image" width="100">
                                </div>  -->

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
                            <form class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="category_id" class="text-danger">Department*</label>
                                        <select class="form-control" name="category_id" id="category_id">
                                            <option value="0">Select</option> 
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select Department.
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="for_the_year" class="text-danger">For the Year*</label>
                                        <select class="form-control" name="for_the_year" id="for_the_year">
                                            <?php
                                            for($i = 0; $i < sizeof($forTheYearsArr); $i++){
                                            ?>
                                            <option value="<?=$forTheYearsArr[$i]->value?>"><?=$forTheYearsArr[$i]->text?></option> 
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select Department.
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-4 mb-3">
                                        <label for="course_id" class="text-danger">Course*</label>
                                        <select class="form-control" name="course_id" id="course_id">
                                            <option value="0">Select</option> 
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select Course.
                                        </div>
                                    </div> -->
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="author_name" class="text-danger">Student Name*</label>
                                        <input type="text" class="form-control" id="author_name" value="" required >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Name.
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="email" class="text-danger">Primary Email*</label>
                                        <input type="text" class="form-control" id="email" value="">
                                        <!-- <textarea class="form-control" id="author_bio" value="" required style="min-height:300px;"></textarea> -->
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Primary Email.
                                        </div>
                                    </div>  
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="registration_number" class="text-danger">Registration Number*</label>
                                        <input type="text" class="form-control" id="registration_number" value="">
                                        <!-- <textarea class="form-control" id="author_bio" value="" required style="min-height:300px;"></textarea> -->
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Registration Number.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-2 mt-4">
                                        <input type="file" accept="image/*" class="custom-file-input" id="author_photo" aria-describedby="author_photo"  onchange="savePhoto()">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose image...</label>
                                        <small id="author_photoError" class="form-text text-danger"> </small>
                                        <img src="" id="image" width="100">
                                    </div> 
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="author_status" class="text-danger">Activity Status*</label>
                                        <select class="form-control" name="author_status" id="author_status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Biography.
                                        </div>
                                    </div> 

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="author_id" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            <button class="btn  btn-primary" type="button" id="submitForm">
                                <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                <span class="btn-text" id="submitForm_text">Save Changes</span>
                            </button>
                        </div>
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
    
    <script src="user_facility/function.js?d=<?=date('Ymdhis')?>"></script>