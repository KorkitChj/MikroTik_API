<?php
$aa = $_SERVER["SCRIPT_NAME"];
switch ($_SERVER["SCRIPT_NAME"]) {
    case "/web/products.php":
        $CURRENT_PAGE = "Products";
        $PAGE_TITLE = "Products Us";
        break;
    case "/web/cart.php":
        $CURRENT_PAGE = "Cart";
        $PAGE_TITLE = "Cart";
        break;
    case "/web/transfer.php":
        $CURRENT_PAGE = "Transfer";
        $PAGE_TITLE = "Transfer Us";
        break;
    case "/web/register.php":
        $CURRENT_PAGE = "Register";
        $PAGE_TITLE = "Register Us";
        break;
    case "/web/login.php":
        $CURRENT_PAGE = "Login";
        $PAGE_TITLE = "Login";
        break;
    case "/web/service_introduction.php":
        $CURRENT_PAGE = "service";
        $PAGE_TITLE = "Service introduction";
        break;
    default:
        $CURRENT_PAGE = "Index";
        $PAGE_TITLE = "Welcome to my homepage!";
}
