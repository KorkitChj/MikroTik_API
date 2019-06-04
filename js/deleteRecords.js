$(document).ready(function () {
    $('.delete_customer').click(function (e) {
        e.preventDefault();
        var cusid = $(this).attr('data-cus-id');
        var parent = $(this).parent("td").parent("tr");
        bootbox.dialog({
            message: "Are you sure you want to Delete ?",
            title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
            buttons: {
                success: {
                    label: "No",
                    className: "btn-success",
                    callback: function () {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "Delete!",
                    className: "btn-danger",
                    callback: function () {
                        $.ajax({
                            type: 'POST',
                            url: 'deleteRecords.php',
                            data: 'cusid=' + cusid
                        })
                            .done(function (response) {
                                bootbox.alert(response);
                                parent.fadeOut('slow');
                            })
                            .fail(function () {
                                bootbox.alert('Error....');
                            })
                    }
                }
            }
        });
    });
});