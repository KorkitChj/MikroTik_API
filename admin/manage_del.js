var managemember;
$(document).ready(function () {
    managemember = $("#managemember").DataTable({
        "order": [],
        "ajax": {
            url: "manage_retrieve.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 6],
            "orderable": false,
        }],
    });
});
function removeMember(id = null) {
    if (id) {
        // click on remove button
        $("#removeBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: 'admin_del.php',
                type: 'post',
                data: {
                    cus_id: id
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        // refresh the table
                        managemember.ajax.reload(null, false);
                        // close the modal
                        $("#removeMemberModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        }); // click remove btn
    } else {
        alert('Error: Refresh the page again');
    }
}
$('#checkall').click(function(){
    $('.checkitem').prop("checked", $(this).prop("checked"))
})
$('#removeAllBtn').click(function () {
    var cus_id = [];
    $('.checkitem:checked').each(function (i) {
        cus_id[i] = $(this).val();
    });
    if (cus_id.length === 0) //tell you if the array is empty
    {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: 'admin_del_check.php',
            method: 'POST',
            data: {
                cus_id: cus_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    // refresh the table
                    managemember.ajax.reload(null, false);
                    // close the modal
                    $("#removeAllMemberModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});