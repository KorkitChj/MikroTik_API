var order_list;
$(document).ready(function () {
    order_list = $("#order_list").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[1, "desc"]],
        "ajax": {
            url: "../admin/order_list_retrieve.php",
            type: "POST",
        },
        "columnDefs": [{
            "targets": [0,5,7],
            "orderable": false,
        }]
    });
});
function removeOrder(id) {
    if (id) {
        $("#removeBtn").off('click').on('click', function () {
            $.ajax({
                url: '../admin/order_del.php',
                type: 'post',
                data: {
                    order_id: id
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        order_list.ajax.reload(null, false);
                        $("#removeOrderModal").modal('hide');
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
    var order_id = [];
    $('.checkitem').prop("checked", $(this).prop("checked"));
    $('.checkitem:checked').each(function (i) {
        order_id[i] = $(this).val();
    });
    var countCheckedCheckboxes = order_id.length;
    $('#count-checked-checkboxes').text(countCheckedCheckboxes);
});
$('#removeAllBtn').click(function () {
    var order_id = [];
    $('.checkitem:checked').each(function (i) {
        order_id[i] = $(this).val();
    });
    if (order_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../admin/order_del_check.php',
            method: 'POST',
            data: {
                order_id: order_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    order_list.ajax.reload(null, false);
                    $("#removeAllOrderModal").modal('hide');
                    $("#checkall").prop("checked", false);
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                    $("#checkall").prop("checked", false);
                }
            }
        });
    }
});