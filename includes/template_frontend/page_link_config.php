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
    case "/web/process/main_site/password_reset.php":
        $PAGE_TITLE = "Password Reset";
        break;
    case "/web/process/main_site/password_verified.php":
        $PAGE_TITLE = "Password Verified";
        break;
    case "/web/admin/login.php":
        $PAGE_TITLE = "ALogin";
        break;
    default:
        $CURRENT_PAGE = "Index";
        $PAGE_TITLE = "Welcome to my homepage!";
}
