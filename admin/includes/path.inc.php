<?php
// Clinic
$HOME_PAGE = "index.php";
$BRAND_NAME = "Wound Monitoring UI";
$PATH = "SurgeryAndWound/admin";

switch ($_SERVER["SCRIPT_NAME"]) {
    case '/'.$PATH.'/login.php':
        $CURRENT_PAGE = "Login";
        $CURRENT_PATH = "Login";
        $PAGE_TITLE = "Login | $BRAND_NAME";
        break;
    
    // Patient    
    case '/'.$PATH.'/patient-add.php':
        $CURRENT_PAGE = "Add Patient";
        $CURRENT_PATH = "Add Patient";
        $PAGE_TITLE = "Patient | $BRAND_NAME";
        break;
    
    case '/'.$PATH.'/patient-view.php':
        $CURRENT_PAGE = "View Patient";
        $CURRENT_PATH = "View Patient";
        $PAGE_TITLE = "Patient | $BRAND_NAME";
        break;
    
    // Doctor
    case '/'.$PATH.'/doctor-add.php':
        $CURRENT_PAGE = "Add Doctor";
        $CURRENT_PATH = "";
        $PAGE_TITLE = "Doctor | $BRAND_NAME";
        break;
    
        case '/'.$PATH.'/doctor-view.php':
        $CURRENT_PAGE = "View Doctor";
        $CURRENT_PATH = "";
        $PAGE_TITLE = "Doctor | $BRAND_NAME";
        break;

    // Research Team
    case '/'.$PATH.'/research_team-add.php':
        $CURRENT_PAGE = "Add Member";
        $CURRENT_PATH = "";
        $PAGE_TITLE = "Research Team | $BRAND_NAME";
        break;
    


    //patient-doctor-list
    case '/'.$PATH.'/patient-doctor-list.php':
        if($_GET['t']==base64_encode('d')){
            $CURRENT_PAGE = "Doctor List";
            $CURRENT_PATH = "Doctor List";
            $PAGE_TITLE = "Doctor | $BRAND_NAME";
        }
        if($_GET['t']==base64_encode('p')){
            $CURRENT_PAGE = "Patient List";
            $CURRENT_PATH = "Patient List";
            $PAGE_TITLE = "Patient | $BRAND_NAME";
        }
        if($_GET['t']==base64_encode('R')){
            $CURRENT_PAGE = "Member List";
            $CURRENT_PATH = "Member List";
            $PAGE_TITLE = "Member | $BRAND_NAME";
        }
        break;

    //patient-doctor-view
    case '/'.$PATH.'/patient-doctor-view.php':
        if($_GET['t']==base64_encode('d')){
            $CURRENT_PAGE = "View Doctor";
            $CURRENT_PATH = "View Doctor";
            $PAGE_TITLE = "Doctor | $BRAND_NAME";
        }
        if($_GET['t']==base64_encode('p')){
            $CURRENT_PAGE = "View Patient";
            $CURRENT_PATH = "View Patient";
            $PAGE_TITLE = "Patient | $BRAND_NAME";
        }
        if($_GET['t']==base64_encode('R')){
            $CURRENT_PAGE = "View Member";
            $CURRENT_PATH = "View Member";
            $PAGE_TITLE = "Member | $BRAND_NAME";
        }
        break;



    
    // Appointment
    case '/'.$PATH.'/appointment-add.php':
        $CURRENT_PAGE = "Appointment";
        $CURRENT_PATH = "";
        $PAGE_TITLE = "Appointment | $BRAND_NAME";
        break;
    
    
    case '/'.$PATH.'/appointment-excel-add.php':
        $CURRENT_PAGE = "Appointment";
        $CURRENT_PATH = "";
        $PAGE_TITLE = "Appointment | $BRAND_NAME";
        break;

    case '/'.$PATH.'/appointment-list.php':
        $CURRENT_PAGE = "Appointment List";
        $CURRENT_PATH = "";
        $PAGE_TITLE = "Appointment List| $BRAND_NAME";
        break;

    // Schedule
    case '/'.$PATH.'/schedule.php':
        $CURRENT_PAGE = "Schedule";
        $CURRENT_PATH = "Schedule";
        $PAGE_TITLE = "Schedule | $BRAND_NAME";
        break;
    
    case '/'.$PATH.'/speciality.php':
        $CURRENT_PAGE = "Speciality";
        $CURRENT_PATH = "";
        $PAGE_TITLE = "Speciality | $BRAND_NAME";
        break;
    
    case '/'.$PATH.'/language.php':
        $CURRENT_PAGE = "Language";
        $CURRENT_PATH = "Language";
        $PAGE_TITLE = "Language | $BRAND_NAME";
        break;
    
    case '/'.$PATH.'/report.php':
        $CURRENT_PAGE = "Report";
        $CURRENT_PATH = "Report";
        $PAGE_TITLE = "Report | $BRAND_NAME";
        break;
    
    case '/'.$PATH.'/admin.php':
        $CURRENT_PAGE = "Manage Admin";
        $CURRENT_PATH = "Manage Admin";
        $PAGE_TITLE = "Manage Admin | $BRAND_NAME";
        break;

    case '/'.$PATH.'/profile.php':
        $CURRENT_PAGE = "Edit Admin";
        $CURRENT_PATH = "Edit Admin";
        $PAGE_TITLE = "Edit Admin | $BRAND_NAME";
        break;

    case '/'.$PATH.'/admin-add.php':
        $CURRENT_PAGE = "Add Admin";
        $CURRENT_PATH = "Add Admin";
        $PAGE_TITLE = "Add Admin | $BRAND_NAME";
        break;

    //others
    case '/'.$PATH.'/admin-upload.php':
        $CURRENT_PAGE = "Excel Import";
        $CURRENT_PATH = "Excel Import";
        $PAGE_TITLE = "Excel Import | $BRAND_NAME";
        break;

    case '/'.$PATH.'/admin-export.php':
        $CURRENT_PAGE = "Excel Export";
        $CURRENT_PATH = "Excel Export";
        $PAGE_TITLE = "Excel Export | $BRAND_NAME";
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