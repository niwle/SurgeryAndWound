<?php
include('../config/config.php');
include('../config/database.php');
include('../config/security.php');
include('../config/validator.php');
require_once '../vendor/autoload.php';

define('CSS_PATH', '../config/path_css.php');
define('JS_PATH', '../config/path_script.php');

define('EMAIL_HELPER', '../helper/email.helper.php');
define('SELECT_HELPER', '../helper/select_helper.php');
define('FILE_HELPER', '../helper/file_helper.php');

$created_at = date('Y-m-d H:i:s');
$created_at_notime = date('Y_m_d');
$created_at_notime2 = date('Y-m-d');