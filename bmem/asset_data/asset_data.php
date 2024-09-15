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
                        <!-- <button type="button" class="btn btn-primary mb-2 float-right" id="onMyModal">Add New</button> -->

                        <a href="?p=asset-facility-details&gr=setup"><i class="fa fa-arrow-left" ></i> Back</a>
                        <hr>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Facility name</th>
                                        <th>Facility code</th>
                                        <th>RBER status<br>(RBER/Condemned)</th>
                                        <th>Equipment name</th>
                                        <th>Equipment code/Id</th>
                                        <th>Maintanence Type<br>(i.e. under warranty/AMC/CMC/No <br>information etc)</th>
                                        <th>Technology<br>(i.e obsolute/running)</th>
                                        <th>Asset status<br>(Working/not working/<br>not in use/packed/RBER)</th>
                                        <th>Verified(Yes/No)</th>
                                        <th>Asset class<br>(i.e Critical/non critical)</th>  
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Facility name</th>
                                        <th>Facility code</th>
                                        <th>RBER status<br>(RBER/Condemned)</th>
                                        <th>Equipment name</th>
                                        <th>Equipment code/Id</th>
                                        <th>Maintanence Type<br>(i.e. under warranty/AMC/CMC/No <br>information etc)</th>
                                        <th>Technology<br>(i.e obsolute/running)</th>
                                        <th>Asset status<br>(Working/not working/<br>not in use/packed/RBER)</th>
                                        <th>Verified(Yes/No)</th>
                                        <th>Asset class<br>(i.e Critical/non critical)</th>  
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
                                     

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="facility_id" value="<?=$_GET['facility_id']?>">
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
    
    <script src="asset_data/function.js?d=<?=date('Ymdhis')?>"></script>