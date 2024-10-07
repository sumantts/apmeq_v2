$('#asset_code').on('blur', function(){
    $asset_code = $('#asset_code').val();

    $('#asset_detail, #s_button_div').removeClass('d-block').show();
    $('#asset_detail, #s_button_div').addClass('d-none').hide();

    $.ajax({
        method: "POST",
        url: "call_log/function.php",
        data: { fn: "getAssetDetails", asset_code: $asset_code }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $html = '';
            $html += '<div class="col-md-12">';
            $html += '<span><strong>Date of installation:</strong> '+$res1.date_of_installation+'</span></br>';
            $html += '<span><strong>Supplied by:</strong> '+$res1.asset_supplied_by+'</span></br>';
            $html += '<span><strong>Total year in service:</strong> '+$res1.total_year_in_service+'</span></br>';
            $html += '<span><strong>Last date of calibration:</strong> '+$res1.last_date_of_calibration+'</span></br>';
            $html += '<span><strong>Frequency of calibration:</strong> '+$res1.frequency_of_calibration_y+'Year '+$res1.frequency_of_calibration_m+'Month '+$res1.frequency_of_calibration_d+'Day </span></br>';
            $html += '<span><strong>Last date of Preventive Maintanence(PMS):</strong> '+$res1.last_date_of_pms+'</span></br>';
            $html += '<span><strong>Frequency of Preventive Maintenence(PMS):</strong> '+$res1.frequency_of_pms_y+'Year '+$res1.frequency_of_pms_m+'Month '+$res1.frequency_of_pms_d+'Day </span></br>';
            $html += '<span><strong>(QA)Quality Certification due date:</strong> '+$res1.qa_due_date+'</span></br>';
            $html += '<span><strong>Warranty last date:</strong> '+$res1.warranty_last_date+'</span></br>';
            if($res1.amc_yes_no == 1){
                $html += '<span><strong>Last Date of AMC:</strong> '+$res1.amc_last_date+'</span></br>';
            }
            if($res1.cmc_yes_no == 1){
                $html += '<span><strong>Last Date of CMC:</strong> '+$res1.cmc_last_date+'</span></br>';
            }
            $html += '<span><strong>Service Provider Details(Contact Number, Email Id) (in Warranty/AMC/CMC):</strong> '+$res1.sp_details+'</span></br>';
            $html += '</div>';
            $('#asset_detail').html($html);
            
            $('#asset_detail, #s_button_div').removeClass('d-none').show();
            $('#asset_detail, #s_button_div').addClass('d-block').hide();
            
        }else{
            alert('Asset Code Does Not Match');
        }
    });//end ajax

})


$('#myForm').on('submit', function(){   
    console.log('save log data');
    
    $asset_code = $('#asset_code').val();
    $user_id = $('#user_id').val();
    $ticket_raiser_name = $('#ticket_raiser_name').val(); 
    $ticket_raiser_contact = $('#ticket_raiser_contact').val();
    $issue_description = $('#issue_description').val(); 

    $.ajax({
        method: "POST",
        url: "call_log/function.php",
        data: { fn: "saveFormData", asset_code: $asset_code, user_id: $user_id, ticket_raiser_name: $ticket_raiser_name, ticket_raiser_contact: $ticket_raiser_contact, issue_description: $issue_description }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){
            alert('Your Call Log Token ID: '+$res1.token_id);
            $('#orgFormAlert1').css("display", "block");            
            $('#myForm').trigger('reset'); 
            
            $('#asset_detail, #s_button_div').removeClass('d-block').show();
            $('#asset_detail, #s_button_div').addClass('d-none').hide();
        }else{
            alert($res1.error_message);
        }
    });//end ajax
    
    return false;
})  