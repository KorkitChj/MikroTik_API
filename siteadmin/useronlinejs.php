<script>
    $(document).ready(function() {
    <?php
    if ($_SESSION["cus_id"]) {
        ?>
        function update_user_activity() {
            var action = 'update_time';
            $.ajax({
                url: "../admin/useronline_action.php",
                method: "POST",
                data: {
                    action: action
                },
                success: function(data) {

                }
            });
        }
        setInterval(function() {
            update_user_activity();
        }, 3000);
        <?php }?>
     });
</script>
