<?php if ($CURRENT_PAGE == "dashboard") {
    $page = "dashboard.php";
} else if ($CURRENT_PAGE == "interface") {
    $page = "interfacemonitor.php";
} else if ($CURRENT_PAGE == "employee") {
    $page = "employeestatus.php";
} else if ($CURRENT_PAGE == "employeeactive") {
    $page = "employeeactive.php";
} else if ($CURRENT_PAGE == "serverprofile") {
    $page = "addserverprofile.php";
} else if ($CURRENT_PAGE == "hotspotprofile") {
    $page = "profilestatus.php";
} else if ($CURRENT_PAGE == "wallgarden") {
    $page = "wallgardenstatus.php";
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <ul class="nav navbar-nav ml-auto">
        <div id="DATE"></div>&nbsp;&nbsp;
        <div id="disconnect"></div>&nbsp;&nbsp;
        <button type=" button" class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo $page ?>'"><img src="../img/refresh.png" width="20" title="Refresh">&nbsp;Reconnect</button>
    </ul>
</nav>
<script>
    $(document).ready(function() {
        var months = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหายน", "กันยนยน", "ตุลาคม", "พฤษจิกายน", "ธันวาคม"];
        var days = ["วันอาทิตย์", "วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัสบดี", "วันศุกร์", "วันเสาร์"];

        var d = new Date();
        var day = days[d.getDay()];
        var hr = d.getHours();
        var min = d.getMinutes();
        if (min < 10) {
            min = "0" + min;
        }
        var date = d.getDate();
        var month = months[d.getMonth()];
        var year = d.getFullYear();
        var x = document.getElementById("DATE");
        x.innerHTML = day + " " + date + " " + month + " " + (year + 543) + " " + hr + ":" + min;
    });
</script>
<script src="../js/site_admin/alert_disconnect.js"></script>