<?php
$aa = $_SERVER["SCRIPT_NAME"];
switch ($_SERVER["SCRIPT_NAME"]) {
    case "/web/admin/dashboard.php":
        $CURRENT_PAGE = "dashboard";
        $PAGE_TITLE = "Dashboard";
        break;
    case "/web/admin/order_list.php":
        $CURRENT_PAGE = "orderlist";
        $PAGE_TITLE = "Order List";
        break;
    case "/web/admin/checkpayment.php":
        $CURRENT_PAGE = "checkpayment";
        $PAGE_TITLE = "Check payment";
        break;
    case "/web/admin/manage.php":
        $CURRENT_PAGE = "manage";
        $PAGE_TITLE = "Manage";
        break;
    case "/web/admin/useronline.php":
        $CURRENT_PAGE = "useronline";
        $PAGE_TITLE = "Useronline";
        break;
    default:
        $CURRENT_PAGE = "siteregister";
        $PAGE_TITLE = "Site Register";
}
