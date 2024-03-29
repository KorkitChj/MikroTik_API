var site_manage;
$(document).ready(function () {
    load_data();
    function load_data(is_category) {
        site_manage = $("#site_manage").DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[2, "desc"]],
            "ajax": {
                url: "../process/admin/register_retrieve_process.php",
                type: "POST",
                data: { is_category: is_category }
            },
            "columnDefs": [{
                "targets": [0, 6],
                "orderable": false,
            }],
            "language": {
                "sProcessing":    "กำลังดำเนินการ...",
                "sLengthMenu":    "แสดง _MENU_ แถว",
                "sZeroRecords":   "ไม่พบค้นหา",
                "sEmptyTable":    "ไม่มีข้อมูลในตาราง",
                "sInfo":          "แสดง _START_ ถึง _END_ ของ _TOTAL_ แถว",
                "sInfoEmpty":     "แสดง 0 ถึง 0 ของ 0 แถว",
                "sInfoFiltered":  "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix":   "",
                "sSearch":        "ค้นหา:",
                "sUrl":           "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "กำลังโหลดข้อมูล...",
                "oPaginate": {
                    "sFirst":    "หน้าแรก",
                    "sLast":    "หน้าสุดท้าย",
                    "sNext":    "ถัดไป",
                    "sPrevious": "ก่อนหน้า"
                },
                "oAria": {
                    "sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                    "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
                }
            }
            /*"createdRow": function (row, data, dataIndex) {
                if (data[1] == '<span class=\"badge-pill badge-success\">สั่งซื้อ</span>') {
                    $(row).css({ "color": "#0066ff" });
                } else {
                    $(row).css({ "background-color": "#ff9999", "color": "#000000" });
                }
            }*/
        });
    }
    $(document).on('change', '#category', function () {
        var category = $(this).val();
        $('#site_manage').DataTable().destroy();
        if (category != '') {
            load_data(category);
        }
        else {
            load_data();
        }
    });
});
function removeMember(id) {
    if (id) {
        $("#removeBtn").off('click').on('click', function () {
            $.ajax({
                url: '../process/admin/del_process.php',
                type: 'post',
                data: {
                    cus_id: id
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        site_manage.ajax.reload(null, false);
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
    var cus_id = [];
    $('.checkitem').prop("checked", $(this).prop("checked"));
    $('.checkitem:checked').each(function (i) {
        cus_id[i] = $(this).val();
    });
    var countCheckedCheckboxes = cus_id.length;
    $('#count-checked-checkboxes').text(countCheckedCheckboxes);
});
$('#removeAllBtn').click(function () {
    var cus_id = [];
    $('.checkitem:checked').each(function (i) {
        cus_id[i] = $(this).val();
    });
    if (cus_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../process/admin/del_check_process.php',
            method: 'POST',
            data: {
                cus_id: cus_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    site_manage.ajax.reload(null, false);
                    $("#removeAllMemberModal").modal('hide');
                    $("#checkall").prop("checked", false);
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                    $("#checkall").prop("checked", false);
                }
            }
        });
    }
});