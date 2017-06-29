
//file tree function
$(document).ready( function() {
    $('#chooseFile').fileTree({
        root: '/',
        script: '../connectors/jqueryFileTree.php'
    }, function(file) {
        $("input[name='filename']").val(file);
    });
    $("form").submit(function(e){
        if($("input[name='filename']").val() == ""){
            alert("please choose a file");
            return false;
        } else {
            if($(this).attr("name", "clipsForm")) {
                var start_hh = format_number($("input[name=start_hour]").val());
                var start_mm = format_number($("input[name=start_minute]").val());
                var start_ss = format_number($("input[name=start_second]").val());
                var end_hh = format_number($("input[name=end_hour]").val());
                var end_mm = format_number($("input[name=end_minute]").val());
                var end_ss = format_number($("input[name=end_second]").val());
                if((start_hh < end_hh)||((start_hh == end_hh) && (start_mm < end_mm))||((start_hh == end_hh) && (start_mm == end_mm) && (start_ss <= end_ss))) {
                    return true;
                } else {
                    alert("开始时间应早于结束时间");
                    return false;
                }
            } else {
                return true;
            }
        }
    });
});
