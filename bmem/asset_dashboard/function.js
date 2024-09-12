
//Course
function calculateAssetValue(){
    $.ajax({
        method: "POST",
        url: "asset_dashboard/function.php",
        data: { fn: "calculateAssetValue" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){ 
            $('#tot_aset').html('Total Asset: ' + $res1.total_asset_count); 
            $('#tot_aset_val').html('Total Asset Value: &#x20B9;' + $res1.sub_total_value_of_the_asset); 
        }        
    });//end ajax
}//end

$(document).ready(function () {
    calculateAssetValue()
});