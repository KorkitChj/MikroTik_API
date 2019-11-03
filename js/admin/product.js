var productstable;
$(document).ready(function () {
    productstable = $("#productstable").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "../process/admin/products_retrieve_process.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 5],
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
});
$(document).on('click', '.displayimg', function () {
    var product_id = $(this).attr("id");
    $.ajax({
        url: "../process/admin/fetch_img_process.php",
        method: "POST",
        data: { product_id: product_id },
        dataType: "json",
        success: function (data) {
            $('#product').html(data.product_image);
        }
    })
});
$(document).on('click', '.displaydetail', function () {
    var product_id = $(this).attr("id");
    $.ajax({
        url: "../process/admin/fetch_product_detail_process.php",
        method: "POST",
        data: { product_id: product_id },
        dataType: "json",
        success: function (data) {
            var value = data.data.split('/');
            for (var i = 0; i < value.length; i++) {
                $('#productdetail').append('<i class="fas fa-dot-circle"></i> ' + value[i] + "<br>");
            }
            $('#displayproductdetailModal').on('hidden.bs.modal', function () {
                $("#productdetail").html("");
            })
        }
    })
});
$("#addProductModalBtn").click(function () {
    $("#addproduct")[0].reset();
    $("#addproduct").off('submit').on('submit', function () {
        var form = $(this);
        var extension = $('#product_image').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                swal("ผิดพลาด", "Invalid Image File", "error");
                $('#product_image').val('');
                return false;
            }
        }
        var productname = $("#productname").val();
        var productprice = $("#productprice").val();
        var producttitle = $("#producttitle").val();
        var productdetail = $("textarea#productdetail").val();
        if (productname && productprice && producttitle && productdetail) {
            $.ajax({
                url: '../process/admin/product_add_process.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        $("#addproduct")[0].reset();
                        productstable.ajax.reload(null, false);
                        $("#addProductModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        }
        return false;
    });
});
function removeProduct(id) {
    if (id) {
        $("#removeProductBtn").off('click').on('click', function () {
            $.ajax({
                url: '../process/admin/products_del_process.php',
                type: 'POST',
                data: { 'product_id': id, 'type': 'one' },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        productstable.ajax.reload(null, false);
                        $("#removeproductModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                        $("#removeproductModal").modal('hide');
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
$('#removeAllProductsBtn').click(function () {
    var product_id = [];
    $('.checkitem:checked').each(function (i) {
        product_id[i] = $(this).val();
    });
    if (product_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../process/admin/products_del_process.php',
            method: 'POST',
            data: {
                'product_id': product_id, 'type': 'many'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    productstable.ajax.reload(null, false);
                    $("#removeAllMemberModal").modal('hide');
                    $("#checkall").prop("checked", false);
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                    productstable.ajax.reload(null, false);
                    $("#checkall").prop("checked", false);
                    $("#removeAllMemberModal").modal('hide');
                }
            }
        });
    }
});
function editProduct(id) {
    if (id) {
        $.ajax({
            url: '../process/admin/getSelectedProduct_process.php',
            type: 'POST',
            data: {
                product_id: id
            },
            dataType: 'json',
            success: function (response) {
                $("#editproductname").val(response.product_name);
                $("#editproductprice").val(response.price);
                $("#editproducttitle").val(response.title);
                $("textarea#editproductdetail").val(response.function);
                $('#displayproduct_image').html(response.image);
                $("#editproduct").append('<input type="hidden" name="editproduct_id" id="editproduct_id" value="' + response.product_id + '"/>');
                $("#editproduct").off('submit').on('submit', function () {
                    var form = $(this);
                    var editproductname = $("#editproductname").val();
                    var editproductprice = $("#editproductprice").val();
                    var editproducttitle = $("#editproducttitle").val();
                    var editproductdetail = $("textarea#editproductdetail").val();

                    if (editproductname && editproductprice && editproducttitle && editproductdetail) {
                        $.ajax({
                            url: '../process/admin/product_update_process.php',
                            type: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function (response) {
                                if (response.success == true) {
                                    swal("สำเร็จ", response.messages, "success");
                                    productstable.ajax.reload(null, false);
                                    $("#editproductModal").modal('hide');
                                } else {
                                    swal("ผิดพลาด", response.messages, "error");
                                }
                            }
                        });
                    }
                    return false;
                });
            }
        });
    } else {
        alert("Error : Refresh the page again");
    }
}

function readURLedit(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imageproduct').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#editproduct_image").change(function() {
    readURLedit(this);
});
function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#add_product').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  $("#product_image").change(function() {
    readURL(this);
  });





