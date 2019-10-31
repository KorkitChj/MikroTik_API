<?php
$aa = $_SERVER["SCRIPT_NAME"];
switch ($_SERVER["SCRIPT_NAME"]) {
    case "/web/siteadmin/connectstatus.php":
        $CURRENT_PAGE = "connectstatus";
        $PAGE_TITLE = "Connect State";
        break;
    case "/web/siteadmin/invoice.php":
        $CURRENT_PAGE = "invoice";
        $PAGE_TITLE = "Invoice";
        break;
    case "/web/siteadmin/order_report.php":
        $CURRENT_PAGE = "orderreport";
        $PAGE_TITLE = "Order Report";
        break;
    case "/web/site/dashboard.php":
        $CURRENT_PAGE = "dashboard";
        $PAGE_TITLE = "Dash Board";
        break;
    case "/web/site/interfacemonitor.php":
        $CURRENT_PAGE = "interface";
        $PAGE_TITLE = "Interface";
        break;
    case "/web/site/employeestatus.php":
        $CURRENT_PAGE = "employee";
        $PAGE_TITLE = "Employee";
        break;
    case "/web/site/employeeactive.php":
        $CURRENT_PAGE = "employeeactive";
        $PAGE_TITLE = "Employee Active";
        break;
    case "/web/site/addserverprofile.php":
        $CURRENT_PAGE = "serverprofile";
        $PAGE_TITLE = "Server Profile";
        break;
    case "/web/site/profilestatus.php":
        $CURRENT_PAGE = "hotspotprofile";
        $PAGE_TITLE = "Hotspot Profile";
        break;
    case "/web/site/wallgardenstatus.php":
        $CURRENT_PAGE = "wallgarden";
        $PAGE_TITLE = "Wall Graden";
        break;
}
