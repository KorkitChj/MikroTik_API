<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <ul class="nav navbar-nav ml-auto">
        <div id="DATE"></div>
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