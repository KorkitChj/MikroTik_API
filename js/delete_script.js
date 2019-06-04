
$(document).ready(function () {
    $('#example').DataTable({
        "aLengthMenu": [
            [5, 10, 25, -1],
            [5, 10, 25, "All"]
        ],
        "iDisplayLength": 5
    });
    $(document).on('click', '#select_all', function () {
        $(".cus_checkbox").prop("checked", this.checked);
        $("#select_count").html($("input.cus_checkbox:checked").length + " Selected");
    });
    $(document).on('click', '.cus_checkbox', function () {
        if ($('.cus_checkbox:checked').length == $('.cus_checkbox').length) {
            $('#select_all').prop('checked', true);
        } else {
            $('#select_all').prop('checked', false);
        }
        $("#select_count").html($("input.cus_checkbox:checked").length + " Selected");
    });
    // delete selected records
    $('#delete_records').on('click', function (e) {
        var siteadmin = [];
        $(".cus_checkbox:checked").each(function () {
            siteadmin.push($(this).data('cus-id'));
        });
        if (siteadmin.length <= 0) {
            alert("Please select records.");
        } else {
            WRN_PROFILE_DELETE = "Are you sure you want to delete " + (siteadmin.length > 1 ? "these" : "this") + " row?";
            var checked = confirm(WRN_PROFILE_DELETE);
            if (checked == true) {
                var selected_values = siteadmin.join(",");
                $.ajax({
                    type: "POST",
                    url: "../siteadmin/delete_action.php",
                    cache: false,
                    data: 'cus_id=' + selected_values,
                    success: function (response) {
                        // remove deleted siteadmin rows
                        var cus_ids = response.split(",");
                        for (var i = 0; i < cus_ids.length; i++) {
                            $("#" + cus_ids[i]).remove();
                        }
                    }
                });
            }
        }
    });
});
