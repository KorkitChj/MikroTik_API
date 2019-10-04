var managemember;
$(document).ready(function () {
    managemember = $("#managemember").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[1, "desc"]],
        "ajax": {
            url: "../admin/manage_retrieve.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 5, 6],
            "orderable": false,
        }],
    });
});
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayBtn: true,
    language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    thaiyear: true              //Set เป็นปี พ.ศ.
}).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน

function datepicker(){
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var start_date = moment(start_date, 'DD/MM/YYYY', true).format();
    var end_date = moment(end_date, 'DD/MM/YYYY', true).format();
    if(start_date != '' && end_date != ''){
       window.location.href = "printcsv.php?start_date="+start_date+"&end_date="+end_date
    }
}
function removeMember(id) {
    if (id) {
        $("#removeBtn").off('click').on('click', function () {
            $.ajax({
                url: '../admin/admin_del.php',
                type: 'post',
                data: {
                    cus_id: id
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        managemember.ajax.reload(null, false);
                        $("#removeMemberModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        });
    } else {
        alert('Error: Refresh the page again');
    }
}
$('#checkall').click(function () {
    $('.checkitem').prop("checked", $(this).prop("checked"))
})
$('#removeAllBtn').click(function () {
    var cus_id = [];
    $('.checkitem:checked').each(function (i) {
        cus_id[i] = $(this).val();
    });
    if (cus_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../admin/admin_del_check.php',
            method: 'POST',
            data: {
                cus_id: cus_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    managemember.ajax.reload(null, false);
                    $("#removeAllMemberModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});