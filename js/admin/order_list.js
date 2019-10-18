var order_list;
$(document).ready(function () {
    load_data();
    function load_data(is_category) {
        order_list = $("#order_list").DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[1, "desc"]],
            "ajax": {
                url: "../process/admin/order_list_retrieve_process.php",
                data: { is_category: is_category },
                type: "POST",
            },
            "columnDefs": [{
                "targets": [0, 6],
                "orderable": false,
            }],
            "language": {
                "sProcessing": "กำลังดำเนินการ...",
                "sLengthMenu": "แสดง _MENU_ แถว",
                "sZeroRecords": "ไม่พบค้นหา",
                "sEmptyTable": "ไม่มีข้อมูลในตาราง",
                "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ แถว",
                "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 แถว",
                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix": "",
                "sSearch": "ค้นหา:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "กำลังโหลดข้อมูล...",
                "oPaginate": {
                    "sFirst": "หน้าแรก",
                    "sLast": "หน้าสุดท้าย",
                    "sNext": "ถัดไป",
                    "sPrevious": "ก่อนหน้า"
                },
                "oAria": {
                    "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                    "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
                }
            }
        });
    }
    $(document).on('change', '#category', function () {
        var category = $(this).val();
        $('#order_list').DataTable().destroy();
        if (category != '') {
            load_data(category);
        }
        else {
            load_data();
        }
    });
});
function removeOrder(id) {
    if (id) {
        $("#removeBtn").off('click').on('click', function () {
            $.ajax({
                url: '../process/admin/order_del_process.php',
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
            url: '../process/admin/order_del_check_process.php',
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