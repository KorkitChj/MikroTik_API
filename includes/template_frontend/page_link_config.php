<?php
$aa = $_SERVER["SCRIPT_NAME"];
switch ($_SERVER["SCRIPT_NAME"]) {
    case "/web/products.php":
        $CURRENT_PAGE = "Products";
        $PAGE_TITLE = "Products Us";
        break;
    case "/web/payment.php":
        $CURRENT_PAGE = "Payment";
        $PAGE_TITLE = "Payment Us";
        break;
    case "/web/transfer.php":
        $CURRENT_PAGE = "Transfer";
        $PAGE_TITLE = "Transfer Us";
        break;
    case "/web/register.php":
        $CURRENT_PAGE = "Register";
        $PAGE_TITLE = "Register Us";
        break;
    default:
        $CURRENT_PAGE = "Index";
        $PAGE_TITLE = "Welcome to my homepage!";
}
?>