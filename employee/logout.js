$(".logout").click(function() {
    swal({
            title: "ออกจากระบบ?",
            text: "คุณกำลังจะออกจากระบบ!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                swal("ออกจากระบบ!", "ออกจากระบบเสร็จสิ้น!", "success");
                window.location.href = "emp_logout.php";
            } else {
                swal("ยกเลิก", "ยกเลิกออกจากระบบ :)", "error");
                e.preventDefault();
            }
        });
});
