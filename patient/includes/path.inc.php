<?php
// Clinic
$HOME_PAGE = "index.php";
$BRAND_NAME = "Wound Monitoring UI";
$PATH = "SurgeryAndWound/patient";

switch ($_SERVER["SCRIPT_NAME"]) {
    case '/' . $PATH . '/login.php':
        $CURRENT_PAGE = "Login";
        $CURRENT_PATH = "Login";
        $PAGE_TITLE = "Login | $BRAND_NAME";
        break;


    case '/' . $PATH . '/patient-Iupload.php':
        $CURRENT_PAGE = "Image Upload";
        $CURRENT_PATH = "";
        $PAGE_TITLE = "Image Upload| $BRAND_NAME";
        break;

    case '/' . $PATH . '/patient-Iview.php':
        $CURRENT_PAGE = "Image View";
        $CURRENT_PATH = "";
        $PAGE_TITLE = "Image View| $BRAND_NAME";
        break;

    case '/' . $PATH . '/patient-edit-view.php':
        $CURRENT_PAGE = "Image View & Edit";
        $CURRENT_PATH = "";
        $PAGE_TITLE = "Image View| $BRAND_NAME";
        break;

    case '/' . $PATH . '/patient-list.php':
        $CURRENT_PAGE = "Notification";
        $CURRENT_PATH = "Notification";
        $PAGE_TITLE = "Notification| $BRAND_NAME";
        break;
    case '/' . $PATH . '/appointment-list.php':
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
