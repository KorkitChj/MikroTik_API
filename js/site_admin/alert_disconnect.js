alert_disconnect();
setInterval(function() {
    alert_disconnect();
}, 2000);
function alert_disconnect() {
    $.ajax({
        url: "../process/site_admin_router/alert_disconnect_process.php",
        method: "POST",
        dataType: "json",
        success: function(data) {
            if(data.disconnect == true){
                $("#disconnect").html('<button type=" button"  class="btn btn-sm btn-danger">Disconnect</button>&nbsp;<button type=" button" class="btn btn-sm btn-warning" onclick="window.location.href=\'dashboard.php\'"><img src="../img/refresh.png" width="20" title="Refresh"><i class="glyphicon glyphicon-remove"></i>&nbsp;Reconnect</button>');
            }else{
                $("#disconnect").html('<button type=" button"  class="btn btn-sm btn-success"><i class="glyphicon glyphicon-ok"></i>&nbsp;Connect</button>');
                $("#cpu-load").html('<h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>'+data.cpuload+'</span></h2>');
                $("#uptime").html('<h2 class="text-right"><i class="fab fa-cloudversify f-left"></i><span>'+data.uptime+'</span></h2>');
            }
        }
    });
}
