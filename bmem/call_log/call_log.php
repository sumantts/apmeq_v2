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
                        <h5>Register a Log </h5> 
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
                         

                        <form class="needs-validation" action="#" id="myForm">
                            <div class="form-row">    

                                <div class="col-md-3 mb-3">
                                      <label for="qr_code">Scan QR Code</label></br>
                                   <!--<input type="text" class="form-control" id="qr_code"> 
                                    <textarea class="form-control" id="multiple"></textarea> -->
                                    <button class="qrcode-reader btn  btn-primary" type="button" id="openreader-multi" 
                                        data-qrr-multiple="true" 
                                        data-qrr-repeat-timeout="0"
                                        data-qrr-line-color="#00FF00"
                                        data-qrr-target="#asset_code">Read QRCode</button> 
                                </div>      

                                <div class="col-md-3 mb-3">
                                    <label for="asset_code" class="text-danger">Asset Code*</label>
                                    <input type="text" class="form-control" id="asset_code" required> 

                                    <span class="d-none text-danger" id="asset_error_span">Asset Code Does Not Match / You have no access on it</span>
                                </div>   

                                <div class="col-md-3 mb-3">
                                    <label for="ticket_raiser_name">Ticket Raiser Name</label>
                                    <input type="hidden" name="facility_id" id="facility_id" value="0">
                                    <input type="hidden" name="user_id" id="user_id" value="<?=$_SESSION["user_id"]?>" >
                                    <input type="text" class="form-control" id="ticket_raiser_name" value="<?=$_SESSION["user_name"]?>" required > 

                                    
                                    <input type="hidden" name="amc_yes_no" id="amc_yes_no" value="">
                                    <input type="hidden" name="amc_last_date" id="amc_last_date" value="">
                                    <input type="hidden" name="cmc_yes_no" id="cmc_yes_no" value="">
                                    <input type="hidden" name="cmc_last_date" id="cmc_last_date" value="">
                                </div>  

                                <div class="col-md-3 mb-3">
                                    <label for="ticket_raiser_contact">Ticket Raiser Contact Number</label>
                                    <input type="number" class="form-control" id="ticket_raiser_contact" value="<?=$_SESSION["user_mobile"]?>" required > 
                                </div>     

                                <div class="col-md-12 mb-3">
                                    <label for="issue_description" class="text-danger">Issue Description*</label>
                                    <textarea class="form-control" id="issue_description" required></textarea>
                                </div> 
                            </div>  

                            <div class="row d-none" id="asset_detail"> </div>

                            <div class="form-row d-none" id="s_button_div">
                                <div class="col-md-2 mt-4">
                                    <button class="btn btn-primary" type="submit" id="submitForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Log a Call</span>
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
    
    <script src="call_log/function.js?d=<?=date('Ymdhis')?>"></script>
    
    <!-- QR Code Scanner Start -->
    <script src="qrcode_reader/dist/js/qrcode-reader.min.js?v=20190604"></script>

    <script>  
    $(function(){
        // overriding path of JS script and audio 
        $.qrCodeReader.jsQRpath = "qrcode_reader/dist/js/jsQR/jsQR.min.js";
        $.qrCodeReader.beepPath = "qrcode_reader/dist/audio/beep.mp3";

        // bind all elements of a given class
        $(".qrcode-reader").qrCodeReader();

        // bind elements by ID with specific options
        $("#openreader-multi2").qrCodeReader({multiple: true, target: "#multiple2", skipDuplicates: false});
        $("#openreader-multi3").qrCodeReader({multiple: true, target: "#multiple3"});

        // read or follow qrcode depending on the content of the target input
        $("#openreader-single2").qrCodeReader({callback: function(code) {
        if (code) {
            window.location.href = code;
        }  
        }}).off("click.qrCodeReader").on("click", function(){
        var qrcode = $("#single2").val().trim();
        if (qrcode) {
            window.location.href = qrcode;
        } else {
            $.qrCodeReader.instance.open.call(this);
        }
        });
    });
    </script>
    <!-- QR Code Scanner End -->