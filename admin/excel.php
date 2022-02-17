<?php
$flag =($_POST['flag'])!="" ? $_POST['flag'] : "all";
$type =($_POST['m_type'])!="" ? $_POST['m_type'] : "all";

$startDate =($_POST['expStartDate'])!="" ? $_POST['expStartDate'] : "";
$endDate =($_POST['expEndDate'])!="" ? $_POST['expEndDate'] : "";

$buildsqlArr = ['flag' => $flag, 'm_type' => $type, 'startDate' => $startDate, "endDate" => $endDate];
$lstKey = array_key_last($buildsqlArr);
$previousKey = "";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();

$activeSheet->setCellValue('A1', 'ID');
$activeSheet->setCellValue('B1', 'Name');
$activeSheet->setCellValue('C1', 'Identity');
$activeSheet->setCellValue('D1', 'Registration ID (Patient)');
$activeSheet->setCellValue('E1', 'Gender');
$activeSheet->setCellValue('F1', 'Type');
$activeSheet->setCellValue('G1', 'Email');
$activeSheet->setCellValue('H1', 'Phone');
$activeSheet->setCellValue('I1', 'Date of Birth');
$activeSheet->setCellValue('J1', 'Created At');


// print_r($_POST);

$buildsql = "SELECT * FROM user_master ";


foreach ($buildsqlArr as $key => $value) {
    if ($value != "" && $value != "all") {
        if (strpos($buildsql, 'where') == false) {
            $buildsql .= " where ";
        } else {
            if ((strpos($buildsql, $previousKey) == true)) {
                $buildsql .= " and ";
            }
        }
        if ($key == "startDate") {
            $buildsql .= " $key >= '$value' ";
        } else if ($key == "endDate") {
            $buildsql .= " $key <= '$value' ";
        } else {
            $buildsql .= " $key = '$value' ";
        }
        $previousKey = $key;
    }
    if ($lstKey == $key) {
        $buildsql .= ";";
    }
}

$buildsql = str_replace("startDate", "created_at", $buildsql);
$buildsql = str_replace("endDate", "created_at", $buildsql);

$query = $conn->query("$buildsql");

if ($query->num_rows > 0) {
    $i = 2;
    while ($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A' . $i, $row['m_id']);
        $activeSheet->setCellValue('B' . $i, $row['m_name']);
        $activeSheet->setCellValue('C' . $i, $row['m_identity']);
        $activeSheet->setCellValue('D' . $i, $row['m_regis_id']);
        $activeSheet->setCellValue('E' . $i, $row['m_gender']);
        $activeSheet->setCellValue('F' . $i, $row['m_type']);
        $activeSheet->setCellValue('G' . $i, $row['email']);
        $activeSheet->setCellValue('H' . $i, $row['phone']);
        $activeSheet->setCellValue('I' . $i, $row['m_dob']);
        $activeSheet->setCellValue('J' . $i, $row['created_at']);
        $i++;
    }

    $filename = 'temp/User_Listing_' . $created_at_notime . '_' . $_SESSION['userID'] . '.xlsx';

    if (headers_sent()) {
        print_r("Error generating excel"); //header problem. Please put this infront of everything so it does not encounter this problem
    } else {
        $Excel_writer->save($filename);
        ob_clean();
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . basename($filename));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        unlink($filename);
        exit();
    }
} else {
    echo "<script>
    Swal.fire(
        'No record available for the chosen criteria',
      )
    </script>";
    
}
