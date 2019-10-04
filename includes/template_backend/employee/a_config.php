<?php
$aa = $_SERVER["SCRIPT_NAME"];
switch ($_SERVER["SCRIPT_NAME"]) {
    case "/web/employee/employee.php":
        $CURRENT_PAGE = "employee_con";
        $PAGE_TITLE = "Employee Connect";
        break;
    case "/web/employee/changpwemp.php":
        $CURRENT_PAGE = "cpwe";
        $PAGE_TITLE = "Chang Password Employee";
        break;
    case "/web/employee/dashboard.php":
        $CURRENT_PAGE = "dashboard";
        $PAGE_TITLE = "Dashboard";
        break;
    case "/web/employee/userstatus.php":
        $CURRENT_PAGE = "userstatus";
        $PAGE_TITLE = "Users status";
        break;
}
