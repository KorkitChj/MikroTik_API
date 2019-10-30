<?php
    if(isset($_POST['slip_name']))
    {
        $output = array();
    
        $output['user_image'] = '<img src="../slips/'.$_POST['slip_name'].'" class="img-thumbnail" width="300" height="250" /><input type="hidden" name="hidden_user_image" />';
    }elseif(isset($_POST['product_id']))
    {
        $output = array();
        $output['product_image'] = '<img src="../img/products/'.$_POST['product_id'].'" class="img-thumbnail" width="300" height="250" /><input type="hidden" name="hidden_user_image" />';
    }
echo json_encode($output);
?>