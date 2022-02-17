<?php
// Clinic
$HOME_PAGE = "index.php";
$BRAND_NAME = "Wound Monitoring UI";
$PATH = "SurgeryAndWound/doctor";

switch ($_SERVER["SCRIPT_NAME"]) {
    case '/'.$PATH.'/login.php':
        $CURRENT_PAGE = "Login";
        $CURRENT_PATH = "Login";
        $PAGE_TITLE = "Login | $BRAND_NAME";
        break;

    case '/'.$PATH.'/patient-list.php':
        $CURRENT_PAGE = "Patient List";
        $CURRENT_PATH = "Patient List";
        $PAGE_TITLE = "Patient List| $BRAND_NAME";
        break;

    case '/'.$PATH.'/patient-view.php':
        $CURRENT_PAGE = "Patient View";
        $CURRENT_PATH = "Patient View";
        $PAGE_TITLE = "Patient View| $BRAND_NAME";
        break;

    case '/'.$PATH.'/comment-list.php':
        $CURRENT_PAGE = "Comments";
        $CURRENT_PATH = "Comments";
        $PAGE_TITLE = "Comments List| $BRAND_NAME";
        break;

    case '/'.$PATH.'/notification-list.php':
        $CURRENT_PAGE = "Notification";
        $CURRENT_PATH = "Notification";
        $PAGE_TITLE = "Notification List| $BRAND_NAME";
        break;

    case '/'.$PATH.'/appointment-list.php':
        $CURRENT_PAGE = "Appointment";
        $CURRENT_PATH = "Appointment";
        $PAGE_TITLE = "Appointment List| $BRAND_NAME";
        break;
    
    // Index Page
    default:
        $CURRENT_PAGE = "Dashboard";
        $PAGE_TITLE = "Home | $BRAND_NAME";
        break;
}

define('NAVIGATION', 'layouts/navigate.php');
define('HEADER', 'layouts/nav_header.php');
define('WIDGET', 'layouts/widget.php');