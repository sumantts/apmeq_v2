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
                        <h5>Reallocated Asset Details </h5>
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
                                        <th>Facility Name</th>
                                        <th>Facility Code</th>
                                        <th>Total Reallocation </th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Facility Name</th>
                                        <th>Facility Code</th>
                                        <th>Total Reallocation </th> 
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
                        <h5>Filter Reallocated Asseta </h5> 
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
                                    <label for="author_name">Facility code</label>
                                    <input type="text" class="form-control" id="author_name"> 
                                </div>   

                                <div class="col-md-2 mt-4">
                                    <button class="btn  btn-primary" type="button" id="submitForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Search</span>
                                    </button>
                                </div>  

                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-dark" type="button" id="submitForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Clear</span>
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
                        <!-- <button type="button" class="btn btn-primary mb-2 float-right" id="generateLink">Generate Link <i class="fa fa-external-link" aria-hidden="true"></i></button>                         -->
                        <div class="table-responsive">
                            <table id="example_1" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th> 
                                        <th>Facility Name</th>
                                        <th>Facility Code</th>
                                        <th>Parent Department</th>
                                        <th>Reallocated Department</th>
                                        <th>All asset related details</th> 
                                        <th>Date</th>
                                        <th>Status<br>(i.e Shifted to parent depratment)</th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Facility Name</th>
                                        <th>Facility Code</th>
                                        <th>Parent Department</th>
                                        <th>Reallocated Department</th>
                                        <th>All asset related details</th> 
                                        <th>Date</th>
                                        <th>Status<br>(i.e Shifted to parent depratment)</th>
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
                        <h5>Initiate Reallocation</h5> 
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
                                    <label for="author_name" class="text-danger">Facility Name*</label>
                                    <select class="form-control" id="author_name">
                                        <option value="0">Select</option>
                                        <option value="1">Facility 1</option>
                                        <option value="2">Facility 2</option>
                                    </select> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Facility code</label>
                                    <input type="text" class="form-control" id="author_name"> 
                                </div>   

                                <div class="col-md-3 mb-3">
                                    <label for="author_name" class="text-danger">Department*</label>
                                    <select class="form-control" id="author_name">
                                        <option value="0">Select</option>
                                        <option value="1">Department 1</option>
                                        <option value="2">Department 2</option>
                                    </select> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="author_name" class="text-danger">Aseet Name*</label>
                                    <select class="form-control" id="author_name">
                                        <option value="0">Select</option>
                                        <option value="1">Aseet 1</option>
                                        <option value="2">Aseet 2</option>
                                    </select> 
                                </div>     

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Aseet code</label>
                                    <input type="text" class="form-control" id="author_name"> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="author_name" class="text-danger">Reallocated to Department*</label>
                                    <select class="form-control" id="author_name">
                                        <option value="0">Select</option>
                                        <option value="1">Department 1</option>
                                        <option value="2">Department 2</option>
                                    </select> 
                                </div>    

                                <div class="col-md-3 mb-3">
                                    <label for="author_name">Relocate Date</label>
                                    <input type="date" class="form-control" id="author_name"> 
                                </div>
                            </div>  

                            <div class="form-row">
                                <div class="col-md-2 mt-4">
                                    <button class="btn  btn-primary" type="button" id="submitForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Initiate</span>
                                    </button>
                                </div> 
                            </div>
                        </form>
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
    
    <script src="reallocated_asset_details/function.js?d=<?=date('Ymdhis')?>"></script>